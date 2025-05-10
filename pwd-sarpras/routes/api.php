<?php

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPeminjamanController;
// API Login
Route::post('/login', [App\Http\Controllers\AuthController::class, 'apiLogin']);

// API Logout (harus pakai auth:sanctum middleware)
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\AuthController::class, 'apiLogout']);

// Proteksi pakai Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Info user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // API User CRUD
    Route::apiResource('users', ApiUserController::class);

    // API Barang CRUD
    Route::apiResource('barangs', ApiBarangController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'apiLogout']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index']);
    Route::get('/peminjaman/{id}', [ApiPeminjamanController::class, 'show']);
    Route::post('/peminjaman/{id}/approve', [ApiPeminjamanController::class, 'approve']);
    Route::post('/peminjaman/{id}/reject', [ApiPeminjamanController::class, 'reject']);
});
