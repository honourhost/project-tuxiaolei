<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>农小拼-小农丁拼团</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
		<meta name="format-detection" content="telphone=no, email=no" />
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/newtuan.css" />
		<script type="text/javascript" src="{pigcms{$static_path}js/groupbuy/hhSwipe.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/groupbuy/jquery-1.9.1.min.js"></script>
	</head>

	<body>
		<script type="text/javascript">
			var intDiff = parseInt(864000); //倒计时总秒数量
			function timer(intDiff) {
				window.setInterval(function() {
					var day = 0,
						hour = 0,
						minute = 0,
						second = 0; //时间默认值        
					if(intDiff > 0) {
						hour = Math.floor(intDiff / (60 * 60)) - (hour * 24);
						minute = Math.floor(intDiff / 60) - (hour * 60);
						second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
					}
					if(minute <= 9) minute = '0' + minute;
					if(second <= 9) second = '0' + second;
					$('#hour_show').html('<s id="h"></s>' + hour + ':');
					$('#minute_show').html('<s></s>' + minute + ':');
					$('#second_show').html('<s></s>' + second);
					$('#hour_show2').html('<s id="h"></s>' + hour + ':');
					$('#minute_show2').html('<s></s>' + minute + ':');
					$('#second_show2').html('<s></s>' + second);
					intDiff--;
				}, 1000);
			}
			$(function() {
				timer(intDiff);
			});
		</script>
		<!-- 最新订单提醒 -->
        <div class="news-dingdan">
            <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$now_pin_order['sun_id']))}">
            <span></span>
            <div class="news-dingdan-c">
            <if condition="$now_pin_order">
                <img src="{pigcms{$now_pin_order.list_pic}" />最新订单来自<?php echo getUserName($now_pin_order['uid']);?>，<?php echo time()-$now_pin_order['add_time'];?>秒前
            </if>
            </div>
            </a>
        </div>
		<div class="public-cen">
			<!-- 轮播图 -->
			<div class="slide">
				<div id="iswipe"></div>
			</div>
			<!-- 价格、销量 -->
			<div class="details-ow">
			    <div class="details-title">
					{pigcms{$now_group.s_name}
				</div>
				<p class="details-con">{pigcms{$now_group.group_name}</p>
				<div class="details-price" style=" display:none;">
					<span>累计销量：{pigcms{$now_group.sale_count}件</span>
					<b>&yen;{pigcms{$now_group['price']}<del>&yen;<php>echo getGroupPrice($now_group['related_id']);</php></del></b>
				</div>
				<div class="details-price">
				<if condition="$now_group['is_lottery_group_buy']">
				<b><i>{pigcms{$now_group['need_num']}人抽奖团</i><h3><em style="color: #00bca3;">&yen;</em>{pigcms{$now_group['price']}</h3><em>参与抽奖</em></b>
				<else/>
				<b><i>{pigcms{$now_group['need_num']}人拼团价</i><h3><em style="color: #00bca3;">&yen;</em>{pigcms{$now_group['price']}</h3><em>/件</em></b>
				</if>
					
					<p>单买价<del>&yen;<php>echo getGroupPrice($now_group['related_id']);</php></del></p>
				
					
				</div>
				
				
				<div class="detais-fuwu">
				<if condition="$now_group['is_lottery_group_buy']">
					<span>高中奖率</span>
					<span>成团开奖</span>
					<span>失败退款</span>
					<span>48小时发货</span>
					<else/>
						<span>包邮</span>
					<span>7天退货</span>
					<span>假一赔十</span>
					<span>48小时发货</span>
				</if>
				
				</div>
				<div class="details-font">
				<if condition="$now_group['is_lottery_group_buy']">
					
						<p>参与抽团，分享并邀约好友参加，24小时内拼团成功即产生中奖者，失败则自动退款</p>
				
				<else/>
					<h3>支付开团并邀请<span>{pigcms{$now_group.need_num}</span>人参团，人数不足自动退款</h3>
				</if>
				
					
				</div>
				<!-- 发起团购 -->
				<div class="details-faqi">
					<notempty name="category_groupbuy_list">
					   <span class="item-nearby-gourp-tip">以下小伙伴正在发起<if condition="$now_group['is_lottery_group_buy']">抽奖团购<else/>团购</if>，您可以直接参与</span>
					</notempty>
                 
					<volist name="category_groupbuy_list" id="groupbuy">
						
						<div class="nearby_group_detail">
							<div class="nearby_g_img">
								<img class="nearby_g_owner_img" src="<?php echo getAvatar($groupbuy['user_id']);?>">
							</div>
							<div class="nearby_g_button">
								<div class="nearby_g_info">
								<div id="nearby_g_owner"><?php echo getUserName($groupbuy['user_id']);?>发起{pigcms{$groupbuy.s_name}</div>
								
								<div id="nearby_g_address">还差<?php echo $groupbuy['need_num']-$groupbuy['react_num'];?><if condition="$now_group['is_lottery_group_buy']">人开奖<else/>人成团</if></div>
								
							</div>
							</div>
							<div class="qucantuan">
								<a href="{pigcms{:U('Groupbuy/show',array('sun_id'=>$groupbuy['sun_id']))}"><span><if condition="$now_group['is_lottery_group_buy']">参加抽奖<else/>去参团</if></span><img src="{pigcms{$static_path}img/qucantuan_arrow.png"></a>
							</div>
							<div class="nearby_line"></div>
						</div>
					</volist>
				</div>
				<!-- 发起团购 end-->
				<!-- 店铺、进店逛逛 -->

			</div>
			<div class="detais-dian">
				<volist name="now_group['store_list']" id="vo" offset="0" length="2">
					<a href="{pigcms{:U('Index/index',array('token'=>$vo['mer_id']))}"><span><img src="{pigcms{$static_path}img/icon-dian.png" />进店逛逛</span></a>
					<div class="details-shop">
						<img src="<?php echo getMerchantPic($vo['mer_id']);?>" />
						<h3>{pigcms{$vo.name}</h3>
						<p>销量：<?php echo $now_group['sale_count']+ $now_group['virtual_num']?></p>
					</div>
				</volist>
				<div style="clear: both;"></div>
			</div>
			<!-- 产品详情内容 -->
			<style>
				.details-banner{
					width: 100%;
				}
				.details-banner img{
					width: 100%;
				}
				.details-tishi{
				
					line-height: 25px;
					padding: 10px;
					color: #bfbfbf;
				}
				.details-tishi span{
					color: #f19325;
					
				
				}
			</style>
			<div class="details-content">
				<div class="details-banner">
				   
					<p class="details-tishi"><span >温馨提示：</span><br/>{pigcms{$now_group['cue_arr'][0]['value']}</p>
					<div style="width: 100%; text-align: center; padding: 0px; display: none;">
						<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/news-tongzhi.jpg">
					</div>
					<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=1338">
						<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/del02.jpg">
					</a>
				</div>
				{pigcms{$now_group.content}
			</div>
			<section class="term introList">
				<a name="goumaijilu"></a>
				<div class="titleDiv">
						<if condition="$now_group['is_lottery_group_buy']">
						<div class="title">抽奖记录</div>
						<else/>
						<div class="title">购买记录</div>
						</if>
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
			<div class="cai">
				<h3 class="cai-title">你可能会喜欢</h3>
				<ul>
					<volist name="category_group_list" id="vo">
						<li>
							<a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$vo['group_id']))}">
								<div class="car-img" style="background-image: url({pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])})"></div>
								<h3>{pigcms{$vo.group_name}</h3>
								<div class="car-price">
									<b>&yen;{pigcms{$vo.price}</b>
								</div>
							</a>
						</li>
					</volist>
				</ul>
				<div style=" clear: both;"></div>
			</div>
			<div class="footer-don">
				<span></span>
				<p>已经到底部了</p>
			</div>
			<div style="width: 100%; height: 60px;"></div>
			<div class="details-footer">
				<ul>
					<li class="nav-01">
						<a href="{pigcms{:U('groupbuy/index')}">
							<i><img src="{pigcms{$static_path}img/icon-index.png" /></i>首页
						</a>
					</li>
				      <if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
					<li class="nav-02">
						<a href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['related_id']))}">
							<span>&yen;<?php echo getGroupPrice($now_group['related_id']);?></span>单独购买
						</a>
					</li>
                          <if condition="($now_group['is_lottery_group_buy'] eq 1 ) and $category_groupbuy_list ">
                              <li class="nav-03">
                                  <a href="{pigcms{:U('Groupbuy/show',array('group_id'=>$now_group['group_id'] ,'sun_id'=>$maxnum['sun_id']))}">
                                      <span>&yen;{pigcms{$now_group.price}</span>试试手气
                                  </a>
                              </li>
                              <elseif condition=" $now_group['is_lottery_group_buy'] eq 1 " />
                               <li class="nav-03">
							  <a href="{pigcms{:U('NewGroup/buy',array('group_id'=>$now_group['group_id']))}">
								  <span>&yen;{pigcms{$now_group.price}</span>试试手气
							  </a>
							  </li>
							  <else />


                              <li class="nav-03">
                                  <a href="{pigcms{:U('NewGroup/buy',array('group_id'=>$now_group['group_id']))}">
                                      <span>&yen;{pigcms{$now_group.price}</span>{pigcms{$now_group.need_num}人团
                                  </a>
                              </li>
                          </if>

					<else/>
					<li class="nav-02">
						<a href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['related_id']))}">
							<span>&yen;<?php echo getGroupPrice($now_group['related_id']);?></span>单独购买
						</a>
					</li>
					<li class="nav-03">
						<a href="">
							<span>&yen;{pigcms{$now_group.price}</span>已售罄
						</a>
					</li>
					</if>
				</ul>
			</div>
		</div>
	</body>
	<!-- 右侧返点顶部 -->
	<div class="top-tz">
		<a href="{pigcms{:U('My/group_buy_list')}"><span style="background-image: url({pigcms{$static_path}img/go_my.png); margin-bottom: 10px;">我的</span></a>
		<a href="#"><span style="background-image: url({pigcms{$static_path}img/go_top.png);">顶部</span></a>
	</div>

	<script id="swipe" type="text/tmpl">
		<div class="addWrap">
			<div class="swipe" id="mySwipe">
				<div class="swipe-wrap">
					<volist name="now_group['all_pic']" id="vo">
						<div>
							<a href="javascript:;"><img class="img-responsive" src="{pigcms{$vo.m_image}" /></a>
						</div>
					</volist>
				</div>
			</div>
			<ul id="position">
				<li class="cur"></li>
				<li></li>

			</ul>
		</div>
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#iswipe").html($('#swipe').html());
			var bullets = document.getElementById('position').getElementsByTagName('li');
			var banner = Swipe(document.getElementById('mySwipe'), {
				auto: 1000,
				continuous: true,
				disableScroll: false,
				callback: function(pos) {
					var i = bullets.length;
					while(i--) {
						bullets[i].className = ' ';
					}
					if(pos <= bullets.length) {
						bullets[pos].className = 'cur';
					}
				}
			})
			$('.drawer').drawer();
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
									if(buy_lists[i].is_lottery_order == 1){
										listhtml += buy_lists[i].nickname + "</h3><span>" + buy_lists[i].last_time + "</span></div><div class='con-price'><span><font color=#f19325>中奖啦</font>&nbsp;  " + "</span>";
									}else {

										listhtml += buy_lists[i].nickname + "</h3><span>" + buy_lists[i].last_time + "</span></div><div class='con-price'><span>&yen;" + buy_lists[i].price + "<i>×</i>" + buy_lists[i].num + "件</span>";
									}
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
	<script type="text/javascript">
            var shareData={
                        imgUrl: "{pigcms{$now_group.all_pic.0.m_image}", 
                        link: "{pigcms{$config.site_url}{pigcms{:U('NewGroup/detail',array('group_id'=>$now_group['group_id']))}",
						title: <if condition="$now_group['is_lottery_group_buy'] eq 1">'{pigcms{$username}邀你试手气，价值{pigcms{$now_group.old_price}元的{pigcms{$now_group.s_name}等你拿！'<else/><if condition="$username">'{pigcms{$username}喊你一起买"{pigcms{$now_group.s_name}"，仅售{pigcms{$now_group.price}元！'<else/>'小农丁喊你一起买"{pigcms{$now_group.s_name}"，仅售{pigcms{$now_group.price}元！'</if></if>,
						desc: <if condition="$now_group['is_lottery_group_buy'] eq 1">'{pigcms{$username}正在拼颜值，你来么~{pigcms{$now_group.s_name}'<else/>"我在农小拼等你一起拼团！{pigcms{$now_group.group_name}"</if>
            };
        </script>
         <include file="Share:share"/>

</html>