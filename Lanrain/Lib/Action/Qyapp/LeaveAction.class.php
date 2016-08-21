<?php
/**
*请假管理
**/
class LeaveAction extends Action{
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
    $this->check();
	if($_POST){
		$where['user_id'] = $_SESSION['user_id'];
		//按照时间段
		if(!empty($_POST['searchmoment'])){
			$arr = explode('-',$_POST['searchmoment']);
			$t1 = strtotime(trim($arr[0]));
			$t2 = strtotime(trim($arr[1]));
			$begintime=mktime(0,0,0,date('m',$t1),date('d',$t1),date('Y',$t1));
			$endtime=mktime(23,59,59,date('m',$t2),date('d',$t2),date('Y',$t2));
			$where['time']=array('between',array($begintime,$endtime));
			$this->assign('searchmoment',$_POST['searchmoment']);
		}
        if(!empty($_POST['username'])){
			if(strstr($v['username'],'(')){
				$where['name'] = substr($_POST['username'],0,strpos($_POST['username'],'('));
				//$users[$i]=$v['auditname'];				
			}else{
				$where['name']=$_POST['username'];	
                $this->assign('searchmoment',$where['name']);				
			} 		    
		}	
		$info = M('Qyleave_type')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('info',$info);		
		$count      = M('qyleave_index')->where($where)->count();
		$Page       = new Page($count,15);
		$data = M('qyleave_index')->order('name desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();				
	}else{
		$info = M('Qyleave_type')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('info',$info);		
		$count      = M('qyleave_index')->where($where)->count();
		$Page       = new Page($count,15);
		$data = M('qyleave_index')->order('name desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();		
	}




		
}

public function conf(){
    $this->check();
        if($_POST){
		    $where['user_id'] = $_SESSION['user_id'];
			//按照时间段
			if(!empty($_POST['searchmoment'])){
				//print_r($_POST);exit;
				$arr = explode('-',$_POST['searchmoment']);
				$t1 = strtotime(trim($arr[0]));
				$t2 = strtotime(trim($arr[1]));
				//$ti=strtotime($_POST['month']);
				$begintime=mktime(0,0,0,date('m',$t1),date('d',$t1),date('Y',$t1));
				$endtime=mktime(23,59,59,date('m',$t2),date('d',$t2),date('Y',$t2));
				$where['time']=array('between',array($begintime,$endtime));
				$this->assign('searchmoment',$_POST['searchmoment']);
			}		
		}



	    $info = M('Qyleave_type')->where($where)->select();
		$this->assign('info',$info);		
		$count      = M('qyleave_index')->where($where)->count();
		$Page       = new Page($count,15);
		$data = M('qyleave_index')->order('name desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();	
}

/**
 * 请假详情导出
 */
public function exportSN()
	{
	   
		//$objReader = PHPExcel_IOFactory::createReader('Excel5');
		//header("Content-Type: text/html; charset=utf-8");
		//header("Content-type:application/vnd.ms-execl");
		//header("Content-Disposition:filename=kaoqing.xls");

		header("Content-Type: application/vnd.ms-execl"); 
        header("Content-Type: application/vnd.ms-excel;charset=gb2312");
		header("Content-Disposition: attachment;filename=card.xls");
		header("Pragma: no-cache"); 
        header("Expires: 0");
		//   以下\t代表横向跨越一格，\n 代表跳到下一行，可以根据自己的要求，增加相应的输出相，要和循环中的对应哈
		//字段
		$letterArr=explode(',',strtoupper('a,b,c,d,e,f,g,h'));
		$arr=array(
			array('en'=>'id','cn'=>'编号'),
		    array('en'=>'name','cn'=>'姓名'),
		    array('en'=>'nianjia','cn'=>'年假'),
		    array('en'=>'tiaoxiu','cn'=>'调休'),
		    array('en'=>'shijia','cn'=>'事假'),
		    array('en'=>'bingjia','cn'=>'病假'),
		    array('en'=>'hunjia','cn'=>'婚假'),
		    array('en'=>'chanjia','cn'=>'产假'),
		    array('en'=>'sangjia','cn'=>'丧假'),
		    array('en'=>'qita','cn'=>'其他')   
		);
		$i=0;
		$fieldCount=count($arr);
		$s=0;
		//thead
		foreach ($arr as $f){
			if ($s<$fieldCount-1){
				echo iconv('utf-8','gbk',$f['cn'])."\t";
			}else {
				echo iconv('utf-8','gbk',$f['cn'])."\n";
			}
			$s++;
		}
		$user_id = $_SESSION['user_id'];
		$card_create_db =M('qyleave_index');	
		$members   = $card_create_db->where(array('user_id'=>$user_id))->select();
		if ($members ){
			foreach ($members as $ke=>$v){
				$j=0;
				foreach ($arr as $field){
					$fieldValue=$v[$field['en']];
					switch ($field['en']){
						default:
							break;
						case 'id':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'name':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'nianjia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'tiaoxiu':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'shijia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'bingjia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;	
						case 'hunjia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;	
						case 'chanjia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;	
						case 'sangjia':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;
						case 'qita':
							$fieldValue=iconv('utf-8','gbk',$fieldValue);
							break;		
						
					}
					if ($j<$fieldCount-1){
						echo $fieldValue."\t";
					}else {
						echo $fieldValue."\n";
					}
					$j++;
				}
				$i++;
			} 
		}
		exit();
	}




/**
*配置审核人
**/
public function conf_man(){
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
		$check=M('Qyleave_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($check){
			M('Qyleave_config')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$check['id']))->delete();
		}
		$id = M('Qyleave_config')->add($data); 
		if($id){
		    $this->success('设置成功',U('Leave/conf_man',array('mid'=>$_GET['mid']))); 
		}else{
		    $this->error('设置失败');
		}		
	}else{
	    $check=M('Qyleave_config')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->find();
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
*配置请假类型
**/
public function leaveType(){
    if(IS_POST){
		$data = array();		
		foreach($_POST['leave'] as $k=>$v){
			$data = $v;
			if($v['status']){
				$data['status'] = $v['status'];
			}else{
				$data['status'] = 0;
			}
			$data['user_id'] = $_SESSION['user_id']; 
			$id = M('Qyleave_type')->where(array('user_id'=>$_SESSION['user_id'],'name'=>$v['name']))->find();
			if($id){
                M('Qyleave_type')->where(array('user_id'=>$_SESSION['user_id'],'name'=>$v['name']))->save($data);			
			}else{
			    M('Qyleave_type')->add($data);
			}
			 
		}
		$this->success('设置成功',U('Leave/leaveType',array('mid'=>$_GET['mid'])));	 	
	}else{
		$data=M('Qyleave_type')->where(array('user_id'=>$_SESSION['user_id']))->order('disorder asc')->select();
        if($data){ 
		    $this->assign('data',$data);		
		}else{
			$data =array(
				array('name' => '年假','cname' => '年假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>1), 
				array('name' => '调休','cname' => '调休','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>2),
				array('name' => '事假','cname' => '事假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>3),
				array('name' => '病假','cname' => '病假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>4),
				array('name' => '婚假','cname' => '婚假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>5),
				array('name' => '产假','cname' => '产假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>6),
				array('name' => '丧假','cname' => '丧假','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>7),
				array('name' => '其它','cname' => '其它','status'=>'on','days'=>0,'mintime'=>12,'disorder'=>8)
			);
		    $this->assign('data',$data);			
		}		
		$this->display();	
	}

}

/**
*详情
**/
public function LeaveInfo(){
	$this->display();
}


/*****************手机端********************/
/*
*首页
*/
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//dump($app);dump($_GET);exit;
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Leave';
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
		//F('cookie55',$_COOKIE);
		//默认首页显示我申请的假期
		$_GET['status'] ?$status=$_GET['status'] : $status=0;
		//echo $status;
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('name,pic,position')->find();
		$this->assign('user',$user);
		$arr=M('Qyleave_record')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'status'=>$status))->select();
		$res = M('qyleave_type')->where(array('user_id'=>$app['userid']))->select();
		foreach($res as $k=>$v){
		    $type[$v['id']] = $v['name'];
		}
		$list = array();
		$i = 0;
		foreach($arr as $key=>$val){
		    $list[$i] = $val;
			$list[$i]['typename'] = $type[$val['type']];
			$i++;
		}
		$this->assign('list',$list);
		
	$this->display();


}

/*
*我的假单
*/
public function wap_list(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Leave';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_list');
		exit();
	}
	$_GET['status'] ?$status=$_GET['status'] : $status=0;
	// echo $status;exit;
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('name,pic')->find();
	$this->assign('user',$user);
	$list=M('Qyleave_record')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'status'=>$status))->order('id desc')->limit(15)->select();
	foreach($list as $ke=>$va){
		$type=M('Qyleave_type')->where(array('id'=>$va['type']))->field('cname')->find();	
		$lists[$ke]=$va;
		$lists[$ke]['type']=$type['cname'];
	}
	//dump($lists);die();
	$this->assign('list',$lists);
	$this->display();
}

/*
*请假
*/
public function wap_holiday(){
    
	//请假类型
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Leave';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_holiday');
		exit();
	}
	
	
	$type=M('Qyleave_type')->where(array('user_id'=>$app['userid'],'status'=>'on'))->select();
	$this->assign('type',$type);
	//$checker=M('Qyleave_config')->where(array('user_id'=>$app['userid']))->find();
	//dump(unserialize('{i:1;s:1:"2";i:2;s:2:"25";i:3;s:1:"1";i:4;s:10:"1417511335";}'));
	$this->display();
}

