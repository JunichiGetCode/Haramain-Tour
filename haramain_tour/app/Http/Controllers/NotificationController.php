<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Tampilkan semua notifikasi user
     */
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
            ->with('pendaftaran.paket')
            ->latest()
            ->get();

        return view('notifikasi', compact('notifikasis'));
    }

    /**
     * Tandai notifikasi sudah dibaca
     */
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Tandai semua notifikasi sudah dibaca
     */
    public function markAllRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return redirect()->back()->with('success', __('Semua notifikasi ditandai sudah dibaca.'));
    }

    /**
     * API: Jumlah notifikasi belum dibaca  
     */
    public function unreadCount()
    {
        $count = Notifikasi::where('user_id', Auth::id())
            ->where('dibaca', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * API: Detail pendaftaran dari notifikasi (untuk modal)
     */
    public function showDetail($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->with('pendaftaran.paket')
            ->findOrFail($id);

        if (!$notifikasi->pendaftaran) {
            return response()->json(['success' => false, 'message' => __('Data pendaftaran tidak ditemukan.')]);
        }

        $p = $notifikasi->pendaftaran;

        // Build signature URL
        $signatureUrl = null;
        if ($p->tanda_tangan_digital) {
            $signatureUrl = asset('storage/' . $p->tanda_tangan_digital);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $p->id,
                'nama_lengkap' => $p->nama_lengkap,
                'nik' => $p->nik,
                'tempat_lahir' => $p->tempat_lahir,
                'tanggal_lahir' => $p->tanggal_lahir ? $p->tanggal_lahir->format('d F Y') : '-',
                'jenis_kelamin' => $p->jenis_kelamin === 'L' ? __('Laki-laki') : __('Perempuan'),
                'no_hp' => $p->no_hp,
                'alamat_lengkap' => $p->alamat_lengkap,
                'nama_mahram' => $p->nama_mahram ?? '-',
                'golongan_darah' => $p->golongan_darah,
                'riwayat_penyakit' => $p->riwayat_penyakit ?? '-',
                'paket_nama' => $p->paket->nama ?? '-',
                'paket_harga' => $p->jumlah_bayar_rupiah,
                'paket_durasi' => ($p->paket->durasi_hari ?? '-') . ' ' . __('Hari'),
                'paket_tanggal' => $p->paket && $p->paket->tanggal_keberangkatan ? $p->paket->tanggal_keberangkatan->format('d F Y') : '-',
                'hotel_makkah' => $p->paket->hotel_makkah ?? '-',
                'hotel_madinah' => $p->paket->hotel_madinah ?? '-',
                'status' => $p->status,
                'status_label' => $p->status_label,
                'payment_status' => ($p->payment_status === 'unpaid' && $p->total_bayar > 0) ? 'partial' : $p->payment_status,
                'payment_status_label' => $p->payment_status_label,
                'metode_pembayaran' => $p->metode_pembayaran_label,

                'catatan_admin' => $p->catatan_admin ?? '-',
                'tanda_tangan_url' => $signatureUrl,
                'created_at' => $p->created_at->format('d F Y, H:i'),
                'can_download_pdf' => $p->status === 'approved',
                'pdf_url' => $p->status === 'approved' ? route('pendaftaran.pdf', $p->id) : null,
            ],
        ]);
    }
}
