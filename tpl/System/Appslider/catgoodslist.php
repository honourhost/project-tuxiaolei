<include file="Public:header"/>
<div class="mainbox">


    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <style>
                .table-list td{line-height:22px;padding-top:5px;padding-bottom:5px;}
            </style>
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="240" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>名称（悬浮查看商品标题）</th>
                    <th>价格</th>
                    <th>销售概览</th>
                    <th>查看二维码</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($group_list)">
                    <volist name="group_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.id}" target="_blank" title="{pigcms{$vo.title}">{pigcms{$vo.title}</a></td>
                            <td>{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.current_price}元<br/>原价：￥{pigcms{$vo.origin_price}元</td>
                            <td>售出：{pigcms{$vo.sale_count} 份<br/><!--库存： <if condition="$vo['count_num']">{pigcms{$vo.count_num}<else/>无限制</if><br/>虚拟：{pigcms{$vo.virtual_num} 人--></td>
                            <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=group&id={pigcms{$vo.id}','查看二维码',430,433,true,false,false,null,'merchant_qrcode',true);" class="see_qrcode">查看二维码</a></td>

                            <td class="textcenter"><a href="{pigcms{:U('Group/order_list',array('group_id'=>$vo['id']))}">订单列表</a> | <a href="{pigcms{:U('Group/reply_list',array('group_id'=>$vo['id']))}">评论列表</a> | <a href="{pigcms{:U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id'],'group_id'=>$vo['id']))}">编辑</a>  | <a href="javascript:void(0);" class="cancle_row" parameter="group_id={pigcms{$vo['id']}" url="{pigcms{:U('Group/group_cancle')}">删除</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="11">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="11">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>