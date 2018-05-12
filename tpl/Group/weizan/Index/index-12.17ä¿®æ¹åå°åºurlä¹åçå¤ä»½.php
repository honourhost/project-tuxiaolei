<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$now_category.cat_name}{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/header.css">

		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/list.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_path}js/list.js"></script>

		
		<script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script>
		<!--[if lte IE 8]>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="back-black">
		<include file="Public:header_top"/>
		
		<!-- 王强新增 -->
		<!-- 顶部导航end -->
		<!-- <div class="zw-header">
			<div class="zw-header-wrap">
				<p class="zw-header-logo">
					<a href="index.html">
						<img src="{pigcms{$static_path}images/xnd_img/header_logo.gif" height="34" align="">
					</a>
				</p>
				<ul class="zw-header-nav">
						<li><a href="sales.html">今日特卖1111</a></li>
						<li><a href="cruise.html">农场活动</a></li>
						<li><a href="">热门农场</a></li>
						<li><a href="citywalk.html">即将上线</a></li>
						<li><a href="show.html">特色馆</a></li>
			    </ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
						<div class="ipts">
							<p class="icons">
								<span class="zwui-iconfont icon-search"></span>
							</p>
							<input type="text" name="kw" value="" placeholder="搜索国家、城市、产品" autocomplete="off" class="iptext" id="zwheadSearchText">
						</div>
					
				</div>
			</div>
		</div> -->
		<script type="text/javascript" src="js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		<!--gulp_combine_model_start-->
		<div class="zw-module-banner1-wrap">
			<span class="zw-module-banner1-surface" style="background-image:url({pigcms{$static_path}images/xnd_img/banner1-black-img1.jpg);"></span>
		    <span class="zw-module-logo"><img src="{pigcms{$static_path}images/xnd_img/banner1-black-logo.png" /></span>
		    <p class="zw-module-con">小农丁精心为您推荐的全国各地的优质农特产品，有机为本，绿色健康，体味回归田园的愉悦</p>
		</div>
		<div style="margin-top:35px;">
			<!-- 筛选条件开始 -->
			<div id="anchor_filtrate" name="anchor_filtrate" class="zw-module-filtrate-condition">
				<!-- 产品类型 -->
				<!-- 产品类型 -->



				
				<if condition="$cat_option_html || $top_category">
					<div class="filter-section-wrapper">
						<if condition="$top_category || $area_list">
						
						
							<div class="filter-breadcrumb ">
								<span class="breadcrumb__item">
									<a class="filter-tag filter-tag--all" href="{pigcms{$group_category_all}">全部</a>
								</span>
								<php>if($top_category){</php>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag">{pigcms{$top_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$group_category_all}" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="{pigcms{$group_category_all}" class="log-mod-viewed">全部</a>
												<volist name="all_category_list" id="vo">
													<a class="<if condition="$vo['cat_id'] eq $top_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
												</volist>
											</span>
										</span>
									</span>
								</span>
								<php>}</php>
								
								
								
								<php>if($now_category['cat_id'] != $top_category['cat_id']){</php>
								<span class="breadcrumb_item__title filter-tag">{pigcms{$now_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$top_category.url}" class="breadcrumb-item--delete"><i></i></a>
						
						
								<php>}</php>
								
								<php>if($now_area && $area_list){</php>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag">{pigcms{$now_area.area_name}<i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="log-mod-viewed">全部</a>
													<volist name="area_list" id="vo">
														<a class="<if condition="$vo['area_id'] eq $now_area['area_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">
														{pigcms{$vo.area_name}</a>
													</volist>
												</span>
											</span>
										</span>
									</span>
								<php>}</php>
							</div>
						</if>
						{pigcms{$cat_option_html}
					</div>
				</if>
				
				
			</div>
			<!-- 筛选条件end -->

		</div>

		<!-- 排序列表 -->
		<div class="zw-module-sortnav-wrap sortnav-black">
			<ul class="zw-module-sortnav-btnList">
				<li id="sort_default" <if condition="$_GET['order'] eq '' || $_GET['order'] eq 'all'"> class="cur"</if>>
					<a href="{pigcms{$default_sort_url}">综合排序</a>
				</li>
				<li id="sort_sales" <if condition="$_GET['order'] eq 'hot'">class="cur"</if>>
					<a href="{pigcms{$hot_sort_url}">销量
						<i class="zwui-iconfont icon-down"></i>
					</a>
				</li>
				<li id="sort_price" <if condition="$_GET['order'] eq 'price-asc' || $_GET['order'] eq 'price-desc'">class="cur"</if>>
					<a <if condition="$_GET['order'] eq 'price-asc'">href="{pigcms{$price_desc_sort_url}" class="cur time-asc"<elseif condition="$_GET['order'] eq 'price-desc'"/>href="{pigcms{$price_asc_sort_url}" class="cur"<else/>href="{pigcms{$price_desc_sort_url}"  class="time-asc"</if>>
						价格
						<if condition="$_GET['order'] eq 'price-asc'">
						<i class="zwui-iconfont icon-down"></i>
						<elseif condition="$_GET['order'] eq 'price-desc'"/>
							<i class="zwui-iconfont icon-up"></i>
						<else/>
						<i class="zwui-iconfont icon-up"></i>
						</if>
					</a>
				</li>
				<li <if condition="$_GET['order'] eq 'time'">class="cur"</if>>
					<!-- 复选框点击搜索  href="链接地址为点击复选框筛选的页面地址,以上的三项同此" -->
					<a class="for_sort_today_new" href="{pigcms{$time_sort_url}"></a>
					<input type="checkbox" name="sort_today_new" id="sort_today_new" class="today-new-checkbox" value="" <if condition="$_GET['order'] eq 'time'">checked</if>/>
					<label class="cus-checkbox" for="sort_today_new"></label>
					<span class="today-new-text">今日新品</span>
				</li>
			</ul>
			<form class="zw-module-sortnav-searchform" action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
				<div class="zw-module-sortnav-search">
					<input id="zwsearch" class="search-text" type="text" value="" name="w" placeholder="输入关键词">
					<button id="zwSearchBtn" type="submit" class="search-btn" value="">
						<i class="zwui-iconfont icon-search-small"></i>
					</button>
				</div>
			</form>
		</div>
		<!-- 排序列表 end -->

		<!-- 大卡片区域 -->
		<div class="zw-module-productlist-unit">
			
			
			
			
					<if condition="$group_list">
						<ul class="ccf">
							<volist name="group_list" id="vo">
								<li <if condition='$k%4 eq 0'>class="last--even"</if>>
								<!--商品层-->
								
								
								
								
								
								
											<div class="zw-module-bigcard-wrap clearfix">
				<div class="zw-module-bigcard-item bigcard-black">
					<a href="{pigcms{$vo.url}" target="_blank">
						<img class="zw-module-bigcard-itemimg" src="{pigcms{$static_path}images/xnd_img/placehold.png" data-original="{pigcms{$vo.list_pic}" width="360" height="270" title="" alt="{pigcms{$vo.s_name}">
					</a>
					
					
					
			
										
										
					<div class="zw-module-bigcard-iteminfo bigcard-iteminfo-noinfotype">
						<span class="zw-module-bigcard-infoplace"><php>echo $_SESSION["cityarr"]['0']['area_name'];</php></span>
						<div class="zw-module-bigcard-infonum">
							
							<if condition="$vo['reply_count']">
													<a href="{pigcms{$vo.url}#anchor-reviews" target="_blank">
												
														<span>{pigcms{$vo.reply_count}次评价</span>
													</a>
													<else/>
														<span>暂无评价</span>
												</if>
							
							
							
							
							<span>{pigcms{$vo['sale_count']+$vo['virtual_num']}</span>件已售
						</div>
						<h2>
					     <a href="{pigcms{$vo.url}" target="_blank">
					      	【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}
					      </a>
				        </h2>
						<ul class="zw-module-bigcard-infolist">
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								{pigcms{$vo.group_name}<br />
							</li>
							
							<if condition="$vo['wx_cheap']">
							<li style="color: #dd1414">
								<i class="zwui-iconfont icon-star-line" ></i>
																				
													微信购买立减￥{pigcms{$vo.wx_cheap}											
												<br />
							</li></if>
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								该商家有<b>{pigcms{$vo.fans_count}</b>个粉丝
							</li>
						</ul>
						<div class="zw-module-bigcard-price">
							<span class="line">{pigcms{$vo.old_price}元</span>
							<em>{pigcms{$vo.price}</em>元起
						</div>
						<div class="zw-module-bigcard-bottombar">
							<div class="zw-module-bigcard-datebar">
								
								
								 <a href="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html" target="_blank">
					      	农场主页
					      </a> &nbsp;&nbsp;
					      
					      	
								 <a style="display: none;" href="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html" target="_blank">
					      	{pigcms{$config.group_alias_name}
					      </a> 
					      &nbsp;&nbsp;
					      	
								 <a href="{pigcms{$config.site_url}/meal/{pigcms{$vo.mer_id}.html" target="_blank">
					      	{pigcms{$config.meal_alias_name}
					      </a> 
								
								
								
						
								
							</div>
							<a class="zw-module-bigcard-btn" href="{pigcms{$vo.url}" target="_blank">
								立即抢购
							</a>
						</div>
					</div>
				</div>
			</div>

								
								
								
								
								
								
								</li>
							</volist>
						</ul>
<div class="zw-page-wrap clearfix zw-page-black">
				<div class="ui_page">
					{pigcms{$pagebar}
				</div>
			</div>
					<else/>
						<div style="text-align:center;height:500px;margin-top:60px;">暂无此类{pigcms{$config.group_alias_name}，请查看其他分类</div>
					</if>
					
			
			
			

			<!-- <div class="zw-module-bigcard-wrap clearfix">
				<div class="zw-module-bigcard-item bigcard-black">
					<a href="" target="_blank">
						<img class="zw-module-bigcard-itemimg" src="{pigcms{$static_path}images/xnd_img/placehold.png" data-original="{pigcms{$static_path}images/xnd_img/275x185.jpg" width="400" height="270" title="" alt="">
					</a>
					<div class="zw-module-bigcard-iteminfo bigcard-iteminfo-noinfotype">
						<span class="zw-module-bigcard-infoplace">北京</span>
						<div class="zw-module-bigcard-infonum">
							<span>48500</span>次浏览
							<span>12</span>件已售
						</div>
						<h2>
					      <a href="" title="" target="_blank">
					      	【达人线路】四合院里看北京 - 史家胡同半日游
					      </a>
				        </h2>
						<ul class="zw-module-bigcard-infolist">
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								京味儿：老胡同里的家长里短，大杂院内的柴米油盐<br />
							</li>
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								京曲儿：五百年流传，始终未变，不是京剧哦<br />
							</li>
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								朱老师说：游走城市，与历史不期而遇
							</li>
						</ul>
						<div class="zw-module-bigcard-price">
							<span class="line">198元</span>
							<em>118</em>元起
						</div>
						<div class="zw-module-bigcard-bottombar">
							<div class="zw-module-bigcard-datebar">
								旅行时间：&nbsp;2015/11-2016/12
							</div>
							<a class="zw-module-bigcard-btn" href="" target="_blank">
								立即预订
							</a>
						</div>
					</div>
				</div>
			</div> -->

		<!-- 通用dock 开始 -->
		<div class="zw-module-dock-wrap">
			<div class="zw-module-dock-comm clearfix">
				<ul class="dock-nav">
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">产品类型</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="cplx"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">出发地</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="cfd"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">目的地</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="mdd"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">玩法</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="wanfa"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">旅行时间</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="lxsj"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">旅游地区</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="lydq"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">保险公司</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="bxgs"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">保险种类</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="bxzl"></div>
					</li>
					<li class="dock-break"></li>
				</ul>
				<div class="dock-search"></div>
			</div>
		</div>
		<!-- 通用dock end -->
		
		<!-- 王强新增end -->
		
		
		
		
		
		
		
		
		<!-- old main -->
		<!-- <div class="body" > 
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top">全部分类</div>
						<div class="list">
							<ul>
								<volist name="all_category_list" id="vo" key="k">
									<li>
										<div class="li_top cf">
											<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
											<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
										</div>
										<if condition="$vo['cat_count'] gt 1">
											<div class="li_bottom">
												<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
													<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
												</volist>
											</div>
											<div class="list_txt">
												<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
												<volist name="vo['category_list']" id="voo" key="j">
													<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
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
					</div>
				</div>
			</article>
			 -->
			
			
			
			<!-- <article class="menu_table">
				
				
				
				<if condition="$cat_option_html || $top_category">
					<div class="filter-section-wrapper">
						<if condition="$top_category || $area_list">
							<div class="filter-breadcrumb ">
								<span class="breadcrumb__item">
									<a class="filter-tag filter-tag--all" href="{pigcms{$group_category_all}">全部</a>
								</span>
								<php>if($top_category){</php>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag">{pigcms{$top_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$group_category_all}" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="{pigcms{$group_category_all}" class="log-mod-viewed">全部</a>
												<volist name="all_category_list" id="vo">
													<a class="<if condition="$vo['cat_id'] eq $top_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
												</volist>
											</span>
										</span>
									</span>
								</span>
								<php>}</php>
								<php>if($now_category['cat_id'] != $top_category['cat_id']){</php>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag">{pigcms{$now_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$top_category.url}" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="{pigcms{$top_category.url}" class="log-mod-viewed">全部</a>
													<volist name="son_category_list" id="vo">
														<a class="<if condition="$vo['cat_id'] eq $now_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
													</volist>
												</span>
											</span>
										</span>
									</span>
								<php>}</php>
								<php>if($now_area && $area_list){</php>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag">{pigcms{$now_area.area_name}<i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="log-mod-viewed">全部</a>
													<volist name="area_list" id="vo">
														<a class="<if condition="$vo['area_id'] eq $now_area['area_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a>
													</volist>
												</span>
											</span>
										</span>
									</span>
								<php>}</php>
							</div>
						</if>
						{pigcms{$cat_option_html}
					</div>
				</if>
				
				
				
				
				<div class="sort">
					<ul class="cf">
						<li><a href="{pigcms{$default_sort_url}" <if condition="$_GET['order'] eq '' || $_GET['order'] eq 'all'">class="selected"</if>>默认排序</a></li>
						<li>
							<a href="{pigcms{$hot_sort_url}"<if condition="$_GET['order'] eq 'hot'">class="selected"</if>>
								<div class="li_txt">销量</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a <if condition="$_GET['order'] eq 'price-asc'">href="{pigcms{$price_desc_sort_url}" class="selected time-asc"<elseif condition="$_GET['order'] eq 'price-desc'"/>href="{pigcms{$price_asc_sort_url}" class="selected"<else/>href="{pigcms{$price_desc_sort_url}"  class="time-asc"</if>>
								<div class="li_txt">价格</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="{pigcms{$rating_sort_url}" <if condition="$_GET['order'] eq 'rating'">class="selected"</if>>
								<div class="li_txt">好评</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="{pigcms{$time_sort_url}" <if condition="$_GET['order'] eq 'time'">class="selected"</if>>
								<div class="li_txt">发布时间</div>
								<div class="li_img"></div>
							</a>
						</li>
					</ul>
				</div>
			</article> -->
			<!-- <div class="category cf" id="f1">

				<div class="activity">
					<div class="activity_title">热门活动</div>
					<pigcms:adver cat_key="group_list_right" limit="5" var_name="group_list_right">
						<div class="activity_img"><a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.name}"><img src="{pigcms{$vo.pic}"/></a></div>
					</pigcms:adver>
				</div>
			</div> -->
        </div>
		<!--div class="extension_bottom" style="position:absolute;bottom:1400px;right:10px;margin-left:-80px;margin-top:23px;">
			<div class="extension" >
				<div class="side_extension">最近浏览</div>
				<div class="extension_history " >清空</div>
				<div  style="clear:both"></div>
				<div class="side_extension_no">暂无浏览记录</div>
			</div>
		</div>-->
		<include file="Public:footer"/>
		
	</body>
</html>
