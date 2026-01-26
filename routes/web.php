<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('profile')
        : redirect()->route('login.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

