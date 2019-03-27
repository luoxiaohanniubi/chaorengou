<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/address.css">
    <link rel="stylesheet" href="css/sm.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="layui/layui.js"></script>
   
    
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="writeaddr" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    @foreach($data as $k=>$v)
    <div class="addr-list">
         <ul>
            <li class="clearfix">
                <span class="fl">{{$v->consignee_name}}</span>
                <span class="fr">{{$v->consignee_tel}}</span>
            </li>
            <li>
                <p>{{$v->province}}</p>
            </li>

            <li class="a-set">
                @if($v->status==1)
                    <span class="z-defalt" style="color:red" id="{{$v->id}}">设为默认</span>
                @else
                    <span class="z-defalt" id="{{$v->id}}">设为默认</span>
                @endif
                <div class="fr">
                    <span class="edit"><a href="addressupdate?id={{$v->id}}">编辑</a></span>
                    <span class="remove" id="{{$v->id}}">删除</span>
                </div>
            </li>
        </ul>
    </div>
    @endforeach
</div>
<script src="js/zepto.js" charset="utf-8"></script>
<script src="js/sm.js"></script>
<script src="js/sm-extend.js"></script>
<!-- 单选 -->
<script>
     // 删除地址
    $(document).on('click','span.remove', function () {
        var buttons1 = [
            {
              text: '删除',
              bold: true,
              color: 'danger',
              onClick: function() {
                $.alert("您确定删除吗？");
              }
            }
          ];
          var buttons2 = [
            {
              text: '取消',
              bg: 'danger'
            }
          ];
          var groups = [buttons1, buttons2];
          $.actions(groups);
    });
</script>
<script src="js/jquery-1.8.3.min.js"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
            // jquery相关代码
            $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){
                    
                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }   
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
            }
        )
    });
</script>
</body>
</html>
<script>
    layui.use(['layer'],function(){
        $(document).on('click','.z-defalt',function(){
            var url = 'addressupd';
            var data = {};
            var id = $(this).prop('id');
            data.id=id;
            $.ajax({
                data:data,
                Type:'POST',
                url:url,
                success:function(msg){
                    if(msg.status==0){
                        layer.msg(msg.msg);
                    }else{
                        layer.msg(msg.msg);
                        location.href="/address";
                    }
                }
            });
        })

        // 删除地址
        $(document).on('click','.remove', function () {
            var buttons1 = [
                {
                    text: '删除',
                    bold: true,
                    color: 'danger',
                    onClick: function() {
                        var url="/addressdel";
                        var data={};
                        var id=$('.remove').prop('id');
                        console.log(id);
                        data.id=id;
                        $.ajax({
                            url:url,
                            data:data,
                            type:'post',
                            dataType:'json',
                            success:function(msg){
                                // console.log(msg);
                                if(msg.status==0){
                                    layer.msg(msg.msg);
                                    location.href="/register";
                                }else{
                                    layer.msg(msg.msg);
                                    location.href="/address";
                                }
                            }
                        })
                    }

                }

            ];
            var buttons2 = [
                {
                    text: '取消',
                    bg: 'danger'
                }
            ];
            var groups = [buttons1, buttons2];
            $.actions(groups);

        });
    })
</script>
