<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin/newcommon.css" />
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
	    	<div class="xnd-index">
			   <ul>
			   	<if condition="$money_list">
				   	<volist name="money_list" id="vo">
					<li>
				   		<span class="jia">+{pigcms{$vo.money}</span>
				   		<div class="index-lf">
				   			<img src="{pigcms{$static_path}images/weixin/{pigcms{$vo.image}.png" />
				   			<h3>
				   				<b>{pigcms{$vo.desc}</b>
				   				<p><php> echo date("Y-m-d H:m:s",$vo['time']);</php></p>
				   			</h3>
				   		</div>
				   	</li>
				   	</volist>
				   <div style="clear: both;"></div>
				   <else/>
					<li>暂时没有佣金信息...</li>
					</if>
			   </ul>
	    	</div>
	    	<if condition="$pagebar">
			<div>{pigcms{$pagebar}</div>
			</if>
		</div>
		
	</body>
</html>
