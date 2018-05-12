// 初始化应用程序并将其存储到myApp变量以进一步访问其方法
var myApp = new Framework7({
    pushState: true,
    activeState:false,
    activeStateElemets:'',
    animateNavBackIcon: true,
    imagesLazyLoadThreshold:1000,//懒加载图片预设位置
    swipeBackPage:false,
    swipeoutNoFollow:true,
    pushStateNoAnimation:false, //是否禁止页面返回动画
    swipeBackPageThreshold:1000    //如果“触摸距离”超过这个值，将开始刷卡动作
});
/**
 * Created by chenzhiliang on 17/2/16.
 */
    // Add view
var mainView = myApp.addView('.view-main', {
    // Because we want to use dynamic navbar, we need to enable it for this view:
    dynamicNavbar: true,
    domCache: true,
    // animatePages:false,
    uniqueHistory:true
});

var $$ = Dom7;


// var mySearchbar = myApp.searchbar('.searchbar', {
//     searchList: '.list-block-search',
//     searchIn: '.item-title'
// });
var audio = new Audio();

var vm;
var record;
var pdIndex;
var threeSetTime;
var timeBuffered;
var timeout = false; //启动及关闭用户学习记录方法;
var playBar = 1;
var showNextVersion;
var isPlay = false;
var changeObject=null;
var circle = localStorage.circle?localStorage.circle:0;
var preAudioId;
var preAudioVersionIndex;
var fiveSecondsTimeSign;
var listenStoryNum = "";
var v2Audio = require("V2Audio");
var audioClass = require("AudioClass");
var advert = require("Advert");
var personalCenter = require("PersonalCenter");
var spokesman = require("Spokesman");
var lockFans = require("lockFans");
var v2AudioPunch = require("V2AudioPunch");
var studyPlan = require("StudyPlan");
var creditsShop = require("CreditsShop");
var commonService = require("Common");
var creditsLottery = require("CreditsLottery");
var V2AudioNew = require("V2AudioNew");

var listenedNum = 1;
var onceChange = false; //点击上一曲或下一曲
var endChange = false;  //自动播放完毕
var mainSign = true;
var scan = false;
var namesStorage;
var names;
var hasStorage = false;
var ww;
var scrolldata = false;
var duration;
var isSubPageShare  = 0;
var punchSuccessSign = false;
var punchlittleModal;
var shareModalSign = false;
var timeRages;
var diamondX;
var diamond;
var punchCreditsTemp = 5;
var mainRefresh = false;   //刷新主页标志

var currentTime_ = 0;
var kouboBeginDuan=[];//口播区间段的开始

var thisToday = (new Date().getFullYear()).toString() + ((new Date().getMonth()) + 1).toString() + (new Date().getDate()).toString();//今天的日期
var ydyPunchCredits = 6;//打卡获取魔法石
var ydyContinue7dayCredits = 0;//类型打卡七天积分翻倍数
var ydyShareCredits = 0;//分享成功获得积分数
var ydyPunchIdentify = 0;//打卡时长（打卡成功标识\

if(localStorage.shopNames){
    names = JSON.parse(localStorage.shopNames)
}else {
    names = [];
}
vm = new Vue({
    el: '#main',
    data: {
        audios:[],
        menuList:[],
        albumList:[],
        page:0,
        size:9,
        length:0,
        adImgs:[],
        currentAudio:{},
        circle: circle,
        selectedIndex: 0,
        total:0,
        sign:false,
        studyRecordId:0,
        bannerShow:true,
        searchbarbg:false,
        playVersion:0,
        tipList:[],
        recommendKeywords:[],
        keyword:'',
        stickPunchShow:false,
        joinPunch:true,
        punchStatus:false,
        punchStatusNum:0,
        punchCredits:punchCreditsTemp,
        shareCredits:0,
        punchIdentify:0,
        punchTotalumber:0,
        restPunchTime:10,
        taskId:0,
        studyTime:0,
        shareStatus:false,
        punchModalShow:false,
        continuePunchDay:0,
        alreadyShare:false,
        newAlbumList:[],
        totalPunchTime:10,
        seventhDay:false,
        koubo:null,
        beforeAd:null,
        afterAd:null,
        allCurrentTime:0,
        kbPlayTime:0,
        preAdPlayTime:0,
        nextAdPlayTime:0,
        isPlayingIndex:0,
        addTime:0,     //判断音频在哪个部分,添加对应的时间
        allAdTime:0,    //口播+前广告+后广告的总和
        ips:[],
        recommendTeacherList:[],
        guessAudios:[],
        albumNum: 4,
        freeAlbums:[],
        payAlbums:[],
        jxAlbums:[],
        todayStory:true,
        ydy_ZhuanPanadImgs:{},
        creditsStoryComplete:0,//是否获取了收听的魔法石
    },
    methods: {
        //轮播下面的广告位
        ydy_goAd:function () {
            window.location.href=vm.ydy_ZhuanPanadImgs[0].url;
        },
        changeStyle:function (event) {
            event.stopPropagation();
            $("#playControl").hide();
            $(".punch-MainBtn").hide();
            inputFocus();
            searchbarbg = true;
        },
        style:function (event) {
            event.stopPropagation();
            $("#playControl").show();
            $(".punch-MainBtn").show();
            inputBlur();
            searchbarbg = false;
        },
        typeClick:function (index) {
            mainSign = false;
            switch(index)
            {
                case 0:
                    myApp.showIndicator();
                    inRankList();
                    break;
                case 1:
                    myApp.showIndicator();
                    inTeachList();
                    break;
                case 2:
                    myApp.showIndicator();
                    inMyFavorite();
                    break;
                case 3:
                    myApp.showIndicator();
                    inTypeAll();
                    break;
                default:

            }

        },
        jumpAllAlbum:function (type) {
            myApp.showIndicator();
            inAlbumMain(type);
        },
        toPlay:function (item,itemIndex,versionIndex,isBottomMenu) {
            if(item.needBuyFlag){
                showToast("此故事不能试听哦~ 请购买专辑");
            }else {
                if(item){
                    if (item.needBuyFlag) {
                        showToast("请先购买专辑!");
                    } else {
                        if(item.id !== vm.currentAudio.id || (item.id == vm.currentAudio.id && (vm.playVersion != versionIndex) && (itemIndex === ""))){
                            vm.playVersion = versionIndex;
                            vm.currentAudio = item;
                            vm.selectedIndex = itemIndex;
                            if (!vm.selectedIndex && vm.selectedIndex == '') {
                                for(var i=0;i<vm.menuList.length;i++){
                                    if(vm.menuList[i].id == item.id){
                                        vm.selectedIndex = i;
                                        break;
                                    }
                                }
                            }
                            if(mainSign){
                                if(!isBottomMenu){
                                    vm.menuList = vm.audios;
                                    vm.length = vm.menuList.length;
                                    cacheData();
                                }
                            }
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                } else {
                    myApp.showIndicator();
                    inPlayer(vm.currentAudio.id,1);
                }
            }
        },
        guessToPlay:function (item,itemIndex,versionIndex,isBottomMenu) {
            if(item.needBuyFlag){
                showToast("此故事不能试听哦~ 请购买专辑");
            }else {
                if(item){
                    if (item.needBuyFlag) {
                        showToast("请先购买专辑!");
                    } else {
                        if(item.id !== vm.currentAudio.id || (item.id == vm.currentAudio.id && (vm.playVersion != versionIndex) && (itemIndex === ""))){
                            vm.playVersion = versionIndex;
                            vm.currentAudio = item;
                            vm.selectedIndex = itemIndex;
                            if (!vm.selectedIndex && vm.selectedIndex == '') {
                                for(var i=0;i<vm.menuList.length;i++){
                                    if(vm.menuList[i].id == item.id){
                                        vm.selectedIndex = i;
                                        break;
                                    }
                                }
                            }
                            if(mainSign){
                                if(!isBottomMenu){
                                    vm.menuList = vm.guessAudios;
                                    cacheData();
                                    vm.length = vm.menuList.length;
                                }
                            }
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                } else {
                    myApp.showIndicator();
                    inPlayer(vm.currentAudio.id,1);
                }
            }
        },
        toAlbumDetail:function (albumId,freeGetSign) {
            myApp.showIndicator();
            inAlbumDetail(albumId,freeGetSign);
        },
        searchBtn:function () {
            myApp.closeModal(".popup");
            myApp.showIndicator();
            vm.keyword = $$("#input-search-story").val();
            inSearch(encodeURI($$("#input-search-story").val()),1,0);
            inputBlur();
            setHistoryList(vm.keyword);
        },
        formatTime:function (seconds) {
            var timestr = "";
            var minutes = parseInt(seconds / 60).toString();
            // if(minutes.length==1) minutes = "0"+minutes;
            var seconds = String(parseInt(seconds) % 60);
            if(seconds.length==1) seconds = "0"+seconds;
            timestr = minutes+":"+seconds;
            return timestr;
        },
        showMenu: function(event) {
            event.stopPropagation();
            upMenu();
        },
        hideMenu: function(event) {//隐藏播放列表hideaudioList
            event.preventDefault();
            downMenu();
        },
        pauseOrPlay: function(event) {//暂停、播放按钮事件
            event.stopPropagation();
            if(isPlay) {
                stopAudio();
            } else {
                playAudio(1);
            }
        },
        showMenu: function(event) {
            event.stopPropagation();
            upMenu();
        },
        hideMenu: function(event) {//隐藏播放列表hideaudioList
            event.preventDefault();
            downMenu();
        },
        changeCircle: function(event) {
            event.stopPropagation();
            unifyCircle(true);
        },
        toTop:function (event) {
            event.stopPropagation();
            $$('.page-content').scrollTop(0,1000);
        },
        scanOneScan:function () {
            myApp.showIndicator();
            inScan();
        },
        popupShow:function () {
            inputFocus();
        },
        tipJump:function (item) {
            myApp.closeModal(".popup");
            myApp.showIndicator();
            vm.keyword = item;
            inSearch(encodeURI(item),0,0);
            inputBlur();
            setHistoryList(item);
        },
        toPunch:function (isOrNotJoin,num) {
            if(isOrNotJoin){
                inStoryPunch(num);
            }else {
                joinActivity();
            }
        },
        popoverModal:function () {
            if(vm.taskId == 0){
                $$(".invivationHan").show();
                toCenterAndUpModal();
            }else {
                closeSuccModal();
                punchStatus(true);
            }
        },
        closePunchModal:function () {
            vm.showed = false;
            punchStatus();
        },
        inSuperStory:function (id) {
            inSuperStory(id);
        },
        toTeachDetail:function (item) {
            inTeachDetail(item.teacherId);
        },
        changeData:function () {
            guessLikeAudio();
        },
        sourceEvent:function (goodsId) {
            if(goodsId>0){
                location.href = "https://www.dayutang.cn/shopOrder/goodDetails.html?goodId=" + goodsId;
            }else {
                showToast("配套绘本已售罄!");
            }
        }
    },
    watch:{
        adImgs:function () {
            bannerSet();
        },
        albumList:function () {
            setSwiper();
            //触发懒加载
            $$('img.lazy').trigger('lazy');
        },
        studyTime:function () {
            if(!punchSuccessSign){
                if(parseInt(vm.studyTime/60)>=10){
                    punchSuccessSign = true;
                }else {
                    vm.restPunchTime = 10 - parseInt(vm.studyTime/60);
                }
            }

        },
        punchStatus:function () {
            if(vm.punchStatus){
                $$(".punchBtn-content").addClass("iconfont");
                $$(".punchBtn-content").html("&#xe650;");
                $$(".punchBtn-content").css("top","31px");
                $$(".punchBtn-content").css("fontSize","20px");
                $$(".punchBtn-content").css("right","13px");
                // closeSuccModal();
                // if(storyPunchSign){
                //     if(sessionStorage.isEntryPage == 1){}else {
                //         storyPunch_vm.punchStatus = true;
                //         if(localStorage.getItem("ydyStorytimestamp")==thisToday){
                //             $$(".modal-overlay").css("background",'rgba(0, 0, 0, 0.8)');
                //             punchStatusModal('今日打卡成功',ydyPunchCredits,'将打卡主页分享到朋友圈可额外获得'+ydyShareCredits+'颗魔法石哦',1);
                //             //localStorage.firstShowCompleteModal = true;
                //         }
                //     }
                // }
                // punchStatus();
            }
        },
        albumList:function () {
            var mySwiperAlbum = myApp.swiper('.swiper-album', {
                spaceBetween: 20,
                slidesPerView: 1.1,
                animation: true,
                loop:true
            });
        },
        ips:function () {
            var mySwiperSuper = myApp.swiper('.swiper-superStory', {
                slidesPerView: 3.4,
                spaceBetween: 10,
                slidesOffsetBefore: 18,
                slidesOffsetAfter:18
            });
        },
        audios:function () {
            var mySwiperToday = myApp.swiper('.swiper-dayStory', {
                pagination: '.swiper-dayStory .swiper-pagination',
                slidesPerView: 1.11,
                centeredSlides:true,
                slidesOffsetAfter:18,
                spaceBetween: 10,
                loop: true,
                autoplay: 5000,
                loopedSlides:8
            })
        },
        recommendTeacherList:function () {
            var mySwiperTeach = myApp.swiper('.swiper-teachers', {
                slidesPerView: 3.4,
                spaceBetween: 10,
                slidesOffsetBefore: 18,
                slidesOffsetAfter:18
            });
        }
    }

});

init();
function init() {
    storyGetDictDataListByCodeFun();
}

function storyGetDictDataListByCodeFun() {
    request("Common","getDictDataListByCode",{"dictCode":"StoryBeginningSwitch"},function (data) {
        if(data.code==0){
            if(data.list.length>0){
                kouboBeginDuan=data.list[0].value.split("-");
            }else{
                kouboBeginDuan = [0,0];
            }
            getAd();
            isEntryPage();
            unifyCircle(false);
            backTop();
            setKeywords();
            punchStatus();
            //punchModalShowHide();
            storeCredits();
            getIPList();
            getRecommendTeacherList();
            guessLikeAudio();
            getAlbumList(1);
            getAlbumList(2);
            getAlbumList(3);
        }
    })
}

// input获取焦点样式
function inputFocus() {
    $$("input.iconfont").css("width",'83%');
    $$("input.iconfont").css("marginLeft",'0');
    $$("input.iconfont").focus();
    $$("input.iconfont").css("text-align","left");
    $$("input.iconfont").css("background","#ffffff");
    $$("input.iconfont").css("color","#000");
    $$("input.iconfont").attr("placeholder","");
    $("input.iconfont").removeClass("iconfont");
    $$(".searchbar-input").css("paddingLeft","60px");
    $$(".searchbar-icon").css("left","70px");
    // $$(".mainScanImg").show();
    $$(".search-placeholder").hide();
    $$(".searchbar-icon").show();
    $$(".searchbar-txt").show();
    $$(".searchbar-txt").css("right","70px");
    $$("#main .searchbar-overlay").show();
    $$("#main .searchbar-overlay").css("opacity","1");
    $$("#main .searchbar-overlay").css("pointer-events","auto");
    $$(".searchbar").css("background","#60D67D");
    $$(".searchbar").css("paddingLeft","0px");
    $$(".scan-btn").css("color","white");
    $$("#main .page-content").css({"overflow": "hidden"});
}

// //初始化日期来判断打卡弹窗的显示与隐藏
// function punchModalShowHide() {
//     if(thisToday != localStorage.thisToday){
//         localStorage.thisToday = thisToday;
//         localStorage.punchModalShowSign = false;
//         localStorage.firstShowCompleteModal = 'undefined';
//     }
// }

// input失去焦点
function inputBlur() {
    // $$("input#input-search-story").css("text-align","center");
    $$("input#input-search-story").css("background","#F2F2F2");
    $$(".searchbar-icon").hide();
    $$(".searchbar-txt").hide();
    $$("#main .searchbar-overlay").hide();
    // $$(".mainScanImg").hide();
    $$(".search-placeholder").show();
    $$(".searchbar-input").css("paddingLeft","0px");
    $$("#main .searchbar-overlay").css("opacity","0");
    $$("input#input-search-story").addClass("iconfont");
    $$(".searchbar").css("background","#fff");
    $$(".searchbar").css("paddingLeft","8px");
    $$("#main .page-content").css({"overflow": "auto"});
    $$(".scan-btn").css("color","#999");
    $$("#input-search-story").blur();
    $$("#input-search-story").val("");
    $$(".searchbar-input").css("paddingLeft","8px");
    $$("input.iconfont").css("width",'70%');
    $$("input.iconfont").css("marginLeft",'15%');
}

//打卡状态弹框
function punchStatusModal(statusMainInfo,magicStoreNum,statusDes, num) {
    var str = '<div class="punchModal" v-show="punchMainModalShow">';
    str += '<div class="punch-success">';
    if(num==3){
        str += '<img class="punch-success-bgImg" src="img/bgLight.png" alt="">';
        str += '<div class="punch-Goldnum "> ';
        str += '<img src="img/mofashi.png" class="mofashi" /> <span class="punch-plus">+</span> <span class="punch-storeNum">'+magicStoreNum+'</span></div>';
        str += '<p class="bottom-des">'+statusDes+'</p>';
        str += '<div class="punch-success-close iconfont" onclick="closePunchModal()">&#xe66f;</div>';
    }else if(num==2){
        str += '<img class="punch-success-bgImg" src="img/bgLight.png" alt="">';
        str += '<div class="punch-Goldnum punch-Goldnum2"> ';
        str += '<img src="img/mofashi.png" class="mofashi" /> <span class="punch-plus">+</span> <span class="punch-storeNum">'+magicStoreNum+'</span></div>';
        str += '<p class="bottom-des">'+statusDes+'</p>';
        str += '<p class="bottom-des bottom-des2">今日打卡奖励</p>';
        str += '<div class="punch-success-bottomBtn punch-success-bottomBtn2" onclick="toIndexYdy()">去听故事</div>';
        str += '<div class="punch-success-close punch-success-close2  iconfont" onclick="closePunchModal()">&#xe66f;</div>';
    }else if(num==1){
        str += '<div class="punch-Goldnum punch-Goldnum2">';
        str += '<img src="img/sharePenyou.png" style="width: 65px;margin-bottom: 10px;" class="mofashi" /></div>';
        str += '<p class="bottom-des">'+statusDes+'</p>';
        str += '<p class="bottom-des bottom-des2" style="font-size: 20px;">分享打卡主页至朋友圈</p>';
        str += '<p class="bottom-des bottom-des2" style="font-size: 20px;">即可完成今日打卡</p>';
        str += '<div class="punch-success-bottomBtn punch-success-bottomBtn2" style="background: #FF554E; color: #fff;" onclick="nowShare2()">分享打卡主页</div>';
        str += '<div class="punch-success-close punch-success-close2  iconfont" onclick="closePunchModal()">&#xe66f;</div>';
    }else if(num==4){
        str += '<img class="punch-success-bgImg" src="img/bgLight.png" alt="">';
        str += '<div class="punch-Goldnum punch-Goldnum2"> ';
        str += '<img src="img/mofashi.png" class="mofashi" /> <span class="punch-plus">+</span> <span class="punch-storeNum">'+magicStoreNum+'</span></div>';
        str += '<p class="bottom-des">'+statusDes+'</p>';
        str += '<p class="bottom-des bottom-des2">今日打卡奖励</p>';
        str += '<div class="punch-success-close punch-success-close2  iconfont" onclick="closePunchModal()">&#xe66f;</div>';
    }



    str += '<div class="cal-content-topInfo">' ;
    str += '<div class="left-topInfo"><img src="img/caiDai_left.png" alt=""></div>';
    str += '<div class="yuanzai-topInfo"><img src="img/yuanzai_calImg1.png" alt=""><img src="img/yuanzai_calImg2.png" alt="" class="yuanzai_calImg2"></div>';
    str += '<div class="right-topInfo" ><img src="img/caiDai_right.png" alt=""></div>';
    str += '<p class="punchDay-tip"><span>'+statusMainInfo+'</span><span class="bottomLine-topInfo"></span></p></div>';
    str += '</div></div>';

    // var punchStatusModal = myApp.modal({
    //     title:str
    // });
    if($(".punchModal").length>0){
        $(".punchModal").remove();
    }
    $("body").append(str)
    // if(storyPunchSign){
    //     storyPunch_vm.storyPunchModal();
    // }
}

//点击小鸡的动作
function clickLittleChick() {
    var ydyNumber = ydyPunchCredits;
    if(vm.seventhDay){
        vm.punchCredits = ydyPunchCredits;
        ydyNumber = ydyPunchCredits * 4;
    }
    if(vm.punchStatus){
        if(vm.punchStatusNum == 2){
            popoverModalFunc($$('.bofangImg'),'完成今日打卡并完成学习任务！<br/>超级赞～获得魔法石 <span class="iconfont" style="font-weight: 100 !important;vertical-align: middle">&#xe61f;</span> +'+ (parseInt(ydyNumber)+parseInt(ydyShareCredits)),'',false);
        }else {
            popoverModalFunc($$('.bofangImg'),'打卡成功！你还有 3 颗魔法石待领取<br>听完任意故事即可抱走哦～',"",true);
        }
    }else {
        punchStatusModal('打卡领取奖励',ydyPunchCredits,'今日打卡奖励魔法石<span style="color: #D98700" class="iconfont">&#xe61f;</span>+'+ydyNumber,1);
    }
    resetYZModalPosition();
}

// function refreshPopover() {
//     if($$(".modal-overlay").length<1){
//         return;
//     }
//     if(vm.punchStatus){
//         $$(".punchBtn-content").html("&#xe650;");
//         if(vm.seventhDay){
//             vm.punchCredits = ydyPunchCredits;
//         }
//         if(vm.alreadyShare){
//             $$(".punch-status-des").html('完成今日打卡并分享成功！<br/>超级赞～获得魔法石 <span class="iconfont" style="font-weight: 100 !important;vertical-align: middle">&#xe61f;</span> +'+ (parseInt(ydyPunchCredits)+parseInt(ydyShareCredits)));
//             $$(".extra-getStores").html("");
//         }else {
//             $$(".punch-status-des").html('完成今日打卡！获得 <span class="iconfont" style="font-weight: 100 !important;vertical-align: middle">&#xe61f;</span> +'+ydyPunchCredits);
//             $$(".extra-getStores").html('还想额外获得 '+ydyShareCredits+' 颗魔法石？ >');
//         }
//     }else {
//         $$(".punchBtn-content").html("打卡");
//         if(playerSign){
//             if(isPlay){
//                 $$(".punch-status-des").html('故事正在播放中.....<br/>再听'+vm.restPunchTime+'分钟即可完成今日打卡哦~');
//                 $$(".extra-getStores").html("");
//             }else {
//                 $$(".punch-status-des").html('故事已暂停播放.....<br/>再听'+vm.restPunchTime+'分钟即可完成今日打卡哦~');
//                 $$(".extra-getStores").html("");
//             }
//         }else {
//             if(isPlay){
//                 $$(".punch-status-des").html('后台正在播放中.....<br/>再听'+vm.restPunchTime+'分钟即可完成今日打卡哦~');
//                 $$(".extra-getStores").html("");
//             }else {
//                 $$(".punch-status-des").html('故事已暂停播放.....<br/>再听'+vm.restPunchTime+'分钟即可完成今日打卡哦~');
//                 $$(".extra-getStores").html("");
//             }
//         }
//
//     }
// }

// 点击圆仔弹框位置重置
function resetYZModalPosition() {
    //$$(".floating-button").css("opacity","0");
    if(playerSign){//播放页
        $$(".popover-about").css("top","auto");
        $$(".popover-about").css("bottom","245px");
        $$(".popover-about").css("left","35px");
    }else{ //其他页
        //$$(".floating-button").css("opacity","0");
        $$(".popover-about").css("top","auto");
        $$(".popover-about").css("bottom","155px");
        $$(".popover-about").css("left","20px");
    }
}


function setKeywords() {
    namesStorage = localStorage['shopNames'];
    if(namesStorage!=null && namesStorage!=''){
        names = JSON.parse(localStorage.shopNames);
        vm.recommendKeywords = names;
        if(names.length>5){
            vm.recommendKeywords = names.slice(0,5);
        }
    }else{
        localStorage.shopNames = "[]";
    }
}

//是否直接进入子页面
function isEntryPage() {
    var s = window.location.href;
    var re = new RegExp(".html","g");
    var arr = s.match(re);
    var num = arr.length;
    if (num === 2) {
        sessionStorage.setItem("isEntryPage",1);
        isPlay = false;
    }else if(num == 1){
        sessionStorage.setItem("isMain",1);
    }
}

//判断是否是第一次进入听故事
function isEntryStory() {
    if(localStorage.firstEntryStory == undefined){
        if(vm.taskId==0){
            $$(".invivationHan").show();
            toCenterAndUpModal();
        }
        localStorage.firstEntryStory = false;
    }
}

function setHistoryList(keyword){//存储历史搜索记录
    if (decodeURI(keyword).trim()) {
        names.unshift(decodeURI(keyword));
        names = names.unique();
        if(names.length >10){
            names = names.slice(0,5);
        }
        localStorage['shopNames'] = JSON.stringify(names);
    }
}

function bannerSet() {
    var mySwiper1 = myApp.swiper('.swiper-1', {
        pagination: '.swiper-1 .swiper-pagination-main',
        paginationClickable: true,
        autoplayDisableOnInteraction : false,
        // direction: 'horizontal',
        loop: true,
        autoplay: 3000,
        // slidesOffsetBefore: 18,
        // slidesOffsetAfter:18,
        slidesPerView: 1.1,
        centeredSlides:true,
        spaceBetween: 10,
        observer:true,//修改swiper自己或子元素时，自动初始化swiper
        observeParents:true,//修改swiper的父元素时，自动初始化swiper
        loopedSlides:8
    });

    $(".banner-slide").click(function () {
        location.href = $(this).attr("data-url");
    })
}

//获取广告
function getAd(){
    // 故事转盘默认广告
    advert.getAdvertByBanner('TodayStoryDefault',function(data){
        if (data.code == 0) {
            vm.ydy_ZhuanPanadImgs = data.adverts;
        }
    });

    // 获取首页banner
    advert.getAdvertByBanner('Story-1',function(data){
        if (data.code == 0) {
            vm.adImgs = data.adverts;
        }
    });

    if(sessionStorage.koubo && sessionStorage.beforeAd && sessionStorage.afterAd){
        vm.koubo = JSON.parse(sessionStorage.koubo);
        vm.beforeAd = JSON.parse(sessionStorage.beforeAd);
        vm.afterAd = JSON.parse(sessionStorage.afterAd);

        vm.kbPlayTime = vm.koubo.audioPlayTime;
        vm.preAdPlayTime = vm.beforeAd.audioPlayTime;
        vm.nextAdPlayTime = vm.afterAd.audioPlayTime;
        vm.allAdTime = vm.kbPlayTime + vm.preAdPlayTime + vm.nextAdPlayTime;
        getTodayAudio();
        addAudioListener();
    }else {
        // 获取口播
        advert.getAdvertByBanner('StoryBeginning',function(data){
            if (data.code == 0) {
                if(data.adverts[0] && data.adverts[0].audioPlayTime>0){
                    vm.koubo = data.adverts[0];
                    vm.kbPlayTime = vm.koubo.audioPlayTime;
                    sessionStorage.koubo = JSON.stringify(vm.koubo);
                }
            }
            getBeforeAdvert();

        })


    }
}

// 获取IP列表
function getIPList() {
    v2Audio.getIPList(function (data) {
        if(data.code == 0){
            vm.ips = data.ips;
        }else {
            console.log(data.msg);
        }
        getTodayAudio();
    })
}

// 获取今日故事
function getTodayAudio() {
    var param = {userId:userID};
    v2Audio.getTodayAudio(param,function (data) {
        if(data.code == 0){
            vm.audios = data.audios;
            vm.todayStory = data.todayStory;
            sessionStorage.storyMainImg = vm.audios[0].smallImg;
            if(localStorage.currentAudio && localStorage.menuList && !scrolldata && !(JSON.parse(localStorage.currentAudio).needBuyFlag)){
                hasStorage = true;
                vm.currentAudio = JSON.parse(localStorage.currentAudio);
                vm.playVersion = parseInt(localStorage.playVersion);
                vm.selectedIndex = parseInt(localStorage.selectedIndex);
                vm.menuList = JSON.parse(localStorage.menuList);
                vm.length = vm.menuList.length;
                var curTime = vm.currentAudio.versions[vm.playVersion].currentTime;
                if(curTime == 0 || vm.currentAudio.finishStatus == 1){
                    vm.allCurrentTime = 0;
                }else if(curTime>0){
                    if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
                        vm.allCurrentTime = vm.kbPlayTime + vm.preAdPlayTime + curTime;
                    }else {
                        vm.allCurrentTime = vm.preAdPlayTime + curTime;
                    }
                }
                ww = vm.allCurrentTime / (vm.currentAudio.versions[vm.playVersion].playTime + vm.allAdTime) * $$("#bofangtiao").width();
                $("#bofangtiaoLine").width(ww);
                judgePosition();
            }else {
                vm.menuList = vm.audios;
                vm.length = vm.menuList.length;
                if(!vm.sign){
                    if(!localStorage.currentAudio){
                        vm.currentAudio = data.audios[0];
                        vm.sign = true;
                    }else {
                        vm.currentAudio = JSON.parse(localStorage.currentAudio);
                    }
                }

                if(!isPlay && sessionStorage.isEntryPage != 1){
                    initAudio();
                }
            }
            cacheData();
        }else {
            console.log(data.msg);
        }
        onWXReady();
    })
}

// 获取推荐老师
function getRecommendTeacherList() {
    v2Audio.getRecommendTeacherList(function (data) {
        if(data.code == 0){
            vm.recommendTeacherList = data.recommendTeacherList;
        }else {
            console.log(data.msg);
        }
    });
}

// 猜你喜欢
function guessLikeAudio() {
    var param = {userId:userID};
    v2Audio.guessLikeAudio(param,function (data) {
        if(data.code == 0){
            vm.guessAudios = data.audios;
        }else {
            console.log(data.msg);
        }
    })
}

// 获取专辑列表
function getAlbumList(type) {
    audioClass.getAlbumList(userID,vm.albumNum,vm.page,type,function (data) {
        if(data.code == 0){
            if(type == 1){
                vm.freeAlbums = data.albums;
            }else if(type == 2){
                vm.payAlbums = data.albums;
            }else if(type == 3){
                vm.jxAlbums = data.albums;
            }
        }else {
            console.log(data.msg);
        }
    })
}

function getBeforeAdvert() {
    // 获取音频前广告
    advert.getAdvertByBanner('AdBeforeStory',function(data){
        if (data.code == 0) {
            if(data.adverts[0] && data.adverts[0].audioPlayTime>0){
                vm.beforeAd = data.adverts[0];
                vm.preAdPlayTime = vm.beforeAd.audioPlayTime;
                sessionStorage.beforeAd = JSON.stringify(vm.beforeAd);
            }
        }
        getAfterAdvert();
    })
}

function getAfterAdvert() {
    // 获取音频后广告
    advert.getAdvertByBanner('AdAfterStory',function(data){
        if (data.code == 0) {
            if(data.adverts[0] && data.adverts[0].audioPlayTime>0){
                vm.afterAd = data.adverts[0];
                vm.nextAdPlayTime = vm.afterAd.audioPlayTime;
                sessionStorage.afterAd = JSON.stringify(vm.afterAd);
            }
        }
        if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
            vm.allAdTime = vm.kbPlayTime + vm.preAdPlayTime + vm.nextAdPlayTime;
        }else{
            vm.allAdTime = vm.preAdPlayTime + vm.nextAdPlayTime;
        }
        getTodayAudio();
        addAudioListener();
    })
}

//用户是否参与打卡
function joinActivity() {
    v2AudioPunch.joinActivity(userID,function (data) {
        if(data.code == 0){
            vm.taskId = data.taskId;
            localStorage.firstJoinPunchActivity = true;
            vm.joinPunch = true;
            inStoryPunch(0);
        }else {
            showToast(data.msg);
        }
    })
}

// 获取用户打卡状态
function punchStatus(clickLittleChickSign) {
    V2AudioNew.punchStatus(userID,function (data) {
        if(data.code == 0){
            vm.punchStatus = data.punchStatus >= 1?true:false;
            if(data.punchStatus==2){
                $(".punchBtn_red").hide();
            }
            vm.punchStatusNum = data.punchStatus;

            vm.punchTotalumber = data.punchTotalumber;
            if(parseInt(vm.punchTotalumber)<=20000){
                vm.punchTotalumber = parseInt(10000+parseInt(vm.punchTotalumber)/2);
            }
            vm.continuePunchDay = data.continuePunchDay;
            vm.alreadyShare = data.alreadyShare;
            vm.taskId = data.taskId;
            vm.seventhDay = data.seventhDay;
            if(vm.seventhDay){
                vm.punchCredits = ydyPunchCredits ;
            }
            if(vm.taskId>0){
                //goPunch(vm.taskId);
                if(vm.punchStatus==false){
                    getpushStatus();//每天只弹一次的提示打卡分享
                }
            }else {
                isEntryStory();
            }
            vm.joinPunch = vm.taskId>0?true:false;
            if(vm.punchStatus){
                $$(".punchBtn-content").html("&#xe650;");
            }
            if(clickLittleChickSign){
                clickLittleChick();
            }
        }else {
            showToast(data.msg);
        }
    })
}

//打卡
// var goPunchDataTimes = 0;
// function goPunch(taskId) {
//     var goPunchData = JSON.parse(sessionStorage.getItem("handleGoPunchData"));
//
//     //十分钟缓存
//     if(goPunchData && goPunchData!=null &&  goPunchData.studyTime < 570 && goPunchDataTimes > 0 && goPunchDataTimes < 4){
//         goPunchData.studyTime = goPunchData.studyTime + 10;
//         sessionStorage.setItem("handleGoPunchData",JSON.stringify(goPunchData));
//         handleGoPunchData(goPunchData);
//         goPunchDataTimes ++;
//     }else{
//
//         // v2AudioPunch.shareCredits(userID,function (data) {
//         //     if(data.code == 0){
//         //         storyPunch_vm.storyPunchModal();
//         //     }else {
//         //         showToast(data.msg);
//         //     }
//         // })
//     }
//
// }
//处理打卡数据
function handleGoPunchData(data){
    if(data.code == 0){
        vm.punchStatus = data.punchStatus== 1?true:false;
        if(playerSign){
            player_vm.punchStatus = vm.punchStatus;
        }
        vm.studyTime = data.studyTime;
        vm.restPunchTime = vm.totalPunchTime - parseInt(vm.studyTime/60);
        if(storyPunchSign){
            storyPunch_vm.studyTime = data.studyTime;
            storyPunch_vm.punchStatus = vm.punchStatus;
        }
        //refreshPopover();
    }else {
        showToast(data.msg);
    }

    sessionStorage.setItem("handleGoPunchData",JSON.stringify(data));

}

//记录用户学习记录
var studyRecordBool = false;
function studyRecord(audioId,flag,oBool) {//oBool主要是用来判断切换音频的时候 来判断用哪种学习上报的方式
    if(studyRecordBool){
        return;
    }else{
        studyRecordBool=true;
    }

    var bower = browserRedirect();
    var network = getNetworkType();
    var timestamp = new Date().getTime();
    var currentHour = new Date().getHours();
    var currentMinute = new Date().getMinutes();
    if(currentHour == 0 && currentMinute<10){
        vm.punchStatus = false;
    }
    if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
        var beforeTime = vm.kbPlayTime + vm.preAdPlayTime;
    }else{
        var beforeTime = vm.preAdPlayTime;
    }
    var currentAudioTime = vm.currentAudio.versions[vm.playVersion].playTime;
    var lastPlayTime = 0;
    var audioType = '';
    console.log(oBool);
    if(oBool == undefined || oBool){//相当于 每次接着上一次的时间来进行上报
        lastPlayTime = parseInt(vm.allCurrentTime) - beforeTime;
        if(parseInt(vm.allCurrentTime) - beforeTime < 0){
            lastPlayTime = 0;
        }else if(parseInt(vm.allCurrentTime) - beforeTime - currentAudioTime > 0){
            lastPlayTime = currentAudioTime;
        }
        audioType = vm.currentAudio.versions[vm.playVersion].type;
    }else {//相当于切换音频从音频列表中拿出学习记录
        // 循环列表 拿出currentTime
        for(var i=0;i<vm.menuList.length;i++){
            if(vm.menuList[i].id == audioId){
                lastPlayTime = vm.menuList[i].versions[preAudioVersionIndex].currentTime;
                audioType = vm.menuList[i].versions[preAudioVersionIndex].type;
                break;
            }
        }
    }

    if(lastPlayTime > (currentAudioTime -12) && localStorage.getItem("ydyStorytimesPushFen") != thisToday){
        localStorage.setItem("ydyStorytimesPushFen",thisToday);
        V2AudioNew.storyComplete({"userId":userID,"taskId":vm.taskId},function (data) {
            if(data.code == 0 && data.storyCredits!=0){
                vm.punchStatusNum = 2;
                $(".punchBtn_red").hide();
                punchStatusModal('听完故事啦',data.storyCredits,'每连续打卡第7天还可以获得 4倍奖励（24颗魔法石）哦！',3);
            }
        });
    }

    v2Audio.studyRecord(userID,audioId,timestamp,"wx",network,vm.studyRecordId,lastPlayTime,audioType,currentAudioTime,function (data) {
        studyRecordBool = false;
        if(data.code == 0){

            if(flag){
                vm.studyRecordId = data.studyRecordId;
                // cacheData();
            }
            vm.currentAudio.versions[vm.playVersion].currentTime = 0;
            if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]){
                if(vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime > 0){
                    vm.currentAudio.versions[vm.playVersion].currentTime = parseInt(vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime);
                }
            }else{
                if(vm.allCurrentTime  - vm.preAdPlayTime > 0){
                    vm.currentAudio.versions[vm.playVersion].currentTime = parseInt(vm.allCurrentTime - vm.preAdPlayTime);
                }
            }
            cacheData();
        }

    })
}

