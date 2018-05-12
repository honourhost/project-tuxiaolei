<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>农小拼</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/newtuan.css"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/groupbuy/jquery-1.9.1.min.js"></script>
		<script type="text/javascript">
			var intDiff = parseInt({pigcms{$lefttime});//倒计时总秒数量
			function timer(intDiff){
			    window.setInterval(function(){
			    var day=0,
			        hour=0,
			        minute=0,
			        second=0;//时间默认值        
			    if(intDiff > 0){
			        hour = Math.floor(intDiff / (60 * 60)) - (hour * 24);
			        minute = Math.floor(intDiff / 60) - (hour * 60);
			        second = Math.floor(intDiff) -  (hour * 60 * 60) - (minute * 60);
			    }
			    if (hour <= 9) hour = '0' + hour;
			    if (minute <= 9) minute = '0' + minute;
			    if (second <= 9) second = '0' + second;
			    $('#hour_show').html('<s id="h"></s>'+hour);
			    $('#minute_show').html('<s></s>'+minute);
			    $('#second_show').html('<s></s>'+second);
			    $('#hour_show2').html('<s id="h"></s>'+hour);
			    $('#minute_show2').html('<s></s>'+minute);
			    $('#second_show2').html('<s></s>'+second);
			    intDiff--;
			    }, 1000);
			} 
			$(function(){
			    timer(intDiff);
			});    
       </script>
	   <style>
			.wx-ma{
				width: 180px;
				margin: 80px auto 20px auto;
				position: relative;
			}
			.wx-ma .ma-img{
				position: relative;
				width: 100%;
				left: 0;
				top: 0;
			}
			.wx-ma .user-img{
				position: absolute;
				width: 30px;
				height: 30px;
				top: 50%;
				margin-top: -15px;
				left: 50%;
				margin-left: -15px;
				overflow: hidden;
				border-radius: 5px;
			}
			.circleimg{
				width: 30px;
				height: 30px;
				border-radius: 30px;
			}
		</style>
	</head>
	<body>
		<!-- 拼团介绍 -->
		<div class="tuan-jieshao">
			<a href="{pigcms{:U('GroupBuy/introduction')}"><img src="{pigcms{$static_path}img/icon-pin.png" /></a>
		</div>
		<div class="public-cen">
			<!-- 顶部弹窗，前往购买 -->
			<div class="header-go">
				<span><a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$newest_groupbuy[0]['group_id']))}">前往购买</a></span>
				<img src="{pigcms{$newest_groupbuy.0.list_pic}" />
				<h3>{pigcms{$newest_groupbuy.0.group_name}</h3>
			</div>
			<div class="header-go-kong"></div>
			<div class="pin-header" onClick="window.location.href='http://www.xiaonongding.com/wap.php?g=Wap&c=NewGroup&a=detail&group_id={pigcms{$group_buy.group_id}'">
				<div class="left shop-img" style="background-image: url({pigcms{$now_group.all_pic.0.m_image});">
				</div>
				<h3 >{pigcms{$now_group.s_name}</h3>
				<p >{pigcms{$group_buy.need_num}人团：<span>&yen;<i>{pigcms{$now_group['price']}</i></span>/件</p>
				<div style="clear: both;"></div>
				<if condition="$group_buy['status'] eq 1">
				<div class="pin-zt">
					<img src="{pigcms{$static_path}img/pin-cg.png" />
				</div>
				</if>
			</div>
			<!-- tuan 内容 -->
			<div class="pin-pr">
				<div class="pin-pr-con">
					<volist name="users" id="user" key="k">
                	<if condition="$k eq 1">
                    <a>
                        <img src="<php>echo getAvatar($user['uid']);</php>" />
                        <span>团长</span>
                    </a>
                    <else/>
                    <a>
                        <img src="<php>echo getAvatar($user['uid']);</php>" />
                    </a>
                	</if>
            		</volist>					
				</div>
					
				<div style="clear: both;"></div>
				<p class="pin-p">还差<span><php>echo $group_buy['need_num']-$group_buy['react_num'];</php></span>人，盼你如南方人盼暖气~</p>
				<div class="pin-icon" style="display: none;">
					<img src="{pigcms{$static_path}img/icon-pin.png" />
				</div>
				<div class="pin-time">
					<span class="time-line"></span>
					<div class="pin-time-djs">
						<label>剩余：</label>
						<span id="hour_show">00</span>&nbsp;:
					    <span id="minute_show">00</span>&nbsp;:
					    <span id="second_show">00</span>
						<label>结束</label>
					</div>
				</div>
					<div class="wx-ma">
					<img class="ma-img" src=" {pigcms{:U('GroupBuy/qrpng',array('groupid'=>$now_group['group_id']))}">
					<img class="circleimg user-img" src="http://www.xiaonongding.com/xnd.png">
					<p> 分享二维码，邀请好友开团</p>
				</div>
				<div class="fenxiang-btn">
					<if condition="$now_group.is_lottery_group_buy eq 1">
						<a class="dianji">赶快邀请你的小伙伴一起来抽奖吧！</a>
						<else/>
						<a class="dianji">赶快邀请你的小伙伴一起来拼团吧！</a>
					</if>

				</div>
				<div class="open-pin">查看全部拼团详情<i id="show_all"></i></div>
				<div class="up-pin">收起全部拼团详情<i id="show_all-up"></i></div>
				<div style="clear: both;"></div>
				<div class="sanjiao">
					<img src="{pigcms{$static_path}img/sans.png" />
				</div>
				<div class="tuan-main">
					<div class="tuan" style="margin-top: 20px;">
						<span class="right time"><php>echo date("Y-m-d H:i:s",$group_buy['create_time']);</php>开团</span>
						<div class="fqr">
							<span>
								<img src="<php>echo getAvatar($group_buy['user_id']);</php>" />
							</span>
							<h3>团长&nbsp;{pigcms{$first.nickname}</h3>
						</div>
					</div>
						<if condition="$now_group.is_lottery_group_buy eq 1">
						<div class="tuan" style="margin-top: 20px;">
							<span class="right time"></span>
							<div class="fqr">
							<span>
								<img src="{pigcms{$lottery.avatar}" />
							</span>
								<h3>中奖者&nbsp;{pigcms{$lottery.nickname}</h3>
							</div>
						</div>
						</if>
					<span class="line-tuan"></span>
				</div>
				<div class="tuan-main">
					<volist name="users" id="user" key="k">
                    <div class="tuan ct-tuan">
							<if condition="$lottery['uid'] eq $user[uid]">
							<span class="right time ct-time"><php>echo '中奖者 '.date("Y-m-d H:i:s",$user['add_time']);</php> 参团</span>
							<else/>
							<span class="right time ct-time"><php>echo date("Y-m-d H:i:s",$user['add_time']);</php> 参团</span>

						</if>
						<div class="cantuan">
							<span>
								<img src="<php>echo getAvatar($user['uid']);</php>" />
							</span>
							<h3><php>echo getUserName($user['uid']);</php></h3>
						</div>
					</div>
            		</volist>
					
					<span class="line-tuan"></span>
				</div>
			</div>
			
			<!-- 猜你喜欢 -->
			<div class="cai">
				<h3 class="cai-title">你可能会喜欢</h3>
				<if condition="$category_group_list">
            	<ul>
                <volist name="category_group_list" id="onegroup">
                <li>
                        <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$onegroup['sun_id']))}">
                            <div class="car-img" style="background-image: url({pigcms{$onegroup.list_pic});"></div>
                            <h3>{pigcms{$onegroup.group_name}</h3>
                            <div class="car-price">
                                <b>&yen;{pigcms{$onegroup.price}</b>
                            </div>
                        </a>
                    </li>
                </volist>
            </ul>
            <else/>
            <ul>
                <li>
                    <p>暂时还没有推荐拼团...</p>
                </li>
            </ul>
        	</if>
				<div style=" clear: both;"></div>
			</div>
			<div class="pin-wanfa">
				<h3>
					<a href="{pigcms{:U('GroupBuy/more')}">
						<span>查看详情<img src="{pigcms{$static_path}img/more.png" /></span>
					</a>
					拼团玩法
				</h3>
				<ul>
					<li>
						<i>1</i>
						<span>选择<br />心仪商品</span>
					</li>
					<li>
						<i>2</i>
						<span>支付开团<br />或参团</span>
					</li>
					<li>
						<i>3</i>
						<span>等待好友<br />参团支付</span>
					</li>
					<li>
						<i>4</i>
						<span>达到人数<br />参团成功</span>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div style="width: 100%; height: 80px;"></div>
			<div class="pin-footer">
				<span class="footer-bg"></span>
					<a class="btn-more left" href="{pigcms{:U('GroupBuy/lists')}"><img src="{pigcms{$static_path}img/icon-more.png" />更多拼团</a>
				<if condition="$group_buy[status] eq 0">
					<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
						<switch name="$now_group['is_lottery_group_buy']">
							<case value="1"><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id'],'sun_id'=>$group_buy['sun_id']))}">我也要抽奖</a></case>
							<case value="0"><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id'],'sun_id'=>$group_buy['sun_id']))}">我也要参团</a></case>
							<default /><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id'],'sun_id'=>$group_buy['sun_id']))}">我也要参团</a>
						</switch>

					<else/>
						<a class="btn-bao right" >已售罄</a>
					</if>



					<else/>

					<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
						<switch name="$now_group['is_lottery_group_buy']">
							<case value="1"><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id']))}">我也要抽奖</a></case>
							<case value="0"><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id']))}">我也要开团</a></case>
							<default /><a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id']))}">我也要开团{pigcms{$now_group['is_lottery_group_buy']}</a>
						</switch>

						<else/>
						<a class="btn-bao right" >已售罄</a>
					</if>

					</if>




			</div>
		</div>
		<!-- 右侧返点顶部 -->
		<div class="top-tz">
			<a href="#"><span style="background-image: url({pigcms{$static_path}img/go_top.png);">顶部</span></a>
		</div>
		<!-- 弹出层微信分享 -->
		<div class="weixinfx">
			<div class="weixinfx-bg"></div>
			<div class="weixinfx-img">
				<img src="{pigcms{$static_path}img/fenxiang.png" />
			</div>
		
		<script type="text/javascript">
			$(document).ready(function(){
			  $(".open-pin").click(function(){
			  $(".up-pin").show();
			  $(".open-pin").hide();
			  $(".tuan-main").show();
			  $(".sanjiao").show();
			  });
			  $(".up-pin").click(function(){
			  $(".open-pin").show();
			  $(".up-pin").hide();
			  $(".tuan-main").hide();
			  $(".sanjiao").hide();
			  });
			  $(".dianji").click(function(){
			  $(".weixinfx").show();
			  });
			  $(".weixinfx").click(function(){
			  $(".weixinfx").hide();
			  });
			});
		</script>
		</div>
			<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$now_group.all_pic.0.m_image}", 
						link: "{pigcms{$config.site_url}{pigcms{:U('GroupBuy/show', array('sun_id' => $_GET['sun_id']))}",
						title: <if condition="$now_group['is_lottery_group_buy'] eq 1">'{pigcms{$username}邀你试手气，价值{pigcms{$now_group.price}等你拿！'<else/><if condition="$username">'{pigcms{$username}喊你一起买"{pigcms{$now_group.s_name}"，仅售{pigcms{$now_group.price}元！'<else/>'小农丁喊你一起买"{pigcms{$now_group.s_name}"，仅售{pigcms{$now_group.price}元！'</if></if>,
						desc: <if condition="$now_group['is_lottery_group_buy'] eq 1">'{pigcms{$username}正在拼颜值，你来么~'<else/>"我在农小拼等你一起拼团！{pigcms{$now_group.group_name}"</if>
			};
		</script>
		 <include file="Share:share"/>
	
	</body>
</html>
