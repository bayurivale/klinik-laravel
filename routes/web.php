<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('user', UserController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('obat', ObatController::class);
});

// PEGAWAI
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/pegawai', [DashboardController::class, 'index'])
        ->name('pegawai.dashboard');
});

// PELANGGAN
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/pelanggan', [DashboardController::class, 'pelanggan'])
        ->name('pelanggan.dashboard');
});