//缓存数据
function cacheData() {
    localStorage.currentAudio = JSON.stringify(vm.currentAudio);
    localStorage.playVersion = JSON.stringify(vm.playVersion);
    localStorage.selectedIndex = JSON.stringify(vm.selectedIndex);
    localStorage.menuList = JSON.stringify(vm.menuList);
}

//判断缓存音频位置
function judgePosition() {
    if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
        if (vm.allCurrentTime < vm.kbPlayTime) {
            vm.isPlayingIndex = 0;
            setSrc(vm.koubo);
            audio.currentTime = vm.allCurrentTime;
        } else if (vm.allCurrentTime < (vm.kbPlayTime + vm.preAdPlayTime)) {
            vm.isPlayingIndex = 1;
            setSrc(vm.beforeAd);
            audio.currentTime = vm.allCurrentTime - vm.kbPlayTime;
        } else if (vm.allCurrentTime < (vm.kbPlayTime + vm.preAdPlayTime + vm.currentAudio.versions[vm.playVersion].playTime)) {
            vm.isPlayingIndex = 2;
            setSrc(vm.currentAudio.versions[vm.playVersion]);
            audio.currentTime = vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime;
        } else {
            vm.isPlayingIndex = 3;
            setSrc(vm.afterAd);
            audio.currentTime = vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime - vm.currentAudio.versions[vm.playVersion].playTime;
        }
    }else{
        if (vm.allCurrentTime < ( vm.preAdPlayTime)) {
            vm.isPlayingIndex = 1;
            setSrc(vm.beforeAd);
            audio.currentTime = vm.allCurrentTime;
        } else if (vm.allCurrentTime < (vm.preAdPlayTime + vm.currentAudio.versions[vm.playVersion].playTime)) {
            vm.isPlayingIndex = 2;
            setSrc(vm.currentAudio.versions[vm.playVersion]);
            audio.currentTime = vm.allCurrentTime - vm.preAdPlayTime;
        } else {
            vm.isPlayingIndex = 3;
            setSrc(vm.afterAd);
            audio.currentTime = vm.allCurrentTime - vm.preAdPlayTime - vm.currentAudio.versions[vm.playVersion].playTime;
        }
    }
    addTimeFuc();
}


//弹出菜单
function upMenu() {
    $$(".audioList").show();
    $$(".audioListContent").css("height",(vm.menuList.length * 50) +'px');
    $$(".oneList").css("bottom",(vm.menuList.length * 50) +'px');
    if (vm.menuList.length>5){
        $$(".audioListContent").css("height",'250px');
        $$(".oneList").css("bottom",'250px');
    }
    $(".upMenu").animate({
        bottom:0
    },500);
    $$("html,body").css({"height":"100%", "overflow":"hidden"});
}
//隐藏菜单
function downMenu() {
    $(".upMenu").animate({
        bottom:-300
    },300);
    setTimeout(function(){
        $$(".audioList").hide();
    },200);
}

//添加音频事件
function addAudioListener() {
    audio.addEventListener("timeupdate", function(event) {
        duration = 0;
        var bufferWw;
        if(audio.duration === Infinity){
            duration = vm.currentAudio.versions[vm.playVersion].playTime + vm.allAdTime;
        }else{
            duration = vm.currentAudio.versions[vm.playVersion].playTime + vm.allAdTime;
        }

        if(playerSign) {
            if (isControl) return;
            player_vm.allCurrentTime = player_vm.addTime + audio.currentTime;
            vm.addTime = player_vm.addTime;
            vm.allCurrentTime = player_vm.allCurrentTime;
            ww = player_vm.allCurrentTime / duration * ($("#bar").width() - 10);
            $("#circle").css("left", ww);
            $("#process").width(ww);
            if(vm.isPlayingIndex == 2){
                // 获取以缓存的时间
                if(audio.src){
                    // 获取已缓冲部分的 TimeRanges 对象
                    timeRages = audio.buffered;
                    if(timeRages.length>0){
                        timeBuffered = timeRages.end(timeRages.length - 1);
                        // 获取缓存进度，值为0到1
                        var bufferPercent = timeBuffered / audio.duration;
                    }
                }
                bufferWw = bufferPercent * ($("#bar").width());
                $("#bufferLine").width(bufferWw);
            }
            // player_vm.allCurrentTime = timeCountDown.formatTime(audio.currentTime);
            $("#timecurrent").text(player_vm.formatTime(player_vm.allCurrentTime));//上面那句快速切换会导致页面值不刷新
            if (player_vm.currentAudio.versions[player_vm.playVersion + 1]) {
                switch(player_vm.playVersion + 1)
                {
                    case 0:
                        player_vm.nextVersionTipName = "双语";
                        break;
                    case 1:
                        player_vm.nextVersionTipName = "纯英";
                        break;
                    default:
                        player_vm.nextVersionTipName = "中文";
                }
                showNextVersion = player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime - 5;
                if (parseInt(player_vm.allCurrentTime) === parseInt(showNextVersion)) {
                    player_vm.nextVersionTipShow = true;
                }
            }
        }else{
            vm.allCurrentTime = vm.addTime + audio.currentTime;
            if(playerSign){
                player_vm.addTime = vm.addTime;
            }
            ww = vm.allCurrentTime / duration * $$("#bofangtiao").width();
            $("#bofangtiaoLine").width(ww);
            // bufferWw = bufferPercent * ($$("#bofangtiao").width());
            // $("#bofangtiaoBuffer").width(bufferWw);
        }
    });
    audio.addEventListener("loadeddata", function(event) {
        if(playerSign){//代表当前在播放页面
            player_vm.currentAudio = vm.currentAudio;
            if(isPlay){
                $(".swiper-slide-active .box").addClass("cover_img");
                $(".rotateImg").addClass("cover_img");
            }
            // if(player_vm.currentAudio.versions[player_vm.playVersion].currentTime > 0){
            //     player_vm.allCurrentTime = player_vm.currentAudio.versions[player_vm.playVersion].currentTime + player_vm.addTime;
            // }

            //audio.currentTime = currentTime_ ;     //兼容iPhone多个音频不能快进
        } else if(scanSign){//在扫描页面
            scanVm.currentAudio = vm.currentAudio;
        }else if(albumDetailSign){//专辑列表页
            albumDetail_vm.currentAudio = vm.currentAudio;
            albumDetail_vm.playVersion = vm.playVersion;
        }else if(interfSign){//最近收听
            myFavorite_vm.currentAudio = vm.currentAudio;
        }else if(teachDetailSign){
            teachDetail_vm.currentAudio = vm.currentAudio;
        }else {
            if(vm.currentAudio.versions[vm.playVersion].currentTime > 0){
                vm.allCurrentTime = vm.currentAudio.versions[vm.playVersion].currentTime;
            }else {
                vm.allCurrentTime = 0;
            }
        }
    });
    audio.addEventListener("ended", function(event){
        vm.isPlayingIndex ++;
        judgeOverAudio();//// 判断在第几个音频结束
        setDataByIndex();////根据index给音频赋值
        addTimeFuc();//音频播放结束后设置添加时间
    })
    audio.addEventListener("error", function() {
        // audio.src = vm.currentAudio.versions[0].audioPath;
        // audio.play();
    }, true)
}

// 判断在第几个音频结束
function judgeOverAudio() {
    if(vm.afterAd){
        if(vm.isPlayingIndex == 4){
            playAudioPart();
        }
    }else if(vm.currentAudio){
        if(vm.isPlayingIndex == 3){
            playAudioPart();
        }
    }else if(vm.beforeAd){
        if(vm.isPlayingIndex == 2){
            playAudioPart();
        }
    }else{
        if(vm.isPlayingIndex == 1){
            playAudioPart();
        }
    }
}

//根据index给音频赋值
function setDataByIndex() {
    if(!vm.beforeAd){
        if(vm.isPlayingIndex == 1){
            vm.isPlayingIndex++;
        }
    }
    if(!vm.currentAudio){
        if(vm.isPlayingIndex == 2){
            vm.isPlayingIndex++;
        }
    }
    if(!vm.afterAd){
        if(vm.isPlayingIndex == 3){
            vm.isPlayingIndex = 0;
            playAudioPart();
        }
    }
    switch(vm.isPlayingIndex){
        case 0:
            if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
                setSrc(vm.koubo);
            }
            break;
        case 1:
            setSrc(vm.beforeAd);
            break;
        case 2:
            setSrc(vm.currentAudio.versions[vm.playVersion]);
            break;
        case 3:
            setSrc(vm.afterAd);
            break;
    }
}

//音频播放结束后设置添加时间
function addTimeFuc() {
    if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
        if (vm.isPlayingIndex == 1) {
            vm.addTime = vm.kbPlayTime;
            if (playerSign) {
                player_vm.addTime = vm.kbPlayTime;
            }
        } else if (vm.isPlayingIndex == 2) {
            vm.addTime = vm.kbPlayTime + vm.preAdPlayTime;
            if (playerSign) {
                player_vm.addTime = vm.kbPlayTime + vm.preAdPlayTime;
            }
        } else if (vm.isPlayingIndex == 3) {
            if (playerSign) {
                player_vm.addTime = vm.kbPlayTime + vm.preAdPlayTime + player_vm.currentAudio.versions[vm.playVersion].playTime;
            } else {
                vm.addTime = vm.kbPlayTime + vm.preAdPlayTime + vm.currentAudio.versions[vm.playVersion].playTime;
            }
        }
    }else{
        if (vm.isPlayingIndex == 1) {
            vm.addTime = 0;
            if (playerSign) {
                player_vm.addTime = vm.addTime;
            }
        } else if (vm.isPlayingIndex == 2) {
            vm.addTime = vm.preAdPlayTime;
            if (playerSign) {
                player_vm.addTime =  vm.preAdPlayTime;
            }
        } else if (vm.isPlayingIndex == 3) {
            if (playerSign) {
                player_vm.addTime =  vm.preAdPlayTime + player_vm.currentAudio.versions[vm.playVersion].playTime;
            } else {
                vm.addTime = vm.preAdPlayTime + vm.currentAudio.versions[vm.playVersion].playTime;
            }
        }
    }
}

// 前广告结束播放音频部分
function playAudioPart() {
    if(playerSign){
        if(isPlay){
            if(player_vm.currentAudio.versions[player_vm.playVersion+1]){
                player_vm.playVersion = player_vm.playVersion+1;
                vm.playVersion =  player_vm.playVersion;
            }else {
                if(player_vm.menuList[player_vm.selectedIndex + 1] && player_vm.menuList[player_vm.selectedIndex + 1].needBuyFlag){
                    player_vm.currentAudio = player_vm.menuList[player_vm.selectedIndex];
                    vm.currentAudio = player_vm.currentAudio;
                    stopAudio();
                    BuyTip();
                }else {
                    if(listenStoryNum != 0 && listenStoryNum != ""){
                        if(playerSign){
                            if(listenedNum/listenStoryNum != 1){
                                listenedNum ++;
                                $$('#time').html(listenedNum + "/" + listenStoryNum);
                            }else {
                                stopAudio();
                                $$('#time').html("&#xe632;");
                                listenedNum = 1;
                                listenStoryNum = 0;
                                timeOutSignOver = true;
                                return;
                            }
                        }
                    }
                    if(circle == 2){
                        endChange = true;
                    }else {
                        onceChange = true;
                    }
                    setNextCircle();
                    resetAudio();
                    unifyCollection();
                }
            }
            initAudio();
        }
    }else{
        if(vm.menuList[vm.selectedIndex + 1] &&vm.menuList[vm.selectedIndex + 1].needBuyFlag){
            stopAudio();
        }else {
            if(vm.currentAudio.versions[vm.playVersion+1]){
                vm.playVersion = vm.playVersion+1;
            }else {
                if(circle == 0) {//列表循环
                    if(vm.selectedIndex == vm.menuList.length - 1) {
                        vm.selectedIndex = 0;
                    } else {
                        vm.selectedIndex++;
                    }
                    vm.currentAudio = vm.menuList[vm.selectedIndex];
                } else if(circle == 1) {//随机播放
                    vm.selectedIndex = Math.floor(Math.random() * (vm.menuList.length));
                    vm.currentAudio = vm.menuList[vm.selectedIndex];
                } else {//单曲循环
                    vm.currentAudio = vm.menuList[vm.selectedIndex];
                }
                vm.playVersion = 0;
                for(var i=0;i<vm.menuList.length;i++){
                    if(vm.menuList[i].id == vm.currentAudio.id){
                        vm.currentAudio = vm.menuList[i];
                    }
                }
            }
            vm.allCurrentTime = 0;
            vm.isPlayingIndex = 0;
            vm.addTime = 0;
            duration = 0;
            initAudio();
        }

    }
}

function changeMenuList(arr) {
    arr.sort(function() {
        return (0.5-Math.random());
    })
}

//同步循环模式
function unifyCircle(isChange){
    if(!isChange){
        if(circle == 0) {
            $$(".circleText").text("列表循环");
            $$(".circleImg").html("&#xe67f;");
        } else if(circle == 1) {
            $$(".circleText").text("随机播放");
            $$(".circleImg").html("&#xe633;");
        } else {
            $$(".circleText").text("单曲循环");
            $$(".circleImg").html("&#xe67e;");
        }
    }else{
        if(circle == 0) {
            $$(".circleText").text("随机播放");
            $$(".circleImg").html("&#xe633;");
            circle = 1;
        } else if(circle == 1) {
            $$(".circleText").text("单曲循环");
            $$(".circleImg").html("&#xe67e;");
            circle = 2;
        } else {
            $$(".circleText").text("列表循环");
            $$(".circleImg").html("&#xe67f;");
            circle = 0;
        }
    }
    localStorage.circle = circle;
}

