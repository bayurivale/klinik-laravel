<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');

    Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');

    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

    Route::get('/password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware(['auth'])->group(function () {

        Route::middleware(['role:admin,pegawai'])->group(function () {
            Route::resource('obat', ObatController::class);
        });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('user', UserController::class);
        Route::resource('pegawai', PegawaiController::class);
    });

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

    Route::middleware(['role:pelanggan'])
        ->prefix('pelanggan')
        ->name('pelanggan.')
        ->group(function () {

            Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');

            Route::resource('/obat', PelangganController::class);

            Route::post('/obat/beli', [PelangganController::class, 'beli'])
                ->name('obat.beli');

            Route::get('/pembayaran', [PelangganController::class, 'pembayaranSaya'])
                ->name('pembayaran.index');
        });
});
