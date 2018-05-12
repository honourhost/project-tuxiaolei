<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-style.css"/>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="https://cdn.bootcss.com/html2canvas/0.5.0-beta4/html2canvas.js"></script>
    <title>农丁鲜生 - 领取奖品</title>
</head>
<body>
	<style>
		@media screen and (min-width:414px){
			.wx-cen{
				padding-bottom: 0px;
			}
			.changan{
				font-size: 18px;
			}
			.wx-an{
				margin: 5px auto 0px auto;
			}
			.wx-logo2{
				padding: 45px 0px 15px 0px;
			}
			.wx-uesr p{
				padding: 10px 0px 20px 0px;
			}
			.red-bg{
				padding-bottom: 40px;
			}
		}
	</style>
<div class="wx-body">
    <div class="wx-cen">
        <div class="wx-logo2">
            <img src="{pigcms{$static_path}giftimg/logo-01.png" />
        </div>
        
	     
	    <div class="red-bg" style="background-image: url(http://www.xiaonongding.com/tpl/Wap/default/static/giftimg/red-bg.png); background-size: cover;">
	    	<div class="user-img">
	     	<if condition="$userinfo.avatar neq null ">
	            <img src="{pigcms{$userinfo.avatar}" />
	            <else />
	            <img src="http://www.xiaonongding.com/xnd.png" />
	        </if>
	     </div>
	        <div class="wx-uesr">
	            <h3>{pigcms{$userinfo.nickname}</h3>
	            <p>送您一份{pigcms{$orderinfo.payment_money}元的农丁鲜生<br/>充值卡</p>
	        </div>
	        <div id="qrcode" class="wx-an"></div>
        </div>
         <p class="changan">长按二维码识别领取</p>
        
    </div>
    <p class="wx-jieshi">本活动最终解释权规小农丁所有</p>
    <div>

</body>


<include file="Public:vipshare"/>
<script>
    $(document).ready(function () {
        var orderid="{pigcms{$order_id}";
        var url="http://www.xiaonongding.com/wap.php?c=Vip&a=index&issend=1&order_id="+orderid;
        $('#qrcode').qrcode({render: "canvas",width: 150,height: 150,text: url});
//        setTimeout(  html2canvas(document.body, {
//            onrendered: function(canvas) {
//                document.getElementsByClassName("wx-body").item(0).innerHTML='';
//                document.getElementsByClassName("wx-body").item(0).appendChild(canvas);
//            }
//        }),2000);

    });
</script>

<script type="text/javascript">
    var orderid="{pigcms{$order_id}";
    var nick="{pigcms{$userinfo.nickname}";
    var money="{pigcms{$orderinfo.payment_money}";
    var desc="{pigcms{$orderinfo.desc}";
    var url="http://www.xiaonongding.com/wap.php?c=Vip&a=index&issend=1&order_id="+orderid;
    window.shareData = {
        "moduleName": "Gift",
        "moduleID": "0",
        "imgUrl": "{pigcms{$userinfo.avatar}",
        "sendFriendLink": url,
        "tTitle": nick+"送您一份价值"+money+"元的农丁鲜生充值卡，赶快领取哦~",
        "tContent": desc
    };
</script>
</html>
