<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FormList</title>
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

    <script type="text/javascript">
        var islock=false;
        function exportForm(){

            if(islock){
                alert('Exportting！');
                return false;
            }
            islock=true;
            window.location.href="{pigcms{:U('Third/exportGroup')}";

        }

    </script>

    <script type="text/javascript">
        var islock=false;
        function exportXLS(){

            if(islock){
                alert('Exportting！');
                return false;
            }
            islock=true;
            window.location.href="{pigcms{:U('Third/exportSN')}";

        }

    </script>
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
        <th>PHONE 联系电话</th>
        <th>EMAIL 邮箱</th>
        <th>Preferred language 倾向语言</th>
        <th class="textcenter">How know 从哪里获知</th>
        <th class="textcenter">Add time填写时间</th>
        <th>Party 参加</th>

    </tr>
    </thead>
    <tbody>
    <volist name="data" id="formdata">
        <tr>
            <td>{pigcms{$formdata.id}</td>
            <td style="color:red;">{pigcms{$formdata.username}</td>
            <td style="color:red;">{pigcms{$formdata.phone}</td>
            <td>{pigcms{$formdata.email}</td>
            <td>
                <switch name="formdata.tendlanuange" >
                    <case value="0" >English</case>
                    <case value="1">Chinese</case>
                </switch>
            </td>
            <td class="textcenter">
                <switch name="formdata.whereknow" >
                    <case value="0" >My kids go to QAIS. 我的孩子在青岛美亚国际学校就读(
                    <volist name="formdata.meiyastudent" id="student">
                       <span style="color: red;">name</span> :{pigcms{$student.name}  <span style="color: red;">grade</span>:{pigcms{$student.grade}|</h3>

                    </volist>
                        ）
                    </case>
                    <case value="1">I'm a staff member 我是青岛美亚国际学校老师</case>
                    <case value="2">I'm a guest 我是来访家长
                        <?php $how=explode(";",$formdata["wherehow"]);
                        echo "【";
                        if(count($how)>0){
                            foreach ($how as $k=>$v){
                                echo $v."-";
                            }
                        }else{

                        }
                        echo "】";
                        ?>
                    </case>
                </switch>
            </td>
            <td class="textcenter"><?php echo date("Y/m/d H:i:s",$formdata['addtime']);?></td>
            <td class="textcenter">
              <a href="{pigcms{:U('Third/listuser',array('formid'=>$formdata['id']))}">Party</a>
                <if condition="formdata.meiyauser neq null">
                    <volist name="formdata.meiyauser" id="myuser">
                    <span>{pigcms{$myuser.name}|</span>
                    </volist>
                    <else />
                    <span>no party</span>
                </if>


            </td>
        </tr>
    </volist>




    </tbody>
</table>
<button class="button" style="display: none;" onclick="exportForm()">Export CSV file</button>

<button class="button" onclick="exportXLS()">Export XLS file</button>

</body>
</html>