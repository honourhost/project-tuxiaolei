<include file="Food:header"/>
<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container businessHours">

		<if condition="!empty($list)">
                            
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
		</if>
	<div style="display: none;text-align: center;height: 30px;margin-top: 15px;" id="show_more" page="2"><a href="javascript:void(0);" style="color: #ED0B8C;">加载更多...</a></div>
	<input type="hidden" id="canScroll" value="1" />

	<footer data-role="footer"></footer>
</div>
<script type="text/javascript">
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
			});
            
                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }


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