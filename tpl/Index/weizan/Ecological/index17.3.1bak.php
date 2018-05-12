<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
    <meta name="keywords" content="{pigcms{$config.seo_keywords}" />
    <meta name="description" content="{pigcms{$config.seo_description}" />
    <link href="http://www.xiaonongding.com/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
    <!-- 王强新增 -->
    <link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" /><!-- 全局基础样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/index_block.css" rel="stylesheet" /> <!--首页版块样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/shop-list.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.css" rel="stylesheet" /><!-- 头部样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/footer.css.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script><!-- 焦点图左侧大导航js -->
    <script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/public.css"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/index.css"/>
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

    </head>
<body style="background: #fff;">
	
<include file="Public:head_topnew"/>
<div class="main-public" style="margin-top: 10px;">
	
		<!-- 4张广告图 -->
		<div class="banner-four">
			 <div class="four-left">
				<div class="four-01">
					<img src="{pigcms{$static_path}images/xnd_img/guanggao01.jpeg" />
				</div>
				<div class="four-02">
					<img src="{pigcms{$static_path}images/xnd_img/guanggao02.jpeg" />
				</div>
				<div class="four-03">
					<img src="{pigcms{$static_path}images/xnd_img/guanggao03.jpeg" />
				</div>
				<div class="four-04">
					<img src="{pigcms{$static_path}images/xnd_img/guanggao04.jpeg" />
				</div>
			 </div>
			 <div class="four-right">
				<img src="{pigcms{$static_path}images/xnd_img/guanggao03.jpeg" />
			 </div>
			<div style="clear: both;"></div>
		</div>
	
			<!-- 主题游 -->
			<div class="main-fenlei">
				<div class="fenlei-title">
					<a href="#" target="_blank"><span>查看更多></span></a>
					<h3><i><img src="{pigcms{$static_path}images/xnd_img/icon-title.png" /></i>主题游</h3>
					<ul>
						<li class="on"><a href="#">亲子游</a></li>
						<li><a href="#">蜜月游</a></li>
						<li><a href="#">户外活动</a></li>
						<li><a href="#">海鲜美食</a></li>
						<li><a href="#">自驾游</a></li>
						<li><a href="#">租车游</a></li>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="fenlei-main">
					<div class="fenlei-left">
						<div class="left-img">
							<img src="{pigcms{$static_path}images/xnd_img/shanshuilouceng1.png" />
						</div>
						<div class="left-list">
							<ul>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
							</ul>
						</div>
					</div>
					<div class="fenlei-right">
						<ul>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			    <div style="clear: both;"></div>
			</div>
		    
		    <!-- 体验游 -->
			<div class="main-fenlei">
				<div class="fenlei-title">
					<span>查看更多></span>
					<h3><i><img src="{pigcms{$static_path}images/xnd_img/icon-title.png" /></i>体验游</h3>
					<ul>
						<li class="on"><a href="#">采摘</a></li>
						<li><a href="#">烧烤</a></li>
						<li><a href="#">民宿</a></li>
						<li><a href="#">农家宴</a></li>
						<li><a href="#">钓鱼</a></li>
						<li><a href="#">滑雪</a></li>
						<li><a href="#">旱冰</a></li>
						<li><a href="#">温泉</a></li>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="fenlei-main">
					<div class="fenlei-left">
						<div class="left-img">
							<img src="{pigcms{$static_path}images/xnd_img/guzhenlouceng1.png" />
						</div>
						<div class="left-list">
							<ul>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
							</ul>
						</div>
					</div>
					<div class="fenlei-right">
						<ul>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		    
		    <!-- 农家宴周边游 -->
			<div class="main-fenlei">
				<div class="fenlei-title">
					<span>查看更多></span>
					<h3><i><img src="{pigcms{$static_path}images/xnd_img/icon-title.png" /></i>周边游</h3>
					<ul>
						<li class="on"><a href="#">热门景点</a></li>
						<li><a href="#">北京</a></li>
						<li><a href="#">上海</a></li>
						<li><a href="#">天津</a></li>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="fenlei-main">
					<div class="fenlei-left">
						<div class="left-img">
							<img src="{pigcms{$static_path}images/xnd_img/remailouceng1.png" />
						</div>
						<div class="left-list">
							<ul>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
							</ul>
						</div>
					</div>
					<div class="fenlei-right">
						<ul>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		
		    <!-- 景点游 -->
			<div class="main-fenlei">
				<div class="fenlei-title">
					<span>查看更多></span>
					<h3><i><img src="{pigcms{$static_path}images/xnd_img/icon-title.png" /></i>景点游</h3>
					<ul>
						<li class="on"><a href="#">门票</a></li>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<div class="fenlei-main">
					<div class="fenlei-left">
						<div class="left-img">
							<img src="{pigcms{$static_path}images/xnd_img/wenquan.png" />
						</div>
						<div class="left-list">
							<ul>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
								<li>
									<a href="#">
									<span><i></i>50252</span>
									 <h3>古北水镇</h3>
									 </a>
								</li>
							</ul>
						</div>
					</div>
					<div class="fenlei-right">
						<ul>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
							<li>
								<a href="#" target="_blank">
								<div class="pic" style="background-image: url({pigcms{$static_path}images/xnd_img/shop.jpg);">
									<span class="pic-ceng">
									</span>
									<h3 class="pic-title">含双早，赠水镇价值150元/人门票</h3>
								</div>
								<div class="price">
									<span>&yen;</span>901
									<span>元/份</span>
									<span class="myd">
										满意度：<i>97%</i>
									</span>
								</div>
								<div class="name">
									<h3>含双早，赠水镇价值150元/人门票，贴心赠送电瓶车接送一次，享长城脚下温泉体验，更有家庭房3人间可选</h3>
								</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		  
		  
			
		
		</div>
<include file="Public:footer"/>
</body>
</html>