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

//Route::get('/home', 'HomeController@index')->name('home');

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