<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('temporary');
});

Route::get('amp', function () {
    return view('amp');
});

Route::get('amp-single', function () {
    return view('amp-single');
});

Route::get('new', function () {
    return view('new');
});
