<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
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
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/detail.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?448"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?212" charset="utf-8"></script>
		<script type="text/javascript"><?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/detail.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.9.1.min.js" charset="utf-8"></script>
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
			<img src="<?php echo ($static_path); ?>images/xnd-phone-po-close.png" class="po-close" />
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Topic&a=index&topic=duoshou">
				<img src="<?php echo ($static_path); ?>images/1111.png" class="po-img" />
			</a>
		</div>  -->
		<div>
			<div id="scroller">
				<div id="pullDown" style="background-color:#06c1ae;color:white;">
					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIcon" style="margin-right:10px;vertical-align:middle;"></i><?php echo ($config["wechat_name"]); ?> 精心为您优选</span>
				</div>
				<section class="imgBox">
					<img src="<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>" class="view_album" data-pics="<?php if(is_array($now_group['all_pic'])): $i = 0; $__LIST__ = $now_group['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["m_image"]); if(count($now_group['all_pic']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>"/>
					<div class="imgCon">
						<div class="title"><?php echo ($now_group["s_name"]); ?></div>
					<!--	<div class="desc"><?php echo ($now_group["group_name"]); ?></div>-->
					</div>
					<div class="back" onclick="history.back();"></div>
				</section>
				<section class="buyBox">
					<div class="priceDiv">
						<span class="price">￥<strong><?php echo ($now_group['price']); ?></strong><span class="old">￥<del><?php echo ($now_group["old_price"]); ?></del></span></span>
						<?php if($now_group['end_time'] > $_SERVER['REQUEST_TIME']): ?><a class="btn buy-btn btn-large btn-strong" href="<?php echo U('Group/buy',array('group_id'=>$now_group['group_id'],'is_scan'=>$isscan));?>">立即购买</a>
							<?php else: ?><a class="btn buy-btn btn-large btn-strong" >已售罄</a><?php endif; ?>
					</div>
					<?php if($now_group['wx_cheap']): ?><div class="cheapDiv">优惠 <span class="tag">微信购买再减<?php echo ($now_group["wx_cheap"]); ?>元</span></div><?php endif; ?>
                    <?php if($now_group['secondprice']): ?><div class="cheapDiv">优惠 <span class="tag">微信第二件<?php echo ($now_group["secondprice"]); ?>元</span></div><?php endif; ?>
					<div class="saleDiv">
						<span><i class="yesLightIcon"></i>农湾基地保障</span>
						<span><i class="yesLightIcon"></i>无条件赔付</span>
						<span class="sale"><i class="yesIcon"></i>已售<?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></span>
					</div>
				</section>
				<?php if(!empty($reply_list)): ?><section class="scoreBox link-url" data-url="<?php echo U('Group/feedback',array('group_id'=>$now_group['group_id']));?>">
						<div class="rateInfo">
							<div class="starIconBg"><div class="starIcon" style="width:<?php echo ($now_group['score_mean']*20); ?>%;"></div></div>
							<div class="starText"><?php echo ($now_group["score_mean"]); ?></div>
							<div class="right"><?php echo ($now_group["reply_count"]); ?> 人评价</div>
						</div>
					</section><?php endif; ?>
				<section class="storeBox">
					<dl class="storeList">
						<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = array_slice($now_group['store_list'],0,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo U('Index/index',array('token'=>$vo['mer_id']));?>">
								<div class="name"><?php echo ($vo["name"]); ?></div>
								<div class="address"><?php echo ($vo["adress"]); ?></div>
								<?php if($vo['range']): ?><div class="position"><div class="range"><?php echo ($vo["range"]); ?></div><?php if($i == 1): ?><div class="desc">离我最近</div><?php endif; ?></div><?php endif; ?>
								 
								 
								 <div class="enter_button">
                                                          <span>进店逛逛</span>
                                                              </div>
								 
								 
							
							
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<?php if(count($now_group['store_list']) > 2): ?><div class="more link-url" data-url="<?php echo U('Group/branch',array('group_id'=>$now_group['group_id']));?>">全部<?php echo count($now_group['store_list']);?>家分店</div><?php endif; ?>
				</section>
				<style>
				 .del-tongzhi img{
				 	width: 100%;
				 }
				</style>
				<?php if($now_group['cue_arr']): ?><section class="term introList">
						<div class="titleDiv"><div class="title">购买须知</div></div>
						<div class="content">
							<ul>
								<?php if(is_array($now_group['cue_arr'])): $i = 0; $__LIST__ = $now_group['cue_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['value']): ?><li><b><?php echo ($vo["key"]); ?>：</b><?php echo (nl2br($vo["value"])); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div> 
					</section><?php endif; ?>
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
                          	<img src="<?php echo ($static_path); ?>images/del02.jpg">
                          </a>
                         </div>
					<div class="content" id="content">
                         
                    </div>
                    <?php if($now_group['youcha']==1){?>
                    <div style="text-align: center;">
                        <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=<?php echo $_GET['group_id'];?>" style="width:38.33%;height:40px;line-height:40px;text-align:center;font-size:1rem;display:inline-block">
                            <img src="http://www.xiaonongding.com/tpl/Static/weizan/images/lijigoumai.png"/>

                        </a>
                        <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=3039" style="width:38.33%;height:40px;line-height:40px;text-align:center;font-size:1rem;display:inline-block">
                            <img src="http://www.xiaonongding.com/tpl/Static/weizan/images/youcha.png"/>

                        </a>
                        <p style="text-align:center;">
	<span style="line-height:1.5;font-size:18px;color:#337FE5;"><img src="/upload/group/content/000/000/979/59855fc59f10d.jpg"  style="    max-width: 100%;width: 100%;display: block;" alt=""><br>
</span>
                        </p>
                    </div>
                    <?php }?>
				</section>
				
				<?php if(!empty($reply_list)): ?><section class="comment introList">
						<div class="titleDiv"><div class="title">评价<div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:<?php echo ($now_group['score_mean']*20); ?>%;"></div></div><div class="starText"><?php echo ($now_group["score_mean"]); ?></div></div><div class="right"><?php echo ($now_group["reply_count"]); ?> 人评论</div></div></div>
						<dl>
							<?php if(is_array($reply_list)): $i = 0; $__LIST__ = $reply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
									<div class="titleBar">
										<div class="nickname"><?php echo ($vo["nickname"]); ?></div><div class="dateline"><?php echo ($vo["add_time"]); ?></div><div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:<?php echo ($vo['score']*20); ?>%;"></div></div></div>
									</div>
									<div class="replyCon">
										<div class="textDiv">
											<div class="text"><?php echo ($vo["comment"]); ?></div>
										</div>
										<?php if($vo['pics']): ?><ul class="imgList" data-pics="<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i; echo ($voo["m_image"]); if(count($vo['pics']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>">
												<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($voo["s_image"]); ?>"/></li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul><?php endif; ?>
										<?php if($vo['merchant_reply_content']): ?><div class="textDiv">
											<div class="text">商家回复：<?php echo ($vo["merchant_reply_content"]); ?></div>
										</div><?php endif; ?>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
						<?php if($now_group['reply_count'] > 3): ?><div class="more link-url" data-url="<?php echo U('Group/feedback',array('group_id'=>$now_group['group_id']));?>">查看全部 <?php echo ($now_group["reply_count"]); ?> 条评价</div><?php endif; ?>
					</section><?php endif; ?>
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
				<?php if($merchant_group_list): ?><section class="storeProList introList">
						<div class="titleDiv"><div class="title">商家其他<?php echo ($config["group_alias_name"]); ?></div></div>
						<ul class="goodList">
							<?php if(is_array($merchant_group_list)): $i = 0; $__LIST__ = $merchant_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="link-url" data-url="<?php echo ($vo["url"]); ?>" <?php if($i > 2): ?>style="display:none;"<?php endif; ?>>
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="title"><?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span>
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<!-- <?php if(count($merchant_group_list) > 2): ?><li class="more">其他<?php echo count($merchant_group_list)-2;?>个<?php echo ($config["group_alias_name"]); ?></li><?php endif; ?> -->
						</ul>
					</section><?php endif; ?>
				<?php if($category_group_list): if($now_group['mer_id'] != 686): ?><section class="sysProList introList">
						<div class="titleDiv"><div class="title">看了本<?php echo ($config["group_alias_name"]); ?>的用户还看了</div></div>
						<dl class="likeBox dealcard">
							<?php if(is_array($category_group_list)): $i = 0; $__LIST__ = $category_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="brand"><?php if($vo['tuan_type'] != 2): echo ($vo["merchant_name"]); else: echo ($vo["s_name"]); endif; ?><span class="location-right">28米</span></div>
										<div class="title">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span>
										</div>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
					</section><?php endif; endif; ?>
				
			
			
		<?php if($now_group['mer_id'] != 686): ?><div>
				<a class="wx-btn" href="<?php echo U('Group/qrcode',array('title'=>$now_group['group_name'] ,'price'=>$now_group['price'],'s_title'=>$now_group['s_name'],'shareid'=>$_SESSION['distribution_id'],'groupid'=>$now_group['group_id'],'images'=>$now_group['all_pic'][0]['m_image']));?>">产品不错推荐给我的小伙伴</a>
			</div><?php endif; ?>
		<!--	</if>  -->
			
					<?php if($now_group['mer_id'] != 686): ?><div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($static_path); ?>img/xnd-logo.png" style="height:50px;margin-top:10px"/>
				</div><?php endif; ?>
			</div>
		</div>
		<div class="positionDiv">
			<div class="left"><div class="back"></div></div>
			<?php if($now_group['tuan_type'] != 2): ?><div class="center"><?php echo ($now_group["merchant_name"]); ?></div><?php endif; ?>
			<?php if($now_group['end_time'] > $_SERVER['REQUEST_TIME']): ?><div class="right">
					<a class="btn buy-btn btn-large btn-strong" href="<?php echo U('Group/buy',array('group_id'=>$now_group['group_id']));?>">购买</a>
				</div><?php endif; ?>
		</div>
		
		<script type="text/javascript">
			
			  $("#con-more").click(function(){
			  	
			  	$.ajax({
					type:'POST',
					url:"<?php echo U('Group/getContent');?>",
					data:{id:<?php echo ($now_group["group_id"]); ?>},
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
					url:"<?php echo U('Group/getContent');?>",
					data:{id:<?php echo ($now_group["group_id"]); ?>},
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
					url:"<?php echo U('Group/getOrderListDemo');?>",
					data:{group_id:<?php echo ($now_group["group_id"]); ?>,mer_id:<?php echo ($now_group["mer_id"]); ?>,page:p},
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
										listhtml += "<li><div class='con-shop-img'><img src='" + "<?php echo ($static_path); ?>images/logo.png" + "' /></div><div class='con-shop-title'><h3>";
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

		<?php if(empty($no_footer)): ?><footer class="footerMenu <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>">
		<ul>
			<li>
				<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>"><em class="home"></em><p>首页</p></a>
			</li>
			<li>
				<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>"><em class="group"></em><p><?php echo ($config["group_alias_name"]); ?></p></a>
			</li>
			<!--<li class="voiceBox">
				<a href="<?php echo U('Search/voice');?>" class="voiceBtn" data-nobtn="true"></a>
			</li>-->
			<!-- <li>
				<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal'))): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index');?>"><em class="store"></em><p><?php echo ($config["meal_alias_name"]); ?></p></a>
			</li> -->
			<li style="display: none;">
				<a <?php if($_GET['topic'] == 'shengtaiyou'): ?>class="active"<?php endif; ?> href="<?php echo U('Topic/index',array('topic'=>'shengtaiyou'));?>"><em class="store"></em><p>生态游</p></a>
			</li>
			<li>
				<a <?php if($_GET['topic'] == 'shengtaiyou'): ?>class="active"<?php endif; ?> href="<?php echo U('Groupbuy/index');?>"><em class="store"></em><p>农小拼</p></a>
			</li>
			<li>
                <a <?php if(in_array(MODULE_NAME,array('My','index'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>"><em class="my"></em><p>我的</p></a>
				<!--<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>"><em class="my"></em><p>我的</p></a>-->
			</li>
		</ul>
	</footer><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
	
		
		<script type="text/javascript">
			var shareData={
						imgUrl: "<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>", 
						<?php if($_SESSION['distribution_id']): ?>link: "<?php echo ($config["site_url"]); echo U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['distribution_id']));?>",
						<?php elseif($_SESSION['share_distribution_id']): ?>
						link: "<?php echo ($config["site_url"]); echo U('Group/detail', array('group_id' => $now_group['group_id'],'share_distribution_id'=>$_SESSION['share_distribution_id']));?>",
						<?php else: ?>
						link: "<?php echo ($config["site_url"]); echo U('Group/detail', array('group_id' => $now_group['group_id']));?>",<?php endif; ?>
						title: "<?php if($now_group['tuan_type'] != 2): echo ($now_group["s_name"]); else: echo ($now_group["s_name"]); endif; ?> <?php echo ($now_group["group_name"]); ?>",
						desc: "<?php echo ($now_group["intro"]); ?>"
			};
		</script>
		 <?php
$appid = "wx9001d7083b0287ac"; $secret = "4499a315e917f4c9db705a232f9427f1"; require_once APP_PATH.'Lib/ORG/weixinshare/jssdk.php'; $jssdk = new JSSDK($appid, $secret); $signPackage = $jssdk->GetSignPackage(); ?>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
			wx.config({
				debug: false,
				appId: '<?php echo $signPackage["appId"];?>',
			    timestamp: <?php echo $signPackage["timestamp"];?>,
			    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			    signature: '<?php echo $signPackage["signature"];?>',
				jsApiList: [
					'onMenuShareTimeline',
					'onMenuShareAppMessage',
					'onMenuShareQQ',
					'onMenuShareWeibo',
					'onMenuShareQZone',
					'previewImage'
				]
			});
            wx.ready(function(){
            wx.onMenuShareTimeline(shareData);
			wx.onMenuShareAppMessage(shareData);
			wx.onMenuShareQQ(shareData);
			wx.onMenuShareWeibo(shareData);
			wx.onMenuShareQZone(shareData);
            });
        </script>
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