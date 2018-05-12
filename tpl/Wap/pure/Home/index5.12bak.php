<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>{pigcms{$config.site_name}</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?215"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index.css?217"/>
		
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?211" charset="utf-8"></script>
		<script type="text/javascript"><if condition="$user_long_lat">var user_long = "{pigcms{$user_long_lat.long}",user_lat = "{pigcms{$user_long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/index.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
	    <style>
			.xnd-phone-po-bg{
				position: fixed;
				left: 0;
				top: 0;
				background: #000000;
				opacity: 0.7;
				z-index: 100000;
				width: 100%;
				height: 100%;
			}
			.xnd-phone-po-div{
				width: 200px;
				margin: 0px auto;
				position: fixed;
				z-index: 100001;
				top: 30%;
				left: 50%;
				text-align: center;
				margin-left: -100px;
			}
			.po-img{
				width: 200px;
				text-align: center;
				margin: 20px auto;
			}
			.po-close{
				width: 35px;
				height: 35px;
				position: absolute;
				right: 0px;
				top: -30px;
			}
		</style>
	</head>
	<body>
		<div class="xnd-phone-po-bg" style="display: none;"></div>
		<div class="xnd-phone-po-div" style="display: none;">
			<img src="{pigcms{$static_path}images/xnd-phone-po-close.png" class="po-close" />
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Topic&a=gansu">
				<img src="{pigcms{$static_path}images/xnd-phone-po-div-img.png" class="po-img" />
			</a>
		</div>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<header>

					<div id="locaitonBtn" class="link-url" data-url="{pigcms{:U('home/areaselect')}" >  </div>
                    <style>
                         .areaname{
                             display: block;
                             padding: 0 0 0 47px;
                             height: 50px;
                             line-height: 52px;
                             border: none;
                             font-size: 16px;
                             color: #fff;

                         }
                    </style>
                    <div class="areaname" ><?php  echo $_SESSION['cityarr']['0']['area_name']; ?></div>



					<div id="searchBox" style="margin-right:10px">
						<a href="{pigcms{:U('Search/index')}">
							<i class="icon-search"></i>
							<span>请输入您内容</span>
						</a>
					</div>
					<div id="">  </div>
				</header>
				<if condition="$wap_index_slider">
					
					<section class="">
						<!-- old -->
						<div class="">
							<ul class="Hundreds-nav">
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=shengxianroulei"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img1.png"></a></span>
						   	  		<h3>有机生鲜</h3>
						   	  	</li>
						   	    <li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=jiaxiangweizhutiguan"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img2.png"></a></span>
						   	  		<h3>地方特产</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=zhutinongzhuang"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img3.png"></a></span>
						   	  		<h3>特色农庄</h3>
						   	  	</li>
						   	  	
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Wapactivity&a=index"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img4.png"></a></span>
						   	  		<h3>亲子活动</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=caizhaiyuan"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img5.png"></a></span>
						   	  		<h3>农家采摘</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=teseshengtaiyou"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img6.png"></a></span>
						   	  		<h3>生态游</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Group&a=index&cat_url=yangzhichang"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img7.png"></a></span>
						   	  		<h3>特色养殖</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Meal_list"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img8.png"></a></span>
						   	  		<h3>送菜到家</h3>
						   	  	</li>
						   	  	 <div style="clear: both;"></div>
						   	  </ul>
							<div class="swiper-wrapper">
							</div>
							<div class="swiper-pagination swiper-pagination2" style="display: none;"></div>
						</div>
					</section>
				</if>
				<if condition="$invote_array">
					<section class="invote">
						<a href="{pigcms{$invote_array.url}">
							<img src="{pigcms{$invote_array.avatar}"/>
							{pigcms{$invote_array.txt}
							<button>关注我们</button>
						</a>
					</section>
				<elseif condition="$share"/>
					<section class="invote">
						<a href="{pigcms{$share.a_href}">
							<img src="{pigcms{$share.image}"/>
							{pigcms{$share.title}
							<button>{pigcms{$share['a_name']}</button>
						</a>
					</section>
				</if>
				<section class="recommend" <if condition="!$wap_index_center_adver">style="height:85px;"</if>>
					<div class="nearBox">
						<ul>
							<li>
								<div class="nearBoxDiv merchant link-url" data-url="{pigcms{:U('Meal_list/index')}">
									<div class="title">附近商家</div>
									<div class="desc">快速找到商家</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv group link-url" data-url="{pigcms{:U('Group/index')}">
									<div class="title">附近{pigcms{$config.group_alias_name}</div>
									<div class="desc">看得到的便宜</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv store link-url" data-url="{pigcms{:U('Meal_list/index')}">
									<div class="title">附近{pigcms{$config.meal_alias_name}</div>
									<div class="desc">购物无需等待</div>
									<div class="icon"></div>
								</div>
							</li>
						</ul>
					</div>
				</section>
				<section class="youlike hide">
					<div class="headBox">猜你喜欢</div>
					<dl class="likeBox dealcard"></dl>
				</section>
				<script id="indexRecommendBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{{ d[i].list_pic }}" alt="{{ d[i].s_name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{# if(d[i].tuan_type != 2){ }} {{ d[i].merchant_name }}  {{# if(d[i].range){ }}<span class="location-right">{{ d[i].range }}</span>{{# } }}   {{# }else{ }} {{ d[i].s_name }} {{# } }}</div>								
								<div class="title">{{ d[i].group_name }}</div>
								<div class="price">
									<strong>{{ d[i].price }}</strong><span class="strong-color">元</span>{{# if(d[i].wx_cheap){ }}<span class="tag">微信再减{{ d[i].wx_cheap }}元</span>{{# }else{ }}<del>{{ d[i].old_price }}</del>{{# } }} <span class="line-right">已售{{ d[i].sale_count }}</span>
								</div>
							</div>
						</dd>
					{{# } }}
				</script>			
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$config.site_logo}" style="height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
		<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$config.wechat_share_img}", 
						link: "{pigcms{$config.site_url}/wap.php",
						title: "小农丁- 国内首家农场创意众筹 ，地标农特产品预售团购及农家乐特色活动体验O2O生态农场平台",
						desc: "国内首家农场创意众筹 ，地标农特产品预售团购及农家乐特色活动体验O2O生态农场平台"
			};
		</script>
		 <include file="Public:share"/>
		<script type="text/javascript">
		$(document).ready(function(){
		  $(".po-close").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		});
	</script>
	</body>
</html>