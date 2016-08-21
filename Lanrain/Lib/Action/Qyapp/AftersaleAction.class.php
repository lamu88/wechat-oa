<?php
/**
 * 售后功能
 * @author hc
 * @time 2015-04-08
 */
class AftersaleAction extends Action{
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
/**
*配置审核人
**/
public function index(){
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
		$check=M('Qyaftersale_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($check){
			M('Qyaftersale_config')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
		}
		$id = M('Qyaftersale_config')->add($data); 
		if($id){
		    $this->success('设置成功',U('Aftersale/index',array('mid'=>$_GET['mid'])));
		}else{
		    $this->error('设置失败');
		}		
	}else{
	    $check=M('Qyaftersale_config')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
		if($check){
		    $check['audit'] = unserialize($check['audit']);
		    $audit = json_encode($check['audit']);
			$this->assign('audit',$audit);
			$this->display('config');  //显示已配置
		}else{
			$this->display('unconfig');	//显示未配置
		}

	}
}

/**
*配置售后类型
**/
public function saleType(){

	if(IS_POST){
	    $_POST['user_id']=$_SESSION['user_id'];	
		//print_r($_POST);exit;
		$info=M('Qyaftersale_type')->add($_POST);
		
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
 
	}else{
	    $userid=$_SESSION['user_id'];

	   $data=M('Qyaftersale_type')->where($userid)->order('disorder desc')->select();
	   
	   $this->assign('data',$data);
	   $this->display();
	}

}

/**
*增加
**/
public function add(){
    if(IS_POST){
	    $_POST['user_id'] = $_SESSION['user_id'];
	    if($info=M('Qyaftersale_type')->add($_POST)){
		    $this->success('添加成功',U('Aftersale/saleType',array('mid'=>$_GET['mid'])));	
		}else{
	        $this->error('添加失败');		
		}
	}else{
	    $this->display();	
	}

}

