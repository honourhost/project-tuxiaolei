<?php


class OqueryAction extends BaseAction{
    public function index(){

		$database_group_order = D('Group_order');
		$condition_group_category['mer_id'] = 629;//intval($_GET['mer_id'])

        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }


        $fuwufei=$database_group_order->query("SELECT FORMAT(sum(go.payment_money)-sum(go.payment_money*concat(m.percent/100,'%')),2) as num FROM `pigcms_group_order` as go 
INNER JOIN pigcms_merchant as m ON go.mer_id=m.mer_id
WHERE go.mer_id!=629 and go.mer_id!=890 and go.mer_id!=812 and go.paid=1 $condition_where");

		
		$count_group_category = $database_group_order->where($condition_group_category)->count();


		import('@.ORG.system_page');
		$p = new Page($count_group_category,20);
		$category_list = $database_group_order->field('order_name,price,total_money,num,express_id,add_time')->where($condition_group_category)->order('`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $database_group_order->getLastSql();

		$this->assign('category_list',$category_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
        $this->assign('fuwufei',$fuwufei[0]['num']);





        $this->display();
    }

    public function xianxia(){

        $database_group_order = D('fast_order');
        //$condition_group_category['mer_id'] = 629;//intval($_GET['mer_id'])

        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }



        $count_group_category = $database_group_order->where($condition_group_category)->count();


        import('@.ORG.system_page');
        $p = new Page($count_group_category,20);
        $category_list = $database_group_order->field('order_name,price,total_money,add_time')->where($condition_group_category)->order('`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $database_group_order->getLastSql();

        $this->assign('category_list',$category_list);
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);






        $this->display();
    }


    public function shengxian(){

        $database_group_order = D('Group_order');
        $condition_group_category['mer_id'] = 890;//intval($_GET['mer_id'])

        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }




        $count_group_category = $database_group_order->where($condition_group_category)->count();


        import('@.ORG.system_page');
        $p = new Page($count_group_category,20);
        $category_list = $database_group_order->field('order_name,price,total_money,num,express_id,add_time')->where($condition_group_category)->order('`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $database_group_order->getLastSql();

        $this->assign('category_list',$category_list);
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);






        $this->display();
    }

    public function export(){
    // echo $_GET['kaishi'];exit;
    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    // 输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="order.csv"');
    header('Cache-Control: max-age=0');

    $database_group_order = D('Group_order');
    $condition_group_category['mer_id'] = 629;//intval($_GET['mer_id'])



    $condition_where="";
    if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
        $ks=strtotime($_GET['kaishi']);
        $js=strtotime($_GET['jieshu']);
        $condition_where="and add_time BETWEEN '$ks' AND '$js'";

        $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
    }
    $stmt = $database_group_order->field('order_name,price,total_money,num,express_id,add_time')->where($condition_group_category)->order('`order_id` DESC')->select();

    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    /*$where=array(
        "paid"=>1,
        "pay_type"=>array("NEQ","offline"),
        "status"=>array("lt",3),
    );*/
    //$mid=$this->merchant_session['mer_id'];
    //$where="mer_id=$mid";
    // $stmt = M("Group_order")->field("order_name,phone,add_time,price,total_money,payment_money,contact_name")->where($where)->order("order_id DESC")->limit(1000)->select();
    // 打开PHP文件句柄，php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');

    // 输出Excel列名信息
    $head = array("商品名称","供货价","销售价","单量","是否发货","日期");
    foreach ($head as $i => $v) {
        // CSV的Excel支持GBK编码，一定要转换，否则乱码
        $head[$i] = iconv('utf-8', 'gbk', $v);
    }

    // 将数据通过fputcsv写到文件句柄
    fputcsv($fp, $head);

