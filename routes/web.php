<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;

/*
|--------------------------------------------------------------------------
| Web Routes — Desa Pelang Lor
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Berita Desa (Publik)
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Sistem Surat Keterangan (Tanpa Login Warga)
Route::prefix('surat')->name('surat.')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('index');
    Route::post('/ajukan', [SuratController::class, 'store'])->name('store');
    Route::get('/preview/{id}', [SuratController::class, 'preview'])->name('preview');
    Route::get('/edit/{id}', [SuratController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [SuratController::class, 'update'])->name('update');
    Route::get('/pdf/{id}', [SuratController::class, 'pdf'])->name('pdf');
    Route::get('/jpg/{id}', [SuratController::class, 'jpg'])->name('jpg');
    
    // Pencarian Riwayat berdasarkan NIK
    Route::get('/riwayat', [SuratController::class, 'riwayat'])->name('riwayat');
    Route::post('/riwayat', [SuratController::class, 'cariRiwayat'])->name('riwayat.cari');
});

// Panel Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Berita CRUD
        Route::prefix('berita')->name('berita.')->group(function () {
            Route::get('/',             [BeritaController::class, 'index'])->name('index');
            Route::get('/tambah',       [BeritaController::class, 'create'])->name('create');
            Route::post('/',            [BeritaController::class, 'store'])->name('store');
            Route::get('/{berita}/edit',[BeritaController::class, 'edit'])->name('edit');
            Route::put('/{berita}',     [BeritaController::class, 'update'])->name('update');
            Route::patch('/{berita}/toggle', [BeritaController::class, 'togglePublish'])->name('toggle');
            Route::delete('/{berita}',  [BeritaController::class, 'destroy'])->name('destroy');
        });
    });
});
