<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::group(['as' => 'auth.'], function () {
    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware(['auth:sanctum'])
        ->name('logout');
});


// Password reset routes
Route::group(['as' => 'password.', 'prefix' => 'password/'], function () {
    Route::post('send-reset-link', [PasswordResetController::class, 'sendResetLinkViaEmail'])
        ->name('send-reset-link');

    Route::post('reset', [PasswordResetController::class, 'reset'])
        ->name('reset');
});


// User-related routes
Route::group(['as' => 'user.', 'prefix' => 'user/', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UserController::class, 'current'])
        ->name('current');

    Route::post('/update-info', [UserController::class, 'updateInfo'])
        ->name('update-info');

    Route::post('/update-password', [UserController::class, 'updatePassword'])
        ->name('update-password');

    //TODO: add to laravel base
    //TODO: test
});
