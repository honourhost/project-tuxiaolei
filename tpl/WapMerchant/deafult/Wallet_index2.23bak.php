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
            <img src="{pigcms{$pimage}">
        </div>
        <div class="header-name">
            <span></span>
            <i>{pigcms{$pname}</i>
        </div>
    </div>
    <div class="zhanghu">
        <ul>
            <li>
                <h3>&yen;{pigcms{$shouyitoday}</h3>
                <h4>今日收益</h4>
                <span></span>
            </li>
            <li>
                <b>{pigcms{$shouyi}</b>
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
            <li>
                <a href="{pigcms{:U('WithDraw/index')}">
                    <span><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>
                    <h4>我要提现</h4>
                </a>
            </li>
            <li>
                <a href="{pigcms{:U('Qrcode/fensi')}">
                    <span><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>
                    <h4>粉丝列表</h4>
                </a>
            </li>
        </ul>
    </div>


</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
</body>
</html>