//播放
function playAudio(num){//num只有为1 的时候不是切换音频的时候
    isPlay = true;
    if(timeOutSignOver){
        if(myPicker && myPicker.params.cols[0].activeIndex < 4){
            playAudioPart();
        }
        timeOutSignOver = false;
    }
    if(vm.studyRecordId != 0){
        studyRecord(preAudioId,false,true);//第二个true是后加的学习上报的条件，上报原有的学习id 走的是10秒一上报的逻辑
    }
    if(playerSign){
        $(".bigBtnsStyle").html("&#xe631;");
        $(".swiper-slide-active .box").removeClass("cover_img");
        $(".rotateImg").removeClass("cover_img");
        $(".swiper-slide-active .box").addClass("cover_img");
        $(".rotateImg").addClass("cover_img");
        //resetAdAnimation();
    }else {
        $$(".zan").html("&#xe611;");
    }
    preAudioId = vm.currentAudio.id;
    preAudioVersionIndex = vm.playVersion;
    vm.studyRecordId = 0;
    timeout = false;
    clearTimeout(record);
    if(num == 1){//num只有为1 的时候不是切换音频的时候 是暂停播放的时候 暂停播放的时候不传false
        time();
    }else{
        time(false);//true判断学习上报切换时 上报新的id 的记录
    }

    if(!(localStorage.currentAudio && localStorage.menuList)){
        if(!audio.src){
            initAudio();
        }
    }
    audio.play();
    if(!playerSign){
        $("#bofangtiao .bofangImg").addClass("cover_img");
    }else if(playerSign){
        player_vm.totalTime = timeCountDown.formatTime(player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime);
    }
}

//暂停
function stopAudio(){
    if(playerSign){
        $$(".bigBtnsStyle").html("&#xe630;");
        $(".swiper-slide-active .box").removeClass("cover_img");
        $(".rotateImg").removeClass("cover_img");
        if(player_vm.currentAudio.popupGoodsImg){
            window.clearTimeout(flipTimeout1);
            window.clearTimeout(flipTimeout2);
            funBackOrFrontSign = false;
            $(".swiper-slide-active").siblings().children(".box").children(".list").addClass("in").removeClass("out");
            $(".swiper-slide-active").children(".box").children(".list").eq(1).addClass("out").removeClass("in");
            $(".swiper-slide-active").children(".box").children(".list").eq(0).addClass("in").removeClass("out");
        }
    }else {
        $$(".zan").html("&#xe733;");
        $("#bofangtiao .bofangImg").removeClass("cover_img");
    }
    studyRecord(preAudioId,false);
    cacheData();
    vm.studyRecordId = 0;
    timeout = true;
    clearTimeout(record);
    audio.pause();
    isPlay = false;
}

function time(oBool) {
    if(timeout) return;
    studyRecord(vm.currentAudio.id,true,oBool);
    record = setTimeout(time,10000);
}

// 设置src
function setSrc(obj) {
    if(obj && obj.audioUrl){
        audio.src = obj.audioUrl;
    }else{
        audio.src = obj.audioPath;
    }
    audio.load();
    audio.currentTime = 0;
    // currentTime_ = 0;
    if(isPlay){
        playAudio();
    }
}

//初始化音频
function initAudio(){
    var curTime = vm.currentAudio.versions[vm.playVersion].currentTime;
    if(curTime > 0){
        if(vm.currentAudio.versions[vm.playVersion].audioUrl){
            audio.src = vm.currentAudio.versions[vm.playVersion].audioUrl;
        }else {
            audio.src =vm.currentAudio.versions[vm.playVersion].audioPath;
        }
        if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
            vm.allCurrentTime = (vm.kbPlayTime + vm.preAdPlayTime + curTime);
        }else{
            vm.allCurrentTime = ( vm.preAdPlayTime + curTime);
        }
        audio.currentTime = curTime;
        currentTime_ = curTime;
        vm.isPlayingIndex = 2;
        if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
            vm.addTime = vm.kbPlayTime + vm.preAdPlayTime;
            if (playerSign) {
                player_vm.addTime = vm.kbPlayTime + vm.preAdPlayTime;
            }
        }else{
            vm.addTime = vm.preAdPlayTime;
            if (playerSign) {
                player_vm.addTime = vm.preAdPlayTime;
            }
        }
        if (vm.currentAudio.versions[vm.playVersion].playTime - curTime < 10 || curTime - vm.currentAudio.versions[vm.playVersion].playTime > 0) {
            vm.allCurrentTime = 0;
            audio.currentTime = 0;
            currentTime_ = 0;
            vm.addTime = 0;
            vm.isPlayingIndex = 0;
            AdPanDuan();
            if(playerSign){
                player_vm.addTime = 0;
            }
        }
    }else {
        AdPanDuan();
        audio.currentTime = 0;
        currentTime_ = 0;
        vm.addTime = 0;
        if(playerSign){
            player_vm.addTime = 0;
        }
    }
    audio.load();

}

//广告音频判断
function AdPanDuan() {
    if(vm.koubo && (vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1])){
        if (vm.koubo.audioUrl) {
            audio.src = vm.koubo.audioUrl;
        } else {
            audio.src = vm.koubo.audioPath;
        }
        vm.isPlayingIndex = 0;
        if (playerSign) {
            player_vm.isPlayingIndex = 0;
        }
    }else if(vm.beforeAd){
        if(vm.beforeAd.audioUrl){
            audio.src =vm.beforeAd.audioUrl;
        }else {
            audio.src =vm.beforeAd.audioPath;
        }
        vm.isPlayingIndex = 1;
        if(playerSign){
            player_vm.isPlayingIndex = 1;
        }
    }else if(vm.currentAudio){
        if(vm.currentAudio.versions[vm.playVersion].audioUrl){
            audio.src =vm.currentAudio.versions[vm.playVersion].audioUrl;
        }else {
            audio.src =vm.currentAudio.versions[vm.playVersion].audioPath;
        }
        vm.isPlayingIndex = 2;
        if(playerSign){
            player_vm.isPlayingIndex = 2;
        }
    }else if(vm.afterAd){
        if(vm.afterAd.audioUrl){
            audio.src =vm.afterAd.audioUrl;
        }else {
            audio.src =vm.afterAd.audioPath;
        }
        vm.isPlayingIndex = 3;
        if(playerSign){
            player_vm.isPlayingIndex = 3;
        }
    }
}


//页面返回设置
function pageBack() {
    $$("#playControl").show();
}

function closeSuccModal(modal) {
    clearTimeout(threeSetTime);
    myApp.closeModal(modal);
}

function shareTipCloseModal() {
    $(".punch-MainBtn").css("opacity","1");
    shareModalSign = false;
    //myApp.closeModal();
    $(".punchModal").remove();
    resetPosition();
    closePunchModal();
}

//播放页下一曲循环设置
function setNextCircle() {
    pdIndex = player_vm.selectedIndex;
    if(circle == 0) {
        nextItem();
        isOrNotPayAudio("right");
    } else if(circle == 1) {
        player_vm.selectedIndex = Math.floor(Math.random() * (player_vm.menuList.length));
        player_vm.initialSlide =  player_vm.selectedIndex;
        isOrNotPayAudio("");
    }else {
        if(onceChange){
            nextItem();
            onceChange = false;
            isOrNotPayAudio("right");
        }
        if(endChange){
            isOrNotPayAudio("");
        }
    }

}

//播放页上一曲循环设置
function setBeforeCircle() {
    pdIndex = player_vm.selectedIndex;
    if(circle == 0) {
        preItem();
        isOrNotPayAudio("left");
    } else if(circle == 1) {
        player_vm.selectedIndex = Math.floor(Math.random() * (player_vm.menuList.length));
        player_vm.initialSlide =  player_vm.selectedIndex;
        isOrNotPayAudio("");
    }else {
        if(onceChange){
            preItem();
            onceChange = false;
            isOrNotPayAudio("left");
        }
        if(endChange){
            isOrNotPayAudio("");
        }
    }
}

//上一曲的判断
function preItem() {
    if(player_vm.selectedIndex == 0) {
        player_vm.selectedIndex = player_vm.menuList.length - 1;
    } else {
        player_vm.selectedIndex--;
    }
}

//下一曲的判断
function nextItem() {
    if(player_vm.selectedIndex == player_vm.menuList.length - 1) {
        player_vm.selectedIndex = 0;
    } else {
        player_vm.selectedIndex++;
    }
}

// 判断是否是付费音频
function isOrNotPayAudio(direction) {
    if(player_vm.menuList[player_vm.selectedIndex] && player_vm.menuList[player_vm.selectedIndex].needBuyFlag){
        player_vm.currentAudio = player_vm.menuList[pdIndex];
        vm.currentAudio = player_vm.currentAudio;
        stopAudio();
        BuyTip();
    }else {
        player_vm.currentAudio = player_vm.menuList[player_vm.selectedIndex];
        vm.currentAudio =  player_vm.currentAudio;
        if(direction === "left"){
            mySwiper7.slidePrev();
        }else if(direction === "right"){
            mySwiper7.slideNext();
        }
        resetAudio();
        unifyCollection();
    }
}

// js回到顶部
function backTop() {
    $$(".page-content").scroll(function(){
        if ($$(".page-content").scrollTop()>700){//如果滚动条顶部的距离大于topMain则就nav导航就添加类.nav_scroll，否则就移除。
            $$(".backTop").show();
        }
        else
        {
            $$(".backTop").hide();
        }
    });
}

//初始化swiper
function setSwiper() {
    var mySwiper = myApp.swiper('.swiper-4', {
        freeMode: false,
        paginationClickable: false,
        preventClicks : false,//默认true
        preventClicksPropagation:true,
        spaceBetween: 10,
        resistanceRatio : 0.9,
        slidesPerView: 2.2,
        animation:true,
        observer:true
    });
}

// 打卡圆仔位置还原
function resetPosition() {
    if(playerSign){
        $$(".punch-MainBtn").css("bottom","200px");
    }else {
        $$(".punch-MainBtn").css("bottom","110px");
        $$(".punch-MainBtn").css("left","15px");
    }
}


//调用微信相关
function onWXReady(){
    //唤起扫一扫功能
    if(scan){
        scan = false;
        weiXinTools.scanQRCode(function (bookcode) {
            if(bookcode){
                inScanResult(bookcode);
            }else {
                showToast("不能识别此二维码!");
            }
        })
    }

    if(isSubPageShare == 1){
        return ;
    }
    var imgURL;
    if(vm.currentAudio.smallImg){
        imgURL = vm.currentAudio.smallImg;
    }else {
        imgURL = sessionStorage.storyMainImg;
    }
    var linkURL = location.href.split("?")[0];
    if(userHasStore) {
        linkURL += replaceQuery("fromUserId", userID);
    } else {
        linkURL += replaceQuery("fromUserId", fromUserId);
    }
    var title =  '我和宝贝正在新东方绘本馆听名师讲故事';
    var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
    weiXinTools.showFavoriteMenu();
    weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
        closeSuccModal();
        showToast("分享打卡主页才能算作打卡哦！")
    });
    weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
        closeSuccModal();
        showToast("分享打卡主页才能算作打卡哦！")
    });

    if(storyPunchSign){
        storyPunch_vm.onWXReady();
    }

}

function getUrl() {
    if(window.location.hash == ""){
        $$(".pages").find(".page").eq(0).siblings(".page").remove();
        $$(".pages").find(".page").eq(0).removeClass("page-on-left");
        $$(".pages").find(".page").eq(0).removeClass("cached");
        pageBack();
    }
}

function barPlayOrPause() {
    if(isPlay){
        $$(".zan").html("&#xe611;");
        $("#bofangtiao .bofangImg").addClass("cover_img");
    }else {
        $$(".zan").html("&#xe733;");
        $("#bofangtiao .bofangImg").removeClass("cover_img");
    }
    ww = audio.currentTime / duration * $$("#bofangtiao").width();
    $("#bofangtiaoLine").width(ww);
}

// popover 弹框
function popoverModalFunc(clickedLink,statusDes,moreStore,getExtraThreeStore) {
    popoverHTML = '<div class="popover popover-about">'+
        '<div class="popover-inner">'+
        '<img src="img/clickYZModalImg.png" alt="">'+
        '<div class="content-block">'+
        '<p class="punch-status-des">'+statusDes+'</p>'+
        '<p class="extra-getStores" >'+moreStore+'</p></div></div>'+
        '<div class="rightTop-tip-img">' ;
    if(!vm.punchStatus){
        popoverHTML += '<div class="rightTop-tip-BgImg"><img src="img/dialogLittleC.png" alt=""></div>';
    }else{
        popoverHTML += '<img class="rightTop-tip-rotateImg" src="img/mainModalLight.png" alt=""><div class="rightTop-tip-BgImg"><img src="img/ydy_yuanzai.png" alt=""></div>';
    }

    popoverHTML +='</div>' +'</div></div>';
    punchlittleModal = myApp.popover(popoverHTML, clickedLink);
    $$(".modal-overlay").css("background","rgba(255,255,255,0)");
    // if(vm.punchStatus){
    //     $(".rightTop-tip-rotateImg").show();
    // }else {
    //     $(".rightTop-tip-rotateImg").hide();
    // }

    $$(".modal-overlay").click(function () {
        resetPosition();
        $$(".modal-overlay").remove();
    })

}

// function nextStatus() {
//    if($$(".extra-getStores").text() == '还想额外获得 '+ydyShareCredits+' 颗魔法石？ >'){
//        nowShare();
//     }else {
//         closeSuccModal();
//         vm.stickPunchShow = false;
//     }
//
// }

function nowShare() {
    closeSuccModal();
    $$(".floating-button").css("opacity","1");
    $$(".punchBtn-content").html("&#xe650;");
    $$(".modal-overlay").css("background",'rgba(0, 0, 0, 0.8)');
    if(!storyPunchSign){
        if(playerSign){
            playerSign = false;
            if(pageObj.fromPage.name == "storyPunch"){
                closeSuccModal();
                mainView.router.back();
                shareTipModal();
                storyPunchSign = true;
            }else{
                $$("#playControl").show();
                barPlayOrPause();
                inStoryPunch(1);
            }
        }else {
            inStoryPunch(1);
        }
    }else {
        shareTipModal();
    }

}

function nowShare2() {
    //closeSuccModal();
    $(".punchModal").remove();
    inStoryPunch(1);

}

function toIndexYdy() {
    location.href="https://www.dayutang.cn/story/main.html";
}

function nowJoin() {
    vm.toPunch(false);
}

//弹出弹框
function toCenterAndUpModal() {
    $(".punch-MainBtn").stop().animate({
        bottom:"50%",
        left:'50%',
        marginLeft:'-25px',
        marginBottom:'-25px'
    },"fast",function () {
        setTimeout(function () {
            $(".punch-MainBtn").hide();
            $(".invivationHan").show();
            $(".invivationHan-content").show().addClass("addInvivationHanAnimation");
        },300);
    });
}

// 关闭弹框
function returnAndDownModal() {
    $(".invivationHan-content").removeClass("addInvivationHanAnimation");
    $(".invivationHan").hide();
    $(".punch-MainBtn").show();
    $(".invivationHan-content").hide();
    $(".punch-MainBtn").css({'bottom':"90px",'left':"15px",'marginLeft':"auto",'marginBottom':"auto"});
    resetPosition();
}

function getpushStatus() {
    if(!playerSign){//播放页
        if(localStorage.getItem("ydyStorytimestamp") != thisToday){
            var num = ydyPunchCredits;
            if(vm.seventhDay){
                num = ydyPunchCredits * 4;
            }
            punchStatusModal('打卡领取奖励',num,'今日打卡奖励魔法石<span class="iconfont">&#xe61f;</span>+'+num,1);
            localStorage.setItem("ydyStorytimestamp",thisToday);
        }
    }

}


// 获取积分
function storeCredits() {
    v2AudioPunch.storeCredits(function (data) {
        if(data.code == 0){
            if(storyPunchSign){
                storyPunch_vm.continue7dayCredits = data.continue7dayCredits;
                storyPunch_vm.punchCredits = data.punchCredits;
                storyPunch_vm.shareCredits = data.shareCredits;
                storyPunch_vm.punchIdentify = data.punchIdentify;
                // $(".listenMoreMinutes").text(storyPunch_vm.punchIdentify);
                // if(storyPunch_vm.punchIdentify == 10){
                //     $(".punch-process-content").css("width","13px");
                // }else {
                //     $(".punch-process-content").width(parseInt(10-storyPunch_vm.punchIdentify)*10 + "%");
                // }
            }else if(mainSign){
                vm.continue7dayCredits = data.continue7dayCredits;
                vm.punchCredits = data.punchCredits;
                vm.shareCredits = data.shareCredits;
                vm.punchIdentify = data.punchIdentify;
            }
            ydyContinue7dayCredits = data.continue7dayCredits;//类型打卡七天积分翻倍数
            ydyPunchCredits = data.punchCredits;//打卡成功获得积分数
            ydyShareCredits = data.shareCredits;//分享成功获得积分数
            ydyPunchIdentify = data.punchIdentify;//打卡时长（打卡成功标识）
            punchCreditsTemp = data.punchCredits;//打卡成功获得积分数
        }
    })
}


$$(document).on('pageAfterAnimation', function (e) {
    var page = e.detail.page;
    getUrl();
    myApp.hideIndicator();
});

myApp.onPageBeforeInit('main',function () {
    mainSign = true;
});
myApp.onPageAfterAnimation('main',function () {
    $("#mainPage").css("opacity","1");
    $("#mainPage").css("transform","translate3d(0%, 0, 0)");
    $("#mainPage").css("-webkit-transform","translate3d(0%, 0, 0)");
});
myApp.onPageReinit('main',function () {
    resetPosition();
    isSubPageShare =0;
    if(mainSign){
        playerSign = false;
        $$("#playControl").show();
    }
    $$("input#input-search-story").css("text-align","center");
    $$("input#input-search-story").css("background","rgba(255,255,255,0.20)");
    $$(".searchbar-icon").hide();
    $$(".searchbar-txt").hide();
    $$("#main .searchbar-overlay").hide();
    $$(".search-placeholder").show();
    $$("#main .searchbar-overlay").css("opacity","0");
    $$(".punch-MainBtn").css("opacity","1");
    $$("input#input-search-story").addClass("iconfont");
    $$(".searchbar").css("background","linear-gradient(-180deg, #000000 0%,rgba(0,0,0,0.00) 100%)");
    $$("#main .page-content").css({"overflow": "auto"});
    barPlayOrPause();
    setSwiper();
    inputBlur();
    setKeywords();
    closeSuccModal();
    punchStatus();
    mainSign = true;
    storyPunchSign = false;
    onWXReady();
});


$$(document).on('pageBeforeInit', function (e) {
    var page = e.detail.page;
    getUrl();
    var pageName = page.name;
    if(pageName == "player"){
        removeSamePage();
        if(parseInt(location.href.toString().indexOf("player.html"))>0){
            $$("#playControl").hide();
        }
    }else if(pageName == "teachDetail"){
        removeSamePage();
        playerSign = false;
        $$("#playControl").show();
    }else if(pageName == "albumDetail"){
        removeSamePage();
        $$("#playControl").show();
    }
    else if(pageName == "rankList"){
        removeSamePage();
    }else if(pageName == "myFavorite"){
        $$("#playControl").show();
    }

    // 删除相同页面
    function removeSamePage() {
        if($$(".pages").find(".page[data-page=" + pageName + "]").length > 1){
            $$(".pages").find(".page[data-page=" + pageName + "]")[0].remove();
        }
    }
});

//S 浮窗广告
getHomePageAdvert("StoryPopUp");
//E 浮窗广告
//初始化albumDetail.html页面
var albumDetail_vm;
var albumDetailPage;
var albumDetailSign = false;
var pageContent;
var cardModel;
var  shareToFriendModal;
myApp.onPageInit('albumDetail',function (page) {
    pageContent = page;
    myApp.hideIndicator();
    playerSign = false;
    $$("#playControl").show();
    albumDetailPage = page.fromPage;
    albumDetailSign = true;
    if(sessionStorage.currentAudio){
        sessionStorage.removeItem("currentAudio");
        sessionStorage.removeItem("menuList");
    }
    barPlayOrPause();
    albumDetail_vm = new Vue({
        el: '#albumDetail',
        data: {
            page:0,
            size:10,
            classInfo:{},
            audios:[],
            selectedIndex:0,
            currentAudio:{},
            total:0,
            collectSign:false,
            type:2,
            playVersion:vm.playVersion,
            invitationCardFilePath:'',
            invitationCardTxt:'',
            collectionFlag:false,
            allAdTime:vm.allAdTime,
            fold:0,
            studyImgs:[],
            loading:false,
        },
        methods: {
            baCloseHide: function () {
                $$('.badge-alert').hide();
                $(".punch-MainBtn").show();
                //$$("#mainCatalog .page-content").css({"height": "inherit", "overflow": "auto"});
            },
            //毕业证
            clickDiplome: function () {
                if (albumDetail_vm.classInfo.diplomaStatus === 1) {
                    mainView.router.loadPage("tpl/courseDiplome.html?audioClassId=" +  pageContent.query.albumId);
                } else {
                    $$('.badge-alert').show();
                    $(".punch-MainBtn").hide();
                    $$("#mainCatalog .page-content").css({"height": "100%", "overflow": "hidden"});
                }
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("请购买专辑");
                }else {
                    if(item){
                        if(item.id !== albumDetail_vm.currentAudio.id || (item.id == albumDetail_vm.currentAudio.id && albumDetail_vm.playVersion != versionIndex && !itemIndex) ){
                        albumDetail_vm.currentAudio = item;
                        vm.currentAudio = item;
                        albumDetail_vm.playVersion = versionIndex;
                        vm.playVersion = versionIndex;
                        vm.selectedIndex = itemIndex;
                        vm.menuList = albumDetail_vm.audios;
                        vm.length = vm.menuList.length;
                        if(!vm.selectedIndex){
                            vm.selectedIndex = vm.menuList.indexOf(item);
                        }
                        albumDetail_vm.selectedIndex = vm.selectedIndex;
                        initAudio();
                        playAudio();
                        myApp.showIndicator();
                        inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }


                    }
                }

            },
            shareToFree:function () {
                upAttention();
            },
            shareToFriend:function () {
                closeModal();
                $$(".floating-button").css("bottom","90px");
                $$(".floating-button").css("opacity","1");
                shareToFriendModal = myApp.modal({
                    text: '<div class="all-bg" onclick="closeModal()"><div class="model-shareFriend"><img src="img/Confirm.png" alt=""></div></div>'
                });
                $$(".all-bg").css("height",window.screen.availHeight + "px");
            },
            isOrNotCollect:function () {
                collectionOrCancel(albumDetail_vm.type,page.query.albumId);
            },
            toBuy:function () {
                location.href = albumDetail_vm.classInfo.purchaseUrl + "&_channel=144";
            },
            getShare:function () {
                onWXReady2();
            },
            openAccordion:function (num) {
                //albumDetail_vm.accordtionExtend = !albumDetail_vm.accordtionExtend;
                albumDetail_vm.fold = num;
                albumDetail_vm.loading = false;
                albumDetail_vm.page = 0;
                albumDetail_vm.audios = [];
                getAudioListByAudioClassId(pageContent.query.albumId,albumDetail_vm.page,albumDetail_vm.size,albumDetail_vm.fold);
            },
            formatPercent:function (item) {
                var processPer = "1";
                if(item.currentTime > 0){
                    processPer = parseInt((vm.kbPlayTime + vm.preAdPlayTime + item.currentTime)/(item.playTime + vm.allAdTime) * 100);
                }
                return processPer;
            },
            receiveDiploma: function () {
                // 制作用户毕业证
                receiveDiploma(albumDetail_vm, $$(".badge-alert .name"), pageContent.query.albumId);
            }
        },
        watch:{
            classInfo:function () {
                //毕业证的显示进度
                //albumDetail_vm.biyeHeight = parseInt((albumDetail_vm.classInfo.studyCount/albumDetail_vm.classInfo.audioCount)*22);
                if($(window).width()>374){
                    var ydy_biyeHeight=22;
                }else{
                    var ydy_biyeHeight=14;
                }
                if (albumDetail_vm.classInfo.diplomaStatus!=-1 ) {
                    var progress = (albumDetail_vm.classInfo.studyCount / albumDetail_vm.classInfo.audioCount) * 100;
                    $(".ydy_jindu").css("height",progress/100*ydy_biyeHeight+"px");
                    $('.demo-progressbar-inline .progressbar').find('span').css('width', progress + "%");
                }
                onWXReady2();
            }
        }
    });

    init();

    function init() {
        getAudioClassInfo(pageContent.query.albumId);
        getAudioListByAudioClassId(pageContent.query.albumId,albumDetail_vm.page,albumDetail_vm.size);
        if(page.query.freeGetSign && page.query.freeGetSign != "undefined"){
            upAttention();
        }
    }

    // 调用微信相关
    function onWXReady2(){
        //isSubPageShare = 1;
        var imgURL;
        if(albumDetail_vm.classInfo.image){
            imgURL = albumDetail_vm.classInfo.image;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL1 = location.href.split("#")[0] +"?albumDetailSign=1#";
        var linkURL2 = location.href.split("#")[1];
        var linkURL = linkURL1 + linkURL2;
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '新东方绘本馆故事专辑《' + albumDetail_vm.classInfo.name + '》';
        var desc =  '一起来新东方绘本馆听故事吧>>';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            closeModal();
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            closeModal();
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }



});
function closeModal() {
    myApp.closeModal();
}



myApp.onPageBack('albumDetail',function () {
    albumDetailSign = false;
    $$(".weui_dialog_confirm").hide();
    closeModal();
});
myApp.onPageReinit('albumDetail',function () {
    $$(".floating-button").css("bottom","90px");
    albumDetail_vm.playVersion = vm.playVersion;
    albumDetail_vm.getShare();
    albumDetailSign = true;
    albumDetail_vm.audios = [];
    albumDetail_vm.page = 0;

    $$('.badge-alert').hide();
    getAudioClassInfo(pageContent.query.albumId);
    getAudioListByAudioClassId(pageContent.query.albumId,albumDetail_vm.page,albumDetail_vm.size,albumDetail_vm.fold);

});

// 获取专辑信息
function getAudioClassInfo(albumId) {
    audioClass.getAudioClassInfo(userID,albumId,function (data) {
        if(data.code == 0){
            albumDetail_vm.classInfo = data.classInfo;
            albumDetail_vm.studyImgs = data.classInfo.studyImgs;
            albumDetail_vm.invitationCardTxt = data.classInfo.invitationCardKeyword;
            albumDetail_vm.collectionFlag = data.classInfo.collectionFlag;
            if(data.classInfo.invitationCardId>0){
                getInvitationCard(data.classInfo.invitationCardId);
            }

        }else {
            showToast(data.msg);
        }
    })
}

