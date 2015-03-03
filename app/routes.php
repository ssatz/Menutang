<?php

Route::get('info',function(){
    echo phpinfo();
});

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
Route::group(['domain' => 'admin.localhost'], function () {
    Route::get('login', 'AdminAuthController@showLogin');
    Route::get('/', 'AdminAuthController@showLogin');
    Route::post('login', ['as' => 'admin.login.post', 'uses' => 'AdminAuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AdminAuthController@logout']);

    Route::group(['before' => 'auth.admin'], function () {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminAuthController@dashboard']);
        Route::get('regional-settings', ['as' => 'admin.regionalsettings', 'uses' => 'AdminAuthController@regionalSettings']);
        Route::post('regional-settings/update', ['as' => 'admin.regionalsettings.update', 'uses' => 'AdminAuthController@updateCityStatus']);
        Route::any('delivery-area', ['as' => 'admin.delivery-area', 'uses' => 'AdminAuthController@addOrUpdateDeliveryArea']);
        Route::get('manage-business', ['as' => 'admin.business', 'uses' => 'ManageBusinessController@showBusinesses']);
        Route::group(['prefix' => 'manage-business'], function () {
            Route::any('add', ['as' => 'admin.business.add', 'uses' => 'ManageBusinessController@addBusinessInfo']);
        });
        Route::any('deliverysearch', ['as' => 'admin.business.deliveryAreaSearch', 'uses' => 'ManageBusinessController@deliveryAreaSearch']);
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
Route::group(['domain' => 'business.localhost'], function () {
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

Route::get('/',['as'=>'index','uses'=>'FrontEndController@index']);
Route::get('{locality}/{query}',['as'=>'locality.area','uses'=>'FrontEndController@searchBU']);
Route::get('{locality}',['as'=>'locality','uses'=>'FrontEndController@searchBU']);
Route::any('restaurants/{query}',['as'=>'business','uses'=>'FrontEndController@restaurantsProfile']);
//Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query)
{
   var_dump($query);
}); */
