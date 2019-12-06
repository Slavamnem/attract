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

Route::group(['prefix' => 'v1'], function(){
    Route::post('register', 'Api\AuthController@register');
    Route::post('oauth/token', 'Api\AuthController@oauth')->middleware('basic-auth');

    Route::group(['middleware' => ['oauth'], 'namespace' => 'Api'], function() {
        Route::get('users', 'UserController@getUsers');
        Route::group(['prefix' => 'messages'], function() {
            Route::post('', 'MessengerController@store');
            Route::get('', 'MessengerController@getMessagesFromUser');
        });
    });
});
