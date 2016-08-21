<?php

/**
 * 
 * 外勤管理
 *
 */
class LegworkAction extends Action{
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
	 * 外勤人员统计
	 */
	public function index(){
	    $this->check();
		$user_id = $_SESSION['user_id'];
		$where['user_id']=$_SESSION['user_id'];
		
		if(IS_POST){
			
			//按用户名查询
			if($_POST['username']){
				$user = M('Qyusers')->where(array('name'=>$_POST['username'],'user_id'=>$user_id))->field('id')->find();
				$where['uid'] = $user['id'];
			}
			
			//按部门查询
			if($_POST['department']){
				$list = array();
				$result = array();
				$post = explode(';', $_POST['department']);
				foreach ($post as $v){
					if($v){
						$list[] = $v;
					}
				}
				foreach ($list as $va){
					$result1[] = M('Department')->where(array('name'=>$va,'user_id'=>$user_id))->field('wxid')->find();
				}
				foreach ($result1 as $k=>$v){
					$wh['pid'][]= array('like','%'.$result1[$k]['wxid'].'%');
				}
				$wh['user_id'] = $_SESSION['user_id'];
				$user = M('Qyusers')->where($wh)->select();
			}
		
		}
		$model = M('Qyfield');
		if($_POST['department']){
			foreach ($user as $v){
				$where['uid'] = $v['id'];
				$arr = $model->where($where)->find();
				$result[] = $arr;
			}
		}
		else{
			$result = $model->where($where)->select();
		}
		if($result){
			foreach($result as $k=>$v){
				$departments = '';
				$user = M('Qyusers')->where(array('id'=>$v['uid'],'user_id'=>$user_id))->find();
				$pid = explode(';', $user['pid']);
				foreach ($pid as $va){
					if($va){
						$department = M('Department')->where(array('user_id'=>$user_id,'wxid'=>$va))->find();
						$departments .=$department['name'].'|';
					}
				}
				$result[$k]['name'] = $user['name'];
				$result[$k]['department'] = $departments;
				$result[$k]['position'] = $user['position'];
			}
		}
		$this->assign('arr',$result);
		$this->display();
	}
	
	/**
	 * 外勤人员统计
	 */
	public function manage(){
	    $this->check();
		$user_id = $_SESSION['user_id'];
		$where['user_id']=$_SESSION['user_id'];
		
		if(IS_POST){
			
			//按用户名查询
			if($_POST['username']){
				$user = M('Qyusers')->where(array('name'=>$_POST['username'],'user_id'=>$user_id))->field('id')->find();
				$where['uid'] = $user['id'];
			}
			
			//按部门查询
			if($_POST['department']){
				$list = array();
				$result = array();
				$post = explode(';', $_POST['department']);
				foreach ($post as $v){
					if($v){
						$list[] = $v;
					}
				}
				foreach ($list as $va){
					$result1[] = M('Department')->where(array('name'=>$va,'user_id'=>$user_id))->field('wxid')->find();
				}
				foreach ($result1 as $k=>$v){
					$wh['pid'][]= array('like','%'.$result1[$k]['wxid'].'%');
				}
				$wh['user_id'] = $_SESSION['user_id'];
				$user = M('Qyusers')->where($wh)->select();
			}
		
		}
		$model = M('Qyfield');
		if($_POST['department']){
			foreach ($user as $v){
				$where['uid'] = $v['id'];
				$arr = $model->where($where)->find();
				$result[] = $arr;
			}
		}
		else{
			$result = $model->where($where)->select();
		}
		if($result){
			foreach($result as $k=>$v){
				$departments = '';
				$user = M('Qyusers')->where(array('id'=>$v['uid'],'user_id'=>$user_id))->find();
				$pid = explode(';', $user['pid']);
				foreach ($pid as $va){
					if($va){
						$department = M('Department')->where(array('user_id'=>$user_id,'wxid'=>$va))->find();
						$departments .=$department['name'].'|';
					}
				}
				$result[$k]['name'] = $user['name'];
				$result[$k]['department'] = $departments;
				$result[$k]['position'] = $user['position'];
			}
		}
		$this->assign('arr',$result);
		$this->display();
	}
	
