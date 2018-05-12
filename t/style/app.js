// 初始化应用程序并将其存储到myApp变量以进一步访问其方法
var myApp = new Framework7({
    pushState: true,
    animateNavBackIcon: true,
    imagesLazyLoadThreshold:1000,//懒加载图片预设位置
    swipeBackPage:false,
    swipeoutNoFollow:true,
    pushStateNoAnimation:false, //是否禁止页面返回动画
    swipeBackPageThreshold:1000    //如果“触摸距离”超过这个值，将开始刷卡动作
});

// 自定义的DOM库，让我们将它保存到$$变量：
var $$ = Dom7;