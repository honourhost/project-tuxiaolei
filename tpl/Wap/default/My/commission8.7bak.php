<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin/style.css" />
		<title>我的余额</title>
	</head>
	<body style='background-color:#fff; font-family:Arial, Helvetica, sans-serif;'>
		<div class="public-cen">
			<div class="wx-logo">
				<img src="{pigcms{$static_path}images/weixin/commission.png" />
			</div>
			<div class="wx-my">我的余额</div>
			<if condition="$user['now_money']">
			<div class="wx-price"><span>&yen;</span> {pigcms{$user.now_money}</div>
			<else/>
			<div class="wx-price"><span>&yen;</span> 0</div>
			</if>
			<div class="wx-btn">
				<a href="{pigcms{:U('My/commission_list')}">余额记录</a>
				<a href="{pigcms{:U('My/recharge')}">充值</a>
				<if condition="$channels">
					<volist name="channels" id="channel">
					<a href="{pigcms{:U('My/getChannelList',array('c_id'=>$channel['id']))}">{pigcms{$channel.name}</a>
					</volist>
				</if>
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
	</body>
</html>
