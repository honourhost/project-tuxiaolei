<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Crowdfunding/index')}">众筹管理</a>
            </li>
            <li class="active">众筹列表</li>
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
                    <button class="btn btn-success" onclick="CreateShop()">添加众筹</button>
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="120">编号</th>
                                <th>名称（悬浮查看商品标题、图片）</th>
                                <th>档次列表</th>
                                <th>时间</th>
                                <th>查看数</th>

                                <th width="100">众筹状态</th>
                                <th width="200" style="text-align:center;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$group_list">
                                <volist name="group_list" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td>{pigcms{$vo.crowd_id}</td>
                            <td><a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Crowdfunding&a=detail&crowdid={pigcms{$vo.crowd_id}" target="_blank" data-title="{pigcms{$vo.title}" data-pic="{pigcms{$vo.list_pic}" class="group_name">{pigcms{$vo.title}</a></td>
                            <td>
                                <volist name="vo.grades" id="grade">
                                    {pigcms{$grade.title}<br>
                                </volist>
                            </td>
                            <td>开始时间：{pigcms{$vo.starttime|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.endtime|date='Y-m-d H:i:s',###}<br/></td>
                            <td>{pigcms{$vo.hit}</td>

                            <!--td><switch name="vo['type']"><case value="1">进行中，未开团</case><case value="2">进行中，已开团</case><case value="3">已结束，团购成功</case><case value="4">已结束，团购结束</case></switch></td-->
                            <td>
                                <if condition="$vo['starttime'] gt $_SERVER['REQUEST_TIME']">
                                    未开始
                                    <elseif condition="$vo['endtime'] lt $_SERVER['REQUEST_TIME']"/>
                                    已结束
                                    <else/>
                                    进行中
                                </if>
                            </td>
                            <td style="text-align:center;"><a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('Crowdfunding/edit',array('crowd_id'=>$vo['crowd_id']))}">编辑</a>|<a href="javascript:void(0);" class="cancle_row" parameter="crowd_id={pigcms{$vo['crowd_id']}" url="{pigcms{:U('Crowdfunding/group_cancle')}">删除</a>&nbsp;&nbsp;<a style="width: 60px; " class="label label-sm label-info" title="普通众筹订单" href="{pigcms{:U('Crowdorder/orderlist',array('crowd_id'=>$vo['crowd_id']))}">普通众筹订单</a><br>
                                <a style="width: 60px; " class="label label-sm label-info" title="抽奖众筹订单" href="{pigcms{:U('Crowdorder/lottery_orderlist',array('crowd_id'=>$vo['crowd_id']))}">抽奖众筹订单</a></td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="11" >您没有添加过众筹！</td></tr>
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
        window.location.href = "{pigcms{:U('Crowdfunding/add')}";
    }
    $(function(){
        $('.group_name').hover(function(){
            var top = $(this).offset().top;
            var left = $(this).offset().left+$(this).width()+10;
            $('body').append('<div id="group_name_div" style="position:absolute;z-index:5555;background:white;top:'+top+'px;left:'+left+'px;border:1px solid #ccc;padding:10px;"><div style="margin-bottom:10px;"><b>众筹标题：</b>'+$(this).data('title')+'</div><div><众筹图片：</b><img src="'+$(this).data('pic')+'" style="width:180px;"/></div></div>');
        },function(){
            $('#group_name_div').remove();
        });

    });
    //取消操作
    $('.cancle_row').click(function(){
        var now_dom = $(this);
        window.top.art.dialog({
            icon: 'question',
            title: '请确认',
            id: 'msg' + Math.random(),
            lock: true,
            fixed: true,
            opacity:'0.4',
            resize: false,
            content: '你确定这样操作吗？操作后可能不能恢复！',
            ok:function (){
                $.post(now_dom.attr('url'),now_dom.attr('parameter'),function(result){
                    if(result.status == 1){
                        window.top.msg(1,result.info,true);
                        window.location.reload();
                    }else{
                        window.top.msg(0,result.info);
                    }
                });
            },
            cancel:true
        });
        return false;
    });
</script>
<include file="Public:footer"/>
