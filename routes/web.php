<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Manajemen pengguna (khusus admin)
    Route::middleware('role:admin')->resource(
        'users',
        UserController::class);

    // Data anggota
    Route::resource('anggota', AnggotaController::class);

    // Data simpanan
    Route::resource('simpanan', SimpananController::class);

    // Data pinjaman
    Route::resource('pinjaman', PinjamanController::class);

    // Data angsuran
    Route::resource('angsuran', AngsuranController::class);
});

require __DIR__.'/auth.php';
