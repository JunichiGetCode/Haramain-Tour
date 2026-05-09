<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan halaman form daftar
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Memproses data pendaftaran
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan Data Akun ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk menggunakan akun Anda.');
    }
}