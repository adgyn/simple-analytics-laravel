<?php

use Illuminate\Support\Facades\Route;

Route::prefix('analytics')->group(function() {
    Route::post('event', [\Adgyn\SimpleAnalytics\Http\Controllers\SimpleAnalyticsController::class, 'store']);
});