<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{pigcms{$channel.name}</title>
		
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telphone=no, email=no"/>
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/new-common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/new-xnd-gansu.css"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/hhSwipe.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
	</head>
	<body style="background: #c20a0c;">
		<div class="public_cen">
			
			<!-- nav -->
			<div class="phone-gansu-nav" style="display: none;">
				
				<ul>
					<span class="gansu-icon-nav-lf"><img src="{pigcms{$static_path}images/gansu-icon-nav-lf.png" /></span>
					<volist name="categories" id="cat" key="k">
						<if condition="$k neq 1">
						<a href="#{pigcms{$cat.cat_url}">
						<li>
							<span class="nav-right"></span>
							<span class="nav-bottom"></span>
							{pigcms{$cat.name}
					    </li>
					</a>
					</if>
					</volist>
					<span class="gansu-icon-nav-rg"><img src="{pigcms{$static_path}images/gansu-icon-nav-rg.png" /></span>
					<div style="clear: both;"></div>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<volist name="categories" id="cat" key="k">
				<if condition="$k eq 1">
					<php>$goodslist=getCatGoodsList($cat['id']);</php>
					<if condition="$goodslist">
					<!-- 农场特卖推荐 -->
					<div class="xinnian-top">
					<!-- 顶部banner图 -->
					<div class="xinnian-banner">
						<img src="{pigcms{$static_path}images/xinnian-banner.jpg" />
					</div>
					<!-- 农场特卖推荐 -->
					<div class="nav-top-img" style="position: absolute; bottom: -10px;">
						<img src="{pigcms{$static_path}images/nav-bg.png" />
						<div class="phone-gansu-tj-title">
							<a>{pigcms{$cat.name}</a>
						</div>
					</div>
					</div>
					<div class="phone-gansu-tj-nav" style="position: relative; top: 10px;">
						<ul>
							<volist name="goodslist" id="goods">
							<li>
								<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$goods.group_id}">
								<div class="phone-gansu-tj-img" style="background-image: url({pigcms{$goods.all_pic.0.m_image});"></div>
								<div class="phone-gansu-tj-right">
									<h3>{pigcms{$goods.s_name}</h3>
									<p>{pigcms{$goods.group_name}</p>
									<div class="phone-gansu-tj-btm">
										<span>销售：<php>echo $goods['sale_count']+$goods['virtual_num'];</php></span>
										<h4><b>{pigcms{$goods.price}元</b>/份</h4>
									</div>
								</div>
								<div style="clear: both;"></div>
								</a>
							</li>
							</volist>
						</ul>
						<div style="clear: both;"></div>
					</div>
			<!-- 农场特卖推荐end -->
			</if>
					<else/>
			<!-- 分类推荐Start -->
			<php>$goodslist=getCatGoodsList($cat['id']);</php>
			<if condition="$goodslist">
					<a name="{pigcms{$cat.cat_url}"></a>
					<div class="nav-top-img">
						<img src="{pigcms{$static_path}images/nav-bg.png" />
							<div class="phone-gansu-tj-title">
							<a>{pigcms{$cat.name}</a>
						</div>
					</div>
				<div class="phone-gansu-tj-nav">
				<ul>
					<volist name="goodslist" id="goods">
					<li>
						<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$goods.group_id}">
						<div class="phone-gansu-tj-img" style="background-image: url({pigcms{$goods.all_pic.0.m_image});"></div>
						<div class="phone-gansu-tj-right">
							<h3>{pigcms{$goods.s_name}</h3>
							<p>{pigcms{$goods.group_name}</p>
							<div class="phone-gansu-tj-btm">
								<span>销售：<php>echo $goods['sale_count']+$goods['virtual_num'];</php></span>
								<h4><b>{pigcms{$goods.price}元</b>/份</h4>
							</div>
						</div>
						<div style="clear: both;"></div>
						</a>
					</li>
					</volist>
				</ul>
				<div style="clear: both;"></div>
				</div>
				<!-- 分类推荐end -->
				</if>
				</if>
			</volist>
			<!-- 下面为隐藏部分，勿删除，可忽略 -->
			<div class="phone-gansu-ts-nav" style="display: none;">
				<div class="phone-gansu-ts-title">
					<img src="img/gansu-nav09.jpg" />
				</div>
				<ul>
					<li>
						<div class="phone-gansu-ts-img" style="background-image: url(img/275x185.jpg);"></div>
						<h3>丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元</h3>
						<b>&yen;168.00</b>
					</li>
					<li>
						<div class="phone-gansu-ts-img" style="background-image: url(img/275x185.jpg);"></div>
						<h3>丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元</h3>
						<b>&yen;168.00</b>
					</li>
					<li>
						<div class="phone-gansu-ts-img" style="background-image: url(img/275x185.jpg);"></div>
						<h3>丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元</h3>
						<b>&yen;168.00</b>
					</li>
					<li>
						<div class="phone-gansu-ts-img" style="background-image: url(img/275x185.jpg);"></div>
						<h3>丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元丹麦进口饼干0.25元</h3>
						<b>&yen;168.00</b>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="copy_footer"><img src="{pigcms{$static_path}images/xnd-logo.png"></div>
		</div>
		
			<style>
				.fox-right{
					position: fixed;
					bottom: 20px;
					right: 2%;
					z-index: 10000000;
					display: none;
				}
				.fox-right img{
					width: 40px;
				}
			</style>
			<div class="fox-right" id="btn_top">
				<a href="#"><img src="{pigcms{$static_path}images/gansu-top.png" /></a>
			</div>
			<script>
				$(function () {
				    $(window).scroll(function () {
				        if ($(window).scrollTop() >= 150) {
				            $('#btn_top').fadeIn();
				        }
				        else {
				            $('#btn_top').fadeOut();
				        }
				    });
				});
				$('#btn_top').click(function () {
				    $('html,body').animate({ scrollTop: 0 }, 500);
				});
			</script>
		
         <!--分享-->
    <script type="text/javascript">
		var shareData={
					imgUrl: "{pigcms{$config.site_url}/upload/channelshare/{pigcms{$channel.share_pic}", 
					<if condition="$_SESSION['distribution_id']">
					link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url'],'share_distribution_id'=>$_SESSION['distribution_id']))}",
					<elseif condition="$_SESSION['share_distribution_id']"/>
					link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url'],'share_distribution_id'=>$_SESSION['share_distribution_id']))}",
					<else/>
					link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url']))}",
					</if>
					title: "{pigcms{$channel.share_title}",
					desc: "{pigcms{$channel.share_desc}"
		};
	</script>
	<include file="Share:share"/>
	</body>
</html>
