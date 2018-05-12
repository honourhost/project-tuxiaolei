<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Cash/reject')}" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{pigcms{$cash.id}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100%">驳回反馈信息</th>
        </tr>
        <tr>
            <td width="100%"><textarea type="text" name="note" id="note" value="{pigcms{$cash.note}" style="width:97%;height:100px;"></textarea></td>
        </tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<include file="Public:footer"/>