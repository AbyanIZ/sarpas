<?php

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPeminjamanController;
use App\Http\Controllers\ApiPengembalianController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



    Route::apiResource('barangs', ApiBarangController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pengembalian', [ApiPengembalianController::class, 'store']);
});
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'apiLogout']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('users', ApiUserController::class);
    Route::post('/peminjaman', [ApiPeminjamanController::class, 'store']);
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index']);
    Route::post('/peminjaman/{id}/approve', [ApiPeminjamanController::class, 'approve']);
    Route::post('/peminjaman/{id}/reject', [ApiPeminjamanController::class, 'reject']);
});

Route::middleware('auth:sanctum')->group(function () {
    // ... rute lainnya

    // Rute Pengembalian
    Route::post('/pengembalian/{peminjaman_id}', [ApiPengembalianController::class, 'store']); // Menggunakan ID peminjaman di URL
    Route::get('/pengembalian', [ApiPengembalianController::class, 'index']); // Untuk melihat daftar pengembalian
    Route::post('/pengembalian/{id}/approve', [ApiPengembalianController::class, 'approve']); // Approve pengembalian
    Route::post('/pengembalian/{id}/reject', [ApiPengembalianController::class, 'reject']); // Reject pengembalian

    // Opsional - jika butuh rute khusus
    Route::get('/pengembalian/user', [ApiPengembalianController::class, 'userReturns']); // Pengembalian oleh user tertentu
});
