<!DOCTYPE html>
<html>

<head>
    <meta name="keywords" content="小农丁 农丁鲜生">
    <meta name="description" content="小农丁 农丁鲜生">
    <title>小农丁 农丁鲜生</title>
    <link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/xiansheng/basePath.css">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xiansheng/gb.min.css">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xiansheng/index.min.css">


</head>

<body style="overflow-x: hidden;">


<div class="mod_container hh">

    <div class="hh_box JS_floor">
        <div class="hh_hd">
            <div class="hh_mod_main">
                <div class="hh_hd_topic">
                    <h1 class="hh_hd_topic_tit mod_png24">农丁鲜生 - 100优选</h1>
                    <p class="hh_hd_topic_txt">/&nbsp;精挑细选的100份健康美味&nbsp;/</p>
                </div>
                <div class="hh_features">
                    <div class="hh_features_l">
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">产地直采</div>
                        </div>
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">绿色生态</div>
                        </div>
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">精挑细选</div>
                        </div>
                    </div>
                    <div class="hh_features_r">
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">严格质检</div>
                        </div>
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">全程冷链</div>
                        </div>
                        <div class="hh_features_item">
                            <div class="hh_features_item_icon">
                                <div class="hh_mod_icon hh_features_item_icon_bg"></div>
                                <div class="hh_mod_icon hh_features_item_icon_font"></div>
                            </div>
                            <div class="hh_features_item_txt">安全保证</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hh_week hh_week_d">
            <div class="hh_mod_main">
                <div class="hh_week_tit">
                    <h2 class="mod_png24">本周鲜品</h2>
                    <div class="hh_week_date">{pigcms{$mondaystr}-{pigcms{$todaystr}</div>
                    <p>/&nbsp;&nbsp;&nbsp;&nbsp;每周上新，不重样的好品质&nbsp;&nbsp;&nbsp;&nbsp;/</p>
                </div>
                <div class="hh_week_main">
                    <div class="hh_week_hot">

                        <volist name="weekrec" id="weekdata">
                            <div class="hh_week_hot_item">
                                <div class="hh_week_hot_info">
                                    <h4 class="hh_week_hot_info_tit">
                                        <a href="" title="{pigcms{$weekdata.name}" target="_blank">{pigcms{$weekdata.name}</a>
                                    </h4>
                                    <p class="hh_week_hot_info_desc">{pigcms{$weekdata.desc}</p>
                                    <div class="hh_week_hot_info_price">
                                        <i>本周尝鲜价：</i><span>¥</span><em>{pigcms{$weekdata.price}</em>
                                    </div>
                                </div>
                                <div class="hh_week_hot_img">
                                    <a href="" title="{pigcms{$weekdata.name}" target="_blank"><img src="{pigcms{$weekdata.pic}"
                                                                                   width="320" height="320" alt="{pigcms{$weekdata.name}">
                                        <span class="hh_week_hot_img_hover"></span>
                                        <span class="hh_week_hot_img_bg mod_png24 hh_week_hot_img_bg_1"></span>
                                        <span class="hh_week_hot_img_wow"></span>
                                    </a>
                                </div>
                            </div>

                        </volist>

                    </div>
                </div>
                <div class="hh_week_ornbg mod_png24"></div>
            </div>
            <div class="hh_week_bgs">
                <div class="hh_week_bgs_box">
                    <div class="hh_week_bgs_item hh_week_bgs_item_1"></div>
                    <div class="hh_week_bgs_item hh_week_bgs_item_2"></div>
                    <div class="hh_week_bgs_item hh_week_bgs_item_3"></div>
                    <div class="hh_week_bgs_item hh_week_bgs_item_4"></div>
                    <div class="hh_week_bgs_box_bg mod_png24"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="hh_new lazy-fn JS_floor">
        <div class="hh_new_box">
            <div class="hh_mod_main">
                <div class="hh_new_tit">
                    <h2 class="mod_png24">新品预告</h2>
                    <p>/&nbsp;&nbsp;&nbsp;&nbsp;期待相遇，未谋面的新鲜感&nbsp;&nbsp;&nbsp;&nbsp;/</p>
                </div>
                <div class="hh_new_slider" id="newContainer">
                    <div class="hh_new_main">
                        <div class="hh_new_slider_box">
                            <div class="hh_new_slider_box_length">
                                <volist name="trailerdata" id="trailer">
                                    <a href="" class="hh_new_slider_item" target="_blank" title="{pigcms{$trailer.name}"
                                       style="opacity: 1;">
                                        <div class="hh_new_slider_img">
                                            <div class="hh_new_slider_img_bg mod_png24"></div>
                                            <img src="{pigcms{$trailer.pic}" width="290" height="290" alt="{pigcms{$trailer.name}"
                                                 data-webp="no">
                                            <div class="hh_new_slider_img_txt mod_png24">
                                                <span class="mod_ver"></span>
                                                <span class="hh_new_slider_img_txt_price"><i>¥</i><em>{pigcms{$trailer.price}</em></span>
                                            </div>
                                        </div>
                                        <div class="hh_new_slider_info mod_png24">
                                            <div class="hh_mod_ver"></div>
                                            <div class="hh_new_slider_info_main">
                                                <h4>{pigcms{$trailer.name}</h4>
                                                <p>/&nbsp;{pigcms{$trailer.desc}&nbsp;/</p>
                                            </div>
                                        </div>

                                    </a>
                                </volist>



                            </div>
                        </div>
                    </div>
                    <div class="hh_mod_icon hh_new_slider_btn hh_new_slider_btn_l"></div>
                    <div class="hh_mod_icon hh_new_slider_btn hh_new_slider_btn_r"></div>
                </div>
                <a href="" class="hh_new_rule J_newRule">预定规则</a>
            </div>
        </div>
        <div class="hh_new_bg mod_png24"></div>
    </div>


    <div class="hh_list JS_floor">
        <div class="hh_list_tit">
            <h2 class="mod_png24">优选100</h2>
            <p>/&nbsp;&nbsp;精挑细选，可看见的优选品&nbsp;&nbsp;/</p>
        </div>
        <!-- 是否有 Tab -->
        <div class="hh_list_container hh_list_container_notab">
            <div class="hh_list_nav">
                <div class="hh_mod_main">
                    <div class="hh_list_nav_auto">
                        <div class="hh_list_nav_logo">
                            <a href="#" class="hh_mod_icon"></a>
                        </div>
                        <div class="hh_list_nav_box">
                            <a href="javascript:;" class="hh_list_nav_item hh_list_nav_item_on">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">最新优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                            <a href="javascript:;" class="hh_list_nav_item ">
                                <span class="hh_mod_icon hh_list_nav_item_bg1"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg2"></span>
                                <span class="hh_mod_icon hh_list_nav_item_bg3"></span>
                                <span class="hh_list_nav_item_tit">海鲜优选</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hh_mod_main">
                <div class="hh_list_wrap" id="hhListBox">
                    <div class="hh_list_block" id="itemListBox">
                        <!-- 商品块 -->
                        <div class="hh_list_box hh_list_box_on">
                            <volist name="groups" id="group">

                                <div class="hh_list_item">
                                    <a href="" class="hh_list_item_img" title="" target="_blank">
                                        <img src="{pigcms{$group.pic}" width="240" height="240" alt="">
                                        <div class="hh_list_item_img_tag">
                                            <div class="hh_mod_icon"></div>
                                            <span class="hh_list_item_img_tag_price">¥<em>{pigcms{$group.price}</em></span>
                                        </div>
                                    </a>
                                    <div class="hh_list_item_info">
                                        <h5 class="hh_list_item_info_tit"><a href="" target="_blank" title="">{pigcms{$group.s_name}</a></h5>
                                        <p class="hh_list_item_info_desc">/&nbsp;{pigcms{$group.name}&nbsp;/</p>
                                    </div>
                                    <div class="hh_list_item_bg"></div>
                                </div>
                            </volist>


                            <div style="clear: both;"></div>
                        </div>

                    </div>
                    <div class="hh_list_bg"></div>
                </div>
            </div>
        </div>
        <div style="width: 100%; height: 70px;"></div>
    </div>


    <div class="mod_foot">
        <div class="mod_foot_wave mod_png24"></div>
        <div class="mod_foot_content">
            <div class="mod_foot_service">
                <div class="mod_foot_service">
                    <div class="mod_foot_service_main">
                        <div class="mod_foot_service_desc mod_foot_service_save">
                            <div class="mod_foot_service_icon">
                                <i class="mod_foot_service_icon_wrap mod_foot_iconfont"></i>
                                <i class="mod_foot_service_icon_content mod_foot_iconfont"></i>
                            </div>
                            <div class="mod_foot_service_content">
                                <div class="mod_foot_service_title mod_foot_icontit">食品安全</div>
                                <div class="mod_foot_service_detail">精选生鲜 严格质检</div>
                            </div>
                            <div class="mod_foot_service_division mod_foot_service_division_first">
                                <i class="mod_foot_service_division_icon mod_foot_iconfont"></i>
                            </div>
                        </div>

                        <div class="mod_foot_service_desc mod_foot_service_cold">
                            <div class="mod_foot_service_icon">
                                <i class="mod_foot_service_icon_wrap mod_foot_iconfont"></i>
                                <i class="mod_foot_service_icon_content mod_foot_iconfont"></i>
                            </div>
                            <div class="mod_foot_service_content">
                                <div class="mod_foot_service_title mod_foot_icontit">全程冷链</div>
                                <div class="mod_foot_service_detail">自营物流 安全可控</div>
                            </div>
                            <div class="mod_foot_service_division mod_foot_service_division_first">
                                <i class="mod_foot_service_division_icon mod_foot_iconfont"></i>
                            </div>
                        </div>

                        <div class="mod_foot_service_desc mod_foot_service_brand">
                            <div class="mod_foot_service_icon">
                                <i class="mod_foot_service_icon_wrap mod_foot_iconfont"></i>
                                <i class="mod_foot_service_icon_content mod_foot_iconfont"></i>
                            </div>
                            <div class="mod_foot_service_content">
                                <div class="mod_foot_service_title mod_foot_icontit">鲜活天然</div>
                                <div class="mod_foot_service_detail">绿色生态 京东精选</div>
                            </div>
                            <div class="mod_foot_service_division mod_foot_service_division_third">
                                <i class="mod_foot_service_division_icon mod_foot_iconfont"></i>
                            </div>
                        </div>
                        <div class="mod_foot_service_desc mod_foot_service_vip">
                            <div class="mod_foot_service_icon">
                                <i class="mod_foot_service_icon_wrap mod_foot_iconfont"></i>
                                <i class="mod_foot_service_icon_content mod_foot_iconfont"></i>
                            </div>
                            <div class="mod_foot_service_content">
                                <div class="mod_foot_service_title mod_foot_icontit">产地直采</div>
                                <div class="mod_foot_service_detail">限定产源 质量保证</div>
                            </div>
                            <div class="mod_foot_service_division mod_foot_service_division_fourth">
                                <i class="mod_foot_service_division_icon mod_foot_iconfont"></i>
                            </div>
                        </div>
                        <div class="mod_foot_service_desc mod_foot_service_saled">
                            <div class="mod_foot_service_icon">
                                <i class="mod_foot_service_icon_wrap mod_foot_iconfont"></i>
                                <i class="mod_foot_service_icon_content mod_foot_iconfont"></i>
                            </div>
                            <div class="mod_foot_service_content">
                                <div class="mod_foot_service_title mod_foot_icontit">无忧售后</div>
                                <div class="mod_foot_service_detail">优鲜赔 售后通道</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mod_foot_main">
                <div class="mod_foot_main_box">
                    <div class="mod_foot_info">
                        <div class="mod_foot_qrcode"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/foot-qrcode-weixin.png" srcset="" width="150" height="150" alt="">
                            <p>扫描关注，每周鲜享优惠</p>
                        </div>

                    </div>
                    <div class="mod_foot_lk">
                        <dl class="mod_foot_lk_item">
                            <dt>购物指南</dt>
                            <dd>
                                <a href="" target="_blank" title="购物流程">购物流程</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="售后政策">售后政策</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="支付方式">支付方式</a>
                            </dd>
                        </dl>
                        <dl class="mod_foot_lk_item">
                            <dt>配送方式</dt>
                            <dd>
                                <a href="" target="_blank" title="配送运费">配送运费</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="配送时效">配送时效</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="配送服务查询">配送服务查询</a>
                            </dd>
                        </dl>
                        <dl class="mod_foot_lk_item">
                            <dt>商家服务</dt>
                            <dd>
                                <a href="" target="_blank" title="商家入驻">商家入驻</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="平台规则">平台规则</a>
                            </dd>
                            <dd>
                                <a href="" target="_blank" title="联系我们">联系我们</a>
                            </dd>
                        </dl>
                        <dl class="mod_foot_lk_item">
                            <dt>专属客服</dt>
                            <dd>
                                <a href="" target="_blank" title="在线客服">在线客服</a>
                                <a href="" class="mod_foot_lk_item_dongdong" title="在线客服" target="_blank">咚咚咨询</a>
                            </dd>
                            <dd><span>客服电话</span>400-606-3311</dd>
                            <dd><span>服务时间</span>09:00-24:00</dd>
                            <dd><span>反馈邮箱</span>
                                <a href="mailto:fresh-fankui@jd.com">fresh-fankui@jd.com</a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mod_foot_right">Copyright&nbsp;©&nbsp;2004-2017&nbsp;&nbsp;京东JD.com&nbsp;版权所有</div>
            </div>
        </div>
    </div>

</div>

</body>

</html>