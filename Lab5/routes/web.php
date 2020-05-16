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

Route::redirect('/', '/cars');
Route::get('/cars', 'CarsController@allcars');
Route::get('/car/new', 'CarsController@newcarform');
Route::post('/car', 'CarsController@newcar');
Route::get('/cars/{id}', 'CarsController@show')->name('cars.show');

Route::get('reviews', 'ReviewsController@index')->name('reviews.index');;
Route::get('reviews/create/{carId}', 'ReviewsController@create')->name('reviews.create');
Route::get('reviews/show/{id}', 'ReviewsController@show')->name('reviews.show');
Route::get('reviews/cars/{id}', 'ReviewsController@cars')->name('reviews.cars');
Route::post('reviews', 'ReviewsController@store');

Route::post('/search', 'ReviewsController@search');
