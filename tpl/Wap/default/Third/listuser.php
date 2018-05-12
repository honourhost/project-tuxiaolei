<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        th {
            height: 40px;
            font-weight: bold;
            line-height: 40px;
            font-family: 微软雅黑;
            text-align: left;
            background: rgb(238, 243, 247);
            border-bottom: 1px solid rgb(213, 223, 232);
        }
    </style>
</head>
<body>

<table width="100%" cellspacing="0">
    <colgroup>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
    </colgroup>
    <thead style="    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;">
    <tr>
        <th>NO 编号</th>
        <th>NAME 姓名</th>
        <th>AGE 年龄</th>
        <th>SIZE 尺寸</th>
        <th>NATION 国籍</th>
        <th class="textcenter">HEIGHT 身高</th>
        <th class="textcenter">ADDTIME 填写时间</th>

    </tr>
    </thead>
    <tbody>
    <volist name="data" id="formdata">
        <tr>
            <td>{pigcms{$formdata.uid}</td>
            <td style="color:red;">{pigcms{$formdata.name}</td>
            <td style="color:red;">{pigcms{$formdata.age}</td>
            <td>{pigcms{$formdata.shirtsize}</td>
            <td>{pigcms{$formdata.nation}</td>
            <td class="textcenter">{pigcms{$formdata.height}</td>
            <td class="textcenter"><?php echo date("Y/m/d H:i:s",$formdata['addtime']);?></td>
        </tr>
    </volist>




    </tbody>
</table>

</body>
</html>