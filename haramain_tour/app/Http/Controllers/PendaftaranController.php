<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Paket;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    /**
     * Simpan data pendaftaran dari form multi-step (5 step)
     * Sekarang return JSON dengan snap token untuk pembayaran Midtrans
     */
    public function store(Request $request)
    {
        // Fix for cURL error on local Windows environment
        if (file_exists('C:\laragon\etc\ssl\cacert.pem')) {
            ini_set('curl.cainfo', 'C:\laragon\etc\ssl\cacert.pem');
        }

        $request->validate([

            // Step 1: Persyaratan (checked via JS, no server fields needed)
            // Step 2: Tanda Tangan Digital
            'tanda_tangan_digital' => 'required|string',

            // Step 3: Identitas
            'paket_id' => 'required|exists:pakets,id',
            'nama_lengkap' => 'required|string|max:200',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'nama_mahram' => 'nullable|string|max:200',

            // Step 4: Dokumen
            'foto_ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_paspor' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_visa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_buku_vaksin' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'riwayat_penyakit' => 'nullable|string',
            'golongan_darah' => 'required|in:A,B,AB,O',

            // New: Skema Pembayaran
            'skema_pembayaran' => 'required|in:full,cicilan',
            'nominal_dp' => 'nullable|required_if:skema_pembayaran,cicilan|integer|min:5000000',
        ]);

        // Upload files
        $fotoKtp = $request->file('foto_ktp')->store('pendaftaran/ktp', 'public');
        $fotoPaspor = $request->file('foto_paspor')->store('pendaftaran/paspor', 'public');
        $pasFoto = $request->file('pas_foto')->store('pendaftaran/pasfoto', 'public');
        $fotoVaksin = $request->file('foto_buku_vaksin')->store('pendaftaran/vaksin', 'public');
        
        $fotoVisa = null;
        if ($request->hasFile('foto_visa')) {
            $fotoVisa = $request->file('foto_visa')->store('pendaftaran/visa', 'public');
        }

        // Save digital signature as image file
        $signaturePath = null;
        if ($request->tanda_tangan_digital) {
            $signatureData = $request->tanda_tangan_digital;
            // Remove data:image/png;base64, prefix
            $signatureData = preg_replace('/^data:image\/\w+;base64,/', '', $signatureData);
            $signatureData = base64_decode($signatureData);
            $signatureFilename = 'pendaftaran/signatures/' . Auth::id() . '_' . time() . '.png';
            Storage::disk('public')->put($signatureFilename, $signatureData);
            $signaturePath = $signatureFilename;
        }

        // Get Paket first to get the price
        $paket = Paket::findOrFail($request->paket_id);

        // Determine amount to pay now
        $amountToPay = $paket->harga;
        if ($request->skema_pembayaran === 'cicilan') {
            $amountToPay = (int) $request->nominal_dp;
        }

        // Create pendaftaran with correct initial values
        $pendaftaran = Pendaftaran::create([
            'user_id' => Auth::id(),
            'paket_id' => $request->paket_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_mahram' => $request->nama_mahram,
            'foto_ktp' => $fotoKtp,
            'foto_paspor' => $fotoPaspor,
            'foto_visa' => $fotoVisa,
            'pas_foto' => $pasFoto,
            'foto_buku_vaksin' => $fotoVaksin,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'golongan_darah' => $request->golongan_darah,
            'tanda_tangan_digital' => $signaturePath,
            'surat_perjanjian_accepted_at' => now(),
            'persyaratan_accepted_at' => now(),
            'jumlah_bayar' => $paket->harga, // Total price of package
            'payment_status' => 'unpaid',
            'status' => 'pending',
        ]);

        // Generate Midtrans Snap Token for the FIRST payment (DP or Full)
        try {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
            
            // Disable SSL verification for local development (Laragon issue)
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER => [], // Fix for Midtrans SDK undefined key bug
            ];


            $orderId = 'HT-' . $pendaftaran->id . '-' . time();


            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amountToPay,
                ],
                'customer_details' => [
                    'first_name' => $pendaftaran->nama_lengkap,
                    'phone' => $pendaftaran->no_hp,
                    'email' => Auth::user()->email ?? '',
                ],
                'item_details' => [
                    [
                        'id' => 'PAKET-' . $pendaftaran->paket_id,
                        'price' => $amountToPay,
                        'quantity' => 1,
                        'name' => substr($pendaftaran->paket->nama, 0, 50),
                    ],
                ],
                'callbacks' => [
                    'finish' => route('pendaftaran.riwayat'),
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Create Pembayaran record
            \App\Models\Pembayaran::create([
                'pendaftaran_id' => $pendaftaran->id,
                'amount' => $amountToPay,
                'payment_status' => 'unpaid',
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId,
            ]);

            // Update Pendaftaran with the latest order ID and token for legacy support if needed
            $pendaftaran->update([
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId,
            ]);

            // Buat notifikasi
            Notifikasi::create([
                'user_id' => Auth::id(),
                'pendaftaran_id' => $pendaftaran->id,
                'judul' => 'Pendaftaran Dikirim',
                'pesan' => 'Pendaftaran Anda untuk paket "' . $pendaftaran->paket->nama . '" berhasil dikirim. Silakan selesaikan pembayaran.',
                'tipe' => 'info',
            ]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'pendaftaran_id' => $pendaftaran->id,
                'message' => 'Data pendaftaran berhasil disimpan. Silakan selesaikan pembayaran.',
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());

            // Tetap buat notifikasi meskipun Midtrans gagal
            Notifikasi::create([
                'user_id' => Auth::id(),
                'pendaftaran_id' => $pendaftaran->id,
                'judul' => 'Pendaftaran Dikirim',
                'pesan' => 'Pendaftaran Anda untuk paket "' . $pendaftaran->paket->nama . '" berhasil dikirim, namun terjadi kendala pada sistem pembayaran. Silakan hubungi admin.',
                'tipe' => 'warning',
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Data pendaftaran tersimpan, namun terjadi kendala pada sistem pembayaran: ' . $e->getMessage(),
                'pendaftaran_id' => $pendaftaran->id,
            ], 500);
        }
    }


    /**
     * Tampilkan riwayat pendaftaran user
     */
    public function riwayat()
    {
        $pendaftarans = Pendaftaran::where('user_id', Auth::id())
            ->with('paket')
            ->latest()
            ->get();

        return view('riwayat-pendaftaran', compact('pendaftarans'));
    }

    /**
     * Download PDF bukti pendaftaran
     */
    public function downloadPdf($id)
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())
            ->with('paket')
            ->findOrFail($id);

        // Generate signature image URL for PDF
        $signatureBase64 = null;
        if ($pendaftaran->tanda_tangan_digital) {
            $signaturePath = storage_path('app/public/' . $pendaftaran->tanda_tangan_digital);
            if (file_exists($signaturePath)) {
                $signatureBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($signaturePath));
            }
        }

        $pdf = Pdf::loadView('pdf.bukti-pendaftaran', [
            'pendaftaran' => $pendaftaran,
            'signatureBase64' => $signatureBase64,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'Bukti_Pendaftaran_' . str_replace(' ', '_', $pendaftaran->nama_lengkap) . '_' . $pendaftaran->id . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Sinkronisasi manual status pembayaran dari Midtrans.
     * Mengecek SEMUA record Pembayaran (termasuk cicilan) yang belum lunas.
     * Penting untuk environment lokal di mana Webhook gagal.
     */
    public function checkPaymentStatus($id)
    {
        $pendaftaran = Pendaftaran::with('paket')->findOrFail($id);

        // Setup Midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => [],
        ];

        $updated = false;

        // 1. Cek semua record Pembayaran yang masih unpaid
        $unpaidPembayarans = $pendaftaran->pembayarans()->where('payment_status', 'unpaid')->get();

        foreach ($unpaidPembayarans as $pb) {
            if (!$pb->midtrans_order_id) continue;

            try {
                $status = \Midtrans\Transaction::status($pb->midtrans_order_id);
                $txStatus = $status->transaction_status ?? '';

                if (in_array($txStatus, ['capture', 'settlement'])) {
                    $pb->payment_status = 'paid';
                    $pb->save();
                    $updated = true;

                    // Update metode pembayaran di pendaftaran
                    $pendaftaran->metode_pembayaran = $status->payment_type ?? $pendaftaran->metode_pembayaran;
                    $pendaftaran->midtrans_transaction_id = $status->transaction_id ?? $pendaftaran->midtrans_transaction_id;

                } elseif (in_array($txStatus, ['deny', 'cancel'])) {
                    $pb->payment_status = 'failed';
                    $pb->save();
                } elseif ($txStatus === 'expire') {
                    $pb->payment_status = 'expired';
                    $pb->save();
                }
                // 'pending' → tetap unpaid, tidak perlu diubah
            } catch (\Exception $e) {
                Log::warning("Check status gagal untuk order {$pb->midtrans_order_id}: " . $e->getMessage());
            }
        }

        // 2. Hitung ulang total yang sudah dibayar
        $totalPaid = $pendaftaran->pembayarans()->where('payment_status', 'paid')->sum('amount');
        $hargaPaket = $pendaftaran->jumlah_bayar ?: ($pendaftaran->paket->harga ?? 0);

        // 3. Update status pendaftaran berdasarkan total pembayaran
        if ($totalPaid >= $hargaPaket && $hargaPaket > 0) {
            // Lunas
            if ($pendaftaran->payment_status !== 'paid') {
                $pendaftaran->payment_status = 'paid';
                $pendaftaran->status = 'pending'; // Siap review admin

                Notifikasi::create([
                    'user_id' => $pendaftaran->user_id,
                    'pendaftaran_id' => $pendaftaran->id,
                    'judul' => 'Pembayaran Lunas ✅',
                    'pesan' => 'Pembayaran untuk paket "' . ($pendaftaran->paket->nama ?? '') . '" telah lunas. Pendaftaran Anda sedang direview admin.',
                    'tipe' => 'success',
                ]);
            }
        } elseif ($totalPaid > 0) {
            // Belum lunas (cicilan parsial)
            $pendaftaran->payment_status = 'unpaid'; // enum tetap unpaid, tapi total_bayar > 0 → tampil "Belum Lunas"

            if ($updated) {
                Notifikasi::create([
                    'user_id' => $pendaftaran->user_id,
                    'pendaftaran_id' => $pendaftaran->id,
                    'judul' => 'Pembayaran Cicilan Berhasil ✅',
                    'pesan' => 'Pembayaran sebesar Rp ' . number_format($unpaidPembayarans->where('payment_status', 'paid')->sum('amount'), 0, ',', '.') . ' berhasil. Sisa tagihan: Rp ' . number_format($hargaPaket - $totalPaid, 0, ',', '.'),
                    'tipe' => 'success',
                ]);
            }
        }

        $pendaftaran->save();

        return response()->json(['success' => true, 'total_paid' => $totalPaid]);
    }

    /**
     * Ajukan refund untuk pendaftaran yang ditolak
     */
    public function requestRefund(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'catatan_refund' => 'required|string|min:10',
        ]);

        $pendaftaran = Pendaftaran::where('user_id', \Illuminate\Support\Facades\Auth::id())->findOrFail($id);

        if ($pendaftaran->status !== 'rejected') {
            return redirect()->back()->with('error', __('Refund hanya bisa diajukan untuk pendaftaran yang ditolak.'));
        }

        if ($pendaftaran->total_bayar <= 0) {
            return redirect()->back()->with('error', __('Tidak ada pembayaran yang bisa direfund.'));
        }

        $pendaftaran->update([
            'refund_status' => 'requested',
            'catatan_refund' => $request->catatan_refund,
        ]);

        return redirect()->back()->with('success', __('Permintaan refund berhasil diajukan.'));
    }
}

