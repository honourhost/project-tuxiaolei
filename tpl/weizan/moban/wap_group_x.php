<!--wap手机 团购小模版-->

                                    <dd>
								     	<a href="{pigcms{$vo.url}" class="react">
								            <div class="simpleCard">
									            <div class="dealcard">
									          	  	<div class="group-x-img imgbox">
        												<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;">
        											</div>
												    <div class="dealcard-block-right">
														<if condition="$vo['tuan_type'] neq 2">
															<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
														<else/>
															<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
														</if>
												        <div class="price">
												            <strong>{pigcms{$vo['price']}</strong>&nbsp;
												            <del>{pigcms{$vo.old_price}</del>
												            
												            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
												        </div>
												    </div>
                                                    <if condition="isset($vo['juli'])">
													<div class="location_list">{pigcms{:round($vo['juli']/1000,1)}km</div>
    												</if>
                                                    <div class="youhui_list">
                                                        <if condition="$vo['wx_cheap']">
                                                            <span class="lv">减</span>
                                                        </if>
                                                        <if condition="($vo['once_max'] gt 0) OR ($vo['once_min'] gt 1) or ($vo['count_num'] gt 0)">
                                                            <span class="hong">限</span>
                                                        </if>
                                                    </div> 
												</div>
											</div>
								        </a>
								     </dd>