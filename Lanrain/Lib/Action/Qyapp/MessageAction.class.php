<?php
class MessageAction extends Action{
	
	public function index(){
		
		$list = M('Messages')->select();
		foreach($list as $k=>$v){
			$list[$k]['created_time'] = date('Y-m-d H:i:s',$v['created_time']);
		}
		
		$this->assign('list',$list);
		$this->display();
	}
	
	public function wap_index(){
		
		$list = M('Messages')->where(array('wecha_id'=>$_GET['wecha_id']))->select();
		foreach($list as $k=>$v){
			$list[$k]['created_time'] = date('Y-m-d H:i:s',$v['created_time']);
		}
		
		$this->assign('list',$list);
		$this->display();
	}
	
	public function submit(){
		if(IS_POST){
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['author'] = $_POST['wecha_id'];
			$data['created_time'] = time();
			$add = M('Messages')->add($data);
			if($add){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(2);
			}
		}
	}
	
	public function wap_message(){
		
		$this->display();
	}

}
?>
