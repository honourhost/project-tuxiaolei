<footer class="main-footer" style="display: none;">
    <div align="center">
        Powered by <a href="http://blog.lixiaopeng.top">小农丁.Adam </a>
    </div>
    <div class="pull-right hidden-xs">
        Made with Love
    </div>
    <input type="hidden" id="orderc" value="<?php echo empty($_GET['orderc'])?'256508':$_GET['orderc'];?>">
    <input type="hidden" id="moneyc" value="<?php echo empty($_GET['moneyc'])?'32643207.35':$_GET['moneyc'];?>">
    <input type="hidden" id="userc" value="<?php echo empty($_GET['userc'])?'348832':$_GET['userc'];?>">
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
    var sum=parseInt($("#orderc").val());
    function update() {

        $.getJSON("{pigcms{:U('Chart/jsonreturn')}", function(data) {
           sum+=data.n;
            magic_number(sum);
        });
    };

    setInterval(update, 6000);
    update();
</script>
<script>
    function magic_number1(value) {
        var num1 = $("#number1");
        num1.animate({count: value}, {
            duration: 500,
            step: function() {
                num1.text(String(parseInt(this.count)));
            }
        });
    };
    var =parseInt($("#moneyc").val());
    function update1() {

        $.getJSON("{pigcms{:U('Chart/jsonreturn1')}", function(data) {
            sum1+=data.n;
            magic_number1(sum1);
        });
    };

    setInterval(update1, 6000);
    update1();
</script>

<script>
    function magic_number2(value) {
        var num2 = $("#number2");
        num2.animate({count: value}, {
            duration: 500,
            step: function() {
                num2.text(String(parseInt(this.count)));
            }
        });
    };
    var sum2=parseInt($("#userc").val());
    function update2() {

        $.getJSON("{pigcms{:U('Chart/jsonreturn2')}", function(data) {
            sum2+=data.n;
            magic_number2(sum2);
        });
    };

    setInterval(update2, 6000);
    update2();
</script>
</body>
</html>
