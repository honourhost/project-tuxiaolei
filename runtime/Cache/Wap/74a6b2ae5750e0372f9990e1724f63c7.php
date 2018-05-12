<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo ($tpl["wxname"]); ?></title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>tpl/com/css/common.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>tpl/com/css/xnd-phone-show.css"/>

	</head>
	<body class="xnd-phone-bg">
		<div class="xnd-phone-center">
			<!-- 农场大图 -->
			<div class="xnd-phont-header-img" style="background-image: url(<?php echo ($currentmerchant["merchant_theme_image"]); ?>);">
				
			</div>
			<!-- 农场大图 end -->
			<!-- 已筹、店铺、粉丝 -->
				<div class="xnd-phone-nav">
					<ul>
						<li>
							<?php if($storenum): ?><h3><?php echo ($storenum); ?>件</h3>
							<?php else: ?>
							<h3>0件</h3><?php endif; ?>
							<span>特卖</span>
						</li>
						<li>
							<?php if($currentmerchant['hits']): if($mer_id == 1116 ): ?><h3><?php echo $currentmerchant["hits"]+30 ?>次</h3>
									<?php else: ?>
									<h3><?php echo ($currentmerchant["hits"]); ?>次</h3><?php endif; ?>

							<?php else: ?>
							<h3>0</h3><?php endif; ?>
							<span>浏览</span>
						</li>
						<li>
							<?php if($mer_id == 1116 ): ?><h3><?php echo $currentmerchant["fans_count"]+5 ?>人</h3>
								<?php else: ?>
								<h3><?php echo ($currentmerchant["fans_count"]); ?>人</h3><?php endif; ?>

							<span>粉丝</span>
						</li>
						<div style="clear: both;"></div>
					</ul>
					<div style="clear: both;"></div>
				</div>
			<!-- 已筹、店铺、粉丝 -->
			<!-- 店铺信息 -->
			<div class="xnd-phone-shop margin-top10">
				<div class="xnd-phone-shop-icon left-3">
					<img src="<?php echo ($currentmerchant["person_image"]); ?>"  />
				</div>
				<div class="xnd-phone-shop-title">
					<h3><?php echo ($currentmerchant["person_name"]); ?></h3>
					<p>电话：<?php echo ($currentmerchant["phone"]); ?></p>
				</div>
				<div class="xnd-phone-shop-tel">
					<a href="tel:<?php echo ($currentmerchant["phone"]); ?>"><img src="<?php echo ($static_path); ?>tpl/com/images/xnd-phone-icon.png"></a>
				</div>
				<div style="clear: both;"></div>
			</div>
			<!-- 店铺信息end -->

            <!-- 农场抽奖推荐 -->
            <?php if(!empty($group_list_lottery)): ?><div class="xnd-phone-hot margin-top10">
                    <div class="xnd-phone-header">
                        <span class="fl-span"></span>
                        <h3>抽奖团推荐</h3>
                    </div>
                    <div class="xnd-phone-list">
                        <ul>
                            <?php if(is_array($group_list_lottery)): $i = 0; $__LIST__ = $group_list_lottery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li>
                                    <?php if($group['is_group_buy'] == 1): ?><a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id=<?php echo ($group["group_id"]); ?>">
                                            <?php else: ?>
                                            <a href="/wap.php?g=Wap&c=Group&a=detail&group_id=<?php echo ($group["group_id"]); ?>"><?php endif; ?>
                                    <div class="xnd-phone-list-img" style="background-image: url(<?php echo ($group["all_pic"]["0"]["image"]); ?>);">
                                    </div>
                                    <div class="xnd-phone-list-right">
                                        <h3 class="title"><?php echo ($group["name"]); ?></h3>
                                        <p><?php echo ($group["intro"]); ?></p>
                                        <div class="list-right-btm">
                                            <span>销售：<?php echo $group['sale_count']+$group['virtual_num']; ?></span>
                                            <h4><b><?php echo ($group["price"]); ?></b></h4>
                                        </div>
                                    </div>
                                    </a>
                                    <div style="clear: both;"></div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div style="clear: both;"></div>
                        </ul>
                    </div>
                </div><?php endif; ?>
            <!-- 农场抽奖推荐end -->

            <!-- 农场精品推荐 -->
            <?php if(!empty($group_list)): ?><div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农场特卖推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li>
							<?php if($group['is_group_buy'] == 1): ?><a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id=<?php echo ($group["group_id"]); ?>">
							<?php else: ?>
							<a href="/wap.php?g=Wap&c=Group&a=detail&group_id=<?php echo ($group["group_id"]); ?>"><?php endif; ?>
							<div class="xnd-phone-list-img" style="background-image: url(<?php echo ($group["all_pic"]["0"]["image"]); ?>);">
							</div>
							<div class="xnd-phone-list-right">
								<h3 class="title"><?php echo ($group["name"]); ?></h3>
								<p><?php echo ($group["intro"]); ?></p>
								<div class="list-right-btm">
									<span>销售：<?php echo $group['sale_count']+$group['virtual_num']; ?></span>
									<h4><b><?php echo ($group["price"]); ?></b></h4>
								</div>
							</div>
							</a>
							<div style="clear: both;"></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div><?php endif; ?>
			<!-- 农场精品推荐end -->
			
				<!-- 农场拼团推荐 -->
			<?php if(!empty($group_list_pin)): ?><div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农场拼团推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<?php if(is_array($group_list_pin)): $i = 0; $__LIST__ = $group_list_pin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li>
								<?php if($group['is_group_buy'] == 1): ?><a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id=<?php echo ($group["group_id"]); ?>">
										<?php else: ?>
										<a href="/wap.php?g=Wap&c=Group&a=detail&group_id=<?php echo ($group["group_id"]); ?>"><?php endif; ?>
								<div class="xnd-phone-list-img" style="background-image: url(<?php echo ($group["all_pic"]["0"]["image"]); ?>);">
								</div>
								<div class="xnd-phone-list-right">
									<h3 class="title"><?php echo ($group["name"]); ?></h3>
									<p><?php echo ($group["intro"]); ?></p>
									<div class="list-right-btm">
										<span>销售：<?php echo $group['sale_count']+$group['virtual_num']; ?></span>
										<h4><b><?php echo ($group["price"]); ?></b></h4>
									</div>
								</div>
								</a>
								<div style="clear: both;"></div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div><?php endif; ?>
			<!-- 农场拼团推荐end -->

			<!-- 农场团长免单推荐 -->
			<?php if(!empty($group_list_first_free)): ?><div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>团长免单推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<?php if(is_array($group_list_first_free)): $i = 0; $__LIST__ = $group_list_first_free;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li>
								<?php if($group['is_group_buy'] == 1): ?><a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id=<?php echo ($group["group_id"]); ?>">
										<?php else: ?>
										<a href="/wap.php?g=Wap&c=Group&a=detail&group_id=<?php echo ($group["group_id"]); ?>"><?php endif; ?>
								<div class="xnd-phone-list-img" style="background-image: url(<?php echo ($group["all_pic"]["0"]["image"]); ?>);">
								</div>
								<div class="xnd-phone-list-right">
									<h3 class="title"><?php echo ($group["name"]); ?></h3>
									<p><?php echo ($group["intro"]); ?></p>
									<div class="list-right-btm">
										<span>销售：<?php echo $group['sale_count']+$group['virtual_num']; ?></span>
										<h4><b><?php echo ($group["price"]); ?></b></h4>
									</div>
								</div>
								</a>
								<div style="clear: both;"></div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div><?php endif; ?>
			<!-- 团长免单推荐end -->

            <!-- 农场众筹 -->
            <?php if(!empty($crowdfundings)): ?><div class="xnd-phone-hot margin-top10">
                    <div class="xnd-phone-header">
                        <span class="fl-span"></span>
                        <h3>农场众筹推荐</h3>
                    </div>
                    <div class="xnd-phone-list">
                        <ul>
                            <?php if(is_array($crowdfundings)): $i = 0; $__LIST__ = $crowdfundings;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$crowdfunding): $mod = ($i % 2 );++$i;?><li>

                                            <a href="/wap.php?g=Wap&c=Crowdfunding&a=detail&crowdid=<?php echo ($crowdfunding["crowd_id"]); ?>">

                                    <div class="xnd-phone-list-img" style="background-image: url(<?php echo ($crowdfunding["webpic"]); ?>);">
                                    </div>
                                    <div class="xnd-phone-list-right">
                                        <h3 class="title"><?php echo ($crowdfunding["title"]); ?></h3>
                                        <p><?php echo ($crowdfunding["digest"]); ?></p>
                                        <div class="list-right-btm" style="display: inline-block;">
                                            <span>已众筹：<?php echo ($crowdfunding["total"]); ?>元</span>
