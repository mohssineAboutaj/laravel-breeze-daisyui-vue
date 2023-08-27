<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  // register group
  Route::prefix('register')->group(function () {
    Route::get('/', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/', [RegisteredUserController::class, 'store'])->name('register.store');
  });


  // login group
  Route::prefix('login')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/', [AuthenticatedSessionController::class, 'store']);
  });

  // forgot password group
  Route::prefix('forgot-password')->group(function () {
    Route::get('/', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('/', [PasswordResetLinkController::class, 'store'])->name('password.email');
  });


  // reset-password group
  Route::prefix('reset-password')->group(function () {
    Route::get('/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('/', [NewPasswordController::class, 'store'])->name('password.store');
  });
});

Route::middleware('auth')->group(function () {
  Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::put('password', [PasswordController::class, 'update'])->name('password.update');

  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});
