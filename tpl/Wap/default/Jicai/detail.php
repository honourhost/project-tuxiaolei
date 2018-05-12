<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>农丁集采-详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telphone=no, email=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static/css/groupbuy/newtuan.css" />
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static/js/groupbuy/hhSwipe.js"></script>
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static/js/groupbuy/jquery-1.9.1.min.js"></script>

    <!-- add -->
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static//jicai/css/tuan.css" />
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static//jicai/css/common22.css" media="all">
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static//jicai/css/color22.css" media="all">
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static//jicai/js/dmain2.js"></script>
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static//jicai/js/menu2.js"></script>
    <script>
        var islock = false;

        function next() {
            totalPrice = parseFloat($.trim($('#allmoney').text()));
            totalNum = parseInt($.trim($('#menucount').text()));
            if ((totalNum > 0) && (totalPrice > 0)) {
                var data = getMenuChecklist();//[{'id':id,'count':count},{'id':id,'count':count}]
                if ((data.length > 0) && !islock) {
                    islock = true;
                    $('#nextstep').removeClass('orange show').addClass('gray disabled');
                    $.ajax({
                        type: "POST",
                        url: "{pigcms{:U('Jicai/processOrder', array('mer_id' => $mer_id))}",
                        data: {"cart": data},
                        async: true,
                        success: function (res) {
                            islock = false;
                            $('#nextstep').removeClass('gray disabled').addClass('orange show');
                            if (res.error == 0) {
                                window.location.href = "{pigcms{:U('Jicai/sureorder', array('mer_id' => $mer_id))}";
                            } else {
                                alert(res.msg);
                            }
                        },
                        dataType: "json"
                    });
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

    </script>
    <style>
        .list-cons {
            padding-bottom: 0;
            padding: 10px 0px;
            margin-top: 10px;
        }

        .all ul li {
            margin-bottom: 0;
            border-bottom: 0;
        }
    </style>
    <!-- add end -->
</head>

<body>

<div class="public-cen">
    <!-- 轮播图 -->
    <div class="slide">
        <div id="iswipe"></div>
    </div>
    <!-- 价格、销量 -->
    <div class="details-ow">
        <div class="details-title">
            {pigcms{$jicai.name} </div>
        <p class="details-con">{pigcms{$jicai.s_name}</p>
        <div class="details-price" style=" display:none;">
            <span>累计销量：{pigcms{$jicai.sale_count}件</span>
            <b>&yen;{pigcms{$jicai.price}<del>&yen;{pigcms{$jicai.old_price}</del></b>
        </div>
        <div class="details-price">
            <b><h3><em style="color: #00bca3;">&yen;</em>{pigcms{$jicai.price}</h3></b>

            <p>单买价<del>&yen;{pigcms{$jicai.old_price}</del></p>

        </div>

        <!-- 发起团购 -->
        <div class="details-faqi">

        </div>
        <!-- 发起团购 end-->
        <!-- 店铺、进店逛逛 -->

    </div>


    <!-- add -->
    <div class="tab-panel" id="cpxq">
        <div class="all" id="menuList">
            <ul id="ul_type284">

                <li id="dish_li12">
                    <div class="cen">
                        <div class="list-imgs shop-img" style="background-image: url({pigcms{$jicai.pic});">
                            <input type="hidden" class="goodprice" value="{pigcms{$jicai.price}">
                            <input type="hidden" class="goodname" value="{pigcms{$jicai.name}">
                            <input type="hidden" class="gooddigest" value="{pigcms{$jicai.s_name}">
                            <input type="hidden" class="goodimage" value="{pigcms{$jicai.pic}">
                        </div>
                        <div class="list-cons">
                            <div class="left-right">

                                <h5 class="list-imgs">{pigcms{$jicai.name} <input type="hidden"
                                                                                  class="goodprice"
                                                                                  value="{pigcms{$jicai.price}">
                                    <input type="hidden" class="goodname"
                                           value="{pigcms{$jicai.name}">
                                    <input type="hidden" class="gooddigest"
                                           value="{pigcms{$jicai.s_name}">
                                    <input type="hidden" class="goodimage"
                                           value="http://www.xiaonongding.com/upload/group/000/001/137/s_5a0e88514ade4.jpg"></h5>
                                <p>{pigcms{$jicai.name}</p>
                                <div class="price_wrap">
                                    <strong><span
                                                class="unit_price">&yen;{pigcms{$jicai.price}                                                <input
                                                    type="hidden" class="tureunit_price"
                                                    value="{pigcms{$jicai.price}"></span>
                                        <del>&yen;{pigcms{$jicai.old_price}</del>
                                    </strong>
                                    <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$jicai.group_id}">
                                    <div class="price_wrap2">
                                        <div class="fr" max="-1">
                                            <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                        </div>
                                        <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$jicai.group_id}]" value="0">
                                    </div>

                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <!-- add end -->


    <div class="detais-dian">
        <a href="/wap.php?g=Wap&c=Jicai&a=test&mer_id=1137"><span><img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/icon-dian.png" />进店逛逛</span></a>
        <div class="details-shop">
            <img src="{pigcms{$merchant.pic}" />
            <h3>{pigcms{$merchant.name}</h3>
        </div>
        <div style="clear: both;"></div>
    </div>
    <!-- 产品详情内容 -->
    <style>
        .details-banner {
            width: 100%;
        }

        .details-banner img {
            width: 100%;
        }

        .details-tishi {
            line-height: 25px;
            padding: 10px;
            color: #bfbfbf;
        }

        .details-tishi span {
            color: #f19325;
        }
    </style>
    <div class="details-content">
        <div class="details-banner">
            <div class="details-tishi">
                {pigcms{$jicai.content}
            </div>
        </div>
    </div>

    <div class="cai">
        <h3 class="cai-title">你可能会喜欢</h3>
        <ul>
            <volist name="youlikes"  id="youlike">
                <li>
                    <a href="/wap.php?g=Wap&c=Jicai&a=detail&groupid={pigcms{$youlike.group_id}">
                        <div class="car-img" style="background-image: url({pigcms{$youlike.pic})"></div>
                        <h3>{pigcms{$youlike.name}</h3>
                        <div class="car-price">
                            <b>&yen;{pigcms{$youlike.price}</b>
                        </div>
                    </a>
                </li>
            </volist>

        </ul>
        <div style=" clear: both;"></div>
    </div>
    <div class="footer-don">
        <span></span>
        <p>已经到底部了</p>
    </div>
    <div style="width: 100%; height: 60px;"></div>

</div>
<footer data-role="footer">
    <nav class="g_nav">
        <div>
            <span class="cart"></span>
            <span> <span class="money">￥<label id="allmoney">0</label> </span>/<label id="menucount">0</label>个商品</span>
            <a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
        </div>
    </nav>
</footer>
</body>
<!-- 右侧返点顶部 -->
<div class="top-tz">
    <a href="/wap.php?g=Wap&c=My&a=jicai_buy_list"><span style="background-image: url(http://www.xiaonongding.com/tpl/Wap/default/static/img/go_my.png); margin-bottom: 10px;">我的</span></a>
    <a href="#"><span style="background-image: url(http://www.xiaonongding.com/tpl/Wap/default/static/img/go_top.png);">顶部</span></a>
</div>
<script id="swipe" type="text/tmpl">

<div class="addWrap">
    <div class="swipe" id="mySwipe">
        <div class="swipe-wrap">
            <div>
                <a href="javascript:;"><img class="img-responsive" src="{pigcms{$jicai.pic}" /></a>
            </div>
        </div>
    </div>
    <ul id="position">
        <li class="cur"></li>


    </ul>
</div>
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#iswipe").html($('#swipe').html());
        var bullets = document.getElementById('position').getElementsByTagName('li');
        var banner = Swipe(document.getElementById('mySwipe'), {
            auto: 1000,
            continuous: true,
            disableScroll: false,
            callback: function(pos) {
                var i = bullets.length;
                while(i--) {
                    bullets[i].className = ' ';
                }
                if(pos <= bullets.length) {
                    bullets[pos].className = 'cur';
                }
            }
        })
        //$('.drawer').drawer();
    });



</script>
<script type="text/javascript">
    var shareData = {
        imgUrl: "{pigcms{$jicai.pic}",
        link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Jicai&a=detail&groupid={pigcms{$jicai.group_id}",
        title: '{pigcms{$jicai.name}',
        desc: '{pigcms{$jicai.s_name}'
    };
</script>

<include file="Share:share"/>

</html>