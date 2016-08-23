<?php
/**
 *微信绩效
  开发者：麦伟良
 **/
class PerformanceAction extends Action{
	public $logo;	
	public $copyright;
	function _initialize(){
			$HTTP_HOST = $_SERVER['HTTP_HOST'];
			
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
		$user_id = $_SESSION['user_id'];
		if(IS_POST){
			$data['users_id'] =$_POST['userid'];
			$data['leader'] =$_POST['leader'];
			$per = $_POST['performanceusers'];
			$performanceusers = explode(',',$per);
			// $performanceuserss= json_decode($per);
			// $sada = explode(',',"188,189,190");
			if($performanceusers){
				
				$this->ajaxReturn($per);
			}
			foreach($per as $val){
			//$this->ajaxReturn($val);
				$data['contextual_id'] = $val; 
				$selectdata = M('Qycontextual_performance')->where($data)->select();
				if($selectdata){
					$users = M('Qyusers')->where('id='.$val)->field('id,name')->find();
					$this->ajaxReturn($users['name'],'已经关联'.$users['name'].'了!',3);
					// $this->ajaxReturn($users['name']);
					// $this->error('已经关联'.$users['name'].'了!');
				}else{
					$result[] = M('Qycontextual_performance')->add($data);
				}
			}
			//判断添加是够成功
			$performanceuserslenght = count($per);
			$resultlenght = count($result);
			if($resultlenght =$performanceuserslenght){
				// $this->success('设置成功');
				$this->ajaxReturn(2,"添加成功",1);
			}else{
				$this->ajaxReturn(1,"添加失败",2);
			}
		
		}else{
			$where['user_id'] = $user_id;
			$users = M('Qyusers')->where($where)->field('id,name')->select();
			$this->assign('users',$users);

		}
		
		$this->display();
	}
	//员工列表
	public function usersInfo4(){
		$users_id = $_SESSION['user_id'];
		if($_GET['id'] && $_GET['leader']){
			$usersid = $_GET['id'];
			$leaderid = $_GET['leader'];
			$one = strstr($_GET['id'],'(');
			if($one){
				$lenght = strpos($_GET['id'],$one);
				$usersid = substr($_GET['id'],0,$lenght);
			}
			$two = strstr($_GET['leader'],'(');
			if($two){
				$lenghts = strpos($_GET['leader'],$two);
				$leaderid = substr($_GET['leader'],0,$lenghts);
			}

		
			$userid = M('Qyusers')->where(array('userid'=>$usersid,'user_id'=>$users_id))->field('id,name')->find();
			
			$leader = M('Qyusers')->where(array('user_id'=>$users_id,'userid'=>$leaderid))->field('id,name')->find();
			 // print_r($leaderid);
			 // print_r($leader);exit;
			$this->assign('userid',$userid);
			$this->assign('leader',$leader);
			
		}
		$user_id = $_SESSION['user_id'];
		$where['user_id'] = $user_id;
		$users = M('Qyusers')->where($where)->field('id,name')->select();
		// dump($users);exit;
		$this->assign('users',$users);
		$this->display();
	}
	//工资设置
	public function conf(){
		//查找员工表
		$users_id = $_SESSION['user_id'];
		$resultarr = M('Qyusers')->where('user_id='.$users_id)->field('id,name')->select();
		$this->assign('resultarr',$resultarr);
		// print_r($resultarr);exit;
		if(IS_POST){
			$data = $_POST;
			foreach($data as $key=>$val){
				if($key != "users_id" && $key != "__hash__"){
					$total=$total+$val;
				}
			}
			$data['total'] = $total;
			$data['users_id'] = $_POST['users_id'];
			if(!$data['post_wage']){
				$this->error('岗位工资不能为空噢！');
				exit;
			}
			// var_dump($_POST['users_id']);exit;
			$data['firm_id'] = $_SESSION['user_id'];
			$dataarr = M('Qywage')->where(array('users_id'=>$data['users_id']))->find();
			// var_dump($dataarr);exit;
			if($dataarr==null){//判断是否已存在数据
			//不存在数据 添加
				$data['add_time'] = date('Y-m-d');
				$dataadd = M('Qywage')->add($data);
			
				if($dataadd){
					$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}
				
			}else{
				//存在数据修改
				$data['update_time'] = date('Y-m-d');
				$dataupdate = M('Qywage')->where(array('firm_id'=>$_SESSION['user_id']))->save($data);
				if($dataupdate){
					$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}	
			}
		}
		
		$this->display();
		
	}
	//查看薪酬
	public function usersInfo1(){
		$users_id = $_SESSION['user_id'];
		$usersid = $_GET['id'];
		$one = strstr($_GET['id'],'(');
		if($one){
			$lenght = strpos($_GET['id'],$one);
			$usersid = substr($_GET['id'],0,$lenght);
		}
		// echo $id;exit;
		$userid = M('Qyusers')->where(array('userid'=>$usersid,'user_id'=>$users_id))->field('id,name')->find();
		$where['users_id'] = $userid['id'];
		$wagearr = M('Qywage')->where($where)->find();
		// print_r($userid);exit;
		$this->assign('info',$wagearr);
		$this->assign('users_id',$userid);
		$this->display();
	
	}
		//评分标准
	public function usersInfo2(){
		// echo $_GET['id'];exit;
		$normmysql = M('Qynorm');
		$normarr = $normmysql->select();
		// dump($normarr);
		$this->assign('normdata',$normarr);
		$this->display();
	
	}

