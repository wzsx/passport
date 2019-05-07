<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //验证用户token是否存在
        $token =$request->input('token');
        $uid=$request->input('uid');
        //检验参数是否完整
        if(empty($token)||empty($uid)){
            $response=[
              'errno'=>40002,
              'msg'=>'参数不完整'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        //验证token是否有效
        $key='login_token:uid:'.$request->input('uid');
        $local_token =Redis::get($key);
        if($local_token){
            //TODO
            if($token==$local_token){  //token有效
                //TODO 记录日志
                $response=[
                    'errno'=>0,
                    'msg'=>'ok'
                ];
                echo(json_encode($response,JSON_UNESCAPED_UNICODE));
            }else{     //token无效
                $response=[
                    'errno'=>40004,
                    'msg'=>'无效的token'
                ];
                die(json_encode($response,JSON_UNESCAPED_UNICODE));
            }
        }else{
            //TODO 需授权
            $response=[
              'errno'=>40005,
              'msg'=>'请先登录'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }

        return $next($request);
    }
}
