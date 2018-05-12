<!DOCTYPE html >
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$article.title} - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />

		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Static/weizan/css/xnd_css/frame.css"/>
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="http://www.xiaonongding.com/tpl/Static/weizan/css/xnd_css/detail.css"/>
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
		<div class="content-box" style="margin-top: 20px;">
			<div class="content-main">
				<div class="content-box-left" style=" border: 0;">
					<style>
					.content-box-left{
						
					}
					.con-top-mains{
						position: relative;
						height: auto;
					}
					.content-fenxiang{
						width: 40px;
						height: auto;
						float: left;
						position: fixed;
						bottom: 0;
						margin-left: 25px;
					}
					.content-con{
						width: 700px;
						float: right;
					}
					.content-fenxiang label{
						font-size: 12px;
						color: #999;
					}
					.bdsharebuttonbox a{
						width: 40px;
						margin-top: 10px;
						margin-bottom: 10px;
					}
					</style>
					<div class="con-top-mains">
					<div class="content-fenxiang">
						<label>分享到</label>
						<div id="bdshare" class="bdsharebuttonbox" data="{'url':'http://www.baidu.com'}"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信" data="{'url':'http://www.baidu.com'}"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_h163" data-cmd="h163" title="分享到网易热"></a></div>
<script>
   /*
        * 动态设置百度分享URL的函数,具体参数
        * cmd为分享目标id,此id指的是插件中分析按钮的ID
        *，我们自己的文章ID要通过全局变量获取
        * config为当前设置，返回值为更新后的设置。
        */
        function SetShareUrl(cmd, config) {            
         
                config.bdUrl = "http://www.xiaonongding.com/wap.php?g=Wap&c=Article&a=index&imid={pigcms{$article.pigcms_id}";                
           
            return config;
        }

