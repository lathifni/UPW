<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Public\ProgramController as PublicProgramController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\ManagementController as PublicManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\AdminReportController;


// Rute Publik
Route::get('/', [PublicProgramController::class, 'home'])->name('home');
Route::get('/programs', [PublicProgramController::class, 'index'])->name('programs.index.public');
Route::get('/programs/{program}', [PublicProgramController::class, 'show'])->name('programs.show.public');
// Route::post('/donations', [DonationController::class, 'store'])->name('donations.store')->middleware('verified.custom');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::get('/berita', [PublicArticleController::class, 'index'])->name('articles.index.public');
Route::get('/berita/{article:slug}', [PublicArticleController::class, 'show'])->name('articles.show.public');
Route::get('/sejarah', function () {return view('public.sejarah');})->name('sejarah.public');
Route::get('/legalitas', function () {return view('public.legalitas');})->name('legalitas.public');
Route::get('/kepengurusan', [PublicManagementController::class, 'index'])->name('pengurus.public');
Route::get('/email/verify', function () {return view('auth.verify');})->name('verification.notice');
Route::get('/laporan', function () {return view('public.laporan');})->name('laporan.public');
Route::get('/edukasi-wakaf', function () {return view('public.edukasi-wakaf');})->name('edukasi-wakaf.public');
Route::get('/wakaf-uang', [PublicProgramController::class, 'showWakafUang'])->name('public.wakaf-uang');
Route::get('/payment-instruction/{order_id}', [DonationController::class, 'instruction'])->name('donations.instruction');
Route::get('/cek-wakaf', [DonationController::class, 'checkStatusIndex'])->name('donations.check');
// Proses Pencarian Data (saat tombol diklik)
Route::post('/cek-wakaf', [DonationController::class, 'checkStatusProcess'])->name('donations.check.process');
Route::get('/laporan', function() {
    $reports = \App\Models\Report::where('is_active', true)->orderBy('year', 'desc')->get();
    return view('public.laporan', compact('reports'));})->name('laporan.public');

// --- RUTE UNTUK LUPA PASSWORD ---
Route::get('/lupa-password', [ForgotPasswordController::class, 'showPhoneRequestForm'])->name('password.phone.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.phone.send');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Rute Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/email/skip-verification', [AuthController::class, 'skipVerification'])->name('verification.skip');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function() {return view('admin.dashboard');})->name('admin.dashboard');
    Route::resource('/programs', ProgramController::class);
    Route::resource('/articles', ArticleController::class);
    Route::resource('/managements',ManagementController::class);
    Route::get('/donations', [AdminDonationController::class, 'index'])->name('admin.donations.index');
    Route::get('/donations/{donation}', [AdminDonationController::class, 'show'])->name('admin.donations.show');
    Route::post('/donations/{donation}/status', [AdminDonationController::class, 'updateStatus'])->name('admin.donations.status.update');
    Route::get('/donations-cash/create', [AdminDonationController::class, 'createManual'])->name('admin.donations.cash.create');
    Route::post('/donations-cash/store', [AdminDonationController::class, 'storeManual'])->name('admin.donations.cash.store');
    Route::resource('users', AdminUserController::class);
    Route::resource('reports', AdminReportController::class)->only(['index', 'store', 'destroy']);
});

// Rute untuk Donatur yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/donasi-saya', [DashboardController::class, 'donations'])->name('dashboard.donations');
    Route::get('/dashboard/transaksi', [DashboardController::class, 'transactions'])->name('dashboard.transactions');
    Route::get('/dashboard/sertifikat', [DashboardController::class, 'certificates'])->name('dashboard.certificates');
    Route::get('/dashboard/profil', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::put('/dashboard/profil', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::post('/dashboard/profil/foto', [DashboardController::class, 'updatePhoto'])->name('dashboard.profile.photo.update');
    Route::put('/dashboard/profil/password', [DashboardController::class, 'updatePassword'])->name('dashboard.profile.updatePassword');
});

// Rute untuk menampilkan halaman verifikasi
Route::get('/email/verify', function () {
    if (!session('email')) {
        return redirect()->route('login');
    }
    $user = \App\Models\User::where('email', session('email'))->first();

    // Pastikan user dan waktu kedaluwarsa ada sebelum dikirim
    $expiresAt = $user ? $user->verification_code_expires_at : null;

    return view('auth.verify', [
        // Kirim dalam format ISO 8601 String yang pasti dikenali JavaScript
        'expires_at' => $expiresAt ? $expiresAt->toIso8601String() : null,
    ]);
})->name('verification.notice');

// Rute untuk MEMPROSES kode verifikasi
Route::post('/email/verify', [AuthController::class, 'verify'])->name('verification.verify');

// Rute untuk MENGIRIM ULANG kode verifikasi
Route::post('/email/resend', [AuthController::class, 'resend'])->name('verification.resend');

// Rute untuk generate sertifikat
Route::get('donations/{donation}/generate-certificate', [CertificateController::class, 'generate'])
     ->name('admin.donations.generate_certificate');


