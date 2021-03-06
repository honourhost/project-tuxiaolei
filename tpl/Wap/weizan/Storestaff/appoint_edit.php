<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>店员中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{pigcms{$static_path}css/diancai.css" rel="stylesheet" type="text/css" />
<style>
.green{color:green;}
.btn{
margin: 0;
text-align: center;
height: 2.2rem;
line-height: 2.2rem;
padding: 0 .32rem;
border-radius: .3rem;
color: #fff;
border: 0;
background-color: #FF658E;
font-size: .28rem;
vertical-align: middle;
box-sizing: border-box;
cursor: pointer;
-webkit-user-select: none;}
.totel{color: green;}
.cpbiaoge td{font-size:1rem;}
</style>
</head>
<body>

<div style="padding: 0.2rem;"> 
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
                <tr>
					<td>编号：{pigcms{$order.order_id}</td>
				</tr>
                <tr>
					<td>服务名称：{pigcms{$order.appoint_name}</td>
				</tr>
                <tr>
					<td>服务项目：{pigcms{$order.service_name} ￥{pigcms{$order.service_money}</td>
				</tr>
				<tr>
					<td>顾客昵称：{pigcms{$order.nickname}</td>
				</tr>
				<tr>
					<td>顾客电话：<a href="tel:{pigcms{$order.phone}" class="totel">{pigcms{$order.phone}</a></td>
				</tr>
				<tr>
					<td>订单金额： 
                        <span class="price"> 
                            <if condition="$order.dingjin_money gt 0">
                                {pigcms{$order.dingjin_money}
                            <else/>
                                无需订金
                            </if>
                        </span>
                        全价：<span class="price"> ￥{pigcms{$order.appoint_price}</span>
                    </td>
				</tr>
				<tr>
					<td>订单状态：
					  <if condition="$order['service_status'] eq 3">
						<span class="red">已取消并退款</span>
						<elseif condition="$order['paid'] eq 0"/>
							<span class="red">未付款</span>
						<else />
							<span class="green">已付款</span>
						</if>
					</td>
				</tr>
				<tr>
					<td>下单时间： {pigcms{$order.order_time|date="Y-m-d H:i:s",###}</td>
				</tr>
                <tr>
					<td>预约时间： {pigcms{$order.service_time}</td>
				</tr>
                <if condition="$order.appoint_type eq 1">
                    <tr>
    					<td>预约方式： 上门</td>
    				</tr>
    				<tr>
    					<td>上门地址： {pigcms{$order.address}</td>
    				</tr>
                <else/>
                    <tr>
    					<td>预约方式： 到店</td>
    				</tr>
                </if>
				<tr>
				  <td>支付方式： {pigcms{$order.pay_type}</td>
				</tr>
				<if condition="($order['service_status'] eq 0) and ($order['paid'] eq 1)">
					<tr id="xfstatus">
						<form enctype="multipart/form-data" method="post" action="">
							<td>服务状态：
								<span class="red">未服务</span>	
								<div><input name="status" value="1" type="hidden">
								<button id="merchant_remark_btn" class="submit" style="padding: 5px;margin: 12px auto;margin-top: 25px;background-color:#FF658E;border:1px solid #FF658E">确认消费</button>
								<span class="form_tips" style="color: red">
								注：改成已消费状态后同时如果是未付款状态则修改成线下支付已支付，状态修改后就不能修改了	
								</span>
								</div>
							</td>
						</form>
					</tr>
				<elseif condition="$order['status'] eq 1 OR $order['status'] eq 2"/>
					<tr>
						<td>是否已消费：<span class="green"> 已消费</span></td>
					</tr>
				</if>
			</tbody>
		</table>
	</ul>
	<a href="{pigcms{:U('Storestaff/Appoint_list')}" class="btn" style="float:right;right:1rem;top:0.2rem;position:absolute;width:5rem;font-size:1rem;">返 回</a>
</div>
<div class="footReturn">
	<div class="clr"></div>
	<div class="window" id="windowcenter">
		<div id="title" class="wtitle">操作成功<span class="close" id="alertclose"></span></div>
		<div class="content">
			<div id="txt"></div>
		</div>
	</div>
</div>

</script>

<!---<include file="Storestaff:footer"/>--->