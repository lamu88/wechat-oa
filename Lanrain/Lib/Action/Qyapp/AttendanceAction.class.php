<?php
/**
 *微信考勤
 **/
class AttendanceAction extends Action{
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
	 *考勤设置
	 **/
	public function index(){
        $this->check();
		if(IS_POST){
			$data=$_POST;
			$data['user_id']=$_SESSION['user_id'];
			$data['startdate']=strtotime(date('Ym'.$_POST['startdate']));
			if($_POST['end_type']==1){
				$data['end']=strtotime(date('Ym'.$_POST['end_time']));
			}else{
				$data['end']=strtotime(date('Y'.date('m',strtotime('+1 month')).$_POST['end_time']));
			}
			$data['mor_o_type'] = isset($_POST['mor_o_type']) ? $_POST['mor_o_type'] : 0;			
			$data['mor_o_on'] = $_POST['mor_o_on'] == 'on' ? 1 : 0;
			$data['mor_o_time'] = $_POST['mor_o_timehour']*3600+$_POST['mor_o_timeminute']*60;
			$data['aft_o_on'] = $_POST['aft_o_on'] == 'on' ? 1 : 0;
			$data['aft_t_on'] = $_POST['aft_t_on'] == 'on' ? 1 : 0;
			$data['aft_o_time'] = $_POST['aft_o_timehour']*3600+$_POST['aft_o_timeminute']*60;
			$data['aft_o_time'] = $_POST['aft_t_timehour']*3600+$_POST['aft_t_timeminute']*60;
			$data['user_id']=$_SESSION['user_id'];
			$data['mor_o_content']=$_POST['mor_o_content'];	
			$data['aft_o_type'] = isset($_POST['aft_o_type']) ? $_POST['aft_o_type'] : 0;				
			$data['aft_o_content']=$_POST['aft_o_content'];				
			$data['time1']=$_POST['startdate'];
			$data['time2']=$_POST['end_time'];
			$data['time3']=$_POST['mor_o_timehour'];
			$data['time4']=$_POST['mor_o_timeminute'];
			$data['time5']=$_POST['aft_o_timehour'];
			$data['time6']=$_POST['aft_o_timeminute'];
			$data['time7']=$_POST['aft_t_timehour'];
			$data['time8']=$_POST['aft_t_timeminute'];
			//print_r($data);exit;
			$check=M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($check){
				if(M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->save($data)){
					$this->success('设置成功',U('Attendance/index',array('mid'=>$_GET['mid'])));
				}else{
					$this->error('设置失败');
				}
			}else{
				if(M('Qyattendance_conf')->add($data)){
					$this->success('设置成功',U('Attendance/index',array('mid'=>$_GET['mid'])));

				}else{
					$this->error('设置失败');
				}

			}
		}else{
			$data=M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			$conf = $data;	
			if(date('m',$data['time1']) != date('m',$data['time2'])){
			    $conf['end_type'] = 2;
			}else{
			    $conf['end_type'] = 1;
			}
			$conf['startdate'] = $data['time1'];	
			$conf['end_time'] = $data['time2'];				
			$conf['mor_o_timehour'] = $data['time3'];	
			$conf['mor_o_timeminute'] = $data['time4'];				
			$conf['aft_o_timehour'] = $data['time5'];	
			$conf['aft_o_timeminute'] = $data['time6'];				
			$conf['aft_t_timehour'] = $data['time7'];	
			$conf['aft_t_timeminute'] = $data['time8'];		
            $month = array();
            $day = array();
            $hour = array();
            $minute = array();	
            for($i=0;$i<60;$i++){
			    if($i<10){
				   $hour[$i]= '0'.$i; 
				}else{
				   $hour[$i]= $i;
				} 
			}	
            for($j=1;$j<32;$j++){
			    if($j<10){
				   $month[$j]= '0'.$j; 
				}else{
				   $month[$j]= $j;
				}				
			}	
            for($m=0;$m<24;$m++){
			    if($m<10){
				   $day[$m]= '0'.$m; 
				}else{
			        $day[$m]= $m;
				}				
			}				
			$this->assign('month',$month);
			$this->assign('day',$day);
			$this->assign('hour',$hour);
			$this->assign('months',$month);
			$this->assign('days',$day);
			$this->assign('hours',$hour);			
			$this->assign('conf',$conf);
			$check=M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			$this->display();
		}
	}

	/**
	 *考勤设置
	 **/
	public function conf(){
        $this->check();
		if(IS_POST){
			$data=$_POST;
			$data['user_id']=$_SESSION['user_id'];
			$data['startdate']=strtotime(date('Ym'.$_POST['startdate']));
			//
			if($_POST['end_type']==1){
				$data['end']=strtotime(date('Ym'.$_POST['end_time']));
			}else{
				$data['end']=strtotime(date('Y'.date('m',strtotime('+1 month')).$_POST['end_time']));
			}
			$data['mor_o_on'] = $_POST['mor_o_on'] == 'on' ? 1 : 0;
			$data['mor_o_time'] = $_POST['mor_o_timehour']*3600+$_POST['mor_o_timeminute']*60;
			$data['aft_o_on'] = $_POST['aft_o_on'] == 'on' ? 1 : 0;
			$data['aft_t_on'] = $_POST['aft_t_on'] == 'on' ? 1 : 0;
			$data['aft_o_time'] = $_POST['aft_o_timehour']*3600+$_POST['aft_o_timeminute']*60;
			$data['aft_o_time'] = $_POST['aft_t_timehour']*3600+$_POST['aft_t_timeminute']*60;
			$data['user_id']=$_SESSION['user_id'];
			$data['time1']=$_POST['startdate'];
			$data['time2']=$_POST['end_time'];
			$data['time3']=$_POST['mor_o_timehour'];
			$data['time4']=$_POST['mor_o_timeminute'];
			$data['time5']=$_POST['aft_o_timehour'];
			$data['time6']=$_POST['aft_o_timeminute'];
			$data['time7']=$_POST['aft_t_timehour'];
			$data['time8']=$_POST['aft_t_timeminute'];
			$check=M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($check){
				if(M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->save($data)){
					$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}
			}else{
				if(M('Qyattendance_conf')->add($data)){
					$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}

			}
		}else{
			$conf=M('Qyattendance_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			//dump($conf);
			$this->assign('conf',$conf);
			$this->display();
		}
	}

	public function addrule(){
        $this->check();		
		if(IS_POST){
			//print_r($_POST);exit;
			$data=$_POST;
			$data['user_id']=$_SESSION['user_id'];
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'].'-';
				//部门唯一性
				$map['depart']=array('like','%'.$wxid['wxid'].'-%');
				$map['user_id']=$_SESSION['user_id'];
				$ach=M('Qyattendance')->where($map)->find();
				if($ach){
					$a[$k]=$v;
				}
			}
			//dump($a);die();
			if($a){
				$this->error('新增规则时部门不能重复');
			}

			$data['depart']=implode("|",$wxarr);
			$data['week']=implode("|",$_POST['week']);
			$data['out_day']=implode("|",$_POST['out_day']);
			$data['retime']=$_POST['rest_o_houer']*3600+$_POST['rest_o_minute']*60;
			$data['retime_t']=$_POST['rest_t_houer']*3600+$_POST['rest_t_minute']*60;
			if(M('Qyattendance')->add($data)){
				$this->success('添加成功!',U('Attendance/rule',array('mid'=>$_GET['mid'])));
			}else{
				$this->success('添加失败!');
			}
		}else{
            //$info=M('Qyattendance')->where(array('id'=>$_GET['id'],'user_id'=>$_SESSION['user_id']))->find();
			$day = array();
            for($m=0;$m<24;$m++){
			    if($m<10){
				   $day[$m]= '0'.$m; 
				}else{
			        $day[$m]= $m;
				}				
			}				
			$this->assign('day',$day);	
			$hour = array();
            for($i=0;$i<60;$i++){
			    if($i<10){
				   $hour[$i]= '0'.$i; 
				}else{
			        $hour[$i]= $i;
				}				
			}				
			$this->assign('day1',$day);	
			$this->assign('day2',$day);
			$this->assign('day3',$day);		
			$this->assign('day4',$day);				
			$this->assign('hour1',$hour);	
			$this->assign('hour2',$hour);	
			$this->assign('hour3',$hour);		
			$this->assign('hour4',$hour);				
			$this->display();
		}
	}