window._bd_share_config={"common":{onBeforeClick: SetShareUrl,"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
					</div>
					<div class="content-con">
					<h1 class="con-title">{pigcms{$article.title}</h1>
					<div class="content-tm">
						<!--来源：<b>原创</b>-->
						<h3>发布时间：<php>echo date("Y-m-d H:m:s",$article['dateline']);</php></h3>
						<i>阅读量：<?php echo $article["count"]*21;?>人阅读过</i>
					</div>
					<div class="page-contents">
						<p><iframe style="display: none;" frameborder="0" width="320" height="240" style="position: relative; left: 50%; margin-left: -160px; margin-top: 15px; margin-bottom: 10px;" src="http://v.qq.com/iframe/player.html?vid={pigcms{$nowImage['video_url']}&tiny=0&auto=0" allowfullscreen></iframe>
							{pigcms{$article.content}
						</p>
					</div>
					</div>
					<style>
						.page-contents {
							width: 100%;
						}
						
						.page-contents img {
							display: block;
							width: auto;
							max-width: 100%;
							text-align: center;
							margin: 10px auto 0px auto;
						}
						
						.detail-more {
							width: 100%;
							padding: 20px 0px;
							height: auto;
							border-bottom: 1px solid #E9E6E6;
						}
						
						.detail-more label {
							font-size: 16px;
							color: #B5B4B4;
							display: block;
							width: 100%;
						}
						
						.detail-more a {
							display: block;
							float: left;
							width: 50%;
							overflow: hidden;
							font-size: 16px;
							color: #444;
						}
						.con-title{
							height: auto;
							text-align: center;
						}
						.content-tm{
							text-align: center;
						}
						.content-tm b{
							font-weight: normal;
							padding: 1px 5px;
							border: 1px solid #00b081;
							border-radius: 5px;
							margin-right: 50px;
							font-size: 12px;
							color: #00b081;
						}
						.content-tm i{
							margin-left: 40px;
						}
						.content-tm{
							font-size: 12px;
							color: #999;
						}
					</style>
					
					<div style="clear: both;"></div>
					</div>
					<div style="clear: both;"></div>
					<script>
					
						$(window).bind("scroll",
							function() {
							var st = $(document).scrollTop();//往下滚的高度
							var ps = $('.content-con').height()-500;
							
							// document.title=st;
							var sel=$(".content-fenxiang");
							if (st > ps) {
							    $('.content-fenxiang').css("position","absolute")
							} else {
								$('.content-fenxiang').css("position","fixed")
							}
						});
					</script>
					<div class="detail-more">
						<label>继续阅读：</label>
						<if condition="$front">
							<a href="{pigcms{$config.site_url}/article/{pigcms{$front.pigcms_id}.html">上一篇：{pigcms{$front.title}</a>
							<else/>
							<a href="javascript:void(0);">上一篇：没有上一篇了</a>
						</if>
						<if condition="$next">
							<a href="{pigcms{$config.site_url}/article/{pigcms{$next.pigcms_id}.html">下一篇：{pigcms{$next.title}</a>
							<else/>
							<a href="javascript:void(0);">下一篇：没有下一篇了</a>
						</if>	
						<div style="clear: both;"></div>
					</div>
					<section class="appraise" id="anchor-reviews">
							<div class="mod_talk_edit mt30" style="width: 705px;">
									<p class="mod_talk_edit_face">
										<a href="">
											<img width="80" height="80" alt="" src="http://www.xiaonongding.com/tpl/Static/weizan/images/default.png">
											
										</a>
									</p>
									<div class="mod_talk_edit_cnt">

										<p class="arrow"></p>
										<p class="arrow2"></p>
										<div id="textarea" class="qui-textArea" data-width="536" data-height="80" style="">
											<textarea placeholder="说说您的购买体验" class="ui2_textarea" style="width: 673px; height: 100px;"></textarea>
											<div class="tips">
												<span class="current">0</span>/<span class="max">140</span>
											</div>
										</div>
										<div class="btm clearfix">
											<div style="display:none;" id="textarea-tip" class="ui2_error_layer">
												<p class="ui2_error_layer_arrow"></p>
												<p class="ui2_error_layer_arrow2"></p>
												<p class="ui2_error_layer_text">至少写够10个字，最多不超过140字</p>
											</div>
											<p class="fr">
												<input id="mod_talk_sub" type="button" onclick="window.location.href='/index.php?g=User&amp;c=Index&amp;a=index'" value="发表评论" class="ui_buttonB">
											</p>
										</div>

									</div>
								</div>
			        	</section>
				</div>
								<style>
					.caini{
						background: #fff;
						padding: 15px 0px;
						margin-top: 15px;
					}
					.caini ul{
						margin: 0px 10px;
					}
					.caini ul li{
						margin-bottom: 10px;
						height: auto;
					}
					.ta-more{
						width: 100%;
						background: #fff;
						padding: 15px 0px;
					}
					.wz-more{
	background: #fff;
	margin-top: 15px;
	padding-bottom: 15px;
}
.wz-more ul li{
	width: 90%;
	height: auto;
	font-size: 15px;
	margin-top: 15px;
	text-align: left;
}
.wz-more ul li a{
	display: block;
	height: 26px;
	font-size: 15px;
	font-weight: 900;
	line-height: 26px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #363636;
}
.wz-more ul li p{
	font-size: 12px;
	color: #999;
	line-height: 24px;
}
.shop-wz {
	width: 100%;
}
.nc-main ul li{
	float: left;
	width: 50%;
	text-align: center;
	position: relative;
	height: 40px;
}
.shop-wz li h3{
	font-size: 12px;
	color: #999;
}
.shop-wz li b{
	color: #666;
	font-size: 14px;
}
.shop-wz span{
	width: 1px;
	height: 100%;
	position: absolute;
	right: 0;
	top: 0;
	background: #eee;
}
.nc-main{
	width: 100%;
	padding: 15px 0px;
	background: #fff;
	text-align: center;
}
.nc-main h3.titles{
	font-size: 16px;
	font-weight: bold;
	line-height: 30px;
    padding-top: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.nc-main .nc-logo{
	width: 70px;
	margin: 0px auto;
	padding-top: 30px;
}
.nc-main .nc-logo img{
	height: 70px;
	width: 70px;
	border-radius: 70px;
}
</style>
				<div class="content-box-right" style="background: none; border: 0;">
					<!-- 农场主头像 -->
					<div class="nc-main">
						<div class="nc-logo"><img src="http://www.xiaonongding.com/upload/merchant/000/000/629/571ba0c25254f.jpg"></div>
					    <h3 class="titles">小丁丁</h3>
					    <ul class="shop-wz">
							<li>
								<h3>发布文章</h3>
								<b>30</b>
								<span></span>
							</li>
							<li>
								<h3>浏览量</h3>
								<b>45</b>
							</li>
						</ul>
						<div style="clear: both;"></div>
					</div>
					<!-- TA的其他文章 -->
					<div class="wz-more ta-more">
						<h4 class="side-title fontYaHei" style="font-size: 16px; margin-left: 10px; padding-bottom: 11px; margin-bottom: 10px; border-bottom: 1px solid #d7d7d7;">TA的其他文章</h4>
						<p style="display: block; width: 100%; text-align: center; padding: 10px 0px;">农场主很懒哦！还没有发布新闻</p>
						<ul style="display: none;">
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
								<li>
									<h3><a href="#">仓央嘉措诗社社长金罡应邀参加2016威海首届公益文化节</a></h3>
									<p>12342次阅读</p>
								</li>
							</ul>
					</div>
					<div class="caini">
					<h4 class="side-title fontYaHei" style="font-size: 16px; margin-left: 10px; padding-bottom: 11px; margin-bottom: 10px; border-bottom: 1px solid #d7d7d7;">72小时热文</h4>
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
							<div style="clear: both;"></div>
						</li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
					</div>
					<div class="lmSideCell bookzk" style="padding: 15px 0px; background: #fff; margin-top: 15px;">
							<h4 class="side-title fontYaHei" style="font-size: 16px; margin-left: 13px; padding-bottom: 11px; margin-bottom: 10px; border-bottom: 1px solid #d7d7d7;">关注小农丁</h4>
							<div class="cell-cont">
								<div class="gzzk clearfix" style="display: none;">
									<span class="ico"></span>
									<p class="at">关注@小农丁</p>
									<span class="guanzhu"></span>
								</div>
								<div class="sao">
									<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/app-qr-code.png">
								</div>
							</div>
						</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<!-- 2016.5.6  html 主体内容新增  end-->
		
		<include file="Public:footer"/>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
		<script language="javascript">
    function is_mobile() {
        var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
        var u = navigator.userAgent;
        if (null == u) {
            return true;
        }
        var result = regex_match.exec(u);

        if (null == result) {
            return false
        } else {
            return true
        }
    }
    if (is_mobile()) {
        document.location.href = 'http://www.xiaonongding.com/wap.php?g=Wap&c=Article&a=index&imid={pigcms{$article.pigcms_id}';
    }
</script>

	</body>
</html>
