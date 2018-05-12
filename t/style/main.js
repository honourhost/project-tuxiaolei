// var apiURL = "http://192.168.1.12:8080/actionService/gateway";
var apiURL = "https://api.dayutang.cn/actionService/gateway"; //生产机
// var apiURL = "https://wx5.dayutang.cn/actionService/gateway"; //生产机

try {
    var rt ;
    clearInterval(rt);
    if(window.parent==window){
        rt = setInterval(function(){

            var yt_times = sessionStorage.getItem("yt_times");

            if(StringTools.isEmpty(yt_times)){
                yt_times = 1;
            }else{
                yt_times = Number(yt_times) + 1;
            }
            sessionStorage.setItem("yt_times",yt_times);
            yt_times = Number(yt_times);

            var yt_belong = sessionStorage.getItem("yt_belong");
            if(StringTools.isEmpty(yt_belong)){
                yt_belong = getBelong();
                if(StringTools.isEmpty(yt_belong)){
                    yt_belong = 0;
                }
                sessionStorage.setItem("yt_belong",yt_belong);
            }

            var yt_userId = sessionStorage.getItem("yt_userId");
            if(StringTools.isEmpty(yt_userId)){
                yt_userId = userID;
                sessionStorage.setItem("yt_userId",yt_userId);
            }

            var yt_uuid  = sessionStorage.getItem("yt_uuid");
            if(StringTools.isEmpty(yt_uuid)){
                yt_uuid = StringTools.generateUUID();
                sessionStorage.setItem("yt_uuid",yt_uuid);
            }
            var yt_href =  window.location.href;
            var yt_preHref = sessionStorage.getItem("yt_href");

            if(StringTools.isEmpty(yt_preHref)){
                yt_preHref = "";
                sessionStorage.setItem("yt_href",yt_href);
                sessionStorage.setItem("yt_stopTime",0);
            }

            var yt_pages = sessionStorage.getItem("yt_pages");
            if(StringTools.isEmpty(yt_pages)){
                sessionStorage.setItem("yt_pages",0);
                yt_pages = 0;
            }

            var yt_stopTime = sessionStorage.getItem("yt_stopTime");
            if(StringTools.isEmpty(yt_stopTime)){
                yt_stopTime = 1;
                sessionStorage.setItem("yt_stopTime",yt_stopTime);
            }

            if(yt_href == yt_preHref){
                yt_stopTime = Number(yt_stopTime) + 1;
                sessionStorage.setItem("yt_stopTime",yt_stopTime);
            }else{//不相同,换页面,结束上一个页面
                //上报
                //yt_userId\yt_uuid\yt_belong\yt_preHref\yt_pages\yt_stopTime
                if(!StringTools.isEmpty(yt_preHref)) {
                    tj(yt_userId, yt_uuid, yt_belong, yt_preHref, yt_pages, yt_stopTime);
                }

                yt_pages = Number(yt_pages) + 1;
                sessionStorage.setItem("yt_pages",yt_pages);

                yt_stopTime = 1;
                sessionStorage.setItem("yt_stopTime",yt_stopTime);
                sessionStorage.setItem("yt_href",yt_href);
                yt_times = 0;
            }

            //上报
            //yt_userId\yt_uuid\yt_belong\yt_href\yt_pages\yt_stopTime

            if(yt_times%10 == 0){
                tj(yt_userId,yt_uuid,yt_belong,yt_href,yt_pages,yt_stopTime);
                sessionStorage.setItem("yt_times","1");
            }

            //弹框引导关注广告
            // var subAd = localStorage.getItem("subAd");
            // if(StringTools.isEmpty(subAd) || subAd == 0){
            //     subAd = 0;
            //     localStorage.setItem("subAd",0);
            // }
            //
            // if(yt_stopTime > 30 && subAd == 0 && sessionStorage.getItem("yt_isFollowSubscription") != 1){
            //     if(!sessionStorage.getItem("noSubAd")){
            //         $.get("//www.dayutang.cn/common/subAd.html",function (data) {
            //             $("body").append(data);
            //         });
            //     }
            // }

            reportStopTime(yt_stopTime);
        }, 1000);
    }


    //访问时长上报
    function reportStopTime(yt_stopTime) {
        try {
            if(yt_stopTime >= 300){
                if(!sessionStorage.getItem("yt_stop300")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop300':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop300", 1);
                }
            }else if(yt_stopTime >= 240){
                if(!sessionStorage.getItem("yt_stop240")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop240':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop240", 1);
                }
            }else if(yt_stopTime >= 150){
                if(!sessionStorage.getItem("yt_stop150")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop150':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop150", 1);
                }
            }else if(yt_stopTime >= 120){
                if(!sessionStorage.getItem("yt_stop120")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop120':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop120", 1);
                }
            }else if(yt_stopTime >= 90){
                if(!sessionStorage.getItem("yt_stop90")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop90':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop90", 1);
                }
            }else if(yt_stopTime >= 60){
                if(!sessionStorage.getItem("yt_stop60")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop60':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop60", 1);
                }
            }else if(yt_stopTime >= 30){
                if(!sessionStorage.getItem("yt_stop30")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop30':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop30", 1);
                }
            }else if(yt_stopTime >= 20){
                if(!sessionStorage.getItem("yt_stop20")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop20':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop20", 1);
                }
            }else if(yt_stopTime >= 10){
                if(!sessionStorage.getItem("yt_stop10")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop10':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop10", 1);
                }
            }else if(yt_stopTime >= 5){
                if(!sessionStorage.getItem("yt_stop5")){
                    try {MtaH5.clickStat('yonghufangwensh',{'stop5':'true'});}catch(err){}
                    sessionStorage.setItem("yt_stop5", 1);
                }
            }
        }catch(err){}
    }

    function tj(yt_userId,yt_uuid,yt_belong,yt_href,yt_pages,yt_stopTime) {

        var imgUrl = "//report.dayutang.cn/data/tj.gif?";
        imgUrl = imgUrl +"yt_userId=" +yt_userId;
        imgUrl = imgUrl +"&yt_uuid=" +yt_uuid;
        imgUrl = imgUrl +"&yt_belong=" +yt_belong;
        imgUrl = imgUrl +"&yt_href=" +StringTools.getEncodeURI(yt_href);
        imgUrl = imgUrl +"&yt_pages=" +yt_pages;
        imgUrl = imgUrl +"&yt_stopTime=" +yt_stopTime;
        imgUrl = imgUrl +"&screenSize=" +getScreenSize();
        imgUrl = imgUrl +"&networkType=" +getNetworkType();
        imgUrl = imgUrl +"&terminal=" +browserRedirect();
        imgUrl = imgUrl +"&yt_isFollowService=" +sessionStorage.getItem("yt_isFollowService");
        imgUrl = imgUrl +"&yt_isFollowSubscription=" +sessionStorage.getItem("yt_isFollowSubscription");

        var img = new Image();
        img.src = imgUrl;
    }


   var checkUserInterval = setInterval(function(){
        if(userID) {
            if (!sessionStorage.getItem("yt_isFollowService")) {
                var data1 = {"sn": "PersonalCenter", "mn": "checkUserSubscribe", "userId": userID, "wxAccountId": "11"};
                $.post(apiURL, data1, function (result) {
                    var data = JSON.parse(result);
                    if (data.code == 0) {
                        var s = "0";
                        if (data.subscribe) {
                            s = "1";
                        }
                        sessionStorage.setItem("yt_isFollowService", s);
                    }
                });
            }

            if (!sessionStorage.getItem("yt_isFollowSubscription")) {
                var data2 = {"sn": "PersonalCenter", "mn": "checkUserSubscribe", "userId": userID, "wxAccountId": "12"};
                $.post(apiURL, data2, function (result) {
                    var data = JSON.parse(result);
                    if (data.code == 0) {
                        var s = "0";
                        if (data.subscribe) {
                            s = "1";
                            try { MtaH5.clickStat("visitorall1");}catch(err){}
                        }else{
                            try { MtaH5.clickStat("visitorall0");}catch(err){}
                        }
                        try { MtaH5.clickStat("visitorall");}catch(err){}
                        sessionStorage.setItem("yt_isFollowSubscription", s);
                    }
                });
            }
            clearInterval(checkUserInterval);
        }
    }, 1000);


    var reported = {};

    window.onerror = function(msg, file, lineno, colno, error) {
        var key = msg + ':' + file + ':' + lineno + ':' + colno;
        if (reported[key] === true) return;

        var yt_userId = sessionStorage.getItem("yt_userId");
        if(StringTools.isEmpty(yt_userId)){
            yt_userId = userID;
            sessionStorage.setItem("yt_userId",yt_userId);
        }

        var yt_uuid  = sessionStorage.getItem("yt_uuid");
        if(StringTools.isEmpty(yt_uuid)){
            yt_uuid = StringTools.generateUUID();
            sessionStorage.setItem("yt_uuid",yt_uuid);
        }

        var info = {};
        info.message = StringTools.getEncodeURI(msg);
        info.file = StringTools.getEncodeURI(file);
        info.line = lineno || 0;
        info.column = colno || 0;
        info.userAgent = StringTools.getEncodeURI(navigator.userAgent);
        info.error = StringTools.getEncodeURI(error ? error.toString() : undefined);
        info.stack = StringTools.getEncodeURI(error && error.stack ? error.stack : undefined);
        info.userId = yt_userId;
        info.uuid = yt_uuid;
        info.href =  StringTools.getEncodeURI(window.location.href);

        var imgUrl = "error.gif?";
        $.each(info, function(k) {
            imgUrl +=  k +"=" +info[k] +"&";
        });

        var img = new Image();
        img.src = imgUrl;
        reported[key] = true;
    }


}catch(err) {}

