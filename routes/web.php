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

//外贸屏幕接口
Route::get('foreigntrade', 'ForeignTradeScreenController@index');
Route::get('foreigntrade/totals', 'ForeignTradeScreenController@totals');
Route::get('foreigntrade/country', 'ForeignTradeScreenController@country');
Route::get('foreigntrade/area', 'ForeignTradeScreenController@area');
Route::get('foreigntrade/route', 'ForeignTradeScreenController@route');
Route::get('foreigntrade/category', 'ForeignTradeScreenController@category');
Route::get('foreigntrade/csindex', 'ForeignTradeScreenController@csindex');
Route::get('foreigntrade/qgindex', 'ForeignTradeScreenController@qgindex');


//指数屏幕接口
Route::get('index/neixiaoprice', 'indexScreenController@neixiaoprice');
Route::get('index/neixiaobigcateindex', 'indexScreenController@neixiaobigcateindex');
Route::get('index/manjingqiindex', 'indexScreenController@manjingqiindex');
Route::get('index/manjingqiindexindu', 'indexScreenController@manjingqiindexindu');
Route::get('index/manjingqiindexcate', 'indexScreenController@manjingqiindexcate');
Route::get('index/marketcatesale', 'indexScreenController@marketcatesale');
Route::get('index/onlinesale', 'indexScreenController@onlinesale');
Route::get('index/onlinecate', 'indexScreenController@onlinecate');
Route::get('index/onlinesaledata', 'indexScreenController@onlinesaledata');

//主屏幕
Route::get('middle/total', 'MiddleScreenController@total');
Route::get('middle/marketcate', 'MiddleScreenController@marketcate');
Route::get('middle/towndata', 'MiddleScreenController@towndata');

Route::get('middle/chinamap', 'MiddleScreenController@chinamap');


Route::get('middle/sendlogistics', 'MiddleScreenController@sendlogistics');
Route::get('middle/arrivelogistics', 'MiddleScreenController@arrivelogistics');