<?php
namespace  App\Http\Controllers\User;
use App\Model\ApiModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class UserController extends Controller{
    public function reg(Request $request){
        $pass1=$request->input('pass1');
        $pass2=$request->input('pass2');
        $email=$request->input('email');
        if($pass1!=$pass2){
            $response=[
              'errno'=>50002,
              'msg'=>'两次输入的密码不一致'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        $e=ApiModel::where(['email'=>$email])->first();
        if($e){
            $response=[
                'errno'=>50004,
                'msg'=>'Email已存在'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        //密码加密处理
        $pass=password_hash($pass1,PASSWORD_BCRYPT);
        $data=[
            'name'=>$request->input('name'),
            'email'=>$email,
            'pass'=>$pass,
            'age'=>$request->input('age'),
        ];
        $uid=ApiModel::insertGetId($data);
        if($uid){
            //TODO
            $response=[
                'errno'=>0,
                'msg'=>'注册成功'
            ];
        }else{
            //TODO
            $response=[
                'errno'=>50003,
                'msg'=>'注册用户失败'
            ];
        }
        die(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
    public function login(Request $request){
        $email=$request->input('email');
        $pass=$request->input('pass');
        $u=ApiModel::where(['email'=>$email])->first();
        if($u){      //用户存在
            if(password_verify($pass,$u->pass)){  //验证密码
                //TODO 登录逻辑
                $token=$this->generateLoginToken($u->uid);
                $redis_token_key='login_token:uid:'.$u->uid;
                Redis::set($redis_token_key,$token);
                Redis::expire($redis_token_key,604800);
                //生成token
                $response=[
                    'errno'=>0,
                    'msg'=>'ok',
                    'data'=>[
                        'token'=>$token
                    ]
                ];
            }else{
                //TODO 登录失败
                $response=[
                  'errno'=>50010,
                  'msg'=>'密码不正确'
                ];
            }
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }else{       //用户不存在
            $response=[
                'errno'=>50011,
                'msg'=>'用户不存在'
            ];
        }
        die(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
    protected function generateLoginToken($uid){
        return substr(sha1($uid.time().Str::random(10)),5,15);
    }
    public function count(){
        echo __METHOD__;
    }
}