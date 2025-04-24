<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {

     // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
        Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
        // ...
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        // * Put all autheticated routes here
    });

});
