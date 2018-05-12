<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Merchant/index')}">商户列表</a>
            <a href="{pigcms{:U('Merchant/fastorder',array('mer_id'=>$mer_id))}" class="on">商家账单</a>
        </ul>
    </div>
    <div style="margin:15px 0;">
        <b>商家ID：</b>{pigcms{$now_merchant.mer_id}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>商家名称：</b>{pigcms{$now_merchant.name}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>联系电话：</b>{pigcms{$now_merchant.phone}<br/><br/>
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
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="100" align="center"/>
                </colgroup>
                <thead>
                <tr>

                    <th>类型</th>

                    <th>订单号</th>
                    <th>订单详情</th>
                    <th>数量</th>
                    <th>金额</th>
                    <th>余额支付金额</th>
                    <th>在线支付金额</th>
                    <th>商户余额支付金额</th>
                    <th>优惠券</th>
                    <th>下单时间</th>
                    <th>支付时间</th>
                    <th>支付类型</th>
                    <th>状态</th>

                </tr>
                </thead>
                <tbody>
                <if condition="$order_list">
                    <volist name="order_list" id="vo">
                        <tr>
                            <td>快捷付款</td>
                            <td>{pigcms{$vo.order_id}</td>
                            <td>

                                <if condition="$vo['name'] eq 1">
                                    <volist name="vo['order_name']" id="menu">
                                        {pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
                                    </volist>
                                    <else />{pigcms{$vo.order_name}</if>
                            </td>
                            <td>{pigcms{$vo.total}</td>
                            <td>{pigcms{$vo.order_price}</td>
                            <td>{pigcms{$vo.balance_pay}</td>
                            <td>{pigcms{$vo.payment_money}</td>
                            <td>{pigcms{$vo.merchant_balance}</td>
                            <td><if condition="$vo['card_id'] eq 0">未使用<else/>已使用</if></td>
                            <td>{pigcms{$vo.submit_order_time|date="Y-m-d H:i:s",###}</td>
                            <td><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
                            <td>{pigcms{$vo.pay_type_show}</td>
                            <td>
                                <if condition="$vo['paid'] eq 0">
                                    未付款
                                    <else />
                                    <if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])">线下未支付
                                        <elseif condition="$vo['status'] eq 0" />未付款
                                        <elseif condition="$vo['status'] eq 1" />已付款
                                        <elseif condition="$vo['status'] eq 2" />已完成
                                    </if>
                                </if>
                            </td>
                        </tr>
                    </volist>

                    <tr class="odd">
                        <td colspan="16" id="show_count"></td>
                    </tr>
                    <tr><td class="textcenter pagebar" colspan="16">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr class="odd"><td class="textcenter red" colspan="16" >该的店铺暂时还没有订单。</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>