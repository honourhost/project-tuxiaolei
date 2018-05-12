<!--wap手机 快店模版-->

                            <dd>
								<a href="{pigcms{:U('Takeout/shop', array('mer_id' => $vo['mer_id'], 'store_id' => $vo['store_id']))}" class="react">
									<div class="dealcard" data-did="{pigcms{$vo.store_id}">
										<div class="dealcard-img imgbox">
											<img src="{pigcms{$vo.image}" style="width:100%;height:100%;">
										</div>
										<div class="dealcard-block-right">
											<div class="dealcard-brand single-line">{pigcms{$vo.name}</div>
                                            <div class="title_waimai text-block">{pigcms{$vo.area_name}&nbsp;<font color="#dddddd">|</font>&nbsp;<if condition="$vo['mean_money'] gt 0">人均{pigcms{$vo.mean_money}元<else/><if condition="$vo['reply_count'] gt 0">{pigcms{$vo.reply_count}评价<else/>暂无评价</if></if></div>
											<div class="price">
                                                <if condition="$vo['have_meal']">
                            				        <img src="/liuchang/images/wap/waimai.png" height="15" style="margin-right: 8px;">
                                                </if>
                                                <if condition="$vo['have_yuding']">
                            				        <img src="/liuchang/images/wap/yuding.png" height="15">
                                                </if>
												<span class="line-right">已售{pigcms{$vo['sale_count']}</span>
											</div>
											<if condition="isset($vo['juli'])">
												<div class="location_list">{pigcms{:round($vo['juli']/1000,1)}km</div>
											</if>
                                            <div class="youhui_list">
                                                <if condition="$vo['zeng']">
                    							    <span class="lv">赠</span>
                    							</if>
                    							<if condition="$vo['full_money'] neq 0.00 AND $vo['minus_money'] neq 0.00">
               							            <span class="huang">减</span>
                    							</if>
                    							<if condition="$vo['song']">
                    							    <span class="hong">惠</span>
                    							</if>
                                            </div>
										</div>
									</div>
								</a>
							</dd>