<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>小农丁-拼团</title>
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telphone=no, email=no"/>
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/tuan.css"/>
</head>
<body>
<div class="public-cen">
    <div class="pin-header">
        <div class="left shop-img">
            <img src="{pigcms{$now_group.all_pic.0.m_image}" />
        </div>
        <h3>{pigcms{$now_group.s_name}</h3>
        <p>{pigcms{$group_buy.need_num}人团：<span>&yen;<i>{pigcms{$now_group['price']}</i></span>/件</p>
        <div style="clear: both;"></div>
    </div>
    <!-- tuan 内容 -->
    <div class="pin-pr">
        <div class="pin-pr-con">
            <volist name="users" id="user" key="k">
                <if condition="$k eq 1">
                    <a>
                        <img src="<php>echo getAvatar($user['uid']);</php>" />
                        <span>团长</span>
                    </a>
                    <else/>
                    <a>
                        <img src="<php>echo getAvatar($user['uid']);</php>" />
                    </a>
                </if>
            </volist>

        </div>

        <div style="clear: both;"></div>
        <p class="pin-p">还差<span><php>echo $group_buy['need_num']-$group_buy['react_num'];</php></span>人，盼你如南方人盼暖气~</p>
        <div class="pin-icon" style="display: none;">
            <img src="{pigcms{$static_path}images/groupbuy/icon-pin.png" />
        </div>
        <div class="pin-time">
            <span class="time-line"></span>
            <div class="pin-time-djs">
                <label>剩余：</label>
                <span>23</span>&nbsp;:
                <span>23</span>&nbsp;:
                <span>23</span>
                <label>结束</label>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="sanjiao">
            <img src="{pigcms{$static_path}images/groupbuy/sans.png" />
        </div>
        <div class="tuan">
            <span class="right time"><php>echo date("Y-m-d H:i:s",$group_buy['create_time']);</php>开团</span>
            <div class="fqr">
						<span>
							<img src="<php>echo getAvatar($group_buy['user_id']);</php>" />
						</span>
                <h3>团长&nbsp;{pigcms{$first.nickname}</h3>
            </div>
        </div>
    </div>
    
    <div class="cai">
        <h3 class="cai-title">你可能会喜欢</h3>
        <if condition="$category_group_list">
            <ul>
                <volist name="category_group_list" id="onegroup">
                    <li>
                        <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$onegroup['sun_id']))}">
                            <div class="car-img" style="background-image: url({pigcms{$onegroup.list_pic});"></div>
                            <h3>{pigcms{$onegroup.group_name}</h3>
                            <div class="car-price">
                                <b>&yen;{pigcms{$onegroup.price}</b>
                            </div>
                        </a>
                    </li>
                </volist>
            </ul>
            <else/>
            <ul>
                <li>
                    <p>暂时还没有推荐拼团...</p>
                </li>
            </ul>
        </if>
        <div style=" clear: both;"></div>
    </div>

</div>
<div style="width: 100%; height: 80px;"></div>
<div class="pin-footer">
    <span class="footer-bg"></span>
    <a class="btn-more left" href="{pigcms{:U('GroupBuy/lists')}">更多拼团</a>
    <if condition="$group_buy['status'] eq 0">
    <if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
    <a class="btn-bao right" href="{pigcms{:U('NewGroup/buy',array('group_id'=>$group_buy['group_id'],'sun_id'=>$group_buy['sun_id']))}">我也要参团</a>
    <else/>
    <a class="btn-bao right" href="javascript:void(0);">该活动已经结束</a>
    </if>
    <else/>
      <a class="btn-bao right" href="javascript:void(0);">该拼团已经完成或者结束</a>
    </if>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
        <script type="text/javascript">
            var shareData={
                        imgUrl: "{pigcms{$now_group.all_pic.0.m_image}", 
                        link: "{pigcms{$config.site_url}{pigcms{:U('GroupBuy/show', array('sun_id' => $group_buy['sun_id']))}",
                        title: "{pigcms{$now_group.s_name}拼团",
                        desc: "{pigcms{$now_group.need_num}人团"
            };
        </script>
         <include file="Share:share"/>
</body>
</html>