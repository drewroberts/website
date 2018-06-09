<?php

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

Route::get('/article', function () {
    return view('article');
});

Route::get('/amp', function () {
    return view('amp');
});

Route::get('/example', function () {
    return view('test');
});

Route::get('/test', function () {
    return view('example');
});

Route::get('/', function () {
    return view('app');
});

// Redirect ./recommendations to ./recommends

Route::any('{all}', function () {
    return view('app');
})
->where(['all' => '.*']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Need to put all topics here.
