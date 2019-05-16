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

Route::get('/user/login', 'User\LoginController@loginIndex');
Route::post('/userinfo','User\LoginController@login');   //用户登录


Route::post('/reg','Api\UserController@register');  //app注册
Route::post('/login','Api\UserController@login');  //app登录
Route::post('/center','Api\UserController@center');  //app个人中心