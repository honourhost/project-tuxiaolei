<!DOCTYPE html>
<html class="ui-mobile">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1">
    <title>{pigcms{$lottery.title}</title>
    <link rel="stylesheet" href="{pigcms{$static_path}css/jquery.css">
    <link rel="stylesheet" href="{pigcms{$static_path}css/tigerslot.css">
    <script src="{pigcms{$static_path}js/jquery-1.js"></script>
    <script src="{pigcms{$static_path}js/jquery-2.js"></script>
    <script src="{pigcms{$static_path}js/alert.js"></script>
    <script src="{pigcms{$static_path}js/tigerslot.js"></script>
    <style type="text/css">
.window {
	width:290px;
	position:fixed;
	display:none;
	bottom:120px;
	left:50%;
	 z-index:9999;
	margin:-50px auto 0 -145px;
	padding:2px;
	border-radius:0.6em;
	-webkit-border-radius:0.6em;
	-moz-border-radius:0.6em;
	background-color: #ffffff;
	-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	-o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	font:14px/1.5 Microsoft YaHei,Helvitica,Verdana,Arial,san-serif;
}
.window .title {
	
	background-color: #A3A2A1;
	line-height: 26px;
    padding: 5px 5px 5px 10px;
	color:#ffffff;
	font-size:16px;
	border-radius:0.5em 0.5em 0 0;
	-webkit-border-radius:0.5em 0.5em 0 0;
	-moz-border-radius:0.5em 0.5em 0 0;
	background-image: -webkit-gradient(linear, left top, left bottom, from( #585858 ), to( #565656 )); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient(#585858, #565656); /* Chrome 10+, Saf5.1+ */
	background-image:    -moz-linear-gradient(#585858, #565656); /* FF3.6 */
	background-image:     -ms-linear-gradient(#585858, #565656); /* IE10 */
	background-image:      -o-linear-gradient(#585858, #565656); /* Opera 11.10+ */
	background-image:         linear-gradient(#585858, #565656);
	
}
.window .content {
	/*min-height:100px;*/
	overflow:auto;
	padding:10px;
	background: linear-gradient(#FBFBFB, #EEEEEE) repeat scroll 0 0 #FFF9DF;
    color: #222222;
    text-shadow: 0 1px 0 #FFFFFF;
	border-radius: 0 0 0.6em 0.6em;
	-webkit-border-radius: 0 0 0.6em 0.6em;
	-moz-border-radius: 0 0 0.6em 0.6em;
}
.window #txt {
	min-height:30px;font-size:16px; line-height:22px;
}
.window .txtbtn {
	
	background: #f1f1f1;
	background-image: -webkit-gradient(linear, left top, left bottom, from( #DCDCDC ), to( #f1f1f1 )); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient( #ffffff , #DCDCDC ); /* Chrome 10+, Saf5.1+ */
	background-image:    -moz-linear-gradient( #ffffff , #DCDCDC ); /* FF3.6 */
	background-image:     -ms-linear-gradient( #ffffff , #DCDCDC ); /* IE10 */
	background-image:      -o-linear-gradient( #ffffff , #DCDCDC ); /* Opera 11.10+ */
	background-image:         linear-gradient( #ffffff , #DCDCDC );
	border: 1px solid #CCCCCC;
	border-bottom: 1px solid #B4B4B4;
	color: #555555;
	font-weight: bold;
	text-shadow: 0 1px 0 #FFFFFF;
	border-radius: 0.6em 0.6em 0.6em 0.6em;
	display: block;
	width: 100%;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	text-overflow: ellipsis;
	white-space: nowrap;
	cursor: pointer;
	text-align: windowcenter;
	font-weight: bold;
	font-size: 18px;
	padding:6px;
	margin:10px 0 0 0;
}
.window .txtbtn:visited {
	background-image: -webkit-gradient(linear, left top, left bottom, from( #ffffff ), to( #cccccc )); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient( #ffffff , #cccccc ); /* Chrome 10+, Saf5.1+ */
	background-image:    -moz-linear-gradient( #ffffff , #cccccc ); /* FF3.6 */
	background-image:     -ms-linear-gradient( #ffffff , #cccccc ); /* IE10 */
	background-image:      -o-linear-gradient( #ffffff , #cccccc ); /* Opera 11.10+ */
	background-image:         linear-gradient( #ffffff , #cccccc );
}
.window .txtbtn:hover {
	background-image: -webkit-gradient(linear, left top, left bottom, from( #ffffff ), to( #cccccc )); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient( #ffffff , #cccccc ); /* Chrome 10+, Saf5.1+ */
	background-image:    -moz-linear-gradient( #ffffff , #cccccc ); /* FF3.6 */
	background-image:     -ms-linear-gradient( #ffffff , #cccccc ); /* IE10 */
	background-image:      -o-linear-gradient( #ffffff , #cccccc ); /* Opera 11.10+ */
	background-image:         linear-gradient( #ffffff , #cccccc );
}
.window .txtbtn:active {
	background-image: -webkit-gradient(linear, left top, left bottom, from( #cccccc ), to( #ffffff )); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient( #cccccc , #ffffff ); /* Chrome 10+, Saf5.1+ */
	background-image:    -moz-linear-gradient( #cccccc , #ffffff ); /* FF3.6 */
	background-image:     -ms-linear-gradient( #cccccc , #ffffff ); /* IE10 */
	background-image:      -o-linear-gradient( #cccccc , #ffffff ); /* Opera 11.10+ */
	background-image:         linear-gradient( #cccccc , #ffffff );
	border: 1px solid #C9C9C9;
	border-top: 1px solid #B4B4B4;
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3) inset;
}

.window .title .close {
	float:right;
	
	width:26px;
	height:26px;
	display:block;	
}
</style>
</head><body>
<div class="window" id="windowcenter">
	<div id="title" class="title">消息提醒<span class="close" id="alertclose"></span></div>
	<div class="content">
	 <div id="txt"></div>
	 <input value="确定" id="windowclosebutton" name="确定" class="txtbtn" type="button">	
	</div>
</div>

        <div role="main" style="padding-top:10px" class="tigerslot ui-content" data-role="content" activity_id="{pigcms{$lottery.id}" wechat_id="{pigcms{$lottery.wecha_id}" data-token="{pigcms{$lottery.token}" rid="{pigcms{$lottery.rid}">
          <div style="height:20px;"></div>
            <div class="machine">
                <div class="strip left">
                    <div style="background-position: 0px 0px;" class="box"></div>
                    <div class="cover"></div>
                </div>
                <div class="strip middle">
                    <div style="background-position: 0px 0px;" class="box"></div>
                    <div class="cover"></div>
                </div>
                <div class="strip right">
                    <div style="background-position: 0px 0px;" class="box"></div>
                    <div class="cover"></div>
                </div>
                <div class="gamebutton" <if condition="$wecha_id eq ''">onclick="alert('您只能查看，无法参与此活动')"</if>></div>
            <div class="light l0"></div><div class="light l1 on"></div><div class="light l2"></div><div class="light l3 on"></div><div class="light l4"></div><div class="light l5 on"></div><div class="light l6"></div><div class="light l7 on"></div><div class="light l8"></div><div class="light l9 on"></div><div class="light l10"></div><div class="light l11 on"></div><div class="light l12"></div><div class="light l13 on"></div><div class="light l14"></div><div class="light l15 on"></div><div class="light l16"></div><div class="light l17 on"></div><div class="light l18"></div><div class="light l19 on"></div><div class="light l20"></div></div>
            
            
            <div id="result" class="part" <if condition="$isLotteryButNotInputTel eq 0">style="display:none"</if>>
            	<a title="取消" data-wrapperels="span" data-iconshadow="true" data-shadow="true" data-corners="true" class="close-btn ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-icon-notext" style="position:absolute;top:0;right:0;" data-role="button" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true"><span class="ui-btn-inner"><span class="ui-btn-text">取消</span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span></a>
                <div class="title">恭喜您中奖了!</div>
                <div class="content">
					<p>您中了：<span id="prize">{pigcms{$record.prize}等奖</span></p>
					<p>{pigcms{$lottery.renamesn}：<span id="sncode">{pigcms{$record.sn}</span></p>
					<p class="red" id="red">请仔细填写{pigcms{$lottery.renametel}，提交后无法修改! </p>
					<p><input class="ui-input-text ui-body-c" id="tel" value="{pigcms{$fans.tel}" placeholder="请输入您的{pigcms{$lottery.renametel}" type="text">
					</p>
				
					<p>
					<input data-disabled="false" class="ui-btn-hidden" id="submit-btn" value="提交" type="button">
					</p>                  
                </div>
            </div>            
            </if>		
			<if condition="$isLotteryButNotSend eq 1">
			<div class="part">
                <div class="title">恭喜您中奖了!</div>
                <div class="content">
					<p>您中了：<span id="prize">{pigcms{$record.prize}等奖</span></p>
					<p>{pigcms{$lottery.renamesn}：<span id="sncode">{pigcms{$record.sn}</span></p>
                </div>
            </div>
			<div id="request-reward" class="part">
				<a title="取消" data-wrapperels="span" data-iconshadow="true" data-shadow="true" data-corners="true" class="close-btn ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-icon-notext" style="position:absolute;top:0;right:0;" data-role="button" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true"><span class="ui-btn-inner"><span class="ui-btn-text">取消</span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span></a>
				<div class="title">输入验证码</div>
				<div class="content">
					<input id="sn" type="hidden">
					<p><input class="ui-input-text ui-body-c" id="password" placeholder="领奖时商家输入兑奖密码" type="password">
					</p>				
					<p><input data-disabled="false" class="ui-btn-hidden" id="ver-btn" value="提交" type="button">
					</p>				
				</div>
			</div>
			</if>
			<if condition="$isLotteryAndSend eq 1">
			<div id="request-reward" class="part">
				<a title="取消" data-wrapperels="span" data-iconshadow="true" data-shadow="true" data-corners="true" class="close-btn ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-icon-notext" style="position:absolute;top:0;right:0;" data-role="button" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true"><span class="ui-btn-inner"><span class="ui-btn-text">取消</span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span></a>
				<div class="title">已兑奖</div>
				<div class="content">
					<p>您中了{pigcms{$record.prize}等奖，已于{pigcms{$record.sendtime|date="Y-m-d",###}兑奖</p>
				</div>
			</div>
			</if>
			<if condition="$wecha_id eq ''">
			<div class="part">
                <div class="title">友情提醒:</div>
                <div class="content">
				<p style="color:#f00;line-height:160%">您可能是从朋友圈等分享过的页面打开的链接，无法直接参与此活动，如需参与此活动请按照以下步骤操作：<br>1、关注微信名称“{pigcms{$config.wechat_name}”或者微信号“{pigcms{$config.wechat_id}”<br>2、输入关键词：“{pigcms{$lottery.keyword}”</p>            
                </div>
            </div>
			</if>
			<if condition="$lottery['end'] eq 1">
			<div class="part">
                <div class="title">结束说明:</div>
                <div class="content">
				<p>{pigcms{$lottery.endinfo}</p>            
                </div>
            </div>
			</if>	        
            <div class="part">
                <div class="title">奖项设置:</div>
                <div class="content">              
                   <?php if ($lottery['statdate']>time()){echo '<p style="color:red">活动还没有开始 :(</p>';}?>
		 <p>每人最多允许抽奖次数:{pigcms{$lottery.canrqnums} <if condition="$lottery.daynums neq 0">，每天只能抽{pigcms{$lottery.daynums}次</if> <if condition="$lottery.usenums gt 0"> - 已抽取 <span class="red" id="usenums">{pigcms{$lottery.usenums}</span> 次</if></p>
            <p>一等奖: {pigcms{$lottery.fist}  <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.fistnums}<php>}</php></p>
              <if condition="$lottery['second'] neq ''">
                <p>二等奖: {pigcms{$lottery.second} <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.secondnums}<php>}</php></p>
              </if>             
            <if condition="$lottery['third'] neq ''">
                <p>三等奖: {pigcms{$lottery.third} <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.thirdnums}<php>}</php></p>
            </if>
            <if condition="$lottery['four'] neq ''">
                <p>四等奖: {pigcms{$lottery.four}  <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.fournums}<php>}</php></p>
            </if>
            <if condition="$lottery['five'] neq ''">
                <p>五等奖: {pigcms{$lottery.five}  <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.fivenums}<php>}</php></p>
            </if>
            <if condition="$lottery['six'] neq ''">
                <p>六等奖: {pigcms{$lottery.six}   <php>if($lottery['displayjpnums']){</php>奖品数量: {pigcms{$lottery.sixnums}<php>}</php></p>
            </if>                                  
                </div>
            </div>

            <div class="part">
                <div class="title">活动说明:</div>
                <div class="content">
				<p>{pigcms{$lottery.info}</p>
        <p>活动时间:{pigcms{$lottery.statdate|date="Y/m/d",###}至{pigcms{$lottery.enddate|date="Y/m/d",###}</p>		
        <p><strong>{pigcms{$lottery.txt}</strong></p>            
                </div>
            </div>
			
			        	
        </div>

           


<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span></div>

<script type="text/javascript">
window.shareData = {  
            "moduleName":"LuckyFruit",
            "moduleID":"{pigcms{$lottery.id}",
            "imgUrl": "{pigcms{$lottery.starpicurl}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('LuckyFruit/index',array('token'=>$token,'id'=>$lottery['id'],'type'=>5))}",
            "tTitle": "{pigcms{$lottery.title}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body></html>