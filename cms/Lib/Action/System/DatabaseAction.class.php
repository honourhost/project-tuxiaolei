<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/13
 * Time: 14:16
 */
class DatabaseAction extends BaseAction{
    public function index(){
        $Db    = Db::getInstance();
        $list  = $Db->query('SHOW TABLE STATUS');
        $list  = array_map('array_change_key_case', $list);
        $title = '数据备份';
        //渲染模板
        $this->assign('meta_title', $title);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 备份数据库
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function export($tables = null, $id = null, $start = null){
        if(IS_POST && !empty($tables) && is_array($tables)){ //初始化
            //读取备份配置
            $config = array(
                'path'     => realpath("./data/") . DIRECTORY_SEPARATOR,
                'part'     => "20971520",
                'compress' => 1,
                'level'    => 9
            );

            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $this->error('检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                //创建锁文件
                file_put_contents($lock, NOW_TIME);
            }

            //检查备份目录是否可写
            is_writeable($config['path']) || $this->error('备份目录不存在或不可写，请检查后重试！');
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', NOW_TIME),
                'part' => 1,
            );
            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Database = new Database($file, $config);
            if(false !== $Database->create()){
                $tab = array('id' => 0, 'start' => 0);
                $this->success('初始化成功！', '', array('tables' => $tables, 'tab' => $tab));
            } else {
                $this->error('初始化失败，备份文件创建失败！');
            }
        } elseif (IS_GET && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = new Database(session('backup_file'), session('backup_config'));
            $start  = $Database->backup($tables[$id], $start);
            if(false === $start){ //出错
                $this->error('备份出错！');
            } elseif (0 === $start) { //下一表
                if(isset($tables[++$id])){
                    $tab = array('id' => $id, 'start' => 0);
                    $this->success('备份完成！', '', array('tab' => $tab));
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    $this->success('备份完成！');
                }
            } else {
                $tab  = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
                $this->success("正在备份...({$rate}%)", '', array('tab' => $tab));
            }

        } else { //出错
            $this->error('参数错误！');
        }
    }

    //上传FTP
    public function sendFtp(){
        $list=$this->listDir("./data/");
        if(!empty($list)) {
            //遍历上传到FTP服务器上
            //先连接FTP
            $conn_id = ftp_connect("116.255.142.2");
            if (!$conn_id) {
                $this->error("连接FTP服务器失败",U("Database/index"));
            }
            $login_result = ftp_login($conn_id, "shopkeeper-mysql-bak", "shopkeeper-mysql-bak");
            if (!$login_result) {
                $this->error("登录FTP失败",U("Database/index"));
            }
            //打开一个日志文件，用来存储上传日志信息
            $logfile = realpath("./data/log") . DIRECTORY_SEPARATOR . "log.log";
            $log = fopen($logfile, "a");
            foreach ($list as $k => $val) {
                $file = $val;
                $realpath = realpath("./data/") . DIRECTORY_SEPARATOR . $file;
                $fp = fopen($realpath, "r");
                if (ftp_fput($conn_id, $file, $fp, FTP_BINARY)) {
                    $result[] = $val . "上传成功！";
                    fclose($fp);
                    //成功之后删除文件
                    $del = unlink(realpath("./data/") . DIRECTORY_SEPARATOR . $val);
                    if ($del) {
                        fwrite($log, $val . "上传FTP成功并删除成功！\r\n");
                    } else {
                        fwrite($log, $val . "上传FTP成功但删除失败！\r\n");
                    }
                } else {
                    fclose($fp);
                    fwrite($log, $val . "上传FTP失败！\r\n");
                }
            }
            ftp_close($conn_id);
            fclose($log);
            $this->success("上传完成，具体上传情况请查看日志",U("Database/index"));
        }else{
            $this->error("当前数据库备份目录下没有文件",U("Database/index"));
        }
    }

    //遍历方法
    function listDir($dir)

    {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ((is_dir($dir . "/" . $file)) && $file != "." && $file != "..") {
                        continue;
                    } else {
                        if ($file != "." && $file != "..") {
                            $result[]=$file;
                        }
                    }
                }
            }
        }
        return $result;
    }
}