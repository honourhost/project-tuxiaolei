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
		<script type="text/javascript" src="{pigcms{$static_path}js/detail.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js" charset="utf-8"></script>
		<style>
				.wx-btn {
				display: block;
				width: 80%;
				height: 40px;
				line-height: 40px;
				text-align: center;
				font-size: 16px;
				color: #fff;
				background: #ff7f1a;
				margin: 3% auto 0;
			}
			.wx-btn:hover{
				color:#fff;
			}
			.con-more{
				display: block;
				text-align: center;
				line-height: 20px;
				margin: 0px auto;
				font-size: 16px;
				cursor: pointer;
				position: relative;
				top: -2px;
				float: right;
			}
			.con-more img{
				height: 16px;
				margin-right: 10px;
			}
			.introList .content{
				padding-top: 0px;
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
							width: 50%;
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
							font-size: 14px;
							color: #666;
						}
						.con-price i{
							font-style: normal;
							color: #C6C6C6 ;
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
							width: 33%;
							text-align: right;
						}
						.page-lf img,
						.page-rg img{
							height: 26px;
						}
						.page-lf img{
							margin-right: 0px;
						}
						.page-rg img{
							margin-left: 0px;
						}
						.con-page .page-c{
							width: 34%;
							text-align: center;
							font-size: 16px;
							position: relative;
							top: 3px;
						}
						.page-c span{
							color: #FF6634;
						}
						.con-page .page-rg{
							width: 33%;
							text-align: left;
						}
						.xnd-phone-po-bg{
				position: fixed;
				left: 0;
				top: 0;
				background: #000000;
				opacity: 0.5;
				z-index: 100000;
				width: 100%;
				height: 100%;
			}
			.xnd-phone-po-div{
				width: 200px;
				margin: 0px auto;
				position: fixed;
				z-index: 100001;
				top: 20%;
				left: 50%;
				text-align: center;
				margin-left: -130px;
			}
			.po-img{
				width: 260px;
				text-align: center;
				margin: 20px auto;
			}
			.po-close{
				width: 35px;
				height: 35px;
				position: absolute;
				right: -60px;
				top: -10px;
			}
			.con-guanggao{
				width: 96%;
				padding-top: 10px;
			}
			.con-guanggao img{
				width: 100%;
				margin-bottom: 5px;
			}
		</style>
	</head>
	<body onload="load()">
	<!--	<div class="xnd-phone-po-bg"></div>
		<div class="xnd-phone-po-div">
			<img src="{pigcms{$static_path}images/xnd-phone-po-close.png" class="po-close" />
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Topic&a=index&topic=duoshou">
				<img src="{pigcms{$static_path}images/1111.png" class="po-img" />
			</a>
		</div>  -->
		<div>
			<div id="scroller">
				<div id="pullDown" style="background-color:#06c1ae;color:white;">
					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIcon" style="margin-right:10px;vertical-align:middle;"></i>{pigcms{$config.wechat_name} 精心为您优选</span>
				</div>
				<section class="imgBox">
					<img src="{pigcms{$now_group.all_pic.0.m_image}" class="view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>"/>
					<div class="imgCon">
						<div class="title">{pigcms{$now_group.s_name}</div>
					<!--	<div class="desc">{pigcms{$now_group.group_name}</div>-->
					</div>
					<div class="back" onclick="history.back();"></div>
				</section>
				<section class="buyBox">
					<div class="priceDiv">
						<span class="price">￥<strong>{pigcms{$now_group['price']}</strong><span class="old">￥<del>{pigcms{$now_group.old_price}</del></span></span>
						<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
							<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id'],'is_scan'=>$isscan))}">立即购买</a>
							<else/><a class="btn buy-btn btn-large btn-strong" >已售罄</a>
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
							<dd class="link-url" data-url="{pigcms{:U('Index/index',array('token'=>$vo['mer_id']))}">
								<div class="name">{pigcms{$vo.name}</div>
								<div class="address">{pigcms{$vo.adress}</div>
								<if condition="$vo['range']"><div class="position"><div class="range">{pigcms{$vo.range}</div><if condition="$i eq 1"><div class="desc">离我最近</div></if></div></if>
								 
								 
								 <div class="enter_button">
                                                          <span>进店逛逛</span>
                                                              </div>
								 
								 
							
							
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
				<section class="detail introList">
					<div class="titleDiv">
						<div class="title">
							<!-- <a class="con-more" id="con-more">展开详情
								<img class="img01" src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/iconfont-xiajiantou.png">
							</a> -->
							本单详情
						</div>
					</div>
					<div class="del-tongzhi" style=" margin:0px 13px 0px 0px; text-align: center; padding: 20px 0px 0px 0px; display: none;">
						<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/news-tongzhi.jpg">
					</div>
					<div class="con-guanggao" style=" display: none;"> 
                          
                          <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=1338">
                          	<img src="{pigcms{$static_path}images/del02.jpg">
                          </a>
                         </div>
					<div class="content" id="content">
                         
                    </div> 
				</section>
				
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
										<if condition="$vo['merchant_reply_content']">
										<div class="textDiv">
											<div class="text">商家回复：{pigcms{$vo.merchant_reply_content}</div>
										</div>
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
				<!-- 购买记录 -->
				
				<section class="term introList">
					<a name="goumaijilu"></a>
					<div class="titleDiv">
						<div class="title">购买记录</div>
					</div>
					
					<div class="content">
						<ul class="con-shop-list" id="buy_lists">
							<li>
								<p>数据加载中...</p>
							</li>
							<div style="clear: both;"></div>

						</ul>
						<div class="con-page" id="con-page">
						</div>
					</div>
				</section>
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
							<!-- <if condition="count($merchant_group_list) gt 2"><li class="more">其他{pigcms{:count($merchant_group_list)-2}个{pigcms{$config.group_alias_name}</li></if> -->
						</ul>
					</section>
				</if>
				<if condition="$category_group_list">
					<if condition="$now_group['mer_id'] neq 686">
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
				</if>
				
			
			
		<if condition="$now_group['mer_id'] neq 686">
					<div>
				<a class="wx-btn" href="{pigcms{:U('Group/qrcode',array('title'=>$now_group['group_name']
				,'price'=>$now_group['price'],'s_title'=>$now_group['s_name'],'shareid'=>$_SESSION['distribution_id'],'groupid'=>$now_group['group_id'],'images'=>$now_group['all_pic'][0]['m_image']))}">产品不错推荐给我的小伙伴</a>
			</div>
			</if>
		<!--	</if>  -->
			
					<if condition="$now_group['mer_id'] neq 686">
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$static_path}img/xnd-logo.png" style="height:50px;margin-top:10px"/>
				</div>
				</if>
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
			
			  $("#con-more").click(function(){
			  	
			  	$.ajax({
					type:'POST',
					url:"{pigcms{:U('Group/getContent')}",
					data:{id:{pigcms{$now_group.group_id}},
					dataType:"html",
					success:function(data){
						$("#content").html(data);
					},
				});
			  });
			window.onload=function(){
				//异步加载详情页
				$.ajax({
					type:'POST',
					url:"{pigcms{:U('Group/getContent')}",
					data:{id:{pigcms{$now_group.group_id}},
					dataType:"html",
					success:function(data){
						$("#content").html(data);
					},
				});
				//异步加载购买记录
				getBuyList(1);
			}
			var flag=true;
			var permission=true;
			function getBuyList(p){
				if(permission){
				permission=false;
				}else{
					return;
				}
				$.ajax({
					type:'GET',
					url:"{pigcms{:U('Group/getOrderListDemo')}",
					data:{group_id:{pigcms{$now_group.group_id},mer_id:{pigcms{$now_group.mer_id},page:p},
					dataType:"json",
					success:function(data){
						if(data.status==1) {
							var buy_lists = data.info.group_order_list;
							if (flag) {
								$("#buy_lists").empty();
								flag = false;
							}
							if (buy_lists == "") {
								$("#next_page").remove();
								$("#buy_lists").append("<li><a class='page-b' style=' display:block; text-align:center;'>已经加载完成...</a></li>");
							} else {
								var listhtml = "";

								$("#con-page").empty();
								for (var i = 0; i < buy_lists.length; i++) {
									if (buy_lists[i].avatar == "") {
										listhtml += "<li><div class='con-shop-img'><img src='" + "{pigcms{$static_path}images/logo.png" + "' /></div><div class='con-shop-title'><h3>";
									} else {
										listhtml += "<li><div class='con-shop-img'><img src='" + buy_lists[i].avatar + "' /></div><div class='con-shop-title'><h3>";
									}
									listhtml += buy_lists[i].nickname + "</h3><span>" + buy_lists[i].last_time + "</span></div><div class='con-price'><span>" +"<i></i>" + buy_lists[i].num + "件</span>";
									listhtml += "</div><div style='clear: both;'></div>"
								}
								var listRows=data.info.list_row;
								if( buy_lists.length<listRows){
									$("#next_page").remove();
									listhtml+="<li><a class='page-b' style=' display:block; text-align:center;'>已经加载完成...</a></li>";
								}else {
									var next_page = data.info.next_page;
									var pagehtml = "";
									pagehtml += "<a class='page-b' page='" + next_page + "' id='next_page'> 点击加载更多... </a>";

									pagehtml += "<div style='clear: both;'></div>";

									$("#con-page").append(pagehtml);

									$("#next_page").click(function () {
										getBuyList($(this).attr("page"));
									});
								}
								$("#buy_lists").append(listhtml);
								permission=true;
							}
						}
						else
							if (data.status == 0) {
								if (flag) {
								$("#buy_lists").empty();
								flag = false;
								}
								$("#buy_lists").append("<li><p>暂时还没有购买记录...</p></li>");
							}
					},
				});
			}
		</script>

		<include file="Public:footer"/>
	
		
		<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$now_group.all_pic.0.m_image}", 
						<if condition="$_SESSION['distribution_id']">
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['distribution_id']))}",
						<elseif condition="$_SESSION['share_distribution_id']"/>
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['share_distribution_id']))}",
						<else/>
						link: "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}",
						</if>
						title: "<if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.s_name}<else/>{pigcms{$now_group.s_name}</if> {pigcms{$now_group.group_name}",
						desc: "{pigcms{$now_group.intro}"
			};
		</script>
		 <include file="Public:share"/>
		 <script type="text/javascript">
		$(document).ready(function(){
		  $(".po-close").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		  $(".po-img").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		  $(".xnd-phone-po-bg").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		});
	</script>
	</body>
</html>