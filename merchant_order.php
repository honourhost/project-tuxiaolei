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

$row    =array('商品名称','订单id','客户备注','订单金额','数量','收件人姓名','手机','省','市','区','地址','自定义ID','group ID','下单时间','物流单号');
$filed  = array('order_name','s1','s2','payment_money','num','contact_name','phone','s3','s4','s5','adress','s6','group_id','add_time','express_id');
$unsend           = $_GET['unsend']           ? $_GET['unsend']           : 1;

$mer_id=$_GET['merid']? $_GET['merid'] : 0; //629;

$db = mysqli_connect('localhost','root','web24so123','xnd_o2ocms','3306');
if(! $db){
    echo '404！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}
if(!$_GET['merid']){
    echo  '农场id为空！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}elseif (!$_GET['storeid']){
    echo  '店铺id为空！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}
else{
    $condition_where = "`o`.`mer_id`=".$mer_id." AND `o`.`paid` = '1' ";
    if($_GET['find_type'] == 1 && strlen($find_value) == 14){
        $condition_where .= " AND `o`.`group_pass`=".$_GET['find_value'];
    }else{
        $condition_where .= " AND `o`.`store_id`= ".$_GET['storeid'];
        if($_GET['find_type'] == 1){
            $condition_where .= " AND `o`.`group_pass` like ".$_GET['find_value'];
        }else if($_GET['find_type'] == 2){
            $condition_where .= " AND `o`.`express_id` like ".$_GET['find_value'];
        }else if($_GET['find_type'] == 3){
            $condition_where .= " AND `o`.`order_id`= ".$_GET['find_value'];
        }else if($_GET['find_type'] == 4){
            $condition_where .= " AND `o`.`group_id`= ".$_GET['find_value'];
        }else if($_GET['find_type'] == 5){
            $condition_where .= " AND `o`.`uid`= ".$_GET['find_value'];
        }else if($_GET['find_type'] == 6){
            $condition_where .= " AND `O`.`contact_name` like ".$_GET['find_value'];
        }else if($_GET['find_type'] == 7){
            $condition_where .= " AND `o`.`phone` like   ".$_GET['find_value'];
        }
    }
    if($_GET['unsend']){
        $condition_where .= " AND `o`.`status` = 0 ";
    }

    $sql = 'SELECT * FROM `pigcms_group_order` AS `o` WHERE '.$condition_where;
   // echo $sql;

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
                switch (intval($row['delivery_type'])){
                    case 1:
                        $comment="工作日、双休日与假日均可送货";
                        break;
                    case 2:
                        $comment="只工作日送货";
                        break;
                    case 3:
                        $comment="只双休日、假日送货";
                        break;
                    case 4:
                        $comment="白天没人，其它时间送货";
                        break;
                }

                $tr .= '<td>&nbsp; '.$comment.'&nbsp;</td>';

            } elseif($v == 's3'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            }elseif($v == 's4'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's5'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's6'){
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif ($v=='add_time'){
                $tr .= '<td>'.date("Y-m-d H:i:s",$row[$v]).' </td>';
            }
            else{
                $tr .= '<td>'.$row[$v].'</td>';

            }

        }
        $tr .='</tr>';
    }
}

echo '<table>'.$tr.'</table>';

$db->close();

?>