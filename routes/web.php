<?php

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('csrf');
Route::post('/login', 'Auth\LoginController@login')->middleware('csrf');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => '/oauth'], function () {
    Route::post('/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
    Route::get('/scopes', '\Laravel\Passport\Http\Controllers\ScopeController@all');

    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::get('/authorize', '\Laravel\Passport\Http\Controllers\AuthorizationController@authorize');
        Route::post('/authorize', '\Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve');
        Route::delete('/authorize', '\Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny');
    });
});