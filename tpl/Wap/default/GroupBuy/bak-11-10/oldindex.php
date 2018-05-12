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
    <link href="{pigcms{$static_path}css/groupbuy/tuan.css" rel="stylesheet"/>
</head>
<body>
<div class="public-cen">
    <div class="tuan-list">
        <ul>
            <if condition="$group_list">
                <volist name="group_list" id="group">
                    <li>
                        <a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$group['group_id']))}">
                            <div class="tuan-list-img" style="background-image: url({pigcms{$group.list_pic});"></div>
                            <h3>{pigcms{$group.group_name}</h3>
                            <div class="tuan-list-foot">
                                <span class="right tuan-btn">去开团<img src="{pigcms{$static_path}images/groupbuy/jiantou.png" /></span>
                                <span class="left num"><img src="{pigcms{$static_path}images/groupbuy/tuan.png">{pigcms{$group.need_num}人团</span>
                                <span class="left price">&yen;<i>{pigcms{$group.price}</i></span>
                                <del class="left old-price">单买价：&yen;<php>echo getGroupPrice($group['related_id']);</php></del>
                            </div>
                            <div style="clear: both;"></div>
                        </a>
                    </li>
                </volist>
        </ul>
        <div style="clear: both;"></div>
    </div>
</div>
</body>
</html>
