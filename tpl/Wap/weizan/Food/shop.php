<include file="Food:header"/>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/nav.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/common_wap.js"></script>
<link href="{pigcms{$static_path}meal/css/nav.css" rel="stylesheet">
<link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet">

<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container storeDetails">
		<header data-role="header" class="imglist">
			<if condition="isset($store['images'][0])">
				<img src="{pigcms{$store['images'][0]}">
			</if>
		</header>
		<section data-role="body">
            <div class="store_info liu_borderBottom">
    			<span><strong>{pigcms{$store['mean_money']}</strong>人均消费/元</span>
    			<span><strong>{pigcms{$store['deposit']}</strong>预订订金/元</span>
    		</div>
            <div class="liu_body liu_borderTop liu_margin_top">
                    店铺名称：{pigcms{$store['name']}
            </div>
            <div class="liu_body liu_borderTop phone" data-phone="{pigcms{$store['phone']}">
                    联系电话：{pigcms{$store['phone']}
            </div>
            <div class="liu_body liu_borderTop">
                    详情地址：<a href="http://api.map.baidu.com/geocoder?address={pigcms{$store['adress']}&output=html">{pigcms{$store['adress']}</a>
            </div>
            <if condition="!empty($juli)">
            <div class="liu_body liu_borderTop">
                    大约距离：{pigcms{$juli}米
            </div>
			</if>
            <div class="liu_body liu_borderTop liu_borderBottom">
                    营业时间：<volist name="store['office_time']" id="row" key="i">{pigcms{$row['open']}-{pigcms{$row['close']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</volist>
            </div>
            

			<div class="liu_list_body liu_margin_top liu_borderTop liu_borderBottom">
					<a href="{pigcms{:U('Food/shop_detail', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
                        <div class="liu_pingjia">
                            <div class="liu_dxx"><span style="width:{pigcms{$store['score_mean']/5*100}%"></span></div>
                            &nbsp;{pigcms{$store['score_mean']}分
                        </div>  
                        <h2>{pigcms{$store.reply_count}条评价</h2>
                    </a>
			</div>	
				
            <!--占位-->
            <div style="height: 65px;display: block;"></div>
            
		      <div class="btndiv">
                <if condition="$store['have_meal']">
    				<div style="width:33.33%">
    					<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}" class="schedule"><span class="btn bigfont big liu_huang">立即预订</span></a>
    				</div>
    				<div style="width:33.33%">
    					<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn bigfont big liu_lv">我要点菜</span></a>
    				</div>
    				<div style="width:33.33%">
    					<a href="{pigcms{:U('Takeout/shop', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn bigfont liu_hong">我要外卖</span></a>
    				</div>
                <else/>
    				<div>
    					<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}" class="schedule"><span class="btn bigfont big liu_huang">立即预订</span></a>
    				</div>
    				<div>
    					<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont big liu_lv">我要点菜</span></a>
    				</div>
                </if>				
			</div>
			
		</section>
	
	</div>
<include file="kefu" />
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Food/index',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
</body>
</html>