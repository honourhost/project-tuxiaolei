<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Jicai/index')}">集采管理</a>
            </li>
            <li class="active">集采列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success" onclick="CreateShop()">添加集采</button>
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="120">编号</th>
                                <th>名称（悬浮查看商品标题、图片）</th>
                                <th>价格</th>
                                <th>销售概览</th>
                                <th>时间</th>



                                <th width="200" style="text-align:center;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$group_list">
                                <volist name="group_list" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td>{pigcms{$vo.group_id}</td>
                            <td><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.group_id}" target="_blank" data-title="{pigcms{$vo.name}" data-pic="{pigcms{$vo.list_pic}" class="group_name">{pigcms{$vo.s_name}</a></td>
                            <td>{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.price}元<br/>原价：￥{pigcms{$vo.old_price}元</td>
                            <td>售出：{pigcms{$vo.sale_count} 份<br/>库存： <if condition="$vo['count_num']">{pigcms{$vo.count_num}<else/>无限制</if><br/>虚拟：{pigcms{$vo.virtual_num} 人</td>
                            <td>开始时间：{pigcms{$vo.begin_time|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.end_time|date='Y-m-d H:i:s',###}<br/>{pigcms{$config.group_alias_name}券有效期：{pigcms{$vo.deadline_time|date='Y-m-d H:i:s',###}</td>


                            <td style="text-align:center;">
                                <if condition="$vo['group_lock'] eq 0">
                                    <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('Jicai/edit',array('group_id'=>$vo['group_id']))}">编辑</a>
                                </if>
                                &nbsp;<a style="width: 60px;" class="label label-sm label-info" title="订单列表" href="{pigcms{:U('Jicai/order_list',array('group_id'=>$vo['group_id']))}">订单列表</a>


                            </td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="11" >您没有添加过集采！</td></tr>
                            </if>
                            </tbody>
                        </table>
                        {pigcms{$pagebar}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
    function CreateShop(){
        window.location.href = "{pigcms{:U('Jicai/add')}";
    }
    $(function(){
        $('.group_name').hover(function(){
            var top = $(this).offset().top;
            var left = $(this).offset().left+$(this).width()+10;
            $('body').append('<div id="group_name_div" style="position:absolute;z-index:5555;background:white;top:'+top+'px;left:'+left+'px;border:1px solid #ccc;padding:10px;"><div style="margin-bottom:10px;"><b>商品标题：</b>'+$(this).data('title')+'</div><div><b>商品图片：</b><img src="'+$(this).data('pic')+'" style="width:180px;"/></div></div>');
        },function(){
            $('#group_name_div').remove();
        });
        $('.see_qrcode').click(function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看渠道二维码',
                padding: 0,
                width: 430,
                height: 433,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });
    });
</script>
<include file="Public:footer"/>
