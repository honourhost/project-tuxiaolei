/**
 * Created by chenzhiliang on 17/6/27.
 */

define("Advert", function(require, exports, module) {
    module.exports = {
        getAdvertByBanner: function (banner,callBackFunc){
            request("Advert","getAdvertByBanner",{
                banner:banner
            },function (data) {
                callBackFunc(data);
            });
        },
    }
});
/**
 * Created by chenzhiliang on 17/6/24.
 */
/**
 * 音频
 * AudioClass.js
 */
define("AudioClass", function(require, exports, module) {
    module.exports = {
        /**
         *获取购物车 个数
         *userId 数据类型为 string  用户id
         */
        getAudioListByAudioClassId: function (userId,audioClassId,page,size,fold,callBackFunc){
            request("AudioClass","getAudioListByAudioClassId",{
                userId:userId,
                audioClassId:audioClassId,
                page:page,
                size:size,
                queryType:fold
            },function (data) {
                callBackFunc(data);
            });
        },
        getAlbumList: function (userId,size,page,queryType,callBackFunc){
            request("AudioClass","getAlbumList",{
                userId: userId,
                size: size,
                page: page,
                queryType: queryType
            },function (data) {
                callBackFunc(data);
            });
        },
        getAudioClassInfo:function (userId,audioClassId,callBackFunc) {
            request("AudioClass","getAudioClassInfo",{
                userId: userId,
                audioClassId: audioClassId
            },function (data) {
                callBackFunc(data);
            });
        },
        // 获取用户已购专辑
        getUserAlbumList:function (param,callBackFunc) {
            request("AudioClass","getUserAlbumList",param,function (data) {
                callBackFunc(data);
            });
        },
        // 制作用户毕业证
        makeUserDiplomaImg:function (param,callBackFunc) {
            request("AudioClass","makeUserDiplomaImg",param,function (data) {
                callBackFunc(data);
            });
        },
        // 获取用户毕业证
        getUserDiplomaImg:function (param,callBackFunc) {
            request("AudioClass","getUserDiplomaImg",param,function (data) {
                callBackFunc(data);
            });
        }
    }
});
/**
 * 图书包
 * BookPackage.js
 */
