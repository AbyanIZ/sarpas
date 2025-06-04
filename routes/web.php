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
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root sesuai status login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Routes untuk autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk registrasi user biasa (non admin)
Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

// Route dashboard, hanya untuk user login
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Group route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {

    // Halaman statis pendataan dan laporan
    Route::view('/pendataan', 'pendataan')->name('pendataan');
    Route::view('/laporan', 'laporan')->name('laporan');

    // Pengguna dan master data
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', BarangController::class);

    // Export Excel laporan stok barang
    Route::get('/laporan-stok/export', function () {
        return Excel::download(new BarangExport, 'Laporan Barang.xlsx');
    })->name('laporan-stok.export');

    // Laporan peminjaman barang
    Route::get('laporan/peminjaman', [LaporanPeminjamanController::class, 'index'])->name('laporan.peminjaman.index');
    Route::get('laporan/peminjaman/export', [LaporanPeminjamanController::class, 'exportExcel'])->name('laporan.peminjaman.export');

    // Peminjaman barang CRUD
    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    // Delete peminjaman (riwayat)
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
});

// Group route admin prefix dan autentikasi untuk pengembalian barang
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('pengembalian', PengembalianController::class);
    Route::post('/pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
});

// Laporan stok barang (halaman)
Route::get('/laporan-stok', [LaporanStokController::class, 'index'])->name('laporan-stok.index');
