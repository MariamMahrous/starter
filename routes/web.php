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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//Facebook Login Routes
Route::get('/redirect/{service}','SocialController@redirect');

Route::get('/callback/{service}','SocialController@callback');

//Crud Opreation
Route::get('fillable','CrudController@getoffers');
Route::group(['prefix'=>'offers'],function(){
  // Route::get('store','CrudController@store');
   Route::get('create','CrudController@create');
    Route::post('store','CrudController@store')->name('offers.store');




});
