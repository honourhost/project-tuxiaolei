<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>分销订单记录</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
    <style>
        .fensi{
            margin: 0px auto;
            background: #fff;
            max-width: 650px;
            min-width: 240px;
        }
        .fensi ul li{
            width: 100%;
            padding: 10px 0px;
            border-bottom: 1px solid #f5f5f5;
        }
        .fensi-logo{
            float: left;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 40px;
            margin: 0px 10px;
        }
        .fensi-logo img{
            width: 40px;
            height: 40px;
        }
        .fensi-t{
            float: left;
            margin-top: 3px;
        }
        .fensi-r{
            float: right;
        }
        .fensi-t h3{
            font-size: 14px;
            color: #7C7C7C;
            padding-bottom: 3px;
            height: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 250px;

        }
        .fensi-t h4{
            font-size: 12px;
            color: #7C7C7C;
        }
        .fensi-r{
            margin-right: 10px;
            color: #7C7C7C;
            margin-top: 3px;
        }
        .fensi-r span{
            font-size: 14px;
            padding-bottom: 3px;
            display: inline-block;
            color: #12AF7E;
        }
        .fensi-r span.nei{
            color: red;
        }
        .fensi-r h4{
            font-size: 12px;
            position: relative;
            top: 4px;
        }
        .leiji{
            margin: 0px 10px;
            padding: 15px 0px;
            border-bottom: 1px solid #f5f5f5;
        }
        .leiji h3{
            font-size: 14px;
            color: #7C7C7C;
        }
        .leiji h3 b{
            font-size: 24px;
            color: #ff9900;
            font-weight: normal;
        }
        .fuwu2{
            width: 100%;
            text-align: center;
            color: #acacac;
            line-height: 80px;

        }
    </style>
</head>
<body>
<div class="fensi">
    <div class="leiji">
        <h3>账户余额：<b>{pigcms{$now_money}</b>

               <a href="http://www.xiaonongding.com/index.php?g=WapMerchant&c=Userwithdraw&a=index"
                  style="text-align: center;background: #1aad19;font-size: 16px;float:right;margin-right:10px; border-radius: 5px;color: #fff;display: block;      padding-left: 10px;
    padding-right: 10px;  height: 35px;
    line-height: 35px;
  ">提现</a>

        </h3>
    </div>
    <ul>

        <volist name="fans" id="fan">
            <li>
                <div class="fensi-logo">
                    <img src="{pigcms{$fan.avatar}"/>
                </div>
                <div class="fensi-t">
                    <h3><?php
                            echo $fan['username']."&nbsp;"; echo  $fan['add_time'];
                       ?></h3>
                    <h4>购买：{pigcms{$fan.order_name}</h4>
                </div>
                <div class="fensi-r">
                       <?php if($fan['distributestatus']=="已结算"){?>

                            <span class="nei" style="color: #1aad19;"><?php echo  $fan['distributestatus'];?></span>

                         <?php }else{?>
                            <span class="nei" style="color: #ff9900;"><?php echo  $fan['distributestatus'];?></span>

                   <?php }?>


                    <h4>佣金<i style="color: red;">{pigcms{$fan.commission} </i>元</h4>
                </div>
                <div style="clear: both;"></div>
            </li>
        </volist>
    </ul>
</div>
<div class="fuwu2">
    本服务由小农丁提供
</div>
</body>
</html>
