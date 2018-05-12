(function() {
	var loadCss = function(link) {
		try {
			if (document.createStyleSheet) {
				document.createStyleSheet(link);
			} else {
				var myLink = document.createElement("link");
				myLink.type = "text/css";
				myLink.rel = "stylesheet";
				myLink.href = link;
				document.getElementsByTagName("head")[0].appendChild(myLink);
			}
		} catch (e) {}
	}
	var Cookie = {
		get: function(key) {
			var ret, m;
			try {
				if (key) {
					if ((m = String(document.cookie).match(new RegExp('(?:^| )' + key + '(?:(?:=([^;]*))|;|$)')))) {
						ret = m[1] ? decodeURIComponent(m[1]) : '';
					}
				}
			} catch (e) {
				ret = null;
			}
			return ret;
		},
		set: function(key, value, maxAge, path, domain, secure) {
			var cookie = key + "=" + encodeURIComponent(value);
			if (maxAge) {
				cookie += "; max-age=" + maxAge;
			}
			if (path) {
				cookie += "; path=" + path;
			}
			if (domain) {
				cookie += "; domain=" + domain;
			}
			if (secure) {
				cookie += "; secure=" + secure;
			}
			document.cookie = cookie;
		}
	};
	var MobileApp = function() {
		this.init();
		this.bindEvents();
	}
	MobileApp.prototype = {
		init: function() {
			this.querySetting();
			loadCss('http://hao123.winworlds.cn/tpl/Static/weizan/css/mask.css');
		},
		bindEvents: function() {
			$(window).on("mobileappdataload", $.proxy(this.onAppDataLoad, this));
		},
		
		onAppDataLoad: function(e, data) {
			var newOpen = data.activity_frequence,
				newClose = data.activity_closelimit;
			var oldOpen = Cookie.get("MOBILE_APP_SETTING_OPEN"),
				oldState = Cookie.get("MOBILE_APP_SETTING_STATE") || "OPEN";
			var open, state;
			if (newOpen == 0) {
				Cookie.set("MOBILE_APP_SETTING_OPEN", newOpen, 0, "/", ".tuniu.com");
				state = "OPEN";
			} else {
				if (oldOpen) {
					state = oldState;
				} else {
					Cookie.set("MOBILE_APP_SETTING_OPEN", newOpen, newOpen * 24 * 3600, "/", ".tuniu.com");
					state = "OPEN";
				}
			}
			var self = this;
			if ((newClose != -1) && (oldState == "OPEN")) {
				this.closeTimer = setTimeout(function() {
					self.close();
				}, newClose * 1000);
			}
			this.build(data);
			if (state == "OPEN") {
				this.openElt.css("left", "0");
				this.closeElt.css("left", "-100%");
			} else {
				this.openElt.css("left", "-100%");
				this.closeElt.css("left", "0");
			}
			this.openElt.find(".btn-close").on("click", $.proxy(this.close, this));
			this.closeElt.on("click", $.proxy(this.open, this));
		},
		build: function(data) {
			this.openElt = $(MobileApp.OpenHtml).appendTo(document.body);
			this.closeElt = $(MobileApp.CloseHtml).appendTo(document.body);
			this.openElt.find(".box-background").css("background-color", "#" + data.color);
			this.openElt.find(".background-img img").attr("src", data.bkg.bkg_url);
			this.openElt.find(".background-img a").attr("href", data.bkg.bkg_linkurl);
			this.openElt.find(".btn-close img").attr("src", data.button_close.img_url);
			this.openElt.find(".btn-download a").each(function(index, item) {
				$(this).attr("href", data.button_other[index].btn_url);
				$(this).find("img").attr("src", data.button_other[index].url);
			});
			this.closeElt.find(".background-img img").attr("src", data.button_other[3].url);
		},
		open: function() {
			var self = this;
			self.closeElt.animate({
				left: "-100%"
			}, "normal", "swing", function() {
				self.openElt.animate({
					left: "0"
				}, "normal", "swing", function() {
					Cookie.set("MOBILE_APP_SETTING_STATE", "OPEN", 365 * 24 * 3600, "/", ".tuniu.com");
				})
			});
		},
		close: function() {
			var self = this;
			self.openElt.animate({
				left: "-100%"
			}, "normal", "swing", function() {
				self.closeElt.animate({
					left: "0"
				}, "normal", "swing", function() {
					Cookie.set("MOBILE_APP_SETTING_STATE", "CLOSE", 365 * 24 * 3600, "/", ".tuniu.com");
				})
			});
		}
	}
	MobileApp.OpenHtml = ['<div class="m-app-open">', '<div class="box-background">', '</div>', '<div class="box-inner">', '   <div class="background-img">', '       <a target="_blank" href=""></a>', '       <img src="" alt="">', '   </div>', '   <div class="btn-download">', '       <a href="" target="_blank">', '           <img src="" alt="">', '       </a>', '       <a href="" target="_blank">', '           <img src="" alt="">', '       </a>', '       <a href="" target="_blank">', '           <img src="" alt="">', '       </a>', '   </div>', '   <div class="btn-close">', '       <img src="" alt="">', '   </div>', '</div>', '</div>'].join("\n");
	MobileApp.CloseHtml = ['<div class="m-app-close">', '   <div class="background-img">', '       <img src="" alt="">', '   </div>', '</div>'].join("\n");
	var init = true;
	document.onmousemove = function() {
		if (init) {
			if (!window.XMLHttpRequest) {
				init = false;
				return false;
			}
			(new MobileApp());
		}
		init = false;
	}
})();;
var _zeus = _zeus || (function() {
	var windowAlias = window,
		visitUrl = windowAlias.location.href,
		currentTime = '',
		hostName = 'tuniu.com';
	var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	var base64DecodeChars = new Array(-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);

	function base64encode(str) {
		var out, i, len;
		var c1, c2, c3;
		len = str.length;
		i = 0;
		out = "";
		while (i < len) {
			c1 = str.charCodeAt(i++) & 0xff;
			if (i == len) {
				out += base64EncodeChars.charAt(c1 >> 2);
				out += base64EncodeChars.charAt((c1 & 0x3) << 4);
				out += "==";
				break;
			}
			c2 = str.charCodeAt(i++);
			if (i == len) {
				out += base64EncodeChars.charAt(c1 >> 2);
				out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
				out += base64EncodeChars.charAt((c2 & 0xF) << 2);
				out += "=";
				break;
			}
			c3 = str.charCodeAt(i++);
			out += base64EncodeChars.charAt(c1 >> 2);
			out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
			out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
			out += base64EncodeChars.charAt(c3 & 0x3F);
		}
		return out;
	}

	function base64decode(str) {
		var c1, c2, c3, c4;
		var i, len, out;
		len = str.length;
		i = 0;
		out = "";
		while (i < len) {
			do {
				c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
			}
			while (i < len && c1 == -1);
			if (c1 == -1)
				break;
			do {
				c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
			}
			while (i < len && c2 == -1);
			if (c2 == -1)
				break;
			out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));
			do {
				c3 = str.charCodeAt(i++) & 0xff;
				if (c3 == 61)
					return out;
				c3 = base64DecodeChars[c3];
			}
			while (i < len && c3 == -1);
			if (c3 == -1)
				break;
			out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));
			do {
				c4 = str.charCodeAt(i++) & 0xff;
				if (c4 == 61)
					return out;
				c4 = base64DecodeChars[c4];
			}
			while (i < len && c4 == -1);
			if (c4 == -1)
				break;
			out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
		}
		return out;
	}

	function utf16to8(str) {
		var out, i, len, c;
		out = "";
		len = str.length;
		for (i = 0; i < len; i++) {
			c = str.charCodeAt(i);
			if ((c >= 0x0001) && (c <= 0x007F)) {
				out += str.charAt(i);
			} else
			if (c > 0x07FF) {
				out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
				out += String.fromCharCode(0x80 | ((c >> 6) & 0x3F));
				out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
			} else {
				out += String.fromCharCode(0xC0 | ((c >> 6) & 0x1F));
				out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
			}
		}
		return out;
	}

	function utf8to16(str) {
		var out, i, len, c;
		var char2, char3;
		out = "";
		len = str.length;
		i = 0;
		while (i < len) {
			c = str.charCodeAt(i++);
			switch (c >> 4) {
				case 0:
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
					out += str.charAt(i - 1);
					break;
				case 12:
				case 13:
					char2 = str.charCodeAt(i++);
					out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
					break;
				case 14:
					char2 = str.charCodeAt(i++);
					char3 = str.charCodeAt(i++);
					out += String.fromCharCode(((c & 0x0F) << 12) | ((char2 & 0x3F) << 6) | ((char3 & 0x3F) << 0));
					break;
			}
		}
		return out;
	}

	function getCookie(name) {
		var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
		if (arr != null) return unescape(arr[2]);
		return null;
	}

	function addCookie(objName, objValue, objHours, objPath, objDomain) {
		var str = objName + "=" + escape(objValue);
		if (objHours > 0) {
			var date = new Date();
			var ms = objHours * 3600 * 1000;
			date.setTime(date.getTime() + ms);
			str += "; expires=" + date.toGMTString();
		}
		if (objPath != '' && objPath != undefined) {
			str += "; path=" + objPath;
		}
		if (objDomain != '' && objDomain != undefined) {
			str += "; domain=" + objDomain;
		}
		document.cookie = str;
	}

	function isInCookie(needle, haystack) {
		for (s = 0; s < haystack.length; s++) {
			thisEntry = haystack[s].toString();
			if (thisEntry == needle) {
				return true;
			}
		}
	}
	Date.prototype.Format = function(fmt) {
		var o = {
			"M+": this.getMonth() + 1,
			"d+": this.getDate(),
			"h+": this.getHours(),
			"m+": this.getMinutes(),
			"s+": this.getSeconds(),
			"q+": Math.floor((this.getMonth() + 3) / 3),
			"S": this.getMilliseconds()
		};
		if (/(y+)/.test(fmt))
			fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
		for (var k in o)
			if (new RegExp("(" + k + ")").test(fmt))
				fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
		return fmt;
	}

	function getCurrentTime() {
		return new Date().Format("yyyy-MM-dd hh:mm:ss");
	}

	function getHostname(url) {
		var e = new RegExp('^(?:(?:https?|ftp):)/*(?:[^@]+@)?([^:/#]+)'),
			matches = e.exec(url);
		return matches ? matches[1].substring(matches[1].indexOf('.')) : url;
	}

	function setZeusCookie(code) {
		currentTime = getCurrentTime();
		hostName = getHostname(visitUrl);
		var zeusStr = base64encode(utf16to8(code + '::' + visitUrl + '::' + currentTime));
		var zeusCookieStrArr, zeusCookieStr = getCookie('tuniu_zeus');
		if (zeusCookieStr != '' && zeusCookieStr != null) {
			var zeusCookieStrArr = String(zeusCookieStr).split(",");
			if (zeusCookieStrArr.length > 10) {
				zeusCookieStrArr.shift();
			}
			zeusCookieStr = zeusCookieStrArr.join(",");
			if (!isInCookie(zeusStr, zeusCookieStrArr)) {
				var value = zeusCookieStr + ',' + zeusStr;
				addCookie('tuniu_zeus', value, 24 * 30, '/', hostName);
			}
		} else {
			addCookie('tuniu_zeus', zeusStr, 24 * 30, '/', hostName);
		}
	}

	function Recorder() {
		return {
			push: function(code) {
				if (code != undefined && code != '') {
					setZeusCookie(code);
				}
			}
		};
	}
	return {
		getRecorder: function() {
			return new Recorder();
		}
	};
}());