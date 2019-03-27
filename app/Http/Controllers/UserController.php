<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //我的潮购
    public function UserPage(){
    	return view('userpage');
    }

    //收货地址
    public function Address(){
       $user_id=session('id');
       if(empty($user_id)){
           echo '请先登录';
       }
       $data=DB::table('order_address')->where(['user_id'=>$user_id])->get();
       return view('address',['data'=>$data]);
   }

    //地址管理
    public function WriteAddr(){
      return view('writeaddr');
   }

    //地址添加
    public function WriteaddrAdd(Request $request){
        $arr = $request->input();
        $user_id=session('id');
        $order_id=session('order_id');
        if(empty($user_id)){
            $arr=array('status'=>0,'msg'=>'请先登录!');
            return $arr;
        }
        $arr['ctime']=time();
        $arr['user_id']=$user_id;
        $arr['order_id']=$order_id;
        $arr['status']=0;
        $data = DB::table('order_address')->insert($arr);
        if($data){
            $arr=array('status'=>1,'msg'=>'Yes ^_^加入成功!');
            return $arr;
        }else{
            $arr=array('status'=>1,'msg'=>'No o(╥﹏╥)o');
            return $arr;
        }
   }

    //设为默认
    public function AddressUpd(Request $request){
        $id=$request->input('id');
        $user_id=session('id');
        if(empty($user_id)){
            echo '请先登录';die;
        }
        $data = DB::table('order_address')->where('id',$id)->update(['status'=>1]);
        DB::table('order_address')->where('id','!=',$id)->update(['status'=>0]);
        if($data){
            $arr=array('status'=>1,'msg'=>'设为默认成功');
            return $arr;
        }else{
            $arr=array('status'=>0,'msg'=>'系统错误');
            return $arr;
        }
    }

    //删除
    public function AddressDel(Request $request){
        $user_id=session('id');
        if(empty($user_id)){
            $arr=array('status'=>0,'msg'=>'请先登录!');
            return $arr;
        }
        $id = $request->input('id');
        $data = DB::table('order_address')->where('id',$id)->delete();
        if($data){
            $arr=array('status'=>1,'msg'=>'Yes^_^!');
            return $arr;
        }else{
            $arr=array('status'=>0,'msg'=>'No o(╥﹏╥)o');
            return $arr;
        }
    }

    //修改页面展示
    public function AddressUpdate(Request $request){
        $id = $request->input('id');
        $data = DB::table('order_address')->where('id',$id)->get();
        return view('addressupda',['data'=>$data]);
    }

    //修改
    public function writeaddrupd(Request $request){
        $arr = $request->input();
        $id=$arr['id'];
        $data['consignee_name']=$arr['consignee_name'];
        $data['consignee_tel']=$arr['consignee_tel'];
        $data['province']=$arr['province'];
        $data['detailed_address']=$arr['detailed_address'];
        $info = DB::table('order_address')->where('id',$id)->update($data);
        if($info){
            $arr=array('status'=>1,'msg'=>'Yes');
            return $arr;
        }else{
            $arr=array('status'=>0,'msg'=>'No');
            return $arr;
        }
    }

    //潮购记录
    public function Buyrecord(Request $request){
        $user_id=session('id');
        $res=DB::table('order_detail')->where(['user_id'=>$user_id])->get();
        $data=DB::table('goods')->paginate(4);
        return view('buyrecord',['data'=>$data,'res'=>$res]);
    }
}
