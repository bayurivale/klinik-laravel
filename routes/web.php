<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin,pegawai'])->group(function () {
        Route::resource('obat', ObatController::class);
    });

    // ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('user', UserController::class);
        Route::resource('pegawai', PegawaiController::class);
    });

    // PEGAWAI
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/pegawai', [DashboardController::class, 'index'])
            ->name('pegawai.dashboard');
        
        Route::get('/verifikasi/transaksi', [PegawaiController::class, 'index'])
            ->name('transaksi.menunggu');

        Route::get('/verifikasi/transaksi/{id}', [PegawaiController::class, 'showVerifikasi'])
            ->name('transaksi.verifikasi');

        Route::post('/verifikasi/transaksi/{id}', [PegawaiController::class, 'updateVerifikasi'])
            ->name('transaksi.verifikasi.update');
    });

    // PELANGGAN
    Route::middleware(['role:pelanggan'])
        ->prefix('pelanggan')
        ->name('pelanggan.')
        ->group(function () {

        Route::get('/dashboard', [PelangganController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('/obat', PelangganController::class);
        Route::post('/obat/beli', [PelangganController::class, 'beli'])
            ->name('obat.beli');
        Route::get('/pembayaran', [PelangganController::class, 'pembayaranSaya'])
            ->name('pembayaran.index');
    });

    
    // REGISTER FORM
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');

// REGISTER PROSES
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');


});
