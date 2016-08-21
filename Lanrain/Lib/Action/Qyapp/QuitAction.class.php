<?php
/**
*离职管理
**/
class QuitAction extends Action{

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
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}

/**
*配置审核人
**/
public function index(){	
		$where['user_id'] = $_SESSION['user_id'];
		if(IS_POST){
		    //dump($_POST);exit;
			//用户名查询
			if($_POST['username'] != ''){
				$where['name'] = array('like',$_POST['username']);
				
				$count      = M('Qyquit_index')->where($where)->count();
				$Page       = new Page($count,15);
				$data = M('Qyquit_index')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
				foreach($data as $k=>$v){
					$dept=explode("-",$data[$k]['bumen']);
					$data[$k]['bumen']=implode("&nbsp;&nbsp;",$dept);
				}
				$show       = $Page->show();	
				$this->assign('data',$data);
				$this->assign('page',$show);
				$this->assign('username',$_POST['username']);
				$this->display();
				
			}
			//部门查询
			if($_POST['departname'] != ''){
				$departname=$_POST['departname'];
				$this->assign('departname',$departname);
				
				$str = explode(';', $_POST['departname']);
				$aa=sizeof($str);
				//判断是否多个部门进行搜索
				if($aa == 1){
					$strs=$_POST['departname'];
					$where['bumen']=array('like',array("%$strs%","%$strs","$strs%"),'or');
				}else{
					$str=implode("-",$str);
					$where['bumen']=array('like',array("%$str%","%$str","$str%"),'or');
				}
				$count      = M('Qyquit_index')->where($where)->count();
				$Page       = new Page($count,15);
				$data = M('Qyquit_index')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
				foreach($data as $k=>$v){
					$dept=explode("-",$data[$k]['bumen']);
					$data[$k]['bumen']=implode("&nbsp;&nbsp;",$dept);
				}
				$show       = $Page->show();	
				$this->assign('data',$data);
				$this->assign('page',$show);
				$this->assign('departname',$strs);
				$this->display();
				
			}
			//当用户名和部门空的时候按照时间查询
			if($_POST['username'] == '' && $_POST['departname'] == ''){
				if($_POST['reportrange'] != '' || $_POST['stop_times'] != ''){
					if($_POST['reportrange'] != '' && $_POST['stop_times'] != ''){
						$where['quit_time'] = array('between',array($_POST['reportrange'],$_POST['stop_times']));
					}
					$count      = M('Qyquit_index')->where($where)->count();
					$Page       = new Page($count,15);
					$data = M('Qyquit_index')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
					foreach($data as $k=>$v){
						$dept=explode("-",$data[$k]['bumen']);
						$data[$k]['bumen']=implode("&nbsp;&nbsp;",$dept);
					}
					$show       = $Page->show();	
					$this->assign('data',$data);
					$this->assign('page',$show);
					$this->display();
					
				}
			}
		}else{
			$count      = M('Qyquit_index')->where($where)->count();
			$Page       = new Page($count,15);
			$data = M('Qyquit_index')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach($data as $k=>$v){
				$dept=explode("-",$data[$k]['bumen']);
				$data[$k]['bumen']=implode("&nbsp;&nbsp;",$dept);
			}
			$show       = $Page->show();	
			$this->assign('data',$data);
			$this->assign('page',$show);
			$this->display();	
		}
}

