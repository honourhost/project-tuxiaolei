<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>修改银行卡</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
</head>
<body style="background: #fff;">
<div class="cen-main">
    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('WithDraw/modifyCard')}">
        <div class="tixian">
            <if condition="$cardinfo">
                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="merchant_real_name" placeholder="真实姓名" onfocus="this.placeholder=''" onblur="this.placeholder='真实姓名'" value="{pigcms{$cardinfo.user_name}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="merchant_real_telephone" placeholder="手机号" onfocus="this.placeholder=''" onblur="this.placeholder='手机号'" value="{pigcms{$cardinfo.phone}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" placeholder="开户行信息" onfocus="this.placeholder=''" onblur="this.placeholder='开户行信息'"  value="{pigcms{$cardinfo.bank_name}" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" placeholder="银行卡号" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'" value="{pigcms{$cardinfo.bank_card}" />

                    </li>

                </ul>
                <else />
                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="merchant_real_name" onfocus="this.placeholder=''" onblur="this.placeholder='真实姓名'" placeholder="真实姓名" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="merchant_real_telephone" onfocus="this.placeholder=''" onblur="this.placeholder='手机号'" placeholder="手机号" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" onfocus="this.placeholder=''" onblur="this.placeholder='开户行信息'" placeholder="开户行信息" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'" placeholder="银行卡号" />

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
