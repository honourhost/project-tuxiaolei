<?php if(!defined('THINK_PATH')) exit('deny access!');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>{pigcms{$config.site_name}</title>
		<meta name="description" content="{pigcms{$config.seo_description}">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
		<link href="{pigcms{$static_path}css/index_wap.css?time=11" rel="stylesheet"/>
		<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	</head>
	<body id="index">
        <header class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('Group/around')}" class="react">
               		<span class="nav-city"><img src="{pigcms{$static_path}images/liuchang/fujintuan.png" style="width: 22px;margin-top: -2px;padding: 0 4px;"></span>
           		</a>
            </div>
            <div class="box-search">
            	<a href="{pigcms{:U('Search/index')}" class="react">
                	<i class="icon-search text-icon"></i>
               		<span>输入您想找的商品/店铺</span>
           		 </a>
           	</div>
            <div class="nav-wrap-right">
                <a class="react" rel="nofollow" href="javascript:;" onclick="wx_saoyisao()" >
                    <span class="nav-btn">
                        <span class="nav-city"><img src="/liuchang/images/wap/saoyisao.png" style="width: 22px;margin-top: -2px;"></span>
                    </span>
                </a>
                <!--全部分类 {pigcms{:U('Group/navigation')}-->
            </div>
        </header>
        <div id="container">
			<if condition="$wap_index_top_adver">
				<section class="banner">
					<div class="swiper-container swiper-container1">
						<div class="swiper-wrapper">
							<volist name="wap_index_top_adver" id="vo">
								<div class="swiper-slide">
									<a href="{pigcms{$vo.url}">
										<img src="{pigcms{$vo.pic}"/>
									</a>
								</div>
							</volist>
						</div>
						<div class="swiper-pagination swiper-pagination1"></div>
					</div>
				</section>
			</if>
			<if condition="$wap_index_slider">
				<dl class="list list-in" style="height:170px;">
					<dd style="height:100%;">
						<div class="swiper-container swiper-container2">
							<div class="swiper-wrapper">
								<volist name="wap_index_slider" id="vo">
									<div class="swiper-slide">
										<ul class="icon-list">
											<volist name="vo" id="voo">
												<li class="icon">
													<a class="react" href="{pigcms{$voo.url}">
														<span class="icon-circle typeid1"><img src="{pigcms{$voo.pic}"/></span>
														<span class="icon-desc">{pigcms{$voo.name}</span>
													</a>
												</li>
											</volist>
										</ul>
									</div>
								</volist>
							</div>
							<div class="swiper-pagination swiper-pagination2"></div>
						</div>
					</dd>
				</dl>
			</if>
            <!-- 刘畅  去掉粉丝提示
			<if condition="$invote_array">
				<dl class="list">
					<a href="{pigcms{$invote_array.url}" style="color:#888;display:block;height:50px;line-height: 50px;">
						<img src="{pigcms{$invote_array.avatar}" style="height:50px;margin-right:20px;margin-top:-2px"/>
						{pigcms{$invote_array.txt}
					</a>
				</dl>
			<else />
				<if condition="$share">
					<dl class="list">
						<a href="{pigcms{$share.a_href}" style="color:#888;display:block;height:50px;line-height: 50px;">
							<img src="{pigcms{$share.image}" style="height:50px;margin-right:20px;margin-top:-2px"/>
							{pigcms{$share.title}
						</a>
					</dl>
				</if>
			</if>-->
            
            <div class="liu_kj liu_margin_top">
                <div class="liu_kj_xiao">
                      <a href="{pigcms{$wap_index_center_ad.0.url}">
                        <img src="{pigcms{$wap_index_center_ad.0.pic}"/>
                      </a>
                </div>
                <div class="liu_kj_xiao">
                    <a href="{pigcms{$wap_index_center_ad.1.url}">
                         <img src="{pigcms{$wap_index_center_ad.1.pic}"/>
                    </a>
                    <div class="liu_border_left"></div>
                </div>
                <div class="liu_kj_xiao2">
                     <a href="{pigcms{$wap_index_center_ad.2.url}">
                          <img src="{pigcms{$wap_index_center_ad.2.pic}"/>
                     </a>
                    <div class="liu_border_left"></div>
                </div>
            </div>

	    	<div class="liu_list_title liu_margin_top">优惠推荐 <a href="{pigcms{:U('Group/index')}">更多</a> </div>
            <div class="liu_kj liu_list">
                <volist name="index_sort_group_list" id="vo">
                    <if condition='$i lt 3'>
                        <div class="liu_kj_da<if condition='$i eq 2'>2</if>">
                            <a href="{pigcms{$vo.url}" group-id="{pigcms{$vo.group_id}">   
                                <h1 <if condition='$i eq 2'>style="color: #ff9a37;"</if>><if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}<else/>{pigcms{$vo.s_name}</if></h1>
                                <h2>{pigcms{$vo.group_name}</h2>
                                <h3>{pigcms{$vo['price']-$vo['wx_cheap']}元</h3>
                                <span style="height: 100px;">
                                    <img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.s_name}"/>
                                </span>
                            </a>
                            <div class="liu_border_top"></div>
                            <div class="liu_border_left"></div>
                        </div>
                    <else/>
                        <div class="liu_kj_xiao<if condition='$i%3 eq 0'>2</if>">
                            <a href="{pigcms{$vo.url}" group-id="{pigcms{$vo.group_id}">		            	
    						    <h5><if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}<else/>{pigcms{$vo.s_name}</if></h5>
    						    <h6>{pigcms{$vo.group_name}</h6>
                                <span>
                                    <img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.s_name}"/>
                                </span>
    					    </a>
                            <div class="liu_border_top"></div>
                            <div class="liu_border_left"></div>
                        </div>
                    </if>
				</volist>
            </div>
			<if condition="$classify_Zcategorys">
				<dl class="list classifyDom">
					<dd>
						<dl>
							<dd class="dd-padding" style="padding:.24rem .2rem .18rem .08rem;">
								<div>
									<a style="color:red;font-weight:bold;" href="{pigcms{:U('Classify/index')}">分类信息</a>
									<a href="{pigcms{:U('Classify/SelectSub')}" class="add"><i class="ico_write"></i>发布信息</a>
								</div>
							</dd>
							<dd>
								<volist name="classify_Zcategorys" id="vo">
									<div class="classify_f_div <if condition='$i eq 1'>on</if>">
										<a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])))}">{pigcms{$vo.cat_name}</a>
									</div>
									<ul <if condition='$i neq 1'>style="display:none;"</if>>
										<volist name="vo['subdir']" id="voo">
											<li><a href="{pigcms{:U('Classify/Lists',array('cid'=>$voo['cid']))}">{pigcms{$voo.cat_name}</a></li>
										</volist>
										<if condition="$vo['subEmptyCount']">
											<for start="0" end="$vo['subEmptyCount']">
												<li></li>
											</for>
										</if>
									</ul>
								</volist>
							</dd>
						</dl>
					</dd>
				</dl>
			</if>
			<if condition="$wap_index_center_adver">
				<dl class="list">
					<dd class="huodong-padding">
						<div class="huodong-line">
							<volist name="wap_index_center_adver" id="vo">
								<div class="huodong-container">
									<a href="{pigcms{$vo.url}">
										<div class="huodong-img-wrapper"><img src="{pigcms{$vo.pic}"/></div>
									</a>
								</div>
								<if condition="$i%2 eq 0 && $i neq 4">
									</div>
									<div class="huodong-line">
								</if>
							</volist>
						</div>
					</dd>
				</dl>
			</if>
            
            
			<dl class="list">
                <div class="liu_list_title liu_margin_top" style="border-bottom:1px #eee solid;">最新{pigcms{$config.group_alias_name}</div>
	    		<dd>
	    			<dl class="list">
	       				<volist name="new_group_list" id="vo">
		        		    <include file="liuchang/moban/wap_group.php"/>
		       			</volist>
					</dl>
				</dd>
	   			<dd class="db">
	   				<a class="react" href="{pigcms{$group_category_all}">
	        			<div class="more">查看全部{pigcms{$config.group_alias_name}</div>
	    			</a>
	    		</dd>
			</dl>
		</div>
		<style>
		#near_banner{padding-right:0px;}
		#near_banner a{width:33.33%;display:inline-block;text-align:center;color:black;padding-bottom:0.2rem;padding-top:0.28rem;font-size:.28rem;}
		#near_content .qianggoucard{height:auto;margin:0;padding:.2rem 0;border-bottom:1px solid #C9C4B8;}
		#near_content .qianggoucard .brand{height:.64rem;overflow:hidden;line-height:.32rem;margin-bottom:.15rem;}
		#near_content .qianggoucard .campaign-price{margin-bottom:0;color:black;font-size:.24rem;}
		</style>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var wechat_name="{pigcms{$config.wechat_name}";var get_near_url="{pigcms{:U('Home/near_info')}";var group_index_sort_url="{pigcms{:U('Home/group_index_sort')}";<if condition="$user_long_lat">var user_long = "{pigcms{$user_long_lat.long}";var user_lat = "{pigcms{$user_long_lat.lat}";<else/>var user_long = '0';var user_lat  = '0';</if></script>
		<script src="{pigcms{$static_path}js/wap_index.js?{pigcms{$_SERVER['REQUEST_TIME']}"></script>
		
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Home",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$config.site_logo}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Home/index')}",
		            "tTitle": "{pigcms{$config.site_name}",
		            "tContent": "{pigcms{$config.seo_description}"
		};
		</script>


		<include file="Public:footer"/>
	</body>
</html>