<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>{pigcms{$now_store.name}</title>
	<else/>
		<title>【{pigcms{$now_store.name}】图片|电话|地址_{pigcms{$config.site_name}</title>
	</if>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
    
	<style>
		.albumContainer {
			position: fixed;
			width: 100%;
			height: 100%;
			left: 0;
			top: 0;
			background: #000;
			z-index: 1000;
			display: none;
			overflow: hidden;
			-webkit-transform-origin: 0px 0px;
			opacity: 1;
			-webkit-transform: scale(1,1);
		}
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
		.img-count {
	        position: absolute;
	        right: 0;
	        border: .1rem;
	        z-index: 2;
	        background: rgba(0,0,0,.6);
	        color: white;
	        bottom: 20px;
	        padding: .1rem;
	    }
	    .comments {
	        color: #999;
	        margin-left: .1rem;
	        vertical-align: middle;
	    }
	    #poi .dealcard-block-right {
	        height: 1.68rem;
	    }

	    #poi .rating {
	        margin-bottom: .2rem;
	    }
	    #poi .kv-line-r h6 {
	        line-height: 1.41;
	        text-align: justify;
	        margin-top: -.2em;
	        margin-bottom: -.2em;
	    }
		.js-web-btn .web-text:after {
	        content: "进入商家微官网";
	    }
	    .js-fav-btn .fav-text {
	        vertical-align: top;
	    }
		
	    .js-fav-btn .fav-text:after {
	        content: "收藏";
	    }
	
	    .js-fav-btn .icon-star {
	        display: none
	    }
	
	    .js-fav-btn .icon-star-empty {
	        display: inline-block
	    }
	
	    .js-fav-btn.faved .fav-text:after {
	        content: "取消收藏";
	    }
	
	    .js-fav-btn.faved .icon-star {
	        display: inline-block
	    }
	
	    .js-fav-btn.faved .icon-star-empty {
	        display: none
	    }
	    .btn-line {
	        display: -webkit-box;
	    }
	    .btn-line .btn {
	        -webkit-box-flex: 1;
	        display: block;
	        padding: 0;
	    }
	    .btn-line .color-strong {
	        -webkit-box-flex: .8;
	    }
	    .btn-margin {
	        margin: 0 .2rem;
	    }
	    .btn-line .text-icon {
	        margin-right: .14rem;
	        vertical-align: top;
	        height: 100%;
	    }
	    .kv-line{
	        margin: 0;
	    }
	
	    .kv-line p {
	        color: #666;
	    }
	    .historydeal small {
	        margin-left: .2rem;
	        font-size: 100%;
	        color: #999;
	    }
	    .react>.kv-line-r {
	        margin: 0;
	        color: #666;
	    }
	    .react>.kv-line-r p{
	        border-left: 1px solid #ddd8ce;
	        padding-left: .2rem;
	    }
	    .react>.kv-line-r .text-icon {
	         margin-right: .1rem;
	     }
	    .react>.kv-line-r p {
	        color: #2bb2a3;
	        display: -webkit-box;
	        -webkit-box-align: center;
	        display: -ms-flex-box;
	        -ms-box-align: center;
	    }
	    .msg-option-btns{
			margin-top: .07rem;
		}
        
        /*刘畅 - 修改商家中心*/
        .liu_supp_img{width: 100%;height:170px;overflow: hidden;position: relative;}
        .liu_supp_img img{width: 100%;}
        /*框架*/
        .liu_supp_kj{display: block;padding: 12px 10px;overflow: hidden;position: relative;}
        /*名称*/
        .liu_supp_name{width: 70%; font-weight:bold;font-size:16px;color:#333;line-height: 25px; overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
        /*微官网*/
        .liu_supp_wei{width: 70px;height:100%;position: absolute;top:0;right: 10px;}
        .liu_supp_wei a{display: block;text-align: center;background: #37caad;color:#fff;line-height: 40px;margin-top: 15px;}
	   /*地址*/
       .liu_supp_address{width: 65%;height: 35px;display: block;overflow: hidden;float:left;background: url(/liuchang/images/wap/address.png) no-repeat 0 center;padding-left:18px;background-size:11px;}
       .liu_supp_address p{vertical-align: middle;display: table-cell;color:#999;line-height: 17px;height:35px;font-size: 14px;}
       /*电话*/
       .liu_supp_tel{width: 69px;height: 35px;float: right;border-left: 1px #eeeeee solid;}
       .liu_supp_tel a{display: block;background: url(/liuchang/images/wap/phoneBig.png) no-repeat 27px center;background-size: 17px;}
       
       /*已开通的服务*/
        .liu_supp_fuwu{width: 100%;height: 50px;background: #fff;display: table;}
        .liu_supp_fuwu a{width: 50%;height: 50px;border-left: 1px #eee solid;display: table-cell;text-align: center;color: #666;line-height: 50px;}
        
    </style>
</head>
<body id="index" data-com="pagecommon">
        <dl class="list list-in" id="poi">
                    <div class="view_album" data-pics="<volist name="now_store['all_pic']" id="vo">{pigcms{$vo}<if condition="count($now_store['all_pic']) gt $i">,</if></volist>">
			            <div class="liu_supp_img">
                            <span class="img-count">共{pigcms{:count($now_store['all_pic'])}张</span>
			            	<img src="{pigcms{$now_store.all_pic.0}"/>
                        </div>
                    </div>
                    <div class="liu_group_ico liu_group_ico_ht liu_group_ico_kj " style="left: 15px;" onclick="javascript:history.go(-1);"></div>
                    <div id="shoucang" class="liu_group_ico <if condition="$now_store['is_collect']">liu_group_ico_sc_on<else/>liu_group_ico_sc</if> liu_group_ico_kj " style="right: 15px;" fav-type="group_shop" fav-id="{pigcms{$now_store.store_id}"></div>
			        
                    <div class="liu_supp_kj liu_borderBottom">
                        <div class="liu_supp_name">
                            {pigcms{$now_store.name}
                        </div>
                        <div class="liu_pingjia" style="margin-top: 2px;">
                            <div class="liu_dxx"><span style="width:{pigcms{$now_store['star']/5*100}%"></span></div>
                            &nbsp;{pigcms{$now_store['star']}分
                        </div>
                        <div class="liu_supp_wei">
                            <a href="{pigcms{:U('Index/index',array('token'=>$now_store['mer_id']))}">微官网</a>
                        </div>
                    </div>
				    <div class="liu_supp_kj">
                        <div class="liu_supp_address" onclick="window.open('{pigcms{:U('Group/addressinfo',array('store_id'=>$now_store['store_id']))}')">
                             <p>{pigcms{$now_store.area_name}{pigcms{$now_store.adress}</p>
                        </div>
                        <div class="liu_supp_tel">
                            <a class="react phone" href="javascript:void(0);" data-phone="{pigcms{$now_store.phone}"></a>
                        </div>
                    </div> 
		    </dd>
                
		    <!--dd class="dd-padding btn-line">
		        <a class="js-fav-btn btn btn-block color-strong btn-weak <if condition="$now_store['is_collect']">faved</if>" fav-type="group_shop" fav-id="{pigcms{$now_store.store_id}"><i class="text-icon icon-star"></i><i class="text-icon icon-star-empty"></i><span class="fav-text"></span></a>
		        <a class="btn btn-block btn-weak btn-margin" data-com="share" data-share-text="这家店不错哦，一起去吧！{pigcms{$now_store.name}，{pigcms{$now_store.area_name}{pigcms{$now_store.adress}，{pigcms{$now_store.phone}。{pigcms{$config.site_url}/group/shop/{pigcms{$now_store.store_id}.html" data-share-pic="{pigcms{$now_store.all_pic.0}"><i class="text-icon icon-share"></i> 分享</a>
		    </dd-->
		</dl>
        
        <if condition="($now_store['have_meal'] eq 1) or ($now_store['have_yuding'] eq 1)">
            <div class="liu_supp_fuwu liu_margin_top">
                <if condition="$now_store['have_meal']">
                    
                    <a href="{pigcms{:U("Takeout/shop",array('store_id'=>$now_store['store_id'],'mer_id'=>$now_store['mer_id']))}"><img src="/liuchang/images/wap/shop_waimai.png" width="17">&nbsp; 送餐外卖</a>
                </if>
                <if condition="$now_store['have_yuding']">
                    
                    <a href="{pigcms{:U("Food/shop",array('store_id'=>$now_store['store_id'],'mer_id'=>$now_store['mer_id']))}"><img src="/liuchang/images/wap/shop_yuding.png" width="17">&nbsp;预约订座</a>
                </if>
            </div>
        </if>
                    
		<dl class="list">
            <div class="liu_x_title liu_borderBottom">
                <h1>本店{pigcms{$config.group_alias_name} <b> ({pigcms{:count("$store_group_list")})</b></h1>
            </div> 
       		<dd>
       			<dl class="list">
        			<volist name="store_group_list" id="vo">
       				     <include file="liuchang/moban/wap_group_x.php"/>
        			</volist>
				</dl>
			</dd>
    	</dl>
    	<dl class="list" id="poi-summary">
            <div class="liu_x_title liu_borderBottom">
                <h1>店家简介</h1>
            </div> 
    		<dd>
    			<dl>
		            <dd class="dd-padding kv-line">
		                <p style="text-indent:2em;">{pigcms{$now_store.txt_info}</p>
		            </dd>
				</dl>
			</dd>
		</dl>
        
        <if condition="!empty($reply_list)">
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
							<volist name="reply_list" id="vo">
								<include file="liuchang/moban/wap_qingjia.php"/>
							</volist>
						</dl>
					</dd>
					<if condition="$reply_count gt 3">
                        <div class="liu_list_body liu_borderTop">
                            <a href="{pigcms{:U('Group/shop_reply',array('store_id'=>$now_store['store_id']))}">
                                <h1>查看全部{pigcms{$reply_count}条评价</h1>
                            </a>
                        </div>
					</if>
				</dl>
			</if>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var static_path="{pigcms{$static_path}";var collect_url="{pigcms{:U('Collect/collect')}";var group_id="{pigcms{$now_group.group_id}";</script>
		<script src="{pigcms{$static_path}js/group_detail.js"></script>
		<include file="Public:footer"/>

<script type="text/javascript">

                                    $(function()
                                    {
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
                                        })

                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }

window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_store.all_pic.0}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/shop', array('store_id' => $now_store['store_id']))}",
            "tTitle": "{pigcms{$now_store.name}",
            "tContent": ""
};
</script>

</body>
</html>