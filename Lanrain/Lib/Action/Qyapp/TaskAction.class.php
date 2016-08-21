<?php
/**
*任务协作
**/
class TaskAction extends Action{
	public $logo;	
	public $copyright;
	function _initialize(){
			
			$data=M('Qywebsite')->where(array('uid'=>1))->find();
			if(empty($data['copyright'])){
				$this->copyright = '版权所有';
				$this->logo = '';			
			}else{
				$this->copyright = $data['copyright'];	
				$this->logo = $data['site_logo'];			
			}
			if(!isset($_GET['mid']) || empty($_GET['mid'])){
				$mymodule = M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>MODULE_NAME))->find();
				$_GET['mid'] = $mymodule['id'];
			}
			$this->assign('copyright',$this->copyright);	
			$this->assign('logo',$this->logo);	            		
	}
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Qyapp/Public/login'));
		}
	}	
		
	public function conf(){
	    if($_SESSION['username']==''){
			   $this->error('非法操作',U('Qyapp/Public/login'));
		}
		$count      = M('qytask')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qytask')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
		//print_r($data);exit;
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}	
	
	public function index(){
	    if($_SESSION['username']==''){
			   $this->error('非法操作',U('Qyapp/Public/login'));
		}
		$count      = M('qytask')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qytask')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
		//print_r($data);exit;
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}		
	
	
/**
*详情
**/
public function info(){
	$info=M('Qytask')->where(array('id'=>$_GET['id']))->find();
	//dump($info);
	$this->assign('info',$info);
	$this->display();
}

/*******************************任务协作手机部分*******************************************/
/**
*手机首页
**/

//任务列表  默认是我参与的任务
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
	
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
		}else{
			$check=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			if(empty($check)){
				$Member=A('Qyapp/Member');
				$meinfo=json_decode($Member->memberInfo_get($_GET['wecha_id'],$app['userid']),true);
				$infos=array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid'],
				'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			}
		}
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		//echo $user['name'];exit;
		$where=array('wecha_id'=>$_GET['wecha_id'],'helper'=>array('like','%'.$user['name'].';%'));
		//dump($where);exit;
		if($_GET['status']==3){
			$where['end_time']=array('ELT',time());//结束
		}else{
			$where['end_time']=array('EGT',time());//进行中
		}
		//dump($where);exit;
		$list = M('qytask')->where($where)->order('id desc')->select();
		//dump($list);exit;
		foreach($list as $k=>$v){
			$lists[$k]=$v;
			$lists[$k]['user']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('pic')->find();
		}
		$this->assign('list',$lists);
		//dump($list);
		$this->display();  
}



public function wap_index_one(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index_one');
		}else{
			$check=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			//dump($check);exit;
			if(empty($check)){
				$Member=A('Qyapp/Member');
				$meinfo=json_decode($Member->memberInfo_get($_GET['wecha_id'],$app['userid']),true);
				$infos=array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid'],
				'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			}
		}
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		$where=array('token'=>$_GET['token'],'helper'=>array('like','%'.$user['name'].';%'));
		if($_GET['status']==3){
			$where['end_time']=array('ELT',time());//结束
			$this->assign('status',3);
		}else{
			$where['end_time']=array('EGT',time());//进行中
			$this->assign('status',1);
		}
		if($_GET['type']){
			$where['order'] = $_GET['type'];
		}
		//dump($where);exit;
		$list = M('qytask')->where($where)->order('id desc')->select();
		//dump($list);exit;
		foreach($list as $k=>$v){
			$lists[$k]=$v;
			$lists[$k]['user']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('pic,name')->find();
		}
		$this->assign('list',$lists);
		//print_r($lists);exit;
		//dump($lists);exit;
		
		$this->display();  
}


//我负责的任务
public function wap_index_two(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index_two');
		}else{
			$check=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			if(empty($check)){
				$Member=A('Qyapp/Member');
				$meinfo=json_decode($Member->memberInfo_get($_GET['wecha_id'],$app['userid']),true);
				$infos=array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid'],
				'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			}
		}
		
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		// dump($user);exit;
		$where=array('fuzeren'=>$user['name'],'user_id'=>$app['userid']);
		//dump($where);exit;
		if($_GET['status']==3){
			$where['end_time']=array('ELT',time());//结束
			$this->assign('status',3);
		}else{
			$where['end_time']=array('EGT',time());//进行中
			$this->assign('status',1);
		}
		if($_GET['type']){
			$where['order'] = $_GET['type'];
		}
		$list = M('qytask')->where($where)->order('id desc')->select();
		//dump($list);exit;
		foreach($list as $k=>$v){
			$lists[$k]=$v;
			$lists[$k]['user']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('pic,name')->find();
		}
		// dump($lists);exit;
		$this->assign('list',$lists);
		$this->display();  
}




