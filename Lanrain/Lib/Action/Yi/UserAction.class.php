<?php
/*
*前台用户管理
*
*/

class UserAction extends Action {

	public function _initialize() {
		if($_SESSION['uid']==''){
		   $this->error('非法操作',U('Yi/Public/login'));
		}
	}
    /**
	*首页
	**/
	public function userlist(){
		$where['uid']=$_SESSION['uid'];
		$count      = M('qytoken')->where($where)->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = M('qytoken')->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		//dump($data);
		foreach($data as $ke=>$va){
			$da[$ke]=$va;
			$da[$ke]['ty']=M('Qyusernode')->where(array('id'=>$va['type']))->find();
		}
		$this->assign('page',$show);
		$this->assign('data',$da);
		$this->display();
	    
	
	}
	public function useredit(){
		if(IS_POST){
			$_POST['endtime']=strtotime($_POST['endtime']);
			if($_POST['password']){
				$_POST['password']=md5($_POST['password']);
				
				if(M('Qytoken')->where(array('id'=>$_POST['userid']))->save($_POST)){
					$this->success('修改成功!',U('userlist'));
				}else{
					$this->error('修改失败!');
				}
			}else{
				unset($_POST['password']);
				if(M('Qytoken')->where(array('id'=>$_POST['userid']))->save($_POST)){
					$this->success('修改成功!',U('userlist'));
				}else{
					$this->error('修改失败!');
				}
			}
		}else{
			$data = M('Qytoken')->where(array('id'=>$_GET['id']))->find();
			$this->assign('data',$data);
			//用户等级
			$nodes=M('Qyusernode')->where(array('uid'=>$_SESSION['uid']))->select();
			//dump($nodes);
			$this->assign('node',$nodes);
			$this->display();
		}
	}
	
	public function config(){
	    if(IS_POST){
		
		}else{
			$this->display();		    
		}
	
	}
	
	//用户删除
	public function userdel(){
		//dump($_GET);
		if($_GET['id']){
			$id=M('Qytoken')->where(array('id'=>$_GET['id']))->delete();
			if($id){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
	}
	
	
	
	public function user_node(){
		if(IS_POST){
			//dump($_POST);die();
			$_POST['uid']=$_SESSION['uid'];
			if(M('Qyusernode')->add($_POST)){
				$this->success('修改成功!',U('userlist'));
			}else{
				$this->error('修改失败!');
			}
		}else{
			$data = M('Qyusernode')->where(array('uid'=>$_SESSION['uid']))->select();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	
	
	public function usernodeAdd(){
		if(IS_POST){
			if($_POST['aid']){
				$_POST['uid']=$_SESSION['uid'];
				if(M('Qyusernode')->where(array('id'=>$_POST['aid']))->save($_POST)){
					$this->success('修改成功!',U('user_node'));
				}else{
					$this->error('修改失败!');
				}
				
			}else{
				$_POST['uid']=$_SESSION['uid'];
				if(M('Qyusernode')->add($_POST)){
					$this->success('添加成功!',U('user_node'));
				}else{
					$this->error('添加失败!');
				}
			}
		}else{
			$data = M('Qyusernode')->where(array('id'=>$_GET['id']))->find();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	
	
	
	public function usernodeDel(){
		if(M('Qyusernode')->where(array('id'=>$_GET['id']))->delete()){
			$this->success('删除成功!');
		}else{
			$this->success('删除失败!');
		}
	}
	public function upfile(){
		if(IS_POST){
			$data=M('qyup_config')->where(array('uid'=>$_POST['uid']))->find();
			if($data){
				$data=M('qyip_config')->where(array('uid'=>$_POST['uid']))->save($_POST);
			}else{
				$data=M('qyup_config')->add($_POST);
			}
			if($data){
				$this->success('更新成功!');
			}else{
				$this->success('更新失败!');
			}
		
		}else{
			$data=M('qyup_config')->where(array('uid'=>$_GET['id']))->find();
			//dump($data);die;
			$this->assign('data',$data);
			$this->display();
		}
	}

	
}