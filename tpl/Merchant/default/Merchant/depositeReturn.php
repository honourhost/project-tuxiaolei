<include file="Public:header"/>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                缴纳反馈信息
            </li>
        </ul>
    </div>
    <style>
					.form-xinxi {
						width: 100%;
						height: 40px;
						background: #f8f9fd;
						line-height: 40px;
						margin-bottom: 30px;
					}
					
					.form-xinxi h3 {
						font-size: 16px;
						margin-left: 10px;
						color: #a1a1a1;
						line-height: 40px;
					}
					
					.form-xinxi2 {
						width: 100%;
						height: 40px;
						background: #f8f9fd;
					}
					
					.form-xinxi2 h3 {
						font-size: 16px;
						margin-left: 10px;
						color: #a1a1a1;
						line-height: 40px;
					}
					
					.form-page-nav {
						width: 100%;
						margin: 10px auto;
						height: 150px;
					}
					
					.form-page-nav ul {
						height: 60px;
						margin-left: 10%;
					}
					
					.form-page-nav ul li {
						float: left;
						list-style-type: none;
						height: 60px;
						padding: 0px 40px;
						font-size: 18px;
						line-height: 60px;
						text-align: center;
						color: #fff;
						font-family: "microsoft yahei";
					}
					
					#page-nav-01 {
						background: #2bb0db;
						border-radius: 30px 0px 0px 30px;
					}
					
					#page-nav-02 {
						background: #4bb9dc;
					}
					
					#page-nav-03 {
						background: #6bc6e3;
					}
					
					#page-nav-04 {
						background: #88d4ec;
						height: 70px;
						position: relative;
						top: -5px;
						line-height: 70px;
						font-size: 20px;
					}
					
					.page-nav-05 {
						background: #a1def1;
					}
					
					.page-nav-06 {
						background: #b8e6f5;
					}
					
					.page-nav-07 {
						background: #d3f1fb;
					}
					
					.form-page-nav p {
						text-align: center;
						width: 100%;
						font-size: 14px;
						color: #a2a2a2;
						padding-top: 10px;
					}
					
					.tab-content {
						border: 0;
					}
					
					.form-group {
						height: 50px;
					}
					
					.tab-content-bzj {
						width: 80%;
						margin: 0px auto;
					}
					
					.tab-content-price {
						width: 100%;
						height: 60px;
						margin-top: 20px;
					}
					
					.tab-content-price label {
						float: left;
						width: 80px;
						font-size: 16px;
						color: #888888;
						height: 55px;
						line-height: 55px;
					}
					
					.tab-content-price-sp {
						display: inline-block;
						float: left;
						width: 170px;
						height: 55px;
						line-height: 55px;
						font-size: 28px;
						font-family: "microsoft yahei";
						color: #ff8b27;
						text-align: center;
						margin-right: 10px;
						background: #ededed;
					}
					
					.tab-content-price img {
						height: 47px;
					}
					
					.tab-content-btn {
						clear: both;
						display: block;
						margin: 0px auto;
						width: 358px;
						height: 65px;
						line-height: 65px;
						text-align: center;
						background: #ff8b26;
						color: #fff;
						font-size: 28px;
						border-radius: 5px;
						text-decoration: none;
						font-weight: bold;
					}
					
					.wx-onclick {
						display: inline-block;
						float: left;
						width: 170px;
						height: 55px;
						line-height: 45px;
						font-size: 28px;
						font-family: "microsoft yahei";
						color: #ff8b27;
						text-align: center;
						margin-right: 10px;
						border: 2px solid #f8f9fd;
						background: #f8f9fd;
					}
					
					.zfb-onclick {
						display: inline-block;
						float: left;
						width: 170px;
						height: 55px;
						line-height: 45px;
						font-size: 28px;
						font-family: "microsoft yahei";
						color: #ff8b27;
						text-align: center;
						margin-right: 10px;
						border: 2px solid #ededed;
						background: #ededed;
					}
					
					.wx-onclick-border {
						border: 2px solid #4fb640;
					}
					
					.tab-content-btn:hover {
						color: #fff;
						text-decoration: none;
					}
					
					.tab-content h3 {
						font-size: 16px;
					}
				</style>
    <!-- 内容头部 -->
    <div class="page-content">
    	<div class="form-xinxi">
			<h3>商户信息</h3>
		</div>
		<div class="form-page-nav">
			<ul>
				<li id="page-nav-01">申请</li>
				<li id="page-nav-02">提交信息</li>
				<li id="page-nav-03">交保证金</li>
				<li id="page-nav-04">完成审核</li>
				<li class="page-nav-05"></li>
				<li class="page-nav-06"></li>
				<li class="page-nav-07"></li>
			</ul>

			<p>备注：申请过程中，可能会由于资料问题需重新申请</p>
		</div>
		<div class="form-xinxi2">
			<h3>缴纳信息</h3>
		</div>
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
                <button class="btn btn-info" onclick="window.location.href='{pigcms{:U('Merchant/newRecharge')}'">
                <i class="ace-icon fa fa-check bigger-110"></i>
                点击重新填写缴纳申请
                </button>
                </if>
                <else/>
                <h3>暂时没有缴纳的信息</h3>
            </if>
        </div>
    </div>
</div>
<include file="Public:footer"/>
