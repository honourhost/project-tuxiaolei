<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>提现明细</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css"/>
</head>
<body>
<div class="cen-main">
    <div class="my-jifen">
       <!-- <span><i>进入积分商城</i><img src="{pigcms{$static_path}images/icon-right.jpg" /></span>-->
        <h3>我的零钱：<b>￥{pigcms{$lingqian}</b></h3>
    </div>
    <div class="mx-list">
        <ul>

         <volist name="cashlist" id="cash">
             <li>
                 <div class="mx-tit">
                     <h3>{pigcms{$cash.merchant_real_name} ￥{pigcms{$cash.cash_num}</h3>
                     <h4>{pigcms{$cash.bank_num}</h4>
                 </div>
                 <div class="mx-price">
                     <b class="jia"><if condition="$cash.status eq 0 ">提现中<elseif condition="$cash.status eq 1"/>已提现<else/>已驳回</if></b>
                     <span><?php echo  date('Y-m-d H:i:s', $cash["create_time"]);?></span>
                 </div>
                 <div class="clear-both"></div>
             </li>
         </volist>
        </ul>
    </div>
</div>
</body>
</html>
