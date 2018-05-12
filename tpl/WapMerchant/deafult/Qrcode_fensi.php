<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>我的粉丝</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css" />
    <style>
        .fensi{
            margin: 0px auto;
            background: #fff;
            max-width: 650px;
            min-width: 240px;
        }
        .fensi ul li{
            width: 100%;
            padding: 10px 0px;
            border-bottom: 1px solid #f5f5f5;
        }
        .fensi-logo{
            float: left;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 40px;
            margin: 0px 10px;
        }
        .fensi-logo img{
            width: 40px;
            height: 40px;
        }
        .fensi-t{
            float: left;
            margin-top: 3px;
        }
        .fensi-r{
            float: right;
        }
        .fensi-t h3{
            font-size: 14px;
            color: #7C7C7C;
            padding-bottom: 3px;
            height: 20px;
        }
        .fensi-t h4{
            font-size: 12px;
            color: #7C7C7C;
        }
        .fensi-r{
            margin-right: 10px;
            color: #7C7C7C;
            margin-top: 3px;
        }
        .fensi-r span{
            font-size: 14px;
            padding-bottom: 3px;
            display: inline-block;
            color: #12AF7E;
        }
        .fensi-r span.nei{
            color: red;
        }
        .fensi-r h4{
            font-size: 12px;
            position: relative;
            top: 4px;
        }
        .leiji{
            margin: 0px 10px;
            padding: 15px 0px;
            border-bottom: 1px solid #f5f5f5;
        }
        .leiji h3{
            font-size: 14px;
            color: #7C7C7C;
        }
        .leiji h3 b{
            font-size: 24px;
            color: #ff9900;
            font-weight: normal;
        }
        .fuwu2{
            width: 100%;
            text-align: center;
            color: #acacac;
            line-height: 80px;

        }
    </style>
</head>
<body>
<div class="fensi">
    <div class="leiji">
        <h3>累计粉丝数：<b>{pigcms{$fanscount}</b></h3>
    </div>
    <ul>

<volist name="fans" id="fan">
    <li>
        <div class="fensi-logo">
            <img src="{pigcms{$fan.avatar}"/>
        </div>
        <div class="fensi-t">
          <h3><?php if(empty($fan['nickname'])){
              echo "匿名用户";
              }else{
                  echo $fan['nickname'];
              }?></h3>
           <h4>消费<i><if condition="$fan.totalmoney gt 0">{pigcms{$fan.totalmoney}<else /> 0</if></i>元</h4>
       </div>
       <div class="fensi-r">
           <if condition="$fan.paycount gt 1">
               <span class="nei" style="color: #ff9900;">铁粉</span>
               <else />
               <span class="nei" style="color: #12AF7E;">嫩粉</span>
               </if>
           
            <h4>消费<i><if condition="$fan.paycount gt 0">{pigcms{$fan.paycount}<else /> 0</if></i>次</h4>
        </div>
        <div style="clear: both;"></div>
    </li>
</volist>
    </ul>
</div>
<div class="fuwu2">
    本服务由小农丁提供
</div>
</body>
</html>
