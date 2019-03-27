<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
class ShopController extends Controller
{
    //购物车
    public function ShopCart(Request $request){
         $data=DB::table('goods')->paginate(4);
         if(empty(session('id'))){
            $arr = array(
               'status'=>1,
               'msg'=>'请先登录'
            );
            return $arr;
         }else{
            $arr = DB::table('cart')->get();
            if(empty($arr)){
               return view('shopcart',['data'=>$data]);
            }else{
               return view('shopcart',['data'=>$data,'arr'=>$arr]);
            }
         }
    }

    //详情
    public function ShopContent(Request $request){
        $goods_id=$request->input('goods_id');
        $where = [
            'goods_id'=>$goods_id
        ];
        $data=DB::table('goods')->where($where)->first();
        $str = $data->goods_img;
        $var=explode("|",$str);
        return view('shopcontent',['data'=>$data,'var'=>$var]);
    }

    //加入购物车
    public function Cart(Request $request){
     $goods_id=$request->input('goods_id');
     //判断是否登录
     if(empty(session('id'))){
        $arr = array(
           'status'=>0,
           'msg'=>'请先登录'
        );
        return $arr;
     }
     //查看是否有这个商品
     $where = [
        'goods_id'=>$goods_id
     ];
     $data=DB::table('goods')->where($where)->get();
     if(empty($data)){
        $arr = array(
           'status'=>0,
           'msg'=>'此商品已下架',
        );
        return $arr;
     }
     //获取登录手机号
     $user = session('user_tel');
     $where = [
        'user_tel'=>$user
     ];
     $user_id=DB::table('user')->where($where)->select('user_id')->get();
     $data = [
        'user_id'=>$user_id[0]->user_id,
        'goods_id'=>$data['0']->goods_id,
        'goods_name'=>$data['0']->goods_name,
        'market_price'=>$data['0']->market_price,
        'goods_num'=>$data['0']->goods_num,
        'goods_img'=>$data['0']->goods_img
     ];
     $res=DB::table('cart')->where(['goods_name'=>$data['goods_name']])->where(['user_id'=>$user_id[0]->user_id])->get();
     if(empty($res[0]->goods_name)){
        $data_arr = DB::table('cart')->insert($data);
        if($data_arr){
           $arr = array(
              'status'=>1,
              'msg'=>'加入成功,赶快去看看吧!',
           );
           return $arr;
        }else{
           $arr = array(
              'status'=>0,
              'msg'=>'很遗憾主人,商品已经下架了',
           );
           return $arr;
        }
     }else{
        $int = $res[0]->num+1;
        $sznzi = DB::table('cart')->where(['goods_name'=>$data['goods_name']])->update(['num'=>$int]);
        if($sznzi){
           $arr = array(
              'status'=>1,
              'msg'=>'加入成功,赶快去看看吧'
           );
           return $arr;
        }else{
           $arr = array(
              'status'=>0,
              'msg'=>'很遗憾主人,商品已下架'
           );
           return $arr;
        }
     }
    }

    //删除
    public function Delete(Request $request){
     $res=$request->input();
     $where = [
        'goods_id' => $res['id']
     ];
     $res=DB::table('cart')->where($where)->update(['status'=>1]);
     if($res){
        $arr = array(
           'status'=>1,
           'msg'=>'修改成功'
        );
        return $arr;
     }else{
        $arr = array(
           'status'=>0,
           'msg'=>'修改失败'
        );
        return $arr;
     }
    }

    //数量修改
    public function NumUpdate(Request $request){
        $data=$request->input();
        $zhi = $data['zhi'];
        $id = $data['id'];
        $where = [
            'id'=>$id
        ];
        $cart = DB::table('cart')->select('goods_num')->where($where)->get();
        $goods_num=$cart[0]->goods_num;
        $intval=intval($zhi);
        if($intval>$goods_num){
            $intval=$goods_num;
        }
        if($intval<=0){
            $intval=1;
        }
        $update=['num'=>$intval];
        $info = DB::table('cart')->where($where)->update($update);
        if($info){
            return 1;
        }else{
            return 2;
        }
    }

