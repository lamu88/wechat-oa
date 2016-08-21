<?php
/**
*投票
**/
class VoteAction extends Action{
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
	*查看投票
	**/
	public function index(){
	    $this->check();
	    $status = $this->_GET('status');
	   if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		if($status){
			//已经结束
			if($status==3){
				$map['endtime']=array('lt',time());
				$map['user_id']=$_SESSION['user_id'];
				$count      = M('qyvote')->where($map)->count();
				$Page       = new Page($count,15);
				$data = M('qyvote')->order('id desc')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
				$show       = $Page->show();
			}else{
				$count      = M('qyvote')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
				$Page       = new Page($count,15);
				$data = M('qyvote')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
				$show       = $Page->show();	
			}
			
		}else{
			$count      = M('qyvote')->where(array('user_id'=>$_SESSION['user_id']))->count();
			$Page       = new Page($count,15);
			$data = M('qyvote')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();		    
		}
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}
	
	/**
	*查看投票
	**/
	public function conf(){
	    $this->check();
	    $status = $this->_GET('status');
	   if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		if($status){
			//已经结束
			if($status==3){
				$map['endtime']=array('lt',time());
				$map['user_id']=$_SESSION['user_id'];
				$count      = M('qyvote')->where($map)->count();
				$Page       = new Page($count,15);
				$data = M('qyvote')->order('id desc')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
				$show       = $Page->show();
			}else{
				$count      = M('qyvote')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
				$Page       = new Page($count,15);
				$data = M('qyvote')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
				$show       = $Page->show();	
			}
			
		}else{
			$count      = M('qyvote')->where(array('user_id'=>$_SESSION['user_id']))->count();
			$Page       = new Page($count,15);
			$data = M('qyvote')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();		    
		}
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}

	/**
	*添加文字投票
	**/	
	public function add(){
	    $this->check();
		if(IS_POST){
		    //dump($_POST);exit;
			$_POST['user_id'] = $_SESSION['user_id'];
			$_POST['endtime'] = strtotime($_POST['endtime']);  //投票截止时间
			$_POST['starttime'] = strtotime($_POST['starttime']);  //投票开始时间			
			$_POST['is_radio'] = $_POST['is_radio'] == 'on' ? 1 : 0;	
			//$_POST['content'] = serialize($_POST['content']);
			$_POST['type'] = trim($_POST['type']);  //投票类型
			//echo $_POST['starttime'].'<br>';
			//echo time();exit;
            if($_POST['starttime']>time()){
			    $_POST['status'] = 2;	//未开始			
			}else{
			    $_POST['status'] = 1;	//进行中			
			}	
            //$_POST['status'] = 4;	//未开启
            $_POST['switch'] = 2;	//未开启			
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$_POST['depart']=implode("|",$wxarr);
			$getDepart=A('Qyapp/Department');
			$departs=$getDepart->wap_department($_POST['depart'].'|',$_SESSION['user_id']);
			//参与抽奖人数算法
			$depart=explode('|',$departs);
			foreach($depart as $k=>$v){
				if($v){
					$arr[]='%;'.$v.';%';
				}
			}
			$count = 0;
			foreach($depart as $key=>$val){
			    if($val){
				    $n = M('qyusers')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>array('like','%'.$val.'%')))->count();
					//echo $n;exit;
					$count+=$n;
				}
			}
			//echo $count;exit;
			$_POST['nums'] = 0;    //投票人数 
			$_POST['count'] = $count;
			$_POST['node']=$departs;
			$_POST['time'] = time();  //创建时间
			//print_r($_POST);exit;
 			if($_POST['yz']){
			
				if(M('qyvote')->where(array('id'=>$_POST['yzmim']))->save($_POST)){
				$this->success('修改成功',U('Vote/conf',array('mid'=>$_GET['mid'])));
				}else{
				
				$this->success('修改失败');
				
				}
			}else{
			    $resultId = M('qyvote')->add($_POST);
				if($resultId){
					if(is_array($_POST['content']) && $_POST['content'] != ''){
						$result = array();
						foreach($_POST['content'] as $k=>$v){
							$result['user_id'] = $_SESSION['user_id'];
							$result['vote_id'] = $resultId;  //该选项在qyvote表中对应的id
							$result['option_number'] = $k;  //该选项编号
							$result['option_title'] = $v['option'];  //该选项名称
							$result['vote_number'] = 0;	  //该选项投票人数	
							//$result['vote_total'] = 0;	 //投票总人数	
					        M('qyvote_option_'.$_POST['type'])->add($result);                            							
						}					
					}
					
					$this->success('添加成功',U('Vote/conf',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('添加失败');
				}	
			} 
			
		}else{
			$type = $this->_GET('type');		
			if($type == 1){
				$this->assign('type',$type);
				$this->display('type_text');
			}else{
				$this->display('type_pic');		
			}	
		
		}
	}
//文字投票edit	
	public function edit(){
    $this->check();
		if($_GET['id']){
		
		
		$myvote=M('Qyvote')->where(array('id'=>$_GET['id']))->find();
		
		if($myvote['type']==1||$myvote['type']==2){
		
		$myvote['content']=unserialize($myvote['content']);
		
		$this->assign('myvote',$myvote);

		$this->display(type_text);
		
		
		}
		
		if($myvote['type']==3||$myvote['type']==4||$myvote['type']==5){
		
		$myvote['content']=unserialize($myvote['content']);
		
		$this->assign('myvote',$myvote);
		
		$this->display(type_pic);
		
		}
	
	
		
	
	}
	}
	
