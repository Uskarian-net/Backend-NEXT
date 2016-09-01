<?php

Route::get('/login', 'Auth\LoginController@showLoginForm')->middleware('csrf');
Route::post('/login', 'Auth\LoginController@login')->middleware('csrf');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/logout/return', 'Auth\LoginController@logoutWithReturn');

Route::post('/register', 'Auth\RegisterController@register')->middleware('csrf');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->middleware('csrf');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->middleware('csrf');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->middleware('csrf');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->middleware('csrf');

Route::group(['prefix' => '/oauth'], function () {
    Route::post('/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
    Route::get('/scopes', '\Laravel\Passport\Http\Controllers\ScopeController@all');

    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::get('/authorize', '\Laravel\Passport\Http\Controllers\AuthorizationController@authorize');
        Route::post('/authorize', '\Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve');
        Route::delete('/authorize', '\Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny');
    });
});