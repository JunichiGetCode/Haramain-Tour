<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // Default settings
    private function getDefaults()
    {
        return [
            'notif_promo'         => true,
            'notif_update_paket'  => true,
            'notif_keberangkatan' => true,
            'bahasa'              => 'id',
            'dark_mode'           => false,
            'show_email'          => true,
            'show_phone'          => false,
        ];
    }

    // Menampilkan halaman pengaturan
    public function show()
    {
        $user = Auth::user();
        $settings = array_merge($this->getDefaults(), $user->settings ?? []);

        return view('settings', [
            'user' => $user,
            'settings' => $settings,
        ]);
    }

    // Menyimpan pengaturan
    public function update(Request $request)
    {
        $user = Auth::user();

        $settings = [
            'notif_promo'         => $request->boolean('notif_promo'),
            'notif_update_paket'  => $request->boolean('notif_update_paket'),
            'notif_keberangkatan' => $request->boolean('notif_keberangkatan'),
            'bahasa'              => $request->input('bahasa', 'id'),
            'dark_mode'           => $request->boolean('dark_mode'),
            'show_email'          => $request->boolean('show_email'),
            'show_phone'          => $request->boolean('show_phone'),
        ];

        $user->settings = $settings;
        $user->save();

        // Ensure session locale is also updated so ApplyUserSettings prioritizes the new language
        session(['locale' => $settings['bahasa']]);

        $redirectParams = [];
        if ($request->has('from')) {
            $redirectParams['from'] = $request->input('from');
        }

        return redirect()->route('settings', $redirectParams)->with('success', 'Pengaturan berhasil disimpan!');
    }

    // Hapus akun
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai. Akun tidak dihapus.']);
        }

        // Logout dulu
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus user
        $user->delete();

        return redirect('/')->with('success', 'Akun Anda telah berhasil dihapus.');
    }
}
