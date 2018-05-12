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
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?211" charset="utf-8"></script>
		<script type="text/javascript"><if condition="$user_long_lat">var user_long = "{pigcms{$user_long_lat.long}",user_lat = "{pigcms{$user_long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/index.js?210" charset="utf-8"></script>
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
		<div class="xnd-phone-po-bg"></div>
		<div class="xnd-phone-po-div">
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
				<if condition="$wap_index_top_adver">
					<section class="banner">
						<div class="swiper-container swiper-container1">
							<div class="swiper-wrapper">
								<volist name="wap_index_top_adver" id="vo">
									<div class="swiper-slide">
										<a href="{pigcms{$vo.url}">
											<img src="{pigcms{$vo.pic}"/>
										</a>
									</div>
								</volist>
							</div>
							<div class="swiper-pagination swiper-pagination1"></div>
						</div>
					</section>
				</if>
				<if condition="$wap_index_slider">
					
					<section class="">
						<!-- old -->
						<div class="">
							<ul class="Hundreds-nav">
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=有机生鲜"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img1.png"></a></span>
						   	  		<h3>有机生鲜</h3>
						   	  	</li>
						   	    <li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=地方特产"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img2.png"></a></span>
						   	  		<h3>地方特产</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=特色农庄"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img3.png"></a></span>
						   	  		<h3>特色农庄</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=亲子活动"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img4.png"></a></span>
						   	  		<h3>亲子活动</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=农家采摘"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img5.png"></a></span>
						   	  		<h3>农家采摘</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=生态游"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img6.png"></a></span>
						   	  		<h3>生态游</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=特色养殖"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img7.png"></a></span>
						   	  		<h3>特色养殖</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Search&a=group&w=送菜到家"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img8.png"></a></span>
						   	  		<h3>送菜到家</h3>
						   	  	</li>
						   	  	 <div style="clear: both;"></div>
						   	  </ul>
							<div class="swiper-wrapper">
								<volist name="wap_index_slider" id="vo">
									
									<div class="swiper-slide" style="display: none;">
										<ul class="icon-list">
											<volist name="vo" id="voo">
												<li class="icon">
													<a href="{pigcms{$voo.url}">
														<span class="icon-circle">
															<img src="{pigcms{$voo.pic}">
														</span>
														<span class="icon-desc">{pigcms{$voo.name}</span>
													</a>
												</li>
											</volist>
										</ul>
									</div>
								</volist>
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
				<if condition="$activity_list">
					<section class="activity" style="display: none;">
						<div class="activityBox">
							<div class="swiper-container swiper-container4">
								<div class="swiper-wrapper">
									<volist name="activity_list" id="vo">
										<div class="swiper-slide">
											<a href="{pigcms{:U('Wapactivity/detail',array('id'=>$vo['pigcms_id']))}">
												<label>
													<span class="title">参与</span>
													<span class="number">{pigcms{$vo.part_count}</span>
												</label>
												<div class="clock"><span class="time_d">{pigcms{$time_array['d']}</span>天 <span class="timerBox"><span class="timer time_h">{pigcms{$time_array['h']}</span>:<span class="timer time_m">{pigcms{$time_array['m']}</span>:<span class="timer time_s">{pigcms{$time_array['s']}</span></span></div>
												<div class="icon">
													<img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.name}"/>
												</div>
												<div class="desc">
													<div class="name">{pigcms{$vo.name}</div>
													<div class="price">
														<if condition="$vo['type'] eq 1">
															<strong class="yuan">剩{pigcms{$vo['all_count']-$vo['part_count']}</strong>
														<else/>
															<if condition="$vo['mer_score']">
																<strong>{pigcms{$vo.mer_score}积分</strong>
															<else/>
																<strong>￥{pigcms{$vo.mer_score}</strong>
															</if>
														</if>
													</div>
												</div>
											</a>
										</div>
									</volist>
								</div>
							</div>
						</div>
					</section>
				</if>
				<section class="recommend" <if condition="!$wap_index_center_adver">style="height:85px;"</if>>
					<if condition="$wap_index_center_adver">
						<div class="recommendBox">
							<div class="recommendLeft link-url" data-url="{pigcms{$wap_index_center_adver.2.url}">
								<img src="{pigcms{$wap_index_center_adver.2.pic}" alt="{pigcms{$wap_index_center_adver.2.name}"/>
							</div>
							<div class="recommendRight">
								<div class="recommendRightTop link-url" data-url="{pigcms{$wap_index_center_adver.1.url}">
									<img src="{pigcms{$wap_index_center_adver.1.pic}" alt="{pigcms{$wap_index_center_adver.1.name}"/>
								</div>
								<div class="recommendRightBottom link-url" data-url="{pigcms{$wap_index_center_adver.0.url}">
									<img src="{pigcms{$wap_index_center_adver.0.pic}" alt="{pigcms{$wap_index_center_adver.0.name}"/>
								</div>
							</div>
						</div>
					</if>
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
				<if condition="$classify_Zcategorys">
					<section class="classify" style="display: none">
						<div class="headBox">分类信息</div>
						<div class="classifyBox">
							<div class="swiper-container swiper-container3">
								<div class="swiper-wrapper">
									<volist name="classify_Zcategorys" id="vo">
										<if condition="$vo['cat_pic']">
											<div class="swiper-slide">
												<a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])))}">
													<span class="icon">
														<img src="{pigcms{$vo.cat_pic}"/>
													</span>
													<span class="desc">{pigcms{$vo.cat_name}</span>
												</a>
											</div>
										</if>
									</volist>
								</div>
							</div>
						</div>
					</section>
				</if>
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