    //全删
    public function Del(Request $request){
        $res=$request->input('id');
        $session=session('id');
        if(empty($session)){
            $arr = array(
                'status'=>0,
                'msg'=>'请先登录'
            );
            return $arr;
        }else{
            $data=DB::table('cart')->where(['id'=>$res])->update(['status'=>1]);
            if($data){
                $arr = array(
                    'status'=>1,
                    'msg'=>'删除成功'
                );
                return $arr;
            }else{
                $arr = array(
                    'status'=>0,
                    'msg'=>'删除失败'
                );
                return $arr;
            }
        }
    }

    //形成订单
    public function PayMent(Request $request){
        if(empty(session('id'))){
            $arr = array(
                'status'=>1,
                'msg'=>'请先登录'
            );
            return $arr;
        }
        $id=$request->input();
        if(empty($id)){
            $arr = array(
                'status'=>1,
                'msg'=>'商品不能为空'
            );
            return $arr;
        }
        $array=cart::join('goods','goods.goods_id','=','cart.goods_id')->whereIn('cart.id',$id)->get()->toArray();
        $name = [];
        $num = [];
        foreach($array as $key=>$value){
            if($value['num']>$value['goods_num']){
                $name[]=$value['goods_num'];
            }
            if($value['is_sell']!=1){
                $num[]=$value['goods_name'];
            }
        }
        $name = implode(',',$name);
        $num = implode(',',$num);
        if($name!=''){
            $arr  =array(
                'status'=>1,
                'msg'=>$name.'亲！您选择的商品库存不足哟'
            );
            return $arr;
        }
        if($num!=''){
            $arr = array(
                'status'=>1,
                'msg'=>$name.'亲！抱歉，暂无货物'
            );
            return $arr;
        }
        $self_price1=$request->input('price');
        $self_price = ltrim($self_price1,'￥');
        $data = date('YmdHis',time()).rand(0,9);
        $user = session('id');
        $order = [
            'user_id'=>$user,
            'order_amount'=>$self_price,
            'ctime'=>time(),
            'order_number'=>$data
        ];
        $orderdata=DB::table('order')->insert($order);
        if(!$orderdata){
            $arr = array(
                'status'=>1,
                'msg'=>'订单添加错误,系统错误,请稍后重试!'
            );
            return $arr;
        }
        $order_id = DB::table('order')->where($order)->select('order_id')->get();
        foreach($array as $key=>$value){
            $order_detail = [
                'user_id'=>$user,
                'order_id'=>$order_id[0]->order_id,
                'goods_id'=>$value['goods_id'],
                'goods_name'=>$value['goods_name'],
                'self_price'=>$value['self_price'],
                'goods_img'=>$value['goods_img'],
                'buy_number'=>$value['num'],
                'ctime'=>time()
            ];
            DB::table('cart')->where(['id'=>$value['id']])->update(['status'=>1]);
            $order_detail = DB::table('order_detail')->insert($order_detail);
        }
        if($order_detail){
            session(['order_id'=>$order_id[0]->order_id]);
            $arr = array(
                'status'=>0,
                'msg'=>$name.'订单生成成功'
            );
            return $arr;
        }else{
            $arr = array(
                'status'=>1,
                'msg'=>$name."订单生成失败"
            );
            return $arr;
        }
    }

    //结算支付
    public function PaymentShow(Request $request){
        $user_id = session('id');
        if(empty($user_id)){
            $arr = array(
                'status'=>1,
                'msg'=>'请登录'
            );
            return $arr;
        }
        $orderdata=DB::table('order_detail')->where(['user_id'=>$user_id])->get();
        $order=DB::table('order')->where(['user_id'=>$user_id])->where(['pay_type'=>1])->select(['order_amount'])->get();
        $int = $order[0]->order_amount;
        return view('payment',['orderdata'=>$orderdata,'int'=>$int]);
    }
}
