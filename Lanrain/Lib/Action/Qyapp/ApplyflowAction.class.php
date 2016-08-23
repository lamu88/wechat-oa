<?php
/**
*报销管理
**/
class ApplyflowAction extends Action{
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
		
/**
*配置审核人
**/
public function index(){
    $this->check();
	if(IS_POST){
	    //dump($_POST);exit;
		$users=array();
		$i=0;
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
		$check=M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($check){
			M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
		}
		$id = M('Qyapplyflow_config')->add($data); 
		if($id){
		    $this->success('设置成功',U('Applyflow/index',array('mid'=>$_GET['mid']))); 
		}else{
		    $this->error('设置失败');
		}		
	}else{
	    $check=M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
		if($check){
		    $check['audit'] = unserialize($check['audit']);
			//print_r($check['audit']);exit;
		    $audit = json_encode($check['audit']);
			$this->assign('audit',$audit);
			$this->display('config');  //显示已配置
		}else{
			$this->display('unconfig');	//显示未配置
		}

	}
}

/**
*配置审核人
**/
public function conf(){
    $this->check();
	if(IS_POST){
	    //print_r($_POST);exit;
		$users=array();
		$i=0;
		foreach($_POST['level'] as $k=>$v){
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
		}
		$data = array();
		$data['audit'] = serialize($users);  // 审核人
		$data['time'] = time();  // 审核添加时间
		$data['user_id'] = $_SESSION['user_id']; 
		$data['status'] = 1;   //报销是否冻结
		$check=M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($check){
			M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
		}
		$id = M('Qyapplyflow_config')->add($data); 
		if($id){
		    $this->success('设置成功',U('Applyflow/index',array('mid'=>$_GET['mid']))); 
		}else{
		    $this->error('设置失败');
		}		
	}else{
/* 	    $users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->select();
		if($users){
		    foreach($users as $k=>$v){
				$info[$k]['value'] = $v['userid'].'('.$v['name'].')';
				$info[$k]['label'] = $v['userid'].'('.$v['name'].')';
				$info[$k]['name'] = $v['name'];
				$info[$k]['image'] = $v['pic'];				
			}
		}
		$result = json_encode($info);
		$data = str_replace("\"","'",$result);
		$this->assign('data',$data); */
	    $check=M('Qyapplyflow_config')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
		if($check){
		    $check['audit'] = unserialize($check['audit']);
			//print_r($check['audit']);exit;
		    $audit = json_encode($check['audit']);
			$this->assign('audit',$audit);
			$this->display('config');  //显示已配置
		}else{
			$this->display('unconfig');	//显示未配置
		}

	}
}

/**
*配置报销类型
**/
public function applytype(){
    $this->check();
	if(IS_POST){
	    $_POST['userid']=$_SESSION['user_id'];	
		//print_r($_POST);exit;
		$info=M('Qyapplyflow_type')->add($_POST);
		//F('55',$_POST);
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
 
	}else{
	    $userid=$_SESSION['user_id'];

	   $data=M('Qyapplyflow_type')->where($userid)->order('disorder desc')->select();
	   
	   $this->assign('data',$data);
	   $this->display();
	}

}

/**
*输入自动完成
**/
public function searchName(){
	$search_word = $_GET['search_word'];
	$content = M('qyusers')->field('name')->where(array('name'=>array('like'=>$search_word)))->select(); 
    echo json_encode($content);
}

/**
*编辑
**/
public function edit(){
$this->check();
if(IS_POST){
    //print_r($_POST);exit;
    if($info=M('Qyapplyflow_type')->save($_POST)){
		$this->success('添加成功',U('Applyflow/applytype',array('mid'=>$_GET['mid'])));
	}else{
	    $this->error('添加失败');
	}
}else{
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	$data=M('Qyapplyflow_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();
	$this->assign('data',$data);
	$this->display();
}

}

/**
*删除
**/
public function del(){
    $this->check();
    $id = $this->_post('id');
    $user_id = $_SESSION['user_id'];
	//print_r($_POST);exit;
	$info=M('Qyapplyflow_user')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
}

/**
*增加
**/
public function add(){
    $this->check();
    if(IS_POST){
	//F('445566',$_POST);
	    if($info=M('Qyapplyflow_type')->add($_POST)){
		    $this->success('添加成功',U('Applyflow/applytype',array('mid'=>$_GET['mid'])));		
		}else{
	        $this->error('添加失败');		
		}
	}else{
	    $this->display();	
	}

}

/**
*报销类型详情
**/
public function applyinfo(){
    $this->check();
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	//$this->assign('user_id',$user_id);
	$data=M('Qyapplyflow_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
	$this->assign('data',$data);
	$this->display();
}

/**
*冻结操作
**/
public function freeze(){
//检查是否有还有审批的流程

}

public function details(){

	$count      = M('Qyapplyflow_user')->where(array('user_id'=>$_SESSION['user_id']))->count();
	$Page       = new Page($count,15);
	$info = M('Qyapplyflow_user')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
	$show       = $Page->show();
    //$info = M('Qyapplyflow_user')->where(array('user_id'=>$_SESSION['user_id']))->select();
	$temp = M('Qyapplyflow_type')->where(array('user_id'=>$_SESSION['user_id']))->select();
	$res = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id']))->field('userid,name')->select();		
	$type = array();
	foreach($temp as $k=>$v){
	    $type[$v['id']] = $v;    
	}
	$users = array();
	foreach($res as $k=>$v){
	    $users[$v['userid']] = $v;    
	}	
	$data = array();
	foreach($info as $key=>$val){
	    $data[$key] = $val;
		$data[$key]['type'] = $type[$val['type']]['name'];
		$data[$key]['user'] = $users[$val['wecha_id']]['name'];
	}
	$this->assign('data',$data);
	$this->assign('page',$show);	
    $this->display();
}

/**
*详情
**/
public function detailsInfo(){
    $this->check();
	$data=M('Qyapplyflow_user')->where(array('id'=>$_GET['id'],'user_id'=>$_SESSION['user_id']))->find();
	$temp = M('Qyapplyflow_type')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['type']))->field('name')->find();
	$res = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$data['wecha_id']))->field('name')->find();	
    $data['type'] = $temp['name'];
    $data['user'] = $res['name'];	
	$res = unserialize($data['name_defined']);
	$this->assign('data',$data);
	$detail = array();
	$i = 0;
	foreach($res as $k=>$v){
	    $detail[$i] = $v;
		$i++;
	}	
	$this->assign('detail',$detail);	
	$this->display();
}

