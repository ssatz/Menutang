<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Admin Routes
 */
Route::group(['domain' => 'admin.localhost'], function () {
    Route::get('login', 'AdminAuthController@showLogin');
    Route::get('/', 'AdminAuthController@showLogin');
    Route::post('login', ['as' => 'admin.login.post', 'uses' => 'AdminAuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AdminAuthController@logout']);

    Route::group(['before' => 'auth.admin'], function () {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminAuthController@dashboard']);
    });
});



/**
 *  Business Routes
 */
Route::group(['domain' => 'business.localhost'], function () {
    Route::get('login', 'BusinessAuthController@showLogin');
    Route::get('/', 'BusinessAuthController@showLogin');
    Route::post('login', ['as' => 'business.login.post', 'uses' => 'BusinessAuthController@postLogin']);
    Route::get('logout', ['as' => 'business.logout', 'uses' => 'BusinessAuthController@logout']);

    Route::group(['before' => 'auth.businessuser'], function () {
        Route::get('dashboard', ['as' => 'business.dashboard', 'uses' => 'BusinessAuthController@dashboard']);
    });
});