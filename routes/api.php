<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status'    => 'ok',
        'message'   => 'Laptop Store API is running',
        'timestamp' => now(),
        'version'   => config('app.version', '1.0'),
    ]);
});
