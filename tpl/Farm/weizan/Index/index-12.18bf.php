<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/xnd_css/home_css.css" rel="stylesheet" />
		<script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script>
		<!--[if lte IE 8]>
			<script src="{pigcms{$static_path}js/xnd_js/respond.min.js"></script>
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
								当前地区：{pigcms{$cityname}<i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									
									<div class="q-layer q-layer-section">
												<div class="q-layer">
													<div class="section-title">
														
														<i class="iconfont icon-jiantouyou"></i>
													</a>
														<span>热门地区</span>
													</div>

													<volist name="cities" id="city">
													<dl class="section-item">
														<dt><php>echo strtoupper($key);</php></dt>
														<dd>
															<volist name="city" id="one">
															<a href="{pigcms{$config.site_url}<php>echo "/categorycityid/";</php>{pigcms{$one[area_id]}">{pigcms{$one.area_name}</a>
															</volist>
														</dd>
													</dl>
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
								<a class="nav-span icon-phone-a" href="">
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
											<i class="iconfont icon-wenda"></i> 商家中心
										</a>
									</li>
									<li>
										<a href="{pigcms{$config.site_url}/merchant.php" title="">
											<i class="iconfont icon-wenda"></i> 我想合作
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
						<li><a href="/index.php?g=Farm&c=Index&a=index">热门农场</a></li>
						<li><a href="#">即将上线</a></li>
						<li><a href="#">特色馆</a></li>
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
		<div class="zw-module-banner-wrap">
			<a class="banner-btn banner-prev-btn" href="javascript:void(0);"></a>
			<ul class="zw-module-banner-imglist clearfix">
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/hd_02.jpg);"></a>
				</li>
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/hd_03.jpg);"></a>
				</li>
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/hd_04.jpg);"></a>
				</li>
			</ul>
			<a class="banner-btn banner-next-btn" href="javascript:void(0);"></a>
		</div>
		<!-- 头图 end -->
		<div style="margin-top:35px;">
			
			<!-- 筛选条件开始 -->
			<div id="anchor_filtrate" name="anchor_filtrate" class="zw-module-filtrate-condition">
				<!-- 产品类型 -->
				<!-- 产品类型 -->

				<!-- 出发地 -->
				<div class="condition-line clearfix">
					<div class="condition-title">地区</div>
					<div class="condition-wrap clearfix">
						<div class="condition-all">
							<a class="condition-btn-link active" href="javascript:void(0);">全部</a>
						</div>
						<div class="condition-list-wrap">
							<ul class="condition-list clearfix">
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">北京/天津</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">上海/杭州</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">成都/重庆</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">广州/深圳</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">港澳台</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">国内其他</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">海外</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
				<!-- 出发地 -->

				<!-- 目的地 -->
				<div class="condition-line clearfix" data-lmtype="mdd">
					<div class="condition-title">分类</div>
					<div class="condition-wrap clearfix">
						<div class="condition-all">
							<a class="condition-btn-link active" href="javascript:void(0);">全部</a>
						</div>
						<div class="condition-list-wrap">
							<ul class="condition-list clearfix">
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">香港</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">澳门</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">台湾</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">泰国</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">马来西亚</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">法国</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">意大利</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">新加坡</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">美国</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">日本</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">德国</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">韩国</a>
								</li>
								<li class="condition-list-cell">
									<a class="condition-btn-link" href="">柬埔寨</a>
								</li>
							</ul>

							<!-- 各个大洲 -->
							<div class="condition-sub-list-wrap">
								<ul class="condition-list clearfix">
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">英国</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">越南</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">澳大利亚</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">印度尼西亚</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">菲律宾</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">尼泊尔</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">希腊</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">新西兰</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">加拿大</a>
									</li>
									<li class="condition-list-cell">
										<a class="condition-btn-link" href="">阿联酋</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="slide-btn">
							<span class="slide-btn-text">更多</span>
							<i class="slide-btn-ico zwui-iconfont icon-more2"></i>
						</div>
					</div>
				</div>

			</div>
			<!-- 筛选条件end -->

		</div>

		<!-- 排序列表 -->
		<div class="zw-module-sortnav-wrap ">
			<ul class="zw-module-sortnav-btnList">
				<li id="sort_default" class="cur">
					<a href="">综合排序</a>
				</li>
				<li id="sort_sales" class="">
					<a href="">人气
						<i class="zwui-iconfont icon-down"></i>
					</a>
				</li>
				<li id="sort_price" class="">
					<a href="">入驻时间
						<i class="zwui-iconfont icon-up"></i>
					</a>
				</li>
				<li>
					<a class="for_sort_today_new" href=""></a>
					<input type="checkbox" name="sort_today_new" class="today-new-checkbox" value="" />
					<label class="cus-checkbox" for="sort_today_new"></label>
					<span class="today-new-text">离我最近</span>
				</li>
			</ul>
			<form class="zw-module-sortnav-searchform" action="">
				<div class="zw-module-sortnav-search">
					<input id="zwsearch" class="search-text" type="text" value="" name="kw" placeholder="输入关键词">
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
									<li>
										<div class="travel">
											<div class="photo">
												<a href="" target="_blank">
													<img class="lazy" src="{pigcms{$static_path}images/xnd_img/275x185.jpg" width="275" height="185" style="display: inline;">
												</a>
												<div class="like">
													<i class="iconfont icon-xiangqu1"></i> 13人关注
												</div>
											</div>
											<div class="inner">
												<div class="info">
													<span class="avatar">
														<a href="" target="_blank">
															<img class="lazy" src="{pigcms{$static_path}images/xnd_img/275x185.jpg" style="display: inline;">
														</a>
													</span>
													<span class="txt">
														<a href="" target="_blank">农场主名</a>
														<span class="auth_avatar_q s"> 
															<i class="icon member"></i>
														</span>
													</span>
												</div>
												<a href="" target="_blank">
													<div class="caption">
														农场名称农场名称农场名称农场名称
													</div>
												</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
							</div>
						
					</div>
					</div>
				<div class="more">
					<a href="" target="_blank">查看更多</a>
				</div>
			</div>
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
				<li><a href="/">首页</a></li>
				<li><a href="/category/all">今日特卖</a></li>
				<li><a href="/activity/">农场活动</a></li>
				<li><a href="/index.php?g=Farm&c=Index&a=index">热门农场</a></li>
				<li><a href="">即将上线</a></li>
				<li><a href="sales.html">特色馆</a></li>
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
	</body>

</html>