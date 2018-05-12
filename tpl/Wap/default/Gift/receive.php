<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xs-style.css"/>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <title>礼品接收-农丁鲜生</title>
    <style>
        .alert-bg{
            display: block;
        }
        .alert-main{
            display: block;
        }
        .lingqu-btn{
            width: 100%;
            text-align: center;
        }
        .lingqu-btn img{
            width: 60px;
        }
    </style>
</head>
<body>
<div class="alert-bg"></div>
<div class="alert-main">
    <div class="alert-close">
        <img src="{pigcms{$static_path}giftimg/alert-close.png" />
    </div>

    <div class="kong">

    </div>
    <div class="lingqu-btn">
        <a ><img src="{pigcms{$static_path}giftimg/btn-ling.png" /></a>
    </div>
    <div class="user-icon">
        <if condition="$userinfo.avatar neq null ">
            <img src="{pigcms{$userinfo.avatar}" />
            <else />
            <img src="http://www.xiaonongding.com/xnd.png" />
        </if>
        <h3>{pigcms{$userinfo.nickname}</h3>
        <p>给您发了一个见面礼</p>
        <h4>{pigcms{$orderinfo.payment_money}元大礼包</h4>
    </div>
</div>
<div class="neirong">
</div>
</body>
<script>
    $(document).ready(function(){
        var orderid="{pigcms{$orderinfo.order_id}";
        var uid="{pigcms{$uid}";
        $(".alert-bg").click(function(){
            $('.alert-bg').hide();
            $('.alert-main').hide();
            window.location.href="http://www.xiaonongding.com/wap.php?c=Vip";
        });
        $(".alert-close").click(function(){
            $('.alert-bg').hide();
            $('.alert-main').hide();
            window.location.href="http://www.xiaonongding.com/wap.php?c=Vip";
        });
        $(".lingqu-btn").on("click",function () {

            $.post("{pigcms{:U('Gift/receiveaction')}",{order_id:orderid,userid:uid},function(result){
                    var res=JSON.parse(result);
                    if(res.error==0){
                        alert(res.message);
                        window.location.href=res.url;
                    }else{
                        alert(res.message);
                    }
            });

        });
    });
</script>
</html>