//百度统计
var _hmt = _hmt || [];
(function() {
	var hm = document.createElement("script");
	hm.src = "//hm.baidu.com/hm.js?36202825b85fc873ea96b028079ce287";
	var s = document.getElementsByTagName("script")[0];
	s.parentNode.insertBefore(hm, s);
})();

var _mtac = {"performanceMonitor":1,"senseQuery":1};
(function() {
    var mta = document.createElement("script");
    mta.src = "//pingjs.qq.com/h5/stats.js?v2.0.4";
    mta.setAttribute("name", "MTAH5");
    mta.setAttribute("sid", "500299271");
    mta.setAttribute("cid", "500340812");
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(mta, s);
})();

var userID = localStorage.userId;
var myselfUserID = localStorage.myselfUserId;
var token = localStorage.token;
var openid = localStorage.openid;

var userHasStore = false; //是否为线上店主
var spokesManIsVaild = false; //妈妈代言人是否合法
var KEY = "6783c950bdbf40aeac52042a9206e0ba"; //后台服务验证的KEY_CODE
var fromUserId = getQuery("fromUserId"); //获取参数fromUserId
var wxAppId = 'wxaa66399ab39edad3';
var wxIsReady = false;
var realURL;
var wxSignUrl = "https://www.dayutang.cn/pay/sign";

