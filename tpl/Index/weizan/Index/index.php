﻿<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>{pigcms{$config.seo_title}</title>
	<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}" />
        <meta name="baidu-site-verification" content="WBViD3WLT9" />
	<link href="http://www.xiaonongding.com/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
	<!-- 王强新增 -->
    <link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" /><!-- 全局基础样式 -->
	<link href="{pigcms{$static_path}css/xnd_css/index_block.css" rel="stylesheet" /> <!--首页版块样式 -->
	<link href="{pigcms{$static_path}css/xnd_css/shop-list.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
	<link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.css" rel="stylesheet" /><!-- 头部样式 -->
	<link href="{pigcms{$static_path}css/xnd_css/footer.css.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
	<script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script><!-- 焦点图左侧大导航js -->
	<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
	<!--[if lte IE 8]>
	<script src="{pigcms{$static_path}js/xnd_js/respond.min.js"></script>
	<![endif]-->
	<!-- 王强新增end -->
	
	
	
	<if condition="$config['wap_redirect']">
		<script>
			if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
			<if condition="$config['wap_redirect'] eq 1">
				window.location.href = './wap.php';
			<else/>
				if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
					window.location.href = './wap.php';
				}
			</if>
			}
		</script>
	</if>
	<style>
			.guanggao-top{
				width: 100%;
				height: 80px;
				background: #cc1a1a;
				text-align: center;
			}
			.guanggao-top img{
				height: 80px;
			}
		</style>
</head>
<body>
<div class="guanggao-top" style="display: none;">
	<img src="{pigcms{$static_path}images/xnd_img/header-banner.jpg" />