/**
*配置审核人
**/
public function conf_man(){
	if(IS_POST){
		$users=array();
		$i=0;
		//print_r($_POST);exit;
/* 		foreach($_POST['level'] as $k=>$v){
			if($v['auditname']==1){  //直接上级
				$users[$i]=0;
			}else{  //指定人员
				$users[$i]=$v['auditname'];
			}
			$i++;
		} */
/* 		foreach($_POST['level'] as $k=>$v){
			if($v['auditname']==1){  //直接上级
				$users[$i]=0;
			}else{  //指定人员
 			    if(strstr($v['auditname'],'(')){
					$v['auditname'] = substr($v['auditname'],0,strpos($v['auditname'],'('));
					$users[$i]=$v['auditname'];				
				}else{
					$users[$i]=$v['auditname'];					
				} 
			}
			$i++;
		} */
		foreach($_POST['level'] as $k=>$v){
		    //$index = $k;
			if($v['auditselect']==1){  //直接上级
				$users[$i]=0;
			}else{  //指定人员
 			    if(strstr($v['auditname'],'(')){
					$v['auditname'] = substr($v['auditname'],0,strpos($v['auditname'],'('));
					$info = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$v['auditname'],'status'=>1))->find();
					if(!$info){
					    $this->error("你选择的审核人不存在，请选择正确的审核人");
					}
					$users[$i]=$v['auditname'];				
				}else{
				    $users[$i]=$v['auditname'];	
					//$this->error("你选择的审核人不正确，请选择正确的审核人");					
				} 
			}
			$i++;
		}		
		$data = array();
		$data['audit'] = serialize($users);  // 审核人
		$data['time'] = time();  // 审核添加时间
		$data['user_id'] = $_SESSION['user_id']; 
		$data['status'] = 1;   //报销是否冻结
		$check=M('Qyquit_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($check){
			M('Qyquit_config')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
		}
		$id = M('Qyquit_config')->add($data); 
		if($id){
		    $this->success('设置成功',U('Quit/conf_man')); 
		}else{
		    $this->error('设置失败');
		}		
	}else{
	    $check=M('Qyquit_config')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
		if($check){
		    $check['audit'] = unserialize($check['audit']);
		    $audit = json_encode($check['audit']);
			$this->assign('audit',$audit);
			//dump($audit);exit;
			$this->display('config');  //显示已配置
		}else{
			$this->display('unconfig');	//显示未配置
		}

	}
}



/**
*详情
**/
public function quitInfo(){
	$info=M('Qyquit_index')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_GET['id']))->find();
	$this->assign('data',$info);
	$this->display();
}


/*****************手机端********************/
/*
*首页
*/
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Quit';
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
		
	//默认首页显示我申请的离职
	$_GET['status'] ? $status=$_GET['status'] : $status=0;
	//echo $status;
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('position,name,pic')->find();
	$this->assign('user',$user);
	$list=M('Qyquit_index')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'status'=>$status))->select();
	$this->assign('list',$list);
		
	$this->display();
}


/*
*我的离职
*/
public function wap_list(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Quit';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_list');
		exit();
	}
	
	$_GET['status'] ?$status=$_GET['status'] : $status=0;
	//echo $status;
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('name,pic')->find();
	$this->assign('user',$user);
	$list=M('Qyquit_index')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'status'=>$status))->order('id desc')->select();
	$this->assign('list',$list);
	//dump($list);
	
	$this->display();
}

/*
*离职
*/
public function wap_holiday(){
	 $app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	 if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Quit';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_holiday');
		exit();
	}  
//用户信息、部门查询	
	$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();	
/*	 去除开头逗号、最后一个逗号函数：
     ltrim($str, ",");rtrim($str, ",");
*/	
	if($userinfo){
		$s_pid=rtrim($userinfo['pid'],";");
		$u=ltrim($s_pid, ";");
		$depart = explode(';', $u);
		$dept=implode(',',$depart);
		//$Depart=M('Department')->order('id desc')->where("id in(1365,1379)")->select();
		$Depart=M('Department')->where("id in($dept)")->select();
	//可这样输出部门信息	
		foreach($Depart as $k=>$v){
			$str[$k]=$v['name'];
		}
		$str=implode("&nbsp;&nbsp;",$str);
		$this->assign('Depart',$Depart);
	}
	$this->assign('userinfo',$userinfo);
	$this->display();
}

