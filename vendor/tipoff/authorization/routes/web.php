<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Tipoff\Authorization\Http\Controllers\AuthenticationController;
use Tipoff\Authorization\Http\Controllers\EmailAuthenticationController;
use Tipoff\Authorization\Http\Controllers\RegistrationController;
use Tipoff\Authorization\Http\Middleware\TipoffAuthenticate;
use Tipoff\Authorization\Http\Middleware\TipoffRedirectIfAuthenticated;

Route::middleware(config('tipoff.web.middleware_group'))
    ->prefix(config('tipoff.web.uri_prefix'))
    ->group(function () {

        // GUEST - email or web
        Route::middleware(TipoffRedirectIfAuthenticated::class . ':email,web')->group(function () {
            Route::get('cart/create', [EmailAuthenticationController::class, 'create'])->name('authorization.email-login');
            Route::post('cart/create', [EmailAuthenticationController::class, 'store']);
        });

        // GUEST - web
        Route::middleware(TipoffRedirectIfAuthenticated::class . ':web')->group(function () {
            Route::get('login', [AuthenticationController::class, 'create'])->name('authorization.login');
            Route::post('login', [AuthenticationController::class, 'store']);

            Route::get('/register', [RegistrationController::class, 'create'])->name('authorization.register');
            Route::post('/register', [RegistrationController::class, 'store']);
        });

        Route::middleware(TipoffAuthenticate::class  .':email,web')->group(function () {
            Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('authorization.logout');
        });
    });
