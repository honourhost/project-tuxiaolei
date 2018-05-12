<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title><?php echo ($now_link["name"]); ?> - <?php echo ($config["site_name"]); ?></title>
		<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/intro.css"  rel="stylesheet"  type="text/css" />
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_path); ?>js/intro.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<script type="text/javascript">
	      var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	    </script>
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<!--[if IE 6]>
		<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css">
				body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc"); 
				}
				.category_list li:hover .bmbox {
		filter:alpha(opacity=50);
			 
					}
		  .gd_box{	display: none;}
		</style>
		<![endif]-->
		
		<style>
			
			
			
			
			
			 .accordion {
 	width: 100%;
 	max-width: 208px;

 	background: #FFF;

 }

.accordion .link {
	cursor: pointer;
	display: block;
	padding: 15px 15px 15px 42px;
	color: #666666;
	font-size: 16px;
	border-bottom: 1px solid #edecec;
	position: relative;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}

.accordion li:last-child .link {
	border-bottom: 0;
}

.accordion li i {
	position: absolute;
	top: 16px;
	left: 12px;
	font-size: 18px;
	color: #b7b5b5;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
	right: 12px;
	left: auto;
	font-size: 16px;
}

.accordion li.open .link {
	color: #3db180;
}

.accordion li.open i {
	color: #3db180;
}
.accordion li.open i.fa-chevron-down {
	-webkit-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/
 .submenu {
 	display: none;

 	font-size: 14px;
 }

 .submenu li {
 	border-bottom: 1px solid #edecec;
 }

 .submenu a {
 	display: block;
 	text-decoration: none;
 	color: #d9d9d9;
 	padding: 12px;
 	padding-left: 42px;
 	-webkit-transition: all 0.25s ease;
 	-o-transition: all 0.25s ease;
 	transition: all 0.25s ease;
 }

 .submenu a:hover {
 	background: #f5f5f5;
 	color: #3db180;
 }
			
			
		</style>
		
	</head>
	<body>
		<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">
<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
<script src="<?php echo ($static_path); ?>js/xnd_js/headerfoot_black.min.js" async="async"></script>
<!-- 公用头部 -->
<div class="q-layer-header">
			<div class="header-inner">
				<a href="/">
					<img class="logo" src="<?php echo ($static_path); ?>images/xnd_img/index_logo_small.png"  height="18" />
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
                            <li class="nav-list ">
								<a class="nav-span icon-phone-a" href="/app/index.html">
									<i class="iconfont icon-phone"></i>手机小农丁</a>
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
						<img src="<?php echo ($static_path); ?>images/xnd_img/header_logo.gif" height="34" align="">
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
							<li><a href="/activity/">农场活动</a></li>
						<!-- <li><a href="#">即将上线</a></li> -->
						<li><a href="/topic/gansu/index.html">特色馆</a></li>
						<li><a href="/jinrong/nongxiaodai/jinrong.html">金融</a></li>
						<li>
							<a href="http://hot.xiaonongding.com/" style="padding: 0px 10px;"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/toutiao.png"></a>
						</li>
				        <li style="display: none;"><a href="/jinrong/cunlebao/jiankang.html">村乐保</a></li>
			    </ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
					<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
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
		<div class="body-intro"> 
			<div class="w main">
				<div id="Position" class="margin_b6">
					<a href="<?php echo ($config["site_url"]); ?>">首页</a><span>&gt;</span>&nbsp;关于我们<span>&gt;</span>&nbsp;<?php echo ($now_link["name"]); ?></div>
					<div class="left">
						<h2 style="padding-left: 42px">帮助中心</h2>
						
				<!-- Contenedor -->
	<ul id="accordion" class="accordion">
		<li>
			<div class="link">关于我们<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/1.html" >关于小农丁</a></li><li><a href="http://www.xiaonongding.com/intro/2.html" >公司资质</a></li><li><a href="http://www.xiaonongding.com/intro/5.html" >联系我们</a></li>
			</ul>
		</li>	
		
		<li>
			<div class="link">新手说明<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/30.html" >新手指南</a><li><a href="http://www.xiaonongding.com/intro/6.html" >常见问题</a></li><li><a href="http://www.xiaonongding.com/intro/8.html" >用户协议</a></li><li><a href="http://www.xiaonongding.com/intro/9.html" >积分规则</a></li><li><a href="http://www.xiaonongding.com/intro/10.html" >优惠卡券</a></li><li><a href="http://www.xiaonongding.com/intro/11.html" >邀约好友</a></li><li><a href="/topic/weixin.html" target="_blank">手机微信版</a></li>
			</ul>
		</li>
		<li>
			<div class="link">农场入驻<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/12.html" >入驻资质</a></li><li><a href="http://www.xiaonongding.com/intro/3.html" >入驻流程</a></li><li><a href="http://www.xiaonongding.com/intro/13.html" >身份保障</a></li><li><a href="http://www.xiaonongding.com/intro/14.html" >健康承诺</a></li><li><a href="http://www.xiaonongding.com/intro/15.html" >口碑监督</a></li>
			</ul>
		</li>
		<li>
			<div class="link">支付方式<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/16.html" >货到付款</a></li><li><a href="http://www.xiaonongding.com/intro/17.html" >在线支付</a></li><li><a href="http://www.xiaonongding.com/intro/18.html" >余额支付</a></li><li><a href="http://www.xiaonongding.com/intro/19.html" >微信支付</a></li>
			</ul>
		</li>
		<li><div class="link">派送说明<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/22.html" >运费说明</a></li><li><a href="http://www.xiaonongding.com/intro/24.html" >正品承诺</a></li><li><a href="http://www.xiaonongding.com/intro/25.html" >售后咨询</a></li><li><a href="http://www.xiaonongding.com/intro/26.html" >退货政策</a></li><li><a href="http://www.xiaonongding.com/intro/27.html" >退货办理</a></li>
			</ul>
		</li>
		
		<li><div class="link">服务保障<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/28.html" >保障协议</a></li><li><a href="http://www.xiaonongding.com/intro/29.html" >知识产权声明</a></li></li>
			</ul>
		</li>
	</ul>

<script src='js/jquery.js'></script>
<script src="js/index.js"></script>
			
						
						
						
						
						
						
						
						
						
						
						
						
						<ul class="conact_side" id="each" style=" display: none;">
							<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo['out_link']): ?>target="_blank"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
						</ul>
						<div class="borderlr"></div>
						<div class="corner_b">
							<div class="corner_bl"></div>
							<div class="corner_br"></div>
						</div>
					</div>
					<div class="right">
						<div class="corner_t">
							<div class="corner_tl"></div>
							<div class="corner_tr"></div>
						</div>
						<div class="corner_c"></div>
						<div class="content">
							<h1 class="tit"><?php echo ($now_link["title"]); ?></h1>
							<?php echo ($now_link["content"]); ?>
						</div>
						<!--[if !ie]>内容 结束<![endif]-->
						<div class="corner_b"><div class="corner_bl"></div><div class="corner_br"></div></div>
						<!--[if !ie]>help_tips 开始<![endif]-->
						<!--[if !ie]>help_tips 结束<![endif]-->
					</div>
					<!--[if !ie]>right 结束<![endif]-->
				</div>
        </div>
        <div style="width:100%; height: 10px; clear: both;"></div>
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








	</body>
</html>