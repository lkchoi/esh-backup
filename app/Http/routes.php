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

// Web Routes
Route::group(['middleware' => 'auth:web'], function() {
    Route::resource('matches', 'MatchesController', ['except' => ['index','show']]);
});

Route::resource('matches', 'MatchesController', ['only' => ['index','show']]);

// API Routes
Route::group(['prefix' => '/api/v1/'], function() {
    Route::resource('users', 'Api\UsersController');
    Route::resource('matches', 'Api\MatchesController');
    Route::resource('channels', 'Api\Chat\ChannelsController');
    Route::resource('messages', 'Api\Chat\MessagesController');
    Route::resource('channels.messages', 'Api\Chat\ChannelMessagesController');
    Route::resource('channels.users', 'Api\Chat\ChannelUsersController');
});