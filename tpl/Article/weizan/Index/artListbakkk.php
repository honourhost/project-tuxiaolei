<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>文章列表 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />

		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/activity.css"  rel="stylesheet"  type="text/css" />
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script>
		
		<!--[if IE 6]>
		<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
			body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
		</style>
		<![endif]-->
		<!-- 2016.5.6  新增css -->
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/articlelist.css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/articledetails.css" />
		<style>
			#conContainer {
				padding-top: 0;
				width: 100%;
				min-width: 800px;
			}
			
			.con-pic {
				width: 48px;
			}
			
			.nearby {
				width: 100%;
			}
			#listContent{
				width: 840px;
			}
			.qunar {
				width: 840px;
				margin:0px auto;
				position: relative;
				overflow: hidden;
			}
			.qunar .e_pic_wrap {
				z-index: 1;
				white-space: nowrap;
				width: 840px;
				height: 260px;
			}
			.qunar .e_pic_wrap li {
				position: relative;
				display: inline;
				width: 840px;
				height: 260px;
				overflow: hidden;
			}
			.qunar .e_bg_flt {
				position: absolute;
				right: 0;
				top: 0;
				width: 270px;
				height: 260px;
				background: #000;
				filter: alpha(opacity=50);
				-moz-opacity: .5;
				opacity: .5;
				z-index: 10;
			}
			.qunar .e_flt_inf {
				position: absolute;
				right: 0;
				top: 0;
				width: 227px;
				height: 180px;
				padding: 25px 28px 10px 15px;
				overflow: hidden;
				z-index: 20;
				color: #fff;
				white-space: normal;
				word-wrap: break-word;
			}
			.qunar .e_flt_inf h2 {
				font: 18px/25px "微软雅黑";
			}
			.qunar .e_flt_inf h3 {
				font: 16px/22px "微软雅黑";
				margin-bottom: 22px;
			}
			.qunar .e_flt_inf h3 a, .qunar .e_flt_inf h2 a {
				color: #fff;
			}
			.qunar .e_flt_inf .t_info {
				line-height: 20px;
				height: 84px;
				overflow: hidden;
				margin-top: 30px;
			}
			.qunar .e_flt_inf .t_info a {
				color: #fff;
			}
			.qunar .e_flt_inf .t_info .l_view {
				background: url(ico_p1.png) no-repeat scroll -120px 0;
				color: #fff;
				width: 39px;
				height: 14px;
				line-height: 14px;
				padding: 0 2px;
				display: inline-block;
			}
			.qunar .e_sep {
				color: #81d6d3;
				position: absolute;
				bottom: 20px;
				right: 20px;
				width: 235px;
				z-index: 20;
			}
			.qunar .e_sep a {
				color: #81d6d3;
			}
			.e_prevnext .prev, .e_prevnext .next {
				position: absolute;
				z-index: 30;
				display: block;
			}
			.e_prevnext .prev {
				top: 113px;
				left: 10px;
			}
			.e_prevnext .next {
				top: 113px;
				right: 10px;
			}
			.e_prevnext .prev a, .e_prevnext .next a {
				display: block;
				width: 25px;
				height: 32px;
				overflow: hidden;
				background: url({pigcms{$static_path}images/ico_prevnext.png) no-repeat scroll 0 0;
				_background-image: url({pigcms{$static_path}images/ico_prevnext_ie6.png);
			}
			.e_prevnext .prev a {
				background-position: 0 0;
			}
			.e_prevnext .prev a:hover {
				background-position: 0 -40px;
			}
			.e_prevnext .next a {
				background-position: 0 -80px;
			}
			.e_prevnext .next a:hover {
				background-position: 0 -120px;
			}
		</style>
		<script src="{pigcms{$static_path}js/jquery.SuperSlide.js"></script>
		<!-- 2016.5.6  新增css -->
	</head>
	<body>
		<include file="Public:header_top"/>
		
		<!-- 头图 -->
		<div class="zw-module-banner-wrap" style="display: none;">
			<a class="banner-btn banner-prev-btn" href="javascript:void(0);"></a>
			<php>$list=getAdvList("article_top",1);</php>
			<ul class="zw-module-banner-imglist clearfix">
				<volist name="list" id="adv">
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="{pigcms{$adv.url}" target="_blank" style="background-image:url({pigcms{$config.site_url}/upload/adver/{pigcms{$adv.pic});"></a>
				</li>
				</volist>
			</ul>
			<a class="banner-btn banner-next-btn" href="javascript:void(0);"></a>
		</div>
		<!-- 头图 end -->
        <!-- 2016.5.6  html 主体内容新增  -->
		<div class="content-box">
			<style>
					.nearby{
						margin-top: 0;
						border-left: 0;
						border-right: 0;
						border-top: 0;
					}
				</style>
			<div class="content-main">
				<div class="content-box-left2">
				<div class="lunbo" style=" display: none;">
						<div class="qunar">
						  <div class="e_pic_wrap">
						    <div class="tempWrap" style="overflow:hidden; position:relative; width:840px">
						      <ul style="width: 8736px; position: relative; overflow: hidden; padding: 0px; margin: 0px; left: -2912px;">
						        <li style="float: left; width: 840px;"><a href="http://www.xiaonongding.com/article/342.html" target="_blank"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/lunbo.jpg"></a>
						          <div class="e_flt_inf">
						            <h2><a href="http://www.xiaonongding.com/article/342.html">河南力推两牛产业 今年将新增5万优质奶牛20万优质肉牛</a></h2>
						            <p class="t_info"><a href="http://www.xiaonongding.com/article/342.html">2月8日，河南省畜牧工作会议在郑州召开。河南省将深入推进畜牧业供给侧结构性改革，2017年要新增优质奶牛5万头、优质肉牛20万头，把“两牛”产业发展作为畜牧业结构调整的突破口，全面提升畜牧业的质量、效益和竞争力。</a><a href="javascript:" class="l_view">去看看</a></p>
						          </div>
						          <div class="e_bg_flt"></div>
						        </li>
						        <li style="float: left; width: 840px;"><a href="http://www.xiaonongding.com/article/343.html" target="_blank"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/lunbo2.jpg"></a>
						          <div class="e_flt_inf">
						            <h2><a href="http://www.xiaonongding.com/article/343.html">什么？创业者别光想着做CEO，他首先应是一名出色的销售</a></h2>
						            <p class="t_info"><a href="http://www.xiaonongding.com/article/343.html">创业者总是更愿意自视为创客而非推销员，对此，销售理论及实操专家Jeff Hoffman提醒我们要正视这个问题，培养自己对销售的热情。</a><a href="javascript:" class="l_view">去看看</a></p>
						          </div>
						          <div class="e_bg_flt"></div>
						        </li>
						      </ul>
						    </div>
						  </div>
						  <div class="e_prevnext">
						    <div class="prev"><a href="javascript:void(0)"></a></div>
						    <div class="next"><a href="javascript:void(0)"></a></div>
						  </div>
						</div>
						<script >
						jQuery(".qunar").slide({ mainCell:".e_pic_wrap ul",effect:"leftLoop", autoPlay:false, delayTime:400});
						</script>
				</div>
				<div class="content-box-left">
					<div class="menu_table" style="margin-bottom: 10px;">
						<div class="nearby cf">
							<div class="category cf" style="border:0;">
								<div class="cate">类别：</div>
								<div class="cate_cate">
									<span><if condition="$_GET['cat_id'] eq all"><a href="{pigcms{$config.site_url}/article/cat/all.html" style="color:red;padding: 4px 10px;background: #12af7e;color: #fff;">全部</a><else/><a href="{pigcms{$config.site_url}/article/cat/all.html" >全部</a></if></span><volist name="lists" id="cat"><if condition="$_GET['cat_id'] eq $cat['cat_url']"><span><a href="{pigcms{$config.site_url}/article/cat/{pigcms{$cat.cat_url}.html" style="color:red;padding: 4px 10px;background: #12af7e;color: #fff;">{pigcms{$cat.name}</a></span><else/><span><a href="{pigcms{$config.site_url}/article/cat/{pigcms{$cat.cat_url}.html">{pigcms{$cat.name}</a></span></if></volist></div>
							</div>
						</div>
					</div>
					<div id="conContainer">
						<div id="listContent" class="clearfix">
							<div class="lc-fl">
								<style>
									.content-box-left p{
										line-height: 22px;
									}
								</style>
								<div class="tab-content">
									<div class="yjgl tabcell">
										<div class="ylcon-wrap">
											<if condition="$texts">
											<volist name="texts" id="text" >
												<div class="yl-con">
												<div class="con-inner xfix">
													<dl class="con-detail">
														<dd class="xcfb">
															<div class="tle-con">
																<p>
																	<a class="tc-title aptle" href="{pigcms{$config.site_url}/article/{pigcms{$text.pigcms_id}.html" target="_blank">{pigcms{$text.title}																		
																	</a>
																</p>
																<p class="tc-desc">{pigcms{$text.digest}</p>
																<span class="con-time">
																	<i class="inbg2 zhhf2"></i>
																	来源：<a href="{pigcms{$config.site_url}/merindex/{pigcms{$text.mer_id}.html" target="_blank">{pigcms{$text.name}</a>
																	&nbsp;&nbsp;&nbsp;
																	<i class="inbg3 zhhf2"></i>
																	发布时间：<b class="xnum"><php>echo date("Y-m-d H:m:s",$text['dateline']);</php></b>
																	&nbsp;&nbsp;&nbsp;
																	<i class="inbg4 zhhf2"></i>
																	阅读量：<b class="xnum">100</b>
																</span>
															    
															</div>
															<a href="{pigcms{$config.site_url}/article/{pigcms{$text.pigcms_id}.html" class="tc-awrap anchtoup" target="_blank">
																<div class="tc-rimg" style="background-image: url({pigcms{$config.site_url}{pigcms{$text.cover_pic});"></div>
															</a>
														</dd>
													</dl>
												</div>
											</div>
											</volist>

										<div class="page2">
										{pigcms{$pagebar}
										</div>
											<else/>
											<h3>暂时没有该分类下文章...</h3>
											</if>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				</div>
				
				
				
				
				
				
				
				<div class="content-box-right">
					<!-- 时间轴 -->
					<div class="times-zhou">
						<h4 class="hot-tuijian">TOP10</h4>
						<p style="display: none;" class="zanwu">暂无最新动态!</p>
						<ul >
							<!-- 最新动态列表 -->
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<li>
								<label>1小时前</label>
								<div class="tims-r">
									<span></span>
									<a href="#">
									<h4>
										刘晓光：男子汉就要有自己的事业刘晓光：男子汉就要有自己的事业 
									</h4>
									</a>
								</div>
								<div style="clear: both;"></div>
							</li>
							<!-- 最新动态列表 end-->
						</ul>
					</div>
					<div class="hot-main">
					    <h4 class="hot-tuijian">热门关注</h4>
						<ul>
							<volist name="textlist" id="onetext">
								<li>
								<div class="left-img">
									<a href="{pigcms{$config.site_url}/article/{pigcms{$onetext.pigcms_id}.html" style="cursor:pointer;"><img src="{pigcms{$config.site_url}{pigcms{$onetext.cover_pic}"></a>
								</div>
								<div class="right-title">
									<a href="{pigcms{$config.site_url}/article/{pigcms{$onetext.pigcms_id}.html" style="cursor:pointer;">
										<h3>{pigcms{$onetext.title}</h3>
										<span><php>echo date("Y-m-d H:m:s",$onetext['dateline']);</php></span>
									</a>
								</div>
							</li>
							</volist>
							<div style="clear: both;"></div>
						</ul>
					</div>
					<!-- 关注小农丁 -->
					<div class="guanzhu-nd">
						<h4 class="hot-tuijian">关注小农丁</h4>
						<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/app-qr-code.png" />
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<!-- 2016.5.6  html 主体内容新增  end-->
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
	</body>
</html>
