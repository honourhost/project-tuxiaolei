<include file="Public:header"/>
<div class="mainbox">

    <table class="search_table" width="100%">
        <tr>
            <td>
                <form action="{pigcms{:U('Group/lottery_pin_order')}" method="get">
                    <input type="hidden" name="c" value="Group"/>
                    <input type="hidden" name="a" value="lottery_pin_order"/>
                    筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
                    <select name="searchtype">
                        <option value="order_id" <if condition="$_GET['searchtype'] eq 'order_id'">selected="selected"</if>>订单编号</option>
                        <option value="s_name" <if condition="$_GET['searchtype'] eq 's_name'">selected="selected"</if>>{pigcms{$config.group_alias_name}名称</option>
                        <option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>客户名称</option>
                        <option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>客户电话</option>
							<option value="group_id" <if condition="$_GET['searchtype'] eq 'group_id'">selected="selected"</if>>特卖ID</option>
                    </select>
                    <input type="submit" value="查询" class="button"/>
                </form>
            </td>
        </tr>
    </table>

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
                    <col width="100" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>订单编号</th>
                    <th>{pigcms{$config.group_alias_name}信息</th>
                    <th>商家信息</th>
                    <th>订单信息</th>
                    <th>订单用户</th>
                    <th>查看用户信息</th>
                    <th>订单状态</th>
                    <th>时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($order_list)">
                    <volist name="order_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.order_id}</td>
                            <td><a  target="_blank" href="{pigcms{$config['config_site_url']}/group/{pigcms{$vo.group_id}.html">{pigcms{$config.group_alias_name}ID：{pigcms{$vo.group_id}　{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.g_price}<br/>{pigcms{$config.group_alias_name}名称：{pigcms{$vo.s_name}<br/>备注：{pigcms{$vo.remarks}</a></td>
                            <td>商家ID：{pigcms{$vo.mer_id}　商家电话：{pigcms{$vo.m_phone}<br/>商家名称：{pigcms{$vo.m_name}</td>
                            <td>数量：{pigcms{$vo.num}<br/>总价：￥{pigcms{$vo.total_money|floatval=###}</td>
                            <td><if condition="$vo['pinnickname']">团长昵称:{pigcms{$vo.pinnickname}</br></if>中奖用户名：{pigcms{$vo.nickname}<br/>订单手机号：{pigcms{$vo.group_phone}</td>
                            <td>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/edit',array('uid'=>$vo['uid']))}','编辑用户信息',680,560,true,false,false,editbtn,'edit',true);">查看用户信息</a>
                            </td>
                            <td>
                                <if condition="$vo['status'] eq 3">
                                    <font color="blue">已取消</font>
                                    <elseif condition="$vo['paid'] eq 1"/>
                                    <if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" >
                                        <font color="red">线下支付&nbsp;未付款</font>
                                        <elseif condition="$vo['status'] eq 0" />
                                        <font color="green">已付款</font>&nbsp;
                                        <php>if($vo['tuan_type'] != 2){</php>
                                        <font color="red">未消费</font>
                                        <php>}else{</php>
                                        <font color="red">未发货</font>
                                        <php>}</php>
                                        <elseif condition="$vo['status'] eq 1"/>
                                        <php>if($vo['tuan_type'] != 2){</php>
                                        <font color="green">已消费</font>
                                        <php>}else{</php>
                                        <php>if($vo['user_confirm']==0){</php>
                                        <font color="green">已发货 待确认</font>
                                        <php>}else{</php>
                                        <font color="green">已发货 已确认</font>
                                        <php>}</php>
                                        <php>}</php>&nbsp;
                                        <font color="red">待评价</font>
                                        <else/>
                                        <font color="green">已完成</font>
                                    </if>
                                    <else/>
                                    <font color="red">未付款</font>
                                </if>
                            </td>
                            <td>
                                下单时间：{pigcms{$vo['add_time']|date='Y-m-d H:i:s',###}<br/>
                                <if condition="$vo['paid']">付款时间：{pigcms{$vo['pay_time']|date='Y-m-d H:i:s',###}</if>
                            </td>
                            <td class="textcenter"><if condition="($vo['paid'] eq 0) AND ($vo['status'] neq 3)"><a href="javascript:void(0);" class="cancle_row" parameter="order_id={pigcms{$vo['order_id']}" url="/xnd_admin.php?g=System&c=Group&a=order_cancle">取消订单</a> | </if><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/order_edit',array('order_id'=>$vo['order_id']))}','查看订单详情',600,460,true,false,false,false,'order_edit',true);">查看详情</a></td>
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