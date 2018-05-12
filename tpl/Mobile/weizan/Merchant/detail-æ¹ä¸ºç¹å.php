<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>农场详情</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
	</head>
	<body style="background: #f4f4f4;">
		
		<div class="xnd-phone-center">
			<!-- 农场大图 -->
			<div class="xnd-phont-header-img" style="background-image: url({pigcms{$merchant.merchant_theme_image});">
				<img src="{pigcms{$merchant.person_image}" />
			</div>
			<div class="phone-xq-title">
					<h3>{pigcms{$merchant.person_name}馆长</h3>
			</div>
			<div class="phone-fram-num">
				<h4><img src="{pigcms{$static_path}images/xnd_img/phone-xq-num.jpg">官方资深认证<span><php>echo getRealAreaName($merchant['area_id']);</php><php>echo round($merchant['distance']/1000,2);</php>km</span></h4>
			</div>
			<!-- 店铺信息 -->
			<div class="phone-fram-shop">
				<div class="fram-shop-left">
					<p>【客服电话】{pigcms{$merchant.merchant_phone}</p>
				</div>
				<a id="collect-a" class="phone-fram-sc" onclick="addCollect({pigcms{$merchant.mer_id});" style="cursor:pointer;">
					<img src="{pigcms{$static_path}images/xnd_img/iconfont-shoucang.png">
					<if condition="$is_collect">
					<span >已收藏</span>
					<else/>
					<span id="collect">收藏</span>
					</if>
				</a>
				<div style="clear: both;"></div>
			</div>
			<!-- 4个导航农场 -->
			<div class="phone-fram-nav">
				<ul>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id={pigcms{$merchant.mer_id}">
						<img src="{pigcms{$static_path}images/xnd_img/phone-show-nav01.jpg" />
						<span class="line-btm"></span>
						<h4>农场特卖</h4>
						</a>
						<span class="line-right"></span>
					</li>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id={pigcms{$merchant.mer_id}">
						<img src="{pigcms{$static_path}images/xnd_img/phone-show-nav02.jpg" />
						<span class="line-btm"></span>
						<h4>农场活动</h4>
						</a>
						<span class="line-right"></span>
					</li>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getPicturesList&mer_id={pigcms{$merchant.mer_id}">
						<img src="{pigcms{$static_path}images/xnd_img/phone-show-nav03.jpg" />
						<span class="line-btm"></span>
						<h4>农场相册</h4>
						</a>
						<span class="line-right"></span>
					</li>
					<li>
						<a href="/mobile.php?g=Mobile&c=Merchant&a=getInfo&mer_id={pigcms{$merchant.mer_id}">
						<img src="{pigcms{$static_path}images/xnd_img/phone-show-nav04.jpg" />
						<span class="line-btm"></span>
						<h4>我的农场</h4>
						</a>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			
			<div class="phone-xq-details-title">
				<span></span>
				<h3>店长推荐</h3>
			</div>
			<div class="xnd-phone-more">
				<ul>
					<if condition="$meals">
					<volist name="meals" id="meal">
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$meal.image.s_image});">
						</div>
						<h3 class="xnd-phone-more-tit">{pigcms{$meal.name}</h3>
						<div class="xnd-phone-more-con">
							<span><b>{pigcms{$meal.price}</b>/{pigcms{$meal.unit}</span>
							<h3>销售：{pigcms{$meal.sell_count}</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					</volist>
					<else/>
					<li>暂时还没有推荐商品...</li>
					</if>
				</ul>
				<div style="clear: both;"></div>
			</div>
		</div>
			<div style="width: 100%; height: 60px;" style="display: none;"></div>
			<div class="phone-fram" style="display: none;">
				<span></span>
				<a href="/mobile.php?g=Mobile&c=Merchant&a=getActivityList&mer_id={pigcms{$merchant.mer_id}">农场活动<a>
				<a href="/mobile.php?g=Mobile&c=Merchant&a=getGroups&mer_id={pigcms{$merchant.mer_id}">推荐商品</a>
			</div>
		<script type="text/javascript">
		function addCollect(id){
			 $.post("{pigcms{:U('Merchant/addMerchantCollect')}",{id:id},function(result){
			 	var obj = eval('(' + result + ')');
    			if(obj.status==1){
    			if($("#collect").html()=="收藏"){
    				$("#collect").html("已收藏");
    			}else{
    				$("#collect").html("收藏");
    			}
    			}else{
    				if(obj.msg=="login"){
    					alert("请先登录！");
    					window.location.href='app:redirect:{pigcms{$config.site_url}/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='+id;
    				}else{
    					alert(obj.msg);
    				}
    			}
  			 });
		}
		</script>
	</body>
</html>