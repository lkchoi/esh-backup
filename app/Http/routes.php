<?php

// singularize route-model binding params
Route::singularResourceParameters();

Route::auth();

$r = ['only' => ['index','show']]; // read
$cud = ['only' => 'store','update','destroy']; // create, update, destroy

// web routes
Route::group(['as' => 'web.', 'namespace' => 'Web'], function() use ($r, $cud) {

    // authed web routes
    Route::group(['middleware' => 'auth:web'], function() use ($r, $cud) {
        Route::resource('matches', 'MatchesController', $cud);
    });

    // public web routes
    Route::get('/', ['uses' => 'HomeController@index']);
    Route::resource('users',   'UsersController');
    Route::resource('matches', 'MatchesController');
});

// api routes
Route::group([
    'prefix' => '/api/v1/',
    'namespace' => 'Api',
    'middleware' => 'api'
], function() use ($r, $cud) {

    // authed api routes
    Route::group(['middleware' => 'auth:api', 'guard' => 'api'], function() use ($r, $cud) {
        Route::resource('users',             'UsersController', $cud);
        Route::resource('matches',           'MatchesController', $cud);
        Route::resource('channels',          'Chat\ChannelsController', $cud);
        Route::resource('messages',          'Chat\MessagesController', $cud);
        Route::resource('channels.messages', 'Chat\ChannelsMessagesController', $cud);
        Route::resource('channels.users',    'Chat\ChannelsUsersController', $cud);
    });

    // public api routes
    Route::resource('users',             'UsersController', $r);
    Route::resource('matches',           'MatchesController', $r);
    Route::resource('channels',          'Chat\ChannelsController', $r);
    Route::resource('messages',          'Chat\MessagesController', $r);
    Route::resource('channels.messages', 'Chat\ChannelsMessagesController', $r);
    Route::resource('channels.users',    'Chat\ChannelsUsersController', $r);
});