<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>商品详情页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telphone=no, email=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css?v=3.22"/>
    <script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
<body>
<!-- 详情顶部大图 -->
<div class="public_cen">
    <!-- 店铺信息 -->

    <!-- 产品详情 -->
    <div class="phone-xq-details">
        <div class="phone-xq-details-title">
            <span></span>
            <h3>商品介绍</h3>
        </div>
        <div class="phone-xq-details-con">
            {pigcms{$content}
        </div>
    </div>
    <div class="xnd-logo">
        <img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
    </div>
    <style>
        .phone-xq-details-con img{
            width: 100%;
        }
    </style>
    <!-- 底部浮动 -->
    <div style="width: 100%; height: 55px;"></div>
    <div class="phone-order-footer-del" style="z-index: 100000000; display: none;">
        <div class="order-footer-left">
            <p style="color: #fff;">
                <a class="phone-group-xq-footer-add" style="cursor:pointer;" href="app:main">
                    <img src="{pigcms{$static_path}images/xnd_img/iconfont-dianpu.png" height="22px" />
                    <span>首页</span>
                </a>
                <a class="phone-group-xq-footer-add" style="cursor:pointer;" onclick="addCollect({pigcms{$now_group.group_id});">
                    <if condition="$is_collect">
                        <img class="img-ysc" src="{pigcms{$static_path}images/xnd_img/iconfont-shoucangyishoucang.png" height="22px" style="margin-top: 5px;" />
                        <span id="collect">已收藏</span>
                        <else/>
                        <img class="img-ysc" src="{pigcms{$static_path}images/xnd_img/iconfont-guanzhu.png" height="20px" style="margin-top: 7px;" />
                        <span id="collect">收藏</span>
                    </if>
                </a>

                <a class="phone-group-xq-footer-add" style="cursor:pointer;" href="{pigcms{:U('Group/shopcart',array('group_id'=>$now_group['group_id']))}">
                    <img src="{pigcms{$static_path}images/xnd_img/iconfont-gouwuche.png"  height="22px"/>
                    <span>购物车</span>
                </a>
            </p>
        </div>
        <if condition ="$islogin">
            <a class="order-footer-a" href="{pigcms{:U('Group/shopcart',array('group_id'=>$now_group['group_id']))}">
                立即购买
            </a>
            <else/>
            <a class="order-footer-a" href="app:redirect:login">
                登陆购买
            </a>
        </if>

    </div>

</div>
</body>

</script>
</html>