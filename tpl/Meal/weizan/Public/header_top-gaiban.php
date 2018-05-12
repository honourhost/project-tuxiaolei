<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/header.css">
<link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />

<script src="{pigcms{$static_path}js/xnd_js/headerfoot_black.min.js" async="async"></script>
<!-- 公用头部 -->
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
													<div class="section-title" style="display: none;">
														
														<i class="iconfont icon-jiantouyou"></i>
													</a>
														<span>热门地区</span>
													</div>
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
															<a href="{pigcms{$config.site_url}<php>echo "/categorycityid/";</php>{pigcms{$one[area_id]}">{pigcms{$one.area_name}</a>
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
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dd.png"></span> 我的订单
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Rates/index')}" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-pl.png"></span> 我的评价
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Collect/index')}" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-sc.png"></span> 我的收藏
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Point/index')}" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-jf.png"></span> 我的积分
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Credit/index')}" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-ye.png"></span> 账户余额
										</a>
									</li>
									<li>
										<a href="{pigcms{:U('User/Adress/index')}" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dz.png"></span> 收货地址
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
						<li><a href="http://www.xiaonongding.com/topic/public/china.html">特色馆</a></li>
			            <li><a href="/jinrong/nongxiaodai/jinrong.html">小农贷</a></li>
				        <li><a href="/jinrong/cunlebao/jiankang.html">村乐保</a></li>
				</ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
					<form action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
						<div class="ipts">
							<p class="icons">
								<span class="zwui-iconfont icon-search"></span>
							</p>
							<input type="text" name="w" value="" placeholder="搜索农特产品" autocomplete="off" class="iptext" id="zwheadSearchText">
						</div>
					<form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		
		<!-- 公用头部 -->

<!-- 王强新增header end -->










<!-- old header -->
<div class="header_top" style="display: none;">
    <div class="hot cf">
        <div class="loginbar cf">
		
			 
		
			<if condition="empty($user_session)">
				<div class="login"><a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a></div>
				<div class="regist"><a href="{pigcms{:U('Index/Login/reg')}">注册 </a></div>
			<else/>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
					</span>
					<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
				</p>
			</if>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank">访问微信版</a></p><img src="{pigcms{$config.wechat_qrcode}"/></div>
			</div>
			
			
			
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="{pigcms{:U('User/Index/index')}">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="{pigcms{:U('User/Index/index')}">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf" style="display: none;">
	<pigcms:one_adver cat_key="index_top">
		<div class="content">
			<div class="banner">
				<div class="hot"><a href="{pigcms{$one_adver.url}" title="{pigcms{$one_adver.name}"><img src="{pigcms{$one_adver.pic}" /></a></div>
			</div>
		</div>
	</pigcms:one_adver>
    <div class="nav cf">
		<div class="logo">
			<a href="{pigcms{$config.site_url}" title="{pigcms{$config.site_name}">
				<img  src="{pigcms{$config.site_logo}" />
			</a>
		</div>
		<div class="area">
            {pigcms{$cityname}<img src="{pigcms{$static_path}images/o2o1_03.png"  title=" <?php echo
            $_SESSION['cityid'];  ?>" />
		</div>
		<div class="search">
			<form action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
				<div class="form_sec">
					<div class="form_sec_txt group">{pigcms{$config.group_alias_name}</div>
					<div class="form_sec_txt1 meal">{pigcms{$config.meal_alias_name}</div>
				</div>
				<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick"><img src="{pigcms{$static_path}images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<volist name="search_hot_list" id="vo">
					<a href="{pigcms{$vo.url}"><span>{pigcms{$vo.name}</span></a>
				</volist>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
    <div class="line_bom">&nbsp;</div>
</header>