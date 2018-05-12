
//最新的公共的弹窗方法
(function($) {
    $.extend({
        //活动类弹窗 一个图片 一个关闭功能
        movableAlert: function (options) {
            var defaults = {
                adMark:""
            };
            var options = $.extend(defaults, options);
            //异步加载弹窗样式文件
            if($("#yt_customAlertCss").length==0){
                var linkCss = '<link rel="stylesheet" type="text/css" id="yt_customAlertCss" href="/common/lib/customAlert/customAlert.css" >'
                $("body").append(linkCss);
            }

            var movableAlertOne = {
                init:function () {
                    var that = this;
                    that.requestFun(options.adMark);//请求接口事件
                    that.bindClickFun();//绑定关闭事件
                },
                requestFun:function (adMark) {
                    var that = this;
                    request("Advert", "getHomePageAdvert", {
                        banner :  adMark,
                        userId: userID
                    }, function(data) {
                        if(data.code == 0){
                            if( typeof(data.adverts)=="undefined" || data.adverts.length <= 0){
                                return;
                            }
                            console.log(data);
                            if(data.isWatch==0) {
                                that.strHtmlInsert(data.adverts[0].image, data.adverts[0].url);//插入html
                            }
                        }
                    })
                },
                strHtmlInsert:function (imgData, hrefData) {
                    var str = '<div class="yt_CustomAlertCommon">';
                    str +='<div class="yt_activityCustomAlert">';
                    str +='<a href="'+hrefData+'"><img src="'+imgData+'" alt=""></a>';
                    str +='<img class="yt_CustomAlertClose" src="/common/lib/customAlert/close.png" alt="">';
                    str +='</div></div>';
                    $("body").append(str);
                },
                bindClickFun:function () {
                    $("body").delegate(".yt_CustomAlertClose","click",function () {
                        $(".yt_CustomAlertCommon").remove();
                    })
                }
            };
            movableAlertOne.init();
        }
    })
})(jQuery);


var uiTools = {
	//显示加载状态图标
	showLoading: function () {
        var mask = $('<div class="loading_mask"></div>');
        var icon = $('<img src="//static.dayutang.cn/img/loading.gif"/>');
        mask.append(icon);
        $("body").append(mask);
        var $loadingMask = $(".loading_mask");
        var $loadingMaskImg = $(".loading_mask img");
        $loadingMask.css({"position":"fixed", "top":"50%", "left":"50%", "marginTop":"-35px", "marginLeft":"-35px", "borderRadius":"70px", "boxShadow":"0px 0px 10px rgba(0,0,0,0.4)", "height":"70px", "width":"70px", "overflow":"hidden", "lineHeight":"0", "z-index":"20001"});
        $loadingMaskImg.css({"width":"100%", "height":"100%"});
        mask.show();
	},
	hideLoading: function () {
		$(".loading_mask").remove();
	},
    showAlert:function (idName,title, content, confirmLabel, cancelLabel, callback) {
        var div = $('<div class="weui_dialog_confirm"></div>');
        var mask = $('<div class="weui_mask" style="z-index: 21"></div>');
        var dialog = $('<div class="weui_dialog" style="z-index: 22"></div>');
        var head = $('<div class="weui_dialog_hd"><strong class="weui_dialog_hd">'+title+'</strong></div>');
        if(content==undefined) content="";
        var content = $('<div class="weui_dialog_bd">'+content+'</div>');
        var footer = $('<div class="weui_dialog_ft"></div>');
        var btnCancel;
        if(cancelLabel!=undefined && cancelLabel!=""){
            btnCancel = $('<a class="weui_btn_dialog default">'+cancelLabel+'</a>');
            footer.append(btnCancel);
        }
        if(confirmLabel==undefined) confirmLabel="确定";
        var btnOK = $('<a class="weui_btn_dialog primary">'+confirmLabel+'</a>');
        footer.append(btnOK);
        dialog.append(head);
        dialog.append(content);
        dialog.append(footer);
        div.append(mask);
        div.append(dialog);
        $("#" + idName).append(div);
        //addeventlistener
        if(btnCancel){
            addTapEvent(btnCancel[0], function(element){
                div.remove();
                if(callback!=null){
                    callback(0);
                }
            });
        }
        addTapEvent(btnOK[0], function(element){
            div.remove();
            if(callback!=null){
                callback(1);
            }
        });
    }
};

