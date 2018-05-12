<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>农丁鲜生充值送礼</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-style.css"/>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
</head>
<body>
<div class="wx-body">
    <div class="cz-logo"><img src="{pigcms{$static_path}giftimg/logo-01.png" /></div>
    <!-- 微信头像、名称 -->
    <div class="wx-info">
        <if condition="$userinfo.avatar neq null ">
            <img src="{pigcms{$userinfo.avatar}" />
            <else />
            <img src="http://www.xiaonongding.com/xnd.png" />
        </if>
        <h3>{pigcms{$userinfo.nickname}</h3>
    </div>
    <!-- 充值金额 -->
    <form method="post"   id="moneyform" action="{pigcms{:U('Gift/goPay')}">
    <div class="wx-recharge">
        <label>充值金额</label>
        <span>元</span>
        <input type="text" name="money" placeholder="0.00" />
    </div>
    <!-- textarea -->
    <div class="wx-textarea">
        <textarea name="desc">送您一份小农丁大礼！</textarea>
    </div>
    <!-- 金额 -->
    <div class="my-money">
<!--        <h2>9805321342.37</h2>-->
    </div>
    <!-- 充值按钮 -->
    <div class="wx-btn">
        <input type="submit" value="立即充值" />
    </div>
    </form>
</div>
</body>
<script type="text/javascript">

    var url="http://www.xiaonongding.com/wap.php?c=Gift&a=giftrecharge";
    window.shareData = {
        "moduleName": "Gift",
        "moduleID": "0",
        "imgUrl": "http://www.xiaonongding.com/xnd.png",
        "sendFriendLink": url,
        "tTitle": "农丁鲜生充值赠送",
        "tContent": "给有品の您，有品の送礼体验！"
    };
</script>

<include file="Public:vipshare"/>
</html>
