<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;

/*
|--------------------------------------------------------------------------
| Web Routes — Desa Pelang Lor
|--------------------------------------------------------------------------
*/

// Rute yang membutuhkan login warga
Route::middleware('auth:warga')->group(function () {
    // Landing Page (Profil Desa / Dasbor Warga)
    Route::get('/', [LandingController::class, 'index'])->name('landing');

    // Sistem Surat Keterangan
    Route::prefix('surat')->name('surat.')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('index');
        Route::post('/ajukan', [SuratController::class, 'store'])->name('store');
        Route::get('/preview/{id}', [SuratController::class, 'preview'])->name('preview');
        Route::get('/edit/{id}', [SuratController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SuratController::class, 'update'])->name('update');
        Route::get('/download/{id}', [SuratController::class, 'download'])->name('download');
        Route::get('/download-pdf/{id}', [SuratController::class, 'downloadPdf'])->name('download.pdf');
    });
});

// Autentikasi Warga
Route::prefix('warga')->name('warga.')->group(function () {
    Route::get('/register',  [WargaController::class, 'registerForm'])->name('register');
    Route::post('/register', [WargaController::class, 'register'])->name('register.post');
    Route::get('/login',     [WargaController::class, 'loginForm'])->name('login');
    Route::post('/login',    [WargaController::class, 'login'])->name('login.post');
    Route::post('/logout',   [WargaController::class, 'logout'])->name('logout');
});

// Panel Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/surat', [AdminController::class, 'suratList'])->name('surat.list');
        Route::get('/surat/pending', [AdminController::class, 'suratPending'])->name('surat.pending');
        Route::post('/surat/{id}/approve', [AdminController::class, 'approve'])->name('surat.approve');
        Route::post('/surat/{id}/tolak', [AdminController::class, 'tolak'])->name('surat.tolak');
    });
});
