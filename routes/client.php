<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SiteSettingController;

/*
|--------------------------------------------------------------------------
| Client / Front-end Web Routes
|--------------------------------------------------------------------------
|
| Front-end routes are loaded separately to clearly separate client-side
| routes from admin routes. These routes make no auth assumptions.
|
*/

Route::namespace('App\Http\Controllers\Client')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');

    Route::resource('products', ProductController::class)->only(['index', 'show']);

});
