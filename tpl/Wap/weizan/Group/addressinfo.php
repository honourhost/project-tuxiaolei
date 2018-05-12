<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>【{pigcms{$now_store.name}】地图详情_{pigcms{$config.site_name}</title>
	
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    #biz-map {
	        width: 100%;
	        height: 7.1rem;
	    }
	    .kv-line-r {
	        -webkit-box-align: center;
	        -ms-box-align: center;
	    }
	    #address .text-icon {
	        color: #666;
	        font-size: .34rem;
	        margin-right: .2rem;
	    }
	    .kv-line-r h6 {
	        margin-right: .2rem;
	    }
	    .markerspan {
	        position: absolute;
	        bottom: .95rem;
	        padding: .2rem;
	        width: 3rem;
	        left: .17rem;
	        text-align: center;
	        -webkit-transform: translateX(-50%);
	        -ms-transform: translateX(-50%);
	    }
	    .markerspan-bg {
	        opacity: .9;
	        background-color: white;
	        position: absolute;
	        width: 100%;
	        height: 100%;
	        -webkit-filter:drop-shadow(0 0 4px rgba(0,0,0,.5));
	        left: 0;
	        top:0;
	        z-index: -1;
	        border-radius: .06rem;
	    }
	    .markerspan-bg:before {
	        content: "";
	        position: absolute;
	        bottom: -.15rem;
	        width: .3rem;
	        height: .3rem;
	        -webkit-transform: rotateZ(45deg);
	        -ms-transform: rotateZ(45deg);
	        background-color: white;
	        left: 1.6rem;
	    }
	    #address .icon-mark {
	        color: #2bb2a3;
	        font-size: .65rem;
	        -webkit-text-stroke: 2px white;
	    }
	</style>
</head>
<body id="index" data-com="pagecommon">
		<div id="address">
		    <dl class="list">
		        <dd id="biz-map" class="amap-container"></dd>
		        <dd class="" id="see_load">
					<div class="dd-padding kv-line-r" style="margin:0 0;">
						<i class="text-icon">⦿</i>
						<h6> {pigcms{$now_store.area_name}{pigcms{$now_store.adress}</h6>
						<a class="btn kv-v" href="{pigcms{:U('Group/get_route',array('store_id'=>$now_store['store_id']))}">查看路线</a>
					</div>
		        </dd>
		    </dl>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="http://api.map.baidu.com/api?type=quick&ak={pigcms{$config.baidu_map_key}&v=1.0"></script>
		<script type="text/javascript">
			$(function(){
				$('#biz-map').height($(window).height()-$('header').height()-$('footer').height()-$('#see_load').height()-13);
				
				// 百度地图API功能
				var map = new BMap.Map("biz-map");
				map.centerAndZoom(new BMap.Point({pigcms{$now_store.long},{pigcms{$now_store.lat}), 16);
			
				map.addControl(new BMap.ZoomControl());  //添加地图缩放控件
				var marker1 = new BMap.Marker(new BMap.Point({pigcms{$now_store.long},{pigcms{$now_store.lat}));  //创建标注
				map.addOverlay(marker1);                 // 将标注添加到地图中
				//创建信息窗口
				var infoWindow1 = new BMap.InfoWindow("{pigcms{$now_store.name}");
				marker1.openInfoWindow(infoWindow1);
				marker1.addEventListener("click", function(){this.openInfoWindow(infoWindow1);});
			});
			
		</script>
		<include file="Public:footer"/>
</body>
</html>