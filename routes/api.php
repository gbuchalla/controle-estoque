<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// Stock route
Route::post('/stock/update/{id}', 'ProductController@stockUpdate');

// Salaries routes
Route::get('/salaries', 'SalaryController@index');
Route::get('/salaries/{month}', 'SalaryController@show');
Route::post('/salaries/{employee_id}/pay', 'SalaryController@pay');
Route::get('/salaries/{id}/edit', 'SalaryController@edit');
Route::post('/salaries/{id}/update', 'SalaryController@update');
Route::delete('/salaries/{id}', 'SalaryController@destroy');

// Cart Routes
Route::post('/cart/{product_id}', 'CartController@addToCart');
Route::get('/cart/products', 'CartController@getProducts');
Route::delete('/cart/{id}', 'CartController@destroy');
Route::patch('/cart/products/{id}/increment', 'CartController@incrementProduct');
Route::patch('/cart/products/{id}/decrement', 'CartController@decrementProduct');

// Extra infos Route
Route::get('/extra', 'CartController@getExtraInfo');

// Point of Sale Routes 
Route::get('/products/{category_id}', 'PosController@getFilteredProducts');
Route::post('/orders', 'PosController@storeOrder');

// Orders Routes
Route::get('/orders/today', 'OrderController@getTodayOrders');
Route::get('/orders/{id}', 'OrderController@show');
Route::get('/orders/{id}/details', 'OrderController@showDetails');
Route::post('/orders/search', 'OrderController@searchByDate');

// Dashboard Routes

Route::get('/today/sold', 'DashboardController@getTodaySold');
Route::get('/today/income', 'DashboardController@getTodayIncome');
Route::get('/today/due', 'DashboardController@getTodayDue');
Route::get('/today/expense', 'DashboardController@getTodayExpense');
Route::get('/dashboard/products/stockout', 'DashboardController@getStockOut');
