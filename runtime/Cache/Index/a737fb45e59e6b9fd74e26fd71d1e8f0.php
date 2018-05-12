<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo ($merchantarr['name']); ?> - <?php echo ($config["seo_title"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/detail.css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
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
			
			.videoBox_div{
				width: 1060px;
				margin: 0px auto;
				height: 400px;
			}
			.videoBox_left{
				width: 400px;
				float: left;
				height: 380px;
				position: relative;
				top: 100px;
				z-index: 10000;
				text-align: center;
			}
			.videoBox_left h3{
				font-size: 24px;
				color: #fff;
				font-weight: bold;
				padding-top: 7px;
			}
			.videoBox_left h3 span{
				position: relative;
				top: 15px;
			}
			.videoBox_left h3 span img{
				width: 15px;
			}
			.videoBox_left p{
				width: 300px;
				height: 120px;
				display: block;
				padding: 10px;
				margin-left: 40px;
				margin-top: 20px;
				font-size: 16px;
				background: #000000;
				color: #fff;
				opacity: 0.8;
				overflow: hidden;
				line-height: 25px;
				text-align: center;
			}
			.videoBox_left_logo{
				width: 150px;
				height: 150px;
				border-radius: 150px;
				border: 5px solid #fff;
			}
			.videoBox {
				background: rgba(255, 255, 255, .4);
				filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#99ffffff', endColorstr='#99ffffff', gradientType=0);
				width: 616px;
				height: 443px;
				padding: 5px;
				float: right;
				position: relative;
				top: 92px;
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
				background-image: url(<?php echo ($static_path); ?>images/xnd_img/video_icon.png);
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/video_icon.png) no-repeat 0px -100px;
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
				background-image: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png);
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
				height: 432px;
				font-size: 0;
				float: left;
				position: relative;
			}
			
			.RCprdList .image .lijian {
				width: 130px;
				height: 40px;
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png) no-repeat 0 0;
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png) no-repeat -482px -95px;
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
				padding-bottom: 20px;
			}
				.section3 {
				background: #1bcdae;
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
				width: 100%;
				margin-bottom: 20px;
	            margin-left: calc(50% - 75px * <?php echo ($category_count+1); ?>);
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png);
				margin: 0 auto 10px;
			}
			
			.travelTip .row1 {
				border-bottom: 1px solid #ddd;
				padding-bottom: 20px;
				margin-bottom: 10px;
			}
			
			.travelTip .view {
				display: block;
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png) 52px -897px #8acda2;
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png) no-repeat 0px -200px;
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/sprites.png) no-repeat;
			}
			
			.number {
				background-image: url(<?php echo ($static_path); ?>images/xnd_img/sprite.png);
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/rightNav.png) no-repeat #04976b;
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
				background: url(<?php echo ($static_path); ?>images/xnd_img/moviebg.jpg) no-repeat center;
			}
			
			.movie .block {
				width: 1000px;
				margin: 0 auto;
			}
			
			.movie_icon {
				background: url(<?php echo ($static_path); ?>images/xnd_img/movie_icon.png) no-repeat center;
			}
			/* 新增 */
			.content-unit-ms{
				font-size: 18px;
			}
			.confession{
		    	width: 1000px;
		    	margin: 0px auto;
		    	clear: both;
		    	padding: 50px 0px;
		    }
		    .confession_portrait{
		    	width: 150px;
		    	height: 150px;
		    	margin: 0 auto;
		    }
		    .confession_portrait img{
		    	width: 150px;
		    	height: 150px;
		    	border-radius: 150px;
		    	border: 4px #fff solid;
		    }
		    .portrait_title{
		    	width: 980px;
		    	margin: 0 auto;
		    	font-size: 18px;
		    	color: #fff;
		    }
		    
		    
		
		    .portrait_title p{
			    line-height: 25px;
		    	width: 100%;
		    	
		    }
		    .portrait_title h3{
		    	font-size: 42px;
		    	text-align: center;
		    	width: 100%;
		    	height: 120px; line-height: 120px;
		    }
		</style>
	
	
</head>
<body>
<!DOCTYPE >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><?php echo ($config["seo_title"]); ?></title>
    <meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
    <meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/common.css" />
	<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
</head>
<body>
	
