<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/** Route CUSTOMER*/
Route::group(['prefix' => 'customer'], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('', 'Customer_controller@index');
    Route::get('create', 'Customer_controller@create');
    Route::get('{id}/edit/', 'Customer_controller@create');
    Route::post('store', 'Customer_controller@store')->middleware('validator:App\Customer');
    Route::get('detail/{id}', 'Customer_controller@detail');

    // Action handle Customer location
    Route::get('{id}/create_location', 'Customer_controller@create_location');
    Route::post('save_location', 'Customer_controller@create_location')->middleware('validator:App\Customer_location');

    // Action handle Customer contact
    Route::get('{id}/create_contact', 'Customer_controller@create_contact');
    Route::post('{id}/create_contact', 'Customer_controller@create_contact');
});

/** Route INDUSTRIAL_WASTE */
Route::group(['prefix' => 'industrial_waste'], function() {

    Route::get('', 'Industrial_waste_controller@index');
    Route::get('create', 'Industrial_waste_controller@create');
    Route::get('update', 'Industrial_waste_controller@update');
});

$router->get('create', [
    'uses' => 'Customer_controller@create',
     // Pass the model name (including namespace)
]);

Route::group(['prefix' => 'api'], function() {
    Route::post('definition/change_status', 'api\Definition@change_status');
});

