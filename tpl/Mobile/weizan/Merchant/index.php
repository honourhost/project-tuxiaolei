<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		
	</head>
	<body class="xnd-phone-bg">
		
		<div class="xnd-phone-center">
			<ul class="Hundreds-nav" style="margin-top: 0;">
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img01.png"></a></span>
	   	  		<h3>美食</h3>
	   	  	</li>
	   	    <li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img02.png"></a></span>
	   	  		<h3>烘焙</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img03.png"></a></span>
	   	  		<h3>新鲜果素</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img04.png"></a></span>
	   	  		<h3>生鲜</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img05.png"></a></span>
	   	  		<h3>花卉</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img06.png"></a></span>
	   	  		<h3>美容</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img07.png"></a></span>
	   	  		<h3>服装</h3>
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="zhuanxian.html"><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-img08.png"></a></span>
	   	  		<h3>小吃</h3>
	   	  	</li>
	   	  	 <div style="clear: both;"></div>
	   	  </ul>
			<!-- 农场列表 -->
			<div class="phone-nc-list">
				<ul>
					<volist name="merchant_list" id="merchant">
						<a href="{pigcms{:U('Merchant/detail',array('mer_id'=>$merchant['mer_id']))}">
					<li>
						<div class="nc-list-bg" style="background-image: url({pigcms{$merchant.merchant_theme_image});"></div>
						<h3 class="nc-list-title">
							 — {pigcms{$merchant.person_name}农场 —
						</h3>
						<div class="nc-list-btm">
							<div class="btn-left">
								<div class="btn-left-header"><img src="{pigcms{$merchant.person_image}" /></div>
								{pigcms{$merchant.txt_info}
							</div>
							<div class="btn-right">
								<img src="{pigcms{$static_path}images/xnd_img/iconfont-ditu.png" /><label><php>echo getRealAreaName($merchant['area_id'])</php></label><small><php>echo $merchant['distance']/1000;</php>km</small>
							</div>
						</div>
					</li>
					</a>
					</volist>
				</ul>
			</div>
			<!-- 农场列表end -->
			<div class="phone_footer">
				2015-2016&copy;小农丁
			</div>
		</div>
	</body>
</html>
