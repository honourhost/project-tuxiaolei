<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>小农拼-团长免单</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no" />
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/newtuan.css" />
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
		<!-- 团长免单 -->
		<div class="public-cen">
		<div class="mian">
			<div class="mian-header">
				<ul>
					<li>您已成功领取一张团长免单券，<span>（有限期至2016-11-02）</span></li>
					<li>请选择一个商品免费开团，成团后可收获</li>
				</ul>
			</div>
			<div class="mian-list">
				<ul>
					<li>
						<div class="list-pic" style="background-image: url({pigcms{$static_path}img/banner02.jpg);">
							
						</div>
						<div class="list-con">
							<h3>产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题</h3>
							<del>拼团价：&yen;79.9</del>
							<div class="list-fot">
								<i>&yen;0</i>
								<span><a href="#">免费开团</a></span>
							</div>
						</div>
					</li>
					<li>
						<div class="list-pic" style="background-image: url({pigcms{$static_path}img/banner02.jpg);">
							
						</div>
						<div class="list-con">
							<h3>产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题</h3>
							<del>拼团价：&yen;79.9</del>
							<div class="list-fot">
								<i>&yen;0</i>
								<span><a href="#">免费开团</a></span>
							</div>
						</div>
					</li>
					<li>
						<div class="list-pic" style="background-image: url({pigcms{$static_path}img/banner02.jpg);">
							
						</div>
						<div class="list-con">
							<h3>产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题产品标题</h3>
							<del>拼团价：&yen;79.9</del>
							<div class="list-fot">
								<i>&yen;0</i>
								<span><a href="#">免费开团</a></span>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer-don">
				<span></span>
				<p>已经到底部了</p>
			</div>
	    </div>
	</body>
</html>
