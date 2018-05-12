<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>确认订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
</head>
<body>
<div id="tips" class="tips"></div>
<div class="wrapper-list">
    <h4 style="margin-top:.4rem">{pigcms{$order_info.name}</h4>
    <dl class="list">
        <dd>
            <dl>
                <if condition="$order_info['order_txt_type']">
                    <dd class="kv-line-r dd-padding">
                        <h6>类型：</h6>
                        <p>众筹</p>
                    </dd>
                </if>
                <if condition="$order_info['order_num']">
                    <dd class="kv-line-r dd-padding">
                        <h6>购买数量：</h6><p>1</p>
                    </dd>
                </if>
                <if condition="$order_info['price']">
                    <dd class="kv-line-r dd-padding">
                        <h6>项目单价：</h6><p>{pigcms{$order_info.price}元</p>
                    </dd>
                </if>
                <dd class="kv-line-r dd-padding">
                    <h6>总额：</h6><p><strong class="highlight-price">{pigcms{$order_info.total_money}元</strong></p>
                </dd>
            </dl>
        </dd>
    </dl>

    <form action="/source{pigcms{:U('Crowdpay/go_pay',array('showwxpaytitle1'=>1))}" method="POST" id="pay-form" class="pay-form">
        <input type="hidden" name="order_id" value="{pigcms{$order_info.corder_id}"/>
        <div id="pay-methods-panel" class="pay-methods-panel">

            <div class="wrapper buy-wrapper">
                <button type="submit" class="btn mj-submit btn-strong btn-larger btn-block" style="display:none;">确认支付</button>
            </div>
        </div>
    </form>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script>var showBuyBtn = true;</script>
<if condition="$cheap_info['can_buy'] heq false">
    <script>layer.open({title:['提示：','background-color:#FF658E;color:#fff;'],content:'您必须关注公众号后才能购买本单！<br/>长按图片识别二维码关注：<br/><img src="{pigcms{$config.site_url}/index.php?c=Recognition&a=get_tmp_qrcode&qrcode_id={pigcms{$order_info['order_id']+2000000000}" style="width:230px;height:230px;"/>',shadeClose:false});$('button.mj-submit').remove();var showBuyBtn = false;</script>
</if>
<script>if(showBuyBtn){$('button.mj-submit').show();}</script>
<php>$no_footer = true;</php>
<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>