/**
*离职提交
**/
public function wap_holiday_post(){
	if(IS_POST){
		$is_esit=M('Qyquit_index')->where(array('wecha_id'=>$_POST['wecha_id']))->find();
		if($is_esit){
			echo json_encode(array('status'=>6));//查看申请过没
		}else{
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
			$_POST['user_id']=$app['userid'];
			$_POST['time']=time();
			$_POST['quit_time']=$_POST['endtime'];
		//用户信息、部门查询	
			$userinfo=M('Qyusers')->where(array('userid'=>$_POST['wecha_id']))->find();
			if($userinfo){
				if($userinfo['enable'] ==1){
					$_POST['name']=$userinfo['name'];
					$_POST['zhiwei']=$userinfo['position'];
				//得到所在的部门 一个或多个
					if($userinfo['pid'] != ''){
						$s_pid=rtrim($userinfo['pid'],";");
						$u=ltrim($s_pid, ";");
						$depart = explode(';', $u);
						$dept=implode(',',$depart);
						$Depart=M('Department')->where("id in($dept)")->select();
						foreach($Depart as $k=>$v){
							$str[$k]=$v['name'];
						}
						$str=implode("-",$str);//用 - 作为分开多个部门的标志
						if($str != ''){
							$_POST['bumen']=$str;
						}
					}
					
				}else{
					echo json_encode(array('status'=>7));//账号已被禁用
					exit;
				}
			}else{
				echo json_encode(array('status'=>8));//查看是否存在
				exit;
			}
			
			
			$id=M('Qyquit_index')->add($_POST);
			if($id){
				$checker=M('Qyquit_config')->where(array('user_id'=>$app['userid']))->find();
				if(!$checker){
					echo json_encode(array('status'=>2));//没有离职审核人
					exit();
				}
				$checkers=unserialize($checker['audit']);
				$i=1;
				foreach($checkers as $v){
					if($v==null){
						$node=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->field('pid')->find();
						$leader=M('Qy_node')->where(array('id'=>$node['pid']))->find();
						$v=$leader['node_user'];
					}
					if($v){
						$arr[$i]=$v;
						//添加审核人
						M('Qyquit_check')->add(array('user_one'=>$_POST['wecha_id'],'user_two'=>$v,'user_id'=>$app['userid'],'pid'=>$id,'time'=>time()));
						$i++;
					}
				}
				$_POST['check_now']=$arr[1];
				$_POST['check_order']=serialize($arr);
				//F('wwwww',$id);
				M('Qyquit_index')->where(array('id'=>$id))->save($_POST);
				//给所有用户发送审核信息
				$inin['touser']=implode('|',$arr);
				$Msg=A('Qyapp/Msg');
				$inin['title']="您有一个离职申请需要您查看";
				$inin['description']="请您点击进入查看详情";
				//F('eeee',$id);
				$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Quit&a=wap_holiday_info&wecha_id='.$_POST['wecha_id'].'&token='.$_POST['token'].'&pid='.$id;
				$inin["agentid"]=$app['appid'];
				$msg=$Msg->msg_send_all($inin,$app['userid']);
				//F('$inn',$inin);
				//F('$msg2',$msg);
				if($msg['errcode']==0){
					echo json_encode(array('status'=>1,'id'=>$id));//添加成功
				}else{
					M('Qyquit_index')->where(array('id'=>$id))->delete();
					echo json_encode(array('status'=>3));//群发失败审核人id不对
				}
			 }else{
				echo json_encode(array('status'=>0));//添加失败
			 }
		}
	}
}

