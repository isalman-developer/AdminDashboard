<?php

use Illuminate\Support\Facades\Route;

Route::view('/test', 'admin.welcome');
Route::view('/admin/login', 'admin.auth.login');
Route::view('/', 'admin.welcome');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
