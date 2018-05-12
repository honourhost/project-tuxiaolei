<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($config["group_alias_name"]); ?>列表</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210">
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/list.css?210"/>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.9.1.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript">
			var location_url = "<?php echo U('Group/ajaxList');?>";
			var now_cat_url="<?php if(!empty($now_cat_url)): echo ($now_cat_url); else: ?>-1<?php endif; ?>";
			var now_area_url="<?php if(!empty($now_area_url) && $all_area_list): echo ($now_area_url); else: ?>-1<?php endif; ?>";
			var now_sort_id="<?php if(!empty($now_sort_array)): echo ($now_sort_array["sort_id"]); else: ?>defaults<?php endif; ?>";
			<?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?>
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/dropdown.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/grouplist.js?rand=<?php echo rand(1000,50000); ?>" charset="utf-8"></script>
	</head>
	<body>
		<section class="searchBar pageSliderHide <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>">
			<div class="searchBox">
				<form id="search-form" action="<?php echo U('Search/group');?>" method="post">
					<input type="search" id="keyword" name="w" placeholder="请输入搜索词" autocomplete="off"/>
				</form>
			</div>
			<div class="voiceBtn"></div>
		</section>
		<section class="navBox pageSliderHide">
			<ul>
				<li class="dropdown-toggle caret category" data-nav="category">
					<span class="nav-head-name"><?php if($now_category): echo ($now_category["cat_name"]); else: ?>全部分类<?php endif; ?></span>
				</li>
				<li class="dropdown-toggle caret biz subway" data-nav="biz">
					<span class="nav-head-name"><?php if($now_area): echo ($now_area["area_name"]); else: ?>全城<?php endif; ?></span>
				</li>
				<li class="dropdown-toggle caret sort" data-nav="sort">
					<span class="nav-head-name"><?php echo ($now_sort_array["sort_value"]); ?></span>
				</li>
			</ul>
			<div class="dropdown-wrapper">
				<div class="dropdown-module">
					<div class="scroller-wrapper">
						<div id="dropdown_scroller" class="dropdown-scroller" style="overflow:hidden;">
							<div>
								<ul>
									<li class="category-wrapper">
										<ul class="dropdown-list">
											<li data-category-id="-1" <?php if(empty($top_category)): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="全部分类">全部分类</span></li>
											<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-category-id="<?php echo ($vo["cat_url"]); ?>" <?php if($vo['cat_count'] > 1): ?>data-has-sub="true"<?php else: ?>onclick="list_location($(this));return false;"<?php endif; ?> class="<?php if($vo['cat_count'] > 1): ?>right-arrow-point-right<?php endif; ?> <?php if($top_category['cat_url'] == $vo['cat_url']): ?>active<?php endif; ?>">
													<span data-name="<?php echo ($vo["cat_name"]); ?>"><?php echo ($vo["cat_name"]); ?></span>
													<?php if($vo['cat_count'] > 1): ?><span class="quantity"><b></b></span><?php endif; ?>
													<div class="sub_cat hide" style="display:none;">
														<?php if($vo['cat_count'] > 1): ?><ul class="dropdown-list sub-list">
																<li data-category-id="<?php echo ($vo["cat_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($vo["cat_name"]); ?>">全部</span></div></li>
																<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li data-category-id="<?php echo ($voo["cat_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($voo["cat_name"]); ?>"><?php echo ($voo["cat_name"]); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
															</ul><?php endif; ?>
													</div>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
									<?php if($all_area_list): ?><li class="biz-wrapper">
											<ul class="dropdown-list">
												<li data-area-id="-1" <?php if(empty($now_area_url)): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="全城">全城</span></li>
												<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-area-id="<?php echo ($vo["area_url"]); ?>" <?php if($vo['area_count'] > 0): ?>data-has-sub="true"<?php else: ?>onclick="list_location($(this));return false;"<?php endif; ?> class="<?php if($vo['area_count'] > 0): ?>right-arrow-point-right<?php endif; ?> <?php if($top_area['area_url'] == $vo['area_url']): ?>active<?php endif; ?>">
														<span><?php echo ($vo["area_name"]); ?></span>
														<?php if($vo['area_count'] > 0): ?><span class="quantity"><b></b></span><?php endif; ?>
														<div class="sub_cat hide" style="display:none;">
															<?php if($vo['area_count'] > 0): ?><ul class="dropdown-list sub-list">
																	<li data-area-id="<?php echo ($vo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($vo["area_name"]); ?>">全部</span></div></li>
																	<?php if(is_array($vo['area_list'])): $j = 0; $__LIST__ = $vo['area_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li data-area-id="<?php echo ($voo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($voo["area_name"]); ?>"><?php echo ($voo["area_name"]); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
																</ul><?php endif; ?>
														</div>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</li><?php endif; ?>
									<li class="sort-wrapper">
										<ul class="dropdown-list">
											<?php if(is_array($sort_array)): $i = 0; $__LIST__ = $sort_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-sort-id="<?php echo ($vo["sort_id"]); ?>" <?php if($vo['sort_id'] == $now_sort_array['sort_id']): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="<?php echo ($vo["sort_value"]); ?>"><?php echo ($vo["sort_value"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						<div id="dropdown_sub_scroller" class="dropdown-sub-scroller"><div></div></div>
					</div>
				</div>
			</div>
		</section>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<script id="storeListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.store_list.length; i < len; i++){ }}
						<dd>
							<div class="brand link-url" data-url="{{ d.store_list[i].url }}">
								<div class="brandCon">{{ d.store_list[i].store_name }}<span class="location-right">{{ d.store_list[i].range_txt }}</span></div>
							</div>
							<ul class="goodList">
								{{# for(var j = 0, jlen = d.store_list[i].group_list.length; j < jlen; j++){ }}
									<li class="link-url" data-url="{{ d.store_list[i].group_list[j].url }}" {{# if(j > 1){ }}style="display:none;"{{# } }}>
										<div class="dealcard-img imgbox">
											<img src="{{d.store_list[i].group_list[j].list_pic}}" alt="{{ d.store_list[i].group_list[j].group_name }}"/>
										</div>
										<div class="dealcard-block-right">
											<div class="title">{{ d.store_list[i].group_list[j].group_name }}</div>
											<div class="price">
												<strong>{{ d.store_list[i].group_list[j].price }}</strong><span class="strong-color">元</span>{{# if(d.store_list[i].group_list[j].wx_cheap){ }}<span class="tag">微信再减{{ d.store_list[i].group_list[j].wx_cheap }}元</span>{{# } }}<span class="line-right">已售{{ d.store_list[i].group_list[j].sale_count }}</span>
											</div>
										</div>
									</li>
								{{# } }}
								{{# if(d.store_list[i].group_list.length > 2){ }}
									<li class="more">其他{{ d.store_list[i].group_list.length-2 }}个<?php echo ($config["group_alias_name"]); ?></li>
								{{# } }}
							</ul>
						</dd>
					{{# } }}
				</script>
				<script id="groupListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.group_list.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d.group_list[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{{d.group_list[i].list_pic}}" alt="{{ d.group_list[i].s_name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{# if(d.group_list[i].tuan_type != 2){ }} {{ d.group_list[i].merchant_name }} {{# }else{ }} {{ d.group_list[i].s_name }} {{# } }}</div>								
								<div class="title">{{ d.group_list[i].group_name }}</div>
								<div class="price">
									<strong>{{ d.group_list[i].price }}</strong><span class="strong-color">元</span>{{# if(d.group_list[i].wx_cheap){ }}<span class="tag">微信再减{{ d.group_list[i].wx_cheap }}元</span>{{# }else{ }}<del>{{ d.group_list[i].old_price }}</del>{{# } }} <span class="line-right">已售{{ d.group_list[i].sale_count }}</span>
								</div>
							</div>
						</dd>
					{{# } }}
				</script>
				<section class="storeListBox listBox">
					<dl></dl>
					<div class="shade hide"></div>
					<div class="no-deals hide">暂无此类<?php echo ($config["group_alias_name"]); ?>，请查看其他分类</div>
				</section>
				<div id="pullUp">
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var shareData={
						imgUrl: "<?php echo $group_list[0]['list_pic'];?>", 
						link: "<?php echo ($config["site_url"]); echo U('Group/index');?>",
						title: "<?php echo ($config["group_alias_name"]); ?>列表 小农丁-致力于打造中国最专业的O2O生态农场平台",
						desc: "小农丁（www.xiaonongding.com）-国内首家O2O生态农场平台。作为农场主，小农丁为您提供专业的线上农场管理平台，帮助您快速建立农小店线上PC端、手机端及微信端销售渠道，帮助您快速发布农特产品团购，农场众筹及农场体验活动。作为消费者，您在小农丁不仅能够以低廉的价格购买到平台为您推荐的各种农场的优质农特产品，而且能在这里参加农场主发起的创意采摘、种植、农家乐，一起来种菜等各种直达田间体验活动。走出城市，回归自然，有机为本，健康第一！"
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
	</body>
</html>