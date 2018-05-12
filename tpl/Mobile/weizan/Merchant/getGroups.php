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
			<div class="public-phone-nav">
				<ul>
					<!-- class="nav-on"为当前颜色 -->
					<if condition="empty($_GET['order'])">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>">
						<h3>综合</h3>
						<span class="icon iconfont">&#xe607;</span><!-- 下 -->
						</a>
					</li>
					<else/>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>">
						<h3>综合</h3>
						<span class="icon iconfont">&#xe607;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe614;</span><!-- 上 -->
						</a>
					</li>
					</if>
					<if condition="$_GET['order'] eq 'hot'">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>&order=hot">
						<h3>销量</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					<else/>
						<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>&order=hot">
						<h3>销量</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					</if>
					<if condition="$_GET['order'] eq 'price-asc'">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-desc">
						<h3>价格</h3>
						<span class="icon iconfont">&#xe680;</span><!-- 上 -->
						
						</a>
					</li>
					<elseif condition="$_GET['order'] eq 'price-desc'"/>
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-asc">
						<h3>价格</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					<else/>
						<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-desc">
						<h3>价格</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
						</li>
					</if>
				</ul>
			</div>
			
			<!-- 主体内容start -->
			<div class="phone-temai">
				<ul>
					<if condition="$list">
					<volist name="list" id="group">
					<li>
						<a href="{pigcms{$group.url}">
						<div class="phone-temai-img" style="background-image: url({pigcms{$group.list_pic});"></div>
					    <div class="phone-temai-con">
					    	<div class="phone-temai-con-price">
					    		<h3><b>&yen;{pigcms{$group.price}</b></h3>
					    		<span></span>
					    	</div>
					    	<div class="phone-temai-con-title">
					    		<h3>{pigcms{$group.group_name}</h3>
					    		<del>原价：{pigcms{$group.old_price}元</del><span>销量：<php>echo $group['virtual_num']+$group['sale_count'];</php></span>
					    	</div>
					    </div>
					    </a>
					</li>
					</volist>
					<else/>
					<li style="color: #ccc; text-align: center; padding: 15px 0px; border-top: 0px; width: 100%;">暂无数据</li>
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
