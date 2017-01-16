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

Route::get('customer', 'Customer_controller@index');
Route::get('customer/create', 'Customer_controller@create');
Route::post('customer/store', 'Customer_controller@store');

$router->get('create', [
    'uses' => 'Customer_controller@create',
    'as' => 'admin.customer.create',
    'permission' => 'manage_tag',
    'middleware' => 'validator:App\Eloquent\Customer' // Pass the model name (including namespace)
]);