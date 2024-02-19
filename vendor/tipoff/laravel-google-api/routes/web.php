<?php

use Illuminate\Support\Facades\Route;
use Tipoff\GoogleApi\Http\Controllers\GoogleOauthController;

Route::middleware(config('tipoff.web.middleware_group'))
    ->prefix(config('tipoff.web.uri_prefix'))
    ->group(function () {

        Route::prefix('google-oauth')
            ->group(function () {
            Route::get('oauth', [GoogleOauthController::class, 'redirect'])->name('google-oauth.connect');
            Route::get('callback', [GoogleOauthController::class, 'handleCallback'])->name('google-oauth.callback');
            Route::get('logout', [GoogleOauthController::class, 'logout'])->name('google-oauth.logout');
        });
    });
