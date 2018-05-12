<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>订单详情</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
    <style>
        .btn-wrapper {
            margin: .28rem .2rem;
        }
        .hotel-price {
            color: #ff8c00;
            font-size: 12px;
            display: block;
        }
        .dealcard .line-right {
            display: none;
        }
        .agreement li {
            display: inline-block;
            width: 50%;
            box-sizing: border-box;
            color: #666;
        }

        .agreement li:nth-child(2n) {
            padding-left: .14rem;
        }

        .agreement li:nth-child(1n) {
            padding-right: .14rem;
        }

        .agreement ul.agree li {
            height: .32rem;
            line-height: .32rem;
        }

        .agreement ul.btn-line li {
            vertical-align: middle;
            margin-top: .06rem;
            margin-bottom: 0;
        }

        .agreement .text-icon {
            margin-right: .14rem;
            vertical-align: top;
            height: 100%;
        }

        .agreement .agree .text-icon {
            font-size: .4rem;
            margin-right: .2rem;
        }


        #deal-details .detail-title {
            background-color: #F8F9FA;
            padding: .2rem;
            font-size: .3rem;
            color: #000;
            border-bottom: 1px solid #ccc;
        }

        #deal-details .detail-title p {
            text-align: center;
        }

        #deal-details .detail-group {
            font-size: .3rem;
            display: -webkit-box;
            display: -ms-flexbox;
        }

        .detail-group .left {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            display: block;
            padding: .28rem 0;
            padding-right: .2rem;
        }

        .detail-group .right {
            display: -webkit-box;
            display: -ms-flexbox;
            -webkit-box-align: center;
            -ms-box-align: center;
            width: 1.2rem;
            padding: .28rem .2rem;
            border-left: 1px solid #ccc;
        }

        .detail-group .middle {
            display: -webkit-box;
            display: -ms-flexbox;
            -webkit-box-align: center;
            -ms-box-align: center;
            width: 1.7rem;
            padding: .28rem .2rem;
            border-left: 1px solid #ccc;
        }

        ul.ul {
            list-style-type: initial;
            padding-left: .4rem;
            margin: .2rem 0;
        }

        ul.ul li {
            font-size: .3rem;
            margin: .1rem 0;
            line-height: 1.5;
        }
        .coupons small{
            float: right;
            font-size: .28rem;
        }
        strong {
            color: #FDB338;
        }
        .coupons-code {
            color: #666;
            text-indent: .2rem;
        }
        .voice-info {
            font-size: .3rem;
            color: #eb8706;
        }
    </style>