	/**
	*添加图片投票
	**/
	public function pic_add(){
	    $this->check();
		if(IS_POST){
		    //print_r($_POST);exit;
			$_POST['user_id'] = $_SESSION['user_id'];
			$_POST['endtime'] = strtotime($_POST['endtime']);
			$_POST['starttime'] = strtotime($_POST['starttime']);		
            if($_POST['starttime']>time()){
			    $_POST['status'] = 2;	//未开始			
			}else{
			    $_POST['status'] = 1;	//进行中			
			}	
            $_POST['switch'] = 2;	//未开启			
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$_POST['depart']=implode("|",$wxarr);
			$getDepart=A('Qyapp/Department');
			$departs=$getDepart->wap_department($_POST['depart'].'|',$_SESSION['user_id']);
			$_POST['node']=$departs;
			
			//参与抽奖人数算法
			$depart=explode('|',$departs);
			foreach($depart as $k=>$v){
				if($v){
					$arr[]='%;'.$v.';%';
				}
			}
			$map['pid'] =array('like',$arr,'OR');
			$map['user_id'] =$_SESSION['user_id'];
			//$_POST['count'] = M('Qyusers')->where($map)->count();	
            $_POST['nums'] = 0;			
			$_POST['time'] = time();
			$_POST['type'] = trim($_POST['temp']);  //投票类型；3多图对比；4赞成&反对；5评级
			$resultId = M('qyvote')->add($_POST);	
            if($resultId){
				if($_POST['type']==3){  //投票类型；3多图对比；
					//$_POST['imgurls']=serialize($_POST['GoodsImages']);
					if($_POST['GoodsImages']){
						$imgdata = array();
						foreach($_POST['GoodsImages'] as $k=>$v){
							$imgdata['user_id'] = $_SESSION['user_id'];
							$imgdata['vote_id'] = $resultId;  //该选项在qyvote表中对应的id					
							$imgdata['option_number'] = $k+1;	
							//$imgdata['option_title'] = $v['title'];							
							$imgdata['option_imgurl'] = $v['imgurl'];
							$imgdata['option_info'] = $_POST['information'][$k]['info'];	
							$imgdata['vote_number'] = 0;	  //该选项投票人数	
							//$result['vote_total'] = 0;	 //投票总人数	
							M('qyvote_option_3')->add($imgdata); 						
						}
					    $this->success('添加成功',U('Vote/conf',array('mid'=>$_GET['mid'])));						
				    }
				}elseif($_POST['type']==4){  //投票类型；4赞成&反对；
				    if($_POST['imgurl']){
					    $option = array();
					    $arr = array(1=>array('title'=>'赞成','info'=>''),2=>array('title'=>'反对','info'=>''));
						foreach($arr as $k=>$v){
							$option['user_id'] = $_SESSION['user_id'];
							$option['vote_id'] = $resultId;  //该选项在qyvote表中对应的id							
						    $option['option_number'] = $k;
							$option['option_title'] = $v['title'];							
							$option['option_imgurl'] = $_POST['imgurl'];
							$option['option_info'] = $v['info'];	
							$option['vote_number'] = 0;	  //该选项投票人数	
							//$result['vote_total'] = 0;	 //投票总人数	
							M('qyvote_option_4')->add($option); 								
							
						}
					    $this->success('添加成功',U('Vote/conf',array('mid'=>$_GET['mid'])));							
					}
				}elseif($_POST['type']==5){  //投票类型；5评级
				    if($_POST['imgurl']){
					    $option = array();
					    $arr = array(
						            1=>array('title'=>'1分','info'=>''),
									2=>array('title'=>'2分','info'=>''),
									3=>array('title'=>'3分','info'=>''),
									4=>array('title'=>'4分','info'=>''),
									5=>array('title'=>'5分','info'=>'')
						        );
						foreach($arr as $k=>$v){
							$option['user_id'] = $_SESSION['user_id'];
							$option['vote_id'] = $resultId;  //该选项在qyvote表中对应的id							
						    $option['option_number'] = $k;
							$option['option_title'] = $v['title'];							
							$option['option_imgurl'] = $_POST['imgurl'];
							$option['option_info'] = $v['info'];	
							$option['vote_number'] = 0;	  //该选项投票人数	
							//$result['vote_total'] = 0;	 //投票总人数	
							M('qyvote_option_5')->add($option); 								
							
						}
					    $this->success('添加成功',U('Vote/conf',array('mid'=>$_GET['mid'])));							
					}				
				}			
			}else{
				$this->error('添加失败');			
			}			

		}else{
			$this->display('type_pic');		
		}
	}
	
	
	/**
	*详情
	**/
	public function info(){
		    $this->check();
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('Qyvote')->where(array('id'=>$id,'user_id'=>$user_id))->find();
		//<if condition="$data['type'] eq 1">单选</if>
		//<if condition="$data['type'] eq 2">多选</if>
		//<if condition="$data['type'] eq 5">评级</if>
		//<if condition="$data['type'] eq 3">多图对比</if>
		//<if condition="$data['type'] eq 4">赞成反对</if>	
		if($data['type'] == 1){    //
		    $result=M('Qyvote_option_1')->where(array('vote_id'=>$data['id'],'user_id'=>$user_id))->select();	
			$option = array();
			if($result){
				foreach($result as $k=>$v){
					$option[$v['option_number']] = $v;
					if($data['nums'] == 0){
						$option[$v['option_number']]['rate'] = 0;    
					}else{
						$tmp = $v['vote_number']/$data['nums'];	
						$option[$v['option_number']]['rate'] = (sprintf("%04.2f",$tmp)*100).'%';
					}
				}			
			}
		
		}elseif($data['type'] == 2){    //
		    $result=M('Qyvote_option_2')->where(array('vote_id'=>$data['id'],'user_id'=>$user_id))->select();
			$option = array();
			if($result){			
				foreach($result as $k=>$v){
					$option[$v['option_number']] = $v;
					if($data['nums'] == 0){
						$option[$v['option_number']]['rate'] = 0;    
					}else{
						$tmp = $v['vote_number']/$data['nums'];	
						$option[$v['option_number']]['rate'] = (sprintf("%04.2f",$tmp)*100).'%';
					}
				}
            }			
		}elseif($data['type'] == 3){   
		    $result=M('Qyvote_option_3')->where(array('vote_id'=>$data['id'],'user_id'=>$user_id))->select();		
			$option = array();
			if($result){	
				foreach($result as $k=>$v){
					$option[$v['option_number']] = $v;
					$option[$v['option_number']]['option_info'] = mb_substr($v['option_info'],0,30,'utf-8');
					if($data['nums'] == 0){
						$option[$v['option_number']]['rate'] = 0;    
					}else{
						$tmp = $v['vote_number']/$data['nums'];	
						$option[$v['option_number']]['rate'] = (sprintf("%04.2f",$tmp)*100).'%';
					}
				}	
            }			
		}elseif($data['type'] == 4){
		    $result=M('Qyvote_option_4')->where(array('vote_id'=>$data['id'],'user_id'=>$user_id))->select();		
			$option = array();
			if($result){			
				foreach($result as $k=>$v){
					//$option[$v['option_number']] = $v;
					if($v['option_number'] == 1){  //赞成
						$option['agree_num'] = $v['vote_number'];
						if($data['nums'] == 0){
							//$option[$v['option_number']]['agree'] = 0; 
							$option['agree'] = 0;						
							
						}else{
							$tmp = $v['vote_number']/$data['nums'];	
							$option['agree'] = (sprintf("%04.2f",$tmp)*100).'%';
						}				
					}else{  //反对
						$option['disagree_num'] = $v['vote_number'];				
						if($data['nums'] == 0){
							$option['disagree'] = 0;  
							
						}else{
							$tmp = $v['vote_number']/$data['nums'];	
							$option['disagree'] = (sprintf("%04.2f",$tmp)*100).'%';
						}				
					}

					
				}	
		    }	
		}elseif($data['type'] == 5){
		    $result=M('Qyvote_option_5')->where(array('vote_id'=>$data['id'],'user_id'=>$user_id))->select();	
			if($result){
			    $total_score = 0;
			    foreach($result as $key=>$val){
				    $option[$key] = $val;
					/* if($data['nums'] == 0){
						//$option[$v['option_number']]['agree'] = 0; 
						$option[$key]['score'] = 0;						
						
					}else{
						$tmp = ($val['vote_number']*$val['option_number'])/$data['nums'];	
						$option[$key]['score'] = sprintf("%02.1f",$tmp);
					} */
                    $total_score += $val['vote_number']*$val['option_number'];					
				}
				if($data['nums'] == 0){
				    $scores = 0;
				}else{
				    $total_score = $total_score/$data['nums'];
					$scores = sprintf("%02.1f",$total_score);
				}
				
			}
		}
		//dump($result);exit;
				
		$count=M('Qyvote_record')->where(array('pid'=>$id,'user_id'=>$user_id))->count();
		$depart=explode('|', $data['depart']);
		foreach($depart as $k=>$v){
			$departmen=M('Department')->where(array('wxid'=>$v))->field('name')->find();
			$department.=$departmen['name'].'. ';
		}
		if($data['endtime'] >= time()){  //该投票正在进行
		    $overtime = time();
			//$switch = 1;
		}else{                           //该投票已经结束
		   $overtime = $data['endtime']; 
			//$switch = 0;		   
		}
		//if($data['starttime'] < time() && time() < $data['endtime']){  //该投票正在进行
		//	$switch = 1;
		//}else{                           //该投票已经结束 
		//	$switch = 2;		   
		//}		
		//dump($scores);exit;
		$this->assign('scores',$scores);
		$this->assign('department',$department);
		$this->assign('count',$count);
		$this->assign('data',$data);
		$this->assign('option',$option);
		//print_r($option);exit;
		//$this->assign('info',json_encode($option));		
		$this->assign('overtime',$overtime);	
		//$this->assign('switch',$switch);		
		$this->display();
	}


/**
*删除
**/
public function del(){
    $this->check();
		if(IS_POST){
		$data = M('qyvote')->where(array('id'=>$_POST['id']))->find();
		if(M('qyvote')->where(array('id'=>$data['id']))->delete()){
			echo json_encode(array('status'=>1));
		}
		
	}
}

/**
*关闭
**/
public function freeze(){
    $this->check();
	if(IS_POST){
	$data = M('qyvote')->where(array('id'=>$_POST['id']))->find();

	if(M('qyvote')->where(array('id'=>$data['id']))->save(array('switch'=>2))){
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
		$data = M('qyvote')->where(array('id'=>$_POST['id']))->find();
		$app=M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>'Vote'))->field('appid,token')->find();
		$Msg=A('Qyapp/Msg');
		$inin['title']="有一个投票活动需要您的参与,现在就去参与";
		$inin['description']=$data['title'].'截止时间:'.date("Y-m-d h:i", $data['endtime']);
		$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Vote&a=wap_index&token='.$app['token'].'&pid='.$data['id'];
		$inin["agentid"]=$app['appid'];
		$inin['toparty']=$data['depart'];
		$msc=$Msg->msg_send_depart($inin,$data['user_id']);
		if($msc['errcode']==0){
			if(M('qyvote')->where(array('id'=>$data['id']))->save(array('switch'=>1))){
				echo json_encode(array('status'=>0));
			}
		}else{
			echo json_encode(array('status'=>1));
		}
		
	}

}


