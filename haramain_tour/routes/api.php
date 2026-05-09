<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\MobileContentController;

/*
|--------------------------------------------------------------------------
| HaramainQu API Routes
|--------------------------------------------------------------------------
| Semua route di sini bisa diakses melalui prefix /api/
| Contoh: http://127.0.0.1:8000/api/auth/login
*/

// ── Public routes (tanpa auth) ────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/google', [AuthApiController::class, 'googleLogin']);
});

// Content API (public) — primary routes
Route::prefix('content')->group(function () {
    Route::get('/panduan', [MobileContentController::class, 'panduan']);
    Route::get('/kamus', [MobileContentController::class, 'kamus']);
    Route::get('/doa', [MobileContentController::class, 'doa']);
    Route::get('/berita', [MobileContentController::class, 'berita']);
    Route::get('/sync', [MobileContentController::class, 'sync']);
    Route::get('/settings', [MobileContentController::class, 'settings']);
});

// Alias routes — match Flutter app paths
Route::get('/doa', [MobileContentController::class, 'doa']);
Route::get('/kamus', [MobileContentController::class, 'kamus']);
Route::get('/ibadah/panduan', [MobileContentController::class, 'panduan']);
Route::get('/ibadah/panduan/{id}', [MobileContentController::class, 'panduanDetail']);


// ── Protected routes (perlu Sanctum token) ────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthApiController::class, 'logout']);
        Route::get('/me',      [AuthApiController::class, 'me']);
    });

    // Profile jamaah (data diri + pendaftaran + paket)
    Route::get('/profile', function (Request $request) {
        $user = $request->user();
        $pendaftaran = $user->pendaftarans()
            ->with(['paket', 'rombongan'])
            ->where('status', 'approved')
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'user' => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'phone'      => $user->phone,
                'address'    => $user->address,
                'gender'     => $user->gender,
                'birth_date' => $user->birth_date,
                'avatar'     => $user->avatar ? asset('storage/' . $user->avatar) : null,
            ],
            'pendaftaran' => $pendaftaran,
        ]);
    });

    // ── Admin only routes ────────────────────────────────────────────────────
    Route::middleware('ensure.admin')->prefix('admin')->group(function () {

        // Dashboard stats
        Route::get('/stats', function (Request $request) {
            $totalJamaah  = \App\Models\Pendaftaran::where('status', 'approved')->count();
            $totalPending = \App\Models\Pendaftaran::where('status', 'pending')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total_jamaah'  => $totalJamaah,
                    'total_pending' => $totalPending,
                ],
            ]);
        });

        // Rombongan list
        Route::get('/rombongan', function () {
            $rombongan = \App\Models\Rombongan::with('ketua')
                ->withCount(['pendaftarans as total_jamaah' => function ($q) {
                    $q->where('status', 'approved');
                }])
                ->get();
            return response()->json(['success' => true, 'data' => $rombongan]);
        });
    });
});
