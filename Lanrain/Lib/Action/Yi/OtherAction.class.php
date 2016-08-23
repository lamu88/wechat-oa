<?php
/*
*管理
*
*/

class OtherAction extends Action {

	public function _initialize() {
		if($_SESSION['uid']==''){
		   $this->error('非法操作',U('Yi/Public/login'));
		}
	}
    /**
	*首页
	**/
	public function linklist(){
		$where['uid']=$_SESSION['uid'];
		$count      = M('qywebsite_link')->where($where)->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = M('qywebsite_link')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		//dump($data);
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
	}
	public function addlink(){
		if(IS_POST){
			if($_POST['aid']){
				if(M('qywebsite_link')->where(array('id'=>$_POST['aid']))->save($_POST)){
				$this->success('修改成功!',U('linklist'));
				}else{
					$this->error('修改失败!');
				}
			}else{
				$_POST['uid']=$_SESSION['uid'];
				if(M('qywebsite_link')->add($_POST)){
				$this->success('添加成功!',U('linklist'));
				}else{
					$this->error('添加失败!');
				}
			}
		}else{
			$data = M('qywebsite_link')->where(array('id'=>$_GET['id']))->find();
			$this->assign('data',$data);
			$this->display();
		}
	
	}
	
	
	public function linkdel(){
	
		if(M('qywebsite_link')->where(array('id'=>$_GET['id']))->delete()){
			$this->success('删除成功!');
		}else{
			$this->success('删除失败!');
		}
	}

}