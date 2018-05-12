<?php
require "jssdk.php";

$appid = "wx9001d7083b0287ac";
$secret = "4499a315e917f4c9db705a232f9427f1";

$jssdk = new JSSDK($appid, $secret);
$signPackage = $jssdk->GetSignPackage();
?>
var script = document.createElement("script");
var doc = document.getElementsByTagName("script")[0];
script.type = "text/javascript";
script.src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js";
doc.parentNode.insertBefore(script, doc);
if (script.readyState) {
    script.onreadystatechange = function () {
        if (script.readyState == "loaded" || script.readyState == "complete") {
            script.onreadystatechange = null;
            wx.config({
				debug: false,
				appId: '<?php echo $signPackage["appId"];?>',
				timestamp: <?php echo $signPackage["timestamp"];?>,
				nonceStr: '<?php echo $signPackage["nonceStr"];?>',
				signature: '<?php echo $signPackage["signature"];?>',
				jsApiList: [
					'onMenuShareTimeline',
					'onMenuShareAppMessage',
					'onMenuShareQQ',
					'onMenuShareWeibo',
					'onMenuShareQZone'
				]
			});
			if (typeof(shareData) != 'undefined'){
				wx.ready(function(){
					wx.onMenuShareTimeline(shareData);
					wx.onMenuShareAppMessage(shareData);
					wx.onMenuShareQQ(shareData);
					wx.onMenuShareWeibo(shareData);
					wx.onMenuShareQZone(shareData);
				});
			}
			window.iShareinfo = function(info){
                wx.onMenuShareTimeline(info);
				wx.onMenuShareAppMessage(info);
				wx.onMenuShareQQ(info);
				wx.onMenuShareWeibo(info);
				wx.onMenuShareQZone(info);
            };
        }
    };
}else{
    script.onload = function () {
        wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: <?php echo $signPackage["timestamp"];?>,
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'onMenuShareQQ',
				'onMenuShareWeibo',
				'onMenuShareQZone'
			]
		});
		if (typeof(shareData) != 'undefined'){
			wx.ready(function(){
				wx.onMenuShareTimeline(shareData);
				wx.onMenuShareAppMessage(shareData);
				wx.onMenuShareQQ(shareData);
				wx.onMenuShareWeibo(shareData);
				wx.onMenuShareQZone(shareData);
			});
		}
		window.iShareinfo = function(info){
			wx.onMenuShareTimeline(info);
			wx.onMenuShareAppMessage(info);
			wx.onMenuShareQQ(info);
			wx.onMenuShareWeibo(info);
			wx.onMenuShareQZone(info);
		};
    };
}