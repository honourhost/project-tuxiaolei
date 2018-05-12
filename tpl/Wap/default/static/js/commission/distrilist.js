/**
 * Created by adamin90 on 2017/8/14.
 */
var OFFSET = 5;
var page = 1;
var PAGESIZE = 10;

var myScroll,
    pullDownEl, pullDownOffset,
    pullUpEl, pullUpOffset,
    generatedCount = 0;
var maxScrollY = 0;

var hasMoreData = false;

document.addEventListener('touchmove', function(e) {
    e.preventDefault();
}, false);

document.addEventListener('DOMContentLoaded', function() {
    $(document).ready(function() {
        loaded();
    });
}, false);

function loaded() {
    pullDownEl = document.getElementById('pullDown');
    pullDownOffset = pullDownEl.offsetHeight;
    pullUpEl = document.getElementById('pullUp');
    pullUpOffset = pullUpEl.offsetHeight;

    hasMoreData = false;
    // $("#thelist").hide();
    $("#pullUp").hide();

    pullDownEl.className = 'loading';
    pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';

    page = 1;
    $.get(
        "/wap.php?g=Wap&c=My&a=getdistribute", {
            "page": page,
            "pagesize": PAGESIZE
        },
        function(response, status) {
            if (status == "success") {
                $("#thelist").show();

                if (response.info.length < PAGESIZE) {
                    hasMoreData = false;
                    $("#pullUp").hide();
                } else {
                    hasMoreData = true;
                    $("#pullUp").show();
                }

                // document.getElementById('wrapper').style.left = '0';

                myScroll = new iScroll('wrapper', {
                    useTransition: true,
                    topOffset: pullDownOffset,
                    onRefresh: function() {
                        if (pullDownEl.className.match('loading')) {
                            pullDownEl.className = 'idle';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                            this.minScrollY = -pullDownOffset;
                        }
                        if (pullUpEl.className.match('loading')) {
                            pullUpEl.className = 'idle';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                        }
                    },
                    onScrollMove: function() {
                        if (this.y > OFFSET && !pullDownEl.className.match('flip')) {
                            pullDownEl.className = 'flip';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '放手刷新...';
                            this.minScrollY = 0;
                        } else if (this.y < OFFSET && pullDownEl.className.match('flip')) {
                            pullDownEl.className = 'idle';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                            this.minScrollY = -pullDownOffset;
                        }
                        if (this.y < (maxScrollY - pullUpOffset - OFFSET) && !pullUpEl.className.match('flip')) {
                            if (hasMoreData) {
                                this.maxScrollY = this.maxScrollY - pullUpOffset;
                                pullUpEl.className = 'flip';
                                pullUpEl.querySelector('.pullUpLabel').innerHTML = '放手刷新...';
                            }
                        } else if (this.y > (maxScrollY - pullUpOffset - OFFSET) && pullUpEl.className.match('flip')) {
                            if (hasMoreData) {
                                this.maxScrollY = maxScrollY;
                                pullUpEl.className = 'idle';
                                pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                            }
                        }
                    },
                    onScrollEnd: function() {
                        if (pullDownEl.className.match('flip')) {
                            pullDownEl.className = 'loading';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
                            // pullDownAction(); // Execute custom function (ajax call?)
                            refresh();
                        }
                        if (hasMoreData && pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'loading';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                            // pullUpAction(); // Execute custom function (ajax call?)
                            nextPage();
                        }
                    }
                });

                $("#thelist").empty();

                $.each(response.info.money_list, function(key, value) {
                    console.error(value);
                        var innerCont="<li><span class='right'>+"+value.commission+"</span><div class='left'><div class='left-time'><span class='time'>"+value.order_name+"</span><span class='chongzhi'>"+value.distributestatus+"</span></div></div><div style='clear: both;'></div></li>";

                    $("#thelist").append(innerCont);
                });
                // $("#thelist").listview("refresh");
                myScroll.refresh(); // Remember to refresh when contents are loaded (ie: on ajax completion)
                // pullDownEl.className = 'idle';
                // pullDownEl.querySelector('.pullDownLabel').innerHTML = 'Pull down to refresh...';
                // this.minScrollY = -pullDownOffset;

                if (hasMoreData) {
                    myScroll.maxScrollY = myScroll.maxScrollY + pullUpOffset;
                } else {
                    myScroll.maxScrollY = myScroll.maxScrollY;
                }
                maxScrollY = myScroll.maxScrollY;
            };
        },
        "json");
}

function refresh() {
    page = 1;
    $.get(
        "/wap.php?g=Wap&c=My&a=getdistribute", {
            "page": page,
            "pagesize": PAGESIZE
        },
        function(response, status) {
            if (status == "success") {
                $("#thelist").empty();

                myScroll.refresh();

                if (response.info.length < PAGESIZE) {
                    hasMoreData = false;
                    $("#pullUp").hide();
                } else {
                    hasMoreData = true;
                    $("#pullUp").show();
                }

                $.each(response.info.money_list, function(key, value) {
                        var innerCont="<li><span class='right'>+"+value.commission+"</span><div class='left'><div class='left-time'><span class='time'>"+value.order_name+"</span><span class='chongzhi'>"+value.distributestatus+"</span></div></div><div style='clear: both;'></div></li>";
                    $("#thelist").append(innerCont);
                });
                // $("#thelist").listview("refresh");
                myScroll.refresh(); // Remember to refresh when contents are loaded (ie: on ajax completion)

                if (hasMoreData) {
                    myScroll.maxScrollY = myScroll.maxScrollY + pullUpOffset;
                } else {
                    myScroll.maxScrollY = myScroll.maxScrollY;
                }
                maxScrollY = myScroll.maxScrollY;
            };
        },
        "json");
}

function nextPage() {
    page++;
    $.get(
        "/wap.php?g=Wap&c=My&a=getdistribute", {
            "page": page,
            "pagesize": PAGESIZE
        },
        function(response, status) {
            if (status == "success") {
                if (response.info.length < PAGESIZE) {
                    hasMoreData = false;
                    $("#pullUp").hide();
                } else {
                    hasMoreData = true;
                    $("#pullUp").show();
                }

                $.each(response.info.money_list, function(key, value) {
                        var innerCont="<li><span class='right'>+"+value.commission+"</span><div class='left'><div class='left-time'><span class='time'>"+value.order_name+"</span><span class='chongzhi'>"+value.distributestatus+"</span></div></div><div style='clear: both;'></div></li>";
                    $("#thelist").append(innerCont);
                });
                // $("#thelist").listview("refresh");
                myScroll.refresh(); // Remember to refresh when contents are loaded (ie: on ajax completion)
                if (hasMoreData) {
                    myScroll.maxScrollY = myScroll.maxScrollY + pullUpOffset;
                } else {
                    myScroll.maxScrollY = myScroll.maxScrollY;
                }
                maxScrollY = myScroll.maxScrollY;
            };
        },
        "json");
}