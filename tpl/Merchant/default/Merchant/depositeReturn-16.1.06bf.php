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
                <h3>缴纳金额：{pigcms{$deposite.pay_money}</h3>
                <h3>缴纳时间：<php>echo date('Y-m-d H:i:s',$deposite['create_time']);</php></h3>
                <if condition="$deposite['status']==0">
                <h3>押金已缴纳，请先耐心等待后台审核...</h3>
                    <elseif condition="$deposite['status']==1"/>
                    <h3>审核已通过</h3>
                    <else/>
                <h3>缴纳审核反馈时间：<php>echo date('Y-m-d H:i:s',$deposite['verify_time']);</php></h3>
                <h3>缴纳审核反馈信息：{pigcms{$deposite.verify_info}</h3>
                </if>
                <else/>
                <h3>暂时没有缴纳的信息</h3>
            </if>
        </div>
    </div>
</div>
<include file="Public:footer"/>
