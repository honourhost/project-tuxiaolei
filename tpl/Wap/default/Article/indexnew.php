<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>{pigcms{$config.site_name}</title>
		<meta name="description" content="{pigcms{$config.seo_description}">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="{pigcms{$static_path}css/mp_news.css" rel="stylesheet"/>
		<style>
			.header-top{
				width: 100%;
				background: #fff;
				padding: 10px 0px;
				border-bottom: 1px solid #ececec;
				position: fixed;
				top: 0;
				left: 0;
				z-index: 1000000;
			}
			.header-logo{
				width: 40px;
				height: 40px;
				float: left;
				margin-left: 20px;
				margin-right: 5px;
			}
			.header-logo img{
				width: 40px;
				height: 40px;
			}
			.header-gz h3{
				float: left;
				font-size: 14px;
				display: inline-block;
				max-width: 50%;
				overflow: hidden;
				margin-left: 5px;
			}
			.header-gz{
				float: right;
				display: block;
				margin-right: 20px;
				width: 70px;
				height: 30px;
				line-height: 30px;
				margin-top: 5px;
				font-size: 14px;
				text-align: center;
				border: 1px solid #ffa169;
				border-radius: 5px;
				color: #ffa169;
			}
			@font-face {font-family: "iconfont";
			  src: url('{pigcms{$static_path}css/iconfont.eot'); /* IE9*/
			  src: url('{pigcms{$static_path}css/iconfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			  url('{pigcms{$static_path}css/iconfont.woff') format('woff'), /* chrome, firefox */
			  url('{pigcms{$static_path}css/iconfont.ttf') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
			  url('{pigcms{$static_path}css/iconfont.svg#iconfont') format('svg'); /* iOS 4.1- */
			}
			
			.iconfont {
			  font-family:"iconfont" !important;
			  font-size:16px;
			  font-style:normal;
			  -webkit-font-smoothing: antialiased;
			  -webkit-text-stroke-width: 0.2px;
			  -moz-osx-font-smoothing: grayscale;
			}
			.icon-shoucang:before { content: "\e61f"; }
			.icon-shoucang1:before { content: "\e66e"; }
			.icon-dianzan:before { content: "\e680"; }
			.icon-dianzan1:before { content: "\e699"; }
			.icon-liuyan:before { content: "\e744"; }
			.icon-fenxiang:before { content: "\e689"; }
			.rich_media_meta_list{
				margin-top: 10px;
			}
			.rich_media_title_main{
				width: 100%;
				position: relative;
			}
			.rich_media_title {
				width: 78%;
				height: 45px;
				overflow: hidden;
				float: left;
				line-height: 24px;
				font-weight: 700;
				font-size: 20px;
				word-wrap: break-word;
				-webkit-hyphens: auto;
				-ms-hyphens: auto;
				-moz-hyphens: auto;
				hyphens: auto;
			}
			.rich_media_sc{
				float: right;
				width: 20%;
				display: inline-block;
				text-align: center;
				color: #aeaeae;
				height: 45px;
				border-left: 1px solid #cdcdcd;
				position: absolute;
				right: -15px;
				font-size: 14px;
			}
			.dq i{
				display: block;
				width: 100%;
				text-align: center;
				font-size: 26px;
				position: relative;
				line-height: 24px;
				color: #858585;
			}
			.on{
				display: none;
				color: #ce5c26;
			}
			.on i{
				display: block;
				width: 100%;
				text-align: center;
				font-size: 26px;
				position: relative;
				line-height: 24px;
				color: #ce5c26;
			}
			.rich_media_title .rich_media_meta {
				vertical-align: middle;
				position: relative;
			}
			.rich_footer{
				position: fixed;
				bottom: 0;
				left: 0;
				width: 100%;
				padding: 10px 0px;
				background: #fff;
			}
			.rich_footer a{
				display: inline-block;
				width: 33.333%;
				float: left;
				text-align: center;
				height: auto;
			}
			.rich_footer a i{
				font-size: 22px;
			}
			.rich_footer a span{
				position: relative;
				top: -2px;
				font-size: 16px;
				color: #d27377;
			}
			
		</style>
	</head>
		<body id="activity-detail" class=" ">
		<div class="rich_media container">
			<div class="header" style="display: none;"></div>
			<div class="header-top">
				<a class="header-gz">下载</a>
				<div class="header-logo">
					<img src="img/banner01.png" />
				</div>
				<h3 style="font-size: 14px;">小农丁手机版</h3>
				
				<div style="clear: both;"></div>
			</div>
			<div style="width: 100%; height: 60px;"></div>
			<div class="rich_media_inner content" style="min-height: 831px;">
				<div class="rich_media_title_main">
					<a class="rich_media_sc dq">
						<i class="icon iconfont">&#xe61f;</i>收藏
					</a>
					<a class="rich_media_sc on">
						<i class="icon iconfont">&#xe66e;</i>已收藏
					</a>
					<h2 class="rich_media_title" id="activity-name">{pigcms{$nowImage['title']}</h2>
					<div style="clear: both;"></div>
				</div>
				
				<div class="rich_media_meta_list">
					<em id="post-date" class="rich_media_meta text">{pigcms{$nowImage['now']}</em> 
					<em class="rich_media_meta text"></em> 
					<a class="rich_media_meta link nickname js-no-follow js-open-follow" href="javascript:;" id="post-user">{pigcms{$nowImage['author']}</a>
				</div>
				<div id="page-content" class="content">
					<div id="img-content">
						<if condition="$nowImage['cover_pic'] && $nowImage['is_show']">
						<div class="rich_media_thumb" id="media">
							<img onerror="this.parentNode.removeChild(this)" src="{pigcms{$nowImage['cover_pic']}">
						</div>
						</if>
						<div class="rich_media_content" id="js_content">{pigcms{$nowImage['content']|htmlspecialchars_decode=ENT_QUOTES}</div>
						<if condition="$nowImage['url']">
						<div class="rich_media_tool" id="js_toobar">
							<a class="media_tool_meta meta_primary" href="{pigcms{$nowImage['url']}">阅读原文</a>
						</div>
						</if>
					</div>
				</div>
			</div>
			<div class="rich_footer">
				<a>
				  <i class="icon iconfont">&#xe680;</i>
				  <span>310</span>
				</a>
				<a>
				  <i class="icon iconfont">&#xe744;</i>
				  <span>48</span>
				</a>
				<a>
				  <i class="icon iconfont">&#xe689;</i>
				  <span></span>
				</a>
			</div>
		</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Article",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$nowImage['cover_pic']}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Article/index', array('imid' => $nowImage['pigcms_id']))}",
		            "tTitle": "{pigcms{$nowImage['title']}",
		            "tContent": "{pigcms{$nowImage['digest']}"
		};
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
			  $(".dq").click(function(){
			  $(".dq").hide();
			  $(".on").show();
			  });
			  $(".on").click(function(){
			  $(".on").hide();
			  $(".dq").show();
			  });
			});
		</script>
		{pigcms{$shareScript}
	</body>
</html>