function setChannel(){
	var channel = getQuery("_channel");
	if (channel != "" && channel != undefined && channel != null) {
		sessionStorage.channel = channel;
	}
}
function setBelong(){
    var belong = getQuery("_belong");
    if (belong != "" && belong != undefined && belong != null) {
        // sessionStorage.belong = belong;
        setCookie("belong",belong,1);
    }
}
function getChannel(){
	var channel = sessionStorage.channel;
	if (channel != "" && channel != undefined && channel != null) {
		return channel;
	}
	return "";
}
function getBelong(){
    // var belong = sessionStorage.belong;
    var belong = getCookie("belong");
    if (belong != "" && belong != undefined && belong != null) {
        return belong;
    }
    return "";
}
//判断是否登陆
function isLogin(){
    return  localStorage.userId!=undefined &&
        localStorage.token!=undefined;
}
//跳出到首页
function jumpIndex(){
    location.href = "https://www.dayutang.cn/";
}

$(document).ready(function() {
	setChannel();
    setBelong();
    updateRecommendUserId();
    if(userID && myselfUserID  &&  userID !== myselfUserID){
        checkMainAccount();
    }
	if(is_weixn()) {
		wxConfig();
	} else {
		getUserProxy();
	}

	if(fromUserId == null  || fromUserId == "") {
		if(sessionStorage.fromUserId != undefined) {
			fromUserId = sessionStorage.fromUserId;
		} else {
			fromUserId = "";
		}
	} else {
		sessionStorage.fromUserId = fromUserId;
	}

    // 外部链接进入 其他公众号引流 (param outer = 1)  qrPay = 1
     if (getQuery("outer") && getQuery("outer") === '1') {
         sessionStorage.setItem("qrPay", "1");
    }

});

//检查是否被主账户踢掉
function checkMainAccount() {
    request("HomeAccount", "check", {
        userId: userID,
        myselfUserId: myselfUserID
    }, function(data) {
        if(data.code == 0) {
            if(!data.isNormal){
                localStorage.removeItem("userId");
                localStorage.removeItem("myselfUserId");
                localStorage.removeItem("token");
                localStorage.removeItem("openid");
                uiTools1.userRemoveModel('您已退出家庭账户<br/>请用自己的账号登录系统','使用当前微信登录',function (index) {
                    location.href = "../html/pageBack.html";
                });
            }
        }
    });
}


//配置微信（初始化）
function wxConfig() {
	//读取cookie里的ticket
	var ticket = getCookie("ticket");
	if(ticket == null) {
		var getTicketUrl = createURLStr('WXCom', 'getJsapiTicket', {});
		$.get(getTicketUrl, function(res) {
			var obj = JSON.parse(res);
			if(obj.code == 0) {
				var ticket = obj.jsapiTicket;
				setCookie("ticket", ticket, 2);
				doWXConfig(ticket);
			} else {
				//获取ticket失败
			}
		});
	} else {
		doWXConfig(ticket);
	}
}

function doWXConfig(ticket) {
	var wx_nonceStr = Math.ceil(Math.random() * 10000).toString();
	var now = new Date();
	var timestamp = Math.round(now.getTime() / 1000).toString();
	var holeUrl =  location.href;
	var arr = holeUrl.split('#');
	var pre_url = arr[0];
	var signObj = {
		noncestr: wx_nonceStr,
		jsapi_ticket: ticket,
		timestamp: timestamp,
		url: pre_url
	};
	var paramArr = [];
	for(var key in signObj) {
		paramArr.push({
			key: key,
			value: signObj[key]
		});
	}
	paramArr.sort(function(a, b) {
		return a.key > b.key ? 1 : -1;
	});
	var str = "";
	for(var i = 0; i < paramArr.length; i++) {
		str += (paramArr[i].key + "=" + paramArr[i].value + '&');
	}
	str = str.slice(0, str.length - 1);
	var sign = hex_sha1(str).toString();
	wx.config({
		debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
		appId: wxAppId, // 必填，公众号的唯一标识
		timestamp: timestamp, // 必填，生成签名的时间戳
		nonceStr: wx_nonceStr, // 必填，生成签名的随机串
		signature: sign, // 必填，签名，见附录1
		jsApiList: [
				'openWithSafari',
				'checkJsApi',
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'onMenuShareQQ',
				'onMenuShareWeibo',
				'hideMenuItems',
				'showMenuItems',
				'hideAllNonBaseMenuItem',
				'showAllNonBaseMenuItem',
				'translateVoice',
				'startRecord',
				'stopRecord',
				'onRecordEnd',
				'playVoice',
				'pauseVoice',
				'stopVoice',
				'uploadVoice',
				'downloadVoice',
				'chooseImage',
				'previewImage',
				'uploadImage',
				'downloadImage',
				'getNetworkType',
				'openLocation',
				'getLocation',
				'hideOptionMenu',
				'showOptionMenu',
				'closeWindow',
				'scanQRCode',
				'chooseWXPay',
				'openProductSpecificView',
				'addCard',
				'chooseCard',
				'openCard'
			] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	});


	wx.ready(function() {
		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
		wxIsReady = true;
		wx.hideOptionMenu(); //隐藏右上角菜单项
		wx.getNetworkType({success: function (res) {localStorage.networkType = res.networkType;}});//缓存用户上网情况
		getUserProxy();
	});

	wx.error(function(res) {
		// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
		wxIsReady = false;
		//JSON.stringify(res)
	});
}


