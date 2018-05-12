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
                    <th>店铺id</th>
                    <th>订单号</th>
                    <th>缴纳金额</th>
                    <th>提现请求状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($merchant_list)">
                    <volist name="merchant_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.mer_id}</td>
                            <td>{pigcms{$vo.order_id}</td>
                            <td>{pigcms{$vo.pay_money}</td>
                            <td><if condition="$vo['cash_status']==0">等待处理<else/>已完成处理</if></td>
                            <td><a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Merchant/finishDeposite')}">缴纳信息确认</a> | <a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Merchant/rejectDeposite',array('id'=>$vo['id']))}','编辑驳回的详情',480,240,true,false,false,editbtn,'edit',true);"">驳回</a></td>
                </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="9">{pigcms{$pagebar}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>