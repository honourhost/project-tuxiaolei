<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<if condition="$now_group['tuan_type'] neq 2">
			<title>{pigcms{$now_group.merchant_name}</title>
		<else/>
			<title>{pigcms{$now_group.group_name}</title>
		</if>
	<else/>
		<if condition="$now_group['tuan_type'] neq 2">
			<title>【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.s_name}</title>
		<else/>
			<title>【{pigcms{$now_group.group_name}】{pigcms{$now_group.s_name}</title>
		</if>
	</if>
	<meta name="description" content="{pigcms{$now_group.intro}">
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
		.swiper-slide{
			display: -webkit-box;
			display: -ms-flexbox;
			overflow: hidden;
			-webkit-box-align: center;
			-webkit-box-pack: center;
			-ms-box-align: center;
			-ms-flex-pack: justify;
		}
		.swiper-slide img{
			width:auto;
			height:auto;
			max-width:100%;
			max-height:90%;
		}
		.swiper-pagination{
			left: 0;
			top: 10px;
			text-align: center;
			bottom:auto;
			right:auto;
			width:100%;
		}
		.swiper-close{
			right:10px;
			top:5px;
			text-align:right;
			position:absolute;
			z-index:21;
			color:white;
			font-size:.7rem;
		}

		
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
        /*刘畅 详情表格距离修正*/
        .group_content p
        {
            margin: 10px 0 0 0;
        }
	</style>
	
</head>
<body id="index">
		<div id="deal" class="deal">
			<div class="list">
			    <div class="album view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>">
			        <img src="{pigcms{$now_group.all_pic.0.m_image}" alt="{pigcms{$now_group.merchant_name}"/>
			        <div class="desc">
                        <div class="desc_h1"><if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.merchant_name}<else/>{pigcms{$now_group.s_name}</if></div>
                        <div class="desc_p">{pigcms{$now_group.intro}</div>
                    </div>
			    </div>
                
                <!--刘畅 新增 小图标-->
                <div class="liu_group_ico liu_group_ico_ht liu_group_ico_kj " style="left: 15px;" onclick="javascript:history.go(-1);"></div>
                <div id="shoucang" class="liu_group_ico <if condition="$now_group['is_collect']">liu_group_ico_sc_on<else/>liu_group_ico_sc</if> liu_group_ico_kj " style="right: 15px;" fav-type="group_detail" fav-id="{pigcms{$now_group.group_id}"></div>
                
			    <dl class="list list-in">
			        <dd class="dd-padding buy-price" id="buy_box">
			            <div class="price">
			                <strong class="J_pricetag strong-color">{pigcms{$now_group['price']}</strong>
			                <space></space>
							<del class="group_del">{pigcms{$now_group.old_price}</del>
			            </div>
						
							<a class="liu_group_an" 
                                <if condition="$now_group['goumai'] eq 1">
                                    href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}"
                                <else/>
                                    href="javascript:void(0);" style="background: #bbb;"
                                </if>
                            >
                                {pigcms{$now_group.goumai_an}
                            </a>
						</if>
			        </dd>

					<if condition="$now_group['wx_cheap']">
						<ul class="campaign-tip dd-padding liu_borderTop">
							<li class="campaign">
								<span style="color:#777">优惠</span>&nbsp;&nbsp;&nbsp; <span class="tag">微信购买再减 {pigcms{$now_group.wx_cheap} 元</span>
							</li>
						</ul>
					</if>
                    <if condition="$now_group['count_num'] gt 0">
						<ul class="campaign-tip dd-padding liu_borderTop">
							<li class="campaign">
								<span style="color:#777">数量</span>&nbsp;&nbsp;&nbsp; 还剩 <b>{pigcms{$now_group.count_shengyu}</b> 件
							</li>
						</ul>
					</if>
                    <if condition="($now_group['once_max'] gt 0) or ($now_group['once_min'] gt 1)"> <!--每人最少购买1件时，不显示-->
						<ul class="campaign-tip dd-padding liu_borderTop">
							<li class="campaign">
								<span style="color:#777">限购</span>&nbsp;&nbsp;&nbsp; <if condition="$now_group['once_max'] gt 0">每人 <b>{pigcms{$now_group.once_max}</b> 件 &nbsp;&nbsp;</if><if condition="$now_group['once_min'] gt 1"> 起售 <b>{pigcms{$now_group.once_min}</b> 件</if>
							</li>
						</ul>
					</if>
                    
					<ul class="campaign-tip dd-padding liu_borderTop">
    					<li class="campaign">
    					   <span style="color:#777">日期</span>&nbsp;&nbsp;&nbsp; {pigcms{$now_group.begin_time|date='Y/m/d',###}&nbsp;&nbsp;至&nbsp;&nbsp;{pigcms{$now_group.end_time|date='Y/m/d',###}
    					</li>
					</ul>
                    <if condition="($now_group['tuan_type'] neq 2)"><!--实物不显示-->
                        <ul class="campaign-tip dd-padding liu_borderTop">
        					<li class="campaign">
        					   <span style="color:#777">使用</span>&nbsp;&nbsp;&nbsp; 截止到 {pigcms{$now_group.deadline_time|date='Y/m/d',###}
        					</li>
    					</ul>
                    </if>
			        <div class="liu_kj liu_group_bao liu_borderTop">
                        <p>随时退</p>
			            <p>过期退</p>    
			            <p class="liu_shouchu">已售{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</p>

			            <!--<ul class="btn-line">
			                <li><a class="btn btn-weak btn-block" data-com="share" data-share-text="在{pigcms{$config.site_name}发现一个不错的{pigcms{$config.group_alias_name}哦，您也来看看吧。仅售{pigcms{$now_group['price']-$now_group['wx_cheap']}元!{pigcms{$now_group.merchant_name}" data-share-pic="{pigcms{$now_group.all_pic.0.m_image}"><i class="text-icon icon-share"></i>  分享</a>
			                </li><li><a class="js-fav-btn btn btn-weak btn-block <if condition="$now_group['is_collect']">faved</if>" fav-type="group_detail" fav-id="{pigcms{$now_group.group_id}"><i class="text-icon icon-star"></i><i class="text-icon icon-star-empty"></i><span class="fav-text"></span></a>
			            </li>
			            </ul>-->
			        </div>
	
			    </dl>
			</div>
            <if condition="!empty($reply_list)">
                <div class="liu_list_body liu_margin_top">
                    <a href="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">
                        <div class="liu_pingjia">
                            <div class="liu_dxx"><span style="width:{pigcms{$now_group['score_mean']/5*100}%"></span></div>
                            &nbsp;{pigcms{$now_group['score_mean']}分
                        </div>  
                        <h2>{pigcms{$now_group.reply_count}条评价</h2>
                    </a>
                </div>
            </if> 
			<dl class="list">
                <volist name="now_group['store_list']" id="vo">
			     <include file="liuchang/moban/wap_store.php"/>
			    </volist>
			</dl>
            <if condition="$user">
                <div class="liu_x_title liu_margin_top">
                    <h1>组个团吧 <b>购买后未消费的用户</b></h1>
                </div>
                <div class="liu_kj liu_group_user">
                    <volist name="user" id="vo">
                        <a href="{pigcms{$liao_url}{pigcms{$vo['openid']}" <if condition="$i gt 4">style="display: none;"</if>>
                            <img src="{pigcms{$vo['avatar']}">
                            <h1>{pigcms{$vo['nickname']}</h1>
                        </a>
					</volist>
                </div>
                <php>if($i > 4){</php>
                <div class="liu_kj_center liu_borderTop" onclick="liu_group_user()" id="group_user_g">点击展开更多</div>
                <php>}</php>
                <script>
                    //控制头像列表高度
                    function liu_group_user(res)
                    {
                        $('.liu_group_user a').show();
                        $('#group_user_g').hide();
                    }
                </script>
                
            </if>
			<if condition="$now_group['cue_arr']">
				<dl id="deal-terms" class="list">
                    <div class="liu_x_title liu_borderBottom">
                         <h1>购买须知</h1>
                    </div>
					<dd>
						<dl>
							<dd class="liu_group_xz">
									<volist name="now_group['cue_arr']" id="vo">
										<if condition="$vo['value']">
											<p><b>{pigcms{$vo.key}：</b>{pigcms{$vo.value|nl2br=###}</p>
										</if>
									</volist>
							</dd>
						</dl>
					</dd>
				</dl>
			</if>
            <if condition="$table">
    			<dl id="deal-details" class="list">
    			    <div class="liu_x_title">
                        <h1>套餐</h1>
                    </div>
                    <dd class="group_content">
                        {pigcms{$table}{pigcms{$table_money}
                    </dd>
    			</dl>
                <div class="liu_list_body">
                    <a href="{pigcms{:U('Group/body',array('group_id'=>$now_group['group_id']))}">
                        <h1>显示图文详情</h1>
                    </a>
                </div>
            <else/>
                <div class="liu_list_body liu_margin_top">
                    <a href="{pigcms{:U('Group/body',array('group_id'=>$now_group['group_id']))}">
                        <h1>显示图文详情</h1>
                    </a>
                </div>
            </if>
            
			<if condition="!empty($reply_list)">
				<dl class="list" id="deal-feedback">
                    <div class="liu_x_title liu_borderBottom">
                          <h1>评价</h1>
                          <div class="liu_right">
                                <div class="liu_pingjia">
                                    <div class="liu_xxx"><span style="width:{pigcms{$now_group['score_mean']/5*100}%"></span></div>
                                    &nbsp;{pigcms{$now_group['score_mean']}分
                                </div>
                          </div>
                     </div>
					<dd>
						<dl>
							<volist name="reply_list" id="vo">
								<include file="liuchang/moban/wap_qingjia.php"/>
							</volist>
						</dl>
					</dd>
					<if condition="$now_group['reply_count'] gt 3">
                        <div class="liu_list_body liu_borderTop">
                            <a href="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">
                                <h1>查看全部{pigcms{$now_group.reply_count}条评价</h1>
                            </a>
                        </div>
					</if>
				</dl>
			</if>
			<div id="recommand">
				<if condition="$merchant_group_list">
							<dl class="list">
							     <div class="liu_x_title liu_borderBottom liu_margin_top">
                                    <h1>商家其他{pigcms{$config.group_alias_name}</h1>
                                 </div>
							     <volist name="merchant_group_list" id="vo">
								     <include file="liuchang/moban/wap_group_x.php"/>
							     </volist>
							</dl>
			    </if>
			    <if condition="$category_group_list">
							<dl class="list">
                            <div class="liu_x_title liu_borderBottom liu_margin_top">
                                <h1>看了本{pigcms{$config.group_alias_name}的用户还看了</h1>
                            </div>
							    <volist name="category_group_list" id="vo">
								    <include file="liuchang/moban/wap_group.php"/>
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
		<script>var static_path="{pigcms{$static_path}";var collect_url="{pigcms{:U('Collect/collect')}";var group_id="{pigcms{$now_group.group_id}";</script>
		<script src="{pigcms{$static_path}js/group_detail.js"></script>
		<include file="Public:footer"/>
		
<script type="text/javascript">
$(document).ready(function(){
    
                                            //刘畅 评价遍历 隐藏或显示展开 取外框架和内框架的高度对比，如果没有外框架大，说明字数没有超过，就要隐藏”展开“标识
                                            $(".comment_kj").each(function()
                                            {
                                                height_kj=$(this).find("div").height();
                                                height_p=$(this).find("p").height();
                                                height=height_p - height_kj;
                                                
                                                if(height < 10)
                                                {
                                                    $(this).find("i").hide();
                                                }
                                            })
                                            
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

                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_group.all_pic.0.m_image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}",
            "tTitle": "【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.s_name}",
            "tContent": ""
};
</script>

</body>
</html>