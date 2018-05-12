//检测是否为微信浏览器
function is_weixn() {
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i) == "micromessenger") {
		return true;
	} else {
		return false;
	}
}
//验证是否已经为微信授权用户
function openOAuth(scope) {
	var realURL = window.location.href;
	localStorage.realURL = realURL;
	var oAuthURL = encodeURIComponent("https://www.dayutang.cn/shopOrder/oAuth.html");
	var wxAuthURL = "https://open.weixin.qq.com/connect/oauth2/authorize" +
		"?appid=wxaa66399ab39edad3" +
		"&redirect_uri=" + oAuthURL +
		"&response_type=code&scope=" + scope +
		"&state=STATE" +
		"#wechat_redirect";
	window.open(wxAuthURL, "_self");
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

if(is_weixn()) {
	if(window.noOauth == undefined || window.noOauth != true) {
		wxAccessToken = getCookie("wxAccessToken");
		if(localStorage.userId == undefined || localStorage.token == undefined) {
			openOAuth("snsapi_userinfo");
		} else if(wxAccessToken == null) {
			openOAuth("snsapi_base");
		}
	}
}
