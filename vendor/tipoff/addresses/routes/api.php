<?php

use Illuminate\Support\Facades\Route;
use Tipoff\Addresses\Http\Controllers\PhoneFieldController;

Route::post('save-phone-number', [PhoneFieldController::class, 'store']);
