<?php
/*
*
*
*/
class AdminAction extends Action {
	public function _initialize() {
	
	
	
	
		if($_SESSION['uid']==''){
		   $this->error('非法操作',U('Yi/Public/login'));
		}
		$webinfo=M('Qywebsite')->where(array('site_url'=>$_SERVER['SERVER_NAME']))->find();
		$this->assign('webinfo',$webinfo);
	//	dump($webinfo);
	}
    /**
	*首页
	**/
	public function index(){
		$this->display();
	}
	public function login(){
		if($_POST){
			if(M(Qywebsite)->where(array('uid'=>$_SESSION['uid']))->save($_POST)){
				$this->success('设置成功');
			}else{
				$this->error('设置失败');
			}
		}else{
			$login=M('Qywebsite')->where(array('uid'=>$_SESSION['uid']))->find();
			$this->assign('login',$login);
			$this->display();
		}
	}
	
	public function website(){
	
	//	echo $_SERVER['SERVER_NAME']; 
		if($_POST){
		
			$_POST['day']=$_POST['day']*24*3600;
		
			$check=M('Qywebsite')->where(array('uid'=>$_SESSION['uid']))->find();

		
			if($check){
			    $_POST['uid']=$_SESSION['uid'];
				if(M('Qywebsite')->where(array('uid'=>$_SESSION['uid']))->save($_POST)){
						$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}
			}else{
				$_POST['uid']=$_SESSION['uid'];
				if(M('Qywebsite')->add($_POST)){
						$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}
			}
		}else{
			$data=M('Qywebsite')->where(array('uid'=>$_SESSION['uid']))->find();
			// dump($data);die;
			$data['day']=$data['day']/(24*3600);
			$this->assign('data',$data);
			$this->display();
		}
	}
	public function userinfo(){
		if(IS_POST){
			//dump($_POST);
			if($_POST['new_password']==$_POST['new_password_verify']){
				if($_POST['new_password']==$_POST['old_password']){
					$this->error('设置失败');
				}else{
					$check=M('Qyuser')->where(array('id'=>$_SESSION['uid'],'psd'=>md5($_POST['old_password'])))->find();
					if($check){
						if(M('Qyuser')->where(array('id'=>$_SESSION['uid']))->save(array('psd'=>md5($_POST['new_password'])))){
						$this->success('设置成功');
						}else{
							
							$this->error('设置失败');
						}
					}else{
						$this->error('原始密码错误');
					}
				}
				
				
			}else{
				$this->error('新密码验证失败');
			}
		
		}else{
			$this->display();
		}
		
	
	}
	

   

}