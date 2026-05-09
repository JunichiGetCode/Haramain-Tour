<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    /**
     * Tampilkan halaman admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $recentUsers = User::where('role', 'user')->latest()->take(10)->get();
        $allUsers = User::all();
        $totalPendaftaran = Pendaftaran::count();
        $pendaftaranPending = Pendaftaran::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'recentUsers', 'allUsers', 'totalPendaftaran', 'pendaftaranPending'));
    }

    /**
     * Tampilkan halaman manajemen pengguna
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Update role pengguna
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        // Jangan biarkan admin mengubah role dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$request->role}.");
    }

    /**
     * Hapus pengguna
     */
    public function deleteUser(User $user)
    {
        // Jangan biarkan admin menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "Pengguna {$name} berhasil dihapus.");
    }

    /**
     * Laporan Keuangan
     */
    public function laporanKeuangan(Request $request)
    {
        $query = \App\Models\Pembayaran::with(['pendaftaran.user', 'pendaftaran.paket'])->where('payment_status', 'paid');

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pembayarans = $query->latest()->get();
        $totalPendapatan = $pembayarans->sum('amount');

        return view('admin.laporan', compact('pembayarans', 'totalPendapatan'));
    }

    /**
     * Export Laporan Keuangan ke PDF
     */
    public function exportLaporanPdf(Request $request)
    {
        $query = \App\Models\Pembayaran::with(['pendaftaran.user', 'pendaftaran.paket'])->where('payment_status', 'paid');

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pembayarans = $query->latest()->get();
        $totalPendapatan = $pembayarans->sum('amount');

        $pdf = Pdf::loadView('pdf.laporan-keuangan', compact('pembayarans', 'totalPendapatan'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan_Keuangan_Haramain_Tour.pdf');
    }
}