		//计分 项目清单
	public function usersInfo3(){
		$user_id = $_SESSION['user_id'];
		if(IS_POST){
			$data['name'] =$_POST['name'];
			$where['id'] =$_POST['id'];
			$score_projectdata = M('Qyscore_project')->where($where)->save($data);
			if($score_projectdata){
				$this->ajaxReturn(1);
			}
			//修改分值
			if($_POST['scoreid']){
					$data['score'] =$_POST['score'];
					$where['id'] =$_POST['id'];
					$score_projectdata = M('Qyscore_project')->where($where)->save($data);
					if($score_projectdata){
						$this->ajaxReturn(1);
					}else{
						$this->ajaxReturn(3);
					}
			}
			//删除数据
			if($_POST['deldata']){
					$delid = $_POST['deldata'];
		
									$datanamefind = M('Qyscore_project')->where(array('pid'=>$delid))->find();
									if($datanamefind){
										$this->ajaxReturn(4);
									}else{
								
										//不存在数据直接删除
										$datadel = M('Qyscore_project')->where(array('id'=>$delid))->delete();
									}
	
					
					if($datadel){
						$this->ajaxReturn(5);
					}
			
			}
		}
	
		$score_projectdata = M('Qyscore_project')->where(array('user_id'=>$user_id))->select();
		$this->assign('score_projectdata',$score_projectdata);	
		$this->display();
	}
	public function kpiinfo(){
		
		$score_projectdata = M('Qyscore_project')->where(array('pid'=>$_GET['id'],''))->select();
		$this->assign('score_projectdata',$score_projectdata);	
		// print_r($score_projectdata);
		$this->display();
	}
	//评分标准
	public function norm(){
		
		$normmysql = M('Qynorm');
		$normarr = $normmysql->select();
		// print_r($normarr);exit;
		$this->assign('normdata',$normarr);
		$this->display();
	
	}
	//设置绩效关联
	public function performance(){
		$user_id = $_SESSION['user_id'];
		if(IS_POST){
			
			$data['users_id'] =$_POST['username'];
			$data['leader'] =$_POST['leader'];
			$performanceusers = $_POST['performanceusers'];
			foreach($performanceusers as $val){
			
				$data['contextual_id'] = $val; 
				$selectdata = M('Qycontextual_performance')->where($data)->select();
				if($selectdata){
					$users = M('Qyusers')->where('id='.$val)->field('id,name')->find();
					// print_r($users['name']);
					$this->error('已经关联'.$users['name'].'了!');
				}else{
				$result[] = M('Qycontextual_performance')->add($data);
				}// print_r($data);
			}
			//判断添加是够成功
			$performanceuserslenght = count($performanceusers);
			$resultlenght = count($result);
			if($resultlenght =$performanceuserslenght){
				$this->success('设置成功');
			}else{
				$this->error('设置失败');
			}
			
		}else{
			$userid = "xiuying";
			$usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工id
			// print_r($usersid['id']);
			$where['user_id'] = $user_id;
			// $where['id'] =array('neq',$usersid['id']);
			$users = M('Qyusers')->where($where)->field('id,name')->select();
			$this->assign('users',$users);
		// print_r($users);exit;
		}
		
		$this->display();
	}
	//评分标准删除
	public function normdel(){
		$id = $_GET['id'];
		// echo $id;exit;
		$delresult = M('Qynorm')->where("id=".$id)->delete();
		if($delresult){
			$this->success('删除成功');					
		}else{
			
		 $this->success('删除失败');	
		}
	}
	
