<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>小农丁生态游-活动列表 - {pigcms{$config.site_name}</title>
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

			<div class="category cf" id="f1">
				<div class="zw-module-productlist-unit">
				<!-- 列表循环 -->
				<ul class="unit-list">
					<volist name="toptui" id="vo1">
						<li>
							<div class="unit-list-left">
								<div class="unit-list-title">
									<a href="{pigcms{$vo1.url}">
										<h3>{pigcms{$vo1.merinfo.s_name}</h3>
										<p>{pigcms{$vo1.merinfo.name}</p>
									</a>
								</div>
								<div class="unit-list-btm">
									<div class="unit-list-btm-logo">
										<img src="{pigcms{$vo1.merinfo.merchantperson.person_image}" />
									</div>
									<div class="unit-list-btm-center">
										<h3>有效期：至<php>echo date("Y-m-d ", $vo1['merinfo']['end_time']);</php><span></span></h3>
										<p>农场：<span>{pigcms{$vo1.merinfo.merchantperson.name}</span></p>
										<p>电话：{pigcms{$vo1.merinfo.merchantperson.phone}</p>
									</div>
									<div class="unit-list-btm-btn">
										<a href="{pigcms{$vo1.url}">立马参加</a>
									</div>
								</div>
							</div>
							<div class="unit-list-right">
								<a href="{pigcms{$vo1.url}"><img src="{pigcms{$vo1.merinfo.pic.s_image}"  /></a>
								<span style="background: #f06d12;">HOT<br /></span>
							</div>
							<div style="clear: both;"></div>
						</li>
					</volist>
				<volist name="grouplist" id="vo" key="k">
						<li>
							<div class="unit-list-left">
								<div class="unit-list-title">
								  <a href="/group/{pigcms{$vo.group_id}.html">
									<h3>{pigcms{$vo.merchant_name}</h3>
									<p>{pigcms{$vo.product_name}</p>
								  </a>
								</div>
								<div class="unit-list-btm">
									<div class="unit-list-btm-logo">
										<img src="{pigcms{$vo.mer_person}" />
									</div>
									<div class="unit-list-btm-center">
										<h3>有效期：至<php>echo date("Y-m-d ", $vo['end_time']);</php><span></span></h3>
										<p>农场：<span>{pigcms{$vo.mer_name}</span></p>
										<p>电话：{pigcms{$vo.mer_phone}</p>
									</div>
									<div class="unit-list-btm-btn">
										<a href="/group/{pigcms{$vo.group_id}.html">立马参加</a>
									</div>
								</div>
							</div>
							<div class="unit-list-right">
								<a href="/group/{pigcms{$vo.group_id}.html"><img src="{pigcms{$vo.list_pic}"  alt="{pigcms{$vo.merchant_name}"/></a>
							    <span>活动<br />进行中</span>
							</div>
							<div style="clear: both;"></div>
						</li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
					<div class="zw-page-wrap clearfix zw-page-black">

			</div>
		</div>
			</div>
        </div>
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
	</body>
</html>