/**
*报销明细删除
**/
public function delDetail(){
    $this->check();
    $id = $this->_post('id');
    $user_id = $_SESSION['user_id'];
	$info=M('Qyapplyflow_user')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
}
/****************************************手机端**********************************************/
/**
*手机端报销主页
**/
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//print_r($_GET);exit;
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		//print_r($user);exit;
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_index',$_GET);	
	} 	
	$data=M('Qyapplyflow_user')->where(array('user_id'=>$app['userid'],'status'=>1))->select();
	

	// $list = array();
	// foreach($data as $key=>$val){
		// $list[$key] = $val;
		// $list[$key]['type'] = $arr[$val['type']]['name'];
	// }
	// //print_r($list);exit;
	$this->assign('list',$list);	
	$this->display('wap_act_my');
}

/**
*我的报销
**/
public function wap_act_my(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_my');
		exit();
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_act_my',$_GET);	
	} 	
	$where['user_id']=$app['userid'];
	$where['wecha_id']=$_GET['wecha_id'];
	//审核中
	if($_GET['status']==1){
		$where['status']=array(1,5,'or');
	}
	//通过
	if($_GET['status']==2){
		$where['status']=2;
	}
	//驳回
	if($_GET['status']==3){
		$where['status']=3;
	}
	//->field('user_id,wecha_id,id,next_wecha_id,time')
	$list=M('Qyapplyflow_user')->where($where)->order('id desc')->select();
	$user_info=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->order('id desc')->limit(10)->field('name,userid,pic')->find();
	//dump($$_GET['wecha_id']);die;
	foreach($list as $k=>$v){
		$nlist[$k]=$v;
		$nlist[$k]['info']=$user_info;
		$nlist[$k]['check_info']=M('Qyusers')->where(array('userid'=>$v['next_wecha_id'],'user_id'=>$app['userid']))->field('name')->find();
		$nlist[$k]['msg_type']=M('Qyapplyflow_type')->where(array('id'=>$v['type']))->field('name')->find();
		// if(!$nlist[$k]['info']){
			// $Member=A('Qyapp/Member');
			// $meinfo=json_decode($Member->memberInfo_get($v['wecha_id']),true);
			// $infos=array('userid'=>$v['wecha_id'],'user_id'=>$v['user_id'],
			// 'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
			// M('Qyusers')->add($infos);
			// $nlist[$k]['info']=$infos;
		// }
	}
	//dump($nlist);die();
	$this->assign('list',$nlist);
	$this->display();
}
/**
*报销申请
**/
public function wap_post111(){
	if(IS_POST){
	    //dump($_POST);exit;
		$app=M('Qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$config=M('Qyapplyflow_config')->where(array('user_id'=>$app['userid']))->find();
		$check=unserialize($config['audit']);
		$data=$_POST;
		$data['name']=$_POST['name'];		
		$data['user_id']=$app['userid'];
		$data['name_defined']=serialize($_POST['project']);
		$data['wecha_id']=$_POST['wecha_id'];
		$data['d_wecha_id']=0;
		$data['time']=time();
		foreach($_POST['project'] as $v){
			//dump($v["'money'"]);
			$data['allmoney']=$data['allmoney']+$v['money'];
		}
		//dump($_POST);
		//dump($data);die();
		if($c_id=M('Qyapplyflow_user')->add($data)){
			//给所有人发信息
			$m=0;
			foreach($check as $k=>$v){
					if(empty($v)){
						$pid=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id']))->field('pid')->find();
						$father=M('Qy_node')->where(array('id'=>$pid['pid']))->field('node_user')->find();
						if($father){
							$v=$father['node_user'];
						}else{
							$v=0;
						}
					}
					if($v!==0){
						$new_node[$m]=$v;
						$touser[$m] = $v;						
						$m++;
						$w_id=M('Qyapplyflow_witer')->add(array('user_id'=>$data['user_id'],'pid'=>$c_id,'wecha_id'=>$data['wecha_id'],'form_wecha_id'=>$v,'module'=>'Applyflow'));
						//$inin['touser'].=$v.'|';
					}
			}
			$ssc=M('Qyapplyflow_user')->where(array('id'=>$c_id))->save(array('next_wecha_id'=>$new_node[count($new_node)-1],'next_num'=>serialize($new_node)));
			//$inin['touser']=str_replace('|--','',$inin['touser'].'--');
			$inin['touser'] = implode('|',$touser);
			//dump($inin);exit;
			//F('inin1',$inin);
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个报销申请需要处理";
			$inin['description']="请您点击进入处理";
			$inin['picurl']="picurl";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_sp_info&token='.$_POST['token'].'&wecha_id='.$_POST['wecha_id'].'&pid='.$c_id;
			$inin["agentid"]=$app['appid'];
			//F('inin',$inin);
			$info=$Msg->msg_send_all($inin,$app['userid']);
			if($info['errcode']==0){
				$this->redirect(U('wap_act_my',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'status'=>1)));
			}else{
				$this->redirect(U('wap_act_my',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'status'=>1)));
			}
		}

	}else{
	//获取报销类型
	    $app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Applyflow';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_post');
			exit();
		} */
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_post',$_GET);	
		} 		
	    $list=M('Qyapplyflow_type')->where(array('status'=>1))->select();	
		$this->assign('list',$list);
		//dump($list);
		$this->display();
	}

}

