<?php

namespace App\Http\Controllers\Login;

use App\Functions\LogAction;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function login(Request $request){
        if (!empty($request->session()->get('user'))){
            return redirect()->route('index');
        }
        return view('Login/index');
    }
    public function verification(Request $request){
        //接收值
        $username = $request->input('username');
        $password = $request->input('password');
        $captcha = $request->input('captcha');
        $user = new User();
        //判断登录
        $value = captcha_check($captcha);
        if(!$value){
            return ['msg'=>'验证码错误','static'=>"0",'error'=>false];
        }
        $content = $user->where('username',$username)->first();
        if (is_null($content)) {
            return ['msg'=>'账号或密码错误','static'=>"1",'error'=>false];
        }
        if (!Hash::check($password,$content->password)) {
            return ['msg' => '账号或密码错误', 'static' => "2", 'error' => false];
        }
        $data=[
            'username'   =>$content->username,
            'user_id'    =>$content->user_id,
            'prevTime'   =>$content->updated_at,
            'prevIp'     =>$content->salt,
            'prevCity'   =>$this->getIpArea($content->salt),
            'nowTime'    =>date('Y-m-d H:i:s'),
            'nowIp'      =>request()->ip()
        ];
        //储存session
        $request->session()->put( 'user',$data );
        $a['salt'] =$_SERVER["REMOTE_ADDR"];
        $user->where('username',$username)->update($a);
        //记录日志
        LogAction::logAction('用户【'.$username.'】登录成功');
        //登录跳转
        return ['msg'=>'登录成功，正在跳转！！！！','error'=>true,'url'=>'index'];
    }
    public function quit(Request $request){
        LogAction::logAction('退出登录');
        $request->session()->flush();
        return redirect()->route('login');
    }
    public function getIpArea($ip,$format=true){
        $requestAddress = 'http://ip.taobao.com/service/getIpInfo.php?ip=';
        $arr = LogAction::get($requestAddress.$ip,'array');
        if ($arr['code']!=0){
            return false;
        }
        $address = '';
        if ($format){
            $address .= $arr['data']['country'];
            $address .= $arr['data']['area'];
            $address .= $arr['data']['region'];
            $address .= $arr['data']['city'];
            $address .= $arr['data']['isp'];
            return $address;
        }
        return $arr;
    }
    function getIp(){
        $onlineip='';
        if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
            $onlineip=getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
            $onlineip=getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
            $onlineip=getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
            $onlineip=$_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
}