// 制作用户毕业证
function receiveDiploma(vm, el, courseId) {
    vm.name = el.val();
    var reg = /^[a-zA-Z0-9\u4e00-\u9fa5\s]+$/;
    var flag = reg.test(vm.name);
    if (vm.name.trim() != '' && flag) {
        if (getByteLen(vm.name) > 12) {
            showToast("姓名太长了哦！");
        } else {
            var pream = {};
            pream.userId = userID;
            pream.audioClassId = courseId;
            pream.name = vm.name.trim();
            $$(".name").attr('disabled', 'true');
            audioClass.makeUserDiplomaImg( pream, function (data) {
                if (data.code == 0) {
                    mainView.router.loadPage("tpl/courseDiplome.html?audioClassId=" + courseId);
                }
            })
        }
    } else if (vm.name.trim() == '') {
        showToast("请输入姓名哦！");
    } else {
        showToast("请勿输入除汉字、字母和空格以外的字符哦！");
    }
}
//输入字符长度
function getByteLen(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        if (a.match(/[^\x00-\xff]/ig) != null) {
            len += 2;
        }
        else {
            len += 1;
        }
    }
    return len;
}

//检查该场景是否关注
function checkUserSubscribeByScene() {
    personalCenter.checkUserSubscribeByScene(userID,12,"",function (data) {
        if(data.code==0){
            albumDetail_vm.isSubscribe = data.subscribe;
            if(!albumDetail_vm.isSubscribe){
                showToast("没有关注新东方绘本馆");
            }else {
                cardModel = myApp.modal({
                    text: '<div class="getFreeAlbum">'+
                    '<div class="getFreeAlbum-shareCard"><img src=""' +
                    ' alt=""><div' +
                    ' class="getFreeAlbum-close" onclick="closeModal()">x</div></div>'+
                    '<div class="getFreeAlbum-bottomText"><p class="topD">' +
                    '规则:</p>' +
                    '<p class="getFreeAlbum-bottomText-content">长按保存上图，并用微信发给好友或分享至朋友圈，邀请1位好友扫描图上二维码【首次】关注我们，即可获得免费收听该专辑的特权哦！</p></div>'+
                    '</div>'
                });
                albumDetail_vm.invitationCardFilePath = 'img/attentionMe.jpeg';
                albumDetail_vm.invitationCardTxt = '长按二维码关注「新东方绘本馆」公众号回复“'+ albumDetail_vm.invitationCardTxt +'”获得免费获取专辑的方法快来关注吧！';
                $$(".getFreeAlbum-shareCard img").attr('src',albumDetail_vm.invitationCardFilePath);
                $$(".getFreeAlbum-bottomText-content").text(albumDetail_vm.invitationCardTxt);
            }
        }else {
            showToast(data.msg);
        }
    });
}

// 通过专辑ID获取音频列表
function getAudioListByAudioClassId(albumId,page,size,fold) {
    audioClass.getAudioListByAudioClassId(userID,albumId,page,size,fold,function (data) {
        albumDetail_vm.loading = true;
        if (data.code === 0) {
            albumDetail_vm.audios = albumDetail_vm.audios.concat(data.audios);
            downLoadMore2.down($('.audio-listStyle'), data.audios.length, albumDetail_vm.size, function () {
                albumDetail_vm.page++;
                getAudioListByAudioClassId(pageContent.query.albumId,albumDetail_vm.page,albumDetail_vm.size,albumDetail_vm.fold);
            });
            $(".background-img").height($(".background-img").width()/16*9);
            for(var i=0;i<albumDetail_vm.audios.length;i++){
                if(albumDetail_vm.audios[i].id == vm.currentAudio.id){
                    albumDetail_vm.currentAudio = albumDetail_vm.audios[i];
                }
            }
            if(sessionStorage.isEntryPage == 1){
                if(albumDetail_vm.audios.length>0 && albumDetail_vm.audios[0].needBuyFlag == true && localStorage.currentAudio){
                    albumDetail_vm.currentAudio = JSON.parse(localStorage.currentAudio);
                    vm.currentAudio = JSON.parse(localStorage.currentAudio);
                    albumDetail_vm.menuList = JSON.parse(localStorage.menuList);
                    albumDetail_vm.selectedIndex = JSON.parse(localStorage.selectedIndex);
                    vm.menuList = albumDetail_vm.menuList;
                    vm.selectedIndex = albumDetail_vm.selectedIndex;
                    albumDetail_vm.length = albumDetail_vm.menuList.length;
                    vm.length = vm.menuList.length;
                    initAudio();
                    stopAudio();
                }else {
                    if(!albumDetail_vm.currentAudio){
                        albumDetail_vm.currentAudio = albumDetail_vm.audios[0];
                        vm.currentAudio = albumDetail_vm.audios[0];
                        vm.selectedIndex = 0;
                        vm.menuList = albumDetail_vm.audios;
                        vm.length = vm.menuList.length;
                        sessionStorage.removeItem("isEntryPage");
                    }

                }

            }

        }
    });
}


// 收藏或取消收藏
function collectionOrCancel(type,albumId) {
    v2Audio.collectionOrCancel(userID,type,albumId,function (data) {
        if(data.code == 0){
            if(data.operate == 1){
                showToast("收藏成功!请在首页「我的故事」里查看!");
                if(albumDetailSign){
                    albumDetail_vm.collectionFlag = true;
                }else if(playerSign){
                    $$(".header-rightCollect").html("&#xe62d;");
                    player_vm.collectionFlag = true;
                    player_vm.menuList[player_vm.selectedIndex].collectionFlag = true;
                }
            }else {
                showToast("已取消收藏!");
                if(albumDetailSign){
                    albumDetail_vm.collectionFlag = false;
                }else if(playerSign){
                    $$(".header-rightCollect").html("&#xe609;");
                    player_vm.collectionFlag = false;
                    player_vm.menuList[player_vm.selectedIndex].collectionFlag = false;
                }
            }

        }
    })
}
// 获取锁粉邀请卡
function getInvitationCard(invitationCardId) {
    spokesman.getInvitationCard(userID, invitationCardId,function (data) {
        if(data.code == 0){
            if(data.invitationCardFilePath){
                albumDetail_vm.invitationCardFilePath = data.invitationCardFilePath;
            }else {
                albumDetail_vm.invitationCardFilePath = data.invitationCardFilePath;
            }
        }
    })
}

// 进入专辑详情面
function inAlbumDetail(albumId,freeGetSign) {
    mainView.router.loadPage({
        url:"tpl/albumDetail.html?albumId=" + albumId + "&freeGetSign=" + freeGetSign
    });
}

//弹出关注框
function upAttention() {
    $$("#playControl").hide();
    $(".attentionConfirm").show();
    $(".attentionImg").animate({
        bottom: 0,
    }, 500);
}
//隐藏关注框
function downAttention() {
    $$("#playControl").show();
    $(".attentionConfirm").hide();
    $(".attentionImg").animate({
        bottom: -$(".attentionImg").height(),
    }, 500);
}

var pcUserID = getQuery("pcUserID");
pcUserId();
function pcUserId() {
    if (pcUserID && pcUserID != userID) {
        showAlert("该微信号非电脑端登录账户，请务必使用对应微信号扫码。");
    }
}
//初始化albumList.html页面
var albumList_vm;
myApp.onPageInit('albumList',function (page) {
    albumList_vm = new Vue({
        el: '#albumList',
        data: {
            typeAlbumArr:[],
            total:0,
            page:0
        },
        methods: {
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            }
        }
    })
    getAudioByTag(userID,1000,albumList_vm.page,page.query.id,"album");
    //通过标签获取音频和专辑列表
    function getAudioByTag(userId,size,page,tagId,type) {
        v2Audio.getAudioByTag(userId,size,page,tagId,type,function (data) {
            if (data.code == 0){
                if(type){
                    albumList_vm.typeAlbumArr = data.albums;
                    albumList_vm.total = data.total;
                }
            }
        })
    }
})

myApp.onPageReinit('albumList',function (page) {
    $$(".floating-button").css("bottom","90px");
})



// 进入老师详情页面
function inAlbumList(id) {
    mainView.router.load({
        url:"tpl/albumList.html?id=" + id
    });
}
//初始化albumMain.html页面
var albumMain_vm;
myApp.onPageInit('albumMain',function (page) {
    myApp.hideIndicator();
    albumMain_vm = new Vue({
        el: '#albumMain',
        data: {
            page:0,
            size:10,
            albumList:[],
            queryType:'',
            total:0
        },
        methods: {
            toTeachDetail:function (id) {
                inTeachDetail(id);
            },
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            },
            toShop:function () {
                location.href = "../../shop/index.html";
            },
            getShare:function () {
                onWXReady();
            }
        }
    });

    if (page.query.queryType == 0){
        albumMain_vm.queryType = 0;
        myApp.showTab('#tab0');
        getAlbumListHotList();
    }else if(page.query.queryType == 1){
        albumMain_vm.queryType = 1;
        myApp.showTab('#tab1');
        getAlbumListHotList();
    }else if(page.query.queryType == 2){
        albumMain_vm.queryType = 2;
        myApp.showTab('#tab2');
        getAlbumListHotList();
    }else {
        albumMain_vm.queryType = 3;
        myApp.showTab('#tab3');
        getAlbumListHotList();
    }

    //tab切换
    $$('#tab0').on('show', function () {
        albumMain_vm.queryType = 0;
        albumMain_vm.page = 0;
        albumMain_vm.albumList = [];
        getAlbumListHotList();
    });

    $$('#tab1').on('show', function () {
        albumMain_vm.queryType = 1;
        albumMain_vm.page = 0;
        albumMain_vm.albumList = [];
        getAlbumListHotList();
    });

    $$('#tab2').on('show', function () {
        albumMain_vm.queryType = 2;
        albumMain_vm.page = 0;
        albumMain_vm.albumList = [];
        getAlbumListHotList();
    });
    $$('#tab3').on('show', function () {
        albumMain_vm.queryType = 3;
        albumMain_vm.page = 0;
        albumMain_vm.albumList = [];
        getAlbumListHotList();
    });



    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        var imgURL;
        if(albumMain_vm.albumList.length>0){
            imgURL = albumMain_vm.albumList[0].image;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '来看看你在新东方绘本馆都拥有哪些专辑吧！';
        var desc =  '一起来新东方绘本馆听故事吧 >>';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }

});

//获取专辑
function getAlbumListHotList(){
    audioClass.getAlbumList(userID,albumMain_vm.size,albumMain_vm.page,albumMain_vm.queryType,function(data){
        if (data.code == 0) {
            albumMain_vm.albumList = albumMain_vm.albumList.concat(data.albums);
            downLoadMore2.down($('.bestAlbums'), data.albums.length, albumMain_vm.size, function () {
                albumMain_vm.page++;
                getAlbumListHotList();
            });
            onWXReady();
        }
    })
}

myApp.onPageReinit('albumMain',function () {
    albumMain_vm.getShare();
    albumMain_vm.page = 0;
    albumMain_vm.albumList = [];
    getAlbumListHotList();
    $$(".floating-button").css("bottom","90px");
});

// 进入专辑主页面
function inAlbumMain(queryType) {
    mainView.router.load({
        url:"tpl/albumMain.html?queryType=" + queryType
    });
}


// 我的毕业证
$$(document).on('pageInit', '.page[data-page="courseDiploma"]', function (e) {
    mainView.hideToolbar();
    document.title = "新东方绘本馆";
    var page = e.detail.page;
    var audioClassId = page.query.audioClassId;
    var vm;
    $(document).ready(function () {
        vm_courseDiploma = new Vue({
            el: '#courseDiploma',
            data: {
                diplomaImg: ''
            },
            methods: {
                bigImg: function () {
                    $$('.bigImg').show();
                },
                smallImg: function () {
                    $$('.bigImg').hide();
                }

            }
        });
        getUserDiplomaImg();

    });

    function getUserDiplomaImg() {
        var pream = {};
        pream.userId = userID;
        pream.audioClassId = audioClassId;
        audioClass.getUserDiplomaImg( pream, function (data) {
            if (data.code == 0) {
                vm_courseDiploma.diplomaImg = data.diplomaImg;
            }
        })
    }


});

/**
 * Created by chenzhiliang on 17/6/22.
 */
var  myFavorite_vm;
var interfSign = false;//判断当前页面是不是最近收听的页面
myApp.onPageInit('myFavorite',function (page) {
    myApp.hideIndicator();
    playerSign = false;
    barPlayOrPause();
    myFavorite_vm = new Vue({
        el: '#myFavorite',
        data: {
            page:0,
            size:10,
            classInfo:{},
            audios:[],
            selectedIndex:0,
            currentAudio:{},
            total:0,
            type: 4,
            albums:[],
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime,
            boughtAlbums:[],
            recentList:[],
            showList:[]
        },
        methods: {
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            toPlay:function (list,item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== myFavorite_vm.currentAudio.id || (item.id == myFavorite_vm.currentAudio.id && myFavorite_vm.playVersion != versionIndex && !itemIndex) ){
                            myFavorite_vm.currentAudio = item;
                            vm.currentAudio = item;
                            myFavorite_vm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = list;
                            vm.length = vm.menuList.length;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            myFavorite_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }
            },
            onSwipeoutDeleted:function (albumId) {
                collectionOrCancel(2,albumId);
            },
            toAlbumDetail:function (albumId) {
                myApp.showIndicator();
                inAlbumDetail(albumId);
            },
            cancelCollect:function (id,index,type) {
                if(type === 'album'){
                    myFavorite_vm.type = 2;
                    collectionOrCancel(myFavorite_vm.type,id,index);
                }else {
                    myFavorite_vm.type = 0;
                    collectionOrCancel(myFavorite_vm.type,id,index);
                }
            },
            toShop:function () {
                location.href = "../../shop/index.html";
            },
            toMainPage:function () {
                mainView.router.back();
            },
            formatPercent:function (item) {
                var processPer = "1";
                if(item.currentTime > 0){
                    processPer = parseInt((vm.kbPlayTime + vm.preAdPlayTime + item.currentTime)/(item.playTime + vm.allAdTime) * 100);
                }
                return processPer;
            },
            formateType:function (index) {
                switch(index)
                {
                    case 1:
                        return "双语";
                        break;
                    case 2:
                        return "纯英";
                        break;
                    default:
                        return "中文";
                }
            }
        }
    })

    //tab切换
    $$('#tab00').on('show', function () {
        myFavorite_vm.page = 0;
        myFavorite_vm.type = 4;
        myFavorite_vm.recentList = [];
        myFavorite_vm.showList = [];
        //if(interfSign){
            getRecentListenAudio();
        //}
    });

    $$('#tab0').on('show', function () {
        myFavorite_vm.page = 0;
        myFavorite_vm.boughtAlbums = [];
        myFavorite_vm.type = 1;
        getUserAlbumList();
    });

    $$('#tab1').on('show', function () {
        myFavorite_vm.page = 0;
        myFavorite_vm.albums = [];
        myFavorite_vm.type = 2;
        getUserCollectionList();
    });

    $$('#tab2').on('show', function () {
        myFavorite_vm.page = 0;
        myFavorite_vm.audios = [];
        myFavorite_vm.type = 0;
        getUserCollectionList();
    });

    getRecentListenAudio();



    // 收藏或取消收藏
    function collectionOrCancel(type,albumId,index) {
        v2Audio.collectionOrCancel(userID,type,albumId,function (data) {
            if(data.code == 0){
                if(data.operate == 1){
                    showToast("收藏成功!");
                }else {
                    var removeItem = $$(".media-list").children("ul").children("li").eq(index);
                    myApp.swipeoutDelete(removeItem);
                    showToast("已取消收藏!");
                    getUserCollectionList();
                }
                return;
            }
        })
    }
})

//获取收藏列表
function getUserCollectionList() {
    v2Audio.getUserCollectionList(userID,myFavorite_vm.page,myFavorite_vm.size,myFavorite_vm.type,function (data) {
        if(data.code == 0){
            myFavorite_vm.total = data.total;
            if(myFavorite_vm.type == 0){
                myFavorite_vm.audios = myFavorite_vm.audios.concat(data.audios);
                for(var i=0;i<myFavorite_vm.audios.length;i++){
                    if(myFavorite_vm.audios[i].id == vm.currentAudio.id){
                        myFavorite_vm.currentAudio = myFavorite_vm.audios[i];
                    }
                }
                downLoadMore2.down($('.tab'), data.audios.length, myFavorite_vm.size, function () {
                    myFavorite_vm.page++;
                    getUserCollectionList();
                });
            }else {
                myFavorite_vm.albums = myFavorite_vm.albums.concat(data.albums);
                downLoadMore2.down($('#tab1'), data.albums.length, myFavorite_vm.size, function () {
                    myFavorite_vm.page++;
                    getUserCollectionList();
                });
            }
        }
    })
}

// 获取用户已购专辑
function getUserAlbumList() {
    var param = {userId: userID,page:myFavorite_vm.page,size: myFavorite_vm.size};
    audioClass.getUserAlbumList(param,function (data) {
        if(data.code == 0){
            myFavorite_vm.boughtAlbums = myFavorite_vm.boughtAlbums.concat(data.albums);
            downLoadMore2.down($('.tab'), data.albums.length, myFavorite_vm.size, function () {
                myFavorite_vm.page++;
                getUserCollectionList();
            });
        }else {
            console.log(data.msg);
        }
    })
}

// 最近收听
function getRecentListenAudio() {
    var param = {userId:userID,page:myFavorite_vm.page,size:myFavorite_vm.size};
    v2Audio.getRecentListenAudio(param,function (data) {
        if(data.code == 0){
            myFavorite_vm.recentList = data.audios;
            myFavorite_vm.showList = myFavorite_vm.showList.concat(myFavorite_vm.recentList);
            for (var i=0;i<myFavorite_vm.showList.length;i++){
                if(myFavorite_vm.showList[i].id == vm.currentAudio.id){
                    myFavorite_vm.currentAudio = myFavorite_vm.showList[i];
                }
            }
            downLoadMore2.down($('#tab00'), data.audios.length, myFavorite_vm.size, function () {
                myFavorite_vm.page++;
                getRecentListenAudio();
            });
            interfSign = true;
        }else {
            console.log(data.msg);
        }
    })
}

myApp.onPageReinit('myFavorite',function () {
    $$(".floating-button").css("bottom","90px");
    myFavorite_vm.currentAudio = vm.currentAudio;
    myFavorite_vm.playVersion = vm.playVersion;
    if(myFavorite_vm.type == 4){
        myFavorite_vm.page = 0;
        myFavorite_vm.recentList = [];
        myFavorite_vm.showList = [];
        getRecentListenAudio();
        getUserAlbumList();
        interfSign = false;
        myApp.showTab("#tab00");
    }
});

