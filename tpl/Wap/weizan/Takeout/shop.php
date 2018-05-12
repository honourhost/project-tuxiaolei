<include file="header" />
<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
    <link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/swipe_min.js"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<header class="nav">
		<div>
			<a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">菜单</a>
			<a href="javascript:;" class="on">门店详情</a>
		</div>
	</header>
	<section>
		<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
			<ul style="width: 640px;">
				<volist name="store['images']" id="img">
				<li data-index="0" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
				<a href=""><img src="{pigcms{$img}"></a>
				</li>
				</volist>
				<!--li data-index="1" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
				<a href=""><img src=""></a>
				</li-->
			</ul>
			<ol id="swipeNum">
				<volist name="store['images']" id="img">
				<if condition="$i eq 1">
				<li class="on"></li>
				<else />
				<li></li>
				</if>
				</volist>
			</ol>
		</div>
		<div class="store_info">
			<span><strong>{pigcms{$store['basic_price']}</strong>起送价/元</span>
			<span><strong>{pigcms{$store['delivery_fee']}</strong>配送费/元</span>
		</div>
        <if condition="($store['zeng']) or ($store['full_money'] gt 0) or ($store['song'])">
            <ul class="box">
                <if condition="$store['zeng']">
                    <li style="padding-left: 40px;">
                        {pigcms{$store['zeng']}
                        <div class="youhui_list" style="top: 12px;left:10px;">
                            <span class="lv">赠</span>
                        </div>
                    </li>
                </if>
                <if condition="$store['full_money'] gt 0">
                    <li style="padding-left: 40px;">
                        满{pigcms{$store['full_money']}元，减{pigcms{$store['minus_money']}元
                        <div class="youhui_list" style="top: 12px;left:10px;">
                            <span class="huang">减</span>
                        </div>
                    </li>
                </if>
                <if condition="$store['song']">
                    <li style="padding-left: 40px;">
                        {pigcms{$store['song']}
                        <div class="youhui_list" style="top: 12px;left:10px;">
                            <span class="hong">惠</span>
                        </div>
                    </li>
                </if>
    		</ul>
        </if>
		<ul class="box">
			<li>
				<a class="phone" href="javascript:void(0);" data-phone="{pigcms{$store['phone']}">
					联系电话：{pigcms{$store['phone']}
				</a>
			</li>
			<li>
				<a href="http://api.map.baidu.com/geocoder?address={pigcms{$store['adress']}&output=html">
					详情地址：{pigcms{$store['adress']}
				</a>
			</li>
		</ul>
		<ul class="box">
			<li>营业时间：<volist name="store['office_time']" id="tim"><if condition="$i gt 2"><br></if><b style="margin-right: 20px;font-weight: normal;<if condition="$i gt 2">margin-left:70px</if>">{pigcms{$tim['open']}-{pigcms{$tim['close']}</b></volist>
            </li>
			<li>服务半径：{pigcms{$store['delivery_radius']}公里</li>
			<li>配送区域：{pigcms{$store['delivery_area']}</li>
		</ul>
        
        
		<if condition="!empty($reply_list)">
			<ul class="box">
				<dl class="list" id="deal-feedback">
                    <div class="liu_x_title liu_borderBottom">
                          <h1>评价</h1>
                          <div class="liu_right">
                                <div class="liu_pingjia">
                                    <div class="liu_xxx"><span style="width:{pigcms{$store['score_mean']/5*100}%"></span></div>
                                    &nbsp;{pigcms{$store['score_mean']}分
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
				</dl>
                <if condition="$store['reply_count'] gt 3">
                        <div class="liu_list_body liu_borderTop">
                            <a href="{pigcms{:U('Takeout/reply',array('store_id'=>$store['store_id']))}">
                                <h1>查看全部{pigcms{$store['reply_count']}条评价</h1>
                            </a>
                        </div>
	           	</if>
			</ul>
		</if>
		
	<input type="hidden" id="canScroll" value="1" />
	</section>
	<footer class="go_menu">
		<div class="fixed">
			<a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" <if condition="$store['have_yuding']">style="width: 50%;"</if>>我要外卖</a>
            <if condition="$store['have_yuding']">
                <a href="{pigcms{:U('Food/shop', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="go_yuyue">到店预约</a>
            </if> 
		</div>
	</footer>
</div>
<include file="kefu" />
<script type="text/javascript">
                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }
$(document).ready(function(){
    
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
                                            

});
window.shareData = {  
            "moduleName":"Takeout",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Takeout/shop',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
</body>
</html>