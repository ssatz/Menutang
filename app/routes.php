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
 * 404 Error
 *
 */
App::missing(function ($exception) {
    return View::make('error404');


    
});
/**
 * Admin Routes
 */
Route::group(['domain' => 'admin.'.preg_replace('#^http(s)?://(www.)?#', '', Config::get('app.url'))], function () {
    Route::get('login', 'AdminAuthController@showLogin');
    Route::get('/', 'AdminAuthController@showLogin');
    Route::post('login', ['as' => 'admin.login.post', 'uses' => 'AdminAuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AdminAuthController@logout']);

    Route::group(['before' => 'auth.admin'], function () {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminAuthController@dashboard']);

        Route::get('regional-settings', ['as' => 'admin.regionalsettings', 'uses' => 'AdminAuthController@regionalSettings']);
        Route::post('regional-settings/add', ['as' => 'admin.regionalsettings.add', 'uses' => 'AdminAuthController@addCity']);
        Route::post('regional-settings/update', ['as' => 'admin.regionalsettings.update', 'uses' => 'AdminAuthController@updateCityStatus']);
        Route::any('delivery-area', ['as' => 'admin.delivery-area', 'uses' => 'AdminAuthController@addOrUpdateDeliveryArea']);
        Route::get('manage-business', ['as' => 'admin.business', 'uses' => 'ManageBusinessController@showBusinesses']);
        Route::group(['prefix' => 'manage-business'], function () {
            Route::any('add', ['as' => 'admin.business.add', 'uses' => 'ManageBusinessController@addBusinessInfo']);
            Route::any('timeday', ['as' => 'admin.business.timeday', 'uses' => 'ManageBusinessController@timeDay']);
        });
        Route::any('{businessName}/holidays', ['as' => 'admin.business.holidays', 'uses' => 'ManageBusinessController@addOrUpdateHolidays']);
        Route::get('deliverysearch', ['as' => 'admin.business.deliveryAreaSearch', 'uses' => 'ManageBusinessController@deliveryAreaSearch']);
        Route::post('addbutype', ['as' => 'admin.business.addBuType', 'uses' => 'ManageBusinessController@addBuType']);
        Route::post('addcutype', ['as' => 'admin.business.addCuType', 'uses' => 'ManageBusinessController@addCuType']);
        Route::post('addUpdateType', ['as' => 'admin.business.addUpdateType', 'uses' => 'AdminAuthController@addUpdateType']);
        Route::get('{businessName?}', ['as' => 'admin.business.dashboard', 'uses' => 'ManageBusinessController@businessDashboard']);
        Route::any('{businessName}/edit', ['as' => 'admin.business.edit', 'uses' => 'ManageBusinessController@editBusinessInfo']);
        Route::any('{businessName}/menu/add-item', ['as' => 'admin.business.additem', 'uses' => 'ManageBusinessController@addItem']);
        Route::any('{businessName}/menu/edit-item', ['as' => 'admin.business.edititem', 'uses' => 'ManageBusinessController@editItem']);
        Route::any('{businessName}/menu/upload', ['as' => 'admin.business.menu_upload', 'uses' => 'ManageBusinessController@upload']);
        Route::any('{businessName}/delivery-area', ['as' => 'admin.business.deliveryarea', 'uses' => 'ManageBusinessController@deliveryArea']);
        Route::any('{businessName}/addCategory', ['as' => 'admin.business.addCategory', 'uses' => 'ManageBusinessController@addCategory']);
        Route::get('{businessName}/changecategory', ['as' => 'admin.business.changecategory', 'uses' => 'ManageBusinessController@changeMenuCategory']);
    });
});

/**
 *  Business Routes
 */
Route::group(['domain' => 'business.'.preg_replace('#^http(s)?://(www.)?#', '', Config::get('app.url'))], function () {
    Route::get('login', 'BusinessAuthController@showLogin');
    Route::get('/', 'BusinessAuthController@showLogin');
    Route::post('login', ['as' => 'business.login.post', 'uses' => 'BusinessAuthController@postLogin']);
    Route::get('logout', ['as' => 'business.logout', 'uses' => 'BusinessAuthController@logout']);

    Route::group(['before' => 'auth.businessuser'], function () {
        Route::get('dashboard', ['as' => 'business.dashboard', 'uses' => 'BusinessAuthController@dashboard']);
    });
});

/**
 * FrontEnd Routes
 */
Route::get('info.htm',function(){
    echo phpinfo();
});
Route::get('about-us.htm', ['as' => 'aboutUs', 'uses' => 'GuestController@aboutUs']);
Route::get('faq.htm', ['as' => 'faq', 'uses' => 'GuestController@faq']);
Route::get('logout', ['as' => 'user.logout', 'uses' => 'FrontEndController@logout']);
Route::post('login', ['as' => 'user.login', 'uses' => 'FrontEndController@userLogin']);
Route::post('register', ['as' => 'user.register', 'uses' => 'FrontEndController@userRegistration']);
Route::get('/',['as'=>'index','uses'=>'FrontEndController@index']);
Route::any('password/reset/{type}/{token}', ['as'=>'password.reset','uses'=>'FrontEndController@passwordReset']);
Route::post('forgot-password', ['as'=>'password.forgot','uses'=>'FrontEndController@forgotPassword']);
Route::any('restaurants/{query}',['as'=>'business','uses'=>'FrontEndController@restaurantsProfile']);
Route::post('restaurants/{query}/cart',['as'=>'business.cart','uses'=>'CartController@addToCart']);
Route::get('restaurants/{query}/getcart',['as'=>'business.get.cart','uses'=>'CartController@getCart']);
Route::get('restaurants/{query}/getoptions',['as'=>'business.get.options','uses'=>'CartController@getOptions']);
Route::post('restaurants/{query}/addoptions',['as'=>'business.add.options','uses'=>'CartController@addToCartOptions']);
Route::post('restaurants/{query}/cart/update',['as'=>'business.update.cart','uses'=>'CartController@updateCartItem']);
Route::get('{locality}/{query}',['as'=>'locality.area','uses'=>'FrontEndController@searchBU']);
Route::get('{locality}',['as'=>'locality','uses'=>'FrontEndController@searchBU']);




//Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query)
{
   var_dump($query);
});*/
