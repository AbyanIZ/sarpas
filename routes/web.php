<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
// Auth
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/pendataan', function () {
    return view('pendataan');
})->name('pendataan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

//Pengguna
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');

//kategori Barang
Route::resource('kategori', KategoriBarangController::class);

Route::resource('barang', BarangController::class);

Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

Route::middleware('auth')->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::delete('/peminjaman/{id}/delete', [PeminjamanController::class, 'deleteHistory'])->name('peminjaman.deleteHistory');
});
