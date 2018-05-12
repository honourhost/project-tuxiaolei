<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telphone=no, email=no" />
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<title>小农丁下载</title>
		<link rel="stylesheet" type="text/css" href="/app/css/common.css"/>
		<style>
		*{
			margin: 0;
			padding: 0;
		}
		img{
			border: 0;
			margin: 0;
			padding: 0;
		}
		body{
			margin: 0;
			padding: 0;
		}
			.down-main{
				padding: 0;
				margin: 0;
			}
			.down-main-div{
				width: 100%;
			}
			.down-main-div img{
				width: 100%;
				margin-bottom: -5px;
			}
		</style>
	</head>
	<body class="down-main" onload="down()">
		<div class="down-main-div">
		<img src="/app/img2/img01.jpg">
		<a href="http://fir.im/lscu">
	    <img src="/app//img2/img02.jpg">
		</a>
		<a href="https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8">
		<img src="/app//img2/img03.jpg">
		</a>
		<img src="/app/img2/img04.jpg">
		</div>
	</body>
	<script type="text/javascript">
	function down(){
		var u = navigator.userAgent;
		var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
		var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
		if(isAndroid == true){
			window.location.assign("http://fir.im/lscu")
		}else if(isiOS == true){
			window.location.assign("https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8")
		}else{
			alert("http://fir.im/lscu");
		}
	}
</script>
	<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$static_path}/images/logo.png", 
						link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Index&a=app",
						title: "小农丁APP下载",
						desc: "小农丁-首家为国内生态农场提供优质农产品特卖，创意农场众筹，及农场线下活动体验的一站式O2O开放平台！"
			};
		</script>
	<include file="Share:share"/>
</html>