// 进入我的页面
function inMyFavorite() {
    mainView.router.loadPage({
        url:"myFavorite.html"
    });
}
//初始化player.html页面
var player_vm;
// var pageContent;
var playerSign = false;
var isControl = false;
var t;
var myPicker;
var mySwiper7;
var referrer = getQuery("referrer");
var picAudioId = getQuery("audioId");
var studyPlaySign = getQuery("studyPlaySign");
var fromSharePage = getQuery("fromSharePage");
var eleBack = null;
var eleFront = null;
var eleList = null;
var flipTimeout1;
var flipTimeout2;
var funBackOrFrontSign = false;
var pageObj;
var timeOutSignOver = false;
myApp.onPageBeforeInit('player',function (page) {
    myApp.hideIndicator();
    albumDetailSign = false;
    storyPunchSign = false;
    mainSign = false;
    playerSign = true;
    resetPosition();
})
myApp.onPageInit('player',function (page) {
    var initFlag = 0;
    var playBar = page.query.playBar;
    var dataValue = page.query.date;
    // pageContent = page.fromPage;
    pageObj = page;
    if(parseInt(location.href.toString().indexOf("player.html"))>0){
        $$("#playControl").hide();
    }
    clearTimeout(flipTimeout1);
    clearTimeout(flipTimeout2);
    player_vm = new Vue({
        el:'#player',
        data:{
            currentAudio:{},
            currentTime:'00:00',
            totalTime:'00:00',
            selectedIndex: 0,
            playImgShow:true,
            isShow:false,
            playTime:'00:00',
            length:0,
            menuList:[],
            menuList2:[],
            adObject:{},
            imgArray:[],
            playVersion:vm.playVersion,
            nextVersionTipShow:false,
            nextVersionTipName:"",
            nextVersionTipTime:5,
            initialSlide:0,
            collectionFlag:false,
            setTimeCoverBg:false,
            punchStatus:false,
            allAdTime:vm.allAdTime,
            allCurrentTime:vm.allCurrentTime,
            addTime:vm.addTime,
            TurntableDefault:[],
        },
        methods:{
            showTimeSet:function () {
                myPicker = myApp.picker({
                    rotateEffect: true,
                    toolbarTemplate:'<div class="toolbar"> ' +
                    '<div class="toolbar-inner"> ' +
                    '<div class="left"></div>' +
                    '<div class="center">设置定时关闭</div> ' +
                    '<div class="right"></div>' +
                    '</div>' +
                    '</div> ',
                    cols: [
                        {
                            values: ['听完这个故事', '再听1个故事', '再听2个故事','再听3个故事','15分钟后','30分钟后','1小时后'],
                        }
                    ]
                });
                var pickerBtn = "<div class='pickerBtns'><span class='noOpen left'" +
                    " onclick='noOpened()'>不开启</span><span" +
                    " class='noOpen" +
                    " left' onclick='selTimeSet()'>确定</span></div>";
                myPicker.open(); // open Picker
                myPicker.inline = true;
                player_vm.setTimeCoverBg = true;
                $$(".picker-modal-inner").append(pickerBtn);
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            back: function() {
                downMenu();
                if(fromSharePage && fromSharePage == 1){
                    location.href = "https://www.dayutang.cn/story/main.html";
                }else {
                    if (window.history.length > 1) {
                        window.history.back();
                        if(pageObj.fromPage.name == "storyPunch"){
                            storyPunchSign = true;
                        }
                    }else{
                        location.href = "../main.html";
                    }
                }
            },
            showMenu: function(event) {
                event.stopPropagation();
                upMenu();
            },
            hideMenu: function() {
                event.preventDefault();
                downMenu();
            },
            xunhuan: function() {
                unifyCircle(true);
                showTips();
            },
            selectedItem: function(item,event, index) {
                event.stopPropagation();
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if(item.id !== player_vm.currentAudio.id){

                        vm.selectedIndex = index;
                        player_vm.selectedIndex = index;
                        player_vm.initialSlide = index;
                        player_vm.currentAudio = item;
                        unifyCollection();
                        player_vm.playVersion = 0;
                        vm.playVersion = 0;
                        vm.currentAudio = item;
                        audio.allCurrentTime = 0;
                        player_vm.allCurrentTime = 0;
                        setSessionStorage();
                        initAudio();
                        playAudio();
                        resetAdAnimation();
                    }
                }

            },
            nextLeft: function() {
                if(player_vm.menuList.length == 1){
                    showToast("已经是最后一首了哦！");
                }else {
                    onceChange = true;

                    setBeforeCircle();
                }
            },
            nextRight: function() {
                if(player_vm.menuList.length == 1){
                    showToast("已经是最后一首了哦！");
                }else {
                    onceChange = true;
                    setNextCircle();
                }
            },
            playStatus: function() {
                if(isPlay) {
                    stopAudio();
                } else {
                    playAudio(1);
                }
            },
            changeCircle: function(event) {
                event.stopPropagation();
                unifyCircle(true);
            },
            collectOrNot:function () {
                collectionOrCancel(0,player_vm.currentAudio.id);
            },
            changeVersion:function (index) {
                player_vm.playVersion = index;
                vm.playVersion = index;
                vm.isPlayingIndex = 0;
                initAudio();
                playAudio();
            },
            closeModel:function () {
                notOpen();
            },
            matchResource:function () {
                MtaH5.clickStat("playerpopadclick")
                var modal = myApp.modal({
                    afterText:  '<div class="matchResource-modal"><img  onclick="toGoodDetail()"><div class="matchResource-modal-close" onclick="closeMatchResourceModal()">x</div></div>',
                });
                $$(".matchResource-modal img").attr("src",player_vm.currentAudio.popupGoodsImg);
            },
            lookMatchResource:function () {
                MtaH5.clickStat("turntableadclick");
                if(player_vm.currentAudio.rotateGoodsImg || player_vm.TurntableDefault[0].image.length>0){
                    window.clearTimeout(flipTimeout1);
                    window.clearTimeout(flipTimeout2);
                    funBackOrFrontSign = true;
                    $(".swiper-slide-active .box").removeClass("cover_img");
                    $(".swiper-slide-active").children(".box").children(".list").eq(0).addClass("in").removeClass("out");
                    $(".swiper-slide-active").children(".box").children(".list").eq(1).addClass("out").removeClass("in");
                    imgFlip(true);

                }
            }
        },
        watch:{
            currentAudio:function () {
                onWXReady();
            },
            menuList2:function () {
                mySwiper7 = myApp.swiper('.swiper-7', {
                    slidesPerView: 1,
                    onlyExternal : true,
                    initialSlide:player_vm.initialSlide,
                    prevButton:'.swiper-button-prev',
                    nextButton:'.swiper-button-next',
                    loop:true,
                });
                if(isPlay){
                    $(".swiper-slide-active .box").addClass("cover_img");
                    $(".rotateImg").addClass("cover_img");
                }
                if(player_vm.menuList.length == 1){
                    mySwiper7.params.loop = true;
                }
                $$(window).resize(onMainResize);
                onMainResize();
                if(player_vm.TurntableDefault.length>0 ||  player_vm.currentAudio.rotateGoodsImg){
                    funBackOrFront();
                }
            },
            nextVersionTipShow:function () {
                if(player_vm.nextVersionTipShow){
                    fiveSecondsTime();
                }
            },
            playVersion:function () {
                onWXReady();
            },
            initialSlide:function () {
                mySwiper7 = myApp.swiper('.swiper-7', {
                    slidesPerView: 1,
                    onlyExternal : true,
                    initialSlide:player_vm.initialSlide,
                    prevButton:'.swiper-button-prev',
                    nextButton:'.swiper-button-next',
                    loop:true,
                });
                if(isPlay){
                    $(".swiper-slide-active .box").addClass("cover_img");
                    $(".rotateImg").addClass("cover_img");
                }
            },
            punchStatus:function () {
                if(player_vm.punchStatus){
                    $$(".punchBtn-content").addClass("iconfont");
                    $$(".punchBtn-content").html("&#xe650;");
                    $$(".punchBtn-content").css("top","31px");
                    $$(".punchBtn-content").css("fontSize","20px");
                    $$(".punchBtn-content").css("right","13px");
                    // if(localStorage.firstShowCompleteModal == undefined){
                    //     popoverModalFunc($$('.create-popOver'),'完成今日打卡！获得 <span class="iconfont" style="font-weight: 100 !important;">&#xe671;</span> +'+vm.punchCredits,'还想额外获得 '+vm.shareCredits+' 颗魔法石？ >',true);
                    //     localStorage.firstShowCompleteModal = true;
                    // }
                    punchStatus();
                }
            }
        }

    });
    var audioId = page.query.audioId;
    var rankingList = page.query.rankingList;



    getAdvertByBannerFunYdy();
    function init() {
        initData();
        addListener();
        unifyCircle(false);
        unifyCollection();
        lockFans.addLockFansReocrd(userID,fromUserId);
        punchStatus();
        storeCredits();
    }

    // 故事转盘默认广告
    function getAdvertByBannerFunYdy() {
        advert.getAdvertByBanner('TurntableDefault',function(data){
            if (data.code == 0) {
                player_vm.TurntableDefault = data.adverts;
            }
            init();
        });
    }



    function initData() {
        if (referrer === 'picture') {
            getAudioPlayList(audioId,"",'','','','','','',page.query.picBookId);
        }else if(studyPlaySign == 1){
            getAudioById(audioId);
        }else if(dataValue){
            getTodayStudyPlan(audioId,dataValue);
        }else if(vm.currentAudio.name != undefined && referrer != 'picture') {
            setPlayerBar();

        }else if (sessionStorage.currentAudio != null && (sessionStorage.currentAudio != "{}") && referrer != 'picture') {
            player_vm.currentAudio = JSON.parse(localStorage.currentAudio);
            collectionOrNot();
            vm.currentAudio = player_vm.currentAudio;
            player_vm.menuList = JSON.parse(localStorage.menuList);
            player_vm.selectedIndex = JSON.parse(sessionStorage.selectedIndex);
            player_vm.playVersion = JSON.parse(localStorage.playVersion);
            vm.playVersion = JSON.parse(localStorage.playVersion);
            vm.menuList = player_vm.menuList;
            player_vm.menuList2 = player_vm.menuList;
            vm.selectedIndex = player_vm.selectedIndex;
            player_vm.initialSlide = player_vm.selectedIndex;
            player_vm.length = player_vm.menuList.length;
            vm.length = vm.menuList.length;
            player_vm.totalTime = timeCountDown.formatTime(player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime);
            setPlayBar();
            stopAudio();
        }
    }
    var startX;

    function onBallTouchStart(event) {
        startX = event.touches[0].pageX;
        isControl = true;
        vm.studyRecordId = 0;
        timeout = true;
        clearTimeout(record);
    }

    function onBallTouchMove(event) {
        var offX = event.touches[0].pageX - startX;
        startX = event.touches[0].pageX;
        var oldLeft = $("#circle").css("left");
        oldLeft = parseInt(oldLeft);
        var newLeft = offX + oldLeft;
        if(newLeft < -5) newLeft = -5;
        var max = $("#bar").width() - 10;
        if(newLeft > max) newLeft = max;
        $("#circle").css("left", newLeft);
        $("#process").css("width", newLeft + 5);
        var percent = newLeft / $("#bar").width();
    }

    function onBallTouchEnd(event) {
        isControl = false;
        var totalCurrentTime = player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime;
        var percent = $("#process").width() / $("#bar").width();
        player_vm.allCurrentTime = percent * totalCurrentTime;
        ww = player_vm.allCurrentTime / totalCurrentTime * ($("#bar").width() - 10);
        $("#circle").css("left", ww);
        $("#process").width(ww);
        vm.allCurrentTime = player_vm.allCurrentTime;
        setAudioInitTime();
        if(isPlay){
            vm.studyRecordId = 0;
            timeout = false;
            time();
        }
        studyRecord(player_vm.currentAudio.id,false,true);
    }

    function addListener() {
        var ball = $("#circle")[0];
        ball.addEventListener("touchstart", onBallTouchStart);
        ball.addEventListener("touchmove", onBallTouchMove);
        ball.addEventListener("touchend", onBallTouchEnd);
    }

    function onMainResize() {
        var allw = $$(window).height();
        var ratio = allw / 568;
        var ratioW = $$(window).width()/320;
        $$(".rotateImg").css("height", $$(".rotateImg").width());
        $(".swiper-slide-player").parent().parent(".swiper-container-play").css("height", $$(".rotateImg").width());
        $(".swiper-slide-player").css("height", $$(".rotateImg").width());
        $(".swiper-slide-player .box").css("width",190*ratioW + "px");
        $(".swiper-slide-player .box").css("height",190*ratioW + "px");
        $(".swiper-slide-player .box").css("top",($$(".rotateImg").width() - $(".swiper-slide-player .box").height()) / 2 + "px");
        $$(".leftNext").css("left",(-10)*ratioW + "px");
        $$(".leftNext").css("top",(110)*ratioW + "px");
        $$(".rightNext").css("top",(110)*ratioW + "px");
        $$(".rightNext").css("right",(-10)*ratioW + "px");
        $(".swiper-slide-player .box").css("marginLeft",(95*ratioW)*(-1) + 'px');
        $$(".bottomBtns").css("bottom", ratio * 40);
        $$(".mainInfo").css("marginTop",(50*ratioW) + 'px');
    }

    //弹出定时器
    function upTimeout() {
        $(".setList").animate({
            bottom: 0,
        },300);
    }


    //弹出广告
    function upAd() {
        $(".adAnswerImg").animate({
            top: 0,
        },500);
    }

    //播放模式
    function showTips(){
        $$(".playTipBar").show();
        $$(".playTipBarSan").show();
        setTimeout(function() {
            $$(".playTipBar").hide();
            $$(".playTipBarSan").hide();
        }, 1000);
    }

    //弹出菜单
    function upMenu() {
        $$(".audioList").show();
        $$(".audioListContent").css("height",(vm.menuList.length * 50) +'px');
        $$(".oneList").css("bottom",(vm.menuList.length * 50) +'px');
        if (vm.menuList.length>5){
            $$(".audioListContent").css("height",'250px');
            $$(".oneList").css("bottom",'250px');
        }
        $(".upMenu").animate({
            bottom:0
        },500);
        $$("html,body").css({"height":"100%", "overflow":"hidden"});
    }

    //统一循环模式
    function unifyCircle(isChange){
        if(isChange){
            if(circle == 0) {
                $$(".showCircle").html("&#xe633;");
                $$(".circleImg").html("&#xe633;");
                $$(".playTipBar").text("随机播放");
                $$(".circleName").text("随机播放");
                circle = 1;
            } else if(circle == 1) {
                $$(".showCircle").html("&#xe67e;");
                $$(".circleImg").html("&#xe67e;");
                $$(".playTipBar").text("单曲循环");
                $$(".circleName").text("单曲循环");
                circle = 2;
            } else {
                $$(".showCircle").html("&#xe67f;");
                $$(".circleImg").html("&#xe67f;");
                $$(".playTipBar").text("列表循环");
                $$(".circleName").text("列表循环");
                circle = 0;
            }
            // sessionStorage.circle = player_vm.circle;
        }else{
            if(circle == 0) {
                $$(".showCircle").html("&#xe67f;");
                $$(".circleImg").html("&#xe67f;");
                $$(".playTipBar").text("列表循环");
                $$(".circleName").text("列表循环");
            } else if(circle == 1) {
                $$(".showCircle").html("&#xe633;");
                $$(".circleImg").html("&#xe633;");
                $$(".playTipBar").text("随机播放");
                $$(".circleName").text("随机播放");
            } else {
                $$(".showCircle").html("&#xe67e;");
                $$(".circleImg").html("&#xe67e;");
                $$(".playTipBar").text("单曲循环");
                $$(".circleName").text("单曲循环");
            }
        }
        localStorage.circle = circle;
    }

    //调用微信相关
    function onWXReady(){
        var imgURL;
        if(player_vm.currentAudio.smallImg){
            imgURL = player_vm.currentAudio.smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL ="https://www.dayutang.cn/story/storyLandingPage.html?audioId=" + player_vm.currentAudio.id + "&" + "version=" + player_vm.playVersion+ "&fromUserId=" + userID;;
        // if(userHasStore) {
        //     linkURL += "&fromUserId=" + userID;
        // } else {
        //     linkURL += "&fromUserId=" + getQuery('fromUserId');
        // }
        var title =  '我正在听《' + player_vm.currentAudio.name +'》';
        var desc =  '一起来新东方绘本馆听故事吧>>';
        var dataUrl;
        if(player_vm.currentAudio.versions[vm.playVersion].audioUrl){
            dataUrl =player_vm.currentAudio.versions[vm.playVersion].audioUrl;
        }else{
            dataUrl = player_vm.currentAudio.versions[vm.playVersion].audioPath;
        }
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        },"","");
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }

    //获取播放器列表
    function getAudioById(audioId) {
        request("V2Audio", "getAudioById", {
            userId:userID,
            audioId:audioId
        },function(data) {
            if(data.code == 0) {
                player_vm.menuList = [];
                vm.menuList = [];
                player_vm.menuList.push(data.audio);
                player_vm.menuList2 = player_vm.menuList;
                vm.menuList.push(data.audio);
                player_vm.currentAudio = player_vm.menuList[0];
                vm.currentAudio = player_vm.menuList[0];
                vm.length = vm.menuList.length;
                player_vm.length = player_vm.menuList.length;
                vm.totalTime = timeCountDown.formatTime(vm.currentAudio.versions[0].playTime);
                if(!data.audio.needBuyFlag) {
                    vm.freeAudio = true;
                    audio.src = player_vm.currentAudio.versions[0].audioUrl || player_vm.currentAudio.versions[0].audioPath;
                    stopAudio();
                }else {
                    vm.freeAudio = false;
                    return;
                }

            } else {
                alert(data.msg);
            }
        })
    }
    
    function getTodayStudyPlan(audioId,dataValue) {
        studyPlan.getTodayStudyPlan(userID,dataValue,function (data) {
            if(data.code == 0){
                player_vm.menuList = [];
                vm.menuList = [];
                player_vm.menuList = data.audioList;
                player_vm.menuList2 = player_vm.menuList;
                vm.menuList = data.audioList;
                if(player_vm.menuList.length>0){
                    for(var i=0;i<player_vm.menuList.length;i++){
                        if(player_vm.menuList[i].id == page.query.audioId){
                            player_vm.currentAudio = player_vm.menuList[i];
                            vm.currentAudio = player_vm.menuList[i];
                            player_vm.playVersion = 0;
                            vm.length = vm.menuList.length;
                            player_vm.selectedIndex = i;
                            player_vm.initialSlide = player_vm.selectedIndex;
                            player_vm.length = player_vm.menuList.length;
                            player_vm.totalTime = timeCountDown.formatTime(player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime);
                            if(!player_vm.currentAudio.needBuyFlag) {
                                vm.freeAudio = true;
                                audio.src = player_vm.currentAudio.versions[0].audioUrl || player_vm.currentAudio.versions[0].audioPath;
                                stopAudio();
                            }else {
                                vm.freeAudio = false;
                                return;
                            }
                        }
                    }
                }else {
                    return;
                }
            }else {
                showToast(data.msg);
            }
        })
    }

})
myApp.onPageAfterAnimation('player',function (page){
    isOrNotEntry();
})

// 是否第一次打卡且第一次进入播放页
function isOrNotEntry() {
    if(localStorage.firstJoinPunchActivity == true.toString() && localStorage.firstJoinPlayPage == undefined){
        localStorage.firstJoinPlayPage = true;
        clickLittleChick();
    }
}

//通过音频id获取列表
function getAudioPlayList(audioId,isbn,albumId,keyword,tagId,teacherId,rankingList,homePage,picBookId) {
    v2Audio.getAudioPlayList(userID,audioId,isbn,albumId,keyword,tagId,teacherId,rankingList,homePage,picBookId,function (data) {
        if(data.code == 0){
            player_vm.menuList = data.audios;
            player_vm.length = player_vm.menuList.length;
            player_vm.menuList2 = player_vm.menuList;
            vm.menuList = player_vm.menuList;
            player_vm.playVersion = 0;
            for (var i=0;i<player_vm.menuList.length;i++){
                if(player_vm.menuList[i].id == audioId){
                    player_vm.currentAudio = player_vm.menuList[i];
                    vm.currentAudio = player_vm.currentAudio;
                    player_vm.initialSlide = i;
                }
            }
            collectionOrNot();
            player_vm.allCurrentTime = 0;
            player_vm.totalTime = timeCountDown.formatTime(player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime);
            setSessionStorage();
            audio.currentTime = 0;
            initAudio();
        }else {
            showToast(data.msg);
        }
    })
}
//同步收藏
function unifyCollection() {
    if(player_vm.currentAudio.collectionFlag){
        $$(".header-rightCollect").html("&#xe62d;");
        player_vm.collectionFlag = true;
    }else {
        $$(".header-rightCollect").html("&#xe609;");
        player_vm.collectionFlag = false;
    }
}

// 音频最后五秒倒计时
function fiveSecondsTime() {
    if(player_vm.currentAudio.versions[player_vm.playVersion + 1]){
        switch(player_vm.playVersion + 1)
        {
            case 0:
                break;
            case 1:
                player_vm.nextVersionTipName = "纯英";
                break;
            default:
                player_vm.nextVersionTipName = "中文";
        }
        showNextVersion = player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime - 5;
    }
    player_vm.nextVersionTipTime = 5;
    var fiveSecondsTime = setInterval(function(){
        if(player_vm.nextVersionTipTime > 1) {
            player_vm.nextVersionTipTime -- ;
            return;
        }else {
            clearInterval(fiveSecondsTime);
            player_vm.nextVersionTipShow = false;
        }
    },1000);
}

function BuyTip(){
    uiTools.showAlert("listenStory","下一个音频为付费音频,请去商城购买~", "", "确定", "取消", function (index) {
        if (index == 1) {
            myApp.showIndicator();
            window.location.href = "../shop/index.html?channel=144";
            myApp.hideIndicator();
        }else {
            mainView.router.back();
        }
    });
}

// 关闭picker
function notOpen() {
    myPicker.inline= false;
    player_vm.setTimeCoverBg = false;
    myPicker.close(); // open Picker
}
//不开启
function noOpened() {
    notOpen();
    clearTimeout(t);
    $$("#time").css("fontSize","25px");
    listenedNum = 0;
    listenStoryNum = 0;
    $$('#time').html("&#xe632;");
}
function selTimeSet() {
    clearTimeout(t);
    $$("#time").css("fontSize","16px");
    switch(myPicker.params.cols[0].activeIndex) {
        case 0:
            $$('#time').html("1/1");
            listenStoryNum = 1;
            break;
        case 1:
            $$('#time').html("1/2");
            listenStoryNum = 2;
            break;
        case 2:
            $$('#time').html("1/3");
            listenStoryNum = 3;
            break;
        case 3:
            $$('#time').html("1/4");
            listenStoryNum = 4;
            break;
        case 4:
            setTimeClose(15);
            break;
        case 5:
            setTimeClose(30);
            break;
        default:
            setTimeClose(60);
            break;
    }
    notOpen();
}

//定时关闭设置
function setTimeClose(timeStr) {
    $$('#time').html(timeStr + ':00');
    var m = (timeStr - 1);
    var s = 59;
    t = setInterval(function() {
        if(s < 10) {
            $$('#time').html(m + ':0' + s);
        } else {
            $$('#time').html(m + ':' + s);
        }
        s--;
        if(s < 0) {
            s = 59;
            m--;
        }
        if(m - 0 == 0 && (s - 0 == 0)) {
            closeTimeout();
            stopAudio();
            $$('#time').html("&#xe632;");
            timeOutSignOver = true;
        }
    }, 1000);
}

//隐藏广告
function downAd() {
    $(".adAnswerImg").animate({
        top: -$(".adAnswerImg").height(),
    },500);
}

//隐藏菜单
function downMenu() {
    $(".upMenu").animate({
        bottom:-300
    },201);
    setTimeout(function(){
        $$(".audioList").hide();
    },200);
}
//收藏的判断
function collectionOrNot() {
    if(vm.currentAudio.collectionFlag){
        $$(".header-rightCollect").html("&#xe62d;");
        player_vm.collectionFlag = true;
    }else {
        $$(".header-rightCollect").html("&#xe609;");
        player_vm.collectionFlag = false;
    }
}

function setSessionStorage() {
    sessionStorage.currentAudio = JSON.stringify(player_vm.currentAudio);
    sessionStorage.menuList = JSON.stringify(player_vm.menuList);
    sessionStorage.selectedIndex = JSON.stringify(player_vm.selectedIndex);
    sessionStorage.playVersion = JSON.stringify(player_vm.playVersion);
}

//设置播放页播放条信息
function setPlayerBar() {
    playerSign = true;
    player_vm.currentAudio = vm.currentAudio;
    collectionOrNot();
    player_vm.selectedIndex = vm.selectedIndex;
    player_vm.initialSlide = vm.selectedIndex;
    player_vm.menuList = vm.menuList;
    player_vm.menuList2 = vm.menuList;
    player_vm.length = player_vm.menuList.length;
    player_vm.totalTime = timeCountDown.formatTime(vm.currentAudio.versions[player_vm.playVersion].playTime + vm.allAdTime);
    setSessionStorage();
    if(isControl) return;
    if(isPlay){
        $(".bigBtnsStyle").html("&#xe631;");
        $(".swiper-slide-active .box").addClass("cover_img");
        $("#timecurrent").text(timeCountDown.formatTime(player_vm.allCurrentTime ));//上面那句快速切换会导致页面值不刷新
    }else {
        setPlayBar();
        setAudioInitTime();
    }


}

myApp.onPageBack('player',function () {
    playerSign = false;
    resetPosition();
    window.clearTimeout(flipTimeout1);
    window.clearTimeout(flipTimeout2);
    funBackOrFrontSign = false;
    $$("#playControl").show();
    $$(".weui_dialog_confirm").hide();
    barPlayOrPause();
    closeTimeout();
    downAd();
    downMenu();
    closeMatchResourceModal();
    sessionStorage.isPlayId = JSON.stringify(player_vm.currentAudio.id);
    if(sessionStorage.currentAudio){
        sessionStorage.removeItem("currentAudio");
        sessionStorage.removeItem("menuList");
    }
    if(sessionStorage.isEntryPage == 1){
        sessionStorage.removeItem("isEntryPage");
    }
});

myApp.onPageReinit('player',function () {
    playerSign = true;
    $$("#playControl").hide();
    setPlayerBar();
    resetPosition();
});

function closeTimeout() {
    clearTimeout(t);
    $$(".setList").children("ul").children("li").removeClass("selectedTime");
    $$('#time .inTime').hide();
    $$('#time .timeIcon').show();
    $$(".middlePlay").html("&#xe61c;");
    $$("#img").removeClass("cover_img");
}


// 进入播放页面
function inPlayer(audioId,mainInto) {
    mainView.router.loadPage({
        url:"player.html?audioId="+ audioId + "&mainInto=" + mainInto
    });
}

// 重置播放音频
function resetAudio() {
    if (player_vm.menuList[player_vm.selectedIndex].needBuyFlag) {
        stopAudio();
        BuyTip();
        return;
    }
    player_vm.currentAudio = player_vm.menuList[player_vm.selectedIndex];
    if(circle == 1){
        player_vm.currentAudio = player_vm.menuList2[player_vm.selectedIndex];
    }
    vm.selectedIndex = player_vm.selectedIndex;
    vm.currentAudio = player_vm.currentAudio;
    audio.currentTime = 0;
    currentTime_ = 0;
    player_vm.playVersion = player_vm.currentAudio.recentPlayVersionIndex;
    vm.playVersion = vm.currentAudio.recentPlayVersionIndex;
    player_vm.allCurrentTime = 0;
    player_vm.totalTime = timeCountDown.formatTime(player_vm.currentAudio.versions[player_vm.playVersion].playTime + player_vm.allAdTime);
    setSessionStorage();
    initAudio();
    playAudio();
    resetAdAnimation();
}

//关闭配套资源模态框
function closeMatchResourceModal() {
    myApp.closeModal();
}

//进入商品详情页
function toGoodDetail() {
    location.href = "../shopOrder/goodDetails.html?goodId=" + player_vm.currentAudio.goodsId + "&_channel=133";
}

//重置翻转动画
function resetAdAnimation() {
    if(player_vm.currentAudio.smallImg){
        window.clearTimeout(flipTimeout1);
        window.clearTimeout(flipTimeout2);
        funBackOrFrontSign = false;
        $(".swiper-slide-active").siblings().children(".box").children(".list").addClass("in").removeClass("out");
        $(".swiper-slide-active").children(".box").children(".list").eq(0).addClass("out").removeClass("in");
        $(".swiper-slide-active").children(".box").children(".list").eq(1).addClass("in").removeClass("out");
        if(player_vm.currentAudio.rotateGoodsImg || player_vm.TurntableDefault[0].image.length>0){
            funBackOrFront();
        }

    }
}

function setPlayBar() {
    if(player_vm.currentAudio.versions[player_vm.playVersion].currentTime > 0){
        var play_ww = parseInt(player_vm.currentAudio.versions[player_vm.playVersion].currentTime + vm.allAdTime) / (parseInt(player_vm.currentAudio.versions[player_vm.playVersion].playTime + vm.allAdTime)) * ($("#bar").width() - 10);
        $("#circle").css("left", play_ww);
        $("#process").width(play_ww);
        if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
            player_vm.allCurrentTime = player_vm.currentAudio.versions[player_vm.playVersion].currentTime + vm.kbPlayTime + vm.preAdPlayTime;
        }else{
            player_vm.allCurrentTime = player_vm.currentAudio.versions[player_vm.playVersion].currentTime + vm.preAdPlayTime;
        }
        $("#timecurrent").text(timeCountDown.formatTime(player_vm.allCurrentTime));//上面那句快速切换会导致页面值不刷新
        if(player_vm.currentAudio.versions[player_vm.playVersion].playTime == 0){
            player_vm.totalTime = timeCountDown.formatTime(vm.currentAudio.versions[vm.playVersion].playTime + vm.allAdTime);
        }
    }else {
        var ww = player_vm.allCurrentTime / (audio.duration + vm.allAdTime) * ($("#bar").width() - 10);
        $("#circle").css("left", ww);
        $("#process").width(ww);
        player_vm.allCurrentTime = vm.allCurrentTime;
        $("#timecurrent").text(timeCountDown.formatTime(player_vm.allCurrentTime));//上面那句快速切换会导致页面值不刷新
    }
    currentTime_ = player_vm.allCurrentTime;
}

//设置音频位置
function setAudioInitTime() {
    if(vm.currentAudio.id<kouboBeginDuan[0] || vm.currentAudio.id>kouboBeginDuan[1]) {
        if (player_vm.allCurrentTime < vm.kbPlayTime) {
            if (vm.isPlayingIndex != 0) {
                vm.isPlayingIndex = 0;
                setSrc(vm.koubo);
            }
            audio.currentTime = player_vm.allCurrentTime;

            currentTime_ = player_vm.allCurrentTime;
        } else if (player_vm.allCurrentTime < (vm.kbPlayTime + vm.preAdPlayTime)) {
            if (vm.isPlayingIndex != 1) {
                vm.isPlayingIndex = 1;
                setSrc(vm.beforeAd);
            }
            audio.currentTime = player_vm.allCurrentTime - vm.kbPlayTime;

            currentTime_ = player_vm.allCurrentTime - vm.kbPlayTime;
        } else if (player_vm.allCurrentTime < (vm.kbPlayTime + vm.preAdPlayTime + player_vm.currentAudio.versions[player_vm.playVersion].playTime)) {
            if (vm.isPlayingIndex != 2) {
                vm.isPlayingIndex = 2;
                setSrc(vm.currentAudio.versions[vm.playVersion]);
            }
            audio.currentTime = player_vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime;

            currentTime_ = player_vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime;
        } else {
            if (vm.isPlayingIndex != 3) {
                vm.isPlayingIndex = 3;
                setSrc(vm.afterAd);
            }
            audio.currentTime = player_vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime - player_vm.currentAudio.versions[player_vm.playVersion].playTime;

            currentTime_ = player_vm.allCurrentTime - vm.kbPlayTime - vm.preAdPlayTime - player_vm.currentAudio.versions[player_vm.playVersion].playTime;

        }


        if (vm.isPlayingIndex == 0) {
            player_vm.addTime = 0;
        } else if (vm.isPlayingIndex == 1) {
            player_vm.addTime = vm.kbPlayTime;
        } else if (vm.isPlayingIndex == 2) {
            player_vm.addTime = vm.kbPlayTime + vm.preAdPlayTime;
        } else if (vm.isPlayingIndex == 3) {
            player_vm.addTime = vm.kbPlayTime + vm.preAdPlayTime + player_vm.currentAudio.versions[vm.playVersion].playTime;
        }
    }else{
        if (player_vm.allCurrentTime < (vm.preAdPlayTime)) {
            if (vm.isPlayingIndex != 1) {
                vm.isPlayingIndex = 1;
                setSrc(vm.beforeAd);
            }
            audio.currentTime = player_vm.allCurrentTime;

            currentTime_ = player_vm.allCurrentTime;
        } else if (player_vm.allCurrentTime < (vm.preAdPlayTime + player_vm.currentAudio.versions[player_vm.playVersion].playTime)) {
            if (vm.isPlayingIndex != 2) {
                vm.isPlayingIndex = 2;
                setSrc(vm.currentAudio.versions[vm.playVersion]);
            }
            audio.currentTime = player_vm.allCurrentTime - vm.preAdPlayTime;

            currentTime_ = player_vm.allCurrentTime - vm.preAdPlayTime;
        } else {
            if (vm.isPlayingIndex != 3) {
                vm.isPlayingIndex = 3;
                setSrc(vm.afterAd);
            }
            audio.currentTime = player_vm.allCurrentTime - vm.preAdPlayTime - player_vm.currentAudio.versions[player_vm.playVersion].playTime;

            currentTime_ = player_vm.allCurrentTime - vm.preAdPlayTime - player_vm.currentAudio.versions[player_vm.playVersion].playTime;

        }


        if (vm.isPlayingIndex == 0) {
            player_vm.addTime = 0;
        } else if (vm.isPlayingIndex == 1) {
            player_vm.addTime = 0;
        } else if (vm.isPlayingIndex == 2) {
            player_vm.addTime =  vm.preAdPlayTime;
        } else if (vm.isPlayingIndex == 3) {
            player_vm.addTime =  vm.preAdPlayTime + player_vm.currentAudio.versions[vm.playVersion].playTime;
        }
    }
}

