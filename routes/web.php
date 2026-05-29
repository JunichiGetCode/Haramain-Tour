<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Language Switcher (accessible by both guest & auth)
Route::get('/lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['id', 'en'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    
    // If user is logged in, also save to their settings
    if (Auth::check()) {
        $user = Auth::user();
        $settings = $user->settings ?? [];
        $settings['bahasa'] = $locale;
        $user->settings = $settings;
        $user->save();
    }
    
    return redirect()->back();
})->name('lang.switch');

// Rute untuk reset session jika nyangkut
Route::get('/force-logout', function () {
    Auth::logout();
    session()->invalidate();
    return redirect('/login');
});

// Route /panduan temporarily removed from here

// Chatbot Route (Terbuka untuk semua, bisa diakses dari Landing Page maupun Dashboard)
Route::post('/chatbot/message', [ChatBotController::class, 'message'])->name('chatbot.message');

// Berita & Info
Route::get('/berita', [\App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

// Midtrans Webhook Callback (tidak perlu auth, dipanggil oleh server Midtrans)
Route::post('/midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');

// Middleware Guest (Hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // Google Login Routes
    Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('google.login');
    Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])->name('google.callback');
});

// Middleware Auth (Hanya untuk yang sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Halaman Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    // Halaman Panduan Ibadah
    Route::get('/panduan', function () {
        return view('panduan');
    })->name('panduan');

    // Halaman Doa-Doa Penting
    Route::get('/doa', function () {
        return view('doa');
    })->name('doa');

    // Halaman Kamus Bahasa Arab
    Route::get('/kamus', function () {
        return view('kamus');
    })->name('kamus');

    // Halaman Bantuan & FAQ
    Route::get('/faq', function () {
        return view('faq');
    })->name('faq');

    // Pencarian Global
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/search/ajax', [SearchController::class, 'ajax'])->name('search.ajax');

    // Halaman Daftar Paket menggunakan Controller
    Route::get('/paket', [PaketController::class, 'index'])->name('paket');

    // Halaman Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Halaman Pengaturan
    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])->name('settings.delete-account');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Pendaftaran Paket
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/riwayat', [PendaftaranController::class, 'riwayat'])->name('pendaftaran.riwayat');
    Route::get('/pendaftaran/{id}/pdf', [PendaftaranController::class, 'downloadPdf'])->name('pendaftaran.pdf');
    Route::post('/pendaftaran/{id}/check-payment', [PendaftaranController::class, 'checkPaymentStatus'])->name('pendaftaran.check-payment');
    Route::post('/pendaftaran/{id}/installment', [MidtransController::class, 'createInstallment'])->name('pendaftaran.installment');
    Route::post('/pendaftaran/{id}/refund', [PendaftaranController::class, 'requestRefund'])->name('pendaftaran.refund');



    // Notifikasi
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotificationController::class, 'markAllRead'])->name('notifikasi.read-all');
    Route::get('/notifikasi/unread-count', [NotificationController::class, 'unreadCount'])->name('notifikasi.unread-count');
    Route::get('/notifikasi/{id}/detail', [NotificationController::class, 'showDetail'])->name('notifikasi.detail');
});

// ============================================================
// ADMIN ROUTES - Hanya bisa diakses oleh user dengan role admin
// ============================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::put('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Laporan Keuangan
    Route::get('/laporan', [AdminController::class, 'laporanKeuangan'])->name('laporan');
    Route::get('/laporan/pdf', [AdminController::class, 'exportLaporanPdf'])->name('laporan.pdf');

    // Manajemen Paket
    Route::resource('pakets', App\Http\Controllers\AdminPaketController::class);

    // Manajemen Berita
    Route::resource('berita', App\Http\Controllers\AdminBeritaController::class)->parameters([
        'berita' => 'berita'
    ]);

    // Manajemen Pendaftaran
    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::post('/pendaftaran/{id}/approve', [AdminPendaftaranController::class, 'approve'])->name('pendaftaran.approve');
    Route::post('/pendaftaran/{id}/reject', [AdminPendaftaranController::class, 'reject'])->name('pendaftaran.reject');
    Route::post('/pendaftaran/{id}/process-refund', [AdminPendaftaranController::class, 'processRefund'])->name('pendaftaran.process-refund');
    Route::post('/pendaftaran/{id}/complete-refund', [AdminPendaftaranController::class, 'completeRefund'])->name('pendaftaran.complete-refund');
    Route::post('/pendaftaran/{id}/notify', [AdminPendaftaranController::class, 'sendNotification'])->name('pendaftaran.notify');


    // Pengaturan Mobile App
    Route::get('/mobile-app', [\App\Http\Controllers\AdminMobileAppController::class, 'index'])->name('mobile_app.index');
    Route::post('/mobile-app', [\App\Http\Controllers\AdminMobileAppController::class, 'store'])->name('mobile_app.store');

    // Manajemen Konten Mobile
    Route::resource('doa', \App\Http\Controllers\AdminDoaController::class);
    Route::resource('kamus', \App\Http\Controllers\AdminKamusController::class);
    Route::resource('panduan', \App\Http\Controllers\AdminPanduanController::class)->only(['index', 'edit', 'update']);
});