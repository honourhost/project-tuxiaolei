<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <if condition="empty($_GET['mer_id'])">
                <a href="{pigcms{:U('Crowdfunding/index')}" class="on">众筹列表</a>
                <else/>
                <a href="{pigcms{:U('Crowdfunding/index')}">众筹列表</a> |
                <a href="{pigcms{:U('Crowding/index',array('mer_id'=>$_GET['mer_id']))}" class="on">指定商家的众筹列表</a>
            </if>
        </ul>
    </div>
    <table class="search_table" width="100%">
        <tr>
            <td>
                <form action="{pigcms{:U('Crowdfunding/index')}" method="get">
                    <input type="hidden" name="c" value="Crowdfunding"/>
                    <input type="hidden" name="a" value="index"/>
                    <input type="hidden" name="mer_id" value="{pigcms{$_GET.mer_id}"/>
                    筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
                    <select name="searchtype">
                        <option value="crowd_id" <if condition="$_GET['searchtype'] eq 'crowd_id'">selected="selected"</if>>众筹编号</option>
                        <option value="title" <if condition="$_GET['searchtype'] eq 'title'">selected="selected"</if>>众筹名称</option>
                    </select>
                    <input type="submit" value="查询" class="button"/>
                </form>
            </td>
        </tr>
    </table>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <style>
                .table-list td{line-height:22px;padding-top:5px;padding-bottom:5px;}
            </style>
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>

                    <col width="240" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>名称（悬浮查看众筹标题）</th>
                    <th>档次列表</th>
                    <th>数据</th>
                    <th>时间</th>
                    <th>众筹状态</th>
                    <th>众筹订单</th>
                    <th class="textcenter">操作</th>

                </tr>
                </thead>
                <tbody>
                <if condition="is_array($group_list)">
                    <volist name="group_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.crowd_id}</td>
                            <td><a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Crowdfunding&a=detail&crowdid={pigcms{$vo.crowd_id}" target="_blank" title="{pigcms{$vo.title}">{pigcms{$vo.title}</a></td>
                            <td>
                                <volist name="vo.grades" id="grade">
                                    {pigcms{$grade.title}<br>
                                </volist>
                            </td>
                            <td>售出：{pigcms{$vo.dealnum} 份<br/></td>
                            <td>开始时间：{pigcms{$vo.starttime|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.endtime|date='Y-m-d H:i:s',###}<br/></td>
                            <td><switch name="vo['progress']"><case value="0"><font color="red">众筹中</font></case><case value="1"><font color="green">众筹结束</font></case></switch></td>
                            <td><if condition="$vo.dealnum eq 0 ">无订单<else/>您有{pigcms{$vo.dealnum}订单未处理</if></td>
                            <td class="textcenter"><a href="{pigcms{:U('Crowdfunding/lottery_order_list',array('crowd_id'=>$vo['crowd_id']))}">抽奖众筹订单列表</a> |<a href="{pigcms{:U('Crowdfunding/order_list',array('crowd_id'=>$vo['crowd_id']))}">普通众筹订单列表</a> | <a href="{pigcms{:U('Crowdfunding/edit',array('mer_id'=>$vo['mer_id'],'crowd_id'=>$vo['crowd_id']))}">编辑</a> | <a href="{pigcms{:U('Crowdfunding/anticheck',array('mer_id'=>$vo['mer_id'],'crowd_id'=>$vo['crowd_id']))}">反审核</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="11">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="11">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>