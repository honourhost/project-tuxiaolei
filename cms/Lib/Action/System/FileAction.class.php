<?php
/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class FileAction extends BaseAction {

    /* 文件上传 */
    public function upload(){
		$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
		/* 调用文件上传组件上传文件 */
		$File = D('File');
		$info = $File->upload(
			$_FILES,
			C('DOWNLOAD_UPLOAD'),
			"",
			""
		);
        /* 记录附件信息 */
        if($info){
            $return['data'] = json_encode($info['download']);
            $return['info'] = $info['download']['name'];
        } else {
            $return['status'] = 0;
            $return['info']   = $File->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}