/*
*离职详情
*/
public function wap_holiday_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Quit';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_holiday_info',$_GET['pid']);
			exit();
		}
	if($_GET['pid']){
		$record=M('Qyquit_index')->where(array('id'=>$_GET['pid']))->find();
		$this->assign('data',$record);
		//$info = M('qyquit_check')->where(array(''=>))->find();
		
		
		//$order=unserialize($record['check_order']);
		//if($_GET['wecha_id'] == $record['check_now']){
		//    $is_show = 1;
		//}else{
		//    $is_show = 1;
		//}
		//$this->assign('order',$order);
		//dump($order);
		
		$use=M('Qyusers')->where(array('userid'=>$record['wecha_id'],'user_id'=>$app['userid']))->find();
		$this->assign('user',$use);
		$check=M('Qyquit_check')->where(array('pid'=>$record['id']))->select();//已经审核记录
		//dump($check);exit;
		//F('$check2',$check);
		if($check){
			foreach($check as $k=>$v){
			    if($v['status'] != 0){
				$re[$k]=$v;
				$re[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_two'],'user_id'=>$app['userid']))->field('name,pic,position')->find();				
				}
				//F('$v2',$v);
				//F('$_GET2',$_GET);
				if($_GET['wecha_id'] == $record['check_now']){
				    if($v['status'] == 0){
					    $is_show = 1;
					}else{
					    $is_show = 0;
					}		   
				}else{
				    $is_show = 0;
				}
			}		
		}
        $this->assign('is_show',$is_show);
		//dump($check);exit;
		$this->assign('check',$re);
		$this->display();
	}
}

/*
*待审核
*/
public function wap_wait_check(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Quit';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_wait_check');
		exit();
	}
	
	
	$_GET['status'] ?$status=$_GET['status'] : $status=0;
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('name,pic')->find();
	$this->assign('user',$user);
	$list=M('Qyquit_check')->where(array('user_id'=>$app['userid'],'user_two'=>$_GET['wecha_id'],'status'=>$status))->order('id desc')->select();
	foreach($list as $k=>$v){
		$arr[$k]=$v;
		$arr[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_one'],'user_id'=>$app['userid']))->field('name,pic')->find();
		$arr[$k]['info']=M('Qyquit_index')->where(array('id'=>$v['pid']))->field('reason')->find();
		//$arr[$k]['users']=M('Qyquit_index')->where(array('id'=>$v['pid']))->find();
	}
	//print_r($arr);exit;
	$this->assign('list',$arr);
	$this->display();
}


/*
*离职详情
*/
public function wap_check_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Quit';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_holiday_info',$_GET['pid']);
			exit();
		} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Quit','wap_check_info',$_GET);	
	}	
    //F('$_GET3',$_GET);	
	if($_GET['pid']){
		//$checks=M('Qyquit_check')->where(array('id'=>$_GET['pid']))->find();
		$record=M('Qyquit_index')->where(array('id'=>$_GET['pid']))->find();
		//$record['types']=M('Qyquit_type')->where(array('id'=>$record['type']))->field('cname')->find();
		//F('$record',$record);
		$this->assign('data',$record);
		$use=M('Qyusers')->where(array('userid'=>$record['wecha_id'],'user_id'=>$app['userid']))->find();
		//F('$use',$use);
		$this->assign('user',$use);
		$check=M('Qyquit_check')->where(array('pid'=>$record['id'],'status'=>1))->select();//已经审核记录
		F('$check',$check);
		foreach($check as $k=>$v){
			$re[$k]=$v;
			$re[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_two'],'user_id'=>$app['userid']))->field('name,pic')->find();
		}
		//dump($_GET);
		//dump($re);exit;
		$this->assign('check',$re);
		$this->display();
	}
}


/**
*同意离职
**/

