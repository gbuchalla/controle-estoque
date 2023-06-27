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

// Stock route
Route::post('/stock/update/{id}', 'ProductController@stockUpdate');

// Salaries routes

// Falta um método p/ remover o Salaries
Route::get('/salaries', 'SalaryController@index');
Route::get('/salaries/{month}', 'SalaryController@show');
Route::post('/salaries/{employee_id}/pay', 'SalaryController@pay');
Route::get('/salaries/{id}/edit', 'SalaryController@edit');
Route::post('/salaries/{id}/update', 'SalaryController@update');

// Cart Routes
Route::post('/cart/{$product_id}', 'CartController@addToCart'); // 
Route::get('/cart/products', 'CartController@getProducts');//
Route::delete('/cart/{id}', 'CartController@destroy');
Route::patch('/cart/products/{id}/increment', 'CartController@incrementProduct');
Route::patch('/cart/products/{id}/decrement', 'CartController@decrementProduct');

// Extra infos Route
Route::get('/extra', 'CartController@getExtraInfo');


// Point of Sale Routes 
Route::get('/products/{category_id}', 'PosController@getFilteredProducts');
Route::post('/orders', 'PosController@storeOrder');

// Orders Routes
Route::get('/orders', 'OrderController@getTodayOrders');
Route::get('/orders/{id}', 'OrderController@show');
Route::get('/orders/details/{id}', 'OrderController@showDetails');
Route::post('/orders/search', 'OrderController@searchByDate'); // Change to GET http verb

// Dashboard Routes

Route::get('/today/sold', 'DashboardController@getTodaySold');
Route::get('/today/income', 'DashboardController@getTodayIncome');
Route::get('/today/due', 'DashboardController@getTodayDue');
Route::get('/today/expense', 'DashboardController@getTodayExpense');
Route::get('/products/stockout', 'DashboardController@stockOut');

