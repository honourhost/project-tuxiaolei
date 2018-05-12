<html>
<img src="{pigcms{$now_user.avatar}">

	<h1>频道名：<a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Topic&a=index&topic={pigcms{$channel.url}">{pigcms{$channel.name}</a></h1>

	<h1>总营收：{pigcms{$channel.income}</h1>

	<h1>总收益：{pigcms{$channel.profit}</h1>

	<h1>我的分红:<php>echo $channel['profit']*$person['percent']/100;</php></h1>

</html>