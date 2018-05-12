<footer class="main-footer">
    <div align="center">
        Powered by <a href="http://blog.lixiaopeng.top">小农丁.Adam </a>
    </div>
    <div class="pull-right hidden-xs">
        Made with Love
    </div>
</footer>
</div><!-- ./wrapper -->


<!-- Bootstrap 3.3.2 JS -->
<script src="http://gf.lixiaopeng.top/assets/public/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="http://gf.lixiaopeng.top/assets/public/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='http://gf.lixiaopeng.top/assets/public/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="http://gf.lixiaopeng.top/assets/public/js/app.min.js" type="text/javascript"></script>

<script>
    function magic_number(value) {
        var num = $("#number");
        num.animate({count: value}, {
            duration: 500,
            step: function() {
                num.text(String(parseInt(this.count)));
            }
        });
    };

    function update() {
        $.getJSON("{pigcms{:U('Chart/jsonreturn')}", function(data) {
            magic_number(data.n);
        });
    };

    setInterval(update, 3000);
    update();
</script>
</body>
</html>

