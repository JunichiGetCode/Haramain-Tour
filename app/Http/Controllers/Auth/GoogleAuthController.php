<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect user to Google for authentication.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah terdaftar menggunakan google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                // Cek apakah user sudah terdaftar melalui email biasa
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Tautkan akun Google ke user yang sudah ada
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                        'avatar'    => $existingUser->avatar ?? $googleUser->avatar,
                    ]);

                    Auth::login($existingUser);
                    return redirect()->intended('/dashboard');
                } else {
                    // Buat user baru (Password di-generate acak karena login eksklusif via Google)
                    $newUser = User::create([
                        'name'      => $googleUser->name,
                        'email'     => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'avatar'    => $googleUser->avatar,
                        'password'  => Hash::make(Str::random(24)),
                        'role'      => 'user', // Default role
                    ]);

                    Auth::login($newUser);
                    return redirect()->intended('/dashboard');
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google Login Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['email' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }
    }
}
