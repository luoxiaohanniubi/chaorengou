<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('phpinfo','IndexController@PhpInfo');
//项目首页
Route::any('/',"IndexController@Index");
//商品列表
Route::any('allshops',"AllsController@AllShops");
//购物车
Route::any('shopcart',"ShopController@ShopCart");
//购物车
Route::any('delete','ShopController@Delete');
//我的潮购
Route::any('userpage','UserController@UserPage');
//收货地址
Route::any('address','UserController@Address');
//注册页面
Route::any('register','RegisterController@register');
//注册
Route::any('registershow','RegisterController@RegisterShow');
//登录页面
Route::any('login','RegisterController@Login');
//登录
Route::any('loginAdd','RegisterController@LoginAdd');
//商品详情
Route::any('shopcontent','ShopController@ShopContent');
//分类查询
Route::any('category','AllsController@Category');
//商品搜索
Route::any('sicon','AllsController@Sicon');
//加入购物车
Route::any('cart','ShopController@Cart');
//人气
Route::any('dau','AllsController@Dau');
//验证码
Route::any('create','CaptchaController@Create');
//手机短信
Route::any('doregister','RegisterController@Doregister');
//发送手机短信
Route::any('telcode','RegisterController@TelCode');
//数量修改
Route::any('numupdate','ShopController@NumUpdate');
//全删
Route::any('del','ShopController@Del');
//形成订单
Route::any('payment','ShopController@PayMent');
//收货管理
Route::any('writeaddr','UserController@WriteAddr');
//结算支付
Route::any('paymentshow','ShopController@PaymentShow');
//收货地址添加
Route::any('writeaddradd','UserController@WriteaddrAdd');
//收货地址设为默认
Route::any('addressupd','UserController@AddressUpd');
//删除
Route::any('addressdel','UserController@AddressDel');
//修改
Route::any('addressupdate','UserController@AddressUpdate');
//修改成功
Route::any('writeaddrupd','UserController@WriteaddrUpd');
//潮购记录
Route::any('buyrecord','UserController@Buyrecord');




//手机支付
Route::any('mobilepay','AlipayController@mobilepay');
Route::any('returns','AlipayController@returns');
Route::any('notify','AlipayController@notify');