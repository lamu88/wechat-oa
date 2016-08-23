<?php
/*
*用户登录
*
*/

class PublicAction extends Action {

    /**
	*首页
	**/
	public function login(){
		//dump($_SESSION);
		$this->display();
	}

    /**
	*用户登录
	**/
	public function checklogin(){
	
	  $db=M('Qyuser');
	  $where['username']=$_POST['username'];
	  $where['psd']=md5($_POST['password']);
	  $res=$db->where($where)->find();
	  if($res){
	       session('uid',$res['id']);
		   session('uname',$res['username']);
	       $this->success('登陆成功',U('Yi/Admin/index'));
	  }else{
	       $this->error('账号或密码验证失败');
	  }	
	}
	
	public function loginout(){
		session('uid',null);
		session('uname',null);
		$this->redirect(U('Yi/Public/login'));
	}

	public function checkpwd(){
		$where['username']=$this->_post('username');
		$db=D('Qytoken');
		$list=$db->where($where)->find();
		
		if($list==false) $this->error('用户名不正确！',U('Qyapp/Public/forgotpwd'));
		$smtpserver = C('email_server'); 
		$port = C('email_port');
		$smtpuser = C('email_user');
		$smtppwd = C('email_pwd');
		$mailtype = "TXT";
		$sender = C('email_user');
		$smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$to = $list['email']; 
		$subject = C('pwd_email_title');
		$code = C('site_url').U('Qyapp/Public/forgotpwd',array('uid'=>$list['id'],'code'=>md5($list['id'].$list['password'].$list['username']),'resettime'=>time()));
		$fetchcontent = C('pwd_email_content');
		$fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		$fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
		$fetchcontent = str_replace('{code}',$code,$fetchcontent);
		$body=$fetchcontent;
		$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
		$this->success('请访问你的邮箱 '.$list['username'].' 验证邮箱后登录!<br/>');
		
	}	

}