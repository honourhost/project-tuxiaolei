<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Appcate/index')}">推薦导航分类列表</a>|
            <a href="{pigcms{:U('Appcate/slider_list',array('cat_id'=>$now_category['id']))}" class="on">{pigcms{$now_category.name} - 导航列表</a>|
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/slider_add',array('cat_id'=>$now_category['id']))}','添加导航',500,240,true,false,false,addbtn,'add',true);">添加导航</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col />
                    <col />
                    <col width="180" align="center"/>
                    <col width="180" align="center"/>

                </colgroup>
                <thead>
                <tr>
                    <th>排序</th>
                    <th>编号</th>
                    <th>名称</th>
                    <th>链接地址</th>
                    <th>状态</th>
                    <th>图片(以下为强制小图，点击图片查看大图)</th>
                    <th class="textcenter">操作</th>

                </tr>
                </thead>
                <tbody>
                <if condition="is_array($slider_list)">
                    <volist name="slider_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.sort}</td>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.name}</td>
                            <td><a href="{pigcms{$config.site_url}/group/{pigcms{$vo.group_id}.html" target="_blank">访问链接</a></td>
                            <td><?php if($vo['status']==1){?>开启 <?php }else{?>关闭<?php }?>  结束时间: <?php echo  date("Y/m/d H:i:s", $vo["end_time"]);?></td>
                            <td>
                                <if condition="$vo['pic']">
                                    <img src="{pigcms{$config.site_url}/upload/appslider/{pigcms{$vo.pic}" style="width:50px;height:50px;" class="view_msg"/>
                                    <else/>
                                    没有图片
                                </if>
                            </td>
                            <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/slider_edit',array('id'=>$vo['id'],'frame_show'=>true))}','查看信息',480,330,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/slider_edit',array('id'=>$vo['id']))}','编辑信息',480,330,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Appcate/slider_del')}">删除</a></td>

                        </tr>
                    </volist>
                    <else/>
                    <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>