/*S标题滚动方法*/
var scrollAudioName = {
	outer: null,
	inner: null,
	timeOut: null,
	scrollFunction: function () {
		// clearTimeout(this.timeOut);
		var wName = this.inner.width();
		var wNameDiv = this.outer.width();
		// console.log(wName + " L " + wNameDiv)
		if (wName > wNameDiv + 2) {
			var ll = parseInt(this.inner.css("left"));
			var maxl = wNameDiv - wName - wNameDiv / 2;
			// console.log(ll +"" + (ll < maxl));
			ll < maxl && this.resetPosition() || this.inner.css("left", ll - 1);
		} else {
			this.resetPosition();
		}
	},
	play: function() {
		this.timeOut = setInterval(function () {
			scrollAudioName.scrollFunction();
		}, 50);
	},
	resetPosition: function() {
		this.inner && this.inner.css("left", 0);
		return this;
	},
	stop: function() {
		this.timeOut && clearInterval(this.timeOut);
		this.timeOut = null;
		return this;
	},
	resetAndStop: function() {
		this.resetPosition().stop();
	}
};
/*E标题滚动方法*/

/*S页面无限加载翻页公用方法*/
var infiniteScroll = {
    loading: false,
    size: 0,
    run: function (VLivingExample, loadCallbackFunc) {
        if (!this.loading) {
            if (VLivingExample) {
                VLivingExample.loading = this.loading = true;
                this.size = VLivingExample.size = VLivingExample.size += VLivingExample.size;
                loadCallbackFunc && loadCallbackFunc();
            }
        }
    }
};
/*E页面无限加载翻页公用方法*/

/*S倒计时工具*/
var timeCountDown = {
	intervalObj: null,
	setElementTime: function (timeStamp, str, callback) {
		var currentTimeStamp = new Date().getTime();
		balance = timeStamp ? timeStamp - currentTimeStamp : this.restoreMsTime(str) - (new Date().getTime());
		console.log(balance);
        balance = Math.abs(balance);

		dd = this.completeTime(parseInt(balance / 1000 / 60 / 60 / 24, 10)); //计算剩余的天数
		hh = this.completeTime(parseInt(balance / 1000 / 60 / 60 % 24, 10)); //计算剩余的小时数;
		mm = this.completeTime(parseInt(balance / 1000 / 60 % 60, 10)); //计算剩余的分钟数;
		ss = this.completeTime(parseInt(balance / 1000 % 60, 10)); //计算剩余的秒数;

		$(".daysLeft").text(dd);
		$(".hours").text(hh);
		$(".minutes").text(mm);
		$(".seconds").text(ss);

        callback && callback(balance);
        // timeCountDown.executeBusiness(balance);
	},
    // executeBusiness: function (balance) {
	 //    if (document.location.href.indexOf('goodDetails') > 0) {
    //         if (balance <= 60000) {
    //             clearInterval(this.intervalObj);
    //             r.getBookInfo();
    //             return;
    //         }
    //     }
    //     if (document.location.href.indexOf('alipay') > 0) {
    //         if (balance > 1800000) {
    //             clearInterval(this.intervalObj);
    //             location.href = '../order/orderList.html?#!/orderDetails.html?payOrderNo=' + getQuery("payOrderNo");
    //             return;
    //         }
    //     }
    //
    //
    // },
	countDown: function (timeStamp, str,  callback) {
		this.intervalObj = setInterval(function () {
			timeCountDown.setElementTime(timeStamp, str, callback);
		}, 1000);
	},
	restoreMsTime: function (str) {  // '2017-06-09 12:02:38'
		var timeStamp = 0;
		var year = str.split("-")[0];
		var mouth = str.split("-")[1] - 1;
		var day = str.split(" ")[0].split("-")[2];
		var hour = str.split(" ")[1].split(":")[0];
		var minutes = str.split(" ")[1].split(":")[1];
		var seconds = str.split(" ")[1].split(":")[2];
		var timeStamp = new Date(year, mouth, day, hour, minutes, seconds).getTime();
		return timeStamp;
	},
	completeTime: function (i) {
		return i = i < 10 ? '0' + i : i;
	},
	appendElement: function () {
		var elment =  '<div class="fr countDownDay">'
					+ '<span class="dayseatra fr">后开抢</span>'
					+ '</div>'
					+ '<div class="fr countDownHMS">'
					+ '<span class="fr countDownHMSSplit">分</span>'
					+ '<div class="fr">'
					+ '<span class="countDownBox minutes"></span>'
					+ '</div>'
					+ '<span class="fr countDownHMSSplit">时</span>'
					+ '<div class="fr">'
					+ '<span class="countDownBox hours"></span>'
					+ '</div>'
					+ '<span class="fr countDownHMSSplit">天</span>'
					+ '<div class="fr">'
					+ '<span class="countDownBox daysLeft"></span>'
					+ '</div>'
					+ '</div>';
		$(".timeCountDown").append(elment);
	},
    formatTime:function (seconds) { //将时间戳格式为"00:00"格式
        if (seconds == "" || seconds == null || isNaN(seconds)) {
            return '00:00';
        }
        var timestr = "";
        var minutes = parseInt(seconds / 60).toString();
        if(minutes.length == 1) minutes = "0" + minutes;
        var seconds = String(parseInt(seconds) % 60);
        if(seconds.length == 1) seconds = "0" + seconds;
        timestr = minutes + ":" + seconds;
        return timestr;
    },
    //获取日历月份最后一天
    getLastDay:function(year,month){
        var new_year = year;  //取当前的年份
        var new_month = month++;//取下一个月的第一天，方便计算（最后一天不固定）
        if(month>12)      //如果当前大于12月，则年份转到下一年
        {
            new_month -=12;    //月份减
            new_year++;      //年份增
        }
        var new_date = new Date(new_year,new_month,1);        //取当年当月中的第一天
        return (new Date(new_date.getTime()-1000*60*60*24)).getDate();//获取当月最后一天日期
    },
    // 获取某个月有多少天
    mGetDate:function(year, month){
        var d = new Date(year, month, 0);
        return d.getDate();
    }
};
/*E倒计时工具*/

