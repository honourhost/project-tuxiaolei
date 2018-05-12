<include file="Public:header"/>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                交纳押金
            </li>
        </ul>
    </div>
    <style>
				
	.form-xinxi{
		width: 100%;
		height: 40px;
		background: #f8f9fd;
		line-height: 40px;
		margin-bottom: 30px;
	}
	.form-xinxi h3{
		font-size: 16px;
		margin-left: 10px;
		color: #a1a1a1;
		line-height: 40px;
	}
	.form-xinxi2{
		width: 100%;
		height: 40px;
		background: #f8f9fd;
	}
	.form-xinxi2 h3{
		font-size: 16px;
		margin-left: 10px;
		color: #a1a1a1;
		line-height: 40px;
	}
	.form-page-nav{
		width: 100%;
		margin: 10px auto;
		height: 150px;
	}
	.form-page-nav ul{
		height: 60px;
		margin-left: 10%;
	}
	.form-page-nav ul li{
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
	.page-nav-01{
		background: #2bb0db;
		border-radius: 30px 0px 0px 30px;
	}
	#page-nav-02{
		background: #4bb9dc;
		height: 70px;
		position: relative;
		top: -5px;
		line-height: 70px;
		font-size: 20px;
	}
	.page-nav-03{
		background: #6bc6e3;
	}
	.page-nav-04{
		background: #88d4ec;
	}
	.page-nav-05{
		background: #a1def1;
	}
	.page-nav-06{
		background: #b8e6f5;
	}
	.page-nav-07{
		background: #d3f1fb;
	}
	.form-page-nav p{
		text-align: center;
		width: 100%;
		font-size: 14px;
		color: #a2a2a2;
		padding-top: 10px;
	}
	.tab-content{
		border: 0;
	}
	.form-group{
		height: 50px;
	}
</style>
    <!-- 内容头部 -->
    <div class="page-content">
    	<div class="form-xinxi">
			<h3>商户信息</h3>
		</div>
		<div class="form-page-nav">
			<ul>
				<li class="page-nav-01">申请</li>
				<li id="page-nav-02">提交信息</li>
				<li class="page-nav-03">交保证金</li>
				<li class="page-nav-04">完成审核</li>
				<li class="page-nav-05"></li>
				<li class="page-nav-06"></li>
				<li class="page-nav-07"></li>
			</ul>
			
			<p>备注：申请过程中，可能会由于资料问题需重新申请</p>
		</div>
		<div class="form-xinxi2">
			<h3>交押金</h3>
		</div>
        <div class="tab-content">
        <form enctype="multipart/form-data" class="form-horizontal" method="post">
        <div class="form-group">
            <label class="col-sm-1"><label for="name">押金数</label></label>
            <input class="col-sm-1" size="20" name="money" id="money" type="text" readonly value="2000"/>
        </div>

            <button class="btn btn-info" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                点击确认缴纳
            </button>

            </form>
            </div>
    </div>
</div>
<include file="Public:footer"/>
