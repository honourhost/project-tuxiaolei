<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/5/10
 * Time: 10:21
 */
class DownloadOrderAction extends BaseAction{
    public function index(){
        $this->display();
    }
    public function export(){
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    // 输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="order.csv"');
    header('Cache-Control: max-age=0');

    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    /*$where=array(
        "paid"=>1,
        "pay_type"=>array("NEQ","offline"),
        "status"=>array("lt",3),
    );*/
    $where="paid=1 AND sun_id is null AND pay_type <> 'offline' AND status<3";
    $stmt = M("Group_order")->field("order_id,order_name,num,price,total_money,contact_name,phone,zipcode,adress,wx_cheap,balance_pay,payment_money,tuan_type,pay_time,pay_type,third_id,is_mobile_pay,paid,status")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');

    // 输出Excel列名信息
    $head = array("订单号","订单名称","购买数量","单价","总价","联系人姓名","联系人电话","邮编","详细地址","微信优惠金额","余额支付金额","真实支付金额","特卖类型（2为实物）","支付时间","支付类型","第三方支付id","是否是手机支付","是否支付","订单状态");
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
       if($i=='pay_time'){
            $v=date("Y-m-d,H:i:s",$v);
       }
        $row[$i] = iconv('utf-8', 'gbk', $v);
    }
    fputcsv($fp, $row);
    }
        fclose($fp);
    }


    public function exportUnsend(){
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    // 输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="order.csv"');
    header('Cache-Control: max-age=0');

    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    /*$where=array(
        "paid"=>1,
        "pay_type"=>array("NEQ","offline"),
        "status"=>array("lt",3),
    );*/
    $where="paid=1 AND sun_id is null AND pay_type <> 'offline' AND status=0";
    $stmt = M("Group_order")->field("order_id,order_name,num,price,total_money,contact_name,phone,zipcode,adress,wx_cheap,balance_pay,payment_money,tuan_type,pay_time,pay_type,third_id,is_mobile_pay,paid,status")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');

    // 输出Excel列名信息
    $head = array("订单号","订单名称","购买数量","单价","总价","联系人姓名","联系人电话","邮编","详细地址","微信优惠金额","余额支付金额","真实支付金额","特卖类型（2为实物）","支付时间","支付类型","第三方支付id","是否是手机支付","是否支付","订单状态");
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
       if($i=='pay_time'){
            $v=date("Y-m-d,H:i:s",$v);
       }
        $row[$i] = iconv('utf-8', 'gbk', $v);
    }
    fputcsv($fp, $row);
    }
        fclose($fp);
    }


    public function exportPin(){
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    //输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="order.csv"');
    header('Cache-Control: max-age=0');

    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    
    $where="go.paid=1 AND go.sun_id is not null AND go.sun_id <> '' AND go.pay_type <> 'offline' AND go.status<3";
    $stmt = M("Group_order")->alias("go")->field("go.sun_id,go.order_id,go.order_name,go.num,go.price,go.total_money,go.contact_name,gbu.nickname,gbu.uid,go.phone,go.zipcode,go.adress,go.wx_cheap,go.balance_pay,go.payment_money,go.tuan_type,go.pay_time,go.pay_type,go.third_id,go.is_mobile_pay,go.paid,go.status")->join("INNER JOIN (SELECT gb.sun_id,u.nickname,u.uid FROM ".C("DB_PREFIX")."group_buy gb LEFT JOIN ".C("DB_PREFIX")."user u ON gb.user_id=u.uid WHERE gb.status=1) gbu ON go.sun_id=gbu.sun_id")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');

    // 输出Excel列名信息
    $head = array("拼团id","订单号","订单名称","购买数量","单价","总价","联系人姓名","团长昵称(昵称有乱码不显示)","团长id","联系人电话","邮编","详细地址","微信优惠金额","余额支付金额","真实支付金额","特卖类型（2为实物）","支付时间","支付类型","第三方支付id","是否是手机支付","是否支付","订单状态");
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
       if($i=='pay_time'){
            $v=date("Y-m-d,H:i:s",$v);
       }
        $row[$i] = iconv('utf-8', 'gbk', $v);
    }
    fputcsv($fp, $row);
    }
        fclose($fp);
    }

    public function exportUnsendPin(){
        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    //输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="order.csv"');
    header('Cache-Control: max-age=0');

    // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
    
    $where="go.paid=1 AND go.sun_id is not null AND go.sun_id <> '' AND go.pay_type <> 'offline' AND go.status=0";
    $stmt = M("Group_order")->alias("go")->field("go.sun_id,go.order_id,go.order_name,go.num,go.price,go.total_money,go.contact_name,gbu.nickname,gbu.uid,go.phone,go.zipcode,go.adress,go.wx_cheap,go.balance_pay,go.payment_money,go.tuan_type,go.pay_time,go.pay_type,go.third_id,go.is_mobile_pay,go.paid,go.status")->join("INNER JOIN (SELECT gb.sun_id,u.nickname,u.uid FROM ".C("DB_PREFIX")."group_buy gb LEFT JOIN ".C("DB_PREFIX")."user u ON gb.user_id=u.uid WHERE gb.status=1) gbu ON go.sun_id=gbu.sun_id")->where($where)->order("order_id DESC")->limit(1000)->select();
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');

    // 输出Excel列名信息
    $head = array("拼团id","订单号","订单名称","购买数量","单价","总价","联系人姓名","团长昵称(昵称有乱码不显示)","团长id","联系人电话","邮编","详细地址","微信优惠金额","余额支付金额","真实支付金额","特卖类型（2为实物）","支付时间","支付类型","第三方支付id","是否是手机支付","是否支付","订单状态");
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
       if($i=='pay_time'){
            $v=date("Y-m-d,H:i:s",$v);
       }
        $row[$i] = iconv('utf-8', 'gbk', $v);
    }
    fputcsv($fp, $row);
    }
        fclose($fp);
    }
}