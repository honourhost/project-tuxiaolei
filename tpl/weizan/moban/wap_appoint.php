<!--wap手机 预约模版-->

                                <dd>
			        				<a href="{pigcms{$vo.url}" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<div class="dealcard-brand single-line">{pigcms{$vo.appoint_name}</div>
                                                <div class="title_kj">
												    <div class="title text-block">{pigcms{$vo.appoint_content}</div>
                                                </div>
												<div class="price">
													
                                                    <if condition="$vo['payment_money'] gt 0">
                                                        <strong class="lv">{pigcms{$vo.payment_money}&nbsp;<b>定金</b></strong>
                                                    <else/>
                                                        <div style="color:#37caad;font-size: 16px;">免定金</div>
                                                    </if>
                                                    
													<if condition="$vo['appoint_sum']"><span class="line-right">已预约{pigcms{$vo['appoint_sum']}</span></if>
												</div>
												<if condition="isset($vo['juli'])">
													<div class="location_list">{pigcms{:round($vo['juli']/1000,1)}km</div>
												</if>
                                                <div class="youhui_list">
                                                    <if condition="$vo['appoint_type'] eq 1">
                                                        <span class="hong">上门</span>
                                                    <else/>
                                                        <span class="lv">到店</span>
                                                    </if>
                                                </div>
										    </div>
										</div>
			       					</a>
			       				</dd>