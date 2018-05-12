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
            background: #000;
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
        
        .wx-alert-bg{
				position: fixed;
				left: 0;
				top: 0;
				background: #000000;
				opacity: 0.6;
				z-index: 999;
				width: 100%;
				height: 100%;
			}
			.alert-main{
				width: 240px;
				margin: 0px auto;
				position: fixed;
				height: 340px;
				top: 15%;
				left: 50%;
				margin-left: -120px;
				background-image: url({pigcms{$static_path}vip/alert-bg.png);
				background-repeat: no-repeat;
				background-size: cover;
				z-index: 1000;
				border-radius: 0px 0px 20px 20px;
			}
			.kong{
				width: 100%;
				height: 85px;
			}
			.user-icon{
				width: 80%;
				margin: 0px auto;
				text-align: center;
				color: #f7da8c;
			}
			.user-icon img{
				width: 60px;
				height: 60px;
				border-radius: 10px;
				margin: 15px auto 0px auto;
			}
			.user-icon h3{
				font-size: 14px;
			}
			.user-icon p{
				font-size: 13px;
				padding-top: 10px;
			}
			.user-icon h4{
				font-size: 24px;
				color: #f7da8c;
				padding-top: 2px;
				font-weight: 700;
			}
			.alert-close{
				position: absolute;
				right: -25px;
				top: -25px;
			}
			.alert-close img{
				width: 25px;
				height: 25px;
			}
			.wx-alert-bg{
				display: none;
			}
			.alert-main{
				display: none;
			}
			.lingqu-btn{
				width: 100%;
				text-align: center;
			}
			.lingqu-btn img{
				width: 60px;
				margin: 0px auto;
			}
    </style>
    
</head>
<body>
<if condition="$issend eq 1">
    <div class="wx-alert-bg" style="display: block;"></div>
    <div class="alert-main"  style="display: block;">
        <div class="alert-close">
            <img src="{pigcms{$static_path}vip/alert-close.png" />
        </div>

        <div class="kong">

        </div>
        <div class="lingqu-btn">
            <a><img src="{pigcms{$static_path}vip/btn-ling.png" /></a>
        </div>
        <div class="user-icon">
            <if condition="$userinfo.avatar neq null ">
                <img src="{pigcms{$userinfo.avatar}" />
                <else />
                <img src="http://www.xiaonongding.com/xnd.png" />
            </if>
            <h3>{pigcms{$userinfo.nickname}</h3>
            <p>给您送了一张充值卡</p>
            <h4>{pigcms{$orderinfo.payment_money}<span style="font-size: 20px; font-weight: 100;">元</span></h4>
        </div>
    </div>
    <else />
    <div class="wx-alert-bg" style="display: none;"></div>
    <div class="alert-main"  style="display: none;">
        <div class="alert-close">
            <img src="{pigcms{$static_path}vip/alert-close.png" />
        </div>

        <div class="kong">

        </div>
        <div class="lingqu-btn">
            <a><img src="{pigcms{$static_path}vip/btn-ling.png" /></a>
        </div>
        <div class="user-icon">
            <if condition="$userinfo.avatar neq null ">
                <img src="{pigcms{$userinfo.avatar}" />
                <else />
                <img src="http://www.xiaonongding.com/xnd.png" />
            </if>
            <h3>{pigcms{$userinfo.nickname}</h3>
            <p>给您送了一张充值卡</p>
            <h4>{pigcms{$orderinfo.payment_money}元</h4>
        </div>
    </div>
</if>
		<script>
		$(document).ready(function(){
		  $(".wx-alert-bg").click(function(){
		    $('.wx-alert-bg').hide();
		    $('.alert-main').hide();
		  });
		  $(".alert-close").click(function(){
		    $('.wx-alert-bg').hide();
		    $('.alert-main').hide();
		  });
		});
	</script>
<div class="vip-rows">

    <div class="vip-img">
        <img src="{pigcms{$static_path}vip/vip-img01.jpg"/>
    </div>
    
    <div class="from-rows">
        <img src="{pigcms{$user.avatar}" />
        <h3>{pigcms{$user.nickname}</h3>
        <if condition="$user.cardmoney gt 0 ">
            <div class="result-row">
                <p>您的白金账户余额<b>{pigcms{$user.cardmoney}</b>元</p>
                <input type="button" class="btn-dh" value="立即領取" />
            </div>
            <div class="inp-row" style="display: none;">
                <input type="text" placeholder="请您输入专属码" class="inp" />
                <input type="button" class="btn" value="确认输入" />
            </div>
            <else />
            <div class="result-row"  style="display: none;">
                <p>您的白金账户余额<b>{pigcms{$user.cardmoney}</b>元</p>
                <input type="button" class="btn-dh" value="立即領取" />
            </div>
            <div class="inp-row" >
                <input type="text" placeholder="请您输入专属码" class="inp" />
                <input type="button" class="btn" value="确认输入" />
            </div>

        </if>


    </div>
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img03.jpg"/>
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
        <img src="{pigcms{$static_path}vip/vip-img10.jpg"/>
    </div>
   
    <div class="vip-img postion-top">
        <img src="{pigcms{$static_path}vip/vip-img12.jpg"/>
    </div>
</div>
<style>
			.postion-fix{
				position: fixed;
				right: 10px;
				bottom: 30px;
				z-index: 800;
			}
			.postion-fix a{
				display: block;
				width: 45px;
				height: 45px;
				border-radius: 100%;
				background:rgba(0,0,0,.5);
				color: #fff;
				text-align: center;
				margin-bottom: 10px;
			}
			.postion-fix a img{
				width: 20px;
				height: 20px;
				margin: 0px auto;
				position: relative;
				top: 5px;
				display: none;
			}
			.postion-fix a h3{
				display: block;
				width: 100%;
				font-size: 12px;
				position: relative;
				top: 8px;
			}
		</style>
		<div class="postion-fix">
            <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Gift&a=giftrecharge">
                <img src="{pigcms{$static_path}vip//icon-dingdan.png" />
                <h3>我要<br/>送卡</h3>
            </a>
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=My&a=group_order_list">
				<img src="{pigcms{$static_path}vip//icon-dingdan.png" />
				<h3>我的<br/>订单</h3>
			</a>
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Vip&a=vipgoods">
				<img src="{pigcms{$static_path}vip//icon-list.png" /><h3>商品<br/>列表</h3>
			</a>
            <a class="cardduihuan">
                <img src="{pigcms{$static_path}vip//icon-list.png" /><h3>卡号<br/>兑换</h3>
            </a>
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
        $(".cardduihuan").on("click",function () {
            $(".result-row").hide();
            $(".inp-row").show();

        });
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
                    location.reload();
                }else{
                   // alert(data.message);
                    layer.alert(data.message+"出错啦");
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
<include file="Public:vipshare"/>
</html>
