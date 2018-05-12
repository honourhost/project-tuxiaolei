<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Just for test</title>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name=" apple-mobile-web-app-capable"/>

</head>
<body>
<a href="javascript:fuck();">点我测试</a>
</body>
<script type="text/javascript">
//  $(document).ready(function () {
      var u = navigator.userAgent;
      var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
      var iOSplatform = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
//      alert('是否是Android：'+isAndroid);
//      alert('是否是iOS：'+isiOS);
//  });
</script>
<script type="text/javascript" >

function fuck() {
    $.ajax({
        url: "{pigcms{:U('Ts/test')}",
        success: function (res) {
            if(isAndroid){
                  controller.onJsCallBack(JSON.stringify(res));
            }
           else if(iOSplatform){
                window.webkit.messageHandlers.onJsCallBack.postMessage(res);

            }else{
                controller.onJsCallBack("啥都不是");
            }
        },
        dataType: 'json'
    });

}


</script>
</html>