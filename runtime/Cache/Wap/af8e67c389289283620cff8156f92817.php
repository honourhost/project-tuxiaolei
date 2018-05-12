<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($config["site_name"]); ?></title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?215"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/index.css?217"/>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/hhSwipe.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.9.1.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
		<script type="text/javascript"><?php if($user_long_lat): ?>var user_long = "<?php echo ($user_long_lat["long"]); ?>",user_lat = "<?php echo ($user_long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/index.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
	    <style>
	    .addWrap{ position:relative; width:100%;margin:0; padding:0; }
			.addWrap .swipe{overflow: hidden;visibility: hidden;position:relative;}
			.addWrap .swipe-wrap{overflow:hidden;position:relative;}
			.addWrap .swipe-wrap > div {float: left;width: 100%;position:relative;}
			#position{ position:absolute; bottom:0; right:0; padding-left:8px; margin:0; opacity: 0.4; width:100%; filter: alpha(opacity=50);text-align:center;}
			#position li{width:5px;height:5px;margin:0 2px;display:inline-block;-webkit-border-radius:5px;border-radius:5px;background-color:#ffffff;}
			#position li.cur{background-color:#000;}
			.img-responsive { 
			display: block; 
			width: 100%;
			}
			.xnd-phone-po-bg{
				position: fixed;
				left: 0;
				top: 0;
				background: #000000;
				opacity: 0.7;
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
			.guanggao{
						width: 100%;
						height: auto;
						background: #fff;
					}
					.guanggao ul li{
						width: 50%;
						height: 80px;
						float: left;
						position: relative;
						border-bottom: 1px solid #f4f4f4;
						background-origin: content-box;
						background-position: 50% 50%;
						background-repeat: no-repeat;
						background-size:contain;
					}
					.guanggao ul li:nth-child(1) span,
					.guanggao ul li:nth-child(3) span{
						display: block;
						position: absolute;
						right: 0;
						top: 0;
						border-right: 1px solid #f4f4f4;
						width: 1px;
						height: 100%;
					}
					.tuijian{
						margin-top: 8px;
						width: 100%;
						background: #fff;
					}
					.tuijian ul{
						width: 98%;
						padding: 2% 0px;
					}
					.tuijian ul li{
						width: 31.333%;
						margin-left: 2%;
						float: left;
					}
					.tuijian-img{
						width: 100%;
						height: 100px;
						background-origin: content-box;
						background-position: 50% 50%;
						background-repeat: no-repeat;
						background-size:cover;
						border-radius: 2px;
					}
					.tuijian ul li span{
						display: block;
						width: 100%;
						font-size: 16px;
						height: 20px;
						line-height: 20px;
						overflow: hidden;
						color: #444;
						margin-top: 5px;
					}
					.tuijian ul li i{
						display: block;
						width: 100%;
						font-size: 14px;
						height: 20px;
						line-height: 20px;
						overflow: hidden;
						color: #888;
						font-style: normal;
						margin-bottom: 5px;
					}
					.dealcard-img .img-icon{
						position: absolute; 
						top: 0;
						left: 0; 
						display: block;
						width: 50px;
						height: 50px;
						background: url(http://www.xiaonongding.com/tpl/Wap/pure/static/images/jiaobiao.png);
						background-repeat: no-repeat;
						background-size: cover;
					}
					.dealcard-img .img-icon{
						position: absolute; 
						top: 0;
						left: 0; 
						display: block;
						width: 50px;
						height: 50px;
						background: url(http://www.xiaonongding.com/tpl/Wap/pure/static/images/jiaobiao.png);
						background-repeat: no-repeat;
						background-size: cover;
					}
					.headBox span{
						float: right;
						font-size: 14px;
						margin-right: 10px;
						color: #888;
					}
		</style>
		<style>
			.fangjia-bg{
				position: absolute;
				left: 0;
				top: 0;
				background: #000000;
				width: 100%;
				height: 100%;
				z-index: 999;
				opacity: 0.4;
			}
		.fangjia{
			position: fixed;
			width: 300px;
			height: auto;
			top: 20%;
			z-index: 10000;
			left: 50%;
			margin-left: -150px;
			border-radius: 5px;
		}
		.fangjia-con{
		
		}
		.fangjia-con img{
			width: 100%;
		}
		
		.fangjia-close{
			position: absolute;
			right: 0px;
			top: 0px;
		}
		.fangjia-close img{
			height: 30px;
		}
	</style>
	</head>
	<body>
	
		<div class="xnd-phone-po-bg" style="display: none;"></div>
		<div class="xnd-phone-po-div" style="display: none;">
			<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-phone-po-close.png" class="po-close" />
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Topic&a=index&topic=duoshou">
				<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/1111.png" class="po-img" />
			</a>
		</div>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<header>

					<div id="locaitonBtn" class="link-url" data-url="<?php echo U('home/areaselect');?>" >  </div>
                    <style>
                         .areaname{
                             display: block;
                             padding: 0 0 0 47px;
                             height: 50px;
                             line-height: 52px;
                             border: none;
                             font-size: 16px;
                             color: #fff;

                         }
                    </style>
                    <div class="areaname" ><?php  echo $_SESSION['cityarr']['0']['area_name']; ?></div>



					<div id="searchBox" style="margin-right:10px">
						<a href="<?php echo U('Search/index');?>">
							<i class="icon-search"></i>
							<span>请输入您内容</span>
						</a>
					</div>
					<div id="">  </div>
				</header>
				<!-- slide start -->
					 <div class="addWrap">
						<div class="swipe" id="mySwipe">
							<div class="swipe-wrap">
							  	<?php if(is_array($pin_main)): $i = 0; $__LIST__ = $pin_main;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$slider_home): $mod = ($i % 2 );++$i;?><div>
									<a href="<?php echo ($slider_home["url"]); ?>">
									<img class="img-responsive" src="<?php echo "http://www.xiaonongding.com/upload/appslider/"; echo ($slider_home["pic"]); ?>"/>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							
							</div>
						</div>
						<ul id="position">
                            <li class="cur"></li>
                            <li class="cur"></li>
                            <li class="cur"></li>
						</ul>
			        </div>
				<!-- slide end-->
				<?php if($wap_index_slider): ?><section class="">
						<!-- old -->
						<div class="">
							<ul class="Hundreds-nav">
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&a=search"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/1.png"></a></span>
						   	  		<h3>优选</h3>
						   	  	</li>
                                <li>
                                    <span><a href="/wap.php?g=Wap&c=Crowdfunding&a=index&catid=-1"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/7.png"></a></span>
                                    <h3>众筹</h3>
                                </li>
                                <li>
                                    <span><a href="<?php echo U('Groupbuy/index');?>"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/8.png"></a></span>
                                    <h3>农小拼</h3>
                                </li>
						   	    <li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&a=search&cat_url=xgrm"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/2.png"></a></span>
						   	  		<h3>水果</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&a=search&cat_url=sxrq"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/3.png"></a></span>
						   	  		<h3>生鲜肉</h3>
						   	  	</li>
						   	  	
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&a=search&cat_url=wugzl"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/4.png"></a></span>
						   	  		<h3>杂粮</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&&a=search&cat_url=yjsc"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/5.png"></a></span>
						   	  		<h3>蔬菜</h3>
						   	  	</li>
						   	  	<li>
						   	  		<span><a href="/wap.php?g=Wap&c=Topic&&a=search&cat_url=sty"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/wap_recommend/6.png"></a></span>
						   	  		<h3>生态游</h3>
						   	  	</li>

						   	  	 <div style="clear: both;"></div>
						   	  </ul>
							<div class="swiper-wrapper">
							</div>
							<div class="swiper-pagination swiper-pagination2" style="display: none;"></div>
						</div>
					</section><?php endif; ?>
				<?php if($invote_array): ?><section class="invote" style="display: none;">
						<a href="<?php echo ($invote_array["url"]); ?>">
							<img src="<?php echo ($invote_array["avatar"]); ?>"/>
							<?php echo ($invote_array["txt"]); ?>
							<button>关注我们</button>
						</a>
					</section>
				<?php elseif($share): ?>
					<section class="invote" style="display: none;">
						<a href="<?php echo ($share["a_href"]); ?>">
							<img src="<?php echo ($share["image"]); ?>"/>
							<?php echo ($share["title"]); ?>
							<button><?php echo ($share['a_name']); ?></button>
						</a>
					</section><?php endif; ?>
				<section style="display: none;" class="recommend" <?php if(!$wap_index_center_adver): ?>style="height:85px;"<?php endif; ?>>
					<div class="nearBox">
						<ul>
							<li>
								<div class="nearBoxDiv merchant link-url" data-url="<?php echo U('Meal_list/index');?>">
									<div class="title">附近商家</div>
									<div class="desc">快速找到商家</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv group link-url" data-url="<?php echo U('Group/index');?>">
									<div class="title">附近<?php echo ($config["group_alias_name"]); ?></div>
									<div class="desc">看得到的便宜</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv store link-url" data-url="<?php echo U('Meal_list/index');?>">
									<div class="title">附近<?php echo ($config["meal_alias_name"]); ?></div>
									<div class="desc">购物无需等待</div>
									<div class="icon"></div>
								</div>
							</li>
						</ul>
					</div>
				</section>
				<!-- 王强新增  广告模块01   4张广告图 -->
				<section class="guanggao">
					  <ul>
					  	<?php if(is_array($home_adds)): $i = 0; $__LIST__ = $home_adds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$add): $mod = ($i % 2 );++$i;?><li onclick="window.location.href='<?php echo ($add["url"]); ?>'" style="background-image: url(<?php echo ($add["pic"]); ?>);">
					  		<span></span>
					  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
					  </ul>
					  <div style="clear: both;"></div>
				</section><!-- 王强新增  广告模块01   4张广告图  end-->
				
				<!-- 王强新增  广告模块02   3张广告图 -->
			    <div class="youlike tuijian" style="display: none;">
					<div class="headBox" style="display: none;"><span><a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Crowdfunding&a=index&catid=-1">更多</a></span>众筹</div>
                    <dl class="likeBox2 dealcard" style="display: none;">
                        <?php if(is_array($threeTuiMerchant)): $i = 0; $__LIST__ = $threeTuiMerchant;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$farm): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo U('Crowdfunding/detail',array('crowdid'=>$farm['crowd_id']));?>">
                            <div class="dealcard-img imgbox"><img
                                        src="<?php echo ($farm["webpic"]); ?>" alt="<?php echo ($farm["title"]); ?>"></div>
                            <div class="dealcard-block-right">
                                <div class="brand"> <?php echo ($farm["title"]); ?></div>
                                <div class="title"><?php echo ($farm["digest"]); ?></div>
                                <div class="price"><span>目标筹款</span><strong><?php echo ($farm["funds"]); ?></strong><span class="strong-color">元</span>
                                    <span class="line-right">已筹<?php echo ($farm["total"]); ?>元</span></div>
                            </div>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <ul style="display: none;">
						<?php if(is_array($threeTuiMerchant)): $i = 0; $__LIST__ = $threeTuiMerchant;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$farm): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U('Crowdfunding/detail',array('crowdid'=>$farm['crowd_id']));?>">
							<span><?php echo ($farm["title"]); ?></span>
