var uiTools1 = {
	//显示加载状态图标
	showLoading: function () {
        var mask = $('<div class="loading_mask"></div>');
        var icon = $('<img src="//static.dayutang.cn/img/loading.gif"/>');
        mask.append(icon);
        $("body").append(mask);
        var $loadingMask = $(".loading_mask");
        var $loadingMaskImg = $(".loading_mask img");
        $loadingMask.css({"position":"fixed", "top":"50%", "left":"50%", "marginTop":"-35px", "marginLeft":"-35px", "borderRadius":"70px", "boxShadow":"0px 0px 10px rgba(0,0,0,0.4)", "height":"70px", "width":"70px", "overflow":"hidden", "lineHeight":"0"});
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
    },
    userRemoveModel:function (contentDes,confirmLabel,callback) {
        var exitDiv = $('<div class="setMainStatusModal"></div>');
        var modelContain = $('<div class="exitModel-contain"></div>');
        var modelContain_img = $('<img src="../common/img/unbindImg.png" >');
        var modelContain_p = $('<p >'+ contentDes +'</p>');
        var useThisUser = $('<div class="useThisUser"></div>');
        var weChat_img = $('<img src="../common/img/weChat.png" >');
        var userNowWX = $('<span class="userNowWX">'+''+ confirmLabel +'</span>');

        useThisUser.append(weChat_img);
        useThisUser.append(userNowWX);
        modelContain.append(modelContain_img);
        modelContain.append(modelContain_p);
        modelContain.append(useThisUser);
        exitDiv.append(modelContain);
        $("body").append(exitDiv);

        exitDiv.css({'position': 'fixed','left': '0','top':'0','width': '100%','height': '100%','backgroundColor': 'rgba(0,0,0,0.6)','zIndex':'300000','textAlign':'center'});
        modelContain.css({'backgroundColor': '#ffffff','position': 'absolute','top':' 24%','left':'10%','width': '80%','borderRadius': '8px','padding':'20px','boxSizing': 'border-box','textAlign':'center'});
        modelContain_img.css({'width': '80px','height': '80px','margin': '0 auto','borderRadius':'50%'});
        modelContain_p.css({'color': '#000','lineHeight': '1.5em','textAlign':'center'});
        useThisUser.css({'width': '80%','margin': '0 auto','marginTop': '20px','lineHeight':'2.5em','background':'#67B044','borderRadius':'4px','color':'#fff','textAlign':'center'});
        weChat_img.css({'width':'30px','height': '30px','verticalAlign':'middle','marginRight':'3px'});
        exitDiv.show();

        addTapEvent(useThisUser[0], function(element){
            exitDiv.remove();
            if(callback!=null){
                callback(1);
            }
        });
    }

};

/** 鑷畾涔塼ap鎵嬪娍 **/
function addTapEvent(element,func){
    var isTouchStart = false;
    var startX;
    var startY;
    var startTime;
    if(isMobile){
        element.addEventListener("touchstart",function(evt){
            isTouchStart = true;
            var date = new Date();
            startTime = date.getTime();
            startX = evt.touches[0].pageX;
            startY = evt.touches[0].pageY;
        });
        element.addEventListener("click", function(evt){
            evt.preventDefault();
        });
        element.addEventListener("touchend",function(evt){
            evt.preventDefault();
            if(isTouchStart){
                isTouchStart = false;
                var date = new Date();
                var endTime = date.getTime();
                var endX = evt.changedTouches[0].pageX;
                var endY = evt.changedTouches[0].pageY;
                if(endTime-startTime<250){
                    if(Math.abs(endX-startX)<10 && Math.abs(endY-startY)<10){
                        if(func!=null){
                            func(element);
                        }
                    }
                }
            }
        });
    }else{
        element.addEventListener("click", function(evt){
            if(func!=null){
                func(element);
            }
        });
    }
}

