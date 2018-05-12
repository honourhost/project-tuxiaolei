<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>小农丁-扫码购买</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        img{
            border: 0;
        }
        body,div,input{
            margin: 0;
            padding: 0;
        }
        .chongzhi{
            max-width: 650px;
            min-width: 240px;
            margin: 20px auto;
        }
        .cz-input{
            display: block;
            width: 94%;
            height: 40px;
            line-height: 40px;
            text-indent: 10px;
            border: 1px solid #ddd;
            margin: 0px auto;
        }
        .cz-sub{
            display: block;
            border: 0;
            width: 94%;
            background: red;
            color: #fff;
            height: 45px;
            line-height: 45px;
            border-radius: 5px;
            font-size: 18px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
<div class="chongzhi">
    <form method="post" action="{pigcms{:U('Qrpay/test2')}">


    <input  type="number"  step="0.01" placeholder="请输购买产品金额" class="cz-input" name="money"/>
    <input type="submit" class="cz-sub" value="微信付款" />
    </form>
</div>
</body>
</html>
