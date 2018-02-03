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
/* items */
//Route::resource('items', 'ItemController');
Route::get('/items', 'ItemController@index')->name('items.index');
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items/create', 'ItemController@store')->name('items.store');
Route::get('/items/{item_id}', 'ItemController@show')->name('items.show');
Route::get('/items/{item_id}/edit', 'ItemController@edit')->name('items.edit');
Route::post('/items/{item_id}', 'ItemController@update')->name('items.update');

Route::resource('costs', 'CostController');
Route::resource('medias', 'MediaController');
