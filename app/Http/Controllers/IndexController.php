<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    //潮购首页
   public function Index(){
      $data=DB::table('goods')->where(['is_new'=>1])->paginate(2);
      $info=DB::table('goods')->where(['is_best'=>1])->get();
      $user_id=session('id');
      $user=DB::table('cart')->where(['user_id'=>$user_id])->get();
      return view('index',['data'=>$data,'info'=>$info,'user'=>$user]);
   }
   //php配置
    public function PhpInfo(){
       echo phpinfo();
    }
}
