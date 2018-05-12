<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">店铺二维码</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        店铺二维码：<a href="{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=meal&id={pigcms{$store_id}" class="see_qrcode">查看二维码</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
    $(function() {
            $('.see_qrcode').click(function () {
                art.dialog.open($(this).attr('href'), {
                    init: function () {
                        var iframe = this.iframe.contentWindow;
                        window.top.art.dialog.data('iframe_handle', iframe);
                    },
                    id: 'handle',
                    title: '查看渠道二维码',
                    padding: 0,
                    width: 430,
                    height: 433,
                    lock: true,
                    resize: false,
                    background: 'black',
                    button: null,
                    fixed: false,
                    close: null,
                    left: '50%',
                    top: '38.2%',
                    opacity: '0.4'
                });
                return false;
            });

        art.dialog.open("{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=meal&id={pigcms{$store_id}",{
            init: function(){
                var iframe = this.iframe.contentWindow;
                window.top.art.dialog.data('iframe_handle',iframe);
            },
            id: 'handle',
            title:'查看渠道二维码',
            padding: 0,
            width: 430,
            height: 433,
            lock: true,
            resize: false,
            background:'black',
            button: null,
            fixed: false,
            close: null,
            left: '50%',
            top: '38.2%',
            opacity:'0.4'
        });
        }
    );
</script>
<include file="Public:footer"/>
