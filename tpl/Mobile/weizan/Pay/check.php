<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>购物车</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
		<style>
        	.phone-add{
        		color: #000000;
        		font-size: 14px;
        		line-height: 80px;
        		display: block;
        		width: 100%;
        		text-align: center;
        	}
        </style>
	</head>
	<body class="phone-car-body">
		<div class="public_cen">
			<div class="phone-car-header">
				<a href="{pigcms{:U('User/adress',array('order_id'=>$_GET['order_id'],'type'=>$_GET['type']))}">
				<span class="phone-car-header-bg">
					<img src="{pigcms{$static_path}images/xnd_img/phone-price-header.jpg">
				</span>
				<if condition="$address">
				<div class="phone-car-header-cen">
					
					<span class="phone-car-header-rg">
							<img src="{pigcms{$static_path}images/xnd_img/phone-car-header-more.jpg">
					</span>
					<h3 class="phone-car-header-title">
						<img src="{pigcms{$static_path}images/xnd_img/phone-car-header-my.jpg">{pigcms{$address.name}
						<span>
							<img src="{pigcms{$static_path}images/xnd_img/phone-car-header-sj.jpg">{pigcms{$address.phone}
						</span>
					</h3>
					
					<input type="hidden" id="address_id" name="address_id" value="{pigcms{$address.adress_id}"/>
					<p>{pigcms{$address.province_txt}{pigcms{$address.city_txt}{pigcms{$address.area_txt}{pigcms{$address.adress}</p>
				</div>
				<else/>
				<div class="phone-car-header-cen">
					<a class="phone-add" href="{pigcms{:U('User/adress',$_GET)}">添加新地址+</a>
				</div>
				<input type="hidden" id="address_id" name="address_id" value="{pigcms{$address.adress_id}"/>
				</if>
				<span class="phone-car-header-bg">
					<img src="{pigcms{$static_path}images/xnd_img/phone-price-header.jpg">
				</span>
				</a>
			</div>
			<div class="phone-car-price">
				<ul>
					<li>
						<span>&yen;{pigcms{$order_info.order_total_money}</span>
						订单金额含优惠
					</li>
					<li>
						<span>﹣&yen;<php>echo $order_info['order_total_money']-$pay_money;</php></span>
						优惠金额
					</li>
					<li>
						<if condition="$pay_money gt 0">
						<span><b>&yen;{pigcms{$pay_money}</b></span>
						<h3>您还需支付</h3>
						<else/>
						<h3>直接使用余额支付</h3>
						</if>
					</li>
				</ul>
			</div>
			<if condition="$pay_money gt 0">
			<div class="phone-car-zhifu">
				<ul>
					<li>
						<input type="radio" name="pay_type" value="weixin"/>
						<div class="phone-car-ka">
							<img src="{pigcms{$static_path}images/xnd_img/phone-car-icon.jpg">
							<h3>微信支付</h3>
							<span>绿色通道，安全便捷</span>
						</div>
						<div style="clear: both;"></div>
					</li>
					<li >
						<input type="radio" name="pay_type" value="alipay"/>
						<div class="phone-car-ka">
							<img src="{pigcms{$static_path}images/xnd_img/phone-car-icon2.jpg">
							<h3>支付宝</h3>
							<span>支持大额订单支付</span>
						</div>
						<div style="clear: both;"></div>
					</li>
					<div style="clear: both;"></div>
				</ul>
				<div style="clear: both;"></div>
			</div>
		</if>
		</div>
		<div style="width: 100%; height: 60px;"></div>
		<div class="phone-order-footer-del">

			<if condition="$pay_money gt 0">
			<div class="order-footer-left">
				<p style="color: #fff;">实付款：<span id="real_pay">{pigcms{$pay_money}</span></p>
			</div>
			<a class="order-footer-a" href="#" onclick="go_to_pay();">
				确认支付
			</a>
			<else/>
			<div class="order-footer-left">
				<p style="color: #fff;">使用余额支付</p>
			</div>
			<form id="myform" action="{pigcms{:U('Pay/go_pay')}" method="post">
				<input type="hidden" name="order_id" value="{pigcms{$order_info.order_id}">
				<input type="hidden" name="order_type" value="{pigcms{$order_info.order_type}">
			<a class="order-footer-a" href="#" onclick="redirect_pay();">
				确认支付
			</a>
			</form>
			</if>
		</div>
		<script>
		<if condition="$pay_money gt 0">
		$('input:radio:first').attr('checked', 'checked');
		</if>
		var clickevent=false;
		var postaddress=false;
		function go_to_pay(){
			if(clickevent){
				return;
			}
			clickevent=true;
			var pay_money=$("#real_pay").text();
			if(pay_money==""){
				alert("没有支付金额！");
				clickevent=false;
				return;
			}
			var order_id={pigcms{$order_info.order_id};
			//如果是非实物类型不需要传递地址
			var tuan_type={pigcms{$order_info.tuan_type};
			if(tuan_type==0||tuan_type==1){
					postaddress=true;
			}
			//先提交地址信息
			var address_id=$("#address_id").val();
			if(!postaddress){
				if(address_id==""){
				alert("请先选择地址！");
				clickevent=false;
				return;
				}
				//请求先保存地址
				$.ajax({
             	type: "post",
             	url: "{pigcms{:U('Group/saveOrderAddress')}",
             	data: {address_id:address_id,order_id:order_id},
             	async:false,
             	dataType: "json",
             	success: function(data){
                        var obj=eval(data);
    		 			clickevent=false;
    		 		   if(obj.status==1){
    		 		     	postaddress=true;
    		 		   }
                      }
         		});
			}
			//如果有地址才支付
			if(postaddress){
				var pay_type=$("input[type='radio']:checked").val();
				clickevent=false;
				// window.location.href="mobile.php?g=Mobile&c=Pay&a=go_pay&order_type=group&pay_type="+pay_type+"&order_id={pigcms{$order_info.order_id}";
                                       window.location.href= "app:"+pay_type+":{pigcms{$order_info.order_type}:{pigcms{$order_info.order_id}";
			}
		}

		function redirect_pay(){
			if(clickevent){
				return;
			}
			clickevent=true;
			

			var order_id={pigcms{$order_info.order_id};

			//如果是非实物类型不需要传递地址
			var tuan_type={pigcms{$order_info.tuan_type};
			if(tuan_type==0||tuan_type==1){
					postaddress=true;
			}
			//先提交地址信息
			var address_id=$("#address_id").val();
			if(!postaddress){
				if(address_id==""){
				alert("请先选择地址！");
				clickevent=false;
				return;
				}
				//请求先保存地址
				$.ajax({
             	type: "post",
             	url: "{pigcms{:U('Group/saveOrderAddress')}",
             	data: {address_id:address_id,order_id:order_id},
             	async:false,
             	dataType: "json",
             	success: function(data){
                        var obj=eval(data);
    		 			clickevent=false;
    		 		   if(obj.status==1){
    		 		     	postaddress=true;
    		 		   }
                      }
         		});
			}
			//如果有地址才支付
			if(postaddress){
			$("#myform").submit();
			}
		}
		</script>
	</body>
</html>