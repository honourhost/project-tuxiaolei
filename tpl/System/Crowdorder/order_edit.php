<include file="Public:header"/>
<style>
    .frame_form td{line-height:24px;}
</style>
<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
    <tr>
    <tr>
        <th width="15%">订单编号</th>
        <td width="35%">{pigcms{$now_order.corder_id}</td>
        <th width="15%">众筹商品</th>
        <td width="35%"><a href="{pigcms{$config['config_site_url']}/index.php?g=wap&c=Crowdfunding&a=detail&crowdid={pigcms{$now_order.crowd_id}" target="_blank" title="查看商品详情">{pigcms{$now_order.name}</a></td>
    </tr>
    </tr>


    <tr>
        <td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
    </tr>
    <tr>

        <th width="15%">订单状态</th>
        <td width="35%">
            <if condition="$now_order['paid']">
                <if condition="$now_order['status'] eq 2" >
                    <font color="red">已发货&nbsp;待评价</font>
                    <elseif condition="$now_order['status'] eq 0" />
                    <font color="green">未付款</font>&nbsp;

                    <elseif condition="$now_order['status'] eq 1"/>

                    <font color="red">未发货</font>
                    <elseif condition="$now_order['status'] eq 3"/>
                    <font color="green">已完成</font>
                    <else/>
                    <font color="green">已退款</font>
                </if>
                <else/>
                <font color="red">未付款</font>
            </if>
        </td>
    </tr>
    <tr>
        <th width="15%">数量</th>
        <td width="35%">{pigcms{$now_order.num}</td>
        <th width="15%">总价</th>
        <td width="35%">￥ {pigcms{$now_order.total_money}</td>
    </tr>
    <tr>
        <th width="15%">下单时间</th>
        <td width="35%">{pigcms{$now_order.add_time|date='Y-m-d H:i:s',###}</td>
        <if condition="$now_order['paid']">
            <th width="15%">付款时间</th>
            <td width="35%">{pigcms{$now_order.paytime|date='Y-m-d H:i:s',###}</td>
            <else/>
            <th width="15%"></th>
            <td width="35%"></td>
        </if>
    </tr>


    <if condition="$now_order['status'] eq 1">
        <tr>
            <th width="15%">发货时间</th>
            <td width="85%" colspan="3">{pigcms{$now_order.use_time|date='Y-m-d H:i:s',###}</td>
        </tr>
    </if>

    <tr>
        <td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
    </tr>
    <tr>
        <th width="15%">用户ID</th>
        <td width="35%">{pigcms{$now_order.uid}</td>
        <th width="15%">收货人姓名</th>
        <td width="35%">{pigcms{$now_order.contact_name}</td>
    </tr>
    <tr>
        <th width="15%">订单手机号</th>
        <td width="35%">{pigcms{$now_order.phone}</td>

    </tr>

        <tr>
            <td colspan="4" style="padding-left:5px;color:black;"><b>配送信息：</b></td>
        </tr>
        <tr>
            <th width="15%">收货人</th>
            <td width="35%">{pigcms{$now_order.contact_name}</td>
            <th width="15%">联系电话</th>
            <td width="35%">{pigcms{$now_order.phone}</td>
        </tr>
        <tr>
            <th width="15%">配送要求</th>

            <th width="15%">邮编</th>
            <td width="35%">{pigcms{$now_order.zipcode}</td>
        </tr>
        <tr>
            <th width="15%">收货地址</th>
            <td width="85%" colspan="3">{pigcms{$now_order.address}</td>
        </tr>

        <if condition="$now_order['paid'] eq '1'">
            <tr>
                <th width="15%">快递信息</th>
                <td width="85%" colspan="3">
                    <select id="express_type"><volist name="express_list" id="vo">
                            <if condition="$vo['id'] eq $now_order['express_type']">
                                <option value="{pigcms{$vo.id}" selected>{pigcms{$vo.name}</option>
                                <else/>
                                <option value="{pigcms{$vo.id}">{pigcms{$vo.name}</option>
                            </if>
                        </volist>
                    </select>
                    <input type="text" class="input" id="express_id" value="{pigcms{$now_order.express_id}" style="width:140px;"/> <button id="express_id_btn">填写</button></td>
            </tr>
        </if>


</table>
<div class="btn hidden">
    <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
    <input type="reset" value="取消" class="button" />
</div>
<script type="text/javascript">
    $(function(){
        <if condition="$now_order['paid'] eq 1 && $now_order['status'] eq 0">var fahuo=1;<else/>var fahuo=0;</if>
        $('#express_id_btn').click(function(){
            if(fahuo == 1){
                if(confirm("您确定要提交快递信息吗？提交后订单状态会修改为已发货。")){
                    express_post();
                }
            }else{
                express_post();
            }
        });

        function express_post(){
            $('#express_id_btn').html('提交中...').prop('disabled',true);
            $.post("{pigcms{:U('Crowdorder/group_express',array('order_id'=>$now_order['corder_id'],'mer_id'=>$now_order['mer_id']))}",{express_type:$('#express_type').val(),express_id:$('#express_id').val()},function(result){
                if(result.status == 1){
                    fahuo=0;
                    window.location.href = window.location.href;
                }
                $('#express_id_btn').html('填写').prop('disabled',false);
                alert(result.info);
            });
        }
    });
</script>
<include file="Public:footer"/