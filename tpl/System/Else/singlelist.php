<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>

                <a href="{pigcms{:U('Else/singlelist')}" class="on">商品列表</a>

        </ul>
    </div>

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
                    <col/>
                    <col width="240" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>名称（悬浮查看商品标题）</th>
                    <th>价格</th>
                    <th>销售概览</th>
                    <th>时间</th>
                    <th>数字</th>
                    <th>查看二维码</th>
                    <th>运行状态</th>
                    <th>特卖状态</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($group_list)">
                    <volist name="group_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.group_id}</td>
                            <td><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.group_id}" target="_blank" title="{pigcms{$vo.name}">{pigcms{$vo.s_name}</a></td>
                            <td>{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.price}元<br/>原价：￥{pigcms{$vo.old_price}元</td>
                            <td>售出：{pigcms{$vo.sale_count} 份<br/><!--库存： <if condition="$vo['count_num']">{pigcms{$vo.count_num}<else/>无限制</if><br/>虚拟：{pigcms{$vo.virtual_num} 人--></td>
                            <td>开始时间：{pigcms{$vo.begin_time|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.end_time|date='Y-m-d H:i:s',###}<br/>{pigcms{$config.group_alias_name}券有效期：{pigcms{$vo.deadline_time|date='Y-m-d H:i:s',###}</td>

                            <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=group&id={pigcms{$vo.group_id}','查看二维码',430,433,true,false,false,null,'merchant_qrcode',true);" class="see_qrcode">查看二维码</a></td>
                            <td>
                                <if condition="$vo['begin_time'] gt $_SERVER['REQUEST_TIME']">
                                    未开团
                                    <elseif condition="$vo['end_time'] lt $_SERVER['REQUEST_TIME']"/>
                                    已结束
                                    <else/>
                                    进行中
                                </if>
                            </td>
                            <td><switch name="vo['status']"><case value="0"><font color="red">关闭</font></case><case value="1"><font color="green">正常</font></case><case value="2"><font color="red">审核中</font></case></switch></td>
                            <td class="textcenter"><a href="{pigcms{:U('Group/order_list',array('group_id'=>$vo['group_id']))}">订单列表</a> </td>
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