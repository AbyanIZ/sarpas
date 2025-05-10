<?php

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPeminjamanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'apiLogout']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', ApiUserController::class);

    Route::apiResource('barangs', ApiBarangController::class);

    Route::post('/peminjaman', [APiPeminjamanController::class, 'store']); // Untuk mengajukan peminjaman
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index']); // Untuk melihat semua peminjaman
    Route::post('/peminjaman/{id}/approve', [ApiPeminjamanController::class, 'approve']); // Untuk approve peminjaman
    Route::post('/peminjaman/{id}/reject', [ApiPeminjamanController::class, 'reject']); // Untuk reject peminjaman
});
