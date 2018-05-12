<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
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
					<li class="nav-on">
						<h3>综合</h3>
						<span class="icon iconfont">&#xe607;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe614;</span><!-- 上 -->
					</li>
					<li>
						<h3>销量</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe680;</span><!-- 上 -->
					</li>
					<li>
						<h3>价格</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe680;</span><!-- 上 -->
					</li>
					<li>
						<h3>距离</h3>
						<span class="icon iconfont">&#xe756;</span><!-- 下 -->
						<span class="icon iconfont" style="display: none;">&#xe680;</span><!-- 上 -->
					</li>
				</ul>
			</div>
			<div class="phone-index-tx" style="margin-top: 0; border-top: 0;">
				<span class="index-news-more">更多></span>
				<div class="index-news-icon"><img src="{pigcms{$static_path}images/xnd_img/phone-index-news.jpg" /></div>
				<div class="index-news-title apple">
					<ul>
						<li>
							<a href="#"><b>新品</b>1中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</a>
						</li>
						<li>
							<a href="#"><b>新品</b>2中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</a>
						</li>
						<li>
							<a href="#"><b>新品</b>3中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</a>
						</li>
						<li>
							<a href="#"><b>新品</b>4中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</a>
						</li>
						<li>
							<a href="#"><b>新品</b>5中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</a>
						</li>
					</ul>
					  
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="photo-index-activity" style="margin-top: 10px; border-top: 1px solid #ddd;">
				<div class="index-activity-con">
					<ul>
						<li>
							<a href="#">
							<div class="activity-con-img" style="background-image: url({pigcms{$static_path}images/xnd_img/275x185.jpg);"></div>
						    <div class="activity-con-right">
						    	<h3>中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</h3>
						    	<span>&yen;0.01<i><img src="{pigcms{$static_path}images/xnd_img/activity-con-right-cion.jpg" />2321.2km</i></span>
						    	<h4>截止时间：2016.2.28</h4>
						    </div>
						    </a>
						</li>
						<li>
							<a href="#">
							<div class="activity-con-img" style="background-image: url({pigcms{$static_path}images/xnd_img/275x185.jpg);"></div>
						    <div class="activity-con-right">
						    	<h3>中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</h3>
						    	<span>&yen;0.01<i><img src="{pigcms{$static_path}images/xnd_img/activity-con-right-cion.jpg" />2321.2km</i></span>
						    	<h4>截止时间：2016.2.28</h4>
						    </div>
						    </a>
						</li>
						<li>
							<a href="#">
							<div class="activity-con-img" style="background-image: url({pigcms{$static_path}images/xnd_img/275x185.jpg);"></div>
						    <div class="activity-con-right">
						    	<h3>中兴A1全国通网中兴A1全国通网中兴A1全国通网中兴A1全国通网</h3>
						    	<span>&yen;0.01<i><img src="{pigcms{$static_path}images/xnd_img/activity-con-right-cion.jpg" />2321.2km</i></span>
						    	<h4>截止时间：2016.2.28</h4>
						    </div>
						    </a>
						</li>
						<div style="clear: both;"></div>
					</ul>
				</div>
				<!-- 最新提醒 -->
					
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
