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
    return view('home');
});

Route::post('store', 'homeController@store')->name('store');
Route::get('home', 'homeController@home')->name('home');
Route::get('delete/{id?}','homeController@delete')->name('delete');
Route::get('read/{id?}','homeController@read')->name('read');

