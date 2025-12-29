<?php

use Illuminate\Support\Facades\Route;

// Catch ALL routes and send to Vue and Vue Router will handle the actual routing
/**
 * Matches every possible URL
 * Returns the same Blade view every time
 * e.g. /, /about, /dashboard, /users/1, /posts/2020/05/01/some-post-title
 */
Route::get('/{any}', function () {
    return view('app'); // Load app.blade.php
})->where('any', '.*'); 