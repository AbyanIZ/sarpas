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
Route::middleware('auth:sanctum')->delete('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logout berhasil'
    ]);
});
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

    Route::post('/pengembalian/{peminjaman_id}', [ApiPengembalianController::class, 'store']);
    Route::get('/pengembalian', [ApiPengembalianController::class, 'index']);
    Route::get('/pengembalian/{id}', [ApiPengembalianController::class, 'show']);
    Route::post('/pengembalian/{id}/approve', [ApiPengembalianController::class, 'approve']);
    Route::post('/pengembalian/{id}/reject', [ApiPengembalianController::class, 'reject']);

    Route::get('/pengembalian/user', [ApiPengembalianController::class, 'userReturns']);
});
