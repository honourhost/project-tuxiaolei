<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/color.css" media="all">
    <script type="text/javascript" src="{pigcms{$static_path}/vip/jquery_min.js"></script>
    <title>商品兑换</title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
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
</style>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/menu.js"></script>

<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">

    var islock = false;

    function next() {
        totalPrice = parseFloat($.trim($('#allmoney').text()));
        totalNum = parseInt($.trim($('#menucount').text()));
        if((totalNum > 0) && (totalPrice > 0)) {
            var data = getMenuChecklist(); //[{'id':id,'count':count},{'id':id,'count':count}]
            if((data.length > 0) && !islock) {
                islock = true;
                $('#nextstep').removeClass('orange show').addClass('gray disabled');
                $.ajax({
                    type: "POST",
                    url: "/wap.php?g=Wap&c=Vip&a=processOrder&mer_id=629",
                    data: { "cart": data },
                    async: true,
                    success: function(res) {
                        islock = false;
                        $('#nextstep').removeClass('gray disabled').addClass('orange show');
                        if(res.error == 0) {
                            window.location.href = "/wap.php?g=Wap&c=Vip&a=sureorder&mer_id=629";
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
    .menudesc {
        width: 100%;
        height: 36px;
        line-height: 36px;
        overflow: hidden;
    }

    #menuList .licontent>div {
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

    .price_wrap {
        float: right;
    }
</style>
<div data-role="container" class="container menu">
    <section data-role="body">

        <div class="right" id="usermenu">
            <div class="all" id="menuList">
                <ul id="ul_type284">
                    <volist name="groups" id="group">
                        <li id="dish_li{pigcms{$group.group_id}" >
                            <div class="licontent">
                                <div class="menudesc showPop">
                                    <h3>{pigcms{$group.s_name}</h3>
                                    <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                    <div class="info">{pigcms{$group.intro}</div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="span showPop lf-img">
                                    <img src="{pigcms{$group.pic}" alt="" url="{pigcms{$group.pic}">							</div>
                                <div class="price_wrap">
                                    <strong>￥<span class="unit_price">{pigcms{$group.price}<input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"></span></strong>
                                    <div class="fr" max="-1">
                                        <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                    </div>
                                    <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                </div>
                            </div>
                        </li>
                    </volist>


                </ul>
            </div>
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

<div class="menu_detail" id="menuDetail">
    <img style="display: none;">
    <div class="nopic"></div>
    <a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
    <dl>
        <dt>价格：</dt>
        <dd class="highlight">￥<span class="price"></span></dd>
    </dl>
    <p class="sale_desc"></p>
    <dl class="desc">
        <dt>介绍：</dt>
        <dd class="info"></dd>
    </dl>
</div>



</body>

</html>