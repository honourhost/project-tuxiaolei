/**
 * 开发版本的文件导入
 */
(function (){

    // 加载文件
    (function(){
        var paths,baseURL,sources=[],v=window.QYER.FED.config.version|0;

        paths  = [
            "lib/qyer/jquery-1.10.2AndRequireJSAndTemplate.js",
            "qyerUtil.js"
        ];
        baseURL = 'http://fed.static.qyer.com/core/web/basic/js/';
        for (var i=0,pi;pi = paths[i++];) {
            sources.push('<script type="text/javascript" src="'+ baseURL + pi +'?v='+v+'"></script>');
        }

        // 页面主逻辑入口
        if( QYER.FED.config.pageID&&QYER.FED.config.pagePath ){

            if(location.href.indexOf('http://fed.static.qyer.com/')!=-1 || location.href.indexOf('qdebug')!=-1 || !window.QYER.FED.config.version){
                sources.push('<link type="text/css" rel="stylesheet" href="http://fed.static.qyer.com/'+(QYER.FED.config.pagePath)+'css/index.css?v='+v+'" />');
                sources.push('<script type="text/javascript" src="http://fed.static.qyer.com/'+(QYER.FED.config.pagePath)+'js/index.js?v='+v+'" async="async" ></script>');
            }else{
                sources.push('<link type="text/css" rel="stylesheet" href="http://static.qyer.com/output/'+ QYER.FED.config.pageID +'.css?v='+v+'" />');
                sources.push('<script type="text/javascript" src="http://static.qyer.com/output/'+ QYER.FED.config.pageID +'.js?v='+v+'" async="async" ></script>');
            }
        }


        document.write(sources.join(''));
        
        sources.length=0
        paths=baseURL=sources=null;
    })();

})();;;