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

Route::put('/update-name' , ['as' => 'name.update' , 'uses' => 'NameController@update']);

Route::get('/del-name/{id}' , ['as' => 'name.destroy' , 'uses' => 'NameController@destroy']);



Route::get('/full-text-search' , ['as' => 'fullSearch.index' , 'uses' => 'Full_text_searchController@index']);
Route::post('/full-text-search-action' , ['as' => 'full-text-search.action' , 'uses' => 'Full_text_searchController@action']);


Route::group(['prefix' => 'pagination'] , function (){
    Route::get('/' , ['as' => 'pagination.index' , 'uses' => 'PaginationController@index']);
    Route::get('/fetch_data', ['as' => 'pagination.fetch_data' , 'uses' => 'PaginationController@fetch_data']);
});


Route::get('/render' , function () {
   $view = view('welcome');
   echo $view;
});
