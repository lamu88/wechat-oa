<?php
/*
*用户登录
*
*/

class PublicAction extends Action {

    /**
	*首页
	**/
	public function _initialize() {
		$webinfo=M('Qywebsite')->where(array('site_url'=>$_SERVER['SERVER_NAME']))->find();
		$this->assign('webinfo',$webinfo);
	}
	
	public function index(){
		
		$this->display();
	    
	
	}

    /**
	*用户登录
	**/
	public function checklogin(){
	  $db=M('Qytoken');
	  if(strstr($_POST['username'],'@')){
		//权限管理用户登录
		$arr=explode('@',$_POST['username']);
		$nodeuser=M('Group')->where(array('name'=>$arr[0],'uid'=>$arr[1],'pwd'=>md5($_POST['password'])))->find();
		if($nodeuser){
			$node=M('Group_list')->where(array('uid'=>$nodeuser['id']))->find();
			session('node',$node);
			session('node_id',$nodeuser['id']);
			$user=$db->where(array('id'=>$arr[1]))->find();
			$where['username']=$user['username'];
			$where['password']=$user['password'];
		}else{
			$this->error('权限用户登录失败',U('Weiyi/Weiyi/login'));
		}
	  }else{
			$where['username']=$_POST['username'];
			$where['password']=md5($_POST['password']);
	  }
	  $res=$db->where($where)->find();
	  if($res['zt']!=1){
	  if($res&&$res['endtime']>time()){
	       session('user_id',$res['id']);
		   session('username',$res['username']);
		   session('qyname',$res['qyname']);
		   session('contact',$res['contact']);
		   session('mp',$res['mp']);
		   session('industry',$res['industry']);
		   session('address',$res['address']);
		   session('corpid',$res['corpid']);
		   session('corpsecret',$res['corpsecret']);
		   session('host',$_POST['host']);
	       $this->success('登陆成功',U('Qyapp/Appslist/appList'));
	  }else{
	       $this->error('帐号已到期或者已关闭请联系管理员',U('Weiyi/Weiyi/login'));
	  }
	    
			}else{
			
			
	      $this->error('登陆失败',U('Weiyi/Weiyi/login'));
		  
			}
	}
    /**
	*用户注册
	**/	
	public function register(){
		$this->display();
	}
	   /**
	*注册识别
	**/	
	public function checkreg(){
	    $_POST['address']=$_POST['province3'].$_POST['city3'].$_POST['area3'];
		$_POST['industry']=$_POST['business'];
		$_POST['addtime']=time();
		//默认给平台默认使用15天
		//获取总后台配置
		$conf=M('Qywebsite')->where(array('site_url'=>$_SERVER['SERVER_NAME']))->find();
		if(strstr($_POST['username'],'@')){
			$this->error('登录id不能含有@符号',U('Weiyi/Weiyi/register'));
		}
		$_POST['endtime']=time()+$conf['day'];
		//dump($_POST);die();
		$zc=1;
		if($zc!=0){
			$db=D('Qytoken');
			if($db->create()){
				$id=$db->add();
				if($id){
					session('user_id',$id);
					session('username',$_POST['username']);
					session('qyname',$_POST['qyname']);
					session('contact',$_POST['contact']);
					session('mp',$_POST['mp']);
					session('industry',$_POST['industry']);
					session('address',$_POST['address']);
					$this->success('注册成功',U('Qyapp/Appslist/appList'));
				}else{
					$this->error('注册失败',U('Weiyi/Weiyi/register'));
				}
			}else{
				$this->error($db->getError(),U('Weiyi/Weiyi/register'));
			}
		}else{
		   $this->success('注册成功!请联系管理员开通！',U('Weiyi/Weiyi/login'));
		}
	}
    /**
	*用户退出
	**/	
	public function logout(){
		$this->display();	
	}
	
    /**
	*帮助
	**/	
	public function help(){
		$this->display();	
	}
	
    /**
	*套餐
	**/	
	public function service(){
	$this->display();	
	    
	
	}

    /**
	*代理
	**/	
	public function agent(){
	$this->display();	
	    
	
	}	
	
    /**
	*关于我们
	**/	
	public function about(){
	$this->display();	
	    
	
	}	
	
	
	public function checkpwd(){
		$where['username']=$this->_post('username');
		$db=D('Qytoken');
		$list=$db->where($where)->find();
		
		if($list==false) $this->error('用户名不正确！',U('Weiyi/Weiyi/forgotpwd'));
		$smtpserver = C('email_server'); 
		$port = C('email_port');
		$smtpuser = C('email_user');
		$smtppwd = C('email_pwd');
		$mailtype = "TXT";
		$sender = C('email_user');
		$smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$to = $list['email']; 
		$subject = C('pwd_email_title');
		$code = C('site_url').U('Weiyi/Weiyi/forgotpwd',array('uid'=>$list['id'],'code'=>md5($list['id'].$list['password'].$list['username']),'resettime'=>time()));
		$fetchcontent = C('pwd_email_content');
		$fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		$fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
		$fetchcontent = str_replace('{code}',$code,$fetchcontent);
		$body=$fetchcontent;
		$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
		$this->success('请访问你的邮箱 '.$list['username'].' 验证邮箱后登录!<br/>');
		
	}	

}