/*S处理浮点数精度*/
var formatFloat = {
    powFloat: function (float, n) {
        return Math.round(parseFloat(float * Math.pow(10, n)));
    }
};
/*E处理浮点数精度*/

// 数组相关方法
var arrayFunction ={
    // 一位数组分割成每多个一组:第一种
    arrayOneToThree:function(arr,childNum){
        var result = [];
        for(var i=0,len=arr.length;i<len;i+=childNum){
            result.push(arr.slice(i,i+childNum));
        }
        return result;
    },
    //删除数组中指定元素
    delItemInArr:function(arr, val) {
        for(var i=0; i<arr.length; i++) {
            if(arr[i] == val) {
                arr.splice(i, 1);
                break;
            }
        }
    }
};

//微信相关工具
var weiXinTools = {
    /**
     * 检查是否微信
     * @returns {boolean}
     */
    isWeiXin : function () {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
        } else {
            return false;
        }
    },
    /**
     * 隐藏微信右上角菜单
     */
    hideOptionMenu : function () {
        wx.hideOptionMenu(); //隐藏右上角菜单项
    },
    /**
     * 显示右上角菜单项
     */
        showOptionMenu : function () {
        wx.showOptionMenu(); //显示右上角菜单项
    },
    /**
     * 显示收藏按钮
     */
    showFavoriteMenu : function () {
        wx.showMenuItems({
            menuList: [
                'menuItem:favorite' // 显示收藏按钮
            ]
        });
    },
    /**
     * 隐藏收藏按钮
     */
    hideFavoriteMenu : function () {
        wx.hideMenuItems({
            menuList: [
                'menuItem:favorite'  //隐藏收藏按钮
            ]
        });
    },
    /**
     * 隐藏发送给好友按钮
     */
    hideAppMessageMenu : function () {
        wx.hideMenuItems({
            menuList: [
                "menuItem:share:appMessage"//隐藏发送给好友按钮
            ]
        });
    },
    /**
     * 显示发送给好友按钮
     */
    showAppMessageMenu : function (title,desc,link,imgUrl,successFun,type,dataUrl) {
        try {
            wx.showMenuItems({
                menuList: [
                    'menuItem:share:appMessage' // 分享到朋友
                ]
            });
            if (!type) {
                type = "link";
            }
            wx.onMenuShareAppMessage({    //分享给朋友
                title: title,
                desc: desc,
                link: link,
                imgUrl: imgUrl,
                type: type,
                dataUrl: dataUrl,
                success: function () {
                    setTimeout(function () {
                        successFun && successFun();
                    },500)
                }
            });
        } catch (e) {
            console.error("显示发送给好友按钮,请检查代码")
        }
    },
    /**
     * 隐藏分享到朋友圈按钮
     */
    hideTimeLineMenu : function () {
        wx.hideMenuItems({
            menuList: [
                "menuItem:share:timeline"//分享到朋友圈
            ]
        });
    },
    /**
     * 显示分享到朋友圈按钮
     */
    showTimeLineMenu : function (title,link,imgUrl,successFun) {
        try {
            wx.showMenuItems({
                menuList: [
                    'menuItem:share:timeline' // 分享到朋友圈
                ]
            });
            wx.onMenuShareTimeline({   //分享到朋友圈
                title: title,
                link: link,
                imgUrl: imgUrl,
                success: function () {
                    setTimeout(function () {
                        successFun && successFun();
                    },500)
                }
            });
        } catch (e) {
            console.error("显示分享到朋友圈按钮,请检查代码")
        }
    },
    /**
     * 在Safari中打开
     */
    openWithSafari: function () {
        wx.showMenuItems({
            menuList: [
                "menuItem: openWithSafari",  //在Safari中打开
                "menuItem:openWithQQBrowser", //在Safari中打开
                "menuItem: openWithSafari"  //在Safari中打开

            ]
        });
    },
    scanQRCode:function (successFun) {
        wx.scanQRCode({
            needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            sourceType: ['camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                if (result.indexOf("EAN_13") >= 0) {
                    var arr = result.split("EAN_13,");
                    if (arr.length == 2) {
                        bookcode = arr[1];
                        if (bookcode.length == 13) {
                            successFun && successFun(bookcode);
                        } else {
                            successFun && successFun("");
                        }
                    } else {
                        successFun && successFun("");
                    }
                } else {
                    successFun && successFun("");
                }

            }
        })
    }
};
//统计工具
var tjTools = {
    //百度统计代码
    trackEvent : function (category, action, opt_label, opt_value) {
        try {
            _hmt.push(['_trackEvent', category, action,opt_label,opt_value]);
        }catch (e){
            console.error("百度统计代码,请检查代码")
        }
    }
};

