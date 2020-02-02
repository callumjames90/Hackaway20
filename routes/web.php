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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/review', 'ReviewController@index')->middleware('auth');
Route::post('/review', 'ReviewController@store')->middleware('auth');

Route::get('/review/create', 'ReviewController@create')->middleware('auth');

Route::get('/profile', 'ProfileController@index')->middleware('auth');
