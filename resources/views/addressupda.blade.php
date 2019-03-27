<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/writeaddr.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="dist/css/LArea.css">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="#" class="m-index-icon">保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">

</form> -->
<form class="layui-form" action="">
    <div class="addrcon">
        <ul>
            <input type="hidden" value="{{$data[0]->id}}" id="id">
            <li><em>收货人</em><input id="consignee_name" value="{{$data[0]->consignee_name}}" name="consignee_name" type="text" placeholder="请填写真实姓名"></li>
            <li><em>手机号码</em><input id="consignee_tel" value="{{$data[0]->consignee_tel}}" name="consignee_tel" type="number" placeholder="请输入手机号"></li>
            <li><em>所在区域</em><input type="text" value="{{$data[0]->province}}" id="province" name="province" placeholder="请输入省市区"></li>
            <li class="addr-detail"><em>详细地址</em><input value="{{$data[0]->detailed_address}}" type="text" placeholder="20个字以内" id="detailed_address" class="addr"></li>
        </ul>
    </div>
</form>

<!-- SUI mobile -->
<script src="dist/js/LArea.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="layui/layui.js"></script>

<script>
    //Demo
    layui.use(['layer','form'], function(){
        var form = layui.form();
        var layer=layui.layer;
        //监听提交
        $('.m-index-icon').click(function(){
            var consignee_name = $('#consignee_name').val();
            var id = $('#id').val();
            var consignee_tel = $('#consignee_tel').val();
            var province = $('#province').val();
            var detailed_address = $('#detailed_address').val();
            $.ajax({
                url:'writeaddrupd',
                data:{id:id,consignee_name:consignee_name,consignee_tel:consignee_tel,province:province,detailed_address:detailed_address},
                type:'post',
                success:function(msg){
                    if(msg.status==1){
                        layer.msg(msg.msg);
                        location.href="/address";
                    }else{
                        layer.msg(msg.msg);
                    }
                }
            })
        })
    });




</script>


</body>
</html>
