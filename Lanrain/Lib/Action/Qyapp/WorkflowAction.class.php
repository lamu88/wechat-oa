<?php
/**
*流程审批
**/
class WorkflowAction extends Action{
	public $logo;	
	public $copyright;
	function _initialize(){
		$data=M('Qywebsite')->where(array('uid'=>1))->find();
		if(empty($data['copyright'])){
			$this->logo = '';			
		}else{
			$this->logo = $data['site_logo'];			
		}
		if(!isset($_GET['mid']) || empty($_GET['mid'])){
			$mymodule = M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>MODULE_NAME))->find();
			$_GET['mid'] = $mymodule['id'];
		//	echo $_GET['mid'];exit;
		}	
		$this->assign('logo',$this->logo);	            		
	}
	
	private function check(){
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
	
/**
*自定义流程
**/
public function index(){
    $this->check();
	//dump($_SESSION);
	$count      = M('qyworkflow')->where(array('user_id'=>$_SESSION['user_id']))->count();
	$Page       = new Page($count,15);
	$data = M('qyworkflow')->order('time desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
	$show       = $Page->show();

	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}

/**
*自定义流程
**/
public function conf(){
    $this->check();
	//dump($_SESSION);
	$count      = M('qyworkflow')->where(array('user_id'=>$_SESSION['user_id']))->count();
	$Page       = new Page($count,15);
	$data = M('qyworkflow')->order('time desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
	$show       = $Page->show();
	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}

/**
*新增自定义流程
**/
public function add(){
    $this->check();
    if(IS_POST){
		//dump($_POST);die();
 	     if(!$_POST['flow_name']){
		     $this->error('请填写流程名称');
		 }
	     if(!$_POST['departid']){
		     $this->error('请填写流程人员范围');
		 }		
	     if(!$_POST['field']){
		     $this->error('请添加自定义字段的内容');
		 }
		 //print_r($_POST);exit;
		//处理添加字段
		$fields=array();
		$n=0;
		foreach($_POST['field'] as $k=>$v){
			$fields[$n]['name'] = $v['name'];
			$fields[$n]['type'] = $v['type'];
			if($v['status']){
			    //$fields[$n]['status']=1;
				$fields[$n]['status']='on';
			}else{
			    //$fields[$n]['status']=0;
				$fields[$n]['status']='off';
			}
			if($v['info']){
			    $fields[$n]['info'] = $v['info'];
			}else{
			    $fields[$n]['info']='';
			}			
			$n++;
		}		
		//print_r($fields);exit;
 		$data['name'] = trim($_POST['flow_name']);  //流程名称
		$data['department'] = trim($_POST['departid']);  //流程人员范围
		$data['name_defined'] = serialize($fields);  //添加字段并序列化
		//遍历审核人的userid
		$users=array();
		$i=0;
/* 		foreach($_POST['level'] as $k=>$v){
			if($v['auditname'] == 1){
			    //$users[$i]['auditselect'] = '';  //select框选中项
			    //$users[$i]['auditselect'] = 0;
				$users[$i]['auditname'] = 1;			
			}else{
			    $users[$i]['auditname'] = $v['auditname'];
				$users[$i]['auditselect'] = $v['auditselect'];	
 			    //if(strstr($v['auditname'],'(')){
				//	$v['auditname'] = substr($v['auditname'],0,strpos($v['auditname'],'('));
				//	$users[$i]=$v['auditname'];				
				//}else{
				//	$users[$i]=$v['auditname'];					
				//} 				
			}
			$i++;
		} */
		foreach($_POST['level'] as $k=>$v){
		    $index = $k;
			if($v['auditname']==1){  //直接上级
				$users[$i]['auditname'] = 1;
			}else{  //指定人员
 			    if(strstr($v['auditselect'],'(')){
				    //echo $v['auditselect'];
					$v['auditselect'] = substr($v['auditselect'],0,strpos($v['auditselect'],'('));
					//echo $v['auditselect'];exit;
					$info = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$v['auditselect'],'status'=>1))->find();
					//print_r($info);
					//print_r($info);exit;
					if(!$info){
					    $this->error("你选择的审核人不存在，请选择正确的审核人");
					}
					$users[$i]['auditname'] = $v['auditname'];
					$users[$i]['auditselect']=$v['auditselect'];				
				}else{
				    $users[$i]['auditname'] = $v['auditname'];
				    $users[$i]['auditselect'] = $v['auditselect'];
					//$this->error("你选择的审核人不正确，请选择正确的审核人");					
				} 
			}
			$i++;
		}		
		//print_r($users);exit;
		$data['examine'] = serialize($users);  // 审核人
		$data['time'] = time();  // 流程添加时间
		$data['user_id'] = $_SESSION['user_id']; 
		$data['status'] = 1; 
		$data['icon'] = $_POST['icon']; 
		$id = M('qyworkflow')->add($data);
		if($id){
		    $this->success('添加成功',U('Workflow/index',array('mid'=>$_GET['mid'])));
		}else{
		    $this->error('添加失败');
		}
	}else{
		$this->display();		
	}
}

/**
*应用管理
**/
public function appmanage(){
    $this->check();
	$this->display();
}

/**
*详情
**/
public function edit(){
    
    $this->check();
	$user_id = $_SESSION['user_id']; 	
	if(IS_POST){
	     //print_r($_POST);exit;
 	     if(!$_POST['flow_name']){
		     $this->error('请填写流程名称');
		 }
	     if(!$_POST['departid']){
		     $this->error('请填写流程人员范围');
		 }		
	     if(!$_POST['field']){
		     $this->error('请添加表单字段');
		 }
		//处理添加字段
		$fields=array();
		$n=0;
		foreach($_POST['field'] as $k=>$v){
			$fields[$n]['name'] = $v['name'];  //字段名称
			$fields[$n]['type'] = $v['type'];  //字段类型
			if($v['status']){  //是否必填，1为必填0为不填
			    //$fields[$n]['status']=1;  
				$fields[$n]['status']='on';
			}else{
			    //$fields[$n]['status']=0;
				$fields[$n]['status']='off';
			}
			if($v['info']){  //下拉框内容
			    $fields[$n]['info'] = $v['info'];
			}else{
			    $fields[$n]['info']='';
			}			
			$n++;
		}		
 		$data['name'] = trim($_POST['flow_name']);  //流程名称
		$data['department'] = trim($_POST['departid']);  //流程人员范围
		$data['name_defined'] = serialize($fields);  //添加字段并序列化
		//遍历审核人的userid
		$users=array();
		$i=0;
/* 		foreach($_POST['level'] as $k=>$v){
			if($v['auditname'] == 1){
			    //$users[$i]['auditselect'] = '';  //select框选中项
			    //$users[$i]['auditselect'] = 0;
				$users[$i]['auditname'] = 1;			
			}else{
			    $users[$i]['auditname'] = $v['auditname'];
				$users[$i]['auditselect'] = $v['auditselect'];	
			}
			$i++;
		} */
		foreach($_POST['level'] as $k=>$v){
		    $index = $k;
			if($v['auditname']==1){  //直接上级
				$users[$i]=0;
			}else{  //指定人员
 			    if(strstr($v['auditselect'],'(')){
					$v['auditselect'] = substr($v['auditselect'],0,strpos($v['auditselect'],'('));
					$info = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$v['auditselect'],'status'=>1))->find();
					if(!$info){
					    $this->error("你选择的审核人不存在，请选择正确的审核人");
					}
					//$users[$i]=$v;	
					$users[$i]['auditname'] = $v['auditname'];
					$users[$i]['auditselect']=$v['auditselect'];					
				}else{
				    $users[$i]['auditname'] = $v['auditname'];
				    $users[$i]['auditselect'] = $v['auditselect'];				
					//$this->error("你选择的审核人不正确，请选择正确的审核人");					
				} 
			}
			$i++;
		}
        //print_r($user);exit;		
		$data['examine'] = serialize($users);  // 审核人
		$data['user_id'] = $user_id;  	
		$data['icon'] = $_POST['icon'];  
	    $id = M('qyworkflow')->where(array('user_id'=>$user_id,'id'=>$_POST['id']))->save($data);
		if($id){
		    $this->success('修改成功',U('Workflow/index',array('mid'=>$_GET['mid'])));
		}else{
		    $this->error('修改失败');
		}		
	}else{
	    $id = $this->_get('id');
	    $data = M('Qyworkflow')->where(array('user_id'=>$user_id,'id'=>$id))->find();
		$ids = explode(',',$data['department']);
		foreach($ids as $k=>$v){
			$depart = M('department')->where(array('id'=>$v))->find();
			$departname[] = $depart['name'];
			$departid[] = $depart['id'];
		}
		$data['departid'] = implode(',',$departid);
		$data['departname'] = implode(',',$departname);
		$_fields = unserialize($data['name_defined']);
		$_audit = unserialize($data['examine']);
		$fields = json_encode($_fields);
		$audit = json_encode($_audit);	
	    $this->assign('fields',$fields);
	    $this->assign('audit',$audit);	
	    $this->assign('data',$data);			
	    $this->display();	
	}

}

