<include file="Public:header"/>
<div class="mainbox">
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>提交申请商家id</th>
                     <th>提交申请时间</th>
                    <th>审核通过时间</th>
                    <th class="textcenter">状态</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($merchants)">
                    <volist name="merchants" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.mer_id}</td>
                            <td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                            <td><php>echo date("Y-m-d H:i:s",$vo['response_time']);</php></td>
                            <td class="textcenter">审核通过</td>
                            <td  class="textcenter"><a href="{pigcms{:U('Merchant/merchant_has_verify',array('id'=>$vo['id']))}">点击查看</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>