<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/common22.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/color22.css" media="all">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}vip/layer.js"></script>
    <title>商品兑换</title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"
          name="viewport">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <!-- Mobile Devices Support @begin -->
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Mobile Devices Support @end -->
</head>
<style type="text/css">
    #dingcai_adress_info {
        border-top: 1px solid #ddd8ce;
        border-bottom: 1px solid #ddd8ce;
        position: relative;
    }

    #dingcai_adress_info:after {
        position: absolute;
        right: 8px;
        top: 50%;
        display: block;
        content: '';
        width: 13px;
        height: 13px;
        border-left: 3px solid #999;
        border-bottom: 3px solid #999;
        -webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
    }

    #enter_im_div {
        bottom: 121px;
        z-index: 11;
        display: none;
        position: fixed;
        width: 100%;
        max-width: 640px;
        height: 1px;
    }

    #enter_im {
        width: 94px;
        margin-left: 110px;
        position: relative;
        left: -100px;
        display: block;
    }

    a {
        color: #323232;
        outline-style: none;
        text-decoration: none;
    }

    #to_user_list {
        height: 30px;
        padding: 7px 6px 8px 8px;
        background-color: #00bc06;
        border-radius: 25px;
        /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
    }

    #to_user_list_icon_div {
        width: 20px;
        height: 16px;
        background-color: #fff;
        border-radius: 10px;
    }

    .rel {
        position: relative;
    }

    .left {
        float: left;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    #to_user_list_icon_em_num {
        background-color: #f00;
    }

    #to_user_list_icon_em_num {
        width: 14px;
        height: 14px;
        border-radius: 7px;
        text-align: center;
        font-size: 12px;
        line-height: 14px;
        color: #fff;
        top: -14px;
        left: 68px;
    }

    .hide {
        display: none;
    }

    .abs {
        position: absolute;
    }

    .to_user_list_icon_em_a,
    .to_user_list_icon_em_b,
    .to_user_list_icon_em_c {
        width: 2px;
        height: 2px;
        border-radius: 1px;
        top: 7px;
        background-color: #00ba0a;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    .to_user_list_icon_em_b {
        left: 9px;
    }

    .to_user_list_icon_em_c {
        right: 4px;
    }

    .to_user_list_icon_em_d {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 4px;
        top: 14px;
        left: 6px;
        border-color: #fff transparent transparent transparent;
    }

    #to_user_list_txt {
        color: #fff;
        font-size: 13px;
        line-height: 16px;
        padding: 1px 3px 0 5px;
    }

    .all ul {
        margin-bottom: 20px;
        width: 100%;
        margin: 0px auto;
    }

    .all ul li {
        background: #fff;
        margin-bottom: 15px;
        border-bottom: 1px solid #f1f1f1;
    }

    .cen {
        width: 92%;
        margin: 0px auto;
    }

    .target-fix2 {
        position: relative;
        top: -44px;
        display: block;
        height: 0;
        overflow: hidden;
    }
</style>

<script type="text/javascript" src="{pigcms{$static_path}/vip/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dmain2.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/menu2.js"></script>