	/**
	 * 外勤人员外勤详情
	 */
	public function info(){
	    $this->check();
		$id = $_GET['id'];
		if(IS_POST){
		//TYPE
			if(!empty($_POST['searchday'])){
				$day=strtotime($_POST['searchday']);
				$beginthisday=mktime(0,0,0,date('m',$day),date('d',$day),date('Y',$day));
				$endthisday=mktime(23,59,59,date('m',$day),date('d',$day),date('Y',$day));
				$where['btime']=array('between',array($beginthisday,$endthisday));
				$this->assign('searchday',$_POST['searchday']);
			}
			//按照月份
			if(!empty($_POST['monthy']) && !empty($_POST['monthm'])){
				$begin = $_POST['monthy'].'-'.$_POST['monthm'];
				$t1=strtotime($begin);
				$end = $_POST['monthy'].'-'.($_POST['monthm']+1);
				if(($_POST['monthm']+1) > 12){
					$end = ($_POST['monthy']+1).'-01';
				}else{
					$end = $_POST['monthy'].'-'.($_POST['monthm']+1);
				}
				$t2=strtotime($end);
				$beginThismonth=mktime(0,0,0,date('m',$t1),date('d',$t1),date('Y',$t1));
				$endThismonth=mktime(0,0,0,date('m',$t2),date('d',$t2),date('Y',$t2));
				$where['btime']=array('between',array($beginThismonth,$endThismonth));
				$this->assign('monthy',$_POST['monthy']);
				$this->assign('monthm',$_POST['monthm']);
			}
			//按照时间段
			if(!empty($_POST['searchmoment'])){
				$arr = explode('-',$_POST['searchmoment']);
				$t1 = strtotime(trim($arr[0]));
				$t2 = strtotime(trim($arr[1]));
				//$ti=strtotime($_POST['month']);
				$begintime=mktime(0,0,0,date('m',$t1),date('d',$t1),date('Y',$t1));
				$endtime=mktime(23,59,59,date('m',$t2),date('d',$t2),date('Y',$t2));
				$where['btime']=array('between',array($begintime,$endtime));
				$this->assign('searchmoment',$_POST['searchmoment']);
			}
		}
		
		$user = M('Qyfield')->where(array('id'=>$id))->find();
		$where['wxid'] = $user['uid'];
		$where['user_id'] = $_SESSION['user_id'];
		$list = M('Qyfield_report')->where($where)->select();
		foreach ($list as $k=>$v){
			if($v['status']==1){
				$list[$k]['status'] = '正在进行中...';
			}else{
				$list[$k]['status'] = '已经结束';
			}
			
			$list[$k]['btime'] = date('Y/m/d',$v['btime']);
			$list[$k]['etime'] = date('Y/m/d',$v['etime']);
			
		}
		$user = M('Qyusers')->where(array('id'=>$user['uid'],'user_id'=>$_SESSION['user_id']))->find();
		$this->assign('name',$user['name']);
		$this->assign('arr',$list);
		$this->display();	
	}
	
	
	public function realtime(){
	    $this->check();
		$list = M('Qyfield')->where(array('user_id'=>$_SESSION['user_id']))->select();
		foreach($list as $k=>$v){
			$departments = "";
			$user = M('Qyusers')->where(array('id'=>$v['uid']))->find();
			$dep = explode(';',$user['pid']);
			foreach($dep as $vo){
				if($vo){
					$department = M('Department')->where(array('user_id'=>$_SESSION['user_id'],'wxid'=>$vo))->find();
					$departments .=$department['name'].'|';	
				}
			}
				$list[$k]['name'] = $user['name'];
				$list[$k]['department'] = $departments;
				$list[$k]['position'] = $user['position'];
			$report = M('Qyfield_report')->where(array('wxid'=>$user['id'],'user_id'=>$_SESSION['user_id']))->find();
			$check =  M('Qyfield_check')->where(array('record_id'=>$report['id'],'user_id'=>$_SESSION['user_id']))->find();
			$list[$k]['outplace'] = $report['outplace'];
			$list[$k]['checktime'] = $check['checktime'];
			$list[$k]['long'] = $check['long'];
			$list[$k]['lat'] = $check['lat'];
		}
		$this->assign('data',$list);
		$this->display();
	}
	