/**
*报销申请
**/
public function wap_post(){
	if(IS_POST){
	    //dump($_POST);exit;
		//F('$_POST8',$_POST);
		$app=M('Qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$config=M('Qyapplyflow_config')->where(array('user_id'=>$app['userid']))->find();
		$check=unserialize($config['audit']);
		//print_r($check);exit;
		$data=$_POST;
		$data['name']=$_POST['name'];		
		$data['user_id']=$app['userid'];
		//
		$data['wecha_id']=$_POST['wecha_id'];
		$data['d_wecha_id']=0;
		$data['time']=time();
		$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
		if($app['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$save_dir = "./Uploads/Applyflow/".$app['userid']."/".$_POST['wecha_id']."/";
		$cache = S('AccessToken');
		if($cache){
			$access_token = $cache;
		}else{
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			S('AccessToken',$access_token,7140);
		}	
        		
		foreach($_POST['project'] as $key=>$val){
			//dump($v["'money'"]);
			$data['allmoney']=$data['allmoney']+$val['money'];
			if($val['pic']){
				$fileUrl = '';
				//$i = 0;
				foreach($val['pic'] as $k=>$v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					//F('$filePath',$filePath);
					$picFind=M('qyapplyflow_pic')->where(array('user_id'=>$app['appid'],'pic'=>$filePath))->find();
					if(!$picFind){
						$add = M('qyapplyflow_pic')->add(array('user_id'=>$app['appid'],'pic'=>$filePath));
						if($add){
							$fileUrl .= $add.',';
						}
					}
					$_POST['project'][$key]['url'] = $fileUrl;
					//$i++;
				}
				
			    
			}
			
		}
		//dump($_POST);
		//dump($data);die();
		//F('$data3',$data);
		//F('$RRDF',$_POST['project']);
		$data['name_defined']=serialize($_POST['project']);
		if($c_id=M('Qyapplyflow_user')->add($data)){
			//给所有人发信息
			$m=0;
			foreach($check as $k=>$v){
					if(empty($v)){
						$pid=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id']))->field('pid')->find();
						$father=M('Qy_node')->where(array('id'=>$pid['pid']))->field('node_user')->find();
						if($father){
							$v=$father['node_user'];
						}else{
							$v=0;
						}
					}
					if($v!==0){
						$new_node[$m]=$v;
						$touser[$m] = $v;						
						$m++;
						$w_id=M('Qyapplyflow_witer')->add(array('user_id'=>$data['user_id'],'pid'=>$c_id,'wecha_id'=>$data['wecha_id'],'form_wecha_id'=>$v,'module'=>'Applyflow'));
						//$inin['touser'].=$v.'|';
					}
			}
			$ssc=M('Qyapplyflow_user')->where(array('id'=>$c_id))->save(array('next_wecha_id'=>$new_node[count($new_node)-1],'next_num'=>serialize($new_node)));
			
			//$inin['touser']=str_replace('|--','',$inin['touser'].'--');
			//$inin['touser'] = implode('|',$touser);
			//dump($inin);exit;
			//F('inin1',$inin);
			$inin['touser'] = $check[0];
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个报销申请需要处理";
			$inin['description']="请您点击进入处理";
			$inin['picurl']="picurl";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_sp_info&token='.$_POST['token'].'&wecha_id='.$_POST['wecha_id'].'&pid='.$c_id;
			$inin["agentid"]=$app['appid'];
			//F('inin',$inin);
			$info=$Msg->msg_send_all($inin,$app['userid']);
			if($info['errcode']==0){
				$this->redirect(U('wap_act_my',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'status'=>1)));
			}else{
				$this->redirect(U('wap_act_my',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'status'=>1)));
			}
		}

	}else{
	//获取报销类型
	    $app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Applyflow';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_post');
			exit();
		} */
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_post',$_GET);	
		} 	
		//JSSDK调用
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);		
	    $list=M('Qyapplyflow_type')->where(array('status'=>1))->select();	
		$this->assign('list',$list);
		//dump($list);
		$this->display();
	}

}

