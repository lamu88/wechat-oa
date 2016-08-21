<?php

class InstallAction extends Action {
	public function _initialize() {
		if($_SESSION['username']==''){
		
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		
		}
	}
	//第一步
    public function page_one(){
		if(IS_POST){
			$appInfo=$this->get_appinfo($_GET['id']);
			$checkdata=M('Qymyapp')->where(array('fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id']))->find();
			if(!$checkdata){
				//生成token值
				$token=$this->getToken(6).time();
				//生成EncodingAESKey
				$EncodingAESKey=$this->getToken(43);
				$id=M('Qymyapp')->add(array(
					'fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id'],
					'name'=>$appInfo['name'],'desc'=>$appInfo['desc'],
					'logo'=>$appInfo['logo'],'outh_host'=>'dexingky.wxopen.cn',
					'module'=>$appInfo['module'],'category'=>$appInfo['category'],
					'token'=>$token,'encodingkey'=>$EncodingAESKey
				));
				if($id){
					$this->redirect(U('page_two',array('id'=>$_POST['fun_id'])));
				}else{
					$this->redirect(U('page_one',array('id'=>$_POST['fun_id'])));
				}
				
			}else{
				$this->redirect(U('page_two',array('id'=>$_POST['fun_id'])));
			}
		}else{
			if($_GET['id']){
				$appInfo=$this->get_appinfo($_GET['id']);
				$this->assign('info',$appInfo);
			}
			$this->display();
		}
		
		
    }
	
	public function img_load(){
			//$basename="http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png";
			$basename=$_GET['file'];
			header('Content-type: image/png');
			header("Content-Disposition: attachment; filename=weiyi".time());
			//在header确保前面没有任何输出
			@readfile($basename);
			exit;
	}
	
	//第二步
	public function page_two(){
		if(IS_POST){
			//生成token值
			$appInfo=$this->get_appinfo($_GET['id']);
			$checkdata=M('Qymyapp')->where(array('fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id']))->find();
			if($checkdata){
				M('Qymyapp')->where(array('fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id']))->save(array('appid'=>$_POST['appid'],'outh_host'=>$_SERVER['SERVER_NAME']));
				$this->redirect(U('page_three',array('id'=>$_POST['fun_id'])));
			}else{
				$this->redirect(U('page_one',array('id'=>$_POST['fun_id'])));
			}
		}else{
			if($_GET['id']){
				$appInfo=$this->get_appmysql($_SESSION['user_id'],$_GET['id']);
				$this->assign('info',$appInfo);
			}
			$this->display();
		}
	
	}
	
	//第三步
	public function page_three(){
		if(IS_POST){
			$this->redirect(U('page_four',array('id'=>$_POST['fun_id'])));
		}else{
			if($_GET['id']){
				$appInfo=$this->get_appmysql($_SESSION['user_id'],$_GET['id']);
				$this->assign('info',$appInfo);
			}
			$this->display();
		}
	}
	
	//第四步
	public function page_four(){
		if(IS_POST){
			$this->redirect(U('page_five',array('id'=>$_POST['fun_id'])));
		}else{
			if($_GET['id']){
				$appInfo=$this->get_appmysql($_SESSION['user_id'],$_GET['id']);
				$this->assign('info',$appInfo);
			}
			$this->display();
		}
	}
	
	//第五步
	public function page_five(){
		if(IS_POST){
			$this->redirect(U('page_six',array('id'=>$_POST['fun_id'])));
		}else{
			if($_GET['id']){
				$appInfo=$this->get_appmysql($_SESSION['user_id'],$_GET['id']);
				$this->assign('info',$appInfo);
			}
			$this->display();
		}
	}
	
	//第六步
	public function page_six(){
		if(IS_POST){
			$checkdata=M('Qymyapp')->where(array('fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id']))->find();
			if($checkdata){
				$id=M('Qymyapp')->where(array('fun_id'=>$_POST['fun_id'],'userid'=>$_SESSION['user_id']))->save(array('status'=>1));
				//应用安装量加1
				M('Qyapplist')->where(array('id'=>$checkdata['fun_id']))->setInc('times',1);
				//安装过程中一键更新自定义菜单成官方菜单
				if(M('Qymenu')->where(array('userid'=>$_SESSION['user_id'],'appid'=>$checkdata['id']))->delete()){
					$class_list=M('App_class')->where(array('module'=>$checkdata['module']))->select();
					foreach($class_list as $v){
						M('Qymenu')->add(array(
							'user_id'=>$_SESSION['user_id'],
							'appid'=>$checkdata['id'],
							'name'=>$v['name'],
							'pid'=>0,
							'link'=>'http://'.$_SERVER['SERVER_NAME'].$v['url'].'&token='.$checkdata['token'],
							'type'=>'1'
						));
					}
				}
				$this->redirect(U('Appslist/appList'));
			}else{
				$this->error('安装失败');
			}
		}else{
			$this->display();
		}
	}
	
	function get_appmysql($userid='',$fun_id=''){
		$appInfo=M('Qymyapp')->where(array('userid'=>$userid,'fun_id'=>$fun_id))->find();
		return $appInfo;
	}
	
	
	function get_appinfo($id=1){
		$appInfo=M('Qyapplist')->where(array('id'=>$id))->find();
		return $appInfo;
	}
	
	function getToken($length){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];
		}
		return $str;
	}
	
}