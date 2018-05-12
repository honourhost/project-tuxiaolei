<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>特卖详情</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/detail.css?210"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?448"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?212" charset="utf-8"></script>
		<script type="text/javascript"><if condition="$long_lat">var user_long = "{pigcms{$long_lat.long}",user_lat = "{pigcms{$long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/detail.js?215" charset="utf-8"></script>
		<script>
			function lazyLoad(){
				$.ajax({
					type:'POST',
					url:"{pigcms{:U('Group/getContent')}",
					data:{id:{pigcms{$now_group.group_id}},
					dataType:"html",
					success:function(data){
						$("#content").html(data);
					},
				});
			}
		</script>
		<style>
			.con-more{
				display: block;
				width: 80%;
				height: 40px;
				text-align: center;
				line-height: 40px;
				margin: 0px auto;
				font-size: 14px;
				text-decoration: underline;
			}
			.con-more:hover{
				text-decoration: underline;
			}
			.con-shop-list{
							
						}
						.con-shop-list li{
							width: 100%;
							border-bottom: 1px solid #f4f4f4;
							padding: 5px 0px;
						}
						.con-shop-img{
							width: 45px;
							height: 45px;
							float: left;
							overflow: hidden;
							margin-right: 5px;
						}
						.con-shop-img img{
							width: 45px;
							height: 45px;
							border-radius: 45px;
						}
						.con-shop-title{
							float: left;
							line-height: 0px;
							width: 60%;
							overflow: hidden;
						}
						.con-shop-title h3{
							font-size: 14px;
							font-weight: normal;
							display: block;
							height: 20px;
							line-height: 20px;
							overflow: hidden;
							margin-bottom: 5px;
							position: relative;
							top: -10px;
							
						}
						.con-shop-title span{
							font-size: 12px;
							color: #C6C6C6;
							position: relative;
							top: -5px;
						}
						.con-price{
							float: right;
							text-align: right;
							line-height: 40px;
							font-size: 18px;
							color: red;
						}
						.con-page{
							width: 100%;
							text-align: center;
							padding-top: 5px;
						}
						.con-page a{
							display: block;
							float: left;
							width: 100%;
						}
						.con-page .page-lf{
							width: 35%;
							text-align: right;
						}
						.con-page .page-c{
							width: 30%;
							text-align: center;
						}
						.con-page .page-rg{
							width: 35%;
							text-align: left;
						}
		</style>
	</head>
	<body onload="lazyLoad();">
		
		<div id="container">
			<div id="scroller">
				<div id="pullDown" style="background-color:#06c1ae;color:white;">
					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIcon" style="margin-right:10px;vertical-align:middle;"></i>{pigcms{$config.wechat_name} 精心为您优选</span>
				</div>
				<section class="imgBox">
					<img src="{pigcms{$now_group.all_pic.0.m_image}" class="view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>"/>
					<div class="imgCon">
						<div class="title">{pigcms{$now_group.s_name}</div>
						<div class="desc">{pigcms{$now_group.group_name}</div>
					</div>
					<div class="back"></div>
				</section>
				<section class="buyBox">
					<div class="priceDiv">
						<span class="price">￥<strong>{pigcms{$now_group['price']}</strong><span class="old">￥<del>{pigcms{$now_group.old_price}</del></span></span>
						<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
							<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">立即购买</a>
						</if>
					</div>
					<if condition="$now_group['wx_cheap']">
						<div class="cheapDiv">优惠 <span class="tag">微信购买再减{pigcms{$now_group.wx_cheap}元</span></div>
					</if>
					<div class="saleDiv">
						<span><i class="yesLightIcon"></i>随时退</span>
						<span><i class="yesLightIcon"></i>过期退</span>
						<span class="sale"><i class="yesIcon"></i>已售{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</span>
					</div>
				</section>
				<if condition="!empty($reply_list)">
					<section class="scoreBox link-url" data-url="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">
						<div class="rateInfo">
							<div class="starIconBg"><div class="starIcon" style="width:{pigcms{$now_group['score_mean']*20}%;"></div></div>
							<div class="starText">{pigcms{$now_group.score_mean}</div>
							<div class="right">{pigcms{$now_group.reply_count} 人评价</div>
						</div>
					</section>
				</if>
				<section class="storeBox">
					<dl class="storeList">
						<volist name="now_group['store_list']" id="vo" offset="0" length="2">
							<dd class="link-url" data-url="{pigcms{:U('Group/shop',array('store_id'=>$vo['store_id']))}">
								<div class="name">{pigcms{$vo.name}</div>
								<div class="address">{pigcms{$vo.area_name}{pigcms{$vo.adress}</div>
								<if condition="$vo['range']"><div class="position"><div class="range">{pigcms{$vo.range}</div><if condition="$i eq 1"><div class="desc">离我最近</div></if></div></if>
								<div class="phone" data-phone="{pigcms{$vo.phone}"></div>
							</dd>
						</volist>
					</dl>
					<if condition="count($now_group['store_list']) gt 2">
						<div class="more link-url" data-url="{pigcms{:U('Group/branch',array('group_id'=>$now_group['group_id']))}">全部{pigcms{:count($now_group['store_list'])}家分店</div>
					</if>
				</section>
				<style>
				 .del-tongzhi img{
				 	width: 100%;
				 }
				</style>
				<section class="detail introList">
					<div class="titleDiv"><div class="title">本单详情</div></div>
					<div class="del-tongzhi" style="display:none; margin:0px 13px 0px 0px; text-align: center; padding: 20px 0px 0px 0px;">
						<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/tongzhi.jpg">
					</div>
					<a class="con-more" onclick="lazyLoad()">展开详情</a>
					<div class="content" id="content" style="display: none;">
                    
                    </div> 
				</section>
				<if condition="$now_group['cue_arr']">
					<section class="term introList">
						<div class="titleDiv"><div class="title">购买须知</div></div>
						<div class="content">
							<ul>
								<volist name="now_group['cue_arr']" id="vo">
									<if condition="$vo['value']">
										<li><b>{pigcms{$vo.key}：</b>{pigcms{$vo.value|nl2br=###}</li>
									</if>
								</volist>
							</ul>
						</div> 
					</section>
				</if>
				<if condition="!empty($reply_list)">
					<section class="comment introList">
						<div class="titleDiv"><div class="title">评价<div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:{pigcms{$now_group['score_mean']*20}%;"></div></div><div class="starText">{pigcms{$now_group.score_mean}</div></div><div class="right">{pigcms{$now_group.reply_count} 人评论</div></div></div>
						<dl>
							<volist name="reply_list" id="vo">
								<dd>
									<div class="titleBar">
										<div class="nickname">{pigcms{$vo.nickname}</div><div class="dateline">{pigcms{$vo.add_time}</div><div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:{pigcms{$vo['score']*20}%;"></div></div></div>
									</div>
									<div class="replyCon">
										<div class="textDiv">
											<div class="text">{pigcms{$vo.comment}</div>
										</div>
										<if condition="$vo['pics']">
											<ul class="imgList" data-pics="<volist name="vo['pics']" id="voo">{pigcms{$voo.m_image}<if condition="count($vo['pics']) gt $i">,</if></volist>">
												<volist name="vo['pics']" id="voo">
													<li><img src="{pigcms{$voo.s_image}"/></li>
												</volist>
											</ul>
										</if>
									</div>
								</dd>
							</volist>
						</dl>
						<if condition="$now_group['reply_count'] gt 3">
							<div class="more link-url" data-url="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">查看全部 {pigcms{$now_group.reply_count} 条评价</div>
						</if>
					</section>
				</if>
				<if condition="$merchant_group_list">
					<section class="storeProList introList">
						<div class="titleDiv"><div class="title">商家其他{pigcms{$config.group_alias_name}</div></div>
						<ul class="goodList">
							<volist name="merchant_group_list" id="vo">
								<li class="link-url" data-url="{pigcms{$vo.url}" <if condition="$i gt 2">style="display:none;"</if>>
									<div class="dealcard-img imgbox">
										<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.name}"/>
									</div>
									<div class="dealcard-block-right">
										<div class="title">{pigcms{$vo.group_name}</div>
										<div class="price">
											<strong>{pigcms{$vo['price']}</strong><span class="strong-color">元</span><if condition="$vo['wx_cheap']"><span class="tag">微信再减{pigcms{$vo.wx_cheap}元</span></if><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span>
										</div>
									</div>
								</li>
							</volist>
							<if condition="count($merchant_group_list) gt 2"><li class="more">其他{pigcms{:count($merchant_group_list)-2}个{pigcms{$config.group_alias_name}</li></if>
						</ul>
					</section>
				</if>
				<if condition="$category_group_list">
					<section class="sysProList introList">
						<div class="titleDiv"><div class="title">看了本{pigcms{$config.group_alias_name}的用户还看了</div></div>
						<dl class="likeBox dealcard">
							<volist name="category_group_list" id="vo">
								<dd class="link-url" data-url="{pigcms{$vo.url}">
									<div class="dealcard-img imgbox">
										<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.name}"/>
									</div>
									<div class="dealcard-block-right">
										<div class="brand"><if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}<else/>{pigcms{$vo.s_name}</if><span class="location-right">28米</span></div>
										<div class="title">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
										<div class="price">
											<strong>{pigcms{$vo['price']}</strong><span class="strong-color">元</span><if condition="$vo['wx_cheap']"><span class="tag">微信再减{pigcms{$vo.wx_cheap}元</span></if><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span>
										</div>
									</div>
								</dd>
							</volist>
						</dl>
					</section>
				</if>
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$static_path}img/xnd-logo.png" style="height:50px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<div class="positionDiv">
			<div class="left"><div class="back"></div></div>
			<if condition="$now_group['tuan_type'] neq 2">
				<div class="center">{pigcms{$now_group.merchant_name}</div>
			</if>
			<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
				<div class="right">
					<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">购买</a>
				</div>
			</if>
		</div>
		
		<script type="text/javascript">
			$(document).ready(function(){
			  $(".con-more").click(function(){
			  $(".content").show();
			  $(".con-more").hide();
			  });
			});
		</script>
		<include file="Public:footer"/>
		
		<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$now_group.all_pic.0.m_image}", 
						<if condition="$_SESSION['share_distribution_id']">
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['share_distribution_id']))}",
						<elseif condition="$_SESSION['distribution_id']"/>
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['distribution_id']))}",
						<else/>
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}",
						</if>
						title: "<if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.merchant_name}<else/>{pigcms{$now_group.s_name}</if> {pigcms{$now_group.group_name}",
						desc: "{pigcms{$now_group.group_name}"
			};
		</script>
		 <include file="Public:share"/>
	</body>
</html>