/**
*待审批列表
**/
public function wap_act_list(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_list');
		exit();
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_act_list',$_GET);	
	} 	
	$where['user_id']=$app['userid'];
	$where['form_wecha_id']=$_GET['wecha_id'];
	$where['module']='Applyflow';
	//已审核
	if($_GET['status']==1){
		$where['status']=1;
	}
	//未审核
	if($_GET['status']==0){
		$where['status']=array(0,5,'or');
	}
	//已驳回
	if($_GET['status']==2){
		$where['status']=2;
	}
	
	//$data=M('Qyapplyflow_user')->where($where)->order('id desc')->select();
	//$user_info=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->order('id desc')->limit(10)->field('name,userid,pic')->find();	
	
	
	$data=M('Qyapplyflow_witer')->where($where)->order('id desc')->limit(15)->select();
	//$res=M('Qyapplyflow_type')->where(array('status'=>1))->field('id,name')->select();
	//dump($data);exit;
	//$type = array();
	//foreach($res as $k=>$v){
	//    $type[$v['id']] = $v;
	//}
	//dump($_GET);
	//dump($data);
	foreach($data as $k=>$v){
		$list[$k]=$v;
		//$list[$k]=$v;
		$list[$k]['info']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$v['user_id']))->field('name,pic')->find();
		$list[$k]['record']=M('Qyapplyflow_user')->where(array('id'=>$v['pid']))->field('time,allmoney,type,name')->find();
		$list[$k]['msg_type']=M('Qyapplyflow_type')->where(array('id'=>$list[$k]['record']['type']))->field('name')->find();
		//$list[$k]['name']=$list[$k]['record']['name'];
	}
	//dump($list);exit;
	$this->assign('list',$list);
	$this->display();
}

