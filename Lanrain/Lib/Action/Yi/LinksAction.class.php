<?php
class LinksAction extends Action{
	public function index(){
		$db=M('qywebsite_link');
		//F('links',null);
		$links=M('qywebsite_link')->select();
		$count=$db->count();
		$page=new Page($count,25);
		$info=$db->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($info as $k=>$v){
			$agency = M('Agency_list')->where(array('id'=>$v['agency_id']))->find();
			$info[$k]['username'] = $agency['name'];
		}
		$this->assign('info',$info);
		$this->assign('page',$page->show());
		$this->display();
	}
	
	public function edit(){
	if($_POST){
		$info=M(qywebsite_link)->where(array('id'=>$_POST['id']))->save($_POST);
			if($info){
				$this->success('操作成功');
			}else{
				$this->error('操作失败');
			}
	}else{
		$where['id']=$this->_get('id','intval');
		$info=M('qywebsite_link')->where($where)->find();
		$agency = M('Agency_list')->select();
		$this->assign('info',$info);
		$this->assign('agency',$agency);
		$this->display();
	}
	}
	
	public function add(){
	    if($_POST){
			$info=M(qywebsite_link)->add($_POST);
			if($info){
				$this->success('操作成功',U('add'));
			}else{
				$this->error('操作失败');
			}
	    }else{
			$level = M('Agency_list')->select();
			$this->assign('user',$level);
			$this->display();
		}
	}
	

	
	
	public function del(){
		$db=M('qywebsite_link');
		$id=$this->_get('id','intval');
		if($db->delete($id)){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	
}