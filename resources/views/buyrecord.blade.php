<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>潮购记录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/buyrecord.css">
   
    
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">潮购记录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="buycart"></i></a>
</div>
<div class="recordwrapp" style="display: none">
    <!--<div class="buyrecord-con clearfix">
        @foreach($res as $k=>$v)
        <div class="record-img fl">
            <img src="{{$v->goods_img}}" alt="">
        </div>
        <div class="record-con fl">
            <h3>(第<i>{{$v->goods_id}}</i>){{$v->goods_name}}</h3>
            <p class="winner">获得者：<i>{{$v->user_id}}</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">{{$v->ctime}}</p>
                    <p class="w-chao">第<i>{{$v->id}}</i>潮正在进行中...</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
        @endforeach
        </div>
    </div>-->
</div>

<div class="nocontent">
    <div class="m_buylist m_get">
        <ul id="ul_list">
            <div class="noRecords colorbbb clearfix">
                <s class="default"></s>您还没有购买商品哦~
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
                                <a href="#">(第<i>{{$v->goods_id}}</i>潮){{$v->goods_name}}</a>
                            </p>
                            <ins class="gray9">价值:￥{{$v->self_price}}</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
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
        </ul>
    </div>
</div>


<script src="js/jquery-1.11.2.min.js"></script>




</body>
</html>
