<?php

Route::auth();

// web routes
Route::group(['as' => 'web.', 'namespace' => 'Web'], function() {

    // authed web routes
    Route::group(['middleware' => 'auth:web'], function() {
        Route::resource('matches', 'MatchesController', ['except' => ['index','show']]);
    });

    // public web routes
    Route::get('/', ['uses' => 'HomeController@index']);
    Route::resource('users',   'UsersController');
    Route::resource('matches', 'MatchesController');
});

// api routes
Route::group(['prefix' => '/api/v1/', 'namespace' => 'Api'], function() {

    // authed api routes
    Route::group(['middleware' => 'auth:api'], function() {
        $cud = ['only' => 'store','update','destroy'];
        Route::resource('users',             'UsersController', $cud);
        Route::resource('matches',           'MatchesController', $cud);
        Route::resource('channels',          'Chat\ChannelsController', $cud);
        Route::resource('messages',          'Chat\MessagesController', $cud);
        Route::resource('channels.messages', 'Chat\ChannelsMessagesController', $cud);
        Route::resource('channels.users',    'Chat\ChannelsUsersController', $cud);
    });

    // public api routes
    $r = ['only' => ['index','show']];
    Route::resource('users',             'UsersController', $r);
    Route::resource('matches',           'MatchesController', $r);
    Route::resource('channels',          'Chat\ChannelsController', $r);
    Route::resource('messages',          'Chat\MessagesController', $r);
    Route::resource('channels.messages', 'Chat\ChannelsMessagesController', $r);
    Route::resource('channels.users',    'Chat\ChannelsUsersController', $r);
});