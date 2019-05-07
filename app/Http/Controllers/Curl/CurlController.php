<?php
namespace  App\Http\Controllers\Curl;
use App\Model\Cmsmodel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class CurlController extends Controller{
    public function testCurlPost(){
        $url='http://1809a.test.com/user/curl';
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
//        curl_exec($ch);
        $output = curl_exec($ch);
        echo $output;
//        curl_close($ch);
    }
    public function testCurlPost1()  //form-data
    {
        $url='http://1809a.test.com/user/curl';
         $data=[
            'nick_name'=>'lisi',
            'email'=>'lisi@qq.com'
        ];
//        print_r($data);die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        echo $output;
    }
    public function testCurlPost2() //application/x-www-form-urlencoded
    {
        $url='http://1809a.test.com/user/curl';
        $post_str="nick_name=zhangsan&email=zhangsan@qq.com";
//        print_r($post_str);die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        $output = curl_exec($ch);
        echo $output;
    }
    public function testCurlPost3() //raw
    {
        $url='http://1809a.test.com/user/curl';
        $data=[
            'nick_name'=>'lisi',
            'email'=>'lisi@qq.com'
        ];
        $post_json=json_encode($data);
//        var_dump($post_json);die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $output = curl_exec($ch);
        echo $output;
    }
    public function times(){
        echo __METHOD__;
    }
}