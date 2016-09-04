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

Route::group(['prefix' => '/users', 'middleware' => ['auth:api', 'role:api,admin']], function () {
    Route::get('/', 'UsersController@index')->middleware('scopes:users:read');
    Route::post('/', 'UsersController@create')->middleware('scopes:users:write');

    Route::get('/{id}', 'UsersController@read')->middleware('scopes:users:read');
    Route::put('/{id}', 'UsersController@update')->middleware('scopes:users:write');
    Route::delete('/{id}', 'UsersController@delete')->middleware('scopes:users:write');
});