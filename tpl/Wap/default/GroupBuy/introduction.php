<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>农小拼-拼团介绍</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/newtuan.css"/>
	</head>
	<body>
		<!-- 最新订单提醒 -->
        <div class="news-dingdan">
            <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$now_pin_order['sun_id']))}">
            <span></span>
            <div class="news-dingdan-c">
            <if condition="$now_pin_order">
                <img src="{pigcms{$now_pin_order.list_pic}" />最新订单来自<?php echo getUserName($now_pin_order['uid']);?>，<?php echo time()-$now_pin_order['add_time'];?>秒前
            </if>
            </div>
            </a>
        </div>
		<div class="public-cen">
			
			<div class="jieshao">
				<div class="jieshao-con">
					<img src="{pigcms{$static_path}img/group_explain.png" />
				</div>
				<span><a onclick="WeixinJSBridge.call('closeWindow');"><img src="{pigcms{$static_path}img/quit_button.png" /></a></span>
			</div>
		</div>
		
	</body>
</html>
