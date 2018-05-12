<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title><?php echo ($config["seo_title"]); ?></title>
	<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
        <meta name="baidu-site-verification" content="WBViD3WLT9" />
	<link href="http://www.xiaonongding.com/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
	<!-- 王强新增 -->
    <link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" /><!-- 全局基础样式 -->
	<link href="<?php echo ($static_path); ?>css/xnd_css/index_block.css" rel="stylesheet" /> <!--首页版块样式 -->
	<link href="<?php echo ($static_path); ?>css/xnd_css/shop-list.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
	<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.css" rel="stylesheet" /><!-- 头部样式 -->
	<link href="<?php echo ($static_path); ?>css/xnd_css/footer.css.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
	<script src="<?php echo ($static_path); ?>js/xnd_js/frame_block.js"></script><!-- 焦点图左侧大导航js -->
	<script src="<?php echo ($static_path); ?>js/jquery-1.9.1.min.js"></script>
	<!--[if lte IE 8]>
	<script src="<?php echo ($static_path); ?>js/xnd_js/respond.min.js"></script>
	<![endif]-->
	<!-- 王强新增end -->
	
	
	
	<?php if($config['wap_redirect']): ?><script>
			if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
			<?php if($config['wap_redirect'] == 1): ?>window.location.href = './wap.php';
			<?php else: ?>
				if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
					window.location.href = './wap.php';
				}<?php endif; ?>
			}
		</script><?php endif; ?>
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
	<img src="<?php echo ($static_path); ?>images/xnd_img/header-banner.jpg" />
</div>
<!-- 王强新增header -->
<!-- 公用头部 -->

