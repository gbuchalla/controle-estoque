<?php

use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/employees', 'EmployeeController');
Route::apiResource('/suppliers', 'SupplierController');
Route::apiResource('/categories', 'CategoryController');
Route::apiResource('/products', 'ProductController');
Route::apiResource('/expenses', 'ExpenseController');
Route::apiResource('/customers', 'CustomerController');

Route::Get('/salaries', 'SalaryController@index');
Route::Get('/salaries/{month}', 'SalaryController@show');
Route::Post('/salaries/{employee_id}/pay', 'SalaryController@pay');
Route::Get('/salaries/{id}/edit', 'SalaryController@edit');
Route::Post('/salaries/{id}/update', 'SalaryController@update');

Route::Post('/stock/update/{id}', 'ProductController@stockUpdate');