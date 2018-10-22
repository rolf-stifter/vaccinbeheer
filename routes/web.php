<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/home', 'StockController@index')->middleware('auth');

Auth::routes();

//routes for Stock controller
Route::resource('stock', 'StockController')->middleware('auth');
Route::get('/stock/edit/{id}', 'StockController@edit')->middleware('auth');
Route::get('/stock/destroy/{id}', 'StockController@destroy')->middleware('auth')->name('stock.customdestroy');


//routes for Requests controller
Route::resource('requests', 'RequestsController')->middleware('auth');
Route::get('/requests/edit/{id}', 'requestsController@edit')->middleware('auth');
Route::get('/requests/destroy/{id}', 'requestsController@destroy')->middleware('auth')->name('requests.customdestroy');

//routes for Vaccinations controller
Route::resource('vaccinations', 'VaccinationsController')->middleware('auth');
Route::get('/vaccinations/edit/{id}', 'VaccinationsController@edit')->middleware('auth');
Route::get('/vaccinations/destroy/{id}', 'VaccinationsController@destroy')->middleware('auth')->name('vaccinations.customdestroy');

//Routes for manage_stock controller
Route::resource('manage_stock', 'manage_StockController')->middleware('auth');
Route::get('manage_stock/edit/{id}', 'manage_StockController@edit')->middleware('auth');
Route::get('manage_stock/destroy/{id}', 'manage_StockController@destroy')->middleware('auth')->name('manage_stock.customdestroy');

//Routes for manage_requests controller
Route::resource('manage_requests', 'manage_RequestsController')->middleware('auth');
Route::get('manage_requests/edit/{id}', 'manage_RequestsController@edit')->middleware('auth');
Route::get('manage_requests/destroy/{id}', 'manage_RequestsController@destroy')->middleware('auth')->name('manage_requests.customdestroy');

//routes for Vaccinations controller
Route::resource('manage_vaccinations', 'manage_VaccinationsController')->middleware('auth');
Route::get('/manage_vaccinations/edit/{id}', 'manage_VaccinationsController@edit')->middleware('auth');
Route::get('/manage_vaccinations/destroy/{id}', 'manage_VaccinationsController@destroy')->middleware('auth')->name('manage_vaccinations.customdestroy');

//routes for Vaccins controller
Route::resource('vaccins', 'VaccinsController')->middleware('auth');
Route::get('/vaccins/edit/{id}', 'VaccinsController@edit')->middleware('auth');
Route::get('/vaccins/destroy/{id}', 'VaccinsController@destroy')->middleware('auth')->name('vaccins.customdestroy');

//routes for Vaccins controller
Route::resource('schools', 'SchoolsController')->middleware('auth');
Route::get('/schools/edit/{id}', 'SchoolsController@edit')->middleware('auth');
Route::get('/schools/destroy/{id}', 'SchoolsController@destroy')->middleware('auth')->name('schools.customdestroy');

//routes for Users controller
Route::resource('users', 'UsersController')->middleware('auth');
Route::get('/users/edit/{id}', 'UsersController@edit')->middleware('auth');
Route::get('/users/destroy/{id}', 'UsersController@destroy')->middleware('auth')->name('users.customdestroy');