//获取用户所有权限
function getUserProxy() {
    var rolesCookie = getCookie("rolesCookie");
    if(rolesCookie){
        var proxyArr = rolesCookie.split(",");
        userHasStore = proxyArr.indexOf("user.front.shop") != -1; //是否为店主
        checkShopIsVaild(); //妈妈代言人身份是否合法
    }else{
        request("PersonalCenter", "getRole", {
            userId: userID
        }, function(data) {
            if(data.code == 0) {
                setCookie("rolesCookie",data.roles,1);
                var proxyArr = data.roles.split(",");
                userHasStore = proxyArr.indexOf("user.front.shop") != -1; //是否为店主
                checkShopIsVaild(); //妈妈代言人身份是否合法
            }
        });
    }
}

//S 妈妈代言人身份是否合法
function checkShopIsVaild(isForce){
    var  spokesManIsVaildCookie = getCookie("spokesManIsVaildCookie");
    if( isForce ){
        spokesManIsVaildCookie = false ;
    }
    if(spokesManIsVaildCookie){
        spokesManIsVaild = spokesManIsVaildCookie  === 'true' ;

        if(spokesManIsVaild){
            userHasStore=true;
        }else{
            userHasStore=false;
        }

        if(userHasStore){
            fromUserId = userID;
            sessionStorage.fromUserId = fromUserId;
        }
        localStorage.userHasStore = userHasStore ? "1" : "0";
        onWXandProxyReady();
    }else{
        requestSync("Spokesman", "checkShopIsVaild", {
            userId: userID
        }, function(data) {
            if(data.code == 0){
                spokesManIsVaild=data.shopIsVaild;
                setCookie("spokesManIsVaildCookie",spokesManIsVaild,1);

                if(spokesManIsVaild){
                    userHasStore=true;
                }else{
                    userHasStore=false;
                }

                if(userHasStore){
                    fromUserId = userID;
                    sessionStorage.fromUserId = fromUserId;
                }
                localStorage.userHasStore = userHasStore ? "1" : "0";
                onWXandProxyReady();
            }
        })
    }

    return spokesManIsVaild;
}
//E 妈妈代言人身份是否合法

//微信配置完成，获取到了用户权限
function onWXandProxyReady () {
	try {
		onWXReady();
	} catch(e) {
		//		console.log(e.message);
	}
}

//发送get请求-基于jquery
function request(serviceName, methodName, otherParam, callback) {
	var urlStr = createURLStr(serviceName, methodName, otherParam);
	$.get(urlStr, function(result) {
		var data = JSON.parse(result);
		if(callback != null) {
			callback(data);
		}
	});
}


//发送post请求-基于jquery
function requestPost(serviceName, methodName, otherParam, callback) {
    var urlStr = createURLStr(serviceName, methodName, null);
    $.post(urlStr,otherParam, function (result) {
        var data = JSON.parse(result);
        if(callback != null) {
            callback(data);
        }
    });
}


//发送get请求-基于jquery
function requestSync(serviceName, methodName, otherParam, callback) {
    var urlStr = createURLStr(serviceName, methodName, otherParam);
    $.ajax({
        type : "get",
        url : urlStr,
        async : false,
        success : function(result){
            var data = JSON.parse(result);
            if(callback != null) {
                callback(data);
            }
        }
    });
}

//创建请求的url
function createURLStr(serviceName, methodName, otherParam) {
	var data = {};
	data.sn = serviceName;
	data.mn = methodName;
	data.token = token;
	data.uncache = 123*Math.random();
	if(otherParam != null) {
		for(var key in otherParam) {
			data[key] = otherParam[key];
		}
	}
	//MD5验证机制///////////////////
	var paramArr = [];
	for(var key in data) {
		if(key != "info") {
			paramArr.push({
				key: key,
				value: data[key]
			});
		}
	}
	paramArr.sort(function(a, b) {
		return a.key > b.key ? 1 : -1;
	});
	var md5 = "";
	for(var i = 0; i < paramArr.length; i++) {
		md5 += paramArr[i].value;
	}
	md5 += KEY;
	md5 = $.md5(md5);
	data.sign = md5;
	///////////////////////////////
	var str = createVarsStrByObj(data);
	var urlStr = apiURL + "?" + str;
	return urlStr;
}

//把对象转换为字符串拼接
function createVarsStrByObj(obj) {
	var str = "";
	for(var key in obj) {
		var encodeKeyValue = encodeURIComponent(obj[key]);
		str += key + "=" + encodeKeyValue + "&";
	}
	str = str.slice(0, str.length - 1);
	return str;
}

/**
 * 替换URL中的参数的数值,不存在直接追加,F7子页面的模式的URL处理子页面的值
 * @param para
 * @param value
 * @returns {string}
 */
function replaceUrl(para, value){
    var s = window.location.href;
    var re = new RegExp(".html","g");
    var arr = s.match(re);
    var num = arr.length;
    var search;
    var urlStart ="";
    if (num === 1) {
        urlStart = window.location.href.split("?")[0];
    } else if (num === 2) {
        urlStart = s.substr(0,s.lastIndexOf(".html") + 5);
    }
    return urlStart  + replaceQuery(para, value);
}
//js获取location.href的参数的方法
function getQuery (para) {
    var s = window.location.href;
    var re = new RegExp("[.]html","g");
    var arr = s.match(re);
    var num = arr.length;
    var reg = new RegExp("(^|&)" + para + "=([^&]*)(&|$)");
    var search;
    if (num === 1) {
        search = decodeURIComponent(window.location.search);
    } else if (num === 2) {
        search = s.substr(s.lastIndexOf(".html") + 5);
    }
    var r = search.substr(1).match(reg);
    if (r) {
        return unescape(r[2]);
    }
    return "";
}

