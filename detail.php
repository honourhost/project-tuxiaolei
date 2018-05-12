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

$row    =array('商品名称','价格','商家id','销售数目','数量','group ID');
$filed  = array('s_name','price','mer_id','sale_count','count_num','group_id');


$db = mysqli_connect('localhost','root','web24so123','xnd_o2ocms','3306');
if(! $db){
    echo '404！'.'<br/>'.date('Y-m-d H:i').'<br/>';
}

$sql = 'SELECT * FROM `pigcms_group` WHERE `sale_count` >'.'0';
$result = $db->query($sql);

echo '统计数目：'.$result->num_rows;


//exit(json_encode($result->fetch_assoc()));

if ($result->num_rows > 0) {
    // 输出每行数据
    $tr = '<tr>';
    foreach($row as $td ){  $tr .= '<td>'.$td.'</td>';  }
    $tr .= '</tr>';

    while($row = $result->fetch_assoc()) {
        $tr .='<tr>';
        foreach($filed as $k=>$v){
            if($v == 's1'){
                exit("s1");
                $tr .= '<td>&nbsp; '.$row['order_id'].'&nbsp;</td>';

            }elseif($v == 's2'){
                exit("s1");
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's3'){
                exit("s1");
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            }elseif($v == 's4'){
                exit("s1");
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's5'){
                exit("s1");
                $tr .= '<td>&nbsp; &nbsp;&nbsp; </td>';

            } elseif($v == 's6'){
                exit("s1");
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