/**
*删除
**/
public function del(){
    $this->check();
		if(IS_POST){
		$data = M('Qyworkflow')->where(array('id'=>$_POST['id']))->find();
		if(M('Qyworkflow')->where(array('id'=>$data['id']))->delete()){
			echo json_encode(array('status'=>1));
		}
		
	}
}

/**
*冻结
**/
public function freeze(){
    $this->check();
	if(IS_POST){
	$data = M('Qyworkflow')->where(array('id'=>$_POST['id']))->find();
	if(M('Qyworkflow')->where(array('id'=>$data['id']))->save(array('status'=>0))){
		echo json_encode(array('status'=>1));
	}
	
}

}


/**
*开启
**/
public function start(){
    $this->check();
	if(IS_POST){
	$data = M('Qyworkflow')->where(array('id'=>$_POST['id']))->find();
	if(M('Qyworkflow')->where(array('id'=>$data['id']))->save(array('status'=>1))){
		echo json_encode(array('status'=>0));
	}
	
}

}

/**
*详情
**/
public function info(){
    $this->check();
    $id = $this->_get('id');
    $data = M('qyworkflow')->where(array('id'=>$id))->find();
	//print_r($data);
	$this->assign('data',$data);
	$this->display();
}

/****************wap***************/

//审批大厅
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Workflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
		}

		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		//dump($_GET['wecha_id']);
		$ids=array_filter(explode(';',$userinfo['pid']));
		$list=M('Qyworkflow')->where(array('user_id'=>$app['userid'],'status'=>1))->order('time desc')->select();
 		foreach($list as $k=>$va){
			$departid = explode(',',$va['department']);
			foreach($ids as $v){
				$department=M('Department')->where(array('wxid'=>$v,'user_id'=>$app['userid']))->find();
				if(in_array($department['id'],$departid)){
					$nlist[] = $va;
					break;
				}
			}
		} 
		$this->assign('list',$nlist);
		$this->display();
	}

