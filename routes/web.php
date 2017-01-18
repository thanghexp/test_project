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
Route::get('customer', 'Customer_controller@index');
Route::get('customer/create', 'Customer_controller@create');
Route::get('customer/update/{id}', 'Customer_controller@update');
Route::post('customer/store', 'Customer_controller@store')->middleware('validator:App\Customer');
Route::get('customer/detail/{id}', 'Customer_controller@detail');

$router->get('create', [
    'uses' => 'Customer_controller@create',
     // Pass the model name (including namespace)
]);