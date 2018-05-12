<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<script>
			function format_time(time){
				if(time < 10){
					time = '0'+time;
				}
				return time;
			}
			$(function(){				
				var timeHDom = $('#time_h');
				var timeMDom = $('#time_m');
				var timeSDom = $('#time_s');
				var timeMMDom = $('#time_mm');
				var timer = setInterval(function(){
					var timeH = parseInt(timeHDom.html());
					var timeM = parseInt(timeMDom.html());
					var timeS = parseInt(timeSDom.html());
					var timeMM = parseInt(timeMMDom.html());					
					if(timeMM == 0){
						if(timeS == 0){
							if(timeM == 0){
								if(timeH == 0){
									clearInterval(timer);
									window.location.reload();
								}else{
									timeHDom.html(format_time(timeH-1));
								}
								timeMDom.html('59');
							}else{
								timeMDom.html(format_time(timeM-1));
							}
							timeSDom.html('59');
						}else{
							timeSDom.html(format_time(timeS-1));
						}
						timeMMDom.html('90');
					}else{
						timeMMDom.html(format_time(timeMM-1));
					}
				},10);
			});
		</script>
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
		
		<div class="banner activity_banner">
			<div class="banner_img">
				<img src="{pigcms{$now_activity.bg_pic}"/>
				<div class="banner_list">
					<div class="banner_list_txt">距<if condition="$time_array['type'] eq 1">开始<else/>结束</if></div>
					<div id="divdown1">
						<div class="banner_list_data" id="time_h">{pigcms{$time_array['h']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_m">{pigcms{$time_array['m']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_s">{pigcms{$time_array['s']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_mm" style="color:red">00</div>
					</div>
				</div>
			</div>
        </div>
        <div class="body2">
			<div class="menu_table">
				<div class="nearby cf">
					<div class="category cf">
						<div class="cate">区域：</div>
						<div class="cate_cate">
							<volist name="activity_area_list" id="vo">
								<span><a href="{pigcms{$vo.url}" <if condition="$activity_area eq $vo['area_url']">style="color:red;padding: 4px 10px;background: #12af7e;color: #fff;"</if>>{pigcms{$vo.area_name}</a></span>
							</volist>
						</div>
					</div>
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
	</body>
</html>
