<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>农场活动</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-index.css"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/hhSwipe.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
	</head>
	<body style="background: #f4f4f4;">
		<div class="public_cen">
			<div class="public-phone-nav">
				<ul>
					<!-- class="nav-on"为当前颜色 -->
					<if condition="empty($_GET['order'])">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>">
						<h3>综合</h3>
						<span class="icon iconfont">&#xe607;</span><!-- 下 -->
						</a>
					</li>
					<else/>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>">
						<h3>综合</h3>
						<span class="icon iconfont">&#xe607;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe614;</span><!-- 上 -->
						</a>
					</li>
					</if>
					<if condition="$_GET['order'] eq 'hot'">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>&order=hot">
						<h3>销量</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					<else/>
						<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>&order=hot">
						<h3>销量</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					</if>
					<if condition="$_GET['order'] eq 'price-asc'">
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-desc">
						<h3>价格</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					<elseif condition="$_GET['order'] eq 'price-desc'"/>
					<li class="nav-on">
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-asc">
						<h3>价格</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						</a>
					</li>
					<else/>
						<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id=<php>echo $_GET['mer_id'];</php>&order=price-desc">
						<h3>价格</h3>
						
						<span class="icon iconfont">&#xe680;</span><!-- 上 -->
						</a>
						</li>
					</if>
				</ul>
			</div>
			<div class="phone-index-tx" style="margin-top: 0; border-top: 0;">
				<span class="index-news-more">更多></span>
				<div class="index-news-icon"><img src="{pigcms{$static_path}images/xnd_img/phone-index-news.jpg" /></div>
				<div class="index-news-title apple">
					<ul>
						<if condition="$tuiactivities">
						<volist name="tuiactivities" id="activity" key="k">
						<li>
							<a href="{pigcms{$activity.url}"><b>最新活动</b>{pigcms{$k}、{pigcms{$activity.merchant_name} {pigcms{$activity.product_name}</a>
						</li>
						</volist>
						<else/>
						<li>暂时没有获取到最新活动。。。</li>
						</if>
					</ul>
					  
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="photo-index-activity" style="margin-top: 10px; border-top: 1px solid #ddd;">
				<div class="index-activity-con">
					<ul>
						<if condition="$list">
						<volist name="list" id="activity">
						<li>
							<if condition="$activity['type']==1">
							<a href="{pigcms{$activity.url}">
							<div class="activity-con-img" style="background-image: url({pigcms{$activity.pic.0.image});"></div>
						    <div class="activity-con-right">
						    	<h3>{pigcms{$activity.name}</h3>
						    	<span>&yen;<php>echo sprintf(" %1\$.2f",$activity['price']);</php><i><img src="{pigcms{$static_path}images/xnd_img/activity-con-right-cion.jpg" /><php>echo round($distance/1000,2);</php>km</i></span>
						    	<h4>截止时间：<php>echo date("Y-m-d",$activity['end_time']);</php></h4>
						    </div>
						    </a>
						    <else/>
						    <a href="{pigcms{$activity.url}">
							<div class="activity-con-img" style="background-image: url({pigcms{$activity.pic.0.image});"></div>
						    <div class="activity-con-right">
						    	<h3>{pigcms{$activity.name}</h3>
						    	<span>&yen; {pigcms{$activity.money}<i><img src="{pigcms{$static_path}images/xnd_img/activity-con-right-cion.jpg" /><php>echo round($distance/1000,2);</php>km</i></span>
						    	<h4>截止时间：<php>echo date("Y-m-d",$activity['end_time']);</php></h4>
						    </div>
						    </a>
						    </if>
						</li>
						</volist>
						<else/>
						<li>暂时没有获取到数据。。。</li>
						</if>
						<div style="clear: both;"></div>
					</ul>
				</div>
				<!-- 最新提醒 -->
					
			</div>
			<div class="xnd-logo">
				<img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
			</div>
		</div>
	</body>
	<script type="text/javascript"> 
		  function autoScroll(obj){  
				$(obj).find("ul").animate({  
					marginTop : "-20px"  
				},500,function(){  
					$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
				})  
			}  
			$(function(){  
				setInterval('autoScroll(".apple")',3000);
				  
			}) 
	</script> 
</html>