/**
*请假提交
**/
public function wap_holiday_post(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		$_POST['user_id']=$app['userid'];
		$_POST['time']=time();
		$_POST['day']=(strtotime($_POST['stop_time'])-strtotime($_POST['start_time']))/(3600*24);
		$day=M('Qyleave_type')->where(array('id'=>$_POST['type']))->field('days')->find();
		$now = time();
		$beginTime = mktime(0, 0,0, 1, 1, date('Y', $now));  
		$endTime = mktime(0, 0, 0, 12, 31, date('Y', $now)); 
		$daysum=M('Qyleave_record')->where(array('type'=>$_POST['type'],'wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid'],'time'=>array('between',array($beginTime,$endTime))))->sum('day');
		//if(($daysum+$_POST['day']) > $day['days']){
			//echo json_encode(array('status'=>4));//该类型请假时间已用完
			//DIE();
		//}
		//根据时间类型新增请假记录
		//按小时类型
		if($_POST['typetime']==1){
			$_POST['hour']=$_POST['hours'];
			$_POST['day']=0;
			$_POST['timetype']=1;
			$_POST['daytype']=0;
		}
		//按半天模式
		if($_POST['typetime']==2){
			$_POST['day']=0;
			$_POST['timetype']=2;
		}
		//整天模式typetime
		if($_POST['typetime']==3){
			$_POST['daytype']=0;
			$_POST['timetype']=3;
		}
		$id=M('Qyleave_record')->add($_POST);
		if($id){
			$checker=M('Qyleave_config')->where(array('user_id'=>$app['userid']))->find();
			if(!$checker){
				echo json_encode(array('status'=>2));//没有请假审核人
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
					M('Qyleave_check')->add(array('user_one'=>$_POST['wecha_id'],'user_two'=>$v,'user_id'=>$app['userid'],'pid'=>$id,'time'=>time()));
					$i++;
				}
			}
			$_POST['check_now']=$arr[1];
			$_POST['check_order']=serialize($arr);
			M('Qyleave_record')->where(array('id'=>$id))->save($_POST);
			//给所有用户发送审核信息
			$inin['touser']=implode('|',$arr);
			$Msg=A('Qyapp/Msg');
			$inin['title']="您有一个请假申请需要您查看";
			$inin['description']="请您点击进入查看详情";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Leave&a=wap_wait_check&token='.$_POST['token'].'&pid='.$id;
			$inin["agentid"]=$app['appid'];
			$msg=$Msg->msg_send_all($inin,$app['userid']);

			if($msg['errcode']==0){
				echo json_encode(array('status'=>1));//添加成功
			}else{
				M('Qyleave_record')->where(array('id'=>$id))->delete();
				echo json_encode(array('status'=>3));//群发失败审核人id不对
			}
		 }else{
			echo json_encode(array('status'=>0));//添加失败
		 }
	}
}

