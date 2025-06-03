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

// Tambahan untuk export Excel
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

// Route untuk autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard (hanya untuk user yang terautentikasi)
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk halaman pendataan dan laporan
Route::middleware('auth')->group(function () {
    Route::get('/pendataan', function () {
        return view('pendataan');
    })->name('pendataan');
    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('/laporan', function () {
        return view('laporan');
    })->name('laporan');
});

// Route untuk pengguna dan kategori barang (hanya untuk user yang terautentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', BarangController::class);

    // ✅ Route Export Excel Barang
    Route::get('/laporan-stok/export', function () {
        return Excel::download(new BarangExport, 'Laporan Barang.xlsx');
    })->name('laporan-stok.export')->middleware('auth');
});

// Route untuk register user baru
Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

// Route untuk peminjaman (hanya untuk user yang terautentikasi)
Route::middleware('auth')->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::delete('/peminjaman/{id}/delete', [PeminjamanController::class, 'deleteHistory'])->name('peminjaman.deleteHistory');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::post('/pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
});

Route::get('/laporan-stok', [LaporanStokController::class, 'index'])->name('laporan-stok.index');
