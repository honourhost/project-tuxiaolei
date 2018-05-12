<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>文章详情 - {pigcms{$config.site_name}</title>
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
				min-width: 700px;
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
				<div class="content-box-left">
					<h1 class="con-title">{pigcms{$article.title}</h1>
					<div class="content-tm">
						
						<h3><php>echo date("Y-m-d H:m:s",$article['dateline']);</php></h3>
						<i>{pigcms{$article.count}人阅读过</i>
					</div>
					<p>{pigcms{$article.content}
					</p>
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
