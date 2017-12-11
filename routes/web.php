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

Route::post('foreigntrade', 'ForeignTradeScreenController@index');
Route::post('foreigntrade/totals', 'ForeignTradeScreenController@totals');
Route::post('foreigntrade/country', 'ForeignTradeScreenController@country');
Route::post('foreigntrade/area', 'ForeignTradeScreenController@area');
Route::post('foreigntrade/route', 'ForeignTradeScreenController@route');
Route::post('foreigntrade/category', 'ForeignTradeScreenController@category');
