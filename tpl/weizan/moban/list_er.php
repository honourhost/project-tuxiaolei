<!--商家二维码浮动层-->


<a href="{pigcms{$voo.url}" target="_blank">
    <div class="bmbox">
            <div class="bmbox_title"> 该商家有<b> {pigcms{$voo.fans_count} </b>个粉丝</div>
            <div class="bmbox_list">
                <div class="bmbox_list_img"><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']))}" /></div>
                <div class="bmbox_list_li">
                    <ul>
                        <li class="liu_list_ico_supp open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$voo.mer_id}.html">商家</li>
                        <li class="liu_list_ico_dian open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$voo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
                        <li class="liu_list_ico_gou open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$voo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
                    </ul>
                </div>
                <div class="liu_list_jindian">
                    马上下单
                </div>
            </div>
    </div>
</a>