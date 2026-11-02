
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Koperasi
Route::get('/dashboard', function () {

    return view('dashboard', [

        // Statistik
        'totalAnggota' => Anggota::count(),
        'totalSimpanan' => Simpanan::count(),
        'totalPinjaman' => Pinjaman::count(),
        'totalAngsuran' => Angsuran::count(),

        // Daftar nama anggota
        'daftarAnggota' => Anggota::latest()->get(),

    ]);

})->middleware(['auth', 'verified'])->name('dashboard');


// Route pengguna yang sudah login
Route::middleware(['auth'])->group(function () {

    // Manajemen User khusus Admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Data Anggota
    Route::resource('anggota', AnggotaController::class);

    // Data Simpanan
    Route::resource('simpanan', SimpananController::class);

    // Data Pinjaman
    Route::resource('pinjaman', PinjamanController::class);

    // Persetujuan Pinjaman
    Route::post('/pinjaman/{id}/setujui', [PinjamanController::class, 'setujui'])
        ->name('pinjaman.setujui');

    // Penolakan Pinjaman
    Route::post('/pinjaman/{id}/tolak', [PinjamanController::class, 'tolak'])
        ->name('pinjaman.tolak');

    // Pencairan Pinjaman
    Route::post('/pinjaman/{id}/cairkan', [PinjamanController::class, 'cairkan'])
        ->name('pinjaman.cairkan');

    // Pelunasan Pinjaman
    Route::post('/pinjaman/{id}/lunasi', [PinjamanController::class, 'lunasi'])
        ->name('pinjaman.lunasi');

    // Data Angsuran
    Route::resource('angsuran', AngsuranController::class);

});

// Autentikasi
require __DIR__.'/auth.php';