//图片翻转js
////////////////////////////////////////
// 在前面显示的元素，隐藏在后面的元素

// 确定前面与后面元素
function funBackOrFront() {
    // 纸牌元素们
    eleList = $(".swiper-slide-active").children(".box").children(".list");
    $(".swiper-slide-active").siblings().children(".box").children(".list").addClass("in").removeClass("out");
    eleList.each(function() {
        if ($(this).hasClass("out")) {
            eleBack = $(this);
        } else {
            eleFront = $(this);
        }
    });
    if(!funBackOrFrontSign){
        flipTimeout1 = setTimeout(function () {
            imgFlip(true);
            $(".swiper-slide-active .box").removeClass("cover_img");
        },8000);
        funBackOrFrontSign = true;
    }else {
        flipTimeout1 = setTimeout(function () {
            imgFlip(true);
            if(isPlay){
                $(".swiper-slide-active .box").addClass("cover_img");
            }
        },5000);
        funBackOrFrontSign = false;
    }
};

function imgFlip(goOnFlip) {
    // 切换的顺序如下
    // 1. 当前在前显示的元素翻转90度隐藏, 动画时间225毫秒
    // 2. 结束后，之前显示在后面的元素逆向90度翻转显示在前
    // 3. 完成翻面效果
    eleFront.addClass("out").removeClass("in");
    flipTimeout2 = setTimeout(function() {
        eleBack.addClass("in").removeClass("out");
        if(goOnFlip){
            // 重新确定正反元素
            if(player_vm.currentAudio.rotateGoodsImg || player_vm.TurntableDefault[0].image.length>0){
                funBackOrFront();
            }
        }
    },225);
    return false;
}

//////////////////////////////////////
//初始化rankList.html页面
var rankList_vm;
var rankListSign = false;
myApp.onPageInit('rankList',function () {
    myApp.hideIndicator();
    rankListSign = true;
    if(!playerSign){
        $$("#playControl").show();
    }
    rankList_vm = new Vue({
        el:'#rankList',
        data:{
            audios:[],
            page:0,
            size:10,
            selectedIndex:0,
            currentAudio:{},
            total:0,
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods:{
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== rankList_vm.currentAudio.id || (item.id == rankList_vm.currentAudio.id && rankList_vm.playVersion != versionIndex && !itemIndex) ){
                            rankList_vm.currentAudio = item;
                            vm.currentAudio = item;
                            rankList_vm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = rankList_vm.audios;
                            vm.length = vm.menuList.length;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            rankList_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            getShare:function () {
                onWXReady();
            }
        },
        watch:{
            total:function () {
                this.$nextTick(function(){
                    if(rankList_vm.total>0){
                        $$(".rankList-header-show-One-img").height($$(".rankList-header-show-One-img").width());
                    }
                })
            }
        }
    })
    getRankingList();
    //获取音频排行榜
    function getRankingList() {
        v2Audio.getRankingList(userID,rankList_vm.page,rankList_vm.size,function (data) {
            if(data.code == 0){
                rankList_vm.audios = data.audios;
                rankList_vm.total = data.total;
                onWXReady();
                for (var i=0;i<rankList_vm.audios.length;i++){
                    if(rankList_vm.audios[i].name == vm.currentAudio.name){
                        rankList_vm.currentAudio = rankList_vm.audios[i];
                    }
                }
            }
        })
    }

    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        var imgURL;
        if(rankList_vm.audios[0]){
            imgURL = rankList_vm.audios[0].smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '新东方绘本馆名师故事排行榜';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }
})

myApp.onPageReinit('rankList',function () {
    $$(".floating-button").css("bottom","90px");
    rankList_vm.currentAudio = vm.currentAudio;
    rankList_vm.playVersion = vm.playVersion;
    rankList_vm.getShare();
});
myApp.onPageBack('rankList',function () {
    // pageBack();
    rankListSign = false;
});

// 进入排行榜页面
function inRankList() {
    mainView.router.load({
        url:"rankList.html"
    });
}
//初始化scan.html页面
var scanVm;
var scanSign = false;
var codes = [];
var imgURL;
//控制是否调用二维码接口
var scan = false;
myApp.onPageInit('scan',function () {
    myApp.hideIndicator();
    scanSign = true;
    var codesStorage = localStorage['codes'];
    // var value = decodeURI($$("#searchPageInput").val());
    if(codesStorage==null ){
        localStorage.codes = "[]";
    }
    codes = JSON.parse(localStorage.codes);

    scanVm = new Vue({
        el:'#scan',
        data:{
            list:{},
            selectedIndex:0,
            currentAudio:{},
            scanResult:true,
            audios:[],
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods:{
            scanOneScan:function () {
                scan = true;
                onWXReady();
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            },
            toPlay: function(item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if (item.id !== scanVm.currentAudio.id || (item.id == scanVm.currentAudio.id && scanVm.playVersion != versionIndex && !itemIndex)) {
                            scanVm.currentAudio = item;
                            vm.currentAudio = item;
                            scanVm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            scanVm.selectedIndex = itemIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = scanVm.audios;
                            vm.length = vm.menuList.length;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id, "");
                        } else {
                            myApp.showIndicator();
                            inPlayer("", "");
                        }
                    }
                }
            },
            changeVersion:function (item,version,index) {
                vm.currentAudio = item;
                scanVm.currentAudio = item;
                vm.playVersion = index;
                scanVm.playVersion = index;
                initAudio();
                playAudio();
            },
            getShare:function () {
                onWXReady();
            }
        }
    })

    getAudioByISBN(codes);
    onWXReady();

    function onWXReady() {
        isSubPageShare = 1;
        if(scanVm.audios.length>0){
            imgURL = scanVm.audios[0].smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }

        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '新东方绘本馆扫绘本条形码听故事啦！';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });

        if(scan){
            weiXinTools.scanQRCode(function (bookcode) {
                if(bookcode){
                    inScanResult(bookcode);
                }else {
                    showToast("不能识别此二维码!");
                }
            })
            scan = false;
        }
    }
})

myApp.onPageReinit('scan',function () {
    $$(".floating-button").css("bottom","90px");
    scanVm.currentAudio = vm.currentAudio;
    scanVm.playVersion = vm.playVersion;
    getAudioByISBN(codes);
});

//根据isbn获取音频和专辑列表
function getAudioByISBN(isbn) {
    v2Audio.getAudioByISBN(userID,isbn,function (data) {
        if(data.code == 0){
            scanVm.list =[];
            scanVm.total = 0;
            scanVm.audios = [];
            scanVm.list = data.list;
            scanVm.scanResult = false;
            for (var i=0;i<scanVm.list.length;i++){
                scanVm.total += data.list[i].total;
                scanVm.audios = scanVm.audios.concat(data.list[i].audios);
                for(var j=0;j<scanVm.list[i].audios.length;j++){
                    if(scanVm.list[i].audios[j].name == vm.currentAudio.name){
                        scanVm.currentAudio = scanVm.list[i].audios[j];
                    }
                }
            }
            if(scanVm.audios.length>0){
                imgURL = scanVm.audios[0].smallImg;

            }else {
                imgURL = sessionStorage.storyMainImg;
            }
            scanVm.getShare();

        }
    })
}

myApp.onPageBack('scan',function () {
    scanSign = false;
});



// 进入扫一扫页面
function inScan() {
    mainView.router.load({
        url:"tpl/scan.html"
    });
}
//初始化scanResult.html页面
var scanResult_vm;
var isbn;
myApp.onPageInit('scanResult',function (page) {
    scanResult_vm = new Vue({
        el:'#scanResult',
        data:{
            list:[],
            albums:[],
            audios:[],
            scanCode:isbn,
            currentAudio:{},
            resultShow:true,
            total:0,
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods:{
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            goScan:function () {
                weiXinTools.scanQRCode(function (bookcode) {
                    if(bookcode){
                        getAudioByISBN1(bookcode);
                    }else {
                        $$(".hasResult").hide();
                        $$(".noResult").show();
                    }
                })
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if(item){
                        if(item.id !== scanResult_vm.currentAudio.id || (item.id == scanResult_vm.currentAudio.id && scanResult_vm.playVersion != versionIndex) ){
                            scanResult_vm.currentAudio = item;
                            vm.currentAudio = item;
                            scanResult_vm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = scanResult_vm.audios;
                            vm.length = vm.menuList.length;
                            if(!vm.selectedIndex){
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            scanResult_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }

            },
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            },
            lookShop:function () {
                location.href = "../../shop/index.html";
            },
            handSearch:function () {
                inSearch("","","");
            },
            changeVersion:function (item,version,index) {
                vm.currentAudio = item;
                scanResult_vm.currentAudio = item;
                vm.playVersion = index;
                scanResult_vm.playVersion = index;
                initAudio();
                playAudio();
            }
        },
        watch:{
            albums:function () {
                var mySwiper2 = myApp.swiper('.swiper-5', {
                    freeMode: false,
                    initialSlide :0,
                    paginationClickable: true,
                    preventClicks : false,//默认true
                    preventClicksPropagation:true,
                    spaceBetween: 10,
                    slidesPerView: 2.2,
                    animation:true
                });
            }
        }
    })
    if(page.query.isbn){
        isbn = page.query.isbn;
        getAudioByISBN1(isbn);
    }else {
        $$(".hasResult").hide();
        $$(".noResult").show();
    }

})

//根据isbn获取音频和专辑列表
function getAudioByISBN1(isbn) {
    v2Audio.getAudioByISBN(userID,isbn,function (data) {
        if(data.code == 0){
            scanResult_vm.albums = data.list[0].albums;
            scanResult_vm.audios = data.list[0].audios;
            for (var i=0;i<scanResult_vm.audios.length;i++){
                if(scanResult_vm.audios[i].name == vm.currentAudio.name){
                    scanResult_vm.currentAudio = scanResult_vm.audios[i];
                }
            }
            vm.menuList = data.list[0].audios;
            vm.length = vm.menuList.length;
            scanResult_vm.total = data.list[0].total;
            if(scanResult_vm.total == 0){
                $$(".hasResult").hide();
                $$(".noResult").show();
            }else {
                $$(".noResult").hide();
                $$(".hasResult").show();
                $$("#barCode span").html(isbn);
                codes.push(isbn);
                codes.reverse();
                codes = codes.unique();
                localStorage['codes'] = JSON.stringify(codes);
            }

        }
    })
}

myApp.onPageReinit('scanResult',function () {
    $$(".floating-button").css("bottom","90px");
    scanResult_vm.currentAudio = vm.currentAudio;
    scanResult_vm.playVersion = vm.playVersion;
    $$(".hasResult").hide();
    $$(".noResult").show();
    getAudioByISBN1(isbn);
});
//进入扫一扫结果页
function inScanResult(isbn) {
    mainView.router.load({
        url:"tpl/scanResult.html?isbn=" + isbn
    });
}
//初始化search.html页面
var search_vm;
var tab = 0;
var lastName;
var searchSign = false;
var  shareKeyword;
var mySwiper3;
myApp.onPageInit('search',function (page) {
    myApp.hideIndicator();
    searchSign = true;
    $$("#playControl").show();
    lastName = page.fromPage.name;
    if(sessionStorage.currentAudio){
        sessionStorage.removeItem("currentAudio");
        sessionStorage.removeItem("menuList");
    }
    search_vm = new Vue({
        el: '#search',
        data: {
            page:0,
            size:10,
            albumPage:0,
            albumSize:50,
            searchList:[],
            searchList_1:[],
            searchList_2:[],
            searchList_2_sub:[],
            total:0,
            tipList: names,
            tab:0,
            shareWord:'',
            playVersion:vm.playVersion,
            currentAudio:{},
            tags:[],
            tagsTip:false,
            typeArr:[],
            currentTagId:"",
            keyword:decodeURI(page.query.keyword)?decodeURI(page.query.keyword):'',
            keywords:[],
            initialSlide:0,
            allAdTime:vm.allAdTime,
            tagItemsShow:false,
            tagIndex:'',
            tagArr:[],
            tagIdArray:[],
            tagIdStr:'',
            clickSearchSign:true,
            lookAll:page.query.lookAll == 1?true:false,
            tagIndexChanged:false,
            chooseTagSign:false,
            overHideSign:false
        },
        methods: {
            searchBtn:function () {
                inputBlur();
                search_vm.keyword = $$("#searchPageInput").val()?$$("#searchPageInput").val():'';
                search_vm.searchList = [];
                search_vm.page = 0;
                search_vm.searchList_2 = [];
                setHistoryList(search_vm.keyword);
                getAudioAndAlbum(search_vm.tagIdStr);
                sessionStorage.searchKeyword = $$("#searchPageInput").val();
                // myApp.accordionClose(".accordion-item"); // - 关闭指定条目
                search_vm.tagsTip = false;
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            sousuo:function () {
                inputFocus();
                $("#playControl").hide();
                $(".punch-MainBtn").hide();
            },
            noSousuo:function () {
                $("#playControl").show();
                $(".punch-MainBtn").show();
            },
            tipJump:function (item) {
                $$("#searchPageInput").val(item);
                sessionStorage.searchKeyword = item;
                search_vm.keyword = item;
                search_vm.searchList = [];
                search_vm.page = 0;
                search_vm.searchList_2 = [];
                setHistoryList(search_vm.keyword);
                getAudioAndAlbum(search_vm.currentTagId);
                shareKeyword = item;
                sessionStorage.setItem("searchKeyword",search_vm.keyword);
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== search_vm.currentAudio.id || (item.id == search_vm.currentAudio.id && search_vm.playVersion != versionIndex && !itemIndex) ){
                            search_vm.currentAudio = item;
                            vm.currentAudio = item;
                            search_vm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = search_vm.searchList;
                            vm.length = vm.menuList.length;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            search_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                    $$("#playControl").hide();
                }

            },
            toTeachDetail:function (id) {
                inTeachDetail(id);
            },
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            },
            getShare:function () {
                onWXReady();
            },
            showOrNotTags:function () {
                search_vm.tagsTip = search_vm.tagsTip?false:true;
                if(search_vm.tagsTip){
                    $$("#accordion-item").addClass("accordion-item-expanded");
                }else {
                    $$("#accordion-item").removeClass("accordion-item-expanded");
                }
            },
            scanOneScan:function () {
                scan = true;
                onWXReady();
            },
            changeTag:function (tagId,accordion,tag) {
                if($$("#searchPageInput").val()){
                    search_vm.keyword = $$("#searchPageInput").val();
                    search_vm.searchList = [];
                    search_vm.page = 0;
                    search_vm.searchList_2 = [];
                    if(tagId){
                        search_vm.currentTagId = tagId;
                        if(tag === 'tag'){
                            for(var i=0;i<search_vm.tags.length;i++){
                                if(search_vm.tags[i].id == tagId){
                                    search_vm.initialSlide = parseInt(search_vm.tags.indexOf(search_vm.tags[i])) + 1;
                                }
                            }
                            var tagsChange = search_vm.tags;
                            search_vm.tags = [];
                            search_vm.tags = tagsChange;
                        }
                    }else {
                        search_vm.currentTagId = '';
                        $$(".swiper-3 .swiper-wrapper").css("transform",'translate3d(0px, 0px, 0px)');
                        search_vm.initialSlide = 0;
                        var tagsChange = search_vm.tags;
                        search_vm.tags = [];
                        search_vm.tags = tagsChange;
                    }

                    getAudioAndAlbum(search_vm.currentTagId);
                    if(accordion){
                        myApp.accordionClose(".accordion-item"); // - 关闭指定条目
                        search_vm.tagsTip = false;
                    }
                }else {
                    if(sessionStorage.searchKeyword){
                        search_vm.keyword = sessionStorage.searchKeyword;
                        search_vm.searchList = [];
                        search_vm.page = 0;
                        search_vm.searchList_2 = [];
                        if(tagId){
                            search_vm.currentTagId = tagId;
                            if(tag === 'tag'){
                                for(var i=0;i<search_vm.tags.length;i++){
                                    if(search_vm.tags[i].id == tagId){
                                        search_vm.initialSlide = parseInt(search_vm.tags.indexOf(search_vm.tags[i])) + 1;
                                    }
                                }
                                var tagsChange = search_vm.tags;
                                search_vm.tags = [];
                                search_vm.tags = tagsChange;
                            }
                        }else {
                            search_vm.currentTagId = '';
                            $$(".swiper-3 .swiper-wrapper").css("transform",'translate3d(0px, 0px, 0px)');
                            search_vm.initialSlide = 0;
                            var tagsChange = search_vm.tags;
                            search_vm.tags = [];
                            search_vm.tags = tagsChange;
                        }

                        getAudioAndAlbum(search_vm.currentTagId);
                        if(accordion){
                            myApp.accordionClose(".accordion-item"); // - 关闭指定条目
                            search_vm.tagsTip = false;
                        }
                    }else {
                        showToast("请输入关键字!");
                    }

                }
            },
            lookAllAlbums:function () {
                $$(".moreAlbums").hide();
                search_vm.searchList_2_sub = search_vm.searchList_2;
            },
            toTop:function (event) {
                event.stopPropagation();
                $$('#searchToTop').scrollTop(0,1000);
            },
            showTagItem:function (index) {
                search_vm.tagIndex = index;
                search_vm.chooseTagSign = true;
                $$(".swiper-3").find(".swiper-slide").eq(index).addClass("swiper-slide-active");
                $$(".swiper-3").find(".swiper-slide").eq(index).children("span.iconfont").addClass("rowRotate");
                $$(".swiper-3").find(".swiper-slide").eq(index).siblings().children("span.iconfont").removeClass("rowRotate");
                $$(".swiper-3").find(".swiper-slide").eq(index).siblings().removeClass("swiper-slide-active");
                $$(".swiper-slide-items-ul").hide();
                $$(".swiper-slide-items").show();
                search_vm.overHideSign = true;
                $$(".swiper-slide-items-ul").eq(index).show();

            },
            closeTagItems:function () {
                resetTabStyle();
            },
            chooseTag:function (index,item) {
                $$(".swiper-3").find(".swiper-slide").eq(search_vm.tagIndex).children("#tagName").text(item.name);
                $$(".swiper-slide-items-ul").eq(search_vm.tagIndex).find(".swiper-slide-items-li").eq(index+1).addClass("swiper-slide-items-li-active").siblings().removeClass("swiper-slide-items-li-active");
                resetTabStyle();
                for(var i=0;i<search_vm.tagIdArray.length;i++){
                    if(search_vm.tagIdArray[i] == item.id){
                        return;
                    }
                }

                var compArr = search_vm.typeArr[search_vm.tagIndex].list;
                for (var j=0;j<search_vm.tagIdArray.length;j++){
                    for(var k=0;k<compArr.length;k++){
                        if(search_vm.tagIdArray[j] == compArr[k].id){
                            arrayFunction.delItemInArr(search_vm.tagIdArray,compArr[k].id);
                            var pattern = "," + compArr[k].id;
                            search_vm.tagIdStr = search_vm.tagIdStr.replace(new RegExp(pattern), "");
                        }
                    }
                }

                search_vm.tagIdArray.push(item.id);
                search_vm.tagIdStr = search_vm.tagIdStr + "," + item.id;
                search_vm.searchList = [];
                search_vm.page = 0;
                search_vm.searchList_2_sub = [];
                getAudioAndAlbum(search_vm.tagIdStr);
            },
            choooseFirstTage:function (name) {
                $$(".swiper-slide-items-ul").eq(search_vm.tagIndex).find(".swiper-slide-items-li").each(function(){
                    if($(this).hasClass("swiper-slide-items-li-active")){
                        var tagId_clear = $$(".swiper-slide-items-ul").eq(search_vm.tagIndex).children(".swiper-slide-items-li-active").attr("data-id");
                        for(var i=0;i<search_vm.tagIdArray.length;i++){
                            if(search_vm.tagIdArray[i] == tagId_clear){
                                search_vm.tagIdArray.splice(i, 1);
                                var pattern = "," + tagId_clear;
                                search_vm.tagIdStr = search_vm.tagIdStr.replace(new RegExp(pattern), "");
                                break;
                            }
                        }
                    }
                })
                $$(".swiper-3").find(".swiper-slide").eq(search_vm.tagIndex).children("#tagName").text("不限"+name);
                $$(".swiper-slide-items-ul").eq(search_vm.tagIndex).find(".swiper-slide-items-li").eq(0).addClass("swiper-slide-items-li-active").siblings().removeClass("swiper-slide-items-li-active");
                resetTabStyle();
                search_vm.searchList = [];
                search_vm.page = 0;
                search_vm.searchList_2_sub = [];
                getAudioAndAlbum(search_vm.tagIdStr);
            }
        },
        watch:{
            shareWord:function () {
                onWXReady();
            },
            tags:function () {
                mySwiper3 = myApp.swiper('.swiper-3', {
                    preventClicks : false,//默认true
                    paginationClickable: false,
                    freeMode : true,
                    preventClicksPropagation:true,
                    slidesPerView: 4,
                    resistanceRatio: 0,   //抵抗率:值越小抵抗越大越难将slide拖离边缘，0时完全无法拖离,
                    touchAngle : 10,
                    longSwipesMs : 1000,
                    longSwipes:false,
                    touchMoveStopPropagation : false,
                    initialSlide:search_vm.initialSlide,
                    // observer:true,
                    observeParents:true
                });
                $$(".swiper-3").find(".swiper-slide").removeClass("swiper-slide-active");
            },
            tagIndex:function () {
                search_vm.tagIndexChanged = true;
            }
        }
    })

    if(search_vm.keyword && search_vm.keyword != "undefined"){
        $$("#searchPageInput").val(search_vm.keyword);
        sessionStorage.searchKeyword = search_vm.keyword;
        getAudioAndAlbum(search_vm.currentTagId);
    }else {
        if(search_vm.lookAll){
            search_vm.keyword = "";
            getAudioAndAlbum(search_vm.currentTagId);
        }
    }

    getAudioAllTag();
    getHotWords();
    backTop();

    // 搜索关键字缓存
    function keywordCache() {
        if(namesStorage!=null && namesStorage!= ""){
            names = JSON.parse(namesStorage);
        }else{
            localStorage.shopNames = [];
            names = [];
        }
    }

    // 获取搜索页音频和专辑
    function getAudioAndAlbum(tagId) {
        search_vm.clickSearchSign = false;
        audioSearch(decodeURI(search_vm.keyword),"",tagId);
        if(decodeURI(search_vm.keyword) && decodeURI(search_vm.keyword) != "undefined"){
            albumSearch(decodeURI(search_vm.keyword),"album",tagId);
        }else {
            search_vm.searchList_2 = [];
            search_vm.searchList_2_sub = [];
        }
        onWXReady();
        setHistoryList(search_vm.keyword);
    }

    // 还原搜索页tab样式
    function resetTabStyle() {
        search_vm.chooseTagSign = false;
        $$(".swiper-slide-items-ul").hide();
        $$(".swiper-slide-items").hide();
        search_vm.overHideSign = false;
        $$(".swiper-3").find(".swiper-slide").eq(search_vm.tagIndex).children("span.iconfont").removeClass("rowRotate");
    }

    //搜索专辑
    function albumSearch(keyword,type,tagId) {
        v2Audio.audioSearch(userID,tagId,search_vm.albumPage,search_vm.albumSize,keyword,type,function (data) {
            if (data.code == 0){
                search_vm.shareWord = keyword;
                search_vm.searchList_2 = data.albums;
                if(search_vm.searchList_2 && search_vm.searchList_2.length>0){
                    search_vm.searchList_2_sub = search_vm.searchList_2.slice(0, 4);
                }else {
                    search_vm.searchList_2_sub = [];
                }
            }else {
                showToast(data.msg);
            }
        })
    }

    // js回到顶部
    function backTop() {
        $$("#searchToTop").scroll(function(){
            if ($$("#searchToTop").scrollTop()>700){//如果滚动条顶部的距离大于topMain则就nav导航就添加类.nav_scroll，否则就移除。
                $$(".backTop").show();
            }
            else
            {
                $$(".backTop").hide();
            }
        });
    }

    function inputFocus() {
        $$(".search-form input").css("background","#fff");
        $$(".search-form input").css("color","#000");
        $$(".search-txt").css("color","#60D67D");
        $$(".search-icon").css("color","#60D67D");
    }
    function inputBlur() {
        $$(".search-form input").css("background","rgba(255, 255, 255, 0.2)");
        $$(".search-form input").css("color","#fff");
        $$(".search-txt").css("color","#fff");
        $$(".search-icon").css("color","#fff");
    }


    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        // 分享功能
        var imgURL;
        if(search_vm.searchList[0]){
            imgURL = search_vm.searchList[0].smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0] + "?keyword=" + search_vm.shareWord;
        if(userHasStore) {
            linkURL += "&fromUserId=" + userID;
        } else {
            linkURL += "&fromUserId=" + fromUserId;
        }
        var title =  '快来听关于「'+ search_vm.shareWord +'」的音频故事吧！';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });

        //唤起扫一扫功能
        if(scan){
            scan = false;
            weiXinTools.scanQRCode(function (bookcode) {
                if(bookcode){
                    inScanResult(bookcode);
                }else {
                    showToast("不能识别此二维码!");
                }
            })
        }
    }

    //获取所有故事分类
    function getAudioAllTag() {
        v2Audio.getAudioAllTag(function (data) {
            if(data.code == 0){
                search_vm.typeArr = data.tags;
                for(var i=0;i<search_vm.typeArr.length;i++){
                    for(var j=0;j<search_vm.typeArr[i].list.length;j++){
                        search_vm.tags.push(search_vm.typeArr[i].list[j]);
                    }
                }
            }else {
                showToast(data.msg);
            }

        })
    }

    // 获取热门搜索关键词
    function getHotWords() {
        commonService.getDictDataListByCode("storyHotSearch", function (data) {
            if (data.code == 0) {
                search_vm.keywords = data.list;
                search_vm.keywords = search_vm.keywords.slice(0,5);
            }
        })
    }
})

