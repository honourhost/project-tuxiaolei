<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>众筹列表</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>

    <style>
        .my-account {
            color: #333;
            position: relative;
            background: -webkit-linear-gradient(top,#e1dace,#dfc8b4);
            border-bottom: 1px solid #C0BBB2;
            display: block;
            height: 1.6rem;
            position: relative;
            padding-right: .2rem;
        }
        .my-account>img {
            height: 100%;
            position: absolute;
            right: 0;
            top:0;
            z-index: 0;
        }
        .my-account .user-info {
            z-index: 1;
            position: relative;
            height: 100%;
            padding: .28rem .2rem;
            margin-right: .2rem;
            box-sizing: border-box;
            padding-left: 1.7rem;
            font-size: .24rem;
            color: #666;
        }
        .my-account .uname {
            font-size: .3rem;
            color: #333;
            margin-top: .0rem;
            margin-bottom: .12rem;
        }
        .my-account .umoney {
            margin-bottom: 0.06rem;
        }
        .my-account strong {
            color: #FF9712;
            font-weight: normal;
        }
        .my-account .avater {
            position: absolute;
            top: .2rem;
            left: .3rem;
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 50%;
        }
        .my-account .more.more-weak:after {
            border-color: #666;
            -webkit-transform: translateY(-50%) scaleY(1.2) rotateZ(-135deg);
        }
        dl.list dd.dealcard {
            overflow: visible;
            -webkit-transition: -webkit-transform .2s;
            position: relative;
        }
        .dealcard.orders-del {
            -webkit-transform: translateX(1.05rem);
        }
        .dealcard-block-right {
            height: 1.68rem;
            position: relative;
        }
        .dealcard .dealcard-brand {
            margin-bottom: .18rem;
        }
        .dealcard small {
            font-size: .24rem;
            color: #666;
        }
        .dealcard weak {
            font-size: .24rem;
            color: #999;
            position: absolute;
            bottom: 0;
            left: 0;
            display: block;
            width: 100%;
        }
        .dealcard weak b {
            color: #FDB338;
        }
        .dealcard weak a.btn{
            margin: -.15rem 0;
        }
        .dealcard weak b.dark {
            color: #fa7251;
        }
        .hotel-price {
            color: #ff8c00;
            font-size: .24rem;
            display: block;
        }
        .del-btn {
            display: block;
            width: .45rem;
            height: .45rem;
            text-align: center;
            line-height: .45rem;
            position: absolute;
            left: -.85rem;
            top: 50%;
            background-color: #EC5330;
            color: #fff;
            -webkit-transform: translateY(-50%);
            border-radius: 50%;
            font-size: .4rem;
        }
        .no-order {
            color: #D4D4D4;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2.5rem;
        }
        .icon-line {
            font-size: 2rem;
            margin-bottom: .2rem;
        }
        .orderindex li {
            display: inline-block;
            width:50%;
            text-align:center;
            position: relative;
        }
        .orderindex li .react {
            padding: .28rem 0;
        }
        .orderindex .text-icon {
            display: block;
            font-size: .4rem;
            margin-bottom: .18rem;
        }
        .orderindex .amount-icon {
            position: absolute;
            left: 50%;
            top: .16rem;
            color: white;
            background: #EC5330;
            border-radius: 50%;
            padding: .08rem .06rem;
            min-width: .28rem;
            font-size: .24rem;
            margin-left: .1rem;
            display: none;
        }
        .order-icon {
            display: inline-block;
            width: .5rem;
            height: .5rem;
            text-align: center;
            line-height: .5rem;
            border-radius: .06rem;
            color: white;
            margin-right: .25rem;
            margin-top: -.06rem;
            margin-bottom: -.06rem;
            background-color: #F5716E;
            vertical-align: initial;
            font-size: .3rem;
        }
        .order-all {
            background-color: #2bb2a3;
        }
        .order-zuo,.order-jiudian {
            background-color: #F5716E;
        }
        .order-fav {
            background-color: #0092DE;
        }
        .order-card {
            background-color: #EB2C00;
        }
        .order-lottery {
            background-color: #F5B345;
        }
        .color-gray{
            color:gray;
            border-color:gray;
        }
        .color-gray:active{
            background-color:gray;
        }
        .orderindex li .react.hover{
            color:#FF658E;
        }
    </style>
    <style>
        .address-container {
            font-size: .3rem;
            -webkit-box-flex: 1;
        }
        .kv-line h6 {
            width:auto;
        }
        .btn-wrapper {
            margin: .2rem .2rem;
            padding: 0;
        }

        .address-wrapper a {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flex-box;
        }

        .address-select {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flex-box;
            padding-right: .2rem;
            -webkit-box-align: center;
            -webkit-box-pack: center;
            -moz-box-align: center;
            -moz-box-pack: center;
            -ms-box-align: center;
            -ms-flex-pack: justify;
        }

        .list.active dd {
            background-color: #fff5e3;
        }

        .confirmlist {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flex-box;
        }

        .confirmlist li {
            -ms-flex: 1;
            -moz-box-flex: 1;
            -webkit-box-flex: 1;
            height: .88rem;
            line-height: .88rem;
            border-right: 1px solid #C9C3B7;
            text-align: center;
        }

        .confirmlist li a {
            color: #2bb2a3;
        }

        .confirmlist li:last-child {
            border-right: none;
        }
    </style>
    <style>
        .pin-list-wx{
            width: 100%;
            background: #fff;
        }
        .pin-list-wx ul{

        }
        .pin-list-wx ul li{
            width: 94%;
            height: auto;
            margin: 0px auto;
            border-bottom: 1px solid #e5e5e5;
            padding: 2% 0px;
            position: relative;
        }
        .tuanzhang{
            position: absolute;
            right: 0px;
            top: 25px;
            width: 60px;
            height: 60px;
        }
        .tuanzhang img{
            width: 100%;
        }
        .list-wx-img{
            width: 100px;
            height: 100px;
            background-origin: border-box;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-size: cover;
            float: left;
            border-radius: 3px;
            margin-right: 2%;
            overflow: hidden;
        }
        .list-wx-img .position{
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .list-wx-img .position span {
            float: left;
            padding: 3px 3px;
            margin-right: 5px;
            font-size: 10px;
            color: #fff;
        }
        .icon-color01 {
            background: #a5dd18;
            color: #000;
        }
        .list-right h3{
            font-size: 14px;
            color: #343434;
            display: block;
            height: 20px;
            line-height: 20px;
            overflow: hidden;
        }
        .list-right span{
            margin-right: 10px;
        }
        .list-right span i{
            font-style: normal;
        }
        .list-right p{
            display: block;
            margin-top: 10px;
            color: #9e9e9e;
            height: 40px;
        }
        .btn-kaituan{
            padding: 5px 15px;
            border: 1px solid #ff668e;
            text-align: center;
            color: #ff658e;
            font-size: 14px;
            border-radius: 3px;
        }
        .btn-seeorder{
            padding: 5px 15px;
            border: 1px solid #ff668e;
            text-align: center;
            color: #ff658e;
            font-size: 14px;
            border-radius: 3px;
        }
        .btn-contikaituan{
            padding: 5px 15px;
            border: 1px solid #ff668e;
            text-align: center;
            color: #ff658e;
            font-size: 14px;
            border-radius: 3px;
        }
    </style>
    <link href="{pigcms{$static_path}css/groupbuy/tuan.css" rel="stylesheet"/>
</head>
<body id="index">
<div>
    <a class="my-account" href="{pigcms{:U('My/myinfo')}">
        <img src="{pigcms{$static_path}images/my-photo.png">
        <img class="avater" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像"/>
        <div class="user-info more more-weak">
            <p class="uname">{pigcms{$now_user.nickname}<i class="level-icon level0"></i></p>
            <p class="umoney">余额：<strong>{pigcms{$now_user.now_money}</strong> 元 &nbsp;&nbsp;&nbsp<span>积分：<strong>{pigcms{$now_user.score_count}</strong> 分</span></p>
            <p>等级：<php>if(isset($levelarr[$now_user['level']])){
                    $imgstr='';
                    if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">';
                    echo ' <strong>'.$levelarr[$now_user['level']]['lname'].'</strong>';
                    }else{echo '<strong>暂无等级</strong>';}</php></p>
        </div>
    </a>
</div>
<div id="tips" class="tips"></div>
<dl class="list" style="margin-top:10px;">
    <dd>
        <ul class="orderindex">
            <li><a href="{pigcms{:U('My/crowd_buy_list',array('status'=>1))}" class="react <if condition="$_GET['status'] eq 1">hover</if>">
                <i class="text-icon">⌺</i>
                <span>普通众筹</span>
                </a>
            </li><li><a href="{pigcms{:U('My/crowd_buy_list',array('status'=>0))}" class="react <if condition="$_GET['status'] eq 0">hover</if>">
                <i class="text-icon">⌸</i>
                <span>抽奖众筹</span>
                </a>
            </li>
        </ul>
    </dd>
</dl>
<div class="public-cen">
    <div class="pin-list-wx">
        <ul>
            <if condition="$group_buy_list">
                <volist name="group_buy_list" id="group_buy">
                    <li>
                        <a href="{pigcms{:U('Crowdfunding/detail',array('crowdid'=>$group_buy['crowd_id']))}">
                            <div class="list-wx-img" style="background-image: url({pigcms{$group_buy.webpic});">
                            </div>
                            <div class="list-right">
                                <h3>{pigcms{$group_buy.name}</h3>
                                <p>
                                    <span>价格：<i>&yen;{pigcms{$group_buy.price}</i>元</span>
                                </p>

                                    <a href="{pigcms{:U('My/crowdorder',array('order_id'=>$group_buy['corder_id']))}">
                                        <span class="btn-seeorder" data-url="{pigcms{:U('My/crowdorder',array('order_id'=>$group_buy['corder_id']))}">查看订单</span>
                                    </a>
                                    <a href="{pigcms{:U('My/delorder',array('order_id'=>$group_buy['corder_id']))}" >
                                        <span class="btn-seeorder">删除订单</span>
                                    </a>

                            </div>
                            <div style="clear: both;"></div>
			                <div style="width: 100%; text-align: right; padding: 5px 0px; ">
			            		<span >订单时间：<?php echo date("Y-m-d H:i:s",$group_buy['paytime']);?></span>
			            	</div>
                        </a>
                        <style>
                            .tuanzhang3{
                                position: absolute;
                                right: 160px;
                                top: 25px;
                                width: 60px;
                                height: 60px;
                            }
                            .tuanzhang3 img{
                                height:60px;
                            }
                        </style>

                        <if condition="$group_buy['is_lottery_order'] eq 1">


                            <if condition="$group_buy['lottery_confirm'] eq  1 ">
                                <switch name="group_buy.lottery">
                                  <case value="0" break="1">
                                      <div class="tuanzhang3">
                                          <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/lottery-failed.png" />
                                      </div>
                                  </case>
                                    <case value="1" >
                                        <div class="tuanzhang3">
                                            <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/pin-lottery.png" />
                                        </div>
                                    </case>
                                </switch>

                            <else/>
                        </if>
                        </if>
                        <div style="clear: both;"></div>
                    </li>
                </volist>
                <if condition ="$group_buy_list">

                    <else/>
                    <style>
                        .s_empty{
                            color: #999;
                            display: none;
                            height: 70px;
                            line-height: 70px;
                            text-align: center;
                            background: #f9f9f6;
                            background-color: none;
                        }

                    </style>
                    <div class="s_empty" style="display:block;">您暂时没有众筹</div>
                </if>
        </ul>
        <div style="clear: both;"></div>
    </div>


    <div class="cai" style="display: none;">
        <if condition="$category_group_list">
            <h3 class="cai-title">你可能会喜欢</h3>
            <ul>
                <volist name="category_group_list" id="group_tuijian">
                    <li>
                        <a href="/wap.php?g=Wap&amp;c=NewGroup&amp;a=detail&amp;group_id={pigcms{$group_tuijian['group_id']}">
                            <div class="car-img" style="background-image: url({pigcms{$group_tuijian['list_pic']})"></div>
                            <h3>
                                <if condition ="$group_buy_list">
                                    {pigcms{$group_tuijian['group_name']}
                                    <else/>{pigcms{$group_tuijian['name']}</if></h3>
                            <div class="car-price">
                                <b>¥{pigcms{$group_tuijian['price']}</b>
                            </div>
                        </a>
                    </li>
                </volist>
            </ul>


            <div style=" clear: both;">
            </div>
        </if>
    </div>
</div>
</body>
</html>