<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'HomeController@index']);
Route::auth();
Route::get('/home', 'HomeController@index');
Route::resource('users', 'UsersController');

Route::group(['middleware' => 'auth:web'], function() {
    Route::resource('matches', 'MatchesController', ['except' => ['index','show']]);
});

Route::resource('matches', 'MatchesController', ['only' => ['index','show']]);
