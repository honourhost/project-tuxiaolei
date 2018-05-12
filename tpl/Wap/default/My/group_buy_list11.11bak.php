<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>拼团列表</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
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
					<li><a href="{pigcms{:U('My/group_buy_list',array('status'=>1))}" class="react <if condition="$_GET['status'] eq 1">hover</if>">
						<i class="text-icon">⌺</i>
						<span>已参加正在进行的拼团</span>
					</a>
					</li><li><a href="{pigcms{:U('My/group_buy_list',array('status'=>-1))}" class="react <if condition="$_GET['status'] neq 1">hover</if>">
						<i class="text-icon">⌸</i>
						<span>已经结束的拼团</span>
					</a>
					</li>
				</ul>
			</dd>
		</dl>
		<div class="public-cen">
	    <div class="tuan-list" style="display: none;">
	        <ul>
	            <if condition="$group_buy_list">
	                <volist name="group_buy_list" id="group_buy">
	                    <li>
	                        <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$group_buy['sun_id']))}">
	                            <div class="tuan-list-img" style="background-image: url({pigcms{$group_buy.list_pic});"></div>
	                            <h3>{pigcms{$group_buy.group_name}</h3>
	                            <div class="tuan-list-foot">
	                                <span class="right tuan-btn">查看<img src="{pigcms{$static_path}images/groupbuy/jiantou.png" /></span>
	                                <span class="left num"><img src="{pigcms{$static_path}images/groupbuy/tuan.png">{pigcms{$group_buy.need_num}人团</span>
	                                <span class="left price">&yen;<i>{pigcms{$group_buy.price}</i></span>
	                                <del class="left old-price">单买价：&yen;<php>echo getGroupPrice($group_buy['related_id']);</php></del>
	                            </div>
	                            <div style="clear: both;"></div>
	                        </a>
	                    </li>
	                </volist>
	        </ul>
	        <div style="clear: both;"></div>
	    </div>
        <div class="pin-list-wx">
			<ul>
				 <if condition="$group_buy_list">
            <volist name="group_buy_list" id="group_buy">
				<li>
					<a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$group_buy['sun_id']))}">
						<div class="list-wx-img" style="background-image: url({pigcms{$group_buy.list_pic});">
						</div>
						<div class="list-right">
							<h3>{pigcms{$group_buy.group_name}</h3>
							<p>
								<span>{pigcms{$group_buy.need_num}人团：<i>&yen;{pigcms{$group_buy.price}</i>元</span>
							    <del>单买价：&yen;<php>echo getGroupPrice($group_buy['related_id']);</php></del>
							</p>
							<span class="btn-kaituan">邀约好友参团</span>
						</div>
					</a>
					<div style="clear: both;"></div>
				</li>
				 </volist>
			</ul>
			<div style="clear: both;"></div>
		</div>
		
		
		<div class="cai">
          <if condition="$category_group_list">
				<h3 class="cai-title">你可能会喜欢</h3>
				<ul>
					 <volist name="category_group_list" id="group_tuijian">
					 <li>
							<a href="/wap.php?g=Wap&amp;c=NewGroup&amp;a=detail&amp;group_id={pigcms{$group_tuijian['group_id']}">
								<div class="car-img" style="background-image: url({pigcms{$group_tuijian['list_pic']})"></div>
								<h3>{pigcms{$group_tuijian['group_name']}</h3>
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