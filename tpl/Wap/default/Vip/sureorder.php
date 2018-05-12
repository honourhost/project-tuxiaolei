<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/datePicker.css">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/common1.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/color1.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/nav.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/mobiscroll_min.css" media="all">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}meal/js/mobiscroll_min.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}vip/layer.js"></script>
<!--    <script src="{pigcms{$static_path}layer/layer.m.js"></script>-->
    <script type="text/javascript" src="{pigcms{$static_path}meal/js/info.js"></script>
    <title>{pigcms{$store['name']}</title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <!-- Mobile Devices Support @begin -->
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Mobile Devices Support @end -->
    <style>
        .rows-main {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: none;
        }

        .alert-bg {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        .alert-content {
            width: 180px;
            height: auto;
            position: relative;
            z-index: 10000;
            margin: 0px auto;
            top: 30%;
            background: #fff;
            padding: 15px;
        }

        .alert-content img {
            width: 100%;
            display: block;
            font-size: 0;
            height: 150px;
        }

        .alert-content h3 {
            font-size: 16px;
            display: block;
            text-align: center;
            margin-bottom: 5px;
            color: #1ab24e;
            font-weight: 100;
            margin-top: 10px;
        }

        .alert-content p {
            display: block;
            width: 100%;
            font-size: 12px;
            text-align: center;
            color: #1ab24e;
        }

        .btns-close {
            display: block;
            width: 100%;
            margin: 10px auto 0px auto;
            height: 30px;
            line-height: 30px;
            background: #1ab24e;
            color: #fff;
            text-align: center;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".alert-bg").bind("click",function() {
               // alert("test");
                $('.rows-main').hide();
                window.location.href="{pigcms{:U('Vip/index')}";
            });
            $(".btns-close").bind("click",function() {
                $('.rows-main').hide();
                window.location.href="{pigcms{:U('Vip/index')}";
            });
        });
    </script>

</head>
<body onselectstart="return true;" ondragstart="return false;">
<script>
    var config = {
        table_fee:0,//包房服务费 0 不需要  大于是需要包房费
            order_sn:'',
            utype:1,
            businessHours:[{"stime":"00:00","etime":"23:59"}],//营业时间
            editInfo:{"date":"{pigcms{$date}", "time":"{pigcms{$time}", "tel":"{pigcms{$user_info['phone']}", "name":"{pigcms{$user_info['name']}", "sex":null, "seattype":'{pigcms{$seattype}', "mark":""},//修改预订信息
            postURL: "{pigcms{:U('Vip/saveorder')}",//ajax发送路径
            max_seat_num:50,
            seat_num_default:2
        };
</script>
<div data-role="container" class="container bookinfo">
    <header data-role="header">
    </header>
    <section data-role="body">
        <div class="info">
            <if condition="!empty($totalmoney)">
                <div class="line icons">
                    <span>选购列表</span>
                    <label>共<strong style="color:#FF4907">{pigcms{$totalmoney}</strong>元</label>
                </div>
            </if>

        </div>
        <ul id="usermenu" style="margin-bottom: 16px;">
            <volist  name="goods" id="good">
                <li id="dish_li" >
                    <div class="licontent">
                        <div class="span">
                            <div class="menudesc" style="margin-left: 16px;">
                                <h4>{pigcms{$good.s_name} *{pigcms{$good.num}</h4>
                            </div>

                        </div>

                </li>
            </volist>

        </ul>

        <div class="info">
            <div class="line">
                <input type="tel" name="tel" id="tel" placeholder="请输入您的手机号码" value="{pigcms{$user_info['phone']}">
            </div>
            <div class="line">
                <input type="text" name="address" id="address" placeholder="请输入您的地址" value="{pigcms{$user_info['province_txt']}{pigcms{$user_info['city_txt']}{pigcms{$user_info['area_txt']}{pigcms{$user_info['adress']}">
            </div>
            <div class="line name">
                <input type="text" placeholder="请输入您的姓名" name="name" id="name" value="{pigcms{$user_info['name']}">
                <div class="sexdiv">
                    <label><input type="radio" name="sex" value="0" id="sex" class="">女士</label>
                    <label><input type="radio" name="sex" value="1" checked="checked" class="">先生</label>
                </div>
            </div>
            <div class="line textarea">
                <textarea name="remark" placeholder="给小农丁留言" id="mark"></textarea>
            </div>
        </div>
    </section>
    <footer data-role="footer">
        <nav class="g_nav">
            <div>

                <a class="orange right" onclick="submit_AA()" id="next"><label>完成兑换</label></a>
            </div>
        </nav>
    </footer>
</div>

<div class="rows-main">
    <div class="alert-bg">

    </div>
    <div class="alert-content">
        <h3>恭喜您,兑换成功!</h3>
        <img src="http://www.xiaonongding.com/qrcodexnd.png" />

        <p>长按二维码关注小农丁<br>方便查看订单详情</p>
        <a class="btns-close" >确定</a>
    </div>
</div>
<include file="kefu" />
{pigcms{$hideScript}
<script>
    function  submit_AA(){
        var name_elm = document.getElementById("name");
        var tel_elm = document.getElementById("tel");
        var address_elm = document.getElementById("address");
        var tel = tel_elm.value;
        var yname = name_elm.value;
        var address=address_elm.value;


      if(isNull(tel)){
            alert("请填写手机号码")
            return false;
        }else if(isNull(yname)){
            alert("请填写顾客姓名")
            return false;
        }else if(isNull(address)){
        alert("请填写地址");
        return false;
        }
    else{
          $.ajax({
              type: "POST",
              url: config.postURL,
              data: {
                  tel:tel,
                  name:yname,
                  address:address

              },
              async:true,
              success: function(res){
                  isajax = false;
                  if(res.status==0) {
                      layer.open({
                          content: res.message,
                          yes: function(index, layero){
                              layer.close(index); //如果设定了yes回调，需进行手工关闭
                              window.location.href="{pigcms{:U('Vip/index')}";
                          }
                      });

                  } else {
//                      layer.open({
//                          content: res.message,
//                          yes: function(index, layero){
//                              layer.close(index); //如果设定了yes回调，需进行手工关闭
//                              window.location.href="{pigcms{:U('Vip/index')}";
//                          }
//                      });

                          $('.rows-main').show();



                  }
              },
              dataType: "json"
          });
      }
    }
</script>

</body>
</html>