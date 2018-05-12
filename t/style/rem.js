/**
 * Created by wangjinhui on 2017/11/15.
 */
(function(){
    styleNodeFontSize()
})();

window.onresize = function(){
    styleNodeFontSize()
};

function styleNodeFontSize() {
    var width = document.documentElement.clientWidth;
    var styleNode = document.createElement('style');
    if(width >640){
        styleNode.innerHTML = "html{font-size:" + (640/15) + "px!important}";
    }else{
        styleNode.innerHTML = "html{font-size:" + (width/15) + "px!important}";
    }
    document.head.appendChild(styleNode);
}