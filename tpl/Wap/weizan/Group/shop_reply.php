<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
		<title>{pigcms{$now_store.name}的评价</title>

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
</head>
<body id="index" data-com="pagecommon">

		<div id="deal" class="deal">
			<dl class="list" id="deal-feedback">
                <div class="liu_x_title liu_borderBottom">
                    <h1>评价</h1>
                    <div class="liu_right">
                        <div class="liu_pingjia">
                            <div class="liu_xxx"><span style="width:{pigcms{$now_store['star']/5*100}%"></span></div>
                            &nbsp;{pigcms{$now_store['star']}分
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
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/shop_reply', array('store_id' => $now_store['store_id']))}",
            "tTitle": "{pigcms{$now_store.name}的评价",
            "tContent": ""
};
</script>

</body>
</html>