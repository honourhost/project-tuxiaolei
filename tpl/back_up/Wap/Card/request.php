<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<title></title>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/card/wei_webapp_new_v1.0.4.css" />
<script src="{pigcms{$static_path}js/card/jquery.js"  type="text/javascript" ></script>
<script src="{pigcms{$static_path}js/card/rotate.js"  type="text/javascript"></script>
</head>
<style>
body{font: 12px/1.5 Microsoft YaHei,Helvitica,Verdana,Arial,san-serif;}
.footReturn {
display: block;
margin: 11px auto;
padding: 0;
position: relative;}
.submit {
background-color: #179F00;
padding: 10px 20px;
font-size: 16px;
text-decoration: none;
border: 1px solid #0B8E00;
Invalid property value.background-image: linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -o-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -moz-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
background-image: -webkit-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -ms-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
background-image: -webkit-gradient(
 linear,
 left bottom,
 left top,
 color-stop(0, #179F00),
 color-stop(1, #5DD300)
 );
-webkit-box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
Unknown property name.-moz-box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
-webkit-border-radius: 5px;
Unknown property name.-moz-border-radius: 5px;
Unknown property name.-o-border-radius: 5px;
border-radius: 5px;
color: #ffffff;
display: block;
text-align: center;
text-shadow: 0 1px rgba(0, 0, 0, 0.2);
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	var value = 360;
	$(".card").bind('click',function(){		
		if($("#card2").is(":hidden")){
			$("#card").rotate({ animateTo:value});
			$("#card").delay(600).hide(0);
			$("#card2").delay(600).show(0);
		
		}else{
			$("#card2").rotate({ animateTo:value});
			$("#card").delay(600).show(0);
			$("#card2").delay(600).hide(0);
		
		}
		
	});	
});

</script>
<body id="page_card">

<div id="mappContainer">
  <div class="inner root" style="height: 468px;">
    <div id="card" class="card" style="background:url('{pigcms{$card.bg}') no-repeat 0 0;-webkit-background-size:267px 159px;background-size:267px 159px;">
		  <img src="{pigcms{$card.logo}" class="logo"/>
		  <h1 style="color:{pigcms{$card.vipnamecolor};text-shadow:0 1px #e2ded2;">{pigcms{$card.cardname}</h1>
		  <!--<h2></h2>-->
		  <figure class="pdo twodim" hidden=""><img data-src="006 4655"></figure>
		  <figure class="pdo barcode" hidden=""><img data-src="006 4655"></figure>
		  <strong class="pdo verify" style="">
				<span style="color:#847d64;text-shadow:0 1px #ebe9e0;"><em style="color:#847d64;text-shadow:0 1px #ebe9e0;">会员卡号</em><span style="color:{pigcms{$card.numbercolor}">{pigcms{$card_info.number}</span></span>
		  </strong>
	  </div>
	  <!--会员卡背面-->
	  <div id="card2" class="card" style="background:url('{pigcms{$card.bg}') no-repeat 0 0;-webkit-background-size:267px 159px;background-size:267px 159px;display:none">
		  <img src="{pigcms{$card.logo}" class="logo"/>
		  <h1 style="color:{pigcms{$card.vipnamecolor};text-shadow:0 1px #e2ded2;">{pigcms{$card.cardname}</h1>
		  <!--<h2></h2>-->
		  <div style="padding-top:50px;color:#847d64;font-size:12px;margin-left:10px;"><span style="color:{pigcms{$card.vipnamecolor}">总店电话：{pigcms{$contact.tel}</span><p></p>
		  <span style="color:{pigcms{$card.vipnamecolor}">总店地址：{pigcms{$contact.info}</span>
		  </div>
		  
		 
		  
	  </div>
    <p><span data-hidden-when-lost="使用时向服务员出示此卡">{pigcms{$card.msg}</span></p>
    <ul class="round" style="display:block">
     <li style="height:70px;" class="intro">	 
		<div class="footReturn">
			<button id="showcard" class="submit"  onclick="Javascript:window.open('{pigcms{:U('Userinfo/index',array('token' => $token))}','_parent')"  style="width:100%">点击领取会员卡</button>
			<div class="window" id="windowcenter">
				<div id="title" class="wtitle"><span class="close" id="alertclose"></span></div>
				<div class="content">
				<div id="txt"></div>
				</div>
			</div>
		</div>
		
	</li>    
      <!-- 自定义链接在预存余额下面显示 -->
    </ul>
     <ul class="round" style="display:block">
     <li class="intro">
		<div style="width:99%;background:rgb(134, 141, 46);color:white;line-height:30px;padding-left:10px;">商家介绍 - {pigcms{$info.description}</div>
		<div >
			<span style="float:left;padding-righ:10px"><img src="{pigcms{$info.logo}"/></span>{pigcms{$info.info}
			
		</div>
		
	</li>   
	</ul>
	<ul class="round" style="display:block;margin-bottom:5px;">
     <li class="intro">
		{pigcms{:C('copyright')}
	</li>   
	</ul>
  </div>
  	
</div>
<div style="clear:both"></div>
<include file="Card:share"/>
</body>
</html>