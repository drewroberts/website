<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AMPController;

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

Route::get('/amp-tailwind', [AMPController::class, 'index'])->name('amp.index');
