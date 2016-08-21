<?php
/**
*调研
**/
class ResearchAction extends Action{
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
*问卷调查
**/	
public function index(){
    $this->check();
	$where = array('user_id'=>$_SESSION['user_id']);
	//未发布
	if($_GET['status']==1){
		$where['status'] = 1;
	}
	//已发布
	if($_GET['status']==2){
	$where['status'] = 2;
	}
	//暂停
	if($_GET['status']==3){
		$where['status'] = 3;
	}
	//结束
	if($_GET['status']==4){
		$where['status'] = 4;
	}
	$count      = M('qyresearch')->where($where)->count();
	$Page       = new Page($count,20);
	$show       = $Page->show();
	$data = M('qyresearch')->where($where)->order('end_time desc')->select();
	$this->assign('page',$show);
	$this->assign('data',$data);
	$this->display();
}


/**
*问卷调查
**/	
public function conf(){
    $this->check();
	$where = array('user_id'=>$_SESSION['user_id']);
	//未发布
	if($_GET['status']==1){
		$where['status'] = 1;
	}
	//已发布
	if($_GET['status']==2){
	$where['status'] = 2;
	}
	//暂停
	if($_GET['status']==3){
		$where['status'] = 3;
	}
	//结束
	if($_GET['status']==4){
		$where['status'] = 4;
	}
	$count      = M('qyresearch')->where($where)->count();
	$Page       = new Page($count,20);
	$show       = $Page->show();
	$data = M('qyresearch')->where($where)->order('end_time desc')->select();
	$this->assign('page',$show);
	$this->assign('data',$data);
	$this->display();
}

/**
*添加问卷
**/	
public function add(){
    $this->check();
	if(IS_POST){
	    //dump($_POST);exit;
		$_POST['user_id']=$_SESSION['user_id'];
		$ids=explode(',',$_POST['departid']);
		//dump($ids);exit;
		foreach($ids as $k=>$v){
			$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
			$wxarr[$k]=$wxid['wxid'];
		}
		//dump($wxarr);exit;
		$_POST['departid']=implode("|",$wxarr);
		//dump($_POST['departid']);exit;		
		//子部门算法
		$getDepart=A('Qyapp/Department');
		$departs=$getDepart->wap_department($_POST['departid'].'|',$_SESSION['user_id']);
		$_POST['alldepart']=$departs;
		
		$_POST['end_time']=strtotime($_POST['end_time']);
		if($id = M('qyresearch')->add($_POST)){
			$this->success('调研信息添加成功！',U('Research/conf',array('mid'=>$_GET['mid'])));
		}else{
			$this->error('调研信息添加失败！');
		}
	}else{
		$set=array();
		$set['time']=time()+10*24*3600;
		$this->assign('set',$set);
		$this->display();
	}
}

/**
*部门
**/	
public function tree(){
	$this->display();
}

/**
*问卷详情
**/	
public function testInfo(){
    $this->check();
	$count      = M('Qyresearch_an')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_GET['id']))->count();
	$Page       = new Page($count,15);
	$data = M('Qyresearch_an')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_GET['id']))->limit($Page->firstRow.','.$Page->listRows)->select();
	$show       = $Page->show();
	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}

/**
*编辑
**/	
public function edit(){
    $this->check();
    if(IS_POST){
	    $_POST['user_id']=$_SESSION['user_id'];
		$_POST['end_time'] = strtotime($_POST['end_time']);
		
		$ids=explode(',',$_POST['departid']);
		foreach($ids as $k=>$v){
			$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
			$wxarr[$k]=$wxid['wxid'];
		}
		$_POST['departid']=implode("|",$wxarr);	
		if(empty($_POST['departid'])){
					$data = M('qyresearch')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
					$_POST['departid']=$data['departid'];
				}		
	    if(M('qyresearch')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->save($_POST)){
		    $this->success('修改成功',U('Research/conf',array('mid'=>$_GET['mid'])));
		}else{
		    $this->error('修改失败');
		}
	}else{
		$id = $this->_get('id');
		$data = M('qyresearch')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
		$arr=explode('|',$data['departid']);
		foreach($arr as $k=>$v){
			$n=M('Department')->where(array('wxid'=>$v))->field('name')->find();
			$str.=$n['name'].';';
		}
		$departid=str_replace('|',',',$data['departid']);
		$this->assign('departid',$departid);
		$this->assign('str',$str);
		//ump($data);exit;
		$this->assign('data',$data);
		$this->display();	
	}

}

