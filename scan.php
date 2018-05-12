<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>扫码支付商品汇总</title>
    <style>
        table{  border:0; cellspacing:0; cellpadding:0;}
        td{  border:1px solid #2F4F4F;}
    </style>
</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/8 0008
 * Time: 11:43
 */



$row    =array('商品名称','备注','订单状态','订单金额','数量','收件人姓名','手机','省','市','区','地址','自定义ID');
$filed  = array('order_name','s1','s2','payment_money','num','contact_name','phone','s3','s4','s5','adress','s6');
$paid           = $_GET['paid']           ? $_GET['paid']           : 1;
$group_id       = $_GET['group_id']       ? $_GET['group_id']       : 820;    //820;
$begin_order_id = $_GET['begin_order_id'] ? $_GET['begin_order_id'] : 2834;   //2834;

$db = mysqli_connect('localhost','root','web24so123','xnd_o2ocms','3306');
if(! $db){
    echo '404！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}
if($_GET['group_id'] &&  $_GET['begin_order_id']){
    $sql = 'SELECT * FROM `pigcms_group_order` WHERE `group_id` ='.$group_id.'  AND `paid` ='.$paid.' AND `order_id` >'.$begin_order_id;

}elseif($_GET['begin_order_id'] && !$_GET['group_id'] ){
    $sql = 'SELECT * FROM `pigcms_group_order` WHERE   `paid` ='.$paid.' AND `order_id` >'.$begin_order_id;

}else{
    $sql = 'SELECT * FROM `pigcms_group_order` WHERE   `paid` ='.$paid.' AND `is_scan` = 1';
}

$result = $db->query($sql);


if ($result->num_rows > 0) {
    // 输出每行数据
    $tr = '<tr>';
    foreach($row as $td ){  $tr .= '<td>'.$td.'</td>';  }
    $tr .= '</tr>';

    while($row = $result->fetch_assoc()) {
        $tr .='<tr>';
        foreach($filed as $k=>$v){
            if($v == 's1'){
                $tr .= '<td>&nbsp; '.$row['order_id'].'&nbsp;</td>';

            }elseif($v == 's2'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's3'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            }elseif($v == 's4'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's5'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's6'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } else{
                $tr .= '<td>'.$row[$v].'</td>';

            }

        }
        $tr .='</tr>';
    }
}

echo '<table>'.$tr.'</table>';

$db->close();

