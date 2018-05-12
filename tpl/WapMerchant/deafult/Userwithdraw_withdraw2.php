<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>填写提现信息</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
    <style>
        .fuwu2{
            width: 100%;
            text-align: center;
            color: #acacac;
            padding-bottom: 10px;
            padding-top: 30px;

        }

    </style>
    <script src="http://www.xiaonongding.com/tpl/Wap/default/static/js/jquery.min.js"></script>
    <style>
        .yanzheng {
            margin: 20px 15px;
            height: 35px;
            line-height: 35px;
            margin-bottom: 10px;
            border-bottom: 1px solid #f9f9f9;
            padding-bottom: 7px;
        }

        .inp-num {
            width: 53%;
            height: 30px;
            text-indent: 5px;
            font-size: 14px;
            border: 1px solid #f9f9f9;
            color: #191919;
            font-family: arial, helvetica, sans-serif
        }

        .yz-btn {
            width: 40%;
            float: right;
            height: 32px;
            font-size: 14px;
            background: #1aad19;
            color: #fff;
            border: 0;
            text-align: center;

        }

        .yz-btn1 {
            width: 40%;
            float: right;
            height: 32px;
            font-size: 14px;
            background: rgba(22, 21, 34, 0.49);
            color: #fff;
            border: 0;
            text-align: center;

        }

    </style>


</head>
<body style="background: #fff;">

<div class="cen-main">
    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Userwithdraw/withdraw')}">
        <div class="tixian">

                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="real_name" placeholder="真实姓名" onfocus="this.placeholder=''" onblur="this.placeholder='真实姓名'" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="real_telephone" placeholder="手机号" onfocus="this.placeholder=''" onblur="this.placeholder='手机号'" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" placeholder="请务必填写完整的开户支行" onfocus="this.placeholder=''" onblur="this.placeholder='请务必填写完整的开户支行'"   />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" placeholder="银行卡号" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="cash_money" placeholder="提现金额" onfocus="this.placeholder=''" onblur="this.placeholder='提现金额'" />

                    </li>

                </ul>

            <button class="tx-btn2" type="submit" style="display:none;">确认提交</button>
        </div>
    </form>
    <span class="tx-btn" >确认提交</span>
</div>
<div class="fuwu2">
    本服务由小农丁提供
</div>
<script>
    $(document).ready(function(){




        $(".tx-btn").click(function () {
            var money = $("input[name='cash_money']").val();
            if (money <50) {
                alert('最小提现金额为50');
                return;
            }

            $("form").submit();

        });
    });



</script>
</body>
</html>
