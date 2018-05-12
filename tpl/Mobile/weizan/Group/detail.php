<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>商品详情页</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no" />
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css?v=3.22"/>
		<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
		<body>
			<!-- 详情顶部大图 -->
			<div class="public_cen">
				<div class="phone-xq">
					<img src="{pigcms{$now_group.pic.0.s_image}">
				</div>
				<div class="phone-xq-title">
					<h3>{pigcms{$now_group.group_name}</h3>
					<span>&yen;{pigcms{$now_group.price}</span>
				</div>
				<div class="phone-xq-num">
					<h4>销量：<php>echo $now_group['sale_count']+$now_group['virtual_num'];</php></h4>
				</div>
				<!-- 店铺信息 -->
				<div class="phone-xq-shop">
					<div class="phone-xq-shop-cen">
						<div class="phone-xq-shop-portrait">
							<img src="{pigcms{$now_group.person_image}">
						</div>
						<div class="phone-xq-shop-title">
							<h3>{pigcms{$now_group.person_name}</h3>
							<span><b><php>echo getRealAreaName($now_group['area_id']);</php></b> <php>echo round($now_group['distance']/1000,2);</php>km</span>
						</div>
						<div class="phone-xq-shop-get">
							<a href="{pigcms{:U('Merchant/detail',array('mer_id'=>$now_group['mer_id']))}">进店看看</a>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
				
				<!-- 产品详情 -->
				<div class="phone-xq-details">
					<div class="phone-xq-details-title">
						<span></span>
						<h3>商品介绍</h3>
					</div>
					<div class="phone-xq-details-con">
							{pigcms{$now_group.content}
					</div>
				</div>
				<div class="xnd-logo">
					<img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
				</div>
				<style>
					.phone-xq-details-con img{
						width: 100%;
					}
				</style>
				<!-- 底部浮动 -->
				<div style="width: 100%; height: 55px;"></div>
				<div class="phone-order-footer-del" style="z-index: 100000000;">
					<div class="order-footer-left">
						<p style="color: #fff;">
						<a class="phone-group-xq-footer-add" style="cursor:pointer;" href="app:main">
								<img src="{pigcms{$static_path}images/xnd_img/iconfont-dianpu.png" height="22px" />
								<span>首页</span> 
							</a>
							<a class="phone-group-xq-footer-add" style="cursor:pointer;" onclick="addCollect({pigcms{$now_group.group_id});">
								<if condition="$is_collect">
								<img class="img-ysc" src="{pigcms{$static_path}images/xnd_img/iconfont-shoucangyishoucang.png" height="22px" style="margin-top: 5px;" />
								<span id="collect">已收藏</span>
								<else/>
								<img class="img-ysc" src="{pigcms{$static_path}images/xnd_img/iconfont-guanzhu.png" height="20px" style="margin-top: 7px;" />
								<span id="collect">收藏</span>
								</if>
							</a>
							
							<a class="phone-group-xq-footer-add" style="cursor:pointer;" href="{pigcms{:U('Group/shopcart',array('group_id'=>$now_group['group_id']))}">
								<img src="{pigcms{$static_path}images/xnd_img/iconfont-gouwuche.png"  height="22px"/>
								<span>购物车</span> 
							</a>
						</p>
					</div>
					<if condition ="$islogin">
						<a class="order-footer-a" href="{pigcms{:U('Group/shopcart',array('group_id'=>$now_group['group_id']))}">
						立即购买
					</a>
					<else/>
					<a class="order-footer-a" href="app:redirect:login">
						登陆购买
					</a>
					</if>
				
				</div>
				
			</div>
		</body>
		<script type="text/javascript">
			function getDetail(){
				var msg = '{ "url":"{pigcms{$config.site_url}/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$now_group.group_id}","image_url":"{pigcms{$now_group.pic.0.s_image}","title": "{pigcms{$now_group.s_name}", "price": "{pigcms{$now_group.price}", "content": "{pigcms{$now_group.group_name}" }';
				return msg;
			}
			function addCollect(id){
			 $.post("{pigcms{:U('Group/addGroupCollect')}",{id:id},function(result){
			 	var obj = eval('(' + result + ')');
    			if(obj.status==1){
    			if($("#collect").html()=="收藏"){
    				$("#collect").html("已收藏");
    				$(".img-ysc").attr("src","/tpl/Static/weizan/images/xnd_img/iconfont-shoucangyishoucang.png");
    			}else{
    				$("#collect").html("收藏");
    				$(".img-ysc").attr("src","/tpl/Static/weizan/images/xnd_img/iconfont-guanzhu.png");
    				
    				}  
    			}else{
    				if(obj.msg=="login"){
    					alert("请先登录！");
    					window.location.href="app:redirect:{pigcms{$config.site_url}/mobile.php?g=Mobile&c=Group&a=detail&group_id="+id;
    				}else{
    					alert(obj.msg);
    				}
    			}
  			 });
		}
		</script>
		</script>
</html>