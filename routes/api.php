<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {
    Route::get('/event', [\App\Http\Controllers\Api\EventController::class, 'allEvent']);
    Route::post('/event', [\App\Http\Controllers\Api\EventController::class, 'createEvent']);
    Route::get('/event/{eventID}', [\App\Http\Controllers\Api\EventController::class, 'singleEvent']);
    Route::post('/event/{eventID}/update', [\App\Http\Controllers\Api\EventController::class, 'updateEvent']);
    Route::delete('/event/{eventID}/delete', [\App\Http\Controllers\Api\EventController::class, 'deleteEvent']);
    Route::post('/register/participant', [\App\Http\Controllers\Api\EventController::class, 'registerParticipant']);
});