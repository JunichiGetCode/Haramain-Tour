<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class AdminPendaftaranController extends Controller
{
    /**
     * List semua pendaftaran
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'paket'])->latest();

        // Filter by status
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $pendaftarans = $query->paginate(15);

        $totalPending = Pendaftaran::where('status', 'pending')->count();
        $totalApproved = Pendaftaran::where('status', 'approved')->count();
        $totalRejected = Pendaftaran::where('status', 'rejected')->count();

        return view('admin.pendaftaran.index', compact(
            'pendaftarans', 'totalPending', 'totalApproved', 'totalRejected'
        ));
    }

    /**
     * Detail pendaftaran
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'paket'])->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Approve pendaftaran
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $catatan = $request->catatan_admin ?: 'Pendaftaran Anda telah disetujui oleh admin. Selamat mempersiapkan keberangkatan!';

        $pendaftaran->update([
            'status' => 'approved',
            'catatan_admin' => $catatan,
        ]);

        // Buat notifikasi success untuk user
        Notifikasi::create([
            'user_id' => $pendaftaran->user_id,
            'pendaftaran_id' => $pendaftaran->id,
            'judul' => 'Pendaftaran Disetujui! ✅',
            'pesan' => 'Selamat! Pendaftaran Anda untuk paket "' . $pendaftaran->paket->nama . '" telah disetujui. ' . $catatan,
            'tipe' => 'success',
        ]);

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran ' . $pendaftaran->nama_lengkap . ' berhasil disetujui.');
    }

    /**
     * Reject pendaftaran
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|min:10',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Buat notifikasi danger untuk user
        Notifikasi::create([
            'user_id' => $pendaftaran->user_id,
            'pendaftaran_id' => $pendaftaran->id,
            'judul' => 'Pendaftaran Ditolak ❌',
            'pesan' => 'Pendaftaran Anda untuk paket "' . $pendaftaran->paket->nama . '" ditolak. Alasan: ' . $request->catatan_admin . '. Anda dapat mendaftar ulang dengan melengkapi persyaratan.',
            'tipe' => 'danger',
        ]);

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran ' . $pendaftaran->nama_lengkap . ' telah ditolak.');
    }

    /**
     * Proses refund (mengubah status menjadi processed)
     */
    public function processRefund($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if ($pendaftaran->refund_status !== 'requested') {
            return redirect()->back()->with('error', 'Refund belum diajukan atau sudah diproses.');
        }

        $pendaftaran->update(['refund_status' => 'processed']);

        return redirect()->back()->with('success', 'Status refund berhasil diubah menjadi Sedang Diproses.');
    }

    /**
     * Selesaikan refund (mengubah status menjadi completed)
     */
    public function completeRefund($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if ($pendaftaran->refund_status !== 'processed') {
            return redirect()->back()->with('error', 'Refund harus diproses terlebih dahulu.');
        }

        $pendaftaran->update(['refund_status' => 'completed']);

        // Buat notifikasi untuk user
        Notifikasi::create([
            'user_id' => $pendaftaran->user_id,
            'pendaftaran_id' => $pendaftaran->id,
            'judul' => 'Refund Selesai 💰',
            'pesan' => 'Pengajuan refund Anda untuk paket "' . $pendaftaran->paket->nama . '" telah selesai diproses. Silakan cek rekening Anda.',
            'tipe' => 'info',
        ]);

        return redirect()->back()->with('success', 'Status refund berhasil diubah menjadi Selesai.');
    }
}