/**
*报销详细信息
**/
public function wap_act_info(){
	$id = $_GET['pid'];
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_act_info',$_GET);	
	} 	
	//获取报销类型
	$info=M('Qyapplyflow_type')->where(array('status'=>1))->select();
	foreach($info as $v){
	    $arr[$v['id']] = $v;
	}
	$witer=M('Qyapplyflow_witer')->where(array('pid'=>$id))->find();
	// print_r($witer);exit;
	$this->assign('witer',$witer);
	$list=M('Qyapplyflow_user')->where(array('id'=>$id))->find();
	$list['type'] = $arr[$list['type']]['name'];
	$namedefine=unserialize($list['name_defined']);
	$this->assign('namedefine',$namedefine);
	$this->assign('list',$list);
	// print_r($list);exit;
	$this->display();	
}


public function wap_sp_info(){
	$id = $_GET['pid'];
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,appid')->find();
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_sp_info',$_GET);	
	} 	
	//F('$$_GET',$_GET);
	//获取报销类型
	$info=M('Qyapplyflow_type')->where(array('status'=>1))->select();
	foreach($info as $v){
	    $arr[$v['id']] = $v;
	}
	$witer=M('Qyapplyflow_witer')->where(array('form_wecha_id'=>$_GET['wecha_id'],'pid'=>$id))->find();
	//F('$witer',$witer);
	//dump($witer);
	$this->assign('witer',$witer);
	$list=M('Qyapplyflow_user')->where(array('id'=>$id))->find();
	$list['type'] = $arr[$list['type']]['name'];
	$namedefine=unserialize($list['name_defined']);
	//F('$list22',$list);
	//dump($namedefine);exit;
	$i = 0;
	foreach($namedefine as $k=>$v){
	     //$info[$i] = $v;
		 if($v['url']){
			 $temp = explode(',',$v['url']);
			 $res = array();
			 foreach($temp as $key=>$val){
				if($val){
				    $pic = M('qyapplyflow_pic')->where(array('user_id'=>$app['appid'],'id'=>$val))->find();
					if($pic['pic']){
					    $res[$key] = $pic['pic'];
					}
					
				}
			 }	
             $namedefine[$k]['url'] = $res;			 
		 }
	}
	//dump($namedefine);exit;
	//dump($list);exit;
	$this->assign('list',$list);
	//dump($list);exit;
	$com = M('Qyapplyflow_comment')->where(array('list_id'=>$witer['id']))->select();
	//dump($com);exit;
	//F('$com',$com);
	foreach($com as $key=>$val){
		$user = M('Qyusers')->where(array('userid'=>$val['wecha_id'],'user_id'=>$app['userid']))->field('name,id,pic,position')->find();
		// print_r($val['wecha_id']);
		$msg['name'] = $user['name'];
		$msg['pic'] = $user['pic'];
		$msg['position'] = $user['position'];
		$msg['content'] = $val['content'];
		if($val['voice']){
		    $voice =M('Qyapplyflow_pic')->where(array('user_id'=>$app['appid'],'id'=>$val['voice']))->find();
			if($voice['pic']){
			    $msg['voice'] = $voice['pic'];
			}
		}
		$msg['status'] = $val['status'];
		$msg['filesize'] = filesize($msg['voice']);
		$msg['long'] = ceil(((filesize($msg['voice'])/1024)/16)*8);
		$comment[$key] = $msg;
	}
	//F('$comment',$comment);exit;
	$this->assign('comment',$comment);
	//dump($comment);exit;
	$this->assign('namedefine',$namedefine);
	$this->assign('list',$list);
	$qytoken=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
	$Jsssdk=A('Qyapp/Jsssdk');
	$jsssdk_info=$Jsssdk->wap_index($qytoken['corpid'],$qytoken['corpsecret'],$app);
	$this->assign('jsssdk_info',$jsssdk_info);
	$this->display();	
}

