<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>收益明细</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css"/>
    <style>
        .fuwu2{
            width: 100%;
            text-align: center;
            color: #acacac;
            line-height: 80px;

        }
    </style>
</head>
<body>
<div class="cen-main">
    <div class="my-jifen">
        <!-- <span><i>进入积分商城</i><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>-->
        <h3>累计收益：<b>￥{pigcms{$shouyi}</b></h3>
    </div>
    <div class="mx-list">
        <ul>

            <volist name="shouyilist" id="cash">
                <li>
                    <div class="mx-tit">

                        <h4><if condition="$cash.nickname neq null">{pigcms{$cash.nickname}<else />匿名用户</if><br> <span><?php echo  date('Y-m-d H:i:s', $cash["pay_time"]);?></span></h4>
                    </div>
                    <div class="mx-price">
                        <b class="jia">+{pigcms{$cash.payment_money}</b>
                    </div>
                    <div class="clear-both"></div>
                </li>
            </volist>
        </ul>
    </div>
    <div class="fuwu2">
        本服务由小农丁提供
    </div>
</div>
</body>
</html>
