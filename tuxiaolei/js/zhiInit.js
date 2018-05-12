// 手动初始化智齿咨询组件
// 智齿客服 桌面网站和移动网站接入文档 详情请参考https://dev.help.sobot.com/chapter1/zhuo-mian-wang-zhan-he-yi-dong-wang-zhan-jie-ru.html
// 初始化智齿咨询组件实例
zhiManager = (getzhiSDKInstance());
// 再调用load方法
zhiManager.on("load",function(){
zhiManager.initBtnDOM();
});
zhiManager.set('customBtn','true');
// 设置悬浮框的水平位置
zhiManager.set('customMargin',5);