function replaceQuery(para, value) {
    var s = window.location.href;
    var re = new RegExp(".html","g");
    var arr = s.match(re);
    var num = arr.length;
    var search;
    if (num === 1) {
        search = decodeURIComponent(window.location.search);
    } else if (num === 2) {
        search = s.substr(s.lastIndexOf(".html") + 5);
    }

	if(search == "") {
		search = "?" + para + "=" + value;
	} else if(search.indexOf(para) == -1) {
		search += "&" + para + "=" + value
	} else {
		var reg = new RegExp(para + "=[^&]*");
		search = search.replace(reg, para + "=" + value);
	}
	return search;
}

//检测是否为微信浏览器
function is_weixn() {
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i) == "micromessenger") {
		return true;
	} else {
		return false;
	}
}
//读取cookies
function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	if(arr = document.cookie.match(reg))
		return unescape(arr[2]);
	else
		return null;
}

//写入2小时cookie
function setCookie(name, value, Hours) {
	var exp = new Date();
	exp.setTime(exp.getTime() + Hours * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString()+"; path=/";
}

//获得用户分辨率
function getScreenSize(){
	return window.screen.width +"*" +window.screen.height;
}
//获得用户上网情况
function getNetworkType(){
    wx.getNetworkType({success: function (res) {localStorage.networkType = res.networkType;}});//缓存用户上网情况
    var networkType =  localStorage.getItem("networkType");
	if(networkType==null || networkType==""){
		networkType = "unknown";
	}
	return networkType;
}

/**
 * 推送事件
 * @param type 1 前置事件  2 后置事件  3 普通事件
 * @param productCode
 * @param eventCode
 * @param backEventCode
 */
function pushEvent(type,productCode,eventCode) {
    try {
        var preEventCode ="";
        var backEventCode ="";
        if (!productCode) {
            productCode = 'DefaultCode';
            eventCode = 'Default';
        }

        if(type == 1){
            sessionStorage.setItem("productCode",productCode);
            sessionStorage.setItem("preEventCode",eventCode);
            preEventCode = eventCode ;
            backEventCode = eventCode ;
        }

        if(type == 2){
            productCode = sessionStorage.getItem("productCode");
            preEventCode = sessionStorage.getItem("preEventCode");
            backEventCode = eventCode ;
        }

        if(type == 3){
            productCode = productCode;
            preEventCode = "0";
            backEventCode = eventCode ;
        }

        var param  = {"productCode":productCode,"preEventCode":preEventCode,"backEventCode":backEventCode,"userId":userID};
        request("EventStatistic", "pushEvent", param, function(data) {});
    } catch (e) {}
}

/**
 * 获得随机数
 * 用途：分享连接拼接
 * @returns {string}
 */
function getRandomNum() {
    return  Math.ceil(Math.random() * 10000).toString();
}


//判断终端是PC还是移动端
function browserRedirect() {
    var accessTerminal = "";
    var sUserAgent = navigator.userAgent.toLowerCase();
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
        accessTerminal = "wx";
    } else {
        accessTerminal = "pc";
    }
    return accessTerminal;
}

//判断终端是ios还是安卓
function IOSorAndroid() {
    var accessTerminal = "";
    var sUserAgent = navigator.userAgent.toLowerCase();

    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    if(bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM){
        accessTerminal = "android";
    }else{
        accessTerminal = "iospc";
    }
    return accessTerminal;
}

// js数组去重
Array.prototype.unique = function(){
    var res = [];
    var json = {};
    for(var i = 0; i < this.length; i++){
        if(!json[this[i]]){
            res.push(this[i]);
            json[this[i]] = 1;
        }
    }
    return res;
};

//S 浮窗广告
var vmAd;
$(document).ready(function() {
    try {
        vmAd = new Vue({
            el: '#adSwiperBox',
            data: {
                isWatch:0,
                icoUrl:'',
                advertsList:[]
            },
            methods: {
                goAdHref:function(val){
                    window.location = val
                }
            },//methods结束,
            watch : {
                advertsList : function () {
                    var loopBoolean = false;
                    if(vmAd.advertsList && vmAd.advertsList.length >1 ){
                        loopBoolean = true;
                    }
                    try{
                        myApp.swiper('.swiper-ad', {
                            pagination:'.swiper-ad .swiper-pagination',
                            paginationClickable: true,
                            loop: loopBoolean,
                            autoplayDisableOnInteraction: false,
                            autoplay: 3000
                        });
                    }catch (e) {
                        var swiperIndex =  new Swiper('.swiper-ad', {
                            pagination:'.swiper-ad .swiper-pagination',
                            paginationClickable: true,
                            loop: loopBoolean,
                            autoplayDisableOnInteraction: false,
                            autoplay: 3000,
                        });
                    }
                }
            }

        });
    } catch (e) {}
});

