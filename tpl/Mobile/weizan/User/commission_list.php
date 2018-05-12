<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<link rel="stylesheet" type="text/css" href="/tpl/Wap/default/static/css/weixin/jquery.mobile-1.3.2.min.css" />
		<script src="/tpl/Wap/default/static/js/commission/jquery-1.9.1.min.js"></script>
		<script src="/tpl/Wap/default/static/js/commission/jquery.mobile-1.3.2.min.js"></script>
		<script src="/tpl/Wap/default/static/js/commission/iscroll.js"></script>
		<script src="/tpl/Wap/default/static/js/commission/mobile-list.js"></script>
		<link rel="stylesheet" type="text/css" href="/tpl/Wap/default/static/css/weixin/newstyle.css" />
		<link rel="stylesheet" type="text/css" href="/tpl/Wap/default/static/css/weixin/list.css" />
		<title>余额记录</title>
		<style>
			#thelist li{
				padding: 10px 0px;
			}
			.left-img{
				width: 50px;
				height: 50px;
				border-radius: 50px;
				overflow: hidden;
			}
		</style>
	</head>
	<body>
<div class="public-cen">
	    	<div class="index-title" style="position: relative; top: -7px;">
	    		<if condition="$now_money">
	    		<h3 style="font-size: 16px; color: #2a2a2a; font-weight: 100; margin-left: 10px;">账户余额：
	    			<span style="color: #ff731a; font-size: 18px;">&yen; {pigcms{$now_money}</span>
	    		</h3>
	    		<else/>
	    		<h3 style="font-size: 16px; color: #2a2a2a; font-weight: 100; margin-left: 10px;">账户余额：
	    			<span style="color: #ff731a; font-size: 18px;">&yen; 0</span>
	    		</h3>
	    		</if>
	    	</div>
	    	<div id="wrapper">
			<div id="scroller">
			<div id="pullDown" class="idle">
				<span class="pullDownIcon"></span>
				<span class="pullDownLabel">下拉刷新...</span>
			</div>

			<ul id="thelist">
			</ul>
			<div id="pullUp" class="idle">
				<span class="pullUpIcon"></span>
				<span class="pullUpLabel">上拉刷新...</span>
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
		</div>
		</div>
		
	</body>
</html>
