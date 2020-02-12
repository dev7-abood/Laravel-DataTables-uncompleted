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

Route::get('/home', ['as' => 'get.names' , 'uses' => 'NameController@index']);

Route::post('/store-name', ['as' => 'name.store' , 'uses' => 'NameController@store']);

Route::get('/edit-name/{id}' , ['as' => 'name.edit' , 'uses' => 'NameController@edit']);

Route::post('/update-name' , ['as' => 'name.update' , 'uses' => 'NameController@update']);
