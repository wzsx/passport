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
Route::get('/userinfo','Api\ApiController@userinfo');   //商品数据接口
Route::post('/user/reg','Api\ApiController@user_reg');
Route::get('/user/yse','Api\ApiController@yse');
//Route::post('/user/yse','Api\ApiController@yse');
Route::post('/user/reg','Api\ApiController@user_reg');
Route::post('/user/bbs','Api\ApiController@Testbase64');
Route::get('/user/bbk','Api\ApiController@base64Test');
Route::post('/user/curl','Curl\CurlController@testCurlPost');
Route::post('/user/curl1','Curl\CurlController@testCurlPost1');//form-data
Route::post('/user/curl2','Curl\CurlController@testCurlPost2'); //application/x-www-form-urlencoded
Route::post('/user/curl3','Curl\CurlController@testCurlPost3');//josn
Route::get('/user/time','Curl\CurlController@times')->middleware('request10times');

Route::post('/user/reg','User\UserController@reg');
Route::post('/user/login','User\UserController@login');

//个人中心
Route::get('/user/count','User\UserController@count')->middleware('check.login','request10times');

//资源路由
Route::resource('/goods',GoodsController::class);