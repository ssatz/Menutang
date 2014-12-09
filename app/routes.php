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
/*
 * Admin Routes
 */
Route::group(array('prefix' => 'admin'), function(){
	Route::get('login', 'AuthController@showLogin');
	Route::get('/', 'AuthController@showLogin');
	Route::post('login',['as'=>'admin.login.post','uses'=> 'AuthController@postLogin']);
});