    // 计数器
    $cnt = 0;
    // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 500;
    // 逐行取出数据，不浪费内存
    $count = count($stmt);
    for($t=0;$t<$count;$t++) {

        $cnt ++;
        if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
            ob_flush();
            flush();
            $cnt = 0;
        }
        $row = $stmt[$t];
        foreach ($row as $i => $v) {
            if($i=='add_time'){
                $v=date("Y-m-d,H:i:s",$v);
            }
            $row[$i] = iconv('utf-8', 'gbk', $v);
        }
        fputcsv($fp, $row);
    }
    fclose($fp);
}

    public function export_sx(){
        // echo $_GET['kaishi'];exit;
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        // 输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="order.csv"');
        header('Cache-Control: max-age=0');

        $database_group_order = D('Group_order');
        $condition_group_category['mer_id'] = 890;//intval($_GET['mer_id'])



        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }
        $stmt = $database_group_order->field('order_name,price,total_money,num,express_id，add_time')->where($condition_group_category)->order('`order_id` DESC')->select();

        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        /*$where=array(
            "paid"=>1,
            "pay_type"=>array("NEQ","offline"),
            "status"=>array("lt",3),
        );*/
        //$mid=$this->merchant_session['mer_id'];
        //$where="mer_id=$mid";
        // $stmt = M("Group_order")->field("order_name,phone,add_time,price,total_money,payment_money,contact_name")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("商品名称","供货价","销售价","单量","是否发货","日期");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($stmt);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $stmt[$t];
            foreach ($row as $i => $v) {
                if($i=='add_time'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function export_xianxia(){
        // echo $_GET['kaishi'];exit;
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        // 输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="order.csv"');
        header('Cache-Control: max-age=0');

        $database_group_order = D('fast_order');




        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }
        $stmt = $database_group_order->field('order_name,price,total_money,add_time')->where($condition_group_category)->order('`order_id` DESC')->select();

        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        /*$where=array(
            "paid"=>1,
            "pay_type"=>array("NEQ","offline"),
            "status"=>array("lt",3),
        );*/
        //$mid=$this->merchant_session['mer_id'];
        //$where="mer_id=$mid";
        // $stmt = M("Group_order")->field("order_name,phone,add_time,price,total_money,payment_money,contact_name")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("商品名称","供货价","销售价","日期");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($stmt);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $stmt[$t];
            foreach ($row as $i => $v) {
                if($i=='add_time'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


    public function export_order(){
        // echo $_GET['kaishi'];exit;
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        // 输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="order.csv"');
        header('Cache-Control: max-age=0');

        $database_group_order = D('Group_order');
        $condition_group_category['mer_id'] = $_GET['mer_id'];
        $condition_group_category['paid'] = 1;

        $condition_where="";
        if(!empty($_GET['kaishi']) && !empty($_GET['jieshu'])){
            $ks=strtotime($_GET['kaishi']);
            $js=strtotime($_GET['jieshu']);
            $condition_where="and add_time BETWEEN '$ks' AND '$js'";

            $condition_group_category['add_time'] = array('between',''.$ks.','.$js.'');
        }
        $stmt = $database_group_order->field('order_name,price,total_money,num,express_id,add_time')->where($condition_group_category)->order('`order_id` DESC')->select();

        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        /*$where=array(
            "paid"=>1,
            "pay_type"=>array("NEQ","offline"),
            "status"=>array("lt",3),
        );*/
        //$mid=$this->merchant_session['mer_id'];
        //$where="mer_id=$mid";
        // $stmt = M("Group_order")->field("order_name,phone,add_time,price,total_money,payment_money,contact_name")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("商品名称","供货价","销售价","单量","是否发货","日期");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($stmt);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $stmt[$t];
            foreach ($row as $i => $v) {
                if($i=='add_time'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


    public function merlist(){

        $Merchant = D('Merchant');


        $condition_where="";
        if(!empty($_GET['keyword'])){

            $condition_where .= " AND name LIKE '%" . $_GET['keyword'] . "%'";

        }


        $count_group_category = $Merchant->where('mer_id !=629 and mer_id !=890 '.$condition_where)->count();


        import('@.ORG.system_page');
        $p = new Page($count_group_category,20);
        $category_list = $Merchant->field('mer_id,name')->where('mer_id !=629 and mer_id !=890 '.$condition_where)->order('`mer_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $database_group_order->getLastSql();

        $this->assign('category_list',$category_list);
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);






        $this->display();
    }

    public function order_list(){

        $database_group = D('Group_order');
        $condition_group['mer_id'] = $_GET['mer_id'];
        $condition_group['paid'] = 1;
        $mer_id=$_GET['mer_id'];
        $now_group = $database_group->field(true)->where($condition_group)->find();

        //echo $database_group->getLastSql();exit;
        if(empty($now_group)){
            $this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
        }
        $this->assign('now_group',$now_group);

        //商家信息
        $database_merchant = D('Merchant');
        $condition_merchant['mer_id'] = $now_group['mer_id'];
        $now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
        if(empty($now_merchant)){
            $this->error_tips('当前'.$this->config['group_alias_name'].'所属的商家不存在！');
        }
        $this->assign('now_merchant',$now_merchant);

        //订单列表
        $group_id = $now_group['group_id'];
        $condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`mer_id`='$mer_id' AND `o`.`paid`='1'";// 现在查询所有订单
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');

        $order_count = $database_group->where($condition_where)->table($condition_table)->count();
        import('@.ORG.system_page');
        $p = new Page($order_count,30);

        $order_list = $database_group->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        if(empty($order_list)){
            $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
        }
        $this->assign('order_list',$order_list);

        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);

        $this->display();
    }

    public function tixian(){

        $pigcms_bank_cash_info = D('bank_cash_info');
        $condition_group['mer_id'] = $_GET['mer_id'];
        $condition_group['status'] = 1;

        $condition_where="";
        if(!empty($_GET['keyword'])){

            $condition_where .= " AND name LIKE '%" . $_GET['keyword'] . "%'";

        }


        $count_group_category = $pigcms_bank_cash_info->where($condition_group)->count();


        import('@.ORG.system_page');
        $p = new Page($count_group_category,20);
        $category_list = $pigcms_bank_cash_info->field('merchant_real_name,merchant_real_telephone,bank_name,bank_card,cash_num,create_time')->where($condition_group)->order('`mer_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $pigcms_bank_cash_info->getLastSql();

        $this->assign('category_list',$category_list);
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);






        $this->display();
    }

    public function tixianxx(){

        $pigcms_bank_cash_info = D('fast_bank_cash_info');
        $condition_group['mer_id'] = $_GET['mer_id'];
        $condition_group['status'] = 1;

        $condition_where="";
        if(!empty($_GET['keyword'])){

            $condition_where .= " AND name LIKE '%" . $_GET['keyword'] . "%'";

        }


        $count_group_category = $pigcms_bank_cash_info->where($condition_group)->count();


        import('@.ORG.system_page');
        $p = new Page($count_group_category,20);
        $category_list = $pigcms_bank_cash_info->field('merchant_real_name,merchant_real_telephone,bank_name,bank_card,cash_num,create_time')->where($condition_group)->order('`mer_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        //echo $pigcms_bank_cash_info->getLastSql();

        $this->assign('category_list',$category_list);
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);


        $this->display();
    }


    public function export_tixian(){
        // echo $_GET['kaishi'];exit;
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        // 输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="order.csv"');
        header('Cache-Control: max-age=0');

        $database_group_order = D('bank_cash_info');
        $condition_group_category['mer_id'] = $_GET['mer_id'];
        $condition_group_category['status'] = 1;


        $stmt = $database_group_order->field('merchant_real_name,merchant_real_telephone,bank_name,bank_card,cash_num,create_time')->where($condition_group_category)->order('`id` DESC')->select();
        //echo $database_group_order->getLastSql(); exit;

        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("姓名","电话","银行名","卡号","提现金额","日期");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($stmt);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $stmt[$t];
            foreach ($row as $i => $v) {
                if($i=='create_time'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }


    public function export_tixianxx(){
        // echo $_GET['kaishi'];exit;
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        // 输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="order.csv"');
        header('Cache-Control: max-age=0');

        $database_group_order = D('fast_bank_cash_info');
        $condition_group_category['mer_id'] = $_GET['mer_id'];
        $condition_group_category['status'] = 1;


        $stmt = $database_group_order->field('merchant_real_name,merchant_real_telephone,bank_name,bank_card,cash_num,create_time')->where($condition_group_category)->order('`id` DESC')->select();
        //echo $database_group_order->getLastSql(); exit;

        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("姓名","电话","银行名","卡号","提现金额","日期");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($stmt);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $stmt[$t];
            foreach ($row as $i => $v) {
                if($i=='create_time'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

	
}