<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>农场列表-{pigcms{$config.site_name}</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/xnd_css/home_css.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/list.css" rel="stylesheet" />

		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_path}js/list.js"></script>


		<script type="text/javascript">
			window.__qRequire__ = {
				version: '1449121049',
				combineCSS: []
			};
		</script>
		<!--[if lte IE 8]>
			<script src="{pigcms{$static_path}js/xnd_js/respond.min.js"></script>
		<![endif]-->
		<!--[if lt IE 11]>
		<style>
		.sk-wave {
		    background: url('http://home.qyerstatic.com/common/images/common/londing32.gif') center center no-repeat;
		}
		.sk-wave .sk-rect {
		    display: none;
		}
		</style>
		<![endif]-->
				<!--[if lt IE 8]>
		<script src="js/json2.js"></script>
		<![endif]-->
	</head>

	<body class="">
		<script src="{pigcms{$static_path}js/xnd_js/qyerBadJS.js" type="text/javascript"></script>
		<link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
		<script src="{pigcms{$static_path}js/xnd_js/headerfoot_black.min.js" async="async"></script>
		<div class="q-layer-header">
			<div class="header-inner">
				<a href="/">
					<img class="logo" src="{pigcms{$static_path}images/xnd_img/index_logo_small.png"  height="18" />
				</a>
				<div class="nav">
					<ul class="nav-ul">
							<li class="nav-list nav-list-layer index_over">
								<span class="nav-span">
								当前地区：<php>echo $_SESSION["cityarr"]['0']['area_name'];</php><i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									
									<div class="q-layer q-layer-section">
												<div class="q-layer">
													<div class="section-title">
														
														<i class="iconfont icon-jiantouyou"></i>
													</a>
														<span>热门地区</span>
													</div>
													<dl class="section-item" style="display: none;">
														<dt>ALL</dt>
														<dd>
															<a href="{pigcms{$config.site_url}/categorycityid/all">全国</a>
														</dd>
													</dl>
													<dl class="section-item">
													
														<dd>
															<a style="position: relative; left: -10px;"><b>推荐：</b></a>
															<a href="{pigcms{$config.site_url}?cityid=all">全国</a>
															<a href="http://www.xiaonongding.com/?cityid=2268">青岛</a>
															<a href="http://www.xiaonongding.com/?cityid=442">佛山</a>
															<a href="http://www.xiaonongding.com/?cityid=338">定西</a>
															<a href="http://www.xiaonongding.com/?cityid=403">天水</a>
														</dd>
													</dl>
													<volist name="cities" id="city">
													<if condition="$city">
													<dl class="section-item" style="display: none;">
														<dt><php>echo strtoupper($key);</php></dt>
														<dd>
															<volist name="city" id="one">
															<a href="{pigcms{$config.site_url}<php>echo "/farmcityid/";</php>{pigcms{$one[area_id]}">{pigcms{$one.area_name}</a>
															</volist>
														</dd>
													</dl>
													<else/>
													</if>
													</volist>
												</div>
									</div>
								
								</div>
							</li>
							<li class="nav-list ">
								<a class="nav-span" href="/category/all" title="">农特超市</a>
							</li>
							
							<li class="nav-list nav-list-layer" style="display: none;">
								<span class="nav-span">
								农丁社区<i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									<ul>
										<li>
											<a href="" title="">
												<i class="iconfont icon-wenda"></i> 旅行问答
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
									</ul>
								</div>
							</li>
                            <li class="nav-list ">
								<a class="nav-span icon-phone-a" href="/app/index.html">
									<i class="iconfont icon-phone"></i>手机小农丁</a>
							</li>
						</ul>
				</div>
				<div class="fun">
					<div id="siteSearch" class="nav-search">
						<form action="{pigcms{:U('Group/Search/index')}" method="post">
							<input class="txt" name="w" type="text" autocomplete="off">
							<button class="btn" type="submit">
								<i class="iconfont icon-sousuo"></i>
								<span>搜索</span>
							</button>
						</form>
					</div>
					<div id="js_qyer_header_userStatus" class="status">
						<div class="login show">
							
							<a class="otherlogin-link2">
								<i class="iconfont icon-weixin"></i>
							</a>
							<if condition="empty($user_session)">
							<a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a>
							<a href="{pigcms{:U('Index/Login/reg')}">注册 </a>
							<else/>
							<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
							<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
							</if>
						</div>
					</div>
					<if condition="empty($user_session)">
						<div class="nav-list nav-list-layer">
						</div>
					<else/>	
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								个人中心<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="{pigcms{:U('User/Index/index')}" title="">
											<i class="iconfont icon-wenda"></i> 我的订单
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Rates/index')}" title="">
											<i class="iconfont icon-wenda"></i> 我的评价
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Collect/index')}" title="">
											<i class="iconfont icon-wenda"></i> 我的收藏
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Point/index')}" title="">
											<i class="iconfont icon-wenda"></i> 我的积分
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Credit/index')}" title="">
											<i class="iconfont icon-wenda"></i> 账户余额
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Adress/index')}" title="">
											<i class="iconfont icon-wenda"></i> 收货地址
										</a>
									</li>
								</ul>
							</div>
					</div>
					</if>
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								我是农场主<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="{pigcms{$config.site_url}/merchant.php" title="">
											<i><img width="22" height="22" style="position: relative; top: 5px;" src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/iconfont-shangjia.png"></i> 商家中心
										</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/intro/3.html" title="">
											<img width="22" height="22" style="position: relative; top: 5px;" src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/iconfont-cooperation.png"></i> 我想合作
										</a>
									</li>
									
								</ul>
							</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 公共头部 -->
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/header.css">
		<!-- 顶部导航end -->
		<div class="zw-header">
			<div class="zw-header-wrap">
				<p class="zw-header-logo">
					<a href="/">
						<img src="{pigcms{$static_path}images/xnd_img/header_logo.gif" height="34" align="">
					</a>
				</p>
				<ul class="zw-header-nav">
						<li><a href="/category/all">今日特卖</a></li>
						<li><a href="/activity/">农场活动</a></li>
						<li><a href="/farm/index.html">热门农场</a></li>
						<!-- <li><a href="#">即将上线</a></li> -->
						<li><a href="/topic/gansu/index.html">特色馆</a></li>
			    </ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
					<form action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
						<div class="ipts">
							<p class="icons">
								<span class="zwui-iconfont icon-search"></span>
							</p>
							<input type="text" name="w" value="" placeholder="搜索农特产品" autocomplete="off" class="iptext" id="zwheadSearchText">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		<!--gulp_combine_model_start-->
		<!-- 头图 -->
		<!-- 头图 end -->
		<!-- 头图 -->
		<!-- banner -->
		<div id="qyer_banner" class="banner">
			<div id="carousel" class="carousel">
				<div class="img" style="background-image: url(?imageMogr2/interlace/1);">
					<div class="hotlink">
						<a href="" target="_blank"></a>
					</div>
					<div class="text">
						<div class="text-panel">
							<a href="" target="_blank">
								<p><strong></strong></p>
								<p></p>
							</a>
						</div>
					</div>
				</div>
				<ul class="carousel-data">
					<li>
						<input class="bannerimg" type="hidden" value="{pigcms{$static_path}images/xnd_img/farm_banner01.jpg">
						<input class="bannertext" type="hidden" value="青岛">
						<input class="bannerurl" type="hidden" value="{pigcms{:U('Farm/Index/searchByArea')}">
						<input class="itemid" type="hidden" value="1412244">
						<input class="bannerlink" type="hidden" value="">
						<div class="text">
							<a href="" target="_blank">
								<p><strong>德泰隆盐池滩羊肉</strong></p>
								<p>寻找家乡的味道甘肃主题     “德泰隆盐池滩羊肉”，双旦推出精美礼品盒，为回馈青岛广大食客厚爱，市场原价218元现优惠价180元。</p>
							</a>
						</div>
					</li>
					<li>
						<input class="bannerimg" type="hidden" value="{pigcms{$static_path}images/xnd_img/farm_banner02.jpg">
						<input class="bannertext" type="hidden" value="北京">
						<input class="bannerurl" type="hidden" value="{pigcms{:U('Farm/Index/searchByArea')}">
						<input class="itemid" type="hidden" value="1335307">
						<input class="bannerlink" type="hidden" value="">
						<div class="text">
							<a href="" target="_blank">
								<p><strong>信军农场</strong></p>
								<p>定西土豆新大坪-甘肃味，不得不流口水的记忆！</p>
							</a>
						</div>
					</li>
					<li>
						<input class="bannerimg" type="hidden" value="{pigcms{$static_path}images/xnd_img/farm_banner03.jpg">
						<input class="bannertext" type="hidden" value="上海">
						<input class="bannerurl" type="hidden" value="{pigcms{:U('Farm/Index/searchByArea')}">
						<input class="itemid" type="hidden" value="1386910">
						<input class="bannerlink" type="hidden" value="">
						<div class="text">
							<a href="" target="_blank">
								<p><strong>寻找家乡的味道</strong></p>
								<p>甘肃主题馆：土豆，宽粉，辣酱，甘肃的姐妹们有口福了~~</p>
							</a>
						</div>
					</li>
				</ul>
			</div>
			<div id="search" class="search active-place">
				<div class="tab">
					<a class="tab-place" href="javascript:;" data-type="place">热门地区</a>
					<a class="tab-plan" href="javascript:;" data-type="plan">农场入驻</a>
					<a class="tab-z" href="javascript:;"  data-type="z">找农场</a>
				</div>
				<div class="panel">
					<em class="arrow"></em>
					<div class="panel-inner">
						<div class="panel-cont">
							<div class="place place_search_box">
								<div class="input-control">
									<form class="place_search_form" target="_blank" action="{pigcms{:U('Farm/Index/searchByArea')}" method="post">
										<input class="txt placesearch_txt" type="text" name="area_name" placeholder="青岛" >
										<button class="btn" type="submit">搜索</button>
									</form>
								</div>
							</div>
							<div class="plan">
								<p>做自己的农场主！</p>
								<a class="link" target="_blank" href="{pigcms{$config.site_url}/merchant.php"><i class="iconfont icon-jiahao"></i> 创建农场</a>
								<a class="link custom" target="_blank" href="{pigcms{$config.site_url}/merchant.php"><i class="iconfont icon-custom"></i> 管理农场</a>
							</div>
							<div class="z z_search_box">
								<div class="input-control">
									<form class="z_search_form" target="_blank" action="/farm/searchByTitle" data-action="" method="post">
										<input class="txt zsearch_txt" type="text" placeholder="搜索农场" autocomplete="off" name="title_name">
										<button class="btn" type="submit">搜索</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="q-layer q-layer-placesearch-history">
					<div class="placesearch_history_box"></div>
					<div class="placesearch-history-title">
						<span>热门城市</span>
					</div>
					<div class="placesearch-history-cont hot">
						<a href="/farm/searchByArea/青岛" target="_blank">青岛</a>
						<a href="/farm/searchByArea/杭州" target="_blank">杭州</a>
						<a href="/farm/searchByArea/上海" target="_blank">上海</a>
						<a href="/farm/searchByArea/北京" target="_blank">北京</a>
						<a href="/farm/searchByArea/天津" target="_blank">天津</a>
						<a href="/farm/searchByArea/天水" target="_blank">天水</a>
						<a href="/farm/searchByArea/潍坊" target="_blank">潍坊</a>
						<a href="/farm/searchByArea/西安" target="_blank">西安</a>
						<a href="/farm/searchByArea/定西" target="_blank">定西</a>
					</div>
				</div>
				<div class="q-layer q-layer-zsearch-history">
					<div class="zsearch_history_box"></div>
					<div class="zsearch-history-title">
						<span>热门搜索</span>
					</div>
					<div class="zsearch-history-cont hot">
						<a href="/farm/&kw=北海湾海参" target="_blank">北海湾海参</a>
						<a href="/farm/&kw=北海湾海参" target="_blank">北海湾海参</a>
					</div>
				</div>
			</div>
		</div>
		<!-- content -->
		<!-- 头图 end -->
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
									<a class="filter-tag filter-tag--all" href="{pigcms{$farm_category_all}">全部</a>
								</span>
                                <php>if($top_category){</php>
                                <span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag">{pigcms{$top_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$farm_category_all}" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="{pigcms{$farm_category_all}" class="log-mod-viewed">全部</a>
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
										<span class="breadcrumb_item__title filter-tag">{pigcms{$now_area.area_name}<i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $farm_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $farm_category_all;}?>" class="log-mod-viewed">全部</a>
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
</if>
			<!-- 筛选条件end -->

		</div></div>

		<!-- 排序列表 -->
		<div class="zw-module-sortnav-wrap ">
			<ul class="zw-module-sortnav-btnList">
				<li id="sort_default" class="cur">
					<a href="/farm/all/all">综合排序</a>
				</li>
				<li id="sort_sales" class="">
					<if condition="$_GET['order'] eq 'fans_count-desc'">
					<a href="/farm/all/all/fans_count-asc">人气
						<i class="zwui-iconfont icon-down"></i>
					</a>
					<else/>
					<a href="/farm/all/all/fans_count-desc">人气
						<i class="zwui-iconfont icon-up"></i>
					</a>
					</if>
				</li>
				<li id="sort_price" class="">
					<if condition="$_GET['order'] eq 'reg_time-desc'">
					<a href="/farm/all/all/reg_time-asc">入驻时间
						<i class="zwui-iconfont icon-down"></i>
					</a>
					<else/>
					<a href="/farm/all/all/reg_time-desc">入驻时间
						<i class="zwui-iconfont icon-up"></i>
					</a>
				</if>
				</li>
				<li>
					<a class="for_sort_today_new" href=""></a>
					<input type="checkbox" name="sort_today_new" class="today-new-checkbox" value="" />
					<label class="cus-checkbox" for="sort_today_new"></label>
					<span class="today-new-text">离我最近</span>
				</li>
			</ul>
			<form class="zw-module-sortnav-searchform" action="/farm/searchByTitle" method="post">
				<div class="zw-module-sortnav-search">
					<input id="zwsearch" class="search-text" type="text" value="" name="title_name" placeholder="输入关键词">
					<button id="zwSearchBtn" type="submit" class="search-btn" value="">
						<i class="zwui-iconfont icon-search-small"></i>
					</button>
				</div>
			</form>
		</div>
		<!-- 排序列表 end -->

		<!-- 小卡片区域 -->
		<div class="section">
			<div class="wrapper">
				<div id="hottravels" class="hottravels">
					<div class="slider slider-hottravels">
						<div class="slider-inner">
							<div class="item" style="display: block;">
								<ul>
									<volist name="farm_list" id="farm">
									<li>
										<div class="travel">
											<div class="photo">
												<a href="/merindex/{pigcms{$farm.mer_id}.html" target="_blank">
													<if condition="$farm['merchant_theme_image']">
														<img class="lazy" src="{pigcms{$farm.merchant_theme_image}" width="275" height="185" style="display: inline;">
														<else/>
														<img src="{pigcms{$static_path}images/xnd_img/banner1-black-img1.jpg" />
												    </if>
													
												</a>
												<div class="like">
													<i class="iconfont icon-xiangqu1"></i> {pigcms{$farm.fans_count}人关注
												</div>
											</div>
											<div class="inner">
												<div class="info">
													<span class="avatar">
														<a href="/merindex/{pigcms{$farm.mer_id}.html" target="_blank">
															<if condition="$farm['person_image']">
																<img class="lazy" src="{pigcms{$farm.person_image}" style="display: inline;">
																<else/>
																<img src="{pigcms{$static_path}images/default.png" />
															</if>
															
														</a>
													</span>
													<span class="txt">
														<a href="/merindex/{pigcms{$farm.mer_id}.html" target="_blank"><h3>{pigcms{$farm.name}</h3><span>农场主：{pigcms{$farm.person_name}</span></a>
														<span class="auth_avatar_q s"> 
															<i class="icon member"></i>
														</span>
													</span>
												</div>
												<a href="" target="_blank">
													<div class="caption">
														<php>echo getStrSub($farm['person_info']);</php>
													</div>
												</a>
											</div>
										</div>
									</li>
								</volist>
								</ul>
							</div>
							</div>
						
					</div>
					</div>
					<div class="more">
						{pigcms{$page}
					</div>
				<!-- <div class="more">
					<a href="" target="_blank">查看更多</a>
				</div> -->
			</div>
		</div>
		<div style="width: 100%; height: 20px; clear: both;">
			
		</div>
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
							<span class="dock-nav-title-text">地区</span>
							<i class="dock-nav-title-ico zwui-iconfont icon-more2"></i>
						</div>
						<div class="dock-nav-condition-wrap" data-type="cfd"></div>
					</li>
					<li class="dock-nav-cell js-dock-filtrate">
						<div class="dock-nav-title">
							<span class="dock-nav-title-text">分类</span>
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

		<!-- 右侧浮动 -->
		<div class="zw-module-sidefloater-wrap">
			
			<a class="zw-module-sidefloater-cell myorder" href="" title="" target="_blank">
				<i class="zwui-iconfont icon-order"></i>
				<div class="sidefloater-cell-text">
					<p class="sidefloater-cell-text-inner">
						<span>我的</span>
						<span>订单</span>
					</p>
				</div>
			</a>
			<a class="zw-module-sidefloater-cell collect" href="" title="" target="_blank">
				<i class="zwui-iconfont icon-Collect"></i>
				<div class="sidefloater-cell-text">
					<p class="sidefloater-cell-text-inner">
						<span>我的</span>
						<span>收藏</span>
					</p>
				</div>
			</a>
			<div id="gototop" class="zw-module-sidefloater-cell totop">
				<i class="zwui-iconfont icon-top"></i>
			</div>
		</div>
		<!-- 右侧浮动 end -->
		<!--gulp_combine_model_end-->
		<!-- 公共尾部 -->
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/footer.css">
		<!-- 公共尾部 -->
		<div class="zw-footerprepend">
			<ul class="zw-footer-nav">
				<li><a href="/intro/1.html">关于小农丁</a></li>
				<li><a href="/intro/27.html">七天无条件退货</a></li>
				<li><a href="/intro/12.html">农场入驻</a></li>
				<li><a href="/intro/11.html">邀约返利</a></li>
				<li><a href="/intro/5.html">联系我们</a></li>
			</ul>
			<ul class="zw-footer-feature">
				<li>
					<p class="icon zybz"></p>
					<h3 class="title">身份保障</h3>
					<p class="text">农场生产环节透明，产品加工过程安全，企业资质审核严格，用户服务担保交易</p>
				</li>
				<li>
					<p class="icon dcsh"></p>
					<h3 class="title">健康承诺</h3>
					<p class="text">倡导入驻企业，农场，商户与消费者签署《产品服务品质承诺书》</p>
				</li>
				<li>
					<p class="icon axph"></p>
					<h3 class="title">口碑监督</h3>
					<p class="text">靠谱商家以身作则，消费者亲历打造农场诚信评价档案，有机轨迹一网打尽</p>
				</li>
			</ul>
		</div>

		<!-- 公共尾部 -->
		<div class="zw-footer">
			<div class="zw-footer-wrap">
				<div class="zw-footer-line1 clearfix">
					<div class="zw-footer-intro">
						<p class="logo"><img src="{pigcms{$static_path}images/xnd_img/foot_logo.png"></p>
						<p class="text">
							您有多久没有闻过泥土的芬芳？您的孩子是否从未在农田里奔跑？您是否厌倦了城市钢筋水泥般枯槁的生活？您是否渴望寻找一片属于自己和家人的乐园？您是否心中始终怀揣着回归田园的梦想？
						</p>
					</div>
					<dl class="zw-footer-concerns">
						<dt>关注我们</dt>
						<dd class="iphone">
							<p class="icons">
								<span class="zwui-iconfont icon-iphone"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="{pigcms{$static_path}images/xnd_img/foot-qrcode-app.jpg"></p>
										<div class="text">
											<p class="txt1">扫一扫下载</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">APP</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="wechat">
							<p class="icons">
								<span class="zwui-iconfont icon-wechat"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="{pigcms{$static_path}images/xnd_img/foot-qrcode-weixin.png"></p>
										<div class="text">
											<p class="txt1">扫一扫关注</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">微信</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="weibo">
							<p class="icons"><span class="zwui-iconfont icon-weibo"></span></p>
							<div class="layer">
								<div class="box">
									<div class="clearfixs">
										<a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank" class="follow">+ 关注</a>
										<span class="text"><a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank">@小农丁</a></span>
									</div>
								</div>
							</div>
						</dd>
						
					</dl>
				</div>
				<div class="zw-footer-line2">
					<div class="zw-footer-listlinks">
						2015-2016 © 小农丁™ xiaonongding.com All rights reserved. 鲁ICP备14030686号-1
					</div>
					<p class="zw-footer-frilinks">
						友情链接：
						<a href="http://www.joyvio.com/" target="_blank">佳沃农业</a>
						<a href="http://www.taobao.com/" target="_blank">淘宝</a>
						<a href="http://z.jd.com/new.html" target="_blank">京东众筹</a>
					</p>
				</div>
			</div>
		</div>

		<!-- 公共尾部 end -->
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
		<script src="{pigcms{$static_path}js/xnd_js/base_js.js"></script>
		<script src="{pigcms{$static_path}js/xnd_js/home_js.js"></script>
	</body>

</html>