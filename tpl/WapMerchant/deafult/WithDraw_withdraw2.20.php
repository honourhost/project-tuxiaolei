<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>提现</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
</head>
<body style="background: #fff;">
<div class="cen-main">
    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('WithDraw/withdraw')}">
    <div class="tixian">
        <ul>
            <li>
                <label>店主真实姓名：</label>
                <input type="text" name="merchant_real_name" />
                <p>请正确填写真实姓名</p>
            </li>
            <li>
                <label>联系电话：</label>
                <input type="text" name="merchant_real_telephone" />
                <p>请正确填写电话信息</p>
            </li>
            <li>
                <label>银行名称：</label>
                <input type="text" name="bank_name" />
                <p>请务必正确填写银行信息</p>
            </li>
            <li>
                <label>银行卡号：</label>
                <input type="text"  name="bank_card" />
                <p>请务必正确填写银行卡号信息</p>
            </li>
            <li>
                <label>申请提现金额：</label>
                <input type="text" name="cash_num"/>
                <p>最低提现金额为50元</p>
            </li>
        </ul>
        <button class="tx-btn" type="submit">确认提现</button>
    </div>
        </form>
</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
</body>
</html>