function getHomePageAdvert(adMark){
    request("Advert", "getHomePageAdvert", {
        banner :  adMark,
        userId: userID
    }, function(data) {
        if(data.code == 0){
            if( typeof(data.adverts)=="undefined" || data.adverts.length <= 0){
                return;
            }
            if(data.isWatch==0){
                vmAd.isWatch = data.isWatch;
                vmAd.icoUrl = data.icoUrl;
                vmAd.advertsList = data.adverts;

                $('.adSwiperBox').show();
                $('.adSwiperIcon').find('img').attr("src",data.icoUrl);
                $('.adSwiperBox').find('.adClose').click(function () {
                    $('.adSwiperBox').fadeOut();
                });
                $('.adSwiperIcon').click(function () {
                    $('.adSwiperBox').fadeIn();
                    $('.adSwiperIcon').fadeOut();
                });
            }
        }
    })
}
//E 浮窗广告

/**
 *  page-content 层上面直接写上class : infinite-scroll 后期js追加无效
 *  注意不要传入$(".page-content")这个class。需要在page-content后面加上唯一的id，在进行传入，否者会有返回页面继续loading的问题
 * 下拉加载更多文件
 *在监听循环数据值时，只需要调用downLoadMore.down（）方法，传入4个参数
 * id 外层的元素唯一id
 * loadLength  数据的个数
 * moreTotal 需要拿到请求数据的总个数
 * callback   回调方法
 * */
var downLoadMore ={
    insertHtml:function(loadLength,moreTotal){
        var str='';
        str+='<div class="infinite-scroll-preloader">';
        str+='<div class="preloader"></div>';
        str+='</div>';
        if(loadLength != moreTotal){
            return str;
        }

    },
    down:function(id,loadLength,moreTotal, callback){
        $(".infinite-scroll-preloader").remove();
        var _this =this;
        id.append(_this.insertHtml(loadLength,moreTotal));
        $('.infinite-scroll').unbind();
        var loading = false;// 加载flag
        $('.infinite-scroll').bind('infinite', function(){
            if (loading) return;// 如果正在加载，则退出
            loading = true;// 设置flag
            setTimeout(function () {// 模拟1s的加载过程
                loading = false;// 重置加载flag
                if (loadLength == moreTotal){//可用优惠卷缓存数据是否等于可用总数
                    //myApp.detachInfiniteScroll($$('.infinite-scroll'));// 加载完毕，则注销无限加载事件，以防不必要的加载
                }else{
                    callback();
                }
            }, 1000);
        });
    }
};


/**
 *  page-content 层上面直接写上class : infinite-scroll 后期js追加无效
 *  注意不要传入$(".page-content")这个class。需要在page-content后面加上唯一的id，在进行传入，否者会有返回页面继续loading的问题
 *  下拉加载更多文件
 *  在监听循环数据值时，只需要调用downLoadMore.down（）方法，传入4个参数
 *  id 外层的元素唯一id
 *  loadLength  本次请求数据的个数
 *  loadSize 预计请求数据的个数
 *  callback   回调方法
 * */
var downLoadMore2 ={
    insertHtml:function(loadLength,loadSize){
        var str='';
        str+='<div class="infinite-scroll-preloader">';
        str+='<div class="preloader"></div>';
        str+='</div>';
        if(loadLength == loadSize){
            return str;
        }
    },
    down:function(id,loadLength,loadSize, callback){
        $(".infinite-scroll-preloader").remove();
        var _this =this;
        id.append(_this.insertHtml(loadLength,loadSize));

        $('.infinite-scroll').unbind();
        var loading = false;// 加载flag
        $('.infinite-scroll').bind('infinite', function(){
            if (loading) return;// 如果正在加载，则退出
            loading = true;// 设置flag
            setTimeout(function () {// 模拟1s的加载过程
                loading = false;// 重置加载flag
                if (loadLength == loadSize){
                    callback();

                }else{
                    // myApp.detachInfiniteScroll($$('.infinite-scroll'));
                }
            }, 1000);
        });
    }
};

function uploadFile (accept, maxSize, successFunc) {   //上传文件
    var form = $('<form method="post" enctype="multipart/form-data"></form>');
    var file = $('<input type="file" name="Filedata" accept="' + accept + '" />');
    form.append(file);
    file.click();
    file.change(function() {
        uiTools.showLoading();
        var filePath = this.value;
        var fileObj = $(this)[0].files[0];
        var fileSizeM = fileObj.size / 1024 / 1024;
        if(fileSizeM > maxSize) {
            uiTools.hideLoading();
            showToast("文件大小不能超过" + maxSize + "M");
            return;
        }
        fileSizeM = fileSizeM.toFixed(1);
        var obj = {}; //createRequestVars();
        obj.sn = "File";
        obj.mn = "fileUpload";
        var str = createVarsStrByObj(obj);
        var action = apiURL + "?" + str;
        form.attr("action", action);
        form.ajaxSubmit({
            success: function(msg) {
                var json = eval("(" + msg + ")");
                if(json.code == 0) {
                    if(successFunc != null) {
                        successFunc(json.path, json.fileName);
                    }
                } else {
                    alert(json.msg);
                }
                form = null;
                file = null;
            }
        });
    });
}

