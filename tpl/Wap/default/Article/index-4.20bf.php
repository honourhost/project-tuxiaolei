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
		img{
			-webkit-tap-highlight-color:transparent;
			}
			.header-top{
				width: 100%;
				background: url({pigcms{$static_path}/images/footer-bg.png);
				padding: 8px 0px 5px 0px;
				position: fixed;
				bottom: 0;
				left: 0;
				z-index: 1000000;
				color: #fff;
			}
			.header-logo{
				width: 38px;
				height: 38px;
				float: left;
				margin-left: 15px;
				margin-right: 5px;
				position: relative;
				top: 2px;
			}
			.header-logo img{
				width: 38px;
				height: 38px;
				border-radius: 5px;
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
				margin-right: 15px;
				width: 70px;
				height: 30px;
				line-height: 30px;
				margin-top: 5px;
				font-size: 14px;
				text-align: center;
				border-radius: 15px;
				color: #fff;
				background: #12af7e;
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
				width: 100%;
				height: auto;
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
				width: 100%;
				padding: 10px 0px;
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
			.rich_media_xnd{
				color: #fff;
				padding: 2px 5px;
				background: #12af7e;
				border-radius: 10px;
				margin-right: 5px;
				font-size: 12px;
			}
			.public-footer-img{
			width: 100%;
			border-top: 1px solid #ccc;
			padding-top: 10px;
			}
			.public-footer-img span{
			 font-size: 14px;
			 color: #888;
			 line-height: 0px;
			}
		</style>
	</head>
		<body id="activity-detail" class=" ">
		<div class="rich_media container">
			<div class="header" style="display: none;"></div>
			
			
			<div class="rich_media_inner content" style="min-height: 431px;">
				<div class="rich_media_title_main">
					<h2 class="rich_media_title" id="activity-name" style="font-size: 22px; font-weight: normal;">{pigcms{$nowImage['title']}</h2>
					<div style="clear: both;"></div>
				</div>
				
				<div class="rich_media_meta_list">
					<em id="post-date" class="rich_media_meta text" style="font-size: 16px;"><a href="{pigcms{$config.site_url}/wap.php" class="rich_media_xnd">小农丁</a>{pigcms{$nowImage['now']}</em> 
					<em class="rich_media_meta text" style="font-size: 16px;"></em> 
					<a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Index&a=index&token={pigcms{$nowImage['mer_id']}" class="rich_media_meta link nickname js-no-follow js-open-follow" style="font-size: 16px;" href="javascript:;" id="post-user">{pigcms{$nowImage['author']}</a>
				</div>
				<div id="page-content" class="content">
					<div id="img-content">
						<!-- 视频部分 -->
						<if condition="$nowImage['video_url']">
						<iframe frameborder="0" width="320" height="240" style="position: relative; left: 50%; margin-left: -160px; margin-top: 15px; margin-bottom: 10px;" src="http://v.qq.com/iframe/player.html?vid={pigcms{$nowImage['video_url']}&tiny=0&auto=0" allowfullscreen></iframe>
						</if>
						<if condition="$nowImage['cover_pic'] && $nowImage['is_show']">
						<div class="rich_media_thumb" id="media">
							<img onerror="this.parentNode.removeChild(this)" src="{pigcms{$nowImage['cover_pic']}">
						</div>
						</if>
						<div class="rich_media_content" id="js_content">
							{pigcms{$nowImage['content']|htmlspecialchars_decode=ENT_QUOTES}
							<div class="public-footer-img">
								<span>您想更多了解小农丁，长按下放二维码关注小农丁官方微信！</span>
								<img src="{pigcms{$static_path}images/public-footer-img.png">
									
								</div>
						</div>
						
						<div class="rich_media_tool" id="js_toobar" style="color: #888;">
							<a class="media_tool_meta meta_primary" href="{pigcms{$nowImage['url']}">阅读原文</a>阅读量：{pigcms{$nowImage['count']}
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
		<div class="rich_footer" style="display: none;">
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
		<div style="width: 100%; height: 50px;"></div>
			<div class="header-top">
				<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=799">
				<span class="header-gz">购买</span>
				<div class="header-logo">
					<img src="{pigcms{$static_path}images/logo.png" />
				</div>
				<h3 style="font-size: 14px; color: #fff;">静宁苹果特价义卖活动<br />10斤包邮</h3>
				</a>
				<div style="clear: both;"></div>
			</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$config.site_url}{pigcms{$nowImage['cover_pic']}", 
						link: "{pigcms{$config.site_url}/wap.php?c=Article&a=index&imid={pigcms{$nowImage['pigcms_id']}",
						title: "{pigcms{$nowImage['title']}",
						desc: "{pigcms{$nowImage['digest']}"
			};
		</script>
		 <include file="Share:share"/>
		
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
	</body>
</html>