/**
*问题编辑
**/	
public function askEdit(){
       $this->check(); 
	$count  = M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$this->_get('id')))->count();
	$Page   = new Page($count,15);
	$data = M('Qyresearch_ques')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$this->_get('id')))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
	$show       = $Page->show();
	if($data){
	    $chart = 1;
	}else{
	    $chart = 0;	
	}
	$this->assign('page',$show);
	$this->assign('data',$data);
	$this->assign('chart',$chart);
	$this->assign('pid',$this->_get('id'));
	$this->display();
}

/**
*发布
**/	
public function fabu(){
    $this->check();
	if(IS_POST){
		$data = M('qyresearch')->where(array('id'=>$_POST['id']))->find();
		$app=M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>'Research'))->field('appid,token')->find();
		$Msg=A('Qyapp/Msg');
		$inin['title']="有一个调查问卷需要您的参与,现在就去答卷";
		$inin['description']=$data['title'].$data['type'].'截止时间:'.date("Y-m-d h:i", $data['end_time']);
		$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Research&a=wap_index&token='.$app['token'].'&pid='.$data['id'];
		$inin["agentid"]=$app['appid'];
		$inin['toparty']=$data['departid'];
		//F('app',$app);
		$Msg->msg_send_depart($inin,$data['user_id']);
		if(M('Qyresearch')->where(array('id'=>$data['id']))->save(array('status'=>2))){
			echo json_encode(array('status'=>1));
		}
		
	}
}


//暂停

public function stop(){
    $this->check();
	if(IS_POST){
		$data = M('qyresearch')->where(array('id'=>$_POST['id'],'user_id'=>$_SESSION['user_id']))->find();
		if(M('Qyresearch')->where(array('id'=>$data['id']))->save(array('status'=>3))){
			echo json_encode(array('status'=>1));
		}
		
	}
}
/**
*问卷详情
**/	
public function del(){
    $this->check();
	if(IS_POST){
		//$data = M('qyresearch')->where(array('id'=>$_POST['id']))->find();
		if(M('Qyresearch')->where(array('id'=>$_POST['id'],'user_id'=>$_SESSION['user_id']))->delete()){
		    $data = M('Qyresearch_ques')->where(array('pid'=>$_POST['id'],'user_id'=>$_SESSION['user_id']))->select();
			if($data){
				foreach($data as $k=>$v){
					M('Qyresearch_option_'.$v['type'])->where(array('pid'=>$v['id'],'user_id'=>$_SESSION['user_id']))->delete();
				}			
			}
		    M('Qyresearch_ques')->where(array('pid'=>$_POST['id'],'user_id'=>$_SESSION['user_id']))->delete();
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));		
		}
		
	}
}

/**
*问卷详情
**/	
public function analysisInfo(){
    $this->check();
	//$count      = M('Qyresearch_an')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_GET['id']))->count();
	//$Page       = new Page($count,15);
	//$data = M('Qyresearch_an')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_GET['id']))->limit($Page->firstRow.','.$Page->listRows)->select();
	
	//$show       = $Page->show();
	//$this->assign('data',$data);
	//$this->assign('page',$show);	
	$this->display();
}

