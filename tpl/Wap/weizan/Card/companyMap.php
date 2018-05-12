<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>会员卡</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="{pigcms{$static_path}card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
</head>

<body id="cardunion" class="mode_webapp2" >
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak={pigcms{$config.baidu_map_key}"></script>
<div class="main">
	<div class="p_map">
    <div id="container" style="width:100%;height:100%"></div>
        <script type="text/javascript">
        $(function(){
        	var wh = $(window).height();
        	var bh = $('body').height();
        	var mh = $('#container').css('height');
        	mh = mh.replace('px', '');
        	oh = bh - wh;
        	nmh = mh - oh;
        	$('#container').css('height', nmh+'px');
        
        	var sContent = function(id, name, imgsrc, address, tel){
        		return "<h2 style='margin:0 0 7px 0;padding:0 0'>"+name+"</h2>" + 
        		"<img style='float:right;margin:0px 0px 0px 4px' id='imgDemo' src='"+imgsrc+"' width='120' height='80' />" + 
        		"<p style='padding-right:10px'>地址："+address+"</p>" +
        		"<p style=''>电话：<a href='tel:{pigcms{$thisCompany.tel}'>"+tel+"</a></p>" +
        		"" +
        		"</div>";
        	}
        	var storeList = [{"id":"{pigcms{:$thisCompany['id']}","name":"{pigcms{:$thisCompany['name']}","logourl":"{pigcms{:$thisCompany['logourl']}","address":"{pigcms{:$thisCompany['address']}","tel":"{pigcms{:$thisCompany['tel']}","longitude":"{pigcms{:$thisCompany['longitude']}","latitude":"{pigcms{:$thisCompany['latitude']}"}<volist name="branchStores" id="c">,{"id":"{pigcms{:$c['id']}","name":"{pigcms{:$c['name']}","logourl":"{pigcms{:$c['logourl']}","address":"{pigcms{:$c['address']}","tel":"{pigcms{:$c['tel']}","longitude":"{pigcms{:$c['longitude']}","latitude":"{pigcms{:$c['latitude']}"}</volist>];
        	// 编写自定义函数,创建标注
        	function addMarker(point, content){
        	  var marker = new BMap.Marker(point);  // 创建标注
        	  map.addOverlay(marker);
        	  var infoWindow = new BMap.InfoWindow(content);
        	  map.openInfoWindow(infoWindow,point); //开启信息窗口
        	  marker.addEventListener("click", function(){          
        		   this.openInfoWindow(infoWindow);
        		   //图片加载完毕重绘infowindow
        		   document.getElementById('imgDemo').onload = function (){
        		       infoWindow.redraw();
        		   }
        		});
        	}
        	var map = new BMap.Map("container");
        	var point = new BMap.Point({pigcms{:$thisCompany['longitude']}, {pigcms{:$thisCompany['latitude']});
        	map.centerAndZoom(point, 13);
        	var user_marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(user_marker);
            	   
        	for (var i = 0, l=storeList.length; i < l; i ++) {
        	  var point = new BMap.Point(storeList[i].longitude, storeList[i].latitude);
        	  var content = sContent(storeList[i].id,storeList[i].name,storeList[i].logourl,storeList[i].address,storeList[i].tel);
        	  addMarker(point, content);
        	}

        });
        </script>
	</div>
</div>

<include file="Card:bottom"/>
<include file="Card:share"/>
</body>
</html>