/**
*编辑
**/
public function edit(){
if(IS_POST){
    //print_r($_POST);exit;
    if($info=M('Qyaftersale_type')->save($_POST)){
		$this->success('修改成功',U('Aftersale/saleType',array('mid'=>$_GET['mid'])));
	}else{
	    $this->error('添加失败');
	}
}else{
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	$data=M('Qyaftersale_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();
	$this->assign('data',$data);
	$this->display();
}

}

/**
*删除
**/
public function del(){
    $id = $this->_POST('id');
    $user_id = $_SESSION['user_id'];
	$info=M('Qyaftersale_type')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
}

/**
*售后类型详情
**/
public function typeInfo(){
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	//$this->assign('user_id',$user_id);
	$data=M('Qyaftersale_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
	$this->assign('data',$data);
	$this->display();
}


/****************wap***************/

//我的售后申请列表,默认显示审核中的申请
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Aftersale';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	}
	$map['user_id'] = $app['userid'];
	$map['wecha_id'] = $_GET['wecha_id'];
	if($_GET['status']){
		$map['status'] = $_GET['status'];
	}else{
		$map['status'] = 1;//1表示审核中，2表示拒绝，3表示通过
	}	
	$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('id,name')->find();
	$list=M('Qyaftersale_list')->where($map)->order('time desc')->select();
	$this->assign('list',$list);
	$this->assign('name',$userinfo);
	$this->display();
}

//申请售后
public function wap_apply(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('appid,userid')->find();
		$data['user_id']=$app['userid'];
		$data['wecha_id']=$_POST['wecha_id'];
		if($_POST['type']){
			$data['type'] = $_POST['type'];
		}else{
			$data['type'] = '';
		}
		$data['title']=$_POST['title'];
		$data['content']=$_POST['content'];
		$data['status']=1;//1表示待审核
		$data['time']=time();
		if($_POST['pic']){
			$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$save_dir = "./Uploads/Aftersale/".$app['userid']."/".$_POST['wecha_id']."/";
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			$pic = explode(',',$_POST['pic']);
			$fileUrl = '';
			foreach($pic as $v){
				if($v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					$picFind=M('Qyaftersale_pic')->where(array('user_id'=>$user['id'],'pic'=>$filePath,'wecha_id'=>$_POST['wecha_id']))->find();
					if(!$picFind){
						$add = M('Qyaftersale_pic')->add(array('user_id'=>$user['id'],'pic'=>$filePath,'wecha_id'=>$_POST['wecha_id']));
						if($add){
							$fileUrl .= $add.',';
						}
					}
				}
			}
			$data['pic'] = $fileUrl;//保存图片ID
		}
		//F('$data2',$data);
		if($id=M('Qyaftersale_list')->add($data)){
		    //F('$id2',$id);
			//给审核人发送消息
			$users = M('Qyaftersale_config')->where(array('user_id'=>$app['userid']))->find();
			//F('$users2',$users);
			if($users){
			    $users['audit'] = unserialize($users['audit']);
			    $inin['touser'] = '';
			    $check = '';
			    foreach($users['audit'] as $k=>$v){
			    	if($v==''){
			    		$pid=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id']))->field('pid')->find();
						$father=M('Qy_node')->where(array('id'=>$pid['pid']))->field('node_user')->find();
			    		if($father){
			    			$check .= '|'.$father['node_user'].'|';
							$inin['touser'].=$father['node_user'];
						}
			    	}else{
			    		$check .='|'.$v.'|';
			    		$inin['touser'].=$v.'|';
			    	}
			    }
				$check1 = str_replace('||','|',$check);
			    $result = M('Qyaftersale_list')->where(array('id'=>$id))->setField('pid',$check1);
			}
			$inin['touser']=str_replace('|--','',$inin['touser']);
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个待审核申请";
			$inin['description']="请您点击进入审核";
			$inin['url']="http://".$_SERVER['SERVER_NAME']."/index.php?g=Qyapp&m=Aftersale&a=wap_act_my&token=".$_POST['token']."";	
			$inin["agentid"]=$app['appid'];
			//F('$inin2',$inin);
			$msg=$Msg->msg_send_all($inin,$app['userid']);
			//F('$msg2',$msg);
			if($msg['errcode']==0){
				$this->ajaxReturn(1);//发送成功
			 }else{
				 $this->ajaxReturn(2); 
			 }
			
		}else{
			$this->ajaxReturn(3);//申请失败	
		}
	}else{
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Aftersale';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_apply');
		}
		//JSSDK调用
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		$type = M('Qyaftersale_type')->where(array('user_id'=>$app['userid'],'status'=>1))->select();
		$this->assign('type',$type);
		$this->display();
	}
}

//我的审批,显示审核人是‘我’的申请,默认是正在审核中的
public function wap_act_my(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find(); 
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Aftersale';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_my');
		exit();
	}
	if($_GET['wecha_id']){
		$str = "|".$_GET['wecha_id']."|";
		if($_GET['status']){
			$map['status'] = $_GET['status'];
		}else{
			$map['status'] = 1;
		}
		$map['pid'] = array('like','%'.$str.'%');
		$map['user_id'] = $app['userid'];
		$list = M('Qyaftersale_list')->where($map)->order('time desc')->select();
		foreach($list as $k=>$v){
			$user=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('id,name')->find();
			$list[$k]['name'] = $user['name'];
		}
	}
	$this->assign('list',$list);
	$this->display();
}

//审核（通过、不通过）
/* public function wap_check(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$arr = array();
		$id = $_POST['id'];//我审核的申请ID
		$status = $_POST['status'];//状态，1表示通过，2表示拒绝
		$audit = M('Qyaftersale_list')->where(array('id'=>$id))->field('audit')->find();
		if(!$audit['audit']){
			$data = explode('|',$audit['pid']);
			foreach($data as $v){
				if($v){
					if($v==$_POST['wecha_id']){
						$arr[$v] = $status;
					}else{
						$arr[$v] = 0;//0表示正在审核
					}
				}
				
			}
			$str = serialize($arr);
			$save = M('Qyaftersale_list')->where(array('id'=>$id))->setField('audit',$str);
			if($save){
				$this->ajaxReturn(1);//审核成功（包括通过或拒绝）
			}else{
				$this->ajaxReturn(2);//审核失败
			} 
		}else{
			$result = unserialize($audit['audit']);
			$array = array();
			foreach($result as $ke=>$vo){
				if($ke==$_POST['wecha_id']){
					$array[$ke] = $status;
				}else{
					$array[$ke] = $vo;
				}
			}
			$strs = serialize($array);
			$saves = M('Qyaftersale_list')->where(array('id'=>$id))->setField('audit',$strs);
			if($saves){
				$this->ajaxReturn(1);//审核成功（包括通过或拒绝）
			}else{
				$this->ajaxReturn(2);//审核失败
			} 
		}
	}
} */