//统计工具
var StringTools = {
    //转码
    getEncodeURI : function(url) {
        return encodeURIComponent(url);
    },
    //解码
    getDecodeURI : function(url) {
        return decodeURIComponent(url);
    },
    //生成UUID
    generateUUID : function () {
        var d = new Date().getTime();
        var uuid = 'xxxxxxxxxxxx4xxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = (d + Math.random()*16)%16 | 0;
            d = Math.floor(d/16);
            return (c=='x' ? r : (r&0x3|0x8)).toString(16);
        });
        return uuid;
    },
    isEmpty : function (str) {
        if (str === "" || str === null
            || typeof str === 'undefined') {
            return true;
        }
        return false;
    },
    strlen:function (str) {   //js获取字符串字节数
        var len = 0;
        for (var i=0; i<str.length; i++) {
            var c = str.charCodeAt(i);
            //单字节加1
            if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {
                len++;
            }
            else {
                len+=2;
            }
        }
        return len;
    }
};

function lazyLoadImg(option){
    var settings={
        defObj:null,
        defHeight:0,
        scrollTop:0,
        obj:null
    };
    settings=$.extend(settings,option||{});
    var defHeight=settings.defHeight,defObj=(typeof settings.defObj=="object")?settings.defObj.find("img"):$(settings.defObj).find("img");
    var pageTop=function(){
        if(settings.scrollTop == 0){
            return document.documentElement.clientHeight+Math.max(document.documentElement.scrollTop,document.body.scrollTop)-settings.defHeight;
        }else{
            return document.documentElement.clientHeight+Math.max(settings.obj.scrollTop(),document.body.scrollTop)-settings.defHeight;
        }
    };
    var imgLoad=function(){
        defObj.each(function(){
            var data_original=$(this).attr("data-original");
            if(data_original){
                if ($(this).offset().top<=pageTop()){
                    if (data_original){
                        $(this).attr("src",data_original).removeAttr("data-original");
                    }
                }
            }
        });
    };
    imgLoad();
    if(settings.scrollTop == 0) {
        $(window).bind("scroll", function () {
            imgLoad();
        });
    }else{
        settings.obj.bind("scroll", function () {
            imgLoad();
        });
    }
}