//我托付的任务
public function wap_index_three(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index_three');
	}else{
			$check=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			if(empty($check)){
				$Member=A('Qyapp/Member');
				$meinfo=json_decode($Member->memberInfo_get($_GET['wecha_id'],$app['userid']),true);
				$infos=array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid'],
				'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			}
	}
		$where=array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']);
		
		if($_GET['status']==3){
			$where['end_time']=array('ELT',time());//结束
			$this->assign('status',3);
		}else{
			$where['end_time']=array('EGT',time());//进行中
			$this->assign('status',1);
		}
		$type=$_GET['type'];
		if($type == 1){
		    $where['order']=1;
		}elseif($type == 2){
		    $where['order']=2;		
		}elseif($type == 3){
		    $where['order']=3;			
		}
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		$list = M('qytask')->where($where)->order('id desc')->select();
		$this->assign('user',$user);
		$this->assign('type',$type);		
		$this->assign('list',$list);
		$this->display();  
}




/**
*显示任务添加页面
**/
public function wap_add(){


	$lu=explode(',',$_SESSION['txid']);
		$str='';
		foreach($lu as $val){
			$name=M('Qyusers')->where(array('id'=>$val))->find();
			$str.=$name['name'].'|';
		}
		if($_GET['type']==1){
			$s=explode('|',$str);
			$_SESSION['task_1']=$s[0];
		}
		if($_GET['type']==2){
			$_SESSION['task_2']=$str;
		}
	$this->assign('str1',$_SESSION['task_1']);
	$this->assign('str2',$_SESSION['task_2']);		

	$this->display();
}



