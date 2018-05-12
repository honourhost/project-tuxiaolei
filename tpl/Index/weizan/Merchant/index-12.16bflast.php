<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$merchantarr['name']} - {pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/detail.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
	<style>
		    
			.wrapper {
				overflow: hidden;
				color: #646464;
				font-size: 14px;
				background: #fff;
				font-family: "Hiragino Sans GB", "\5FAE\8F6F\96C5\9ED1", "Microsoft Yahei", tahoma, arial, "\5B8B\4F53";
			}
			
			.bannerBox {
				height: 1190px;
				position: relative;
				padding: 0 0 24px;
			}
			
			.fixedImage {
				position: absolute;
				left: 50%;
				top: 0;
				margin-left: -960px;
			}
			
			.fixedImage2 {
				position: absolute;
				left: 50%;
				top: 500px;
				margin-left: -960px;
			}
			
			.videoBox {
				background: rgba(255, 255, 255, .4);
				filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#99ffffff', endColorstr='#99ffffff', gradientType=0);
				width: 616px;
				height: 443px;
				padding: 5px;
				position: relative;
				left: 50%;
				top: 92px;
				margin-left: -116px;
			}
			
			.videoContent {
				width: 616px;
				height: 379px;
				background: #000;
			}
			
			.videoList {
				width: 548px;
				height: 64px;
				background: rgba(0, 0, 0, .8);
				filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#c8000000', endColorstr='#c8000000', gradientType=0);
				padding: 0 34px;
				position: relative;
			}
			
			.videoList span {
				width: 20px;
				height: 54px;
				background: #373737;
				position: absolute;
				top: 5px;
				border-radius: 3px;
				cursor: pointer;
				background-image: url({pigcms{$static_path}images/xnd_img/video_icon.png);
				background-repeat: no-repeat;
			}
			
			.videoList span:hover {
				background-color: #222;
			}
			
			.videoList .videoLeft {
				left: 4px;
				background-position: 5px 20px;
			}
			
			.videoList .videoRight {
				right: 4px;
				background-position: -49px 20px;
			}
			
			.videoNav {
				width: 548px;
				height: 54px;
				overflow: hidden;
				position: relative;
				top: 5px;
			}
			
			.videoNav .active,
			.videoNav li:hover {
				width: 86px;
				height: 50px;
				padding: 0;
				border: 2px solid #ff6c00;
				color: #ff6c00;
			}
			
			.videoNav li {
				float: left;
				width: 86px;
				background: #434343;
				height: 50px;
				padding: 1px;
				text-align: center;
				border: 1px solid #505050;
				margin: 0 4px 0 0;
				cursor: pointer;
				color: #fff;
				position: relative;
			}
			
			.videoNav li h3 {
				font-size: 16px;
				padding: 6px 0 0;
				line-height: 22px;
			}
			
			.videoNav li p {
				font-size: 12px;
			}
			
			.videoNav .disable {
				cursor: not-allowed;
				color: #777
			}
			
			.videoNav .disable:hover {
				width: 86px;
				background: #434343;
				height: 50px;
				padding: 1px;
				border: 1px solid #505050;
				color: #777;
			}
			
			.videoNav .new {
				background: url({pigcms{$static_path}images/xnd_img/video_icon.png) no-repeat 0px -100px;
				position: absolute;
				top: -1px;
				left: -1px;
				width: 24px;
				height: 24px;
			}
			
			.container {
				width: 1000px;
				margin: 0 auto;
			}
			
			.recommendPRD {
				height: 534px;
				background: #fff;
				box-shadow: 0 0 3px 0 #e4e4e4;
				position: relative;
				top: 157px;
				padding: 10px;
			}
			
			.recommendTitle {
				height: 58px;
				background: #04976b;
				position: relative;
				padding-left: 73px;
				border-right: 4px solid #f9594f;
			}
			
			.recommendTitle ul {
				position: absolute;
				right: 0;
				top: 9px;
				overflow: hidden;
				font-size: 16px;
			}
			/*
.recommendTitle li {float: left; width: 66px; height: 42px; line-height: 42px; color: #fff; text-align: center; margin: 0 -1px 0 0; padding: 0 14px;}
.recommendTitle .cur {background-position: 14px -62px; line-height: 32px;}
*/
			
			.recommendTitle li {
				float: left;
				height: 42px;
				line-height: 42px;
				color: #fff;
				text-align: center;
				margin-right: 0px;
				border-right: 1px solid #198d43;
			}
			
			.recommendTitle .tab {
				width: 76px;
				height: 42px;
			}
			
			.recommendTitle .tab div {
				height: 42px;
				margin: 0px 5px;
			}
			
			.recommendTitle .tab.cur div {
				background-image: url({pigcms{$static_path}images/xnd_img/sprites.png);
				background-repeat: no-repeat;
				background-position: -460px 30px;
				line-height: 32px;
				background-color: #f9594f;
				border-radius: 4px;
			}
			
			.RCprdList {
				padding: 9px 0 0;
				position: relative;
				height: 441px;
				display: none;
			}
			
			.RCprdList h3 {
				height: 55px;
				font-size: 26px;
				color: #fff;
				line-height: 58px;
				position: absolute;
				top: -58px;
				left: 73px;
				z-index: 999;
				width: 540px;
				overflow: hidden;
			}
			
			.RCprdList .image {
				width: 577px;
				height: 441px;
				font-size: 0;
				float: left;
				position: relative;
			}
			
			.RCprdList .image .lijian {
				width: 130px;
				height: 40px;
				background: url({pigcms{$static_path}images/xnd_img/sprites.png) no-repeat 0 0;
				text-align: center;
				line-height: 34px;
				color: #fff;
				font-size: 16px;
				position: absolute;
				top: 10px;
				left: -6px;
				padding-right: 8px;
			}
			
			.RCprdList .content {
				width: 363px;
				height: 406px;
				border: 1px solid #ededed;
				position: absolute;
				z-index: 2;
				right: 0;
				top: 9px;
				background: #fff;
				padding: 18px 20px 0;
			}
			
			.RCprdList ins {
				width: 403px;
				height: 431px;
				background: #f4f5f6;
				position: absolute;
				left: 584px;
				bottom: 0;
			}
			
			.prdFlash {
				height: 75px;
				font-size: 16px;
				line-height: 20px;
				color: #767676;
			}
			
			.prdFlash .title {
				float: left;
				height: 75px;
				padding: 0 10px 0 0;
				font-size: 14px;
				background: url({pigcms{$static_path}images/xnd_img/sprites.png) no-repeat -482px -95px;
				padding-left: 20px;
			}
			
			.prdFlash.cur {
				border-bottom: 1px dashed #d1d1d1;
			}
			
			.RCprdList .price {
				padding: 22px 0 0;
				line-height: 40px;
				border-top: 1px solid #eee;
				display: block;
				width: 100%;
				
				clear: both;
			}
			
			.RCprdList .price .old {
				height: 20px;
				line-height: 20px;
				font-size: 18px;
				color: #929292;
			}
			
			.RCprdList .price .old span {
				text-decoration: line-through;
			}
			
			.RCprdList .salePrice {
				font-size: 40px;
			}
			
			.RCprdList .price em {
				font-size: 16px;
			}
			
			.RCprdList .salePrice {
				color: #f8372a;
				font-family: Arial;
			}
			
			.RCprdList .goDetail {
				background: #f8594e;
				color: #fff;
				position: absolute;
				right: 0;
				width: 190px;
				height: 62px;
				line-height: 62px;
				text-align: center;
				font-size: 18px;
				bottom: 22px;
				text-shadow: 0 0 1px #fff;
			}
			
			.section2 {
				background: #f4f5f6;
			}
			
			.productList {
				background: #f4f5f6;
				padding: 0 0 74px;
			}
			
			.productList .block,
			.grayBackground .block,
			.whiteBackground .block,
			.section1 .block,
			.section2 .block {
				width: 1000px;
				margin: 0 auto;
			}
			
			.productTitle {
				text-align: center;
				padding: 45px 0 30px;
			}
			
			.productTitle h2 {
				font-size: 24px;
				color: #000;
				line-height: 24px;
			}
			
			.productTitle p {
				font-size: 16px;
				color: #828282;
				line-height: 16px;
				padding: 8px 0 0;
			}
			
			.productList .prdNav {
				overflow: hidden;
				width: 750px;
				margin: 0 auto 15px;
			}
			
			.productList .prdNav a {
				float: left;
				font-size: 16px;
				color: #333;
				width: 128px;
				line-height: 30px;
				text-align: center;
				border-radius: 8px;
				margin-right: 20px;
				border: 1px solid #959595;
			}
			
			.productList .prdNav .cur {
				background: #f8594e;
				color: #fff;
				border-color: #f8594e;
			}
			#tags .cur{
				background: #f8594e;
				color: #fff;
				border-color: #f8594e;
			}
			#tags LI.cur a{
				display: block;
				
				background: #f8594e;
				color: #fff;
				border-color: #f8594e;
			}
			.prodcutionItem {
				width: 320px;
				float: left;
				margin-right: 20px;
				padding: 0 0 10px;
			}
			
			.prodcutionItem.last {
				margin: -390px 0 0 0;
				float: right;
				position: relative;
			}
			
			.prodcutionItem a {
				float: left;
				border: 1px solid #e5e3e3;
				background: #fff;
				width: 318px;
				padding: 0 0 20px;
				-webkit-transition: all .5s ease;
				-o-transition: all .5s ease;
				transition: all .5s ease;
				height: 360px;
			}
			
			.prodcutionItem a:hover {
				border-color: #fd7f7b;
			}
			
			.prodcutionItem h3 {
				font-size: 16px;
				padding: 12px 10px 15px;
				color: #333;
			}
			
			.prodcutionItem h3 span {
				display: block;
				height: 40px;
				line-height: 20px;
				overflow: hidden;
			}
			
			.prodcutionItem .price {
				font-size: 30px;
				color: #333;
				margin: 0 10px;
				border-top: 1px dashed #e3e1e1;
				text-align: center;
				height: 58px;
				line-height: 58px;
				overflow: hidden;
			}
			
			.productList .price span {
				font-size: 18px;
			}
			
			.productList .button {
				font-size: 20px;
				color: #fff;
				background: #f64038;
				border-radius: 3px;
				border: 1px solid #f14945;
				width: 112px;
				line-height: 32px;
				text-align: center;
				margin: 0 auto;
			}
			
			.imageView {
				font-size: 0;
			}
			
			.imageView img {
				position: relative;
				left: 50%;
				top: 0;
				margin-left: -960px;
			}
			
			.grayBackground {
				background: #f4f5f6;
				padding: 0 0 50px;
			}
			
			.whiteBackground {
				background: #fff;
				padding: 0 0 50px;
			}
			
			.modeTitle .block {
				padding: 36px 0 20px 240px;
				width: 760px;
				margin: 0 auto;
				border-bottom: 1px solid #d0d4db;
				position: relative;
			}
			
			.weileiTitle .block {
				padding: 36px 0 20px 320px;
				width: 680px;
			}
			
			.huanleTitle .block {
				padding: 36px 0 20px 280px;
				width: 720px;
			}
			
			.modeTitle p,
			.youwan p {
				font-size: 14px;
				text-indent: 2em;
				line-height: 26px;
			}
			
			.modeTitle .titImg {
				position: absolute;
				left: 0;
				top: 26px;
			}
			
			.itemTitle {
				padding: 50px 0 15px 57px;
				position: relative;
			}
			
			.itemTitle .numberGroup {
				position: absolute;
				left: 0;
				top: 50px;
			}
			
			.itemTitle p {
				font-size: 18px;
				color: #75ba8e;
				line-height: 18px;
				margin-bottom: 5px;
				text-indent: 0;
			}
			
			.itemTitle h3 {
				font-size: 26px;
				line-height: 26px;
				color: #6d6d6d;
				font-weight: 700;
			}
			
			.imageBox {
				font-size: 0;
			}
			
			.youwan p {
				margin-bottom: 5px;
			}
			
			.travelTip {
				background: #fff;
				padding: 0 0 40px;
			}
			
			.travelTip .block {
				width: 1000px;
				margin: auto;
			}
			
			.travelTip h3 {
				width: 80px;
				text-align: center;
				color: #333;
				font-size: 20px;
				margin: 0 auto;
			}
			
			.travelTip i {
				display: block;
				width: 80px;
				height: 80px;
				background: url({pigcms{$static_path}images/xnd_img/sprites.png);
				margin: 0 auto 10px;
			}
			
			.travelTip .row1 {
				border-bottom: 1px solid #ddd;
				padding-bottom: 20px;
				margin-bottom: 10px;
			}
			
			.travelTip .view {
				display: block;
				background: url({pigcms{$static_path}images/xnd_img/sprites.png) 52px -897px #8acda2;
				height: 20px;
				width: 60px;
				margin: 10px auto 0;
				border-radius: 4px;
				text-align: center;
				padding-right: 10px;
				line-height: 20px;
				color: #fff;
			}
			
			.travelTip .item {
				float: left;
				padding: 20px;
			}
			
			.travelTip .item1,
			.travelTip .item3,
			.travelTip .item4,
			.travelTip .item5 {
				width: 459px;
				border-right: 1px solid #ddd;
			}
			
			.travelTip .item2 {
				width: 460px;
			}
			
			.travelTip .item3,
			.travelTip .item4,
			.travelTip .item5,
			.travelTip .item6 {
				width: 209px;
				height: 360px;
			}
			
			.travelTip .item1 i {
				background-position: 0 -300px;
			}
			
			.travelTip .item2 i {
				background-position: 0 -400px;
			}
			
			.travelTip .item3 i {
				background-position: 0 -500px;
			}
			
			.travelTip .item4 i {
				background-position: 0 -600px;
			}
			
			.travelTip .item5 i {
				background-position: 0 -700px;
			}
			
			.travelTip .item6 i {
				background-position: 0 -800px;
			}
			
			.prodcutionItem .image {
				width: 318px;
				height: 198px;
				position: relative;
			}
			
			.prodcutionItem .image .lijian {
				width: 100px;
				height: 32px;
				background: url({pigcms{$static_path}images/xnd_img/sprites.png) no-repeat 0px -200px;
				color: #fff;
				font-size: 14px;
				line-height: 26px;
				top: 10px;
				left: -4px;
				position: absolute;
				padding-right: 8px;
				text-align: center;
			}
			
			.prodcutionItem .image img {
				width: 318px;
				height: 198px;
			}
			
			.moreTravel {
				background: #f4f5f6;
			}
			
			.moreTopic {
				font-size: 0;
			}
			
			.moreTopic li {
				width: 248px;
				float: left;
				margin-right: 2px;
			}
			
			.aboutLaoYu {
				background: #f4f5f6;
				font-size: 0;
			}
			
			.copyright {
				background: #1c9d4b;
				font-size: 12px;
				text-align: center;
				height: 38px;
				line-height: 38px;
				color: #fff;
			}
			
			.copyright a {
				color: #fff;
			}
			
			.modeTitle {
				padding: 0;
			}
			
			.bigImage {
				font-size: 0;
				padding-bottom: 20px;
			}
			/*icon style*/
			
			.icon-default {
				background: url({pigcms{$static_path}images/xnd_img/sprites.png) no-repeat;
			}
			
			.number {
				background-image: url({pigcms{$static_path}images/xnd_img/sprite.png);
				background-repeat: no-repeat;
			}
			
			.icon-rm {
				width: 58px;
				height: 58px;
				background-position: 0 -100px;
				position: absolute;
				left: 0;
				top: 0;
			}
			
			.number {
				width: 22px;
				height: 50px;
				display: inline-block;
				*display: inline;
				zoom: 1;
			}
			
			.num0 {
				background-position: -22px -579px;
			}
			
			.num1 {
				background-position: -22px -647px;
			}
			
			.num2 {
				background-position: -22px -714px;
			}
			
			.num3 {
				background-position: -22px -781px;
			}
			
			.num4 {
				background-position: -22px -849px;
			}
			
			.num5 {
				background-position: -22px -915px;
			}
			
			.num6 {
				background-position: -22px -983px;
			}
			
			.num7 {
				background-position: -22px -1050px;
			}
			
			.num8 {
				background-position: -22px -1117px;
			}
			
			.num9 {
				background-position: -22px -1185px;
			}
			
			.menpiao {
				background-position: -6px -513px;
				width: 53px;
				height: 53px;
				position: absolute;
				left: 10px;
				top: 10px;
			}
			/*右侧导航滚动css*/
			
			.fixedPosition {
				position: fixed;
				top: 50%;
				left: 50%;
				margin: -250px 0 0 524px;
				width: 150px;
				z-index: 9999;
			}
			
			.fixedPosition li {
				height: 40px;
				line-height: 40px;
				vertical-align: top;
				margin-bottom: 1px;
			}
			
			.fixedPosition li a {
				color: #04976b;
				position: relative;
				padding: 0 0 0 48px;
				float: left;
				font-weight: 600;
			}
			
			.fixedPosition li span {
				position: absolute;
				background: url({pigcms{$static_path}images/xnd_img/rightNav.png) no-repeat #04976b;
				left: 0;
				top: 0;
				width: 40px;
				height: 40px;
				transition: all .5s ease;
			}
			
			.fixedPosition li.li_07 a {
				color: #f4b350;
			}
			
			.fixedPosition li.li_07 span {
				background-color: #f4b350;
			}
			
			.fixedPosition img {
				position: absolute;
				left: -136px;
				top: -68px;
				display: none;
				opacity: 0;
				transition: opacity .5s ease;
			}
			
			.fixedPosition li a:hover,
			.fixedPosition .cur a {
				color: #00365c;
			}
			
			.fixedPosition li a:hover span,
			.fixedPosition .cur span {
				background-color: #00365c;
			}
			
			.fixedPosition li a:hover img {
				display: block;
				opacity: 1;
			}
			
			.fixedPosition li span.star {
				background-position: -1px -3px;
			}
			
			.fixedPosition li span.cont1 {
				background-position: -1px -52px;
			}
			
			.fixedPosition li span.cont2 {
				background-position: -1px -112px;
			}
			
			.fixedPosition li span.cont3 {
				background-position: -2px -169px;
			}
			
			.fixedPosition li span.nav-tiyanshi {
				background-position: -2px -288px;
			}
			
			.fixedPosition li span.nav-tips {
				background-position: -3px -345px;
			}
			
			.fixedPosition li span.laoyutuijian {
				background-position: -2px -397px;
			}
			
			.fixedPosition li span.code {
				background-position: -3px -452px;
			}
			
			.fixedPosition li span.returntop {
				background-position: -1px -498px;
			}
			
			.movie {
				background: url({pigcms{$static_path}images/xnd_img/moviebg.jpg) no-repeat center;
			}
			
			.movie .block {
				width: 1000px;
				margin: 0 auto;
			}
			
			.movie_icon {
				background: url({pigcms{$static_path}images/xnd_img/movie_icon.png) no-repeat center;
			}
			/* 新增 */
			.content-unit-ms{
				font-size: 18px;
			}
			.confession{
		    	width: 1000px;
		    	margin: 0px auto;
		    	height: 200px;
		    	clear: both;
		    	padding: 30px 0px;
		    }
		    .confession_portrait{
		    	width: 200px;
		    	height: 200px;
		    	float: left;
		    }
		    .confession_portrait img{
		    	width: 200px;
		    	height: 200px;
		    	border-radius: 200px;
		    }
		    .portrait_title{
		    	width: 770px;
		    	height: 200px;
		    	float: left;
		    	margin-left: 30px;
		    	overflow: hidden;
		    	font-size: 16px;
		    }
		    .portrait_title h3,
		    .portrait_title h4,
		    .portrait_title span,
		    .portrait_title p{
		    	display: block;
		    	width: 100%;
		    	margin-bottom: 10px;
		    }
		    .portrait_title h3{
		    	font-size: 24px;
		    }
		</style>
	
	
</head>
<body>
<include file="Public:shop_header"/>

<div class="wrapper" id="fortop">
			
			
			<a name="zhanshi"></a>
			<div class='bannerBox an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<img src="{pigcms{$static_path}images/xnd_img/white.gif" width="1920" height="500" data-src="{pigcms{$static_path}images/xnd_img/banner1.jpg" class="fixedImage" alt="">
					<img src="{pigcms{$static_path}images/xnd_img/white.gif" width="1920" height="500" data-src="{pigcms{$static_path}images/xnd_img/banner1.jpg/banner2.jpg" class="fixedImage2" alt="">
					<div class="videoBox">
						<div class="videoContent">
							<iframe frameborder="0" src="{pigcms{$videos[0].video_url}" allowfullscreen="" width="100%" height="100%" scrolling="no"></iframe>
						</div>
						<div class="videoList">
							<span class="videoLeft"></span>
							<span class="videoRight"></span>
							<div class="videoNav">
								<ul class="clearfix">
									<volist name="videos" id="video" key="k"> 
										<if condition="$k eq 1">
									<li data-video="{pigcms{$video.video_url}" class="active">
										<h3>{pigcms{$video.video_name}</h3>
										<else/>
										<li data-video="{pigcms{$video.video_url}">
										<h3>{pigcms{$video.video_name}</h3>
									</if>
									</li>
									</volist>
									<!-- <li data-video="http://v.qq.com/iframe/player.html?vid=y0162l1ly0s&tiny=0&auto=0&width=616&height=379">
										<h3>农场名称</h3>
										<p style='font-size:12px; color:#b8b8b8;'>与狮同行</p>
									</li> -->
									
								</ul>
							</div>
						</div>
					</div>
					<!-- txtModule txtMself end -->
					<!-- txtModule txtMself start -->
					<div class="recommendPRD container floatPosition">
						<div class="recommendTitle">
							<ins class="icon-rm icon-default"></ins>
							<ul>
								<volist name="threelast" id="one" key="k">
									<if condition="$k eq 1">
								<li class="tab cur">
									<volist name="catogory" id="onecat">
										<if condition="$one['cat_id']==$onecat['cat_id']">
									<div>{pigcms{$onecat.cat_name}</div>
								</if>
								</volist>
								</li>
								<else/>
								<li class="tab">
									<volist name="catogory" id="onecat">
										<if condition="$one['cat_id']==$onecat['cat_id']">
									<div>{pigcms{$onecat.cat_name}</div>
								</if>
								</volist>
								</li>
							</if>
								</volist>	
							</ul>
						</div>
						<!-- txtModule txtMself end -->
						<volist name="threelast" id="onegroup">
						<div class="RCprdList">
							<h3>【{pigcms{$onegroup.prefix_title}】{pigcms{$onegroup.name}</h3>
							<ins></ins>
							<div class="image">
								<a href="/group/{pigcms{$onegroup.group_id}.html" onclick="_gaq.push(['_trackEvent', '老于推荐毛里求斯PC-成都', '点击', '-头部区域-1-产品1-1']);" target="_blank">
									<img src="{pigcms{$onegroup[all_pic][0].image}" data-src="{pigcms{$onegroup[all_pic][0]}" width="577" height="441" alt="">
									</a>
							</div>
							<div class="content">
								<div class="zw-module-bigcard-iteminfo2">
									<div class="content-unit product-option">
										<p class="content-unit-ms">
											{pigcms{$onegroup.s_name}
										</p>
									</div>
									<div class="content-unit lm-calendar">
										<h4 class="unit-title">已售：</h4>
										<div class="unit-nr">
											<label class="unit-nr-ft-color">{pigcms{$onegroup.sale_count}</label>
										</div>
									</div>
									<div class="content-unit product-option">
										<h4 class="unit-title">评价：</h4>
										<div class="unit-nr">
											<label><span class="unit-nr-ft-color">{pigcms{$onegroup.reply_count}</span>次评价</label>
										</div>
									</div>
									<ul class="zw-module-bigcard-infolist">
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											{pigcms{$onegroup.intro}<br>
										</li>
										
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											该商家有<b>{pigcms{$currentmerchant.fans_count}</b>个粉丝
										</li>
									</ul>
								</div>
								<div class="price">
									<div class="old">
										￥<span>{pigcms{$onegroup.price}</span>
									</div>
									<em>￥</em>
									<span class="salePrice">{pigcms{$onegroup.price}</span>起
								</div>
								<a href="/group/{pigcms{$onegroup.group_id}.html" target="_blank" class="goDetail">查看详情</a>
							</div>
						</div>
						</volist>
						<!-- <div class="RCprdList">
							<h3>【陈建斌&蒋勤勤】毛里求斯鹿饮泉酒店2</h3>
							<ins></ins>
							<div class="image">
								<a href="" onclick="_gaq.push(['_trackEvent', '老于推荐毛里求斯PC-成都', '点击', '-头部区域-1-产品1-1']);" target="_blank"><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="http://img2.tuniucdn.com/site/file/zt/laoyutuijian/maoqiu/images/sh-lyq.jpg" width="577" height="441" alt=""></a>
							</div>
							<div class="content">
								<div class="zw-module-bigcard-iteminfo2">
									<div class="content-unit product-option">
										<p class="content-unit-ms">
											老于推荐毛里求斯PC老于推荐毛里求斯PC老于推荐毛里求斯PC老于推荐毛里求斯PC
										</p>
									</div>
									<div class="content-unit lm-calendar">
										<h4 class="unit-title">已售：</h4>
										<div class="unit-nr">
											<label class="unit-nr-ft-color">12</label>
										</div>
									</div>
									<div class="content-unit product-option">
										<h4 class="unit-title">评价：</h4>
										<div class="unit-nr">
											<label><span class="unit-nr-ft-color">0</span>次评价</label>
										</div>
									</div>
									<ul class="zw-module-bigcard-infolist">
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											仅售65元，价值120元双人票！节假日通用！<br>
										</li>
										
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											该商家有<b>0</b>个粉丝
										</li>
									</ul>
								</div>
								<div class="price">
									<div class="old">
										￥<span>11861</span>
									</div>
									<em>￥</em>
									<span class="salePrice">11261</span>起
								</div>
								<a href="" target="_blank" class="goDetail">查看详情</a>
							</div>
						</div> -->
						<!-- <div class="RCprdList">
							<h3>【陈建斌&蒋勤勤】毛里求斯鹿饮泉酒店</h3>
							<ins></ins>
							<div class="image">
								<a href="" onclick="_gaq.push(['_trackEvent', '老于推荐毛里求斯PC-成都', '点击', '-头部区域-1-产品1-1']);" target="_blank"><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="http://img2.tuniucdn.com/site/file/zt/laoyutuijian/maoqiu/images/sh-lyq.jpg" width="577" height="441" alt=""></a>
							</div>
							<div class="content">
								<div class="zw-module-bigcard-iteminfo2">
									<div class="content-unit product-option">
										<p class="content-unit-ms">
											老于推荐毛里求斯PC老于推荐毛里求斯PC老于推荐毛里求斯PC老于推荐毛里求斯PC
										</p>
									</div>
									<div class="content-unit lm-calendar">
										<h4 class="unit-title">已售：</h4>
										<div class="unit-nr">
											<label class="unit-nr-ft-color">12</label>
										</div>
									</div>
									<div class="content-unit product-option">
										<h4 class="unit-title">评价：</h4>
										<div class="unit-nr">
											<label><span class="unit-nr-ft-color">0</span>次评价</label>
										</div>
									</div>
									<ul class="zw-module-bigcard-infolist">
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											仅售65元，价值120元双人票！节假日通用！<br>
										</li>
										
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											该商家有<b>0</b>个粉丝
										</li>
									</ul>
								</div>
								<div class="price">
									<div class="old">
										￥<span>11861</span>
									</div>
									<em>￥</em>
									<span class="salePrice">11261</span>起
								</div>
								<a href="" target="_blank" class="goDetail">查看详情</a>
							</div>
						</div> -->
						<!-- txtModule txtMself start -->
					</div>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			
			
			<div id='block_251570' class='productList an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div class="productTitle" id="cityFixed">
						<h2>农小店推荐</h2>
						<p>Shop recommended</p>
					</div>
					<div class="prdNav">
						<ul id="tags">
							<volist name="meal_category" id="category" key="k">
								<if condition="$k eq 1">
							<li class="cur">
								<A onClick="selectTag('tagContent{pigcms{$k-1}',this)" href="javascript:void(0)">{pigcms{$category['sort_name']}</a>
							</li>
							<else/>
							<li>
								<A onClick="selectTag('tagContent{pigcms{$k-1}',this)" href="javascript:void(0)">{pigcms{$category['sort_name']}</a>
							</li>
							</if>
						    </volist>
						</ul>
					</div>
					<!-- txtModule txtMself end category_meals-->
					<DIV id="tagContent">
						<volist name="category_meals" id="meal" key="k">
							<if condition="$meal">
						<DIV class="tagContent <if condition='$k eq 1'>selectTag</if>" id="tagContent{pigcms{$k-1}">
							<div class="clearfix" style="margin-right: -25px;">
								<volist name="meal" id="onemeal">
								<div class="prodcutionItem">
									<a href="" target="_blank">
										<div class="image">
											<img width="318" height="198" src="{pigcms{$onemeal.image.image}" alt="">
										</div>
										<div class="content">
											<h3>
												<span>
													{pigcms{$onemeal.name}
												</span>
											</h3>
											<p class="price">
												<span>¥</span>
												<span class="sale_price">{pigcms{$onemeal.price}</span>
												<span>起</span>
												<span class="old_price" style="display:none;">{pigcms{$onemeal.old_price}</span>
											</p>
											<p class="button">抢 购</p>
										</div>
									</a>
								</div>
								</volist>
							</div>
						</DIV>
						<else/>
						<DIV class="tagContent <if condition='$k eq 1'>selectTag</if>" id="tagContent{pigcms{$k-1}">
							<div class="clearfix" style="margin-right: -25px;">
								<div class="prodcutionItem">
									<a href="" target="_blank">
										<div class="image">
											<img width="318" height="198" src="{pigcms{$static_path}images/xnd_img/img02.jpg" alt="">
										</div>
										<div class="content">
											<h3>
												<span>
													此分类没有商品内容还
												</span>
											</h3>
											<p class="price">
												<span>¥</span>
												<span class="sale_price">0</span>
												<span>起</span>
												<span class="old_price" style="display:none;">0</span>
											</p>
											<p class="button">抢 购</p>
										</div>
									</a>
								</div>
							</div>
						</DIV>
						</if> 
						</volist>
					</div>
				</DIV>
				<SCRIPT type=text/javascript>
					function selectTag(showContent,selfObj){
										// 操作标签
										var tag = document.getElementById("tags").getElementsByTagName("li");
										var taglength = tag.length;
										for(i=0; i<taglength; i++){
											tag[i].className = "";
										}
										selfObj.parentNode.className = "cur";
										// 操作内容
										for(i=0; j=document.getElementById("tagContent"+i); i++){
											j.style.display = "none";
										}
										document.getElementById(showContent).style.display = "block";
									}
				</SCRIPT>
			</div>
			
			
			<a name="xiaodian"></a>
			<volist name="moduledetails" id="detail" key="k">
			<div class='section{pigcms{$k} floatPosition an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					{pigcms{$detail['content']|htmlspecialchars_decode=ENT_QUOTES}
					<!-- txtModule txtMself end -->
				</div>
			</div>
			</volist>
			
			<a name="huodong"></a>
			<div class='section2 floatPosition an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div style="height:187px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/tit2.png" height="187" />
					</div>
					<div style="height:275px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img19_2.jpg" height="275" />
					</div>
					<div style="height:550px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img20.jpg" height="550" />
					</div>
					<div style="height:629px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img21.jpg" height="629" />
					</div>
					<div style="height:275px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img22.jpg" height="275" />
					</div>
					<div style="height:550px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img23.jpg" height="550" />
					</div>
					<div style="height:635px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img24.jpg" height="635" />
					</div>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			
			<a name="zhongchou"></a>
			<div class='section1 floatPosition an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div style="height:241px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/tit3.png" height="241" />
					</div>
					<div style="height:275px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img25.jpg" height="275" />
					</div>
					<div style="height:550px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img26.jpg?v=1" height="550" />
					</div>
					<div style="height:599px;">
						<img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/img27.jpg" height="599" />
					</div>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			<div class="section2">
			<div class="confession">
				<div class="confession_portrait">
					<if condition="$currentmerchant['person_image']">
					<img src="{pigcms{$currentmerchant.person_image}" />
					<else/>
					<img src="{pigcms{$static_path}images/xnd_img/275x185.jpg" />
				    </if>
				</div>
				<div class="portrait_title">
					<h3>
						{pigcms{$currentmerchant.name}
					</h3>
					<h4>
						农场主：{pigcms{$currentmerchant.person_name}
					</h4>
					<span>
						电话：{pigcms{$currentmerchant.merchant_phone}
					</span>
					<span>
						 场主自白
					</span>
					<p>
						{pigcms{$currentmerchant.person_info}
					</p>
				</div>
			</div>
				
			</div>
			
			<div class='moreTravel an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div class="productTitle">
						<h2>更多目的地</h2>
						<p>Destination</p>
					</div>
					<div class="container" style="padding-bottom: 50px;">
						<ul class="clearfix moreTopic">
							<li>
								<a href=""><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/mu_fh.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href=""><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/malaixiya.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href=""><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/mu_oz.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href=""><img src="{pigcms{$static_path}images/xnd_img/white.gif" data-src="{pigcms{$static_path}images/xnd_img/tangrenjie.jpg" width="248" height="344" alt=""></a>
							</li>
						</ul>
					</div>
					<!-- txtModule txtMself end -->
				</div>
			</div>

			<div id='block_251578' class='copyrightbox an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div class="fixedPosition">
						<ul class="clearfix">
							<li><a href="#zhanshi"><span class="star"></span>农场展示</a></li>
							<li><a href="#tuijian"><span class="cont1"></span>特卖推荐</a></li>
							<li><a href="#xiaodian"><span class="cont2"></span>农小店</a></li>
							<li><a href="#huodong"><span class="cont3"></span>农场活动</a></li>
							<li><a href="#zhongchou"><span class="nav-tiyanshi"></span>农场众筹</a></li>
							<li><a><span class="nav-tips"></span>农场实拍</a></li>
							<li>
								<a>
									<span class="code"></span>
									<img src="{pigcms{$static_path}images/xnd_img/app-qr-code.png" width="126" height="126" alt="">关注农场
								</a>
							</li>
							<li>
								<a href="#"><span class="returntop"></span>返回顶部</a>
							</li>

						</ul>

					</div>
					<!-- txtModule txtMself end -->
					<!-- txtModule txtMself start -->
					<script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/jsUtil.js"></script>
					<script type="text/javascript">
						$('img').lazyload({
							effect: "fadeIn",
							data_attribute: 'src'
						});
						$(function() {
							// 设置立减
							$(".RCprdList").each(function() {
								var salePrice = Number($(this).find(".salePrice").text());
								var old = Number($(this).find(".old span").text());
								var lijian = old - salePrice;
								if (lijian >= 100) {
									$(this).find(".image").append('<div class="lijian">立减' + lijian + '元/人</div>');
								}
							});
							// 设置立减
							$(".prodcutionItem").each(function() {
								var salePrice = Number($(this).find(".sale_price").text());
								var old = Number($(this).find(".old_price").text());
								var lijian = old - salePrice;
								if (lijian >= 100) {
									$(this).find(".image").append('<div class="lijian">立减' + lijian + '元/人</div>');
								}
							});
							//推荐景点线路切换特效
							$('.recommendTitle li').bind('mouseover', function() {
								var index = $(this).index();
								$(this).addClass('cur').siblings().removeClass('cur');
								$('.RCprdList').eq(index).css({
									display: 'block'
								}).siblings('.RCprdList').css('display', 'none');
								$(window).trigger('scroll');
							}).first().trigger("mouseover");
							//视频切换特效
							$('.videoNav li').click(function() {
								var videoUrl = $(this).data('video');
								if (!videoUrl || $(this).hasClass('active')) return false;
								$(this).addClass('active').siblings().removeClass('active');
								$('.videoContent iframe').attr('src', videoUrl);
							});
							//右侧定位导航滚动特效
							var floatPosition = {
								dataScrollTop: [],
								init: function() {
									var _self = this;
									// 存储位置
									$('.floatPosition').each(function() {
										_self.dataScrollTop.push($(this).offset().top);
									});
									this.dataScrollTop.push($('body').height());
									$('.fixedPosition li').bind('click', function() {
										var index = $(this).index();
										if (index == 8) {
											$(window).scrollTop(0);
										} else {
											$(window).scrollTop(_self.dataScrollTop[index]);
										}
										_self.checkPosition();
									});
									_self.checkPosition();
									$(window).scroll(function() {
										_self.checkPosition();
									});
								},
								checkPosition: function() {
									if (this.getCurIndex()) {
										this.changePosition(this.getCurIndex() - 1);
									} else {
										$('.fixedPosition li').removeClass('cur')
									}
								},
								getCurIndex: function() {
									var index, scrollTop = $(window).scrollTop() + 6;
									for (var i = 0; i < this.dataScrollTop.length; i++) {
										if (this.dataScrollTop[i] > scrollTop) {
											index = i;
											break;
										}
									};
									return index;
								},
								changePosition: function(index) {
									$('.fixedPosition li').eq(index).addClass('cur').siblings().removeClass('cur');
								}
							};
							floatPosition.init();
						});
					</script>
					<!-- txtModule txtMself end -->
				</div>
			</div>
		</div>






<!-- old -->
<div class="article" style="display: none;">
  <nav class="indexbanner"> <img src="{pigcms{$static_path}images/shop-shop_25.png" /> </nav>
  <section class="introduction">
    <div class="shop_introduction">
      <div class="section_title">
        <div class="section_txt">商家简介1</div>
        <div class="section_border"><a href="{pigcms{$config.site_url}/merintroduce/{pigcms{$merid}.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="shop_introduction_txt">&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$merchantarr['txt_info']}<a href="{pigcms{$config.site_url}/merintroduce/{pigcms{$merid}.html#one0">　<span>[详细]</span> </a></div>
    </div>
    <div class="news_introduction">
      <div class="section_title">
        <div class="section_txt">新闻资讯</div>
        <div class="section_border"><a href="{pigcms{$config.site_url}/mernews/{pigcms{$merid}.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="news_list">
        <ul>
		 <volist name="introduce" id="nvv">
          <li><span><img src="{pigcms{$static_path}images/xiangqing_50.png" /></span><a href="{pigcms{$config.site_url}/newsdetail/{pigcms{$merid}.html?newsid={pigcms{$nvv['id']}">{pigcms{$nvv['title']}</a></li>
		  </volist>
        </ul>
      </div>
    </div>
    <div style="clear:both"></div>
  </section>
  <if condition="!empty($mimgs)">
  <section class="photo">
    <div class="section_title">
      <div class="section_txt">商家相册</div>
      <div class="section_border"><a href="{pigcms{$config.site_url}/mergallery/{pigcms{$merid}.html">更多>></a></div>
      <div  style="clear:both"></div>
    </div>
    <div class="shop_photo">
      <ul>
	    <volist name="mimgs" id="vo">
        <li><img src="{pigcms{$config.site_url}/{pigcms{$vo['imgstr']}" /></li>
		</volist>
      </ul>
    </div>
  </section>
  </if>
  <div class="shop_shop_list">
    <div class="shop_left">
      <section class="comment">
        <div class="section_title">
          <div class="section_txt">网友点评</div>
          <div class="section_border"><a href="/merreviews/{pigcms{$merid}.html">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="comment_table">
		<include file="merreview_index"/>
        </div>
      </section>
      <!--<section class="upcomment">
        <div class="section_title">
          <div class="section_txt">发表点评</div>
          <div class="section_border"><a href="#">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="shop_pingjia">
          <div class="shop_pinjiga_title">发表评价</div>
          <form action="" method="get">
            <div class="shop_pinjgia_form">
              <div class="shop_pingjia_form_list">
                <ul>
                  <li class="zong">总体评价:</li>
                  <li class="red">好评</li>
                  <li class="yellow">
                    <div class="pingjia_icon"><img src="images/dianpupingjia_10.png"></div>
                    <div class="pingjia_txt">中评</div>
                  </li>
                  <li class="gray">
                    <div class="pingjia_icon"> <img src="images/dianpupingjia_12.png"></div>
                    <div class="pingjia_txt">差评</div>
                  </li>
                  <li class="xing">
                    <div class="shop_pingjia_form_list_txt">星级</div>
                    <div class="shop_pingjia_form_list_icon"><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span> <span><img src="images/dianpupingjia_05.png"></span></div>
                  </li>
                  <div style="clear:both"></div>
                </ul>
              </div>
              <div class="textarea">
                <textarea name="" cols="" rows="" class="form_textarea"></textarea>
              </div>
            </div>
            <div class="button">
              <div class="button_txt"><span>文明上网</span><span>礼貌发帖</span><span></span><span>0/300</span></div>
              <button class="form_button">提交</button>
              <div style="clear:both"></div>
            </div>
          </form>
        </div>
      </section>-->
    </div>
    <aside class="aside">
      <div class="aside_title">入驻时间： {pigcms{$merchantarr['reg_time']|date='Y-m-d H:i:s',###}</div>
      <div class="aside_num">
        <li>
          <p><span>{pigcms{$merchantarr['hits']}</span></p>
          <p>访问</p>
        </li>
        <li style="border:0">
          <p><span><a href="{pigcms{$config.site_url}/merreviews/{pigcms{$merchantarr['mer_id']}.html"><if condition="isset($reviews['count']) && ($reviews['count'] gt 0)">{pigcms{$reviews['count']}<else/>0</if></a></span></p>
          <p>评论</p>
        </li>
        <div style="clear:both"></div>
      </div>
	  <if condition="$collectid gt 0">
        <div class="aside_img2" onclick="Collect_This($(this),{pigcms{$collectid})">已收藏</div>
		<else/>
	    <div class="aside_img" onclick="Collect_This($(this),{pigcms{$collectid})">收藏商家</div>
	  </if>
      <div class="aside_fans">
        <div class="aside_fans_title"> 他的粉丝 <span>（{pigcms{$fans_count}）</span></div>
        <ul class="fans_li_img">
		  <if condition="!empty($fans_list)">
		  <volist name="fans_list" id="fv">
			<li><img src="{pigcms{$fv['avatar']}" alt="{pigcms{$fv['nickname']}" /><div>{pigcms{$fv['nickname']}</div></li>
		  </volist>
		  </if>
          <div style="clear:both"></div>
        </ul>
      </div>
	  <if condition="!empty($mer_front_center)">
      <div class="aside_shop">
        <div class="aside_shop_title">有好店铺</div>
        <ul class="ad_youhao">
		 
		  <volist name="mer_front_center" id="mad">
          <li><a href="{pigcms{$mad['url']}" title="{pigcms{$mad['name']}" target="_blank"><img src="{pigcms{$mad['pic']}"/></a></li>
		  </volist>
        </ul>
      </div>
	  </if>
    </aside>
    <div style="clear:both"></div>
  </div>
</div>
<include file="Public:footer_show"/>
</body>
 
</html>