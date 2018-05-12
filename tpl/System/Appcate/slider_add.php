<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Appcate/slider_modify')}" enctype="multipart/form-data">
    <input type="hidden" name="cat_id" value="{pigcms{$now_category.id}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="80">名称</th>
            <td><input type="text" class="input fl" name="name" size="20" placeholder="请输入名称" validate="maxlength:20,required:true"/></td>
        </tr>
        <tr>
            <th width="80">描述</th>
            <td><input type="text" class="input fl" name="desc" size="60" placeholder="请输入描述（可不填）" validate="maxlength:60"/></td>
        </tr>
        <tr>
            <th width="80">特卖id</th>
            <td><input type="text" class="input fl" name="group_id" size="60" placeholder="请输入特卖id" validate="maxlength:60"/></td>
        </tr>
        <tr>
            <th width="80">图片</th>
            <td><input type="file" class="input fl" name="pic" style="width:180px;" placeholder="请上传图片" tips="可不上传"/></td>
        </tr>


        <tr>
            <th width="80">排序</th>
            <td><input type="text" class="input fl" name="sort" style="width:80px;" value="0" validate="maxlength:10,required:true,number:true"/></td>
        </tr>

    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
    function addLink(domid,iskeyword){
        art.dialog.data('domid', domid);
        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
    }
</script>
<include file="Public:footer"/>