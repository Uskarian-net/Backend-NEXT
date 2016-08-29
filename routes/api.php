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

Route::get('/', ['as' => 'root', 'uses' => 'RootController@get']);
Route::get('/authenticated', ['as' => 'root', 'uses' => 'RootController@getAuthenticated'])->middleware('auth:api')->middleware('scopes:self:read');;