/*************************************手机端***********************************/	
	/**
	*详情
	**/
	public function wap_index111(){
		//投票列表
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Vote';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$map['user_id']=$app['userid'];
		if($_GET['status']){
			$map['status']=$_GET['status'];
		}else{
			$map['status']=array('eq',1);
		}
		
		$users=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		$depart=explode(';',$users['pid']);
		foreach($depart as $k=>$v){
			if($v){
				$arr[]='%'.$v.'|%';
			}
		}
		$map['node'] =array('like',$arr,'OR');
		$map['switch']=1;
		$votes=M('Qyvote')->where($map)->order('id desc')->select();
		//print_r($votes);exit;
		$vas = array();
		foreach($votes as $ke=>$va){
			$vas[$ke]=$va;
			$depart=explode('|',$va['node']);
			$count=$va['count'];
			$vas[$ke]['count']=$count;
			$vas[$ke]['bi']=round(($va['nums']/$count)*100);
		    $vas[$ke]['xuanze']=M('Qyvote_record')->where(array('wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'pid'=>$va['id']))->find();	
		}
		$this->assign('votes',$vas);
		//print_r($vas);exit;
		$this->display();
	}

	/**
	*详情
	**/
	public function wap_index(){
		//投票列表
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Vote';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$map['user_id']=$app['userid'];
		if($_GET['status']){
			$map['status']=$_GET['status'];
		}else{
			$map['status']=array('eq',1);
		}
	    $map['switch']=1;
		$users=M('Qyusers')->where(array('user_id'=>$app['userid']))->select();
		$votes=M('Qyvote')->where($map)->order('id desc')->select();
		foreach($votes as $ke=>$va){
		    $departments = array_filter(explode('|',$va['node']));
			$count = 0;
			foreach($users as $k=>$v){
			    $arr = array_filter(explode(';',$v['pid']));
				if(array_intersect($departments,$arr)){
				    $count++;
				}
			}
			//echo $count;
			$vas[$ke]=$va;
			$depart=explode('|',$va['node']);
			//$count=$va['count'];
			$vas[$ke]['count']=$count;
			$vas[$ke]['bi']=round(($va['nums']/$count)*100);
		    $vas[$ke]['xuanze']=M('Qyvote_record')->where(array('wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'pid'=>$va['id']))->find();				
			//$users=M('Qyusers')->where(array('pid'=>array('like',),'user_id'=>$app['userid']))->select();
		}
		//dump($vas);exit;
		$this->assign('votes',$vas);
		$this->display();
	}	
	
	public function wap_vote(){
		$type = trim($_GET['type']);
		//投票列表
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Vote';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
		}
		//获取投票标题信息
		$vote=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_GET['id']))->find();
		if(time()>$vote['endtime']){  //超过结束时间无法投票 
			M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_GET['id']))->save(array('status'=>3));
		}
		//echo 'www';exit;
		//$content=unserialize($vote['content']);
		//显示投票内容
		if($type == 1){
		    $content = M('Qyvote_option_1')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
			$record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			if($record['chose']){
				//$arr = array_filter(explode('|',$record['chose']));
				$option = M('Qyvote_option_1')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'option_number'=>$record['chose']))->find();
				$record['name'] = $option['option_title']; 
			}
		}elseif($type == 2){
		    $content = M('Qyvote_option_2')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
			$record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			if($record['chose_t']){
				$arr = array_filter(explode('|',$record['chose_t']));
				//dump($arr);exit;
				foreach($arr as $k=>$v){
				    //dump(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'id'=>$record['pid'],'option_number'=>$v));exit;
					$option = M('Qyvote_option_2')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'option_number'=>$v))->find();
					//dump($option);exit;
					$res[$k]['name'] = $option['option_title'];
				}
			}
			$record['chose_t'] = $res;			
		}elseif($type == 3){  //多图对比
		    $content = M('Qyvote_option_3')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
			$record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			if($record['chose']){
				//$arr = array_filter(explode('|',$record['chose']));
				$option = M('Qyvote_option_3')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'option_number'=>$record['chose']))->find();
				$record['name'] = $option['option_info']; 
			}
		}elseif($type == 4){  //赞成反对
		    $content = M('Qyvote_option_4')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
			$record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			//if($record['zan']){
				//$arr = array_filter(explode('|',$record['chose']));
			//	$option = M('Qyvote_option_4')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'option_number'=>$record['zan']))->find();
			//	$record['name'] = $option['option_title']; 
			//}
		}elseif($type == 5){  //评级
		    $content = M('Qyvote_option_5')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
			$record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			//if($record['score']){
				//$option = M('Qyvote_option_5')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id'],'option_number'=>$record['score']))->find();
			//	$record['score'] = $record['score']; 
			//}
		}
		//显示其他人投票内容
		//dump($content);exit;
		//print_r($record);exit;
		//if($record = M('Qyvote_record_'.$_GET['type'])->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find()){
		//	$record = 1;
		//}else{
		//	$record = 0;
		//}	
        //dump($record);exit;		
		$this->assign('newsp',$newsp);		
		$this->assign('vote',$vote);	
		$this->assign('record',$record);		
		$this->assign('info',$content);
		$this->display('wap_vote'.$_GET['type']);	
		
		
