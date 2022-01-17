<?php

use App\Http\Controllers\Admin\GeneralController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::redirect('/', 'home');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('lookup_type' , GeneralController::class);
    Route::resource('lookup' , GeneralController::class);
    Route::resource('user' , GeneralController::class);
    Route::resource('file' , GeneralController::class);
    Route::resource('job_info' , GeneralController::class);
    Route::resource('profile_info' , GeneralController::class);
});