	public function norminfo (){
		$id = $_GET['id'];
		if($id){
			
			$result = M('Qynorm')->find($id);
			// print_r($result['KPLnorm']);exit;
			$this->assign('result',$result);	
			
		}
		$this->display('');	
		
		
	}
	//标准添加修改动作
	public function normact(){
		$id = $_POST['id'];
		// print_r($id);exit;
		$data['KPLnorm'] = $_POST['KPLnorm'];
		$data['value'] = $_POST['value'];
		$data['gradenorm'] = $_POST['gradenorm'];
		// print_r($data);exit;
		if($id){//判断是够有id存在，不存就添加，存在就修改;
			$data['update_time'] = date('Y-m-d');
			 $updateresult = M('Qynorm')->where("id=".$id)->save($data);
			if($updateresult){
				$this->success('修改成功');					
			}else{
				
			 $this->success('修改失败');	
			}
		}else{
			$data['create_time'] = date('Y-m-d');
			 $addresult = M('Qynorm')->add($data);
			if($addresult){
				$this->success('添加成功');					
			}else{
				
			 $this->success('添加失败');	
	
			}
		}
		$this->display();
	}
	//计分 项目清单
	public function score_project(){

		$score_projectdata = M('Qyscore_project')->select();
		$this->assign('score_projectdata',$score_projectdata);	
		// print_r($score_projectdata);exit;
		$this->display();
	}
	//计分管理员设置
	public function scoreadmin(){
		$user_id = $_SESSION['user_id'];
		if(IS_POST){
			$data['users_id'] = $_POST['userid'];
			$finfuser = M('Scoreadmin')->where(array('user_id'=>$data['users_id']))->select();
			if($finfuser){
				$this->success('该员工已经是管理员了');
			}
			$data['user_id'] = $user_id;
			$data['create_time'] = date('Ymd');
			$add = M('Scoreadmin')->add($data);
			if($add){
				$this->success('添加成功');	
			}
		}else{
			
			$where['user_id'] = $user_id;
			$userdata = M('Qyusers')->where($where)->select();
			$this->assign('userdata',$userdata);	
			$this->display();
		}
	}
	//添加计分项目
	public function score_projectedit(){
		if(IS_POST){
			$category = $_POST['category'];
			if($category){
				$category_namedata = M('Qyscore_project')->where(array('name'=>$category,'pid'=>0))->find();
				if($category_namedata){
					$this->ajaxReturn(2);
				}
				$data['name'] = $category;
				$data['pid'] = 0;
				$data['score'] = 0;
				$data['user_id'] = $_SESSION['user_id'];
				$data['createtime'] = date('Ymd');
		
				if($_POST['id']){
					$dataid2 = M('Qyscore_project')->where(array('id'=>$_POST['id']))->save($data);
				}else{
					$dataid = M('Qyscore_project')->add($data);
					if($dataid){
					
						$this->ajaxReturn($dataid,"添加成功",1);
					}
				}
				if($dataid2){
					 $this->ajaxReturn(3);
				}
			}
			$data['pid'] = $_POST['category_name'];
			$data['name'] = $_POST['name'];
			$data['score'] = $_POST['score'];
			$data['user_id'] = $_SESSION['user_id'];
			$data['createtime'] = date('Ymd');
			// $this->ajaxReturn(1);
			$dataid = M('Qyscore_project')->add($data);
			if($dataid){
				 $this->ajaxReturn(1);
			}
		}else{
			if($_GET['id']){
			
					$category_name = M('Qyscore_project')->where(array('id'=>$_GET['id']))->find();
					$this->assign('result',$category_name);	
		
			}
			$category_name = M('Qyscore_project')->select();
			$this->assign('category_name',$category_name);	
			$this->display();	
		}
	}
	public function score_projecteditinfo(){
		$category_name = M('Qyscore_project')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('category_name',$category_name);	
		$this->display();
	}
	public function score_projecteditact (){
		$id = $_GET['id'];
		if($id){
			
			$result = M('Qyscore_project')->find($id);
			$this->assign('result',$result);	
			
		}
		if(IS_POST){
			// print_r($_POST['id']);exit;
				$data['name'] = $_POST['name'];
				$data['score'] = $_POST['score'];
			if($_POST['id']){
				$dataid = M('Qyscore_project')->where(array('id'=>$_POST['id']))->save($data);
			}
				if($dataid){
						$this->success('保存成功');	
				}else{
					$this->error('保存失败');	
				}
		}
		$this->display();	
		
		
	}
		
