<?php
namespace  App\Http\Controllers\Api;
use App\Model\Cmsmodel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class ApiController extends Controller{
    public function userinfo(){
        $data=[];
    }
    public function user_reg(Request $request){
        $data=[];
        //$name=$request=>input
        $name=trim($_POST['uname']);
        $email=trim($_POST['uemail']);
        $res_info=ApiModel::where(['user_name'=>$name])->first();
        $info=[
            'user_name'=>$name,
            'user_email'=>$email,
        ];
        $res=UserModel::insert($info);
        if($res){
            $data=[
                'errno'=>0,
                'msg'=>'注册成功'
            ];
        }else{
            $data=[
                'errno'=>5001,
                'msg'=>'注册失败'
            ];
        }
        return $data;
    }
    public function base64Test(){
        $str= 'Hello World';
        echo base64_encode($str);
    }
    public function Testbase64(Request $request){
        $base64_str=$request->input('b64');
        echo 'Base64: '.$base64_str;echo'</br>';
        echo base64_decode($base64_str);
    }
    public function yse(Request $request){
        $uid=$request->input('uid');
        $user_info=[
            'nickname'=>'zhangsan',
            'email'=>'zhangsan@qq.com'
        ];
        $json_str=json_encode($user_info,JSON_UNESCAPED_UNICODE);
        $b64_str=base64_encode($json_str);
        echo $b64_str;
    }
    public function testCurlPost(){
        $url='http://1809a.test.com/user/yse?id=1';
       /*1*/ $data=[
          'nick_name'=>'lisi',
          'email'=>'lisi@qq.com'
        ];
        /*2*/ $post_str="nick_name=zhangsan&email=zhangsan@qq.com";
        /*3*/$post_json=json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        curl_exec($ch);
        $output = curl_exec($ch);
        echo $output;
//        curl_close($ch);
    }
}