</div>
<include file="Public:head_topnew"/>
<!-- 王强新增 -->
<!-- 首屏 -->
		<div class="zw-home-firstfocus">
			<!-- 焦点图 -->
			<div class="zw-home-sliders" id="homeSliders">
				<php>$list=getAdvList("home_top",1);</php>
				<ul class="zw-home-sliders-list">
					<volist name="list" id="adv">	
					<li style="background-image:url({pigcms{$config.site_url}/upload/adver/{pigcms{$adv.pic});">
						<a href="{pigcms{$adv.url}" target="_blank"></a>
					</li>
					</volist>
				</ul>
				<p class="btn-arrow prev">
					<span class="zwui-iconfont icon-arrow-left"></span>
				</p>
				<p class="btn-arrow next">
					<span class="zwui-iconfont icon-arrow-right"></span>
				</p>
			</div>
			<!-- 焦点图 end -->
			<!-- 热门类目 -->
			<style>
				.zw-icon img{
					width: 20px;
					margin-top: 7px;
				}
			</style>
			<div class="zw-home-category" id="zwCategory">
				<ul class="zw-home-category-list" id="zwCategoryList">
					<volist name="all_category_list" id="vo" key="k">
						<if condition="$k==0">
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img alt="{pigcms{$voo.cat_name}" src="{pigcms{$static_path}/css/img/icon-remai.png" /></span>
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==1"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-remai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==2"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-shengxian.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==3"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-shucai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==4"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-wugu.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==5"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-shengtai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<elseif condition="$k==6"/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-zhiwu.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<else/>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="{pigcms{$static_path}/css/img/icon-techan.png" /></span>
						</p>
						<h2 class="zw-home-category-title">{pigcms{$vo.cat_name}</h2>
						<p class="zw-home-category-subtitle">
							<if condition="$vo['cat_count'] gt 1">
						<volist name="vo['category_list']" id="voo" key="j">
								<a  href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name} </a>
						</volist>
						</if>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
 				</if>
				</volist>
				</ul>

				<div class="zw-home-category-contents" id="zwCategoryContents">

					<div class="zw-home-category-content">
						<div class="column">

							<div class="zw-home-category-place">
								<h2 class="bigtitle">新鲜水果</h2>

								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/hwjk" target="_blank">苹果 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jgl" target="_blank">柑橘 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/gjl" target="_blank">猕猴桃 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hgl" target="_blank">柚子 </a>
									</li>
									
									
									<li>
										<a href="http://www.xiaonongding.com/category/rgl" target="_blank">石榴 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/qts" target="_blank">百香果 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jianshen" target="_blank">芒果 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/kafeijiuba" target="_blank">菠萝 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/zhuyou" target="_blank">梨 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jingdianjiaoyou" target="_blank">榴莲 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/zhutigongyuan" target="_blank">鲜枣 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/caizhai" target="_blank">木瓜</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/diy" target="_blank">野生沙棘 </a>
									</li>
									
								</ul>
							</div>

						</div>
					</div>
					<div class="zw-home-category-content">
						<div class="column">

							<div class="zw-home-category-place">
								<h2 class="bigtitle">肉禽蛋奶</h2>
								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/qdl" target="_blank">鸡肉 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/srl" target="_blank">牛肉 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hcbx" target="_blank">猪肉 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/srl" target="_blank">羊肉 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hcgh" target="_blank">鸭肉 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/zbys" target="_blank">肠类 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/qt" target="_blank">蛋类 </a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/rqsx" target="_blank">馒饼 </a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="zw-home-category-content">
						<div class="column">
							<div class="zw-home-category-place">
								<h2 class="bigtitle">时令鲜蔬</h2>
								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/gcl" target="_blank" class="hot">番薯</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jcl" target="_blank">土豆</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ycl" target="_blank">芋头</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hcl" target="_blank">菜干</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jl" target="_blank">花菜</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jiafang" target="_blank">灵芝</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/shoushi" target="_blank">猴头菇</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/jiadian" target="_blank">蘑菇</a>
									</li>
								</ul>
							</div>

						</div>
						
					</div>
					<div class="zw-home-category-content">
						<div class="column">

							<div class="zw-home-category-place">
								<h2 class="bigtitle">粮油干货</h2>
								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/mimian" target="_blank">米面</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/wugu" target="_blank">五谷杂粮</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ganhuo" target="_blank">干货</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/liao" target="_blank" class="hot">调味料</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/you" target="_blank">食用油</a>
									</li>
								</ul>
							</div>

						</div>
						
					</div>
					<div class="zw-home-category-content">
						<div class="column">

							<div class="zw-home-category-place">
								<h2 class="bigtitle">休闲食品</h2>
								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/jgl" target="_blank">坚果类</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ls" target="_blank">零食</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ls" target="_blank">糕点/饼干</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ph" target="_blank" class="hot">膨化/薯片</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/ht" target="_blank">海苔/紫菜</a>
									</li>
								</ul>
							</div>

						</div>
					</div>
					<div class="zw-home-category-content">
						<div class="column">
							<div class="zw-home-category-place">
								<h2 class="bigtitle">酒水茶饮</h2>
								<ul class="list">
									<li>
										<a href="http://www.xiaonongding.com/category/hddq" target="_blank">酒类</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hndq" target="_blank">冲饮</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hbdq" target="_blank">蜂蜜</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/category/hndq" target="_blank">茶类</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 热门类目 end -->
		</div>
		<!-- 首屏 end -->
		<!-- 今日特卖 -->
		<style>
			.main-guanggao{
				width: 100%;
				margin: 0px auto;
				height: auto;
				position: relative;
				
			}
			.xiaonongding-bg{
				width: 100%;
				margin: 0px auto;
				height: 400px;
				background: url({pigcms{$static_path}images/xnd_img/xnd-bg.png) top center no-repeat;
				position: absolute;
				top: -35px;
				z-index: 10;
				display: none;
			}
			.zw-home-todaysale{
				position: relative;
				z-index: 100;
				width: 1160px;
				max-width: 1160px;
				padding: 0 0 0 0 ;
				margin: 35px auto;
			}
		</style>
		
		<div class="main-guanggao">
		<div class="xiaonongding-bg">
		</div>
		<div class="zw-home-todaysale">
			<div class="zw-home-todaysale-wrap">
				<div class="zw-home-titlerow clearfix">
					<h2 class="zw-home-bigtitle fontYaHei">限时特卖</h2>
					<p class="zw-home-subtitle">每日一荐超值农特产品</p>
					<p class="zw-home-switch" id="tdsaleBtn">
						<span class="zwui-iconfont icon-refresh"></span>换一换
					</p>
				</div>
				<div class="zw-home-todaysale-content" id="tdsaleContent">
					<ul class="zw-home-todaysale-list clearfix">
					<for start="0" end="3">
						<if condition="$index_tui_group_list[$i]">
						<li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3>{pigcms{$index_tui_group_list[$i].s_name}</h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank">
										<div class="buytoday-photo">
											<img src="{pigcms{$index_tui_group_list[$i].list_pic}" alt="{pigcms{$index_tui_group_list[$i].name}">
											<div class="cont">
												<p>{pigcms{$index_tui_group_list[$i].name}</p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em>{pigcms{$index_tui_group_list[$i].price}</em>元起<del >原价：{pigcms{$index_tui_group_list[$i].old_price}元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><php>if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];}</php></a>
									</span>
								</div>
							</div>
						</li>
						<else/>
					</if>
					</for>
					</ul>
					<if condition="$index_tui_group_list[3]">
					<ul class="zw-home-todaysale-list clearfix" style="display:none;">
						<for start="3" end="6">
							<if condition="$index_tui_group_list[$i]">
						<li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3>{pigcms{$index_tui_group_list[$i].s_name}</h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank">
										<div class="buytoday-photo">
											<img src="{pigcms{$index_tui_group_list[$i].list_pic}" alt="{pigcms{$index_tui_group_list[$i].s_intro}">
											<div class="cont">
												<p>{pigcms{$index_tui_group_list[$i].s_intro}</p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em>{pigcms{$index_tui_group_list[$i].price}</em>元起<del >原价：{pigcms{$index_tui_group_list[$i].old_price}元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><php>if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];}</php></a>
									</span>
								</div>
							</div>
						</li>
						<else/>
					</if>
					</for>
					</ul>
					</if>
						<if condition="$index_tui_group_list[6]">
					<ul class="zw-home-todaysale-list clearfix" style="display:none;">
						<for start="6" end="9">
						<if condition="$index_tui_group_list[$i]">
						<li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3>{pigcms{$index_tui_group_list[$i].s_name}</h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank">
										<div class="buytoday-photo">
											<img src="{pigcms{$index_tui_group_list[$i].list_pic}" alt="{pigcms{$index_tui_group_list[$i].s_title}">
											<div class="cont">
												<p>{pigcms{$index_tui_group_list[$i].s_title}</p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/{pigcms{$index_tui_group_list[$i].group_id}.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em>{pigcms{$index_tui_group_list[$i].price}</em>元起<del >原价：{pigcms{$index_tui_group_list[$i].old_price}元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><php>if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];}</php></a>
									</span>
								</div>
							</div>
						</li>
						<else/>
					</if>
					</for>
					</ul>
				</if>
					</div>
			</div>
		</div>
		
		</div>
		<!-- 今日特卖 end -->
		<!-- 推荐农场  start -->
		<div class="zw-home-todaysale" >
			<div class="zw-home-todaysale-wrap">
				<div class="zw-home-titlerow clearfix">
					<h2 class="zw-home-bigtitle fontYaHei">发现农场</h2>
					<p class="zw-home-subtitle">产地溯源、回归自然！小农丁为您推荐国内最优质的生态农场</p>
					<ul class="zw-home-tags">
						<li style="border-bottom: 0;">
							<a style="color: #636363;" href="http://www.xiaonongding.com/farm/index.html" target="_blank">查看更多农场>></a>
						</li>
					</ul>
				</div>
				<div class="hottravels" style="margin-top: 40px;">
					<div class="slider slider-hottravels">
						
						<div class="slider-inner">
							<div class="item" style="display: block;">
								<ul>
									<if condition="$merchant_list">
										<volist name="merchant_list" id="farm">
										<li>
										<div class="travel">
											<a href="{pigcms{$config.site_url}/merindex/{pigcms{$farm.desc}.html" target="_blank">
											<div class="photo" style="background-image:url({pigcms{$farm.merinfo.merchant_theme_image});">
												<div class="like">
													<i class="iconfont icon-xiangqu1"></i> {pigcms{$farm.merinfo.fans_count}人关注
												</div>
											</div>
											</a>
											<div class="inner">
												<div class="info">
													<span class="avatar">
														<a href="{pigcms{$config.site_url}/merindex/{pigcms{$farm.merinfo.mer_id}.html" target="_blank">
															<img class="lazy" src="{pigcms{$farm.merinfo.person_image}" style="display: inline;">
														</a>
													</span>
												</div>
												<a href="" target="_blank">
													<div class="caption">
														<h3>{pigcms{$farm.merinfo.name}<span>农场主：{pigcms{$farm.merinfo.person_name}</span></h3>
														<p>{pigcms{$farm.merinfo.txt_info}</p>
													</div>
												</a>
											</div>
										</div>
										</li>
										</volist>
									<else/>
										<li><h3>目前还没有推荐的农场</h3></li>
									</if>
								</ul>
							</div>
							</div>
					</div>
					</div>
			</div>
		</div>

<!-- 一起玩众筹 -->
<div class="zw-home-ziyouxing" style="display: none;">
    <div class="zw-home-ziyouxing-wrap">
        <div class="zw-home-titlerow clearfix">
            <h2 class="zw-home-bigtitle fontYaHei">农丁众筹</h2>
            <p class="zw-home-subtitle">和小伙伴们众筹一方土地，种植自己的私家果园，亲手采摘，乐享自然！</p>
            <ul class="zw-home-tags">
                <li class="active">
                    <a href="" target="_blank">今日推荐</a>
                </li>
                <li style="display: none;">
                    <a href="" target="_blank">一起种地</a>
                </li>
                <li style="display: none;">
                    <a href="" target="_blank">一起种地</a>
                </li>
            </ul>
        </div>
        <div class="zw-home-ziyouxing-content">
            <ul class="zw-home-ziyouxing-list clearfix">
                <volist name="crowdlist" id="crowd" key="k" >
                    <if condition="$k eq 1 ">
                        <li class="zw-home-ziyouxing-one">
                            <a href="http://www.xiaonongding.com/index.php?g=Index&c=Crowdfunding&a=detail&crowd_id={pigcms{$crowd.crowd_id}" target="_blank">
                                <p class="pics">
                                    <img class="lazy" data-original="{pigcms{$crowd.webpic}" src="{pigcms{$crowd.webpic}" width="570" height="267" style="position:relative; top:0px;">
                                </p>
                                <div class="infos" style="display: none;">
                                    <p class="type">已达:43%</p>
                                    <p class="price">已筹:&yen;<em>199</em></p>
                                </div>
                                <div class="titles">
                                    <h3 class="title">{pigcms{$crowd.title}</h3>
                                    <p class="time" style="display: none;">开始时间：<?php echo date("Y/m/d",$crowd['starttime']) ?></p>
                                </div>
                            </a>
                        </li>
                        <else />
                        <li class="zw-home-ziyouxing-item">
                            <a href="http://www.xiaonongding.com/index.php?g=Index&c=Crowdfunding&a=detail&crowd_id={pigcms{$crowd.crowd_id}" target="_blank">
                                <p class="pics">
                                    <img class="lazy" data-original="{pigcms{$crowd.webpic}" src="{pigcms{$crowd.webpic}" width="275" height="183">
                                </p>
                                <div class="infos" style="display: none;">
                                    <p class="type">已达:65%</p>
                                    <p class="price">已筹:&yen;<em>395</em></p>
                                </div>
                                <!-- 进度条 -->
                                <div class="votebox">
                                    <dl class="barbox">
                                        <dd class="barline">
                                            <div w="33" style="width:0px;" class="charts"></div>
                                        </dd>
                                    </dl>
                                </div><!-- 进度条end -->
                                <div class="titles">
                                    <h3 class="title">{pigcms{$crowd.title}</h3>
                                </div>
                            </a>
                        </li>
                    </if>

                </volist>

                <li class="zw-home-channel-more zw-home-ziyouxing-more">
                    <div class="titles">
                        <a href="" target="_blank">
                            <p class="title">查看更多
                                <br>一起玩众筹</p>
                            <p class="arrow">
                                <span class="zwui-iconfont icon-more"></span>
                            </p>
                        </a>
                    </div>
                    <p class="list">
                        <a href="" target="_blank">西瓜</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="" target="_blank">土豆</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="" target="_blank">菜籽油</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="" target="_blank">红辣椒</a>
                    </p>
                </li>
            </ul>


        </div>
    </div>
</div>
		<!-- 推荐农场  end -->

		
			<!-- 主题推荐 -->
		<div class="zw-home-zhuanti" >
			<div class="zw-home-zhuanti-wrap">
				<div class="zw-home-titlerow clearfix">
					<h2 class="zw-home-bigtitle fontYaHei">F2F农场生态游</h2>
					<p class="zw-home-subtitle">组织亲朋好友回归自然，体验乡村，感受休闲观光生态农场的魅力与不凡</p>

				</div>
					<div class="zw-home-zhuanti-content">
					<ul class="zw-home-zhuanti-list clearfix">
					<volist name="toptui" id="activities" key="k">

						<if condition="$k==1">


						<li class="zw-home-zhuanti-one">
							<a href="{pigcms{$activities.url}" target="_blank" >
								<p class="pics">
									<img class="lazy" data-original="{pigcms{$activities.merinfo.pic.image}" src="{pigcms{$activities.merinfo.pic.image}" width="570" height="auto" style="position:relative; top:-56px;">
								</p>
								<div class="mask"></div>
								<h3 class="title"> {pigcms{$activities.merinfo.s_name}</h3>
								<p class="price"><em>{pigcms{$activities.merinfo.price}</em>元起</p>
							</a>
						</li>

						<else/>
						<li class="zw-home-zhuanti-item">
							<a href="{pigcms{$activities.url}" target="_blank">
								<p class="pics">
									<img class="lazy" data-original="{pigcms{$activities.merinfo.pic.image}" src="{pigcms{$activities.merinfo.pic.image}" width="275" height="auto" style="position:relative; top:-12px;">
								</p>
								<div class="infos">
									<h3 class="title"> {pigcms{$activities.merinfo.s_name}</h3>
									<p class="price"><em>{pigcms{$activities.merinfo.price}</em>元起</p>
								</div>
							</a>
						</li>
					</if>
					</volist>
						<li class="zw-home-channel-more zw-home-zhuanti-more">
							<div class="titles">
								<a href="/activity/" target="_blank">
									<p class="title">查看更多<br>农场生态游</p>
									<p class="arrow">
										<span class="zwui-iconfont icon-more"></span>
									</p>
								</a>
							</div>
							<p class="list">
								<a href="" target="_blank">钓鱼</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="" target="_blank" >采摘</a>&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href="" target="_blank" >种植</a>
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- 主题推荐 end -->

	
		
		
		
		
		
		
		
		
		
		<!-- 城市玩乐 -->
		<div class="zw-home-wanle">
			<div class="zw-home-wanle-wrap">
				<div class="zw-home-titlerow clearfix">
					<h2 class="zw-home-bigtitle fontYaHei">农丁头条</h2>
					<p class="zw-home-subtitle">发现最新农业资讯，分享新农人创业故事</p>
					<ul class="zw-home-tags"> 
						<volist name="text_cat" id="cat" key="k">
								<if condition="$k eq 1">
									<li class="active"><a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank">{pigcms{$cat.name}</a></li>
									<else/>
									<li><a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank">{pigcms{$cat.name}</a></li>
								</if>
						</volist>
					</ul>
				</div>
				<div class="zw-home-wanle-content">
					<volist name="artList" id="onelist" key="k">
						<if condition="$k eq 1">
							<ul class="zw-home-wanle-list clearfix">
								<volist name="onelist" id="article" key="j">
									<if condition="$j eq 1">
										<li class="zw-home-wanle-one">
											<a href="./article/{pigcms{$article.pigcms_id}.html" target="_blank">
												<p class="pics" style="background-image:url({pigcms{$config.site_url}{pigcms{$article.cover_pic});" style="position:relative; left:-14px;">
												</p>
												<div class="mask"></div>
												<h3 class="title">{pigcms{$article.title}</h3>
												<div class="infos clearfix" style="display: none;">
													<p class="price"><em><php>echo getAreaName($article['area_id']);</php></em></p>
												</div>
											</a>
										</li>
										<elseif condition="$j eq 4"/>
											<li class="zw-home-channel-more zw-home-wanle-more">
												<div class="titles">
													<a href="/article/index.html" target="_blank" >
														<p class="title">查看更多<br>农丁热点</p>
														<p class="arrow">
															<span class="zwui-iconfont icon-more"></span>
														</p>
													</a>
												</div>
												<p class="list">
													<volist name="text_cat" id="cat" key="k">
														<if condition="$k eq count($text_cat)">
															<a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank" >{pigcms{$cat.name}</a>
															<else/>
															<a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank" >{pigcms{$cat.name}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
														</if>
													</volist>
												</p>
											</li>
											<li class="zw-home-wanle-item">
												<a href="/article/{pigcms{$article.pigcms_id}.html" target="_blank">
													<p class="pics">
														<img class="lazy" alt="{pigcms{$article.title}" data-original="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" src="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" width="120" height="120">
													</p>
													<h3 class="title">{pigcms{$article.title}</h3>
													<p class="ico"><if condition="mb_strlen($article['digest'],'utf-8') gt 28"><php>echo mb_substr($article['digest'],0,28,"utf-8")."...";</php><else/><php>echo $article['digest'];</php></if></p>
													<em class="price"><php>echo getAreaName($article['area_id']);</php></em>
												</a>
											</li>
											<else/>
											<li class="zw-home-wanle-item">
												<a href="/article/{pigcms{$article.pigcms_id}.html" target="_blank">
													<p class="pics">
														<img class="lazy" alt="{pigcms{$article.title}" data-original="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" src="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" width="120" height="120">
													</p>
													<h3 class="title">{pigcms{$article.title}</h3>
													<p class="ico"><if condition="mb_strlen($article['digest'],'utf-8') gt 28"><php>echo mb_substr($article['digest'],0,28,"utf-8")."...";</php><else/><php>echo $article['digest'];</php></if></p>
													<em class="price"><php>echo getAreaName($article['area_id']);</php></em>
												</a>
											</li>
									</if>

								</volist>
							</ul>
							<else/>
							<ul class="zw-home-wanle-list clearfix" style="display: none;">
								<volist name="onelist" id="article" key="l">
									<if condition="$l eq 1">
										<li class="zw-home-wanle-one">
											<a href="./article/{pigcms{$article.pigcms_id}.html" target="_blank">
												<p class="pics" style="background-image:url({pigcms{$config.site_url}{pigcms{$article.cover_pic});" style="position:relative; left:-14px;">
												</p>
												<div class="mask"></div>
												<h3 class="title">{pigcms{$article.title}</h3>
												<div class="infos clearfix" style="display: none;">
													<p class="price"><em><php>echo getAreaName($article['area_id']);</php></em></p>
												</div>
											</a>
										</li>
										<elseif condition="$l eq 4"/>
											<li class="zw-home-channel-more zw-home-wanle-more">
												<div class="titles">
													<a href="/article/index.html" target="_blank" >
														<p class="title">查看更多<br>农丁热点</p>
														<p class="arrow">
															<span class="zwui-iconfont icon-more"></span>
														</p>
													</a>
												</div>
												<p class="list">
													<volist name="text_cat" id="cat" key="k">
														<if condition="$k eq count($text_cat)">
															<a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank" >{pigcms{$cat.name}</a>
															<else/>
															<a href="/article/cat/{pigcms{$cat.cat_url}.html" target="_blank" >{pigcms{$cat.name}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
														</if>
													</volist>
												</p>
											</li>
											<li class="zw-home-wanle-item">
												<a href="/article/{pigcms{$article.pigcms_id}.html" target="_blank">
													<p class="pics">
														<img alt="{pigcms{$article.title}" class="lazy" data-original="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" src="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" width="120" height="120">
													</p>
													<h3 class="title">{pigcms{$article.title}</h3>
													<p class="ico"><if condition="mb_strlen($article['digest'],'utf-8') gt 28"><php>echo mb_substr($article['digest'],0,28,"utf-8")."...";</php><else/><php>echo $article['digest'];</php></if></p>
													<em class="price"><php>echo getAreaName($article['area_id']);</php></em>
												</a>
											</li>
											<else/>
											<li class="zw-home-wanle-item">
												<a href="/article/{pigcms{$article.pigcms_id}.html" target="_blank">
													<p class="pics">
														<img alt="{pigcms{$article.title}" class="lazy" data-original="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" src="{pigcms{$config.site_url}{pigcms{$article.cover_pic}" width="120" height="120">
													</p>
													<h3 class="title">{pigcms{$article.title}</h3>
													<p class="ico"><if condition="mb_strlen($article['digest'],'utf-8') gt 28"><php>echo mb_substr($article['digest'],0,28,"utf-8")."...";</php><else/><php>echo $article['digest'];</php></if></p>
													<em class="price"><php>echo getAreaName($article['area_id']);</php></em>
												</a>
											</li>
									</if>

								</volist>
							</ul>
						</if>
					</volist>
				</div>
			</div>
		</div>
		<!-- 城市玩乐 end -->










		<!-- 机酒自由行 end -->
		<!-- 进度条 -->
		<script language="javascript">
			function animate(){
				$(".charts").each(function(i,item){
					var a=parseInt($(item).attr("w"));
					$(item).animate({
						width: a+"%"
					},1000);
				});
			}
			animate();
		</script>
		




<!-- app下载浮动广告 -->
<script language="javascript" src="{pigcms{$static_path}js/xnd_js/zeus.js"></script>
<!-- 公共尾部 end -->
<script src="{pigcms{$static_path}js/xnd_js/index_block.js"></script><!-- 图片显示，特效js -->


<!-- 王强新增 -->
<!-- index old -->
<div class="body" style="display: none;">

	<div class="gd_box" style="top:1540px;margin-left:-80px;">
		<div id="gd_box">
			<div id="gd_box1">
				<div id="nav" style="background-color:#947D7B;">
					<ul>
						<php>$autoI = 0;</php>
						<volist name="index_group_list" id="vo">
							<if condition="!empty($vo['group_list'])">
								<li <if condition="$i eq 1">class="current"</if>>
								<a class="f{pigcms{$i}" onClick="scrollToId('#f{pigcms{$i}');"><img src="{pigcms{$vo.cat_pic}" />
									<div class="scroll_{pigcms{$autoI%7+1}">{pigcms{$vo.cat_name}</div>
								</a>
								</li>
								<php>$autoI++;</php>
							</if>
						</volist>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<article>
		<div class="menu cf">
			<div class="menu_left">
				<div class="menu_left_top">全部分类</div>
				<div class="list">
					<ul>
						<volist name="all_category_list" id="vo" key="k">
							<li>
								<div class="li_top cf">
									<a href="{pigcms{$vo.url}">
										<span></span>
										<h3>{pigcms{$vo.cat_name}</h3>
									</a>
								</div>
								<!-- 右侧隐藏div 鼠标经过显示部分 下同 -->
								<if condition="$vo['cat_count'] gt 1">
									<div class="list_txt">
										<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
										<volist name="vo['category_list']" id="voo" key="j">
											<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
						</volist>
				</div>
				</if>
				</li>
				</volist>
				</ul>
			</div>
		</div>
		<div class="menu_right cf">
			<div class="menu_right_top">
				<ul>
					<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
						<li class="ctur">
							<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
						</li>
					</pigcms:slider>
				</ul>
			</div>
			<div class="list-main-left">
				<div class="list-nav">
					<h1 class="list-nav-hot-title">
						热门{pigcms{$config.group_alias_name}
					</h1>
					<ul>
						<volist name="hot_group_category" id="vo">
							<li><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></li>
						</volist>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div style="clear: both;"></div>
				<div class="list-nav">
					<h1 class="list-nav-q-title">
						全部区域
					</h1>
					<ul>
						<volist name="all_area_list" id="vo">
							<li><a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a></li>
						</volist>
					</ul>
					<div style="clear: both;"></div>
					<div class="list-more">
						<h1 class="list-nav-q-title">全部区域</h1>
						<ul>
							<volist name="all_area_list" id="vo">
								<li><a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a></li>
							</volist>
						</ul>
						<div style="clear: both;"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="list-nav">
					<h1 class="list-nav-s-title">
						热门商圈
					</h1>
					<ul>
						<volist name="hot_circle_list" id="vo">
							<li><a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a></li>
						</volist>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="list-shop">
					<ul>
						<volist name="index_tui_group_list" id="vo"    >
							<a href="{pigcms{$vo.url}">
								<li>
									<div class="list-shop-img">
										<img src="{pigcms{$vo.list_pic}"  style="width:366px;height: 222px;"/>
										<span> </span>
									</div>
									<div class="list-shop-title">
										<span>&yen;{pigcms{$vo.price}</span>
										<h3>{pigcms{$vo.s_name}</h3>
										<p>{pigcms{$vo.s_name}</p>
									</div>
								</li>
							</a>
						</volist>
					</ul>
				</div>
			</div>
			<div class="list-main-right">
				<div class="list-main-right-img01">


					<img src="{pigcms{$static_path}images/img01.png"  />
				</div>
				<div class="list-main-right-img02 ">
					<img src="{pigcms{$static_path}images/img02.jpg"  />
				</div>
			</div>

		</div>
	</article>

	<style>
		.liu_qy{width:1209px;border: 1px #e5e5e5 solid; border-right-width: 0;border-top-color: #f84848; overflow: hidden;margin-top:20px;}
		.liu_qy li{width: 362px;height:130px;float: left;padding:20px;border-right:1px #e5e5e5 solid}
		.liu_qy li h1{font-size:20px; line-height:25px;text-align: center;}
		.liu_qy li span{display: block;overflow: hidden;height: 90px;margin-top: 15px;}
		.liu_qy li span a{padding:0 15px;color:#777; font-size: 14px;float:left;}
		.liu_qy li span a:hover{color:#f84848}
	</style>
	<div class="liu_qy" style="display: none;">
		<li><h1 style="background: url({pigcms{$static_path}images/o2o1_35.png) no-repeat 32% 0;">
				热门{pigcms{$config.group_alias_name}
			</h1>
                        <span>
						<volist name="hot_group_category" id="vo">
							<a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
						</volist>
		</li>
		<li>
			<h1 style="background: url({pigcms{$static_path}images/o2o1_38.png) no-repeat 32% 0;">
				全部区域
			</h1><span>
					<volist name="all_area_list" id="vo">
						<a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a>
					</volist></span></li><li><h1 style="background: url({pigcms{$static_path}images/o2o1_42.png) no-repeat 32% 0;">
				热门商圈
			</h1><span>
					<volist name="hot_circle_list" id="vo">
						<a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a>
					</volist></span></li>
	</div>


	<pigcms:near_shop limit="8"/>
	<article class="nearby cf">
		<!----推荐餐饮---->
		<div class="liu_index_title"><img src="{pigcms{$static_path}images/good_supp.png"><h1>附近好店</h1><span><a href="" class="liu_index_title_right">发现优惠 发现好店</a></span></div>
		<div class="nearby_list">
			<ul>
				<volist name="near_shop_list" id="vo">
					<li <if condition="$i gt 4">style="border-top:0px;"</if>>
					<div class="box">
						<div class="nearby_list_img">
							<a href="{pigcms{$vo.url}" target="_blank">
								<img class="meal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$vo.image}" title="【{pigcms{$vo.area_name}】  style="display: inline;"/>
							</a>
							<div class="name">【{pigcms{$vo.area_name}】{pigcms{$vo.name}</div>
							<div class="name_info"><if condition="$vo['state']"><b>营业中</b><else /><b class="liu_no_time">打烊了</b></if> </div>
							<div class="info">
								<div class="jois"><b>共售 {pigcms{$vo.sale_count}</b></div>
								<div class="join"><span>{pigcms{$vo.fans_count}</span> 个粉丝</div>
							</div>
						</div>
					</div>
					<a href="{pigcms{$vo.url}" target="_blank" class="liu_jindian">立即进店</a>
					<a href="{pigcms{$vo.url}" target="_blank">
						<div class="bmbox" style="bottom: -318px;">
							<div class="bmbox_title">使用<b>微信</b>扫码查看</div>
							<div class="bmbox_list">
								<div class="bmbox_list_img"><img class="qrcode_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']))}" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']))}" style="display: inline;">
								</div>
								<div class="bmbox_list_li">
									<ul><li class="liu_list_ico_supp open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html">商家</li><li class="liu_list_ico_dian open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$vo.mer_id}.html">{pigcms{$config.meal_alias_name}</li><li class="liu_list_ico_gou open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html">
											{pigcms{$config.group_alias_name}</li></ul>
									<div class="liu_list_jindian">立即进店</div>
								</div>
							</div>
						</div>
					</a>
					</li>
				</volist>
			</ul>
		</div>
		<!--if condition="empty($is_near_shop)">
            <section class="nearby_box">
                <div class="nearby_box_txt"><img src="{pigcms{$static_path}images/tankuang_10.png"/></div>
                <button class="nearby_box_but"><span>选取</span></button>
                <div class="nearby_box_close"></div>
            </section>
        </if-->
	</article>
	<div class="socll" style="width:100%;z-index:99">
		<php>$autoI=0;</php>
		<volist name="index_group_list" id="vo">
			<if condition="!empty($vo['group_list'])">
				<div class="category cf sa" id="f{pigcms{$i}">
					<!--title--->
					<div class="liu_index_title"><if condition="$vo['cat_pic']"><img src="{pigcms{$vo.cat_pic}"/></if><h1>{pigcms{$vo.cat_name}</h1>
							<span>
								<if condition="count($vo['category_list']) gt 1">
									<volist name="vo['category_list']" id="voo" offset="0" length="6" key="j">
										<a target="_blank" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
									</volist>
								</if>
							<a target="_blank" href="{pigcms{$vo.url}" class="liu_index_title_right">全部 &gt;</a></span></div>
					<!----end  title----->

					<div class="category_list cf">
						<ul class="cf">
							<volist name="vo['group_list']" id="voo" offset="0" length="8" key="k">
								<li <if condition='$k%4 eq 0'>class="last--even"</if>>
								<div class="category_list_img">
									<a href="{pigcms{$voo.url}" target="_blank">
										<img alt="{pigcms{$voo.s_name}" class="deal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$voo.list_pic}" style="display: block;"/>
									</a>
									<div class="datal" style="padding:5px 15px 5px;">
										<a href="{pigcms{$voo.url}" target="_blank">
											<div class="category_list_title">【{pigcms{$voo.prefix_title}】{pigcms{$voo.merchant_name}</div>
											<div class="category_list_description">{pigcms{$voo.group_name}</div>
										</a>
										<div class="deal-tile__detail cf">
											<div class="price">¥<strong>{pigcms{$voo.price}</strong></div>
											<span>¥{pigcms{$voo.old_price}</span>
											<div class="sales">已售{pigcms{$voo['sale_count']+$voo['virtual_num']}</div>
										</div>
										<div class="extra-inner">
											<if condition="$voo['wx_cheap']">
												<div class="cheap">微信购买立减￥{pigcms{$voo.wx_cheap}</div>
											</if>
											<div class="noreviews">
												<if condition="$voo['reply_count']">
													<a href="{pigcms{$voo.url}#anchor-reviews" target="_blank">
														<div class="icon"><span style="width:{pigcms{$voo['score_mean']/5*100}%;" class="rate-stars"></span></div>
														<span>{pigcms{$voo.reply_count}次评价</span>
													</a>
													<else/>
													<span>暂无评价</span>
												</if>
											</div>
										</div>
									</div>
									<div class="liu_youhui"></div>
								</div>

								<!---ewm----->
								<a href="{pigcms{$voo.url}" target="_blank">
									<div class="bmbox" style="bottom: -100%;">
										<div class="bmbox_title"> 该商家有<b>{pigcms{$voo.fans_count}</b>个粉丝</div>
										<div class="bmbox_list">
											<div class="bmbox_list_img">
												<img class="lazy_img" src="{pigcms{$static_public}images/blank.gif"" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']))}" style="display: inline;">
											</div>
											<div class="bmbox_list_li">
												<ul>
													<li class="liu_list_ico_supp open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$voo.mer_id}.html">商家</li>
													<li class="liu_list_ico_dian open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$voo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
													<li class="liu_list_ico_gou open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$voo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
												</ul>
											</div>
											<div class="liu_list_jindian">马上下单</div>
										</div>
									</div>
								</a>

								</li>
							</volist>
						</ul>
					</div>
				</div>
				<!---bottom---->
				<div class="liu_index_title_bottom"><a target="_blank" href="{pigcms{$vo.url}">更多{pigcms{$vo.cat_name}的乐购，点击进入查看</a></div>
				<php>$autoI++;</php>
			</if>
		</volist>
	</div>
</div>
<!--友情链接-->
<if condition="!empty($flink_list)">
	<style type="text/css">.component-holy-reco {clear: both; margin: 0 auto;width: 1210px; position: relative;bottom: -98px;}.holy-reco{width:100%;margin:0 auto;padding-bottom:20px;_display:none}.holy-reco .tab-item {
																																																		color: #666;}.holy-reco__content{border:1px solid #E8E8E8;padding:10px;background:#FFF}.holy-reco__content a{display:inline-block;color:#666;font-size:12px;padding:0 5px;line-height:16px;white-space:nowrap;width:85px;overflow:hidden;text-overflow:ellipsis}.nav-tabs--small .current {background: #ededed none repeat scroll 0 0;width:80px;text-align:center;padding:0 6px;float:left;cursor:pointer;}</style>
	<div class="component-holy-reco" style="display: none;">
		<div class="J-holy-reco holy-reco">
			<div>
				<ul class="ccf cf nav-tabs--small">
					<li class="J-holy-reco__label current"><a href="javascript:void(0)" class="tab-item">友情链接</a></li>
				</ul>
			</div>
			<div class="J-holy-reco__content holy-reco__content">
				<volist name="flink_list" id="vo">
					<a href="{pigcms{$vo.url}" title="{pigcms{$vo.info}" target="_blank">{pigcms{$vo.name}</a>
				</volist>
			</div>
		</div>
	</div>
</if>
<!--友情链接--end-->
<include file="Public:footer"/>


<style>
	.area-bg{
		position: fixed;
		top: 0;
		background: #000000;
		opacity: 0.7;
		z-index: 10000000;
		width: 100%;
		height: 100%;
		display: none;
	}
	.area-main{
		position: fixed;
		top: 15%;
		left: 50%;
		width: 500px;
		margin-left: -250px;
		background: #fff;
		z-index: 10000001;
		display: none;
	}
	.area-main-header{
		width: 96%;
		padding: 0px 2%;
		height: 40px;
		line-height: 40px;
		background: #f80;
		color: #fff;
	}
	.area-main-header span{
		float: right;
		cursor: pointer;
	}
	.area-main-header h3{
		font-weight: normal;
		font-size: 16px;
	}
	.area-main-cen{
		width: 426px;
		margin: 30px auto;
	}
	.area-title{
		font-size: 18px;
		font-weight: normal;
	}
	.area-con{
		font-size: 16px;
		color: #505050;
		padding-bottom: 30px;
		margin-bottom: 20px;
		border-bottom: 1px dashed  #f80;
	}
	.area-jr{
		font-size: 14px;
		color: #505050;
	}
	.area-jr a{
		display: inline-block;
		width: 100px;
		height: 50px;
		line-height: 50px;
		text-align: center;
		border: 2px solid #f80;
		font-size: 16px;
		margin: 0px 10px;
		color: #494e52;
	}
	.area-ul{
		margin-left: 15px;
	}
	.area-ul li{
		float: left;
		width: 100px;
		height: 50px;
		line-height: 50px;
		text-align: center;
		border: 1px solid #d9e3e2;
		margin-left: 25px;
		margin-top: 20px;
		margin-bottom: 10px;
		color: #d9e3e2;
	}
	.area-ul li a{
		color: #969495;
		font-size: 16px;
	}
	.area-ul li:hover{
		border: 1px solid #f80;
	}
	.area-more{
		color: #727272;
	}
</style>
<div class="area-bg" style="display: none;"></div>
<div class="area-main" style="display: none;">
	<div class="area-main-header">
		<span class="area-close">关闭</span>
		<h3>切换城市</h3>
	</div>
	<div class="area-main-cen">
		<h3 class="area-title">亲爱的用户您好：</h3>
		<p class="area-con">切换城市分站，让我们为您提供更准确的信息。</p>
		<p class="area-jr">
			点击进入<a href="../../../../?cityid=2268">青岛站</a>or切换到以下城市
		</p>
		<ul class="area-ul">
			<li>
				<a href="../../../../?cityid=2268">青岛市</a>
			</li>
			<li>
				<a href="../../../../?cityid=1">北京市</a>
			</li>
			<li>
				<a href="../../../../?cityid=21">上海市</a>
			</li>
			<li>
				<a href="../../../../?cityid=1">广州市</a>
			</li>
			<li>
				<a href="#">深圳市</a>
			</li>
			<li>
				<a href="#">成都市</a>
			</li>
		</ul>
		<div style="clear: both;"></div>
		<p class="area-more">其他城市正在开通中，敬请期待~</p>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".area").click(function(){
			$(".area-bg").show();
			$(".area-main").show();
		});
		$(".area-bg").click(function(){
			$(".area-bg").hide();
			$(".area-main").hide();
		});
		$(".area-close").click(function(){
			$(".area-bg").hide();
			$(".area-main").hide();
		});
		$(".list-more").mouseout(function(){
			$(".list-more").hide();
		});
	});
</script>


</body>
</html>


<?php  ?>