public function addproblem(){
	    $this->check();
	//$_POST['options']=serialize($_POST['options']);
	$data = array();	
	$data['user_id']= $_SESSION['user_id'];
	$data['pid']= $_POST['pid'];
	$data['type']= $_POST['type'];
	$data['disorder']= $_POST['number'];	
	$data['p_description']= $_POST['p_description'];
	$num = M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$data['pid']))->count();
	$data['number']= $num+1;	
	$id = M('Qyresearch_ques')->add($data);
	if($id){ 
		if($_POST['type'] == 1){  
			if($_POST['options']){
				$i = 1;
				foreach($_POST['options'] as $v){  //单选题
					if(!empty($v)){
	                    $info['user_id']= $_SESSION['user_id'];	
	                    $info['pid']= $id;						
						$info['option_number'] = $i;
						$info['option_title'] = $v;					
					}
					M('Qyresearch_option_1')->add($info);	
					$i++;				
				}
				$this->redirect(U('askEdit',array('id'=>$_POST['pid'])));			
			}else{
			    M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_POST['pid']))->delete();
				$this->error('操作失败');		
			}
		
		}elseif($_POST['type'] == 2){  //多选题
			if($_POST['options']){
				$i = 1;
				foreach($_POST['options'] as $v){
					if(!empty($v)){
	                    $info['user_id']= $_SESSION['user_id'];	
	                    $info['pid']= $id;						
						$info['option_number'] = $i;
						$info['option_title'] = $v;					
					}
					M('Qyresearch_option_2')->add($info);	
					$i++;				
				}
				$this->redirect(U('askEdit',array('id'=>$_POST['pid'])));			
			}else{
			    M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_POST['pid']))->delete();
				$this->error('操作失败');		
			}		
		
		}elseif($_POST['type'] == 3){  //评分题
			if($_POST['options']){
				$i = 1;
				foreach($_POST['options'] as $v){
					if(!empty($v)){
	                    $info['user_id']= $_SESSION['user_id'];	
	                    $info['pid']= $id;						
						$info['option_number'] = $i;
						$info['option_title'] = $v;					
					}
					M('Qyresearch_option_3')->add($info);	
					$i++;				
				}
				$this->redirect(U('askEdit',array('id'=>$_POST['pid'])));			
			}else{
			    M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$_POST['pid']))->delete();
				$this->error('操作失败');		
			}		
		
		}

		$this->redirect(U('askEdit',array('id'=>$_POST['pid'])));
	}else{
		$this->error('操作失败');
	}	
	
}

