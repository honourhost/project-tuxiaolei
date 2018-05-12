<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Tags/modify')}" frame="true" refresh="true">
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="80">标签</th>
            <td><input type="text" class="input fl" name="tagname" size="20" placeholder="请输入标签名称" validate="maxlength:50,required:true"/></td>
        </tr>


        <tr>
            <th width="80">标签排序</th>
            <td><input type="text" class="input fl" name="sort" size="10" value="0" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
        </tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<include file="Public:footer"/>