define("BookPackage", function(require, exports, module) {
    module.exports = {
        // 获取页面主背景图接口
        /**
         *通过关键字获取页面主背景图
         *packageCode	是	string	图书包的Code码steam
         *goodType	是	string	类型（1:课程,2:周边,3:书单,4:玩具）
         */
        getBookPackageImg: function (param, callBackFunc) {
            request("BookPackage", "getBookPackageImg", {
                userId: param.userId,
                packageCode: param.packageCode,
                goodType: param.goodType
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 获取图书包的相关商品接口
        /**
         *通过关键字获取图书包的相关商品
         *userId	是	string		用户ID
         *token	    是	string	    token
         *packageCode	是	string	图书包的Code码steam
         *goodType	是	int	        商品类型（1：课程 2：周边）
         */
        getBookPackageGoodsByType: function (param, callBackFunc) {
            request("BookPackage", "getBookPackageGoodsByType", {
                userId: param.userId,
                packageCode: param.packageCode,
                goodType: param.goodType
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 获取图书单和益智玩具接口
        /**
         *通过关键字获取图书包的相关商品
         *userId	是	string		用户ID
         *token	    是	string	    token
         *packageCode	是	string	图书包的Code码steam
         *ageGroupGoodType	是	int	        商品类型（1：书单 2：益智玩具）
         *ageGroupType	    是	int	            年龄段（1：0-4岁 2：5-8岁，3：9-12岁）
         */
        getAgeGroupGoods: function (param, callBackFunc) {
            request("BookPackage", "getAgeGroupGoods", {
                userId: param.userId,
                packageCode: param.packageCode,
                ageGroupGoodType: param.ageGroupGoodType,
                ageGroupType: param.ageGroupType
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 获取讲解接口
        /**
         *通过关键字获取图书包的相关商品
         *userId	是	string		用户ID
         *token	    是	string	    token
         *packageCode	是	string	图书包的Code码steam
         *ageGroupGoodType	是	int	        商品类型（1：讲解）
         *ageGroupType	    是	int	            年龄段（1：0-4岁 2：5-8岁，3：9-12岁）
         */
        getAgeGroupxplain: function (param, callBackFunc) {
            request("BookPackage", "getAgeGroupxplain", {
                userId: param.userId,
                packageCode: param.packageCode,
                ageGroupGoodType: param.ageGroupGoodType,
                ageGroupType: param.ageGroupType
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 获取商品详情页接口
        /**
         *通过关键字获取图书包的相关商品
         *goodId	是	int		商品ID
         */
        getV2GoodsDes: function (param, callBackFunc) {
            request("BookPackage", "getV2GoodsDes", {
                userId: param.userId,
                goodId: param.goodId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },

        // 获取商品详情页接口
        /**
         *通过关键字获取图书包的相关商品
         *packageCode	是	string		steam
         * ageGroupType     是	int		年龄段（1:0-4岁标准,2:5-8标准,3:9-12标准,4:0-12旗舰）
         */
        getOrderInfo: function (param, callBackFunc) {
            request("BookPackage", "getOrderInfo", param, function (data) {
                callBackFun(data);
            });
        }
    }
});

/**
 * 课程兑换中心
 * CourseExchange.js
 */
define("CourseExchange", function (require, exports, module) {
    module.exports = {
        /**
         *课程兑换
         */
        exchangeCourse: function (param, callBackFunc) {
            request("CourseExchange", "exchangeCourse", {
                userId: param.userId,   //userId	是	string	用户名
                code: param.code  //code	是	string	兑换码
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },

        /**
         *用户课程兑换记录
         */
        userCourseExchangeList: function (param, callBackFunc) {
            request("CourseExchange", "userCourseExchangeList", {
                userId: param.userId,   //userId	是	string	用户名
                page: param.page,  //page	是	string	分页
                size: param.size  //size	是	string	分页
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *用户课程兑换明细
         */
        userCourseExchangeDetail: function (param, callBackFunc) {
            request("CourseExchange", "userCourseExchangeDetail", {
                userId: param.userId,  //userId	是	string	用户名
                userExchangeDetailId: param.userExchangeDetailId    //userExchangeDetailId	是	int	用户兑换明细
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});

/**
 * Created by Chen on 17/11/27.
 */
define("CreditsLottery", function(require, exports, module) {
    module.exports = {
        // 幸运夺宝抽奖接口
        lottery: function (param, callBackFun) {
            request("CreditsLottery", "lottery", param, function (data) {
                callBackFun(data);
            });
        },
        // 积分抽奖获取抽奖资格接口
        getCreditsLotteryCert: function (param, callBackFun) {
            request("CreditsLottery", "getCreditsLotteryCert", param, function (data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/10/31.
 */
/**
 * 金币商城
 */
define("CreditsShop", function(require, exports, module) {
    module.exports = {
        // 积分商品列表接口
        getCreditsGoodsList: function (param, callBackFunc) {
            request("CreditsShop", "getCreditsGoodsList", {
                userId: param.userId,
                page: param.page,
                size: param.size
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 推荐积分商品列表接口
        getRecommendCreditsGoodsList: function (param, callBackFunc) {
            request("CreditsShop", "getRecommendCreditsGoodsList", {
                userId: param.userId,
                page: param.page,
                size: param.size
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 积分优惠券列表接口
        getCouponList: function (param, callBackFunc) {
            request("CreditsShop", "getCouponList", {
                userId: param.userId,
                page: param.page,
                size: param.size
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 积分商品详情接口
        getCreditsGoodsDetail: function (param, callBackFunc) {
            request("CreditsShop", "getCreditsGoodsDetail", {
                userId: param.userId,
                goodsId: param.goodsId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 优惠券详情接口
        getCouponDetail: function (param,callBackFunc) {
            request("CreditsShop", "getCouponDetail", {
                userId: param.userId,
                goodsId: param.goodsId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // goodsId	是	string	商品id

        // getCreditsGoodsList: function (param, callBackFunc) {
        //     request("CreditsShop", "getCreditsGoodsList", param,function (data) {
        //         callBackFunc && callBackFunc(data);
        //     });
        // }
        // getCreditsGoodsList: function (param, callBackFunc) {
        //     request("CreditsShop", "getCreditsGoodsList", {
        //         userId: param.userId,
        //         page: param.page,
        //         size: param.size
        //     },function (data) {
        //         callBackFunc && callBackFunc(data);
        //     });
        // }
    }
});

/**
 * Created by chenzhiliang on 17/11/6.
 */
/**
 * 获取用户信息
 * user.js
 */
define("CreditsShopOrder", function(require, exports, module) {
    module.exports = {
        // 订单列表接口
        getOrderInfoList: function (param, callBackFunc) {
            request("CreditsShopOrder", "getOrderInfoList", {
                userId: param.userId,
                type: param.type,
                page: param.page,
                size: param.size
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 积分商品下单接口
        order: function (param, callBackFunc) {
            request("CreditsShopOrder", "order", {
                userId: param.userId,
                orderInfo: param.orderInfo
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 订单详情接口
        getOrderInfo: function (param, callBackFunc) {
            request("CreditsShopOrder", "getOrderInfo", {
                userId: param.userId,
                exchangeOrderNo: param.exchangeOrderNo
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        //确认收货
        confirmReceive:function(param, callBackFunc){
            request("CreditsShopOrder", "confirmReceive", {
                userId: param.userId,
                exchangeOrderNo: param.exchangeOrderNo
            }, function (data) {
                callBackFunc && callBackFunc(data);
            })
        }
    }
});
/**
 * Created by chenzhiliang on 17/11/4.
 */
define("CreditsUser", function(require, exports, module) {
    module.exports = {
        // 查询用户所有积分数量
        getCredits: function (param, callBackFunc) {
            request("CreditsUser", "getCredits", {
                userId: param.userId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        // 查询用户所有积分数量
        getCreditsUserBill: function (param, callBackFunc) {
            request("CreditsUser", "getCreditsUserBill", {
                userId: param.userId,
                page: param.page,
                size: param.size
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }

    }
});

/**
 * Created by chenzhiliang on 18/1/1.
 */
/**
 * 商城
 * BookStore.js
 */
define("DataCollect", function(require, exports, module) {
    module.exports = {
        /**
         * 获取拼团信息
         *groupNo 数据类型为 string  	团编号
         *userId  数据类型为 string    用户id
         */
        addData: function (param, callBackFunc) {
            request("DataCollect", "addData", {
                userId: param.userId,
                type: param.type,
                shareType:param.shareType,
                channelNum:param.channelNum,
                switchRuledetailId: param.switchRuledetailId,
                wxId: param.wxId,
                modular:param.modular,
                paramId:param.paramId,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         * 获取拼团信息
         *groupNo 数据类型为 string  	团编号
         *userId  数据类型为 string    用户id
         */
        longPressEvent: function (param, callBackFunc) {
            request("DataCollect", "longPressEvent",param , function (data) {
                callBackFunc && callBackFunc(data);
            });
        },

    }
});

/**
 * Created by yanan on 2018/3/22.
 */

// 短期活动
define("DrainageActivity", function (require, exports, module) {
    module.exports = {
        /**
         *获取用户加入信息
         *userId    是    string    用户Id
         *taskId    是    int    任务ID
         */
        getUserJoinInfo: function (param, callBackFunc) {
            request("DrainageActivity", "getUserJoinInfo", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *加入活动
         *userId    是    string    用户Id
         *taskId    是    int    任务ID
         */
        joinActivity: function (param, callBackFunc) {
            request("DrainageActivity", "joinActivity", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取活动信息
         *userId    是    string    用户Id
         *taskId    是    int    任务ID
         */
        getActivityInfo: function (param, callBackFunc) {
            request("DrainageActivity", "getActivityInfo", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *完成课时
         *userId    是    string    用户Id
         *taskClassId    是    int    任务课时ID
         */
        finish: function (param, callBackFunc) {
            request("DrainageActivity", "finish", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取成绩页信息
         *userId    是    string    用户Id
         *studyId    是    int        学习ID
         */
        getFinishInfo: function (param, callBackFunc) {
            request("DrainageActivity", "getFinishInfo", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *打卡
         *userId    是    string    用户Id
         *studyId    是    int        学习ID
         */
        goPunch: function (param, callBackFunc) {
            request("DrainageActivity", "goPunch", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取伴读学习页信息
         *userId    是    string    用户Id
         *taskClassId    是    int        任务课时ID
         */
        getPunchClassInfo: function (param, callBackFunc) {
            request("DrainageActivity", "getPunchClassInfo", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});
/**
 * 邀请卡
 * invitation.js
 */
define("DynamicInvitation", function(require, exports, module) {
    module.exports = {
        /**
         *微信邀请卡活动详情页
         *userId    是    string    用户id
         *invitationActivityId	是	int	邀请卡活动ID
         */
        getInvitationInfo: function (params, callBackFunc) {
            request("DynamicInvitation", "getInvitationInfo", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        getDynamicInvitationPublicityPageInfo: function (params, callBackFunc) {
            request("DynamicInvitation", "getDynamicInvitationPublicityPageInfo", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        getInvitationOperateInfo: function (params, callBackFunc) {
        request("DynamicInvitation", "getInvitationOperateInfo", params, function (data) {
            callBackFunc && callBackFunc(data);
        });
    }
    }
});

/**
 * Created by wangjinhui on 2017/10/24.
 */

define("DynamicQrcode", function(require, exports, module) {
    module.exports = {
        getDynamicQrcode: function(ruleId,backgroundId,callBackFunc){
            request("DynamicQrBackground","getDynamicQrCode",{
                ruleId:ruleId,
                backgroundId:backgroundId,
                condition:0
            },function(data){
                callBackFunc(data)
            })
        }
    }
});
/**
 * Created by yudeyu on 2017/10/13.
 */

/**
 * 题库
 */
define("Exam", function(require, exports, module) {
    module.exports = {
        /**
         *检测用户是否激活过会员
         *userId 是 数据类型为 string  用户id
         */
        checkActivateFlag: function (userId, callBackFunc) {
            request("Exam", "checkActivateFlag", {
                userId: userId,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取用户会员服务
         *userId 是 数据类型为 string  用户id
         */
        getUserExamMemberInfo: function (userId, callBackFunc) {
            request("Exam", "getUserExamMemberInfo", {
                userId: userId,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取练习册列表
         * pream
         *userId 是 数据类型为 string  用户id
         * userId  用户名
         */
        getExamWorkbook: function (pream, callBackFunc) {
            request("Exam", "getExamWorkbook", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取练习册信息
         * pream
         * userId 是 数据类型为 string  用户id
         * workbookId  练习册ID
         */
        getExamWorkbookInfo: function (pream, callBackFunc) {
            request("Exam", "getExamWorkbookInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取章节列表
         * pream
         */
        getExamChapter: function (pream, callBackFunc) {
            request("Exam", "getExamChapter", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取章节信息
         * pream
         */
        getExamChapterInfo: function (pream, callBackFunc) {
            request("Exam", "getExamChapterInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *保存用户章节
         * pream
         */
        saveUserChapter: function (pream, callBackFunc) {
            request("Exam", "saveUserChapter", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取习题
         * pream
         */
        getExamQuestions: function (pream, callBackFunc) {
            request("Exam", "getExamQuestions", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *临时提交习题
         * pream
         */
        tempSubmitQuestions: function (pream, callBackFunc) {
            request("Exam", "tempSubmitQuestions", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *用户提交习题
         * pream
         */
        correctQuestions: function (pream, callBackFunc) {
            request("Exam", "correctQuestions", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *用户做题报告1
         * pream
         */
        getUserReport1: function (pream, callBackFunc) {
            request("Exam", "getUserReport1", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *用户做题报告2
         * pream
         */
        getUserReport2: function (pream, callBackFunc) {
            request("Exam", "getUserReport2", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *分享赠送服务期
         * pream
         */
        presentShareMemberService: function (pream, callBackFunc) {
            request("Exam", "presentShareMemberService", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *我的小伙伴
         * pream
         */
        myFriends: function (pream, callBackFunc) {
            request("Exam", "myFriends", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *订阅或取消订阅新题提醒
         * pream
         */
        subscribeOrCancelRemind: function (pream, callBackFunc) {
            request("Exam", "subscribeOrCancelRemind", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取用户练习记录总信息
         * pream
         */
        getUserExerciseRecordInfo: function (pream, callBackFunc) {
            request("Exam", "getUserExerciseRecordInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取用户练习记录
         * pream
         */
        getUserExerciseRecord: function (pream, callBackFunc) {
            request("Exam", "getUserExerciseRecord", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },/**
         *获取用户错题列表
         * pream
         */
        getUserWrongQuestions: function (pream, callBackFunc) {
            request("Exam", "getUserWrongQuestions", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },/**
         *获取用户错题信息
         * pream
         */
        getUserWrongQuestionInfo: function (pream, callBackFunc) {
            request("Exam", "getUserWrongQuestionInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },/**
         *邀请好友绑定临时关系
         * pream
         */
        bindingTempRelation: function (pream, callBackFunc) {
            request("Exam", "bindingTempRelation", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },/**
         *邀请好友绑定临时关系
         * pream
         */
        getUserExamPunchInfo: function (pream, callBackFunc) {
            request("Exam", "getUserExamPunchInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },/**
         *获取题库年龄标签
         * pream
         */
        getExamTags: function (pream, callBackFunc) {
            request("Exam", "getExamTags", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});
/**
 * Created by Chen on 18/1/5.
 */

define("File", function(require, exports, module) {
    module.exports = {
        fileUploadBase64: function (param, callBackFun){
            requestPost("File", "fileUploadBase64", {
                imgBase64: param.imgBase64
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});

/**
 * Created by Chen on 18/1/5.
 */

define("Gold", function(require, exports, module) {
    module.exports = {
        // 金币信息
        /*userId: param.userId
        token: param.token*/
        getGoldProfitInfo: function (param, callBackFun){
            request("Gold", "getGoldProfitInfo", {
                userId: param.userId,
                token: param.token
            }, function(data) {
                callBackFun(data);
            });
        },

        // 金币记录
        /*userId: param.userId
        token: param.token
        size: param.size
        page: param.page*/
        getGoldUserBillList: function (param, callBackFun){
            request("Gold", "getGoldUserBillList", {
                userId: param.userId,
                token: param.token,
                size: param.size,
                page: param.page
            }, function(data) {
                callBackFun(data);
            });
        },

        // //阅读文章,分享文章,分享拼团获取金币 接口
        /*userId: param.userId
        token: param.token
        behaviorCode: param.behaviorCode  用户行为：阅读文章:”read.article”,分享文章:”share.article”,拼团分享:”share.groupbook”
        type: param.type    记录类型(3.文章阅读 4.文章分享 6.拼团分享
        detailId: param.detailId    文章阅读的文章ID,文章分享的文章ID，分享拼团的拼团ID
        */
        getGoldsByMissions: function (param, callBackFun){
            request("Gold", "getGoldsByMissions",{
                userId: param.userId,
                token: param.token,
                behaviorCode: param.behaviorCode,
                type: param.type,
                detailId: param.detailId,
            }, function(data) {
                callBackFun(data);
            });
        },
        /*参团是否弹出窗口
        *userId	string	用户ID
        *token	string	token
        * */
        isJumpOutWindow:function(param, callBackFun){
            request("Gold", "isJumpOutWindow",{
                userId: param.userId,
                token: param.token,
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});

/**
 * Created by yudeyu on 2018/4/12.
 */
define ("GoodsClass", function(require, exports, module){
    module.exports = {
        getGoodsClassInfo: function(pames, callbackFun){
            request("GoodsClass", "getGoodsClassInfo", pames, function(data){
                callbackFun && callbackFun(data);
            })
        }
    }
})
/**
 * Created by chenzhiliang on 18/1/1.
 */
/**
 * 商城
 * BookStore.js
 */
define("GroupBook", function(require, exports, module) {
    module.exports = {
        /**
         * 获取拼团信息
         *groupNo 数据类型为 string  	团编号
         *userId  数据类型为 string    用户id
         */
        getGroupBookInfo: function (param, callBackFunc) {
            request("GroupBook", "getGroupBookInfo", {
                userId: param.userId,
                groupNo: param.groupNo,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         * 我的拼接记录列表接口
         *userId  数据类型为 string    用户id
         *page	  数据类型为 string  	 分页
         *size   数据类型为 string    分页
         */
        getUserRecordList: function (param, callBackFunc) {
            request("GroupBook", "getUserRecordList", {
                userId: param.userId,
                page: param.page,
                size: param.size,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         * 拼团商品列表接口
         *userId  数据类型为 string    用户id
         *page	  数据类型为 string  	 分页
         *size   数据类型为 string    分页
         */
        getGroupBookGoodsList: function (param, callBackFunc) {
            request("GroupBook", "getGroupBookGoodsList", {
                userId: param.userId,
                page: param.page,
                size: param.size,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }

    }
});

/**
 * Created by chenzhiliang on 17/9/4.
 */
/**
 * 家庭账户
 * HomeAccount.js
 */
define("HomeAccount", function (require, exports, module) {
    module.exports = {
        /**
         *获取账户列表
         *userId    是    string    用户id
         */
        getHomeAccountList: function (userId, callBackFun) {
            request("HomeAccount", "getHomeAccountList", {
                userId: userId
            }, function (data) {
                callBackFun(data);
            });
        },
        /**
         *生成激活码
         *userId    是    string    用户id
         */
        getActiveCode: function (userId,upd,callBackFun) {
            request("HomeAccount", "getActiveCode", {
                userId: userId,
                upd:upd          //当upd=1时 主动更换激活码
            }, function (data) {
                callBackFun(data);
            });
        },
        /**
         *绑定
         *userId    是    string    用户id
         */
        binding: function (userId, activeCode, appellation, masterUserId, callBackFun) {
            request("HomeAccount", "binding", {
                userId: userId,
                activeCode: activeCode,
                appellation: appellation,
                masterUserId: masterUserId
            }, function (data) {
                callBackFun(data);
            });
        },
        /**
         *获取账户列表
         *userId    是    string    用户id
         */
        unbinding: function (userId, slaveUserId, callBackFun) {
            request("HomeAccount", "unbinding", {
                userId: userId,
                slaveUserId: slaveUserId
            }, function (data) {
                callBackFun(data);
            });
        },
        /**
         *获取主账户信息
         *userId    是    string    用户id
         */
        getMasterUserInfo: function (masterUserId,callBackFun) {
            request("HomeAccount", "getMasterUserInfo", {
                masterUserId: masterUserId
            }, function (data) {
                callBackFun(data);
            });
        }

    }
});
/**
 * Created by Chen on 18/1/5.
 */

define("Mission", function(require, exports, module) {
    module.exports = {
        // 主页任务
        getDayMissionsBySize: function (param, callBackFun){
            requestPost("Mission", "getDayMissionsBySize", {
                userId: param.userId,
                size: param.size
            }, function(data) {
                callBackFun(data);
            });
        },

        // 新手成长日常任务
        getSpokesManMission: function (param, callBackFun){
            requestPost("Mission", "getSpokesManMission", {
                userId: param.userId,
                token:param.token,
                roleCode:param.roleCode
            }, function(data) {
                callBackFun(data);
            });
        },
    }
});

/**
 * Created by yudeyu on 2017/9/13.
 */
define("ProductUnion", function(require, exports, module) {
    module.exports = {
        /**
         * preams
         *userId    是    string    用户id
         *token    是    string    token
         * goodsId
         */
        getRecommendProductUnion: function (preams, callBackFun) {
            request("ProductUnion", "getRecommendProductUnion", preams, function (data) {
                callBackFun(data);
            });
        },
        /**
         * preams
         *userId    是    string    用户id
         *token    是    string    token
         * unionId
         */
        getProductUnionDetailInfo: function(preams,callBackFun){
            request("ProductUnion", "getProductUnionDetailInfo", preams, function (data) {
                callBackFun(data);
            });
        },
        /**
         * preams
         *userId    是    string    用户id
         *token    是    string    token
         */
        getExtensionProductUnionList:function(preams,callBackFun){
            request("ProductUnion", "getExtensionProductUnionList", preams, function (data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/5/29.
 */

define("Spokesman", function(require, exports, module) {
    module.exports = {
        /**
         *获取直播列表
         *userId	是	string	用户id
         *token	是	string	token
         */
        // 粉丝排行榜接口
        getFansRank: function (userId,type,callBackFun){
            request("Spokesman", "getFansRank", {
                userId: userId,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        // 奖学金排行榜接口
        getProfitRank: function (userId,type,callBackFun) {
            request("Spokesman", "getProfitRank", {
                userId: userId,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取锁粉邀请卡接口
        getInvitationCard:function (userId, invitationCardId,callBackFun) {
            request("Spokesman", "getInvitationCard", {
                userId: userId,
                invitationCardId:invitationCardId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 锁粉邀请卡列表接口
        getInvitationCardList:function (userId,page,isAll,size,callBackFunc) {
            request("Spokesman", "getInvitationCardList", {
                userId: userId,
                page:page,
                isAll:isAll,
                size:size
            }, function (data) {
                callBackFunc(data);
            });
        },
        // 收益邀请卡商品列表
        getProfitInvitationCardList:function (userId,callBackFunc) {
            request("Spokesman", "getProfitInvitationCardList", {
                userId: userId,
            }, function (data) {
                callBackFunc(data);
            });
        },
        // 收益邀请卡商品列表(新)
        getProfitInvitationList:function (userId,page,size,isAll,callBackFunc) {
            request("Spokesman", "getProfitInvitationList", {
                userId: userId,
                page:page,
                size:size,
                isAll:isAll
            }, function (data) {
                callBackFunc(data);
            });
        },
        // 获取最近收益用户列表
        getLatestProfitList:function (callBackFunc) {
            request("Spokesman", "getLatestProfitList", {}, function (data) {
                callBackFunc(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/10/27.
 */
define("StudyPlan", function(require, exports, module) {
    module.exports = {
        //今日明星故事接口
        getTodayStudyPlan: function (userId,date,callBackFun){
            request("StudyPlan", "getTodayStudyPlan", {
                userId: userId,
                date:date
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/6/27.
 */

define("V2Audio", function(require, exports, module) {
    module.exports = {
        // 粉丝排行榜接口
        getAll: function (userId,page,size,callBackFun){
            request("V2Audio", "getAll", {
                userId: userId,
                page:page,
                size:size
            }, function(data) {
                callBackFun(data);
            });
        },
        getAudioByISBN: function (userId,isbn,callBackFun){
            request("V2Audio", "getAudioByISBN", {
                userId: userId,
                isbn:isbn
            }, function(data) {
                callBackFun(data);
            });
        },
        getAudioAllTag: function (callBackFun){
            request("V2Audio", "getAudioAllTag", {}, function(data) {
                callBackFun(data);
            });
        },
        getAudioByTag: function (userId,size,page,tagId,type,callBackFun){
            request("V2Audio", "getAudioByTag", {
                userId: userId,
                size:size,
                page:page,
                tagId:tagId,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        getTeacherInfo: function (teacherId,callBackFun){
            request("V2Audio", "getTeacherInfo", {
                teacherId: teacherId
            }, function(data) {
                callBackFun(data);
            });
        },
        getAudioByTeacher: function (userId,size,page,teacherId,type,callBackFun){
            request("V2Audio", "getAudioByTeacher", {
                userId: userId,
                size:size,
                page:page,
                teacherId:teacherId,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        getAudioPlayList: function (userId,audioId,isbn,albumId,keyword,tagId,teacherId,rankingList,homePage,picBookId,callBackFun){
            request("V2Audio", "getAudioPlayList", {
                userId: userId,
                audioId:audioId,
                isbn:isbn,
                albumId:albumId,
                keyword:keyword,
                tagId:tagId,
                teacherId:teacherId,
                rankingList:rankingList,
                homePage:homePage,
                picBookId:picBookId
            }, function(data) {
                callBackFun(data);
            });
        },
        audioSearch: function (userId,tagId,page,size,keyword,type,callBackFun){
            request("V2Audio", "audioSearch", {
                userId: userId,
                tagId:tagId,
                page:page,
                size:size,
                keyword:keyword,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        studyRecord: function (userId,audioId,timestamp,terminal,network,studyRecordId,lastPlayTime,audioType,audioTime,callBackFun){
            request("V2Audio", "studyRecord", {
                userId: userId,
                audioId:audioId,
                timestamp:timestamp,
                terminal:terminal,
                network:network,
                studyRecordId:studyRecordId,
                lastPlayTime:lastPlayTime,
                audioType:audioType,
                audioTime:audioTime
            }, function(data) {
                callBackFun(data);
            });
        },
        getRankingList: function (userId,page,size,callBackFun){
            request("V2Audio", "getRankingList", {
                userId:userId,
                page:page,
                size:size
            }, function(data) {
                callBackFun(data);
            });
        },
        collectionOrCancel: function (userId,type,id,callBackFun){
            request("V2Audio", "collectionOrCancel", {
                userId:userId,
                type:type,
                id:id
            }, function(data) {
                callBackFun(data);
            });
        },
        getUserCollectionList: function (userId,page,size,type,callBackFun){
            request("V2Audio", "getUserCollectionList", {
                userId:userId,
                page:page,
                size:size,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        getAudioById:function (userId,audioId,callBackFun) {
            request("V2Audio", "getUserCollectionList", {
                userId:userId,
                audioId:audioId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取IP列表
        getIPList:function (callBackFun) {
            request("V2Audio", "getIPList", {}, function(data) {
                callBackFun(data);
            });
        },
        // 听故事大IP信息
        getIPInfo:function (param,callBackFun) {
            request("V2Audio", "getIPInfo", {
                ipId:param.ipId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取大IP中音频或专辑列表
        getIPAudioList:function (param,callBackFun) {
            request("V2Audio", "getIPAudioList", {
                userId:param.userId,
                ipId:param.ipId,
                type:param.type,
                page:param.page,
                size:param.size,
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取今日故事
        getTodayAudio:function (param,callBackFun) {
            request("V2Audio", "getTodayAudio", {
                userId:param.userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取推荐老师
        getRecommendTeacherList:function (callBackFun) {
            request("V2Audio","getRecommendTeacherList",null,function(data) {
                callBackFun(data);
            });
        },
        // 猜你喜欢
        guessLikeAudio:function (param,callBackFun) {
            request("V2Audio", "guessLikeAudio", {
                userId:param.userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 最近收听
        getRecentListenAudio:function (param,callBackFun) {
            request("V2Audio", "getRecentListenAudio", {
                userId:param.userId,
                page:param.page,
                size:param.size
            }, function(data) {
                callBackFun(data);
            });
        },
        // 听故事完成
        storyComplete:function (param,callBackFun) {
            request("V2Audio", "storyComplete",param , function(data) {
                callBackFun(data);
            });
        },
        // 最近收听
        getAudioByIdFun:function (param,callBackFun) {
            request("V2Audio", "getAudioById",param, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/10/11.
 */
define("V2AudioNew", function(require, exports, module) {
    module.exports = {
        // 听故事完成
        storyComplete:function (param,callBackFun) {
            request("V2AudioNew", "storyComplete",param , function(data) {
                callBackFun(data);
            });
        },
        // 打卡
        goPunch: function(userId, taskId, leaveWord, callBackFun) {
            request("V2AudioNew", "goPunch", {
                userId: userId,
                taskId: taskId,
                token: token,
                leaveWord: leaveWord
            }, function(data) {
                callBackFun(data);
            });
        },
        // 打卡状态
        punchStatus: function(userId, callBackFun) {
            request("V2AudioNew", "punchStatus", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by chenzhiliang on 17/10/11.
 */
define("V2AudioPunch", function(require, exports, module) {
    module.exports = {
        // 打卡状态
        punchStatus: function(userId, callBackFun) {
            request("V2AudioPunch", "punchStatus", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 获取积分
        storeCredits: function(callBackFun) {
            request("V2AudioPunch", "storeCredits", {}, function(data) {
                callBackFun(data);
            });
        },
        // 参与打卡任务
        joinActivity: function(userId, callBackFun) {
            request("V2AudioPunch", "joinActivity", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 打卡
        goPunch: function(userId, taskId, leaveWord, callBackFun) {
            request("V2AudioPunch", "goPunch", {
                userId: userId,
                taskId: taskId,
                token: token,
                leaveWord: leaveWord
            }, function(data) {
                callBackFun(data);
            });
        },
        //7天打卡标记
        todayPosistion: function(userId, taskId, callBackFun) {
            request("V2AudioPunch", "todayPosistion", {
                userId: userId,
                taskId: taskId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 打卡记录日历
        punchCalendar: function(userId, taskId, startDate, endDate, callBackFun) {
            request("V2AudioPunch", "punchCalendar", {
                userId: userId,
                taskId: taskId,
                startDate: startDate,
                endDate: endDate
            }, function(data) {
                callBackFun(data);
            });
        },
        // 听故事打卡排行榜
        storeRanking: function(userId, callBackFun) {
            request("V2AudioPunch", "storeRanking", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 分享成功获得积分
        shareCredits: function(userId, callBackFun) {
            request("V2AudioPunch", "shareCredits", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        // 分享接口
        getSharePageInfo: function(param, callBackFun) {
            request("V2AudioPunch", "getSharePageInfo", param, function(data) {
                callBackFun(data);
            });
        },
        // 用户积分
        userCredits:function (userId,callBackFun) {
            request("V2AudioPunch", "userCredits", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        //分享故事分享落地页接口
        getSharePageInfo1: function(param, callBackFun) {
            request("V2AudioPunch", "getSharePageInfo1", param, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * Created by yudeyu on 2018/4/12.
 */
define ("WeiXinArticle", function(require, exports, module){
    module.exports = {
        getArticlesByType: function(pames, callbackFun){
            request("WeiXinArticle", "getArticlesByType", pames, function(data){
                callbackFun && callbackFun(data);
            })
        },

        /*获取商品详情根据文章ID
        *articleId	string	文章ID
        * */
        getGoodsByArticleId:function(param,callbackFun){
            request("WeiXinArticle", "getGoodsByArticleId", {
                articleId:param.articleId
            }, function(data){
                callbackFun && callbackFun(data);
            })
        }
    }
})
/*
关注见面礼*/

define ("WxConcernGift", function(require, exports, module){
    module.exports = {
        getWxConcerGiftInfo: function(pames, callbackFun){
            request("WxConcernGift", "getWxConcerGiftInfo", pames, function(data){
                callbackFun(data);
            })
        }
    }
})
/**
 * 亲子任务营
 * Activity.js
 */
define("activity", function(require, exports, module) {
    module.exports = {
        /**
         *用户奖品页
         *taskId	是	int	任务id
         *userId	是	string	用户
         */
        getUserPrize: function (userId,taskId, callBackFun){
            request("Activity", "getUserPrize", {
                userId: userId,
                taskId:taskId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *领奖
         *prizeId	是	int	奖品id
         *userId	是	string	用户
         *name	否	string	收货人名称
         *tel	否	string	收货人手机号
         *address	否	string	收货人地址
         *remark	否	string	备注
         * province  省
         * city   市
         * area 区
         */
        acceptPrize: function (userId,prizeId,name,tel,address,province,city,area, callBackFun){
            request("Activity", "acceptPrize", {
                userId: userId,
                prizeId:prizeId,
                name:name,
                tel:tel,
                address:address,
                province:province,
                city:city,
                area:area
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});

/**
 * 商城
 * BookStore.js
 */
define("BookStore", function(require, exports, module) {
    module.exports = {
        /**
         *获取购物车 个数
         *userId 数据类型为 string  用户id
         */
        getProfitInvitationCard: function (bookId,isRandom,backgroundImageName,callBackFunc){
            request("BookStore","getProfitInvitationCard",{
                userId:userID,
                bookId:bookId,
                isRandom:isRandom,
                backgroundImageName:backgroundImageName
            },function (data) {
                callBackFunc(data);
            });
        },

        /*
         *  获取赚钱卡背景图片小图列表
         *  bookId  数据类型为string 商品id
         *
        */
        getProfitCardBackImgList:function(bookId,callBackFunc){
            request('BookStore','getProfitCardBackImgList',{
                userId:userID,
                bookId:bookId
            },function(data){
                callBackFunc(data)
            });
        },

        /*
         *  获取赚钱卡背景图片大图片
         *  bookId  数据类型为string 商品id
         *  backGroundImgId  数据类型为string  图片id
         */
        getProfitInvitationCard:function(bookId,backGroundImgId,callBackFunc){
            request('BookStore','getProfitInvitationCard',{
                userId:userID,
                bookId:bookId,
                backGroundImgId:backGroundImgId
            },function(data){
                callBackFunc(data)
            });
        },
        /**
         *商场商品详情页
         * preams.userId = userId;
         *preams.bookId = goodId;
         */
        getBookInfo: function (preams, callBackFun){
            request("BookStore", "getInfo", preams, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取商品规格信息
         * preams包括 {userId: userId, token: token, bookId: goodId, fromCouponId: getQuery("fromCouponId") || ''};
         */
        getGoodDetailsCarousel: function (preams, callBackFun){
            request("BookStore", "getProducts", preams, function(data) {
                callBackFun(data);
            });
        },
        /**
         * 拼团新增加
         *获取在此商品上正在拼的团列表
         *bookId 数据类型为 string  	商品id
         *userId 数据类型为 string    用户id
         */
        getGroupBooking: function (param, callBackFunc) {
            request("BookStore", "getGroupBooking", {
                userId: param.userId,
                bookId: param.bookId,
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         * 获取商品最高收益接口
         *获取在此商品上正在拼的团列表
         */
        getMaxProfitByGoodsId: function (param, callBackFunc) {
            request("BookStore", "getMaxProfitByGoodsId", {
                userId: param.userId,//userId
                bookId: param.bookId,//商品ID
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }

   }
});

/**
 * 公共模块接口
 * commonModul.js
 */
define("Common", function(require, exports, module) {
    module.exports = {
        /**
         *获取字典数据列表（可用于热门搜索）
         *dictCode	是	string	字典码
         */
        getDictDataListByCode: function (dictCode,callBackFun){
            request("Common", "getDictDataListByCode", {
                dictCode: dictCode
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * 获取 优惠券 数据
 * coupon.js
 */
define("Coupons", function(require, exports, module) {
    module.exports = {
        /**
         *查看商品详情页优惠券
         *userId 是 数据类型为 string  用户id
         *goodId 否 数据类型为 string  商品ID
         */
        showGoodCoupon: function (param, callBackFunc) {
            request("Coupons", "showGoodCoupon", {
                userId: param.userId,
                goodId: param.goodId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *通过优惠券id获取优惠券
         *userId 是 数据类型为 string  用户id
         *cudId 是 数据类型为 string  链接中的长ID 即cguid
         */
        getCoupons: function (param, callBackFunc) {
            request("Coupons", "getCoupons", {
                userId: param.userId,
                cudId: param.cudId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});

/**
 * 帮助中心
 * HelpCenter.js
 */
define("HelpCenter", function(require, exports, module) {
    module.exports = {
        /**
         *通过关键字获取帮助文章
         *type	是	int	类型：1 直播 2伴读 3 听故事
         *keyWord	是	string	关键词
         */
        getArticleByKeyWords: function (pames,callBackFun){
            request("HelpCenter", "getArticleByKeyWords", pames, function(data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * 邀请卡
 * invitation.js
 */
define("InvitationActivity", function(require, exports, module) {
    module.exports = {
        /**
         *微信邀请卡活动详情页
         *userId    是    string    用户id
         *invitationActivityId	是	int	邀请卡活动ID
         */
        getInvitationActivityInfo: function (pream, callBackFunc) {
            request("InvitationActivity", "getInvitationActivityInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *微信邀请卡操作详情
         *userId    是    string    用户id
         *invitationActivityId	是	int	邀请卡活动ID
         */
        getInvitationOperateInfo: function (pream, callBackFunc) {
            request("InvitationActivity", "getInvitationOperateInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         * 获取邀请卡专题信息
         *groupNo 数据类型为 string  	团编号
         *userId  数据类型为 string    用户id
         */
        getInvitationSpecialTopicInfo: function (param, callBackFunc) {
            request("InvitationActivity", "getInvitationSpecialTopicInfo",param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },


        /**
         * 获取邀请卡专题信息
        *payOrderNo		        string	商品订单号
        *backGroundImgId		int	    邀请卡背景图ID
        */
        saveV3OrderByProfitCard: function (param, callBackFunc) {
            request("InvitationActivity", "saveV3OrderByProfitCard",{
                payOrderNo:param.payOrderNo,
                backGroundImgId:param.backGroundImgId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },

        /**
         * 保存用户扫描邀请卡的记录
         *userId		        string	用户的userID
         *backGroundImgId		int	邀请卡背景图ID
         *goodsId		        int	商品ID
         */
        saveProfitCardRecord: function (param, callBackFunc) {
            request("InvitationActivity", "saveProfitCardRecord",{
                userId:param.userId,
                backGroundImgId:param.backGroundImgId,
                goodsId:param.goodsId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
    }
});

/**
 * 获取用户信息
 * lockFans.js
 */
define("lockFans", function(require, exports, module) {
    module.exports = {
        /**
         *锁粉
         *userId 是 数据类型为 string  用户id
         *token 是 数据类型为 string
         *fromUserId 是 数据类型为 string  发起人userId
         *modular 是 数据类型为 string  锁粉时的业务生成场景
         **/
        addLockFansReocrd: function (param, callBackFun){
            if(param.userId == param.fromUserId){
                return true;
            }
            request("LockFans", "addLockFansReocrd", {
                userId: param.userId,
                token: param.token,
                fromUserId: param.fromUserId,
                modular: 'redPacket'
            }, function(data) {
                callBackFun && callBackFun(data);
            });
        }
    }
});

/**
 * 订单接口
 * Order.js
 */
define("order", function(require, exports, module) {
    module.exports = {
        /**
         *订单详情
         * userId:
         * payOrderNo
         */
        getV3OrderInfo: function (param, callBackFun) {
            request("Order", "getV3OrderInfo", param, function (data) {
                callBackFun(data);
            });
        },
        /**
         *取消订单
         * userId:
         * payOrderNo
         */
        cancel: function (param, callBackFun) {
            request("Order", "cancel", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *申请发票
         * userId:
         * payOrderNo
         * head
         * invoiceType
         * headingCode
         */
        applyInvoice: function (param, callBackFun) {
            request("Order", "applyInvoice", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         * 重新申请发票
         * userId:
         * payOrderNo
         * head
         * invoiceType
         * headingCode
         */
        updateInvoice: function (param, callBackFun) {
            request("Order", "updateInvoice", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *确认收货
         * userId:
         * payOrderNo
         */
        makeSure: function (param, callBackFun) {
            request("Order", "makeSure", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *获取订单列表
         * userId:
         * payOrderNo
         * userId
         size
         page
         orderStatus
         */
        getV3OrdersByUser: function (param, callBackFun) {
            request("Order", "getV3OrdersByUser", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *获取订单列表
         * payOrderNo:
         */
        isDelaySendGoodsByPayOrderNo: function (param, callBackFun) {
            request("Order", "isDelaySendGoodsByPayOrderNo", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *获取申请退货订单
         * userId:
         * afterServiceRecordId
         * userId
         */
        getAfterServiceDetail: function (param, callBackFun) {
            request("Order", "getAfterServiceDetail", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *获取申请退货订单
         * userId:
         * afterServiceRecordId
         * userId
         */
        submitExpressNo: function (param, callBackFun) {
            request("Order", "submitExpressNo", param, function (data) {
                callBackFun && callBackFun(data);
            });
        },
        /**
         *获取用户是否已购买某个商品
         */
        getBoughtOrNot: function (param, callBackFun) {
            request("Order", "getBoughtOrNot", {
                userId:param.userId,
                goodsId:param.goodsId
            }, function (data) {
                callBackFun && callBackFun(data);
            });
        },
    }
});
/**
 * 支付
 * Pay.js
 */
define("pay", function(require, exports, module) {
    module.exports = {
        /**
         *支付接口
         * userId: userID,
         * payOrderNo: vm.payOrderNo,
         * spbillCreateIp: '192.168.1.1',
         * attach: "新东方绘本馆订单支付",
         * body: "新东方绘本馆订单支付",
         * cudId: "",//优惠券ID 空就可以
         * qrPay: 1,  //二维码支付
         * bPcQr: 1   //pc支付
         * scholarship_account //奖学金
         */
        pay: function (param, callBackFun) {
            request("Pay", "pay", param, function (data) {
                callBackFun(data);
            });
        }
    }
});
/**
 * 获取 用户中心 信息
 * PersonalCenter.js
 */
define("PersonalCenter", function(require, exports, module) {
    module.exports = {
        /**
         *获取购物车 个数
         *userId 数据类型为 string  用户id
         */
        getTab: function (userId, callBackFunc){
            request("PersonalCenter", "getTab", {
                userId: userId
            }, function (data) {
                callBackFunc(data);
            });
        },
        getAllNotification:function (userId, callBackFunc) {
            request("PersonalCenter", "getAllNotification", {
                userId: userId
            }, function (data) {
                callBackFunc(data);
            });
        },
        updateNotificationStauts:function (userId,notificationId,flag,callBackFunc) {
            request("PersonalCenter", "updateNotificationStauts", {
                userId: userId,
                notificationId:notificationId,
                flag:flag
            }, function (data) {
                callBackFunc(data);
            });
        },
        getUserInfo:function (userId,callBackFunc) {
            request("PersonalCenter", "getUserInfo", {
                userId: userId,
            }, function (data) {
                callBackFunc(data);
            });
        },
        sendSms:function (userId,phoneNum,call,callBackFunc) {
            request("PersonalCenter", "sendSms", {
                userId: userId,
                phoneNum: phoneNum,
                call: call
            }, function (data) {
                callBackFunc(data);
            });
        },
        bindingPhoneNum:function (userId,phoneNum,call,code,password,callBackFunc) {
            request("PersonalCenter", "bindingPhoneNum", {
                userId: userId,
                phoneNum: phoneNum,
                call:call,
                code: code,
                password: password
            }, function (data) {
                callBackFunc(data);
            });
        },
        saveUserInfo:function (userId,password,babySex,babyName,babyBirthday,parentName,appellation,vmFileName,callBackFunc) {
            request("PersonalCenter", "saveUserInfo", {
                userId: userId,
                password: password,
                babySex: babySex,
                babyName: babyName,
                babyBirthday: babyBirthday,
                parentName: parentName,
                appellation: appellation,
                img:vmFileName
            }, function (data) {
                callBackFunc(data);
            });
        },
        checkUserSubscribe:function (userId,wxAccountId,callBackFunc) {
            request("PersonalCenter", "checkUserSubscribe", {
                userId: userId,
                wxAccountId: wxAccountId  //公众账号ID (新东方绘本课堂（服务号）：11，新东方绘本馆（订阅号）：12)
            }, function (data) {
                callBackFunc(data);
            });
        },
        checkUserSubscribeByScene:function (userId,wxAccountId,scene,callBackFunc) {
            request("PersonalCenter", "checkUserSubscribeByScene", {
                userId: userId,
                wxAccountId: wxAccountId,
                scene:scene
            }, function (data) {
                callBackFunc(data);
            });
        },
        /*提交验证信息
         idCard :  身份证号
         idCardName : 身份证姓名
         */
        bindingPhoneIdCard: function (param,callBackFun){
            request("PersonalCenter", "bindingPhoneIdCard", {
                userId: param.userId,
                token: param.token,
                isValidateIdCard: param.isValidateIdCard,
                idCard: param.idCard,
                idCardName: param.idCardName,
                code: param.code,
                phoneNum: param.phoneNum,
            }, function(data) {
                callBackFun && callBackFun(data);
            });
        },
        //用户是否验证过身份
        isAlreadyBindingPhoneIdCard:function(userId,callBackFun){
            request("PersonalCenter","isAlreadyBindingPhoneIdCard",{
                userId:userID
            },function(data){
                callBackFun && callBackFun(data);
            })
        },
        //获取用户当前微信头像
        getUserWxImg:function (param,callBackFun) {
            request("PersonalCenter","getUserWxImg",{
                userId:param.userId
            },function(data){
                callBackFun && callBackFun(data);
            })
        },
        //更新用户头像为当前微信头像
        updateUserWxImg:function (param,callBackFun) {
            request("PersonalCenter","updateUserWxImg",{
                userId:param.userId
            },function(data){
                callBackFun && callBackFun(data);
            })
        }
    }
});

/**
 * Created by yanan on 2018/3/5.
 */
/**
 * 我的奖励
 * prize.js
 */
define("V2Activity", function (require, exports, module) {
    module.exports = {
        /**
         *获取奖品列表
         *userId    是    string    用户id
         *activityType    是    string    活动类型 类型 2 伴读 3 代言人 4 听故事
         * page
         * size
         */
        getUserPrizeList: function (pream, callBackFunc) {
            request("V2Activity", "getUserPrizeList", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取奖品数量
         *userId    是    string    用户id
         *activityType    是    string    活动类型 类型 2 伴读 3 代言人 4 听故事
         */
        getUserPrizeTotalNum: function (pream, callBackFunc) {
            request("V2Activity", "getUserPrizeTotalNum", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取奖品详细
         *userId    是    string    用户id
         *userPrizeId    是    string    用户奖品ID
         *taskPrizeId	是	string	奖项ID 优先使用userPrizeId 没有则读取 taskPrizeId
         */
        getUserPrizeDetail: function (pream, callBackFunc) {
            request("V2Activity", "getUserPrizeDetail", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *领取奖品
         *userId    是    string    用户id
         *userPrizeId    是    string    用户奖品ID
         */
        acceptPrize: function (pream, callBackFunc) {
            request("V2Activity", "acceptPrize", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取任务奖品列表
         *userId    是    string    用户id
         *userPrizeId    是    string    用户奖品ID
         */
        getTaskPrizeList: function (pream, callBackFunc) {
            request("V2Activity", "getTaskPrizeList", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});
/**
 * 新版伴读
 * V2Punch.js
 */
define("V2Punch", function(require, exports, module) {
    module.exports = {
        /**
         *获取用户信息及伴读信息
         *userId	是	string	用户id
         *token	是	string	token
         */
        getUserPunchInfo: function (userId,callBackFun){
            request("V2Punch", "getUserPunchInfo", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读年龄标签
         *userId	是	string	用户id
         */
        getPunchAgeTag: function (userId,callBackFun){
            request("V2Punch", "getPunchAgeTag", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *保存用户标签
         *userId	是	string	用户名
         *token	是	string	token
         *tag	是	string	标签id
         */
        saveUserAgeTag: function (userId,tag,callBackFun){
            request("V2Punch", "saveUserAgeTag", {
                userId: userId,
                tag:tag
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *通过标签获取伴读列表
         *userId	是	String	用户ID
         *token	是	String	token
         *tag	是	int	标签id
         *size	是	int	分页
         *page	是	int	分页
         */
        getPunchByTag: function (userId,tag,size,page,callBackFun){
            request("V2Punch", "getPunchByTag", {
                userId: userId,
                tag:tag,
                size:size,
                page:page
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取目录页详细
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         */
        getCourseInfo: function (userId,courseId,studyPlanId,callBackFun){
            request("V2Punch", "getCourseInfo", {
                userId: userId,
                courseId:courseId,
                studyPlanId:studyPlanId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取目录页列表
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         */
        getCourseClassList: function (userId,courseId,callBackFun){
            request("V2Punch", "getCourseClassList", {
                userId: userId,
                courseId:courseId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *校验是否可解锁
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         *classId	是	string	课时ID
         */
        check: function (userId,courseId,classId,callBackFun){
            request("V2Punch", "check", {
                userId: userId,
                courseId:courseId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *解锁课时
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         *classId	是	string	课时ID
         */
        unlockClass: function (userId,courseId,classId,callBackFun){
            request("V2Punch", "unlockClass", {
                userId: userId,
                courseId:courseId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取课时信息
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         *classId	是	string	课时ID
         */
        getClassInfo: function (userId,courseId,classId,callBackFun){
            request("V2Punch", "getClassInfo", {
                userId: userId,
                courseId:courseId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *提交用户媒体资源
         *userId	是	string	用户id
         *courseId	是	int	课程ID
         *classId	是	int	课时ID
         *pageId	是	int	学习页ID
         *modelUrl	是	string	模板链接
         *media	否	string	资源 当type !=pc时传
         *audioUrl	否	string	文件url 当type=pc时传
         *type	否	string	当type=pc时 为pc 默认手机
         */
        submitMedia: function (userId,courseId,classId,pageId,modelUrl,media,audioUrl,type,callBackFun){
            request("V2Punch", "submitMedia", {
                userId: userId,
                courseId:courseId,
                classId:classId,
                pageId:pageId,
                media:media,
                modelUrl:modelUrl,
                audioUrl:audioUrl,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *完成课时
         *userId	是	string	用户名
         *token	是	string	token
         *courseId	是	string	课程ID
         *classId	是	string	课时ID
         * terminal	否	String	终端
         *network	否	String	网络环境
         */
        finishClass: function (userId,courseId,classId,terminal,network,callBackFun){
            request("V2Punch", "finishClass", {
                userId: userId,
                courseId:courseId,
                classId:classId,
                terminal:terminal,
                network:network
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读打卡任务信息
         *userId	是	string	用户名
         *token	是	string	token
         */
        getUserPunchTaskInfo: function (userId,callBackFun){
            request("V2Punch", "getUserPunchTaskInfo", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读关卡列表
         *userId	是	string	用户名
         */
        getUserPunchTaskList: function (userId,callBackFun){
            request("V2Punch", "getUserPunchTaskList", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取无锁版详细
         *courseId	是	string	伴读ID
         */
        getUnlockDetail: function (courseId,callBackFun){
            request("V2Punch", "getUnlockDetail", {
                courseId: courseId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取学习计划列表
         *type	否	string	类型 1 中文 2 英文 3 全能宝宝 （不传则返回全部类型数据）
         */
        getPunchStudyPlanList: function (type,callBackFun){
            request("V2Punch", "getPunchStudyPlanList", {
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取用户伴读列表
         *userId	是	string	用户名
         *size	是	string	分页
         *page	是	string	分页
         *queryType	是	string	查询类型 0 学习中 1 已完成 2 已购买
         */
        getUserPunchList: function (userId,size,page,queryType,callBackFun){
            request("V2Punch", "getUserPunchList", {
                userId: userId,
                size:size,
                page:page,
                queryType:queryType
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读列表
         *userId	是	string	用户ID
         *page	是	string	分页
         *size	是	string	分页
         *free	否	string	0 :付费， 1: 免费， 其他:全部
         * tag	否	string	标签 多个的话 以英文逗号隔开
         * keyword	否	string	搜索关键字
         */
        getPunchList: function (userId,page,size,free,tag,keyword,callBackFun){
            request("V2Punch", "getPunchList", {
                userId: userId,
                page:page,
                size:size,
                free:free,
                tag:tag,
                keyword:keyword
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *收藏或取消收藏
         *userId	是	string	用户ID
         *courseId	是	string	收藏ID
         */
        collectionOrCancel: function (userId,courseId,callBackFun){
            request("V2Punch", "collectionOrCancel", {
                userId: userId,
                courseId:courseId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取收藏列表
         *userId	是	string	用户ID
         *page	是	string	分页
         *size	是	string	分页
         */
        getUserCollectionList: function (userId,page,size,callBackFun){
            request("V2Punch", "getUserCollectionList", {
                userId: userId,
                page:page,
                size:size
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *搜索
         *userId	是	string	用户名
         *page	是	string	分页
         *size	是	string	分页
         *keyword	是	string	关键字
         */
        search: function (userId,page,size,keyword,callBackFun){
            request("V2Punch", "search", {
                userId: userId,
                page:page,
                size:size,
                keyword:keyword
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *保存用户和学习计划关系
         *userId	是	string	用户名
         *studyPlanId	是	string	学习计划ID
         */
        saveUserStudyPlan: function (userId,studyPlanId,callBackFun){
            request("V2Punch", "saveUserStudyPlan", {
                userId: userId,
                studyPlanId:studyPlanId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取无锁版详细
         *courseId	是	string	伴读ID
         */
        checkJoinPunchTask: function (userId,callBackFun){
            request("V2Punch", "checkJoinPunchTask", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读奖品列表
         *userId	是	string	用户名
         *type	否	string	-1 已过期 1 已领取 2 已过期
         */
        getUserPunchPrizeList: function (userId,queryType,callBackFun){
            request("V2Punch", "getUserPunchPrizeList", {
                userId: userId,
                queryType:queryType
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取学习计划信息
         *userId	是	string	用户名
         *studyPlanId	是	string	学习计划ID
         */
        getStudyPlanInfo: function (userId,studyPlanId,callBackFun){
            request("V2Punch", "getStudyPlanInfo", {
                userId: userId,
                studyPlanId:studyPlanId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取用户学习记录
         *userId	是	string	用户名
         *startTime	是	string	2017-01-01
         *endTime	否	string	2017-01-31
         */
        getUserStudyRecordByTime: function (userId,startTime,endTime,callBackFun){
            request("V2Punch", "getUserStudyRecordByTime", {
                userId: userId,
                startTime:startTime,
                endTime:endTime
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取伴读标签
         */
        getPunchTags: function (callBackFun){
            request("V2Punch", "getPunchTags", {}, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取推荐伴读列表
         *userId	是	string	用户ID
         *free	否	string	0 :付费， 1: 免费
         *page	是	string	分页
         *size	是	string	分页
         * type 否 string pc 默认手机
         */
        getPunchRecommendList: function (userId,page,size,free,type,callBackFun){
            request("V2Punch", "getPunchRecommendList", {
                userId:userId,
                page:page,
                size:size,
                free:free,
                type:type
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *校验是否已解锁
         *userId	是	string	用户ID
         *classId	是	string	课时ID
         */
        checkLock: function (userId,classId,callBackFun){
            request("V2Punch", "checkLock", {
                userId:userId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *制作用户毕业证
         *userId	是	string	用户ID
         *token	是	string	token
         *name	是	string	名称
         *courseId	是	string	伴读ID
         */
        makeUserDiplomaImg: function (pream,callBackFun){
            request("V2Punch", "makeUserDiplomaImg", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取用户毕业证
         *userId	是	string	用户ID
         *token	是	string	token
         *courseId	是	string	伴读D
         */
        getUserDiplomaImg: function (pream,callBackFun){
            request("V2Punch", "getUserDiplomaImg", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取用户伴读证书信息
         *userId	是	string	用户ID
         *token	是	string	token
         *courseId	是	string	伴读D
         */
        getUserCourseDiplomaInfo: function (pream,callBackFun){
            request("V2Punch", "getUserCourseDiplomaInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *加入伴读打卡
         *userId	是	string	用户ID
         */
        joinPunchTask: function (pream,callBackFun){
            request("V2Punch", "joinPunchTask", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取伴读分享落地页信息
         *fromUserId	是	string	用户ID
         *courseId	是	string	伴读ID
         */
        getSharePageInfo: function (pream,callBackFun){
            request("V2Punch", "getSharePageInfo", pream, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *完成课时(新)
         *userId    是    string    用户名
         *token    是    string    token
         *courseId    是    string    课程ID
         *classId    是    string    课时ID
         * terminal    否    String    终端
         *network    否    String    网络环境
         */
        finish: function (pream, callBackFun) {
            request("V2Punch", "finish", pream, function (data) {
                callBackFun(data);
            });
        },
        /**
         *获取成绩页信息
         *userId    是    string    用户名
         *courseId    是    string    课程ID
         *classId    是    string    课时ID
         */
        getFinishInfo: function (pream, callBackFun) {
            request("V2Punch", "getFinishInfo", pream, function (data) {
                callBackFun(data);
            });
        },
        /**
         *获取用户学习信息
         */
        getUserStudyInfo: function (param, callBackFunc) {
            request("V2Punch", "getUserStudyInfo", {
                userId: param.userId  //userId	是	string	用户名
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }
    }
});
/**
 * Created by yanan on 2018/3/24.
 */

// 分享管理
define("Share", function (require, exports, module) {
    module.exports = {
        /**
         *获取分享信息
         *sharePositionCode    是    string    位置CODE
         *shareTypeCode    是    string    分享形式（shareAppMessage:分享给朋友, shareTimeline:分享到朋友圈）
         */
        getShareInfo: function (param, callBackFunc) {
            request("Share", "getShareInfo", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *添加分享记录
         *userId    是    string    用户ID
         *token    是    string    token
         *shareId    是    int    分享记录ID
         *sharePositionCode    是    String    分享位置CODE
         *shareTypeCode    是    String    分享形式
         *paramId    否    int    参数ID，当分析那个页面为详情页时为必填项，值为页面数据ID
         */
        addShareRecord: function (param, callBackFunc) {
            request("Share", "addShareRecord", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *添加分享记录
         *userId    是    string    用户ID
         *token    是    string    token
         *shareId    是    int    分享记录ID
         * shareUserId    是    int    分享人ID
         *sharePositionCode    是    String    分享位置CODE
         *shareTypeCode    是    String    分享形式
         *paramId    否    int    参数ID，当分析那个页面为详情页时为必填项，值为页面数据ID
         */
        addUserPageViewRecord: function (param, callBackFunc) {
            request("Share", "addUserPageViewRecord", param, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
    }
});
/**
 * 获取 配套资源 数据
 * SupportingResource.js
 */
define("SupportingResource", function(require, exports, module) {
    module.exports = {
        /**
         *获取 用户图书包列表
         *userId 是 数据类型为 string  用户id
         */
        getPicBookPackageList: function (param, callBackFunc) {
            request("SupportingResource", "getPicBookPackageList", {
                userId: param.userId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *获取 用户单行本和套装列表
         *userId 是 数据类型为 string  用户id
         *size 是 数据类型为 Number  每页数量
         *page 是 数据类型为 Number  页数
         **/
        getPicBookList: function (param, callBackFunc) {
            request("SupportingResource", "getPicBookList", {
                userId: param.userId,
                size: param.size,
                page: param.page
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 根据图书包ID获取用户单行本和套装列表
         *userId 是 数据类型为 string  用户id
         *size 是 数据类型为 Number  每页数量
         *page 是 数据类型为 Number  页数
         *packageId	是 数据类型为 string	图书包ID
         *sort 否 数据类型为 string 排序 desc 倒序
         **/
        getPicBookListByPackageId: function (param, callBackFunc) {
            request("SupportingResource", "getPicBookListByPackageId", {
                userId: param.userId,
                size: param.size,
                page: param.page,
                packageId: param.packageId,
                sort: param.sort,
                ageScope:param.ageScope
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 根据套装ID获取单行本
         *userId 是 数据类型为 string  用户id
         *size 是 数据类型为 Number  每页数量
         *page 是 数据类型为 Number  页数
         *setId	是 数据类型为 string	套装ID
         **/
        getPicBookListBySetId: function (param, callBackFunc) {
            request("SupportingResource", "getPicBookListBySetId", {
                userId: param.userId,
                size: param.size,
                page: param.page,
                setId: param.setId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 搜索
         *userId 是 数据类型为 string  用户id
         *size 是 数据类型为 Number  每页数量
         *page 是 数据类型为 Number  页数
         *keyword 是 数据类型为 string 搜索关键字
         **/
        search: function (param, callBackFunc) {
            request("SupportingResource", "search", {
                userId: param.userId,
                size: param.size,
                page: param.page,
                // keyword: unescape(escape(param.keyword).replace(/\%uD.{3}/g, ''))
                keyword: param.keyword
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *userId 是 数据类型为 string  用户id
         *token	是 数据类型为 string
         *bookId 是 数据类型为 Number 单行本ID
         **/
        getResourceByBookId: function (param, callBackFunc) {
            request("SupportingResource", "getResourceByBookId", {
                userId: param.userId,
                bookId: param.bookId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**  图书包服务页首页
         *packageId	是	int	图书包ID
         *userId	是	string	用户ID
         **/
        bookPackageHome: function (params, callBackFunc) {
            request("SupportingResource", "bookPackageHome", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },

        /** 上报图书包绘本打开记录
         *packageId	是	int	图书包ID
         *userId	是	string	用户ID
         *bookId	是	int	绘本ID
         **/
        upBookPackageRecord: function (params, callBackFunc) {
            request("SupportingResource", "upBookPackageRecord", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 赠课列表首页信息
         *userId	是	string	用户ID
         **/
        donateCourseInfo: function (params, callBackFunc) {
            request("SupportingResource", "donateCourseInfo", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }

    }
});


/**
 * 获取 配套资源 数据
 * DonateCourse.js
 *
 *
 * 拆分图书包部分接口
 */
define("DonateCourse", function(require, exports, module) {
    module.exports = {
        /** 赠课列表首页信息
         *userId	是	string	用户ID
         **/
        donateCourseInfo: function (params, callBackFunc) {
            request("DonateCourse", "donateCourseInfo", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 赠课列表知识树一级节点数据
         *userId	是	string	用户ID
         **/
        donateCourseFirst: function (params, callBackFunc) {
            request("DonateCourse", "donateCourseFirst", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 知识树下级节点数据
         *fatherId	是	int	知识树节点ID
         **/
        knowledgeTreeChild: function (params, callBackFunc) {
            request("DonateCourse", "knowledgeTreeChild", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 赠课列表知识树二级节点下数据
         *userId	是	string	用户ID
         *fatherId	是	int	知识树节点ID
         **/
        donateCourseSecond: function (params, callBackFunc) {
            request("DonateCourse", "donateCourseSecond", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /** 赠课列表知识树三级节点下数据
         *userId	是	string	用户ID
         *fatherId	是	int	知识树节点ID
         **/
        donateCourseThird: function (params, callBackFunc) {
            request("DonateCourse", "donateCourseThird", params, function (data) {
                callBackFunc && callBackFunc(data);
            });
        }

    }
});

/**
 * 获取用户信息
 * user.js
 */
define("user", function(require, exports, module) {
    module.exports = {
        /**
         *获取直播列表
         *userId	是	string	用户id
         *token	是	string	token
         */
        getUserInfo: function (userId, callBackFun){
            request("User", "getUserInfo", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取直播列表
         *userId 是 数据类型为 string  用户id
         *wxAccountId 是	数据类型为 int 公众账号ID (新东方绘本课堂：11，新东方绘本馆：12)
         */
        checkUserSubscribe: function (param, callBackFun){
            request("PersonalCenter", "checkUserSubscribe", {
                userId: param.userId,
                wxAccountId: param.wxAccountId
            }, function(data) {
                callBackFun(data);
            });
        }
    }
});

/**
 * 获取 优惠券 数据
 * coupon.js
 */
define("V2BookStore", function(require, exports, module) {
    module.exports = {
        /**
         *查看商品详情页优惠券
         *userId 是 数据类型为 string  用户id
         *token  是 数据类型为 string
         *query	 否 数据类型为 string	 关键字
         *tagId	 否 数据类型为 number	 搜索竖标签ID
         *page	 是 数据类型为 string	 分页
         *size   是 数据类型为 string	 分页
         * vTagId: 横标签 vTagId,
         * hTagId: 竖标签 hTagId,
         */
        getCourseGoodCenter: function (param, callBackFunc) {
            request("V2BookStore", "getCourseGoodCenter", {
                userId: param.userId,
                query: param.query,
                tagId: param.tagId,
                vTagId: param.vTagId,
                hTagId: param.hTagId,
                page: param.page,
                size: param.size

            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        /**
         *查看商品详情页优惠券
         *userId 是 数据类型为 string  用户id
         *token  是 数据类型为 string
         *query	 否 数据类型为 string	 关键字
         */
        getVerticalTags: function (param, callBackFunc) {
            request("V2BookStore", "getVerticalTags", {
                userId: param.userId,
                query: param.query

            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        get:function (param, callBackFunc) {
            request("V2BookStore", "get", {
                userId: param.userId,
                size: param.size,
                page: param.page,
                cudId: param.cudId
            }, function (data) {
                callBackFunc && callBackFunc(data);
            });
        },
        getCouponSupplierGoods:function(param,callBackFunc){
            request("V2BookStore","getCouponSupplierGoods",{
                couponId:param.couponId,
                page:param.page,
                size:param.size
            },function(data){
                callBackFunc && callBackFunc(data);
            })
        },
        getGoodsClassInfo:function(param,callBackFunc){
            request("V2BookStore","getGoodsClassInfo",{
                tagId:param.tagId
            },function(data){
                callBackFunc && callBackFunc(data);
            })
        }
    }
});

/**
 * 新版直播
 * v2Live.js
 */
define("v2Live", function(require, exports, module) {
    module.exports = {
        /**
         *获取直播列表
         *userId	是	string	用户id
         *token	是	string	token
         *startTime	是	string	开始时间 20170301
         *endTime	是	string	结束时间 格式 20170311
         */
        getUserClassByTime: function (userId,startTime,endTime,callBackFun){
            request("V2Live", "getUserClassByTime", {
                userId: userId,
                startTime: startTime,
                endTime:endTime
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取直播间信息（自定义直播间）
         *userId	是	string	用户id
         *token	是	string	token
         *startTime	是	string	开始时间 20170301
         *endTime	是	string	结束时间 格式 20170311
         */
        getLiveClassInfo: function (userId,classId,callBackFun){
            request("V2Live", "getLiveClassInfo", {
                userId: userId,
                classId: classId,
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取直播间地址
         *userId	是	string	用户ID
         *token	是	string	token
         *classId	否	int	课时ID
         */
        getLiveClassUrl: function (userId,classId,callBackFun){
            request("V2Live", "getLiveClassUrl", {
                userId: userId,
                classId: classId,
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取上一节或下一节课
         *userId	是	string	用户id
         *token	是	string	token
         */
        getNextOrPreClass: function (userId,callBackFun){
            request("V2Live", "getNextOrPreClass", {
                userId: userId,
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *公开课商城推荐
         */
        getPublicClassMallCommendList: function (callBackFun){
            request("V2Live", "getPublicClassMallCommendList", {
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取公开课分类
         */
        getPublicClassType: function (callBackFun){
            request("V2Live", "getPublicClassType", {
            }, function(data) {
                callBackFun(data);
            });
        },

        /**
         *获取公开课列表
         * userId	是	string	用户ID
         *queryType	否	string	0 直播 1 精彩回放； 默认 0
         *publicClassType	否	string	当queryType=1时需输入； 默认0
         *page	是	int	分页
         *size	是	int	分页
         */
        getPublicClassList: function (userId,queryType,publicClassType,page,size,callBackFun){
            request("V2Live", "getPublicClassList", {
                userId:userId,
                queryType:queryType,
                publicClassType:publicClassType,
                page:page,
                size:size
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取公开课推荐列表
         *userId	是	string	用户id
         *token	是	string	token
         */
        getUserPublicClassList: function (userId,callBackFun){
            request("V2Live", "getUserPublicClassList", {
                userId: userId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取公开课详细信息
         *userId	是	string	用户id
         *classId	是	string	课时ID
         *token	是	string	token
         */
        getPublicClassInfo: function (userId,classId,callBackFun){
            request("V2Live", "getPublicClassInfo", {
                userId: userId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *判断用户是否报名公开课
         *userId	是	string	用户id
         *classId	是	string	课时ID
         *token	是	string	token
         */
        checkPublicClassEnroll: function (userId,classId,callBackFun){
            request("V2Live", "checkPublicClassEnroll", {
                userId: userId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *公开课详情页推荐
         *userId	是	string	用户id
         *classId	是	string	课时ID
         */
        getPublicClassCommendList: function (userId,classId,callBackFun){
            request("V2Live", "getPublicClassCommendList", {
                userId: userId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *用户直播学习记录统计
         *userId	是	string	用户名
         *token	是	string	密码
         *classId	是	int	音频ID
         *timestamp	是	int	时间戳（毫秒）
         *terminal	是	string	终端 wx pc
         *watchType	是	string	观看类型 1 直播 2 回放
         *network	是	string	网络环境
         *studyRecordId	是	string	学习记录ID 不为空且不为0的时候 更新用户学习记录
         */
        studyRecord: function (userId,classId,timestamp,terminal,watchType,network,studyRecordId,callBackFun){
            request("V2Live", "studyRecord", {
                userId: userId,
                classId:classId,
                timestamp:timestamp,
                terminal:terminal,
                watchType:watchType,
                network:network,
                studyRecordId:studyRecordId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *报名公开课
         *userId	是	string	用户id
         *classId	是	string	课时ID
         */
        enrollPublicClass: function (userId,classId,callBackFun){
            request("V2Live", "enrollPublicClass", {
                userId: userId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取班级详细
         *userId	是	string	用户id
         *gradeId	是	string	班级ID
         */
        getGradeInfo: function (userId,gradeId,callBackFun){
            request("V2Live", "getGradeInfo", {
                userId: userId,
                gradeId:gradeId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取班级课表
         *userId	是	string	用户id
         *gradeId	是	string	班级ID
         *queryType	否	string	1 已完成 2 未完成
         *keywork	否	string	搜索关键字
         *size
         *page
         */
        getGradeClass: function (userId,gradeId,queryType,keyword,size,page,callBackFun){
            request("V2Live", "getGradeClass", {
                userId: userId,
                gradeId:gradeId,
                queryType:queryType,
                keyword:keyword,
                size:size,
                page:page
            }, function(data) {
                callBackFun(data);
            });
        },

        /**
         *获取课程信息
         *userId	是	string	用户id
         *gradeId	是	string	班级ID
         *classId	是	int	课程ID
         */
        getClassInfo: function (userId,gradeId,classId,callBackFun){
            request("V2Live", "getClassInfo", {
                userId: userId,
                gradeId:gradeId,
                classId:classId
            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取Pc公开课右边公开课类型
         */
        getPublicClassTypeWithPCLive: function (callBackFun){
            request("V2Live", "getPublicClassTypeWithPCLive", {

            }, function(data) {
                callBackFun(data);
            });
        },
        /**
         *获取PC公开课首页直播信息
         *userId	是	string	用户id
         *publicClassType	是	string	公开课类型ID
         */
        getPublicLiveClassInfo: function (pream,callBackFun){
            request("V2Live", "getPublicLiveClassInfo", pream, function(data) {
                callBackFun(data);
            });
        },
    }
});