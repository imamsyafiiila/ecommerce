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

Route::get('/prepaid-balance', 'PrepaidbalanceController@index');
Route::get('/order', 'OrderController@index');
Route::post('/search-data', 'OrderController@search');
Route::post('/get-code', 'OrderController@getCode');
Route::get('/product', 'ProductecomController@index');
Route::post('/store-pre', 'PrepaidbalanceController@store');
Route::post('/store-pro', 'ProductecomController@store');
Route::match(['get', 'post'],'/payment', 'PayController@index');
Route::post('/save-pay', 'PayController@savepay');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