<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">

    var islock = false;

    function next() {
        totalPrice = parseFloat($.trim($('#allmoney').text()));
        totalNum = parseInt($.trim($('#menucount').text()));
        if ((totalNum > 0) && (totalPrice > 0)) {
            var data = getMenuChecklist(); //[{'id':id,'count':count},{'id':id,'count':count}]
            if ((data.length > 0) && !islock) {
                islock = true;
                $('#nextstep').removeClass('orange show').addClass('gray disabled');
                $.ajax({
                    type: "POST",
                    url: "/wap.php?g=Wap&c=Vip&a=processOrder&mer_id=890",
                    data: {"cart": data},
                    async: true,
                    success: function (res) {
                        islock = false;
                        $('#nextstep').removeClass('gray disabled').addClass('orange show');
                        if (res.error == 0) {
                            window.location.href = "/wap.php?g=Wap&c=Vip&a=sureorder&mer_id=890";
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
    body {
        background: #fff;
    }

    .menudesc {
        width: 100%;
        height: 36px;
        line-height: 36px;
        overflow: hidden;
    }

    #menuList .licontent > div {
        display: block;
    }

    .menudesc h3 {
        float: left;
        display: inline-block;
        max-width: 100%;
        position: relative;
        left: -7px;
        font-size: 16px;
        font-weight: 100;
    }

    .menudesc p {
        float: right;
        display: inline-block;
        position: relative;
        top: -5px;
    }

    .salenum {
        padding-top: 0px;
        line-height: 20px;
    }

    .lf-img {
        float: left;
    }

    .price_wrap2 {
        width: 85px;
        float: right;
        margin: 0px auto 0px auto;
    }

    .shop-img {
        width: 120px;
        height: 120px;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        background-size: cover;
        float: left;
        margin-right: 10px;
        position: relative;
        z-index: 2;
    }

    .list-cons {
        margin: 0px 0px;
        margin-top: 15px;
        padding-bottom: 15px;
    }

    .list-left {
        float: left;
    }

    .list-left img {
        width: 125px;
        height: 125px;
        overflow: hidden;
    }

    .left-right {
        position: relative;
        top: 0px;
        z-index: 1;
    }

    .left-right h5 {
        font-size: 14px;
        height: 20px;
        overflow: hidden;
        line-height: 20px;
        color: #000;
        font-weight: 100;
    }

    .left-right p {
        height: 30px;
        font-size: 12px;
        line-height: 16px;
        overflow: hidden;
        margin-top: 5px;
    }

    @media screen and (max-width: 320px) {
        .list-cons {
            margin: 0px 5px;
            margin-top: 15px;
            padding-bottom: 15px;
        }

        .shop-img {
            width: 100px;
            height: 100px;
        }

        .price_wrap {
            margin-top: 0px;
            text-align: left;
        }

        .price_wrap strong {
            width: 100%;
        }

        .list-left img {
            width: 50px;
            height: 50px;
            overflow: hidden;
        }

        .all ul {
            width: 100%;
        }

        .left-right {
            text-align: center;
            position: relative;
        }

        .left-right h4 {
            font-size: 14px;
            color: #000;
            height: 20px;
            line-height: 20px;
            overflow: hidden;
        }

        .left-right h5 {
            font-size: 14px;
            height: 25px;
            overflow: hidden;
            line-height: 20px;
            color: #000;
            text-align: left
        }

        .left-right p {
            text-align: left;
        }
    }

    .banner-top {
        width: 100%;
    }

    .banner-top img {
        width: 100%;
        display: block;
    }

    .list-nav {
        width: 100%;
        height: 50px;
        background: #fff;
        position: relative;
    }

    .fix {
        position: fixed;
        left: 0;
        top: 0px;
        width: 100%;
        height: 50px;
        z-index: 10000;
        background: #fff;
    }

    .list-nav li.active a {
        color: #f02b2b;
    }

    .nav-banner {
        width: 100%;
        margin-bottom: 15px;
    }

    .nav-banner img {
        width: 100%;
    }

</style>
<!--组件依赖css begin-->
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}vip/widget/navigator/navigator.css"/>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}vip/widget/navigator/navigator.iscroll.css"/>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}vip/widget/navigator/navigator.default2.css"/>
<!--皮肤文件，若不使用该皮肤，可以不加载-->
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}vip/widget/navigator/navigator.iscroll.default.css"/>
<!--皮肤文件，若不使用该皮肤，可以不加载-->
<!--组件依赖css end-->
<!--组件依赖js begin-->
<script type="text/javascript" src="{pigcms{$static_path}vip/zepto.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}vip/zepto.extend.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}vip/zepto.ui.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}vip/zepto.iscroll.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}vip/widget/navigator.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}vip/widget/navigator.iscroll.js"></script>
<div data-role="container" class="container">
    <section data-role="body">
        <div class="banner-top">
            <img src="{pigcms{$static_path}vip/list-banner.jpg"/>
        </div>
        <style>
            .switch-tab {
                height: 50px;
            }

            .switch-tab li a {
                height: 50px;
                line-height: 40px;
                font-size: 14px;
                color: #000;
                text-decoration: none;
                outline: none;
                font-family: arial, helvetica, sans-serif;
                font-weight: 100;
                text-align: center;
                float: left;
                 margin: 0px 15px;
            }
            .ui-navigator .ui-navigator-list li{
               
            }
            .list-nav ul li.active {
                border-bottom: 2px solid #f02b2b;
                color: #f02b2b;
            }

        </style>
        <div class="list-nav">
            <div class="navs" id="nav-smartSetup">
                <ul class="switch-tab">
                    <volist name="categorys" id="cat" key="index">
                        <if condition="$index eq 1">
                            <li class="active mytab" data="{pigcms{$cat.cat_id}">
                                <a href="javascript:; " class="cur">{pigcms{$cat.cat_name}</a>
                            </li>
                            <else/>
                            <li>
                                <a href="javascript:; " class="mytab" data="{pigcms{$cat.cat_id}">{pigcms{$cat.cat_name}</a>
                            </li>
                        </if>
                    </volist>

                </ul>
            </div>
        </div>
        <div class="right" id="usermenu">

            <div class="tab-content">

<volist name="res" id="resitem">
    <div class="tab-panel" id="cpxq">
        <div class="all" id="menuList">
            <ul id="ul_type284">
                <volist name="resitem.goods" id="group">
                    <li id="dish_li{pigcms{$group.group_id}">
                        <div class="cen">
                            <div class="list-imgs shop-img"
                                 style="background-image: url({pigcms{$group.thumb});">
                                <input type="hidden" class="goodprice" value="{pigcms{$group.price}">
                                <input type="hidden" class="goodname" value="{pigcms{$group.s_name}">
                                <input type="hidden" class="gooddigest" value="{pigcms{$group.intro}">
                                <input type="hidden" class="goodimage" value="{pigcms{$group.pic}">
                            </div>
                            <div class="list-cons">
                                <div class="left-right">
                                    <h5 class="list-imgs">{pigcms{$group.s_name}</h5>
                                    <p>{pigcms{$group.name}</p>
                                    <div class="price_wrap">
                                        <strong><span
                                                    class="unit_price">&yen;<?php echo $group['price']; ?>
                                                <input type="hidden" class="tureunit_price"
                                                       value="{pigcms{$group.price}"></span>
                                            <del>&yen;{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden"
                                               value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus"
                                                   data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden"
                                                   name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    </li>
                </volist>
            </ul>

        </div>
    </div>
</volist>








            </div>
            <div class="alert-div">
                <div class="alert-bg"></div>
                <div class="dialog mask">
                    <div class="dialog_wrap">
                        <div class="dialog_tt">壹加壹带骨腹肉1kg</div>
                        <a href="javascript:void(0);" class="dialog_close"></a>
                        <div class="dialog_scroller" style="height: 398px;">
                            <div class="menu_detail dialog_content" id="menuDetail" style="display: block;">
                                <img style="" class="alertimage" src="http://www.xiaonongding.com/xnd.png">
                                <div class="nopic" style="display: none;"></div>

                                <dl>
                                    <dt>价格：</dt>
                                    <dd class="highlight">￥<span class="price">166.00</span></dd>
                                </dl>
                                <p class="sale_desc"></p>
                                <dl class="desc">
                                    <dt>介绍：</dt>
                                    <dd class="info">
                                        位于牛胸腹部，第2肋-第5肋。主要由肋间内肌、肋间外肌、腹外斜肌等肌肉组织。带骨腹肉又称：小牛排、牛仔骨肌间有脂肪，有筋膜层，表面有不均匀脂肪覆盖。用作火锅切片、韩式牛排火锅、韩式烤肉及西餐牛排。
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <style>
                .list-img {
                    width: 100%;
                    display: block;
                    font-size: 0;
                }

                .list-img img {
                    width: 100%;
                }
            </style>
            <div class="list-img">
                <img src="{pigcms{$static_path}vip/list-footer.png">
            </div>
            <div style="width: 100%; height: 1;"></div>
        </div>

    </section>

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



<input type="hidden" class="nowmoney" value="{pigcms{$user.cardmoney}">
</body>
<script>
    $(document).ready(function(){
        $(".list-imgs").on("click",function(){
            var price=    $(this).children(".goodprice").val();
            var title=$(this).children(".goodname").val();
            var digest=$(this).children(".gooddigest").val();
            var image=$(this).children(".goodimage").val();
            $(".dialog_tt").text(title);
            $(".price").text(price);
            $(".info").text(digest);
            $(".alertimage").attr("src",image);
            $('.alert-div').show();
        });
        $(".alert-bg").click(function(){
            $('.alert-div').hide();
        });
    });
</script>

<script>
    $(function () {
        var a = $('.navs'),
            b = a.offset();
        $(document).on('scroll', function () {
            var c = $(document).scrollTop();
            if (b.top <= c) {
                a.css({'position': 'fixed', 'top': '0px', 'z-index': '100', 'width': '100%', 'background': '#fff'})
            } else {
                a.css({'position': 'absolute', 'top': '0px', 'background': '#fff', 'width': '100%'})
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('.switch-tab>li').click(function() {
            var s = $('.switch-tab>li').index(this);
            $('body,html').animate({ scrollTop: $('.tab-content>.tab-panel:eq(' + s + ')').offset().top - 45 }, 200);
        });
        var DT = $('.switch-tab').offset().top;
        $(window).scroll(function() {
            var wt = $(window).scrollTop(),
                l = $('.tab-content>.tab-panel'),
                s = l.length - 1;
            if(wt < DT || wt >= l.last().offset().top + l.last().height() + 45) {
                $('.switch-tab').removeClass('fixed');
                $('.switch-tab>li:first').addClass('active').siblings().removeClass('active');
            } else { $('.switch-tab').addClass('fixed'); for(var i = 0; i < s; i++) { if(wt >= parseInt(l.eq(i).offset().top - 45) && wt < parseInt(l.eq(i + 1).offset().top - 45)) { s = i; break; } } $('.switch-tab>li:eq(' + s + ')').addClass('active').siblings().removeClass('active'); }
        });
    });
</script>
<script type="text/javascript">
    window.shareData = {
        "moduleName": "Vip",
        "moduleID": "0",
        "imgUrl": "{pigcms{$static_path}/vip/share.jpg",
        "sendFriendLink": "http://www.xiaonongding.com/wap.php?g=Wap&c=Vip",
        "tTitle": "农丁鲜生品鲜白金会员专享",
        "tContent": "小农丁为有品の您甄选原产地最优品、最健康的生鲜食材～"
    };
</script>
<script type="text/javascript">
    window.$$ = window.Zepto = Zepto;
    (function () {
        /*组件初始化js begin*/
        $$('#nav-smartSetup').navigator();    //smart setup方式创建 推荐方式
    })();
</script>
<include file="Public:vipshare"/>

</html>