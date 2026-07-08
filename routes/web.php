<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes — Desa Pelang Lor
|--------------------------------------------------------------------------
*/

// Landing Page (Profil Desa)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Sistem Surat Keterangan
Route::prefix('surat')->name('surat.')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('index');
    Route::post('/ajukan', [SuratController::class, 'store'])->name('store');
    Route::get('/preview/{id}', [SuratController::class, 'preview'])->name('preview');
    Route::get('/download/{id}', [SuratController::class, 'download'])->name('download');
    Route::get('/download-pdf/{id}', [SuratController::class, 'downloadPdf'])->name('download.pdf');
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