/**
*添加任务操作
*/ 
public function wap_add_task(){
	if(IS_POST){
		//F('ttt',$_POST);	
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
	    //dump($_POST);exit;
		$data = array();
		$data['user_id'] = $app['userid'];  	
		$data['wecha_id'] = $_GET['wecha_id'];  		 
		$data['fuzeren'] = trim($_POST['fuzeren']);		 //负责人
		$data['head'] = trim($_POST['head']);		 //负责人
		$data['helper'] = trim($_POST['helper']);  //协助人
		$data['follow'] = trim($_POST['follow']);  //协助人	
		$data['end_time'] = strtotime($_POST['end_time']);  //截止时间
		$data['order'] = $_POST['order'];	 //order//优先级 
		$data['content'] = trim($_POST['content']);	 //内容
		$data['mktime'] = time();	 //创建时间	
		//dump($data);exit;
		if($_POST['pic']){
			$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$save_dir = "./Uploads/Task/".$app['userid']."/".$_POST['wecha_id']."/";
			$cache = S('AccessToken');
			if($cache){
				$access_token = $cache;
			}else{
				$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
				S('AccessToken',$access_token,7140);
			}
			$pic = explode(',',$_POST['pic']);
			$fileUrl = '';
			foreach($pic as $v){
				if($v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					$picFind=M('Qytask_pic')->where(array('pic'=>$filePath))->find();
					if(!$picFind){
						$add = M('Qytask_pic')->add(array('pic'=>$filePath));
						if($add){
							$fileUrl .= $add.',';
						}
					}
				}
			}
			$data['pic'] = $fileUrl;
		}
		//F('rrrrrrrrrrrr',$data);
        if($id=M('qytask')->add($data)){
		    //print_r($data);exit;
			//群发消息
			//给负责人发信息
			$head=M('Qyusers')->where(array('id'=>$data['head']))->field('userid')->find();
			$Msg=A('Qyapp/Msg');
			$inin['touser']=$head['userid'];
			$inin['title']="您负责了一个协作任务";
			$inin['description']="请您点击进入完成";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Task&a=wap_act_info&id='.$id.'&wecha_id='.$_POST['wecha_id'].'&token='.$_POST['token'];
			$inin["agentid"]=$app['appid'];
			//$inin["userid"]=$app['userid'];
			//dump($head);dump($inin);dump($app);exit;
			$msg1=$Msg->msg_send_all($inin,$app['userid']);
			//F('$msg1',$msg1);
			if($msg1['errcode']==0){
				//给协同人发信息
				//$this->ajaxReturn(1);
				//F('$msg2',$msg1);
				//$us=explode(';',str_replace(';+','',$data['follow'].'+'));
				$us=array_filter(explode(';',$data['follow']));
				foreach($us as $k=>$v) {
					//$u=M('Qyusers')->where(array('id'=>$v))->field('userid')->find();
					//$uu.=$u['userid'].'|';
					$u=M('Qyusers')->where(array('id'=>$v))->field('userid')->find();
					$uu[$k] = $u['userid'];
				}
				//print_r($us);exit;
				//$fo['touser']=trim('|',$uu);
				
				$fo['touser']=implode('|',$uu);
				$fo['title']="您有一个任务协作任务需要完成";
				$fo['description']="请您点击进入完成";
				//$fo['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Task&a=wap_index_one&type='.$data['order'].'&status=1&token='.$_GET['token'];
				$fo['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Task&a=wap_act_info&id='.$id.'&wecha_id='.$_POST['wecha_id'].'&token='.$_POST['token'];
				$fo["agentid"]=$app['appid'];
				//F('ceshi222',$fo);
				$msgt=$Msg->msg_send_all($fo,$app['userid']);
				//F('arr333',$msgt);
				if($msgt['errcode']!=0){
					M('qytask')->where(array('id'=>$id))->delete();
					$this->ajaxReturn(8);
				}else{
					$this->ajaxReturn(2);
				}
			}else{
				M('qytask')->where(array('id'=>$id))->delete();
				$this->ajaxReturn(4);
			}
			
			//$this->redirect(U('wap_index_three',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>$data['order'])));			
			//$this->redirect(U('wap_index_three',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1)));				
		}else{
			$this->ajaxReturn(6);
			//$this->error('添加失败');
			//$this->redirect(U('wap_index_three',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1)));				
			
		}
	}else{
	
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Task';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_add_task');
			}
			
			$token=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
			$Jsssdk=A('Qyapp/Jsssdk');
			$jsssdk_info=$Jsssdk->wap_index($token['corpid'],$token['corpsecret'],$app);
			$this->assign('jsssdk_info',$jsssdk_info);
			//print_r($_SESSION);exit;
 		if($_GET['type']){
			$user=explode(';',$_SESSION['userlist'.$_GET['wecha_id']]);
			foreach($user as $v){
				if($v){
					$us['id'].=$v.'|';
					$users=M('Qyusers')->where(array('id'=>$v))->field('name')->find();
					$us['name'].=$users['name'].';';	
				}
			}
			$this->assign('follow',$us);
			//print_r($us);
			$choose=M('Qyusers')->where(array('id'=>$_SESSION['userc'.$_GET['wecha_id']]))->field('name,id')->find();
			$this->assign('order',$choose);
			//print_r($choose);exit;
		}else{
			$_SESSION['from']='';
			$_SESSION['ai']='';
			$_SESSION['c1'.$_GET['wecha_id']]='';
			$_SESSION['c2'.$_GET['wecha_id']]='';
			$_SESSION['delist'.$_GET['wecha_id']]='';
			$_SESSION['userlist'.$_GET['wecha_id']]='';
			$_SESSION['userc'.$_GET['wecha_id']]='';
		} 
		//print_r($_SESSION);exit;
	    $this->display();
	}
}

