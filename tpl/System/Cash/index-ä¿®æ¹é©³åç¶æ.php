<include file="Public:header"/>
<div class="mainbox">
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <if condition="empty($_GET['cat_fid'])">
                        <col/>
                        <col/>
                    </if>
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>店铺名称</th>
                    <th>提交申请人真实姓名</th>
                    <th>电话</th>
                    <th>银行名称</th>
                    <th>银行卡号</th>
                    <th>申请提现金额</th>
                    <th>提现请求状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($cash_list)">
                    <volist name="cash_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.name}</td>
                            <td>{pigcms{$vo.merchant_real_name}</td>
                            <td>{pigcms{$vo.merchant_real_telephone}</td>
                            <td>{pigcms{$vo.bank_name}</td>
                            <td>{pigcms{$vo.bank_card}</td>
                            <td>{pigcms{$vo.cash_num}</td>
                            <td><if condition="$vo['cash_status']==0">等待审核<else/>已经完成提现</if></td>
                            <td><a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Cash/finish')}">完成提现</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Cash/reject')}">驳回</a></td>
                </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="8">{pigcms{$pagebar}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>