/**
 * 名称: imgScrollBlock
 * 版本: 1.0
 * 作者: wangjun
 * Copyright © 2012 wangjun
 * 制作日期: 2012-08-02
 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 
 * 使用说明：
 * 使用imgScrollBlock插件，可以做图片上下或者左右的前滚动和后滚动的自动滚动和按钮滚动，支持几个图片一起滚动，具体参数如下：
 *  topScroll:false,  //定义是否是上下滚动，布尔类型，默认值是false
 *  leftScroll:true,  //定义是否是左右滚动，布尔类型，默认值是true
 *  preScrollBtn:undefined,  //定义前滚按钮，默认值是undefined（无定义），定以后是jquery的选择器（对象类型）
 *  nextScrollBtn:undefined, //定义后滚按钮，默认值是undefined（无定义），定以后是jquery的选择器（对象类型）
 *  childrenSel:1,    //定义滚动div的个数，默认值是1，数字类型，支持多个
 *  movePX:100,       //定义滚动的像素值，默认值是100像素，数字类型
 *  scrollTime:3000,  //定义滚动的事件间隔(毫秒)，默认值是3000毫秒，数字类型
 *  fatherDIV:undefined   //定义鼠标移入后暂停的DIV，默认值是undefined（无定义），定以后是jquery的选择器（对象类型）
 **/
 (function ($) {
    $.fn.extend({
        imgScrollBlock: function (options) {
            'use strict';//启用严格模式
            //var container = this,
            // var self = this,
            //@默认参数
            var defaults = {
                    topScroll:false,   //定义是否是上下滚动
                    leftScroll:true,   //定义是否是左右滚动
                    preScrollBtn:null,//定义前滚按钮
                    nextScrollBtn:null,//定义后滚按钮
                    prevCallback:function(){},//定义前滚按钮回调函数
                    nextCallback:function(){},//定义后滚按钮回调函数
                    childrenSel:1,    //定义滚动div的个数
                    showControlDot:true,//定义是否有下端滚动控制球
                    dotText:false,  //定义是否有滚动控制球的text
                    defaultStart:true,
                    scrollTime:5000//自动轮换时间
            },

            opts = $.extend(defaults, options),
            
            //@public 变量
            topScroll = opts.topScroll,
            leftScroll = opts.leftScroll,
            childrenSel = opts.childrenSel,
            showControlDot = opts.showControlDot,
            dotText = opts.dotText,
            defaultStart = opts.defaultStart,
            scrollTime = opts.scrollTime;
                
            //@private 方法，滚动函数
            function imgscroll(aNum,div,tuwen_scroll,callback){
                var Num = Math.abs(aNum);
                if(aNum < 0){
                    if(topScroll){
                        var childrens = div.children(":lt("+ (tuwen_scroll.childrenSel*Num) +")");
                        //childrens.fadeOut("slow");//渐隐
                        div.animate({top:"-"+(tuwen_scroll.movePX*Num)+"px"}, "slow",function(){
                            childrens.appendTo(div);
                            //childrens.show();
                            div.css("top",0);
                            if($.isFunction(callback)){
                                callback();
                            }
                        });
                    }else if(leftScroll){
                        var childrens = div.children(":lt("+ tuwen_scroll.childrenSel*Num +")");
                        //childrens.fadeOut("slow");//渐隐
                        div.animate({left:"-"+tuwen_scroll.movePX*Num+"px"}, "slow",function(){
                            childrens.appendTo(div);
                            //childrens.show();
                            div.css("left",0);
                            if($.isFunction(callback)){
                                callback();
                            }
                        });
                    }
                }else{
                    if(topScroll){
                        div.css("top","-"+(tuwen_scroll.movePX*Num)+"px");
                        var moNum = tuwen_scroll.child_num - tuwen_scroll.childrenSel*Num-1;
                        div.children(":gt("+ moNum +")").prependTo(div);
                        var fadedom = div.children(":lt("+ tuwen_scroll.childrenSel*Num+1 +"):not(:eq(0))");
                        //fadedom.fadeOut("slow");//渐隐
                        div.animate({top: "0"}, "slow",function(){
                            //fadedom.show();
                            if($.isFunction(callback)){
                                callback();
                            }
                        });
                    }else if(leftScroll){
                        div.css("left","-"+(tuwen_scroll.movePX*Num)+"px");
                        var moNum = tuwen_scroll.child_num - tuwen_scroll.childrenSel*Num-1;
                        div.children(":gt("+ moNum +")").prependTo(div);
                        var fadedom = div.children(":lt("+ tuwen_scroll.childrenSel*Num+1 +"):not(:eq(0))");
                        //fadedom.fadeOut("slow");//渐隐
                        div.animate({left: "0"}, "slow",function(){
                            //fadedom.show();
                            if($.isFunction(callback)){
                                callback();
                            }
                        });
                    }
                }
            }

            //@private 方法，点击轮换滚动球执行滚动
            function clickDotScroll(div,tuwen_scroll,currpage,gotoPage,callback){
                var num = parseInt(currpage)-parseInt(gotoPage);
                //var movePxl = div.find('.tuwen[data-page="'+gotoPage+'"]:first').position().left;
                
                if(div.is(":animated") == false){
                     imgscroll(num,div,tuwen_scroll,callback);
                }  
            };
            
            //@private 方法，轮换滚动球
            function showDot(dotdom,dom){
                if(dotdom && dotdom.length>0){
                    var cPage = dom.find("li:first").attr("data-page"),
                        $dot = dotdom.find(".lunhuanBtn-cell-dot");
                    $dot.removeClass("active").eq(parseInt(cPage)-1).addClass("active");
                }
            };

            function set_tuwen_scroll(tuwen_scroll,thisDiv){
                var fatherWidth = thisDiv.parent().width(),//父层级的总宽度
                    fatherHeight = thisDiv.parent().height();//父层级的总高度
                    
                thisDiv.children().width(fatherWidth);
                thisDiv.children().height(fatherHeight);

                var childrenWidth = thisDiv.children().eq(0).outerWidth(true),//每个轮换快的总宽度
                childrenHeight = thisDiv.children().eq(0).outerHeight(true);//每个轮换快的总高度


                tuwen_scroll.child_num = thisDiv.children().length;//取得所有滚动快的个数
                tuwen_scroll.childrenSel = childrenSel;
                tuwen_scroll.showControlDot = showControlDot;
                tuwen_scroll.dotText = dotText;


                if(topScroll){
                    tuwen_scroll.numInFather = Math.round(fatherHeight/childrenHeight);//获取轮换一屏所需要的轮换块的个数
                    tuwen_scroll.singleMovePX = childrenHeight;
                }else if(leftScroll){
                    tuwen_scroll.numInFather = Math.round(fatherWidth/childrenWidth);//获取轮换一屏所需要的轮换块的个数
                    tuwen_scroll.singleMovePX = childrenWidth;
                }
                //设置只有轮换块的个数大于等于一屏所需的轮换个数+一次轮换所需的个数才能轮换，否则只能以每次一个轮换块进行轮换
                if(tuwen_scroll.child_num <= tuwen_scroll.numInFather){
                    tuwen_scroll.canScroll = false;
                    tuwen_scroll.showControlDot = false;
                    tuwen_scroll.childrenSel = 0;
                    return false;
                }else if(tuwen_scroll.numInFather < tuwen_scroll.child_num && tuwen_scroll.child_num < tuwen_scroll.numInFather*2){
                    tuwen_scroll.canScroll = true;
                    tuwen_scroll.showControlDot = false;
                    if(tuwen_scroll.childrenSel <= tuwen_scroll.numInFather){
                        if((tuwen_scroll.childrenSel+tuwen_scroll.numInFather) > tuwen_scroll.child_num){
                            tuwen_scroll.childrenSel = tuwen_scroll.child_num - tuwen_scroll.numInFather;
                        }
                    }else{
                        tuwen_scroll.childrenSel = tuwen_scroll.child_num - tuwen_scroll.numInFather;
                    }
                }else if(tuwen_scroll.child_num >= tuwen_scroll.numInFather*2){
                    if(tuwen_scroll.childrenSel <= tuwen_scroll.numInFather){
                        tuwen_scroll.canScroll = true;
                    }else{
                        tuwen_scroll.canScroll = true;
                        tuwen_scroll.childrenSel = tuwen_scroll.numInFather;
                    }
                }
                tuwen_scroll.movePX = tuwen_scroll.singleMovePX*tuwen_scroll.childrenSel;//总体移动的像素
                
                //设置滚动快的长度
                if(topScroll){
                    thisDiv.height(tuwen_scroll.singleMovePX*tuwen_scroll.child_num+10);
                }
                if(leftScroll){
                    thisDiv.width(tuwen_scroll.singleMovePX*tuwen_scroll.child_num+10);
                }
            }

            function set_children(thisDiv){
                return thisDiv.children();
            }

            function set_timer(thisDiv,tuwen_scroll,callback){
                tuwen_scroll.timer = window.setInterval(function(){
                    if(thisDiv.attr('data-canSlide') == 'true'){
                        if(thisDiv.is(":animated") == false){
                            imgscroll(-1,thisDiv,tuwen_scroll,function(){
                                if($.isFunction(callback)){
                                    callback();
                                }
                            });
                        }
                    }
                },scrollTime);
            }

            //@代码主要功能
            return this.each(function(){
                var thisDiv = $(this),
                    tuwen_scroll = {},
                    preScrollBtn = opts.preScrollBtn||thisDiv.prev(),
                    nextScrollBtn = opts.nextScrollBtn||thisDiv.next(),
                    currPage = 1,
                    $children = set_children(thisDiv);

                thisDiv.attr('data-canSlide',opts.defaultStart);
                set_tuwen_scroll(tuwen_scroll,thisDiv);//设置tuwen_scroll参数
                

                //判断是否有下端滚动球，有则添加
                if(tuwen_scroll.showControlDot){
                    if(tuwen_scroll.canScroll){
                        var totalPage = Math.ceil(tuwen_scroll.child_num/tuwen_scroll.childrenSel);
                        var dotdom = $('<div class="lunhuanBtn-wrap"><ul class="lunhuanBtn clearfix"></ul></div>');
                        //设置滚动div属于哪页
                        thisDiv.children().each(function(i){
                            var n = Math.ceil((i+1)/tuwen_scroll.childrenSel);
                            $(this).attr("data-page",n);
                        });
                        //创建滚动球
                        for(var i=0;i<totalPage;i++){
                            var html = "";
                            if(i==0){
                                html = '<li class="lunhuanBtn-cell"><a class="lunhuanBtn-cell-dot active" data-page="'+(i+1)+'" href="javascript:void(0);">'+(tuwen_scroll.dotText?(i+1):'')+'</a></li>';
                            }else{
                                html = '<li class="lunhuanBtn-cell"><a class="lunhuanBtn-cell-dot" data-page="'+(i+1)+'" href="javascript:void(0);">'+(tuwen_scroll.dotText?(i+1):'')+'</a></li>';
                            }
                            dotdom.find('.lunhuanBtn').append(html);
                        }       
                        thisDiv.parent().append(dotdom);

                        dotdom.find("li a").on("click",function(){
                            if(thisDiv.is(":animated") == false){
                                if(!$(this).hasClass("active")){
                                    var page = $(this).attr("data-page");
                                    clickDotScroll(thisDiv,tuwen_scroll,currPage,page);
                                    dotdom.find("li a").removeClass("active");
                                    $(this).addClass("active");
                                    currPage = page;
                                }
                            }
                            // return false;
                        });
                    }else{
                        var dotdom = null;
                    }
                }

                $(window).on('resize',function(){
                    thisDiv.stop().dequeue();
                    window.clearInterval(tuwen_scroll.timer);
                    set_tuwen_scroll(tuwen_scroll,thisDiv);//设置tuwen_scroll参数

                    // 设滚动定时器
                    set_timer(thisDiv,tuwen_scroll,function(){
                        if(tuwen_scroll.showControlDot){
                            showDot(dotdom,thisDiv);
                        }
                        currPage = thisDiv.find(":first").attr("data-page");
                    })
                })

                
                // 设滚动定时器
                set_timer(thisDiv,tuwen_scroll,function(){
                    if(tuwen_scroll.showControlDot){
                        showDot(dotdom,thisDiv);
                    }
                    currPage = thisDiv.find(":first").attr("data-page");
                })

                
                
                //鼠标移动父层级上终止滚动，离开后重新滚动
                if(thisDiv.parent().length > 0){
                    thisDiv.parent().hover(function(){
                        clearInterval(tuwen_scroll.timer);
                    },function(){
                        set_timer(thisDiv,tuwen_scroll,function(){
                            if(tuwen_scroll.showControlDot){
                                showDot(dotdom,thisDiv);
                            }
                            currPage = thisDiv.find(":first").attr("data-page");
                        })
                    })
                }

                //前滚按钮按下向前滚
                if(preScrollBtn){
                    preScrollBtn.on('click',function(){
                        var $this = $(this);
                        if(tuwen_scroll.canScroll){
                            //当前非动画状态下执行
                            if(thisDiv.is(":animated") == false){
                                imgscroll(1,thisDiv,tuwen_scroll,function(){
                                    if(tuwen_scroll.showControlDot){
                                        showDot(dotdom,thisDiv);
                                    }
                                    currPage = thisDiv.find(":first").attr("data-page");
                                    if($.isFunction(opts.prevCallback)){
                                        opts.prevCallback($this);
                                    }
                                });
                            }
                            // return false;
                        }
                    })
                    
                }
                
                //后滚按钮按下向后滚
                if(nextScrollBtn){
                    nextScrollBtn.on('click',function(){
                        var $this = $(this);
                        if(tuwen_scroll.canScroll){
                            //当前非动画状态下执行
                            if(thisDiv.is(":animated") == false){
                                imgscroll(-1,thisDiv,tuwen_scroll,function(){
                                    if(tuwen_scroll.showControlDot){
                                        showDot(dotdom,thisDiv);
                                    }
                                    currPage = thisDiv.find(":first").attr("data-page");
                                    if($.isFunction(opts.nextCallback)){
                                        opts.nextCallback($this);
                                    }
                                });
                            }
                            // return false;
                        }
                    })
                }
            });
        }
    });
 })(jQuery);