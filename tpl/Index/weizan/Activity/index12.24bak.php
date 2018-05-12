<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>活动列表 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
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
			<ul class="zw-module-banner-imglist clearfix">
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/banner1.jpg);"></a>
				</li>
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/banner1.jpg);"></a>
				</li>
				<li class="banner-img-cell">
					<a class="banner-img-cell-link" href="" target="_blank" style="background-image:url({pigcms{$static_path}images/xnd_img/banner1.jpg);"></a>
				</li>
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
				<volist name="activity_list" id="vo" key="k">
						<div class="zw-module-bigcard-wrap clearfix">
							<div class="zw-module-bigcard-item bigcard-black" style="border: 1px solid #d9d9d9;">
								<a href="/activity/{pigcms{$vo.pigcms_id}.html" target="_blank">
									<img class="zw-module-bigcard-itemimg" src="{pigcms{$vo.list_pic}" data-original="{pigcms{$vo.list_pic}" width="360" height="270" title="" alt="{pigcms{$vo.name}">
								</a>
								<div class="zw-module-bigcard-iteminfo bigcard-iteminfo-noinfotype">
									<span class="zw-module-bigcard-infoplace"><php>echo $_SESSION["cityarr"]['0']['area_name'];</php></span>
									<div class="zw-module-bigcard-infonum">
										
										已有<span>{pigcms{$vo.part_count}</span>人报名
									</div>
									<h2>
								     <a href="" target="_blank">
								      	{pigcms{$vo.name}					      
								     </a>
							        </h2>
									<ul class="zw-module-bigcard-infolist">
										<li>
											<i class="zwui-iconfont icon-star-line"></i> 
											{pigcms{$vo.title}
											<br>
										</li>
									</ul>
									<div class="zw-module-bigcard-price">
										
										<em>{pigcms{$vo.price}</em>元/人
									</div>
									<div class="zw-module-bigcard-bottombar">
										<div class="zw-module-bigcard-datebar">
											<a href="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html" target="_blank">农场主页</a> &nbsp;&nbsp;
											<a href="{pigcms{$config.site_url}/meal/<php>echo getStoreId($vo['mer_id']);</php>.html" target="_blank">农小店</a>
			                            </div>
										<a class="zw-module-bigcard-btn" href="/activity/{pigcms{$vo.pigcms_id}.html" target="_blank">
											立即报名
										</a>
									</div>
								</div>
							</div>
						</div>
					</volist>
				<!-- 列表循环end -->
		</div>
			</div>
        </div>
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
	</body>
</html>
