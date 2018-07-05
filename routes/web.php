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

Route::get('/amp', function () {
    return view('amp');
});

Route::get('/aos', function () {
    return view('aos');
});

Route::get('/oldamp', function () {
    return view('oldamp');
});


Route::get('/source1', function () {
    return view('source1');
});

Route::get('/source2', function () {
    return view('source2');
});

Route::get('/source3', function () {
    return view('source3');
});

Route::get('/source4', function () {
    return view('source4');
});

Route::get('/source5', function () {
    return view('source5');
});

Route::get('/source6', function () {
    return view('source6');
});

Route::get('/', function () {
    return view('temporary');
});

// Redirect ./recommendations to ./recommends

Route::any('{all}', function () {
    return view('temporary');
})
->where(['all' => '.*']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Need to put all topics here.