<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/header.css">
<link href="<?php echo ($static_path); ?>css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
<script src="<?php echo ($static_path); ?>js/xnd_js/headerfoot_black.min.js" async="async"></script>
<!-- 公用头部 -->
<div class="q-layer-header">
			<div class="header-inner">
				<a href="/">
					<img class="logo" src="<?php echo ($static_path); ?>images/xnd_img/index_logo_small.png"  height="18" />
				</a>
				<div class="nav">
					<ul class="nav-ul">
							<li class="nav-list nav-list-layer index_over">
								<span class="nav-span">
								当前地区：<?php echo $_SESSION["cityarr"]['0']['area_name']; ?><i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									
									<div class="q-layer q-layer-section">
												<div class="q-layer">
													<div class="section-title">
														
														<i class="iconfont icon-jiantouyou"></i>
													</a>
														<span>热门地区</span>
													</div>
													<dl class="section-item" style="display: none;">
														<dt>ALL</dt>
														<dd>
															<a href="<?php echo ($config["site_url"]); ?>/categorycityid/all">全国</a>
														</dd>
													</dl>
													<dl class="section-item">
													
														<dd>
															<a style="position: relative; left: -10px;"><b>推荐：</b></a>
															<a href="<?php echo ($config["site_url"]); ?>?cityid=all">全国</a>
															<a href="http://www.xiaonongding.com/?cityid=2268">青岛</a>
															<a href="http://www.xiaonongding.com/?cityid=442">佛山</a>
															<a href="http://www.xiaonongding.com/?cityid=338">定西</a>
															<a href="http://www.xiaonongding.com/?cityid=403">天水</a>
														</dd>
													</dl>
													<?php if(is_array($cities)): $i = 0; $__LIST__ = $cities;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($city): ?><dl class="section-item" style="display: none;">
														<dt><?php echo strtoupper($key); ?></dt>
														<dd>
															<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one): $mod = ($i % 2 );++$i;?><a href="<?php echo ($config["site_url"]); echo "/categorycityid/"; echo ($one[area_id]); ?>"><?php echo ($one["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
														</dd>
													</dl>
													<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
												</div>
									</div>
								
								</div>
							</li>
							<li class="nav-list ">
								<a class="nav-span" href="/category/all" title="">农特超市</a>
							</li>
							
							<li class="nav-list nav-list-layer" style="display: none;">
								<span class="nav-span">
								农丁社区<i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									<ul>
										<li>
											<a href="" title="">
												<i class="iconfont icon-wenda"></i> 旅行问答
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
									</ul>
								</div>
							</li>
                            <li class="nav-list ">
								<a class="nav-span icon-phone-a" href="/app/index.html">
									<i class="iconfont icon-phone"></i>手机小农丁</a>
							</li>
						</ul>
				</div>
				<div class="fun">
					<div id="siteSearch" class="nav-search">
						<form action="<?php echo U('Group/Search/index');?>" method="post">
							<input class="txt" name="w" type="text" autocomplete="off">
							<button class="btn" type="submit">
								<i class="iconfont icon-sousuo"></i>
								<span>搜索</span>
							</button>
						</form>
					</div>
					<div id="js_qyer_header_userStatus" class="status">
						<div class="login show">
							
							<a class="otherlogin-link2">
								<i class="iconfont icon-weixin"></i>
							</a>
							<?php if(empty($user_session)): ?><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a>
							<a href="<?php echo U('Index/Login/reg');?>">注册 </a>
							<?php else: ?>
							<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
							<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a><?php endif; ?>
						</div>
					</div>
					<?php if(empty($user_session)): ?><div class="nav-list nav-list-layer">
						</div>
					<?php else: ?>	
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								个人中心<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="<?php echo U('User/Index/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dd.png"></span> 我的订单
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Rates/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-pl.png"></span> 我的评价
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Collect/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-sc.png"></span> 我的收藏
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Point/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-jf.png"></span> 我的积分
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Credit/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-ye.png"></span> 账户余额
										</a>
									</li>
									<li>
										<a href="<?php echo U('User/Adress/index');?>" title="">
											<span><img src="http://www.xiaonongding.com/tpl/Static/weizan/css/img/icon-dz.png"></span> 收货地址
										</a>
									</li>
								</ul>
							</div>
					</div><?php endif; ?>
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								我是农场主<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="<?php echo ($config["site_url"]); ?>/merchant.php" title="">
											<i><img width="22" height="22" style="position: relative; top: 5px;" src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/iconfont-shangjia.png"></i> 商家中心
										</a>
									</li>
									<li>
										<a href="http://www.xiaonongding.com/intro/3.html" title="">
											<img width="22" height="22" style="position: relative; top: 5px;" src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/iconfont-cooperation.png"></i> 我想合作
										</a>
									</li>
									
								</ul>
							</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶部导航end -->
		<div class="zw-header">
			<div class="zw-header-wrap">
				<p class="zw-header-logo">
					<a href="/">
						<img src="<?php echo ($static_path); ?>images/xnd_img/header_logo.gif" height="34" align="">
					</a>
				</p>
				<ul class="zw-header-nav">
						<li><a href="/category/all">今日特卖</a></li>
						<li><a href="/activity/">农场活动</a></li>
						<li><a href="/farm/index.html">热门农场</a></li>
						<!-- <li><a href="#">即将上线</a></li> -->
						<li><a href="/topic/gansu/index.html">特色馆</a></li>
			    </ul>
				<div class="zw-header-searchs" id="zwheadSearchs">
					<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
						<div class="ipts">
							<p class="icons">
								<span class="zwui-iconfont icon-search"></span>
							</p>
							<input type="text" name="w" value="" placeholder="搜索农特产品" autocomplete="off" class="iptext" id="zwheadSearchText">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/xnd_js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		
		<!-- 公用头部 -->

<!-- 王强新增header end -->
	
	
	
	
	
<!-- old -->
<div class="header_top" style="display: none;">
    <div class="hot cf">
        <div class="loginbar cf">
            <?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
                <div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
                <?php else: ?>
                <p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
                    <a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
                </p><?php endif; ?>
            <div class="span">|</div>
            <div class="weixin cf">
                <div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
                <div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
            </div>
        </div>
        <div class="list">
            <ul class="cf">
                <li>
                    <div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
                    <div class="span">|</div>
                </li>
                <li class="li_txt_info cf">
                    <div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
                    <div class="li_txt_info_ul">
                        <ul class="cf">
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
                        </ul>
                    </div>
                    <div class="span">|</div>
                </li>
                <li class="li_liulan">
                    <div class="li_liulan_txt"><a href="#">最近浏览</a></div>
                    <div class="history" id="J-my-history-menu"></div>
                    <div class="span">|</div>
                </li>
                <li class="li_shop">
                    <div class="li_shop_txt"><a href="#">我是商家</a></div>
                    <ul class="li_txt_info_ul cf">
                        <li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
                        <li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<header class="header cf" style="display: none;">
    <?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
            <div class="banner" style="background:<?php echo ($one_adver["bg_color"]); ?>">
                <div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
            </div>
        </div><?php endif; ?>
    <div class="nav cf">
        <div class="logo">
            <a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
                <img  src="<?php echo ($config["site_logo"]); ?>" />
            </a>
        </div>
        <div class="search">
            <form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
                <div class="form_sec">
                    <div class="form_sec_txt group"><?php echo ($config["group_alias_name"]); ?></div>
                    <div class="form_sec_txt1 meal"><?php echo ($config["meal_alias_name"]); ?></div>
                </div>
                <input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
                <button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
            </form>
            <div class="search_txt">
                <?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="menu">
            <div class="ment_left">
                <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
                <div class="ment_left_txt">随时退</div>
            </div>
            <div class="ment_left">
                <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
                <div class="ment_left_txt">不满意免单</div>
            </div>
            <div class="ment_left">
                <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
                <div class="ment_left_txt">过期退</div>
            </div>
        </div>
    </div>
</header>

<menu class="shop_menu" style="display: none;">
    <div class="box_menu" id="mealallprolist">
        <ul>
            <li <?php if($isindex): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($merid); ?>.html">首页</a></li>
            <?php if(is_array($navmanag)): $i = 0; $__LIST__ = $navmanag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i;?><li <?php if($nv['currenturl']): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/<?php echo ($nv['url']); ?>/<?php echo ($merid); ?>.html"><?php echo ($nv['zhname']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <div style="clear:both"></div>
        </ul>
    </div>
</menu>


<div class="wrapper" id="fortop">
			
			
			<a name="zhanshi"></a>
			<div class='bannerBox an_mo floatPosition'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" width="1920" height="600" data-src="<?php echo ($static_path); ?>images/xnd_img/banner1.jpg" class="fixedImage" alt="">
					<!-- <img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" width="1920" height="600" data-src="<?php echo ($static_path); ?>images/xnd_img/banner2.jpg" class="fixedImage2" alt=""> -->
					<div class="videoBox_div">
						<div class="videoBox_left">
							<?php if($currentmerchant['person_image']): ?><img class="videoBox_left_logo" src="<?php echo ($currentmerchant["person_image"]); ?>" />
							<?php else: ?>
							<img class="videoBox_left_logo" src="<?php echo ($static_path); ?>images/xnd_img/275x185.jpg" /><?php endif; ?>
							<h3>
								<span><img src="<?php echo ($static_path); ?>images/xnd_img/videoBox_left_icon01.png"></span>
								<?php echo ($currentmerchant["person_name"]); ?>的农场
								<span><img src="<?php echo ($static_path); ?>images/xnd_img/videoBox_left_icon02.png"></span>
							</h3>
							<p>
								<?php if($currentmerchant['person_info']): echo getStrSub($currentmerchant['person_info']); ?>
								<?php else: ?>
								<?php echo ($currentmerchant["person_name"]); ?>同学很懒哦~~没有任何梦想！<?php endif; ?>
							</p>
						</div>
						<div class="videoBox">
						<div class="videoContent">
							<?php $len=strlen($videos[0]['video_url']);if($len<25){ ?>
							<iframe frameborder="0" src="http://v.qq.com/iframe/player.html?vid=<?php echo ($videos[0]["video_url"]); ?>" allowfullscreen="" width="100%" height="100%" scrolling="no"></iframe>
							<?php }else{ ?>
							<iframe frameborder="0" src="<?php echo ($videos[0]["video_url"]); ?>" allowfullscreen="" width="100%" height="100%" scrolling="no"></iframe>
							<?php } ?>
						</div>
						<div class="videoList">
							<span class="videoLeft"></span>
							<span class="videoRight"></span>
							<div class="videoNav">
								<ul class="clearfix">
									<?php if(is_array($videos)): $k = 0; $__LIST__ = $videos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($k % 2 );++$k; if($k == 1): $len=strlen($video['video_url']);if($len<25){ ?>
									<li data-video="http://v.qq.com/iframe/player.html?vid=<?php echo ($video["video_url"]); ?>" class="active">
											<?php }else{ ?>
									<li data-video="<?php echo ($video["video_url"]); ?>" class="active">
											<?php } ?>
										<h3><?php echo ($video["video_name"]); ?></h3>
										<?php else: ?>
										<?php $len=strlen($video['video_url']);if($len<25){ ?>
									<li data-video="http://v.qq.com/iframe/player.html?vid=<?php echo ($video["video_url"]); ?>">
											<?php }else{ ?>
									<li data-video="<?php echo ($video["video_url"]); ?>">
											<?php } ?>
										<h3><?php echo ($video["video_name"]); ?></h3><?php endif; ?>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								
									
								</ul>
							</div>
						</div>
					</div>
					</div>
				
					
					<!-- txtModule txtMself end -->
					<!-- txtModule txtMself start -->
					<a name="tuijian"></a>
					<div class="recommendPRD container floatPosition floatPosition">
						<div class="recommendTitle">
							<ins class="icon-rm icon-default"></ins>
							<ul>
								<?php if(is_array($threelast)): $k = 0; $__LIST__ = $threelast;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one): $mod = ($k % 2 );++$k; if($k == 1): ?><li class="tab cur">
									<?php if(is_array($catogory)): $i = 0; $__LIST__ = $catogory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onecat): $mod = ($i % 2 );++$i; if($one['cat_id']==$onecat['cat_id']): ?><div><?php echo ($onecat["cat_name"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</li>
								<?php else: ?>
								<li class="tab">
									<?php if(is_array($catogory)): $i = 0; $__LIST__ = $catogory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onecat): $mod = ($i % 2 );++$i; if($one['cat_id']==$onecat['cat_id']): ?><div><?php echo ($onecat["cat_name"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
							</ul>
						</div>
						<!-- txtModule txtMself end -->
						<?php if(is_array($threelast)): $i = 0; $__LIST__ = $threelast;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onegroup): $mod = ($i % 2 );++$i;?><div class="RCprdList">
							<h3>【<?php echo ($onegroup["prefix_title"]); ?>】<?php echo ($onegroup["name"]); ?></h3>
							<ins></ins>
							<div class="image">
								<a href="/group/<?php echo ($onegroup["group_id"]); ?>.html" onclick="_gaq.push(['_trackEvent', '小农丁', '点击', '-头部区域-1-产品1-1']);" target="_blank">
									<img src="<?php echo ($onegroup[all_pic][0]["image"]); ?>" data-src="<?php echo ($onegroup[all_pic][0]); ?>" width="577" height="432" alt="">
									</a>
							</div>
							<div class="content">
								<div class="zw-module-bigcard-iteminfo2">
									<div class="content-unit product-option">
										<p class="content-unit-ms">
											<?php echo ($onegroup["intro"]); ?>
										</p>
									</div>
									<div class="content-unit lm-calendar">
										<h4 class="unit-title">已售：</h4>
										<div class="unit-nr">
											<label class="unit-nr-ft-color"><?php echo ($onegroup["sale_count"]); ?></label>
										</div>
									</div>
									<div class="content-unit product-option">
										<h4 class="unit-title">评价：</h4>
										<div class="unit-nr">
											<label><span class="unit-nr-ft-color"><?php echo ($onegroup["reply_count"]); ?></span>次评价</label>
										</div>
									</div>
									<ul class="zw-module-bigcard-infolist">
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											<?php echo ($onegroup["s_name"]); ?><br>
										</li>
										
										<li>
											<i class="zwui-iconfont icon-star-line"></i>
											已有<b><?php echo ($currentmerchant["fans_count"]); ?></b>个粉丝关注该商品！
										</li>
									</ul>
								</div>
								<div class="price">
									<div class="old">
										￥<span><?php echo ($onegroup["old_price"]); ?></span>
									</div>
									<em>￥</em>
									<span class="salePrice"><?php echo ($onegroup["price"]); ?></span>起
								</div>
								<a href="/group/<?php echo ($onegroup["group_id"]); ?>.html" target="_blank" class="goDetail">查看详情</a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					
					</div>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			
			<a name="xiaodian"></a>
			<div class='productList an_mo '>
				<div id="block" class="block clearfix floatPosition">
					<!-- txtModule txtMself start -->
					<div class="productTitle" id="cityFixed">
						<h2>特卖列表</h2>
						<p>Sale list</p>
					</div>
					<div class="prdNav">
					<!--	<ul id="tags">
							    <li class="cur">
								<A onClick="selectTag('tagContent0',this)" href="javascript:void(0)">全部</a>
							    </li>
							<?php if(is_array($meal_category)): $k = 0; $__LIST__ = $meal_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($k % 2 );++$k;?><li>
								<A onClick="selectTag('tagContent<?php echo ($k); ?>',this)" href="javascript:void(0)"><?php echo ($category['sort_name']); ?></a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>-->
					</div>
					<!-- txtModule txtMself end category_meals-->
					<DIV id="tagContent">
						<DIV class="tagContent selectTag" id="tagContent0">

							<div class="clearfix" style="margin-right: -25px;">
								<?php if(is_array($allproduct)): $i = 0; $__LIST__ = $allproduct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onemeal): $mod = ($i % 2 );++$i;?><div class="prodcutionItem">
									<a href="/group/<?php echo ($onemeal["group_id"]); ?>.html" target="_blank">
										<div class="image">
											<img width="318" height="198" src="<?php echo ($onemeal[all_pic][0]["image"]); ?>" alt="">
										</div>
										<div class="content">
											<h3>
												<span>
													<?php echo ($onemeal["name"]); if($onemeal["is_lottery_group_buy"] == 1): ?>【抽奖团】<?php elseif($onemeal["is_lottery_group"] == 1): ?>【普通拼团】<?php else: ?>【普通特卖】<?php endif; ?>
												</span>
											</h3>
											<p class="price">
												<span>¥</span>
												<span class="sale_price"><?php echo ($onemeal["price"]); ?></span>
												<span>起</span>
												<span class="old_price" style="display:none;"><?php echo ($onemeal["old_price"]); ?></span>
											</p>
											<p class="button">抢 购</p>
										</div>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>

						</DIV>

						<?php if(is_array($category_meals)): $k = 0; $__LIST__ = $category_meals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$meal): $mod = ($k % 2 );++$k; if($meal): ?><DIV class="tagContent" id="tagContent<?php echo ($k); ?>">
							<div class="clearfix" style="margin-right: -25px;">
								<?php if(is_array($meal)): $i = 0; $__LIST__ = $meal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$onemeal): $mod = ($i % 2 );++$i;?><div class="prodcutionItem">
									<a href="/meal/<?php echo ($merchantmstore["store_id"]); ?>.html#sort_<?php echo ($onemeal["sort_id"]); ?>" target="_blank">
										<div class="image">
											<img width="318" height="198" src="<?php echo ($onemeal["image"]["image"]); ?>" alt="">
										</div>
										<div class="content">
											<h3>
												<span>
													<?php echo ($onemeal["name"]); ?>
												</span>
											</h3>
											<p class="price">
												<span>¥</span>
												<span class="sale_price"><?php echo ($onemeal["price"]); ?></span>
												<span>起</span>
												<span class="old_price" style="display:none;"><?php echo ($onemeal["old_price"]); ?></span>
											</p>
											<p class="button">抢 购</p>
										</div>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</DIV>
						<?php else: ?>
						<DIV class="tagContent" id="tagContent<?php echo ($k); ?>">
							<div class="clearfix" style="margin-right: -25px;">
								<div style=" text-align: center; line-height: 50px; color: green">
									
									<?php echo ($currentmerchant["person_name"]); ?>同学很懒哦~~该分类没有发布任何商品！
									
								</div>
							</div>
						</DIV><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</DIV>
				<div class="productTitle floatPosition" id="cityFixed">
						<h2>农场正在进行的活动</h2>
						<p>Farm activities</p>
				</div>
				<div class="zw-module-productlist-unit">
					<?php if($activities): if(is_array($activities)): $i = 0; $__LIST__ = $activities;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$activity): $mod = ($i % 2 );++$i;?><div class="zw-module-bigcard-wrap2 clearfix">
					<div class="zw-module-bigcard-item2 bigcard-black">
						<a href="/activity/<?php echo ($activity["pigcms_id"]); ?>.html" target="_blank">
							<img class="zw-module-bigcard-itemimg" src="<?php echo ($activity["list_pic"]); ?>" width="400" height="270" title="" alt="">
						</a>
						<?php if($activity['is_finish']): ?><div class="bmbox">
													<div class="bmbox_tips">该活动已经售罄结束</div>
												</div>
						<?php else: ?>
						<div class="zw-module-bigcard-iteminfo3 bigcard-iteminfo-noinfotype">
							
							<div class="zw-module-bigcard-infonum2">
								共需<span><?php echo ($activity["all_count"]); ?></span>人
							</div>
							<h2>
						      <a href="" title="" target="_blank">
						      	<?php echo ($activity["title"]); ?>
						      </a>
					        </h2>
							<ul class="zw-module-bigcard-infolist2">
								<li>
									<i class="zwui-iconfont icon-star-line"></i>
									<?php echo ($activity["name"]); ?><br />
								</li>
							</ul>
							<div class="zw-module-bigcard-price">
								<span class="line">已有</span>
								<em><?php echo ($activity["part_count"]); ?></em>人参加
							</div>
							<div class="zw-module-bigcard-bottombar2">
								<div class="zw-module-bigcard-datebar2">
									截止时间：<?php echo date("Y-m-d", time($activity['end_time'])); ?> 
								</div>
								<a class="zw-module-bigcard-btn2" href="/activity/<?php echo ($activity["pigcms_id"]); ?>.html" target="_blank">
									立即参加
								</a>
							</div>
						</div><?php endif; ?>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
						<p style="text-align:center;">目前该商家还没有发布活动</p><?php endif; ?>
			
		</div>
			
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
			
			
			
			<?php if(is_array($moduledetails)): $k = 0; $__LIST__ = $moduledetails;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($k % 2 );++$k; if($k%2==0): ?><div class='section2 floatPosition an_mo'>
				<div id="block" class="block clearfix" style="text-align: center;">
					<!-- txtModule txtMself start -->
					<?php echo (htmlspecialchars_decode($detail['content'],ENT_QUOTES)); ?>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			<?php else: ?>
				<div class='section1 floatPosition an_mo'>
				<div id="block" class="block clearfix" style="text-align: center;">
					<!-- txtModule txtMself start -->
					<?php echo (htmlspecialchars_decode($detail['content'],ENT_QUOTES)); ?>
					<!-- txtModule txtMself end -->
				</div>
			</div>
			<![endif]--><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			
			
			
			
			
			
			<div class="section3">
			<div class="confession">
				
				
				<div class="confession_portrait">
					<?php if($currentmerchant['person_image']): ?><img src="<?php echo ($currentmerchant["person_image"]); ?>" />
					<?php else: ?>
					<img src="<?php echo ($static_path); ?>images/xnd_img/275x185.jpg" /><?php endif; ?>
				</div>
				
				
				
				<div class="portrait_title">
					<h3>
						<?php echo ($currentmerchant["person_name"]); ?>的农场梦
					</h3>

					<p>
						

						<?php if($currentmerchant['person_info']): ?><span>"</span><?php echo ($currentmerchant["person_info"]); ?><span>"</span>
					<?php else: ?>
					<p style=" text-align: center"><?php echo ($currentmerchant["person_name"]); ?>同学很懒哦~~没有任何梦想！</p><?php endif; ?>
					

					</p>
				</div>
			</div>
				
			</div>
			

			
			
			
			<div class='moreTravel an_mo'>
				<div id="block" class="block clearfix">
					<!-- txtModule txtMself start -->
					<div class="productTitle">
						<h2>优秀农场主推荐</h2>
						<p>Destination</p>
					</div>
					<div class="container" style="padding-bottom: 50px;">
						<ul class="clearfix moreTopic">
							<li>
								<a href="http://www.xiaonongding.com/merindex/592.html"><img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" data-src="<?php echo ($static_path); ?>images/0101.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href="http://www.xiaonongding.com/merindex/583.html"><img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" data-src="<?php echo ($static_path); ?>images/0102.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href="http://www.xiaonongding.com/merindex/592.html"><img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" data-src="<?php echo ($static_path); ?>images/0103.jpg" width="248" height="344" alt=""></a>
							</li>
							<li>
								<a href="http://www.xiaonongding.com/merindex/592.html"><img src="<?php echo ($static_path); ?>images/xnd_img/white.gif" data-src="<?php echo ($static_path); ?>images/0104.jpg" width="248" height="344" alt=""></a>
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
							<li><a><span class="nav-tips"></span>农场实拍</a></li>
							<li>
								<a>
									<span class="code"></span>
									<img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'merchant','id'=>$currentmerchant['mer_id']));?>" width="126" height="126" alt="">关注农场
								</a>
							</li>
							<li>
								<a href="#"><span class="returntop"></span>返回顶部</a>
							</li>

						</ul>

					</div>
					<!-- txtModule txtMself end -->
					<!-- txtModule txtMself start -->
					<script type="text/javascript" src="<?php echo ($static_path); ?>js/xnd_js/jsUtil.js"></script>
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
  <nav class="indexbanner"> <img src="<?php echo ($static_path); ?>images/shop-shop_25.png" /> </nav>
  <section class="introduction">
    <div class="shop_introduction">
      <div class="section_title">
        <div class="section_txt">商家简介1</div>
        <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/merintroduce/<?php echo ($merid); ?>.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="shop_introduction_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($merchantarr['txt_info']); ?><a href="<?php echo ($config["site_url"]); ?>/merintroduce/<?php echo ($merid); ?>.html#one0">　<span>[详细]</span> </a></div>
    </div>
    <div class="news_introduction">
      <div class="section_title">
        <div class="section_txt">新闻资讯</div>
        <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/mernews/<?php echo ($merid); ?>.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="news_list">
        <ul>
		 <?php if(is_array($introduce)): $i = 0; $__LIST__ = $introduce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nvv): $mod = ($i % 2 );++$i;?><li><span><img src="<?php echo ($static_path); ?>images/xiangqing_50.png" /></span><a href="<?php echo ($config["site_url"]); ?>/newsdetail/<?php echo ($merid); ?>.html?newsid=<?php echo ($nvv['id']); ?>"><?php echo ($nvv['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
    <div style="clear:both"></div>
  </section>
  <?php if(!empty($mimgs)): ?><section class="photo">
    <div class="section_title">
      <div class="section_txt">商家相册</div>
      <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/mergallery/<?php echo ($merid); ?>.html">更多>></a></div>
      <div  style="clear:both"></div>
    </div>
    <div class="shop_photo">
      <ul>
	    <?php if(is_array($mimgs)): $i = 0; $__LIST__ = $mimgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($config["site_url"]); ?>/<?php echo ($vo['imgstr']); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </section><?php endif; ?>
  <div class="shop_shop_list">
    <div class="shop_left">
      <section class="comment">
        <div class="section_title">
          <div class="section_txt">网友点评</div>
          <div class="section_border"><a href="/merreviews/<?php echo ($merid); ?>.html">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="comment_table">
		<div class="zzsc">
	<div class="tab">
		<div class="tab_title">
			<a href="/merreviews/<?php echo ($merid); ?>.html" class="on" target="_blank">全部</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=1" target="_blank">好评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=2" target="_blank">中评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=3" target="_blank">差评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=4" target="_blank">有图</a>
		</div>
	</div>
	<div class="content">
		<div class="appraise_li-list">
	        <dl>
				<?php if(!empty($reviews['list'])): if(is_array($reviews['list'])): $i = 0; $__LIST__ = $reviews['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rv): $mod = ($i % 2 );++$i;?><dd>
							<div class="appraise_li-list_img">
                                <div class="appraise_li-list_icon"><img src="<?php echo ($rv['avatar']); ?>"></div>
								<p><?php echo ($rv['nickname']); ?></p>
                            </div>
							<div class="appraise_li-list_right cf">
                                <div class="appraise_li-list_top cf">
                                    <div class="appraise_li-list_top_icon">
										<div><span style="width:<?php echo ($rv['score']/5*100); ?>%;"></span></div>
									</div>
                                    <div class="appraise_li-list_data"><?php echo ($rv['add_time']); ?></div>
                                </div>
                                <div class="appraise_li-list_txt"><?php echo ($rv['comment']); ?></div>
								<?php if(!empty($rv['pics'])): ?><div class="pic-list J-piclist-wrapper">
									<div class="J-pic-thumbnails pic-thumbnails">
									<ul class="pic-thumbnail-list widget-carousel-indicator-list">
									<?php if(is_array($rv['pics'])): $i = 0; $__LIST__ = $rv['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgs): $mod = ($i % 2 );++$i;?><li big-src="<?php echo ($imgs['image']); ?>" m-src="<?php echo ($imgs['m_image']); ?>">
									  <a hidefocus="true" href="#" class="pic-thumbnail"><img src="<?php echo ($imgs['s_image']); ?>"></a>
									  </li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
									 </div>
									 </div><?php endif; ?>
                            </div>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<dd>暂无评论</dd><?php endif; ?>
            </dl>
		</div>
	</div>
  </div>
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
  <script type="text/javascript">
		$('.J-piclist-wrapper li a').live('click',function(){
		var m_src = $(this).closest('li').attr('m-src');
		var big_src = $(this).closest('li').attr('big-src');
		window.art.dialog({
			title: '查看图片',
			lock: true,
			fixed: true,
			opacity: '0.4',
			resize: false,
			left: '50%',
			top: '38.2%',
			content:'<a href="'+big_src+'" target="_blank" title="新窗口打开查看原图"><img src="'+m_src+'" alt="大图"/></a>',
			close: null
		});
		return false;
	});
</script>
        </div>
      </section>
     
    </div>
    <aside class="aside">
      <div class="aside_title">入驻时间： <?php echo (date('Y-m-d H:i:s',$merchantarr['reg_time'])); ?></div>
      <div class="aside_num">
        <li>
          <p><span><?php echo ($merchantarr['hits']); ?></span></p>
          <p>访问</p>
        </li>
        <li style="border:0">
          <p><span><a href="<?php echo ($config["site_url"]); ?>/merreviews/<?php echo ($merchantarr['mer_id']); ?>.html"><?php if(isset($reviews['count']) && ($reviews['count'] > 0)): echo ($reviews['count']); else: ?>0<?php endif; ?></a></span></p>
          <p>评论</p>
        </li>
        <div style="clear:both"></div>
      </div>
	  <?php if($collectid > 0): ?><div class="aside_img2" onclick="Collect_This($(this),<?php echo ($collectid); ?>)">已收藏</div>
		<?php else: ?>
	    <div class="aside_img" onclick="Collect_This($(this),<?php echo ($collectid); ?>)">收藏商家</div><?php endif; ?>
      <div class="aside_fans">
        <div class="aside_fans_title"> 他的粉丝 <span>（<?php echo ($fans_count); ?>）</span></div>
        <ul class="fans_li_img">
		  <?php if(!empty($fans_list)): if(is_array($fans_list)): $i = 0; $__LIST__ = $fans_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fv): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($fv['avatar']); ?>" alt="<?php echo ($fv['nickname']); ?>" /><div><?php echo ($fv['nickname']); ?></div></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          <div style="clear:both"></div>
        </ul>
      </div>
	  <?php if(!empty($mer_front_center)): ?><div class="aside_shop">
        <div class="aside_shop_title">有好店铺</div>
        <ul class="ad_youhao">
		 
		  <?php if(is_array($mer_front_center)): $i = 0; $__LIST__ = $mer_front_center;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mad): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($mad['url']); ?>" title="<?php echo ($mad['name']); ?>" target="_blank"><img src="<?php echo ($mad['pic']); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div><?php endif; ?>
    </aside>
    <div style="clear:both"></div>
  </div>
</div>
<!-- 王强新增footer -->
<script language="javascript" src="<?php echo ($static_path); ?>js/xnd_js/monitor.js"></script>
		<!-- 公共尾部 -->
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/footer.css">
	    <!-- 公共尾部 -->
		<div class="zw-footerprepend">
			<ul class="zw-footer-nav">
				<li><a href="/">首页</a></li>
				<li><a href="/category/all">今日特卖</a></li>
				<li><a href="/activity/">农场活动</a></li>
				<li><a href="/farm/index.html">热门农场</a></li>
				<!-- <li><a href="">即将上线</a></li> -->
				<li><a href="/topic/gansu/index.html">特色馆</a></li>
			</ul>
			<ul class="zw-footer-feature">
				<li>
					<p class="icon zybz"></p>
					<h3 class="title">身份保障</h3>
					<p class="text">农场生产环节透明，产品加工过程安全，企业资质审核严格，用户服务担保交易</p>
				</li>
				<li>
					<p class="icon dcsh"></p>
					<h3 class="title">健康承诺</h3>
					<p class="text">倡导入驻企业，农场，商户与消费者签署《产品服务品质承诺书》</p>
				</li>
				<li>
					<p class="icon axph"></p>
					<h3 class="title">口碑监督</h3>
					<p class="text">靠谱商家以身作则，消费者亲历打造农场诚信评价档案，有机轨迹一网打尽</p>
				</li>
			</ul>
		</div>

		<!-- 公共尾部 -->
		<div class="zw-footer">
			<div class="zw-footer-wrap">
				<div class="zw-footer-line1 clearfix">
					<div class="zw-footer-intro">
						<p class="logo"><img alt="小农丁"  src="<?php echo ($static_path); ?>images/xnd_img/foot_logo.png"></p>
						<p class="text">
							您有多久没有闻过泥土的芬芳？您的孩子是否从未在农田里奔跑？您是否厌倦了城市钢筋水泥般枯槁的生活？您是否渴望寻找一片属于自己和家人的乐园？您是否心中始终怀揣着回归田园的梦想？
						</p>
					</div>
					<dl class="zw-footer-concerns">
						<dt>关注我们</dt>
						<dd class="iphone">
							<p class="icons">
								<span class="zwui-iconfont icon-iphone"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-app.jpg"></p>
										<div class="text">
											<p class="txt1">扫一扫下载</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">APP</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="wechat">
							<p class="icons">
								<span class="zwui-iconfont icon-wechat"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-weixin.png"></p>
										<div class="text">
											<p class="txt1">扫一扫关注</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">微信</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="weibo">
							<p class="icons"><span class="zwui-iconfont icon-weibo"></span></p>
							<div class="layer">
								<div class="box">
									<div class="clearfixs">
										<a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank" class="follow">+ 关注</a>
										<span class="text"><a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank">@小农丁</a></span>
									</div>
								</div>
							</div>
						</dd>
						
					</dl>
				</div>
				<div class="zw-footer-line2">
					<div class="zw-footer-listlinks">
						2015-2016 © 小农丁™ xiaonongding.com All rights reserved. 鲁ICP备14030686号-1
					</div>
					<p class="zw-footer-frilinks">
						友情链接：
						<a href="http://www.joyvio.com/" target="_blank">佳沃农业</a>
						<a href="http://www.taobao.com/" target="_blank">淘宝</a>
						<a href="http://z.jd.com/new.html" target="_blank">京东众筹</a>
					</p>
				</div>
			</div>
		</div>
		<!-- 公共尾部 end -->
		<script src="<?php echo ($static_path); ?>js/xnd_js/channel_block.js"></script>








</body>
 
</html>