
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
			<title>{pigcms{$now_group.appoint_name}</title>
	<else/>
		 
			<title>【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.appoint_name}</title>
	</if>
	<meta name="description" content="{pigcms{$now_group.appoint_content}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>

		#enter_im_div {
		  bottom: 60px;
		  left:10px;
		  z-index: 11;
		  position: fixed;
		  width: 94px;
		  height:31px;
		}
		#enter_im {
		  width: 94px;
		  position: relative;
		  display: block;
		}
		a {
		  color: #323232;
		  outline-style: none;
		  text-decoration: none;
		}
		#to_user_list {
		  height: 16px;
		  padding: 7px 6px 8px 8px;
		  background-color: #00bc06;
		  border-radius: 25px;
		  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
		}
		#to_user_list_icon_div {
		  width: 20px;
		  height: 16px;
		  background-color: #fff;
		  border-radius: 10px;
		}
		
		.rel {
		  position: relative;
		}
		.left {
		  float: left;
		}
		.to_user_list_icon_em_a {
		  left: 4px;
		}
		#to_user_list_icon_em_num {
		  background-color: #f00;
		}
		#to_user_list_icon_em_num {
		  width: 14px;
		  height: 14px;
		  border-radius: 7px;
		  text-align: center;
		  font-size: 12px;
		  line-height: 14px;
		  color: #fff;
		  top: -14px;
		  left: 68px;
		}
		.hide {
		  display: none;
		}
		.abs {
		  position: absolute;
		}
		.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
		  width: 2px;
		  height: 2px;
		  border-radius: 1px;
		  top: 7px;
		  background-color: #00ba0a;
		}
		.to_user_list_icon_em_a {
		  left: 4px;
		}
		.to_user_list_icon_em_b {
		  left: 9px;
		}
		.to_user_list_icon_em_c {
		  right: 4px;
		}
		.to_user_list_icon_em_d {
		  width: 0;
		  height: 0;
		  border-style: solid;
		  border-width: 4px;
		  top: 14px;
		  left: 6px;
		  border-color: #fff transparent transparent transparent;
		}
		#to_user_list_txt {
		  color: #fff;
		  font-size: 13px;
		  line-height: 16px;
		  padding: 1px 3px 0 5px;
		}

