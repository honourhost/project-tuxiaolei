<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
   	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>小农丁 - 扫码付款</title>
</head>
<style>
		*{
			margin: 0;
			padding: 0;
		}
		body,img,div,span,input,ul,li{
			margin: 0;
			padding: 0;
		}
		img{
			border: 0;
		}
		a{
			color: #333;
			text-decoration: none;
		}
		body{
			background: #419156;
			font-size: 12px;
		}
		.max-width{
			max-width: 650px;
			min-width: 240px;
			margin: 0px auto;
		}
		.xnd-ma{
			width: 80%;
			margin: 20px auto;
			background: #fff;
			border-radius: 5px;
			text-align: center;
			overflow: hidden;
		}
		.xnd-ma img{
			width: 90%;
			margin: 5% auto;
		}
		.saoma{
			width: 100%;
			height: 40px;
			line-height: 40px;
			background: #f7f7f7;
			font-size: 14px;
		}
		.copy-right{
			display: block;
			width: 100%;
			text-align: center;
			color: #73b37f;
			font-size: 14px;
		}
</style>
<body>
<div class="max-width">
    <div class="xnd-ma">
        <img src="{pigcms{$static_path}img/erweima.png">
        <div class="saoma">扫描二维码付款</div>
    </div>
    <p class="copy-right">@小农丁</p>
</div>
<script type="text/javascript">
    var title = '小农丁-扫码付款';
    var shareData = {
        imgUrl: 'http://www.xiaonongding.com/xnd.png',
        link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Qrpay&a=qr",
        title: "小农丁-扫码付款",
        desc: "扫描二维码就可以转账付款啦"
    };
</script>
<include file="Share:share"/>
</body>
</html>