public function agree(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		//同意同时给下一个人发信息说明已经同意 同时判断当前审核员是否可以审核
		$record=M('Qyquit_index')->where(array('id'=>$_POST['pid']))->find();
		//F('$record1',$record);
		if($_POST['wecha_id']==$record['check_now']){
			$id=M('Qyquit_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>1,'time'=>time()));
			//F('$id',$id);
			if($id){
				$order=unserialize($record['check_order']);
				//F('$order',$order);
				// array(2) {
					  // [1] => string(6) "xtzlyp"
					  // [2] => string(8) "wangming"
					// }
				foreach($order as $k=>$v){
					if($v==$record['check_now']){
						$ne=$k;
					}
				}
				if($ne==count($order)){
					// //审核完成
					// M('')->where()->save();	
					$i=M('Qyquit_index')->where(array('id'=>$_POST['pid']))->save(array('status'=>1));
					if($i){
						$user_id=session('user_id');
						$data=M('Qyquit_index')->where(array('id'=>$_POST['pid']))->find();
						$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('appid,userid')->find();
						
						//$head=M('Qyusers')->where(array('userid'=>$data['wecha_id'],'user_id'=>$user_id))->field('userid,user_id')->find();
						
						$Msg=A('Qyapp/Msg');
						//$inin['touser']=$head['userid'];
						$inin['touser']=$data['wecha_id'];
						$inin['title']="管理员通过您的请求啦";
						$inin['description']="查看详情请点击此处";
						$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Quit&a=wap_list&token='.$_POST['token']."&wecha_id=".$data['wecha_id']."&id=".$_POST['pid']."&status=1";
						$inin["agentid"]=$app['appid'];
						//F('$inin11',$inin);
						$msg1=$Msg->msg_send_all($inin,$app['userid']);
						//F('$msg1',$msg1);
						if($msg1['errcode']==0){
							echo json_encode(array('status'=>1,id=>$record['id']));
						}else{
							echo json_encode(array('status'=>5));
						}
					}
					//echo json_encode(array('status'=>1));
				}else{
				    
					$next=$order[$ne+1];
					//F('$next',$next);
					$inin['touser']=$next;
					$Msg=A('Qyapp/Msg');
					$inin['title']="您有一个离职申请需要您查看";
					$inin['description']="请您点击进入查看详情";
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Quit&a=wap_check_info&token='.$_POST['token'].'&pid='.$_POST['pid'];
					$inin["agentid"]=$app['appid'];
					//F('$inin2',$inin);
					$msg2=$Msg->msg_send_all($inin,$app['userid'],$id);
					//F('$msg2',$msg2);
					if($msg2['errcode']==0){
						M('Qyquit_index')->where(array('id'=>$_POST['pid']))->save(array('check_now'=>$next));
						echo json_encode(array('status'=>1,'id'=>$record['id']));//t同意成功
					}else{
						echo json_encode(array('status'=>2));//同意失败
					}
				}
			}
		}else{
			echo json_encode(array('status'=>3));//您已经审核通过了
		}
	}
}

/*
*驳回
**/
public function out(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$record=M('Qyquit_index')->where(array('id'=>$_POST['pid']))->find();
		//F('$record',$record);
		//if($_POST['wecha_id']==$record['check_now']){
		    $res = M('Qyquit_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($res['status'] != 0){
			    echo json_encode(array('status'=>3));//您已经审核过了
			}else{
				$id=M('Qyquit_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>2,'time'=>time()));
				if($id){
					$next=$record['wecha_id'];
					$inin['touser']=$next;
					$Msg=A('Qyapp/Msg');
					$inin['title']="您的离职申请被驳回";
					$inin['description']="请您点击进入查看详情";
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Quit&a=wap_check_info&token='.$_POST['token'].'&pid='.$record['id'];
					$inin["agentid"]=$app['appid'];
					//F('$inin',$inin);
					$msg=$Msg->msg_send_all($inin,$app['userid'],$id);
					//F('$msg',$msg);
					if($msg['errcode']==0){
						M('Qyquit_check')->where(array('id'=>$_POST['pid']))->save(array('status'=>2));//驳回
						echo json_encode(array('status'=>1));//驳回成功
					}else{
						echo json_encode(array('status'=>2));//驳回失败
					}
				}			
			}

		//}else{
		//	echo json_encode(array('status'=>3));//您已经审核
		//}
	
	}


}





}