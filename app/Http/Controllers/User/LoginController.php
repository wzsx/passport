<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    //
    public function loginIndex(){
        return view('user.login');
    }
    public function login(Request $request)
    {
        $u=$request->input('u');
        $p=$request->input('p');
        if($u=='admin'&&$p=='admin'){
            setcookie('token',Str::random(6),time()+200,'/','1809a.com',false,true);
            setcookie('uid',999,time()+200,'/','1809a.com',false,true);
            echo "登录成功";
        }else{
            echo '登录失败';
        }
    }
}
