<include file="Public:header"/>
<div class="mainbox">
    <h1>商家申请提现的列表</h1>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>申请提现真实姓名</th>
                    <th>联系电话</th>
                    <th>提现银行</th>
                    <th>提现银行卡号</th>
                    <th>提现金额</th>
                    <th>提现申请时间</th>
                    <th>提现反馈时间</th>
                    <th>提现反馈状态</th>
                   <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($cash_list)">
                    <volist name="cash_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.merchant_real_name}</td>
                            <td>{pigcms{$vo.merchant_real_telephone}</td>
                            <td>{pigcms{$vo.bank_name}</td>
                            <td>{pigcms{$vo.bank_card}</td>
                            <td>{pigcms{$vo.cash_num}</td>
                            <td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                            <td><if condition="$vo['record_time']"><php>echo date("Y-m-d H:i:s",$vo['record_time']);</php><else/>还没有进行处理的申请</if></td>
                            <td><if condition="$vo['record_status']==1">提现成功<elseif condition="$vo['record_status']==2"/>提现被驳回<else/>正在申请中</if></td>
                            <td><if condition="$vo['record_status']==0"><a href="{pigcms{:U('Cash/index')}">去处理</a><else/></if></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="12">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="12">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>