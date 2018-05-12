
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>付款确认</title>
    <meta name="description" content="{pigcms{$config.seo_description}">
    <script src="http://www.xiaonongding.com/tpl/Wap/default/static/js/jquery.min.js"></script>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body,img,div,span,input,ul,li{
        margin: 0;
        padding: 0;
    }
    img{
        border: 0;
    }
    a{
        color: #333;
        text-decoration: none;
    }
    body{
        background: #eeedf2;
        font-size: 12px;
    }
    .max-width{
        max-width: 650px;
        min-width: 240px;
        margin: 0px auto;
    }
    .logo-xnd{
        width: 100px;
        height: 70px;
        margin: 20px auto 20px auto;
        border-radius: 5px;
        overflow: hidden;
        text-align: center;
    }
    .logo-xnd img{
        height: 70px;
    }
    .xnd-zhuanzhang{
        width: 90%;
        margin: 0px auto;
        background: #fff;
        border: 1px solid #d9d8dd;
    }
    .xnd-zhuanzhang h3{
        display: block;
        width: 90%;
        margin: 0px auto;
        height: 40px;
        line-height: 40px;
        color: #757575;
        font-weight: 100;
        font-size: 16px;
    }
    .xnd-je{
        width: 90%;
        margin: 0px auto 0px auto;
        padding-bottom: 10px;
    }
    .xnd-je img{
        height: 20px;
        position: relative;
        top: 3px;
    }
    .xnd-je input{
        width: 80%;
        height: 40px;
        line-height: 40px;
        border: 0;
        font-size: 20px;
    }
    .zz-btn{
        width: 90%;
        margin: 20px auto;
        background: #419156;
        height: 45px;
        text-align: center;
        line-height: 45px;
        color: #fff;
        border-radius: 3px;
        font-size: 18px;
    }
    .zz-btn a{
        color: #fff;
        font-size: 20px;
    }
</style>
<body>
<div class="max-width">
    <div class="logo-xnd">
        <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/logo.png" />
    </div>
    <div class="xnd-zhuanzhang">
        <h3>转账金额</h3>
        <div class="xnd-je">
            <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/rmb.png" />
            <input type="number" step="0.01" name="moneynothide" placeholder="请输入转账金额" />
        </div>
    </div>
    <div class="zz-btn">
        <a>转账</a>
        <form method="post"  style="display: none;" id="moneyform" action="{pigcms{:U('Index/goPay')}">
            <input type="hidden" name="money">
            <input type="submit" style="display: none;">
        </form>
    </div>
</div>
<script>
    $(function () {
        $(".zz-btn").click(function () {
            var money= $("input[name='moneynothide']").val();

            if(money.length==0){
                alert('钱数不能为空，请重新填写！');

            }else if(money<=0){
                alert('请填写正确的钱数！');
            }else {
                $("input[name='money']").val(money);
                $("#moneyform").submit();
            }

        });

    });
</script>
<script type="text/javascript">
    var title = '小农丁';
    var shareData = {
        imgUrl: 'http://www.xiaonongding.com/xnd.png',
        link: "http://www.xiaonongding.com/merchantbuy.php?g=MerchantBuy&c=index&a=pay&mer_id={pigcms{$mer_id}",
        title: "小农丁",
        desc: "小农丁"
    };
</script>
<include file="Share:share"/>
</body>
</html>