	/**
	 * 实时查岗签到
	 */
	 
	 
	 
	 
	 
	/**
	 * 实时查岗签退
	 */
	
	/**
	 * 外勤设置
	 */
	public function setting(){
	    $this->check();
		$data['user_id'] = $_SESSION['user_id'];
		if(IS_POST){
			$data['inphoto'] = $_POST['inphoto'];//1表示必须拍照 0表示不用拍照
			$data['outphoto'] = $_POST['outphoto'];
			$data['range'] = $_POST['range'];
			$type = array();
			foreach ($_POST['type'] as $k=>$v){
				if(!empty($v)){
					$type[] = $v;
				}
			}
			$data['style'] = implode(',', $type);
			$data['in_remind'] = $_POST['in_remind'] == 'on' ? 1 : 0;
			$data['in_remind_time'] = $_POST['in_remind_time'];
			$data['in_remind_hour'] = $_POST['in_remind_hour'];
			$data['in_remind_minute'] = $_POST['in_remind_minute'];
			$data['out_remind'] = $_POST['out_remind'] == 'on' ? 1 : 0;
			$data['out_remind_time'] = $_POST['out_remind_time'];	
			$data['out_remind_hour'] = $_POST['out_remind_hour'];
			$data['out_remind_minute'] = $_POST['out_remind_minute'];	
            //print_r($data);exit;
			//判断是否有存在的规则
			$m = M('Qyfield_type')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($m){
				$result = M('Qyfield_type')->where(array('user_id'=>$_SESSION['user_id']))->save($data);
				if($result){
					 $this->success('修改成功',U('Legwork/setting',array('mid'=>$_GET['mid'])));
				}else{
					 $this->error('修改失败');
				}
			}else{
				$result = M('Qyfield_type')->add($data);
				if($result){
					 $this->success('保存成功',U('Legwork/setting',array('mid'=>$_GET['mid'])));
				}else{
					 $this->error('保存失败');
				}
			}
		}else{
            $day = array();
            $hour = array();
            for($i=0;$i<60;$i++){
			    if($i<10){
				   $hour[$i]= '0'.$i; 
				}else{
				   $hour[$i]= $i;
				} 
			}		
            for($m=0;$m<24;$m++){
			    if($m<10){
				   $day[$m]= '0'.$m; 
				}else{
			        $day[$m]= $m;
				}				
			}		
		    $this->assign('hour1',$hour);
		    $this->assign('hour2',$hour);	
		    $this->assign('day1',$day);
		    $this->assign('day2',$day);				
		    $data = M('Qyfield_type')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if($data){
			    $type = explode(',',$data['style']);
				$type = json_encode($type);
				$this->assign('type',$type);				
				$this->assign('data',$data);					
				$this->display('config');			    
			}else{
				$this->display('unconfig');			
			}
    			

		}
	}
		
/**wap**/
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Legwork';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
				exit();
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		$localtion=S('local_'.$_GET['wecha_id']);
		//显示个人外勤信息，以创建时间顺序排序
		$list = M('Qyfield_report')->where(array('uid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->order('id desc')->select();
		$this->assign('list',$list);
		$this->assign('name',$user['name']);
		$this->display();
	}
	//删除计划
	public function wap_del(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Legwork';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_del');
				exit();
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		$id = $_GET['id'];
		$del = M('Qyfield_report')->where(array('id'=>$id))->delete();
		if($del){
			$url = U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));
			$this->redirect($url);
		}
	}
	/**
	 *添加外勤
	 */
	public function wap_add(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Legwork';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_add');
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		$localtion=S('local_'.$_GET['wecha_id']);
		$this->assign('point',$localtion);
		
		//得到当前用户的ID
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id,name')->find();
		//print_r($user);
		$this->assign('user',$user);
		//遍历外出类型
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		$type = M('Qyfield_type')->where(array('user_id'=>$app['userid']))->find();
		$type = explode(',', $type['style']);
		$this->assign('type',$type);
		if(IS_POST){
		    $user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id,name')->find();
			//保存外勤人员的信息
			$data['user_id'] = $app['userid'];
			$data['uid'] = $_GET['wecha_id'];
			$data['wxid'] = $user['id'];
			$data['outstyle'] = $_POST['type'];
			$data['outaim'] = $_POST['outaim'];
			$data['outplace'] = $_POST['outplace'];
			$data['type'] = $_POST['check_type'];//1表示签到/退，2表示仅签到
			$data['btime'] = strtotime($_POST['btime']);
			$data['etime'] = strtotime($_POST['etime']);
			//print_r($data);exit;
			if(!($data['outstyle']&&$data['outaim']&&$data['btime'])){
				$this->ajaxReturn(1);
			}else{
				if(($data['etime']-$data['btime'])>0){
					$result = M('Qyfield_report')->add($data);
					if($result){
						$arr = M('Qyfield')->where(array('user_id'=>$app['userid'],'uid'=>$user['id']))->find();
						if(!$arr){
							$data1['uid'] = $user['id'];
							$data1['user_id'] = $app['userid'];
							$data1['ctime'] = $data['btime'];
							$add = M('Qyfield')->add($data1);
							if($add){
								$this->ajaxReturn(2);
							}
						}
						$this->ajaxReturn(3);
					}else{
						$this->ajaxReturn(4);
					}
				}else{
					$this->ajaxReturn(5);
				}
			}
		}
		
		$this->display();
	}
	public function baiduapi(){
		
		$this->display();
	}
	
	/**
	 * 签到
	 */
	public function wap_check(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Legwork';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_check');
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		$localtion=S('local_'.$_GET['wecha_id']);
		$this->assign('point',$localtion);
		$id = $_GET['id'];//获取当前外勤的id,并添加在此id范围内所有签到记录
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		if($id){
			$result = M('Qyfield_report')->where('id='.$id)->find();
			$this->assign('data',$result);
			$this->assign('id',$id);
			if(IS_POST){
				//签到时间
				$data['checktime'] = time();
				//签到照片
				$must = M('Qyfield_type')->where(array('user_id'=>$_SESSION['user_id']))->find();
				if($_POST['photo']){
					$data['img'] = $_POST['photo'];
				}
				$data['desc'] = $_POST['desc'];
				$data['place'] = $_POST['place'];
				$data['record_id'] =$id; 
				$data['long'] = $localtion['Longitude'];
				$data['lat'] = $localtion['Latitude'];
				$data['user_id'] = $app['userid'];
				$result = M('Qyfield_check')->add($data);
			}
		}else{
			$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
		}
		$this->display();
	}
	
	/**
	 * 签退
	 */
	public function wap_sign(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Legwork';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_sign');
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		$localtion=S('local_'.$_GET['wecha_id']);
		$this->assign('point',$localtion);
		$id = $_GET['id'];//获取当前外勤的id,并添加在此id范围内所有签到记录
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		//dump($jsssdk_info);exit;
		if($id){
			$result = M('Qyfield_report')->where('id='.$id)->find();
			$this->assign('data',$result);
			$this->assign('id',$id);
			if(IS_POST){
				//签到时间
				$data['checktime'] = time();
				//签到照片
				$must = M('Qyfield_type')->where(array('user_id'=>$_SESSION['user_id']))->find();
				if($must['inphoto']==1){
					if($_POST['photo']){
						$data['img'] = $_POST['photo'];
					}else{
						$this->ajaxReturn(2);//没有拍照
					}
				}
				$data['desc'] = $_POST['desc'];
				$data['record_id'] =$id; 
				$data['place'] = $_POST['place'];
				$data['long'] = $localtion['Longitude'];
				$data['lat'] = $localtion['Latitude'];
				$data['user_id'] = $app['userid'];
				$result = M('Qyfield_sign')->add($data);
				
			}
		}else{
			$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
		}
		$this->display();
	}
	
}




?>