<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$now_link.name} - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/intro.css"  rel="stylesheet"  type="text/css" />
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_path}js/intro.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<script type="text/javascript">
	      var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	    </script>
		<script src="{pigcms{$static_path}js/common.js"></script>
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
				body{behavior:url("{pigcms{$static_path}css/csshover.htc"); 
				}
				.category_list li:hover .bmbox {
		filter:alpha(opacity=50);
			 
					}
		  .gd_box{	display: none;}
		</style>
		<![endif]-->
		
		<style>
			
			
			
			
			
			 .accordion {
 	width: 100%;
 	max-width: 208px;

 	background: #FFF;

 }

.accordion .link {
	cursor: pointer;
	display: block;
	padding: 15px 15px 15px 42px;
	color: #666666;
	font-size: 16px;
	border-bottom: 1px solid #edecec;
	position: relative;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}

.accordion li:last-child .link {
	border-bottom: 0;
}

.accordion li i {
	position: absolute;
	top: 16px;
	left: 12px;
	font-size: 18px;
	color: #b7b5b5;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
	right: 12px;
	left: auto;
	font-size: 16px;
}

.accordion li.open .link {
	color: #3db180;
}

.accordion li.open i {
	color: #3db180;
}
.accordion li.open i.fa-chevron-down {
	-webkit-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/
 .submenu {
 	display: none;

 	font-size: 14px;
 }

 .submenu li {
 	border-bottom: 1px solid #edecec;
 }

 .submenu a {
 	display: block;
 	text-decoration: none;
 	color: #d9d9d9;
 	padding: 12px;
 	padding-left: 42px;
 	-webkit-transition: all 0.25s ease;
 	-o-transition: all 0.25s ease;
 	transition: all 0.25s ease;
 }

 .submenu a:hover {
 	background: #f5f5f5;
 	color: #3db180;
 }
			
			
		</style>
		
	</head>
	<body>
		<include file="Public:header_top"/>
		<div class="body-intro"> 
			<div class="w main">
				<div id="Position" class="margin_b6">
					<a href="{pigcms{$config.site_url}">首页</a><span>&gt;</span>&nbsp;关于我们<span>&gt;</span>&nbsp;{pigcms{$now_link.name}</div>
					<div class="left">
						<h2 style="padding-left: 42px">帮助中心</h2>
						
				<!-- Contenedor -->
	<ul id="accordion" class="accordion">
		<li>
			<div class="link">关于我们<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/1.html" >关于小农丁</a></li><li><a href="http://www.xiaonongding.com/intro/2.html" >公司资质</a></li><li><a href="http://www.xiaonongding.com/intro/5.html" >联系我们</a></li>
			</ul>
		</li>	
		
		<li>
			<div class="link">新手说明<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/30.html" >新手指南</a><li><a href="http://www.xiaonongding.com/intro/6.html" >常见问题</a></li><li><a href="http://www.xiaonongding.com/intro/8.html" >用户协议</a></li><li><a href="http://www.xiaonongding.com/intro/9.html" >积分规则</a></li><li><a href="http://www.xiaonongding.com/intro/10.html" >优惠卡券</a></li><li><a href="http://www.xiaonongding.com/intro/11.html" >邀约好友</a></li><li><a href="/topic/weixin.html" target="_blank">手机微信版</a></li>
			</ul>
		</li>
		<li>
			<div class="link">农场入驻<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/12.html" >入驻资质</a></li><li><a href="http://www.xiaonongding.com/intro/3.html" >入驻流程</a></li><li><a href="http://www.xiaonongding.com/intro/13.html" >身份保障</a></li><li><a href="http://www.xiaonongding.com/intro/14.html" >健康承诺</a></li><li><a href="http://www.xiaonongding.com/intro/15.html" >口碑监督</a></li>
			</ul>
		</li>
		<li>
			<div class="link">支付方式<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/16.html" >货到付款</a></li><li><a href="http://www.xiaonongding.com/intro/17.html" >在线支付</a></li><li><a href="http://www.xiaonongding.com/intro/18.html" >余额支付</a></li><li><a href="http://www.xiaonongding.com/intro/19.html" >微信支付</a></li>
			</ul>
		</li>
		<li><div class="link">派送说明<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/22.html" >运费说明</a></li><li><a href="http://www.xiaonongding.com/intro/24.html" >正品承诺</a></li><li><a href="http://www.xiaonongding.com/intro/25.html" >售后咨询</a></li><li><a href="http://www.xiaonongding.com/intro/26.html" >退货政策</a></li><li><a href="http://www.xiaonongding.com/intro/27.html" >退货办理</a></li>
			</ul>
		</li>
		
		<li><div class="link">服务保障<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li><a href="http://www.xiaonongding.com/intro/28.html" >保障协议</a></li><li><a href="http://www.xiaonongding.com/intro/29.html" >知识产权声明</a></li></li>
			</ul>
		</li>
	</ul>

<script src='js/jquery.js'></script>
<script src="js/index.js"></script>
			
						
						
						
						
						
						
						
						
						
						
						
						
						<ul class="conact_side" id="each" style=" display: none;">
							<pigcms:footer_link var_name="footer_link_list">
								<li><a href="{pigcms{$vo.url}" <if condition="$vo['out_link']">target="_blank"</if>>{pigcms{$vo.name}</a></li>
							</pigcms:footer_link>
						</ul>
						<div class="borderlr"></div>
						<div class="corner_b">
							<div class="corner_bl"></div>
							<div class="corner_br"></div>
						</div>
					</div>
					<div class="right">
						<div class="corner_t">
							<div class="corner_tl"></div>
							<div class="corner_tr"></div>
						</div>
						<div class="corner_c"></div>
						<div class="content">
							<h1 class="tit">{pigcms{$now_link.title}</h1>
							{pigcms{$now_link.content}
						</div>
						<!--[if !ie]>内容 结束<![endif]-->
						<div class="corner_b"><div class="corner_bl"></div><div class="corner_br"></div></div>
						<!--[if !ie]>help_tips 开始<![endif]-->
						<!--[if !ie]>help_tips 结束<![endif]-->
					</div>
					<!--[if !ie]>right 结束<![endif]-->
				</div>
        </div>
        <div style="width:100%; height: 10px; clear: both;"></div>
		<include file="Public:footer"/>
	</body>
</html>
