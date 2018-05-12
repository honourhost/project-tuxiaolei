<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<title>小农丁-致力于打造中国最专业的O2O生态农场平台</title>
<meta name="keywords" content="小农丁，O2O，O2O生态农场平台，创意采摘，农业众筹，农场活动，休闲观光，度假村，温泉农庄，科普基地，拓展培训，生态农庄" />
<meta name="description" content="小农丁(www.xiaonongding.com)-首家为国内生态农场提供优质农产品特卖，创意农场众筹，及农场线下活动体验的一站式O2O开放平台！小农丁秉承绿色健康原生态、产地直达的经营理念，为消费者推荐农特生鲜、创意生态游、特色农家乐、创意采摘亲子游等特色服务，让您真正的体味回归田园的愉悦！" />
<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css2/style.css"/>
<script>
    var phpData = {uid:0, jsVersion:1 };
    window.QYER = {
        uid:phpData.uid,
        FED:{
            config:{
                version:phpData.jsVersion,
                pageID:"a32a91d5-4fc2-606a-5956-354177696857",
                pagePath:"project/web/lm/promotion/20151029lmApp/"
            }
        }
    };
    phpData=null;
    
</script>

<script type="text/javascript" src="js2/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js2/a32a91d5-4fc2-606a-5956-354177696857.js"></script>
<script type="text/javascript" src="js2/jquery.fullPage.min.js"></script>
</head>
<body>

<!-- 页面主体 start -->
<ul id="menu">
    <li class="menu-cell" data-menuanchor="page1"><a href="#page1"></a></li>
    <li class="menu-cell" data-menuanchor="page2"><a href="#page2"></a></li>
    <li class="menu-cell" data-menuanchor="page3"><a href="#page3"></a></li>
    <li class="menu-cell" data-menuanchor="page4"><a href="#page4"></a></li>
    <li class="menu-cell" data-menuanchor="page5"><a href="#page5"></a></li>
</ul>

<div id="fullpage">
	<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">
<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />

<script src="<?php echo ($static_path); ?>js/xnd_js/headerfoot_black.min.js" async="async"></script>
<!-- 公用头部 -->
<div class="q-layer-header" style="position:absolute; z-index: 1000000000000000; left: 0; top: 0;">
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
								<a class="nav-span icon-phone-a" href="">
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
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的订单
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的评价
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的收藏
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的积分
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 账户余额
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 收货地址
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
											<i class="iconfont icon-wenda"></i> 商家中心
										</a>
									</li>
									<li>
										<a href="<?php echo ($config["site_url"]); ?>/merchant.php" title="">
											<i class="iconfont icon-wenda"></i> 我想合作
										</a>
									</li>
									
								</ul>
							</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶部导航end -->
		
		<script type="text/javascript" src="js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		
		<!-- 公用头部 -->

<!-- 王强新增header end -->



    <div class="pages pages1 section" id="cont1" data-anchor="page1">
        <div class="pages-inner clearfix">
            <img class="view-img" src="img2/page-1-left-img.png" />
            <img class="view-text" src="img2/page-1-right-text.png" />
            <div class="btn-wrap">
                <a class="btn-1" target="_blank" href="https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8"></a>
                
                <a class="btn-3" target="_blank" href="http://fir.im/lscu"></a>
                <img class="img-sao" src="img2/page-1-right-sao.png" />
            </div>
        </div>
    </div>

    <div class="pages pages2 section" id="cont2" data-anchor="page2">
        <div class="pages-inner clearfix">
            <img class="view-text" src="img2/page-2-text.png" />
            <img class="view-img" src="img2/page-2-img-1.png" />
        </div>
    </div>

    <div class="pages pages3 section" id="cont3" data-anchor="page3">
        <div class="pages-inner clearfix">
            <div class="text-wrap">
                <img class="view-text" src="img2/page-3-text.png" />
                <img class="view-ico" src="img2/page-3-ico.png" />
            </div>
            <img class="view-img" src="img2/page-3-img.png" />
        </div>
    </div>

    <div class="pages pages4 section" id="cont4" data-anchor="page4">
        <div class="pages-inner clearfix">
            <img class="view-img" src="img2/page-4-img.png" />
            <div class="text-wrap">
                <img class="view-text" src="img2/page-4-text.png" />
                <img class="view-ico" src="img2/page-4-ico.png" />
            </div>
        </div>
    </div>

    <div class="pages pages5 section" id="cont5" data-anchor="page5">
        <div class="pages-inner clearfix">
            <img class="view-text" src="img2/page-5-text.png" />
            <div class="btn-wrap">
                 <a class="btn-1" target="_blank" href="https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8"></a>
                
                 <a class="btn-3" target="_blank" href="http://fir.im/lscu"></a>
                <img class="img-sao" src="img2/page-5-sao.png" />
            </div>
        </div>
    </div>
</div>
<!-- 页面主体 start -->
<!-- 页面尾部 start -->
<div class="footer-fixed">
	<div class="footer-fixed-main">
		<img src="img2/big_img.png" class="lf">
		<div class="footer-fixed-btn">
			<a class="footer-fixed-login" target="_blank" href="http://www.xiaonongding.com/index.php?g=Index&c=Login&a=index">登录</a>或
			<a class="footer-fixed-register" target="_blank" href="http://www.xiaonongding.com/index.php?g=Index&c=Login&a=reg">注册小农丁</a>
		</div>
		<div class="footer-fixed-close"></div>
	</div>
</div>
<script>
$(function(){
setTimeout('$(".footer-fixed").slideDown("slow")');
$(document).ready(function(){
  $(".footer-fixed-close").click(function(){
    $(".footer-fixed").slideUp("slow");
  });
});
});
</script>
</body>
</html>