/**
*问卷分析
**/	
public function analysis(){
    $this->check();
    $id = $this->_get('id');
	$info = M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$id))->order('disorder asc,number asc')->select();
	if($info){
	    foreach($info as $k=>$v){
		    $data[$k]['id'] = $v['id'];		
		    $data[$k]['type'] = $v['type'];
		    $data[$k]['number'] = $v['number'];	
		    $data[$k]['p_description'] = $v['p_description'];				
			if($v['type'] ==1){
		        $res = M('Qyresearch_option_1')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();			
				foreach($res as $key=>$val){
					$data[$k]['table'][$key]['number'] = $val['option_number'];  //表格中选项序号
					$data[$k]['table'][$key]['option_title'] = $val['option_title'];  //表格中选项标题
					$data[$k]['table'][$key]['nums'] = $val['hits'];  //表格中选项人数
					if($v['total'] == 0){
						$data[$k]['table'][$key]['rate'] = 0;    
					}else{
						$tmp = $val['hits']/$v['total'];	
						$data[$k]['table'][$key]['rate'] = (sprintf("%04.2f",$tmp)*100).'%';
					}					
				}
				//表格内容说明信息
				//$data[$k]['table'] = $table;
				//总人数
				$data[$k]['total'] = $v['total'];					
			}elseif($v['type'] ==2){
		        $res = M('Qyresearch_option_2')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();			
				foreach($res as $key=>$val){
					$data[$k]['table'][$key]['number'] = $val['option_number'];  //表格中选项序号
					$data[$k]['table'][$key]['option_title'] = $val['option_title'];  //表格中选项标题
					$data[$k]['table'][$key]['nums'] = $val['hits'];  //表格中选项人数
					if($v['total'] == 0){
						$data[$k]['table'][$key]['rate'] = 0;    
					}else{
						$tmp = $val['hits']/$v['total'];	
						$data[$k]['table'][$key]['rate'] = (sprintf("%04.2f",$tmp)*100).'%';
					}					
				}
				//表格内容说明信息
				//$data[$k]['table'] = $table;
				//总人数
				$data[$k]['total'] = $v['total'];			
			}elseif($v['type'] ==3){
		        $res = M('Qyresearch_option_3')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();
 				foreach($res as $key=>$val){
					$data[$k]['table'][$key]['option_number'] = $val['option_number'];  //表格中选项序号
					$data[$k]['table'][$key]['option_title'] = $val['option_title'];  //表格中选项标题
					$data[$k]['table'][$key]['nums'] = $val['score_1']+$val['score_2']+$val['score_3']+$val['score_4']+$val['score_5'];  //该选项总人数							
					if($v['total'] == 0){
						$data[$k]['table'][$key]['score'] = 0; 											
					}else{
						$tmp = (($val['score_1']*1+$val['score_2']*2+$val['score_3']*3+$val['score_4']*4+$val['score_5']*5)/($v['total']*5))*5;	
						$data[$k]['table'][$key]['rate'] = sprintf("%02.1f",$tmp);					
					}					
				}               				
				//表格内容说明信息
				//$data[$k]['table'] = $table;
				//总人数
				$data[$k]['total'] = $v['total'];				
			}elseif($v['type'] ==4){
		        $res = M('Qyresearch_option_4')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->order('id desc')->limit(5)->select();	
				if($res){
					foreach($res as $m=>$n){
					   $data[$k]['table'][$m]['number']  = $m+1; 
					   $data[$k]['table'][$m]['answer']  = $n['answer']; 					   
					}				
				}
				//总人数
				$data[$k]['total'] = $v['total'];				
			}elseif($v['type'] ==5){
		        $res = M('Qyresearch_option_5')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->order('id desc')->limit(5)->select();	
				if($res){
					foreach($res as $m=>$n){
					   $data[$k]['table'][$m]['number']  = $m+1; 
					   $data[$k]['table'][$m]['answer']  = $n['answer']; 					   
					}				
				}
				//总人数
				$data[$k]['total'] = $v['total'];				
			}
			
		}
	} 
	//print_r($data);exit;
	$this->assign('id',$id);
	$this->assign('data',$data);	
	$this->display();
}

