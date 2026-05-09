<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    // Memperbarui data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:500',
            'gender'     => 'nullable|in:Laki-laki,Perempuan',
            'birth_date' => 'nullable|date',
            'avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data profil
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->address    = $request->address;
        $user->gender     = $request->gender;
        $user->birth_date = $request->birth_date;

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // Memperbarui password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
    }
}
