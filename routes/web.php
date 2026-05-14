<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin Authentication Routes
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
