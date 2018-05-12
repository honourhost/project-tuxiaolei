<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>绑定银行卡</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
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
<body style="background: #fff;">

<div class="yanzheng" >

    <input type="text" class="inp-num" name="yzm" onfocus="this.placeholder=''" placeholder="请输入验证码"/>
    <span type="button" class="yz-btn">点击发送短信</span>

</div>
<div class="cen-main">
    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('WithDraw/bandCard')}">
        <div class="tixian">
            <if condition="$lastinfo">
                <ul>
                    <li>
                        <label><img src="{pigcms{$static_path}images/zhanghao.png" /></label>
                        <input type="text" name="merchant_real_name" placeholder="真实姓名" onfocus="this.placeholder=''" onblur="this.placeholder='真实姓名'" value="{pigcms{$lastinfo.merchant_real_name}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/dianhua.png" /></label>
                        <input type="text" name="merchant_real_telephone" placeholder="手机号" onfocus="this.placeholder=''" onblur="this.placeholder='手机号'" value="{pigcms{$lastinfo.merchant_real_telephone}"/>

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text" name="bank_name" placeholder="请务必填写完整的开户支行" onfocus="this.placeholder=''" onblur="this.placeholder='请务必填写完整的开户支行'"  value="{pigcms{$lastinfo.bank_name}" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" placeholder="银行卡号" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'" value="{pigcms{$lastinfo.bank_card}" />

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
                        <input type="text" name="bank_name" onfocus="this.placeholder=''" onblur="this.placeholder='请务必填写完整的开户支行'" placeholder="请务必填写完整的开户支行" />

                    </li>
                    <li>
                        <label><img src="{pigcms{$static_path}images/ynhang.png"></label>
                        <input type="text"  name="bank_card" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'" placeholder="银行卡号" />

                    </li>

                </ul>
            </if>
            <button class="tx-btn2" type="submit" style="display: none">确认提交</button>
        </div>
    </form>
    <button class="tx-btn" >确认提交</button>


</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
<script>
    $(".tx-tbn").click(function () {
       // var yanzhengma=$(".inp-num").val();
        alert("ddd");

    });
</script>
</body>
</html>
