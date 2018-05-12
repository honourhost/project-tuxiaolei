<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>农丁鲜生白金体验</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}vip/base3.css"/>
    <script type="text/javascript" src="{pigcms{$static_path}vip/jquery_min.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}vip/layer.js"></script>
    <style>
        .vip-rows{
            max-width: 720px;
            min-width: 240px;
            margin: 0px auto;
            position: relative;
        }
        .vip-img{
            width: 100%;
            font-size: 0;
        }
        .vip-img img{
            width: 100%;
            display: block;
            vertical-align:top;
            font-size:0;
            overflow:hidden;
        }
        .from-rows{
            position: relative;
            z-index: 10;
            width: 100%;
            background: url({pigcms{$static_path}vip/bg.jpg);
            height: 140px;
        }
        .row-main{
            width: 100%;
        }
        .from-rows img{
            width: 100px;
            height: 100px;
            border-radius: 100%;
            margin: 0px auto;
            position: absolute;
            top: -70px;
            left: 50%;
            margin-left: -50px;
        }
        .from-rows h3{
            display: block;
            width: 100%;
            text-align: center;
            color: #21c38f;
            font-size: 16px;
            margin-top: 3px;
            position: absolute;
            top: 35px;
        }
        .from-rows input{
            display: block;
            width: 200px;
            border-radius: 0;
            -webkit-appearance: none;
            height: 1;
            padding: 8px 0px;
            border: 0;
            position: absolute;
            left: 50%;
            margin-left: -100px;
        }
        .from-rows input.inp{
            text-indent: 10px;
            font-size: 16px;
            color: #333;
            top: 80px;
        }
        .from-rows input.btn{
            background: #ffd302;
            color: #000;
            font-size: 16px;
            text-align: center;
            top: 125px;
        }
        .postion-top{
            position: relative;
        }
        .inp-row{

        }
        .result-row{
            display: block;
            width: 65%;
            border-radius: 0;
            -webkit-appearance: none;
            height: 1;
            padding: 14px 0px;
            border: 0;
            margin: 0px auto;
            display: none;
        }
        .result-row p{
            position: absolute;
            color: #009946;
            text-align: center;
            font-size: 18px;
            top: 83px;
            width: 300px;
            left: 50%;
            margin-left: -150px;
        }
        .result-row p b{
            font-size:20px;
            padding: 0px 2px;
        }
        .result-row input.btn-dh{
            background: #ffd302;
            color: #000;
            font-size: 16px;
            text-align: center;
            top: 125px;
        }
    </style>
</head>
<body>
<div class="vip-rows">

    <div class="vip-img">
        <img src="{pigcms{$static_path}vip/vip-img01.jpg"/>
    </div>
    <div class="vip-img">
        <img src="{pigcms{$static_path}vip/vip-img02.jpg"/>
    </div>
    <div class="from-rows">
        <img src="{pigcms{$user.avatar}" />
        <h3>{pigcms{$user.nickname}</h3>
        <div class="inp-row">
            <input type="text" placeholder="请您输入专属码" class="inp" />
            <input type="button" class="btn" value="确认输入" />
        </div>
        <div class="result-row">
            <p>恭喜获取<b>1000</b>元领用券</p>
            <input type="button" class="btn-dh" value="立即领取" />
        </div>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img03.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img04.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img05.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img06.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img07.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img08.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img09.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img10.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img11.jpg"/>
    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img12.jpg"/>
    </div>
</div>
</body>
<script>
    function isNull( str ){
        if ( str == "" ) return true;
        var regu = "^[ ]+$";
        var re = new RegExp(regu);
        return re.test(str);
    }

    $(document).ready(function(){
        $(".btn").on("click",function(){
            var code=$(".inp").val();
            if(isNull(code)){
             //   alert("请输入兑换码");
                layer.alert("请输入兑换码");
                return ;
            }
            $.post("{pigcms{:U('Vip/exchangemoneyajax')}",{code:code},function (res) {
             //   alert(typeof  res);
               var data= JSON.parse(res);
                if(data.status==1){
                   // alert(data.message);
                    layer.alert(data.message);
                    $('.inp-row').hide();
                    $('.result-row').show();
                }else{
                   // alert(data.message);
                    layer.alert(data.message);
                }

            });



        });
        $(".btn-dh").on("click",function () {
            window.location.href="{pigcms{:U('Vip/vipgoods')}";

        });
    });
</script>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"Vip",
        "moduleID":"0",
        "imgUrl": "{pigcms{$static_path}/vip/share.jpg",
        "sendFriendLink": "http://www.xiaonongding.com/wap.php?g=Wap&c=Vip",
        "tTitle": "农丁鲜生品鲜白金会员专享",
        "tContent": "小农丁为有品の您甄选原产地最优品、最健康的生鲜食材～"
    };
</script>
<script>
</script>
<include file="Public:vipshare"/>
</html>
