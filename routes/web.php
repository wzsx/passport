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
Route::post('/goods/list','Goods\GoodsController@goods');   //商品列表
Route::post('/goods/salenum','Goods\GoodsController@salevalue');
Route::post('/goods/details','Goods\GoodsController@details');
Route::post('/user/cart','Cart\CartController@cartShow');//购物车数据接口
Route::post('/cart/join','Cart\CartController@cartJoin');//添加到购物车
Route::post('/order/add','Order\OrderController@createOrder');//生成(添加)订单数据接口