/**
 * 将日期格式化成指定格式的字符串
 * @param fmt 目标字符串格式，支持的字符有：y,M,d,q,w,H,h,m,S，默认：yyyy-MM-dd HH:mm:ss
 * @returns 返回格式化后的日期字符串
 */
Date.prototype.format = function (fmt) {
    var date = this == undefined ? new Date() : this;
    fmt = fmt || 'yyyy-MM-dd HH:mm:ss';
    var obj = {
        'y': date.getFullYear(), // 年份，注意必须用getFullYear
        'M': date.getMonth() + 1, // 月份，注意是从0-11
        'd': date.getDate(), // 日期
        'q': Math.floor((date.getMonth() + 3) / 3), // 季度
        'w': date.getDay(), // 星期，注意是0-6
        'H': date.getHours(), // 24小时制
        'h': date.getHours() % 12 == 0 ? 12 : date.getHours() % 12, // 12小时制
        'm': date.getMinutes(), // 分钟
        's': date.getSeconds(), // 秒
        'S': date.getMilliseconds() // 毫秒
    };
    var week = ['日', '一', '二', '三', '四', '五', '六'];
    for (var i in obj) {
        fmt = fmt.replace(new RegExp(i + '+', 'g'), function (m) {
            var val = obj[i] + '';
            if (i == 'w') return (m.length > 2 ? '星期' : '周') + week[val];
            for (var j = 0, len = val.length; j < m.length - len; j++) val = '0' + val;
            return m.length == 1 ? val : val.substring(val.length - m.length);
        });
    }
    return fmt;
};
/**
 * 计算两个日期周数差
 * sDate1和sDate2是日期格式
 */
function weekDiff(sDate1, sDate2) {
    var date1 = sDate1.format('yyyy/MM/dd');
    var date2 = sDate2.format('yyyy/MM/dd');
    var day1 = sDate1.getDay() == 0 ? 7 : sDate1.getDay();
    var day2 = sDate2.getDay() == 0 ? 7 : sDate2.getDay();
    var dateMon1 = new Date(date1).getTime() - (day1 - 1) * 24 * 60 * 60 * 1000;
    var dateMon2 = new Date(date2).getTime() - (day2 - 1) * 24 * 60 * 60 * 1000;
    var monday = (dateMon1 - dateMon2) / 1000 / 60 / 60 / 24 / 7;
    return monday;
}

/**
 * 计算两个日期天数差
 * sDate1和sDate2是日期格式
 */
function dateDiff(sDate1, sDate2) {
    var date1 = sDate1.format('yyyy/MM/dd');
    var date2 = sDate2.format('yyyy/MM/dd');
    var iDays = (new Date(date1).getTime() - new Date(date2).getTime()) / 1000 / 60 / 60 / 24;    //把相差的毫秒数转换为天数
    return iDays;
}

/**
 * 日期需特殊化显示
 * 优先：今日、明天、后天、昨天、前天
 * 其次：本周几、下周几
 * 最后：xx月xx日（与当前日期d跨年了，则显示xxxx年xx月xx日）
 */
function timeTransform(str) {
    var myDate = new Date();
    var liveDate = new Date(str.replace(/-/g, '/'));//字符串转日期不支持'-',需要yyyy/MM/dd

    var days = dateDiff(liveDate, myDate);
    var weeks = weekDiff(liveDate, myDate);
    if (days == 0) {
        return '今天';
    } else if (days == 1) {
        return '明天';
    } else if (days == 2) {
        return '后天';
    } else if (days == -1) {
        return '昨天';
    } else if (days == -2) {
        return '前天';
    } else if (weeks == 1) {
        return '下' + liveDate.format('ww');
    } else if (weeks == 0) {
        return '本' + liveDate.format('ww');
    } else {
        if (liveDate.getFullYear() != myDate.getFullYear()) {  //与当前日期跨年了，则显示xxxx年xx月xx日
            return liveDate.format('yyyy年MM月dd日');
        } else {
            return liveDate.format('M月d日')
        }
    }
}