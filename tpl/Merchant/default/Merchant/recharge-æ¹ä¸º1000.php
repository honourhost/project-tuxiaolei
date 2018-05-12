<include file="Public:header"/>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                交纳押金
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="tab-content">
        <form enctype="multipart/form-data" class="form-horizontal" method="post">
        <div class="form-group">
            <label class="col-sm-1"><label for="name">押金数</label></label>
            <input class="col-sm-1" size="20" name="money" id="money" type="text" readonly value="0.01"/>
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