/**
*ajax获取图表数据
**/
public function getData(){
    $this->check();
    if(IS_POST){
	    $id = $this->_post('id');  //问卷id
		$result = M('Qyresearch')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
		if($result){
			if($result['end_time']<time()){
				$analysisdate = date("Y-m-d H:i",$result['end_time']);
			}else{
				$analysisdate = date("Y-m-d H:i",time());
			}
		}
		$arr = M('Qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$id))->select();
		if($arr){
		    foreach($arr as $k=>$v){
			    if($v['type'] == 1){
					$res = M('Qyresearch_option_1')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();
					if($res){
						foreach($res as $key=>$val){
							$xaxis[$key] = $val['option_title'];  //X轴内容
							$info[$k][$key]['name'] = $val['option_title'];	
							if($v['total'] == 0){
								$info[$k][$key]['y'] = 0;    
							}else{
								$tmp = $val['hits']/$v['total'];	
								$info[$k][$key]['y'] = (sprintf("%04.2f",$tmp)*100);
							}					
						}	
						$return[$k] = array('id'=>$v['id'],'type'=>$v['type'],'datetime'=>$analysisdate,'categories'=>$xaxis,'data'=>$info[$k],'title'=>$v['p_description']);					
					}				
				}elseif($v['type'] == 2){
					$res = M('Qyresearch_option_2')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();
					if($res){
						foreach($res as $key=>$val){
						    
							$xaxis[$key] = $val['option_title'];  //X轴内容
							$info[$k][$key]['name'] = $val['option_title'];	
							if($v['total'] == 0){
								$info[$k][$key]['y'] = 0;    
							}else{
								$tmp = $val['hits']/$v['total'];	
								$info[$k][$key]['y'] = (sprintf("%04.2f",$tmp)*100);
							}
							$info[$k][$key]['color'] = '#'.$this->randColor();								
						}	
						$return[$k] = array('id'=>$v['id'],'type'=>$v['type'],'datetime'=>$analysisdate,'categories'=>$xaxis,'data'=>$info[$k],'title'=>$v['p_description']);					
					}				
				}elseif($v['type'] == 3){
					$res = M('Qyresearch_option_3')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();
					if($res){
					    foreach($res as $key=>$val){
						    $score[$k][$key] = $val;
						}
						$return[$k] = array('id'=>$v['id'],'score'=>$score[$k],'datetime'=>$analysisdate,'type'=>$v['type'],'data'=>'','categories'=>'','title'=>$v['p_description']);					
					}
					//print_r($return);exit;
					
				}
	
			}
		}else{
		    $return = array('status'=>0);
		}
		//print_r($return);exit;
		echo json_encode($return);		
		
	}

}

/**
*随机生成颜色
**/
private function randColor(){
    $colors = array();
    for($i = 0;$i<6;$i++){
        $colors[] = dechex(rand(0,15));
    }
    return implode('',$colors);
}
/**
*详情
**/
public function info(){
    $id = intval($this->_get('id')); 
    $data = M('qyresearch')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
	$depart=explode('|', $data['departid']);
	foreach($depart as $k=>$v){
		$department[$k]=M('Department')->where(array('wxid'=>$v))->field('name')->find();
	}
    //print_r($data);exit;
	//未发布且未过期的可以修改
	$this->assign('depart',$department);
	$this->assign('data',$data);
	$this->display();
}

/**
*填空和简答详细列表
**/
public function detail(){
    $pid = intval($this->_get('pid')); 
    $type = intval($this->_get('type')); 	
    $info = M('qyresearch_ques')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$pid))->find();

	$count      = M('qyresearch_option_'.$type)->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$pid))->count();
	$Page       = new Page($count,15);
	$data = M('qyresearch_option_'.$type)->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$pid))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
	$show       = $Page->show();
	//print_r($data);exit;
	$this->assign('type',$type);
	$this->assign('page',$show);	
	$this->assign('info',$info);	
	$this->assign('data',$data);
	$this->display();
}

