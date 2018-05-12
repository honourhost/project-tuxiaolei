<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>付款确认</title>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
</head>
<body>
       <form action="{pigcms{:U('Index/goPay')}" method="post">
       <input type="text" name="money"/>
       <input type="submit"/>
       </form>
</body>
</html>