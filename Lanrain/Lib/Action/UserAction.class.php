<?php
class UserAction extends BaseAction{
	protected function _initialize()
	{
		parent::_initialize();
		$userinfo=M('Qyusernode')->where(array('id'=>session('gid')))->find();
		$users=M('Qytoken')->where(array('id'=>$_SESSION['uid']))->find();
		$this->assign('thisUser',$users);
		//dump($users);
		$this->assign('viptime',$users['addtime']);
		if(session('uid')){
			
			if($users['addtime']<time())
			{
				session(null);
				session_destroy();
				unset($_SESSION);
				$this->error('您的帐号已经到期，请充值后再使用');
			}
		}
//		$wecha=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
//		$this->assign('wecha',$wecha);
//		$this->assign('token',session('token'));		
//		$this->assign('userinfo',$userinfo);
		 // if(session('uid')==false){
			 // $this->redirect('/index');
		 // }
	}
}