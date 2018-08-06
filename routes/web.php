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

Route::get('/', function () {
    return view('temporary');
});

Route::get('amp', function () {
    return view('amp');
});

Route::get('aos', function () {
    return view('aos');
});

Route::get('home', 'HomeController@index')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('newsletter', 'Auth\RegisterController@showRegistrationForm')->name('newsletter');
Route::group(['prefix' => 'newsletter'], function () {
  Route::get('subscribe', 'Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('subscribe', 'Auth\RegisterController@register');
  Route::get('thanks', 'HomeController@index')->name('home');
  Route::get('confirm/{token}', 'Auth\RegisterController@confirmEmail');
});
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('recommendations', function () { return redirect('recommends'); });
Route::get('recommends', 'RecommendationController@index')->name('recommendations');
Route::group(['prefix' => 'recommends'], function () {
  // All subURLs of /recommends/ will be in those controllers and included in this group.
});

Route::get('{topic}/resources', 'ResourceController@index');
Route::get('{topic}/resources/{resource}', 'ResourceController@show');
Route::get('{topic}/{post}', 'PostController@show');
Route::get('{topic}', 'TopicController@show');


Route::any('{all}', function () {
    return view('temporary');
})
->where(['all' => '.*']);
