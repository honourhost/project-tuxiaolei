<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>农场相册</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
        <style>
            img{
                width:100%;
            }
        </style>
	</head>
	<body style="background: #f4f4f4;">
		<div class="public_cen">
			<!-- 相册头部 -->
			<div class="phone-photo-header" style="background-image: url({pigcms{$farm.merchant_theme_image});">
				<div class="photo-header-logo">
					<img src="{pigcms{$farm.person_image}" />
				</div>
				<ul>
					<li class="lf-hd">
						<span  class="icon iconfont">&#xe600;</span>
						<h3>{pigcms{$collects}</h3>
					</li>
					<li class="rg-hd">
						<span  class="icon iconfont" style="font-size: 20px; position: relative; top: -2px;">&#xe64d;</span>
						<h3>{pigcms{$farm.fans_count}</h3>
					</li>
				</ul>
			</div>
			<div class="photo-header-guanzhu">
				<!-- <span>关注他</span> -->
				<h3>{pigcms{$farm.name}农场的相册</h3>
			</div>
			<div class="photo-list">

				<div class="photo-list-img" >
                    <volist name="moduledetails" id="detail" key="k">
                        <if condition="$k%2==0">
                            <div class='section2 floatPosition an_mo'>
                                <div id="block" class="block clearfix">
                                    <!-- txtModule txtMself start -->
                                    {pigcms{$detail['content']|htmlspecialchars_decode=ENT_QUOTES}
                                    <!-- txtModule txtMself end -->
                                </div>
                            </div>
                            <else/>
                            <div class='section1 floatPosition an_mo'>
                                <div id="block" class="block clearfix">
                                    <!-- txtModule txtMself start -->
                                    {pigcms{$detail['content']|htmlspecialchars_decode=ENT_QUOTES}
                                    <!-- txtModule txtMself end -->
                                </div>
                            </div>
                            <![endif]-->
                        </if>
                    </volist>
                </div>

			</div>
		</div>
		
</html>
