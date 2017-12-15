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
Route::get('index/neixiaoprice', 'IndexScreenController@neixiaoprice');
Route::get('index/neixiaopricetotalindex', 'IndexScreenController@neixiaopricetotalindex');
Route::get('index/neixiaobigcateindex', 'IndexScreenController@neixiaobigcateindex');
Route::get('index/manjingqiindex', 'IndexScreenController@manjingqiindex');
Route::get('index/manjingqiindexindu', 'IndexScreenController@manjingqiindexindu');
Route::get('index/manjingqiindexcate', 'IndexScreenController@manjingqiindexcate');
Route::get('index/marketcatesale', 'IndexScreenController@marketcatesale');
Route::get('index/onlinesale', 'IndexScreenController@onlinesale');
Route::get('index/onlinecate', 'IndexScreenController@onlinecate');
Route::get('index/onlinesaledata', 'IndexScreenController@onlinesaledata');

//主屏幕
Route::get('middle/total', 'MiddleScreenController@total');
Route::get('middle/marketcate', 'MiddleScreenController@marketcate');
Route::get('middle/towndata', 'MiddleScreenController@towndata');
Route::get('middle/bankdata', 'MiddleScreenController@bankdata');
Route::get('middle/chinamap', 'MiddleScreenController@chinamap');
Route::get('middle/sendlogistics', 'MiddleScreenController@sendlogistics');
Route::get('middle/arrivelogistics', 'MiddleScreenController@arrivelogistics');
Route::get('middle/marketsale', 'MiddleScreenController@marketsale');
