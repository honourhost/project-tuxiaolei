webpackJsonp([0],{"3Q4o":function(t,i,e){"use strict";function s(t,i){return new RegExp("(^|\\s)"+i+"(\\s|$)").test(t.className)}i.a=function(t,i){if(!s(t,i)){var e=t.className.split(" ");e.push(i),t.className=e.join(" ")}},i.d=function(t,i){if(s(t,i)){var e=new RegExp("(^|\\s)"+i+"(\\s|$)","g");t.className=t.className.replace(e," ")}},i.b=function(t,i,e){return e?t.setAttribute("data-"+i,e):t.getAttribute("data-"+i)},i.c=function(t){if(t instanceof window.SVGElement){var i=t.getBoundingClientRect();return{top:i.top,left:i.left,width:i.width,height:i.height}}return{top:t.offsetTop,left:t.offsetLeft,width:t.offsetWidth,height:t.offsetHeight}}},GQaK:function(t,i,e){"use strict";function s(){return window.performance&&window.performance.now?window.performance.now()+window.performance.timing.navigationStart:+new Date}function o(t){for(var i=arguments.length,e=Array(i>1?i-1:0),s=1;s<i;s++)e[s-1]=arguments[s];for(var o=0;o<e.length;o++){var n=e[o];for(var r in n)t[r]=n[r]}return t}function n(t){return!1!==T&&("standard"===T?"transitionEnd"===t?"transitionend":t:T+t.charAt(0).toUpperCase()+t.substr(1))}function r(t,i,e,s){t.addEventListener(i,e,{passive:!1,capture:!!s})}function h(t,i,e,s){t.removeEventListener(i,e,{passive:!1,capture:!!s})}function l(t){for(var i=0,e=0;t;)i-=t.offsetLeft,e-=t.offsetTop,t=t.offsetParent;return{left:i,top:e}}function a(t){if(t instanceof window.SVGElement){var i=t.getBoundingClientRect();return{top:i.top,left:i.left,width:i.width,height:i.height}}return{top:t.offsetTop,left:t.offsetLeft,width:t.offsetWidth,height:t.offsetHeight}}function c(t,i){for(var e in i)if(i[e].test(t[e]))return!0;return!1}function p(t,i){t.removeChild(i)}function u(t,i,e,s,o,n){var r=t-i,h=Math.abs(r)/e,l=n.deceleration,a=n.itemHeight,c=n.swipeBounceTime,p=n.wheel,u=n.swipeTime,d=p?4:15,f=t+h/l*(r<0?-1:1);return p&&a&&(f=Math.round(f/a)*a),f<s?(f=o?s-o/d*h:s,u=c):f>0&&(f=o?o/d*h:0,u=c),{destination:Math.round(f),duration:u}}function d(t){console.error("[BScroll warn]: "+t)}function f(t){var i=document.createElement("div"),e=document.createElement("div");return i.style.cssText="position:absolute;z-index:9999;pointerEvents:none",e.style.cssText="box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px;",e.className="bscroll-indicator","horizontal"===t?(i.style.cssText+=";height:7px;left:2px;right:2px;bottom:0",e.style.height="100%",i.className="bscroll-horizontal-scrollbar"):(i.style.cssText+=";width:7px;bottom:2px;top:2px;right:1px",e.style.width="100%",i.className="bscroll-vertical-scrollbar"),i.style.cssText+=";overflow:hidden",i.appendChild(e),i}function m(t,i){this.wrapper=i.el,this.wrapperStyle=this.wrapper.style,this.indicator=this.wrapper.children[0],this.indicatorStyle=this.indicator.style,this.scroller=t,this.direction=i.direction,i.fade?(this.visible=0,this.wrapperStyle.opacity="0"):this.visible=1}function g(t,i){this.wrapper="string"==typeof t?document.querySelector(t):t,this.wrapper||d("can not resolve the wrapper dom"),this.scroller=this.wrapper.children[0],this.scroller||d("the wrapper need at least one child element to be scroller"),this.scrollerStyle=this.scroller.style,this._init(t,i)}var v=function(){return function(t,i){if(Array.isArray(t))return t;if(Symbol.iterator in Object(t))return function(t,i){var e=[],s=!0,o=!1,n=void 0;try{for(var r,h=t[Symbol.iterator]();!(s=(r=h.next()).done)&&(e.push(r.value),!i||e.length!==i);s=!0);}catch(t){o=!0,n=t}finally{try{!s&&h.return&&h.return()}finally{if(o)throw n}}return e}(t,i);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),y=function(t){if(Array.isArray(t)){for(var i=0,e=Array(t.length);i<t.length;i++)e[i]=t[i];return e}return Array.from(t)},w=navigator.userAgent,x=/wechatdevtools/.test(w),b=document.createElement("div").style,T=function(){var t={webkit:"webkitTransform",Moz:"MozTransform",O:"OTransform",ms:"msTransform",standard:"transform"};for(var i in t)if(void 0!==b[t[i]])return i;return!1}(),A=n("transform"),S=n("perspective")in b,P="ontouchstart"in window||x,D=!1!==A,_=n("transition")in b,E={transform:A,transitionTimingFunction:n("transitionTimingFunction"),transitionDuration:n("transitionDuration"),transitionProperty:n("transitionProperty"),transitionDelay:n("transitionDelay"),transformOrigin:n("transformOrigin"),transitionEnd:n("transitionEnd")},Y=1,B={touchstart:Y,touchmove:Y,touchend:Y,mousedown:2,mousemove:2,mouseup:2},C={startX:0,startY:0,scrollX:!1,scrollY:!0,freeScroll:!1,directionLockThreshold:5,eventPassthrough:"",click:!1,tap:!1,bounce:!0,bounceTime:700,momentum:!0,momentumLimitTime:300,momentumLimitDistance:15,swipeTime:2500,swipeBounceTime:500,deceleration:.001,flickLimitTime:200,flickLimitDistance:100,resizePolling:60,probeType:0,preventDefault:!0,preventDefaultException:{tagName:/^(INPUT|TEXTAREA|BUTTON|SELECT)$/},HWCompositing:!0,useTransition:!0,useTransform:!0,bindToWrapper:!1,disableMouse:P,disableTouch:!P,observeDOM:!0,wheel:!1,snap:!1,scrollbar:!1,pullDownRefresh:!1,pullUpLoad:!1},M={swipe:{style:"cubic-bezier(0.23, 1, 0.32, 1)",fn:function(t){return 1+--t*t*t*t*t}},swipeBounce:{style:"cubic-bezier(0.25, 0.46, 0.45, 0.94)",fn:function(t){return t*(2-t)}},bounce:{style:"cubic-bezier(0.165, 0.84, 0.44, 1)",fn:function(t){return 1- --t*t*t*t}}},X=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||function(t){return window.setTimeout(t,(t.interval||100/60)/2)},k=window.cancelAnimationFrame||window.webkitCancelAnimationFrame||window.mozCancelAnimationFrame||window.oCancelAnimationFrame||function(t){window.clearTimeout(t)},L=1,U=-1,H=1,W=-1;m.prototype.refresh=function(){this.transitionTime(),this._calculate(),this.updatePosition()},m.prototype.fade=function(t,i){var e=this;if(!i||this.visible){var s=t?250:500;t=t?"1":"0",this.wrapperStyle[E.transitionDuration]=s+"ms",clearTimeout(this.fadeTimeout),this.fadeTimeout=setTimeout(function(){e.wrapperStyle.opacity=t,e.visible=+t},0)}},m.prototype.updatePosition=function(){if("vertical"===this.direction){var t=Math.round(this.sizeRatioY*this.scroller.y);if(t<0){this.transitionTime(500);var i=Math.max(this.indicatorHeight+3*t,8);this.indicatorStyle.height=i+"px",t=0}else if(t>this.maxPosY){this.transitionTime(500);var e=Math.max(this.indicatorHeight-3*(t-this.maxPosY),8);this.indicatorStyle.height=e+"px",t=this.maxPosY+this.indicatorHeight-e}else this.indicatorStyle.height=this.indicatorHeight+"px";this.y=t,this.scroller.options.useTransform?this.indicatorStyle[E.transform]="translateY("+t+"px)"+this.scroller.translateZ:this.indicatorStyle.top=t+"px"}else{var s=Math.round(this.sizeRatioX*this.scroller.x);if(s<0){this.transitionTime(500);var o=Math.max(this.indicatorWidth+3*s,8);this.indicatorStyle.width=o+"px",s=0}else if(s>this.maxPosX){this.transitionTime(500);var n=Math.max(this.indicatorWidth-3*(s-this.maxPosX),8);this.indicatorStyle.width=n+"px",s=this.maxPosX+this.indicatorWidth-n}else this.indicatorStyle.width=this.indicatorWidth+"px";this.x=s,this.scroller.options.useTransform?this.indicatorStyle[E.transform]="translateX("+s+"px)"+this.scroller.translateZ:this.indicatorStyle.left=s+"px"}},m.prototype.transitionTime=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;this.indicatorStyle[E.transitionDuration]=t+"ms"},m.prototype.transitionTimingFunction=function(t){this.indicatorStyle[E.transitionTimingFunction]=t},m.prototype.remove=function(){this.wrapper.parentNode.removeChild(this.wrapper)},m.prototype._calculate=function(){if("vertical"===this.direction){var t=this.wrapper.clientHeight;this.indicatorHeight=Math.max(Math.round(t*t/(this.scroller.scrollerHeight||t||1)),8),this.indicatorStyle.height=this.indicatorHeight+"px",this.maxPosY=t-this.indicatorHeight,this.sizeRatioY=this.maxPosY/this.scroller.maxScrollY}else{var i=this.wrapper.clientWidth;this.indicatorWidth=Math.max(Math.round(i*i/(this.scroller.scrollerWidth||i||1)),8),this.indicatorStyle.width=this.indicatorWidth+"px",this.maxPosX=i-this.indicatorWidth,this.sizeRatioX=this.maxPosX/this.scroller.maxScrollX}},function(t){t.prototype._init=function(t,i){this._handleOptions(i),this._events={},this.x=0,this.y=0,this.directionX=0,this.directionY=0,this._addDOMEvents(),this._initExtFeatures(),this._watchTransition(),this.options.observeDOM&&this._initDOMObserver(),this.refresh(),this.options.snap||this.scrollTo(this.options.startX,this.options.startY),this.enable()},t.prototype._handleOptions=function(t){this.options=o({},C,t),this.translateZ=this.options.HWCompositing&&S?" translateZ(0)":"",this.options.useTransition=this.options.useTransition&&_,this.options.useTransform=this.options.useTransform&&D,this.options.preventDefault=!this.options.eventPassthrough&&this.options.preventDefault,this.options.scrollX="horizontal"!==this.options.eventPassthrough&&this.options.scrollX,this.options.scrollY="vertical"!==this.options.eventPassthrough&&this.options.scrollY,this.options.freeScroll=this.options.freeScroll&&!this.options.eventPassthrough,this.options.directionLockThreshold=this.options.eventPassthrough?0:this.options.directionLockThreshold,!0===this.options.tap&&(this.options.tap="tap")},t.prototype._addDOMEvents=function(){var t=r;this._handleDOMEvents(t)},t.prototype._removeDOMEvents=function(){var t=h;this._handleDOMEvents(t)},t.prototype._handleDOMEvents=function(t){var i=this.options.bindToWrapper?this.wrapper:window;t(window,"orientationchange",this),t(window,"resize",this),this.options.click&&t(this.wrapper,"click",this,!0),this.options.disableMouse||(t(this.wrapper,"mousedown",this),t(i,"mousemove",this),t(i,"mousecancel",this),t(i,"mouseup",this)),P&&!this.options.disableTouch&&(t(this.wrapper,"touchstart",this),t(i,"touchmove",this),t(i,"touchcancel",this),t(i,"touchend",this)),t(this.scroller,E.transitionEnd,this)},t.prototype._initExtFeatures=function(){this.options.snap&&this._initSnap(),this.options.scrollbar&&this._initScrollbar(),this.options.pullUpLoad&&this._initPullUp(),this.options.pullDownRefresh&&this._initPullDown(),this.options.wheel&&this._initWheel()},t.prototype._watchTransition=function(){if("function"==typeof Object.defineProperty){var t=this,i=!1;Object.defineProperty(this,"isInTransition",{get:function(){return i},set:function(e){i=e;for(var s=t.scroller.children.length?t.scroller.children:[t.scroller],o=i&&!t.pulling?"none":"auto",n=0;n<s.length;n++)s[n].style.pointerEvents=o}})}},t.prototype._initDOMObserver=function(){var t=this;if("undefined"!=typeof MutationObserver){var i=void 0,e=new MutationObserver(function(e){if(!t._shouldNotRefresh()){for(var s=!1,o=!1,n=0;n<e.length;n++){var r=e[n];if("attributes"!==r.type){s=!0;break}if(r.target!==t.scroller){o=!0;break}}s?t.refresh():o&&(clearTimeout(i),i=setTimeout(function(){t._shouldNotRefresh()||t.refresh()},60))}}),s={attributes:!0,childList:!0,subtree:!0};e.observe(this.scroller,s),this.on("destroy",function(){e.disconnect()})}else this._checkDOMUpdate()},t.prototype._shouldNotRefresh=function(){var t=this.x>0||this.x<this.maxScrollX||this.y>0||this.y<this.maxScrollY;return this.isInTransition||this.stopFromTransition||t},t.prototype._checkDOMUpdate=function(){function t(){var o=this;setTimeout(function(){(function(){if(!this.destroyed){var o=(i=a(this.scroller)).width,n=i.height;e===o&&s===n||this.refresh(),e=o,s=n,t.call(this)}}).call(o)},1e3)}var i=a(this.scroller),e=i.width,s=i.height;t.call(this)},t.prototype.handleEvent=function(t){switch(t.type){case"touchstart":case"mousedown":this._start(t);break;case"touchmove":case"mousemove":this._move(t);break;case"touchend":case"mouseup":case"touchcancel":case"mousecancel":this._end(t);break;case"orientationchange":case"resize":this._resize();break;case"transitionend":case"webkitTransitionEnd":case"oTransitionEnd":case"MSTransitionEnd":this._transitionEnd(t);break;case"click":this.enabled&&!t._constructed&&(c(t.target,this.options.preventDefaultException)||(t.preventDefault(),t.stopPropagation()))}},t.prototype.refresh=function(){var t=a(this.wrapper);this.wrapperWidth=t.width,this.wrapperHeight=t.height;var i=a(this.scroller);this.scrollerWidth=i.width,this.scrollerHeight=i.height;var e=this.options.wheel;e?(this.items=this.scroller.children,this.options.itemHeight=this.itemHeight=this.items.length?this.scrollerHeight/this.items.length:0,void 0===this.selectedIndex&&(this.selectedIndex=e.selectedIndex||0),this.options.startY=-this.selectedIndex*this.itemHeight,this.maxScrollX=0,this.maxScrollY=-this.itemHeight*(this.items.length-1)):(this.maxScrollX=this.wrapperWidth-this.scrollerWidth,this.maxScrollY=this.wrapperHeight-this.scrollerHeight),this.hasHorizontalScroll=this.options.scrollX&&this.maxScrollX<0,this.hasVerticalScroll=this.options.scrollY&&this.maxScrollY<0,this.hasHorizontalScroll||(this.maxScrollX=0,this.scrollerWidth=this.wrapperWidth),this.hasVerticalScroll||(this.maxScrollY=0,this.scrollerHeight=this.wrapperHeight),this.endTime=0,this.directionX=0,this.directionY=0,this.wrapperOffset=l(this.wrapper),this.trigger("refresh"),this.resetPosition()},t.prototype.enable=function(){this.enabled=!0},t.prototype.disable=function(){this.enabled=!1}}(g),function(t){t.prototype._start=function(t){var i=B[t.type];if((i===Y||0===t.button)&&!(!this.enabled||this.destroyed||this.initiated&&this.initiated!==i)){this.initiated=i,this.options.preventDefault&&!c(t.target,this.options.preventDefaultException)&&t.preventDefault(),this.moved=!1,this.distX=0,this.distY=0,this.directionX=0,this.directionY=0,this.movingDirectionX=0,this.movingDirectionY=0,this.directionLocked=0,this._transitionTime(),this.startTime=s(),this.options.wheel&&(this.target=t.target),this.stop();var e=t.touches?t.touches[0]:t;this.startX=this.x,this.startY=this.y,this.absStartX=this.x,this.absStartY=this.y,this.pointX=e.pageX,this.pointY=e.pageY,this.trigger("beforeScrollStart")}},t.prototype._move=function(t){if(this.enabled&&!this.destroyed&&B[t.type]===this.initiated){this.options.preventDefault&&t.preventDefault();var i=t.touches?t.touches[0]:t,e=i.pageX-this.pointX,o=i.pageY-this.pointY;this.pointX=i.pageX,this.pointY=i.pageY,this.distX+=e,this.distY+=o;var n=Math.abs(this.distX),r=Math.abs(this.distY),h=s();if(!(h-this.endTime>this.options.momentumLimitTime&&r<this.options.momentumLimitDistance&&n<this.options.momentumLimitDistance)){if(this.directionLocked||this.options.freeScroll||(n>r+this.options.directionLockThreshold?this.directionLocked="h":r>=n+this.options.directionLockThreshold?this.directionLocked="v":this.directionLocked="n"),"h"===this.directionLocked){if("vertical"===this.options.eventPassthrough)t.preventDefault();else if("horizontal"===this.options.eventPassthrough)return void(this.initiated=!1);o=0}else if("v"===this.directionLocked){if("horizontal"===this.options.eventPassthrough)t.preventDefault();else if("vertical"===this.options.eventPassthrough)return void(this.initiated=!1);e=0}e=this.hasHorizontalScroll?e:0,o=this.hasVerticalScroll?o:0,this.movingDirectionX=e>0?W:e<0?H:0,this.movingDirectionY=o>0?U:o<0?L:0;var l=this.x+e,a=this.y+o;(l>0||l<this.maxScrollX)&&(l=this.options.bounce?this.x+e/3:l>0?0:this.maxScrollX),(a>0||a<this.maxScrollY)&&(a=this.options.bounce?this.y+o/3:a>0?0:this.maxScrollY),this.moved||(this.moved=!0,this.trigger("scrollStart")),this._translate(l,a),h-this.startTime>this.options.momentumLimitTime&&(this.startTime=h,this.startX=this.x,this.startY=this.y,1===this.options.probeType&&this.trigger("scroll",{x:this.x,y:this.y})),this.options.probeType>1&&this.trigger("scroll",{x:this.x,y:this.y});var c=document.documentElement.scrollLeft||window.pageXOffset||document.body.scrollLeft,p=document.documentElement.scrollTop||window.pageYOffset||document.body.scrollTop,u=this.pointX-c,d=this.pointY-p;(u>document.documentElement.clientWidth-this.options.momentumLimitDistance||u<this.options.momentumLimitDistance||d<this.options.momentumLimitDistance||d>document.documentElement.clientHeight-this.options.momentumLimitDistance)&&this._end(t)}}},t.prototype._end=function(t){if(this.enabled&&!this.destroyed&&B[t.type]===this.initiated&&(this.initiated=!1,this.options.preventDefault&&!c(t.target,this.options.preventDefaultException)&&t.preventDefault(),this.trigger("touchEnd",{x:this.x,y:this.y}),this.isInTransition=!1,!this.options.pullDownRefresh||!this._checkPullDown()))if(this._checkClick(t))this.trigger("scrollCancel");else if(!this.resetPosition(this.options.bounceTime,M.bounce)){var i=Math.round(this.x),e=Math.round(this.y);this.scrollTo(i,e);var o=i-this.absStartX,n=e-this.absStartY;this.directionX=o>0?W:o<0?H:0,this.directionY=n>0?U:n<0?L:0,this.endTime=s();var r=this.endTime-this.startTime,h=Math.abs(i-this.startX),l=Math.abs(e-this.startY);if(this._events.flick&&r<this.options.flickLimitTime&&h<this.options.flickLimitDistance&&l<this.options.flickLimitDistance)this.trigger("flick");else{var a=0;if(this.options.momentum&&r<this.options.momentumLimitTime&&(l>this.options.momentumLimitDistance||h>this.options.momentumLimitDistance)){var p=this.hasHorizontalScroll?u(this.x,this.startX,r,this.maxScrollX,this.options.bounce?this.wrapperWidth:0,this.options):{destination:i,duration:0},d=this.hasVerticalScroll?u(this.y,this.startY,r,this.maxScrollY,this.options.bounce?this.wrapperHeight:0,this.options):{destination:e,duration:0};i=p.destination,e=d.destination,a=Math.max(p.duration,d.duration),this.isInTransition=!0}else this.options.wheel&&(e=Math.round(e/this.itemHeight)*this.itemHeight,a=this.options.wheel.adjustTime||400);var f=M.swipe;if(this.options.snap){var m=this._nearestSnap(i,e);this.currentPage=m,a=this.options.snapSpeed||Math.max(Math.max(Math.min(Math.abs(i-m.x),1e3),Math.min(Math.abs(e-m.y),1e3)),300),i=m.x,e=m.y,this.directionX=0,this.directionY=0,f=M.bounce}if(i!==this.x||e!==this.y)return(i>0||i<this.maxScrollX||e>0||e<this.maxScrollY)&&(f=M.swipeBounce),void this.scrollTo(i,e,a,f);this.options.wheel&&(this.selectedIndex=Math.round(Math.abs(this.y/this.itemHeight))),this.trigger("scrollEnd",{x:this.x,y:this.y})}}},t.prototype._checkClick=function(t){var i=this.stopFromTransition&&!this.pulling;if(this.stopFromTransition=!1,!this.moved){if(this.options.wheel){if(this.target&&this.target.className===this.options.wheel.wheelWrapperClass){var e=Math.abs(Math.round(this.y/this.itemHeight)),s=Math.round((this.pointY+l(this.target).top-this.itemHeight/2)/this.itemHeight);this.target=this.items[e+s]}return this.scrollToElement(this.target,this.options.wheel.adjustTime||400,!0,!0,M.swipe),!0}return!i&&(this.options.tap&&function(t,i){var e=document.createEvent("Event");e.initEvent(i,!0,!0),e.pageX=t.pageX,e.pageY=t.pageY,t.target.dispatchEvent(e)}(t,this.options.tap),this.options.click&&function(t){var i=t.target;if(!/(SELECT|INPUT|TEXTAREA)/i.test(i.tagName)){var e=void 0;"mouseup"===t.type||"mousecancel"===t.type?e=t:"touchend"!==t.type&&"touchcancel"!==t.type||(e=t.changedTouches[0]);var s={};e&&(s.screenX=e.screenX||0,s.screenY=e.screenY||0,s.clientX=e.clientX||0,s.clientY=e.clientY||0);var n=void 0;"undefined"!=typeof MouseEvent?n=new MouseEvent("click",o({bubbles:!0,cancelable:!1},s)):((n=document.createEvent("Event")).initEvent("click",!0,!1),o(n,s)),n._constructed=!0,i.dispatchEvent(n)}}(t),!0)}return!1},t.prototype._resize=function(){var t=this;this.enabled&&(clearTimeout(this.resizeTimeout),this.resizeTimeout=setTimeout(function(){t.refresh()},this.options.resizePolling))},t.prototype._startProbe=function(){function t(){var e=i.getComputedPosition();i.trigger("scroll",e),i.isInTransition&&(i.probeTimer=X(t))}k(this.probeTimer),this.probeTimer=X(t);var i=this},t.prototype._transitionProperty=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"transform";this.scrollerStyle[E.transitionProperty]=t},t.prototype._transitionTime=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;if(this.scrollerStyle[E.transitionDuration]=t+"ms",this.options.wheel)for(var i=0;i<this.items.length;i++)this.items[i].style[E.transitionDuration]=t+"ms";if(this.indicators)for(var e=0;e<this.indicators.length;e++)this.indicators[e].transitionTime(t)},t.prototype._transitionTimingFunction=function(t){if(this.scrollerStyle[E.transitionTimingFunction]=t,this.options.wheel)for(var i=0;i<this.items.length;i++)this.items[i].style[E.transitionTimingFunction]=t;if(this.indicators)for(var e=0;e<this.indicators.length;e++)this.indicators[e].transitionTimingFunction(t)},t.prototype._transitionEnd=function(t){t.target===this.scroller&&this.isInTransition&&(this._transitionTime(),this.pulling||this.resetPosition(this.options.bounceTime,M.bounce)||(this.isInTransition=!1,this.trigger("scrollEnd",{x:this.x,y:this.y})))},t.prototype._translate=function(t,i){if(this.options.useTransform?this.scrollerStyle[E.transform]="translate("+t+"px,"+i+"px)"+this.translateZ:(t=Math.round(t),i=Math.round(i),this.scrollerStyle.left=t+"px",this.scrollerStyle.top=i+"px"),this.options.wheel)for(var e=this.options.wheel.rotate,s=void 0===e?25:e,o=0;o<this.items.length;o++){var n=s*(i/this.itemHeight+o);this.items[o].style[E.transform]="rotateX("+n+"deg)"}if(this.x=t,this.y=i,this.indicators)for(var r=0;r<this.indicators.length;r++)this.indicators[r].updatePosition()},t.prototype._animate=function(t,i,e,o){function n(){var p=s();if(p>=c)return r.isAnimating=!1,r._translate(t,i),void(r.pulling||r.resetPosition(r.options.bounceTime)||r.trigger("scrollEnd",{x:r.x,y:r.y}));var u=o(p=(p-a)/e),d=(t-h)*u+h,f=(i-l)*u+l;r._translate(d,f),r.isAnimating&&(r.animateTimer=X(n)),3===r.options.probeType&&r.trigger("scroll",{x:r.x,y:r.y})}var r=this,h=this.x,l=this.y,a=s(),c=a+e;this.isAnimating=!0,k(this.animateTimer),n()},t.prototype.scrollBy=function(t,i){var e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0,s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:M.bounce;t=this.x+t,i=this.y+i,this.scrollTo(t,i,e,s)},t.prototype.scrollTo=function(t,i){var e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0,s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:M.bounce;this.isInTransition=this.options.useTransition&&e>0&&(t!==this.x||i!==this.y),!e||this.options.useTransition?(this._transitionProperty(),this._transitionTimingFunction(s.style),this._transitionTime(e),this._translate(t,i),e&&3===this.options.probeType&&this._startProbe(),this.options.wheel&&(i>0?this.selectedIndex=0:i<this.maxScrollY?this.selectedIndex=this.items.length-1:this.selectedIndex=Math.round(Math.abs(i/this.itemHeight)))):this._animate(t,i,e,s.fn)},t.prototype.scrollToElement=function(t,i,e,s,o){if(t&&(t=t.nodeType?t:this.scroller.querySelector(t),!this.options.wheel||t.className===this.options.wheel.wheelItemClass)){var n=l(t);n.left-=this.wrapperOffset.left,n.top-=this.wrapperOffset.top,!0===e&&(e=Math.round(t.offsetWidth/2-this.wrapper.offsetWidth/2)),!0===s&&(s=Math.round(t.offsetHeight/2-this.wrapper.offsetHeight/2)),n.left-=e||0,n.top-=s||0,n.left=n.left>0?0:n.left<this.maxScrollX?this.maxScrollX:n.left,n.top=n.top>0?0:n.top<this.maxScrollY?this.maxScrollY:n.top,this.options.wheel&&(n.top=Math.round(n.top/this.itemHeight)*this.itemHeight),this.scrollTo(n.left,n.top,i,o)}},t.prototype.resetPosition=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:M.bounce,e=this.x,s=Math.round(e);!this.hasHorizontalScroll||s>0?e=0:s<this.maxScrollX&&(e=this.maxScrollX);var o=this.y,n=Math.round(o);return!this.hasVerticalScroll||n>0?o=0:n<this.maxScrollY&&(o=this.maxScrollY),(e!==this.x||o!==this.y)&&(this.scrollTo(e,o,t,i),!0)},t.prototype.getComputedPosition=function(){var t=window.getComputedStyle(this.scroller,null),i=void 0,e=void 0;return this.options.useTransform?(i=+((t=t[E.transform].split(")")[0].split(", "))[12]||t[4]),e=+(t[13]||t[5])):(i=+t.left.replace(/[^-\d.]/g,""),e=+t.top.replace(/[^-\d.]/g,"")),{x:i,y:e}},t.prototype.stop=function(){if(this.options.useTransition&&this.isInTransition){this.isInTransition=!1;var t=this.getComputedPosition();this._translate(t.x,t.y),this.options.wheel?this.target=this.items[Math.round(-t.y/this.itemHeight)]:this.trigger("scrollEnd",{x:this.x,y:this.y}),this.stopFromTransition=!0}else!this.options.useTransition&&this.isAnimating&&(this.isAnimating=!1,this.trigger("scrollEnd",{x:this.x,y:this.y}),this.stopFromTransition=!0)},t.prototype.destroy=function(){this.destroyed=!0,this.trigger("destroy"),this._removeDOMEvents(),this._events={}}}(g),function(t){t.prototype.on=function(t,i){var e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:this;this._events[t]||(this._events[t]=[]),this._events[t].push([i,e])},t.prototype.once=function(t,i){function e(){this.off(t,e),o||(o=!0,i.apply(s,arguments))}var s=arguments.length>2&&void 0!==arguments[2]?arguments[2]:this,o=!1;e.fn=i,this.on(t,e)},t.prototype.off=function(t,i){var e=this._events[t];if(e)for(var s=e.length;s--;)(e[s][0]===i||e[s][0]&&e[s][0].fn===i)&&(e[s][0]=void 0)},t.prototype.trigger=function(t){var i=this._events[t];if(i)for(var e=i.length,s=[].concat(y(i)),o=0;o<e;o++){var n=s[o],r=v(n,2),h=r[0],l=r[1];h&&h.apply(l,[].slice.call(arguments,1))}}}(g),function(t){t.prototype._initSnap=function(){var t=this;this.currentPage={};var i=this.options.snap;if(i.loop){var e=this.scroller.children;e.length>0&&(function(t,i){i.firstChild?function(t,i){i.parentNode.insertBefore(t,i)}(t,i.firstChild):i.appendChild(t)}(e[e.length-1].cloneNode(!0),this.scroller),this.scroller.appendChild(e[1].cloneNode(!0)))}var s=i.el;"string"==typeof s&&(s=this.scroller.querySelectorAll(s)),this.on("refresh",function(){if(t.pages=[],t.wrapperWidth&&t.wrapperHeight&&t.scrollerWidth&&t.scrollerHeight){var e=i.stepX||t.wrapperWidth,o=i.stepY||t.wrapperHeight,n=0,r=void 0,h=void 0,l=void 0,c=0,p=void 0,u=0,d=void 0,f=void 0;if(s)for(p=s.length,d=-1;c<p;c++)f=a(s[c]),(0===c||f.left<=a(s[c-1]).left)&&(u=0,d++),t.pages[u]||(t.pages[u]=[]),n=Math.max(-f.left,t.maxScrollX),r=Math.max(-f.top,t.maxScrollY),h=n-Math.round(f.width/2),l=r-Math.round(f.height/2),t.pages[u][d]={x:n,y:r,width:f.width,height:f.height,cx:h,cy:l},n>t.maxScrollX&&u++;else for(h=Math.round(e/2),l=Math.round(o/2);n>-t.scrollerWidth;){for(t.pages[c]=[],p=0,r=0;r>-t.scrollerHeight;)t.pages[c][p]={x:Math.max(n,t.maxScrollX),y:Math.max(r,t.maxScrollY),width:e,height:o,cx:n-h,cy:r-l},r-=o,p++;n-=e,c++}var m=i.loop?1:0;t._goToPage(t.currentPage.pageX||m,t.currentPage.pageY||0,0);var g=i.threshold;g%1==0?(t.snapThresholdX=g,t.snapThresholdY=g):(t.snapThresholdX=Math.round(t.pages[t.currentPage.pageX][t.currentPage.pageY].width*g),t.snapThresholdY=Math.round(t.pages[t.currentPage.pageX][t.currentPage.pageY].height*g))}}),this.on("scrollEnd",function(){i.loop&&(0===t.currentPage.pageX&&t._goToPage(t.pages.length-2,t.currentPage.pageY,0),t.currentPage.pageX===t.pages.length-1&&t._goToPage(1,t.currentPage.pageY,0))}),!1!==i.listenFlick&&this.on("flick",function(){var e=i.speed||Math.max(Math.max(Math.min(Math.abs(t.x-t.startX),1e3),Math.min(Math.abs(t.y-t.startY),1e3)),300);t._goToPage(t.currentPage.pageX+t.directionX,t.currentPage.pageY+t.directionY,e)}),this.on("destroy",function(){if(i.loop){var e=t.scroller.children;e.length>2&&(p(t.scroller,e[e.length-1]),p(t.scroller,e[0]))}})},t.prototype._nearestSnap=function(t,i){if(!this.pages.length)return{x:0,y:0,pageX:0,pageY:0};var e=0;if(Math.abs(t-this.absStartX)<=this.snapThresholdX&&Math.abs(i-this.absStartY)<=this.snapThresholdY)return this.currentPage;t>0?t=0:t<this.maxScrollX&&(t=this.maxScrollX),i>0?i=0:i<this.maxScrollY&&(i=this.maxScrollY);for(var s=this.pages.length;e<s;e++)if(t>=this.pages[e][0].cx){t=this.pages[e][0].x;break}s=this.pages[e].length;for(var o=0;o<s;o++)if(i>=this.pages[0][o].cy){i=this.pages[0][o].y;break}return e===this.currentPage.pageX&&((e+=this.directionX)<0?e=0:e>=this.pages.length&&(e=this.pages.length-1),t=this.pages[e][0].x),o===this.currentPage.pageY&&((o+=this.directionY)<0?o=0:o>=this.pages[0].length&&(o=this.pages[0].length-1),i=this.pages[0][o].y),{x:t,y:i,pageX:e,pageY:o}},t.prototype._goToPage=function(t){var i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,e=arguments[2],s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:M.bounce,o=this.options.snap;if(o&&this.pages&&(t>=this.pages.length?t=this.pages.length-1:t<0&&(t=0),this.pages[t])){i>=this.pages[t].length?i=this.pages[t].length-1:i<0&&(i=0);var n=this.pages[t][i].x,r=this.pages[t][i].y;e=void 0===e?o.speed||Math.max(Math.max(Math.min(Math.abs(n-this.x),1e3),Math.min(Math.abs(r-this.y),1e3)),300):e,this.currentPage={x:n,y:r,pageX:t,pageY:i},this.scrollTo(n,r,e,s)}},t.prototype.goToPage=function(t,i,e,s){var o=this.options.snap;if(o){if(o.loop){var n=this.pages.length-2;t>=n?t=n-1:t<0&&(t=0),t+=1}this._goToPage(t,i,e,s)}},t.prototype.next=function(t,i){var e=this.currentPage.pageX,s=this.currentPage.pageY;++e>=this.pages.length&&this.hasVerticalScroll&&(e=0,s++),this._goToPage(e,s,t,i)},t.prototype.prev=function(t,i){var e=this.currentPage.pageX,s=this.currentPage.pageY;--e<0&&this.hasVerticalScroll&&(e=0,s--),this._goToPage(e,s,t,i)},t.prototype.getCurrentPage=function(){var t=this.options.snap;return t?t.loop?o({},this.currentPage,{pageX:this.currentPage.pageX-1}):this.currentPage:null}}(g),function(t){t.prototype.wheelTo=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;this.options.wheel&&(this.y=-t*this.itemHeight,this.scrollTo(0,this.y))},t.prototype.getSelectedIndex=function(){return this.options.wheel&&this.selectedIndex},t.prototype._initWheel=function(){var t=this.options.wheel;t.wheelWrapperClass||(t.wheelWrapperClass="wheel-scroll"),t.wheelItemClass||(t.wheelItemClass="wheel-item"),void 0===t.selectedIndex&&(t.selectedIndex=0,d("wheel option selectedIndex is required!"))}}(g),function(t){t.prototype._initScrollbar=function(){var t=this,i=this.options.scrollbar.fade,e=void 0===i||i;this.indicators=[];var s=void 0;this.options.scrollX&&(s={el:f("horizontal"),direction:"horizontal",fade:e},this._insertScrollBar(s.el),this.indicators.push(new m(this,s))),this.options.scrollY&&(s={el:f("vertical"),direction:"vertical",fade:e},this._insertScrollBar(s.el),this.indicators.push(new m(this,s))),this.on("refresh",function(){for(var i=0;i<t.indicators.length;i++)t.indicators[i].refresh()}),e&&(this.on("scrollEnd",function(){for(var i=0;i<t.indicators.length;i++)t.indicators[i].fade()}),this.on("scrollCancel",function(){for(var i=0;i<t.indicators.length;i++)t.indicators[i].fade()}),this.on("scrollStart",function(){for(var i=0;i<t.indicators.length;i++)t.indicators[i].fade(!0)}),this.on("beforeScrollStart",function(){for(var i=0;i<t.indicators.length;i++)t.indicators[i].fade(!0,!0)})),this.on("destroy",function(){t._removeScrollBars()})},t.prototype._insertScrollBar=function(t){this.wrapper.appendChild(t)},t.prototype._removeScrollBars=function(){for(var t=0;t<this.indicators.length;t++)this.indicators[t].remove()}}(g),function(t){t.prototype._initPullDown=function(){this.options.probeType=3},t.prototype._checkPullDown=function(){var t=this.options.pullDownRefresh,i=t.threshold,e=void 0===i?90:i,s=t.stop,o=void 0===s?40:s;return!(this.movingDirectionY!==U||this.y<e)&&(this.pulling||(this.pulling=!0,this.trigger("pullingDown")),this.scrollTo(this.x,o,this.options.bounceTime,M.bounce),this.pulling)},t.prototype.finishPullDown=function(){this.pulling=!1,this.resetPosition(this.options.bounceTime,M.bounce)}}(g),function(t){t.prototype._initPullUp=function(){this.options.probeType=3,this.pullupWatching=!1,this._watchPullUp()},t.prototype._watchPullUp=function(){function t(i){this.movingDirectionY===L&&i.y<=this.maxScrollY+e&&(this.trigger("pullingUp"),this.pullupWatching=!1,this.off("scroll",t))}if(!this.pullupWatching){this.pullupWatching=!0;var i=this.options.pullUpLoad.threshold,e=void 0===i?0:i;this.on("scroll",t)}},t.prototype.finishPullUp=function(){var t=this;this.isInTransition?this.once("scrollEnd",function(){t._watchPullUp()}):this._watchPullUp()}}(g),g.Version="1.6.2",i.a=g},GUgS:function(t,i,e){(t.exports=e("FZ+f")(!0)).push([t.i,"\n.scroll-content {\n  position: relative;\n  z-index: 1;\n}\n.list-content {\n  position: relative;\n  z-index: 10;\n  background: #fff;\n}\n.list-content .list-item {\n  height: 1.6rem;\n  line-height: 1.6rem;\n  font-size: 0.48rem;\n  padding-left: 0.533333rem;\n  border-bottom: 0.026667rem solid #e5e5e5;\n}\n.pulldown-wrapper {\n  position: absolute;\n  width: 100%;\n  left: 0;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-pack: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n  -webkit-transition: all;\n  transition: all;\n}\n.pulldown-wrapper .after-trigger {\n  margin-top: 0.266667rem;\n}\n.pullup-wrapper {\n  width: 100%;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-pack: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n  padding: 0.426667rem 0;\n}","",{version:3,sources:["/Users/Macx/Desktop/小农丁webapp/xiaonongding/src/base/scroll/scroll.vue"],names:[],mappings:";AACA;EACE,mBAAmB;EACnB,WAAW;CACZ;AACD;EACE,mBAAmB;EACnB,YAAY;EACZ,iBAAiB;CAClB;AACD;EACE,eAAe;EACf,oBAAoB;EACpB,mBAAmB;EACnB,0BAA0B;EAC1B,yCAAyC;CAC1C;AACD;EACE,mBAAmB;EACnB,YAAY;EACZ,QAAQ;EACR,qBAAqB;EACrB,qBAAqB;EACrB,cAAc;EACd,yBAAyB;MACrB,sBAAsB;UAClB,wBAAwB;EAChC,0BAA0B;MACtB,uBAAuB;UACnB,oBAAoB;EAC5B,wBAAwB;EACxB,gBAAgB;CACjB;AACD;EACE,wBAAwB;CACzB;AACD;EACE,YAAY;EACZ,qBAAqB;EACrB,qBAAqB;EACrB,cAAc;EACd,yBAAyB;MACrB,sBAAsB;UAClB,wBAAwB;EAChC,0BAA0B;MACtB,uBAAuB;UACnB,oBAAoB;EAC5B,uBAAuB;CACxB",file:"scroll.vue",sourcesContent:["\n.scroll-content {\n  position: relative;\n  z-index: 1;\n}\n.list-content {\n  position: relative;\n  z-index: 10;\n  background: #fff;\n}\n.list-content .list-item {\n  height: 1.6rem;\n  line-height: 1.6rem;\n  font-size: 0.48rem;\n  padding-left: 0.533333rem;\n  border-bottom: 0.026667rem solid #e5e5e5;\n}\n.pulldown-wrapper {\n  position: absolute;\n  width: 100%;\n  left: 0;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-pack: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n  -webkit-transition: all;\n  transition: all;\n}\n.pulldown-wrapper .after-trigger {\n  margin-top: 0.266667rem;\n}\n.pullup-wrapper {\n  width: 100%;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-pack: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n  padding: 0.426667rem 0;\n}"],sourceRoot:""}])},qwAB:function(t,i,e){"use strict";var s=e("GQaK"),o=e("3Q4o"),n={name:"scroll",props:{data:{type:Array,default:function(){return[]}},probeType:{type:Number,default:1},click:{type:Boolean,default:!0},listenScroll:{type:Boolean,default:!1},listenBeforeScroll:{type:Boolean,default:!1},direction:{type:String,default:"vertical"},scrollbar:{type:null,default:!1},pullDownRefresh:{type:null,default:!1},pullUpLoad:{type:null,default:!1},startY:{type:Number,default:0},refreshDelay:{type:Number,default:20},freeScroll:{type:Boolean,default:!1}},data:function(){return{beforePullDown:!0,isRebounding:!1,isPullingDown:!1,isPullUpLoad:!1,pullUpDirty:!0,pullDownStyle:"",bubbleY:0}},computed:{pullUpTxt:function(){var t=this.pullUpLoad&&this.pullUpLoad.txt&&this.pullUpLoad.txt.more||this.$i18n.t("scrollComponent.defaultLoadTxtMore"),i=this.pullUpLoad&&this.pullUpLoad.txt&&this.pullUpLoad.txt.noMore||this.$i18n.t("scrollComponent.defaultLoadTxtNoMore");return this.pullUpDirty?t:i},refreshTxt:function(){return this.pullDownRefresh&&this.pullDownRefresh.txt||this.$i18n.t("scrollComponent.defaultRefreshTxt")}},created:function(){this.pullDownInitTop=-50},mounted:function(){var t=this;setTimeout(function(){t.initScroll()},20)},methods:{initScroll:function(){var t=this;if(this.$refs.wrapper){this.$refs.listWrapper&&(this.pullDownRefresh||this.pullUpLoad)&&(this.$refs.listWrapper.style.minHeight=Object(o.c)(this.$refs.wrapper).height+1+"px");var i={probeType:this.probeType,click:this.click,momentumLimitDistance:20,deceleration:.002,scrollY:this.freeScroll||"vertical"===this.direction,scrollX:this.freeScroll||"horizontal"===this.direction,scrollbar:this.scrollbar,pullDownRefresh:this.pullDownRefresh,pullUpLoad:this.pullUpLoad,startY:this.startY,freeScroll:this.freeScroll};this.scroll=new s.a(this.$refs.wrapper,i),this.listenScroll&&this.scroll.on("scroll",function(i){t.$emit("scroll",i)}),this.listenBeforeScroll&&this.scroll.on("beforeScrollStart",function(){t.$emit("beforeScrollStart")}),this.pullDownRefresh&&this._initPullDownRefresh(),this.pullUpLoad&&this._initPullUpLoad()}},disable:function(){this.scroll&&this.scroll.disable()},enable:function(){this.scroll&&this.scroll.enable()},refresh:function(){this.scroll&&this.scroll.refresh()},scrollTo:function(){this.scroll&&this.scroll.scrollTo.apply(this.scroll,arguments)},scrollToElement:function(){this.scroll&&this.scroll.scrollToElement.apply(this.scroll,arguments)},clickItem:function(t,i){console.log(t),this.$emit("click",i)},destroy:function(){this.scroll.destroy()},forceUpdate:function(t){var i=this;this.pullDownRefresh&&this.isPullingDown?(this.isPullingDown=!1,this._reboundPullDown().then(function(){i._afterPullDown()})):this.pullUpLoad&&this.isPullUpLoad?(this.isPullUpLoad=!1,this.scroll.finishPullUp(),this.pullUpDirty=t,this.refresh()):this.refresh()},_initPullDownRefresh:function(){var t=this;this.scroll.on("pullingDown",function(){t.beforePullDown=!1,t.isPullingDown=!0,t.$emit("pullingDown")}),this.scroll.on("scroll",function(i){t.beforePullDown?(t.bubbleY=Math.max(0,i.y+t.pullDownInitTop),t.pullDownStyle="top:"+Math.min(i.y+t.pullDownInitTop,10)+"px"):t.bubbleY=0,t.isRebounding&&(t.pullDownStyle="top:"+(10-(t.pullDownRefresh.stop-i.y))+"px")})},_initPullUpLoad:function(){var t=this;this.scroll.on("pullingUp",function(){t.isPullUpLoad=!0,t.$emit("pullingUp")})},_reboundPullDown:function(){var t=this,i=this.pullDownRefresh.stopTime,e=void 0===i?600:i;return new Promise(function(i){setTimeout(function(){t.isRebounding=!0,t.scroll.finishPullDown(),i()},e)})},_afterPullDown:function(){var t=this;setTimeout(function(){t.pullDownStyle="top:"+t.pullDownInitTop+"px",t.beforePullDown=!0,t.isRebounding=!1,t.refresh()},this.scroll.options.bounceTime)}},watch:{data:function(){var t=this;setTimeout(function(){t.forceUpdate(!0)},this.refreshDelay)}},components:{}},r={render:function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",{ref:"wrapper",staticClass:"list-wrapper"},[e("div",{staticClass:"scroll-content"},[e("div",{ref:"listWrapper"},[t._t("default",[e("ul",{staticClass:"list-content"},t._l(t.data,function(i){return e("li",{staticClass:"list-item",on:{click:function(e){t.clickItem(e,i)}}},[t._v(t._s(i))])}))])],2)])])},staticRenderFns:[]},h=e("VU/8")(n,r,!1,function(t){e("w2eJ")},null,null);i.a=h.exports},w2eJ:function(t,i,e){var s=e("GUgS");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);e("rjj0")("28ee373e",s,!0)}});
//# sourceMappingURL=0.5be0e22301b318eb0a5a.js.map