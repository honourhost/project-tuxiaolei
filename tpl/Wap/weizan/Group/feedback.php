<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$now_group['tuan_type'] neq 2">
		<title>【{pigcms{$now_group.merchant_name}】评价列表</title>
	<else/>
		<title>【{pigcms{$now_group.group_name}】评价列表</title>
	</if>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		.swiper-slide{
			display: -webkit-box;
			display: -ms-flexbox;
			overflow: hidden;
			-webkit-box-align: center;
			-webkit-box-pack: center;
			-ms-box-align: center;
			-ms-flex-pack: justify;
		}
		.swiper-slide img{
			width:auto;
			height:auto;
			max-width:100%;
			max-height:90%;
		}
		.swiper-pagination{
			left: 0;
			top: 10px;
			text-align: center;
			bottom:auto;
			right:auto;
			width:100%;
		}
		.swiper-close{
			right:10px;
			top:5px;
			text-align:right;
			position:absolute;
			z-index:21;
			color:white;
			font-size:.7rem;
		}
		span.tag{
			background: #fdb338;
			color: #fff;
			line-height: 1.5;
			display: inline-block;
			padding: 0 .06rem;
			font-size: .24rem;
			border-radius: .06rem;
		}
	</style>
	<style>.msg-bg{background:rgba(0,0,0,.4);position:absolute;top:0;left:0;width:100%;z-index:998}.msg-doc{position:fixed;left:.16rem;right:.16rem;bottom:15%;border-radius:.06rem;background:#fff;overflow:hidden;z-index:999}.msg-hd{background:#f0efed;color:#333;text-align:center;padding:.28rem 0;overflow:hidden;font-size:.4rem;border-bottom:1px solid #ddd8ce}.msg-bd{font-size:.34rem;padding:.28rem;border-bottom:1px solid #ddd8ce}.msg-toast{background:rgba(0,0,0,.8);font-size:.4rem;color:#fff;border:0;text-align:center;padding:.4rem;-webkit-animation-name:pop-hide;-webkit-animation-duration:5s;border-radius:.12rem;bottom:60%;opacity:0;pointer-events:none}.msg-confirm,.msg-alert{-webkit-animation-name:pop;-webkit-animation-duration:.3s}.msg-option{-webkit-animation-name:slideup;-webkit-animation-duration:.3s}@-webkit-keyframes pop-hide{0%{-webkit-transform:scale(0.8);opacity:0}2%{-webkit-transform:scale(1.1);opacity:1}6%{-webkit-transform:scale(1)}90%{-webkit-transform:scale(1);opacity:1}100%{-webkit-transform:scale(0.9);opacity:0}}@-webkit-keyframes pop{0%{-webkit-transform:scale(0.8);opacity:0}40%{-webkit-transform:scale(1.1);opacity:1}100%{-webkit-transform:scale(1)}}@-webkit-keyframes slideup{0%{-webkit-transform:translateY(100%)}40%{-webkit-transform:translateY(-10%)}100%{-webkit-transform:translateY(0)}}.msg-ft{display:-webkit-box;display:-ms-flexbox;font-size:.34rem}.msg-ft .msg-btn{display:block;-webkit-box-flex:1;-ms-flex:1;margin-right:-1px;border-right:1px solid #ddd8ce;height:.88rem;line-height:.88rem;text-align:center;color:#2bb2a3}.msg-btn:last-child{border-right:0}.msg-option{background:0;bottom:55px;}.msg-option div:first-child,.msg-option .msg-option-btns:first-child .btn:first-child{border-radius:.06rem .06rem 0 0;border-top:0}.msg-option .btn{width:100%;background:#fff;border:0;color:#FF658E;border-radius:0}.msg-option .msg-bd{background:#fff;border-bottom:0}.msg-option .btn{height:.8rem;line-height:.8rem;border-top:1px solid #ccc}.msg-option-btns .btn:last-child{border-radius:0 0 .06rem .06rem;border-bottom:1px solid #ccc}.msg-option .msg-btn-cancel{padding:0;margin-top:.14rem;color:#FF658E;border-radius:.06rem}.msg-dialog .msg-hd{background-color:#fff}.msg-dialog .msg-bd{background-color:#f0efed}.msg-slide{background:0;bottom:0;left:0;right:0;border-radius:0;-webkit-animation-name:slideup;-webkit-animation-duration:.3s}</style>
</head>
<body id="index" data-com="pagecommon">

		<div id="deal" class="deal">
			<dl class="list" id="deal-feedback">
                <div class="liu_x_title liu_borderBottom">
                    <h1>评价</h1>
                    <div class="liu_right">
                        <div class="liu_pingjia">
                            <div class="liu_xxx"><span style="width:{pigcms{$now_group['score_mean']/5*100}%"></span></div>
                            &nbsp;{pigcms{$now_group['score_mean']}分
                        </div>
                    </div>
               </div>
			    <dd>
			        <dl>
			            <volist name="list" id="vo">
						      <include file="liuchang/moban/wap_qingjia.php"/>
						</volist>
						<if condition="$pagebar">
							<dd>
								<div class="pager">{pigcms{$pagebar}</div>
							</dd>
						</if>
			        </dl>
			    </dd>
			</dl>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var static_path="{pigcms{$static_path}";var collect_url="{pigcms{:U('Collect/collect')}";var group_id="{pigcms{$now_group.group_id}";</script>
		<script src="{pigcms{$static_path}js/group_detail.js"></script>
		<script>
			$(function(){
			                              //刘畅 评价遍历 隐藏或显示展开 取外框架和内框架的高度对比，如果没有外框架大，说明字数没有超过，就要隐藏”展开“标识
                                            $(".comment_kj").each(function()
                                            {
                                                height_kj=$(this).find("div").height();
                                                height_p=$(this).find("p").height();
                                                height=height_p - height_kj;
     
                                                if(height < 10)
                                                {
                                                    $(this).find("i").hide();
                                                }
                                            })
                                        
                                        
				$('.pager a').live('click',function(){
					
				});
			});
            
                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }
		</script>
		<include file="Public:footer"/>

<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/feedback', array('group_id' => $now_group['group_id']))}",
            "tTitle": "【{pigcms{$now_group.merchant_name}】评价列表",
            "tContent": ""
};
</script>

</body>
</html>