<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/cartlist.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
    <script src="layui/layui.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
</head>
<body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="login" class="m-index-icon">退出</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
            @foreach($arr as $k=>$v)
                @if($v->status==0)
                <li>
                    <s class="xuan current" id="{{$v->id}}"></s>
                    <a class="fl u-Cart-img" href="/v44/product/12501977.do">
                        <img src="{{$v->goods_img}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="/v44/product/12501977.do" class="gray6">(已更新至第338潮){{$v->goods_name}}</a>
                        <span class="gray9">
                            <em>剩余{{$v->goods_num}}人次</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min" id="{{$v->id}}"><i></i></em>
                            <input class="text_box" id="{{$v->id}}" name="num" maxlength="6" type="text" value="{{$v->num}}" price="{{$v->market_price}}" >
                            <em class="num-add add" id="{{$v->id}}"><i></i></em>
                        </div>
                        <a href="javascript:;" name="delLink" id="dellink" goods_id={{$v->goods_id}} cid="12501977" isover="0" class="z-del"><s></s></a>
                    </div>    
                </li>
                @endif
            @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn del w_account remove">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn pay w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>购买推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                @foreach($data as $k=>$v)
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="{{$v->goods_img}}" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>{{$v->goods_id}}</i>潮){{$v->goods_name}}</a>
                        </p>
                        <ins class="gray9">价值:￥{{$v->market_price}}</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:{{$v->goods_num}}%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

       
        

<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="{{url('allshops')}}" ><i></i>全部商品</a></li>
        <li "><a href="/v41/post/index.do" ><i></i>  {{--最新揭晓class="f_single--}}</a></li>
        <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" class="hover"><i></i>购物车</a></li>
        <li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<!---商品加减算总数---->
    <script type="text/javascript">
    $(function () {
        $(".add").click(function () {
            var t = $(this).prev();
            t.val(parseInt(t.val()) + 1);
            GetCount();
        })
        $(".min").click(function () {
            var t = $(this).next();
            if(t.val()>1){
                t.val(parseInt(t.val()) - 1);
                GetCount();
            }
        })
    })
    </script>



    
    <script>

    // 全选        
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

             $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current"); 
                } else {
                    $(this).addClass("current");
                } 
            });
            GetCount();
        }else{
            $(this).addClass('current');

             $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }
        
        
    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            

            $(this).removeClass('current');

        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
        // $("#total2").html() = GetCount($(this));
        GetCount();
        //alert(conts);
    });
  // 已选中的总额
    function GetCount() {
        var conts = 0;
        var aa = 0; 
        $(".g-Cart-list .xuan").each(function () {
            if ($(this).hasClass("current")) {
                for (var i = 0; i < $(this).length; i++) {
                    conts += parseInt($(this).parents('li').find('input.text_box').val())*$(this).parents('li').find('input.text_box').attr('price');
                    // aa += 1;
                }
            }
        });
        
         $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();
</script>
</body>
</html>
<script>
    $(function(){
        layui.use(['layer'],function(){
            //删除
             $('#dellink').click(function(){
                var data = {};
                var id = $(this).attr('goods_id');
                data.id = id;
                $.ajax({
                    data:data,
                    Type:'POST',
                    url:'delete',
                    success:function(msg){
                        if(msg.status==1){
                            layer.msg(msg.msg);
                            location.href='shopcart';
                        }else{
                            layer.msg(msg.msg);
                        }
                    }
                });
            })

            //加
            $('.num-add').click(function(){
                var data = {};
                var zhi = $(this).prev().val();
                var id = $(this).attr('id');
                data.id = id;
                data.zhi = zhi;
                var url = "numupdate";
                $.ajax({
                    data:data,
                    url:url,
                    Type:'POST',
                    success:function(msg){
                        if(msg==2){
                            layer.msg('很遗憾,库存不足');
                            location.href="/shopcart";
                        }
                    }
                });
            })

            //减
            $('.num-mius').click(function(){
                var data = {};
                var zhi = $(this).next().val();
                var id = $(this).attr('id');
                data.id = id;
                data.zhi = zhi;
                var url = "numupdate";
                $.ajax({
                    data:data,
                    url:url,
                    Type:'POST',
                    success:function(msg){
                        if(msg==2){
                            layer.msg('很遗憾,库存不足');
                            location.href="/shopcart";
                        }
                    }
                });
            });

            //数据改变
            $('.text_box').change(function(){
                var data = {};
                var zhi = $(this).val();
                var id = $(this).attr('id');
                data.zhi=zhi;
                data.id=id;
                var url = 'numupdate';
                $.ajax({
                    data:data,
                    Type:'POST',
                    url:url,
                    success:function(msg){
                        if(msg==2){
                            layer.msg('很遗憾,库存不足');
                            location.href="/shopcart";
                        }
                    }
                });
            })

            //全删
            $('.del').click(function(){
                var id = [];
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        for (var i = 0; i < $(this).length; i++) {
                            id.push($(this).attr('id'));
                        }
                    }
                });
                var data = {};
                data.id=id;
                $.ajax({
                    data:data,
                    url:'del',
                    Type:'POST',
                    success:function(msg){
                        if(msg.status==1){
                            layer.msg(msg.msg);
                            location.href="/shopcart";
                        }else{
                            layer.msg(msg.msg);
                        }
                    }
                });
            })

            //结算
            $('.pay').click(function(){
                var id = [];
                $(".xuan.current").each(function () {
                    id.push($(this).attr('id'));
                });
                var price = $('.orange.total').text();
                var data={};
                data.id=id;
                data.price=price;
                $.ajax({
                    url:'payment',
                    type:'post',
                    data:data,
                    success:function(msg){
                       if(msg.status==1){
                            layer.msg(msg.msg);
                        }else{
                            layer.msg(msg.msg);
                            location.href="/paymentshow";
                        }
                    }
                })
            })
        })
    })
</script>