/*
*请假详情
*/
public function wap_holiday_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//echo('有数据么');exit;
    //print_r($_GET);exit;
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Leave';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_holiday_info',$_GET['pid']);
			exit();
		}
	if($_GET['pid']){
		$record=M('Qyleave_record')->where(array('id'=>$_GET['pid']))->find();
		$record['types']=M('Qyleave_type')->where(array('id'=>$record['type']))->field('cname')->find();
		$this->assign('data',$record);
		$use=M('Qyusers')->where(array('userid'=>$record['wecha_id'],'user_id'=>$app['userid']))->find();
		$this->assign('user',$use);
		$check=M('Qyleave_check')->where(array('pid'=>$record['id'],'status'=>1))->select();//已经审核记录
		foreach($check as $k=>$v){
			$re[$k]=$v;
			$re[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_two'],'user_id'=>$app['userid']))->field('name,pic')->find();
		}
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
		$data['module']='Leave';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_wait_check');
		exit();
	}
	if($_GET['status']!=0){
		$sstatus=array('NEQ',0);
	}else{
		$sstatus=0;
	}
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->field('name,pic')->find();
	$this->assign('user',$user);
	$list=M('Qyleave_check')->where(array('user_id'=>$app['userid'],'user_two'=>$_GET['wecha_id'],'status'=>$sstatus))->order('id desc')->select();
	foreach($list as $k=>$v){
		$arr[$k]=$v;
		$arr[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_one'],'user_id'=>$app['userid']))->field('name,pic')->find();
		$arr[$k]['info']=M('Qyleave_record')->where(array('id'=>$v['pid']))->find();
		$arr[$k]['type']=M('Qyleave_type')->where(array('id'=>$arr[$k]['info']['type']))->field('cname')->find();
	}
	//dump($user);exit;
	//print_r($arr);exit;
	$this->assign('list',$arr);
	$this->display();
}

/*
*请假详情
*/
public function wap_check_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Leave';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_holiday_info',$_GET['pid']);
			exit();
	}
	// print_r($_GET['pid']);exit;
	if($_GET['pid']){
		$checks=M('Qyleave_check')->where(array('id'=>$_GET['pid']))->find();
		$record=M('Qyleave_record')->where(array('id'=>$checks['pid']))->find();
		$record['types']=M('Qyleave_type')->where(array('id'=>$record['type']))->field('cname')->find();
		//dump($record);exit;
		$this->assign('data',$record);
		$use=M('Qyusers')->where(array('userid'=>$record['wecha_id'],'user_id'=>$app['userid']))->find();
		$this->assign('user',$use);
		$check=M('Qyleave_check')->where(array('pid'=>$record['id'],'status'=>array('neq',0)))->select();//已经审核记录
		foreach($check as $k=>$v){
			$re[$k]=$v;
			$re[$k]['user']=M('Qyusers')->where(array('userid'=>$v['user_two'],'user_id'=>$app['userid']))->field('name,pic,position')->find();
		}
		// print_r($record);exit;
		$this->assign('checks',$checks);
		$this->assign('check',$re);
		$this->display();
	}
}


