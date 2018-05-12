<include file="Public:header"/>
<style type="text/css">
    .table-list p{font-size: 18px; margin-left: 25px; line-height: 1em;}
</style>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <a href="javascript:;">导出订单文件</a>
    </div>


    <table class="search_table" width="100%">
        <tr>
            <td>
                <div style="margin-left: 50px;">
                    <span>导出订单文件</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exportOrder()">立即导出普通特卖订单</button>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exportUnsendOrder()">立即导出特卖支付未发货订单</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exportPinOrder()">立即导出拼团订单</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exportUnsendPinOrder()">立即导出拼团未发货订单</button>
                </div>
            </td>
        </tr>
    </table>
    <div class="table-list">
        <p>导出可能需要较长时间，请不要关闭窗口，静静等待！下载完成后刷新页面再重新下载！</p>
    </div>

</div>

<script type="text/javascript">
    var islock=false;
    function exportOrder(){

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="{pigcms{:U('DownloadOrder/export')}";
       // $('.table-list').append('<p>正在执行生成，请稍等......</p>');
//        $.ajax({
//            url:"{pigcms{:U('DownloadOrder/export')}",
//            type:"post",
//            data:{pam:'嘿嘿！'},
//            dataType:"JSON",
//            success:function(ret){
//                ret.error=parseInt(ret.error);
//                islock=false;
//                if(!ret.error){
//                    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="{pigcms{$config.site_url}/{pigcms{$xmlfilepath}" target="_blank" style="color:#1083F2;">访问文件</a></p>');
//                }else{
//                    $('.table-list').append('<p>'+ret.msg+'</p>');
//                    alert(ret.msg);
//                }
//                /*setTimeout(function(){
//                 window.location.href="";
//                 },5000);*/
//            }
//        });
    }
    function exportPinOrder(){

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="{pigcms{:U('DownloadOrder/exportPin')}";
       // $('.table-list').append('<p>正在执行生成，请稍等......</p>');
//        $.ajax({
//            url:"{pigcms{:U('DownloadOrder/export')}",
//            type:"post",
//            data:{pam:'嘿嘿！'},
//            dataType:"JSON",
//            success:function(ret){
//                ret.error=parseInt(ret.error);
//                islock=false;
//                if(!ret.error){
//                    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="{pigcms{$config.site_url}/{pigcms{$xmlfilepath}" target="_blank" style="color:#1083F2;">访问文件</a></p>');
//                }else{
//                    $('.table-list').append('<p>'+ret.msg+'</p>');
//                    alert(ret.msg);
//                }
//                /*setTimeout(function(){
//                 window.location.href="";
//                 },5000);*/
//            }
//        });
    }

    function exportUnsendOrder(){

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="{pigcms{:U('DownloadOrder/exportUnsend')}";
       // $('.table-list').append('<p>正在执行生成，请稍等......</p>');
//        $.ajax({
//            url:"{pigcms{:U('DownloadOrder/export')}",
//            type:"post",
//            data:{pam:'嘿嘿！'},
//            dataType:"JSON",
//            success:function(ret){
//                ret.error=parseInt(ret.error);
//                islock=false;
//                if(!ret.error){
//                    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="{pigcms{$config.site_url}/{pigcms{$xmlfilepath}" target="_blank" style="color:#1083F2;">访问文件</a></p>');
//                }else{
//                    $('.table-list').append('<p>'+ret.msg+'</p>');
//                    alert(ret.msg);
//                }
//                /*setTimeout(function(){
//                 window.location.href="";
//                 },5000);*/
//            }
//        });
    }

    function exportUnsendPinOrder(){

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="{pigcms{:U('DownloadOrder/exportUnsendPin')}";
       // $('.table-list').append('<p>正在执行生成，请稍等......</p>');
//        $.ajax({
//            url:"{pigcms{:U('DownloadOrder/export')}",
//            type:"post",
//            data:{pam:'嘿嘿！'},
//            dataType:"JSON",
//            success:function(ret){
//                ret.error=parseInt(ret.error);
//                islock=false;
//                if(!ret.error){
//                    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="{pigcms{$config.site_url}/{pigcms{$xmlfilepath}" target="_blank" style="color:#1083F2;">访问文件</a></p>');
//                }else{
//                    $('.table-list').append('<p>'+ret.msg+'</p>');
//                    alert(ret.msg);
//                }
//                /*setTimeout(function(){
//                 window.location.href="";
//                 },5000);*/
//            }
//        });
    }
</script>
<include file="Public:footer"/>