<?php

namespace App\Http\Controllers;
use App\extend\send\Send;
use Illuminate\Http\Request;
use App\Common;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{
    //注册页面
    public function Register()
    {
    	return view('register');
    }

    //注册入库
    public function RegisterShow(Request $request)
    {
        $arr = $request->input();
        $code=$arr['code'];
        if(empty($code)){
            $error=array(
                'status'=>0,
                'msg'=>'验证码不可为空'
            );
            return $error;
        }
        // print_r($arr);die;
        $codedata = DB::table('enroll')->where(['tel'=>$arr['tel']])->where(['code'=>$arr['code']])->first();
        if($codedata){
            if($codedata->status==0){
                if(60<=time()-$codedata->time){
                    $error=array(
                        'status'=>0,
                        'msg'=>'验证码不可用'
                    );
                    return $error;
                }else{
                    if(empty($arr['pass'])){
                        $error = array(
                            'status'=>0,
                            'msg'=>"密码不可为空"
                        );
                        return $error;
                    }

                    if(empty($arr['pass2'])){
                        $error=array(
                            'status'=>0,
                            'msg'=>"确认密码不可为空"
                        );
                        return $error;
                    }

                    if($arr['pass']!=$arr['pass2']){
                        $error=array(
                            'status'=>0,
                            'msg'=>"您的两次密码不一致！"
                        );
                        return $error;
                    }

                    $where=['user_tel'=>$arr['tel']];
                    $user_tel = DB::table('user')->where($where)->first();
                    if($user_tel){
                        $error=array(
                            'status'=>0,
                            'msg'=>"您的手机号已注册"
                        );
                        return $error;
                    }
                    
                    $user_tel = $arr['tel'];
                    $pwd = $arr['pass'];
                    $user_pwd = md5($pwd);
                    $insert=['user_tel'=>$user_tel,'user_pwd'=>$user_pwd];
                    $info = DB::table('user')->insert($insert);
                    if($info){
                        DB::table('enroll')->where(['id'=>$codedata->id])->update(['status'=>1]);
                        $win=array(
                            'status'=>1,
                            'msg'=>"注册成功"
                        );
                        return $win;
                    }else{
                        $win=array(
                            'status'=>0,
                            'msg'=>"注册失败"
                        );
                        return $win;
                    }
                }   
            }else{
                $error=array(
                    'status'=>0,
                    'msg'=>'手机号或验证码错误o(╥﹏╥)o'
                );
                return $error;
            }
        }else{
            $error=array(
                'status'=>0,
                'msg'=>'手机号或验证码错误o(╥﹏╥)o'
            );
            return $error;
        }
    }

    //短信发送
    public function TelCode(Request $request)
   {
        $obj = new Send();
        $arr=$request->input();
        $tel=$arr['userMobile'];
        if(empty($tel)){
            $error=array(
                'status'=>0,
                'msg'=>'手机号不可为空',
            );
            return $error;
        }
        $num = rand(1000,9999);
        $time=time()+60;
        $data['tel']=$tel;
        $data['time']=$time;
        $data['code']=$num;
        $codedata = DB::table('enroll')->where(['tel'=>$data['tel'],'status'=>1])->first();
        if(!empty($codedata)){
            $error=array(
                'status'=>0,
                'msg'=>'您的手机号已注册',
            );
            return $error;
        }
        /*if($obj->show($data['tel'],$data['code'])!=30){
            $error=array(
                'status'=>0,
                'msg'=>'系统错误',
            );
            return $error;
        }*/
        $telcode = DB::table('enroll')->insert($data);
        if($telcode){
            $error=array(
                'status'=>1,
                'msg'=>'短信发送成功',
            );
            return $error;
        }else{
            $error=array(
                'status'=>0,
                'msg'=>'短信发送失败',
            );
            return $error;
        }
    }

    //登录
    public function Login()
    {
    	return view('login');
    }

    //测试
    public function Doregister(Request $request)
    {
        //$mobile = $request->mobile;
        $this->sendMobile($mobile=17631001644);
    }

    //发送手机验证码
    private function sendMobile($mobile)
    {
        //$host = "https://cdcxdxjk.market.alicloudapi.com";
        $host = env('MOBILE_HOST');
        $path = env('MOBILE_PATH');
        $method = "POST";
        $appcode = env('MOBILE_APPCODE');
        $headers = array();
        $code = Common::createcode(5);
        echo $code;die;
        session(['mobilecode'=>$code]);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }

    //登录添加
    public function LoginAdd(Request $request)
    {
    	$data=$request->input();
            session('codeurl');
        if($data['verifcode']!=session('codeurl')){
            $arr = array(
                'status'=>1,
                'msg'=>'验证码错误,请重新输入'
            );
            return $arr;
        }
    	$user_tel = $data['tel'];
    	$pwd = $data['pwd'];
    	$user_pwd = md5($pwd);
    	$where = [
    		'user_tel'=>$user_tel,
    		'user_pwd'=>$user_pwd
    	];
    	$res=DB::table('user')->where($where)->first();
    	if($res){
    		session(['id'=>$res->user_id,'user_tel'=>$user_tel]);
    		$arr = array(
                'status'=>0,
                'msg'=>'登录成功'
            );
            return $arr;
    	}else{
    		$arr = array(
                'status'=>1,
                'msg'=>'登录失败,账号或密码错误'
            );
            return $arr;
    	}

    }
}
