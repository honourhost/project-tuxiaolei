<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>农丁鲜生白金体验</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/base2.css"/>
    <script type="text/javascript" src="{pigcms{$static_path}/vip/jquery_min.js"></script>
    <style>
        .vip-main{
            max-width: 650px;
            min-width: 240px;
            margin: 0px auto;
        }
        .vip-main img{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="vip-main">
    <img src="{pigcms{$static_path}/vip/agree.jpg" />
</div>
<script type="text/javascript">
    $(".vip-main").on("click",function () {
  //     window.location.href="{pigcms{:U('Vip/code')}";
    });
</script>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"Vip",
        "moduleID":"0",
        "imgUrl": "{pigcms{$static_path}/vip/share.jpg",
        "sendFriendLink": "http://www.xiaonongding.com/wap.php?g=Wap&c=Vip",
        "tTitle": "农丁鲜生品鲜白金会员专享",
        "tContent": "小农丁为有品の您甄选原产地最优品、最健康的生鲜食材～"
    };
</script>
<include file="Public:vipshare"/>
</body>
</html>
