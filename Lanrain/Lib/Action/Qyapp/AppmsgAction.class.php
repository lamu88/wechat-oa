<?php
/*
*app msg
*
*/
class AppmsgAction extends Action {
	public $logo;	
	public $copyright;
/* 	function _initialize(){
			$data=M('Qywebsite')->where(array('uid'=>1))->find();
			if(empty($data['copyright'])){
				$this->copyright = '微易科技';
				$this->copyright = '';			
			}else{
				$this->copyright = $data['copyright'];	
				$this->logo = $data['site_logo'];			
			}
			$this->assign('copyright',$this->copyright);	//{lanrain:$copyright}
			$this->assign('logo',$this->logo);	            //{lanrain:$logo}		
	} */
	public function _initialize() {
		if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}
    public function conf(){
		if($_GET['mid']){
			$info=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->find();
			$this->assign('info',$info);
		}
		
		$this->display();
	}
	
	public function saveconf(){
	
		if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
			$checkda=M('Qymyapp')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
			if(M('Qymyapp')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->save(array('appid'=>$_POST['appid']))){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
			$checkda=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->find();
			$this->assign('data',$checkda);
			$this->display();
		}
	
	
	}
	
	
	public function reply_img(){
		if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
			$checkda=M('Qymyapp')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
			$_POST['imgurl']=str_replace('http://'. $_SERVER['SERVER_NAME'],'.',$_POST['imgurl']);
			if(M('Qymyapp')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->save(array('reply_img'=>$_POST['imgurl']))){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}
	
	}
	
	
}