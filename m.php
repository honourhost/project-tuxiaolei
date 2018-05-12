<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        table{  border:0; cellspacing:0; cellpadding:0;}
        td{  border:1px solid #2F4F4F;}
    </style>
</head>
<body>
<?php

//http://www.xiaonongding.com/u.php?paid=1&group_id=820&begin_order_id=2834

$row    =array('商品名称','备注','订单状态','订单金额','数量','收件人姓名','手机','省','市','区','地址','自定义ID','group ID');
$filed  = array('order_name','s1','s2','payment_money','num','contact_name','phone','s3','s4','s5','adress','s6','group_id');
$paid           = $_GET['paid']           ? $_GET['paid']           : 1;
$group_id       = $_GET['group_id']       ? $_GET['group_id']       : 820;    //820;

$db = mysqli_connect('localhost','root','web24so123','xnd_o2ocms','3306');
if(! $db){
    echo '404！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}



    if($_GET['group_id'] ){
        $sql = 'SELECT * FROM `pigcms_group_order` WHERE `group_id` ='.$group_id.'  AND `paid` ='.$paid;

    }



$result = $db->query($sql);

echo '总订单数目：'.$result->num_rows;


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

?>