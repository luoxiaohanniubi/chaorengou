<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AllsController extends Controller
{
   //所有商品
   public function AllShops(){
   		$res=DB::table('category')->where(['pid'=>0])->get();
   		$data=DB::table('goods')->get();
    	return view('allshops',['res'=>$res,'data'=>$data]);
   }

   //分类查询
	public function Category(Request $return)
    {
		$cate_id = $return->input('cate_id');
		$this->get($cate_id);
		$arr=array_filter(self::$arrCate);
		$data=DB::table('goods')->where('cate_id',$arr)->get();
        return view('categround',['data'=>$data]);
	}

	//递归循环
    protected static $arrCate;
    private function Get($id)
    {
        $cate=DB::table('category')->select('cate_id')->where('pid',$id)->get();
        if(count($cate)!=0){
            foreach($cate as $k=>$v){
                $cate_id=$v->cate_id;
                $id=$this->get($cate_id);
                self::$arrCate[]=$id;
            }
  	}
  	if(count($cate)==0){
  		return $id;
  	}
  }

   //搜索
   public function Sicon(Request $request)
   {
        $info=$request->input();
        $where = [];
        if(!empty($info['txtSearch'])){
            $where = ['goods_name'=>$info['txtSearch']];
        }
        $data=DB::table('goods')->where($where)->get();
        return view('sicon',['data'=>$data]);
  }
}
