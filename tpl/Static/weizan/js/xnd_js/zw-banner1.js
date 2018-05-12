define(function(){
    var $=jQuery;

    function zw_banner1(aEl,aOption){
        this.el = aEl;//元素
        this.option = {
            time:3000,
            fade_time:1000
        }
        $.extend(this.option,aOption);
        this.init();
    }

    zw_banner1.prototype = {
        timer:null,
        $li:null,
        $current:null,
        $next:null,
        init:function(){//初始化
            this.$li = this.el.find('.zw-module-banner1-imglist li');
            this.set_order();
            this.bindEvent();
        },
        set_order:function(){
            this.$current = this.$li.filter('.active');
            if(this.$current.index() == this.$li.length-1){
                this.$next = this.$li.eq(0);
            }else{
                this.$next = this.$current.next();
            }
        },
        bindEvent:function(){
            var that = this;
            this.timer = window.setInterval(function(){
                that.effect.call(that);
            },this.option.time) 
        },
        effect:function(){
            var that = this;
            that.$current.fadeOut(this.option.fade_time)
            this.$next.fadeIn(this.option.fade_time,function(){
                that.$current.removeClass('active');
                that.$next.addClass('active');
                that.set_order();
            });
        }
    }


    jQuery.fn.extend({
        zw_banner1:function(aOption,aPram1,aPram2){
            if(typeof aOption === 'object' || typeof aOption === 'undefined'){
                this.each(function(i){
                    var $this = $(this);
                    if(!this.__zw_banner1__){
                        this.__zw_banner1__ = new zw_banner1($this,aOption);
                    }
                });
            }
            //else if(typeof aOption === 'string'){
                // var funs = ['setOffsetAngle','getOriAngle','getAngle'];
                // var returnPram;
                // if( funs.indexOf(aOption) != -1 ){
                //     this.each(function(i){
                //         returnPram = this.__discRotate__[aOption](aPram1,aPram2);
                //     });
                // }
                // return returnPram;
            //}
        }
    })
})