/*刘畅 预约*/
.liu_appoint
{
    width:100%;
    background: #fff;
    display: inline-table;
}
.liu_appoint span
{
    height: 60px;
    display: table-row;
}
.liu_appoint span div
{
    border-left: 1px #eee solid;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    font-size: 16px;
    color:#37caad;
}
.liu_appoint span div h1{font-size: 16px;margin:0;color:#333;line-height: 20px;}
.liu_appoint span div h2{font-size: 16px;margin:0;color:#37caad;font-weight: normal;}
.liu_appoint span div a{display: block;height: 47px;padding-top: 13px; background: #F84848;color:#fff; font-size: 16px;}
.liu_appoint span div a b{font-size:12px;font-weight: normal;}
/*刘畅 - 套餐列表*/
.liu_appoint_list
{
    width: 100%;
    border-bottom: 1px #eee solid;
    overflow: hidden;
    background: #fff;
    display: inline-table;
}
.liu_appoint_list div
{
    width:100%;
    display: table-row;
}
.liu_appoint_list span
{
    padding:12.5px 10px;
    display: table-cell;
    border-top: 1px #eee solid;
    border-right: 1px #eee solid;
    height: 25px;
    line-height: 20px;
    color:#777;
    vertical-align: middle;
}
	</style>
</head>
<body id="index">
		<if condition="$now_group['end_time'] lt $_SERVER['REQUEST_TIME']">
			<div id="tips" class="tips" style="display:block;">真遗憾！这单预约已经结束</div>
		</if>
		<div id="deal" class="deal">
			<div class="list">
			    <div class="album view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>">
			        <img src="{pigcms{$now_group.all_pic.0.m_image}" alt="{pigcms{$now_group.merchant_name}"/>
                    <div class="desc">
                        <div class="desc_h1">{pigcms{$now_group.appoint_name}</div>
                        <div class="desc_p">{pigcms{$now_group.appoint_content}</div>
                    </div>
			    </div>
						<div class="liu_appoint">
                            <span>
                                <div style="width: 30%;">
                                <if condition="$now_group['payment_status'] eq 1">
                                    <h1>定金</h1>
                                    <h2>{pigcms{$now_group.payment_money}</h2>
                                <else/>
                                    免定金
                                </if>
                                </div>
                                <div style="width: 30%;">
                                    <h1>全价</h1>
                                    <h2>{pigcms{$now_group.appoint_price}</h2>
                                </div>
                                <div style="width: 40%;">
                                    <a href="{pigcms{:U('Appoint/order',array('id'=>$now_group['id']))}">
                                    <if condition="$now_group['appoint_type'] eq 1">上门<else/>到店</if>预约<br />
                                    <b>{pigcms{$now_group['count']}人预约</b>
                                    </a>
                                </div>
                            </span>
                        </div>
			<dl class="list">
                <volist name="now_group['store_list']" id="vo">
			     <include file="liuchang/moban/wap_store.php"/>
			    </volist>
			</dl>
			<if condition="count($now_group['appoint_taocan']) gt 0">
					<div class="liu_x_title liu_margin_top">
                        <h1>服务列表</h1>
                    </div>
                    <div class="liu_appoint_list">
                        <volist name="now_group['appoint_taocan']" id="val">
                            <div>
                                <span style="width: 70%;">{pigcms{$val.name}</span>
                                <span style="width: 30%;">￥{pigcms{$val.price}</span>
                            </div>
                        </volist>
                    </div>
                <div class="liu_list_body">
                    <a href="{pigcms{:U('Appoint/body',array('id'=>$now_group['id']))}">
                        <h1>显示图文详情</h1>
                    </a>
                </div>
            <else/>
                <div class="liu_list_body liu_margin_top">
                    <a href="{pigcms{:U('Appoint/body',array('id'=>$now_group['id']))}">
                        <h1>显示图文详情</h1>
                    </a>
                </div>
			</if>
           
			<div id="recommand">
				<if condition="$merchant_group_list">
							<dl class="list">
							     <div class="liu_x_title liu_margin_top liu_borderBottom">
                                    <h1>商家其他可预约项</h1>
                                 </div> 
							     <volist name="merchant_group_list" id="vo">
							     	   <include file="liuchang/moban/wap_appoint.php"/>
							     </volist>
							</dl>

			    </if>
                
                <if condition="$category_group_list">
							<dl class="list">
                            <div class="liu_x_title liu_borderBottom liu_margin_top">
                                <h1>看了本预约的用户还看了</h1>
                            </div>
							    <volist name="category_group_list" id="vo">
								    <include file="liuchang/moban/wap_appoint.php"/>
							     </volist>  
							</dl>
				        </dd>
				    </dl>
			    </if>
                
			</div>
		</div>
		<div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
			<a id="enter_im" data-url="{pigcms{$kf_url}">
				<div id="to_user_list">
					<div id="to_user_list_icon_div" class="rel left">
						<em class="to_user_list_icon_em_a abs">&nbsp;</em>
						<em class="to_user_list_icon_em_b abs">&nbsp;</em>
						<em class="to_user_list_icon_em_c abs">&nbsp;</em>
						<em class="to_user_list_icon_em_d abs">&nbsp;</em>
						<em id="to_user_list_icon_em_num" class="hide abs">0</em>
					</div>
					<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
				</div>
			</a>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script src="{pigcms{$static_path}js/appointlist.js"></script>
		<php>$no_footer = true;</php>
		<include file="Public:footer"/>
		
<script type="text/javascript">
$(document).ready(function(){
	var mousex = 0, mousey = 0;
	var divLeft = 0, divTop = 0, left = 0, top = 0;
	document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
		e.preventDefault();
		var offset = $(this).offset();
		divLeft = parseInt(offset.left,10);
		divTop = parseInt(offset.top,10);
		mousey = e.touches[0].pageY;
		mousex = e.touches[0].pageX;
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
		event.preventDefault();
		left = event.touches[0].pageX-(mousex-divLeft);
		top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
		if(top < 1){
			top = 1;
		}
		if(top > $(window).height()-(50+$(this).height())){
			top = $(window).height()-(50+$(this).height());
		}
		if(left + $(this).width() > $(window).width()-5){
			left = $(window).width()-$(this).width()-5;
		}
		if(left < 1){
			left = 1;
		}
		$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchend', function(event){
		if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		}
		return false;
	});

	$('#enter_im_div').click(function(){
		var url = $('#enter_im').attr('data-url');
		if (url == '' || url == null) {
			alert('商家暂时还没有设置客服');
		} else {
			location.href=$('#enter_im').attr('data-url');
		}
	});
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_group.all_pic.0.m_image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Appoint/detail', array('appoint_id' => $now_group['appoint_id']))}",
            "tTitle": "【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.appoint_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>