</head>
<body id="index">
<div id="tips" class="tips"></div>
<a href="{pigcms{:U('Crowdfunding/detail',array('crowdid'=>$now_order['crowd_id']))}">
    <dl class="list">
        <dd class="dd-padding">
            <div class="more more-weak">
                <div class="dealcard">
                    <div class="dealcard-img imgbox" style="background:none;"><img src="{pigcms{$now_order.webpic}" style="width:100%;height: 1.58rem;"/></div>
                    <div class="dealcard-block-right">
                        <div class="dealcard-brand single-line">{pigcms{$now_order.name}</div>
                        <div class="title text-block">商品单价：{pigcms{$now_order.price}元<br/>购买数量：{pigcms{$now_order.num}</div>
                        <div class="price">
                            订单总价：<span class="strong" style="color:#2bb2a3;">{pigcms{$now_order.total_money}</span><span class="strong-color">元</span>
                        </div>
                    </div>
                </div>
            </div>
        </dd>
    </dl>
</a>
<div class="wrapper-list">
    <dl class="list" style="border-bottom:none;"></dl>
    <dl class="list">
        <dd>
            <dl>
                <dd>
                    <a class="react" href="{pigcms{:U('Index/index',array('token'=>$now_order['mer_id']))}">
                        <div class="more more-weak">
                            <h6>商家信息</h6>
                            <span class="more-after">查看</span>
                        </div>
                    </a>
                </dd>
            </dl>
        </dd>
    </dl>

        <dl class="list coupons">
            <dd>
                <dl>
                    <dt>快递信息</dt>
                    <dd class="dd-padding coupons-code">
                        收货人：{pigcms{$now_order.contact_name}
                    </dd>
                    <dd class="dd-padding coupons-code">
                        地址：{pigcms{$now_order.address}
                    </dd>
                    <dd class="dd-padding coupons-code">
                        电话：{pigcms{$now_order.phone}
                    </dd>
                    <if condition="$now_order['express_type']">
                        <dd class="dd-padding coupons-code">
                            快递公司：{pigcms{$now_order.express_info.name}
                        </dd>
                        <dd class="dd-padding coupons-code">
                            快递单号：{pigcms{$now_order.express_id}<small><a href="http://m.kuaidi100.com/index_all.html?type={pigcms{$now_order.express_info.code}&postid={pigcms{$now_order.express_id}" target="_blank" style="color:#1B9C46;">查看物流信息</a></small>
                        </dd>
                    </if>
                </dl>
            </dd>
        </dl>

    <style>
        .phone-remind{
            font-size: 16px;
            color: #949494;
            text-align: center;
            font-family: "microsoft yahei";
        }
        .phone-remind-title{
            padding: 10px 0px;
            display: block;
            width: 100%;
            background: #f0efed;
        }
        .phone-remind-main{
            width: 100%;
            background: #fff;
            height: auto;
            border-top: 1px solid #ddd8ce;
            border-bottom: 1px solid #ddd8ce;
            padding: 5px 0px;
        }
        .phone-remind-main h4{
            font-size: 14px;
            font-family: "microsoft yahei";
            color: #949494;
            font-weight: normal;
            margin: 0px auto;
            padding: 10px 0px;
        }
        .phone-remind-main img{
            height: 120px;
        }
    </style>
    <if condition="$now_order['mer_id'] neq 686">
        <div class="phone-remind">
            <div class="phone-remind-title">
                - - - - - - - - - - 友情提醒  - - - - - - - - - -
            </div>
            <div class="phone-remind-main">
                <h4>请关注小农丁公共号,避免关闭网页后无法查询订单</h4>
                <img src="{pigcms{$static_path}images/remind-ma.png" />
            </div>
        </div>
        <else/>
    </if>
    <dl class="list">
        <dd>
            <dl>
                <dt>订单详情</dt>
                <ul class="ul">
                    <li>订单编号：{pigcms{$now_order.corder_id}</li>
                    <li>下单时间：{pigcms{$now_order.add_time|date='Y-m-d H:i',###}</li>
                    <li>手机号：{pigcms{$now_order.phone}</li>
                    <li>数量：{pigcms{$now_order.num}</li>
                    <li>总价：{pigcms{$now_order.total_money} 元</li>
                    <if condition="$now_order['third_id'] eq '0' AND $now_order['pay_type'] eq 'offline'">
                        <li>线下需向商家付金额：<font color="red">￥{pigcms{$now_order['total_money']-$now_order['wx_cheap']-$now_order['merchant_balance']-$now_order['balance_pay']}元</font></li>
                        <elseif condition="($now_order['pay_type']=='offline' AND $now_order['paid'] AND !empty($now_order['third_id'])) OR ($now_order['pay_type']!='offline' AND $now_order['paid'])"/>
                        <li>付款方式：{pigcms{$now_order.pay_type_txt}</li>
                        <li>付款时间：{pigcms{$now_order.paytime|date='Y-m-d H:i',###}</li>
                        <if condition="!empty($now_order['use_time'])">
                            <li>消费时间：{pigcms{$now_order.use_time|date='Y-m-d H:i',###}</li>
                        </if>
                    </if>


                </ul>
            </dl>
        </dd>
    </dl>

</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_public}js/jquery.qrcode.min.js"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<include file="Public:footer"/>

{pigcms{$hideScript}
</body>
</html>