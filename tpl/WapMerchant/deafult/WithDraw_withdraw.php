<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>提现</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style3.css"/>
    <script src="http://www.xiaonongding.com/tpl/Wap/default/static/js/jquery.min.js"></script>
    <style>
        .yanzheng {
            margin: 0px 15px;
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
    <script type="text/javascript">
        $(function () {
            //获取短信验证码
            var validCode = true;
            $(".yz-btn").click(function () {
                var time = 30;
                var code = $(this);
                if (validCode) {
                    sendVerify();
                    validCode = false;
                    code.addClass("yz-btn1");
                    var t = setInterval(function () {
                        time--;
                        code.html(time + "秒");
                        if (time == 0) {
                            clearInterval(t);
                            code.html("重新获取");
                            validCode = true;
                            code.removeClass("yz-btn1");

                        }
                    }, 1000)
                }
            })
        })

        function sendVerify() {
            $.post("<?php echo U("Api/Index/sendNewVerifyCode");?>", {mobile: 15725266012}, function (result) {
                var jsondata = eval("(" + result + ")")
                alert(jsondata.errorMsg);

            });
        }
    </script>
</head>
<body>
<div class="cen-main">
    <div class="ka-main">
        <div class="ka">
            <label class="ka-left">
                到账银行卡
            </label>
            <div class="ka-right">
                <a href="{pigcms{:U('WithDraw/modifyCard')}"><h3>
                        {pigcms{$merchant_card.bank_name}（<?php echo substr($merchant_card['bank_card'], strlen($merchant_card['bank_card']) - 4); ?>
                        ）</h3></a>
                <!--      <p>手续费0.1%</p>-->
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="jiner">
            <h3>提现金额</h3>
            <div class="jine-inp">
                <i><img src="{pigcms{$static_path}images/renminbi.png"/></i>
                <input type="text" name="moneynothide" onfocus="this.placeholder=''" placeholder="输入提现金额(最低50元)"
                       style="font-size: 20px;"/>
            </div>
            <div class="yanzheng" style="display: none;">

                <input type="text" class="inp-num" name="yzm" onfocus="this.placeholder=''" placeholder="请输入验证码"/>
                <span type="button" class="yz-btn">点击发送短信</span>

            </div>

            <p><a id="cash_all">全部提现</a></p>
        </div>
        <p class="p-con">12小时内到账</p>
        <a class="inp-btn">提现</a>

        <form method="post" style="display: none;" id="moneyform" action="{pigcms{:U('WithDraw/withdraw')}">
            <li style="display: none;">
                <label><img src="{pigcms{$static_path}images/zhanghao.png"/></label>
                <input type="text" name="merchant_real_name" placeholder="请正确填写真实姓名" onfocus="this.placeholder=''"
                       value="{pigcms{$merchant_card.user_name}"/>

            </li>
            <li style="display: none;">
                <label><img src="{pigcms{$static_path}images/dianhua.png"/></label>
                <input type="text" name="merchant_real_telephone" placeholder="请正确填写电话信息" onfocus="this.placeholder=''"
                       value="{pigcms{$merchant_card.phone}"/>

            </li>
            <li style="display: none;">
                <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                <input type="text" name="bank_name" placeholder="请务必正确填写银行信息" onfocus="this.placeholder=''"
                       value="{pigcms{$merchant_card.bank_name}"/>

            </li>
            <li style="display: none;">
                <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                <input type="text" name="bank_card" placeholder="请务必正确填写银行卡号信息" onfocus="this.placeholder=''"
                       value="{pigcms{$merchant_card.bank_card}"/>

            </li>
            <input type="hidden" name="cash_num">
            <input type="hidden" name="yanzhengma">
            <input type="submit" style="display: none;">
        </form>
    </div>
</div>

<script>
    $(function () {
        $(".inp-btn").click(function () {
            var money = $("input[name='moneynothide']").val();
            if (money > 50000) {
                alert('由于微信限制，钱数太多了');
                return;
            }

            if (money.length == 0) {
                alert('钱数不能为空，请重新填写！');
                return;

            } else if (money <= 0) {
                alert('请填写正确的钱数！');
                return;
            } else {
                $("input[name='cash_num']").val(money);
                $("#moneyform").submit();
            }

        });

        $("#cash_all").click(function () {

            $("input[name='moneynothide']").val("<?php echo $can_cash;?>");

        });

    });
</script>
</body>
</html>
