<?php


class OqueryAction extends BaseAction{
    public function index(){

		$database_group_order = D('Group_order');
		$condition_group_category['mer_id'] = 629;//intval($_GET['mer_id'])
		
		$count_group_category = $database_group_order->where($condition_group_category)->count();
        echo $database_group_order->getLastSql();
        echo $count_group_category;

		import('@.ORG.system_page');
		$p = new Page($count_group_category,50);
		$category_list = $database_group_order->field('order_name,price,total_money,num,express_id')->where($condition_group_category)->order('`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();

		$this->assign('category_list',$category_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);





        $this->display();
    }

	
}