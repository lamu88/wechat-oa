<?php
/**
*会议室预定
**/
class MeetAction extends Action{
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
	*会议室预定查询
	**/
	public function lists(){
	    $this->check();
        if(IS_POST){
			$day=str_replace('/','',$_POST['datetime']);
			$data = M('qymeet_room')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->select();
			foreach($data as $k=>$v){
				 $datas[$k]=$v;
				 $datas[$k]['info']=M('qymeet_order')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id'],'date'=>$day))->find();
			}
			$this->assign('data',$datas);
		}else{
			$where['user_id'] = $_SESSION['user_id'];
			$data = M('qymeet_room')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->select();
			foreach($data as $k=>$v){
				$datas[$k]=$v;
				$datas[$k]['info']=M('qymeet_order')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id'],'date'=>date('Ymd')))->find();//默认是今日
			}
			$this->assign('data',$datas);
		}
		$this->display();
	}
	
	/**
	*会议室预定设置
	**/
	public function index(){
	    $this->check();
        if(IS_POST){
			$data['wave'] = $_POST['wave'];
			$data['start_time'] = $_POST['start_time'];
			$data['end_time'] = $_POST['end_time'];
			$data['advance'] = serialize($_POST['advance']);
			$i = 0;
			$rul= array();
			if(!empty($_POST['ruleout'])){
			    foreach($_POST['ruleout'] as $k=>$v){
				    $rul[$i] = $v;
					$i++;
				}
			}
			$data['ruleout'] = serialize($rul);
			$data['user_id']=$_SESSION['user_id'];
			dump($data);exit;
		    $res = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->find();	
			if($res){
			    $r = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->delete();
				$id = M('qymeet_config')->add($data);
				if($id){
					$this->success('修改成功',U('Meet/index',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('修改失败');
				}			
			}else{
				$id = M('qymeet_config')->add($data);
				if($id){
					$this->success('添加成功',U('Meet/index',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('添加失败');
				}			
			}
		}else{
		   $data = M('qymeet_room')->where(array('user_id'=>$_SESSION['user_id']))->select();
		   $this->assign('data',$data);	
		   $this->assign('jsdata',json_encode($data));			   
		   $info = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->find();			   
           if($info){	   
			   $advance = unserialize($info['advance']);
			   $this->assign('advance',$advance);				   
			   $this->assign('info',$info);	
			   $ruleout = unserialize($info['ruleout']);
			   //dump($info['ruleout']);
			   //dump($ruleout);exit;
               $count = count($ruleout);			   
			   $this->assign('ruleout',json_encode($ruleout));	
			   $this->assign('count',$count);				   
			   $this->display('config');		   
		   }else{			   
		       $this->display('unconfig');		   
		   }		   		   

		}
	}	
	
	/**
	*会议室预定设置
	**/
	public function conf(){
	    $this->check();
        if(IS_POST){
			$data['wave'] = $_POST['wave'];
			$data['start_time'] = $_POST['start_time'];
			$data['end_time'] = $_POST['end_time'];
			$data['advance'] = serialize($_POST['advance']);
			$i = 0;
			$rul= array();
			if(!empty($_POST['ruleout'])){
			    foreach($_POST['ruleout'] as $k=>$v){
				    $rul[$i] = $v;
					$i++;
				}
			}
			$data['ruleout'] = serialize($rul);
			$data['user_id']=$_SESSION['user_id'];
		    $res = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->find();	
			if($res){
			    $r = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->delete();
				$id = M('qymeet_config')->add($data);
				if($id){
					$this->success('修改成功',U('Meet/conf',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('修改失败');
				}			
			}else{
				$id = M('qymeet_config')->add($data);
				if($id){
					$this->success('添加成功',U('Meet/conf',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('添加失败');
				}			
			}
		}else{
		   $data = M('qymeet_room')->where(array('user_id'=>$_SESSION['user_id']))->select();
		   $this->assign('data',$data);	
		   $this->assign('jsdata',json_encode($data));			   
		   $info = M('qymeet_config')->where(array('user_id'=>$_SESSION['user_id']))->find();			   
           if($info){	   
			   $advance = unserialize($info['advance']);
			   $this->assign('advance',$advance);				   
			   $this->assign('info',$info);	
			   $ruleout = unserialize($info['ruleout']);
			   //dump($info['ruleout']);
			   //dump($ruleout);exit;
               $count = count($ruleout);			   
			   $this->assign('ruleout',json_encode($ruleout));	
			   $this->assign('count',$count);				   
			   $this->display('config');		   
		   }else{			   
		       $this->display('unconfig');		   
		   }		   		   

		}
	}
	
	
	public function config_man(){
	    $this->check();
		if(IS_POST){
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
			$check=M('Qymeet_or')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($check){
				M('Qymeet_or')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
			}
			$id = M('Qymeet_or')->add($data); 
			if($id){
				$this->success('设置成功'); 
			}else{
				$this->error('设置失败');
			}	
		}else{
			$check=M('Qymeet_or')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
			if($check){
				$check['audit'] = unserialize($check['audit']);
				$audit = json_encode($check['audit']);
				$this->assign('audit',$audit);
				$this->display('config_man');  //显示已配置
			}else{
				$this->display('unconfig_man');	//显示未配置
			}
		}
	}
	/**
	*新增会议室
	**/
	public function add(){
	    $this->check();
        if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
		    //重名检测
			$name = M('qymeet_room')->where(array('name'=>$_POST['name']))->find();
			if($name){
			    $this->error('该会议室名已存在');			
			}
		    $data = $_POST;
			$data['status'] = 0;
			$id = M('qymeet_room')->add($data);
			if($id){
			    $this->success('添加成功',U('Meet/manage',array('mid'=>$_GET['mid'])));
			}else{
			    $this->error('添加失败');
			}
		}else{
		   $this->display();
		}
	}
	/**
	*修改预定会议室
	**/
	public function edit(){
	    $this->check();
        if(IS_POST){		
			$_POST['user_id']=$_SESSION['user_id'];
		    $id = M('qymeet_room')->where(array('id'=>$_POST['id']))->save($_POST);
			if($id){
			    $this->success('修改成功',U('Meet/manage',array('mid'=>$_GET['mid'])));  			    
			}else{
			    $this->error('修改失败');			
			}
		}else{
			$id = $this->_get('id');
			$data = M('qymeet_room')->where(array('id'=>$id))->find();
			$this->assign('data',$data);
			$this->display();		
		}
	}	
	/**
	*会议室预定详情
	**/
	public function meetInfo(){
        $this->check();
		$id = $this->_get('id');
		$data = M('qymeet_room')->where(array('id'=>$id))->find();
		$this->assign('data',$data);
		$this->display();
	}	
	/**
	*会议室预定管理
	**/
	public function manage(){
    $this->check();
    $status = $_GET['status'];
	if($status){
		$count      = M('qymeet_room')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_position')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}else{
		$count      = M('qymeet_room')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qymeet_room')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}

	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
	}

	/**
	*删除
	**/
	public function del(){
    $this->check();
		if(IS_POST){
			$data = M('qymeet_room')->where(array('id'=>$_POST['id']))->find();
			if(M('qymeet_room')->where(array('id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}
		}
	}
	
	
	
/***********wap**********/

//会议室列表
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Meet';
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
		$list = M('qymeet_room')->where(array('user_id'=>$app['userid']))->select();
		//默认今日
		if($_GET['date']) {
			$dat=$_GET['date'];
	    } else {
			 $dat=date('Ymd');
			 $_GET['date']=date('Ymd');
		}
		$datelist = array();
		if($_GET['datetime']){
		    $dat = date('Ymd',strtotime($_GET['datetime']));
			$strtime = strtotime($_GET['datetime']);
		    $datelist[0] = array('week'=>date('w',strtotime($_GET['datetime'])),'date'=>date('d',strtotime($_GET['datetime'])));			
		    $datelist[1] = array('week'=>date('w',(strtotime($_GET['datetime'])+86400)),'date'=>date('d',(strtotime($_GET['datetime'])+86400)));
		    $datelist[2] = array('week'=>date('w',(strtotime($_GET['datetime'])+172800)),'date'=>date('d',(strtotime($_GET['datetime'])+172800)));
		    $datelist[3] = array('week'=>date('w',(strtotime($_GET['datetime'])+259200)),'date'=>date('d',(strtotime($_GET['datetime'])+259200)));
		    $datelist[4] = array('week'=>date('w',(strtotime($_GET['datetime'])+345600)),'date'=>date('d',(strtotime($_GET['datetime'])+345600)));
		    $datelist[5] = array('week'=>date('w',(strtotime($_GET['datetime'])+432000)),'date'=>date('d',(strtotime($_GET['datetime'])+432000)));					
		}else{
		    $datelist[0] = array('week'=>date('w'),'date'=>date('d'));			
		    $datelist[1] = array('week'=>date('w',strtotime("+1 day")),'date'=>date('d',strtotime("+1 day")));
		    $datelist[2] = array('week'=>date('w',strtotime("+2 day")),'date'=>date('d',strtotime("+2 day")));
		    $datelist[3] = array('week'=>date('w',strtotime("+3 day")),'date'=>date('d',strtotime("+3 day")));
		    $datelist[4] = array('week'=>date('w',strtotime("+4 day")),'date'=>date('d',strtotime("+4 day")));
		    $datelist[5] = array('week'=>date('w',strtotime("+5 day")),'date'=>date('d',strtotime("+5 day")));				
		}
		$mydate = array();
		foreach($datelist as $k=>$v){
		    if($v['week'] == 0 ){
			    $mydate[$k]['week'] = '日';
			    $mydate[$k]['date'] = $v['date'];				
			}elseif($v['week'] == 1 ){
			    $mydate[$k]['week'] = '一';
			    $mydate[$k]['date'] = $v['date'];	
			}elseif($v['week'] == 2 ){
			    $mydate[$k]['week'] = '二';
			    $mydate[$k]['date'] = $v['date'];	
			}elseif($v['week'] == 3 ){
			    $mydate[$k]['week'] = '三';
			    $mydate[$k]['date'] = $v['date'];	
			}elseif($v['week'] == 4 ){
			    $mydate[$k]['week'] = '四';
			    $mydate[$k]['date'] = $v['date'];	
			}elseif($v['week'] == 5 ){
			    $mydate[$k]['week'] = '五';
			    $mydate[$k]['date'] = $v['date'];	
			}elseif($v['week'] == 6 ){
			    $mydate[$k]['week'] = '六';
			    $mydate[$k]['date'] = $v['date'];					
			}
			
		}
		//echo $dat;exit;
		//echo date('d');exit;
		//dump($datelist);exit;
		$this->assign('mydate',$mydate);		
		foreach($list as $k=>$v){
			$count=M('Qymeet_record')->where(array('pid'=>$v['id'],'user_id'=>$v['user_id'],'date'=>$dat))->sum('times');
			//dump($count);
			$lists[$k]=$v;
			$lists[$k]['time']=10-0.5*$count;
		}
		//dump($lists);exit;
		$this->assign('list',$lists);
		//星期计算
		$type = $_GET['type'];
		if($type){
			$type = $_GET['type'];
		}else{
			$type = 1;
		}
		$this->assign('type',$type);
		$week=$this->week(date('D'));
		$this->assign('week',$week);
		$this->display();  
}
//会议室预定
public function wap_class(){
	if(IS_POST){
	    //dump($_POST);exit;
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$_POST['user_id']=$app['userid'];
		$_POST['timeid']=$_POST['time_c'];
		$_POST['date']=$_POST['date'];
		$_POST['time']=time();
		$orderArr=explode(';',$_POST['timeid']);
		unset($orderArr[0]);
		$_POST['times']=count($orderArr);
		$pid=M('Qymeet_record')->add($_POST);  //添加会议预定记录
		if($pid){
			$checker=M('Qymeet_or')->where(array('user_id'=>$app['userid']))->find();  //读取审核人配置
			// if(!$checker){
				// echo json_encode(array('status'=>2));//没有请假审核人
				// exit();
			// }
			$checkers=unserialize($checker['audit']);
			$i=1;
			foreach($checkers as $v){
				if($v==null){  //直接上级
					$node=M('Qy_node')->where(array('node_user'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->field('pid')->find();
					$leader=M('Qy_node')->where(array('id'=>$node['pid']))->find();
					$v=$leader['node_user'];
				}
				if($v){  //指定人员
					$arr[$i]=$v;
					//添加审核人
					M('Qymeet_check')->add(array('user_one'=>$_POST['wecha_id'],'user_two'=>$v,'user_id'=>$app['userid'],'pid'=>$pid,'time'=>time()));
					$i++;
				}
			}
			$datac['check_now']=$arr[1];
			$datac['check_order']=serialize($arr);
			M('Qymeet_record')->where(array('id'=>$id))->save($datac);
			//给所有用户发送审核信息
			$inin['touser']=implode('|',$arr);
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个会议室预定的申请需要您查看";
			$inin['description']="请您点击进入查看详情";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Meet&a=wap_index&token='.$_POST['token'].'&pid='.$id;
			$inin["agentid"]=$app['appid'];
			$msg=$Msg->msg_send_all($inin,$app['userid']);
			//dump($inin);dump($msg);die();
			//给指定人发邮件
			if($_POST['is_mail']==1){
				$touser=M('Qyusers')->where(array('id'=>$_SESSION['c1'.$_POST['wecha_id']]))->field('userid')->find();
				$inin['touser']=$touser['userid'];
				$Msg=A('Qyapp/Msg');
				$inin['title']="您申请预定了一个会议室";
				$inin['description']="请您点击进入查看详情";
				$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Meet&a=wap_order_info&token='.$_POST['token'].'&pid='.$pid;
				$email=M('qymyapp')->where(array('userid'=>$app['userid'],'module'=>'Email'))->field('appid')->find();
				$inin["agentid"]=$email['appid'];
				$msg=$Msg->msg_send_all($inin,$app['userid']);
				if($msg['errcode']==0){
					echo json_encode(array('status'=>1));//添加成功
				}
			}
			$find=M('Qymeet_order')->where(array('pid'=>$_POST['pid'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
			if($find){
				foreach($orderArr as $val){
					$id=M('Qymeet_order')->where(array('id'=>$find['id']))->save(array($val=>1));
				}
			}else{
				$room=M('Qymeet_room')->where(array('id'=>$_POST['pid']))->find();
				$order=M('Qymeet_order')->add(array('name'=>$room['name'],'pid'=>$_POST['pid'],'user_id'=>$app['userid'],'date'=>date('Ymd'),'time'=>time()));
				foreach($orderArr as $val){
					$id=M('Qymeet_order')->where(array('id'=>$order))->save(array($val=>1));
				}
			}
			if($id){
				$this->redirect(U('wap_my_order',array('token'=>$_POST['token'],'wecha_id'=>$_GET['wecha_id'])));
			}
		}
	}else{
		if($_GET['date']){
			$where['date']=$_GET['date'];
		}else{
			$where['date']=date('Ymd');
		}
		$class = M('qymeet_room')->where(array('id'=>$_GET['id']))->find();
		$this->assign('class',$class);
		//预定情况查看
		$where['pid']=$_GET['id'];
		$order=M('Qymeet_order')->where($where)->find();//默认今日
		$this->assign('order',$order);
		if($_GET['date']) $date=date('D',strtotime($_GET['date']));
		else  $date=date('D');
		if(!$_GET['type']){
			$_SESSION['from']='';
			$_SESSION['ai']='';
			$_SESSION['date']='';
			$_SESSION['c1'.$_GET['wecha_id']]='';
			$_SESSION['c2'.$_GET['wecha_id']]='';
			$_SESSION['delist'.$_GET['wecha_id']]='';
			$_SESSION['userlist'.$_GET['wecha_id']]='';
			$_SESSION['userc'.$_GET['wecha_id']]='';
		}
		$week=$this->week($date);
		$this->assign('week',$week);
		$choose=M('Qyusers')->where(array('id'=>$_SESSION['userc'.$_GET['wecha_id']]))->field('name,id')->find();
		$this->assign('user',$choose);
		$this->display();
	}
}

public function wap_my_order(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$status = isset($_GET['status'])?$_GET['status']:2;
	$list=M('Qymeet_record')->where(array('wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'status'=>$status))->order('id desc')->select();
	foreach($list as $k=>$v){
		$lists[$k]=$v;
		$lists[$k]['room']=M('Qymeet_room')->where(array('id'=>$v['pid']))->find();
	}
	$this->assign('list',$lists);
	$this->display();
}

public function wap_task1(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['status']){
		if($_GET['status']==2) $_GET['status']=0;
		$list=M('Qymeet_check')->where(array('user_two'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'status'=>$_GET['status']))->order('id desc')->field('pid,time,id')->select();
	}else{
		$list=M('Qymeet_check')->where(array('user_two'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->order('id desc')->field('pid,time,id')->select();
	}
	
	foreach($list as $k=>$v){
		$lists[$k]=$v;
		$record=M('Qymeet_record')->where(array('id'=>$v['pid']))->field('pid,wecha_id')->find();
		$lists[$k]['orderuser']=$record['wecha_id'];
		$lists[$k]['record']=M('Qymeet_room')->where(array('id'=>$record['pid']))->field('id,name')->find();
	}
	//dump($list);
	//dump($lists);
	$this->assign('list',$lists);
	$this->display();
}

public function wap_task(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
    $status = $this->_get('status');	
	//判断是否已经审核过
	//$check=M('Qymeet_check')->where(array('user_two'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'pid'=>$_GET['pid']))->find();
	//if($check['status']!='0'){
	//	$this->redirect(U('wap_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$_GET['pid'],'status'=>0)));
	//}	
    if($status){
		if($status == 2){  //审核通过	
			if($c_id=M('Qymeet_check')->where(array('user_two'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'pid'=>$_GET['pid']))->save(array('status'=>2,'time'=>time()))){  //改变当前审核人的审核状态
			    $order = M('Qymeet_record')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->find();  //获取配置表中的审核人
				if($order){
				    $examine = unserialize($order['check_order']);
					$num = count($examine);
					if(array_search($_GET['wecha_id'],$examine) == $num){
						M('Qymeet_record')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->save(array('status'=>1));
					}else{
						foreach($examine as $ke=>$va){
							if($va==$_GET['wecha_id']) {
								$mc=$ke;
							}
						}
						M('Qymeet_record')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->save(array('check_now'=>$examine[$mc+1]));
						$inin['touser']=$examine[$mc+1];
						$Msg=A('Qyapp/Msg');
						$inin['title']="您有一个会议室预定的申请需要查看";
						$inin['description']="请您点击进入审核";
						$inin['picurl']="picurl";
				        $inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Meet&a=wap_index&token='.$_POST['token'].'&wecha_id='.$_GET['wecha_id'];
						//$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('appid')->find();
						$inin["agentid"]=$app['appid'];
						$Msg->msg_send_all($inin,$app['user_id']);
					}					
				}
				
			}
		    $this->redirect(U('wap_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$_GET['pid'])));
		}elseif($status == 1){  //审核不通过
		    M('Qymeet_record')->where(array('user_id'=>$app['userid'],'id'=>$_GET['pid']))->save(array('status'=>1));
			$this->redirect(U('wap_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$_GET['pid'])));
		}	
	}else{
		$list=M('Qymeet_check')->where(array('user_two'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->order('id desc')->field('pid,time,id')->select();	
		foreach($list as $k=>$v){
			$lists[$k]=$v;
			$record=M('Qymeet_record')->where(array('id'=>$v['pid']))->field('pid,wecha_id')->find();
			$lists[$k]['orderuser']=$record['wecha_id'];
			$lists[$k]['record']=M('Qymeet_room')->where(array('id'=>$record['pid']))->field('id,name')->find();
		}
		$this->assign('list',$lists);
		
		$this->display();	
	}

}

public function wap_order_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$info=M('Qymeet_record')->where(array('id'=>$_GET['pid']))->find();
	$roominfo=M('Qymeet_room')->where(array('id'=>$info['pid']))->find();
	$this->assign('roominfo',$roominfo);
	$this->assign('info',$info);
	//dump($info);
	$date_time=$this->date_time();
	$orders=explode(';',$info['timeid']);
	foreach($orders as $k=>$v){
		if($v){
			$str_order.=$date_time[$v].';';
		}
	}
	$this->assign('str_order',$str_order);
	//print_r($roominfo);exit;
	$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$info['wecha_id']))->find();
	$this->assign('user',$userinfo);
	//print_r($userinfo);exit;
	$this->display();
}

public function wap_check_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$check=M('Qymeet_check')->where(array('id'=>$_GET['pid']))->field('pid')->find();
	$_GET['pid']=$check['pid'];
	$info=M('Qymeet_record')->where(array('id'=>$_GET['pid']))->find();
	$roominfo=M('Qymeet_room')->where(array('id'=>$info['pid']))->find();
	$this->assign('roominfo',$roominfo);
	$this->assign('info',$info);
	$date_time=$this->date_time();
	$orders=explode(';',$info['timeid']);
	foreach($orders as $k=>$v){
		if($v){
			$str_order.=$date_time[$v].';';
		}
	}
	$this->assign('str_order',$str_order);
	// $orderinfo=M('Qymeet_order')->where(array('user_id'=>$info['user_id'],'pid'=>$info['pid'],'date'=>$info['date']))->find();
	// dump($orderinfo);
	$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$info['wecha_id']))->find();
	if($userinfo['pic']=='http://'.$_SERVER['SERVER_NAME'].'/') $userinfo['pic']='';
	$this->assign('user',$userinfo);
	
	
	//dump($userinfo);
	$this->display();
}

/**
*同意
**/

public function agree(){
	if(IS_POST){
	
		//F('postdata11',$_POST);
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		// print_r($app);exit;
		//F('app',$app);
		//同意同时给下一个人发信息说明已经同意 同时判断当前审核员是否可以审核
		$record=M('Qymeet_record')->where(array('id'=>$_POST['pid']))->find();
		//F('record',$record);
		//如果请假申请被驳回了一次后面审核及时停止
			
		if($record['status']==2){
			//F('status',$record['status']);
			echo json_encode(2);
			exit;
		}
		// print_r($record);exit;
		//$this->ajaxReturn(1);
		// if($_POST['wecha_id']==$record['check_now']){
			$id=M('Qyleave_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>1,'time'=>time()));
					// $this->ajaxReturn(1);
			if($id){
				// $this->ajaxReturn(1);
				$order=unserialize($record['check_order']);
		
				foreach($order as $k=>$v){
					if($v==$record['check_now']){
						$ne=$k;
					}
				}
				if($ne==count($order)){
					// //审核完成
					// M('')->where()->save();
					$record = M('Qyleave_record')->where(array('id'=>$_POST['pid']))->save(array('status'=>1));
					if($record){
						$this->ajaxReturn(1);
						
					}
				
				}else{
					$next=$order[$ne+1];
					$inin['touser']=$next;
					$Msg=A('Qyapp/Msg');
					$inin['title']="您有一个请假申请需要您查看";
					$inin['description']="请您点击进入查看详情";
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Meet&a=wap_check_info&token='.$_POST['token'].'&pid='.$_POST['pid'];
					$inin["agentid"]=$app['appid'];
					$msg=$Msg->msg_send_all($inin,$app['userid'],$id);
					//dump($msg);exit;
					if($msg['errcode']==0){
						
						M('Qymeet_record')->where(array('id'=>$_POST['pid']))->save(array('check_now'=>$next));
						echo json_encode(1);//t同意成功
					}else{
						echo json_encode(3);//同意失败
					}
				}
			}
		// }else{
			// echo json_encode(5);//您已经审核通过了
		// }
	}
}

/*
*驳回
**/
public function out(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$record=M('Qymeet_record')->where(array('id'=>$_POST['pid']))->find();
		if($_POST['wecha_id']==$record['check_now']){
			$id=M('Qymeet_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>2,'time'=>time()));
			if($id){
				$next=$record['wecha_id'];
				$inin['touser']=$next;
				$Msg=A('Qyapp/Msg');
				$inin['title']="您的请假申请被驳回";
				$inin['description']="请您点击进入查看详情";
				$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Meet&a=wap_order_info&token='.$_POST['token'].'&pid='.$id;
				$inin["agentid"]=$app['appid'];
				$msg=$Msg->msg_send_all($inin,$app['userid']);
				if($msg['errcode']==0){
					// M('Qyleave_check')->where(array('id'=>$_POST['pid']))->save(array('status'=>2));//驳回
					// $id=M('Qyleave_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>2,'time'=>time()));
					M('Qymeet_record')->where(array('id'=>$_POST['pid']))->save(array('status'=>2));//驳回审核停止
					echo json_encode(array('status'=>1));//驳回成功
				}else{
					echo json_encode(array('status'=>2));//驳回失败
				}
			}
		}else{
			echo json_encode(array('status'=>3));//您已经审核
		}
	}
}


//会议室的审核流程 依次审核一旦有一个人驳回就删除记录  并且给
public function see(){
	
	
	
}



function week($week){
		if(empty($week)){
			$week   =  date(" D");   
		}
		switch($week)   
		 {   
			 case "Mon":  
				$current[1]   =   $format."一";   
				$current[2]   =   $format."二";  
				$current[3]   =   $format."三";  
				$current[4]   =   $format."四";  
				$current[5]   =   $format."五";  
				 break;   
			 case "Tue":  
				$current[1]   =   $format."二";  
				$current[2]   =   $format."三";  
				$current[3]   =   $format."四";  
				$current[4]   =   $format."五";  
				$current[5]   =   $format."六";  
				 break;   
			 case "Wed":     
				$current[1]   =   $format."三";  
				$current[2]   =   $format."四";  
				$current[3]   =   $format."五";  
				$current[4]   =   $format."六";  
				$current[5]   =   $format."日";
				 break;  
			 case "Thu":   
				$current[1]   =   $format."四";  
				$current[2]   =   $format."五";  
				$current[3]   =   $format."六";  
				$current[4]   =   $format."日";
				$current[5]   =   $format."一";  

				 break;  
			 case "Fri":    
				$current[1]   =   $format."五";  
				$current[2]   =   $format."六";  
				$current[3]   =   $format."日";
				$current[4]   =   $format."一";  
				$current[5]   =   $format."二";
				break;   

			 case "Sat":   
				$current[1]   =   $format."六";  
				$current[2]   =   $format."日";
				$current[3]   =   $format."一";  
				$current[4]   =   $format."二"; 
				$current[5]   =   $format."三";  
				 break;   
			 case "Sun":   
				$current[1]   =   $format."日";
				$current[2]   =   $format."一";  
				$current[3]   =   $format."二"; 
				$current[4]   =   $format."三";
				$current[5]   =   $format."四";     
				break;   

		}
		return $current;
}


function date_time(){
	$arr=array();
	$arr['t_8_1']='8:00-8:30';
	$arr['t_8_2']='8:30-9:00';
	$arr['t_9_1']='9:00-9:30';
	$arr['t_9_2']='9:30-10:00';
	$arr['t_10_1']='10:00-10:30';
	$arr['t_10_2']='10:30-11:00';
	$arr['t_11_1']='11:00-11:30';
	$arr['t_11_2']='11:30-12:00';
	$arr['t_12_1']='12:00-12:30';
	$arr['t_12_2']='12:30-13:00';
	$arr['t_13_1']='13:00-13:30';
	$arr['t_13_2']='13:30-14:00';
	$arr['t_14_1']='14:00-14:30';
	$arr['t_14_2']='14:30-15:00';
	$arr['t_15_1']='15:00-15:30';
	$arr['t_15_2']='15:30-16:00';
	$arr['t_16_1']='16:00-16:30';
	$arr['t_16_2']='16:30-17:00';
	$arr['t_17_1']='17:00-17:30';
	$arr['t_17_2']='17:30-18:00';
	return $arr;
}
	
	
	
	
	
	
}