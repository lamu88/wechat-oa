<?php
/*
*应用管理
*
*/
class AppAction extends Action {

	//应用中心
	public function appcenter(){
		$appList=M('Qyapplist')->where(array('install'=>1))->select();
		$this->assign('list',$appList);
		$this->display();
	}

	public function appinfo(){
		$info=M('Qyapplist')->where(array('id'=>$_GET['id']))->find();
		$this->assign('info',$info);
		$nodes=M('Qyusernode')->where(array('id'=>$info['vip']))->find();
		$this->assign('vip',$nodes);
		if($_GET['up']==1){
			$isinstall['up']=1;
			$isinstall['date']=date('Y-m-d',$_GET['time']);
		}
		$this->assign('isinstall',$isinstall);
		$this->display();
	}
	
	public function appvip(){
		if(IS_POST){
			if(M('Qyapplist')->where(array('id'=>$_POST['appid']))->save(array('vip'=>$_POST['vip']))){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		
		}else{
			$info=M('Qyapplist')->where(array('id'=>$_GET['id']))->find();
			$this->assign('info',$info);
			$nodes=M('Qyusernode')->where(array('uid'=>$_SESSION['uid']))->select();
			$this->assign('vip',$nodes);
			//dump($nodes);
			$this->display();
		}
		
	}
	//卸载
	public function appUnload(){
		if($_GET['appid']){
			if(M('Qyapplist')->where(array('id'=>$_GET['appid']))->save(array('install'=>0))){
				//echo $this-;
				$this->success('卸载成功!');
			}else{
				$this->error('卸载失败!');
			}
		}
	}
	//安装
	public function appUpload(){
		if(IS_POST){
			if(M('Qyapplist')->where(array('id'=>$_POST['appid']))->save(array('vip'=>$_POST['vip']))){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		
		}else{
			$info=M('Qyapplist')->where(array('id'=>$_GET['id']))->find();
			$this->assign('info',$info);
			$nodes=M('Qyusernode')->where(array('uid'=>$_SESSION['uid']))->select();
			$this->assign('vip',$nodes);
			//dump($nodes);
			$this->display();
		}
		
	}
	
	
	//套件
	public function suite(){
		$appList=M('Suiteid')->select();
		$this->assign('list',$appList);
		$this->display();
	}
	public function suite_list(){
		$appList=M('qyapplist')->where(array('suit_id'=>$_GET['id']))->select();
		$this->assign('list',$appList);
		$this->display();
	}
	
	
	//添加套件
	public function suite_add(){
		if(IS_POST){
/* 			if($_POST['id']){
				
			}else{
				$_POST['token']=$this->getToken(6).time();
				$_POST['apkey']=$this->getToken(43).time();
				$id=M('Suiteid')->add($_POST);
				if($id){
					$this->success('添加成功',U("App/suite"));
				}
			} */
				$id=M('Suiteid')->add($_POST);
				if($id){
					$this->success('添加成功',U("App/suite"));
				}else{
				    $this->error('添加失败');
				}			
		}else{
			if($_GET['id']){
				$data=M('Suiteid')->where(array('id'=>$_GET['id']))->find();
				$this->assign('data',$data);
			}
			$token=$this->getToken(6).time();
			$apkey=$this->getToken(43);
			$this->assign('token',$token);		
			$this->assign('apkey',$apkey);
			$this->display();
		
		
		}
	}
	
	//添加套件
	public function suite_save(){
		if(IS_POST){
			if($_POST['id']){
				
			
				//$_POST['token']=$this->getToken(6).time();
				//$_POST['apkey']=$this->getToken(43);
				$id=M('Suiteid')->where(array('id'=>$_GET['id']))->save($_POST);
				if($id){
					$this->success('添加成功',U("App/suite"));
				}
			}
		}else{
			if($_GET['id']){
				$data=M('Suiteid')->where(array('id'=>$_GET['id']))->find();
				$this->assign('data',$data);
			}
			$this->display();
		
		
		}
	}		

	//添加套件
	public function add_suit(){
		if(IS_POST){
            //print_r($_POST);exit;
		    if(M('qyapplist')->where(array('id'=>$_POST['appid']))->save(array('suit_id'=>$_POST['suit'],'suit_appid'=>$_POST['suit_appid']))){
			    echo json_encode(array('status'=>0));
			}else{
			    echo json_encode(array('status'=>1));
			}
		}else{
			$data=M('Suiteid')->select();
			$info = M('qyapplist')->where(array('id'=>$_GET['id']))->find();
			$this->assign('info',$info);
			$this->assign('data',$data);
			$this->display();
		
		
		}
	}	
	
/**
*删除
**/
public function suite_del(){
		//$data = M('Suiteid')->where(array('id'=>$_POST['id']))->find();
		if(M('Suiteid')->where(array('id'=>$_GET['id']))->delete()){
			$this->success('删除成功',U("App/suite"));
		}else{
		    $this->error('删除失败!');
		}
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