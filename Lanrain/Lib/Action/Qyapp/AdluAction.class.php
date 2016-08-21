<?php
/**
*通讯录
**/
class AdluAction extends Action{
public function index(){
    $this->check();
	$this->display();
}
public function appmanage(){
    $this->check();
	$this->display();
}	
public function wap_index(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$first=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>0))->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
		if(strstr($_SESSION['delist'.$_GET['wecha_id']],';'.$first['wxid'].';')){
			$this->assign('status',1);
		}
	}
	$this->assign('first',$first);
	$this->display();
}
public function wap_list(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$father=M('Department')->where(array('user_id'=>$app['userid'],'wxid'=>$_GET['id']))->find();
	$this->assign('father',$father);
	$listde=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->select();
	foreach($listde as $k=>$v){
		$arr[$k]=$v;
		if(strstr($_SESSION['delist'.$_GET['wecha_id']],$v['wxid'])){
			$arr[$k]['is']=1;
		}
	}
	$this->assign('de',$arr);
	$this->display();
}


public function wap_all(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	foreach($users as $k=>$v){
		if($v['name']){
			$arr[$k]=$v;
			if(strstr($_SESSION['userlist'.$_GET['wecha_id']],$v['id'])){
				$arr[$k]['is']=1;
			}
		}
	}
	$this->assign('users',$arr);
	$this->display();
}

public function wap_users(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
 	foreach($users as $k=>$v){
		if($v['name']){
			$arr[$k]=$v;
			//if(strstr($_SESSION['userlist'.$_GET['wecha_id']],$v['id'])){
			//	$arr[$k]['is']=1;
			//}
		}
	} 
	//print_r($arr);exit;
	//$this->assign('users',$users);
	$this->assign('users',$arr);
	$this->display();
}
//抄送人
public function wap_logsusers(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	foreach($users as $k=>$v){
		if($v['name']){
			$arr[$k]=$v;
			if(strstr($_SESSION['userlist'.$_GET['wecha_id']],$v['id'])){
				$arr[$k]['is']=1;
			}
		}
	}
	$this->assign('users',$arr);
	$this->display();
}

public function wap_depart(){
    //echo 'aaa';exit;
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//dump($app);exit;
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
		$_SESSION['date']=$_GET['date'];
	}
	$map['user_id']=$app['userid'];
	$department=M('department')->where($map)->field('name,id')->select();
	//dump($department);
	$this->assign('department',$department);
	//dump($department);exit;
	$this->display();
}
//获取部门，根据部门id获取成员，
public function wap_depart2(){
    //echo 'aaa';exit;
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//dump($app);exit;
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
		$_SESSION['date']=$_GET['date'];
	}
	$map['user_id']=$app['userid'];
	$department=M('department')->where($map)->field('name,id,wxid')->select();
	//dump($department);
	$this->assign('department',$department);
	// dump($department);exit;
	$this->display();
}
//根据部门id 而获取成员
public function wap_usedepartousers(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	if($_GET['pid']){
		$department=M('department')->where(array('user_id'=>$app['userid'],'wxid'=>$_GET['pid']))->field('name')->find();
		// echo $department['name'];exit;
		$map['pid']=array('like','%'.$_GET['pid'].'%');
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic,position')->select();
	foreach($users as $k=>$v){
		if($v['name']){
			$arr[$k]=$v;
			if(strstr($_SESSION['userlist'.$_GET['wecha_id']],$v['id'])){
				$arr[$k]['is']=1;
			}
		}
	}
	$this->assign('department',$department['name']);
	$this->assign('users',$arr);
	$this->display();
}


public function wap_all_one(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
		$_SESSION['date']=$_GET['date'];
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	$this->assign('users',$users);
	$this->display();
}


public function wap_all_go(){
	$_SESSION['userc'.$_GET['wecha_id']]=$_GET['id'];
	$this->redirect($_SESSION['from'].'/'.$_SESSION['ai'],array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_SESSION['aid'],'date'=>$_SESSION['date'],'type'=>2));

}

public function userinfo(){
	$user=M('Qyusers')->where(array('id'=>$_GET['id']))->find();
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$this->assign('user',$user);
	$pid=explode(';',$user['pid']);
	 foreach($pid as $k=>$v){
		 $infos=M('Department')->where(array('wxid'=>$v,'user_id'=>$app['userid']))->field('name')->find();
		 $str.=$infos['name'];
	 }
	// dump($str);
	 $this->assign('str',$str);
	$this->display();
}	

public function post(){
	if(IS_POST){
	//部门多个存session
		if($_SESSION['delist'.$_POST['wecha_id']]){
			$se=$_SESSION['delist'.$_POST['wecha_id']];
			if(strstr($se,";".$_POST['wxid'].";")){
				$_SESSION['delist'.$_POST['wecha_id']]=str_replace(";".$_POST['wxid'],'',$_SESSION['delist'.$_POST['wecha_id']]);
				echo json_encode(array('status'=>2));
			}else{
				$_SESSION['delist'.$_POST['wecha_id']]=$_SESSION['delist'.$_POST['wecha_id']].$_POST['wxid'].";";
				echo json_encode(array('status'=>1));
			}
		}else{
			$_SESSION['delist'.$_POST['wecha_id']]=";".$_POST['wxid'].";";
			echo json_encode(array('status'=>1));
		}
	}
}


public function postUser(){
	if(IS_POST){
		if($_SESSION['userlist'.$_POST['wecha_id']]){
			$se=$_SESSION['userlist'.$_POST['wecha_id']];
			if(strstr($se,";".$_POST['userid'].";")){
				$_SESSION['userlist'.$_POST['wecha_id']]=str_replace(";".$_POST['userid'],'',$_SESSION['userlist'.$_POST['wecha_id']]);
				echo json_encode(array('status'=>2));
			}else{
				$_SESSION['userlist'.$_POST['wecha_id']]=$_SESSION['userlist'.$_POST['wecha_id']].$_POST['userid'].";";
				echo json_encode(array('status'=>1));
			}
		}else{
			$_SESSION['userlist'.$_POST['wecha_id']]=";".$_POST['userid'].";";
			echo json_encode(array('status'=>1));
		}
	}
}



}