<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redis;
use Closure;

class Request10times
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
//        $key='request10times';
        $key='request10times:ip:'.$_SERVER['REMOTE_ADDR'].':token:'.$request->input('token');
        $num=Redis::get($key);
        if($num>10){   //超过限制
            //die('请求次数超过10次');
            $response=[
                'errno'=>50020,
                'msg'=>'请求受限'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        };
        Redis::incr($key);
        Redis::expire($key,5);
        echo $num;echo'</br>';
//        echo date('Y-m-d H:i:s');echo'<hr>';
        return $next($request);
    }
}
