 <div class="good-list-inner">
                    <div id="pullrefresh" class="good-list-box  mui-content mui-scroll-wrapper">
                        <div class="goodList mui-scroll">
                            <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
                                @foreach($data as $k=>$v)
                                <li id="23468">
                                    <span class="gList_l fl">
                                        <img class="lazy" data-original="{{$v->goods_img}}">
                                    </span>
                                    <div class="gList_r">
                                            <h3 class="gray6">
                                                (第{{$v->goods_id}}云){{$v->goods_name}}
                                            </h3>
                                        <em class="gray9">价值：￥{{$v->market_price}}</em>
                                        <div class="gRate">
                                            <div class="Progress-bar">
                                                <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                </p>
                                                <ul class="Pro-bar-li">
                                                    <li class="P-bar01"><em>{{$v->self_price}}</em>已参与</li>
                                                    <li class="P-bar02"><em>{{$v->goods_score}}</em>总需人次</li>
                                                    <li class="P-bar03"><em>{{$v->goods_num}}</em>剩余</li>
                                                </ul>
                                            </div>
                                            <a codeid="12785750" class="dunp" canbuy="646"><s></s></a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>