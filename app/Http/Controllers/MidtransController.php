<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Fix for cURL error on local Windows environment
        if (file_exists('C:\laragon\etc\ssl\cacert.pem')) {
            ini_set('curl.cainfo', 'C:\laragon\etc\ssl\cacert.pem');
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Disable SSL verification for local development (Laragon issue)
        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => [], // Fix for Midtrans SDK undefined key bug
        ];

    }



    /**
     * Generate Snap Token untuk pendaftaran
     */
    public function createTransaction(Pendaftaran $pendaftaran)
    {
        // Jika sudah punya snap token yang masih valid, kembalikan
        if ($pendaftaran->snap_token && $pendaftaran->payment_status === 'unpaid') {
            return response()->json([
                'snap_token' => $pendaftaran->snap_token,
            ]);
        }

        $orderId = 'HT-' . $pendaftaran->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $pendaftaran->paket->harga,
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->nama_lengkap,
                'phone' => $pendaftaran->no_hp,
                'email' => $pendaftaran->user->email ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'PAKET-' . $pendaftaran->paket_id,
                    'price' => (int) $pendaftaran->paket->harga,
                    'quantity' => 1,
                    'name' => substr($pendaftaran->paket->nama, 0, 50),
                ],
            ],
            'callbacks' => [
                'finish' => route('pendaftaran.riwayat'),
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $pendaftaran->update([
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId,
                'jumlah_bayar' => (int) $pendaftaran->paket->harga,
            ]);

            return response()->json([
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal membuat transaksi pembayaran. Silakan coba lagi.',
            ], 500);
        }
    }

    /**
     * Generate Snap Token untuk cicilan berikutnya
     */
    public function createInstallment(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with('paket')->findOrFail($id);

        $request->validate([
            'amount' => 'required|integer|min:1000000',
        ]);

        $amount = (int) $request->amount;

        // Hitung sisa tagihan secara manual untuk memastikan akurat
        $hargaPaket = $pendaftaran->jumlah_bayar ?: ($pendaftaran->paket->harga ?? 0);
        $totalPaid = $pendaftaran->pembayarans()->where('payment_status', 'paid')->sum('amount');
        $sisaTagihan = $hargaPaket - $totalPaid;

        Log::info("Installment Check: Paket={$hargaPaket}, Paid={$totalPaid}, Sisa={$sisaTagihan}, Request={$amount}");

        if ($sisaTagihan <= 0) {
            return response()->json([
                'error' => 'Pembayaran sudah lunas.',
            ], 400);
        }

        if ($amount > $sisaTagihan) {
            return response()->json([
                'error' => 'Nominal melebihi sisa tagihan (Sisa: Rp ' . number_format($sisaTagihan, 0, ',', '.') . ')',
            ], 400);
        }

        $orderId = 'HT-' . $pendaftaran->id . '-C-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->nama_lengkap,
                'phone' => $pendaftaran->no_hp,
                'email' => $pendaftaran->user->email ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'PAKET-' . $pendaftaran->paket_id,
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Cicilan ' . substr($pendaftaran->paket->nama, 0, 40),
                ],
            ],
            'callbacks' => [
                'finish' => route('pendaftaran.riwayat'),
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Create Pembayaran record
            \App\Models\Pembayaran::create([
                'pendaftaran_id' => $pendaftaran->id,
                'amount' => $amount,
                'payment_status' => 'unpaid',
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId,
            ]);

            return response()->json([
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Installment Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal membuat transaksi cicilan. Silakan coba lagi.',
            ], 500);
        }
    }

    /**

     * Handle webhook notification dari Midtrans
     */
    public function callback(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;
        $paymentType = $notification->payment_type;
        $transactionId = $notification->transaction_id;

        Log::info("Midtrans Callback: Order={$orderId}, Status={$transactionStatus}, Payment={$paymentType}");

        $pembayaran = \App\Models\Pembayaran::where('midtrans_order_id', $orderId)->first();
        $pendaftaran = null;

        if (!$pembayaran) {
            Log::warning("Midtrans Callback: Pembayaran not found for order {$orderId}");
            
            // Fallback support for legacy registrations without record in pembayarans table
            $pendaftaran = Pendaftaran::where('midtrans_order_id', $orderId)->first();
            if (!$pendaftaran) {
                return response()->json(['message' => 'Order not found'], 404);
            }
        } else {
            $pendaftaran = $pembayaran->pendaftaran;
        }

        // Determine payment status based on transaction status
        $isPaid = false;
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            if ($transactionStatus == 'capture' && in_array($fraudStatus, ['accept', 'challenge'])) {
                $isPaid = true;
            } elseif ($transactionStatus == 'settlement') {
                $isPaid = true;
            }
        }

        if ($pembayaran) {
            if ($isPaid) {
                $pembayaran->payment_status = 'paid';
            } elseif ($transactionStatus == 'pending') {
                $pembayaran->payment_status = 'unpaid';
            } elseif (in_array($transactionStatus, ['deny', 'cancel'])) {
                $pembayaran->payment_status = 'failed';
            } elseif ($transactionStatus == 'expire') {
                $pembayaran->payment_status = 'expired';
            }
            $pembayaran->save();
        }

        // Update Pendaftaran status
        if ($pendaftaran) {
            $pendaftaran->midtrans_transaction_id = $transactionId;
            $pendaftaran->metode_pembayaran = $paymentType;

            if ($pembayaran) {
                // Check if total paid equals or exceeds package price
                $totalPaid = $pendaftaran->pembayarans()->where('payment_status', 'paid')->sum('amount');
                $hargaPaket = $pendaftaran->paket->harga ?? 0;

                if ($totalPaid >= $hargaPaket) {
                    $pendaftaran->payment_status = 'paid';
                    $pendaftaran->status = 'pending'; // Siap review admin
                    $this->createPaymentNotification($pendaftaran, 'success');
                } else {
                    $pendaftaran->payment_status = 'unpaid'; // Still unpaid/partial
                    
                    if ($isPaid) {
                        // Send notification for partial payment
                        Notifikasi::create([
                            'user_id' => $pendaftaran->user_id,
                            'pendaftaran_id' => $pendaftaran->id,
                            'judul' => 'Pembayaran DP/Cicilan Berhasil ✅',
                            'pesan' => 'Pembayaran sebesar Rp ' . number_format($pembayaran->amount, 0, ',', '.') . ' berhasil. Sisa tagihan: Rp ' . number_format($hargaPaket - $totalPaid, 0, ',', '.'),
                            'tipe' => 'success',
                        ]);
                    }
                }
            } else {
                // Legacy support for older transactions
                if ($isPaid) {
                    $pendaftaran->payment_status = 'paid';
                    $pendaftaran->status = 'pending';
                    $this->createPaymentNotification($pendaftaran, 'success');
                } elseif ($transactionStatus == 'pending') {
                    $pendaftaran->payment_status = 'unpaid';
                } elseif (in_array($transactionStatus, ['deny', 'cancel'])) {
                    $pendaftaran->payment_status = 'failed';
                    $this->createPaymentNotification($pendaftaran, 'failed');
                } elseif ($transactionStatus == 'expire') {
                    $pendaftaran->payment_status = 'expired';
                    $this->createPaymentNotification($pendaftaran, 'expired');
                }
            }

            $pendaftaran->save();
        }


        return response()->json(['message' => 'OK']);
    }

    /**
     * Buat notifikasi pembayaran
     */
    private function createPaymentNotification(Pendaftaran $pendaftaran, string $type)
    {
        $messages = [
            'success' => [
                'judul' => 'Pembayaran Berhasil ✅',
                'pesan' => 'Pembayaran untuk paket "' . $pendaftaran->paket->nama . '" berhasil diterima. Pendaftaran Anda sedang menunggu review admin.',
                'tipe' => 'success',
            ],
            'failed' => [
                'judul' => 'Pembayaran Gagal ❌',
                'pesan' => 'Pembayaran untuk paket "' . $pendaftaran->paket->nama . '" gagal. Silakan lakukan pendaftaran ulang.',
                'tipe' => 'danger',
            ],
            'expired' => [
                'judul' => 'Pembayaran Kadaluarsa ⏰',
                'pesan' => 'Waktu pembayaran untuk paket "' . $pendaftaran->paket->nama . '" telah habis. Silakan lakukan pendaftaran ulang.',
                'tipe' => 'warning',
            ],
        ];

        if (isset($messages[$type])) {
            Notifikasi::create([
                'user_id' => $pendaftaran->user_id,
                'pendaftaran_id' => $pendaftaran->id,
                'judul' => $messages[$type]['judul'],
                'pesan' => $messages[$type]['pesan'],
                'tipe' => $messages[$type]['tipe'],
            ]);
        }
    }
}
