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

Route::get('foreigntrade', 'ForeignTradeScreenController@index');
Route::get('foreigntrade/totals', 'ForeignTradeScreenController@totals');
Route::get('foreigntrade/country', 'ForeignTradeScreenController@country');
Route::get('foreigntrade/area', 'ForeignTradeScreenController@area');
Route::get('foreigntrade/route', 'ForeignTradeScreenController@route');
Route::get('foreigntrade/category', 'ForeignTradeScreenController@category');
