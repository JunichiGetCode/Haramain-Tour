<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email dan password cocok di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect admin ke admin dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard')->with('success', 'Login berhasil! Selamat datang, Admin.');
            }
            
            // Jika cocok, masuk ke dashboard
            return redirect()->intended('dashboard')->with('success', 'Login berhasil! Selamat datang.'); 
        }

        // Jika salah, kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

   // Memproses logout
    public function logout(Request $request)
    {
        // 1. Secara spesifik memutus autentikasi guard 'web'
        Auth::guard('web')->logout();
        
        // 2. Menghancurkan seluruh data sesi saat ini
        $request->session()->invalidate();
        
        // 3. Membuat token CSRF baru agar form lama tidak bisa dipakai lagi (Keamanan)
        $request->session()->regenerateToken();
        
        // 4. PERBAIKAN: Kembalikan ke halaman Landing Page (Home)
        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}