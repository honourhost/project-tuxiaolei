<include file="Public:header"/>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                缴纳反馈信息
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="tab-content">
            <if condition="$deposite">
                <h3>缴纳金额：{pigcms{$deposite.pay_money}；</h3>
                <h3>缴纳时间：<php>echo date('Y-m-d H:i:s',$deposite['create_time']);</php></h3>
                <else/>
                <h3>暂时没有缴纳的信息</h3>
            </if>
        </div>
    </div>
</div>
<include file="Public:footer"/>