//start 发起审批
public function post_act(){
	if(IS_POST){
	    $app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
		$conf=M('Qyworkflow')->where(array('id'=>$_POST['a_id']))->find();
		$examine=unserialize($conf['examine']);
		$data['user_id']=$conf['user_id'];
		$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
		if($app['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$save_dir = "./Uploads/Workflow/".$app['userid']."/".$_POST['wecha_id']."/";
		$cache = S('AccessToken');
		if($cache){
			$access_token = $cache;
		}else{
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			S('AccessToken',$access_token,7140);
		}	
		foreach($_POST['form'] as $key=>$val){
		    if($val['type'] == 7){
			    if($val['val']){
				    $fileUrl = '';
				    foreach($val['val'] as $k=>$v){
						$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
						$filePath = $this->saveMedia($url,$save_dir);
						//F('$filePath',$filePath);
						$picFind=M('qyworkflow_pic')->where(array('pic'=>$filePath))->find();
						if(!$picFind){
							$add = M('qyworkflow_pic')->add(array('pic'=>$filePath));
							if($add){
								$fileUrl .= $add.',';
							}
						}					    
					}
					$_POST['form'][$key]['val'] = $fileUrl;
				}
			    
			}
		}
		//F('$_POST8',$_POST);
		$data['name_defined']=serialize($_POST['form']);
		$data['pid']=$_POST['a_id'];
		$data['wecha_id']=$_POST['wecha_id'];
		$data['d_wecha_id']=0;
		$data['time']=time();
		$data['theme']=$_POST['theme'];
		$data['name']=$conf['name'];
		if($c_id=M('Qyworkflow_user')->add($data)){
			//给所有人发信息
			$m=0;
			foreach($examine as $k=>$v){
					if($v['auditselect']=='直接上级'){
						$pid=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id']))->field('pid')->find();
						$father=M('Qy_node')->where(array('id'=>$pid['pid']))->field('node_user')->find();
						if($father){
							$v['auditselect']=$father['node_user'];
						}else{
							$v['auditselect']=0;
						}
					}
					if($v['auditselect']!==0){
						$new_node[$m]=$v['auditselect'];
						$m++;
						$w_id=M('Qyworkflow_witer')->add(array('user_id'=>$data['user_id'],'pid'=>$c_id,'wecha_id'=>$data['wecha_id'],'form_wecha_id'=>$v['auditselect'],'module'=>'Workflow','time'=>time()));
						$member = M('qyusers')->where(array('id'=>$v['auditselect']))->find();
						$inin['touser'].=$member['userid'].'|';
					}
			}
			$ssc=M('Qyworkflow_user')->where(array('id'=>$c_id))->save(array('next_wecha_id'=>$new_node[count($new_node)-1],'next_num'=>serialize($new_node)));
			$inin['touser']=str_replace('|--','',$inin['touser'].'--');
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个流程审批任务完成";
			$inin['description']="请您点击进入审核";
			$inin['picurl']="picurl";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Workflow&a=wap_act_list&token='.$_POST['token'];
			//$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('appid')->find();
			$inin["agentid"]=$app['appid'];
			$msg=$Msg->msg_send_all($inin,$conf['user_id']);
			if($msg['errcode']==0){
					$this->redirect(U('wap_act_my',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'])));
			}
		}
	}else{
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
 		$conf=M('Qyworkflow')->where(array('id'=>$_GET['a_id']))->find();
		$form=unserialize($conf['name_defined']);
		$examine=unserialize($conf['examine']);
		$keys=array_keys($form);
		$i=0;
		foreach($form as $v){
			$n_form[$i]['field']=$keys[$i];
			$n_form[$i]['name']=$v['name'];
			$n_form[$i]['type']=$v['type'];
			$n_form[$i]['status']=$v['status'];
			if($v['type']==5){
				$n_form[$i]['select']=explode(',',$v['info']);
			}
			$i++;
		}
		//JSSDK调用
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		//dump($n_form);exit;
		$this->assign('form',$n_form);
		$this->display(); 
	}
}

//待审核
public function wap_act_list(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Workflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_list');
		exit();
	}
	
	
	$where['user_id']=$app['userid'];
	$where['form_wecha_id']=$_GET['wecha_id'];
	$where['module']='Workflow';
	//已审核
	if($_GET['status']==1){
		$where['status']=1;
	}
	//未审核
	if($_GET['status']==0){
		$where['status']=0;
	}
	//
	if($_GET['status']==2){
		$where['status']=2;
	}
	$list=M('Qyworkflow_witer')->order('id desc')->where($where)->select();
	//dump($list);die();
	foreach($list as $k=>$v){
		$nlist[$k]=$v;
		$nlist[$k]['info']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$v['user_id']))->find();
		if(!$nlist[$k]['info']){
			$Member=A('Qyapp/Member');
			$meinfo=json_decode($Member->memberInfo_get($v['wecha_id']),true);
			$infos=array('userid'=>$v['wecha_id'],'user_id'=>$v['user_id'],
			'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			M('Qyusers')->add($infos);
			$nlist[$k]['info']=$infos;
		}
		$nlist[$k]['status']=M('Qyworkflow_user')->where(array('id'=>$v['pid']))->field('status,name')->find();
	}
	//dump($nlist);die();
	$this->assign('list',$nlist);
	$this->display();
}

public function wap_userinfo($wecha_id,$userid){
	$userinfo=M('Qyusers')->where(array('userid'=>$wecha_id,'user_id'=>$userid))->find();
	$ids=array_filter(explode(';',$userinfo['pid']));
	foreach($ids as $v){
		$deparid = M('Department')->where(array('wxid'=>$v,'user_id'=>$userid))->find();
		$department[] = $deparid['name'];
	}
	$userinfo['department'] = implode(',',$department);
	return $userinfo;
}

//我的审批
public function wap_act_my(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find(); 
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Workflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_my');
		exit();
	}
	
	$userinfo = $this->wap_userinfo($_GET['wecha_id'],$app['userid']);
	$this->assign('userinfo',$userinfo);
	$where['user_id']=$app['userid'];
	$where['wecha_id']=$_GET['wecha_id'];
	//审核中
	if($_GET['status']==1){
		$where['status']=1;
	}
	//通过
	if($_GET['status']==2){
		$where['status']=2;
	}
	//驳回
	if($_GET['status']==3){
		$where['status']=3;
	}
	$list=M('Qyworkflow_user')->where($where)->order('time desc')->select();
	foreach($list as $k=>$v){
		$nlist[$k]=$v;
		$nlist[$k]['dept']=$userinfo['department'];
		$nlist[$k]['info']=M('Qyworkflow_')->where(array('id'=>$v['pid']))->find();
		if(!$nlist[$k]['info']){
			$Member=A('Qyapp/Member');
			$meinfo=json_decode($Member->memberInfo_get($v['wecha_id']),true);
			$infos=array('userid'=>$v['wecha_id'],'user_id'=>$v['user_id'],
			'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			M('Qyusers')->add($infos);
			$nlist[$k]['info']=$infos;
		}
	}
	$where['status'] = 1;
	$count = array('1','2','3');
	foreach($count as $k=>$v){
		$where['status']=$v;
		$num = M('Qyworkflow_user')->where($where)->count();
		$this->assign('count'.$v,$num);
	}
	$this->assign('list',$nlist);
	$this->display();
}


//审核通过
public function wap_act_info(){
	$data=M('Qyworkflow_user')->where(array('id'=>$_GET['id']))->find();
	$userinfo = $this->wap_userinfo($data['wecha_id'],$data['user_id']);
	$this->assign('users',$userinfo);
	$form=unserialize($data['name_defined']);
	foreach($form as $key=>$val){
	    if($val['type'] == 7){
		    if($val['val']){
			    $res = explode(',',$val['val']);
				$m = 0;
				foreach($res as $k=>$v){
				    if($v){
					   $temp = M('Qyworkflow_pic')->where(array('id'=>$v))->find();	 
					   $arr[$m] = $temp['pic'];
                       $m++;	
					}
				}
				$form[$key]['val'] = $arr;
			}
		}
	}
	$this->assign('data',$data);
	$record=M('Qyworkflow_witer')->where(array('pid'=>$_GET['id'],'module'=>'Workflow'))->select();
	$relist=array();
	foreach($record as $k=>$va){
	   $relist[$k]['base'] = $va;
		$relist[$k]['user']=M('Qyusers')->where(array('user_id'=>$va['user_id'],'id'=>$va['form_wecha_id']))->find();
		$tempic=M('Qyworkflow_user')->where(array('user_id'=>$va['user_id'],'id'=>$va['pid']))->find();
		$arr = explode(',',$tempic['pic']);
		//$relist[$k]['pic'] = $arr;
		$temp= array();

	}
	$this->assign('pic',$pic);
	$this->assign('audit',$relist);
	$this->assign('form',$form);
	$this->display();
}



//审核通过
public function wap_act_agree(){
	$data=M('Qyworkflow_user')->where(array('id'=>$_GET['id']))->field('name_defined,status')->find();
	$userinfo=M('Qyusers')->where(array('userid'=>$data['wecha_id'],'user_id'=>$data['user_id']))->find();
	$form=unserialize($data['name_defined']);
	$check=M('Qyworkflow_witer')->where(array('id'=>$_GET['a_id']))->find();
	// dump($data);
	// dump($userinfo);exit;
	$this->assign('check',$check);
	$this->assign('form',$form);
	$this->assign('data',$data);
	$this->assign('info',$userinfo);
	$this->display();
}

//agrrr

	public function wap_agree(){
		if($_GET['status']){
			$check=M('Qyworkflow_witer')->where(array('id'=>$_GET['a_id']))->find();
			if($check['status']!='0'){
			//已经审核
				$this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
			}
			if($_GET['status']==1){
				if($c_id=M('Qyworkflow_witer')->where(array('id'=>$_GET['a_id']))->save(array('status'=>1,'time'=>time()))){
					$user=M('Qyworkflow_user')->where(array('id'=>$check['pid']))->find();
					$examine=unserialize($user['next_num']);
					if($examine[count($examine)-1]==$user['next_wecha_id']&&$_GET['wecha_id']==$user['next_wecha_id']){
						$cccc=M('Qyworkflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>2,'next_wecha_id'=>0));
						$this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1)));
						// echo 1;exit;
					}else{
						die();
						foreach($examine as $ke=>$va){
							if($va==$_GET['wecha_id']) {
								$mc=$ke;
							}
						}
						M('Qyworkflow_user')->where(array('id'=>$check['pid']))->save(array('next_wecha_id'=>$examine[$mc+1]));
						$inin['touser']=$examine[$mc+1];
						$Msg=A('Qyapp/Msg');
						$inin['title']="您有一个流程审批任务完成";
						$inin['description']="请您点击进入审核";
						$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Workflow&a=wap_index&token='.$_GET['token'];
						$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
						$inin["agentid"]=$app['appid'];
						//
						$msg=$Msg->msg_send_all($inin,$app['userid']);
					}
					$this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1)));
				
				}
			}
			if($_GET['status']==2){
				if(M('Qyworkflow_witer')->where(array('id'=>$_GET['a_id']))->save(array('status'=>2,'time'=>time()))){
					$this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
				}
			}
		}
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
			//$accessClass= A('Qyapp/Common');
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