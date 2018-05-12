
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0" />
	<meta name="format-detection"content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>填写预约</title>
	<link href="{pigcms{$static_path}css/appoint_form.css?07" rel="stylesheet"/>
</head>
<body>
	<section id="main">
		<div class="yxc-body-bg index-section">
			<form action="" method="post" id="main_form">
				<if condition="count($now_group['appoint_taocan']) gt 0">
					<input type="hidden" name="service_name" id="service_name" value="{pigcms{$now_group['appoint_taocan'][0]['name']}"/>
                    <input type="hidden" name="service_money" id="service_money" value="{pigcms{$now_group['appoint_taocan'][0]['price']}"/>
					<div class="comm-service liu-margin-top">
                        <i class="taocan"></i>
                        <h1>{pigcms{$now_group['appoint_taocan'][0]['name']}</h1>						
                        <h2>{pigcms{$now_group['appoint_taocan'][0]['content']}</h2>
                        <em>
                            <u>全价：</u><b>￥</b><font>{pigcms{$now_group['appoint_taocan'][0]['price']}</font>
                        </em>
					</div>
				</if>
               
				<ul class="yxc-attr-list liu-margin-top">
					<li>
						<i class="mer"></i>
						<p class="cover select">
							<select name="store_id" id="store_id" class="ipt-attr">
								<option value="">选择预约店铺</option>
								<volist name="now_group['store_list']" id="vo">
									<option value="{pigcms{$vo.store_id}">{pigcms{$vo.name}&nbsp;<if condition="$vo['juli']">约{pigcms{:round($vo['juli']/1000,1)}km</if></option>
								</volist>
							</select>
						</p>
					</li>
				</ul>
				<ul class="yxc-attr-list liu-margin-top">
					<li data-role="chooseTime">
						<i class="time"></i>
						<p class="cover no-arrow">
							<input type="hidden" name="service_date" id="service_date" value=""/>
							<input type="hidden" name="service_time" id="service_time" value=""/>
							<input class="ipt-attr" type="text" id="serviceJobTime" placeholder="选择预约时间" readonly="readonly"/>
						</p>
					</li>
				</ul>

				<if condition="$now_group['appoint_type']">
					<ul class="yxc-attr-list liu-margin-top">	
						<if condition="$now_group['appoint_type']">
							<li>
								<i class="map"></i>
								<input type="hidden" name="long" data-type="long"/>
								<input type="hidden" name="lat" data-type="lat"/>
								<input type="hidden" name="address" data-type="address"/>
								<p class="cover">
									<input data-role="position" class="ipt-attr" type="text" name="custom_field[0][value]" placeholder="请选择服务位置" readonly="readonly" data-required="required"/>
								</p>
							</li>
						</if>
					</ul>
				</if>
                
                <if condition="$now_group['payment_status'] eq 1">
                    <ul class="yxc-attr-list liu-margin-top">
    					<li>
    						<i class="dingjin"></i>
    						<p class="cover no-arrow">
    							定金：￥{pigcms{$now_group.payment_money}
    						</p>
    					</li>
    				</ul>
            	</if>
				<em class="tip-add-money">
					<div class="foot-index liu-margin-top">
						<input type="submit" class="bt-sub-order" data-role="submit" value="立即下单">
					</div>
				</em>
			</form>
		</div>
	</section>
	<section id="service-type" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<header class="yxc-brand">
				<span>选择服务</span>
			</header>
			<ul class="yxc-service-list yxc-package boder-top service-list">
				<volist name="now_group['appoint_taocan']" id="vo">
					<li <if condition="$i eq 1">class="active"</if> data-id="{pigcms{$vo['id']}">
						<label class="pay-type" for="pay-type-{pigcms{$vo['id']}">
							<div class="service-intro">
							  <h3 data-role="title">{pigcms{$vo['name']}</h3>
							  <span data-role="content">{pigcms{$vo['content']}</span>
							</div>
                            <div class="service-price"><em>¥</em><span data-role="payAmount">{pigcms{$vo['price']}</span></div>
							<input name="pay-type" id="pay-type-{pigcms{$vo['id']}" type="radio" value="" style="opacity:0;position:absolute;top:0;" <if condition="$i eq 1">checked="checked"</if>/>
							<span class="bt-interior"></span>
						</label>
					</li>
				</volist>
			</ul>
		</div>
	</section>
	<section id="service-date" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<div class="yxc-time-con number-{pigcms{:count($timeOrder)}">
				<volist name="appoint_time" id="timeOrderInfo">
					<dl <if condition="$i eq count($timeOrder)">class="last"</if>>
						<dt <if condition="$i eq 1">class="active"</if> data-role="date" data-text="<if condition="$key eq date('Y-m-d')" > 今天<elseif condition="$key eq date('Y-m-d',strtotime('+1 day'))" />明天
	<elseif condition="$key eq date('Y-m-d',strtotime('+2 day'))" />后天<else />{pigcms{$key}
								</if>" data-date="{pigcms{$key}">
								<if condition="$key eq date('Y-m-d')" > 今天
								<elseif condition="$key eq date('Y-m-d',strtotime('+1 day'))" />明天
								<elseif condition="$key eq date('Y-m-d',strtotime('+2 day'))" />后天
                                <elseif condition="$key eq date('Y-m-d',strtotime('+3 day'))" />{pigcms{:substr($key,-2)}日
								<else />
								</if>
							
						</dt>
					</dl>
				</volist>
			</div>
			<div class="yxc-time-con" data-role="timeline">
				<volist name="appoint_time" id="timeOrderInfo">
					<div class="date-{pigcms{$key} timeline" <if condition="$i neq 1">style='display:none'</if> >
					   <volist name="timeOrderInfo" id="vo">
						<dl>
							<dd data-role="item" data-peroid="{pigcms{$vo['time']}" <if condition="$vo['order'] eq 'no'">class="disable"</if> <if condition="$vo['order'] eq 'all'">class="all"</if>>
                            {pigcms{$vo['time']}
							</dd>
						</dl>
						</volist>
					</div>
				</volist>
                
            </div>
		</div>
                <div class="shuoming">
                    <b></b> 预约已满&nbsp;&nbsp;
                    <b style="background: #aaa;"></b> 不可预约&nbsp;&nbsp;
                    <b style="background: #37caad;"></b> 可预约&nbsp;&nbsp;
                </div>
	</section>
	<section id="service-position" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<header class="yxc-brand">
				<span>选择位置</span>
			</header>
			<div id="allmap"></div>
		</div>
	</section>
	<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=5KWzYCZOavUQaPUMDFxQDdyN&v=1.0"></script>
	<script type="text/javascript">
		<if condition="$now_group['user']['long']">
			var user_long={pigcms{$now_group['user']['long']},user_lat={pigcms{$now_group['user']['lat']};
		<else/>
			var user_long=0,user_city='山西';
		</if>
	</script>
	<script type="text/javascript" src="{pigcms{$static_path}js/appoint_form.js?08"></script>
</body>
</html>