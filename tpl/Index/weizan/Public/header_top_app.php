<!-- 王强新增header -->
<!-- 公用头部 -->
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/header.css">
<link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.min.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/channel_block.css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" />

<script src="{pigcms{$static_path}js/xnd_js/headerfoot_black.min.js" async="async"></script>
<!-- 公用头部 -->
<div class="q-layer-header" style="position:absolute; z-index: 1000000000000000; left: 0; top: 0;">
			<div class="header-inner">
				<a href="/">
					<img class="logo" src="{pigcms{$static_path}images/xnd_img/index_logo_small.png"  height="18" />
				</a>
				<div class="nav">
					<ul class="nav-ul">
							<li class="nav-list nav-list-layer index_over">
								<span class="nav-span">
								当前地区：<php>echo $_SESSION["cityarr"]['0']['area_name'];</php><i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									
									<div class="q-layer q-layer-section">
												<div class="q-layer">
													<div class="section-title">
														
														<i class="iconfont icon-jiantouyou"></i>
													</a>
														<span>热门地区</span>
													</div>
													<dl class="section-item" style="display: none;">
														<dt>ALL</dt>
														<dd>
															<a href="{pigcms{$config.site_url}/categorycityid/all">全国</a>
														</dd>
													</dl>
													<dl class="section-item">
													
														<dd>
															<a style="position: relative; left: -10px;"><b>推荐：</b></a>
															<a href="{pigcms{$config.site_url}?cityid=all">全国</a>
															<a href="http://www.xiaonongding.com/?cityid=2268">青岛</a>
															<a href="http://www.xiaonongding.com/?cityid=442">佛山</a>
															<a href="http://www.xiaonongding.com/?cityid=338">定西</a>
															<a href="http://www.xiaonongding.com/?cityid=403">天水</a>
														</dd>
													</dl>
													<volist name="cities" id="city">
													<if condition="$city">
													<dl class="section-item" style="display: none;">
														<dt><php>echo strtoupper($key);</php></dt>
														<dd>
															<volist name="city" id="one">
															<a href="{pigcms{$config.site_url}<php>echo "/categorycityid/";</php>{pigcms{$one[area_id]}">{pigcms{$one.area_name}</a>
															</volist>
														</dd>
													</dl>
													<else/>
													</if>
													</volist>
												</div>
									</div>
								
								</div>
							</li>
							<li class="nav-list ">
								<a class="nav-span" href="/category/all" title="">农特超市</a>
							</li>
							
							<li class="nav-list nav-list-layer" style="display: none;">
								<span class="nav-span">
								农丁社区<i class="iconfont icon-jiantouxia"></i>
							</span>
								<div class="q-layer q-layer-nav q-layer-arrow">
									<ul>
										<li>
											<a href="" title="">
												<i class="iconfont icon-wenda"></i> 旅行问答
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
										<li>
											<a href="" title="">
												<i class="iconfont icon-shenghuoshiyanshi"></i> 生活实验室
											</a>
										</li>
									</ul>
								</div>
							</li>
                            <li class="nav-list ">
								<a class="nav-span icon-phone-a" href="">
									<i class="iconfont icon-phone"></i>手机小农丁</a>
							</li>
						</ul>
				</div>
				<div class="fun">
					<div id="siteSearch" class="nav-search">
						<form action="{pigcms{:U('Group/Search/index')}" method="post">
							<input class="txt" name="w" type="text" autocomplete="off">
							<button class="btn" type="submit">
								<i class="iconfont icon-sousuo"></i>
								<span>搜索</span>
							</button>
						</form>
					</div>
					<div id="js_qyer_header_userStatus" class="status">
						<div class="login show">
							
							<a class="otherlogin-link2">
								<i class="iconfont icon-weixin"></i>
							</a>
							<if condition="empty($user_session)">
						<a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a>
						<a href="{pigcms{:U('Index/Login/reg')}">注册 </a>
							<else/>
							<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
							<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
							</if>
						</div>
					</div>
					<if condition="empty($user_session)">
						<div class="nav-list nav-list-layer">
						</div>
					<else/>	
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								个人中心<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的订单
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的评价
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的收藏
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 我的积分
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 账户余额
										</a>
									</li>
									<li>
										<a href="" title="">
											<i class="iconfont icon-wenda"></i> 收货地址
										</a>
									</li>
								</ul>
							</div>
					</div>
					</if>
					<div class="nav-list nav-list-layer">
							<span class="nav-span" style=" padding: 0px 0px 0px 10px; margin-right: 0;">
								我是农场主<i class="iconfont icon-jiantouxia"></i>
							</span>
							<div class="q-layer2 q-layer-nav q-layer-arrow2">
								<ul>
									<li>
										<a href="{pigcms{$config.site_url}/merchant.php" title="">
											<i class="iconfont icon-wenda"></i> 商家中心
										</a>
									</li>
									<li>
										<a href="{pigcms{$config.site_url}/merchant.php" title="">
											<i class="iconfont icon-wenda"></i> 我想合作
										</a>
									</li>
									
								</ul>
							</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶部导航end -->
		
		<script type="text/javascript" src="js/header.js" async="async"></script>
		<!-- 公共头部 end -->
		
		<!-- 公用头部 -->

<!-- 王强新增header end -->


