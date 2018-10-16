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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/stock', 'StockController@index')->middleware('auth');

//routes for Requests controller
Route::resource('requests', 'RequestsController')->middleware('auth');
Route::get('/requests/edit/{id}', 'requestsController@edit')->middleware('auth');
Route::get('/requests/destroy/{id}', 'requestsController@destroy')->middleware('auth')->name('customdestroy');