/**
*同意请假
**/

public function agree(){
	if(IS_POST){
	
		//F('postdata11',$_POST);
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid,appid')->find();
		// print_r($app);exit;
		//F('app',$app);
		//同意同时给下一个人发信息说明已经同意 同时判断当前审核员是否可以审核
		$record=M('Qyleave_record')->where(array('id'=>$_POST['pid']))->find();
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
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Leave&a=wap_check_info&token='.$_POST['token'].'&pid='.$_POST['pid'];
					$inin["agentid"]=$app['appid'];
					$msg=$Msg->msg_send_all($inin,$app['userid'],$id);
					//dump($msg);exit;
					if($msg['errcode']==0){
						
						M('Qyleave_record')->where(array('id'=>$_POST['pid']))->save(array('check_now'=>$next));
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
		$record=M('Qyleave_record')->where(array('id'=>$_POST['pid']))->find();
		if($_POST['wecha_id']==$record['check_now']){
			$id=M('Qyleave_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>2,'time'=>time()));
			if($id){
				$next=$record['wecha_id'];
				$inin['touser']=$next;
				$Msg=A('Qyapp/Msg');
				$inin['title']="您的请假申请被驳回";
				$inin['description']="请您点击进入查看详情";
				$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Leave&a=wap_check_info&token='.$_POST['token'].'&pid='.$id;
				$inin["agentid"]=$app['appid'];
				$msg=$Msg->msg_send_all($inin,$app['userid']);
				if($msg['errcode']==0){
					// M('Qyleave_check')->where(array('id'=>$_POST['pid']))->save(array('status'=>2));//驳回
					// $id=M('Qyleave_check')->where(array('pid'=>$_POST['pid'],'user_two'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->save(array('status'=>2,'time'=>time()));
					M('Qyleave_record')->where(array('id'=>$_POST['pid']))->save(array('status'=>2));//驳回审核停止
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





}