<div class="q-layer-header">
			<div class="header-inner">
				<a href="/">
					<img class="index_logo" alt="小农丁" src="<?php echo ($static_path); ?>images/xnd_img/index_logo_small.png"  height="18" />
				</a>
				<div class="index_nav">
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
<!--															<a href="http://www.xiaonongding.com/?cityid=338">定西</a>-->
<!--															<a href="http://www.xiaonongding.com/?cityid=403">天水</a>-->
														</dd>
													</dl>
													<?php if(is_array($cities)): $i = 0; $__LIST__ = $cities;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($city): ?><dl class="section-item" style="display: none;">
														<dt><?php echo strtoupper($key); ?></dt>
														<dd>
															<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one): $mod = ($i % 2 );++$i;?><a href="<?php echo ($config["site_url"]); echo "?cityid="; echo ($one[area_id]); ?>"><?php echo ($one["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
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
                            <li class="nav-list ">
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
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0px;">
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
		<!-- 公用头部 -->
		<!-- logo  搜索  -->
		<div class="zw-home-header">
			<div class="zw-home-header-wrap">
				<div class="zw-home-header-logo">
					<a href="/">
						<img src="<?php echo ($static_path); ?>images/xnd_img/index_logo.png" alt="小农丁" align="">
					</a>
				</div>
				<div class="zw-home-header-search" id="zwhomeSearchs">
					<form action="<?php echo U('Group/Search/index');?>" method="post">
					<input type="text" name="w" placeholder="搜索农特产品" autocomplete="off" class="zw-home-header-search-text" id="zwhomeSearchText">
					<p class="zw-home-header-search-gap"></p>
					 <input type="submit" value="搜索" class="zw-home-header-search-submit">
					<p class="zw-home-header-search-smtxt">
					 <span class="zwui-iconfont icon-search"></span>搜索
					</p>
					</form>
				</div>
				<div class="zw-home-header-app">
					<a href="/app/index.html">
						<p class="icons">
							<span class="zwui-iconfont icon-iphone"></span>
						</p>
						<p class="txt">APP</p>
					</a>
				</div>
			</div>
		</div>
		<!-- logo  搜索 -->
		<!-- 首页导航 -->
		<style>
			.zw-home-nav-wrap li img{
				height: 35px;
				position: relative;
				top: 7px;
				margin-left: 0px;
			}
		</style>
		<div class="zw-home-nav">
			<ul class="zw-home-nav-wrap">
				<li class="zw-home-nav-item active">
					<a href="/">首页</a>
				</li>
				
				<li class="zw-home-nav-item">
					<a href="/category/all">今日特卖</a>
				</li>
                <li class="zw-home-nav-item">
                    <a href="http://www.xiaonongding.com/index.php?g=Index&c=Xiansheng">农丁鲜生</a>
                </li>
<!--					<li class="zw-home-nav-item">-->
<!--					<a href="/farm/index.html">热门农场</a>-->
<!--				</li>-->
<!--				<li class="zw-home-nav-item">-->
<!--					<a href="/activity/">农场活动</a>-->
<!--				</li>-->
			
				<!-- <li class="zw-home-nav-item">
					<a href="#">即将上线</a>
				</li> -->
				<li class="zw-home-nav-item">
					<a href="/topic/gansu/index.html">特色馆</a>
				</li>
				<li class="zw-home-nav-item">
					<a href="/jinrong/nongxiaodai/jinrong.html">金融</a>
				</li>
				<li class="zw-home-nav-item" style="display: none;">
					<a href="/jinrong/cunlebao/jiankang.html">村乐保</a>
				</li>
				<li>
					<a href="http://hot.xiaonongding.com/" style="padding: 0px 10px;"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/toutiao.png"></a>
				</li>
			</ul>
		</div>
		<!-- 首页导航 end -->
<!-- 王强新增header end -->










<!-- old header -->
<div class="header_top" style="display: none;">
    <div class="hot cf">
        <div class="loginbar cf">
		
			 
		
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>&nbsp;&nbsp;
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>&nbsp;&nbsp;
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
<!-- 王强新增 -->
<!-- 首屏 -->
		<div class="zw-home-firstfocus">
			<!-- 焦点图 -->
			<div class="zw-home-sliders" id="homeSliders">
				<?php $list=getAdvList("home_top",1); ?>
				<ul class="zw-home-sliders-list">
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adv): $mod = ($i % 2 );++$i;?><li style="background-image:url(<?php echo ($config["site_url"]); ?>/upload/adver/<?php echo ($adv["pic"]); ?>);">
						<a href="<?php echo ($adv["url"]); ?>" target="_blank"></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
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
					<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k==0): ?><li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img alt="<?php echo ($voo["cat_name"]); ?>" src="<?php echo ($static_path); ?>/css/img/icon-remai.png" /></span>
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==1): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-remai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==2): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-shengxian.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==3): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-shucai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==4): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-wugu.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==5): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-shengtai.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php elseif($k==6): ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-zhiwu.png" /></span>
							
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li>
					<?php else: ?>
					<li class="zw-home-category-item">
						<p class="zw-home-category-icon">
							<span class="zw-icon"><img src="<?php echo ($static_path); ?>/css/img/icon-techan.png" /></span>
						</p>
						<h2 class="zw-home-category-title"><?php echo ($vo["cat_name"]); ?></h2>
						<p class="zw-home-category-subtitle">
							<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a  href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?> </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</p>
						<p class="zw-home-category-arrow">
							<span class="zwui-iconfont icon-arrow-right"></span>
						</p>
					</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/xnd-bg.png) top center no-repeat;
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
					<?php $__FOR_START_6802__=0;$__FOR_END_6802__=3;for($i=$__FOR_START_6802__;$i < $__FOR_END_6802__;$i+=1){ if($index_tui_group_list[$i]): ?><li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3><?php echo ($index_tui_group_list[$i]["s_name"]); ?></h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank">
										<div class="buytoday-photo">
											<img src="<?php echo ($index_tui_group_list[$i]["list_pic"]); ?>" alt="<?php echo ($index_tui_group_list[$i]["name"]); ?>">
											<div class="cont">
												<p><?php echo ($index_tui_group_list[$i]["name"]); ?></p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em><?php echo ($index_tui_group_list[$i]["price"]); ?></em>元起<del >原价：<?php echo ($index_tui_group_list[$i]["old_price"]); ?>元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><?php if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];} ?></a>
									</span>
								</div>
							</div>
						</li>
						<?php else: endif; } ?>
					</ul>
					<?php if($index_tui_group_list[3]): ?><ul class="zw-home-todaysale-list clearfix" style="display:none;">
						<?php $__FOR_START_31843__=3;$__FOR_END_31843__=6;for($i=$__FOR_START_31843__;$i < $__FOR_END_31843__;$i+=1){ if($index_tui_group_list[$i]): ?><li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3><?php echo ($index_tui_group_list[$i]["s_name"]); ?></h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank">
										<div class="buytoday-photo">
											<img src="<?php echo ($index_tui_group_list[$i]["list_pic"]); ?>" alt="<?php echo ($index_tui_group_list[$i]["s_intro"]); ?>">
											<div class="cont">
												<p><?php echo ($index_tui_group_list[$i]["s_intro"]); ?></p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em><?php echo ($index_tui_group_list[$i]["price"]); ?></em>元起<del >原价：<?php echo ($index_tui_group_list[$i]["old_price"]); ?>元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><?php if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];} ?></a>
									</span>
								</div>
							</div>
						</li>
						<?php else: endif; } ?>
					</ul><?php endif; ?>
						<?php if($index_tui_group_list[6]): ?><ul class="zw-home-todaysale-list clearfix" style="display:none;">
						<?php $__FOR_START_20576__=6;$__FOR_END_20576__=9;for($i=$__FOR_START_20576__;$i < $__FOR_END_20576__;$i+=1){ if($index_tui_group_list[$i]): ?><li class="zw-home-todaysale-item">
							<div class="buytoday">
								<div class="buytoday-qg">
									<h3><?php echo ($index_tui_group_list[$i]["s_name"]); ?></h3>
									
								</div>
								<div class="buytoday-cont">
									<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank">
										<div class="buytoday-photo">
											<img src="<?php echo ($index_tui_group_list[$i]["list_pic"]); ?>" alt="<?php echo ($index_tui_group_list[$i]["s_title"]); ?>">
											<div class="cont">
												<p><?php echo ($index_tui_group_list[$i]["s_title"]); ?></p>
											</div>
										</div>
									</a>
									<div class="buytoday-price">
										<div class="buytoday-btn">
											<a href="/group/<?php echo ($index_tui_group_list[$i]["group_id"]); ?>.html" target="_blank" class="btn" style="display: inline;">立即抢购</a>
											<span class="disabled" style="display: none;">马上开抢</span>
										</div>
										<span class="price"><em><?php echo ($index_tui_group_list[$i]["price"]); ?></em>元起<del >原价：<?php echo ($index_tui_group_list[$i]["old_price"]); ?>元</del></span>
									</div>
								</div>
								<div class="buytoday-ft">
									<span class="text">
										<a href="" target="_blank"><?php if(mb_strlen($index_tui_group_list[$i]['group_name'],'utf-8')>25){echo mb_substr($index_tui_group_list[$i]['group_name'],0,25,"utf-8")."...";}else{echo $index_tui_group_list[$i]['group_name'];} ?></a>
									</span>
								</div>
							</div>
						</li>
						<?php else: endif; } ?>
					</ul><?php endif; ?>
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
									<?php if($merchant_list): if(is_array($merchant_list)): $i = 0; $__LIST__ = $merchant_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$farm): $mod = ($i % 2 );++$i;?><li>
										<div class="travel">
											<a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($farm["desc"]); ?>.html" target="_blank">
											<div class="photo" style="background-image:url(<?php echo ($farm["merinfo"]["merchant_theme_image"]); ?>);">
												<div class="like">
													<i class="iconfont icon-xiangqu1"></i> <?php echo ($farm["merinfo"]["fans_count"]); ?>人关注
												</div>
											</div>
											</a>
											<div class="inner">
												<div class="info">
													<span class="avatar">
														<a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($farm["merinfo"]["mer_id"]); ?>.html" target="_blank">
															<img class="lazy" src="<?php echo ($farm["merinfo"]["person_image"]); ?>" style="display: inline;">
														</a>
													</span>
												</div>
												<a href="" target="_blank">
													<div class="caption">
														<h3><?php echo ($farm["merinfo"]["name"]); ?><span>农场主：<?php echo ($farm["merinfo"]["person_name"]); ?></span></h3>
														<p><?php echo ($farm["merinfo"]["txt_info"]); ?></p>
													</div>
												</a>
											</div>
										</div>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php else: ?>
										<li><h3>目前还没有推荐的农场</h3></li><?php endif; ?>
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
                <?php if(is_array($crowdlist)): $k = 0; $__LIST__ = $crowdlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$crowd): $mod = ($k % 2 );++$k; if($k == 1 ): ?><li class="zw-home-ziyouxing-one">
                            <a href="http://www.xiaonongding.com/index.php?g=Index&c=Crowdfunding&a=detail&crowd_id=<?php echo ($crowd["crowd_id"]); ?>" target="_blank">
                                <p class="pics">
                                    <img class="lazy" data-original="<?php echo ($crowd["webpic"]); ?>" src="<?php echo ($crowd["webpic"]); ?>" width="570" height="267" style="position:relative; top:0px;">
                                </p>
                                <div class="infos" style="display: none;">
                                    <p class="type">已达:43%</p>
                                    <p class="price">已筹:&yen;<em>199</em></p>
                                </div>
                                <div class="titles">
                                    <h3 class="title"><?php echo ($crowd["title"]); ?></h3>
                                    <p class="time" style="display: none;">开始时间：<?php echo date("Y/m/d",$crowd['starttime']) ?></p>
                                </div>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="zw-home-ziyouxing-item">
                            <a href="http://www.xiaonongding.com/index.php?g=Index&c=Crowdfunding&a=detail&crowd_id=<?php echo ($crowd["crowd_id"]); ?>" target="_blank">
                                <p class="pics">
                                    <img class="lazy" data-original="<?php echo ($crowd["webpic"]); ?>" src="<?php echo ($crowd["webpic"]); ?>" width="275" height="183">
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
                                    <h3 class="title"><?php echo ($crowd["title"]); ?></h3>
                                </div>
                            </a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

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
					<?php if(is_array($toptui)): $k = 0; $__LIST__ = $toptui;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$activities): $mod = ($k % 2 );++$k; if($k==1): ?><li class="zw-home-zhuanti-one">
							<a href="<?php echo ($activities["url"]); ?>" target="_blank" >
								<p class="pics">
									<img class="lazy" data-original="<?php echo ($activities["merinfo"]["pic"]["image"]); ?>" src="<?php echo ($activities["merinfo"]["pic"]["image"]); ?>" width="570" height="auto" style="position:relative; top:-56px;">
								</p>
								<div class="mask"></div>
								<h3 class="title"> <?php echo ($activities["merinfo"]["s_name"]); ?></h3>
								<p class="price"><em><?php echo ($activities["merinfo"]["price"]); ?></em>元起</p>
							</a>
						</li>

						<?php else: ?>
						<li class="zw-home-zhuanti-item">
							<a href="<?php echo ($activities["url"]); ?>" target="_blank">
								<p class="pics">
									<img class="lazy" data-original="<?php echo ($activities["merinfo"]["pic"]["image"]); ?>" src="<?php echo ($activities["merinfo"]["pic"]["image"]); ?>" width="275" height="auto" style="position:relative; top:-12px;">
								</p>
								<div class="infos">
									<h3 class="title"> <?php echo ($activities["merinfo"]["s_name"]); ?></h3>
									<p class="price"><em><?php echo ($activities["merinfo"]["price"]); ?></em>元起</p>
								</div>
							</a>
						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
						<?php if(is_array($text_cat)): $k = 0; $__LIST__ = $text_cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($k % 2 );++$k; if($k == 1): ?><li class="active"><a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank"><?php echo ($cat["name"]); ?></a></li>
									<?php else: ?>
									<li><a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank"><?php echo ($cat["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="zw-home-wanle-content">
					<?php if(is_array($artList)): $k = 0; $__LIST__ = $artList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onelist): $mod = ($k % 2 );++$k; if($k == 1): ?><ul class="zw-home-wanle-list clearfix">
								<?php if(is_array($onelist)): $j = 0; $__LIST__ = $onelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($j % 2 );++$j; if($j == 1): ?><li class="zw-home-wanle-one">
											<a href="./article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
												<p class="pics" style="background-image:url(<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>);" style="position:relative; left:-14px;">
												</p>
												<div class="mask"></div>
												<h3 class="title"><?php echo ($article["title"]); ?></h3>
												<div class="infos clearfix" style="display: none;">
													<p class="price"><em><?php echo getAreaName($article['area_id']); ?></em></p>
												</div>
											</a>
										</li>
										<?php elseif($j == 4): ?>
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
													<?php if(is_array($text_cat)): $k = 0; $__LIST__ = $text_cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($k % 2 );++$k; if($k == count($text_cat)): ?><a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank" ><?php echo ($cat["name"]); ?></a>
															<?php else: ?>
															<a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank" ><?php echo ($cat["name"]); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
												</p>
											</li>
											<li class="zw-home-wanle-item">
												<a href="/article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
													<p class="pics">
														<img class="lazy" alt="<?php echo ($article["title"]); ?>" data-original="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" src="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" width="120" height="120">
													</p>
													<h3 class="title"><?php echo ($article["title"]); ?></h3>
													<p class="ico"><?php if(mb_strlen($article['digest'],'utf-8') > 28): echo mb_substr($article['digest'],0,28,"utf-8")."..."; else: echo $article['digest']; endif; ?></p>
													<em class="price"><?php echo getAreaName($article['area_id']); ?></em>
												</a>
											</li>
											<?php else: ?>
											<li class="zw-home-wanle-item">
												<a href="/article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
													<p class="pics">
														<img class="lazy" alt="<?php echo ($article["title"]); ?>" data-original="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" src="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" width="120" height="120">
													</p>
													<h3 class="title"><?php echo ($article["title"]); ?></h3>
													<p class="ico"><?php if(mb_strlen($article['digest'],'utf-8') > 28): echo mb_substr($article['digest'],0,28,"utf-8")."..."; else: echo $article['digest']; endif; ?></p>
													<em class="price"><?php echo getAreaName($article['area_id']); ?></em>
												</a>
											</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<?php else: ?>
							<ul class="zw-home-wanle-list clearfix" style="display: none;">
								<?php if(is_array($onelist)): $l = 0; $__LIST__ = $onelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($l % 2 );++$l; if($l == 1): ?><li class="zw-home-wanle-one">
											<a href="./article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
												<p class="pics" style="background-image:url(<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>);" style="position:relative; left:-14px;">
												</p>
												<div class="mask"></div>
												<h3 class="title"><?php echo ($article["title"]); ?></h3>
												<div class="infos clearfix" style="display: none;">
													<p class="price"><em><?php echo getAreaName($article['area_id']); ?></em></p>
												</div>
											</a>
										</li>
										<?php elseif($l == 4): ?>
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
													<?php if(is_array($text_cat)): $k = 0; $__LIST__ = $text_cat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($k % 2 );++$k; if($k == count($text_cat)): ?><a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank" ><?php echo ($cat["name"]); ?></a>
															<?php else: ?>
															<a href="/article/cat/<?php echo ($cat["cat_url"]); ?>.html" target="_blank" ><?php echo ($cat["name"]); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
												</p>
											</li>
											<li class="zw-home-wanle-item">
												<a href="/article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
													<p class="pics">
														<img alt="<?php echo ($article["title"]); ?>" class="lazy" data-original="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" src="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" width="120" height="120">
													</p>
													<h3 class="title"><?php echo ($article["title"]); ?></h3>
													<p class="ico"><?php if(mb_strlen($article['digest'],'utf-8') > 28): echo mb_substr($article['digest'],0,28,"utf-8")."..."; else: echo $article['digest']; endif; ?></p>
													<em class="price"><?php echo getAreaName($article['area_id']); ?></em>
												</a>
											</li>
											<?php else: ?>
											<li class="zw-home-wanle-item">
												<a href="/article/<?php echo ($article["pigcms_id"]); ?>.html" target="_blank">
													<p class="pics">
														<img alt="<?php echo ($article["title"]); ?>" class="lazy" data-original="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" src="<?php echo ($config["site_url"]); echo ($article["cover_pic"]); ?>" width="120" height="120">
													</p>
													<h3 class="title"><?php echo ($article["title"]); ?></h3>
													<p class="ico"><?php if(mb_strlen($article['digest'],'utf-8') > 28): echo mb_substr($article['digest'],0,28,"utf-8")."..."; else: echo $article['digest']; endif; ?></p>
													<em class="price"><?php echo getAreaName($article['area_id']); ?></em>
												</a>
											</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
