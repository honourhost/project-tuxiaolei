<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
	<title>{pigcms{$tpl.wxname}</title>
	<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta charset="utf-8">
	
	<link href="{pigcms{$static_path}tpl/142/css/cate.css" rel="stylesheet" type="text/css" />

</head>

<body>
		<!--music-->
		<if condition="$homeInfo['musicurl'] neq false">
			<include file="Index:music"/>
			
		</if>
<div class="mainbg" style="background:#7ABDE9;">
    <volist name="flashbg" id="so">
        <img src="{pigcms{$so.img}" />
    </volist>
</div>

<ul class="mainmenu">

	<volist name="info" id="vo">
        <li>
			<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>" >
				<p><img src="{pigcms{$vo.img}" /><span>{pigcms{$vo.name}</span></p>
			</a>
		</li>
	</volist>	
 

</ul>
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
</body>
</html>