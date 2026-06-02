<?php

use App\Http\Controllers\Api\ReferralController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('referral')->group(function () {
    Route::get('/link', [ReferralController::class, 'link']);
    Route::get('/tree', [ReferralController::class, 'tree']);
});

Route::get('/health', function () {
    return response()->json([
        'status'    => 'ok',
        'message'   => 'MLM Referral Platform API is running',
        'timestamp' => now(),
        'version'   => config('app.version', '1.0'),
    ]);
});