myApp.onPageBack('search',function () {
    searchSign = false;
    sessionStorage.removeItem("searchKeyword");
});
myApp.onPageReinit('search',function () {
    $$(".floating-button").css("bottom","90px");
    search_vm.getShare();
    search_vm.searchList = [];
    search_vm.page = 0;
    audioSearch(decodeURI(search_vm.keyword),0,search_vm.tagIdStr);
    search_vm.playVersion = vm.playVersion;
});

//搜索音频
function audioSearch(keyword,type,tagId) {
    v2Audio.audioSearch(userID,tagId,search_vm.page,search_vm.size,keyword,type,function (data) {
        if (data.code == 0){
            search_vm.shareWord = keyword;
            search_vm.searchList = search_vm.searchList.concat(data.audios);
            for(var i=0;i<search_vm.searchList.length;i++){
                if(search_vm.searchList[i].id == vm.currentAudio.id){
                    search_vm.currentAudio = search_vm.searchList[i];
                }
            }
            downLoadMore2.down($('.search-audio-style'), data.audios.length, search_vm.size, function () {
                search_vm.page++;
                audioSearch(decodeURI(search_vm.keyword),"",search_vm.tagIdStr);
            });
        }else {
            showToast(data.msg);
        }

    })
}
// 进入搜索页面
function inSearch(keyword,clickSearchBtn,clickAll) {
    mainView.router.load({
        url:"tpl/search.html?keyword=" + keyword + "&clickSearchSign=" + clickSearchBtn + "&clickAll=" + clickAll
    });
}
/**
 * Created by chenzhiliang on 17/9/21.
 */
    //初始化albumDetail.html页面
var storyPunch_vm;
var thisYear = new Date().getFullYear();
var thisMonth = new Date().getMonth() + 1;
var thisDate = new Date().getDate();
var newCalendarArr = [];
var storyPunchSign = false;
var creatDivT;
var getDivT;
var yuanzaiSpeakTimes = 1;
var yzShowStatus;
var firstLoadData;
var todayDate = thisYear + '-' + thisMonth + '-' + thisDate;
var tomorrowDate = thisYear + '-' + (parseInt(thisMonth)) + '-' + thisDate;
myApp.onPageInit('storyPunch',function (page) {
    storyPunchSign = true;
    firstLoadData = false;
    var fromPlayer = page.query.fromPlayer;
    var swiperEntry = page.query.swiperEntry;
    playerSign = false;
    resetYZModalPosition()
    //resetPosition();

    $$("#playControl").show();
    storyPunch_vm = new Vue({
        el: '#storyPunch',
        data: {
            punchStatus:false,
            continuePunchDay:0,
            position:0,
            calDays:[],
            rank:[],
            restRank:[],
            todayPunch:'',
            continue7dayCredits:ydyContinue7dayCredits,
            punchCredits:ydyPunchCredits,
            shareCredits:ydyShareCredits,
            punchIdentify:ydyPunchIdentify,
            calendar:[],
            position:[],
            totalPunchDays:0,
            alreadyShare:false,
            punchMainModalShow:false,
            showed:true,
            credits:0,
            yuanzaiShow:false,
            restPunchTime:10,
            studyTime:0,
            seventhDay:false,
            recommendGoodsList:[],
            rgList:[],
            freeTimes:0,
            punStatusBool:false,
        },
        methods: {
            playPunch:function () {
                inStoryPunch(1);
            },
            punchCal:function () {
                var succModal = myApp.modal({
                    text:'<div class="content-block punchCal-content-block">'+
                        '<div class="punch-success-topImg"> <img src="img/teacher-shaomai1.jpg" alt=""></div>'+
                        '<div class="content-block-inner">'+
                        '<div id="calendar-inline-container"></div></div>'+
                        '<div class="punch-success-bottomBtn">参加夺宝赢取奖品</div>'+
                        '<div class="punch-success-close iconfont" onclick="closeSuccModal()">&#xe650;</div></div>',
                })
            },
            backHome:function () {
                if(page.fromPage.name === 'main'){
                    mainView.router.back();
                    storyPunchSign = false;
                }else {
                    storyPunchSign = false;
                    location.href = "https://www.dayutang.cn/story/main.html";
                }
            },
            showCal:function () {
                closeSuccModal();
                var calModal = myApp.modal({
                    text:'<div id="calendar-inline-container" class="cal-content">' +
                    '<div class="cal-content-topInfo">' +
                    '<div class="left-topInfo"><img src="img/caiDai_left.png" alt=""></div>'+
                    '<div class="yuanzai-topInfo"><img src="img/yuanzai_calImg.png" alt=""></div>'+
                    '<div class="right-topInfo"><img src="img/caiDai_right.png" alt=""></div>'+
                    '<p class="punchDay-tip"><span id="punchDay-tip-content"></span><span class="bottomLine-topInfo"></span></p></div>' +
                    '<div class="cal-content-bottomInfo" onclick="jumpOtherPage()">去听故事首页</div>' +
                    '<div class="cal-content-closeModal iconfont" onclick="closeModal()">&#xe66f;</div></div></div>'
                })

                initCalPunch();
            },
            toTop:function (event) {
                event.stopPropagation();
                $$('.page-content').scrollTop(0,1000);
            },
            formateDate:function (str) {
                var thisYear = str.split("-")[0];
                var thisMonth = str.split("-")[1];
                var thisDay = str.split("-")[2];
                var result = parseInt(thisMonth) +"."+parseInt(thisDay);
                var todayYear = new Date().getFullYear();
                var todayMonth = new Date().getMonth()+1;
                var todayDay = new Date().getDate();
                var tomorrowDay = new Date().getDate() + 1;
                if(parseInt(thisYear) === todayYear && (parseInt(thisMonth) === todayMonth) &&(parseInt(thisDay) === todayDay)){
                    result = "今日";
                }else if(parseInt(thisYear) === todayYear && (parseInt(thisMonth) === todayMonth) &&(parseInt(thisDay) === tomorrowDay)){
                    result = "明日";
                }
                return result;
            },
            shareFriend:function () {
                shareTipModal();
            },
            luckyDB:function (isShop) {
                if(isShop){
                    location.href = "https://www.dayutang.cn/goldMall/goldMall.html";
                }else {
                    location.href = "https://www.dayutang.cn/treasureHunt/main.html";
                }
            },
            closePunchModal:function () {
                storyPunch_vm.punchMainModalShow = false;
            },
            storyPunchModal:function () {
                V2AudioNew.punchStatus(userID,function (data) {
                    if(data.code == 0){
                        storyPunch_vm.punchStatus = data.punchStatus >= 1?true:false;
                        if(!storyPunch_vm.punchStatus ){
                            shareTipModal();
                        }
                        storyPunch_vm.continuePunchDay = data.continuePunchDay;
                        storyPunch_vm.alreadyShare =  data.punchStatus==2?true:false;
                        storyPunch_vm.taskId = data.taskId;
                        storyPunch_vm.seventhDay = data.seventhDay;
                        if(storyPunch_vm.seventhDay){
                            if(!firstLoadData){
                                storyPunch_vm.punchCredits = ydyPunchCredits;
                                firstLoadData = true;
                            }
                        }
                        // punchCalendar(storyPunch_vm.taskId,todayDate,tomorrowDate);
                        userCredits();
                        //storeRanking();
                        if(storyPunch_vm.taskId){
                            //goPunch(storyPunch_vm.goPunch(storyPunch_vm.taskId);
                            todayPosistion(storyPunch_vm.taskId);
                        }
                    }else {
                        showToast(data.msg);
                    }
                    storyPunch_vm.onWXReady()
                })
            },
            addLockFans: function () {//添加锁粉
                var fromUserId = getQuery("fromUserId");//formUserId获取
                request("LockFans", "addLockFansReocrd", {
                    userId: userID,
                    token: token,
                    fromUserId: fromUserId,
                    modular: 'story'
                }, function(data) {
                    if(data.code == 0){}
                })
            },
            toGoodDetail:function (one) {
                location.href = "https://www.dayutang.cn/goldMall/goldMall.html#!/tpl/goodDetail.html?goodsId="+one.id+"&nowExchange=0&isEntity=1"
            },
            toGoldMall:function () {
                location.href = "https://www.dayutang.cn/goldMall/goldMall.html";
            },
            // 调用微信相关
            onWXReady:function(){
                var imgURL = "https://www.dayutang.cn/story/img/punchShareImg.jpeg";
                var title =  '听新东方绘本故事打卡领奖励啦，一起来打卡吧!';;
                if(!storyPunch_vm.punchStatus){
                    linkURL = "https://www.dayutang.cn/story/listenStoryClockPage"+getRandomNum()+".html?fromUserId="+ userID+"&continuePunchDay="+(parseInt(storyPunch_vm.continuePunchDay)+1);
                    title = '我在新东方听'+vm.currentAudio.classDes+'故事，第'+(parseInt(storyPunch_vm.continuePunchDay)+1)+'天打卡中';
                }else{
                    linkURL = "https://www.dayutang.cn/story/listenStoryClockPage"+getRandomNum()+".html?fromUserId="+ userID+"&continuePunchDay="+storyPunch_vm.continuePunchDay;
                    title = '我在新东方听'+vm.currentAudio.classDes+'故事，我已打卡'+ storyPunch_vm.continuePunchDay +'天';
                }

                // if(vm.currentAudio.classFree != 0 && vm.currentAudio.classDes && StringTools.strlen(vm.currentAudio.classDes)<=16){
                //     if(storyPunch_vm.continuePunchDay == 0){
                //         title = '我在新东方听'+vm.currentAudio.classDes+'故事，第1天打卡中';
                //     }else {
                //         title = '我在新东方听'+vm.currentAudio.classDes+'故事，我已打卡'+ storyPunch_vm.continuePunchDay +'天';
                //     }
                // }
                var desc =  '俞敏洪老师邀请你和宝贝来听新东方名师讲绘本';
                weiXinTools.showFavoriteMenu();
                weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
                    shareCredits();
                    storyPunch_vm.storyPunchModal();
                });
                weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
                    //punchSuccessShare();
                    closeSuccModal();
                    showToast("只有分享到朋友圈才算打卡哦！")
                });
            }
        },
        watch:{
            position:function () {
                this.$nextTick(function(){
                    SevenDaysLineStyle();
                })
            },
            punchStatus:function () {
                storyPunch_vm.onWXReady();
                todayPosistion(storyPunch_vm.taskId);
            },
            studyTime:function () {
                if(!punchSuccessSign){
                    if(parseInt(storyPunch_vm.studyTime/60)>=10){
                        punchSuccessSign = true;
                    }else {
                        storyPunch_vm.restPunchTime = 10 - parseInt(storyPunch_vm.studyTime/60);
                        storyPunch_vm.punchIdentify = storyPunch_vm.restPunchTime;
                        if(storyPunchSign){
                            if(storyPunch_vm.punchIdentify == 10){
                                $(".punch-process-content").css("width","13px");
                            }else {
                                $(".punch-process-content").width(parseInt(10-storyPunch_vm.punchIdentify)*10 + "%");
                            }
                        }
                    }
                }

            },
            rgList:function () {
                var mySwiper = myApp.swiper('.swiper-exchangeGoods', {
                    pagination:'.swiper-pagination',
                    slidesPerView: 1.2
                });
            }
        }
    });
    if(swiperEntry == 1){
        joinActivity();
    }else {
        init();
    }

    // 初始化页面数据
    function init() {
        if(localStorage.firstJoinPunchActivity == true.toString() && localStorage.firstJoinPunchPage == undefined){
            firstEntryPage();
            localStorage.firstJoinPunchPage = true;
        }

        yzShowStatus = setInterval(function () {
            if(yuanzaiSpeakTimes>2){
                clearInterval(yzShowStatus);
                // return;
            }else {
                yuanzaiShowStatus();
                yuanzaiSpeakTimes ++;
            }
        },5000);
        initCalPunch();
        storyPunch_vm.storyPunchModal();
        getRecommendCreditsGoodsList();
        getCreditsLotteryCert();
    }

    //用户是否参与打卡
    function joinActivity() {
        v2AudioPunch.joinActivity(userID,function (data) {
            if(data.code == 0){
                vm.taskId = data.taskId;
                localStorage.firstJoinPunchActivity = true;
                vm.joinPunch = true;
                init();
            }else {
                showToast(data.msg);
            }
        })
    }

    // 圆仔说话显示状态
    function yuanzaiShowStatus() {
        storyPunch_vm.yuanzaiShow = !storyPunch_vm.yuanzaiShow;
        if(storyPunch_vm.yuanzaiShow){
            $(".yuanzai-tipModal").show();
            $(".yuanzai-tipModal").animate({
                opacity: 1,
                left: 0
            },"slow","linear");
        }else {
            $(".yuanzai-tipModal").animate({
                left: "-82px",
                opacity: 0
            },"slow","linear",function () {
                $(".yuanzai-tipModal").hide();
            });
        }
    }

    //初始化七天打卡连线样式
    function SevenDaysLineStyle(){
        var punchDayRightLine;
        var punchDayMargin;
        var screen = document.body.clientWidth;

        if(screen>=375){
            punchDayMargin = (screen-130)/7-30;
        }else {
            punchDayMargin = (screen-130)/7-25;
        }
        punchDayRightLine = punchDayMargin + 16;
        $$(".punch-rightLine").css("width",parseInt(punchDayRightLine)+"px");
        $$(".punch-rightLine").css("right",-punchDayRightLine+"px");
    }

    // 获取用户魔法石数量
    function userCredits() {
        v2AudioPunch.userCredits(userID,function (data) {
            if(data.code == 0){
                storyPunch_vm.credits = data.credits;
            }else {
                showToast(data.msg);
            }
        })
    }

    // 听故事打卡排行榜
    function storeRanking() {
        v2AudioPunch.storeRanking(userID,function (data) {
            if(data.code == 0){
                console.log(data);
                storyPunch_vm.rank = data.rank;
                storyPunch_vm.restRank = data.rank.slice(1);
            }else {
                showToast(data.msg);
            }
        })
    }


    // 初始化打卡日历
    function initCalPunch() {
        var monthNames = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月' , '9月' , '10月', '11月', '12月'];
        var startDate;
        var endDate;
        var calendarInline = myApp.calendar({
            container: '#calendar-inline-container',
            value: [new Date()],
            disabled: {
                from: new Date(1990, 1, 1),
                to: new Date(3000, 1, 1)
            },
            weekHeader: true,
            dayNamesShort:['周日','周一','周二','周三','周四','周五','周六'],
            toolbarTemplate:
            '<div class="toolbar calendar-custom-toolbar">' +
            '<div class="toolbar-inner">' +
            '<div class="left">' +
            '<a href="#" class="link icon-only"><i class="icon icon-back"></i></a>' +
            '</div>' +
            '<div class="center"></div>' +
            '<div class="right">' +
            '<a href="#" class="link icon-only"><i class="icon icon-forward"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>',
            onOpen: function (p) {
                $$('.calendar-custom-toolbar .center').text(p.currentYear+'年'+ monthNames[p.currentMonth]);
                $$('.picker-calendar-day-prev').attr("disabled","disabled");
                $$('.picker-calendar-day-next').attr("disabled","disabled");
                $$('.calendar-custom-toolbar .left .link').on('click', function () {
                    calendarInline.prevMonth();
                });
                $$('.calendar-custom-toolbar .right .link').on('click', function () {
                    calendarInline.nextMonth();
                });
            },
            onMonthYearChangeStart: function (p) {
                thisYear = p.currentYear;
                thisMonth = p.currentMonth + 1;
                changeCalAction();
                $$('.calendar-custom-toolbar .center').text(p.currentYear+'年'+ monthNames[p.currentMonth]);
            }
        });
        // if(storyPunch_vm.punchStatus){
        //     $$(".cal-content-bottomInfo").text('去听故事首页');
        // }
        startDate = calendarInline.currentYear + "-" + (calendarInline.currentMonth+1) + "-" + "1";
        endDate = calendarInline.currentYear + "-" + (calendarInline.currentMonth+1) + "-" + timeCountDown.getLastDay(calendarInline.currentYear,calendarInline.currentMonth+1);
        if(window.screen.availWidth - 359<=0){
            $$(".picker-calendar").css("height","280px");
        }
        punchCalendar(vm.taskId,startDate,endDate);
    }


    //获取并设置打卡日期
    function punchCalendar(taskId,startDate,endDate) {
        v2AudioPunch.punchCalendar(userID,taskId,startDate,endDate,function (data) {
            if(data.code == 0){
                var thisMonthDays = timeCountDown.mGetDate(thisYear,thisMonth);
                storyPunch_vm.calendar = data.calendar;
                storyPunch_vm.totalPunchDays = data.totalPunchDays;
                storyPunch_vm.onWXReady();
                $$("#punchDay-tip-content").text('累计打卡'+storyPunch_vm.totalPunchDays+'天');
                for(var i=0;i<storyPunch_vm.calendar.length;i++){
                    newCalendarArr.push(storyPunch_vm.calendar[i].split("-")[2]);
                }
                for(var j=0;j<=thisMonthDays;j++){
                    for(var k=0;k<newCalendarArr.length;k++){
                        if(j == newCalendarArr[k]){
                            $("[data-day = "+j+"]").addClass("punchDay");
                            if(j == thisDate){
                                $(".picker-calendar-day-today").addClass("punchDay");
                            }
                        }
                    }
                }
            }
        })
    }

    // 切换日历动作
    function changeCalAction() {
        newCalendarArr = [];
        $(".picker-calendar-month-current").find(".picker-calendar-day").removeClass("punchDay");
        startDate = thisYear + "-" + thisMonth + "-" + "1";
        endDate = thisYear + "-" + thisMonth + "-" + timeCountDown.getLastDay(thisYear,thisMonth);
        punchCalendar(vm.taskId,startDate,endDate);
    }

    // 分享成功获得积分
    function shareCredits() {
        V2AudioNew.goPunch(userID,vm.taskId,"",function (data) {
            closeSuccModal();
            var num = parseInt(ydyPunchCredits);
            if(vm.seventhDay){
                num = parseInt(ydyPunchCredits) * 4;
            }
            if(data.punchStatus && data.hasOwnProperty("punchCredits") && data.punchCredits>0){
                if(data.hasOwnProperty("storyCredits") && data.storyCredits>0){
                    punchStatusModal('打卡成功并完成学习',(parseInt(num) + 3),'超级棒！你已经完成今天<br>的打卡任务啦~继续加油哦!',4);
                    $(".punchBtn_red").hide();
                    //punchStatusModal('听完故事啦',"3",'每连续打卡第7天还可以获得4倍奖励(24颗魔法石）哦!',3);
                }else{
                    punchStatusModal('恭喜打卡成功',num,'今日听完任意故事还可以 <br>再获得3颗魔法石哦!',2);//最后的参数是判断哪种显示弹框的类型
                }
            }

            handleGoPunchData(data);
            goPunchDataTimes = 1;
            vm.punchStatus = true;
            storyPunch_vm.punchStatus = true;
        })
    }

    // //打卡成功分享后的动作
    // function punchSuccessShare() {
    //     shareCredits();
    // }

    // 推荐积分商品列表接口
    function getRecommendCreditsGoodsList() {
        var param = {userId:userID,page:0,size:4};
        creditsShop.getRecommendCreditsGoodsList(param,function (data) {
            if (data.code == 0) {
                storyPunch_vm.recommendGoodsList = data.recommendGoodsList;
                storyPunch_vm.rgList = arrayFunction.arrayOneToThree(data.recommendGoodsList,2);
            }
        })
    }

    function getCreditsLotteryCert() {
        var param = {userId:userID,tag:"duobao"};
        request("CreditsLottery",'getCreditsLotteryCert',param,function (data) {
            if(data.code == 0){
                storyPunch_vm.freeTimes = data.info.freeTimes;
            }else {
                console.log(data.msg);
            }
        })
    }

});
myApp.onPageReinit('storyPunch',function (page) {
    resetPosition();
    storyPunch_vm.onWXReady();
    storyPunchSign = true;
    if(!vm.punchStatus){
        storyPunch_vm.restPunchTime = 10 - parseInt(storyPunch_vm.studyTime/60);
        storyPunch_vm.punchIdentify = storyPunch_vm.restPunchTime;
        if(storyPunch_vm.restPunchTime == 10){
            $(".punch-process-content").css("width","13px");
        }else {
            $(".punch-process-content").width(parseInt(10-storyPunch_vm.restPunchTime)*10 + "%");
        }
    }
    firstLoadData = false;
    storyPunch_vm.storyPunchModal();
    $$("#playControl").show();
});
myApp.onPageBack('storyPunch',function (page) {
    storyPunchSign = false;
    firstLoadData = false;
    closeSuccModal();
    closeDiamond();
});

// 第一次进入打卡页面弹框
function firstEntryPage() {
    var firstEntryModal = myApp.modal({
        text: '<div class="punch-modal punchPage-modal" style=" padding-bottom: 0%;"><div class="two-bg"><div class="three-bg"></div></div>' +
        '<h2 class="welcome-title">欢迎加入魔法故事打卡团<div class="welcome-title-bottomLine"></div></h2>' +
        '<div class="welcome-des">每天分享打卡主页到朋友圈<br/>即可完成打卡</div>' +
        '<div style=" margin-top: 0px;"><img src="img/welcomeImg.png" style="width: 94%;" alt=""></div>' +
        '<div class="punch-modal-bottomBtn" onclick="closePunchModal()">去打卡喽</div></div>',
    })
    $$(".modal").css("top",'12%');
    $$(".modal").css("overflow",'initial');
    $$(".modal").css("borderRadius",'13px 13px 0 0');
    localStorage.firstJoinPunchPage = false;

    // 钻石雨部分
    diamondX = $$("body").width();
    diamondY = $$("body").height();
    creatDiv();
}



function creatDiv(){
    var x1 = Math.round(Math.random()*diamondX*10)/10+"px";
    var opac=Math.round(Math.random()*10)/10;
    var newDiv= $("<div class='diamond'><img src='img/dropMagicStore.png' alt=''></div>");
    newDiv.css("top","0");
    newDiv.css("left",x1);
    newDiv.css("width","20px");
    newDiv.css("lineHeight","0");
    newDiv.css("border","none");
    // newDiv.css("height","10px");
    newDiv.css("opacity",opac);

    $("body").append(newDiv);

    creatDivT=setTimeout('getDiv()',100)
}

function getDiv(){
    var alldiv=$(".diamond");
    for(i=0;i<alldiv.length;i++){
        alldiv.eq(i).css("transition","all 2s");
        alldiv.eq(i).css("mozTransition","all 2s");
        alldiv.eq(i).css("transitionTimingFunction","ease-in");
        alldiv.eq(i).css("webkitTransitionTimingFunction","ease-in");
        alldiv.eq(i).css("mozTransitionTimingFunction","ease-in");
        alldiv.eq(i).css("top","100%");
        if(alldiv.length>100){
            alldiv.eq(0).remove();
        }
    }
    getDivT=setTimeout('creatDiv()',100)
}

// 七天打卡标记
function todayPosistion(taskId) {
    v2AudioPunch.todayPosistion(userID,taskId,function (data) {
        if(data.code == 0){
            storyPunch_vm.continuePunchDay = data.continuePunchDay;
            storyPunch_vm.position = data.position;
            var thisMonth = new Date().getMonth() + 1;
            var thisDay = new Date().getDate();
        }else {
            showToast(data.msg);
        }
    })
}

//打卡规则
function punchRule() {
    var punchRuleModal = myApp.modal({
        text: '<div class="punch-modal"><div class="two-bg"><div class="three-bg"></div></div>' +
              '<div class="yuanzai-happyImg"><img src="img/yuanzai.png" alt=""></div>' +
              '<div class="punch-rule"><h2 class="welcome-title">打卡规则<div class="welcome-title-bottomLine"></div></h2>' +
              '<div class="punch-rule-list"><ul>' +
              '<li class="clearfix"><div class="rule-list-leftImg left"><img src="img/timeLimit.png" alt=""></div><div class="punch-rule-rightConten left">每天分享打卡主页<br/>到朋友圈 </div><div class="punch-rule-txt"><span class="iconfont">&#xe61f;</span><span style="font-weight: normal">+</span>6</div></li>' +
              '<li class="clearfix"><div class="rule-list-leftImg left"><img src="img/sevenDay.png" alt=""></div><div class="punch-rule-rightConten left">连续打卡7天<br/>第7天获4倍奖励</div><div class="punch-rule-txt"><span class="iconfont">&#xe61f;</span><span style="font-weight: normal">+</span>24</div></li>' +
              '<li class="clearfix"><div class="rule-list-leftImg left"><img src="img/storeImg.png" alt=""></div><div class="punch-rule-rightConten left" style="border-bottom:none">魔法石可兑换惊喜宝物<br/><span class="punch-rule-rightDes">独家打卡勋章、吉祥物抱枕等</span></div></li>' +
              '</ul></div></div>'+
              '<div class="punch-modal-bottomBtn" onclick="closeSuccModal()">去打卡喽</div></div>',
    })
    $$(".modal").css("top",'12%');
    $$(".modal").css("overflow",'initial');
    $$(".modal").css("borderRadius",'13px 13px 0 0');
}


// function nowShare() {
//     closeSuccModal();
//     shareTipModal();
// }