<!--                                            <span>目标:<?php echo ($crowdfunding["funds"]); ?>元 &nbsp;&nbsp;</span>-->
                               <!--   <h4><b>目标众筹：{pi:gcms{$crowdfunding.funds}元</b></h4>-->
                                        </div>
                                    </div>
                                    </a>
                                    <div style="clear: both;"></div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div style="clear: both;"></div>
                        </ul>
                    </div>
                </div><?php endif; ?>
            <!-- 农场众筹推荐end -->
			
			<?php if($meal_list): ?><!-- 农场产品 -->
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农小店热卖</h3>
				</div>
				<ul>
					<?php if(is_array($meal_list)): $i = 0; $__LIST__ = $meal_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$meal): $mod = ($i % 2 );++$i;?><li>
						<a href="/wap.php?g=Wap&c=Food&a=menu&mer_id=<?php echo ($mer_id); ?>&store_id=<?php echo ($store_id); ?>">
						<div class="xnd-phone-more-img" style="background-image: url(<?php echo ($meal["image"]["image"]); ?>);">
						</div>
						<h3 class="xnd-phone-more-tit"><?php echo ($meal["name"]); ?></h3>
						<div class="xnd-phone-more-con">
							<span><b><?php echo ($meal["price"]); ?></b>/<?php echo ($meal["unit"]); ?></span>
							<h3>销售：<?php echo ($meal["sell_count"]); ?></h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div style="clear: both;"></div>
			</div>
			

			<div style="width: 100%; height: 60px;"></div>
			<div class="ab_footer">
				<a href="/wap.php?g=Wap&c=Food&a=menu&mer_id=<?php echo ($mer_id); ?>&store_id=<?php echo ($store_id); ?>">进入农小店</a>
			</div><?php endif; ?>
		</div>
		<div style="width: 100%; background: #; text-align: center; padding: 10px 0px;">
					<img src="http://www.xiaonongding.com/upload/config/000/000/004/563c69a292120.png" style="height:30px;"/>
		</div>
		<style>
			.nc-photo{
				position: fixed;
				right: 10px;
				bottom: 10px;
				width: 50px;
				height: 50px;
				border-radius: 50px;
				background-color: rgba(0,0,0,.7);
				text-align: center;
				z-index: 10000;
			}
			.nc-photo h3{
				font-size: 12px;
				line-height: 18px;
				color: #fff;
				position: relative;
				top: 7px;
			}
			.nc-photo h3 a{
				color: #fff;
				font-size: 12px;
			}
		</style>
		<div class="nc-photo">
			<a href="http://www.xiaonongding.com/mobile.php?g=Mobile&c=Merchant&a=getPicturesList&mer_id=<?php echo ($mer_id); ?>">
			<h3>
				农场<br />相册
			</h3>
			</a>
		</div>
		<script type="text/javascript">
			var shareData={
						imgUrl: "<?php echo ($currentmerchant["person_image"]); ?>", 
						link: "http://www.xiaonongding.com/wap.php?g=Wap&c=index&a=index&mer_id=<?php echo ($mer_id); ?>&store_id=<?php echo ($store_id); ?>",
						title: "<?php echo ($tpl["wxname"]); ?>",
						desc: "<?php echo ($currentstore["txt_info"]); ?>"
			};
		</script>
		 <?php
$appid = "wx9001d7083b0287ac"; $secret = "4499a315e917f4c9db705a232f9427f1"; require_once APP_PATH.'Lib/ORG/weixinshare/jssdk.php'; $jssdk = new JSSDK($appid, $secret); $signPackage = $jssdk->GetSignPackage(); ?>
		<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
					'onMenuShareQZone'
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
	</body>
</html>