var firstTimeSize = 0;
//判断手机是横屏还是竖屏
function screenRotation() {
    var supportOrientation = (typeof window.orientation == "number" && typeof window.onorientationchange == "object");
    var orientation;
    var updateOrientation = function () {
        if (supportOrientation) {
            updateOrientation = function () {
                orientation = window.orientation;
                switch (orientation) {
                    case 90:
                    case -90:
                        orientation = "landscape";
                        break;
                    default:
                        orientation = "portrait";
                }
                $("body").removeClass("landscape portrait").addClass(orientation);
                onlodSeize( orientation,_watchTypeAll);
            };
        } else {
            updateOrientation = function () {
                orientation = (window.innerWidth > window.innerHeight) ? "landscape" : "portrait";
                $("body").removeClass("landscape portrait").addClass(orientation);
                onlodSeize( orientation,_watchTypeAll);
            };
        }
        updateOrientation();
    };

    var init = function () {
        updateOrientation();
        if (supportOrientation) {
            //window.removeEventListener("orientationchange");
            window.addEventListener("orientationchange", updateOrientation, false);
        }
    };
    if(firstTimeSize == 0){
        init();
        ++firstTimeSize
    }

    // window.addEventListener("DOMContentLoaded", init, false);
}

//load加载
function loadJs(loadUrl,callMyFun){
    var loadScript=document.createElement('script');
    loadScript.setAttribute("type","text/javascript");
    loadScript.setAttribute('src',loadUrl);
    document.getElementsByTagName("head")[0].appendChild(loadScript);
    $.getScript(loadUrl).done(function() {callMyFun()});
}


//根据时间戳显示 时分秒
function getDateContent(tm) {
    var tt = new Date(parseInt(tm) * 1000);
    var dataTime = toDub(tt.getHours()) + ":" + toDub(tt.getMinutes()) + ":" + toDub(tt.getSeconds());
    return dataTime;
}

//补零
function toDub(n) {
    return n < 10 ? "0" + n : "" + n;
}

//定时器  根据毫秒转换成 时分秒
function MillisecondToDate(msd) {
    var hour =Math.floor(msd /(60*60*1000)) ;
    var minute = Math.floor((msd - hour*60*60*1000)/(60*1000));
    var seconds = Math.floor((msd - hour*60*60*1000 - minute*60*1000)/1000);
    var time = toDub(hour)+":"+toDub(minute)+":"+toDub(seconds);
    return time;
}


function loadJsAddLast(loadUrl,callMyFun){
    $.getScript(loadUrl).done(function() {callMyFun()});
}

//回调方法队列
var funMap = {};

$(function(){
    setTimeout(function(){
        loadJsAddLast("//static.dayutang.cn/js/icomet.js",function () {
            new iComet({
                channel: 'yutang',
                subUrl: '//icomet.dayutang.cn/sub',
                callback: function(content){
                    var data = JSON.parse(content);
                    var fun= funMap[data._m];
                    if(fun){
                        fun(data);
                    }
                }
            });
        });
    },5000)

});

// 获取用户信息判断是否绑定手机号
/**
 * 方法可传入一个执行函数callback参数,因为需要请求数据,有时要在接口请求后执行callback()
 * 方法可传入一个执行函数callback参数,因为需要请求数据,有时要在接口请求后执行callback()
 * **/
function getUserInfoToBindPhone(callback,eventFunction) {
    request("PersonalCenter", "getUserInfo", {
        userId: userID,
    }, function (data) {
        if(data.code == 0) {
            var value = data.userInfo.phoneNumIsActivate;
            var flag = value ==="false" ? false : true;
            if(!flag || !data.userInfo.phoneNum){
                if(eventFunction&&typeof(eventFunction)=="function"){
                    eventFunction();
                }
                location.href = "/";
            }else {
                if(callback&&typeof(callback)=="function"){
                    callback();
                }
            }
        }
    });

}

try{
    var winHref = window.location.href;
    if(winHref.indexOf("www.dayutang.cn")<0){
        if( getCookie("cookie_path") !=null ){
            document.title= getCookie("cookie_path") +":"+ document.title;
        }else{
            document.title=  "预上线环境:"+ document.title;
        }
    }
} catch (e){

}

var hideWxAd ; //url 控制
var showWxAd = true ; //页面js控制
try{
    hideWxAd = getQuery('hideWxAd')?getQuery('hideWxAd'):sessionStorage.getItem('hideWxAd');
    if(hideWxAd){
        sessionStorage.setItem('hideWxAd',hideWxAd);
    }else{
        setTimeout(function(){
            if(showWxAd){
                var url=window.location.href;
                if(url.indexOf('punch/main.html#!/tpl/contentPage.html')>=0 ||
                    url.indexOf('punch/punchShare')>=0 ||
                    url.indexOf('punch/contentPage')>=0 ||
                    url.indexOf('live/videoLive.html')>=0 ||
                    url.indexOf('shopOrder/order/placeOrder.html')>=0 ||
                    url.indexOf('story/shareJumpPage.html')>=0 ||
                    url.indexOf('shopOrder/coupon.html')>=0 ||
                    url.indexOf('task/taskShareAZ.html')>=0||
                    url.indexOf('web/')>=0||
                    url.indexOf('shareDown.html')>=0||
                    url.indexOf('shareReport.html')>=0||
                    url.indexOf('www.dayutang.cn/index.html')>=0||
                    url.indexOf('activity/')>=0||
                    url.indexOf('commonPage/drainage/')>=0||
                    url.indexOf('commonPage/card')>=0||
                    url.indexOf('commonPage/invitation')>=0||
                    url.indexOf('commonPage/dynamicInvitation')>=0||
                    url.indexOf('commonPage/dynamicQR')>=0||
                    url.indexOf('commonPage/dynamicInvitation')>=0||
                    url.indexOf('PayAttentionToGifts/')>=0||
                    url.indexOf('story/storyLandingPage')>=0||
                    url.indexOf('story/listenStoryClockPage')>=0||
                    url.indexOf('live/liveAlLi')>=0||
                    url.indexOf('spokesman/')>=0) return;
                $.get("//www.dayutang.cn/common/wxAd.html",function (data) {
                    $("body").prepend(data);
                });
            }
        },3000)
    }
}catch (e){}


