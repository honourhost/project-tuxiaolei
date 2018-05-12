<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的农场</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
	</head>
	<body style="background: #f4f4f4;">
		<div class="public_cen">
			<!-- 相册头部 -->
			<div class="phone-photo-header" style="background-image: url({pigcms{$farm.merchant_theme_image});">
				<div class="photo-header-logo">
					<img src="{pigcms{$farm.person_image}" />
				</div>
				<div class="photo-header-shop">{pigcms{$farm.name}</div>
			</div>
			<div class="phone-my-con">
				<if condition="$farm['txt_info']">
				<p>
					{pigcms{$farm.txt_info}
				</p>
				<else/>
				<h3 style="display: none;">该农场暂时没有添加简介</h3>
				</if>
				
			</div>
			<div class="xnd-logo">
				<img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
			</div>
		</div>
		
</html>
