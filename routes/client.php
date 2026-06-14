<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SiteSettingController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\OrderController;

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
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

    Route::resource('products', ProductController::class)->only(['index', 'show']);

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Orders
    Route::get('/order/thankyou/{orderNumber}', [OrderController::class, 'thankyou'])->name('order.thankyou');
    Route::get('/order/track', [OrderController::class, 'track'])->name('order.track');
    Route::post('/order/track', [OrderController::class, 'trackOrder'])->name('order.trackOrder');

});
