<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('kayit', [RegisteredUserController::class, 'create'])
                ->name('kayit');

    Route::post('kayit', [RegisteredUserController::class, 'store']);

    Route::get('giris', [AuthenticatedSessionController::class, 'create'])
                ->name('giris');

    Route::post('giris', [AuthenticatedSessionController::class, 'store']);

    Route::get('sifremi-unuttum', [PasswordResetLinkController::class, 'create'])
                ->name('sifremi-unuttum');

    Route::post('sifremi-unuttum', [PasswordResetLinkController::class, 'store'])
                ->name('sifremi-unuttum');

    Route::get('sifre-sifirla/{token}', [NewPasswordController::class, 'create'])
                ->name('sifre-sifirla');

    Route::post('sifre-sifirla', [NewPasswordController::class, 'store'])
                ->name('sifre-sifirla');
});

Route::middleware('auth')->group(function () {
    Route::get('eposta-dogrula', [EmailVerificationPromptController::class, '__invoke'])
                ->name('eposta-dogrula');

    Route::get('eposta-dogrula/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('eposta-dogrula');

    Route::post('eposta/dogrulama-bildirimi', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('dogrulama-gonder');

    Route::get('sifre-dogrula', [ConfirmablePasswordController::class, 'show'])
                ->name('sifre-dogrula');

    Route::post('sifre-dogrula', [ConfirmablePasswordController::class, 'store']);

    Route::post('cikis', [AuthenticatedSessionController::class, 'destroy'])
                ->name('cikis');
});
