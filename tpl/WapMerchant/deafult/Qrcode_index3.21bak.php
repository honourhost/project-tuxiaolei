<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>微信支付</title>
    <style>
        body,div,span,h1,h2,h3,h4,h5,h6,p,img,i,b,a,ul,li,input,table,tr,td,thead{
            margin: 0;
            padding: 0;
        }
        table,tr,td,thead{
            border: 0;
        }
        body{
            font-size: 12px;
            color: #000;
        }
        body,a,input{
            font-family: "microsoft yahei";
        }
        a{
            color: #1978be;
            text-decoration: none;
        }
        a:hover{
            color: #fff;
            text-decoration: none;
        }
        a:active{
            color: #fff;
        }
        input{
            margin: 0;
            padding: 0;
            line-height: 0;
        }
        img{
            border: 0;
            margin: 0;
            padding: 0;
        }
        i{
            font-style: normal;
        }
        h1,h2,h3,h4,h5,h6{
            font-weight: 100;
        }
        ul,li{
            list-style: none;
        }
        .f-left{
            float: left;
        }
        .f-right{
            float: right;
        }
        .clear-both{
            clear: both;
        }
        .cen-main{
            max-width: 650px;
            min-width: 240px;
            margin: 0px auto;
        }
        body{
            background: #f5f5f5;
        }
        .zhifu{
            width: 80%;
            margin: 0px auto;
            text-align: center;
            background: #fff;
            border-radius: 10px;
            margin-top: 30px;
        }
        .weixin-logo{
            padding: 15px 0px;
        }
        .weixin-logo img{
            height: 50px;
        }
        .zhifu-ma h4{
            display: block;
            width: 100%;
            padding: 20px 0px;
            font-size: 20px;
        }
        .zhifu-ma img{
            width: 200px;

        }
        .zhifu-ma{
            background: #4da433;
            color: #fff;
            padding-bottom: 50px;
        }
        .xnd-img{
            padding: 15px 0px;
        }
        .xnd-img img{
            height: 40px;
        }
        .fuwu{
            width: 100%;
            text-align: center;
            color: #acacac;
            padding-bottom: 10px;
            padding-top: 30px;

        }
    </style>
</head>
<body>
<div class="zhifu">
    <div class="weixin-logo"><img src="{pigcms{$static_path}images/zhfu.jpg" /></div>
    <div class="zhifu-ma">
        <h4>扫码 长按识别 点击</h4>
      <a href="http://www.xiaonongding.com/merchantbuy.php?g=MerchantBuy&c=index&a=pay&mer_id={pigcms{$merid}">  <img src="{pigcms{:U('Qrcode/qrpng')}" /></a>
    </div>
    <div class="xnd-img">
        <img src="{pigcms{$static_path}images/xnd-logo.jpg" />
    </div>
</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"QrUser",
        "moduleID":"0",
        "imgUrl": "http://www.xiaonongding.com/tpl/WapMerchant/deafult/static/images/wxpay.png",
        "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('QrUser/index',array('mer_id'=>$merid))}",
        "tTitle": "微信支付",
        "tContent": "{pigcms{$merinfo.name}向您发起一笔付款"
    };
</script>
{pigcms{$shareScript}

</body>
</html>
