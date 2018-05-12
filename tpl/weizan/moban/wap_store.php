<!--wap手机 店铺列表模版-->

                <dd>
			        <dl>
			            <dd class="dd-padding">
							<div class="merchant">
							    <div class="biz-detail">
							        <a class="react" href="{pigcms{:U('Group/shop',array('store_id'=>$vo['store_id']))}">
							            <h5 class="title single-line"> {pigcms{$vo['name']}</h5>
							            <div class="address single-line">{pigcms{$vo['area_name']}{pigcms{$vo['adress']}</div>
                                        <if condition="$vo['juli']">
                                        <div class="map">{pigcms{:round($vo['juli']/1000,1)}km <if condition="$vo['juli_if']"><b>离我最近</b></if></div></if>
							        </a>
							    </div>
							    <div class="biz-call">
							        <a class="react phone" href="javascript:void(0);" data-phone="{pigcms{$vo['phone']}"></a>
							    </div>
							</div>
			            </dd>
			        </dl>
			    </dd>