//我审核的申请的详情页
public function wap_act_info(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$arr = array();
		$lang = array();
		$id = $_POST['id'];//我审核的申请的ID
		$status = $_POST['status'];//状态，1表示通过，2表示拒绝
		$audit = M('Qyaftersale_list')->where(array('id'=>$id))->find();
		$data = explode('|',$audit['pid']);
		foreach($data as $v){
			if($v){
				if($v==$_POST['wecha_id']){
					$arr[$v] = $status;
				}else{
					$arr[$v] = 0;//0表示正在审核
				}
				$lang[] = $v;
			}	
		}
		if(!$audit['audit']){
			$str = serialize($arr);
			$save = M('Qyaftersale_list')->where(array('id'=>$id))->setField('audit',$str);
			if($save){
				$audittor = M('Qyaftersale_list')->where(array('id'=>$id))->field('audit')->find();
				$aduit_arr = unserialize($audittor['audit']);
				$l1 = count($lang);
				$l2 = count($aduit_arr);
				$a = '';
				$b = '';
				$l3 = $l1*2;
				if($l1 == $l2){//所有人都审核了
					foreach($aduit_arr as $va){
						if($va){
							if($va==1){
								$a +=$va;
							}
							if($va==2){
								$b +=$va;
							}
						}	
					}
					if($a == $l1){//所有人都审核通过了
						$sav = M('Qyaftersale_list')->where(array('id'=>$id))->setField('status',3);
					}
					if($b == $l3){//所有人都拒绝了
						$sav = M('Qyaftersale_list')->where(array('id'=>$id))->setField('status',2);
					}
				}
				
				$this->ajaxReturn(1);//审核成功（包括通过或拒绝）
			}else{
				$this->ajaxReturn(2);//审核失败
			} 
		}else{
			$result = unserialize($audit['audit']);
			$array = array();
			foreach($result as $ke=>$vo){
				if($ke==$_POST['wecha_id']){
					$array[$ke] = $status;
				}else{
					$array[$ke] = $vo;
				}
			}
			$strs = serialize($array);
			$saves = M('Qyaftersale_list')->where(array('id'=>$id))->setField('audit',$strs);
			if($saves){
				$audittors = M('Qyaftersale_list')->where(array('id'=>$id))->field('audit')->find();
				$aduit_arrs = unserialize($audittors['audit']);
				//F('tttttaaa',$aduit_arrs);
				$p1 = count($lang);
				$p2 = count($aduit_arrs);
				$m = '';
				$n = '';
				$p3 = $p1*2;
				if($p1 == $p2){//所有人都审核了
					foreach($aduit_arrs as $val){
						if($val){//排除正在审核的人员
							if($val==1){
								$m +=$val;
							}
							if($val==2){
								$n +=$val;
							}
						}	
					}
					if($m == $p1){//所有人都审核通过了
						$savl = M('Qyaftersale_list')->where(array('id'=>$id))->setField('status',3);
					}
					if($n == $p3){//所有人都拒绝了
						$savl = M('Qyaftersale_list')->where(array('id'=>$id))->setField('status',2);
					}
				}
				$this->ajaxReturn(1);//审核成功（包括通过或拒绝）
			}else{
				$this->ajaxReturn(2);//审核失败
			} 
		}
	}
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find(); 
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Aftersale';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_act_info');
		exit();
	}
	$result = M('Qyaftersale_list')->where(array('id'=>$_GET['id']))->find();
	$name = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$result['wecha_id']))->field('name')->find();
	$result['username'] = $name['name'];
	$image = array();
	if($result['pic']){
		$pic = explode(',',$result['pic']);
		foreach($pic as $v){
			if($v){
				$img = M('Qyaftersale_pic')->where(array('id'=>$v))->field('pic')->find();
				$image[] = $img['pic'];
			}
		}
	}
	$array = array();
	if($result['audit']){
		$aduit = unserialize($result['audit']);//已审核的人
		foreach($aduit as $ke=>$vo){
			$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$ke))->field('name,pic,userid')->find();
			$array[$ke]['status'] = $vo;
			$array[$ke]['pic'] = $user['pic'];
			$array[$ke]['name'] = $user['name'];
			$array[$ke]['wecha_id'] = $user['userid'];
			$commen = M('Qyaftersale_comment')->where(array('list_id'=>$_GET['id'],'wecha_id'=>$user['userid']))->find();
			$array[$ke]['comment'] = $commen['content'];
		}
	}else{
		$pid = explode('|',$result['pid']);
		foreach($pid as $key=>$val){
			if($val){
				$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$val))->field('name,pic')->find();
				$array[$key]['status'] = 0;
				$array[$key]['pic'] = $user['pic'];
				$array[$key]['name'] = $user['name'];
			}
		}
	}
	$this->assign('data',$result);
	$this->assign('aduit',$array);
	$this->assign('img',$image);
	$this->display();
}
//我申请的售后的详情页
public function wap_my_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find(); 
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Aftersale';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_my_info');
		exit();
	}
	$result = M('Qyaftersale_list')->where(array('id'=>$_GET['id']))->find();
	$name = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$result['wecha_id']))->field('name')->find();
	$result['username'] = $name['name'];
	$image = array();
	if($result['pic']){
		$pic = explode(',',$result['pic']);
		foreach($pic as $v){
			if($v){
				$img = M('Qyaftersale_pic')->where(array('id'=>$v))->field('pic')->find();
				$image[] = $img['pic'];
			}
		}
	}
	$array = array();
	if($result['audit']){
		$aduit = unserialize($result['audit']);//已审核的人
		foreach($aduit as $ke=>$vo){
			$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$ke))->field('name,pic,userid')->find();
			$array[$ke]['status'] = $vo;
			$array[$ke]['pic'] = $user['pic'];
			$array[$ke]['name'] = $user['name'];
			$array[$ke]['wecha_id'] = $user['userid'];
			$commen = M('Qyaftersale_comment')->where(array('list_id'=>$_GET['id'],'wecha_id'=>$user['userid']))->find();
			$array[$ke]['comment'] = $commen['content'];
		}
	}else{
		$pid = explode('|',$result['pid']);
		foreach($pid as $key=>$val){
			if($val){
				$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$val))->field('name,pic')->find();
				$array[$key]['status'] = 0;
				$array[$key]['pic'] = $user['pic'];
				$array[$key]['name'] = $user['name'];
			}
		}
	}
	$this->assign('data',$result);
	$this->assign('aduit',$array);
	$this->assign('img',$image);
	$this->display();
}