<script language="javascript" src="<?php echo ($static_path); ?>js/xnd_js/zeus.js"></script>
<!-- 公共尾部 end -->
<script src="<?php echo ($static_path); ?>js/xnd_js/index_block.js"></script><!-- 图片显示，特效js -->


<!-- 王强新增 -->
<!-- index old -->
<div class="body" style="display: none;">

	<div class="gd_box" style="top:1540px;margin-left:-80px;">
		<div id="gd_box">
			<div id="gd_box1">
				<div id="nav" style="background-color:#947D7B;">
					<ul>
						<?php $autoI = 0; ?>
						<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><li <?php if($i == 1): ?>class="current"<?php endif; ?>>
								<a class="f<?php echo ($i); ?>" onClick="scrollToId('#f<?php echo ($i); ?>');"><img src="<?php echo ($vo["cat_pic"]); ?>" />
									<div class="scroll_<?php echo ($autoI%7+1); ?>"><?php echo ($vo["cat_name"]); ?></div>
								</a>
								</li>
								<?php $autoI++; endif; endforeach; endif; else: echo "" ;endif; ?>
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
						<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
								<div class="li_top cf">
									<a href="<?php echo ($vo["url"]); ?>">
										<span></span>
										<h3><?php echo ($vo["cat_name"]); ?></h3>
									</a>
								</div>
								<!-- 右侧隐藏div 鼠标经过显示部分 下同 -->
								<?php if($vo['cat_count'] > 1): ?><div class="list_txt">
										<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></p>
										<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="<?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
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
			<div class="list-main-left">
				<div class="list-nav">
					<h1 class="list-nav-hot-title">
						热门<?php echo ($config["group_alias_name"]); ?>
					</h1>
					<ul>
						<?php if(is_array($hot_group_category)): $i = 0; $__LIST__ = $hot_group_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div style="clear: both;"></div>
				<div class="list-nav">
					<h1 class="list-nav-q-title">
						全部区域
					</h1>
					<ul>
						<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div style="clear: both;"></div>
					<div class="list-more">
						<h1 class="list-nav-q-title">全部区域</h1>
						<ul>
							<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
						<?php if(is_array($hot_circle_list)): $i = 0; $__LIST__ = $hot_circle_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="list-shop">
					<ul>
						<?php if(is_array($index_tui_group_list)): $i = 0; $__LIST__ = $index_tui_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>">
								<li>
									<div class="list-shop-img">
										<img src="<?php echo ($vo["list_pic"]); ?>"  style="width:366px;height: 222px;"/>
										<span> </span>
									</div>
									<div class="list-shop-title">
										<span>&yen;<?php echo ($vo["price"]); ?></span>
										<h3><?php echo ($vo["s_name"]); ?></h3>
										<p><?php echo ($vo["s_name"]); ?></p>
									</div>
								</li>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div class="list-main-right">
				<div class="list-main-right-img01">


					<img src="<?php echo ($static_path); ?>images/img01.png"  />
				</div>
				<div class="list-main-right-img02 ">
					<img src="<?php echo ($static_path); ?>images/img02.jpg"  />
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
		<li><h1 style="background: url(<?php echo ($static_path); ?>images/o2o1_35.png) no-repeat 32% 0;">
				热门<?php echo ($config["group_alias_name"]); ?>
			</h1>
                        <span>
						<?php if(is_array($hot_group_category)): $i = 0; $__LIST__ = $hot_group_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</li>
		<li>
			<h1 style="background: url(<?php echo ($static_path); ?>images/o2o1_38.png) no-repeat 32% 0;">
				全部区域
			</h1><span>
					<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></span></li><li><h1 style="background: url(<?php echo ($static_path); ?>images/o2o1_42.png) no-repeat 32% 0;">
				热门商圈
			</h1><span>
					<?php if(is_array($hot_circle_list)): $i = 0; $__LIST__ = $hot_circle_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?></span></li>
	</div>


	<?php $is_near_shop = false;$near_shop_list = D("Merchant_store")->get_hot_list("8");?>
	<article class="nearby cf">
		<!----推荐餐饮---->
		<div class="liu_index_title"><img src="<?php echo ($static_path); ?>images/good_supp.png"><h1>附近好店</h1><span><a href="" class="liu_index_title_right">发现优惠 发现好店</a></span></div>
		<div class="nearby_list">
			<ul>
				<?php if(is_array($near_shop_list)): $i = 0; $__LIST__ = $near_shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i > 4): ?>style="border-top:0px;"<?php endif; ?>>
					<div class="box">
						<div class="nearby_list_img">
							<a href="<?php echo ($vo["url"]); ?>" target="_blank">
								<img class="meal_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo ($vo["image"]); ?>" title="【<?php echo ($vo["area_name"]); ?>】  style="display: inline;"/>
							</a>
							<div class="name">【<?php echo ($vo["area_name"]); ?>】<?php echo ($vo["name"]); ?></div>
							<div class="name_info"><?php if($vo['state']): ?><b>营业中</b><?php else: ?><b class="liu_no_time">打烊了</b><?php endif; ?> </div>
							<div class="info">
								<div class="jois"><b>共售 <?php echo ($vo["sale_count"]); ?></b></div>
								<div class="join"><span><?php echo ($vo["fans_count"]); ?></span> 个粉丝</div>
							</div>
						</div>
					</div>
					<a href="<?php echo ($vo["url"]); ?>" target="_blank" class="liu_jindian">立即进店</a>
					<a href="<?php echo ($vo["url"]); ?>" target="_blank">
						<div class="bmbox" style="bottom: -318px;">
							<div class="bmbox_title">使用<b>微信</b>扫码查看</div>
							<div class="bmbox_list">
								<div class="bmbox_list_img"><img class="qrcode_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']));?>" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']));?>" style="display: inline;">
								</div>
								<div class="bmbox_list_li">
									<ul><li class="liu_list_ico_supp open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($vo["mer_id"]); ?>.html">商家</li><li class="liu_list_ico_dian open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li><li class="liu_list_ico_gou open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($vo["mer_id"]); ?>.html">
											<?php echo ($config["group_alias_name"]); ?></li></ul>
									<div class="liu_list_jindian">立即进店</div>
								</div>
							</div>
						</div>
					</a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		<!--if condition="empty($is_near_shop)">
            <section class="nearby_box">
                <div class="nearby_box_txt"><img src="<?php echo ($static_path); ?>images/tankuang_10.png"/></div>
                <button class="nearby_box_but"><span>选取</span></button>
                <div class="nearby_box_close"></div>
            </section>
        </if-->
	</article>
	<div class="socll" style="width:100%;z-index:99">
		<?php $autoI=0; ?>
		<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><div class="category cf sa" id="f<?php echo ($i); ?>">
					<!--title--->
					<div class="liu_index_title"><?php if($vo['cat_pic']): ?><img src="<?php echo ($vo["cat_pic"]); ?>"/><?php endif; ?><h1><?php echo ($vo["cat_name"]); ?></h1>
							<span>
								<?php if(count($vo['category_list']) > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a target="_blank" href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
							<a target="_blank" href="<?php echo ($vo["url"]); ?>" class="liu_index_title_right">全部 &gt;</a></span></div>
					<!----end  title----->

					<div class="category_list cf">
						<ul class="cf">
							<?php if(is_array($vo['group_list'])): $k = 0; $__LIST__ = array_slice($vo['group_list'],0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($k % 2 );++$k;?><li <?php if($k%4 == 0): ?>class="last--even"<?php endif; ?>>
								<div class="category_list_img">
									<a href="<?php echo ($voo["url"]); ?>" target="_blank">
										<img alt="<?php echo ($voo["s_name"]); ?>" class="deal_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo ($voo["list_pic"]); ?>" style="display: block;"/>
									</a>
									<div class="datal" style="padding:5px 15px 5px;">
										<a href="<?php echo ($voo["url"]); ?>" target="_blank">
											<div class="category_list_title">【<?php echo ($voo["prefix_title"]); ?>】<?php echo ($voo["merchant_name"]); ?></div>
											<div class="category_list_description"><?php echo ($voo["group_name"]); ?></div>
										</a>
										<div class="deal-tile__detail cf">
											<div class="price">¥<strong><?php echo ($voo["price"]); ?></strong></div>
											<span>¥<?php echo ($voo["old_price"]); ?></span>
											<div class="sales">已售<?php echo ($voo['sale_count']+$voo['virtual_num']); ?></div>
										</div>
										<div class="extra-inner">
											<?php if($voo['wx_cheap']): ?><div class="cheap">微信购买立减￥<?php echo ($voo["wx_cheap"]); ?></div><?php endif; ?>
											<div class="noreviews">
												<?php if($voo['reply_count']): ?><a href="<?php echo ($voo["url"]); ?>#anchor-reviews" target="_blank">
														<div class="icon"><span style="width:<?php echo ($voo['score_mean']/5*100); ?>%;" class="rate-stars"></span></div>
														<span><?php echo ($voo["reply_count"]); ?>次评价</span>
													</a>
													<?php else: ?>
													<span>暂无评价</span><?php endif; ?>
											</div>
										</div>
									</div>
									<div class="liu_youhui"></div>
								</div>

								<!---ewm----->
								<a href="<?php echo ($voo["url"]); ?>" target="_blank">
									<div class="bmbox" style="bottom: -100%;">
										<div class="bmbox_title"> 该商家有<b><?php echo ($voo["fans_count"]); ?></b>个粉丝</div>
										<div class="bmbox_list">
											<div class="bmbox_list_img">
												<img class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif"" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']));?>" style="display: inline;">
											</div>
											<div class="bmbox_list_li">
												<ul>
													<li class="liu_list_ico_supp open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($voo["mer_id"]); ?>.html">商家</li>
													<li class="liu_list_ico_dian open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($voo["mer_id"]); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
													<li class="liu_list_ico_gou open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($voo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
												</ul>
											</div>
											<div class="liu_list_jindian">马上下单</div>
										</div>
									</div>
								</a>

								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<!---bottom---->
				<div class="liu_index_title_bottom"><a target="_blank" href="<?php echo ($vo["url"]); ?>">更多<?php echo ($vo["cat_name"]); ?>的乐购，点击进入查看</a></div>
				<?php $autoI++; endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
<!--友情链接-->
<?php if(!empty($flink_list)): ?><style type="text/css">.component-holy-reco {clear: both; margin: 0 auto;width: 1210px; position: relative;bottom: -98px;}.holy-reco{width:100%;margin:0 auto;padding-bottom:20px;_display:none}.holy-reco .tab-item {
																																																		color: #666;}.holy-reco__content{border:1px solid #E8E8E8;padding:10px;background:#FFF}.holy-reco__content a{display:inline-block;color:#666;font-size:12px;padding:0 5px;line-height:16px;white-space:nowrap;width:85px;overflow:hidden;text-overflow:ellipsis}.nav-tabs--small .current {background: #ededed none repeat scroll 0 0;width:80px;text-align:center;padding:0 6px;float:left;cursor:pointer;}</style>
	<div class="component-holy-reco" style="display: none;">
		<div class="J-holy-reco holy-reco">
			<div>
				<ul class="ccf cf nav-tabs--small">
					<li class="J-holy-reco__label current"><a href="javascript:void(0)" class="tab-item">友情链接</a></li>
				</ul>
			</div>
			<div class="J-holy-reco__content holy-reco__content">
				<?php if(is_array($flink_list)): $i = 0; $__LIST__ = $flink_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["info"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div><?php endif; ?>
<!--友情链接--end-->
<!-- 王强新增footer -->
<!--gulp_combine_model_start-->
		<!-- 右侧浮动 -->
		<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
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
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/footer.css">
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
					<div class="zw-footer-listlinks" style="text-align: center;">
						2015-2016 © 小农丁™ xiaonongding.com All rights reserved. 鲁ICP备14030686号-1
						&nbsp;&nbsp;&nbsp;&nbsp;所属公司：广东南海小农丁生态科技有限公司
                        <iframe src="http://wljg.gdgs.gov.cn/lz.ashx?vie=41BEF320E537FBF5BCFF028CECF113DC0F88F21F9E5DE7CF7B900DB7A3B0EF3A97F3CE4C54842EFBB364A2152BDEBA45897A4B9572EC77E9" allowtransparency="true" scrolling="no" style="overflow:hidden;text-align: center;float: right;" frameborder="0"></iframe>
					</div>
                    <div style="display: none;">

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
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead" style="display: none;">
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
	</div><?php endif; ?>
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>

<!--leftsead end-->










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