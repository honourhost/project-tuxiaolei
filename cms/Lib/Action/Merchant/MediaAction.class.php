<?php

class MediaAction extends BaseAction
{
    public function index()
    {
        $count = D('Source_media')->where(array('mer_id' => $this->merchant_session['mer_id']))->count('pigcms_id');
        import('@.ORG.merchant_page');
        $p = new Page($count, 10);
        $list = D('Source_media')->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();

        foreach ($list as &$l) {
            $l['dateline'] = date('Y-m-d H:i:s', $l['dateline']);
        }
        $this->assign('list', $list);
        $this->assign('page', $p->show());
        $this->display();
    }

    public function select_img()
    {
        $count = D('Source_media')->where(array('mer_id' => $this->merchant_session['mer_id']))->count('pigcms_id');
        $p = new Page($count, 10);
        $image_text = D('Image_text')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id asc')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->assign('list', $image_text);
        $this->assign('page', $p->show());
        $this->display();
    }

    public function del_image()
    {
        $pigcms_id = isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0;
        if ($data = D('Source_media')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find()) {
            D('Source_media')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->delete();
            $this->error('删除成功', U('Media/index'));
        } else {
            $this->error('不合法的操作');
        }
    }

    public function one()
    {
        if (IS_POST) {
            $pigcms_id = isset($_POST['pigcms_id']) ? intval($_POST['pigcms_id']) : 0;
            //$thisid = isset($_POST['thisid']) ? intval($_POST['thisid']) : 0;
            $data['content'] = isset($_POST['content']) ? fulltext_filter($_POST['content']) : '';
            $data['title'] = isset($_POST['title']) ? htmlspecialchars_decode($_POST['title']) : '';
            $data['author'] = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
            $data['url'] = isset($_POST['url']) ? ($_POST['url']) : '';
            $data['url_title'] = isset($_POST['url_title']) ? htmlspecialchars($_POST['url_title']) : '';
            $data['cover_pic'] = isset($_POST['cover_pic']) ? htmlspecialchars($_POST['cover_pic']) : '';
            $data['digest'] = isset($_POST['digest']) ? htmlspecialchars($_POST['digest']) : '';
            $data['is_show'] = isset($_POST['is_show']) ? intval($_POST['is_show']) : 0;
            $data['cat_id'] = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
            $data['cat_name'] = isset($_POST['cat_name']) ? htmlspecialchars($_POST['cat_name']) : '';


            if (!empty($_POST['video_url'])) {
                $data['video_url'] = $_POST['video_url'];
            }
            if (!empty($_POST['cat_id'])) {
                $data['cat_id'] = intval($_POST['cat_id']);
            }
            if (empty($data['classname'])) {
                $data['classid'] = 0;
            }
            if (empty($data['title'])) {
                $this->error('标题不能为空！');
            }
            if (empty($data['cover_pic'])) {
                $this->error('必须得有封面图！');
            }
            if (empty($data['content'])) {
                $this->error('内容不能为空！');
            }
            $data['dateline'] = time();
            $data['mer_id'] = $this->merchant_session['mer_id'];
            $data['dateline'] = time();
            if ($pigcms_id) {
                D('Source_media')->where(array('pigcms_id' => $pigcms_id))->data($data)->save($data);
                $this->success('编辑成功！');
            } else {
                D('Source_media')->data($data)->add();
                $this->success('新增成功！');

            }

        } else {
            $pigcms_id = isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0;
            $data = D('Source_media')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find();
            //查询分类
            $categories = M("Source_media_category")->select();
            $this->assign("categories", $categories);
            $this->assign('pigcms_id', $pigcms_id);
            $this->assign('data', $data);
            $this->display();
        }
    }


    public function multi()
    {
        if (IS_POST) {
            $ids = isset($_POST['imgids']) ? htmlspecialchars($_POST['imgids']) : '';
            $ids = explode(",", $ids);
            if (count($ids) > 10) {
                $this->error('最多十条图文');
            }

            $pigcms_id = isset($_POST['pigcms_id']) ? intval($_POST['pigcms_id']) : 0;
            if ($pigcms_id && ($data = D('Source_media')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find())) {
                D('Source_media')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->data(array('it_ids' => serialize($ids), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time(), 'type' => 1))->save();
                $this->success('编辑成功！');
            } else {
                D('Source_media')->data(array('it_ids' => serialize($ids), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time(), 'type' => 1))->add();
                $this->success('创建成功！');
            }
        } else {
            $this->display();
        }
    }

    public function editClass()
    {
        $db = D('Classify');
        $id = (int)$this->_get('id');
        $class = $db->where("token = '{$this->merchant_session['mer_id']}' AND fid = $id")->select();
        foreach ($class as $k => $v) {
            $fid = $v['id'];
            $class[$k]['sub'] = $db->where("token = '$this->merchant_session['mer_id']' AND fid = $fid")->field('id,name')->select();
            $class[$k]['pc_cat_id'] = 0;
        }
        $this->assign('class', $class);
        $this->display();
    }

    public function diytool()
    {
        $this->display();
    }
}