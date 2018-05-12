
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
	</head>
	<body class="xnd-phone-bg" style="background: #fff;">
		
		<div class="xnd-phone-center">
			
			<!-- 农场大图 -->
			<div class="xnd-phont-header-img" style="background-image: url({pigcms{$now_activity.pic.0.s_image});"></div>
			<div class="phone-xq-title">
					<h3>{pigcms{$now_activity.name}</h3>
					
			</div>
			<div class="phone-xq-num" style="margin-top: 20px;">
				<span><php>echo getRealAreaName($now_activity['area_id']);</php><php>echo round($now_activity['distance']/1000,2);</php>km</span>
				<h4>官方资深认证</h4>
				
			</div>
			<!-- 农场大图 end -->
			<!-- 已筹、店铺、粉丝 -->
				<div class="xnd-phone-nav">
					<ul>
						<li>
							<h3>{pigcms{$group_count}件</h3>
							<span>特卖</span>
						</li>
						<li>
							<h3>{pigcms{$meal_count}件</h3>
							<span>商品</span>
						</li>
						<li>
							<h3>{pigcms{$now_activity.fans_count}人</h3>
							<span>粉丝</span>
						</li>
						<div style="clear: both;"></div>
					</ul>
					<div style="clear: both;"></div>
				</div>
			<!-- 已筹、店铺、粉丝 -->
			<!-- 店铺信息 -->
				<div class="phone-xq-shop" style="margin-top: 0;">
					<div class="phone-xq-shop-cen">
						<div class="phone-xq-shop-portrait">
							<img src="{pigcms{$now_activity.person_image}">
						</div>
						<div class="phone-xq-shop-title">
							<h3>{pigcms{$now_activity.person_name}馆长</h3>
							<span><b><php>echo getRealAreaName($now_activity['area_id']);</php></b> <php>echo round($now_activity['distance']/1000,2);</php>km</span>
						</div>
						<div class="phone-xq-shop-get">
							<a href="{pigcms{:U('Merchant/detail',array('mer_id'=>$now_activity['mer_id']))}">进店看看</a>
						</div>
						<div style="clear: both;">
							
						</div>
					</div>
				</div>
				
				<!-- 支持者展示 -->
				<div class="phone-xq-details">
						<div class="phone-xq-details-title">
							<span></span>
							<h3>支持者展示</h3>
						</div>
						<ul class="phone-ul-user">
							<if condition="$five">
								<volist name="five" id="one">
							<li><img src="{pigcms{$one.avatar}" /></li>
								</volist>
							<else/>
							<li><p>暂时还没有参与者...</p></li>
							</if>
						</ul>
						<div style="clear: both;"></div>
				</div>
				<!-- 活动图片 -->
				<div class="phone-xq-details">
						<div class="phone-xq-details-title">
							<span></span>
							<h3>活动图片</h3>
						</div>
						<div class="phone-xq-details-con">
							<volist name="now_activity['pic']" id="onepic">
								<img src="{pigcms{$onepic.s_image}">
							</volist>
						</div>
				</div>
			</div>
			<div style="width: 100%; height: 60px;"></div>
			<div class="phone-activity">
				<span>支持者前5名可上头条哦！</span>
				<a href="#">我要参与</a>
			</div>
	</body>
</html>