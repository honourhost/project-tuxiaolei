<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-style.css"/>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <title>农丁鲜生 - 领取奖品</title>
</head>
<body>
<div class="wx-body">
    <div class="wx-cen">
        <div class="wx-logo2">
            <img src="{pigcms{$static_path}giftimg/logo-03.png" />
        </div>
        <div class="wx-uesr">
            <if condition="$userinfo.avatar neq null ">
                <img src="{pigcms{$userinfo.avatar}" />
                <else />
                <img src="http://www.xiaonongding.com/xnd.png" />
            </if>
            <h3>{pigcms{$userinfo.nickname}</h3>
            <p>送您一份小农丁价值{pigcms{$orderinfo.payment_money}元的<br/>惊喜大礼</p>
        </div>
        <div id="qrcode" class="wx-an"></div>
        <div class="wx-an">
<!--            <img src="{pigcms{$userinfo.avatar}" />-->

            <p>长按二维码识别领取</p>
        </div>
    </div>
    <p class="wx-jieshi">本活动最终解释权规小农丁所有</p>
    <div>

</body>
<script>
    $(document).ready(function () {
        var orderid="{pigcms{$order_id}";
        var url="http://www.xiaonongding.com/wap.php?c=Gift&a=receive&issend=1&order_id="+orderid;
        $('#qrcode').qrcode({render: "canvas",width: 130,height: 130,text: url});

    });
</script>

<script type="text/javascript">
    var orderid="{pigcms{$order_id}";
    var nick="{pigcms{$userinfo.nickname}";
    var money="{pigcms{$orderinfo.payment_money}";
    var desc="{pigcms{$orderinfo.desc}";
    var url="http://www.xiaonongding.com/wap.php?c=Gift&a=receive&issend=1&order_id="+orderid;
    window.shareData = {
        "moduleName": "Gift",
        "moduleID": "0",
        "imgUrl": "{pigcms{$userinfo.avatar}",
        "sendFriendLink": url,
        "tTitle": nick+"送您一份小农丁价值"+money+"元的惊喜大礼",
        "tContent": desc
    };
</script>

<include file="Public:vipshare"/>
</html>
