/**
 * @module QYER.core.web.basic.js
 */


requirejs.config({
   "baseUrl": 'http://fed.static.qyer.com/',
    "paths":{
        'web_qui_controlbase': 'bower_components/web_qui_controlbase/controlBase',
        'web_qui_quiautocomplete': 'bower_components/web_qui_quiautocomplete/QuiAutoComplete',
        "ControlBase":"core/web/basic/js/controlBase",
        "QuiTip":"core/web/common/ui/QuiTip/src/QuiTip",
        "QuiDialog":"core/web/common/ui/QuiDialog/src/QuiDialog",
        "QuiPopup":"core/web/common/ui/QuiPopup/src/QuiPopup",
        "QuiPages":"core/web/common/ui/QuiPages/src/QuiPages",
        "QuiDatePicker":"core/web/common/ui/QuiDatePicker/src/QuiDatePicker",
        "QuiGmap":"core/web/common/ui/QuiGmap/src/QuiGmap",
        "QuiUpload":"core/web/common/ui/QuiUpload/src/QuiUpload",
        "QuiSelect":"core/web/common/ui/QuiSelect/src/QuiSelect",
        "QuiAutoComplete":"core/web/common/ui/QuiAutoComplete/src/QuiAutoComplete",
        "QuiLoading":"core/web/common/ui/QuiLoading/src/QuiLoading",
        "QuiSelectMarker":"core/web/common/ui/QuiSelectMarker/src/QuiSelectMarker",
        "infobox":"core/web/common/ui/QuiGmap/src/infobox",
        "confirm":"core/web/common/ui/confirm/src/confirm",
        "datepicker":"core/web/common/ui/datepicker/src/datepicker",
        "downReflesh":"core/web/common/ui/downReflesh/src/downReflesh",
        "gmap":"core/web/common/ui/gmap/src/gmap",
        "gotoTop":"core/web/common/ui/gotoTop/src/gotoTop",
        "inputAutocomplete":"core/web/common/ui/inputAutocomplete/src/inputAutocomplete",
        "inputValidation":"core/web/common/ui/inputValidation/src/inputValidation",
        "imgLoad":"core/web/common/ui/imgLoad/src/imgLoad",
        "loading":"core/web/common/ui/loading/src/loading",
        "popup":"core/web/common/ui/popup/src/popup",
        "popupLong":"core/web/common/ui/popupLong/src/popupLong",
        "select":"core/web/common/ui/select/src/select",
        "slidConfirm":"core/web/common/ui/slidConfirm/src/slidConfirm",
        "textArea":"core/web/common/ui/textArea/src/textArea",
        "tip":"core/web/common/ui/tip/src/tip",
        "tip2":"core/web/common/ui/tip2/src/tip2",
        "share":"core/web/common/ui/share/src/share",
        "ct_addListToPlan":"core/web/common/component/addListToPlan/src/addListToPlan",
        "ct_antiSpam":"core/web/common/component/antiSpam/src/antiSpam",
        "ct_copyPlan":"core/web/common/component/copyPlan/src/copyPlan",
        "ct_feedback":"core/web/common/component/feedback/src/feedback",
        "ct_footerBanner":"core/web/common/component/footerBanner/src/footerBanner",
        "ct_ieWarning":"core/web/common/component/ieWarning/src/ieWarning",
        "ct_login":"core/web/common/component/login/src/login",
        "ct_slidImg":"core/web/common/component/slidImg/src/slidImg",
        "ct_popImgBox":"core/web/common/component/popImgBox/src/popImgBox",
        "ct_picZoomer":"core/web/common/component/picZoomer/src/picZoomer",
        "ct_switchAccount":"core/web/common/component/switchAccount/src/switchAccount",
        "ct_report":"core/web/common/component/report/src/report",
        "ct_genHotelURI":"core/web/common/component/genHotelURI/src/genHotelURI"
    },
    "models":[
        {
            "name":"main"
        }
    ],
    "shim":{
        'infobox':{
            "exports":"InfoBox"
        }
    },
    "map": {
        '*': {
            'css': 'core/web/basic/js/lib/require-css/css'
        }
    }
});