<!--							<i><?php echo ($farm["person_name"]); ?></i>-->
							<div class="tuijian-img" style="background-image: url(<?php echo ($farm["webpic"]); ?>);"></div>
							</a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div style="clear: both;"></div>
					</ul>
					<div style="clear: both;"></div>
				</div>
				<section class="youlike hide" style="margin-top: 8px;">
					<div class="headBox">猜你喜欢</div>
					<dl class="likeBox dealcard"></dl>
				</section>
				<script type="text/javascript">
					var bullets = document.getElementById('position').getElementsByTagName('li');
					var banner = Swipe(document.getElementById('mySwipe'), {
						auto: 4000,
						continuous: true,
						disableScroll:false,
						callback: function(pos) {
							var i = bullets.length;
							while (i--) {
								bullets[i].className = ' ';
							}
							bullets[pos].className = 'cur';
						}
					})
			    </script>
				<script id="indexRecommendBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{{ d[i].list_pic }}" alt="{{ d[i].s_name }}"/>
								{{# if(d[i].flag == 1){ }}
								<i class="img-icon"></i>
								{{# } }}
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{# if(d[i].tuan_type != 2){ }} {{ d[i].s_name }}  {{# if(d[i].range){ }}<span class="location-right">{{ d[i].range }}</span>{{# } }}   {{# }else{ }} {{ d[i].s_name }} {{# } }}</div>								
								<div class="title">{{ d[i].group_name }}</div>
								<div class="price">
									<strong>{{ d[i].price }}</strong><span class="strong-color">元</span>{{# if(d[i].wx_cheap){ }}<span class="tag">微信再减{{ d[i].wx_cheap }}元</span>{{# }else{ }}<del>{{ d[i].old_price }}</del>{{# } }} <span class="line-right">已售{{ d[i].sale_count }}</span>
								</div>
							</div>
						</dd>
					{{# } }}
				</script>			
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
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
						imgUrl: "<?php echo ($config["wechat_share_img"]); ?>", 
						link: "<?php echo ($config["site_url"]); ?>/wap.php",
						title: "小农丁- 国内首家农场创意众筹 ，地标农特产品预售团购及农家乐特色活动体验O2O生态农场平台",
						desc: "国内首家农场创意众筹 ，地标农特产品预售团购及农家乐特色活动体验O2O生态农场平台"
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
		  $(".fangjia-bg").click(function(){
		  $(".fangjia").hide();
		  $(".fangjia-bg").hide();
		  });
		  $(".fangjia-close").click(function(){
		  $(".fangjia").hide();
		  $(".fangjia-bg").hide();
		  });
		   $(".fangjia-con img").click(function(){
		  $(".fangjia").hide();
		  $(".fangjia-bg").hide();
		  });
		  
		});
	</script>

		<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan style='display:none;' id='cnzz_stat_icon_1261423311'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261423311' type='text/javascript'%3E%3C/script%3E"));</script>
	
	</body>
</html>