/* 		$content=M('Qyvote_option')->where(array('user_id'=>$app['userid'],'vote_id'=>$_GET['id']))->select();
		//echo $_GET['type'];exit;
		$this->assign('content',$content);
		$this->assign('vote',$vote);
		$record=M('Qyvote_record')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id'],'wecha_id'=>$_GET['wecha_id']))->find();
		$this->assign('record',$record);
		//dump($record);
		$count=M('Qyvote_record')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id']))->count();
		if($_GET['type']==5){
			$avg=M('Qyvote_record')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['id']))->avg('score');
			$this->assign('avg',round($avg,1));
		}
		if($_GET['type']==3){
			$imgurls=unserialize($vote['imgurls']);
			$this->assign('imgurls',$imgurls);
			$cc=M('qyvote_record')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$_GET['id']))->find();
			$this->assign('cc',$cc);

		}
		$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->find();
		if($conf['endtime']<time()){
				$this->assign('stop','1');
		}
		
		$somepe=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
		$newsp=M('Qyvote_record')->where(array('user_id'=>$somepe['userid'],'pid'=>$_GET['id']))->limit(5)->select();
		$this->assign('newsp',$newsp);
		$this->assign('count',$count);
		$this->display('wap_vote'.$_GET['type']); */
	}
	
	
	
	
	
	public function pwap_vote3(){
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['id']))->find();
			
			if($conf['endtime']<time()){
				$this->redirect(U('wap_vote',array('type'=>3,'id'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'token'=>$_POST['token'])));
			}
			if($cc=M('qyvote_record')->where(array('wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['id']))->find()){
				
			}else{
				$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
				$_POST['user_id']=$app['userid'];
				$_POST['pid']=$_POST['id'];
				unset($_POST['id']);
				M('qyvote_record')->add($_POST);
				M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');
				$this->redirect(U('wap_index',array('wecha_id'=>$_POST['wecha_id'],'token'=>$_POST['token'])));
			}
		}		
	}
	
	/**
	*单选投票
	**/
	public function wap_vote1(){
		if(IS_POST){
		    //dump($_POST);exit;
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->find();
			if($conf['endtime']<time()){  //投票已经过期
				echo json_encode(array('status'=>3));	
				exit;
			}
			//$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$check=M('Qyvote_record_1')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){  //已经投过票
				echo json_encode(array('status'=>0));
			}else{    //未投票，将投票记录记录表中
			    $option = preg_replace('/option_/i','',$_POST['chose']); 
			    if($option && is_numeric($option)){
					if(M('Qyvote_record_1')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'chose'=>$option))){
						M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');  //对总投票人数计数
						M('Qyvote_option_1')->where(array('user_id'=>$app['userid'],'vote_id'=>$_POST['pid'],'option_number'=>$option))->setInc('vote_number');  //对投票选项进行投票
						echo json_encode(array('status'=>1));
						exit;
					}else{
						echo json_encode(array('status'=>0));
						exit;
					}				
				
				}else{
				    echo json_encode(array('status'=>0));
				    exit;					
				};

			}
		}
	}
	
	/**
	*多选投票
	**/	
	public function wap_vote2(){
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->find();
			if($conf['endtime']<time()){  //投票已经过期
				echo json_encode(array('status'=>3));	
				exit;
			}
			
			$check=M('Qyvote_record_2')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){  //已经投过票
				echo json_encode(array('status'=>2));
				exit;
			}else{
				if($_POST['chose']){
				
					$arr = explode('|',$_POST['chose']);
					if(!empty($arr)){
					    //M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->save(array('status'=>3));  
						M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');  //投票人数加1
						if(M('Qyvote_record_2')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'chose_t'=>$_POST['chose']))){
							foreach($arr as $k=>$v){
								if($v != ''){
								   M('Qyvote_option_2')->where(array('user_id'=>$app['userid'],'vote_id'=>$_POST['pid'],'option_number'=>$v))->setInc('vote_number');
									echo json_encode(array('status'=>1));
									exit;
								}else{
									echo json_encode(array('status'=>0));
									exit;
								}
							}						
						}

					}else{
						echo json_encode(array('status'=>0));
						exit;
					}
				}else{
					echo json_encode(array('status'=>0));
					exit;
				}			
			}			
			
		}
	}

	/**
	*单选投票
	**/
	public function wap_vote3(){
		if(IS_POST){
		    //dump($_POST);exit;
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->find();
			if($conf['endtime']<time()){  //投票已经过期
				echo json_encode(array('status'=>3));	
				exit;
			}
			//$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$check=M('Qyvote_record_3')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){  //已经投过票
				echo json_encode(array('status'=>0));
			}else{    //未投票，将投票记录记录表中
			    //$option = preg_replace('/option_/i','',$_POST['chose']); 
				$option = trim($_POST['select']);
				$info = M('Qyvote_option_3')->where(array('user_id'=>$app['userid'],'id'=>$option))->find();
			    if($info['option_number']){
					if(M('Qyvote_record_3')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'chose'=>$info['option_number']))){
						M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');  //对总投票人数计数
						M('Qyvote_option_3')->where(array('user_id'=>$app['userid'],'vote_id'=>$_POST['pid'],'id'=>$option))->setInc('vote_number');  //对投票选项进行投票
						echo json_encode(array('status'=>1));
						exit;
					}else{
						echo json_encode(array('status'=>0));
						exit;
					}				
				
				}else{
				    echo json_encode(array('status'=>0));
				    exit;					
				};

			}
		}
	}
	
	/**
	*赞成反对投票
	**/
	public function wap_vote4(){
		if(IS_POST){
		    //print_r($_POST);exit;
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->find();
			if($conf['endtime']<time()){  //投票已经过期
				echo json_encode(array('status'=>3));	
				exit;
			}
			//$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$check=M('Qyvote_record_4')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){  //已经投过票
				echo json_encode(array('status'=>2));
			}else{    //未投票，将投票记录记录表中
				if(M('Qyvote_record_4')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'zan'=>$_POST['type']))){
					M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');  //对总投票人数计数				
					M('Qyvote_option_4')->where(array('user_id'=>$app['userid'],'vote_id'=>$_POST['pid'],'option_number'=>$_POST['type']))->setInc('vote_number');  //对投票选项进行投票
					echo json_encode(array('status'=>1));
					exit;	
				
				}else{
					echo json_encode(array('status'=>0));
					exit;
				}			    

			}
		}
	}	

	// public function wap_vote3(){
		// if(IS_POST){
		
			
			// $app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			// $str="";
			// foreach($_POST['check'] as $k=>$v){
				// $str.=$v.';';
			// }
			// $check=M('Qyvote_record')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			// if($check){
				
			// }else{
				// if(M('Qyvote_record')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'chose_t'=>';'.$str))){
					// M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');
					// $this->redirect(U('wap_vote',array('type'=>2,'wecha_id'=>$_POST['wecha_id'],'token'=>$_POST['token'])));
				// }else{
					// $this->redirect(U('wap_vote',array('type'=>2,'wecha_id'=>$_POST['wecha_id'],'token'=>$_POST['token'])));
				// }
			// }
		// }
	// }
	
/* 	public function wap_vote4(){
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$check=M('Qyvote_record')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){
				echo json_encode(array('status'=>0));
			}else{
				if(M('Qyvote_record')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'zan'=>$_POST['type']))){
					M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');
					echo json_encode(array('status'=>1));
				}else{
					echo json_encode(array('status'=>0));
				}
			}
		}
	} */
	
	public function wap_vote5(){
		if(IS_POST){
		    //print_r($_POST);exit;
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$conf=M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->find();
			if($conf['endtime']<time()){
				echo json_encode(array('status'=>3));	
			}
			$check=M('Qyvote_record_5')->where(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){
				echo json_encode(array('status'=>0));
			}else{
				if(M('Qyvote_record_5')->add(array('pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'score'=>$_POST['score']))){
					M('Qyvote')->where(array('user_id'=>$app['userid'],'id'=>$_POST['pid']))->setInc('nums');
					M('Qyvote_option_5')->where(array('user_id'=>$app['userid'],'vote_id'=>$_POST['pid'],'option_number'=>$_POST['score']))->setInc('vote_number');
					echo json_encode(array('status'=>1));
				}else{
					echo json_encode(array('status'=>0));
				}
			}
		}
		
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}