! function() {
    var $ = jQuery;
    //  初始化 qyerUtil
    ! function() {

        /**
         * 常用基础操作封装
         * @class qyerUtil
         */
        window.qyerUtil = {

            init:function(){
                // 新框架的初始化方法, 老框架引入此文件,不需要做初始化(因为所有功能都零散的分散到页面了 -_-! ).
                this._initHead();
                this.spam_text_filter();
                this.frameCompatibleh();
            },

            // 对外暴露一些东西,要兼容老框架或一些外部的调用, 比如 qt 调用等
            frameCompatibleh:function(){
                // 统计代码中要用到的
                window._qyer_userid = window.QYER?window.QYER.uid : 0;
                window.setCookie=this.setCookie;
                window.getCookie=this.getCookie;
            },

            setCookie:function(name, value, time) {
                var Days=365, exp=new Date();
                if (!arguments[2]) {time = 1;}
                 //没有参数就是长期的  有的话就是 短期的 一个session
                 if (time == 1) {
                    exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
                    document.cookie = name + "=" + escape(value) + "; path=/;domain=.qyer.com" + ";expires=" + exp.toGMTString();
                } else {
                    document.cookie = name + "=" + escape(value) + "; path=/;domain=.qyer.com";
                }
                Days= exp= null;
            },

            getCookie:function(name) {
                var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
                if (arr != null) return unescape(arr[2]);
                return null;
            },

            _initHead:function(){

                 /* modified by zhangbiao @20140805*/
                /*
                $("#qyer_head_nav_item_sns, #qyer_head_nav_item_yd").hover(
                    function(){$(this).addClass("qyer_head_nav_item_current").find(".qyer_head_subnav_bg").show();},
                    function(){$(this).removeClass("qyer_head_nav_item_current").find(".qyer_head_subnav_bg").hide();}
                );
                */          
                    /* modified end*/
                //header随屏幕滚动
                if(window.location.hostname=="ask.qyer.com"){
                    $(".qyer_header_bg").css("position","fixed");
                }
            },

            _head: null,
            _getHead: function() {
                if (!this._head) {
                    this._head = document.getElementsByTagName("head")[0];
                }
                return this._head;
            },

            /**
             * 加载 css 文件
             * @method loadCss
             * @param {String} aFilePath 文件路径
             * @param {Boolean} aAsync 是否异步加载
             */

            loadCss: function(aFilePath, aAsync) {
                if (aAsync === false) {
                    this.insertStyle($.ajax({
                        url: aFilePath,
                        async: false
                    }).responseText);
                } else {
                    $('<link rel="stylesheet" type="text/css" />').attr("href", aFilePath).appendTo(this._getHead());
                }
            },

            /**
             * 动态创建  style 节点，插入到 dom 文档
             * @method insertStyle
             * @param {String} aStr css 代码字符串
             */
            insertStyle: function(aStr) {
                var nod = document.createElement("style");
                nod.type = "text/css";
                if (nod.styleSheet) { //ie下  
                    nod.styleSheet.cssText = aStr;
                } else {
                    nod.innerHTML = aStr; //或者写成 nod.appendChild(document.createTextNode(str))  
                }
                this._getHead().appendChild(nod);
                nod = null;
            },

            /**
             * 截取 arguments
             * @method sliceArguments
             * @param {arguments} aArgument function 的 arguments 对象
             * @param {Int} aIndex 要从第几位开始截取
             * @return {Array} 返回截取后的数组
             */
            sliceArguments: function(aArgument, aIndex) {
                var ps = [];
                for (var i = aIndex; i < aArgument.length; i++) {
                    ps.push(aArgument[i]);
                };
                return ps;
            },


            /**
             * 是否是移动设备
             * @method isMobile
             * @return {Boolean}
             */
             isMobile:function () {
                var uA = navigator.userAgent;
                return ( uA.match(/Android/i) || uA.indexOf('iPhone') != -1 || uA.indexOf('iPad') != -1  );
             },

            /**
             * 返回字符串长度
             * @method getWordLen
             * @return {Number}
             */
            getWordLen:function (aValue,g) {
                function byteLength(b){ 
                    if (typeof b == "undefined") { 
                        return 0 ;
                    } 
                    var a = b.match(/[^\x00-\x80]/g); 
                    return (b.length + (!a ? 0 : a.length));
                }
                function doublebyte (str){
                    return str.replace(/[^\x00-\xff]/g,'*') ;
                }

                if(g) {
                    aValue = doublebyte(aValue) ;
                }
                return byteLength($.trim(aValue));
            },


            /**
             * 截取字符串,中文按2个字符算
             * @method subStr
             * @param {String} aStr 要截取的字符串
             * @param {Number} aLen 要截取的长度
             * @return {String}
             */
            subStr:function (aStr, aLen) {
                var char_length=0,son_str,sub_len;
                for (var i = 0; i < aStr.length; i++) {
                    son_str = aStr.charAt(i);
                    encodeURI(son_str).length > 2 ? char_length += 1 : char_length += 0.5;
                    if (char_length >= aLen) {
                        sub_len = char_length == aLen ? i + 1 : i;
                        return aStr.substr(0, sub_len);
                        break;
                    }
                }
                return aStr;
            },





            /**
             * 强制执行 track 代码
             * @method doTrackCode
             * @param {String} aCode track代码
             */
            doTrackCode:function(aCode){
                var id = '__dotarckcodebutton__';
                if( !document.getElementById(id) ){
                    $('<button id="'+id+'" style="display:none;">dotarckcodebutton</button>').appendTo(document.body);
                }
                $('#'+id).attr('data-bn-ipg',aCode).trigger('click');
                id=null;
            },


            /**
             * jQuery ajax 成功回调，用于在所有 ajax 成功的时候，增加全局的业务逻辑处理
             * @method ajaxFillter
             */
            ajaxFillter:function(success, statusText, jqXHR){
                if( window.location.href.indexOf('http://plan.qyer.com') == 0  ){return;}
                if( typeof(success) == 'object' ){
                    if(success.extra && success.extra.code){
                        switch(success.extra.code|0){
                            case 1:
                                // 触发敏感词
                                window.qyerUtil.showAntiSpam(success.extra.msg);
                            break;
                        }
                    }
                }
            },

            /**
             * 弹出警告层（ 只要 ajax 返回结果中有 extra && extra.code != 0 ）
             * @method showAntiSpam
             * @param {String} aText 要显示的文本
             */
            showAntiSpam:function(aText){
                requirejs(['ct_antiSpam'],  function (m) {m.show(aText); });
            },

            /**
             * 执行 ajax 操作
             * @method doAjax
             * @param {Object} aOption 配置项
             * <ul>
             *      <li><span>testData ： Object ， 测试数据，有测试数据的话，直接返回测试数据，不会调用真实的 ajax </span></li>
             *      <li><span>onCallSuccessBefore ： function ， onSuccess 之前的回调</span></li>
             *      <li><span>onCallSuccessAfter ： function ， onSuccess 之后的回调</span></li>
             *      <li><span>onSuccess ： function ， 成功回调</span></li>
             *      <li><span>onError ： function ， 失败回调（ ajax 本身失败， errorcode ！=0 都会走到这里）</span></li>
             *      <li><span>posturl ： String ， 提交到的 url</span></li>
             *      <li><span>data ： Object ， 要 post 的数据对象</span></li>
             *      <li><span>minResponseTime: Number, 最小响应时间 </span></li>
             *      <li><span>\_\_qFED\_\_: Object, 调用测试服务的配置 </span></li>
             *      <ul>
             *          <li>id : {String} 平台测试接口 id</li>
             *          <li>dataIndex : {Number} 获取第几条测试数据</li>
             *          <li>randomData : {Boolean} 获取随机一条数据，此字段为 true 时，dataIndex 配置无效</li>
             *      </ul>
             * </ul>
             */
            doAjax:function(aOption) {
            /*
             * @20140822 增加配置minResponseTime{number}，数据处理方法dataProcess
             */
                var _startDate, _duringTime, dataProcess;

                _startDate = aOption.minResponseTime ? new Date() : null;

                function logSendData(){
                    if(/static.qyer.com/.test(window.location.host)===true && window.console &&  window.console.log ){
                        console.log(aOption.data);
                    }
                }



                dataProcess = function(aJSON) {
                    /*
                     * @20140822为了兼容格式为{error:0,msg:'xxx'}的结果
                     */
                    if (typeof aJSON.error_code == 'undefined') {
                        try {
                            aJSON.error_code = aJSON.error;
                            aJSON.result = aJSON.result;
                            if (aJSON.error_code != 0) {
                                aJSON.data = aJSON.data || {};
                                aJSON.data.msg = aJSON.msg;
                            }
                        } catch (err) {}
                    }

                    if (aJSON.error_code == 0) {
                        if (typeof(aJSON.data) == 'undefined') {
                            aJSON.data = aOption.__defaultData__;
                        }
                        aOption.onCallSuccessBefore && aOption.onCallSuccessBefore(aJSON);
                        aOption.onSuccess && aOption.onSuccess(aJSON);
                        aOption.onCallSuccessAfter && aOption.onCallSuccessAfter(aJSON);
                    } else {
                        aOption.onError && aOption.onError(aJSON);
                    }
                };

                if (aOption.testData) {
                    if (typeof(aOption.testData.data) == 'undefined') {
                        aOption.testData.data = aOption.__defaultData__;
                    }
                    logSendData();
                    setTimeout(function() {dataProcess(aOption.testData);}, (aOption.minResponseTime || 200));
                    return;
                }

                /*
                @20150121增加对236 API测试数据的支持
                 */
                var _host = window.location.host, 
                    _url = aOption.url||aOption.posturl,
                    _data = aOption.data,
                    _dataType = 'json';

                if(/static.qyer.com/.test(_host) === true){
                    var id;
                    _data = $.extend({}, _data, {__qFED__:aOption.__qFED__});
                    if(aOption.__qFED__ && aOption.__qFED__.id){
                        id = aOption.__qFED__.id;
                        aOption.type = "GET";
                        _url = 'http://fe.2b6.me:3000/service/api/' + id;
                        _dataType = 'jsonp';
                        api = null;
                    }
                }

                logSendData();
                var _ajax = $.ajax({
                    type: aOption.type || "POST",
                    url: _url,
                    dataType: _dataType,
                    data: _data,
                    cache:aOption.cache || false,
                    success:function (aJSON) {
                        if (_startDate) {
                            _duringTime = new Date() - _startDate;
                            setTimeout(function() {
                                dataProcess.call(null, aJSON);
                                }, (_duringTime > aOption.minResponseTime ? 0 : aOption.minResponseTime - _duringTime));
                        } else {
                            dataProcess.call(null, aJSON);
                        }
                        _startDate = _duringTime = null;
                    },
                    error:function (aXhr,aInfo) {
                        /*
                         * @20140822 添加__server_error__属性，标识为服务器返回错误
                         * @20141212 添加__server_status__属性，标识为服务器返回错误的text
                         */
                        aOption.onError && aOption.onError({
                                "error_code":-1, 
                                "__server_error__":true,
                                "__server_status__":_ajax.statusText,
                                "result": "error", 
                                "data":{
                                    "msg": aInfo||{}
                                }
                            });
                    }
                });
                return _ajax;
            },

            /**
             * 在一个时间段内，保证此方法只调用一次
             * @method runOneInPeriodOfTime
             * @param {Funtion} aFun 要运行的方法
             * @param {Int} aTimer 多长时间范围内只运行一次（单位 ms）
             * @return {Function}
             */
            runOneInPeriodOfTime:function(aFun,aTimer){
                var timer ;
                return function(a,b,c,d,e){
                    window.clearTimeout(timer);
                    timer = window.setTimeout(function(){
                        aFun(a,b,c,d,e);
                    },aTimer||300);
                };
            },
             
             /**
             * 判断是否登录
             * @method isLogin
             * @return {Boolean}
             */
            isLogin:function(){
                return !!(window.QYER&&window.QYER.uid);
            },

            /**
             * 登录
             * @method doLogin
             */
            doLogin:function(aP){
                if(!window.qyerUtil.isLogin()){
                    requirejs(['ct_login'],function(c){c.show(aP); });
                }
            },

            /**
             * 注册
             * @method  doSignin
             */
            doSignin:function(ap){
                requirejs(['ct_login'], function(c){
                    c.show($.extent({},{page:'regist'},ap));
                });
            },
            
            /**
             * 获取 url 参数
             * @method getUrlParam
             * @param {String} aKey 
             * @return {String}
             */
            getUrlParam:function(aKey, aURL){
                var reg = new RegExp("(^|&)"+ aKey +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var url ;
                if(aURL){
                    var i = aURL.indexOf('?');
                    i!=-1 && ( url = aURL.substr( aURL.indexOf('?') + 1 ) ) ;
                }else{
                    url = window.location.search.substr(1);
                }
                if(!url){
                    return null ;
                }
                var r = url.match(reg);  //匹配目标参数
                if (r!=null) return unescape(r[2]); return null; //返回参数值
            },


            /**
             * 替换外站链接
             * @method spam_text_filter
             */
            spam_text_filter:function(){
                var reg,$this, html,p, $list;
                reg = /(http:\/\/)?[\w\.]*\.?(mafengwo\.cn|mafengwo\.com|mafengwo\.net)[a-zA-Z\/0-9&\?\.#\-_]*/gim;
                $list=$(".qyer_spam_text_filter");
                $list.find("a").each(function(){
                    $this = $(this);
                    if(($this.html()+$this.attr("href")).indexOf("mafengwo.cn")!=-1 || ($this.html()+$this.attr("href")).indexOf("mafengwo.com")!=-1 || ($this.html()+$this.attr("href")).indexOf("mafengwo.net")!=-1){
                        $this.replaceWith($(this).html());
                    }
                });
                $list.each(function(){
                    $this = $(this);
                    html = $this.html().replace(/\<script.*?\>document\.write\(AC_FL_RunContent.*?\<\/script\>/gim,"");
                    p = html.match(/\<img[\s\S]*?\>/gim);
                    if(p!=null){
                        for(var i=0;i<p.length;i++){html = html.replace(p[i],"[imgimg]"+i+"[/imgimg]");}
                    }
                    html = html.replace(reg,"");
                    if(p!=null){
                        for(var i=0;i<p.length;i++){html = html.replace("[imgimg]"+i+"[/imgimg]",p[i]); }
                    }
                    $this.html(html);
                });
                reg= $this= html= p= $list= null;
            },


            /**
             * 代理页面 .js_cmd 的点击事件
             * @method spam_text_filter
             */
            bindPageEvent : function(aEventList) {
                $(document).on('click','.js_cmd',function(aEvt){
                    var $this = $(this);
                    var cmd = $(this).attr('data-cmd');
                    if(aEventList[cmd]){
                        return aEventList[cmd].call(aEventList,aEvt,$this);
                    }
                });
            }


        }

    }();



    // 原型扩展 
    !function () {
        function ex(aObj,aEx) {for(var key in aEx ){aObj[key] = aEx[key]; } }

        /**
         * models Date原型扩展
         * @class Date.prototype
         */
        ex(Date.prototype,{
            /**
             * 返回中文，星期几
             * @method qGetWeekStr
             * @return {String}
             */
            qGetWeekStr:function () {
                return '星期' + ["日","一","二","三","四","五","六"][this.getDay()];
            },

            /**
             * 设置几天之后的日期
             * @method qAddDate
             * @param {Number} aNum 
             */
            qAddDate:function (aNum) {
                this.setDate( this.getDate() + aNum );
                return this;
            },

            /**
             * 转换成字符串 类似 2014-1-1 ， 可以自定义分隔符
             * @method qToString
             * @param {String} aSplit 分隔符
             */
             qToString:function (aSplit) {
                var  str = [ this.getFullYear(), this.getMonth()+1, this.getDate() ];
                return str.join(aSplit||'-');
            }

        });


        /**
         * models String原型扩展
         * @class String.prototype
         */
        ex(String.prototype,{
            /**
             * 转换成 Date 对象
             * @method qToDate
             * @param {String} aSplit 分隔符
             * @return {Date} 
             */
            qToDate:function (aSplit) {
                var s = this.split(aSplit||'-');
                s = [s[0]|0, (s[1]|0)-1, s[2]|0];
                var d = new Date(s[0],s[1],s[2]);
                s.length=0;
                s=null; 
                return d;
            },


            /**
             * 转换成 两位整数 不足补零
             * @method qToIntFixed
             * @param {Number} aLen 要转换成几位
             * @return {String} 
             */
            qToIntFixed:function () {
                var n = this|0;
                return n<10 ? '0'+n : n.toString();
            },

            /**
             * 转换成 html 代码，替换回车等特殊字符
             * @method qToHTML
             * @return {String} 
             */
            qToHTML:function () {
                return this
                           .replace(/</gi,"&lt;")
                           .replace(/>/gi,"&gt;")
                           .replace(/\n/gi,"<br />")
                           .replace(/\t/gi,"&nbsp;&nbsp;&nbsp;&nbsp;");
            }



        });



    }();


}();

/* 运行 */
$(function() {qyerUtil.init();})