	//添加计分项目
	public function score_projectadd(){
		if(IS_POST){
			
			$data['name'] = $_POST['category_name'];
			$dataid = M('Qyscore_project')->add($data);
			// $dataid
			$arr['name'] = $_POST['name'];
			$arr['pid'] = $dataid;
			$arr['score'] = $_POST['score'];
			$arr['createtime'] = date('Y-m-d');
			$datarr = M('Qyscore_project')->add($arr);
			if($datarr){
				$this->success('添加成功');
			}
		}	
		C('TOKEN_ON',false);
		$this->display();		
	}
	//我的团队
	public function myteam(){
		$users_id = $_SESSION['user_id'];
		if(IS_POST){
			$data['pk_time'] = date('Ymd',strtotime($_POST['pk_time'])); 
			if(!$data['pk_time']){
				$this->error('请填写时间');
			}
			$usersdata = M('Qymyteam')->where('userid='.$users_id)->field('id,teamname')->select();
			foreach($usersdata as $val){
				$myteamid[] = M('Qymyteam')->where(array('id'=>$val['id']))->save($data);
			
			}
		
				$myteamidlenght = count($myteamid);
				$usersdatalenght = count($usersdata);
				// print_r($myteamidlenght);
				if($myteamidlenght==$usersdatalenght){
					
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
				
		}else{
			if($users_id){
			$usersdata = M('Qymyteam')->join("JOIN tp_Qyusers as u ON tp_Qymyteam.captain=u.id")->where(array('tp_Qymyteam.userid'=>$users_id))->field('tp_Qymyteam.*,u.name as captain')->select();
			// print_r($usersdata);exit;
			$this->assign('qymyteam',$usersdata);	
			$pk_time = date('Y-m-d',strtotime($usersdata[0]['pk_time']));
			$this->assign('pk_time',$pk_time);	
			$this->display();
				
			}else{
				$this->error('非法操作');
			}
	
		}

	}
	public function myteamInfo(){
		// echo $_GET['id'];exit;
		$Qymyteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$_GET['id'],'type'=>1))->select();
		// print_r($usersdata);exit;
		$Qymyteam= M('Qymyteam')->where(array('id'=>$_GET['id']))->find();
		$captain = M('Qyusers')->where(array('id'=>$Qymyteam['captain']))->field('id,name')->find();
		foreach($Qymyteaminfo as $key=>$val){
			$usersdata['user'][$key] = M('Qyusers')->where(array('id'=>$val['users_id']))->field('id,name')->find();
			$usersdata['captain'] = $captain['name'];
			$usersdata['teamname'] = $Qymyteam['teamname'];
			
			// $captain
			// dump($val);
			
		}
		// dump($usersdata);exit;
		$this->assign('usersdata',$usersdata);	
	$this->display();
	}
	/*
	*
	*wap//手机端//麦伟良
	*
	*/
	//薪资明细
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
			exit();
		}
		$this->display();
	}
	public function wapwage(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapwage');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name')->find();//拿到员工id
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工id
		$wagedata = M('Qywage')->where(array('users_id'=>$usersid['id']))->find();

		$this->assign('wagedata',$wagedata);
		$this->assign('total',$wagedata['total']);	
		$this->assign('username',$usersid['name']);		
		$this->display();
	}
	//指pi标表 绩效关联
 	public function wapnorm(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$users_id = $app['userid'];
		$pid = $usersid['pid'];
		$arrpid = explode(";",$pid);
		foreach($arrpid as $val){
			if($val){
				
				$where['wxid'] = $val;
				$where['user_id'] = $users_id;
				$department[] = M('Department')->where($where)->field('name')->select();
			}
		
		}
		foreach($department as $v){
			foreach($v as $val){
				$departments[] = $val['name'];
			}
		}


		$l = M('Qymyteaminfo')->where(array('users_id'=>$usersid['id'] ,'type'=>1))->field('myteam_id')->find();
		$Qymyteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$l['myteam_id'],'type'=>1))->field('users_id')->select();
		
		$captain = M('Qymyteam')->where(array('id'=>$l['myteam_id'],'userid'=>$users_id))->field('captain')->find();
		$resultleader = M('Qyusers')->where(array('id'=>$captain['captain']))->field('name')->find();

		foreach($Qymyteaminfo as $val){
			$result[] = M('Qyusers')->where('id='.$val['users_id'])->field('name')->find();
		}

		$Qynorm = M('Qynorm')->select();
		$this->assign('position',$usersid['position']);//岗位
		$this->assign('department',$departments);//部门
		$this->assign('resultleader',$resultleader);//领导
		$this->assign('result',$result);//关联员工
		$this->assign('Qynorm',$Qynorm);
		 // print_r($result);exit;
		$this->display();
		
	}
	//自评
	public function wapgrade_me(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapgrade_me');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		if(IS_POST){	
			$data1 = $_POST['norm1'];
			$data1 = json_decode($data1,true);
			if(!$data1){
				//$datas = array();
				//$datas['ssss'] = $data1;
				$this->ajaxReturn(0);
			}
			
			$data2 = $_POST['norm2'];
			$data2 = json_decode($data2,true);
			$data3 = $_POST['norm3'];
			$data3 = json_decode($data3,true);
			$data4 = $_POST['norm4'];
			$data4 = json_decode($data4,true);
			$data5 = $_POST['norm5'];
			$data5 = json_decode($data5,true);
			//print_r($data5);exit;
		
			$da = $data5['complete_status'];
				
				//print_r($da); exit;
			if(!$da){
				//$this->ajaxReturn(0);
			}

			$data = array($data1,$data2,$data3,$data4,$data5); 
			$dataval = array();
			foreach($data as $val){		
			
				$dataval['grade_me']=$val['grade_me'];
				$dataval['norm_id']=$val['norm_id'];
				$dataval['complete_status']=$val['complete_status'];
				$dataval['users_id']=$usersid['id'];
				$dataval['grade_metime']=date('Ymd');
				$dataval['allgrede']=$_POST['allgrede'];
				if($val['id']){
					$result = M('Qynormgrade')->where(array('id'=>$val['id']))->save($dataval);
				}else{
					$result = M('Qynormgrade')->add($dataval);
				}
				
			}
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}else{
			$resultdata = M('Qynormgrade')->where(array('users_id'=>$usersid['id']))->select();
			$resultdatalenght = count($resultdata);
			if($resultdatalenght=5){
				$this->assign('resultdata',$resultdata);
			}
			// print_r($resultdata);exit;
			C('TOKEN_ON',false);
			$this->display();
			
		}
		
	}
	//员工列表
	public function wapusers(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapusers');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$l = M('Qymyteaminfo')->where(array('users_id'=>$usersid['id'] ,'type'=>1))->field('myteam_id')->find();
		$Qymyteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$l['myteam_id'],'type'=>1))->field('users_id')->select();
		
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name,position,pid')->find();//拿到员工id
		// $performance = M('Qycontextual_performance')->where('users_id='.$usersid['id'])->field('leader,contextual_id')->select();
		foreach($Qymyteaminfo as $val){
			// print_r($val['contextual_id']);
			$users[] = M('Qyusers')->where(array('id'=>$val['users_id']))->field('id,name,pic')->find();	
		}

		$this->assign('usersid',$users);
		// dump($users);exit;
		// print_r($users);exit;
		$this->display();
	}
	//评价他人
	public function wapgrade_ot(){
		$users_id = $_GET['users_id'];	
			// print_r($result);exit;
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapgrade_ot');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		if(IS_POST){
			$data = json_decode($_POST['data'],true);
			// print_r($data);exit;
			foreach($data as $key=>$val){
				$normdata['grade_ot'] = $val;
				$result[] = M('Qynormgrade')->where(array('id'=>$key))->save($normdata);
			}
			$resultlenght = count($result);
			$datalenght= count($data);
			if($datalenght=$resultlenght){
				$this->ajaxReturn(1);
			}else{
				
				$this->ajaxReturn(0);
			}
			
			
			// echo 1;exit;		
				// print_r($_POST['norm5']["'grade_ot'"]);exit;
			if(!$_POST['norm5']["'grade_ot'"]){
				// $this->error('5不能为空');
				
			}
			if(!$_POST['norm4']["'grade_ot'"]){
				// $this->error('4不能为空');
				
			}
			if(!$_POST['norm3']["'grade_ot'"]){
				// $this->error('3不能为空');
				
			}
			if(!$_POST['norm2']["'grade_ot'"]){
				// $this->error('2不能为空');
				
			}
			if(!$_POST['norm1']["'grade_ot'"]){
				// $this->error('1不能为空');
				
			}
			// $resel = M('Qynormgrade')->where('users_id='.$usersid)->select();
			// print_r($_POST);exit;
			// $_POST['norm_id'];
			// foreach ($_POST as $val){
				// $otdata['norm_id'] = $val["'norm_id'"];
				// $otdata['grade_ot'] = $val["'grade_ot'"];
				// $otdata['users_id']=$usersid;
				// $otdata['grade_ottime']=date('Y-m-d');
				// print_r($val["'norm_id'"]);
				// if(!$resel){
					// $result = M('Qynormgrade')->add($otdata);	
				// }else{
				
					// $result = M('Qynormgrade')->where('norm_id='.$otdata['norm_id'])->save($otdata);
				// }
			// }
				
		}else{
			$users_id = $_GET['users_id'];	
			$username = M('Qyusers')->where(array('id'=>$users_id))->field('name')->find();
			$data = array();	
			$where['users_id']=$users_id;
			$result = M('Qynormgrade')->order('norm_id')->where($where)->select();
			if($result){
				foreach($result as $key => $val){
					$normarr = M('Qynorm')->where('id='.$val['norm_id'])->select();
					$val['norm'] = $normarr;
					$data[] = $val;
				}
			}else{
				$this->error('该员工还没评分');
			}
			// print_r($data);exit;
			$this->assign('dataarr',$data);
			$this->assign('username',$username['name']);
			C('TOKEN_ON',false);
			$this->display();
		
			
		}
			
			
		
		
	}
	
		//计分 项目清单
	public function wapscore_project(){
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapscore_project');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $score_projectdata = M('Qyscore_project')->where(array('user_id'=>$app['userid']))->select();
			$score_projectdata = M('Qyscore_project')->select();
	
		foreach($score_projectdata as $val){
			if($val['pid']==0){
				$arrtcount = M('Qyscore_project')->where(array('pid'=>$val['id']))->COUNT();
				// print_r($arrtcount);exit;
				$val['arrtcount'] = $arrtcount;
				// print_r($val);
				
			}
			$score_projectdatas[] = $val;
		}
		//print_r($score_projectdatas);exit;
		$this->assign('score_project',$score_projectdatas);	

		$this->assign('score_projectdata',$score_projectdata);	


		$this->display();
	}
	//计分
	public function wapscoring(){
		// $users_id = $_SESSION['user_id'];
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapscoring');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$wheres['captain'] = $usersid['id'];
		$Qymyteam = M('Qymyteam')->where($wheres)->find();//检查是够是管理员 队长
		
		$Qymyteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$Qymyteam['id']))->select();//检查是够是管理员 队长
		foreach($Qymyteaminfo as $val){
			if($val){
				$myteam_uid[] = $val['users_id'];
			}
		}
		if(!$Qymyteam){
			// echo "你暂时不是计分管理员，请与管";exit;
			 $this->error('你暂时不是计分管理员，请与管理员申请');
			 // $this->ajaxReturn(3);
		}
		if(!IS_POST){

			$dataopj = M('Qyscore_project')->where('pid!=0')->select();
			$where['id'] = array('in',$myteam_uid);
			$where['user_id']= $app['userid'];
			// print_r($where);exit;
			$datausers = M('Qyusers')->where($where)->field('id,name')->select();
			$this->assign('dataopj',$dataopj);	
			$this->assign('datausers',$datausers);	
			
			C('TOKEN_ON',false);
			$this->display();
		}else{
			$_POST['create_time'] = date('Ymd');
			$qyscorecard = M('Qyscorecard')->where(array('users_id'=>$_POST['users_id'],'scoreproject'=>$_POST['scoreproject']))->find();
			if($qyscorecard){
				$result = M('Qyscorecard')->where(array('users_id'=>$_POST['users_id'],'scoreproject'=>$_POST['scoreproject']))->save($_POST);
			}else{
				$result = M('Qyscorecard')->add($_POST);
			}
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
			

		}

		
		
	}
	//搜索
	public function wapsearch($keyword = ''){
		
		// print_r($_POST['search']);
		$keyword = $_POST['search'];
		if(preg_match("/^\d*$/",$keyword))   //判断是时间格式还是姓名
		{
			//时间查找
			$where['create_time'] = array('like','%'.$keyword.'%');
			$readcorecard = M('Qyscorecard')->where($where)->select();//查找时间
			$users_id = $_SESSION['user_id'];

			foreach($readcorecard as $val){
				$where['id'] = $val['users_id'];
				$resultsuers[] = M('Qyusers')->where($where)->select();
					foreach($resultsuers as $v){
						$val['name'] =$v[0]['name'];
					}
					$readfile[] = $val;

			}

			if($readfile){
				$dataopj = M('Qyscore_project')->where('pid!=0')->select();
				$datausers = M('Qyusers')->where('user_id='.$users_id)->field('id,name')->select();
				$this->assign('dataopj',$dataopj);	
				$this->assign('datausers',$datausers);		
				$this->assign('readfile',$readfile);		
				$this->display();
			}else{
				$this->error('已经很努力查找了，还是找不到');
			}
		
		
		}else{
				//姓名查找
			$users_id = $_SESSION['user_id'];//查找企业id
			$where['user_id'] = $users_id;
			$where['name'] =array('like','%'.$keyword.'%');
			$usersdata = M('Qyusers')->where($where)->field('id,name')->select();
		
			foreach ($usersdata as $val){
				
				$searchdata = M('Qyscorecard')->where('users_id='.$val['id'])->select();
				foreach($searchdata as $v){
						$v['name'] = $val['name'];	
						$readfile[] = $v;
						// print_r($v);
				}
			}
			if($readfile){
					
					$dataopj = M('Qyscore_project')->where('pid!=0')->select();
					$datausers = M('Qyusers')->field('id,name')->select();
					$this->assign('dataopj',$dataopj);	
					$this->assign('readfile',$readfile);	

					$this->display();
			}else{
				
				$this->error('已经很努力查找了，还是找不到');
			}
		
		}

	// print_r($readfile);
		C('TOKEN_ON',false);
		// $this->display('wapscoring');
	
	}
	
	//删除
	public function wapscoredel(){
		$id = $_GET['id'];
		if($id){
			$result = M('Qyscorecard')->where('id='.$id)->delete();
			if($result){
				$this->success('删除成功');	
			}
		}
	}
	//查看我的分数
	public function wapmyscores (){
		//获取员工id
		
		// $users_id = $_SESSION['user_id'];
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "lzh";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工i
		$users_id = M('Qyusers')->where(array('user_id'=>$app['userid']))->field('id,name')->select();//拿到所有员工id
		foreach($users_id as $val){
			$resultall = M('Qyscorecard')->field('id,users_id,grades')->order('grades desc')->where('users_id='.$val['id'])->select();
				foreach($resultall as $v){
			
					$gradesall[$v['users_id']][] = $v['grades'];
					 // $gradesall[$v['users_id']][] =$gradesall[$v['users_id']][]+$v['grades'];
				}
			// print_r($resultall);
		}
		 // arsort($gradesall,SORT_LOCALE_STRING);
		foreach($gradesall as $key=>$val){
			$usersgradeadll[] = array_sum($val);
			
		}
		arsort($usersgradeadll);
		
		// print_r($usersgradeadll);exit;
		$result = M('Qyscorecard')->where('users_id='.$usersid['id'])->select();
		// $resultgrades = M('Qyscorecard')->field('id,grades')->select();
		foreach($usersgradeadll as $v){
			$fen[] = $v;		
		}
		$grades = '';
		foreach($result as $val){
			$grades += $val['grades'];	
		}
		foreach($fen as $key=>$val){
			if($val==$grades){
				// echo $key."ssds";
				$ranking=$key+1;
			
			}
			// print_r($val."/");
		}
		$this->assign('ranking',$ranking);	
		$this->assign('result',$result);	
		$this->assign('grades',$grades);	
		$this->display();
	}
	//我的团队
	public function wapmyteam (){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "lzh";
		$users_id = $app['userid'];
		$myteaminfoid = M('Qymyteaminfo')->where(array('users_id'=>$usersid['id']))->field('myteam_id')->select(); //拿团团队id
		$wheres['id']=$myteaminfoid[0]['myteam_id'];
		$myteam = M('Qymyteam')->where($wheres)->select();//
		$wheress['myteam_id'] = $myteaminfoid[0]['myteam_id'];
		$myteaminfo = M('Qymyteaminfo')->where($wheress)->select();//查询所有成员id
		
		foreach($myteaminfo as $val){
			$teamsersid = M('Qyusers')->where(array('id'=>$val['users_id']))->field('id,name,pic')->select();//找到员工表信息
			foreach($teamsersid as $v){
					 $scorecard = M('Qyscorecard')->where(array('users_id'=>$v['id']))->select();//查找员工计分信息
					 foreach($scorecard as $k){
							 $gradesall[$k['users_id']]['zonfen'] += $k['grades'];	
							 $gradesall[$k['users_id']]['name'] = $v['name'];
							 $gradesall[$k['users_id']]['pic'] = $v['pic'];
					 } 
			}	
		}
	// print_r($gradesall);exit;
		 $dataallas = array();
		 foreach($gradesall as $key=>$val){
			 $teamsersid = M('Qyusers')->where(array('id'=>$key))->field('id,name,pic')->select();//
			 
			  $dataall['name'] = $teamsersid[0]['name'];
			  $dataall['allgrade'] = $val;
			  $dataallas[] = $dataall;
			
		 }
	
		 $usersid = M('Qyusers')->where(array('user_id'=>$users_id))->field('id,name')->select();//拿到员工i
		 foreach($usersid as $val){
			 $where['users_id'] = $val['id'];
			 $where['type'] = 1;
			 if($myteaminfoids = M('Qymyteaminfo')->where($where)->field('myteam_id')->select());//查找所有团队
			 {
					if($myteaminfoids[0]['myteam_id']!=null){
						 $ss['myteam_id'] =  $myteaminfoids[0]['myteam_id'];
						$ss['userid'] = $val['id'];
						$aa[] = $ss;
						
					}
				
			 }

		 }

		 foreach($aa as $val){
			  $Qyscorecard = M('Qyscorecard')->where(array('users_id'=>$val['userid']))->select(); 

				foreach($Qyscorecard  as $key=>$v){				
					$ks[$val['myteam_id']]['ss'] += $v['grades'];			
				}
		}
		$i=1;
		arsort($ks);
		foreach($ks as $key=>$val){
			$myteams = M('Qymyteam')->where(array('id'=>$key))->find();
				 $ll[$key]= $val;
				 $ll[$key]['ming'] =$i;  
				 $ll[$key]['teamname'] = $myteams['teamname'];	
				 $i++;
		}
			$d = $myteaminfoid[0]['myteam_id'];
		$ming =  $ll[$d]['ming'];
		$team = M('Qyusers')->where(array('id'=>$myteam[0]['captain']))->field('id,name,pic')->find();//拿到员工i
	
		 $pk_time = strtotime($myteam[0]['pk_time']);

		$day = strtotime (date('Ymd'));
		$pkingtime =  ceil(($pk_time-$day)/86400);
		
		$this->assign('myteamname',$myteam[0]['teamname']);//团队名字
		$this->assign('captain',$team);//队长信息
		$this->assign('dataallas',$gradesall);//成员信息
		$this->assign('ming',$ming);//团队排名
		$this->assign('ll',$ll);//
		$this->assign('pkingtime',$pkingtime);//pk时间
		$this->display();
	}
	//创建件团队
	public function wapmyteamindex (){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,appid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapmyteamindex');
			exit();
		}
		// print_r($_GET['wecha_id']);exit;
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "lzh";
		$users_id = $_SESSION['user_id'];

		if(IS_POST){

			$where['teamname'] = $_POST['teamname'];
			$results = M('Qymyteam')->where($where)->find();//检查名字是否存在
			if($results){
				$this->ajaxReturn(2);
			}
			//添加数据
			$pk_time = M('Qymyteam')->where(array('userid'=>$app['userid']))->field('pk_time')->find();
			$captain = M('Qymyteam')->where(array('captain'=>$usersid['id']))->find();//检查是否存在d
			$Qymyteaminfo = M('Qymyteaminfo')->where(array('users_id'=>$usersid['id']))->find();//检查是否存在d
			if($captain && $Qymyteaminfo){
				$this->ajaxReturn(3);
			}
			if($pk_time){
				$data['pk_time'] = $pk_time['pk_time'];
			}
			$data['teamname'] = $_POST['teamname'];
			$data['captain'] =  $usersid['id'];
			$data['userid'] =  $app['userid'];
			$data['create_time'] =  date('Ymd');
			$resultadd = M('Qymyteam')->add($data);
			if($resultadd){
				$datas['users_id'] =  $usersid['id'];
				$datas['myteam_id'] =  $resultadd;
				$datas['createtime'] =  date('Ymd');
				$datas['type'] =  1;
				$resultainfodd = M('Qymyteaminfo')->add($datas);
				$Msg=A('Qyapp/Msg');
				$inined['touser'] = '@all';
				$inined['title']=$usersid['name']."创建了".$data['teamname'];
				$inined['description']="快点击申请加入吧";
				$inined['picurl']="picurl";
				$inined["agentid"]=$app['appid'];
				$inined['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Performance&a=wapjointeam&token='.$_GET['token'];
				$infoed=$Msg->msg_send_all($inined,$app['userid']);
				if($infoed['errcode']==0){
						$this->ajaxReturn(1);
				}
			
			}else{
				$this->ajaxReturn(0);
			}
		}
		$this->display();
	}
	//申请加入团队 有问题待处理
	public function wapjointeam(){
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Performance';
				$data['action']='wapjointeam';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wapjointeam');
				
			}
			// print_r($_GET['wecha_id']);exit;
			$result = M('Qymyteam')->where(array('userid'=>$app['userid']))->select();//查找所有团队
			$this->assign('result',$result);//所有团队
			$this->display();
		
	}
	//申请加入团队 动作
	public function wapjointeamact(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,appid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapjointeamact');
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
	
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		if(IS_POST){
	
			if($_POST['uid']){
				$Qymyteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$_POST['uid'],'users_id'=>$usersid['id']))->find();
				$captain = M('Qymyteam')->where(array('captain'=>$usersid['id']))->find();
				if($Qymyteaminfo || $captain){
					$this->ajaxReturn(2);
					//已经有团队了
				}
				$datas['myteam_id'] = $_POST['uid'];
				$datas['users_id']=$usersid['id'];
				$datas['type']=0;
				$datas['createtime']=date('Ymd');
				$infodata = M('Qymyteaminfo')->add($datas);
				if($infodata){
					$Qymyteam = M('Qymyteam')->where(array('id'=>$datas['myteam_id']))->find();
					$wxuserid = M('Qyusers')->where(array('id'=>$Qymyteam['captain']))->field('userid')->find();//拿到员工id
					$Msg=A('Qyapp/Msg');
					//---------发送处理给队长----------
					$inin['touser'] = $wxuserid['userid'];
					$inin['title']="有小伙伴申请加入您的团队";		
					$inin['description']="请您点击进入处理";
					$inin['picurl']="picurl";
					$inin["agentid"]=$app['appid'];
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Performance&a=wapteamconf&token='.$_GET['token'];
					$info=$Msg->msg_send_all($inin,$app['userid']);
					if($info['errcode']==0){
						$this->ajaxReturn(1);
					}else{
						$this->ajaxReturn(0);
					}
					
					// $this->success('申请成功，请耐心等待队长审核吧！');
				}else{
					$this->ajaxReturn(0);
				}
			}else{
				$this->error("非法操作！");
			}
		}
	}
	//管理团队成员
	public function wapteamconf (){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wapteamconf');
		
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$resultteam = M('Qymyteam')->where(array('captain'=>$usersid['id']))->field('id')->find();

		$resultteaminfo = M('Qymyteaminfo')->where(array('myteam_id'=>$resultteam['id']))->select();
		foreach($resultteaminfo as $val){
			$datausers = M('Qyusers')->where(array('id'=>$val['users_id']))->select();
				foreach($datausers as $v){
					$teaminfodata['name'] = $v['name'];
					 $teaminfodata['id'] =$v['id'];
					  $teaminfodata['type'] = $val['type'];
					 $teaminfodatas[] = $teaminfodata;
				}
				// print_r($val);
		}
			// print_r($teaminfodatas);exit;
		$this->assign('teaminfodatas',$teaminfodatas);//所有团队
		$this->display();
	}
	//审核团队成员
	public function wapteamcheck(){
		if($_GET['users_id']){
			$data['type']=1;
			$teaminfo = M('Qymyteaminfo')->where('users_id='.$_GET['users_id'])->save($data);
			if($teaminfo){
				$this->success('审核成功！');
			}
		}
		// print_r($_GET);exit;
	}
	//删除团队成员
	public function wapteamdell(){
		if($_GET['users_id']){
			// $data['type']=2;
			$teaminfo = M('Qymyteaminfo')->where('users_id='.$_GET['users_id'])->delete();
			if($teaminfo){
				$this->success('删除成功！');
			}
		}
	}
	//数字榜单 
	public function wapbillboard(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Performance';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$users_id = $app['userid'];
		$usersid = M('Qyusers')->where(array('user_id'=>$users_id))->field('id,name')->select();//拿到所有员工ifield('id,users_id,grades')->
		foreach($usersid as $val){
			$resultall = M('Qyscorecard')->order('grades desc')->where('users_id='.$val['id'])->select();
			$i=1;
			foreach($resultall as $v){
			$grades[$v['users_id']]['grades'] += $v['grades'];
			$grades[$v['users_id']]['name'] = $val['name'];
			$i++;
			}
		}
		arsort($grades);
		foreach($grades as $val){
		$all += $val['grades'];
		$alla += $val['grades']*26;
		}
		// print_r($alla);exit;
		$this->assign('grades',$grades);
		$this->assign('all',$all);//总分
		$this->assign('alla',$alla);//总分红
		$this->display();
		
	}

	
}
?>