/* public function wap_del_my(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$id = $_POST['id'];
		$data=M('Qyaftersale_list')->where(array('id'=>$id))->field('pic')->find();
		$pic = explode(',',$data['pic']);
		if($id){
			$del = M('Qyaftersale_list')->where(array('id'=>$id))->delete();
			if($del){
				foreach($pic as $v){
					if($v){
						$picUrl = M('Qyaftersale_pic')->where(array('id'=>$v))->field('pic')->find();
						$remove = unlink($picUrl['pic']);
						if($remove){
							$delPic = M('Qyaftersale_pic')->where(array('id'=>$v))->delete();
						}
					}
				}
				$this->ajaxReturn(1);//删除成功
			}else{
				$this->ajaxReturn(2);//删除失败
			}
		}else{
			$this->ajaxReturn(3);//不能删除
		}
	}
} */

public function wap_eidt_my(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('appid,userid')->find();
		$data['user_id']=$app['userid'];
		$data['wecha_id']=$_POST['wecha_id'];
		$data['type'] = $_POST['type'];
		$data['title']=$_POST['title'];
		$data['content']=$_POST['content'];
		$data['status']=1;//1表示待审核
		$data['time']=time();
		if($_POST['pic']){
			$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$save_dir = "./Uploads/Aftersale/".$app['userid']."/".$_POST['wecha_id']."/";
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			$pic = explode(',',$_POST['pic']);
			$fileUrl = '';
			foreach($pic as $v){
				if($v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					$picFind=M('Qyaftersale_pic')->where(array('user_id'=>$user['id'],'pic'=>$filePath,'wecha_id'=>$_POST['wecha_id']))->find();
					if(!$picFind){
						$add = M('Qyaftersale_pic')->add(array('user_id'=>$user['id'],'pic'=>$filePath,'wecha_id'=>$_POST['wecha_id']));
						if($add){
							$fileUrl .= $add.',';
						}
					}
				}
			}
			if($_POST['picId']){
				$data['pic'] = $fileUrl.$_POST['picId'];//保存图片ID
			}else{
				$data['pic'] = $fileUrl;
			}
			
		}else{
			if($_POST['picId']){
				$data['pic'] = $_POST['picId'];
			}
		}
		if($id=M('Qyaftersale_list')->add($data)){
			//给审核人发送消息
			$users = M('Qyaftersale_config')->where(array('user_id'=>$app['userid']))->find();
			if($users){
			    $users['audit'] = unserialize($users['audit']);
			    $inin['touser'] = '';
			    $check = '';
			    foreach($users['audit'] as $k=>$v){
			    	if($v==''){
			    		$pid=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id']))->field('pid')->find();
						$father=M('Qy_node')->where(array('id'=>$pid['pid']))->field('node_user')->find();
			    		if($father){
			    			$check .= '|'.$father['node_user'].'|';
							$inin['touser'].=$father['node_user'];
						}
			    	}else{
			    		$check .='|'.$v.'|';
			    		$inin['touser'].=$v.'|';
			    	}
			    }
				$check1 = str_replace('||','|',$check);
			    $result = M('Qyaftersale_list')->where(array('id'=>$id))->setField('pid',$check1);
			}
			$inin['touser']=str_replace('|--','',$inin['touser']);
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个新申请";
			$inin['description']="请点击进入审核";
			$inin['url'] = "http://".$_SERVER['SERVER_NAME']."/index.php?g=Qyapp&m=Aftersale&a=wap_act_my&token=".$_POST['token']."";
			$inin["agentid"]=$app['appid'];
			$msg=$Msg->msg_send_all($inin,$app['userid']);
			if($msg['errcode']==0){
				$this->ajaxReturn(1);//发送成功
			 }else{
				 $this->ajaxReturn(2); 
			 }
			
		}else{
			$this->ajaxReturn(3);//申请失败	
		}
	}
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find(); 
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Aftersale';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_eidt_my');
		exit();
	}
	if($_GET['id']){
		$data = M('Qyaftersale_list')->where(array('id'=>$_GET['id']))->find();
		$pic = explode(',',$data['pic']);
		$img = array();
		foreach($pic as $k=>$v){
			if($v){
				$picUrl = M('Qyaftersale_pic')->where(array('id'=>$v))->field('pic,id')->find();
				$img[$k]['img'] = $picUrl['pic'];
				$img[$k]['id'] = $v;
			}
		}
	}
	$type = M('Qyaftersale_type')->where(array('user_id'=>$app['userid'],'status'=>1))->select();
	$this->assign('data',$data);
	$this->assign('img',$img);
	$this->assign('type',$type);
	$this->display();
	
}

//审核人对该次审核的理由
public function wap_comment(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$data['list_id'] =  $_POST['id'];
		$data['wecha_id'] =  $_POST['wecha_id'];
		$data['content'] =  $_POST['content'];
		$data['status'] = $_POST['status'];
		$check = M('Qyaftersale_comment')->where(array('list_id'=>$_POST['id'],'wecha_id'=>$_POST['wecha_id']))->find();
		if($check){
			$save = M('Qyaftersale_comment')->where(array('id'=>$check['id']))->save($data);
			if($save){
				$this->ajaxReturn(1);//修改成功
			}else{
				$this->ajaxReturn(2);//修改失败
			}
		}else{
			$add = M('Qyaftersale_comment')->add($data);
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