public function wap_index(){
	//dump($_GET);exit;
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['pid']){  //调研手机首页
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Research';
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
		
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		//dump($userinfo);exit;
		//正在使用的用户所在部门
		$depart=explode(';',$userinfo['pid']);
		unset($depart[0]);unset($depart[count($depart)]);
		$arr1=array();
		$arr2=array();		
		$tip = isset($_GET['tip']) ? $_GET['tip'] : 1 ;  //1已答，2未答	
		
		$maps['user_id']=$app['userid'];
		$maps['status']=2;			
		$record=M('Qyresearch')->where($maps)->select();
        $arr = array();		
        if($record){
		    foreach($record as $key=>$val){
			    $val['count']=M('Qyresearch_ques')->where(array('pid'=>$val['id']))->count();
			    $alldepart=explode('|',$val['alldepart']);	
				$res = M('Qyresearch_an')->where(array('pid'=>$val['id'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();				
                foreach($depart as $n){
				    if(in_array($n,$alldepart)){
					    if($tip == 2){
						    if(!$res){
							   array_push($arr,$val);
							}
						}else{
						    if($res){
							   array_push($arr,$val);
							}
						}
					    break;
					}
				}				
			}
		}		
        //dump($depart);exit;		
	/*	foreach($depart as $v){
			//$maps['restrictions']=array('like','%'.$v.'%');
			$maps['user_id']=$app['userid'];
			$maps['status']=2;			
			$record=M('Qyresearch')->where($maps)->select();
			//dump($record);
			if($record){
				foreach($record as $va){
				$va['count']=M('Qyresearch_ques')->where(array('pid'=>$va['id']))->count();
	 				if($_GET['tip']==1){
					//已经参与
						if(M('Qyresearch_an')->where(array('pid'=>$va['id'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find()){
							array_push($arr,$va);
						}
					}elseif($_GET['tip']==2){
						$dat=M('Qyresearch_an')->where(array('pid'=>$va['id'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
						
						if(!$dat){
							array_push($arr,$va);
						}
					
					}else{
						array_push($arr,$va);
					} */
/* 					$res = M('Qyresearch_an')->where(array('pid'=>$va['id'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
					//dump($res);
					if($tip == 2){  //未答
						if(!$res){
							array_push($arr2,$va);	
						}				    
					}elseif($tip == 1){
						if($res){
							array_push($arr1,$va);	
						}				
					} */

					
/* 				}			
			}

		}	 */
        $this->assign('list',$arr);
		$this->display('wap_list');
	
	
	}else{
	    //echo $_GET['wecha_id'];exit;
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Research';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index',$_GET['pid']);
		}
		
		$headline = M('qyresearch')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->find();	//调研大标题  
		$result=M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['pid']))->order('disorder asc,number asc')->select();  //调研小标题
		//dump($data);exit;
	    if($result){
		    foreach($result as $k=>$v){
			    if($v['type'] == 1){
                    $result[$k]['content'] = M('Qyresearch_option_1')->where(array('user_id'=>$app['userid'],'pid'=>$v['id']))->select();  
				}elseif($v['type'] == 2){
				    $result[$k]['content'] = M('Qyresearch_option_2')->where(array('user_id'=>$app['userid'],'pid'=>$v['id']))->select(); 
				}elseif($v['type'] == 3){
				    $result[$k]['content'] = M('Qyresearch_option_3')->where(array('user_id'=>$app['userid'],'pid'=>$v['id']))->select(); 
				}
				
			}
		}
		$isanswer = M('qyresearch_an')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id']))->find();	//调研大标题 
		$isanswer ? $show = 1 : $show = 0;
	    //dump($headline);		
	    //dump($result);exit;
	
	
	
	
	
	
/* 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Research';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index',$_GET['pid']);
		}
		$data = M('qyresearch')->where(array('id'=>$_GET['pid']))->find();	
		$list=M('Qyresearch_ques')->where(array('pid'=>$_GET['pid']))->select();
		foreach($list as $k=>$v){
			$nlist[$k]=$v;
			
			$nlist[$k]['options']=unserialize($v['options']);
	
		}
		//判断用户是否已经提交过了
		$check=M('Qyresearch_an')->where(array('user_id'=>$app['userid'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id']))->find();
		$answer=unserialize($check['answer']);
		//dump($answer);
		foreach($answer as $k=>$v){
			$info=M('Qyresearch_ques')->where(array('id'=>$v['pid']))->find();
			$question=unserialize($info['options']);
			$a[$v['pid']]=$v;
			if($v['type']==1){
				
			}
			if($v['type']==2){
				//$a[$v['pid']]['info2']=$question;
				$answer=explode(',',$v['num']);
				$i=0;
				foreach($answer as $va2){
					if($va2!=null){
						$a[$v['pid']]['info2'][$i]=$question[$i];
						$i++;
					}
				}
			}
			if($v['type']==3){
				//$a[$v['pid']]['info2']=$question;
				$answer=explode(';',$v['val']);
				$i=0;
				foreach($answer as $va2){
					if($va2!=null){
						$a[$v['pid']]['info2'][$i]=$va2;
						$i++;
					}
				}
			}
		}
		//dump($a);
		//dump($nlist);
		//echo 'aaa';exit;
		$this->assign('answer',$a);
		$this->assign('app',$app);
		$this->assign('data',$data);
		$this->assign('list',$nlist); */
		//print_r($result);exit;
		$this->assign('show',$show);			
		$this->assign('app',$app);		
		$this->assign('headline',$headline);		
		$this->assign('data',$result);
		$this->display();
	}
	
}

