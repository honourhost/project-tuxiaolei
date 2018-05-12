<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">

            <title>小农丁农产品特卖-<?php echo ($now_category["cat_name"]); echo ($config["group_alias_name"]); ?>列表-<?php echo ($config["site_name"]); ?></title>

        <meta name="description" content="小农丁今日特卖，每天为用户提供特价农特产品，包括新鲜水果，肉禽蛋奶，时令鲜蔬，五谷杂粮，休闲食品，等地标特产。秉承绿色健康原生态、产地直达的经营理念，让您真正的体味回归田园的愉悦！" />
        <meta name="keywords" content="农产品特卖，农特产品，网购水果，鲜果热卖，生鲜肉禽，时令鲜蔬，休闲食品，五谷杂粮" />

		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/list.css"/>
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_path); ?>js/list.js"></script>

		
		<script src="<?php echo ($static_path); ?>js/xnd_js/frame_block.js"></script>
		<!--[if lte IE 8]>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
	</head>
	<body class="back-black">
		<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">
<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
<script src="<?php echo ($static_path); ?>js/xnd_js/headerfoot_black.min.js" async="async"></script>
<link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Static/weizan/css/xnd_css/shop-list.css"/>
<!-- 公用头部 -->
<div class="q-layer-header">
			<div class="header-inner">
				<a href="/">
					<img class="logo" alt="小农丁" src="<?php echo ($static_path); ?>images/xnd_img/index_logo_small.png"  height="18" />
				</a>
				<div class="nav">
					<ul class="nav-ul">
							<li class="nav-list nav-list-layer index_over">
								<span class="nav-span">
								当前地区：<?php echo $_SESSION["cityarr"]['0']['area_name']; ?><i class="iconfont icon-jiantouxia"></i>
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
															<a href="<?php echo ($config["site_url"]); ?>/categorycityid/all">全国</a>
														</dd>
													</dl>
													<dl class="section-item">
													
														<dd>
															<a style="position: relative; left: -10px;"><b>推荐：</b></a>
															<a href="<?php echo ($config["site_url"]); ?>?cityid=all">全国</a>
															<a href="http://www.xiaonongding.com/?cityid=2268">青岛</a>
															<a href="http://www.xiaonongding.com/?cityid=442">佛山</a>
															<a href="http://www.xiaonongding.com/?cityid=338">定西</a>
															<a href="http://www.xiaonongding.com/?cityid=403">天水</a>
														</dd>
													</dl>
													<?php if(is_array($cities)): $i = 0; $__LIST__ = $cities;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($city): ?><dl class="section-item" style="display: none;">
														<dt><?php echo strtoupper($key); ?></dt>
														<dd>
															<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one): $mod = ($i % 2 );++$i;?><a href="<?php echo ($config["site_url"]); echo "/categorycityid/"; echo ($one[area_id]); ?>"><?php echo ($one["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
														</dd>
													</dl>
													<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
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
                            <li class="nav-list">
								<a class="nav-span" href="/app/index.html">
									<i class="iconfont icon-phone" style="font-size: 22px; float: left !important;"></i>手机小农丁</a>
							</li>
						</ul>
				</div>
				<div class="fun">
					<div id="siteSearch" class="nav-search">
						<form action="<?php echo U('Group/Search/index');?>" method="post">
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
							<?php if(empty($user_session)): ?><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a>
							<a href="<?php echo U('Index/Login/reg');?>">注册 </a>
							<?php else: ?>
							<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
							<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a><?php endif; ?>
						</div>
					</div>
					<?php if(empty($user_session)): ?><div class="nav-list nav-list-layer">
						</div>
					<?php else: ?>	
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								个人中心<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="<?php echo U('User/Index/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dd.png"></span> 我的订单
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Rates/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-pl.png"></span> 我的评价
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Collect/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-sc.png"></span> 我的收藏
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Point/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-jf.png"></span> 我的积分
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Credit/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-ye.png"></span> 账户余额
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Adress/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dz.png"></span> 收货地址
										</a>
									</li>
								</ul>
							</div>
					</div><?php endif; ?>
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								我是农场主<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="<?php echo ($config["site_url"]); ?>/merchant.php" title="">
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
						<img alt="小农丁" src="<?php echo ($static_path); ?>images/xnd_img/header_logo.gif" height="34" align="">
					</a>
				</p>
				<style>
					.zw-header-nav li img{
						height: 35px;
						position: relative;
						top: 12px;
						margin-left: 0px;
					}
				</style>
				<ul class="zw-header-nav">
				<li><a href="/category/all">今日特卖</a></li>
						<li><a href="/farm/index.html">热门农场</a></li>
<!--						<li><a href="/activity/">农场活动</a></li>-->
					<li style="display: none;">
						<!--<a href="/activity/">农场活动</a>-->
						<a href="http://www.xiaonongding.com/index.php?g=Index&c=Ecological">生态游</a>
					</li>
						<li><a href="/activity/">农场活动</a></li>
						<!-- <li><a href="#">即将上线</a></li> -->
						<li><a href="/topic/gansu/index.html">特色馆</a></li>
						<li><a href="/jinrong/nongxiaodai/jinrong.html">金融</a></li>
						<li style="display: none;"><a href="/jinrong/cunlebao/jiankang.html">村乐保</a></li>
			             <li>
							<a href="http://hot.xiaonongding.com/" style="padding: 0px 10px;"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/toutiao.png"></a>
						</li>
			    
			    </ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
					<form action="<?php echo U('Group/Search/index');?>" method="post">
						<div class="ipts">
							<p class="icons">
								<span class="zwui-iconfont icon-search"></span>
							</p>
							<input type="text" name="nw" placeholder="搜索农特产品" autocomplete="off" class="iptext">
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
		
			 
		
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
			
			
			
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
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
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf" style="display: none;">
	<?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
			<div class="banner">
				<div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
			</div>
		</div><?php endif; ?>
    <div class="nav cf">
		<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img  src="<?php echo ($config["site_logo"]); ?>" />
			</a>
		</div>
		<div class="area">
            <?php echo ($cityname); ?><img src="<?php echo ($static_path); ?>images/o2o1_03.png"  title=" <?php echo $_SESSION['cityid']; ?>" />
		</div>
		<div class="search">
			<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="form_sec">
					<div class="form_sec_txt group"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1 meal"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
    <div class="line_bom">&nbsp;</div>
</header>
		<style>
			.q-layer-nav{
				top: 30px;
			}
		</style>
		<!-- 王强新增 -->
		<!-- 顶部导航end -->
		<!-- <div class="zw-header">
			<div class="zw-header-wrap">
				<p class="zw-header-logo">
					<a href="index.html">
						<img src="<?php echo ($static_path); ?>images/xnd_img/header_logo.gif" height="34" align="">
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
			<span class="zw-module-banner1-surface" style="background-image:url(<?php echo ($static_path); ?>images/xnd_img/banner1-black-img1.jpg);"></span>
		    <span class="zw-module-logo"><img src="<?php echo ($static_path); ?>images/xnd_img/banner1-black-logo.png" /></span>
		    <p class="zw-module-con">小农丁精心为您推荐的全国各地的优质农特产品，有机为本，绿色健康，体味回归田园的愉悦</p>
		</div>
		<div style="margin-top:35px;">
			<!-- 筛选条件开始 -->
			<div id="anchor_filtrate" name="anchor_filtrate" class="zw-module-filtrate-condition">
				<!-- 产品类型 -->
				<!-- 产品类型 -->



				
				<?php if($cat_option_html || $top_category): ?><div class="filter-section-wrapper">
						<?php if($top_category || $area_list): ?><div class="filter-breadcrumb ">
								<span class="breadcrumb__item">
									<a class="filter-tag filter-tag--all" href="<?php echo ($group_category_all); ?>">全部</a>
								</span>
								<?php if($top_category){ ?>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag"><?php echo ($top_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($group_category_all); ?>" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="<?php echo ($group_category_all); ?>" class="log-mod-viewed">全部</a>
												<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['cat_id'] == $top_category['cat_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</span>
										</span>
									</span>
								</span>
								<?php } ?>
								
								
								
								<?php if($now_category['cat_id'] != $top_category['cat_id']){ ?>
								<span class="breadcrumb_item__title filter-tag"><?php echo ($now_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($top_category["url"]); ?>" class="breadcrumb-item--delete"><i></i></a>
						
						
								<?php } ?>
								
								<?php if($now_area && $area_list){ ?>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag"><?php echo ($now_area["area_name"]); ?><i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="log-mod-viewed">全部</a>
													<?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['area_id'] == $now_area['area_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>">
														<?php echo ($vo["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
												</span>
											</span>
										</span>
									</span>
								<?php } ?>
							</div><?php endif; ?>
						<?php echo ($cat_option_html); ?>
					</div><?php endif; ?>
				
				
			</div>
			<!-- 筛选条件end -->

		</div>

		<!-- 排序列表 -->
		<div class="zw-module-sortnav-wrap sortnav-black">
			<ul class="zw-module-sortnav-btnList">
				<li id="sort_default" <?php if($_GET['order'] == '' || $_GET['order'] == 'all'): ?>class="cur"<?php endif; ?>>
					<a href="<?php echo ($default_sort_url); ?>">综合排序</a>
				</li>
				<li id="sort_sales" <?php if($_GET['order'] == 'hot'): ?>class="cur"<?php endif; ?>>
					<a href="<?php echo ($hot_sort_url); ?>">销量
						<i class="zwui-iconfont icon-down"></i>
					</a>
				</li>
				<li id="sort_price" <?php if($_GET['order'] == 'price-asc' || $_GET['order'] == 'price-desc'): ?>class="cur"<?php endif; ?>>
					<a <?php if($_GET['order'] == 'price-asc'): ?>href="<?php echo ($price_desc_sort_url); ?>" class="cur time-asc"<?php elseif($_GET['order'] == 'price-desc'): ?>href="<?php echo ($price_asc_sort_url); ?>" class="cur"<?php else: ?>href="<?php echo ($price_desc_sort_url); ?>"  class="time-asc"<?php endif; ?>>
						价格
						<?php if($_GET['order'] == 'price-asc'): ?><i class="zwui-iconfont icon-down"></i>
						<?php elseif($_GET['order'] == 'price-desc'): ?>
							<i class="zwui-iconfont icon-up"></i>
						<?php else: ?>
						<i class="zwui-iconfont icon-up"></i><?php endif; ?>
					</a>
				</li>
				<li <?php if($_GET['order'] == 'time'): ?>class="cur"<?php endif; ?>>
					<!-- 复选框点击搜索  href="链接地址为点击复选框筛选的页面地址,以上的三项同此" -->
					<a class="for_sort_today_new" href="<?php echo ($time_sort_url); ?>"></a>
					<input type="checkbox" name="sort_today_new" id="sort_today_new" class="today-new-checkbox" value="" <?php if($_GET['order'] == 'time'): ?>checked<?php endif; ?>/>
					<label class="cus-checkbox" for="sort_today_new"></label>
					<span class="today-new-text">今日新品</span>
				</li>
			</ul>
			<form class="zw-module-sortnav-searchform" action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
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
			
			
			
			
					<?php if($group_list): ?><ul class="ccf">
							<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($k%4 == 0): ?>class="last--even"<?php endif; ?>>
								<!--商品层-->
								
								
								
								
								
								
											<div class="zw-module-bigcard-wrap clearfix">
				<div class="zw-module-bigcard-item bigcard-black">
					<a href="<?php echo ($vo["url"]); ?>" target="_blank">
						<img class="zw-module-bigcard-itemimg" src="<?php echo ($static_path); ?>images/xnd_img/placehold.png" alt="小农丁，F2F，F2F生态农场平台，创意采摘，农业众筹，农场活动，休闲观光，度假村，温泉农庄，科普基地，拓展培训，生态农庄" data-original="<?php echo ($vo["list_pic"]); ?>" width="360" height="270" title="" alt="<?php echo ($vo["s_name"]); ?>">
					</a>
					
					
					
			
										
										
					<div class="zw-module-bigcard-iteminfo bigcard-iteminfo-noinfotype">
						<span class="zw-module-bigcard-infoplace"><?php echo getAreaName($vo['area_id']); ?></span>
						<div class="zw-module-bigcard-infonum">
							
							<?php if($vo['reply_count']): ?><a href="<?php echo ($vo["url"]); ?>#anchor-reviews" target="_blank">
												
														<span><?php echo ($vo["reply_count"]); ?>次评价</span>
													</a>
													<?php else: ?>
														<span>暂无评价</span><?php endif; ?>
							
							
							
							
							<span><?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span>件已售
						</div>
						<h2>
					     <a href="<?php echo ($vo["url"]); ?>" target="_blank">
					      	 <?php echo ($vo["group_name"]); ?>
					      </a>
				        </h2>
						<ul class="zw-module-bigcard-infolist">
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								该特卖产品由<?php echo ($vo["merchant_name"]); ?>提供<br />
							</li>
							
							<?php if($vo['wx_cheap']): ?><li style="color: #ffaf30">
								<i class="zwui-iconfont icon-star-line" ></i>
																				
													微信购买立减￥<?php echo ($vo["wx_cheap"]); ?>											
												<br />
							</li><?php endif; ?>
							<li>
								<i class="zwui-iconfont icon-star-line"></i>
								已有<b>1<?php echo ($vo["fans_count"]); ?></b>个粉丝关注该农场！
							</li>
						</ul>
						<div class="zw-module-bigcard-price">
							<span class="line"><?php echo ($vo["old_price"]); ?>元</span>
							<em><?php echo ($vo["price"]); ?></em>元
						</div>
						<div class="zw-module-bigcard-bottombar">
							<div class="zw-module-bigcard-datebar">
								
								
								 <a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($vo["mer_id"]); ?>.html" target="_blank">
					      	了解该农场
					      </a> &nbsp;&nbsp;
					      
					      	
								 <a style="display: none;" href="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($vo["mer_id"]); ?>.html" target="_blank">
					      	<?php echo ($config["group_alias_name"]); ?>
					      </a> 
					      &nbsp;&nbsp;
					      	
								 <a href="<?php echo ($config["site_url"]); ?>/meal/<?php echo getStoreId($vo['mer_id']); ?>.html" target="_blank">
					      	<?php echo ($config["meal_alias_name"]); ?>
					      </a> 

								
								
								
						
								
							</div>
							<a class="zw-module-bigcard-btn" href="<?php echo ($vo["url"]); ?>" target="_blank">
								立即抢购
							</a>
						</div>
					</div>
				</div>
			</div>

								
								
								
								
								
								
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
<div class="zw-page-wrap clearfix zw-page-black">
				<div class="ui_page">
					<?php echo ($pagebar); ?>
				</div>
			</div>
					<?php else: ?>
						<div style="text-align:center;height:500px;margin-top:60px;">暂无此类<?php echo ($config["group_alias_name"]); ?>，请查看其他分类</div><?php endif; ?>
					
			
			
			

			<!-- <div class="zw-module-bigcard-wrap clearfix">
				<div class="zw-module-bigcard-item bigcard-black">
					<a href="" target="_blank">
						<img class="zw-module-bigcard-itemimg" src="<?php echo ($static_path); ?>images/xnd_img/placehold.png" data-original="<?php echo ($static_path); ?>images/xnd_img/275x185.jpg" width="400" height="270" title="" alt="">
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
								<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
										<div class="li_top cf">
											<?php if($vo['cat_pic']): ?><div class="icon"><img src="<?php echo ($vo["cat_pic"]); ?>" /></div><?php endif; ?>
											<div class="li_txt"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></div>
										</div>
										<?php if($vo['cat_count'] > 1): ?><div class="li_bottom">
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
											<div class="list_txt">
												<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></p>
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="<?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</div><?php endif; ?>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<?php $web_index_slider = D("Slider")->get_slider_by_key("web_slider","10");if(is_array($web_index_slider)): $i = 0;if(count($web_index_slider)==0) : echo "列表为空" ;else: foreach($web_index_slider as $key=>$vo): ++$i;?><li class="ctur">
										<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
									</li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</article>
			 -->
			
			
			
			<!-- <article class="menu_table">
				
				
				
				<?php if($cat_option_html || $top_category): ?><div class="filter-section-wrapper">
						<?php if($top_category || $area_list): ?><div class="filter-breadcrumb ">
								<span class="breadcrumb__item">
									<a class="filter-tag filter-tag--all" href="<?php echo ($group_category_all); ?>">全部</a>
								</span>
								<?php if($top_category){ ?>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag"><?php echo ($top_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($group_category_all); ?>" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="<?php echo ($group_category_all); ?>" class="log-mod-viewed">全部</a>
												<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['cat_id'] == $top_category['cat_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</span>
										</span>
									</span>
								</span>
								<?php } ?>
								<?php if($now_category['cat_id'] != $top_category['cat_id']){ ?>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag"><?php echo ($now_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($top_category["url"]); ?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php echo ($top_category["url"]); ?>" class="log-mod-viewed">全部</a>
													<?php if(is_array($son_category_list)): $i = 0; $__LIST__ = $son_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['cat_id'] == $now_category['cat_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
												</span>
											</span>
										</span>
									</span>
								<?php } ?>
								<?php if($now_area && $area_list){ ?>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag"><?php echo ($now_area["area_name"]); ?><i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="log-mod-viewed">全部</a>
													<?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['area_id'] == $now_area['area_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
												</span>
											</span>
										</span>
									</span>
								<?php } ?>
							</div><?php endif; ?>
						<?php echo ($cat_option_html); ?>
					</div><?php endif; ?>
				
				
				
				
				<div class="sort">
					<ul class="cf">
						<li><a href="<?php echo ($default_sort_url); ?>" <?php if($_GET['order'] == '' || $_GET['order'] == 'all'): ?>class="selected"<?php endif; ?>>默认排序</a></li>
						<li>
							<a href="<?php echo ($hot_sort_url); ?>"<?php if($_GET['order'] == 'hot'): ?>class="selected"<?php endif; ?>>
								<div class="li_txt">销量</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a <?php if($_GET['order'] == 'price-asc'): ?>href="<?php echo ($price_desc_sort_url); ?>" class="selected time-asc"<?php elseif($_GET['order'] == 'price-desc'): ?>href="<?php echo ($price_asc_sort_url); ?>" class="selected"<?php else: ?>href="<?php echo ($price_desc_sort_url); ?>"  class="time-asc"<?php endif; ?>>
								<div class="li_txt">价格</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="<?php echo ($rating_sort_url); ?>" <?php if($_GET['order'] == 'rating'): ?>class="selected"<?php endif; ?>>
								<div class="li_txt">好评</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="<?php echo ($time_sort_url); ?>" <?php if($_GET['order'] == 'time'): ?>class="selected"<?php endif; ?>>
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
					<?php $group_list_right = D("Adver")->get_adver_by_key("group_list_right","5");if(is_array($group_list_right)): $i = 0;if(count($group_list_right)==0) : echo "列表为空" ;else: foreach($group_list_right as $key=>$vo): ++$i;?><div class="activity_img"><a href="<?php echo ($vo["url"]); ?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><img src="<?php echo ($vo["pic"]); ?>"/></a></div><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
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
		<!-- 王强新增footer -->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/footer.css">
<!--gulp_combine_model_start-->
		<!-- 右侧浮动 -->
		<div class="zw-module-sidefloater-wrap">
			
			<a class="zw-module-sidefloater-cell myorder" href="/index.php?g=User&c=Index&a=index" title="" target="_blank">
				<i class="zwui-iconfont icon-order"></i>
				<div class="sidefloater-cell-text">
					<p class="sidefloater-cell-text-inner">
						<span>我的</span>
						<span>订单</span>
					</p>
				</div>
			</a>
			<a class="zw-module-sidefloater-cell collect" href="/index.php?g=User&c=Collect&a=index" title="" target="_blank">
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
						<p class="logo"><img alt="小农丁" src="<?php echo ($static_path); ?>images/xnd_img/foot_logo.png"></p>
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
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-app.jpg"></p>
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
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-weixin.png"></p>
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
		<script src="<?php echo ($static_path); ?>js/xnd_js/channel_block.js"></script>
		
		<!-- app下载浮动广告 -->
<!-- 王强新增footer end -->








<!-- old footer -->
<footer style="display: none;">
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<div class="rightsead" style="display:none;">
	<ul>
		<li>
			<a href="javascript:void(0)" class="wechat">
				<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
				<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
				<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
			</a>
		</li>
		<?php if($config['site_qq']): ?><li>
				<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
					<div class="hides qq_div">
						<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
						<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
					</div>
					<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
				</a>
			</li><?php endif; ?>
		<?php if($config['site_phone']): ?><li>
				<a href="javascript:void(0)" class="tel">
					<div class="hides tel_div">
						<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
						<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
					</div>
					<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
				</a>
			</li><?php endif; ?>
		<li>
			<a class="top_btn">
				<div class="hides btn_div">
					<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
				</div>
				<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
			</a>
		</li>
	</ul>
</div>
<!--leftsead end-->
		
	</body>
</html>