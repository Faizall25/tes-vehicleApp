<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// 🔐 Protected Routes (hanya bisa diakses setelah login)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Contoh route hanya bisa diakses user yang login
    Route::get('/profile', function () {
        return response()->json([
            'user' => auth()->user()
        ]);
    });
});
