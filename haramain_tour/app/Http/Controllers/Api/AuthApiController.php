<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    /**
     * Google Login untuk Mobile App
     * Endpoint: POST /api/auth/google
     *
     * Mobile app mengirim id_token yang didapat dari Google Sign-In SDK.
     * Server memverifikasi token lalu cek apakah user punya paket approved.
     */
    public function googleLogin(Request $request): JsonResponse
    {
        $request->validate([
            'id_token'  => 'required|string',
            'fcm_token' => 'nullable|string',
        ]);

        // Cek apakah Google login diaktifkan di settings
        $config = [];
        if (Storage::disk('local')->exists('mobile_app_config.json')) {
            $config = json_decode(Storage::disk('local')->get('mobile_app_config.json'), true) ?? [];
        }
        if (!($config['google_login_enabled'] ?? true)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Google tidak tersedia saat ini.',
            ], 403);
        }

        // Verify Google ID token via Google's tokeninfo endpoint
        try {
            $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
                'id_token' => $request->id_token,
            ]);

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token Google tidak valid.',
                ], 401);
            }

            $googleData = $response->json();

            // Verify the token is for our app
            $expectedClientId = config('services.google.client_id');
            if ($expectedClientId && ($googleData['aud'] ?? '') !== $expectedClientId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak valid untuk aplikasi ini.',
                ], 401);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memverifikasi token Google.',
            ], 500);
        }

        $googleEmail = $googleData['email'] ?? null;
        $googleId    = $googleData['sub'] ?? null;
        $googleName  = $googleData['name'] ?? $googleData['email'] ?? 'User';
        $googleAvatar = $googleData['picture'] ?? null;

        if (!$googleEmail) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan dari akun Google.',
            ], 400);
        }

        // Cari user berdasarkan google_id atau email
        $user = User::where('google_id', $googleId)->first();
        if (!$user) {
            $user = User::where('email', $googleEmail)->first();
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak terdaftar di Haramain Tour. Silakan daftar melalui website terlebih dahulu.',
            ], 404);
        }

        // Link Google ID jika belum
        if (!$user->google_id) {
            $user->update(['google_id' => $googleId]);
        }

        // Cek apakah wajib punya paket aktif
        $requirePackage = $config['require_active_package'] ?? true;
        $pendaftaran = Pendaftaran::with(['paket', 'rombongan'])
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->first();

        if ($requirePackage && !$pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda belum memiliki paket umroh yang aktif. Hanya jamaah yang telah mendaftar dan disetujui yang bisa mengakses aplikasi mobile.',
            ], 403);
        }

        // Generate kode booking jika belum ada
        if ($pendaftaran && !$pendaftaran->kode_booking) {
            $pendaftaran->update([
                'kode_booking' => 'HTR-' . date('Y') . '-' . str_pad($pendaftaran->id, 6, '0', STR_PAD_LEFT),
            ]);
        }

        // Update FCM token
        if ($request->fcm_token && $pendaftaran) {
            $pendaftaran->update(['fcm_token' => $request->fcm_token]);
        }

        // Hapus token lama, buat token baru
        $user->tokens()->delete();
        $token = $user->createToken('h-nav-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Google berhasil.',
            'token'   => $token,
            'user'    => $this->formatUserData($user, $pendaftaran),
        ]);
    }

    /**
     * Login untuk H-Nav App
     * Endpoint: POST /api/auth/login
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string|min:4',
            'fcm_token' => 'nullable|string',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        // Ambil pendaftaran terbaru (jika ada) - opsional, tidak wajib
        $pendaftaran = Pendaftaran::with(['paket', 'rombongan'])
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->first();

        // Generate kode booking jika pendaftaran ada tapi belum punya kode
        if ($pendaftaran && ! $pendaftaran->kode_booking) {
            $pendaftaran->update([
                'kode_booking' => 'HTR-' . date('Y') . '-' . str_pad($pendaftaran->id, 6, '0', STR_PAD_LEFT),
            ]);
        }

        // Update FCM token jika ada
        if ($request->fcm_token && $pendaftaran) {
            $pendaftaran->update(['fcm_token' => $request->fcm_token]);
        }

        // Hapus token lama, buat token baru
        $user->tokens()->delete();
        $token = $user->createToken('h-nav-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
            'token'   => $token,
            'user'    => $this->formatUserData($user, $pendaftaran),
        ]);
    }

    /**
     * Format user data for response
     */
    private function formatUserData(User $user, ?Pendaftaran $pendaftaran): array
    {
        return [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'role'      => $user->role,
            'phone'     => $user->phone,
            'avatar'    => $user->avatar ? asset('storage/' . $user->avatar) : null,
            'gender'    => $user->gender,
            'pendaftaran' => $pendaftaran ? [
                'id'               => $pendaftaran->id,
                'kode_booking'     => $pendaftaran->kode_booking,
                'nama_lengkap'     => $pendaftaran->nama_lengkap,
                'nik'              => $pendaftaran->nik,
                'nomor_paspor'     => $pendaftaran->nomor_paspor,
                'nomor_kamar'      => $pendaftaran->nomor_kamar,
                'no_hp'            => $pendaftaran->no_hp,
                'golongan_darah'   => $pendaftaran->golongan_darah,
                'status'           => $pendaftaran->status,
                'payment_status'   => $pendaftaran->payment_status,
                'paket'            => $pendaftaran->paket ? [
                    'id'                    => $pendaftaran->paket->id,
                    'nama'                  => $pendaftaran->paket->nama,
                    'kategori'              => $pendaftaran->paket->kategori,
                    'durasi_hari'           => $pendaftaran->paket->durasi_hari,
                    'tanggal_keberangkatan' => $pendaftaran->paket->tanggal_keberangkatan?->format('Y-m-d'),
                    'hotel_makkah'          => $pendaftaran->paket->hotel_makkah,
                    'hotel_madinah'         => $pendaftaran->paket->hotel_madinah,
                ] : null,
                'rombongan' => $pendaftaran->rombongan ? [
                    'id'               => $pendaftaran->rombongan->id,
                    'nama'             => $pendaftaran->rombongan->nama,
                    'kode'             => $pendaftaran->rombongan->kode,
                    'safe_zone_lat'    => (float) $pendaftaran->rombongan->safe_zone_lat,
                    'safe_zone_lng'    => (float) $pendaftaran->rombongan->safe_zone_lng,
                    'safe_zone_radius' => $pendaftaran->rombongan->safe_zone_radius,
                ] : null,
            ] : null,
        ];
    }


    /**
     * Logout dari H-Nav App
     * Endpoint: POST /api/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.',
        ]);
    }

    /**
     * Cek token masih valid atau tidak
     * Endpoint: GET /api/auth/me
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user()->load([]);

        return response()->json([
            'success' => true,
            'user'    => $user,
        ]);
    }
}