public function wap_deny_info(){
	$id = $_GET['pid'];
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
/* 	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Applyflow';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	} */
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_deny_info',$_GET);	
	} 	
	//F('$$$_GET',$_GET);
	//获取报销类型
	$info=M('Qyapplyflow_type')->where(array('status'=>1))->select();
	foreach($info as $v){
	    $arr[$v['id']] = $v;
	}
	$witer=M('Qyapplyflow_witer')->where(array('id'=>$id))->find();
	//F('$witer',$witer);
	//dump($witer);
	$this->assign('witer',$witer);
	$list=M('Qyapplyflow_user')->where(array('id'=>$witer['pid']))->find();
	$list['type'] = $arr[$list['type']]['name'];
	$namedefine=unserialize($list['name_defined']);
	//F('$list22',$list);
	$this->assign('list',$list);
	$com = M('Qyapplyflow_comment')->where(array('list_id'=>$list['id']))->select();
	foreach($com as $key=>$val){
		$user = M('Qyusers')->where(array('userid'=>$val['wecha_id'],'user_id'=>$app['userid']))->field('name,id,pic,position')->find();
		// print_r($val['wecha_id']);
		$msg['name'] = $user['name'];
		$msg['pic'] = $user['pic'];
		$msg['position'] = $user['position'];
		$msg['content'] = $val['content'];
		$msg['status'] = $val['status'];
		$comment[] = $msg;
	}
		//F('$$comment',$comment);
	$this->assign('comment',$comment);
	$this->assign('namedefine',$namedefine);
	$this->assign('list',$list);
	//print_r($comment);exit;
	$this->display();	
}

	public function wap_agree(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,appid')->find();
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Applyflow','wap_agree',$_GET);	
		} 	
		//F('$_GETM',$_GET);
		//F('$_POSTM',$_POST);		
		if($_GET['status']){
			$check=M('Qyapplyflow_witer')->where(array('id'=>$_GET['a_id']))->find();
			if($check['status']==2){
				//已经审核
				$this->ajaxReturn(0);
			}else{
				//催办
				if($_GET['status']==1){
					
					$c_id=M('Qyapplyflow_witer')->where(array('pid'=>$check['pid']))->save(array('status'=>5,'time'=>time()));
					if($c_id){
						$user=M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->find();
						$examine=unserialize($user['next_num']);
						
						//$inin['touser'] = implode('|',$examine);
						$inin['touser'] = $user['next_wecha_id'];
						$Msg=A('Qyapp/Msg');
						$inin['title']="您有一个报销任务需要审核";
						$inin['description']="请您点击进入审核";
						$inin['picurl']="picurl";
						$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_act_list&token='.$_GET['token'].'&status=0';
						//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,appid')->find();
						$inin["agentid"]=$app['appid'];
						$msg = $Msg->msg_send_all($inin,$app['userid']);
						if($msg['errcode']==0){
								M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>5));
								$this->ajaxReturn(1);//发送成功
						 }else{
							 $this->ajaxReturn(2); 
						 }
					}
				}
				//同意
				if($_GET['status']==2){
					if($_GET['a_id']){
					    /* if(trim($_POST['content'])){
			               $check = M('Qyapplyflow_comment')->where(array('list_id'=>$_POST['id'],'wecha_id'=>$_POST['wecha_id']))->find();				
						   $save = M('Qyapplyflow_comment')->where(array('id'=>$check['id']))->save($data);
							if($save){
								$this->ajaxReturn(1);//修改成功
							}else{
								$this->ajaxReturn(2);//修改失败
							}						    
						} */
						if($resId = M('Qyapplyflow_witer')->where(array('id'=>$_GET['a_id']))->save(array('status'=>2,'time'=>time()))){
						    $res = M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->find();
							if($res){
								$map = array();
								$map['wecha_id'] = $_GET['wecha_id'];
								$map['list_id'] = $check['id'];
								$map['content'] = $_POST['content'];
								

								if($_POST['voice']){
									$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
									if($app['type']==2){
										$user['corpid']='';
										$user['corpsecret']='';
									}
									$save_dir = "./Uploads/Applyflow/".$app['userid']."/".$_GET['wecha_id']."/";
									$cache = S('AccessToken');
									if($cache){
										$access_token = $cache;
									}else{
										$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
										S('AccessToken',$access_token,7140);
									}	
									$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$_POST['voice']."";
                                    $filePath = $this->saveMedia($url,$save_dir);
									$picFind=M('qyapplyflow_pic')->where(array('user_id'=>$app['appid'],'pic'=>$filePath))->find();
									if(!$picFind){
										$add = M('qyapplyflow_pic')->add(array('user_id'=>$app['appid'],'pic'=>$filePath));
										if($add){
											$fileUrl = $add;
										}
									}	                                   
									$map['voice'] = $fileUrl;
/* 									foreach($_POST['voice'] as $key=>$val){
										if($val['type'] == 7){
											if($val['val']){
												$fileUrl = '';
												foreach($val['val'] as $k=>$v){
													$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
													$filePath = $this->saveMedia($url,$save_dir);
													//F('$filePath',$filePath);
													$picFind=M('qyapplyflow_pic')->where(array('user_id'=>$app['appid'],'pic'=>$filePath))->find();
													if(!$picFind){
														$add = M('qyapplyflow_pic')->add(array('user_id'=>$app['appid'],'pic'=>$filePath));
														if($add){
															$fileUrl .= $add.',';
														}
													}					    
												}
												$_POST['form'][$key]['val'] = $fileUrl;
											}
											
										}
									} */


									
								}
								
								$map['status'] = 2;
								$add = M('Qyapplyflow_comment')->add($map);	
                                //F('$add',$add);		
                                //F('$map',$map);									
							    $arr = unserialize($res['next_num']);
								$temp= $arr;
								array_flip($temp);
								$num = $temp[$_GET['wecha_id']];
								//$arr[$num+1];
								if(($num+1) == count($arr)){
								    if(M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>2))){
									    $this->ajaxReturn(1);   
									}else{
									    $this->ajaxReturn(7);
									}
								}else{
								    if(M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('next_wecha_id'=>$arr[$num+1]))){
										//给报销申请人发送消息
										$inin['touser'] = $res['next_wecha_id'];
										$Msg=A('Qyapp/Msg');
										$inin['title']="有报销申请需要您审核";
										$inin['description']="请您点击进入查看";
										$inin['picurl']="picurl";
										$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_sp_info&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&pid='.$_GET['a_id'];
										$inin["agentid"]=$app['appid'];
										//F('inin',$inin);
										$info=$Msg->msg_send_all($inin,$app['userid']);
										if($info['errcode']==0){
											$this->ajaxReturn(1); 
										}else{
											$this->ajaxReturn(7); 
										}										    
									    //$this->ajaxReturn(1);
									}else{
									    $this->ajaxReturn(7);
									}
								}
							}else{
							    $this->ajaxReturn(7); 
							}
							
							
							
						     //M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>2,'time'=>time()));
							//$this->ajaxReturn(1);
							// $this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
						}
					}else{
						$this->ajaxReturn(7); 
					}
				}
				//拒绝
				if($_GET['status']==3){
					if($_GET['a_id']){
						//if(M('Qyapplyflow_witer')->where(array('id'=>$_GET['a_id']))->save(array('status'=>3,'time'=>time())) && M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>3,'time'=>time()))){
						//	$this->ajaxReturn(1);//修改成功
							// $this->redirect(U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
						//}
						
						if(M('Qyapplyflow_witer')->where(array('id'=>$_GET['a_id']))->save(array('status'=>3,'time'=>time()))){
                            //F('$check',$check);
                            if(M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->save(array('status'=>3))){
							    $res = M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->find();
								//F('$rrrre',$res);
								if($res['wecha_id']){
								
									$map['wecha_id'] = $_GET['wecha_id'];
									$map['list_id'] = $_GET['id'];
									$map['content'] = $_POST['content'];
									$map['status'] = 3;
									$add = M('Qyapplyflow_comment')->add($map);									
								    //F('$map1',$map);
									//F('$add1',$add);
									//给报销申请人发送消息
									$inin['touser'] = $res['wecha_id'];
									$Msg=A('Qyapp/Msg');
									$inin['title']="您的报销申请已经被拒绝";
									$inin['description']="请您点击进入查看";
									$inin['picurl']="picurl";
									//$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_sp_info&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&pid='.$_GET['a_id'];
									$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Applyflow&a=wap_deny_info&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&pid='.$_GET['a_id'];
									$inin["agentid"]=$app['appid'];
									//F('$$inin',$inin);
									$info=$Msg->msg_send_all($inin,$app['userid']);
									//F('$info2',$info);
									if($info['errcode']==0){
										$this->ajaxReturn(1); 
									}else{
										$this->ajaxReturn(7); 
									}								    
								}else{
								    $this->ajaxReturn(7); 
								} 
							}else{
								$this->ajaxReturn(7);
							}
						
						}else{
						    $this->ajaxReturn(7);
						}
					}else{
						$this->ajaxReturn(7);
						// $this->ajaxReturn(1);//修改成功
					}
				}
				//撤销
				if($_GET['status']==4){
					// $this->ajaxReturn(1);
					if($_GET['a_id']){	
						$del = 	M('Qyapplyflow_witer')->where(array('pid'=>$check['pid']))->delete();
						$del2 = M('Qyapplyflow_user')->where(array('id'=>$check['pid']))->delete();
						if($del2 && $del){
							$this->ajaxReturn(1);
							// $this->redirect(U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
						}else{
							$this->ajaxReturn(2);
							// $this->redirect(U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
						}
					}else{
						$this->error("非法操作！");
					}
					
				}
			
			}

		}

	}
	//审核人对该次审核的理由
	public function wap_comment(){
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$data['list_id'] =  $_POST['id'];
			$data['wecha_id'] =  $_POST['wecha_id'];
			$data['content'] =  $_POST['content'];
			$data['status'] = $_POST['status'];
			$check = M('Qyapplyflow_comment')->where(array('list_id'=>$_POST['id'],'wecha_id'=>$_POST['wecha_id']))->find();
			if($check){
				$save = M('Qyapplyflow_comment')->where(array('id'=>$check['id']))->save($data);
				if($save){
					$this->ajaxReturn(1);//修改成功
				}else{
					$this->ajaxReturn(2);//修改失败
				}
			}else{
				$add = M('Qyapplyflow_comment')->add($data);
				if($add){
					$this->ajaxReturn(3);//发表成功
				}else{
					$this->ajaxReturn(4);//发表失败
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