function shareTipModal() {
    var num = ydyPunchCredits;
    if(vm.seventhDay){
        var num = ydyPunchCredits*4;
    }
    var punchStatusModal = myApp.modal({
        title:'<div class="ydy_share" onclick="shareTipCloseModal()"> <div class="ydy_shareDiv"><div class="ydy_share_img"><img src="https://www.dayutang.cn/story/img/ydy_share.png" alt=""></div><div class="ydy_shareText">点击右上角分享到朋友圈 即可完成今日打卡</div> <div class="ydy_shareText ydy_shareText2"><span>打卡成功奖励魔法石</span><img src="https://www.dayutang.cn/story/img/ydy_mofa.png" alt=""><span>+'+ num+
        '</span></div></div>'
    });
    shareModalSign = true;
    $$(".ydy_share").parents(".modal").css("width","100%");
    $$(".ydy_share").parents(".modal").css("top","0");
    $$(".ydy_share").parents(".modal").css("left","0");
}

// 关闭钻石效果
function closeDiamond() {
    clearTimeout(creatDivT);
    clearTimeout(getDivT);
    $(".diamond").empty();
}


//关闭打卡成功弹框
function closePunchModal() {
    $(".punchModal").remove();
    closeSuccModal();
    closeDiamond();
    //localStorage.punchModalShowSign = true;
}


//跳转至幸运夺宝弹框
function tolunckyindiana() {
    var indianaModal =  myApp.modal({
        title:  '<img src="img/jumpTip.png"/>',
        text: '<p>即将跳转至幸运夺宝<br/>跳转后将暂停打卡计时</p>',
        buttons: [
            {
                text: '取消',
                onClick: function() {

                }
            },
            {
                text: '前往',
                onClick: function() {
                    myApp.alert('You clicked second button!')
                }
            }
        ]
    })

    $$(".modal").css("padding","20px");
    $$(".modal").css("width","80%");
    $$(".modal").css("left","10%");
    $$(".modal").css("top","30%");
    $$(".modal").css("backgroundColor","white");
    $$(".modal").css("box-sizing","border-box");
    $$(".modal").children().eq(0).removeClass("modal-inner");
    $$(".modal-title img").css("width","80px");
    $$(".modal-title img").css("margin","0 auto");
    $$(".modal-title img").css("height","80px");
    $$(".modal-title img").css("borderRadius","50%");
    $$(".modal-buttons").css("marginTop","20px");
    $$(".modal-buttons").css("height","auto");
    $$(".modal-buttons").css("display","block");
    $$(".modal-buttons").css("width","90%");
    $$(".modal-buttons").css("margin","0 auto");
    $$(".modal-button").css("height","auto");
    $$(".modal-button").css("width","40%");
    $$(".modal-button").css("border","1px solid #333");
    $$(".modal-button").css("borderRadius","30px");
    $$(".modal-button").css("float","right");
    $$(".modal-button").css("height","2em");
    $$(".modal-button").css("lineHeight","2em");
    $$(".modal-button").css("fontSize","16px");
    $$(".modal-button").css("backgroundColor","#F5A623");
    $$(".modal-button").css("color","#fff");
    $$(".modal-button").css("border","1px solid #F5A623");
    $$(".modal-button:first-child").css("float","left");
    $$(".modal-button:first-child").css("backgroundColor","transparent");
    $$(".modal-button:first-child").css("color","#333");
    $$(".modal-button:first-child").css("border","1px solid #333");
    $$(".modal-text p").css("marginBottom","15px");
    $$(".modal-text p").css("color","#666");
}

// 日历弹框下方按钮点击事件
function jumpOtherPage() {
    closeSuccModal();
    mainView.router.back();
    // if($$(".cal-content-bottomInfo").text() === '去听故事首页'){
    //     closeSuccModal();
    //     mainView.router.back();
    // }else {
    //     closeSuccModal();
    //     mainView.router.back();
    //     // location.href = "https://www.dayutang.cn/story/main.html";
    // }
}


// 进入故事打卡页面
function inStoryPunch(fromPlayer) {
    if(location.href.indexOf("storyPunch")>0){
        shareTipModal();
        return;
    }
    if($("#storyPunch").length>0){
        mainView.router.back();
    }else{
        mainView.router.loadPage({
            url:"storyPunch.html?fromPlayer=" + fromPlayer
        });
    }
}







/**
 * Created by Chen on 18/1/10.
 */
//初始化superStory.html页面
var superStory_vm;
var superStorySign = false;
myApp.onPageInit('superStory',function (page) {
    $$("#playControl").show();
    superStorySign = true;
    superStory_vm = new Vue({
        el: '#superStory',
        data: {
            page:0,
            albumTotal:0,
            audioTotal:0,
            ipInfo:{},
            ipAlbumArr:[],
            ipAudioArr:[],
            selectedIndex:0,
            currentAudio:{},
            lineShow:true,
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods: {
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            toAlbumDetail:function (album) {
                superStorySign = false;
                inAlbumDetail(album.id);
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== superStory_vm.currentAudio.id || (item.id == superStory_vm.currentAudio.id && superStory_vm.playVersion != versionIndex && !itemIndex) ){
                            superStory_vm.currentAudio = item;
                            vm.currentAudio = item;
                            superStory_vm.playVersion = versionIndex;
                            vm.menuList = superStory_vm.ipAudioArr;
                            vm.length = vm.menuList.length;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            superStory_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }

            },
            getShare:function () {
                onWXReady();
            }
        },
        watch:{
            ipInfo:function () {
                onWXReady();
            },
            ipAlbumArr:function () {
                var mySwiper = myApp.swiper('.swiper-4', {
                    paginationClickable: true,
                    initialSlide :0,
                    preventClicks : false,//默认true
                    preventClicksPropagation:true,
                    spaceBetween: 10,
                    slidesPerView: 2.2,
                    animation:true,
                    observer:true
                });
            }
        }
    })

    init();

    function init() {
        scrollGetData();
        getIPInfo(parseInt(page.query.ipId));
        getIPAudioList(page.query.ipId,"");
    }

    //tab切换
    $$('#tab9').on('show', function () {
        superStory_vm.lineShow = true;
        superStory_vm.page = 0;
        superStory_vm.ipAudioArr = [];
        getIPAudioList(page.query.ipId,"");
    });

    $$('#tab10').on('show', function () {
        superStory_vm.lineShow = false;
        superStory_vm.ipAlbumArr = [];
        superStory_vm.page = 0;
        getIPAudioList(page.query.ipId,"album");
    });

    // 获取IP详情
    function getIPInfo(ipId) {
        var param = {};
        param.ipId = ipId;
        v2Audio.getIPInfo(param,function (data) {
            if(data.code == 0){
                superStory_vm.ipInfo = data.ipInfo;
            }else {
                console.log(data.msg);
            }
        })
    }

    //S 滚动加载
    function scrollGetData(){
        var loading = false;// 加载flag
        $$('.infinite-scroll').on('infinite', function () {// 注册'infinite'事件处理函数
            if (loading) return;// 如果正在加载，则退出
            loading = true;// 设置flag
            setTimeout(function () {// 模拟1s的加载过程
                loading = false;// 重置加载flag
                if (superStory_vm.ipAudioArr.length == superStory_vm.audioTotal) {
                    myApp.detachInfiniteScroll($$('.infinite-scroll'));// 加载完毕，则注销无限加载事件，以防不必要的加载
                    return;
                }else{
                    superStory_vm.page++;
                    getIPAudioList(page.query.ipId,"");
                }
            },1000);
        });
    }

    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        var imgURL;
        if(superStory_vm.ipAudioArr[0]){
            imgURL = superStory_vm.ipAudioArr[0].smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '快来听新东方绘本馆名师讲故事啦！';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }
})



// 进入老师详情页面
function inSuperStory(id) {
    mainView.router.load({
        url:"tpl/superStory.html?ipId=" + id
    });
}


//根据老师获取专辑和音频列表
function getIPAudioList(ipId,album) {
    var size = 10;
    if(album){
        size = 200;
    }
    var param = {userId:userID,ipId:ipId,type:album,page:superStory_vm.page,size:size};
    v2Audio.getIPAudioList(param,function (data) {
        if (data.code == 0){
            if(album){
                superStory_vm.ipAlbumArr = data.albums;
                superStory_vm.albumTotal = data.total;
            }else {
                superStory_vm.ipAudioArr = superStory_vm.ipAudioArr.concat(data.audios);
                superStory_vm.audioTotal = data.total;
                for (var i=0;i<superStory_vm.ipAudioArr.length;i++){
                    if(superStory_vm.ipAudioArr[i].name == vm.currentAudio.name){
                        superStory_vm.currentAudio = superStory_vm.ipAudioArr[i];
                    }
                }
            }
        }
    })
}

myApp.onPageBack('superStory',function () {
    superStorySign = false;
});
myApp.onPageAfterAnimation('superStory',function () {
    superStory_vm.getShare();
});
myApp.onPageReinit('superStory',function (page) {
    superStory_vm.currentAudio = vm.currentAudio;
    superStory_vm.playVersion = vm.playVersion;
    superStorySign = true;
    superStory_vm.page = 0;
    superStory_vm.audioTotal = 0;
    superStory_vm.ipAudioArr = [];
    superStory_vm.currentAudio = {};
    getIPAudioList(page.query.ipId,"");
    superStory_vm.getShare();
});
//初始化teachAlbumList.html页面
var teachAlbumList_vm;
var preteachAlbumList;
myApp.onPageInit('teachAlbumList',function (page) {
    preteachAlbumList = page.fromPage;
    teachAlbumList_vm = new Vue({
        el: '#teachAlbumList',
        data: {
            albums:[],
            page:0,
            size:1000,
            total:0
        },
        methods: {
            jumpInCourse:function (item) {
                inAlbumDetail(item.id);
            }
        }
    })

    getAudioByTeacher(page.query.teacherId,"album");

    //根据老师获取专辑和音频列表
    function getAudioByTeacher(teacherId,type) {
        v2Audio.getAudioByTeacher(userID,teachAlbumList_vm.size,teachAlbumList_vm.page,teacherId,type,function (data) {
            if (data.code == 0){
                teachAlbumList_vm.albums = data.albums;
                teachAlbumList_vm.total = data.total;
            }
        })
    }
})
myApp.onPageReinit('teachAlbumList',function (page) {
    $$(".floating-button").css("bottom","90px");
})



myApp.onPageBack('teachAlbumList',function () {
   if(preteachAlbumList.name == "teachDetail"){
        teachDetailSign = true;
        teachDetail_vm.page = 0;
        teachDetail_vm.audioTotal = 0;
        teachDetail_vm.teachAudioArr = [];
        teachDetail_vm.currentAudio = {};
        getAudioByTeacher(preteachAlbumList.query.teachId,"");
    }
});

// 进入老师专辑列表页面
function inTeachAlbumList(teacherId) {
    mainView.router.load({
        url:"tpl/teachAlbumList.html?teacherId=" + teacherId
    });
}
//初始化teachDetail.html页面
var teachDetail_vm;
var teachDetailSign = false;
myApp.onPageInit('teachDetail',function (page) {
    $$("#playControl").show();
    teachDetailSign = true;
    teachDetail_vm = new Vue({
        el: '#teachDetail',
        data: {
            page:0,
            albumTotal:0,
            audioTotal:0,
            teachInfo:{},
            teachAlbumArr:[],
            teachAudioArr:[],
            selectedIndex:0,
            currentAudio:{},
            lineShow:true,
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods: {
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                // if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            toAlbumDetail:function (album) {
                teachDetailSign = false;
                inAlbumDetail(album.id);
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== teachDetail_vm.currentAudio.id || (item.id == teachDetail_vm.currentAudio.id && teachDetail_vm.playVersion != versionIndex && !itemIndex) ){
                            teachDetail_vm.currentAudio = item;
                            vm.currentAudio = item;
                            teachDetail_vm.playVersion = versionIndex;
                            vm.menuList = teachDetail_vm.teachAudioArr;
                            vm.length = vm.menuList.length;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            teachDetail_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }

            },
            getShare:function () {
                onWXReady();
            }
        },
        watch:{
            teachInfo:function () {
                onWXReady();
            },
            teachAlbumArr:function () {
                var mySwiper = myApp.swiper('.swiper-4', {
                    paginationClickable: true,
                    initialSlide :0,
                    preventClicks : false,//默认true
                    preventClicksPropagation:true,
                    spaceBetween: 10,
                    slidesPerView: 2.2,
                    animation:true,
                    observer:true
                });
            }
        }
    })
    scrollGetData();
    getTeacherInfo(parseInt(page.query.teachId));
    getAudioByTeacher(page.query.teachId,"album");
    getAudioByTeacher(page.query.teachId,"");

    //tab切换
    $$('#tab9').on('show', function () {
        teachDetail_vm.lineShow = true;
    });

    $$('#tab10').on('show', function () {
        teachDetail_vm.lineShow = false;
    });

    //S 滚动加载
    function scrollGetData(){
        var loading = false;// 加载flag
        $$('.infinite-scroll').on('infinite', function () {// 注册'infinite'事件处理函数
            if (loading) return;// 如果正在加载，则退出
            loading = true;// 设置flag
            setTimeout(function () {// 模拟1s的加载过程
                loading = false;// 重置加载flag
                if (teachDetail_vm.teachAudioArr.length == teachDetail_vm.audioTotal) {
                    myApp.detachInfiniteScroll($$('.infinite-scroll'));// 加载完毕，则注销无限加载事件，以防不必要的加载
                    return;
                }else{
                    teachDetail_vm.page++;
                    getAudioByTeacher(page.query.teachId,"");
                }
            },1000);
        });
    }

    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        var imgURL;
        if(teachDetail_vm.teachAudioArr[0]){
            imgURL = teachDetail_vm.teachAudioArr[0].smallImg;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '快来听新东方绘本馆名师讲故事啦！';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }
})



// 进入老师详情页面
function inTeachDetail(id) {
    mainView.router.load({
        url:"tpl/teachDetail.html?teachId=" + id
    });
}

//获取老师信息
function getTeacherInfo(teacherId) {
    v2Audio.getTeacherInfo(teacherId,function (data) {
        if (data.code ==0){
            teachDetail_vm.teachInfo = data.teacherInfo;
        }
    })
}

//根据老师获取专辑和音频列表
function getAudioByTeacher(teacherId,album) {
    var size = 10;
    if(album){
        size = 200;
    }
    v2Audio.getAudioByTeacher(userID,size,teachDetail_vm.page,teacherId,album,function (data) {
        if (data.code == 0){
            if(album){
                teachDetail_vm.teachAlbumArr = data.albums;
                teachDetail_vm.albumTotal = data.total;
            }else {
                teachDetail_vm.teachAudioArr = teachDetail_vm.teachAudioArr.concat(data.audios);
                teachDetail_vm.audioTotal = data.total;
                for (var i=0;i<teachDetail_vm.teachAudioArr.length;i++){
                    if(teachDetail_vm.teachAudioArr[i].name == vm.currentAudio.name){
                        teachDetail_vm.currentAudio = teachDetail_vm.teachAudioArr[i];
                    }
                }
            }
        }
    })
}

myApp.onPageBack('teachDetail',function () {
    teachDetailSign = false;
});
myApp.onPageAfterAnimation('teachDetail',function () {
    teachDetail_vm.getShare();
});
myApp.onPageReinit('teachDetail',function (page) {
    teachDetail_vm.currentAudio = vm.currentAudio;
    teachDetail_vm.playVersion = vm.playVersion;
    teachDetailSign = true;
    teachDetail_vm.page = 0;
    teachDetail_vm.audioTotal = 0;
    teachDetail_vm.teachAudioArr = [];
    teachDetail_vm.currentAudio = {};
    getAudioByTeacher(page.query.teachId,"");
    teachDetail_vm.getShare();
});
//初始化teachList.html页面
var teachList_vm;
myApp.onPageInit('teachList',function () {
    myApp.hideIndicator();
    teachList_vm = new Vue({
        el: '#teachList',
        data: {
            teacherInfo:[
                star = {
                    id:2,
                    des:"英语绘本故事女王",
                    src1:"img/teacher-star1.jpg",
                    src2:"img/teacher-star2.jpg",
                    name:"Star姐姐"
                },
                moon = {
                    id:3,
                    des:"最暖英语绘本女神",
                    src1:"img/teacher-moon1.jpg",
                    src2:"img/teacher-moon2.jpg",
                    name:"Moon姐姐"
                },
                xigua = {
                    id:5,
                    des:"最搞笑幽默语文王",
                    src1:"img/teacher-xigua1.jpg",
                    src2:"img/teacher-xigua2.jpg",
                    name:"西瓜姐姐"
                },
                nangua = {
                    id:6,
                    des:"最渊博语文绘本女神",
                    src1:"img/teacher-nangua1.jpg",
                    src2:"img/teacher-nangua2.jpg",
                    name:"南瓜姐姐"
                },
                lemon = {
                    id:19,
                    des:'绘本馆行走的“百科全书”',
                    src1:"img/teacher-lemon1.jpg",
                    src2:"img/teacher-lemon2.jpg",
                    name:"柠檬哥哥"
                },
                shaomai = {
                    id:4,
                    des:"奥赛冠军数学绘本王",
                    src1:"img/teacher-shaomai1.jpg",
                    src2:"img/teacher-shaomai2.jpg",
                    name:"烧麦姐姐"
                },
                sunny = {
                    id:16,
                    des:"最阳光英文绘本女皇",
                    src1:"img/teacher-sunny1.png",
                    src2:"img/teacher-sunny2.png",
                    name:"Sunny姐姐"
                },
                boluo = {
                    id:23,
                    des:"行走的“段子手”姐姐",
                    src1:"img/teacher-boluo1.jpg",
                    src2:"img/teacher-boluo2.jpg",
                    name:"菠萝姐姐"
                },
                orange = {
                    id:15,
                    des:"最全能语文绘本故事王",
                    src1:"img/teacher-orange1.jpg",
                    src2:"img/teacher-orange2.jpg",
                    name:"橙子姐姐"
                },
                coco = {
                    id:17,
                    des:"最实力英文绘本女皇",
                    src1:"img/teacher-coco1.jpg",
                    src2:"img/teacher-coco2.jpg",
                    name:"Coco姐姐"
                },
                // rainbow = {
                //     id:10,
                //     des:"最学术语文绘本专家",
                //     src1:"img/teacher-rainbow1.png",
                //     src2:"img/teacher-rainbow2.png",
                //     name:"彩虹姐姐"
                // },
                // cola = {
                //     id:14,
                //     des:"最彪悍数学绘本女神",
                //     src1:"img/teacher-cola1.png",
                //     src2:"img/teacher-cola2.png",
                //     name:"可乐姐姐"
                // },
                hamigua = {
                    id:1,
                    des:"最甜绘本全能女神",
                    src1:"img/teacher-hamigua1.jpg",
                    src2:"img/teacher-hamigua2.jpg",
                    name:"哈密瓜姐姐"
                },
                apple = {
                    id:8,
                    des:"最机灵的英语绘本达人",
                    src1:"img/teacher-apple1.jpg",
                    src2:"img/teacher-apple2.jpg",
                    name:"Apple姐姐"
                }


            ]
        },
        methods: {
            doAnimate:function (one,index) {
                $(".teachList-item").children("img").eq(index).attr("src",one.src2);
            },
            endAnimate:function (one,index) {
                $(".teachList-item").children("img").eq(index).attr("src",one.src1);
            },
            toTeachDetail:function (one,index) {
                setTimeout(function () {
                    inTeachDetail(one.id);
                },300);
            },
            getShare:function () {
                onWXReady();
            }
        }
    })
    setTimeout(onWXReady(),1000);

    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        if (!wxIsReady) {
            return;
        }
        var imgURL = 'https://testfile.dayutang.cn/2016/12/07/1481071057308.jpg';
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '快来听新东方绘本馆名师讲故事啦！';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听！';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }

})
myApp.onPageReinit('teachList',function () {
    teachList_vm.getShare();
    $$(".floating-button").css("bottom","90px");
});

// 进入老师列表页面
function inTeachList() {
    mainView.router.load({
        url:"teachList.html"
    });
}


//初始化typeAll.html页面
var  typeAll_vm;
myApp.onPageInit('typeAll',function (page) {
    myApp.hideIndicator();
    typeAll_vm = new Vue({
        el: '#typeAll',
        data: {
            typeArr:[]
        },
        methods: {
            toTypeDetail:function (tagId,tagName) {
                inTypeDetail(tagId,tagName);
            },
            getShare:function () {
                onWXReady();
            }
        }
    });

    getAudioAllTag();

    //获取所有故事分类
    function getAudioAllTag() {
        v2Audio.getAudioAllTag(function (data) {
            typeAll_vm.typeArr = data.tags;
            onWXReady();
        })
    }

    // 调用微信相关
    function onWXReady(){
        isSubPageShare = 1;
        var imgURL;
        if(typeAll_vm.typeArr[0].list[0]){
            imgURL = typeAll_vm.typeArr[0].list[0].icon;
        }else {
            imgURL = sessionStorage.storyMainImg;
        }
        var linkURL = location.href.split("?")[0];
        if(userHasStore) {
            linkURL += replaceQuery("fromUserId", userID);
        } else {
            linkURL += replaceQuery("fromUserId", fromUserId);
        }
        var title =  '我和宝贝正在新东方绘本馆名师讲故事';
        var desc =  '【俞敏洪老师】推荐的绘本故事，现在就去免费听';
        weiXinTools.showFavoriteMenu();
        weiXinTools.showAppMessageMenu(title,desc,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
        weiXinTools.showTimeLineMenu(title,linkURL,imgURL,function () {
            showToast("分享打卡主页才能算作打卡哦！")
        });
    }
})


myApp.onPageReinit('typeAll',function () {
    typeAll_vm.getShare();
    $$(".floating-button").css("bottom","90px");
});


// 进入全部分类页面
function inTypeAll() {
    mainView.router.load({
        url:"typeAll.html"
    });
}

//初始化typeDetail.html页面
var typeDetail_vm;
var tagId = getQuery("tagId");
myApp.onPageInit('typeDetail',function (page) {
    $$("#playControl").show();
    if(sessionStorage.currentAudio){
        sessionStorage.removeItem("currentAudio");
        sessionStorage.removeItem("menuList");
    }
    barPlayOrPause();
    playerSign = false;
    typeDetail_vm = new Vue({
        el: '#typeDetail',
        data: {
            currentAudio:vm.currentAudio,
            page:0,
            size:6,
            typeAlbumArr:[],
            typeAudioArr:[],
            tagName: decodeURI(page.query.tagName),
            total:0,
            audioTotal:0,
            playVersion:vm.playVersion,
            allAdTime:vm.allAdTime
        },
        methods: {
            toTypeDetail:function () {
                inTypeDetail();
            },
            toAlbumDetail:function (albumId) {
                inAlbumDetail(albumId);
            },
            formatTime:function (seconds) {
                var timestr = "";
                var minutes = parseInt(seconds / 60).toString();
                if(minutes.length==1) minutes = "0"+minutes;
                var seconds = String(parseInt(seconds) % 60);
                if(seconds.length==1) seconds = "0"+seconds;
                timestr = minutes+":"+seconds;
                return timestr;
            },
            jumpAlbumList:function () {
                inAlbumList(page.query.tagId);
            },
            toPlay:function (item,itemIndex,versionIndex) {
                if(item.needBuyFlag){
                    showToast("此故事不能试听哦~ 请购买专辑");
                }else {
                    if (item) {
                        if(item.id !== typeDetail_vm.currentAudio.id || (item.id == typeDetail_vm.currentAudio.id && typeDetail_vm.playVersion != versionIndex && !itemIndex) ){
                            typeDetail_vm.currentAudio = item;
                            vm.currentAudio = item;
                            typeDetail_vm.playVersion = versionIndex;
                            vm.playVersion = versionIndex;
                            vm.selectedIndex = itemIndex;
                            vm.menuList = typeDetail_vm.typeAudioArr;
                            vm.length = vm.menuList.length;
                            if (!vm.selectedIndex) {
                                vm.selectedIndex = vm.menuList.indexOf(item);
                            }
                            typeDetail_vm.selectedIndex = vm.selectedIndex;
                            initAudio();
                            playAudio();
                            myApp.showIndicator();
                            inPlayer(item.id,"");
                        }else {
                            myApp.showIndicator();
                            inPlayer("","");
                        }
                    }
                }
            }
        },
        watch:{
            typeAlbumArr:function () {
                var mySwiper1 = myApp.swiper('.swiper-4', {
                    freeMode: false,
                    initialSlide :0,
                    paginationClickable: true,
                    preventClicks : false,//默认true
                    preventClicksPropagation:true,
                    spaceBetween: 10,
                    slidesPerView: 2.2,
                    animation:true
                });
            }
        }
    })

    getAudioByTag(page.query.tagId,"album");
    getAudioByTag(page.query.tagId,"");
})

// 进入类型详情页面
function inTypeDetail(tagId,tagName) {
    mainView.router.load({
        url:"tpl/typeDetail.html?tagId=" + tagId + "&tagName=" + tagName
    });
}

//通过标签获取音频和专辑列表
function getAudioByTag(tagId,type) {
    v2Audio.getAudioByTag(userID,typeDetail_vm.size,typeDetail_vm.page,tagId,type,function (data) {
        if (data.code == 0){
            if(type){
                typeDetail_vm.typeAlbumArr = data.albums;
                typeDetail_vm.total = data.total;
            }else {
                typeDetail_vm.typeAudioArr = typeDetail_vm.typeAudioArr.concat(data.audios);
                for (var i=0;i<typeDetail_vm.typeAudioArr.length;i++){
                    if(typeDetail_vm.typeAudioArr[i].id == vm.currentAudio.id){
                        typeDetail_vm.currentAudio = typeDetail_vm.typeAudioArr[i];
                    }
                }
                typeDetail_vm.audioTotal = data.total;
                downLoadMore2.down($('.audio-list-div'), data.audios.length, typeDetail_vm.size, function () {
                    typeDetail_vm.page++;
                    getAudioByTag(tagId,"");
                });
            }
        }
    })
}

myApp.onPageReinit('typeDetail',function () {
    typeDetail_vm.currentAudio = vm.currentAudio;
    typeDetail_vm.playVersion = vm.playVersion;
    typeDetail_vm.page = 0;
    typeDetail_vm.typeAudioArr = [];
    getAudioByTag(getQuery("tagId"),"");
    $$(".floating-button").css("bottom","90px");
});
