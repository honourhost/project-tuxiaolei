<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<?php if($now_group['tuan_type'] != 2): ?><title><?php echo ($now_group["s_name"]); echo ($config["group_alias_name"]); ?>|图片|价格|菜单 - <?php echo ($config["site_name"]); ?></title>
		<?php else: ?>
			<title><?php echo ($now_group["s_name"]); echo ($config["group_alias_name"]); ?> - <?php echo ($config["site_name"]); ?></title><?php endif; ?>

		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<meta name="keywords" content="<?php echo ($now_group["merchant_name"]); ?>,<?php echo ($now_group["s_name"]); ?>,<?php echo ($config["site_name"]); ?>" />
		<meta name="description" content="<?php echo ($now_group["intro"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">
		<link rel="stylesheet" href="<?php echo ($static_path); ?>css/xnd_css/frame.css" />
		<link rel="stylesheet" href="<?php echo ($static_path); ?>css/xnd_css/detail.css" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
		<script src="<?php echo ($static_path); ?>js/xnd_js/frame_block.js"></script>
		<script src="<?php echo ($static_path); ?>js/xnd_js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo ($static_path); ?>js/xnd_js/simplefoucs.js" type="text/javascript"></script>

        <script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
        <script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
        <script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>

        <script>var site_url = "<?php echo ($config["site_url"]); ?>";var store_long="<?php echo ($now_group["store_list"]["0"]["long"]); ?>";var store_lat="<?php echo ($now_group["store_list"]["0"]["lat"]); ?>";var get_reply_url="<?php echo U('Index/Reply/ajax_get_list',array('order_type'=>0,'parent_id'=>$now_group['group_id'],'store_count'=>count($now_group['store_list'])));?>";var collect_url="<?php echo U('Index/Collect/collect');?>";var login_url="<?php echo U('Index/Login/frame_login');?>";</script>

        <script src="<?php echo ($static_path); ?>js/group_detail.js"></script>
	</head>
	<body>
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
		
		<!-- 王强新增 -->
		<div class="lmMain">
			
			<!-- 表单  -->
			<form action="<?php echo ($now_group["buy_url"]); ?>" method="get" id="buyFrom">
				
				<div class="grand-title clearfix">
				<h4 class="title-text fontYaHei">
				    <?php echo ($now_group["s_name"]); ?> <font style="font-size: medium;color: grey;"> &nbsp;&nbsp;<?php echo ($now_group["group_name"]); ?></font>
				</h4>
				
			</div>
				<div class="top-section clearfix">
					<div class="left-tuwen">
						<!-- 焦点图 -->
						<div class="gallery">
							<div id="focus">
						        <ul >
						        		<?php if(is_array($now_group['all_pic'])): $i = 0; $__LIST__ = $now_group['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php if($i == 1): ?>cur<?php endif; ?>">
												<div><img src="<?php echo ($vo["m_image"]); ?>"  alt="小农丁，F2F，F2F生态农场平台，创意采摘，农业众筹，农场活动，休闲观光，度假村，温泉农庄，科普基地，拓展培训，生态农庄"/></div>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
						           
						        </ul>
						    </div>
						</div>
						<!-- 焦点图end -->

						<div class="gallery-bottom clearfix">
							<p class="desc">
								<span class="desc-inner"><?php echo ($now_group["hits"]); ?></span> 次浏览
							</p>
							<p class="desc">
								<span class="desc-inner"><?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></span> 件已售
							</p>
						</div>

						<ul class="tools clearfix">
							<li data-id="59795" class="sc J-component-add-favorite" <?php if(!empty($now_group['is_collect'])): ?>yi<?php endif; ?>" fav-id="<?php echo ($now_group["group_id"]); ?>"><?php if(empty($now_group['is_collect'])): ?>收藏<?php else: ?>已收藏<?php endif; ?></li>
							<li class="fx">
								<span>分享</span>
								<div class="share-wrap size24 qui-iconShares">
									<span class="trangle"></span>
									<div class="bdsharebuttonbox">
										<div class="bdsharebuttonbox"><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
									</div>
							</li>
							<!-- <li class="tx">填写信息 一键秒杀</li> -->
						</ul>
					</div>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
					<div class="right-operate">
						<div class="content-wrap">
							<h4 class="content-wrap-label"><?php echo ($now_group["intro"]); ?></h4>
							<div class="content-unit product-option">
								<h4 class="unit-title leg_title">售价：</h4>
								<div class="unit-nr">
									<p class="unit-nr-ft-color postion_top">
										&yen;<span class="unit-nr-h3"><?php echo ($now_group["price"]); ?></span>
									</p>
									<del>&yen;<?php echo ($now_group["old_price"]); ?></del>
								</div>
							</div>

							<div class="content-unit lm-calendar">
								<h4 class="unit-title">已售：</h4>
								<div class="unit-nr">
									<label class="unit-nr-ft-color"><?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></label>
								</div>
							</div>
							<div class="content-unit product-option">
								<h4 class="unit-title">评价：</h4>
								<div class="unit-nr">
									<label><span class="unit-nr-ft-color"><?php echo ($now_group["reply_count"]); ?></span>次评价</label>
								</div>
							</div>

							<div class="content-unit lm-calendar">
								<h4 class="unit-title">商家：</h4>
								<div class="unit-nr">
									<label >
										<?php echo ($now_group["person_name"]); ?><span class="unit-nr-ft-color unit-nr-line"></span> 
									</label>
								</div>
							</div>
							<div class="content-unit product-option">
								<h4 class="unit-title">有效期：</h4>
								<div class="unit-nr">
									<label>截止到<?php echo (date('Y.m.d',$now_group["end_time"])); ?>(<span class="unit-nr-ft-color">周末、法定节假日通用</span>)</label>
								</div>
							</div>
							<div class="content-unit person-number">
								<h4 class="unit-title">数量：</h4>
								<div class="unit-nr">
									<ul class="person-list clearfix">
										<li>
											<p class="num-p">
												<button for="J-cart-minus" type="button" class="num-btn minus disable">−</button>
												<input type="text" id="num-adult" class="num-input inp J-cart-quantity" name="q" value="<?php echo ($now_group["once_min"]); ?>" maxlength="9" data-max="<?php echo ($now_group["once_max"]); ?>" data-min="<?php echo ($now_group["once_min"]); ?>"/>
												<button for="J-cart-add" class="item num-btn add" type="button">+</button>
											</p>
										</li>
										<li><span class="deal-component-quantity-warning orange" style="color:red"></span></li>
										<span class="num-tip" style="display:none;">
											<i></i>限购<em></em>人
										</span>
									</ul>
								</div>
							</div>
							<div class="content-pad-btm">
								<?php if($now_group['end_time'] > $_SERVER['REQUEST_TIME']): ?><a class="btn btn_bg01" onclick="submitForm();">立即购买</a><?php endif; ?>
								<a class="btn btn_bg02 shou J-component-add-favorite" <?php if(!empty($is_collect)): ?>yi<?php endif; ?> fav-id="<?php echo ($now_group["group_id"]); ?>"><?php if(empty($is_collect)): ?>收藏商品<?php else: ?>已收藏<?php endif; ?></a>
							</div>
						<script>
						function submitForm(){
							document.getElementById("buyFrom").submit();
						}
						</script>
							<div class="booking-unit">
								<div class="book-cell enable clearfix">
									<div class="price-unit">
										<label class="price-unit-tit">保障：</label>
										<span>农湾认证</span>
										<span>无条件退换</span>
										<span>真实评价</span>
									</div>
									<input id="booking" class="book-btn book-now fontYaHei " onClick="window.location.href='<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html';" type="button" value="进入农场" />
									<i class="entrance-ico" style="position: relative; left: -180px; top: -5px;"></i>
								</div>

							</div>
						</div>
						<div class="fr content_ma">
							<img class="content_ma_img" src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']));?>" />
							 <h4 class="weixinlijian">微信立减<font color="red"><?php echo ($now_group['wx_cheap']); ?></font>元 </h4>
						</div>
					</div>
				</div>
			</form>
			<div class="detail-content-wrap">
				<div class="detail-nav-wrap">
					<!--供应商导航部分-->
					<div class="detail-nav clearfix">
						<ul class="nav-unit clearfix">
							<li class="li-0 active fontYaHei">
								农场简介<span class="trangle"></span>
							</li>
							<li class="li-1 fontYaHei">
								特卖详情<span class="trangle"></span>
							</li>
							<li class="li-2 fontYaHei">
								农丁小贴士<span class="trangle"></span>
							</li>
							<li class="li-3 fontYaHei">
								评论<span class="trangle"></span>
							</li>
						</ul>
						<div class="nav-right" style="display:none;">
							<span class="nav-price">
								¥<em>日均<em>280</em></em>
							</span>
							
							<input class="nav-book canbook fontYaHei" type="button" value="立即预订" />
						</div>

					</div>
					<!--供应商导航部分-->
				</div>
				<div class="detail-wrap clearfix">
					
					<!--供应商介绍部分-->
					<div class="left-list">
						<div class="detail-cell-local">
									<div class="detail-cell-header-img">
										<img src="<?php echo ($now_group["merchant_theme_image"]); ?>" />
										<div class="detail-cell-bg"></div>
										<div class="detail-cell-title">
											<h3><span></span><?php echo ($now_group["merchant_name"]); ?><span></span></h3>
											<p>小农丁特色推荐农场</p>
										</div>
										<div id="detail-cell-user">
											<?php if($now_group['person_image']): ?><img src="<?php echo ($now_group["person_image"]); ?>" />
											<?php else: ?>
											<img src="<?php echo ($static_path); ?>images/default.png" /><?php endif; ?>
											<p>场主：<?php echo ($now_group["person_name"]); ?></p>
										</div>
									</div>
									<div style="width: 100%; height: 70px;"></div>
									<div class="detail-cell-content">
										<span id="content-top">
											<img src="<?php echo ($static_path); ?>images/xnd_img/content-top.png" />
										</span>
										<p>
											<?php echo ($now_group["person_info"]); ?>
										</p>
										<span id="content-bottom">
											<img src="<?php echo ($static_path); ?>images/xnd_img/content-bottom.png" />
										</span>
									</div>
									
									<style>
										.nongwan{
											width: 690px;
										    margin: 10px auto 0px auto;
										    background: #F8F8F8;
										    padding: 15px 30px;
										    border-radius: 5px;    color: #666;
										    font-size: 16px;
										    line-height: 30px;
										    text-align: center;
										}
									</style>
										<div class="nongwan">
											农湾基地保障    无条件赔付									
										</div>
									
									
								</div>
						<!-- 特卖详情 -->
						
						<div class="detail-unit product-detail">
							
							<h4 class="unit-title zkxq fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">购买须知</i>
							</h4>
							<ul class="xuzhi">
								<?php if(is_array($now_group['cue_arr'])): $i = 0; $__LIST__ = $now_group['cue_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['value']): ?><li><b><?php echo ($vo["key"]); ?>：</b><?php echo (nl2br($vo["value"])); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<h4 class="unit-title zkxq fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">特卖详情</i>
							</h4>
							<div style="width: 100%; text-align: center; padding: 20px 0px 0px 0px; display: none;">
								<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/news-tongzhi.jpg">
							</div>
							<div class="detail-cell">
								<?php echo ($now_group["content"]); ?>
							</div>
						</div>
						
						<!-- 农场简介 -->
						<a class="cpjs"></a>
						<div class="detail-unit mt22">
							
							<h4 class="unit-title fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">农场简介</i>
							</h4>
							<div class="detail-cell mt10" style="padding-top: 10px;">
								<span class="detail-cell-jianjie"><?php echo ($now_group["txt_info"]); ?></span>
							</div>
							
						</div>
						
						
						<!--农丁小贴士-->
						<div class="detail-unit">
							<a name="mod_question"></a>
							<h4 class="unit-title pl fontYaHei">
								<span class="pingjia">共 <b><?php echo ($now_group["reply_count"]); ?></b> 次评价</span>
								<i class="tit-ico"></i>
								<i class="tit-text">消费评价</i>
							</h4>
							<div class="detail-cell">
								<div class="detail-cell-local">
									<ul>
								<?php if(is_array($now_group['cue_arr'])): $i = 0; $__LIST__ = $now_group['cue_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['value']): ?><li class="cf">
											<div class="shopping_list_name"><?php echo ($vo["key"]); ?></div>
											<div class="shopping_list_txt"><?php echo ($vo["value"]); ?></div>
										</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
								</div>
							</div>
						</div>
						
						<!--原来的评论-->
						<section class="appraise" id="anchor-reviews">
							<div class="appraise_list cf">
								<div class="appraise_li">
									<div class="zzsc">
										<div class="tab">
											<div class="tab_title rate-filter__item">
												<a href="javascript:;" class="on" data-tab="all">全部</a>
												<a href="javascript:;" data-tab="high">好评</a>
												<a href="javascript:;" data-tab="mid">中评</a>
												<a href="javascript:;" data-tab="low">差评</a>
												<a href="javascript:;" data-tab="withpic">有图</a>
											</div>
										</div>
										<div class="content ratelist-content">
											<div class="appraise_li-list">
												<dl class="J-rate-list"></dl>
											</div>
											<div class="page J-rate-paginator"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="mod_talk_edit mt30">
									<p class="mod_talk_edit_face">
										<a href="">
											<img width="80" height="80" alt="" src="<?php echo ($static_path); ?>images/default.png">
											
										</a>
									</p>
									<div class="mod_talk_edit_cnt">

										<p class="arrow"></p>
										<p class="arrow2"></p>
										<div id="textarea" class="qui-textArea" data-width="536" data-height="80" style="">
											<textarea placeholder="说说您的购买体验" class="ui2_textarea" style="width: 695px; height: 100px;"></textarea>
											<div class="tips">
												<span class="current">0</span>/<span class="max">140</span>
											</div>
										</div>
										<div class="btm clearfix">
											<div style="display:none;" id="textarea-tip" class="ui2_error_layer">
												<p class="ui2_error_layer_arrow"></p>
												<p class="ui2_error_layer_arrow2"></p>
												<p class="ui2_error_layer_text">至少写够10个字，最多不超过140字</p>
											</div>
											<p class="fr">
												<input id="mod_talk_sub" type="button" onclick="window.location.href='<?php echo U('User/Index/index');?>'" value="发表评论" class="ui_buttonB">
											</p>
										</div>

									</div>
								</div>
			        	</section>
				<!--原来的评论-end-->

						<!--评论-->
						
						

						<!--sell record-->
						<div class="detail-unit merchant-deal-record">
							<h4 class="unit-title fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">商家成交记录 
									<span class="record-count">
										(<span class="record-count-num"><?php echo ($all_count); ?></span>)
									</span>
								</i>
							</h4>
							<div class="detail-cell" style="margin-bottom:20px;">
								<table class="record-table">
									<thead>
										<tr>
											<th>买家</th>
											<th class="product-name-th">产品名称</th>
											<th class="product-num-th">数量</th>
											<th>成交时间</th>
										</tr>
									</thead>
									<tbody id="buy_lists">
									
									</tbody>
								</table>
								<div class="mt20 clearfix record-table-pager" id="con-page">
									<p id="loaddata">数据加载中...</p>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						window.onload=function(){
				getBuyList(1);
			}
			var flag=true;
			var permission=true;
			function getBuyList(p){
				if(permission){
				permission=false;
				}else{
					return;
				}
				$.ajax({
					type:'GET',
					url:"<?php echo U('Detail/getOrderListDemo');?>",
					data:{group_id:<?php echo ($now_group["group_id"]); ?>,mer_id:<?php echo ($now_group["mer_id"]); ?>,page:p},
					dataType:"json",
					success:function(data){
						if(data.status==1) {
							var buy_lists = data.info.group_order_list;
							if (flag) {
								$("#buy_lists").empty();
								flag = false;
							}
							if (buy_lists == "") {
								$("#next_page").remove();
								$("#buy_lists").append("<tr><td>已经加载完成...</td></tr>");
							} else {
								var listhtml = "";

								$("#con-page").empty();
								for (var i = 0; i < buy_lists.length; i++) {
									listhtml +="<tr>";
									listhtml +="<td>"+buy_lists[i].nickname + "</td><td><p class='product-name need-dots' style='max-height: 4.2em;'>" + buy_lists[i].order_name + "<span class='ellipsis-dots' style='display: inline;''>...</span></p></td><td>"+buy_lists[i].num+"</td>" +"<td>"+buy_lists[i].last_time+"</td>";
									listhtml +="</tr>";
								}
								var listRows=data.info.list_row;
								if( buy_lists.length<listRows){
									$("#next_page").remove();
									listhtml+="<tr><td>已经加载完成...</td></tr>";
								}else {
									var next_page = data.info.next_page;
									var pagehtml = "";
									pagehtml += "<a class='page-b' page='" + next_page + "' id='next_page' style='display:block;text-align:center;font-size:15px;'> 点击加载更多... </a>";

									pagehtml += "<div style='clear: both;'></div>";

									$("#con-page").append(pagehtml);

									$("#next_page").click(function () {
										getBuyList($(this).attr("page"));
									});
								}
								$("#buy_lists").append(listhtml);
								permission=true;							}
						}
						else if(data.status == 0) {
								if (flag) {
								$("#loaddata").remove();
								$("#buy_lists").empty();
								flag = false;
								}
								$("#buy_lists").append("<li><p>暂时还没有成交记录...</p></li>");
							}
					},
				});
			}
						</script>
						<!--供应商介绍部分-->
					</div>

					<!--侧边开始-->
					<div class="right-merchant">
						<!--侧边开始-->
						<div class="lmSideCell gysj" style="background: #fff;">
							<h4 class="side-title fontYaHei">农场简介</h4>
							<div class="cell-cont">
								<div class="sj-top-wrap">
									<div class="sj-top">
										<div class="img-box">
											<a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html">
												<?php if($now_group['person_image']): ?><img style="width:90px;height:90px;" src="<?php echo ($now_group["person_image"]); ?>">
											<?php else: ?>
											<img style="width:90px;height:90px;" src="<?php echo ($static_path); ?>images/default.png" /><?php endif; ?>										</a>
										</div>
										<div class="text-box" style="display: none;">
											<p class="text-tit">
												<a href="" target="_blank"><?php echo ($now_group["person_name"]); ?></a>
											</p>
											<p class="ico-box">
												<span class="ico-box-img"><img src="<?php echo ($static_path); ?>images/xnd_img/ico-box-01.png"></span>
												<span  class="ico-box-img"><img src="<?php echo ($static_path); ?>images/xnd_img/ico-box-02.png"></span>
											</p>
										</div>
									</div>
									<div class="shop-title">
										<a href="" target="_blank"><?php echo ($now_group["person_name"]); ?></a>
									</div>
									<div style="clear: both;"></div>
									<a class="qjd-entrance" target="_blank" href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html">
										进入该农场<i class="btn-arrow">></i>
									</a>
								</div>
								<div class="sj-phone">
									<h4 class="phone-tit">
										<i class="ico"></i>
										<span class="tit-text">客服电话</span>
									</h4>
									<ul class="phone-list">
										<li><?php echo ($now_group["phone"]); ?></li>
									</ul>

									<p class="phone-day">
										周一至周五 9:00-18:00
									</p>

								</div>
							</div>
						</div>
						<div class="lmSideCell xgsp" style="background: #fff; margin-top: 15px;">
							<h4 class="side-title fontYaHei">该农场的其他特卖</h4>
							<div class="cell-cont">
								<ul class="cell-list">
									<?php if($merchant_group_list): if(is_array($merchant_group_list)): $i = 0; $__LIST__ = $merchant_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
										<div class="pic">
											<a href="<?php echo ($vo["url"]); ?>" target="_blank">
												<img src="<?php echo ($vo["list_pic"]); ?>" />
											</a>
										</div>
										<div class="wenzi">
											<p class="wtop">
												<a href="<?php echo ($vo["url"]); ?>" target="_blank">
													<?php echo ($vo["s_name"]); ?>
												</a>
											</p>
											<p class="wbot">
												特价：<em><?php echo ($vo["price"]); ?></em>元
											</p>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php else: ?>
									<p>
										该农场暂时还没有其他特卖
									</p><?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="lmSideCell yzrmzk" style="background: #fff; margin-top: 15px;">
							<h4 class="side-title fontYaHei">农丁推荐</h4>
							<div class="cell-cont">
								<ul class="cell-list">
									<?php if(is_array($like_group_list)): $i = 0; $__LIST__ = $like_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
										<div class="pic">
											<a href="<?php echo ($vo["url"]); ?>" target="_blank">
												<img src="<?php echo ($vo["list_pic"]); ?>" />
											</a>
										</div>
										<div class="wenzi">
											<p class="wtop">
												<a href="" target="_blank">
													<?php echo ($vo["s_name"]); ?>
												</a>
											</p>
											<p class="wbot">
												特价：<em><?php echo ($vo["price"]); ?></em>元
											</p>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
						
						<div class="lmSideCell bookzk" style="background: #fff; margin-top: 15px;">
							<h4 class="side-title fontYaHei">关注小农丁</h4>
							<div class="cell-cont">
								
								<div class="sao">
									<img src="<?php echo ($static_path); ?>images/xnd_img/app-qr-code.png" />
								</div>
								<div class="ind_emailyd" style="display: none;">
									<form>
										<div class="email clearfix">
											<span class="email-ico"></span>
											<input class="email-input" type="text" name="email" value="" placeholder="输入E-mail" />
											<input class="eamil-submit" type="button" value="订阅" onClick="$(this).parents('form').submit()" />
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--侧边结束-->
					</div>

					<!--侧边结束-->
				</div>
			</div>
		</div>
		
		<!-- 王强新增end -->
		
		
		
		
		
		
		<!-- old -->
		<div class="body" style="display: none;"> 
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
			<article class="product cf">
				<div class="navBreadCrumb cf">
					<ul class="cf">
						<li><a href="<?php echo ($config["site_url"]); ?>">网站首页</a></li>
						<li><span>»</span></li>
						<li><a href="<?php echo ($f_category["url"]); ?>"><?php echo ($f_category["cat_name"]); ?></a></li>
						<li><span>»</span></li>
						<li><a class="link--black__green" href="<?php echo ($s_category["url"]); ?>"><?php echo ($s_category["cat_name"]); ?></a></li>
						<?php if($now_group['store_list'][0]['area']): ?><li><span>»</span></li>
							<li><a href="<?php echo ($now_group["store_list"]["0"]["area"]["url"]); ?>"><?php echo ($now_group["store_list"]["0"]["area"]["area_name"]); ?></a></li>
							<li><span>»</span></li>
							<li><a href="<?php echo ($now_group["store_list"]["0"]["circle"]["url"]); ?>"><?php echo ($now_group["store_list"]["0"]["circle"]["area_name"]); ?></a></li><?php endif; ?>
						<li><span>»</span></li>
						<li><?php echo ($now_group["merchant_name"]); ?></li>
					</ul>
				</div>

				<div class="product_table cf">
					<div class="product_img cf"> 
						<div id="slider">
							<div class="show-box">
								<ul>
									<li><img src="<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>"/></li>
								</ul>
							</div>
							<div class="minImgs">
								<div class="min-box">
									<ul class="min-box-list" style="margin:0px auto;">
										<?php if(is_array($now_group['all_pic'])): $i = 0; $__LIST__ = $now_group['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php if($i == 1): ?>cur<?php endif; ?>">
												<div><img src="<?php echo ($vo["m_image"]); ?>"/></div>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>							  
							</div>
						</div>
					</div>
					<div class="product_list cf">
						<div class="product_list_top cf">
							<div class="product_info">
								<div class="product_name"><span>【<?php echo ($now_group["prefix_title"]); ?>】</span>
									<?php if($now_group['tuan_type'] != 2): echo ($now_group["merchant_name"]); ?>
									<?php else: ?>
									<?php echo ($now_group["s_name"]); endif; ?>
								</div>
							<div class="product_dec"><?php echo ($now_group["intro"]); ?></div>
								<!-- <?php if($now_group['wx_cheap']): ?><div class="product_weixin cf">
										<div class="product_weixin_txt"> 微信购买立减<span>¥<span><?php echo ($now_group["wx_cheap"]); ?></span></span></div>  
										<div class="product_weixin_img"><img src="<?php echo ($static_path); ?>images/xiangqing_07.png"/></div>
										<div class="product_weixin_info">
											<ul>
												<li><i>1.</i> 收藏该<?php echo ($config["group_alias_name"]); ?>单</li>
												<li><i>2.</i> 扫描关注微信号</li>
												<li><i>3.</i> 在微信号中“我的收藏”中购买</li>
											</ul>  
										</div>
									</div><?php endif; ?> -->
								<div class="product_info_list">
									<ul>
										<li class="cf">
											<div class="product_info_list_left">售价1111111111：</div>
											<div class="priduct_price">¥<strong><?php echo ($now_group["price"]); ?></strong><span>¥<?php echo ($now_group["old_price"]); ?></span></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">已售：</div>
											<div class="priduct_sale"><?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">评价：</div>
											<div class="priduct_pingjia">
												<div class="priduct_pingjia_icon">
													<div>
														<span style="width:<?php echo ($now_group['score_mean']/5*100); ?>%"></span>
													</div>
												</div>
												<div class="priduct_pingjia_txt"><a class="see_anchor" href="javascript:void(0);" data-anchor="anchor-reviews"><span><?php echo ($now_group["reply_count"]); ?></span></a> 次评价</div>
											</div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">商家：</div>
											<div class="priduct_shop"><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html" target="_blank"><?php echo ($now_group["merchant_name"]); ?></a>&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;<a class="see_anchor" data-anchor="business-info" href="javascript:void(0);">查看地址/电话</a></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">有效期：</div>
											<div class="priduct_data">截止到<?php echo (date('Y.m.d',$now_group["end_time"])); ?> （<span><?php switch($now_group['is_general']): case "0": ?>周末、法定节假日通用<?php break; case "1": ?>周末不能使用<?php break; case "2": ?>法定节假日不能使用<?php break; endswitch;?></span>）</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="product_info_right">
								<div class="product_info_right_img"><img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']));?>"/></div>
								<p>微信购买立减<span>¥<span><?php echo ($now_group["wx_cheap"]); ?></span></span> </p>
							</div>
						</div>
						<div class="product_list_bottom">
							<form action="<?php echo ($now_group["buy_url"]); ?>" method="get">
							<?php if(isset($mpackages) AND !empty($mpackages)): ?><div class="input cf" id="mpackageslist">
								    <div class="product_info_list_left">套餐：</div>
									 <ul>
									   <?php if(is_array($mpackages)): $i = 0; $__LIST__ = $mpackages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li <?php if($key == $now_group['group_id']): ?>class="current"<?php endif; ?> ><a href="<?php echo ($config["site_url"]); ?>/group/<?php echo ($key); ?>.html"><?php echo ($vv); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
							    </div><?php endif; ?>
								<div class="input cf">
									<div class="product_info_list_left">数量：</div>
									<ul>
										<li><button for="J-cart-minus" type="button">−</button></li>
										<li>
											<input type="text" class="inp J-cart-quantity" name="q" value="<?php echo ($now_group["once_min"]); ?>" maxlength="9" data-max="<?php echo ($now_group["once_max"]); ?>" data-min="<?php echo ($now_group["once_min"]); ?>"/>
										</li>
										<li><button for="J-cart-add" class="item" type="button">+</button></li>
										<li><span class="deal-component-quantity-warning orange"></span></li>
									</ul>
								</div>
								<div class="but cf">
									<button class="info_but" type="submit">立即购买</button>
									<a class="info_shop_but" href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html" target="_blank">商家店铺</a>
									<div class="shou J-component-add-favorite <?php if(!empty($now_group['is_collect'])): ?>yi<?php endif; ?>" fav-id="<?php echo ($now_group["group_id"]); ?>"><?php if(empty($now_group['is_collect'])): ?>收藏<?php else: ?>已收藏<?php endif; ?></div>
								</div>
							</form>
							<div class="baozhang cf">
								<div class="product_info_list_left">保障：</div>
								<div class="baozhang_list">
									<ul class="cf">
										<li>随时退</li>
										<li>过期退</li>
										<li>极速退</li>
										<li>真实评价</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
		<div class="detail_content cf" style="display: none;">
			<div class="content_left">
				<div class="content_navbar" id="J-content-navbar">
					<ul class="cf">
						<li class="current"><a href="#business-info">商家位置</a></li>
						<?php if($now_group['cue_arr']): ?><li><a href="#anchor-purchaseinfo">购买须知</a></li><?php endif; ?>
						<li><a href="#anchor-detail">本单详情</a></li>
						<li><a href="#anchor-bizinfo">商家介绍</a></li>
						<li><a href="#anchor-reviews">消费评价<span class="num J-hub">(<?php echo ($now_group["reply_count"]); ?>)</span></a></li>
					</ul>
					<div id="J-nav-buy" class="buy-group J-hub">
						<a rel="nofollow" class="J-buy btn-hot buy" href="<?php echo ($now_group["buy_url"]); ?>">抢购</a>
					</div>
				</div>
				<section class="address cf" id="business-info">
					<div class="section_title cf">
						<div class="section_txt">商家位置</div>
						<div class="section_border"></div>
					</div>
					<div class="map">
						<div class="map_map">
							<div class="map_map_img">
								<div id="map-canvas" map_point="<?php echo ($now_group["store_list"]["0"]["long"]); ?>,<?php echo ($now_group["store_list"]["0"]["lat"]); ?>" store_name="<?php echo ($now_group["store_list"]["0"]["name"]); ?>" store_adress="<?php echo ($now_group["store_list"]["0"]["area_name"]); echo ($now_group["store_list"]["0"]["adress"]); ?>" store_phone="<?php echo ($now_group["store_list"]["0"]["phone"]); ?>" frame_url="<?php echo U('Map/frame_map');?>"></div>
								<div class="map_icon J-view-full"><img src="<?php echo ($static_path); ?>images/xiangqing_31.png"/></div>
							</div>
						</div>
						<div class="map_txt">
							<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = $now_group['store_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="biz-info <?php if($i == 1): ?>biz-info--open biz-info--first<?php endif; ?> <?php if(count($now_group['store_list']) == 1): ?>biz-info--only<?php endif; ?>">
									<div class="biz-info__title">
										<div class="shop_name"><?php echo ($vo["name"]); ?></div>
										<i class="F-glob F-glob-caret-down-thin down-arrow"></i>
									</div>
									<div class="biz-info__content">
										<div class="shop_add"><span>地址：</span><?php echo ($vo["area_name"]); echo ($vo["adress"]); ?></div>
										<div class="shop_map"><a class="view-map" href="javascript:void(0)" map_point="<?php echo ($vo["long"]); ?>,<?php echo ($vo["lat"]); ?>"  store_name="<?php echo ($vo["name"]); ?>" store_adress="<?php echo ($vo["area_name"]); echo ($vo["adress"]); ?>" store_phone="<?php echo ($vo["phone"]); ?>" frame_url="<?php echo U('Map/frame_map');?>">查看地图</a>&nbsp;&nbsp;&nbsp;<a class="search-path" href="javascript:void(0)" shop_name="<?php echo ($vo["adress"]); ?>">公交/驾车去这里</a></div>
										<div class="shop_ip"><span>电话：</span><?php echo ($vo["phone"]); ?></div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</section>
				<?php if($now_group['cue_arr']): ?><section class="shopping cf" id="anchor-purchaseinfo">
						<div class="section_title cf">
							<div class="section_txt">购买须知</div>
							<div class="section_border"></div>
						</div>
						<div class="shopping_list">
							<ul>
								<?php if(is_array($now_group['cue_arr'])): $i = 0; $__LIST__ = $now_group['cue_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['value']): ?><li class="cf">
											<div class="shopping_list_name"><?php echo ($vo["key"]); ?></div>
											<div class="shopping_list_txt"><?php echo ($vo["value"]); ?></div>
										</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</section><?php endif; ?>
				<section class="package cf" id="anchor-detail">
					<div class="section_title cf">
						<div class="section_txt">本单详情</div>
						<div class="section_border"></div>
					</div>
					<style>
						.BMap_cpyCtrl{display:none;}
						.group_content{padding-top:20px;font-size:14px;  color: #666;}
						.group_content table { width:100%!important; margin-top:0px; border:none; color:#222;  border-collapse: collapse;border-spacing: 0; }
						.group_content table .name { width:auto; text-align:left; border-left:none; }
						.group_content table .price { width:15%; text-align:center; }
						.group_content table .amount { width:15%; text-align:center; }
						.group_content table .subtotal { width:15%; text-align:right; border-right:none; font-family: arial, sans-serif; }
						.group_content table caption, .group_content table th, .group_content table td { padding:8px 10px; background:#FFF; border:1px solid #E8E8E8; border-top:none; word-break:break-all; word-wrap:break-word; }
						.group_content table caption { background:#F0F0F0; }
						.group_content table caption .title, .group_content table .subline .title { font-weight:bold; }
						.group_content table th { color:#333; background:#F0F0F0; font-weight:bold; border-left-style:none; border-right-style:none;}
						.group_content table td { color:#666; /*border-left-style:none; border-right-style:none;*/ border-bottom-style:dotted; }
						.group_content table .subline { background:#fff; text-align:center; border-left:none; border-right:none; }
						.group_content table .subline-left { width:22%; text-align:left;border-right: 1px #e8e8e8 dotted; }
						.group_content p{  margin: 10px 0;font: 14px/24px helvetica neue,helvetica,arial,simsun,"微软雅黑",Hiragino Sans GB,sans-serif;color: #666;}
						.deal-menu-summary { padding:0 10px 10px; text-align:right; border-bottom:1px #e8e8e8 solid; }
						.deal-menu-summary .worth { display:inline-block; min-width:10px; _width:10px; padding-right:20px; text-align:left; word-break:normal; word-wrap:normal; font-weight:bold; }
						.deal-menu-summary .price { color:#ea4f01; padding-right:0; }
						.group_content ul.list{margin:10px 0 15px;padding-left:18px;}
						.group_content ul.list li {list-style-position: outside;list-style-type: disc;margin-bottom: 5px;}
					</style>
					<div class="group_content"><?php echo ($now_group["content"]); ?></div>
				</section>
				<section class="introduce cf" id="anchor-bizinfo">
					<div class="section_title cf">
						<div class="section_txt"><a name="anchor-bizinfo">商家介绍</a></div>
						<div class="section_border"></div>
					</div>
					<div class="introduce_title"><?php echo ($now_group["merchant_name"]); ?></div>
					<div class="introduce_txt"><?php echo ($now_group["txt_info"]); ?></div>
					<div class="introduce_img">
						<?php if(is_array($now_group['merchant_pic'])): $i = 0; $__LIST__ = $now_group['merchant_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vo); ?>" alt="<?php echo ($now_group["merchant_name"]); ?>" class="standard-image"/><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</section>
				<section class="appraise" id="anchor-reviews">
					<div class="section_title cf">
						<div class="section_txt">消费评价</div>
						<div class="section_border"></div>
					</div>
					<div class="appraise_list cf">
						<div class="appraise_title">
							<ul class="cf">
								<li class="pingfen">
									<div class="ping"><span><?php echo ($now_group["score_mean"]); ?></span>分</div>
									<div class="appraise_icon"><div><span style="width:<?php echo ($now_group['score_mean']/5*100); ?>%"></span></div></div>
								</li>
								<li class="pingjia">共 <span><?php echo ($now_group["reply_count"]); ?></span> 次评价</li>
								<li class="pinglun">
									<a class="fabiao" href="<?php echo U('User/Index/index');?>">
										<img src="<?php echo ($static_path); ?>images/xiangqing_54.png"/>
										<p>发表评论</p>
									</a>
								</li>
							</ul>
						</div>
						<div class="appraise_li">
							<div class="zzsc">
								<div class="tab">
									<div class="tab_title rate-filter__item">
										<a href="javascript:;" class="on" data-tab="all">全部</a>
										<a href="javascript:;" data-tab="high">好评</a>
										<a href="javascript:;" data-tab="mid">中评</a>
										<a href="javascript:;" data-tab="low">差评</a>
										<a href="javascript:;" data-tab="withpic">有图</a>
									</div>
									<div class="tab_form">
										<div class="form_sec">
											<select name="时间排序" class="select J-filter-ordertype">
												<option value="default">默认排序</option>
												<option value="time">时间排序</option>
												<option value="score">好评排序</option>
											</select>
										</div>
									</div>
								</div>
								<div class="content ratelist-content">
									<div class="appraise_li-list">
										<dl class="J-rate-list"></dl>
									</div>
									<div class="page J-rate-paginator"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="shop_bottom">
					<ul>
						<li>
							<div class="shop_bottom_pirce">¥<span><?php echo ($now_group["price"]); ?></span></div>
						</li>
						<li>
							<div class="shop_bottom_list">门店价</div>
							<div class="shop_bottom_txt">¥<?php echo ($now_group["old_price"]); ?></div>
						</li>
						<li>
							<div class="shop_bottom_list">折扣</div>
							<div class="shop_bottom_txt"><?php echo ($now_group["discount"]); ?>折</div>
						</li>
						<li>
							<div class="shop_bottom_list">已售</div>
							<div class="shop_bottom_txt"><?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></div>
						</li>
						<li style="float:right">
							<a class="shop_bottom_but" href="<?php echo ($now_group["buy_url"]); ?>">抢购</a>
						</li>
					</ul>
				</section>
			</div>
			<?php if($category_hot_group_list): ?><div class="content_right">
					<div class="activity">
						<div class="activity_title">看了本<?php echo ($config["group_alias_name"]); ?>的人还看了</div>
						<div class="content_right_list">
							<ul>
								<?php if(is_array($category_hot_group_list)): $i = 0; $__LIST__ = $category_hot_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<a href="<?php echo ($vo["url"]); ?>" target="_blank">
											<div class="category_list_img">
												<img src="<?php echo ($vo["list_pic"]); ?>" title="【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?>"/>
												<div class="bmbox">
													<div class="bmbox_title">该商家有<span>465</span>个粉丝</div>
													<div class="bmbox_list">
														<div class="bmbox_list_img"><img class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$vo['group_id']));?>"/></div>
														<div class="bmbox_list_li">
															<ul>
																<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($vo["mer_id"]); ?>.html">商家</li>
																<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
																<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
																<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mermap/<?php echo ($vo["mer_id"]); ?>.html">地图</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="datal cf">
												<div class="category_list_title">【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?></div>
												<div class="deal-tile__detail cf"><span id="price">¥<strong><?php echo ($vo["price"]); ?></strong></span></div>
												<div class="extra-inner cf">
													<div class="sales">已售<strong class="num"><?php echo ($vo['sale_count']+$vo['virtual_num']); ?></strong></div>
												</div>
											</div>
										</a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div><?php endif; ?>
		</div>
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
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/xnd_js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/xnd_js/stickUp.min.js"></script>
		<script src="<?php echo ($static_path); ?>js/xnd_js/channel_block.js"></script>
		
<script type="text/javascript">
			
       jQuery(function($) {
          $(document).ready( function() {
            $('.detail-nav-wrap').stickUp({
              parts: {
                  0:'li-0',
                  1:'li-1',
                  2: 'li-2',
                  3: 'li-3',
                },
                itemClass: 'active2',
                itemHover: 'active'
            });
        });
      });
      $('.li-0').click(function(){$('html,body').animate({scrollTop:$('.cpjs').offset().top}, 800);}); 
      $('.li-1').click(function(){$('html,body').animate({scrollTop:$('.zkxq').offset().top}, 800);}); 
      $('.li-2').click(function(){$('html,body').animate({scrollTop:$('.xts').offset().top}, 800);}); 
      $('.li-3').click(function(){$('html,body').animate({scrollTop:$('.pl').offset().top}, 800);}); 
</script>
	</body>
</html>