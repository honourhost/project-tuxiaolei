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
		</style>
		<!-- 2016.5.6  新增css -->
	</head>
	<body>
		<include file="Public:header_top"/>
		
		<!-- 头图 -->
		<div class="zw-module-banner-wrap">
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
			<div class="content-main">
				<div class="menu_table" style="margin-bottom: 20px;">
					<div class="nearby cf">
						<div class="category cf" style="border:0;">
							<div class="cate">类别：</div>
							<div class="cate_cate">
								<span><a href="{pigcms{$config.site_url}/article/cat/all.html">全部</a></span><volist name="lists" id="cat"><span><a href="{pigcms{$config.site_url}/article/cat/{pigcms{$cat.cat_url}.html" >{pigcms{$cat.name}</a></span></volist></div>
						</div>
					</div>
				</div>
				<div class="content-box-left">
					<div id="conContainer">
						<div id="listContent" class="clearfix">
							<div class="lc-fl">

								<div class="tab-content">
									<div class="yjgl tabcell">
										<div class="ylcon-wrap">
											<volist name="texts" id="text">
												<div class="yl-con">
												<div class="con-inner xfix">
													<a href="{pigcms{$config.site_url}/merindex/{pigcms{$text.mer_id}.html" target="_blank" class="anchtoup">
														<img class="con-pic" src="{pigcms{$text.person_image}">
													</a>
													<dl class="con-detail">
														<dt class="dl-title">
															<a href="{pigcms{$config.site_url}/merindex/{pigcms{$text.mer_id}.html" class="dl-name xc32 aptle" target="_blank">{pigcms{$text.person_name}</a>
														</dt>
														<div style="clear: both;"></div>
														<dd class="dl-des">
															<span class="dd-inw">在
															<strong>
																<a href="{pigcms{$config.site_url}/merindex/{pigcms{$text.mer_id}.html" target="_blank">{pigcms{$text.name}</a>
															</strong>发布

															<span class="con-time">
																<i class="inbg zhhf"></i>
																发布时间
																<b class="xnum"><php>echo date("Y-m-d H:m:s",$text['dateline']);</php></b>
															</span>
														</dd>
														<dd class="xcfb">
															<div class="tle-con">
																<p>
																	<a class="tc-title aptle" href="{pigcms{$config.site_url}/article/{pigcms{$text.pigcms_id}.html" target="_blank">{pigcms{$text.title}
																		
																	</a>
																</p>
																<p class="tc-desc">{pigcms{$text.digest}</p>
															</div>
															<a href="{pigcms{$config.site_url}/article/{pigcms{$text.pigcms_id}.html" class="tc-awrap anchtoup" target="_blank">
																<img class="tc-rimg" src="{pigcms{$config.site_url}{pigcms{$text.cover_pic}">
															</a>
														</dd>
													</dl>
												</div>
											</div>
											</volist>
											
										<div>
										{pigcms{$pagebar}
										</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
				<div class="content-box-right">
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
				<div style="clear: both;"></div>
			</div>
		</div>
		<!-- 2016.5.6  html 主体内容新增  end-->
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
	</body>
</html>