	public function ruleedit(){
        $this->check();	
		if(IS_POST){
			$data=$_POST;
			$data['user_id']=$_SESSION['user_id'];
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v,'user_id'=>$_SESSION['user_id']))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'].'-';
				//部门唯一性
				$map['depart']=array('like','%'.$wxid['wxid'].'-%');
				$map['user_id']=$_SESSION['user_id'];
				$map['id']=array('neq',$_POST['id']);
				$ach=M('Qyattendance')->where($map)->find();
				if($ach){
					$a[$k]=$v;
				}
			}
			if($a){
				$this->error('编辑规则时部门不能重复');
			}
			$data['depart']=implode("|",$wxarr);
			$data['week']=implode("|",$_POST['week']);
			$data['out_day']=implode("|",$_POST['out_day']);			
			$data['retime']=$_POST['rest_o_houer']*3600+$_POST['rest_o_minute']*60;
			$data['retime_t']=$_POST['rest_t_houer']*3600+$_POST['rest_t_minute']*60;
			if(M('Qyattendance')->where(array('id'=>$_POST['id']))->save($data)){
				$this->success('编辑成功!');
			}else{
				$this->error('编辑失败!');
			}
		}else{
			$info=M('Qyattendance')->where(array('id'=>$_GET['id'],'user_id'=>$_SESSION['user_id']))->find();
			if($info['week']){
				$week = explode('|',$info['week']);
				$this->assign('week',$week);
			}
			if(!empty($info['out_day'])){
				$out_day = explode('|',$info['out_day']);
			}else{
				$out_day = array();
			}

			$depart=explode('-|',$info['depart'].'|');

			foreach($depart as $k=>$v){
				if($v){
					$de=M('Department')->where(array('user_id'=>$_SESSION['user_id'],'wxid'=>$v))->field('name,id')->find();
					$str_de.=$de['name'].';';
					$departid.=$de['id'].',';

				}
			}
			$min = array();
			for($i=0;$i<60;$i++){
			    array_push($min,$i);
			}
			$this->assign('rest_o_minute',$min);	
			$this->assign('work_t_minute',$min);	
			$this->assign('rest_t_minute',$min);	
			$this->assign('long_minute',$min);			
			$hour = array();
			for($i=0;$i<24;$i++){
			    array_push($hour,$i);
			}
			$this->assign('rest_o_houer',$hour);	
			$this->assign('work_t_houer',$hour);
			$this->assign('rest_t_houer',$hour);
			$this->assign('long_houer',$hour);			
			//print_r($m);exit;
			$this->assign('str_de',$str_de);
			$this->assign('departid',$departid);
			$count = count($out_day);
			$this->assign('count',$count);
			$this->assign('out_day',json_encode($out_day));
			$this->assign('info',$info);
			//print_r($info);exit;
			$this->display();
		}
	}

	/**
	 *考勤规则
	 **/
	public function rule(){
        $this->check();	
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		$count      = M('Qyattendance')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('Qyattendance')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($data  as $k=>$v){
			$datas[$k]=$v;
			$v['depart']=str_replace('-','',$v['depart']);
			$depart=explode('|', $v['depart']);
			$department='';
			foreach($depart as $kee=>$vaa){
				$departmen=M('Department')->where(array('wxid'=>$vaa,'user_id'=>$_SESSION['user_id']))->field('name')->find();
				$department.=$departmen['name'].'. ';
			}
			$datas[$k]['depart']=$department;
			$week=explode('|', $v['week']);
			
			$weeks='';
			foreach($week as $ke=>$va){
				if($va==7){
					$we="星期天";
				}
				if($va==1){
					$we="星期一";
				}
				if($va==2){
					$we="星期二";
				}
				if($va==3){
					$we="星期三";
				}
				if($va==4){
					$we="星期四";
				}
				if($va==5){	$we="星期五";}
				if($va==6){
					$we="星期六";
				}
				$weeks.=$we.'.';
			}
			$datas[$k]['weeks']=$weeks;
		}
		$show       = $Page->show();
		//print_r($datas);exit;
		$this->assign('data',$datas);
		$this->assign('page',$show);
		$this->display();
	}


	public function info(){
        $this->check();
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('Qyattendance')->where(array('id'=>$id,'user_id'=>$user_id))->find();
		$data['depart']=str_replace('-','',$data['depart']);
		$depart=explode('|', $data['depart']);
		foreach($depart as $k=>$v){
			$departmen=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
			$department.=$departmen['name'].'. ';
		}
		$week=explode('|', $data['week']);
		foreach($week as $ke=>$va){
			if($va==0){
				$we="星期天";
			}
			if($va==1){
				$we="星期一";
			}
			if($va==2){
				$we="星期二";
			}
			if($va==3){
				$we="星期三";
			}
			if($va==4){
				$we="星期四";
			}
			if($va==5){	$we="星期五";}
			if($va==6){
				$we="星期六";
			}
			$weeks.=$we.'.';
		}
		$this->assign('weeks',$weeks);
		$this->assign('department',$department);
		$this->assign('data',$data);
		$this->display();
	}

	public function del(){
        $this->check();	
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		if(IS_POST){
			$data = M('Qyattendance')->where(array('id'=>$_POST['id']))->find();
			if(M('Qyattendance')->where(array('id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}

		}
	}



	/**
	 *考勤地点
	 **/
	public function address(){
        $this->check();
		$count      = M('Qyattendance_place')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('Qyattendance_place')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}
	public function addadress(){
        $this->check();	
		if(IS_POST){
			$data['user_id']=$_SESSION['user_id'];
			$data['long']=trim($_POST['range']);
			$data['province']=$_POST['province3'];
			$data['city']=$_POST['city3'];
			$data['area']=$_POST['area3'];
			$data['address']=$_POST['address'];
			$data['place']=$_POST['place'];
			$data['latitude']=$_POST['lat'];
			$data['longitude']=$_POST['lng'];
			$id=M('Qyattendance_place')->add($data);
			if($id){
				$this->success('添加成功',U('Attendance/address',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('添加失败');
			}
		}else{
		    $res = M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			if(!$res['address']){
			    $res['address'] = '北京';
			    $res['longitude'] = '39.5441';
			    $res['latitude'] = '116.2250';				
			}	
            $this->assign('data',$res);			
	        $this->display();
		}

	}

	public function editadress(){
        $this->check();	
		if(IS_POST){
			//dump($_POST);die;
			$data['long']=$_POST['range'];
			$data['province']=$_POST['province3'];
			$data['city']=$_POST['city3'];
			$data['area']=$_POST['area3'];
			$data['address']=$_POST['address'];
			$data['place']=$_POST['place'];
			$data['latitude']=$_POST['lat'];
			$data['longitude']=$_POST['lng'];
			$id=M('Qyattendance_place')->where(array('id'=>$_GET['id'],'user_id'=>$_SESSION['user_id']))->save($data);
			if($id){
				$this->success('修改成功',U('Attendance/address',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('修改失败');
			}
		}else{
			$data=M('Qyattendance_place')->where(array('id'=>$_GET['id'],'user_id'=>$_SESSION['user_id']))->find();
			$this->assign('data',$data);
			$this->display();
		}

	}

	public function deladress(){
        $this->check();	
		if(IS_POST){
			$data = M('Qyattendance_place')->where(array('id'=>$_POST['id']))->find();
			if(M('Qyattendance_place')->where(array('id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}

		}
	}

	public function address_post(){
        $this->check();	
		$_POST['user_id']=$_SESSION['user_id'];
		$id=M('Qyattendance_place')->add($_POST);
		if($id){
			echo json_encode(array('status'=>0));
		}else{
			echo json_encode(array('status'=>1));
		}
	}

	/**
	 *考勤地点详情
	 **/
	public function addressInfo(){
        $this->check();		
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('Qyattendance_place')->where(array('id'=>$id,'user_id'=>$user_id))->find();
		$this->assign('data',$data);
		$this->display();
	}

	/**
	 *考勤统计
	 **/
	public function tongji(){
        $this->check();		
		    //print_r($_POST);exit;
			$user_id = $_SESSION['user_id'];			
			//部门搜索
			
			if($_POST['departname']){
				//$list = array();
				$result = array();
				$post = explode(';', $_POST['departname']);
				$this->assign('departname',$_POST['departname']);				
				$users = '';
				foreach($post as $k=>$v){
				    if($v){
					    $result = M('department')->where(array('name'=>$v,'user_id'=>$user_id))->field('wxid')->find();
						$ids = M('Qyusers')->where(array('user_id'=>$user_id,'pid'=>array('like','%'.$result['wxid'].';%')))->field('id')->select();
						//print_r($ids);exit;
						foreach($ids as $key=>$val){
						    $arr[] = $val['id'];
						}
						//array_column($ids, 'id');
						$temp = implode(',',$arr);
						$users .= $temp.',';
					}
                }
				$arr = trim($users,',');	
				$where['uid'] = array('in',$arr);
			}
			//名称搜索
			if($_POST['username']){
	 			if(strstr($_POST['username'],'(')){
					$where['name'] = substr($_POST['username'],0,strpos($_POST['username'],'('));				
				}else{
					$where['name']=$_POST['username'];					
				} 		
			}
			$where['user_id'] = $_SESSION['user_id'];
			$count      = M('Qyattendance_record')->where($where)->group('uid')->count();
			$Page       = new Page($count,12);
			$res = M('Qyattendance_record')->order('id desc')->where($where)->group('uid')->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();
			$data = array();
			foreach($res as $k=>$v){
			    $data[$k] = $v;
				$users = M('qyusers')->where(array('userid'=>$v['name'],'user_id'=>$user_id))->field('id,name,pid,position')->find();
				$data[$k]['name'] = $users['name'];
				$data[$k]['position'] = $users['position'];
				$arr = explode(';',$users['pid']);
				if($arr){
				    $str = '';
				    foreach($arr as $key=>$val){
					    if($val){
						    $dept = M('department')->where(array('wxid'=>$val,'user_id'=>$user_id))->field('id,name')->find();
							$str .= $dept['name'].';';
						}
					}
				}
				$data[$k]['departmnet'] = $str;
			}
			$this->assign('data',$data);
			$this->assign('page',$show);	
			$this->display();				
/*             $count      = M('Qyusers')->where($where)->count();
			$Page       = new Page($count,12);
			$res = M('Qyusers')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			$info = M('department')->where($where)->select();
			$department = array();
			foreach($info as $m=>$n){
			    $department[$n['wxid']] = $n;
			}
			$show       = $Page->show();	
            $data = array();				
            foreach($res as $k=>$v){
			    $data[$k] = $v;
				if($v['pid']){
				    
				    $arr = explode(';',$v['pid']);
					
					$arr = array_filter($arr);
					//dump($arr);
					if(is_array($arr) && count($arr)>0){
					    $i = 0;
						foreach($arr as $val){
                            $data[$k]['department'][$i]['name'] = $department[$val]['name'];
							$i++;
						}					
					}

				}
			} */				
			/* $this->assign('data',$data);
			$this->assign('page',$show);
			$this->display(); */		

	}	
	
	
	/**
	 *考勤统计
	 **/
	public function tongji1(){
        $this->check();		
		if(IS_POST){
		    //print_r($_POST);exit;
			$user_id = $_SESSION['user_id'];			
			//部门搜索
			if($_POST['departname']){
				//$list = array();
				$result = array();
				$post = explode(';', $_POST['departname']);
				$this->assign('departname',$_POST['departname']);				
				$users = '';
				//print_r($post);exit;
				foreach($post as $k=>$v){
				    if($v){
					    $result = M('department')->where(array('name'=>$v,'user_id'=>$user_id))->field('wxid')->find();
						$ids = M('Qyusers')->where(array('user_id'=>$user_id,'pid'=>array('like','%'.$result['wxid'].';%')))->field('id')->select();
						//print_r($ids);exit;
						foreach($ids as $key=>$val){
						    $arr[] = $val['id'];
						}
						//array_column($ids, 'id');
						$temp = implode(',',$arr);
						$users .= $temp.',';
					}
                }
				$arr = trim($users,',');
				$where['user_id'] = $_SESSION['user_id'];
				$where['uid'] = array('in',$arr);	
                //print_r($where);exit;				
				//M('Qyusers')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
				
				//foreach ($post as $v){
				//	if($v){
				//		$list[] = $v;
				//	}
				//}
				//foreach ($list as $va){
				//	$result[] = M('Department')->where(array('name'=>$va,'user_id'=>$user_id))->field('wxid')->find();
					
				//}
				//foreach ($result as $k=>$v){
				//	$where['pid'][]= array('like','%'.$result[$k]['wxid'].'%','or');
				//}
			}
			//名称搜索
			if($_POST['username']){
			
	 			if(strstr($_POST['username'],'(')){
					$where['name'] = substr($_POST['username'],0,strpos($_POST['username'],'('));				
				}else{
					$where['name']=$_POST['username'];					
				} 		
				//$this->assign('username',$_POST['username']);
			}
			$count      = M('Qyattendance_record')->where($where)->count();
			$Page       = new Page($count,12);
			$data = M('Qyattendance_record')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();
			$this->assign('data',$data);
			$this->assign('page',$show);	
			$this->display();				
		}else{
		
            $count      = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id']))->count();
			$Page       = new Page($count,12);
			$res = M('Qyusers')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
			$info = M('department')->where(array('user_id'=>$_SESSION['user_id']))->select();
			$department = array();
			foreach($info as $m=>$n){
			    $department[$n['wxid']] = $n;
			}
			//dump($department);exit;
			$show       = $Page->show();	
            $data = array();	
            //dump($res);exit;			
            foreach($res as $k=>$v){
			    $data[$k] = $v;
				if($v['pid']){
				    
				    $arr = explode(';',$v['pid']);
					
					$arr = array_filter($arr);
					//dump($arr);
					if(is_array($arr) && count($arr)>0){
					    $i = 0;
						foreach($arr as $val){
                            $data[$k]['department'][$i]['name'] = $department[$val]['name'];
							$i++;
						}					
					}

				}
			}	
            //dump($data);exit;			
/* 			$count      = M('Qyattendance_record')->where(array('user_id'=>$_SESSION['user_id']))->count();
			$Page       = new Page($count,12);
			$data = M('Qyattendance_record')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();
			$this->assign('data',$data);
			$this->assign('page',$show); */		
/* 		    $count      = M('Qyattendance_feel')->where(array('user_id'=>$_SESSION['user_id']))->count();
			$info=M('Qyattendance_feel')->where(array('user_id'=>$_SESSION['user_id']))->select();
			if($info){
				foreach($info as $key=>$val){
					$feel[$key] = $val;
				}
			}
			$arr = M('Qyusers')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach ($arr as $k=>$v){
				$arr[$k]['department'] = explode(';', $v['pid']);
				foreach ($arr[$k]['department'] as $valu){
					if($valu){
						$arr[$k]['department'][] = $valu;
					}
				}
				$term['user_id']=$_SESSION['user_id'];
				$term['wxid'] = array('like',$arr[$k]['department']);
				$arr[$k]['department'] = M('Department')->where($term)->select();
			} */
			//$this->assign('arr',$arr);			
			$this->assign('data',$data);
			$this->assign('page',$show);
			$this->display();		
		
		}

	}
	
	/**
	 *考勤统计详情
	 **/
	public function userinfo(){
        $this->check();		
		$id = $this->_GET('id');//得到员工id
		//echo $id;exit;
		$user_id = $_SESSION['user_id'];
		
		if($_POST){
			//按天查询
			if(!empty($_POST['searchday'])){
				$day=strtotime($_POST['searchday']);
				$beginthisday=mktime(0,0,0,date('m',$day),date('d',$day),date('Y',$day));
				$endthisday=mktime(23,59,59,date('m',$day),date('d',$day),date('Y',$day));
				$where['creatime']=array('between',array($beginthisday,$endthisday));
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
				$where['creatime']=array('between',array($beginThismonth,$endThismonth));
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
				$where['creatime']=array('between',array($begintime,$endtime));
				$this->assign('searchmoment',$_POST['searchmoment']);
			}
		
		}
		$where['uid'] = $id;
		$where['user_id'] = $_SESSION['user_id'];
		$count = M('Qyattendance_record')->where($where)->count();
		
		$Page       = new Page($count,15);
		$show       = $Page->show();
		$data=M('Qyattendance_record')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//dump($data);exit;
		$arr = array();
		$result = array();
		$list = array();
		$late = array();
		$early = array();
		foreach($data as $key=>$data){
			if($data['creatime'] != '' && $data['outtime'] != ''){
				$worktime = $data['outtime']-$data['creatime'];
				$data['aaa'] = $worktime;
				//print_r($data);exit;
				if($worktime<3600){
					$h = 0;
					if($worktime<60){
						$i = 1;
					}else{
						$i = floor($worktime/60);
					}
				}else{
					$h = floor($worktime/3600);
					$i = floor(($worktime%3600)/60);
				}
				if(0<=$h && $h<10){
					$h = '0'.$h;
				}
				if(0<=$i && $i<10){
					$i = '0'.$i;
				}
				$data['outtime'] = date('Y-m-d H:i:s',$data['outtime']);
				$data['creatime'] = date('Y-m-d H:i:s',$data['creatime']);
				$data['wtime'] = $h.'小时'.$i.'分钟';
			}else{
	
				if($data['outtime'] == ''){
					$data['outtime'] = '无考勤记录';
					$data['worktime'] = '--';
				}else{
					$data['outtime'] = date('Y-m-d H:i:s',$data['outtime']);
				}
				if($data['creatime'] == ''){
					$data['creatime'] = '无考勤记录';
					$data['worktime'] = '--';
				}else{
					$data['creatime'] = date('Y-m-d H:i:s',$data['creatime']);
				}
			}
			/* if($data['earlytime'] != 0 ){
			    //$data['earlytime'] = ceil($data['earlytime']/60);
			}
			if($data['latime'] != 0 ){
			    //$data['latime'] = floor($data['latime']/60);
			} */
			
			$place=M('Qyattendance_place')->where(array('id'=>$data['place_id']))->field('address')->find();//签到地点
			$data['place']=$place['address'];
			$arr[] = $data; //总输出
			$late[] = $data['latime'];//迟到时间
			$early[] = $data['earlytime'];//早退时间
			$result[] = $data['creatime'];//签到时间
			$list[] = $data['outtime'];//签退时间
		}
        //dump($arr);exit;
		//计算总签到天数
		$Ctime = 0;
		foreach ($result as $k=>$v){
			if($v !='无考勤记录' && $v!=''){
				$Ctime = $Ctime+1;
			}
	
		}
		//计算总签退天数
		$Otime = 0;
		foreach ($list as $k=>$v){
			if($v !='无考勤记录' && $v!=''){
				$Otime = $Otime+1;
			}
		}
		//计算迟到时间
		$latetime = 0;
		foreach ($late as $k=>$v){
			if($v !=''){
				$latetime += $v;
			}
		}
		$earlytime = 0;
		foreach ($early as $k=>$v){
			if($v !=''){
				$earlytime += $v;
			}
		}
		$user=M('Qyusers')->where(array('userid'=>$data['name'],'user_id'=>$_SESSION['user_id']))->find();
		//echo $user['name'];exit;
		//$arr['name'] = $user['name'];
		//dump($arr);exit;
		foreach($arr as $k=>$v){
		    $arr[$k] = $v;
			$arr[$k]['name'] = $user['name'];
		}
		$depart=explode(';', $user['pid']);
		foreach($depart as $k=>$v){
				if($v){
					$departmen=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
					$department.=$departmen['name'].'&nbsp;&nbsp; ';
				}
		}
		//print_r($arr);
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('department',$department);
		$this->assign('later',ceil($data['latime']/60));
		$this->assign('early',ceil($data['earlytime']/60));
		$this->assign('ctime',$Ctime);
		$this->assign('otime',$Otime);
		$this->assign('latetime',ceil($latetime/60));
		$this->assign('earlytime',ceil($earlytime/60));
		$this->assign('arr',$arr);
		//dump($arr);exit;
		$this->display();
	}
	
	/**
	 * 考勤详情导出
	 */
	public function exportSN()
	{
		header("Content-Disposition:filename=kaoqing.xls");
		header("Content-Type: application/vnd.ms-execl"); 
        header("Content-Type: application/vnd.ms-excel; charset=gb2312");
		header("Pragma: no-cache"); 
        header("Expires: 0");
		//   以下\t代表横向跨越一格，\n 代表跳到下一行，可以根据自己的要求，增加相应的输出相，要和循环中的对应哈
		//字段
		$letterArr=explode(',',strtoupper('a,b,c,d,e,f,g,h'));
		$arr=array(
		    array('en'=>'name','cn'=>'姓名'),
		    array('en'=>'department','cn'=>'部门'),
		    array('en'=>'creatime','cn'=>'签到'),
		    array('en'=>'outtime','cn'=>'签退'),
		    array('en'=>'latime','cn'=>'早退'),
		    array('en'=>'earlytime','cn'=>'迟到'),  
		);
		$i=0;
		$fieldCount=count($arr);
		$s=0;
		//thead
		foreach ($arr as $f){
			if ($s<$fieldCount-1){
				echo iconv('utf-8','gbk//IGNORE',$f['cn']).iconv('utf-8','gbk//IGNORE',"\t");
			}else {
				echo iconv('utf-8','gbk//IGNORE',$f['cn']).iconv('utf-8','gbk//IGNORE',"\n");
			}
			$s++;
		}
		$id = $this->_GET('id');//得到员工id
		$user_id = $_SESSION['user_id'];
		$card_create_db =M('Qyattendance_record');	
		$members   = $card_create_db->where(array('uid'=>$id,'user_id'=>$user_id))->select();
		if(!$id){
			$members   = $card_create_db->where(array('user_id'=>$user_id))->order('uid')->select();
		}
		if ($members ){
			foreach ($members as $ke=>$v){	
				$user=M('Qyusers')->where(array('id'=>$v['uid'],'user_id'=>$_SESSION['user_id']))->find();
				$depart=explode(';', $user['pid']);
				$department = '';
				foreach($depart as $k=>$va){
					if($va){
						$departmen=M('Department')->where(array('wxid'=>$va,'user_id'=>$_SESSION['user_id']))->field('name')->find();
						$department.=$departmen['name'].'|';
					}
				}
				$j=0;
				foreach ($arr as $field){
					$fieldValue=$v[$field['en']];
					switch ($field['en']){
						default:
							break;
						case 'name':
							$fieldValue=iconv('utf-8','gbk//IGNORE',$user['name']);
							break;
						case 'department':
							$fieldValue=iconv('utf-8','gbk//IGNORE',$department);
							break;
						case 'creatime':
							if ($fieldValue){
								$fieldValue=date('Y-m-d H:i:s',$fieldValue);
							}else {
								$fieldValue=iconv('utf-8','gbk//IGNORE','无考勤记录');
							}
							break;
						case 'outtime':
							if ($fieldValue){
								$fieldValue=date('Y-m-d H:i:s',$fieldValue);	
							}else {
								$fieldValue=iconv('utf-8','gbk//IGNORE','无考勤记录');
							}
							break;
						case 'latime':
							if ($fieldValue){
								$fieldValue=$fieldValue.iconv('utf-8','gbk//IGNORE',"分钟");
							}else {
								$fieldValue=iconv('utf-8','gbk//IGNORE','无');
							}
							break;
						case 'earlytime':
							if ($fieldValue){
								$fieldValue=$fieldValue.iconv('utf-8','gbk//IGNORE',"分钟");	
							}else {
								$fieldValue=iconv('utf-8','gbk//IGNORE','无');
							}
							break;
					}
					if ($j<$fieldCount-1){
						echo $fieldValue.iconv('utf-8','gbk//IGNORE',"\t");
					}else {
						echo $fieldValue.iconv('utf-8','gbk//IGNORE',"\n");
					}
					$j++;
				}
				$i++;
				
			} 
		}
		exit();
	}
	
	
	
	
	
	
	

	public function record_del(){
        $this->check();	
        $this->check();	
		if(IS_POST){
			$data = M('Qyattendance_record')->where(array('id'=>$_POST['id']))->find();
			if(M('Qyattendance_record')->where(array('id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}

		}
	}

	/**wap**/
	public function wap_index(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		if($_COOKIE['wecha_id']){
			$_GET['wecha_id'] = str_replace('wy_','',cookie('wecha_id'));
		}
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Attendance','wap_index',$_GET);	
		} 		
		$conpany=M('Qyattendance_place')->where(array('user_id'=>$app['userid']))->find();
		$lat=$conpany['latitude'];
		$lng=$conpany['longitude'];
		$groud_meters=$conpany['long'];
		$this->assign('conpany',$conpany);
		//公司距离
		// $long=$this->getlong($lat,$lng,$localtion['Latitude'],$localtion['Longitude']);
		// if($long<=$groud_meters){
		// //echo "获取的位置在范围之内 可以签到";
		// $this->assign('type','获取的位置在范围之内 可以签到');
		// }else{
		// $this->assign('type','您不在签到范围距离之内无法签到');
		// }
		//获取签到规则
		//获取用户所在部门
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->find();
		$parr=explode(';',$userinfo['pid']);
		$map=array();
		$i=0;
		foreach($parr as $k=>$v){
			$map['depart']=array('like','%;'.$v.';%');
			$de=M('Qyattendance')->where($map)->find();
			if($de){
				$del[$i]=$de;
				$i++;
			}
		}
		//如果一个人在多个部门里面 而去那个部门在很多规则里面去 默认去第一条规则
		$conf=$del[0];
		//判断今日签到
		if($conf['work_type']==1){
			//标准工时


		}else{
			//弹性工作时间

		}
		//每日签到记录
		$record=M('Qyattendance_record')->where(array('uid'=>$userinfo['id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
		$this->assign('record',$record);
		//上次签到时间
		//$this->assign('last',$record[count($record)-1]);
		//获取表情
		$feel=M('Qyattendance_feel')->order('id desc')->select();
		$this->assign('list',$feel);

		$config=M('qyattendance_conf')->where(array('user_id'=>$app['userid']))->find();
		//dump($config);exit;
        		
        $this->assign('start',$config['time3']);
		$this->assign('end',$config['time5']);
		$time = M('qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'date'=>date(Ymd,time())))->find();
		//dump(array('name'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'date'=>date(Ymd)));exit;
		if($time['outtime']){
			$out['outtime'] = date('H:i',$time['outtime']);
			if($time['earlytime']){
				$on['latime'] = $time['earlytime'];
			}
			$this->assign('out',$out);
		}
		if($time['worktime']){
			$on['worktime'] = date('H:i',$time['worktime']);
			//$on['worktime'] = $time['worktime'];
			if($time['latime']){
				$out['eatime'] = $time['latime'];
			}
			$this->assign('eatime',$out['eatime']);
			$this->assign('on',$on);			
		}	
        $date['month'] = date('m');		
		$date['day'] = date('d');
		//dump($date);exit;
		$this->assign('date',$date);		
		$this->display();
	}
	 public function wap_shark(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		//dump($app);die;
		/* if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Attendance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			//dump($data['corpid']);die;
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_shark');
		} */
	
		if(!$_GET['wecha_id']){	
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Attendance','wap_shark',$_GET);	
		} 
			
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		
		//$Jsssdk=A('Qyapp/Jsssdk');
		//$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		//$this->assign('jsssdk_info',$jsssdk_info);
		//dump($jsssdk_info);exit;
		$this->display();	 
	 }
	//签退index
	public function wap_out(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Attendance','wap_out',$_GET);	
		} 
		$localtion=S('local_'.$_GET['wecha_id']);
		//默认获取用户最后一个部门
		$conpanys=M('Qyattendance_place')->where(array('user_id'=>$app['userid']))->select();
		foreach($conpanys as $k=>$v){
			if(S('user'.$_GET['wecha_id'])){
				$user=S('user'.$_GET['wecha_id']);
			}else{
				$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
				S('user'.$_GET['wecha_id'],$user,7200);
			}
			$lat=$v['latitude'];
			$lng=$v['longitude'];
			$groud_meters=$v['long'];
			$long=$this->getlong($lat,$lng,$localtion['Latitude'],$localtion['Longitude']);
			$juli=$long-$groud_meters;
			if($juli<=0){
				$jl[$k]=$long;
			}
		}
		$this->assign('jl',$jl);
		//获取用户所在部门
		$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->find();
		$parr=explode(';',$userinfo['pid']);
		$map=array();
		$i=0;
		foreach($parr as $k=>$v){
			$map['depart']=array('like','%|'.$v.'|%');
			$de=M('Qyattendance')->where($map)->find();
			if($de){
				$del[$i]=$de;
				$i++;
			}
		}
		//如果一个人在多个部门里面 而去那个部门在很多规则里面去 默认去第一条规则
		$conf=$del[0];
		//判断今日签退
		if($conf['work_type']==1){
			//标准工时
		}else{
			//弹性工作时间
		}
		//每日签退记录
		$record=M('Qyattendance_record')->where(array('uid'=>$userinfo['id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
		//dump($record);
		$this->assign('record',$record);
		//获取表情
		$feel=M('Qyattendance_feel')->order('id desc')->select();
		$this->assign('list',$feel);
		$this->display();
	}
	public function wap_recordsajax(){
		if(IS_POST){
			if(strlen($_POST['day'])==1) {
				$_POST['day']='0'.$_POST['day'];
			}
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$date=$_POST['m'].$_POST['day'];
			$date=str_replace('年','',$date);
			$date=str_replace('月','',$date);
			// $todaystart=strtotime($date);
			// $todaystop=strtotime(date($date,strtotime('+1 day')));
			$map['date']=$date;
			$map['name']=$_POST['wecha_id'];
			$map['user_id']=$app['userid'];
			$info=M('Qyattendance_record')->where($map)->find();
			if($info){
				$dat['times']=1;
				if($info['outtime']) $dat['outtime']=1;
				else $dat['outtime']=0;
				$Begin=date('Y-m-01', strtotime(date("Y-m-d")));
				$BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
				$stop=strtotime("$BeginDate +1 month -1 day");
				$maps['wecha_id']=$_POST['wecha_id'];
				$maps['user_id']=$app['userid'];
				$maps['creatime']=array(between,array(strtotime($Begin),$stop));
				$dat['count']=M('Qyattendance_record')->where($maps)->count();;
				$dat['worktime']=$this->sec2time($info['outtime']-$info['creatime']);
				if($dat['worktime']<0){
					$dat['worktime']=0;

				}
				$dat['creatmind']=M('Qyattendance_feel')->where(array('id'=>$info['creatmind']))->field('title')->find();
				$dat['outmind']=M('Qyattendance_feel')->where(array('id'=>$info['outmind']))->field('title')->find();
					
				echo json_encode(array('status'=>1,'info'=>$dat));
			}else{
				echo json_encode(array('status'=>2,'info'=>$info));
			}
		}
	}

	function sec2time($sec){
		$sec = round($sec/60);
		if ($sec >= 60){
			$hour = floor($sec/60);
			$min = $sec%60;
			$res = $hour.' 小时 ';
			$min != 0  &&  $res .= $min.' 分';
		}else{
			$res = $sec.' 分钟';
		}
		return $res;
	}

	public function wap_records(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		if(!$_GET['wecha_id']){
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Attendance','wap_records',$_GET);	
		}

        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
		$endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
		$Curtime = time();
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$res = M('qyattendance')->where(array('user_id'=>$app['userid']))->find();
		$today = date('Y-m-d',$beginToday);
	    $today = $today.' '.$res['w_stop'];
		if(strtotime($today) > time()){
		    $workday = floor(($Curtime-$beginThismonth)/86400);
		}else{
		    $workday = ceil(($Curtime-$beginThismonth)/86400);
		}
		
		$this->assign('workday',$workday);
        //签到
		$map['name']=$_GET['wecha_id'];
		$map['user_id']=$app['userid'];
		$map['creatime']=array(between,array($beginThismonth,$endThismonth));
		$oncount=M('Qyattendance_record')->where($map)->count();
        //签退
		$where['name']=$_GET['wecha_id'];
		$where['user_id']=$app['userid'];
		$where['outtime']=array(between,array($beginThismonth,$endThismonth));
		$outcount=M('Qyattendance_record')->where($where)->count();
		$this->assign('oncount',$oncount);		
		$this->assign('outcount',$outcount);
		$arr['user_id'] = $app['userid'];
		//$arr['name'] = $_GET['wecha_id'];
		$arr['creatime']=array(between,array($beginThismonth,$endThismonth));
		$lists=M('Qyattendance_record')->where($arr)->field('creatime,worktime,outtime')->select();
		$this->assign('lists',$lists);
		$this->display();		
		//echo $workday;
		//$Begin=date('Y-m-01', strtotime(date("Y-m-d")));
		
		//$BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
		
		//$stop=strtotime("$BeginDate +1 month -1 day");
		
		//$map['wecha_id']=$_GET['wecha_id'];
		//$map['user_id']=$app['userid'];
		//$map['creatime']=array(between,array($Begin,$stop));
		//$count=M('Qyattendance_record')->where($map)->count();
		//dump($beginThismonth);
		//dump($map);
		//dump($count);die;
		//$this->assign('count',$count);
		//$mp['outtime']=array(between,array(strtotime($Begin),$stop));
		//$mp['wecha_id']=$_POST['wecha_id'];
		//$mp['user_id']=$app['userid'];
		//$tui=M('Qyattendance_record')->where($mp)->count();
		//$this->assign('count',$count);
		//$this->assign('tui',$tui);
		//$this->display();

	}


	public function wap_month(){

		$this->display();
	}
	
	//提交签到
	public function wap_updata(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		if(IS_POST){
			//$localtion=S('local_'.$_GET['wecha_id']);
			//F('localtion',$localtion);
			//默认获取用户最后一个部门
			$conpanys=M('Qyattendance_place')->where(array('user_id'=>$app['userid']))->select();
			foreach($conpanys as $k=>$v){
				if(S('user'.$_GET['wecha_id'])){
					$user=S('user'.$_GET['wecha_id']);
				}else{
					$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
					S('user'.$_GET['wecha_id'],$user,7200);
				}
				$lat=number_format($v['latitude'],6);
				$lng= number_format($v['longitude'],6);
				$Latitude = $_POST['Latitude']-0.002495;
				$Longitude = $_POST['Longitude']+0.005343;
				F('321',$Longitude);
					//$Latitude = $_POST['Latitude'];
					//$Longitude =$_POST['Longitude'],4);
					//F('dizhi',$_POST);
					//F('dizhi12',$_POST);
					//$point = file_get_contents("http://api.map.baidu.com/geoconv/v1/?coords=".$Longitude.",".$Latitude."&ak=N3hQDiGAaGbcImqYo2p8QC9N");
					//$array = json_decode($point,true);
					//$Longitude = $array['result'][0]['x'];
					//$Latitude = $array['result'][0]['y'];
					//$Longitude = ;
					//$Latitude = ;
					//number_format($Latitude,6); 
				//F('$lat',$lng.$lat);
				//F('$Latitude',$Latitude.$Longitude);
				$groud_meters=$v['long'];
				//F('$Longitude1',$Longitude);
				
				$long=$this->getlong($lng,$lat,$Latitude,$Longitude);
				//F('$long',$long);
				//F('$groud_meters',$groud_meters);
				$juli=$long-$groud_meters-400;
				//F('juliw',$juli);
				if($juli<=0){
					$jl[$k]=$long;
					$place=$v['id'];
				}
			}
			if($jl){
				//判断该签到的时间点
				//获取用户所在部门
				if(S('user'.$_GET['wecha_id'])){
					$user=S('user'.$_GET['wecha_id']);
				}else{
					$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
					S('user'.$_GET['wecha_id'],$user,7200);
				}
				if(!$user){
					$Member=A('Qyapp/Member');
					$meinfo=json_decode($Member->memberInfo_get($_GET['wecha_id'],$app['userid']),true);
					$infos=array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid'],
				'name'=>$meinfo['name'],'pic'=>$meinfo['avatar'],'mobile'=>$meinfo['mobile'],'email'=>$meinfo['email'],'pid'=>serialize($meinfo['department']));
				}
				$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->find();
				$parr=explode(';',$userinfo['pid']);
				$map=array();
				$i=0;
				foreach($parr as $k=>$v){
					$map['depart']=array('like','%'.$v.'-%');
					$map['user_id']=$app['userid'];
					$de=M('Qyattendance')->where($map)->find();
					if($de){
						$del[$i]=$de;
						$i++;
					}
				}
				//如果一个人在多个部门里面 而去那个部门在很多规则里面去 默认去第一条规则
				$conf=$del[0];
				//每日签到记录
				$record=M('Qyattendance_record')->where(array('uid'=>$userinfo['id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->count();
				// $checkdate=M('Qyattendance_record')->where(array('uid'=>$userinfo['id'],'date'=>date('Ymd')))->find();
				// if($checkdate){
				// //$this->redirect('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));//已经签到
				if($conf['work_type']==1){
					$zero = strtotime(date('Ymd'));
					//上班时间
					//$on=strtotime(date('Ymd').' '.$conf['time3']);
					$on=strtotime(date('Ymd').' '.$conf['w_start']);
					//下班时间
					//$off=strtotime(date('Ymd').' '.$conf['time5']);
					$off=strtotime(date('Ymd').' '.$conf['w_stop']);
					//当前时间
					//F('on',$on);F('off',$off);
					$now = time();
					if($now < $on && $now>$zero){
						$onwork = time();
						$res1=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
						if(!$res1){
							$re_id=M('Qyattendance_record')->add(array(
								'name'=>$_GET['wecha_id'],
								'uid'=>$userinfo['id'],
								'creatime'=>time(),
								'creatmind'=>'开心',
								'status'=>1,
								'date'=>date('Ymd'),
								'conf_id'=>$conf['id'],
								'place_id'=>$place,
								'conf_type'=>1,//标准工时
								'user_id'=>$app['userid'],
								'worktime'=>$onwork
							));
							if($re_id){
								echo json_encode(array('status'=>1));
								exit();						    
							}else{
								echo json_encode(array('status'=>0));
								exit();						
							}						
						}else{
							echo json_encode(array('status'=>5));
							exit();							
						}
                    }elseif($now > $off && $now<($zero+86400)){
						$offwork = $now;
						$res2=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
						if(!$res2){
							$re_id=M('Qyattendance_record')->add(array(
								'name'=>$_GET['wecha_id'],
								'uid'=>$userinfo['id'],
								'creatime'=>time(),
								'creatmind'=>'开心',
								'status'=>1,
								'date'=>date('Ymd'),
								'conf_id'=>$conf['id'],
								'place_id'=>$place,
								'conf_type'=>1,//标准工时
								'user_id'=>$app['userid'],
								'outtime'=>$offwork
							));
							if($re_id){
								$qiantui = date('H:i',$offwork);
								//F('eewer',array('status'=>5,'qiantui'=>$qiantui));
								echo json_encode(array('status'=>5,'qiantui'=>$qiantui));
								exit();						    
							}else{
								echo json_encode(array('status'=>4));
								exit();						
							}						
						}else{
							$arr=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->save(array('outtime'=>$offwork));
							$qiantui = date('H:i',$offwork);
							echo json_encode(array('status'=>5,'qiantui'=>$qiantui));
							exit();																				
						}
                    }else{
/* 						$res3=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
						if($res3){
							if($res3['worktime']){
								echo json_encode(array('status'=>6));
								exit();									
							}elseif($res3['outtime']){
								echo json_encode(array('status'=>6));
								exit();
							}else{
								
							}
						}else{ */
						    $res3=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();							
							
							if(($now - $on)< 3600){
								/*if($res3['worktime']){
									//$chidao = floor(($res3['worktime'] - $on)/60);
									echo json_encode(array('status'=>2,'chidao'=>$res3['earlytime']));
									exit();									
								}else{*/
									$chidao = floor(($now - $on)/60);
									if($res3){
										 $res32=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->save(array('earlytime'=>$chidao,'worktime'=>$res3['creatime'],));
										echo json_encode(array('status'=>2,'chidao'=>$chidao));
										exit();	
									}else{
										$re_id=M('Qyattendance_record')->add(array(
											'name'=>$_GET['wecha_id'],
											'uid'=>$userinfo['id'],
											'creatime'=>$now,
											'creatmind'=>'开心',
											'status'=>1,
											'date'=>date('Ymd'),
											'conf_id'=>$conf['id'],
											'place_id'=>$place,
											'conf_type'=>1,//标准工时
											'user_id'=>$app['userid'],
											'worktime'=>$res3['creatime'],
											'earlytime'=>$chidao,									
										));
										
										if($re_id){
											echo json_encode(array('status'=>2,'chidao'=>$chidao));
											exit();						    
										}else{
											echo json_encode(array('status'=>8));
											exit();						
										}	
									}									
								//}
							
								//$chidao = floor(($now - $on)/60);
                                //echo json_encode(array('status'=>2,'chidao'=>$chidao));
								//exit();								
							}elseif(($off-$now > 0)){
								//4',$res3['outtime']);
								/*if($res3['outtime']){
									echo json_encode(array('status'=>3,'zaotui'=>$res3['latime']));
									exit();										
								}else{*/
									$zaotui = floor(($off - $now)/60);
									if($res3){
										 $res32=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->save(array('latime'=>$zaotui,'outtime'=>$now));
										echo json_encode(array('status'=>3,'zaotui'=>$zaotui));
										exit();	
									}else{
										$re_id=M('Qyattendance_record')->add(array(
											'name'=>$_GET['wecha_id'],
											'uid'=>$userinfo['id'],
											'creatime'=>'',
											'creatmind'=>'开心',
											'status'=>1,
											'date'=>date('Ymd'),
											'conf_id'=>$conf['id'],
											'place_id'=>$place,
											'conf_type'=>1,//标准工时
											'user_id'=>$app['userid'],
											'outtime'=>$now,
											'latime'=>$zaotui,									
										));
										if($re_id){
											echo json_encode(array('status'=>3,'zaotui'=>$zaotui));
											exit();						    
										}else{
											echo json_encode(array('status'=>8));
											exit();						
										}	
									}
								//}
								
							}else{
								F('2',2);
								echo json_encode(array('status'=>8));
								exit();									
							}
						//}
						
					}						
					//标准工时 签到
/* 					$morning=strtotime(date('Ymd').' '.$conf['w_start']);
					$outtime=time()-$morning;
					if($outtime<0) $outtime=0;
					else $outtime=time()-$morning;
					$checktime=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
					if(!$checktime){
						$re_id=M('Qyattendance_record')->add(array(
							'name'=>$_GET['wecha_id'],
							'uid'=>$userinfo['id'],
							'creatime'=>time(),
							'creatmind'=>'开心',
							'status'=>1,
							'date'=>date('Ymd'),
							'conf_id'=>$conf['id'],
							'place_id'=>$place,
							'conf_type'=>1,//标准工时
							'user_id'=>$app['userid'],
							'latime'=>$outtime
						));
						if($re_id){
							echo json_encode(array('status'=>1));
							exit();						    
						}else{
							echo json_encode(array('status'=>2));
							exit();						
						} */	
					}elseif($conf['work_type']==2){
						$res3=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();	
                        if($res3['worktime']){
							$re_id=M('Qyattendance_record')->add(array(
								'name'=>$_GET['wecha_id'],
								'uid'=>$userinfo['id'],
								'creatime'=>time(),
								'creatmind'=>'开心',
								'status'=>1,
								'date'=>date('Ymd'),
								'conf_id'=>$conf['id'],
								'place_id'=>$place,
								'conf_type'=>1,//标准工时
								'user_id'=>$app['userid'],
								'outtime'=>$now
							));
							if($re_id){
								$shichang = $now - $res3['worktime'];
								echo json_encode(array('status'=>1,'shichang'=>$shichang));
								exit();						    
							}else{
								echo json_encode(array('status'=>0));
								exit();						
							}							
						}else{
							$re_id=M('Qyattendance_record')->add(array(
								'name'=>$_GET['wecha_id'],
								'uid'=>$userinfo['id'],
								'creatime'=>time(),
								'creatmind'=>'开心',
								'status'=>1,
								'date'=>date('Ymd'),
								'conf_id'=>$conf['id'],
								'place_id'=>$place,
								'conf_type'=>1,//标准工时
								'user_id'=>$app['userid'],
								'outtime'=>$now
							));
							if($re_id){
								//$shichang = $now - $res3['worktime'];
								echo json_encode(array('status'=>1));
								exit();						    
							}else{
								echo json_encode(array('status'=>0));
								exit();						
							}						
						}						
						//echo json_encode(array('status'=>1));
						//exit();					
					}else{
						echo json_encode(array('status'=>8));
						exit();							
					}			
				}else{
					//$checktime=M('Qyattendance_record')->where(array('name'=>$_GET['wecha_id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->find();
					echo json_encode(array('status'=>7));//签到地址不在指定范围内!
					exit();					
				}
				//echo json_encode(array('status'=>1));
				//exit();
			}else{
				echo json_encode(array('status'=>0));//签到失败
				exit();
			}			
		}		
		
	//}

	//提交签退
	public function wap_get_out(){
		//标准工时 签退
		//签退下午
		if($_POST){
			if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
			$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->find();
			$parr=explode(';',$userinfo['pid']);
			$map=array();
			$i=0;
			foreach($parr as $k=>$v){
				$map['depart']=array('like','%'.$v.'-%');
				$map['user_id']=$app['userid'];
				$de=M('Qyattendance')->where($map)->find();
				if($de){
					$del[$i]=$de;
					$i++;
				}
			}
			
			//如果一个人在多个部门里面 而去那个部门在很多规则里面去 默认去第一条规则
			$conf=$del[0];
			$w_stop=strtotime(date('Ymd').' '.$conf['w_stop']);
			$w_start=strtotime(date('Ymd').' '.$conf['w_start']);
			$earlytime=time()-$w_stop;
			//if($earlytime>0) $outtime=0;
			if($earlytime>0) $earlytime=0;
			else $earlytime=$w_stop-time();
			$re_id=M('Qyattendance_record')->where(array('uid'=>$userinfo['id'],'date'=>date('Ymd'),'user_id'=>$app['userid']))->save(array(
		'outtime'=>time(),
		'date'=>date('Ymd'),
		'worktime'=>time()-$checkdate['creatime'],
		'earlytime'=>$earlytime
			));
			$time=time();
			if($re_id){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>2));

			}
		}
	}

	//计算距离
	function getlong($latitude1, $longitude1, $latitude2, $longitude2) {
		$theta = $longitude1 - $longitude2;
		$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		$miles = acos($miles);
		$miles = rad2deg($miles);
		$miles = $miles * 60 * 1.1515;
		$kilometers = $miles * 1.609344;
		$meters = $kilometers * 1000;
		//F('meters',$meters);
		return $meters;
	}
	
function getlong2($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2) 
{ 
$radLat1 = $lat1 * PI / 180.0; 
$radLat2 = $lat2 * PI / 180.0; 
$a = $radLat1 - $radLat2; 
$b = ($lng1 * PI / 180.0) - ($lng2 * PI / 180.0); 
$s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2))); 
$s = $s * EARTH_RADIUS; 
$s = round($s * 1000); 
if ($len_type > 1) 
{ 
$s /= 1000; 
} 
return round($s, $decimal); 

}	

}