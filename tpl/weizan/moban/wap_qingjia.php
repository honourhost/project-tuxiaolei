<!--wap手机 评价模版-->

<dd class="dd-padding">
									<div class="feedbackCard">
                                       
                                        <img src="{pigcms{$vo.avatar}" class="userImg">
										<div class="userInfo">
											<div class="username">{pigcms{$vo.nickname}</div>
										</div>
										<div class="score">
                                            <div class="liu_xxx">
                                                <span style="width:{pigcms{$vo['score']/5*100}%"></span>
                                            </div>
											<div class="time">{pigcms{$vo.add_time}</div>
										</div>
                                        
                                        <div class="comment_kj"  onclick="comment(this)">
    										<div class="comment">
    											<p>{pigcms{$vo.comment}</p>
    										</div>
                                            <i>展开</i>
                                        </div>
										<if condition="$vo['pics']">
											<div class="pics view_album" data-pics="<volist name="vo['pics']" id="voo">{pigcms{$voo.m_image}<if condition="count($vo['pics']) gt $i">,</if></volist>">
												<volist name="vo['pics']" id="voo">
													<span class="pic-container imgbox" style="background:none;"><img src="{pigcms{$voo.s_image}" style="width:100%;"/></span>&nbsp;
												</volist>
											</div>
										</if>
										<if condition="$vo['store_name']">
											<div style="margin-top: 10px;color:#999">
												{pigcms{$vo.store_name}
											</div>
										</if>
									</div>
								</dd>
                                
                                
                                        <!--  要加到调用本模版的js初始化中
                                        
                                        
                                        刘畅 评价遍历 隐藏或显示展开 取外框架和内框架的高度对比，如果没有外框架大，说明字数没有超过，就要隐藏”展开“标识
                                        
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
                                            
                                            //刘畅 - 点击展开
                                            function comment(res)
                                            {
                                                $(res).find("div").css("max-height","100%")
                                                $(res).find("i").hide();
                                            }
                                        -->