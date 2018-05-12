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
                    <col/>
                    <col/>
                    <col/>
                    <col width="180" align="center"/>
                    <col/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>提交申请人真实姓名</th>
                    <th>电话</th>
                    <th>银行名称</th>
                    <th>银行卡号</th>
                    <th>申请提现金额</th>
                    <th>提现请求状态</th>
                    <th>操作</th>
                    <th>申请时间</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($cash_list)">
                    <volist name="cash_list" id="vo">
                        <tr>
                            <td><if condition="$vo['cash_status']==0"><h6 style="color: red;">{pigcms{$vo.id}</h6><else /> {pigcms{$vo.id}</if></td>
                            <td>{pigcms{$vo.real_name}</td>
                            <td>{pigcms{$vo.real_telephone}</td>
                            <td>{pigcms{$vo.bank_name}</td>
                            <td>{pigcms{$vo.bank_card}</td>
                            <td>{pigcms{$vo.cash_money}</td>
                            <td><if condition="$vo['status']==0"><h6 style="color: red;">等待审核</h6><elseif condition="$vo['status']==2"/>已驳回(驳回信息：{pigcms{$vo.note})<else/>已经完成提现</if></td>
                            <td><a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Usercash/finish')}">完成提现</a> | <a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Usercash/reject',array('id'=>$vo['id']))}','编辑驳回信息',480,240,true,false,false,editbtn,'edit',true);"">驳回</a></td>
                            <td>{pigcms{$vo.add_time|date='Y-m-d H:i',###}</td>
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