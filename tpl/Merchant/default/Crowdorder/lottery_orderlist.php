<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <i class="ace-icon fa fa-comments-o comments-o-icon"></i>
            <li class="active"><a href="{pigcms{:U('Crowdfunding/index')}">众筹列表</a></li>
            <li>{pigcms{$now_group.name}</li>
            <li>抽奖众筹订单列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">

                <div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>订单编号</th>
                                <th>众筹名称</th>
                                <th>用户信息</th>
                                <th>订单状态</th>
                                <th class="button-column">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                            <volist name="order_list" id="vo">
                                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                                <td width="100">{pigcms{$vo.corder_id}</td>
                                <td width="200"><a href="{pigcms{$config['config_site_url']}/index.php?g=Wap&c=Crowdfunding&a=detail&crowdid={pigcms{$vo.crowd_id}" target="_blank">众筹ID：{pigcms{$vo.cgrade_id}　众筹价：￥{pigcms{$vo.g_price}<br/>众筹名称：{pigcms{$vo.title}<br/>备注：{pigcms{$vo.remarks}</a></td>
                                <td width="150">
                                    用户名：{pigcms{$vo.nickname}<br/>订单手机号：{pigcms{$vo.group_phone}
                                </td>

                                <td width="200">
                                    <if condition="$vo['status'] eq 4">
                                        <font color="blue">已取消</font>
                                        <elseif condition="$vo['status'] eq 1"/>
                                        <font color="blue">已支付 未发货</font>
                                        <elseif condition="$vo['status'] eq 2"/>
                                        <font color="blue">已发货 未评价</font>

                                        <elseif condition="$vo['status'] eq 3"/>
                                        <font color="blue">已完成</font>

                                        <else/>
                                        <font color="red">未付款</font>
                                    </if>
                                </td>
                                <td class="button-column" width="40">
                                    <a title="操作订单" class="green handle_btn" style="padding-right:8px;" href="{pigcms{:U('Crowdorder/order_edit',array('order_id'=>$vo['corder_id']))}">
                                        <i class="ace-icon fa fa-search bigger-130"></i>
                                    </a>


                                </td>
                                </tr>
                            </volist>
                            </tbody>
                        </table>
                        {pigcms{$pagebar}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
    $(function(){
        $('.handle_btn').live('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'操作订单',
                padding: 0,
                width: 720,
                height: 520,
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

        $('#group_id').change(function(){
            $('#frmselect').submit();
        });
    });
</script>
<include file="Public:footer"/>
