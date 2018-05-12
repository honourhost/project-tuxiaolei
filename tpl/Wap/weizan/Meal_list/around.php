<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>附近的{pigcms{$config.meal_alias_name}列表_{pigcms{$config.site_name}</title>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
	<style>.navbar{background:#F03C03;border-bottom:1px solid #F03C03;}.navbar .nav-dropdown{background:#F03C03;}.nav-dropdown li{border-bottom:1px solid #FF658E;}</style>
</head>
<body id="index" data-com="pagecommon">
   
		<div class="nav-bar">
		    <ul class="nav" style="padding:0rem .2rem;">
	            <li class="dropdown-toggle caret1 category"  style="text-align: left;"><span class="nav-head-name"></span></li><a href="{pigcms{:U('Meal_list/around_adress')}" class="modify">修改</a>
		    </ul>
		</div>
		<div class="deal-container">
			<div class="deals-list" id="deals">
			<if condition="$group_list">
    			<dl class="list list-in">
       				<volist name="group_list" id="vo">
	        			<include file="liuchang/moban/wap_meal.php"/>
	       			</volist>
				</dl>
				<if condition="$pagebar">
				<dl class="list">
					<dd>
						<div class="pager">{pigcms{$pagebar}</div>
					</dd>
				</dl>
				</if>
			<else/>	
				<div class="no-deals">暂无区域的餐饮店，请查看其他分类</div>
			</if>
			</div>
			<div class="shade hide"></div>
			<div class="loading hide">
		        <div class="loading-spin" style="top: 91px;"></div>
		    </div>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/dropdown.js"></script>
		<include file="Public:footer"/>

<script type="text/javascript">
var lat_long = "{pigcms{$lat_long}";
$(document).ready(function(){
	$.get('http://api.map.baidu.com/geocoder/v2/?ak={pigcms{$config.baidu_map_key}&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
		$('.nav-head-name').html(data.result.formatted_address);
	}, 'jsonp');
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal_list",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Meal_list/around')}",
            "tTitle": "{pigcms{$config.meal_alias_name}店铺列表_{pigcms{$config.site_name}",
            "tContent": ""
};
</script>

</body>
</html>