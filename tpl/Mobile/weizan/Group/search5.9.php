<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>农场特卖</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
	</head>
	<body style="background: #f4f4f4;">
		<!-- public header nav -->
		<div class="public_cen">
			
			
			<!-- 主体内容start -->
			<div class="phone-temai">
				<ul>
					<if condition="$list">
					<volist name="list" id="group">
					<li>
						<a href="/mobile.php?g=Mobile&c=Group&a=detail&group_id={pigcms{$group.group_id}">
						<div class="phone-temai-img" style="background-image: url({pigcms{$group.list_pic});"></div>
					    <div class="phone-temai-con">
					    	<div class="phone-temai-con-price">
					    		<h3><b>&yen;{pigcms{$group.price}</b></h3>
					    		<span></span>
					    	</div>
					    	<div class="phone-temai-con-title">
					    		<h3>{pigcms{$group.group_name}</h3>
					    		<span>销量：<php>echo $group['virtual_num']+$group['sale_count'];</php></span>
					    	</div>
					    </div>
					    </a>
					</li>
					</volist>
					<else/>
					<li style="text-align: center; color: #ccc; padding: 15px 0px;">暂无数据</li>
					</if>
					<div style="clear: both;"></div>
				</ul>
			</div>
			<div class="xnd-logo">
				<img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
			</div>
		</div>
	</body>
</html>
