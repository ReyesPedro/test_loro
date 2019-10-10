<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('users', 'UserController');

Route::get('users/{user}/posts', 'UserPostController@index');
Route::get('users/{user}/posts/{post}', 'UserPostController@show');
Route::post('users/{user}/posts', 'UserPostController@store');
Route::put('users/{user}/posts/{post}', 'UserPostController@update');
Route::delete('users/{user}/posts/{post}', 'UserPostController@destroy');




