<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<if condition="$now_group['tuan_type'] neq 2">
			<title>【{pigcms{$now_group.merchant_name}{pigcms{$config.group_alias_name}】{pigcms{$now_group.s_name}{pigcms{$config.group_alias_name}|图片|价格|菜单 - {pigcms{$config.site_name}</title>
		<else/>
			<title>【{pigcms{$now_group.group_name}{pigcms{$config.group_alias_name}】{pigcms{$now_group.s_name}{pigcms{$config.group_alias_name} - {pigcms{$config.site_name}</title>
		</if>

		<link href="/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
		<meta name="keywords" content="{pigcms{$now_group.merchant_name},{pigcms{$now_group.s_name},{pigcms{$config.site_name}" />
		<meta name="description" content="{pigcms{$now_group.intro}" />
		<link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
		<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/header.css">
		<link rel="stylesheet" href="{pigcms{$static_path}css/xnd_css/frame.css" />
		<link rel="stylesheet" href="{pigcms{$static_path}css/xnd_css/detail.css" />
		<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
		<script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script>
		<script src="{pigcms{$static_path}js/xnd_js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="{pigcms{$static_path}js/xnd_js/simplefoucs.js" type="text/javascript"></script>

        <script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
        <script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
        <script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>

        <script>var site_url = "{pigcms{$config.site_url}";var store_long="{pigcms{$now_group.store_list.0.long}";var store_lat="{pigcms{$now_group.store_list.0.lat}";var get_reply_url="{pigcms{:U('Index/Reply/ajax_get_list',array('order_type'=>0,'parent_id'=>$now_group['group_id'],'store_count'=>count($now_group['store_list'])))}";var collect_url="{pigcms{:U('Index/Collect/collect')}";var login_url="{pigcms{:U('Index/Login/frame_login')}";</script>

        <script src="{pigcms{$static_path}js/group_detail.js"></script>
	</head>
	<body>
		<include file="Public:header_top"/>
		
		<!-- 王强新增 -->
		<div class="lmMain">
			
			<!-- 表单  -->
			<form action="{pigcms{$now_group.buy_url}" method="get" id="buyFrom">
				
				<div class="grand-title clearfix">
				<h4 class="title-text fontYaHei">
				    {pigcms{$now_group.s_name} <font style="font-size: medium;color: grey;"> &nbsp;&nbsp;{pigcms{$now_group.group_name}</font>
				</h4>
				
			</div>
				<div class="top-section clearfix">
					<div class="left-tuwen">
						<!-- 焦点图 -->
						<div class="gallery">
							<div id="focus">
						        <ul >
						        		<volist name="now_group['all_pic']" id="vo">
											<li class="<if condition='$i eq 1'>cur</if>">
												<div><img src="{pigcms{$vo.m_image}"  alt="小农丁，F2F，F2F生态农场平台，创意采摘，农业众筹，农场活动，休闲观光，度假村，温泉农庄，科普基地，拓展培训，生态农庄"/></div>
											</li>
										</volist>
						           
						        </ul>
						    </div>
						</div>
						<!-- 焦点图end -->

						<div class="gallery-bottom clearfix">
							<p class="desc">
								<span class="desc-inner">{pigcms{$now_group.hits}</span> 次浏览
							</p>
							<p class="desc">
								<span class="desc-inner">{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</span> 件已售
							</p>
						</div>

						<ul class="tools clearfix">
							<li data-id="59795" class="sc J-component-add-favorite" <if condition="!empty($now_group['is_collect'])">yi</if>" fav-id="{pigcms{$now_group.group_id}"><if condition="empty($now_group['is_collect'])">收藏<else/>已收藏</if></li>
							<li class="fx">
								<span>分享</span>
								<div class="share-wrap size24 qui-iconShares">
									<span class="trangle"></span>
									<div class="bdsharebuttonbox">
										<div class="bdsharebuttonbox"><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
									</div>
							</li>
							<!-- <li class="tx">填写信息 一键秒杀</li> -->
						</ul>
					</div>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
					<div class="right-operate">
						<div class="content-wrap">
							<h4 class="content-wrap-label">{pigcms{$now_group.intro}</h4>
							<div class="content-unit product-option">
								<h4 class="unit-title leg_title">售价：</h4>
								<div class="unit-nr">
									<p class="unit-nr-ft-color postion_top">
										&yen;<span class="unit-nr-h3">{pigcms{$now_group.price}</span>
									</p>
									<del>&yen;{pigcms{$now_group.old_price}</del>
								</div>
							</div>

							<div class="content-unit lm-calendar">
								<h4 class="unit-title">已售：</h4>
								<div class="unit-nr">
									<label class="unit-nr-ft-color">{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</label>
								</div>
							</div>
							<div class="content-unit product-option">
								<h4 class="unit-title">评价：</h4>
								<div class="unit-nr">
									<label><span class="unit-nr-ft-color">{pigcms{$now_group.reply_count}</span>次评价</label>
								</div>
							</div>

							<div class="content-unit lm-calendar">
								<h4 class="unit-title">商家：</h4>
								<div class="unit-nr">
									<label>
										{pigcms{$now_group.person_name}<span class="unit-nr-ft-color unit-nr-line">|</span> 查看地址电话
									</label>
								</div>
							</div>
							<div class="content-unit product-option">
								<h4 class="unit-title">有效期：</h4>
								<div class="unit-nr">
									<label>截止到{pigcms{$now_group.end_time|date='Y.m.d',###}(<span class="unit-nr-ft-color">周末、法定节假日通用</span>)</label>
								</div>
							</div>
							<div class="content-unit person-number">
								<h4 class="unit-title">数量：</h4>
								<div class="unit-nr">
									<ul class="person-list clearfix">
										<li>
											<p class="num-p">
												<button for="J-cart-minus" type="button" class="num-btn minus disable">−</button>
												<input type="text" id="num-adult" class="num-input inp J-cart-quantity" name="q" value="{pigcms{$now_group.once_min}" maxlength="9" data-max="{pigcms{$now_group.once_max}" data-min="{pigcms{$now_group.once_min}"/>
												<button for="J-cart-add" class="item num-btn add" type="button">+</button>
											</p>
										</li>
										<li><span class="deal-component-quantity-warning orange" style="color:red"></span></li>
										<span class="num-tip" style="display:none;">
											<i></i>限购<em></em>人
										</span>
									</ul>
								</div>
							</div>
							<div class="content-pad-btm">
								<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
								<a class="btn btn_bg01" onclick="submitForm();">立即购买</a>
								</if>
								<a class="btn btn_bg02 shou J-component-add-favorite" <if condition="!empty($is_collect)">yi</if> fav-id="{pigcms{$now_group.group_id}"><if condition="empty($is_collect)">收藏商品<else/>已收藏</if></a>
							</div>
						<script>
						function submitForm(){
							document.getElementById("buyFrom").submit();
						}
						</script>
							<div class="booking-unit">
								<div class="book-cell enable clearfix">
									<div class="price-unit">
										<label class="price-unit-tit">保障：</label>
										<span>品质保证</span>
										<span>无条件退换</span>
										<span>真实评价</span>
									</div>
									<input id="booking" class="book-btn book-now fontYaHei " onClick="window.location.href='{pigcms{$config.site_url}/merindex/{pigcms{$now_group.mer_id}.html';" type="button" value="进入农场" />
									<i class="entrance-ico" style="position: relative; left: -180px; top: -5px;"></i>
								</div>

							</div>
						</div>
						<div class="fr content_ma">
							<img class="content_ma_img" src="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']))}" />
							 <h4 class="weixinlijian">微信立减<font color="red">{pigcms{$now_group['wx_cheap']}</font>元 </h4>
						</div>
					</div>
				</div>
			</form>
			<div class="detail-content-wrap">
				<div class="detail-nav-wrap">
					<!--供应商导航部分-->
					<div class="detail-nav clearfix">
						<ul class="nav-unit clearfix">
							<li class="li-0 active fontYaHei">
								农场简介<span class="trangle"></span>
							</li>
							<li class="li-1 fontYaHei">
								特卖详情<span class="trangle"></span>
							</li>
							<li class="li-2 fontYaHei">
								农丁小贴士<span class="trangle"></span>
							</li>
							<li class="li-3 fontYaHei">
								评论<span class="trangle"></span>
							</li>
						</ul>
						<div class="nav-right" style="display:none;">
							<span class="nav-price">
								¥<em>日均<em>280</em></em>
							</span>
							
							<input class="nav-book canbook fontYaHei" type="button" value="立即预订" />
						</div>

					</div>
					<!--供应商导航部分-->
				</div>
				<div class="detail-wrap clearfix">
					
					<!--供应商介绍部分-->
					<div class="left-list">
						<div class="detail-cell-local">
									<div class="detail-cell-header-img">
										<img src="{pigcms{$now_group.merchant_theme_image}" />
										<div class="detail-cell-bg"></div>
										<div class="detail-cell-title">
											<h3><span></span>{pigcms{$now_group.merchant_name}<span></span></h3>
											<p>小农丁特色推荐农场</p>
										</div>
										<div id="detail-cell-user">
											<if condition="$now_group['person_image']">
											<img src="{pigcms{$now_group.person_image}" />
											<else/>
											<img src="{pigcms{$static_path}images/default.png" />
											</if>
											<p>场主：{pigcms{$now_group.person_name}</p>
										</div>
									</div>
									<div style="width: 100%; height: 70px;"></div>
									<div class="detail-cell-content">
										<span id="content-top">
											<img src="{pigcms{$static_path}images/xnd_img/content-top.jpg" />
										</span>
										<p>
											{pigcms{$now_group.person_info}
										</p>
										<span id="content-bottom">
											<img src="{pigcms{$static_path}images/xnd_img/content-bottom.jpg" />
										</span>
									</div>
								</div>
						<!-- 特卖详情 -->
						
						<div class="detail-unit product-detail">
							
							<h4 class="unit-title zkxq fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">购买须知</i>
								<ul>
								<volist name="now_group['cue_arr']" id="vo">
									<if condition="$vo['value']">
										<li><b>{pigcms{$vo.key}：</b>{pigcms{$vo.value|nl2br=###}</li>
									</if>
								</volist>
							</ul>
							</h4>
							<h4 class="unit-title zkxq fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">特卖详情</i>
							</h4>
							<div style="width: 100%; text-align: center; padding: 20px 0px 0px 0px; display: none;">
								<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/news-tongzhi.jpg">
							</div>
							<div class="detail-cell">
								{pigcms{$now_group.content}
							</div>
						</div>
						
						<!-- 农场简介 -->
						<a class="cpjs"></a>
						<div class="detail-unit mt22">
							
							<h4 class="unit-title fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">农场简介</i>
							</h4>
							<div class="detail-cell mt10" style="padding-top: 10px;">
								<span class="detail-cell-jianjie">{pigcms{$now_group.txt_info}</span>
							</div>
							
						</div>
						
						
						<!--农丁小贴士-->
						<div class="detail-unit">
							<a name="mod_question"></a>
							<h4 class="unit-title pl fontYaHei">
								<span class="pingjia">共 <b>{pigcms{$now_group.reply_count}</b> 次评价</span>
								<i class="tit-ico"></i>
								<i class="tit-text">消费评价</i>
							</h4>
							<div class="detail-cell">
								<div class="detail-cell-local">
									<ul>
								<volist name="now_group['cue_arr']" id="vo">
									<if condition="$vo['value']">
										<li class="cf">
											<div class="shopping_list_name">{pigcms{$vo.key}</div>
											<div class="shopping_list_txt">{pigcms{$vo.value}</div>
										</li>
									</if>
								</volist>
							</ul>
								</div>
							</div>
						</div>
						
						<!--原来的评论-->
						<section class="appraise" id="anchor-reviews">
							<div class="appraise_list cf">
								<div class="appraise_li">
									<div class="zzsc">
										<div class="tab">
											<div class="tab_title rate-filter__item">
												<a href="javascript:;" class="on" data-tab="all">全部</a>
												<a href="javascript:;" data-tab="high">好评</a>
												<a href="javascript:;" data-tab="mid">中评</a>
												<a href="javascript:;" data-tab="low">差评</a>
												<a href="javascript:;" data-tab="withpic">有图</a>
											</div>
										</div>
										<div class="content ratelist-content">
											<div class="appraise_li-list">
												<dl class="J-rate-list"></dl>
											</div>
											<div class="page J-rate-paginator"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="mod_talk_edit mt30">
									<p class="mod_talk_edit_face">
										<a href="">
											<img width="80" height="80" alt="" src="{pigcms{$static_path}images/default.png">
											
										</a>
									</p>
									<div class="mod_talk_edit_cnt">

										<p class="arrow"></p>
										<p class="arrow2"></p>
										<div id="textarea" class="qui-textArea" data-width="536" data-height="80" style="">
											<textarea placeholder="说说您的购买体验" class="ui2_textarea" style="width: 695px; height: 100px;"></textarea>
											<div class="tips">
												<span class="current">0</span>/<span class="max">140</span>
											</div>
										</div>
										<div class="btm clearfix">
											<div style="display:none;" id="textarea-tip" class="ui2_error_layer">
												<p class="ui2_error_layer_arrow"></p>
												<p class="ui2_error_layer_arrow2"></p>
												<p class="ui2_error_layer_text">至少写够10个字，最多不超过140字</p>
											</div>
											<p class="fr">
												<input id="mod_talk_sub" type="button" onclick="window.location.href='{pigcms{:U('User/Index/index')}'" value="发表评论" class="ui_buttonB">
											</p>
										</div>

									</div>
								</div>
			        	</section>
				<!--原来的评论-end-->

						<!--评论-->
						
						

						<!--sell record-->
						<div class="detail-unit merchant-deal-record">
							<h4 class="unit-title fontYaHei">
								<i class="tit-ico"></i>
								<i class="tit-text">商家成交记录 
									<span class="record-count">
										(<span class="record-count-num">{pigcms{$all_count}</span>)
									</span>
								</i>
							</h4>
							<div class="detail-cell" style="margin-bottom:20px;">
								<table class="record-table">
									<thead>
										<tr>
											<th>买家</th>
											<th class="product-name-th">产品名称</th>
											<th class="product-num-th">数量</th>
											<th class="product-price-th">成交价格</th>
											<th>成交时间</th>
										</tr>
									</thead>
									<tbody id="buy_lists">
									
									</tbody>
								</table>
								<div class="mt20 clearfix record-table-pager" id="con-page">
									<p id="loaddata">数据加载中...</p>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						window.onload=function(){
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
					url:"{pigcms{:U('Detail/getOrderListDemo')}",
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
								$("#buy_lists").append("<tr><td>已经加载完成...</td></tr>");
							} else {
								var listhtml = "";

								$("#con-page").empty();
								for (var i = 0; i < buy_lists.length; i++) {
									listhtml +="<tr>";
									listhtml +="<td>"+buy_lists[i].nickname + "</td><td><p class='product-name need-dots' style='max-height: 4.2em;'>" + buy_lists[i].order_name + "<span class='ellipsis-dots' style='display: inline;''>...</span></p></td><td>"+buy_lists[i].num+"</td><td>&yen;" + buy_lists[i].price + "<i>×</i>"+buy_lists[i].num+"</td><td>"+buy_lists[i].last_time+"</td>";
									listhtml +="</tr>";
								}
								var listRows=data.info.list_row;
								if( buy_lists.length<listRows){
									$("#next_page").remove();
									listhtml+="<tr><td>已经加载完成...</td></tr>";
								}else {
									var next_page = data.info.next_page;
									var pagehtml = "";
									pagehtml += "<a class='page-b' page='" + next_page + "' id='next_page' style='display:block;text-align:center;font-size:15px;'> 点击加载更多... </a>";

									pagehtml += "<div style='clear: both;'></div>";

									$("#con-page").append(pagehtml);

									$("#next_page").click(function () {
										getBuyList($(this).attr("page"));
									});
								}
								$("#buy_lists").append(listhtml);
								permission=true;							}
						}
						else if(data.status == 0) {
								if (flag) {
								$("#loaddata").remove();
								$("#buy_lists").empty();
								flag = false;
								}
								$("#buy_lists").append("<li><p>暂时还没有成交记录...</p></li>");
							}
					},
				});
			}
						</script>
						<!--供应商介绍部分-->
					</div>

					<!--侧边开始-->
					<div class="right-merchant">
						<!--侧边开始-->
						<div class="lmSideCell gysj">
							<h4 class="side-title fontYaHei">农场简介</h4>
							<div class="cell-cont">
								<div class="sj-top-wrap">
									<div class="sj-top">
										<div class="img-box">
											<a href="{pigcms{$config.site_url}/merindex/{pigcms{$now_group.mer_id}.html">
												<if condition="$now_group['person_image']">
												<img style="width:90px;height:90px;" src="{pigcms{$now_group.person_image}">
											<else/>
											<img style="width:90px;height:90px;" src="{pigcms{$static_path}images/default.png" />
											</if>										</a></div>
										<div class="text-box">
											<p class="text-tit">
												<a href="" target="_blank">{pigcms{$now_group.person_name}</a>
											</p>
											<p class="ico-box">
												<span class="ico-box-img"><img src="{pigcms{$static_path}images/xnd_img/ico-box-01.png"></span>
												<span  class="ico-box-img"><img src="{pigcms{$static_path}images/xnd_img/ico-box-02.png"></span>
											</p>
										</div>
									</div>
									<a class="qjd-entrance" target="_blank" href="{pigcms{$config.site_url}/merindex/{pigcms{$now_group.mer_id}.html">
										进入该农场<i class="btn-arrow">></i>
									</a>
								</div>
								<div class="sj-phone">
									<h4 class="phone-tit">
										<i class="ico"></i>
										<span class="tit-text">客服电话</span>
									</h4>
									<ul class="phone-list">
										<li>{pigcms{$now_group.phone}</li>
									</ul>

									<p class="phone-day">
										周一至周五 9:00-18:00
									</p>

								</div>
							</div>
						</div>
						<div class="lmSideCell xgsp">
							<h4 class="side-title fontYaHei">该农场的其他特卖</h4>
							<div class="cell-cont">
								<ul class="cell-list">
									<if condition="$merchant_group_list">
									<volist name='merchant_group_list' id="vo">
										<li class="clearfix">
										<div class="pic">
											<a href="{pigcms{$vo.url}" target="_blank">
												<img src="{pigcms{$vo.list_pic}" />
											</a>
										</div>
										<div class="wenzi">
											<p class="wtop">
												<a href="{pigcms{$vo.url}" target="_blank">
													{pigcms{$vo.s_name}
												</a>
											</p>
											<p class="wbot">
												特价：<em>{pigcms{$vo.price}</em>元
											</p>
										</div>
									</li>
									</volist>
									<else/>
									<p>
										该农场暂时还没有其他特卖
									</p>
								</if>
								</ul>
							</div>
						</div>
						<div class="lmSideCell yzrmzk">
							<h4 class="side-title fontYaHei">农丁推荐</h4>
							<div class="cell-cont">
								<ul class="cell-list">
									<volist name='like_group_list' id="vo">
									<li class="clearfix">
										<div class="pic">
											<a href="{pigcms{$vo.url}" target="_blank">
												<img src="{pigcms{$vo.list_pic}" />
											</a>
										</div>
										<div class="wenzi">
											<p class="wtop">
												<a href="" target="_blank">
													{pigcms{$vo.s_name}
												</a>
											</p>
											<p class="wbot">
												特价：<em>{pigcms{$vo.price}</em>元
											</p>
										</div>
									</li>
								</volist>
								</ul>
							</div>
						</div>
						
						<div class="lmSideCell bookzk">
							<h4 class="side-title fontYaHei">关注小农丁</h4>
							<div class="cell-cont">
								<div class="gzzk clearfix">
									<span class="ico"></span>
									<p class="at">关注@小农丁</p>
									<span class="guanzhu"></span>
								</div>
								<div class="sao">
									<img src="{pigcms{$static_path}images/xnd_img/app-qr-code.png" />
								</div>
								<div class="ind_emailyd">
									<form>
										<div class="email clearfix">
											<span class="email-ico"></span>
											<input class="email-input" type="text" name="email" value="" placeholder="输入E-mail" />
											<input class="eamil-submit" type="button" value="订阅" onClick="$(this).parents('form').submit()" />
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--侧边结束-->
					</div>

					<!--侧边结束-->
				</div>
			</div>
		</div>
		
		<!-- 王强新增end -->
		
		
		
		
		
		
		<!-- old -->
		<div class="body" style="display: none;"> 
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top">全部分类</div>
						<div class="list">
							<ul>
								<volist name="all_category_list" id="vo" key="k">
									<li>
										<div class="li_top cf">
											<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
											<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
										</div>
										<if condition="$vo['cat_count'] gt 1">
											<div class="li_bottom">
												<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
													<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
												</volist>
											</div>
										</if>
									</li>
								</volist>
							</ul>
						</div>
					</div>
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
									<li class="ctur">
										<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
									</li>
								</pigcms:slider>
							</ul>
						</div>
					</div>
				</div>
			</article>
			<article class="product cf">
				<div class="navBreadCrumb cf">
					<ul class="cf">
						<li><a href="{pigcms{$config.site_url}">网站首页</a></li>
						<li><span>»</span></li>
						<li><a href="{pigcms{$f_category.url}">{pigcms{$f_category.cat_name}</a></li>
						<li><span>»</span></li>
						<li><a class="link--black__green" href="{pigcms{$s_category.url}">{pigcms{$s_category.cat_name}</a></li>
						<if condition="$now_group['store_list'][0]['area']">
							<li><span>»</span></li>
							<li><a href="{pigcms{$now_group.store_list.0.area.url}">{pigcms{$now_group.store_list.0.area.area_name}</a></li>
							<li><span>»</span></li>
							<li><a href="{pigcms{$now_group.store_list.0.circle.url}">{pigcms{$now_group.store_list.0.circle.area_name}</a></li>
						</if>
						<li><span>»</span></li>
						<li>{pigcms{$now_group.merchant_name}</li>
					</ul>
				</div>

				<div class="product_table cf">
					<div class="product_img cf"> 
						<div id="slider">
							<div class="show-box">
								<ul>
									<li><img src="{pigcms{$now_group.all_pic.0.m_image}"/></li>
								</ul>
							</div>
							<div class="minImgs">
								<div class="min-box">
									<ul class="min-box-list" style="margin:0px auto;">
										<volist name="now_group['all_pic']" id="vo">
											<li class="<if condition='$i eq 1'>cur</if>">
												<div><img src="{pigcms{$vo.m_image}"/></div>
											</li>
										</volist>
									</ul>
								</div>							  
							</div>
						</div>
					</div>
					<div class="product_list cf">
						<div class="product_list_top cf">
							<div class="product_info">
								<div class="product_name"><span>【{pigcms{$now_group.prefix_title}】</span>
									<if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.merchant_name}
									<else/>
									{pigcms{$now_group.s_name}
									</if>
								</div>
							<div class="product_dec">{pigcms{$now_group.intro}</div>
								<!-- <if condition="$now_group['wx_cheap']">
									<div class="product_weixin cf">
										<div class="product_weixin_txt"> 微信购买立减<span>¥<span>{pigcms{$now_group.wx_cheap}</span></span></div>  
										<div class="product_weixin_img"><img src="{pigcms{$static_path}images/xiangqing_07.png"/></div>
										<div class="product_weixin_info">
											<ul>
												<li><i>1.</i> 收藏该{pigcms{$config.group_alias_name}单</li>
												<li><i>2.</i> 扫描关注微信号</li>
												<li><i>3.</i> 在微信号中“我的收藏”中购买</li>
											</ul>  
										</div>
									</div>
								</if> -->
								<div class="product_info_list">
									<ul>
										<li class="cf">
											<div class="product_info_list_left">售价1111111111：</div>
											<div class="priduct_price">¥<strong>{pigcms{$now_group.price}</strong><span>¥{pigcms{$now_group.old_price}</span></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">已售：</div>
											<div class="priduct_sale">{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">评价：</div>
											<div class="priduct_pingjia">
												<div class="priduct_pingjia_icon">
													<div>
														<span style="width:{pigcms{$now_group['score_mean']/5*100}%"></span>
													</div>
												</div>
												<div class="priduct_pingjia_txt"><a class="see_anchor" href="javascript:void(0);" data-anchor="anchor-reviews"><span>{pigcms{$now_group.reply_count}</span></a> 次评价</div>
											</div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">商家：</div>
											<div class="priduct_shop"><a href="{pigcms{$config.site_url}/merindex/{pigcms{$now_group.mer_id}.html" target="_blank">{pigcms{$now_group.merchant_name}</a>&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;<a class="see_anchor" data-anchor="business-info" href="javascript:void(0);">查看地址/电话</a></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">有效期：</div>
											<div class="priduct_data">截止到{pigcms{$now_group.end_time|date='Y.m.d',###} （<span><switch name="now_group['is_general']"><case value="0">周末、法定节假日通用</case><case value="1">周末不能使用</case><case value="2">法定节假日不能使用</case></switch></span>）</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="product_info_right">
								<div class="product_info_right_img"><img src="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']))}"/></div>
								<p>微信购买立减<span>¥<span>{pigcms{$now_group.wx_cheap}</span></span> </p>
							</div>
						</div>
						<div class="product_list_bottom">
							<form action="{pigcms{$now_group.buy_url}" method="get">
							<if condition="isset($mpackages) AND !empty($mpackages)">
								<div class="input cf" id="mpackageslist">
								    <div class="product_info_list_left">套餐：</div>
									 <ul>
									   <volist name="mpackages" id="vv">
										  <li <if condition="$key eq $now_group['group_id']"> class="current"</if> ><a href="{pigcms{$config.site_url}/group/{pigcms{$key}.html">{pigcms{$vv}</a></li>
									   </volist>
									</ul>
							    </div>
								</if>
								<div class="input cf">
									<div class="product_info_list_left">数量：</div>
									<ul>
										<li><button for="J-cart-minus" type="button">−</button></li>
										<li>
											<input type="text" class="inp J-cart-quantity" name="q" value="{pigcms{$now_group.once_min}" maxlength="9" data-max="{pigcms{$now_group.once_max}" data-min="{pigcms{$now_group.once_min}"/>
										</li>
										<li><button for="J-cart-add" class="item" type="button">+</button></li>
										<li><span class="deal-component-quantity-warning orange"></span></li>
									</ul>
								</div>
								<div class="but cf">
									<button class="info_but" type="submit">立即购买</button>
									<a class="info_shop_but" href="{pigcms{$config.site_url}/merindex/{pigcms{$now_group.mer_id}.html" target="_blank">商家店铺</a>
									<div class="shou J-component-add-favorite <if condition="!empty($now_group['is_collect'])">yi</if>" fav-id="{pigcms{$now_group.group_id}"><if condition="empty($now_group['is_collect'])">收藏<else/>已收藏</if></div>
								</div>
							</form>
							<div class="baozhang cf">
								<div class="product_info_list_left">保障：</div>
								<div class="baozhang_list">
									<ul class="cf">
										<li>随时退</li>
										<li>过期退</li>
										<li>极速退</li>
										<li>真实评价</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
		<div class="detail_content cf" style="display: none;">
			<div class="content_left">
				<div class="content_navbar" id="J-content-navbar">
					<ul class="cf">
						<li class="current"><a href="#business-info">商家位置</a></li>
						<if condition="$now_group['cue_arr']"><li><a href="#anchor-purchaseinfo">购买须知</a></li></if>
						<li><a href="#anchor-detail">本单详情</a></li>
						<li><a href="#anchor-bizinfo">商家介绍</a></li>
						<li><a href="#anchor-reviews">消费评价<span class="num J-hub">({pigcms{$now_group.reply_count})</span></a></li>
					</ul>
					<div id="J-nav-buy" class="buy-group J-hub">
						<a rel="nofollow" class="J-buy btn-hot buy" href="{pigcms{$now_group.buy_url}">抢购</a>
					</div>
				</div>
				<section class="address cf" id="business-info">
					<div class="section_title cf">
						<div class="section_txt">商家位置</div>
						<div class="section_border"></div>
					</div>
					<div class="map">
						<div class="map_map">
							<div class="map_map_img">
								<div id="map-canvas" map_point="{pigcms{$now_group.store_list.0.long},{pigcms{$now_group.store_list.0.lat}" store_name="{pigcms{$now_group.store_list.0.name}" store_adress="{pigcms{$now_group.store_list.0.area_name}{pigcms{$now_group.store_list.0.adress}" store_phone="{pigcms{$now_group.store_list.0.phone}" frame_url="{pigcms{:U('Map/frame_map')}"></div>
								<div class="map_icon J-view-full"><img src="{pigcms{$static_path}images/xiangqing_31.png"/></div>
							</div>
						</div>
						<div class="map_txt">
							<volist name="now_group['store_list']" id="vo">
								<div class="biz-info <if condition="$i eq 1">biz-info--open biz-info--first</if> <if condition="count($now_group['store_list']) eq 1">biz-info--only</if>">
									<div class="biz-info__title">
										<div class="shop_name">{pigcms{$vo.name}</div>
										<i class="F-glob F-glob-caret-down-thin down-arrow"></i>
									</div>
									<div class="biz-info__content">
										<div class="shop_add"><span>地址：</span>{pigcms{$vo.area_name}{pigcms{$vo.adress}</div>
										<div class="shop_map"><a class="view-map" href="javascript:void(0)" map_point="{pigcms{$vo.long},{pigcms{$vo.lat}"  store_name="{pigcms{$vo.name}" store_adress="{pigcms{$vo.area_name}{pigcms{$vo.adress}" store_phone="{pigcms{$vo.phone}" frame_url="{pigcms{:U('Map/frame_map')}">查看地图</a>&nbsp;&nbsp;&nbsp;<a class="search-path" href="javascript:void(0)" shop_name="{pigcms{$vo.adress}">公交/驾车去这里</a></div>
										<div class="shop_ip"><span>电话：</span>{pigcms{$vo.phone}</div>
									</div>
								</div>
							</volist>
						</div>
					</div>
				</section>
				<if condition="$now_group['cue_arr']">
					<section class="shopping cf" id="anchor-purchaseinfo">
						<div class="section_title cf">
							<div class="section_txt">购买须知</div>
							<div class="section_border"></div>
						</div>
						<div class="shopping_list">
							<ul>
								<volist name="now_group['cue_arr']" id="vo">
									<if condition="$vo['value']">
										<li class="cf">
											<div class="shopping_list_name">{pigcms{$vo.key}</div>
											<div class="shopping_list_txt">{pigcms{$vo.value}</div>
										</li>
									</if>
								</volist>
							</ul>
						</div>
					</section>
				</if>
				<section class="package cf" id="anchor-detail">
					<div class="section_title cf">
						<div class="section_txt">本单详情</div>
						<div class="section_border"></div>
					</div>
					<style>
						.BMap_cpyCtrl{display:none;}
						.group_content{padding-top:20px;font-size:14px;  color: #666;}
						.group_content table { width:100%!important; margin-top:0px; border:none; color:#222;  border-collapse: collapse;border-spacing: 0; }
						.group_content table .name { width:auto; text-align:left; border-left:none; }
						.group_content table .price { width:15%; text-align:center; }
						.group_content table .amount { width:15%; text-align:center; }
						.group_content table .subtotal { width:15%; text-align:right; border-right:none; font-family: arial, sans-serif; }
						.group_content table caption, .group_content table th, .group_content table td { padding:8px 10px; background:#FFF; border:1px solid #E8E8E8; border-top:none; word-break:break-all; word-wrap:break-word; }
						.group_content table caption { background:#F0F0F0; }
						.group_content table caption .title, .group_content table .subline .title { font-weight:bold; }
						.group_content table th { color:#333; background:#F0F0F0; font-weight:bold; border-left-style:none; border-right-style:none;}
						.group_content table td { color:#666; /*border-left-style:none; border-right-style:none;*/ border-bottom-style:dotted; }
						.group_content table .subline { background:#fff; text-align:center; border-left:none; border-right:none; }
						.group_content table .subline-left { width:22%; text-align:left;border-right: 1px #e8e8e8 dotted; }
						.group_content p{  margin: 10px 0;font: 14px/24px helvetica neue,helvetica,arial,simsun,"微软雅黑",Hiragino Sans GB,sans-serif;color: #666;}
						.deal-menu-summary { padding:0 10px 10px; text-align:right; border-bottom:1px #e8e8e8 solid; }
						.deal-menu-summary .worth { display:inline-block; min-width:10px; _width:10px; padding-right:20px; text-align:left; word-break:normal; word-wrap:normal; font-weight:bold; }
						.deal-menu-summary .price { color:#ea4f01; padding-right:0; }
						.group_content ul.list{margin:10px 0 15px;padding-left:18px;}
						.group_content ul.list li {list-style-position: outside;list-style-type: disc;margin-bottom: 5px;}
					</style>
					<div class="group_content">{pigcms{$now_group.content}</div>
				</section>
				<section class="introduce cf" id="anchor-bizinfo">
					<div class="section_title cf">
						<div class="section_txt"><a name="anchor-bizinfo">商家介绍</a></div>
						<div class="section_border"></div>
					</div>
					<div class="introduce_title">{pigcms{$now_group.merchant_name}</div>
					<div class="introduce_txt">{pigcms{$now_group.txt_info}</div>
					<div class="introduce_img">
						<volist name="now_group['merchant_pic']" id="vo">
							<img src="{pigcms{$vo}" alt="{pigcms{$now_group.merchant_name}" class="standard-image"/>
						</volist>
					</div>
				</section>
				<section class="appraise" id="anchor-reviews">
					<div class="section_title cf">
						<div class="section_txt">消费评价</div>
						<div class="section_border"></div>
					</div>
					<div class="appraise_list cf">
						<div class="appraise_title">
							<ul class="cf">
								<li class="pingfen">
									<div class="ping"><span>{pigcms{$now_group.score_mean}</span>分</div>
									<div class="appraise_icon"><div><span style="width:{pigcms{$now_group['score_mean']/5*100}%"></span></div></div>
								</li>
								<li class="pingjia">共 <span>{pigcms{$now_group.reply_count}</span> 次评价</li>
								<li class="pinglun">
									<a class="fabiao" href="{pigcms{:U('User/Index/index')}">
										<img src="{pigcms{$static_path}images/xiangqing_54.png"/>
										<p>发表评论</p>
									</a>
								</li>
							</ul>
						</div>
						<div class="appraise_li">
							<div class="zzsc">
								<div class="tab">
									<div class="tab_title rate-filter__item">
										<a href="javascript:;" class="on" data-tab="all">全部</a>
										<a href="javascript:;" data-tab="high">好评</a>
										<a href="javascript:;" data-tab="mid">中评</a>
										<a href="javascript:;" data-tab="low">差评</a>
										<a href="javascript:;" data-tab="withpic">有图</a>
									</div>
									<div class="tab_form">
										<div class="form_sec">
											<select name="时间排序" class="select J-filter-ordertype">
												<option value="default">默认排序</option>
												<option value="time">时间排序</option>
												<option value="score">好评排序</option>
											</select>
										</div>
									</div>
								</div>
								<div class="content ratelist-content">
									<div class="appraise_li-list">
										<dl class="J-rate-list"></dl>
									</div>
									<div class="page J-rate-paginator"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="shop_bottom">
					<ul>
						<li>
							<div class="shop_bottom_pirce">¥<span>{pigcms{$now_group.price}</span></div>
						</li>
						<li>
							<div class="shop_bottom_list">门店价</div>
							<div class="shop_bottom_txt">¥{pigcms{$now_group.old_price}</div>
						</li>
						<li>
							<div class="shop_bottom_list">折扣</div>
							<div class="shop_bottom_txt">{pigcms{$now_group.discount}折</div>
						</li>
						<li>
							<div class="shop_bottom_list">已售</div>
							<div class="shop_bottom_txt">{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</div>
						</li>
						<li style="float:right">
							<a class="shop_bottom_but" href="{pigcms{$now_group.buy_url}">抢购</a>
						</li>
					</ul>
				</section>
			</div>
			<if condition="$category_hot_group_list">
				<div class="content_right">
					<div class="activity">
						<div class="activity_title">看了本{pigcms{$config.group_alias_name}的人还看了</div>
						<div class="content_right_list">
							<ul>
								<volist name="category_hot_group_list" id="vo">
									<li>
										<a href="{pigcms{$vo.url}" target="_blank">
											<div class="category_list_img">
												<img src="{pigcms{$vo.list_pic}" title="【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}"/>
												<div class="bmbox">
													<div class="bmbox_title">该商家有<span>465</span>个粉丝</div>
													<div class="bmbox_list">
														<div class="bmbox_list_img"><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$vo['group_id']))}"/></div>
														<div class="bmbox_list_li">
															<ul>
																<li class="open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html">商家</li>
																<li class="open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
																<li class="open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$vo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
																<li class="open_windows" data-url="{pigcms{$config.site_url}/mermap/{pigcms{$vo.mer_id}.html">地图</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="datal cf">
												<div class="category_list_title">【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}</div>
												<div class="deal-tile__detail cf"><span id="price">¥<strong>{pigcms{$vo.price}</strong></span></div>
												<div class="extra-inner cf">
													<div class="sales">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></div>
												</div>
											</div>
										</a>
									</li>
								</volist>
							</ul>
						</div>
					</div>
				</div>
			</if>
		</div>
		<include file="Public:footer"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/stickUp.min.js"></script>
		<script src="{pigcms{$static_path}js/xnd_js/channel_block.js"></script>
		
<script type="text/javascript">
			
       jQuery(function($) {
          $(document).ready( function() {
            $('.detail-nav-wrap').stickUp({
              parts: {
                  0:'li-0',
                  1:'li-1',
                  2: 'li-2',
                  3: 'li-3',
                },
                itemClass: 'active2',
                itemHover: 'active'
            });
        });
      });
      $('.li-0').click(function(){$('html,body').animate({scrollTop:$('.cpjs').offset().top}, 800);}); 
      $('.li-1').click(function(){$('html,body').animate({scrollTop:$('.zkxq').offset().top}, 800);}); 
      $('.li-2').click(function(){$('html,body').animate({scrollTop:$('.xts').offset().top}, 800);}); 
      $('.li-3').click(function(){$('html,body').animate({scrollTop:$('.pl').offset().top}, 800);}); 
</script>
	</body>
</html>
