<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Test endpoint to check if API works
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Rehab API is running! 🚀',
        'timestamp' => now(),
    ]);
});
