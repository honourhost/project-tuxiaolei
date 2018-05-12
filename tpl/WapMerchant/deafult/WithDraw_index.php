<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>零钱</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
</head>

<body style="background: #fff;">
<div class="cen-main">
    <div class="lq-main">
        <div class="lq-img">
            <img src="{pigcms{$static_path}images/lingqian.jpg" />
        </div>
        <div class="lq-font">
            <h3>我的余额</h3>
            <span>&yen;{pigcms{$lingqian}</span>
        </div>
      <if condition="$cashing eq 1">
          <a class="tx-btn" style="background: #a2a1a1;">提现中</a>
          <else />
          <a class="tx-btn" href="{pigcms{:U('Withdraw/withdraw')}">提现</a>
      </if>
        <p class="mingxi"><a href="{pigcms{:U('Withdraw/detail')}">提现明细</a><img src="{pigcms{$static_path}images/icon-right.jpg" /></p>
        <div class="fuwu">
            本服务由小农丁提供
        </div>
    </div>

</div>
</body>

</html>