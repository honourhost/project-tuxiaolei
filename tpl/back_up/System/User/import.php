<include file="Public:header"/>
<style type="text/css">
.importexcel{height: 60px;line-height: 60px;}
.importexcel a{ cursor: pointer;}
</style>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('User/import')}" class="on">客户导入</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<div class="importexcel">
							&nbsp;&nbsp;&nbsp;示例表格：
							<a target="_blank" href="{pigcms{$config['site_url']}/upload/excel/user/sample.xls">点击下载</a>
					</td>
				</tr>
				<tr>
					<td>
						<div class="importexcel">
						  <span>Excel导入： </span>
						  <a href="javascript:;"><input type="file" title="Excel导入"  id="excelimport"  name="excelfile" value="选择文件上传"/></a>
						</div>
					</td>
				</tr>
			</table>
		</div>

<script type="text/javascript" src="{pigcms{$static_public}js/ajaxfileupload.js"></script>
<script type='text/javascript'>
// 上传excel 表格
function ExcelImport(){
       $.ajaxFileUpload({
       url:"{pigcms{:U('User/execimport')}",    //需要链接到服务器地址
       secureuri:false,
       fileElementId:'excelimport',                 //文件选择框的id属性
       dataType: 'json',
       success: function (data) {
       if(data.error){
		   alert(data.msg);
	    }else{
			 alert('导入成功！');
			 window.location.href="{pigcms{:U('User/importlist')}";
		   }
		   $("#excelimport").change(function(){ 
                ExcelImport();            
           });
        } 
     }); 
  }

  $("#excelimport").change(function(){ 
          ExcelImport();            
     });
</script>
<include file="Public:footer"/>