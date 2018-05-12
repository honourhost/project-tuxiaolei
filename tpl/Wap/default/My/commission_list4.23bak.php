<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin/list.css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin/jquery.mobile-1.3.2.min.css" />
		<script src="{pigcms{$static_path}/js/commission/jquery-1.9.1.min.js"></script>
		<script src="{pigcms{$static_path}/js/commission/jquery.mobile-1.3.2.min.js"></script>
		<script src="{pigcms{$static_path}/js/commission/iscroll.js"></script>
		<script src="{pigcms{$static_path}/js/commission/list.js"></script>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin/newstyle.css" />
		<title>余额记录</title>
	</head>
	<body>
<div class="public-cen">
	    	<div class="index-title">
	    		<if condition="$now_money">
	    		<h3>账户余额：<span>&yen; {pigcms{$now_money}</span></h3>
	    		<else/>
	    		<h3>账户余额：<span>&yen; 0</span></h3>
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
		</div>
		</div>
		</div>
		
	</body>
</html>
