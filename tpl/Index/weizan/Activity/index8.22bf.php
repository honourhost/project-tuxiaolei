<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>活动列表 - {pigcms{$config.site_name}</title>
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
	</head>
	<body>
		<include file="Public:header_top"/>
		
		<!-- 头图 -->
		<div class="zw-module-banner-wrap">
			<a class="banner-btn banner-prev-btn" href="javascript:void(0);"></a>
			<php>$list=getAdvList("activity_top",1);</php>
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
        <div class="body2">
			<div class="menu_table">
				<div class="nearby cf">
					<if condition="$_SESSION['areaarr'] neq 'all'">
					<div class="category cf">
						<div class="cate">区域：</div>
						<div class="cate_cate">
							<volist name="activity_area_list" id="vo">
								<span><a href="{pigcms{$vo.url}" <if condition="$activity_area eq $vo['area_url']">style="color:red;padding: 4px 10px;background: #12af7e;color: #fff;"</if>>{pigcms{$vo.area_name}</a></span>
							</volist>
						</div>
					</div>
					<else/>
					</if>
					<div class="category cf" style="border:0;">
						<div class="cate">类别：</div>
						<div class="cate_cate">
							<volist name="activity_type_list" id="vo">
								<span><a href="{pigcms{$vo.url}" <if condition="$activity_type eq $vo['type']">style="color:red;padding: 4px 10px;background: #12af7e;color: #fff;"</if>>{pigcms{$vo.name}</a></span>
							</volist>
						</div>
					</div>
				</div>
			</div>
			<div class="category cf" id="f1">
				<div class="zw-module-productlist-unit">
				<!-- 列表循环 -->
				<ul class="unit-list">
						<volist name="activity_list" id="vo" key="k">
						<li>
							<div class="unit-list-left">
								<div class="unit-list-title">
								  <a href="/activity/{pigcms{$vo.pigcms_id}.html">
									<h3>{pigcms{$vo.product_name}</h3>
									<p>{pigcms{$vo.title}</p>
								  </a>
								</div>
								<div class="unit-list-btm">
									<div class="unit-list-btm-logo">
										<img src="{pigcms{$vo.person_image}" />
									</div>
									<div class="unit-list-btm-center">
										<h3>有效期：至<php>echo getEndTime($vo['activity_term']);</php><span>{pigcms{$vo.part_count}人已报名</span></h3>
										<p>农场：<span>{pigcms{$vo.name}</span></p>
										<p>地址：<php>echo getRealAreaName($vo['area_id']);</php></p>
									</div>
									<div class="unit-list-btm-btn">
										<a href="/activity/{pigcms{$vo.pigcms_id}.html">立马参加</a>
									</div>
								</div>
							</div>
							<div class="unit-list-right">
								<a href="/activity/{pigcms{$vo.pigcms_id}.html"><img src="{pigcms{$vo.list_pic}" /></a>
							</div>
							<div style="clear: both;"></div>
						</li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
					<div class="zw-page-wrap clearfix zw-page-black">
				<div class="ui_page">
					{pigcms{$pagebar}
				</div>
			</div>
		</div>
			</div>
        </div>
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
	</body>
</html>
