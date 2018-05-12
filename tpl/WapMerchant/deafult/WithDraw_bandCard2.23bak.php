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
    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('WithDraw/bandCard')}">
        <div class="tixian">
            <if condition="$lastinfo">
                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="merchant_real_name" placeholder="请正确填写真实姓名" value="{pigcms{$lastinfo.merchant_real_name}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="merchant_real_telephone" placeholder="请正确填写电话信息" value="{pigcms{$lastinfo.merchant_real_telephone}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" placeholder="请务必正确填写银行信息"  value="{pigcms{$lastinfo.bank_name}" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" placeholder="请务必正确填写银行卡号信息"  value="{pigcms{$lastinfo.bank_card}" />

                    </li>

                </ul>
                <else />
                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="merchant_real_name" placeholder="请正确填写真实姓名" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="merchant_real_telephone" placeholder="请正确填写电话信息" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" placeholder="请务必正确填写银行信息" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" placeholder="请务必正确填写银行卡号信息" />

                    </li>

                </ul>
            </if>
            <button class="tx-btn" type="submit">确认提交</button>
        </div>
    </form>
</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
</body>
</html>
