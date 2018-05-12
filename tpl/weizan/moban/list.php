<!--商品层-->

<div class="category_list_img">
    <a href="{pigcms{$voo.url}" target="_blank">
        <img alt="{pigcms{$voo.s_name}" class="deal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$voo.list_pic}"/>
    </a>
    <div class="datal" style="padding:5px 15px 5px;">
        <a href="{pigcms{$voo.url}" target="_blank">
            <div class="category_list_title">【{pigcms{$voo.prefix_title}】{pigcms{$voo.merchant_name}</div>
            <div class="category_list_description">{pigcms{$voo.group_name}</div>
        </a>
        <div class="deal-tile__detail cf">
            <div class="price">&yen;<strong>{pigcms{$voo.price}</strong> </div>
            <span>&yen;{pigcms{$voo.old_price}</span>
            <div class="sales">已售{pigcms{$voo['sale_count']+$voo['virtual_num']}</div >													
        </div>
        <div class="extra-inner">
            <if condition="$voo['wx_cheap']">
            <div class="cheap">微信购买立减￥{pigcms{$voo.wx_cheap}</div>
            </if>

            <div class="noreviews">
                <if condition="$liu_type == 'juli'">
                    <div class="around-distance">距离您<em>约{pigcms{:round($group_around_range[$voo['group_id']]/1000,1)}公里</em></div>
                </if> 
                <if condition="empty($liu_type)">
                    <if condition="$voo['reply_count']">
                    <a href="{pigcms{$voo.url}#anchor-reviews" target="_blank">
                        <div class="icon"><span style="width:{pigcms{$voo['score_mean']/5*100}%;" class="rate-stars"></span></div>
                        <span>{pigcms{$voo.reply_count}次评价 </span>
                    </a>
                    <else/>
                    <span>暂无评价</span>
                    </if>
                </if>
            </div>
        </div>
    </div>
    <div class="liu_youhui">
        <if condition="($voo['once_max'] gt 0) OR ($voo['once_min'] gt 1) or ($voo['count_num'] gt 0)">
            <span class="hong">限量</span>
        </if>
    </div>
</div>
