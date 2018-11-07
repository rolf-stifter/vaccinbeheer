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

Route::middleware(['auth'])->group(function () {
    //routes for Stock controller
    Route::resource('stock', 'StockController');
    Route::get('/stock/edit/{id}', 'StockController@edit');
    Route::get('/stock/destroy/{id}', 'StockController@destroy')->name('stock.customdestroy');
    Route::get('/stock/add_external/{id}', 'StockController@add_external_stock')->name('stock.add_external_stock');

    //routes for Requests controller
    Route::resource('requests', 'RequestsController');
    Route::get('/requests/edit/{id}', 'requestsController@edit');
    Route::get('/requests/destroy/{id}', 'requestsController@destroy')->name('requests.customdestroy');

    //routes for Vaccinations controller
    Route::resource('vaccinations', 'VaccinationsController');
    Route::get('/vaccinations/edit/{id}', 'VaccinationsController@edit');
    Route::get('/vaccinations/destroy/{id}', 'VaccinationsController@destroy')->name('vaccinations.customdestroy');
    Route::get('/vaccinations/definitive_vaccination/{id}', 'VaccinationsController@definitive_vaccination')->name('vaccinations.definitive_vaccination');

    //Routes for manage_stock controller
    Route::resource('manage_stock', 'manage_StockController');
    Route::get('manage_stock/edit/{id}', 'manage_StockController@edit');
    Route::get('manage_stock/destroy/{id}', 'manage_StockController@destroy')->name('manage_stock.customdestroy');
    Route::post('manage_stock/add', 'manage_StockController@add_total_stock')->name('manage_stock.add');

    //Routes for manage_requests controller
    Route::resource('manage_requests', 'manage_RequestsController');
    Route::get('manage_requests/edit/{id}', 'manage_RequestsController@edit');
    Route::get('manage_requests/destroy/{id}', 'manage_RequestsController@destroy')->name('manage_requests.customdestroy');

    //routes for Vaccinations controller
    Route::resource('manage_vaccinations', 'manage_VaccinationsController');
    Route::get('/manage_vaccinations/edit/{id}', 'manage_VaccinationsController@edit');
    Route::get('/manage_vaccinations/destroy/{id}', 'manage_VaccinationsController@destroy')->name('manage_vaccinations.customdestroy');

    //routes for Vaccins controller
    Route::resource('vaccins', 'VaccinsController');
    Route::get('/vaccins/edit/{id}', 'VaccinsController@edit');
    Route::get('/vaccins/destroy/{id}', 'VaccinsController@destroy')->name('vaccins.customdestroy');

    //routes for Schools controller
    Route::resource('schools', 'SchoolsController');
    Route::get('/schools/edit/{id}', 'SchoolsController@edit');
    Route::get('/schools/destroy/{id}', 'SchoolsController@destroy')->name('schools.customdestroy');

    //routes for Users controller
    Route::resource('users', 'UsersController');
    Route::get('/users/edit/{id}', 'UsersController@edit');
    Route::get('/users/destroy/{id}', 'UsersController@destroy')->name('users.customdestroy');

    //routes for Profile controller
    Route::resource('profile', 'ProfileController');
    Route::get('/profile/add_to_favorites/{id}', 'ProfileController@add_to_favorites')->name('profile.favorites');
    Route::get('/profile/delete_favorite/{id}', 'ProfileController@delete_favorite')->name('profile.delete_fav');
});