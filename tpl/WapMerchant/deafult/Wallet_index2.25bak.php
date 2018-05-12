<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>我的收益</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css"/>
</head>
<body>
<div class="cen-main">
    <div class="header" style="background:url('http://www.xiaonongding.com/tpl/Static/default/images/xnd-shncbg.jpg');background-size: 100% 100%;">
        <div class="header-logo">
            <if condition="$pimage">
                <img src="{pigcms{$pimage}">
                <else />
                <img src="http://www.xiaonongding.com/xnd.png">
            </if>

        </div>
        <div class="header-name">
            <span></span>
            <if condition="$pname">
            <i>{pigcms{$pname}</i>
                <else />
                 <i>匿名用户</i>
                </if>
        </div>
    </div>
    <div class="zhanghu">
        <ul>
            <li>
                <h3>&yen;<if condition="$shouyitoday">{pigcms{$shouyitoday}<else />0</if></h3>
                <h4>今日收益</h4>
                <span></span>
            </li>
            <li>
                <b> <if condition="$shouyi">{pigcms{$shouyi}<else />0</if></b>
                <h4>累计收益</h4>
            </li>
            <div class="clear-both"></div>
        </ul>
    </div>

    <div class="nav-list">
        <ul>
            <li>
                <a href="{pigcms{:U('Wallet/detail')}">
                    <span><i>{pigcms{$shouyi}</i><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>
                    <h4>收益明细</h4>
                </a>
            </li>
            <li style="display: none;">
                <a href="{pigcms{:U('WithDraw/index')}">
                    <span><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>
                    <h4>我要提现</h4>
                </a>
            </li>
            <li style="display: none;">
                <a href="{pigcms{:U('Qrcode/fensi')}">
                    <span><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>
                    <h4>粉丝列表</h4>
                </a>
            </li>
        </ul>
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

</div>
<div class="fuwu" style="position: relative; padding-top: 20px;">
    本服务由小农丁提供
</div>
</body>
</html>
