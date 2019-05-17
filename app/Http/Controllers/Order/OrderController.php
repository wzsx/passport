<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderModel;
use App\Model\CartModel;
use App\Model\GoodsModel;
class OrderController extends Controller
{
    public function createOrder(){
        $user_id=$_POST['uid'];
        if(empty($user_id)){
            $data=[
                'errcode'=>4001,
                'msg'=>'请先登录'
            ];
            return $data;
        }
        $goods_id=$_POST['goods_id'];
        $cart_id=$_POST['cart_id'];
        $goods_num=$_POST['goods_num'];
        $total_prices=$_POST['total_prices'];
        $order_num='three'.time();
        $order_data=[
            'order_num'=>$order_num,
            'goods_id'=>$goods_id,
            'uid'=>$user_id,
            'total_prices'=>$total_prices
        ];
        $res=OrderModel::insert($order_data);
        if($res){
            $cart_where=[
                'cart_id'=>$cart_id
            ];
            CartModel::where($cart_where)->update(['is_delete'=>2]);
            $goods_store=GoodsModel::where(['goods_id'=>$goods_id])->value('goods_store');//查询商品库存
            GoodsModel::where(['goods_id'=>$goods_id])->update(['goods_store'=>$goods_store-$goods_num]);//下单减库存
            $res_data=[
                'errcode'=>0,
                'errmsg'=>'下单成功'
            ];
        }else{
            $res_data=[
                'errcode'=>5001,
                'msg'=>'下单失败'
            ];
        }
        return $res_data;
    }
    public function orderShow(){
        $user_id=$_POST['uid'];
        if(empty($user_id)){
            $data=[
                'errcode'=>4001,
                'msg'=>'请先登录'
            ];
            return $data;
        }
        $order_where=[
            'uid'=>$user_id,
            'is_delete'=>1,
        ];
        $order_data=OrderModel::join('api_goods','api_goods.goods_id','=','api_order.goods_id')->where($order_where)->get();
        return $order_data;
    }
}