//索粉
function addLockFans_new(modular){
    var fromUserId = getQuery("fromUserId");//formUserId获取
    if(fromUserId == "" || fromUserId == undefined || fromUserId == userID){
        return;
    }
    request("LockFans", "addLockFansReocrd", {
        userId: userID,
        fromUserId: fromUserId,
        modular: modular
    }, function(data) {
        if(data.code == 0){}
    })
}

var shareInfo = [];
// 获取分享信息
function getShareInfo(sharePositionCode, shareTypeCode, successFun) {
    var param = {};
    param.sharePositionCode = sharePositionCode;
    param.shareTypeCode = shareTypeCode;
    share.getShareInfo(param, function (data) {
        if (data.code == 0) {
            shareInfo = data.shareInfo;
            successFun && successFun();
        }
    })
}


// 添加分享记录
function addShareRecord(shareId, sharePositionCode, shareTypeCode, paramId) {
    var param = {};
    param.userId = userID;
    param.shareId = shareId;
    param.sharePositionCode = sharePositionCode;
    param.shareTypeCode = shareTypeCode;
    param.paramId = paramId;
    share.addShareRecord(param, function (data) {

    })
}

// 添加页面访问记录
function addUserPageViewRecord(shareId, shareUserId, sharePositionCode, shareTypeCode, paramId) {
    var param = {};
    param.userId = userID;
    param.shareId = shareId;
    param.shareUserId = shareUserId;
    param.sharePositionCode = sharePositionCode;
    param.shareTypeCode = shareTypeCode;
    param.paramId = paramId;
    share.addUserPageViewRecord(param, function (data) {

    })
}

// 横屏检测
function pingmu() {
    window.onorientationchange = function () {
        if (window.orientation == 90 || window.orientation == -90) {
            $('body').append("<div class='matches' style='position: fixed;width: 100%;height: 100%;top: 0; left:0;z-index: 999999;background: #295FCA;'><img src='https://www.dayutang.cn/img/vertical_screen1.gif' style='height: auto;width:100%;'/></div>");
        } else {
            $('.matches').remove();
        }

    }
}

//题库上传临时数据
examSubmit();
function examSubmit(){
    if(localStorage.getItem("anwserListChapterId") != null && localStorage.getItem("anwserListChapterId") != '' && localStorage.getItem("anwserListChapterId") != undefined){
        var preams = {};
        preams.userId = userID;
        preams.chapterId = localStorage.getItem("anwserListChapterId");//
        preams.answers = localStorage.getItem("anwserList");//

        request("Exam","tempSubmitQuestions",preams,function(data){
            if(data.code==0){
                localStorage.removeItem("anwserList");
                localStorage.removeItem("anwserListChapterId");
            }
        })
    }
}

try{
//过滤器 传入小数返回保留2位小数
Vue.filter('toFixedTwo',function(value){
    if(value == "" || value == undefined || value == 0 || (value - parseInt(value))==0){
        return value;
    }else{
        var str = value.toFixed(2);
        return str;
    }
});
}catch (e){}


//延迟几秒后在调用的公共方法
function setTimeOutFunCommon(callBack) {
    setTimeout(function () {
        callBack && callBack();
    },400);
}

//更新订单推荐人userId
function updateRecommendUserId() {
    var recommendUserId = getQuery("fromUserId");//formUserId获取
    if(recommendUserId == "" || recommendUserId == undefined || recommendUserId == null){
        return;
    }else{
        sessionStorage.recommendUserId = recommendUserId;
    }
}

//自定义showTost 弹框
function customShowTostFun(strIN,timer,callBack) {
    var str='';
    str+='<div class="ydyshowTost_weiyi" style="position: fixed; width: 100%; height: 100%; z-index: 999999; top: 0px; left: 0px;">';
    str+='<div class="" style="position: absolute; top: 50%; margin-top: -100px; width: 220px; left: 50%; margin-left: -130px; padding: 20px; border-radius: 10px; background: rgba(0,0,0,0.6); color: #fff; font-size: 14px; text-align: center; z-index: 99999;">'+strIN+'</div></div>';
    $("body").append(str);
    setTimeout(function () {
        $(".ydyshowTost_weiyi").remove();
        callBack && callBack();
    },timer)
}

// 邀请卡进入商品详情页 识别路径进入参数存值
function setProfitCardId(){
    var backGroundImgId = getQuery("backGroundImgId");
    if(backGroundImgId == "" || backGroundImgId == undefined || backGroundImgId == null){
        // console.log("没有邀请卡Id")
        sessionStorage.removeItem("backGroundImgId");
        return;

    }else{
        sessionStorage.setItem("backGroundImgId",backGroundImgId);
        // console.log("邀请卡Id:!! " + backGroundImgId)
    }
}
// 邀请卡进入商品详情页 识别路径进入参数取值
function getProfitCardId(){
    var backGroundImgId = sessionStorage.getItem("backGroundImgId");
    if (backGroundImgId != "" && backGroundImgId != undefined && backGroundImgId != null) {
        return backGroundImgId;
    }else{
        return ""
    }
}
