<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{pigcms{$tpl.wxname}</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}tpl/com/css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}tpl/com/css/xnd-phone-show.css"/>

	</head>
	<body class="xnd-phone-bg">
		<div class="xnd-phone-center">
			<!-- 农场大图 -->
			<div class="xnd-phont-header-img" style="background-image: url({pigcms{$currentmerchant.merchant_theme_image});">
				
			</div>
			<!-- 农场大图 end -->
			<!-- 已筹、店铺、粉丝 -->
				<div class="xnd-phone-nav">
					<ul>
						<li>
							<if condition="$storenum">
							<h3>{pigcms{$storenum}件</h3>
							<else/>
							<h3>0件</h3>
							</if>
							<span>特卖</span>
						</li>
						<li>
							<if condition="$currentmerchant['hits']">
								<if condition="$mer_id eq 1116 ">
									<h3><?php echo $currentmerchant["hits"]+30 ?>次</h3>
									<else />
									<h3>{pigcms{$currentmerchant.hits}次</h3>
								</if>

							<else/>
							<h3>0</h3>
							</if>
							<span>浏览</span>
						</li>
						<li>
							<if condition="$mer_id eq 1116 ">
								<h3><?php echo $currentmerchant["fans_count"]+5 ?>人</h3>
								<else />
								<h3>{pigcms{$currentmerchant.fans_count}人</h3>
							</if>

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
					<img src="{pigcms{$currentmerchant.person_image}"  />
				</div>
				<div class="xnd-phone-shop-title">
					<h3>{pigcms{$currentmerchant.person_name}</h3>
					<p>电话：{pigcms{$currentmerchant.phone}</p>
				</div>
				<div class="xnd-phone-shop-tel">
					<a href="tel:{pigcms{$currentmerchant.phone}"><img src="{pigcms{$static_path}tpl/com/images/xnd-phone-icon.png"></a>
				</div>
				<div style="clear: both;"></div>
			</div>
			<!-- 店铺信息end -->

            <!-- 农场抽奖推荐 -->
            <notempty name="group_list_lottery">
                <div class="xnd-phone-hot margin-top10">
                    <div class="xnd-phone-header">
                        <span class="fl-span"></span>
                        <h3>抽奖团推荐</h3>
                    </div>
                    <div class="xnd-phone-list">
                        <ul>
                            <volist name="group_list_lottery" id="group">
                                <li>
                                    <if condition="$group['is_group_buy'] eq 1">
                                        <a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id={pigcms{$group.group_id}">
                                            <else/>
                                            <a href="/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$group.group_id}">
                                    </if>
                                    <div class="xnd-phone-list-img" style="background-image: url({pigcms{$group.all_pic.0.image});">
                                    </div>
                                    <div class="xnd-phone-list-right">
                                        <h3 class="title">{pigcms{$group.name}</h3>
                                        <p>{pigcms{$group.intro}</p>
                                        <div class="list-right-btm">
                                            <span>销售：<php>echo $group['sale_count']+$group['virtual_num'];</php></span>
                                            <h4><b>{pigcms{$group.price}</b></h4>
                                        </div>
                                    </div>
                                    </a>
                                    <div style="clear: both;"></div>
                                </li>
                            </volist>
                            <div style="clear: both;"></div>
                        </ul>
                    </div>
                </div>
            </notempty>
            <!-- 农场抽奖推荐end -->

            <!-- 农场精品推荐 -->
            <notempty name="group_list">
			<div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农场特卖推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<volist name="group_list" id="group">
						<li>
							<if condition="$group['is_group_buy'] eq 1">
							<a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id={pigcms{$group.group_id}">
							<else/>
							<a href="/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$group.group_id}">
							</if>
							<div class="xnd-phone-list-img" style="background-image: url({pigcms{$group.all_pic.0.image});">
							</div>
							<div class="xnd-phone-list-right">
								<h3 class="title">{pigcms{$group.name}</h3>
								<p>{pigcms{$group.intro}</p>
								<div class="list-right-btm">
									<span>销售：<php>echo $group['sale_count']+$group['virtual_num'];</php></span>
									<h4><b>{pigcms{$group.price}</b></h4>
								</div>
							</div>
							</a>
							<div style="clear: both;"></div>
						</li>
					</volist>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div>
            </notempty>
			<!-- 农场精品推荐end -->
			
				<!-- 农场拼团推荐 -->
			<notempty name="group_list_pin">
			<div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农场拼团推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<volist name="group_list_pin" id="group">
							<li>
								<if condition="$group['is_group_buy'] eq 1">
									<a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id={pigcms{$group.group_id}">
										<else/>
										<a href="/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$group.group_id}">
								</if>
								<div class="xnd-phone-list-img" style="background-image: url({pigcms{$group.all_pic.0.image});">
								</div>
								<div class="xnd-phone-list-right">
									<h3 class="title">{pigcms{$group.name}</h3>
									<p>{pigcms{$group.intro}</p>
									<div class="list-right-btm">
										<span>销售：<php>echo $group['sale_count']+$group['virtual_num'];</php></span>
										<h4><b>{pigcms{$group.price}</b></h4>
									</div>
								</div>
								</a>
								<div style="clear: both;"></div>
							</li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div>
				</notempty>
			<!-- 农场拼团推荐end -->

			<!-- 农场团长免单推荐 -->
			<notempty name="group_list_first_free">
			<div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>团长免单推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<volist name="group_list_first_free" id="group">
							<li>
								<if condition="$group['is_group_buy'] eq 1">
									<a href="/wap.php?g=Wap&c=NewGroup&a=detail&group_id={pigcms{$group.group_id}">
										<else/>
										<a href="/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$group.group_id}">
								</if>
								<div class="xnd-phone-list-img" style="background-image: url({pigcms{$group.all_pic.0.image});">
								</div>
								<div class="xnd-phone-list-right">
									<h3 class="title">{pigcms{$group.name}</h3>
									<p>{pigcms{$group.intro}</p>
									<div class="list-right-btm">
										<span>销售：<php>echo $group['sale_count']+$group['virtual_num'];</php></span>
										<h4><b>{pigcms{$group.price}</b></h4>
									</div>
								</div>
								</a>
								<div style="clear: both;"></div>
							</li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div>
				</notempty>
			<!-- 团长免单推荐end -->

            <!-- 农场众筹 -->
            <notempty name="crowdfundings">
                <div class="xnd-phone-hot margin-top10">
                    <div class="xnd-phone-header">
                        <span class="fl-span"></span>
                        <h3>农场众筹推荐</h3>
                    </div>
                    <div class="xnd-phone-list">
                        <ul>
                            <volist name="crowdfundings" id="crowdfunding">
                                <li>

                                            <a href="/wap.php?g=Wap&c=Crowdfunding&a=detail&crowdid={pigcms{$crowdfunding.crowd_id}">

                                    <div class="xnd-phone-list-img" style="background-image: url({pigcms{$crowdfunding.webpic});">
                                    </div>
                                    <div class="xnd-phone-list-right">
                                        <h3 class="title">{pigcms{$crowdfunding.title}</h3>
                                        <p>{pigcms{$crowdfunding.digest}</p>
                                        <div class="list-right-btm" style="display: inline-block;">
                                            <span>已众筹：{pigcms{$crowdfunding.total}元</span>
<!--                                            <span>目标:{pigcms{$crowdfunding.funds}元 &nbsp;&nbsp;</span>-->
                               <!--   <h4><b>目标众筹：{pi:gcms{$crowdfunding.funds}元</b></h4>-->
                                        </div>
                                    </div>
                                    </a>
                                    <div style="clear: both;"></div>
                                </li>
                            </volist>
                            <div style="clear: both;"></div>
                        </ul>
                    </div>
                </div>
            </notempty>
            <!-- 农场众筹推荐end -->
			
			<if condition="$meal_list">
			<!-- 农场产品 -->
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农小店热卖</h3>
				</div>
				<ul>
					<volist name="meal_list" id="meal">
					<li>
						<a href="/wap.php?g=Wap&c=Food&a=menu&mer_id={pigcms{$mer_id}&store_id={pigcms{$store_id}">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$meal.image.image});">
						</div>
						<h3 class="xnd-phone-more-tit">{pigcms{$meal.name}</h3>
						<div class="xnd-phone-more-con">
							<span><b>{pigcms{$meal.price}</b>/{pigcms{$meal.unit}</span>
							<h3>销售：{pigcms{$meal.sell_count}</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					</volist>
				</ul>
				<div style="clear: both;"></div>
			</div>
			

			<div style="width: 100%; height: 60px;"></div>
			<div class="ab_footer">
				<a href="/wap.php?g=Wap&c=Food&a=menu&mer_id={pigcms{$mer_id}&store_id={pigcms{$store_id}">进入农小店</a>
			</div>
			</if>
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
			<a href="http://www.xiaonongding.com/mobile.php?g=Mobile&c=Merchant&a=getPicturesList&mer_id={pigcms{$mer_id}">
			<h3>
				农场<br />相册
			</h3>
			</a>
		</div>
		<script type="text/javascript">
			var shareData={
						imgUrl: "{pigcms{$currentmerchant.person_image}", 
						link: "http://www.xiaonongding.com/wap.php?g=Wap&c=index&a=index&mer_id={pigcms{$mer_id}&store_id={pigcms{$store_id}",
						title: "{pigcms{$tpl.wxname}",
						desc: "{pigcms{$currentstore.txt_info}"
			};
		</script>
		 <include file="Share:share"/>
	</body>
</html>
