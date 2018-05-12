
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


        margin: 50px auto 20px auto;
        border-radius: 5px;
        text-align: center;
    }
    .logo-xnd p{


        line-height: 35px;
        text-align: center;
        color: #757575;
    }
    .logo-xnd img{
        height: 70px;
    }
    .xnd-zhuanzhang{
        width: 90%;
        margin: 0px auto;
        background: #fff;
        border: 1px solid #d9d8dd;
        padding-bottom: 10px;
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
        padding-top: 8px;
    }
    .xnd-je{
        width: 90%;
        margin: 0px auto 0px auto;
        padding-bottom: 10px;
    }
    .xnd-je img{
        height: 14px;
        position: relative;
        top: 0px;
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
        background: #4da433;
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
    .fuwu{
        width: 100%;
        text-align: center;
        color: #acacac;
        padding-bottom: 10px;
        position: absolute;
        bottom: 0;
        left: 0;
    }
</style>
<body>
<div class="max-width">
    <div class="logo-xnd">
        <img src="{pigcms{$merinfo.person_image}" />
        <p>向{pigcms{$merinfo.name}支付</p>
    </div>
    <div class="xnd-zhuanzhang">
        <h3>付款金额</h3>
        <div class="xnd-je">
            <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/rmb.png" />
            <input type="number" step="0.01" name="moneynothide" onfocus="this.placeholder=''"  max="10000000" placeholder="请输入付款金额" />
        </div>
    </div>
    <div class="zz-btn">
        <a>确认支付</a>
        <form method="post"  style="display: none;" id="moneyform" action="{pigcms{:U('Index/goPay')}">
            <input type="hidden" name="money">
            <input type="submit" style="display: none;">
        </form>
    </div>
</div>
<div class="fuwu">
    本服务由小农丁提供
</div>
<script>
    $(function () {
        $(".zz-btn").click(function () {
            var money= $("input[name='moneynothide']").val();
            if(money>10000000){
                alert('由于微信限制，钱数太多了');
                return;
            }

            if(money.length==0){
                alert('钱数不能为空，请重新填写！');
                return;

            }else if(money<=0){
                alert('请填写正确的钱数！');
                return;
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