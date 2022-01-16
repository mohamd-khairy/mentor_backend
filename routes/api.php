<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/************************** auth routes ************************** */
Route::group([], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});
