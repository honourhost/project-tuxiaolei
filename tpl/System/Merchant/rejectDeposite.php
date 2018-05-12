<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Merchant/rejectDeposite')}" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{pigcms{$deposite.id}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100%">编辑驳回详情信息</th>
        </tr>
        <tr>
            <td width="100%"><textarea type="text" name="verify_info" id="verify_info" value="{pigcms{$cash.verify_info}" style="width:97%;height:100px;"></textarea></td>
        </tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<include file="Public:footer"/>