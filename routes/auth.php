<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class, "create"])->name('login-page');
    Route::post('/login', [LoginController::class, "authenticate"])->name('login');
    Route::get('/register', [RegisterController::class, "create"])->name('register-page');
    Route::post('/register', [RegisterController::class, "register"])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});