/**
*投票表单提交
**/
public function wap_get(){
    //dump($_POST);exit;
	if(IS_POST){
		$pid = $this->_post('pid');
		$token = $this->_post('token');
		$wecha_id = $this->_post('wecha_id');
	    $app=M('qymyapp')->where(array('token'=>$token))->field('userid')->find();		
	    if(M('qyresearch_an')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'wecha_id'=>$wecha_id))->find()){
            $this->redirect('wap_index',array('token'=>$_POST['token'],'pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id']));		    
		}else{
			//获取问卷所有标题信息
			$result=M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$_POST['pid']))->select();	
			if($result){
				$question = array();
				foreach($result as $v){
					$question[$v['id']] = $v;
				}
			}
			//对投票人进行处理
			$option = array();
			//dump($_POST);exit;
			//对每一选项进行计数
			foreach($_POST as $key=>$val){
				if(strpos($key,'question') !== false){
					
					if(strpos($key,'-') !== false){
						$res[$key] = explode('-',$key);
						$questionid = preg_replace('/question/i','',$res[$key][0]); 
						//M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');
						if($question[$questionid]['type'] == 3){
							if($val != ''){
								if($res[$key][1] != '' && is_numeric($res[$key][1])){
									$index[$key] = $res[$key][1];
									M('Qyresearch_option_3')->where(array('user_id'=>$app['userid'],'pid'=>$questionid,'option_number'=>$index[$key]))->setInc('score_'.$val);					
								}					
							}

						}				
					}else{
						//
						$questionid = preg_replace('/question/i','',$key); 
						//对每个题目进行计数加1
						
						if($question[$questionid]['type'] == 1){
							if($val != ''){
							$index[$key] = $val+1;  //索引
								//对该选项计数加1
							M('Qyresearch_option_1')->where(array('user_id'=>$app['userid'],'pid'=>$questionid,'option_number'=>$index[$key]))->setInc('hits');
							M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');					
							}
							//$
						}elseif($question[$questionid]['type'] == 2){
							if($val != ''){				
								$arr[$key] = explode(',',$val);
								//dump($arr[$key]);exit;
								foreach($arr[$key] as $m=>$n){
								if($n != ''){
								$index[$key][$m]= $n+1;
								M('Qyresearch_option_2')->where(array('user_id'=>$app['userid'],'pid'=>$questionid,'option_number'=>$index[$key][$m]))->setInc('hits');
								}
								}
								M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');
							}
						}elseif($question[$questionid]['type'] == 3){
							M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');
						}elseif($question[$questionid]['type'] == 4){
							if($val != ''){
								$data[$key]['user_id'] = $app['userid'];
								$data[$key]['pid'] = $questionid;
								$data[$key]['wecha_id'] = $wecha_id;
								$data[$key]['answer'] = $val;					
								M('Qyresearch_option_4')->add($data[$key]);
								M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');
							}	
						}elseif($question[$questionid]['type'] == 5){
							if($val != ''){				
								$info[$key]['user_id'] = $app['userid'];
								$info[$key]['pid'] = $questionid;
								$info[$key]['wecha_id'] = $wecha_id;
								$info[$key]['answer'] = $val;					
								M('Qyresearch_option_5')->add($info[$key]);		
								M('Qyresearch_ques')->where(array('user_id'=>$app['userid'],'pid'=>$pid,'id'=>$questionid))->setInc('total');
							}					
						}
					}
				}
			}
			$an['pid'] = $pid;
			$an['wecha_id'] = $wecha_id;	
			$an['answer'] = serialize($_POST);	
			$an['user_id'] = $app['userid'];	
			$an['time'] = time();				
            M('Qyresearch_an')->add($an);	
            $this->redirect('wap_index',array('token'=>$_POST['token'],'pid'=>$_POST['pid'],'wecha_id'=>$_POST['wecha_id']));			
		}
	    
	}

    //$user_id = $this->_post('user_id');

    //dump($_POST);exit;

	

	
}


public function wap_url(){
    header("Location:");
}
}