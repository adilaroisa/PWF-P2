<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\KategoriApiController;

// Route untuk mendapatkan token
Route::post('/login', [AuthController::class, 'getToken']);

// Route yang membutuhkan Autentikasi API Token
Route::middleware('auth:sanctum')->group(function () {
    
    // API Product
    Route::apiResource('product', ProductApiController::class);

    // API Kategori
    Route::apiResource('kategori', KategoriApiController::class);

    // Endpoint untuk mengambil data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});