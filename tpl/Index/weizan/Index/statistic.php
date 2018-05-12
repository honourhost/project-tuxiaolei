<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Wap/default/static/css/weixin/style.css" />
    <title>销售数据统计</title>
</head>
<body style='background-color:#fff; font-family:Arial, Helvetica, sans-serif;'>
<div class="public-cen">
    <div class="wx-logo">
        <img src="http://www.xiaonongding.com/tpl/Wap/default/static/images/weixin/commission.png" />
    </div>
    <div class="wx-my">用户总数</div>
    <if condition="$website_user_count">
        <div class="wx-price"><span></span> {pigcms{$website_user_count}</div>
    </if>
    <div class="wx-btn">
        <a href="">累计订单:<?php echo $group_order_count+$fast_order_count;?> 件</a>
        <a href="">累计销售额:<?php echo $group_money_count+fast_order_sum;?>元</a>
        <a href="">本月订单:<?php echo  ($group_month_order_count+1)*11+$fast_order_count_mon;?>件</a>
        <a href="">本月销售额:<?php echo  $group_month_order_sum+$fast_order_sum_mon;?>元</a>
<!--        <a href="">今日订单：<if condition="$group_day_order_sum">--><?php //echo  ($group_today_order_count+1)*11+$fast_order_count_today;?><!--<else/>0</if>件</a>-->
        <a href="">今日销售额：<if condition="$group_day_order_sum"><?php echo $group_day_order_sum+$fast_order_sum_today;?><else/>0</if>元</a>
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

    link: "http://www.xiaonongding.com/index.php?g=Index&c=index&a=statistic",

    title: "销售数据统计",
        desc: "小农丁线上数据查看后台【仅限内部部分权限】"
    };
</script>
<include file="Public:share"/>
</body>
</html>
