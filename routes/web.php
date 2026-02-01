<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\GoogleAuthController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('/register', [AuthController::class, 'store'])->name('register');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/home', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/home', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::delete('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
    Route::post('/profile/reset-password', [ProfileController::class, 'sendResetLink'])->middleware('auth')->name('profile.reset-password');
});

Route::get('/otp/verify', [OtpController::class, 'showOtpVerify'])->name('otp.verify');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify.post');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('profile')
        : redirect()->route('login.show');
});

Route::post('/set-language', function (\Illuminate\Http\Request $request) {
    $lang = $request->input('lang', 'pt');
    Session::put('locale', $lang);
    return response()->json(['status' => 'ok']);
})->name('set.language');

