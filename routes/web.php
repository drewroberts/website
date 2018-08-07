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

Route::get('newsletter', 'Auth\RegisterController@showNewsletter')->name('newsletter'); // Build longer style landing page
Route::group(['prefix' => 'newsletter'], function () {
    Route::get('subscribe', 'Auth\RegisterController@showRegistrationForm')->name('subscribe'); // Build short form landing page
    Route::post('subscribe', 'Auth\RegisterController@register');
    Route::get('thanks', 'ProfileController@thanks')->name('requested');
    Route::get('confirm/{id_token}', 'UserController@confirmEmail');
    Route::get('confirm', 'UserController@showConfirmed')->name('confirmed');
});

Route::get('together', 'ProfileController@index')->name('together'); // Not index of profiles, but index of things subscribers can do with me. Password protected.
Route::group(['prefix' => 'together'], function () {
    Route::get('you', 'ProfileController@show')->name('profile');
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    // Contact/Message Routes...
    Route::get('contact', 'MessageController@contact')->name('contact'); // Contact me is for subscribers only to send messages.
    Route::post('messages', 'MessageController@index'); // Historical correspondence with the subscriber.
});



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
