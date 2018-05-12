
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>我的余额</title>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/css/bonus/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/css/bonus/bonus.css"/>
	</head>
	<body>
		<div class="public_cen">
			<div class="bonus">
				<!-- 白底部分 -->
				<div class="bonus-bgfff">
					<div class="bonus-logo">
						<img src="{pigcms{$now_user.avatar}">
					</div>
					<h4 class="bonus-more color-f88 block">累计总分红</h4>
					<!-- data-to:显示金额，data-speed:加载完成时间 -->
					<h3 class="bonus-price color-f88 block timer count-title" id="count-number">
						<php>echo $channel['profit']*$person['percent']/100;</php>
					</h3>
					<span class="bonus-number color-8c block">您持有{pigcms{$channel.name}<b class="number">{pigcms{$person.percent}</b>%的股份</span>
					<div class="bonus-line">
						<img src="{pigcms{$static_path}/images/bonus-line.jpg" />
					</div>
				</div>
				<!-- 白底部分 end-->
				<!-- 灰底部分 -->
				<div class="bonus-ft">
					<div class="bonus-xiaoxi" style="display: none;">
					    <img src="{pigcms{$static_path}/images/bonus-more.jpg">
				    </div>
				    <div class="bonus-num">
				    	<div class="bonus-shouyi">
				    		<img src="{pigcms{$static_path}/images/bonus-shoiyi.jpg" />
				    		<span class="block">频道累计收益</span>
				    		<h3 class="block timer count-title" id="count-number2">{pigcms{$channel.profit}</h3>
				    	</div>
				    	<div class="bonus-shouyi">
				    		<img src="{pigcms{$static_path}/images/bonus-xiaoshou.jpg" />
				    		<span class="block">频道累计销售额</span>
				    		<h3 class="block timer count-title" id="count-number3">{pigcms{$channel.income}</h3>
				    	</div>
				    	<div class="div_clear"></div>
				    	<a class="back-index block" href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Topic&a=index&topic={pigcms{$channel.url}">返回该频道主页</a>
				    	<div style="width: 200px; height: 50px; margin: 0px auto 10px auto;">
				    	    	<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/xnd-logo.png" style="height:50px;margin-top:10px"/>
				    	</div>
				    </div>
				</div>
				<!-- 灰底部分 end-->
			</div>
		</div>
		
	</body>
</html>