public function wap_act_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
	$info = M('qytask')->where(array('id'=>$_GET['id']))->find();
	$this->assign('data',$info);
	if($info['pic']){
		$picid = array_filter(explode(',',$info['pic']));
		$wheres['id'] = array('in',$picid);
		$picarr = M('Qytask_pic')->where($wheres)->select();
		//dump($picarr);exit;
		$this->assign('picarr',$picarr);
		
	}
	
	//任务记录
	//$where=array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']);
	$user=M('Qyusers')->where(array('userid'=>$info['wecha_id'],'user_id'=>$app['userid']))->find();
	$where['pid']=$_GET['id'];
	$where['user_id']=$app['userid'];
	$list = M('Qytask_record')->where($where)->order('id desc')->select();  

	foreach($list as $k=>$v){
		$lists[$k]=$v;
		$lists[$k]['info']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->find();
	}
	//dump($lists);exit;
	$this->assign('list',$lists);
	//dump($user);exit;
	$this->assign('user',$user);
		// print_r($lists);exit;
	//判断是否完成任务
	$is_finish=M('Qytask_record')->where(array('pid'=>$_GET['id'],'user_id'=>$app['userid'],'type'=>2,'wecha_id'=>$_GET['wecha_id']))->find();
	$this->assign('is_finish',$is_finish);
	
	$this->display(); 
}

//完成任务
public function finish(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
	if($_GET['wecha_id'] && $_GET['id']){
		$Qytask_record = M('Qytask_record')->where(array('pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
		if(!$Qytask_record){
			$data = array(
					'pid'=>$_GET['id'],
					'wecha_id'=>$_GET['wecha_id'],
					'user_id'=>$app['userid'],
					'type'=>2,
					'time'=>time());
			$result = M('Qytask_record')->add($data);
			if($result){
				$this->redirect(U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));	
			}else{
				$this->redirect(U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));	
			}
		}else{
			$this->error("非法操作！");	
		}
	}
	
}

/**
*讨论
*/
public function wap_act_discuz(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
	if(IS_POST){
	    //print_r($_POST);exit;
		//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
		$data = array();
		$data['user_id'] = $app['userid'];  		
		//$data = array();
		$data['token'] = $_POST['token'];
		$data['wecha_id'] = $_POST['wecha_id'];
		$data['content'] = $_POST['content'];
		$data['posttime'] = time();		
		$data['status'] = 1;
		$data['pid'] = $_GET['id'];
        $id = M('qytask_discuss')->add($data);
        if($id){
			M('Qytask_record')->add(array('pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'type'=>3,'time'=>time()));
		    $this->redirect(U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));		    
		}else{
		    $this->redirect(U('wap_act_discuz',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));		
		}		
		
	}else{
		$time=M('qytask_discuss')->where(array('status'=>1,'pid'=>$_GET['id']))->select();
		foreach($time as $k=>$v){
		   $times[$k] = $v;
		   $times[$k]['info']=M('qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->find(); 
		}
		$this->assign('time',$times); 
		$this->display(); 
	}

}

/**
*讨论列表
**/
public function wap_discuz_list(){
 	//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
	//$user_id = $app['userid']; 
	//$app=M('qyusers')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();	
//dump($_GET);	
	$time=M('qytask_discuss')->where(array('status'=>1,'pid'=>$_GET['id']))->select();
	//print_r($time);exit;
	$this->assign('time',$time); 
	$this->display(); 
}

/**
*任务列表
**/
public function wap_act_list(){
	$map['end_time']=array('gt',time());
	
	$time=M('qytask')->where(array('user_id'=>$_GET['wecha_id'],$map))->select();
	$this->assign('time',$time);
	$this->display(); 
}

/**
*消息中心
*/
public function wap_message(){
	$this->display(); 
}

public function wap_one_user(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_add_task');
		}	
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	$this->assign('users',$users);
	$this->display();
}

public function wap_all_user(){
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Task';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_add_task');
		}
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
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


function saveMedia($url,$dirname){
        $ch = curl_init($url);
		$header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
       
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);
        
        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time().rand(100,999).".{$fileExt}";
        //$dirname = "./Uploads/Announce/";
        if(!file_exists($dirname)){
            mkdir($dirname,0777,true);
        }
        file_put_contents($dirname.$filename,$media['mediaBody']);
        return $dirname.$filename;
    }



public function access_token($api,$secret,$agentid,$userid){
		if($api&&secret){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
			$json=json_decode($this->curlGet($url_get), true);
		}else{
			if($userid){
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$userid))->field('appid,userid')->find();
			}else{
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->field('appid,userid')->find();
			}
			$json=$this->access_token_get($appinfo['appid'],$appinfo['userid']);
		}
		return $json;
	}

function curlGet($url){
	$ch = curl_init();
	$header = "Accept-Charset: utf-8";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$temp = curl_exec($ch);
	return $temp;
}
function https_request($url, $data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}
}