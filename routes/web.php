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

Route::get('recommendations', function () { return redirect('recommends'); });
Route::get('recommends', 'RecommendationController@index')->name('recommendations');
Route::group(['prefix' => 'recommends'], function () {
  // All subURLs of /recommends/ will be in those controllersa nd included in this group.
});

Route::get('{topic}/resources', 'ResourceController@index');
Route::get('{topic}/resources/{resource}', 'ResourceController@show');
Route::get('{topic}/{post}', 'PostController@show');
Route::get('{topic}', 'TopicController@show');


Route::any('{all}', function () {
    return view('temporary');
})
->where(['all' => '.*']);
Auth::routes();
