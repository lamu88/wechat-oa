<?php
/**
*
**/
class DayAction extends Action{
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

public function index(){
    $this->check();
	$this->redirect(U('Appmsg/conf',array('mid'=>$_GET['mid'])));	
}
public function appmanage(){
    $this->check();
	$this->display();
}	

public function wap_datetime11(){
    if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Day';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$cc['date_time'] = date('Ymd',strtotime(trim($_POST['datetime'])));
		$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();	    
		//print_r($whosha);exit;
		if(!$_GET['type']){
			$_GET['type']=1;
		}
		if($_GET['type']){
			if($_GET['type']==1){
				$cc['date_time']=date("Ymd");
				//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();		
				$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();
			}
			if($_GET['type']==2){
				$cc['date_time']=date("Ymd",strtotime("+1 day"));
				//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();		
				$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();
			}
			if($_GET['type']==3){
					$cc['date_time']=date("Ymd",strtotime("+2 day"));
					$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();		
					$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();		
			}
			if($_GET['type']==4){
				$cc['date_time']=date("Ymd",strtotime("+3 day"));
				//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();		
				$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();		
			}
			if($_GET['type']==5){
				$cc['date_time']=date("Ymd",strtotime("+4 day"));
				//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();		
				$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();		
			}
		}		
			//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$haos=M("qyday_date")->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id']))->limit(5)->select();
		if($_GET['newnub']){	
			 $zent['id']=explode(",",$_GET['newnub']);
			 
			$map['id']=array('in',$zent['id']);
			$map['user_id']=$app['userid'];
			$map['wecha_id']=$_GET['wecha_id'];
			$data['type']=1;
			$data['subtime']=time();
			$hahas=M('qyday_date')->where($map)->save($data);
			$this->redirect(U('Day/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>$_GET['type'])));	
		}	
		$this->assign("haos",$haos);
		$week=$this->week();
		$this->assign('week',$week);
		$this->assign('whosha',$whosha);
		$this->display();    	    
	}
}
public function wap_log_index_ajax(){
	$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
	$cdata = $_POST['date'];
	$strattime = strtotime($cdata . '-1');
	$endtime = strtotime($cdata . '-31');
	$where['time'] = array('between',array($strattime,$endtime));
	$where['user_id'] = $app['userid'];
	if($_POST['type'] == 1){
		$where['wecha_id'] = $_POST['wecha_id'];
		$list = M('qyday_log')->where($where)->order('id desc')->select();
	}else{
		$list = M('qyday_log')->where($where)->order('id desc')->select();
		foreach($list as $k=>$v){
			if(strstr($v['receive'],$_POST['wecha_id']) == true){
				$arr[] = $v;
			}
		}
		$list =  $arr;
	}
	foreach($list as $key=>$val){
		$userpic = M('qyusers')->where(array('wecha_id'=>$app['userid'],'userid'=>$val['wecha_id'],'user_id'=>$app['userid']))->find();
		$list[$key]['userpic'] = $userpic['pic'];
		$list[$key]['username'] = $userpic['name'];
		$list[$key]['position'] = $userpic['position'];
		if($userpic['department'] == ''){
			$userpic['pid'] = str_replace(';','',$userpic['pid']);
			$department = M('department')->where(array('wxid'=>$userpic['pid'],'user_id'=>$app['userid']))->find();
			$list[$key]['department'] = $department['name'];
		}else{
			$userpic['department'] = str_replace(';','',$userpic['department']);
			$department = M('department')->where(array('wxid'=>$userpic['department'],'user_id'=>$app['userid']))->find();
			$list[$key]['department'] = $department['name'];
		}
	}
	$count1 = 0;
	$count2 = 0;
	$count3 = 0;
	foreach($list as $key=>$val){
		$list[$key]['time'] = date('Y-m-d h:i',$val['time']);
		if($val['type'] == '日报'){
			$count1 = $count1 + 1;
		}
		if($val['type'] == '周报'){
			$count2 = $count2 + 1;
		}
		if($val['type'] == '月报'){
			$count3 = $count3 + 1;
		}
	}
	if($list){
		echo json_encode(array('status'=>1,'lists'=>$list,'count1'=>$count1,'count2'=>$count2,'count3'=>$count3));
	}else{
		echo json_encode(array('status'=>0,'count1'=>0,'count2'=>0,'count3'=>0));
	}
}
public function wap_log_content(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$data['content'] = $_POST['content'];
	$data['pid'] = $_GET['id'];
	$data['wecha_id'] = $_GET['wecha_id'];
	$data['user_id'] = $app['userid'];
	$data['time'] = time();
	$is = M('qyday_log_content')->add($data);
	$user=M('Qyusers')->where(array('userid'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->field('name')->find();
	$data['name'] = $user['name'];
	if($is){
		echo json_encode(array('status'=>1,'list'=>$data));
	}else{
		echo json_encode(array('status'=>0));
	}
}
public function wap_log_content_ajax(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$list = M('qyday_log_content')->where(array('pid'=>$_POST['pid'],'user_id'=>$app['userid']))->select();
	foreach($list as $k=>$v){
		$temp=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('name')->find();
		$list[$k]['name'] = $temp['name'];
	}
	if($list){
		echo json_encode(array('status'=>1,'list'=>$list));
	}else{
		echo json_encode(array('status'=>0));
	}
}
public function wap_log(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Day','wap_log',$_GET);	
	} 
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
	//print_r($user);exit;
	if($user['department'] == ''){
		$user['pid'] = str_replace(';','',$user['pid']);
		$department = M('department')->where(array('wxid'=>$user['pid'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}else{
		$user['department'] = str_replace(';','',$user['department']);
		$department = M('department')->where(array('wxid'=>$user['department'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}
	$cdata = date('Y-m',time());
	$strattime = strtotime($cdata . '-1');
	$endtime = strtotime($cdata . '-31');
	$where['time'] = array('between',array($strattime,$endtime));
	$where['user_id'] = $app['userid'];
	if($_GET['type'] == 1){
		$where['wecha_id'] = $_GET['wecha_id'];
		$list = M('qyday_log')->where($where)->order('id desc')->select();
	}else{
		$list = M('qyday_log')->order('id desc')->select();
		foreach($list as $k=>$v){
			if(strstr($v['receive'],$_GET['wecha_id']) == true){
				$arr[] = $v;
			}
		}
		$list =  $arr;
	}
	foreach($list as $key=>$val){
		$userpic = M('qyusers')->where(array('wecha_id'=>$app['userid'],'userid'=>$val['wecha_id'],'user_id'=>$app['userid']))->find();
		$list[$key]['userpic'] = $userpic['pic'];
		$list[$key]['username'] = $userpic['name'];
		$list[$key]['position'] = $userpic['position'];
		if($userpic['department'] == ''){
			$userpic['pid'] = str_replace(';','',$userpic['pid']);
			$department = M('department')->where(array('wxid'=>$userpic['pid'],'user_id'=>$app['userid']))->find();
			$list[$key]['department'] = $department['name'];
		}else{
			$userpic['department'] = str_replace(';','',$userpic['department']);
			$department = M('department')->where(array('wxid'=>$userpic['department'],'user_id'=>$app['userid']))->find();
			$list[$key]['department'] = $department['name'];
		}
	}
	$count1 = 0;
	$count2 = 0;
	$count3 = 0;
	foreach($list as $key=>$val){
		if($val['type'] == '日报'){
			$count1 = $count1 + 1;
		}
		if($val['type'] == '周报'){
			$count2 = $count2 + 1;
		}
		if($val['type'] == '月报'){
			$count3 = $count3 + 1;
		}
	}
	$this->assign('count1',$count1);
	$this->assign('count2',$count2);
	$this->assign('count3',$count3);
	$this->assign('list',$list);
	//print_r($list);exit;
	$this->assign('users',$user);
	$this->display();
}
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Day';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
		exit();
	}
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
	//print_r($user);exit;
	if($user['department'] == ''){
		$user['pid'] = str_replace(';','',$user['pid']);
		$department = M('department')->where(array('wxid'=>$user['pid'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}else{
		$user['department'] = str_replace(';','',$user['department']);
		$department = M('department')->where(array('wxid'=>$user['department'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}
	
	$this->assign('users',$user);
	//print_r(date("Y/m/d",strtotime("1 day")));exit;
		$cc['date_time']=date("Y/m/d");
	$datalist = array(
		date("Y/m/d"),
		date("Y/m/d",strtotime("1 day")),
		date("Y/m/d",strtotime("2 day")),
		date("Y/m/d",strtotime("3 day")),
		date("Y/m/d",strtotime("4 day")),
		date("Y/m/d",strtotime("5 day")),
		date("Y/m/d",strtotime("6 day"))
	);
	//print_r($datalist);
	$list = array();
	foreach($datalist as  $k=>$v){
		$list[$k]=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>array('like',"%".$v."%")))->order('id asc')->select();
	}
	//print_r($list);exit;
	//print_r(date("Y/m/d",strtotime("1 day")));exit;
	/* if($_GET['datetime']){
		$cc['date_time'] = date('Ymd',strtotime(trim($_GET['datetime'])));
		$whosha=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id'],'date_time'=>$cc['date_time']))->order('id asc')->select();
        $type = 6;
        //$this->assgin('active',$active);		
	} */	
	//$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//$haos=M("qyday_date")->where(array('user_id'=>$app['userid'],"wecha_id"=>$_GET['wecha_id']))->limit(5)->select();
	/* if($_GET['newnub']){	
		 $zent['id']=explode(",",$_GET['newnub']);
		 
		$map['id']=array('in',$zent['id']);
		$map['user_id']=$app['userid'];
		$map['wecha_id']=$_GET['wecha_id'];
		$data['type']=1;
		$data['subtime']=time();
		$hahas=M('qyday_date')->where($map)->save($data);
		$this->redirect(U('Day/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>$_GET['type'])));	
	}	 */
	// if($this->isAjax()){
		// $delectid = $_POST['delectid'];
		
		// $this->ajaxReturn(1);
	// }
	//$this->assign("haos",$haos);
	$week=$this->week();
	$this->assign('time',date('Y-m-d',strtotime($cc['date_time'])));
	$this->assign('type',$type);
	$this->assign('week',$week);	
	$this->assign('list',$list);//日程列表
	//print_r($whosha);exit;	
	$this->display();	
  
}

//ajax 获取数据
public function wap_index_ajax(){
	$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
	//$data = str_replace('-','/',$_POST['data']);
	//F('date',strtotime($_POST['date']));
	$datalist = array(
		strtotime($_POST['date']),
		strtotime($_POST['date']) + 3600*24,
		strtotime($_POST['date']) + 2*3600*24,
		strtotime($_POST['date']) + 3*3600*24,
		strtotime($_POST['date']) + 4*3600*24,
		strtotime($_POST['date']) + 5*3600*24,
		strtotime($_POST['date']) + 6*3600*24,
	);
	$datariqi = array();
	foreach($datalist as $k =>$v){
		$datariqi[$k]['riqi'] = date('m/d',$v);
		$datariqi[$k]['riqi1'] = date('Y/m/d',$v);
		$datariqi[$k]['zhouqi'] = $this->getWeek(date('w',$v));
	}
	$list = array();
	foreach($datalist as  $k=>$v){
		$list[$k]=M('qyday_date')->where(array('user_id'=>$app['userid'],"wecha_id"=>$_POST['wecha_id'],'date_time'=>array('like',"%".$datariqi[$k]['riqi1']."%")))->order('id asc')->select();
		
		if(!$list[$k]){
			$list[$k]['status'] = '-1';
		}else{
			foreach($list[$k] as $key=>$val){
				$list[$k][$key]['time'] = date('Y-m-d h:i',$val['d_time'] );
				$list[$k][$key]['hour'] = date('h:i',$val['d_time'] );
			}
		}
	}
	foreach($list as $k=>$v){
		foreach($list[$k] as $key=>$val){
			$userpic = M('qyusers')->where(array('wecha_id'=>$app['userid'],'userid'=>$val['wecha_id']))->field('pic')->find();
			$list[$k][$key]['userpic'] = $userpic['pic'];
		}
	} 
	//F('list',$list);
	if($list){
		echo json_encode(array('status'=>1,'list'=>$list,'riqi'=>$datariqi));//查询成功
	}else{
		echo json_encode(array('status'=>0));//查询失败
	}
}


//判断周几
function getWeek($d){
	$week = $d;
	switch($week){
		case 1:
			return "周一";
			break;
		case 2:
			return "周二";
			break;
		case 3:
			return "周三";
			break;
		case 4:
			return "周四";
			break;
		case 5:
			return "周五";
			break;
		case 6:
			return "周六";
			break;
		case 0:
			return "周日";
			break;
	}
}
//判断当前星期
function getWeektime(){
	$week = date('w',time());
	$temp = strtotime(date('Y-m-d',time()));
	switch($week){
		case 1:
			return array('start'=>$temp,'end'=>$temp + 3600 * 24 * 7);
			break;
		case 2:
			return array('start'=>$temp - 3600 * 24,'end'=>$temp + 3600 * 24 * 6);
			break;
		case 3:
			return array('start'=>$temp - 2*3600 * 24,'end'=>$temp + 3600 * 24 * 5);
			break;
		case 4:
			return array('start'=>$temp - 3*3600 * 24,'end'=>$temp + 3600 * 24 * 4);
			break;
		case 5:
			return array('start'=>$temp - 4*3600 * 24,'end'=>$temp + 3600 * 24 * 3);
			break;
		case 6:
			return array('start'=>$temp - 5*3600 * 24,'end'=>$temp + 3600 * 24 * 2);
			break;
		case 0:
			return array('start'=>$temp - 6*3600 * 24,'end'=>$temp + 3600 * 24 * 1);
			break;
	}
}
//修改日程状态
public function wap_edit(){
	if(IS_POST){
		$id = $_POST['id'];
		$reset = M('Qyday_date')->where(array('id'=>$id))->find();
		if(!$reset){
			echo json_encode(array('status'=>3));
		}
		if($id){
			
			if($reset['type'] == 1){
				$data['type']=0;
			}else{
				$data['type']=1;
			}
			$del = M('Qyday_date')->where(array('id'=>$id))->save($data);
			if($del){
				echo json_encode(array('status'=>$data['type']));
			}else{
				echo json_encode(array('status'=>2));
			}
		}
	}
}
public function wap_del(){
	if(IS_POST){
		$id = $_POST['id'];
		$del = M('Qyday_date')->where(array('id'=>$id))->delete();
		if($del){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}else{
		$this->ajaxReturn(3);
	}
}
public function wap_log_ajax(){
	$app=M('qymyapp')->where(array('token'=>$_POST['token']))->find();
	$data = $_POST;
	$menbers = str_replace('selected-users-','',$data['menbers']);
	$arr = explode(',',$menbers);
	$num = count($arr) - 1;
	unset($arr[$num]);
	$data['receive'] = '';
	foreach($arr as $k=>$v){
		$res = M('qyusers')->where(array('id'=>$v))->field('userid')->find();
		if($data['receive'] == ''){
			$data['receive'] = $res['userid'];
		}else{
			$data['receive'] = $data['receive'] .'|'. $res['userid'];
		}
	}
	$data['time'] = time();
	$data['user_id'] = $app['userid'];
	$id = M('qyday_log')->add($data);
	if($id){
		$inin['touser']=$data['receive'];
		//F('inin',$inin);
		$Msg=A('Qyapp/Msg');
		$inin['picurl']="picurl";
		$inin['title']="您收到了一个". $data['type'];
		$inin['description']="点击查看";
		//$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Task&a=wap_act_info&id='.$id.'&wecha_id='.$_POST['wecha_id'].'&token='.$_POST['token'];
		//$inin['url']="#";
		$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Day&a=wap_log_info&id='.$id.'&token='.$_POST['token'];
		$inin["agentid"]=$app['appid'];
		//$inin["userid"]=$app['userid'];
		//dump($head);dump($inin);dump($app);exit;
		$msg1=$Msg->msg_send_all($inin,$app['userid']);
		if($msg1['errcode']==0){
			echo json_encode(array('status'=>1,'list'=>$data));
		 }else{
			echo json_encode(array('status'=>0));
		}  
	}else{
		echo json_encode(array('status'=>0));
	}
}
public function wap_log_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$Oauth=A('Qyapp/Oauth');
		$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Day','wap_log_info',$_GET);	
	} 
	$id = $_GET['id'];
	$recode = M('qyday_log')->where(array('id'=>$id,'user_id'=>$app['userid']))->find();
	$arr = explode('未完成:',$recode['daywork']);
	$content = $arr[0] . '<br/>  未完成:' . $arr[1];
	$recode['daywork'] = str_replace(';','<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$content);
	$user=M('Qyusers')->where(array('userid'=>$recode['wecha_id'],'user_id'=>$app['userid']))->find();
	if($user['department'] == ''){
		$user['pid'] = str_replace(';','',$user['pid']);
		$department = M('department')->where(array('wxid'=>$user['pid'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}else{
		$user['department'] = str_replace(';','',$user['department']);
		$department = M('department')->where(array('wxid'=>$user['department'],'user_id'=>$app['userid']))->find();
		$user['department'] = $department['name'];
	}
	$recode['receive'] = explode('|',$recode['receive']);
	if(in_array($_GET['wecha_id'],$recode['receive'])|| $_GET['wecha_id'] == $recode['wecha_id'] || $_GET['wecha_id'] == $recode['receive']){
		$status = 1;
	}else{
		$status = 0;
	}
	//print_r($status);print_r($recode['receive']);
	$list = M('qyday_log_content')->where(array('pid'=>$id,'user_id'=>$app['userid']))->select();
	foreach($list as $k=>$v){
		$temp = M('qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$v['wecha_id']))->find();
		$list[$k]['name'] = $temp['name'];
		$list[$k]['pic'] = $temp['pic'];
	}
	//print_r($list);
	$this->assign('list',$list);
	$this->assign('status',$status);
	$this->assign('users',$user);
	$this->assign('recode',$recode);
	$this->display();
}
 public function wap_log_add_ajax(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_POST['type'] == '日报'){
		$where['d_time'] = array('between',array(strtotime(date('Y/m/d')),strtotime(date('Y/m/d')) + 24 * 3600));
	}
	if($_POST['type'] == '周报'){
		$temp = $this->getWeektime();
		$where['d_time'] = array('between',array($temp['start'],$temp['end']));
	}
	if($_POST['type'] == '月报'){
		$where['data_time'] = array('like',"%".date('Y/m')."%");
	}
	$where['user_id'] = $app['userid'];
	$where['wecha_id'] = $_GET['wecha_id'];
	//F('where',$where);
	$list = M('qyday_date')->where($where)->select();
	$daywork ='';
	$needwork ='';
	foreach($list as $k=>$v){
		if($v['type'] == 0){
				$needwork[]= $v['date_content'];
		}else{
				$daywork[]= $v['date_content'];
		}
	}
	//F('list',$list);
	if($list){
		echo json_encode(array('status'=>1,'daywork'=>$daywork,'needwork'=>$needwork));
	}else{
		echo json_encode(array('status'=>1,'daywork'=>'','needwork'=>''));
	}
	
} 
public function wap_log_add(){
	/* if($_POST){
	    dump($_POST); */
		/* F('mydata',$_POST);
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$user=M("qyusers")->where(array('userid'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();	
		$data['user_id']=$app['userid'];
		$data['wecha_id']=$_POST['wecha_id'];
		$data['d_time']=strtotime($_POST['datetime']);
		$data['date_time']=str_replace('-','',str_replace('-','',$_POST['datetime']));
		if($_POST['project']){
			foreach($_POST['project'] as $k=>$v){
				$data['date_zt'] = $v['theme'];
				$data['date_content'] = $v['info'];
				$arr = explode(':',$v['dotime']);
				F('arr',$arr);
				$data['hour'] = $arr[0];
				$data['min'] = $arr[1];
				foreach($v['pic'] as $key=>$value){
					$data['pic'] .= $value . ',';
				}
				if($data['date_zt']){
					$id = M("qyday_date")->add($data);
				}
			}
				$this->redirect(U('Day/wap_index',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'])));
		} */
			
	//}else{
	    $this->display();	
	//} 
}
public function rcday(){
	if($_POST){
	    //dump($_POST);
		F('mydata',$_POST);
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$user=M("qyusers")->where(array('userid'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();	
		$data['user_id']=$app['userid'];
		$data['wecha_id']=$_POST['wecha_id'];
		$data['d_time']=strtotime($_POST['datetime']);
		$data['date_time']=str_replace('-','',str_replace('-','',$_POST['datetime']));
		if($_POST['project']){
			foreach($_POST['project'] as $k=>$v){
				$data['date_zt'] = $v['theme'];
				$data['date_content'] = $v['info'];
				$arr = explode(':',$v['dotime']);
				F('arr',$arr);
				$data['hour'] = $arr[0];
				$data['min'] = $arr[1];
				foreach($v['pic'] as $key=>$value){
					$data['pic'] .= $value . ',';
				}
				if($data['date_zt']){
					$id = M("qyday_date")->add($data);
				}
			}
				$this->redirect(U('Day/wap_index',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'])));
		}
			
	}else{
	    $this->display();	
	} 

}
public function rcdayajax(){
	if($_POST){
	$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
	$whos=M("qyday_date")->where(array('wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],"date_nub"=>$_POST['m']))->find();
	if($whos){
	
	echo json_encode(array('data'=>$whos));
	}else{
	echo json_encode(array('data'=>1));
	}
	
	}


}
public function myrili(){
	if(!$_GET['type']){
	$nubha=1;
	
	}
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$whos=M("qyday_date")->where(array('wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],"date_nub"=>$_GET['type']))->select();
	$this->assign('whos',$whos);
	$this->assign('nubha',$nubha);
	$this->display();
	

	


}
function week(){
		$week   =  date( "D ");   
		switch($week)   
		 {   
			 case "Mon ":  
				$current[1]   =   $format."一";   
				$current[2]   =   $format."二";  
				$current[3]   =   $format."三";  
				$current[4]   =   $format."四";  
				$current[5]   =   $format."五";
				$current[6]   =   $format."六"; 
				$current[7]   =   $format."日";						
				 break;   
			 case "Tue ":  
				$current[1]   =   $format."二";  
				$current[2]   =   $format."三";  
				$current[3]   =   $format."四";  
				$current[4]   =   $format."五";  
				$current[5]   =   $format."六";  
				$current[6]   =   $format."日"; 
				$current[7]   =   $format."一";	
				 break;   
			 case "Wed ":     
				$current[1]   =   $format."三";  
				$current[2]   =   $format."四";  
				$current[3]   =   $format."五";  
				$current[4]   =   $format."六";  
				$current[5]   =   $format."日";
				$current[6]   =   $format."一"; 
				$current[7]   =   $format."二";	
				 break;  
			 case "Thu ":   
				$current[1]   =   $format."四";  
				$current[2]   =   $format."五";  
				$current[3]   =   $format."六";  
				$current[4]   =   $format."日";
				$current[5]   =   $format."一"; 
				$current[6]   =   $format."二"; 
				$current[7]   =   $format."三";

				 break;  
			 case "Fri ":    
				$current[1]   =   $format."五";  
				$current[2]   =   $format."六";  
				$current[3]   =   $format."日";
				$current[4]   =   $format."一";  
				$current[5]   =   $format."二";
				$current[6]   =   $format."三"; 
				$current[7]   =   $format."四";
				break;   

			 case "Sat ":   
				$current[1]   =   $format."六";  
				$current[2]   =   $format."日";
				$current[3]   =   $format."一";  
				$current[4]   =   $format."二"; 
				$current[5]   =   $format."三";
				$current[6]   =   $format."四"; 
				$current[7]   =   $format."五";
				 break;   
			 case "Sun ":   
				$current[1]   =   $format."日";
				$current[2]   =   $format."一";  
				$current[3]   =   $format."二"; 
				$current[4]   =   $format."三";
				$current[5]   =   $format."四";
				$current[6]   =   $format."五"; 
				$current[7]   =   $format."六";
				break;   

		}
		return $current;



}
}