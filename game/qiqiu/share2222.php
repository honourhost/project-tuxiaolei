<?php
$appid = "wx9001d7083b0287ac";
$secret = "4499a315e917f4c9db705a232f9427f1";


require_once 'http://www.tuxiaolei.cn/game/weixinshare/jssdk.php';
$jssdk = new JSSDK($appid, $secret);
$signPackage = $jssdk->GetSignPackage();
?>
		<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
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
            wx.ready(function(){
            wx.onMenuShareTimeline(shareData);
			wx.onMenuShareAppMessage(shareData);
			wx.onMenuShareQQ(shareData);
			wx.onMenuShareWeibo(shareData);
			wx.onMenuShareQZone(shareData);
            });
        </script>