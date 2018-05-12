<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static/css/weixin/style.css" />
    <title>本周数据与上周数据统计</title>
</head>
<body style='background-color:#fff; font-family:Arial, Helvetica, sans-serif;'>
<div class="public-cen">
    <div class="wx-logo">
        <img src="http://www.xiaonongding.com/tpl/Wap/default/static/images/weixin/commission.png" />
    </div>
    <div class="wx-my">本周新增用户</div>

        <div class="wx-price"><span></span> <?php echo $thisweekusercount;?> </div>

    <div class="wx-btn">
        <a href="">本周新增用户数:<?php echo $thisweekusercount;?> 人</a>
        <a href="">上周新增用户数:<?php echo $lastweekusercount;?>人</a>
        <a href="">本周特卖订单总数（付款）:<?php echo  $thisweekgocount;?>笔</a>
        <a href="">上周特卖订单总数（付款）:<?php echo  $lastweekgocount;?>笔</a>
        <a href="">本周特卖交易额：<?php echo  $thisweekgosum;?>元</a>
        <a href="">上周特卖交易额：<?php echo $lastweekgosum;?>元</a>
        <a href="">本周快捷订单总数（付款）:<?php echo  $thisweekfastcount;?>笔</a>
        <a href="">上周快捷订单总数（付款）:<?php echo  $lastweekfastcount;?>笔</a>
        <a href="">本周快捷付款交易额（付款）:<?php echo  $thisweekfastsum;?>元</a>
        <a href="">上周快捷付款交易额（付款）:<?php echo  $lastweekfastsum;?>元</a>
        <a href="">本周所有订单总数（付款）:<?php echo  $thisweekcount;?>笔</a>
        <a href="">上周所有订单总数（付款）:<?php echo  $lastweekcount;?>笔</a>
        <a href="">本周总交易额（付款）:<?php echo  $thisweeksum;?>元</a>
        <a href="">上周总交易额（付款）:<?php echo  $lastweeksum;?>元</a>
    </div>
    <style>
        .foot-logo{
            width: 100%;
            text-align: center;
            padding-top: 30px;
        }
        .foot-logo img{
            height: 30px;
        }
    </style>
    <div class="foot-logo">
        <img src="http://www.xiaonongding.com/upload/config/000/000/004/563c69a292120.png" />
    </div>
</div>

<script type="text/javascript">
    var shareData={
        imgUrl: "http://www.xiaonongding.com/earn.png",

        link: "http://www.xiaonongding.com/index.php?g=Index&c=index&a=statistest",

        title: "周数据统计",
        desc: "小农丁周数据统计"
    };
</script>
<include file="Public:share"/>
</body>
</html>
