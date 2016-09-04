<?php

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

Route::get('/', 'RootController@get');

Route::group(['prefix' => '/self', 'middleware' => ['auth:api', 'scopes:self:read']], function () {
    Route::get('/', 'SelfController@index');
    Route::get('/roles', 'SelfController@roles');
});

Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);