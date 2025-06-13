<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::view('/pendataan', 'pendataan')->name('pendataan');
    Route::view('/laporan', 'laporan')->name('laporan');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', BarangController::class);

    Route::get('/laporan-stok/export', function () {
        return Excel::download(new BarangExport, 'Laporan Barang.xlsx');
    })->name('laporan-stok.export');

    Route::get('laporan/peminjaman', [LaporanPeminjamanController::class, 'index'])->name('laporan.peminjaman.index');
    Route::get('laporan/peminjaman/export', [LaporanPeminjamanController::class, 'exportExcel'])->name('laporan.peminjaman.export');
    Route::get('/laporan/pengembalian', [LaporanPengembalianController::class, 'index'])->name('laporan.pengembalian.index');
    Route::get('/laporan/pengembalian/export', [LaporanPengembalianController::class, 'exportExcel'])->name('laporan.pengembalian.export');


    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('pengembalian', PengembalianController::class);
    Route::post('/pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
});
Route::get('/laporan-stok', [LaporanStokController::class, 'index'])->name('laporan-stok.index');
