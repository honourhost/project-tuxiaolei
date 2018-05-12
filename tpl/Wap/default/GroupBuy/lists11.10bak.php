<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>小农丁-拼团</title>
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telphone=no, email=no"/>
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link href="{pigcms{$static_path}css/groupbuy/newtuan.css" rel="stylesheet"/>
</head>
<body>
<!-- 最新订单提醒 -->
        <div class="news-dingdan">
            <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$now_pin_order['sun_id']))}">
            <span></span>
            <div class="news-dingdan-c">
            <if condition="$now_pin_order">
                <img src="{pigcms{$now_pin_order.list_pic}" />最新订单来自{pigcms{$now_pin_order.contact_name}，<?php echo time()-$now_pin_order['add_time'];?>秒前
            </if>
            </div>
            </a>
        </div>
<div class="public-cen">
    <div class="tuan-list">
        <ul>
            <if condition="$new_group_lists">
                <volist name="new_group_lists" id="group_buy">
                    <li>
                        <a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$group_buy['group_id']))}">
                            <div class="tuan-list-img" style="background-image: url({pigcms{$group_buy.list_pic});"></div>
                            <h3><b>{pigcms{$group_buy.s_name}</b>{pigcms{$group_buy.group_name}</h3>
                            <div class="tuan-list-foot">
                                <span class="right tuan-btn">去开团<img src="{pigcms{$static_path}images/groupbuy/jiantou.png" /></span>
                                <span class="left num"><img src="{pigcms{$static_path}images/groupbuy/tuan.png">{pigcms{$group_buy.need_num}人团</span>
                                <span class="left price">&yen;<i>{pigcms{$group_buy.price}</i></span>
                                <del class="left old-price">单买价：&yen;<php>echo getGroupPrice($group_buy['related_id']);</php></del>
                            </div>
                            <div style="clear: both;"></div>
                        </a>
                    </li>
                </volist>
        </ul>
        <div style="clear: both;"></div>
    </div>
</div>
<script type="text/javascript">
            var shareData={
                        imgUrl: "{pigcms{$group_list.0.list_pic}", 
                        link: "{pigcms{$config.site_url}{pigcms{:U('GroupBuy/lists')}",
                        title: "小农丁拼团列表",
                        desc: "小农丁拼团列表"
            };
        </script>
         <include file="Share:share"/>
</body>
</html>
