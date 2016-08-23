<?php
/**
 *微信绩效
  开发者：麦伟良
 **/
class PerformanceAction extends Action{
	public function index(){
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
					$this->error('已经关联'.$users['name'].'了!');
				}else{
					$result[] = M('Qycontextual_performance')->add($data);
				}
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
			$where['user_id'] = $user_id;
			$users = M('Qyusers')->where($where)->field('id,name')->select();
			$this->assign('users',$users);

		}
		
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
		$id =  $_GET['id'];
		// echo $id;exit;
		$where['users_id'] = $id;
		$wagearr = M('Qywage')->where($where)->find();
		// print_r($wagearr);exit;
		$this->assign('info',$wagearr);
		$this->assign('users_id',$id);
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
					$delids = json_decode($delid);
					$lenght[] = '';
					foreach($delids as $val){
							//检查是不是类别
						
									$datanamefind = M('Qyscore_project')->where(array('pid'=>$val))->find();
									if($datanamefind){
										$this->ajaxReturn(4);
									}else{
										$lenght = $val;
										// count($val);
										//不存在数据直接删除
										$datadel = M('Qyscore_project')->where(array('id'=>$val))->delete();
									}
	
					}
					$lenghts = count($lenght);
					$datadels = count($datadel);
					if($lenghts = $datadels){
						$this->ajaxReturn(5);
					}
			
			}
		}
		$score_projectdata = M('Qyscore_project')->select();
		$this->assign('score_projectdata',$score_projectdata);	
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
		// echo 1;exit;
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
				$data['createtime'] = date('Ymd');
				$dataid = M('Qyscore_project')->add($data);
				if($dataid){
				//$category_name = M('Qyscore_project')->select();
				 $this->ajaxReturn($dataid,"添加成功",1);
				}
			}
			$data['pid'] = $_POST['category_name'];
			$data['name'] = $_POST['name'];
			$data['score'] = $_POST['score'];
			$data['createtime'] = date('Ymd');
			// $this->ajaxReturn(1);
			$dataid = M('Qyscore_project')->add($data);
			if($dataid){
				 $this->ajaxReturn(1);
			}
		}else{
			$category_name = M('Qyscore_project')->select();
			$this->assign('category_name',$category_name);	
			$this->display();	
		}
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
			
			$data['teamname'] = $_POST['teamname'];
			if($data['teamname']){
				$where['teamname'] = $data['teamname'];
				$re = M('Qymyteam')->where($where)->find();
				if($re){
					// print_r($re);exit;
					$this->error('该名字已经存在');
				}
			}
			$data['captain'] = $_POST['captain'];
			if($data['captain']){
				$re = M('Qymyteam')->where('captain='.$data['captain'])->find();
				if($re){
					// print_r($re);exit;
					$this->error('该成员已经是其他团队队长了');
				}
			}
			// $data['pk_time'] = $_POST['pk_time'];
			
			$data['create_tiem'] = date('Ymd');
			$data['pk_time'] = date('Ymd',strtotime($_POST['pk_time'])); 
			$myteamid = M('Qymyteam')->add($data);
			if($myteamid){
				$datauser['myteam_id'] = $_POST['usersname'];
				foreach($datauser['myteam_id'] as $val){
					$teaminfo['users_id'] = $val;
					$teaminfo['myteam_id'] = $myteamid;
					$teaminfo['createtime'] = date('Ymd');
					$tes = M('Qymyteaminfo')->add($teaminfo);
					// print_r($tes);
					
				}
				// print_r($datauser);exit;
			}
				if($tes){
					
					$this->success('添加成功');
				}
				
		}else{
			$usersdata = M('Qyusers')->where('user_id='.$users_id)->field('id,name')->select();
				// print_r($usersdata);exit;
			$this->assign('usersdata',$usersdata);	
		}
	
		$this->display();
	}
	/*
	*
	*wap//手机端//麦伟良
	*
	*/
	//薪资明细
	public function wapwage(){
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
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name')->find();//拿到员工id
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工id
		$wagedata = M('Qywage')->where(array('users_id'=>$usersid['id']))->find();
		// $total = '';
		// foreach ($wagedata as $r=>$v){
			// $total=$total+$v;
		// }
		
		$this->assign('wagedata',$wagedata);
		$this->assign('total',$wagedata['total']);	
		$this->assign('username',$usersid['name']);		
		$this->display();
	}
	//指pi标表 绩效关联
 	public function wapnorm(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		// print_r($app['userid']);exit;
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
		$users_id = $_SESSION['user_id'];
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name,position,pid')->find();//拿到员工id
		$pid = $usersid['pid'];
		$arrpid = explode(";",$pid);
		foreach($arrpid as $val){
			if($val){
				$where['wxid'] = $val;
				$where['user_id'] = $users_id;
				$department[] = M('Department')->where($where)->field('name')->select();
			}
			// print_r($val);
		}
		foreach($department as $v){
			foreach($v as $val){
				$departments[] = $val['name'];
				 // $sss= $departments;
			}
			// print_r($v);
		}
		// print_r($usersid);exit;
		$performance = M('Qycontextual_performance')->where('users_id='.$usersid['id'])->field('leader,contextual_id')->select();
		$resultusers = array();
		foreach($performance as $val){
			$result[] = M('Qyusers')->where('id='.$val['contextual_id'])->field('name')->find();
			$resultleader = M('Qyusers')->where('id='.$val['leader'])->field('name')->find();
			// print_r($result);
			// $resultusers[]= $result;
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
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "xtzlyp";
		// var_dump($userid );exit;
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工id
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
				$result = M('Qynormgrade')->add($dataval);
			}
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}
		C('TOKEN_ON',false);
		$this->display();
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
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name,position,pid')->find();//拿到员工id
		$performance = M('Qycontextual_performance')->where('users_id='.$usersid['id'])->field('leader,contextual_id')->select();
		foreach($performance as $val){
			// print_r($val['contextual_id']);
			$users[] = M('Qyusers')->where('id='.$val['contextual_id'])->field('id,name')->find();	
		}

		$this->assign('usersid',$users);
		// print_r($users);exit;
		$this->display();
	}
	//评价他人
	public function wapgrade_ot(){
		
		$users_id = $_GET['users_id'];	
		print_r($users_id);exit;
		
			$data = array();	
			$where['users_id']=$users_id;
			$result = M('Qynormgrade')->order('norm_id')->where($where)->select();
			// print_r($result);exit;
			foreach($result as $key => $val){
				$normarr = M('Qynorm')->where('id='.$val['norm_id'])->select();
				$val['norm'] = $normarr;
				$data[] = $val;
			}
			// print_r($data);exit;
		if(IS_POST){
				
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
			$resel = M('Qynormgrade')->where('users_id='.$users_id)->select();
			// print_r($_POST);exit;
			foreach ($_POST as $val){
				$otdata['norm_id'] = $val["'norm_id'"];
				$otdata['grade_ot'] = $val["'grade_ot'"];
				$otdata['users_id']=$users_id;
				$otdata['grade_ottime']=date('Y-m-d');
				// print_r($val["'norm_id'"]);
				if(!$resel){
					$result = M('Qynormgrade')->add($otdata);	
				}else{
				
					$result = M('Qynormgrade')->where('norm_id='.$otdata['norm_id'])->save($otdata);
				}
			}
				
		}
			
			$this->assign('dataarr',$data);
			C('TOKEN_ON',false);
			$this->display();
		
		
		
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
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$score_projectdata = M('Qyscore_project')->select();
		$score_projectdatas[] = '';
		foreach($score_projectdata as $val){
			if($val['pid']==0){
				$arrtcount = M('Qyscore_project')->where(array('pid'=>$val['id']))->COUNT();
				$val['arrtcount'] = $arrtcount;
			}
			$score_projectdatas = $val;
		}
		$this->assign('score_projectdata',$score_projectdata);	
		print_r($score_projectdatas);exit;
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
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		$wheres['$users_id'] = $usersid;
		$Scoreadmin = M('Scoreadmin')->where($wheres)->find();//检查是够是管理员
		if(!$Scoreadmin){
			// echo "你暂时不是计分管理员，请与管";exit;
			 $this->error('你暂时不是计分管理员，请与管理员申请');
		}
		if(!IS_POST){

			$dataopj = M('Qyscore_project')->where('pid!=0')->select();
			$where['user_id']= $app['userid'];
			$datausers = M('Qyusers')->where($where)->field('id,name')->select();
			    // print_r($where);
				// print_r($datausers);exit;
			$this->assign('dataopj',$dataopj);	
			$this->assign('datausers',$datausers);	
			
			C('TOKEN_ON',false);
			$this->display();
		}else{
			// print_r(date('Y-m-d'));exit;
			$_POST['create_time'] = date('Ymd');
			if(!$_POST['grades']){
				$this->error('分数不能为空');
			}
			$result = M('Qyscorecard')->add($_POST);
			if($result){
				$this->success('添加成功');
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
		$users_id = $_SESSION['user_id'];
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工i
		$myteaminfoid = M('Qymyteaminfo')->where('users_id='.$usersid['id'])->field('myteam_id')->select(); //拿团团队id
				// print_r();
		$wheres['id']=$myteaminfoid[0]['myteam_id'];
		$myteam = M('Qymyteam')->where($wheres)->select();//
		$wheress['myteam_id'] = $myteaminfoid[0]['myteam_id'];
		$myteaminfo = M('Qymyteaminfo')->where($wheress)->select();//查询所有成员id
		foreach($myteaminfo as $val){
			$teamsersid = M('Qyusers')->where(array('id'=>$val['users_id']))->field('id,name')->select();//找到员工表信息
			foreach($teamsersid as $v){
					 $scorecard = M('Qyscorecard')->where(array('users_id'=>$v['id']))->select();//查找员工计分信息
					 foreach($scorecard as $k){
							 $gradesall[$k['users_id']]['zonfen'] += $k['grades'];	
							$gradesall[$k['users_id']]['name'] = $v['name'];
					 } 
			}	
		}
		

		// print_r($gradesall);
		 // print_r($gradesall);exit;
		 $dataallas = array();
		 foreach($gradesall as $key=>$val){
			 $teamsersid = M('Qyusers')->where(array('id'=>$key))->field('id,name')->select();//
			 
			  $dataall['name'] = $teamsersid[0]['name'];
			  $dataall['allgrade'] = $val;
			    // print_r($teamsersid[0]['name']);
			  // $dataall[]['id'] = $key;
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
			  $Qyscorecard = M('Qyscorecard')->where('users_id='.$val['userid'])->select(); 

				foreach($Qyscorecard  as $key=>$v){				
					$ks[$val['myteam_id']]['ss'] += $v['grades'];			
				}
		}

			 // print_r($ks);
		$i=1;
		arsort($ks);
		foreach($ks as $key=>$val){
			$myteams = M('Qymyteam')->where('id='.$key)->find();
				 $ll[$key]= $val;
				 $ll[$key]['ming'] =$i;  
				 $ll[$key]['teamname'] = $myteams['teamname'];	
				 $i++;
		}

			$d = $myteaminfoid[0]['myteam_id'];
			// echo $d;
		$ming =  $ll[$d]['ming'];
		// echo $ming;
		$team = M('Qyusers')->where(array('id'=>$myteam[0]['captain']))->field('id,name')->find();//拿到员工i
		 $pk_time = strtotime ($myteam[0]['pk_time']);
		 // print_r($pk_time);
		$day = strtotime (date('Ymd'));
		$pkingtime =  ceil(($pk_time-$day)/86400);
		$this->assign('myteamname',$myteam[0]['teamname']);//团队名字
		$this->assign('captain',$team['name']);//队长
		$this->assign('dataallas',$gradesall);//成员信息
		$this->assign('ming',$ming);//团队排名
		$this->assign('ll',$ll);//
		$this->assign('pkingtime',$pkingtime);//成员信息
		// print_r($myteaminfo);exit;
		$this->display();
	}
	//创建件团队
	public function wapmyteamindex (){
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
		$users_id = $_SESSION['user_id'];
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工i
		//检查是否已经创建过团队了
	
		// print_r($usersid);
		if(IS_POST){
			$result = M('Qymyteam')->where('captain='.$usersid['id'])->select();
			if($result){
				$this->error('亲！你已经创建过团队了噢！');
			}
			$data['teamname'] = $_POST['teamname'];
			$where['name'] = $data['teamname'];
			$result = M('Qymyteam')->where($where)->select();
			if($result){
				$this->error('亲！这个名字太热门了！已经存在了！');
			}
			$data['captain'] =  $usersid['id'];
			$data['create_time'] =  date('Ymd');
			$resultadd = M('Qymyteam')->add($data);
			if($resultadd ){
				$this->success('创建成功');
			}
		}
		$this->display();
	}
	//申请加入团队 有问题待处理
	public function wapjointeam(){

		$result = M('Qymyteam')->select();//查找所有团队
		// print_r($result);
		$this->assign('result',$result);//所有团队
		$this->display();
	}
	//申请加入团队 动作
	public function wapjointeamact(){

		if(IS_GET){
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
			// $userid = "lijiahui_270636852";
			$users_id = $_SESSION['user_id'];
			// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工i
			$resultteam = M('Qymyteaminfo')->where(array('users_id'=>$usersid['id']))->find();
			// print_r($usersid);exit;
			if($resultteam){
				
				$this->error('亲！你已经心有所属咯！');
			}
		
			$data['myteam_id'] = $_GET['id'];
			$data['users_id']=$usersid['id'];
			$data['createtime']=date('Ymd');
		// print_r($data);exit;
			$infodata = M('Qymyteaminfo')->add($data);
			if($infodata){
				$this->success('申请成功，请耐心等待队长审核吧！');
			}
			// print_r($_GET);exit;
			
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
			$Oauth->index($data);
			exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id,name,position,pid')->find();//拿到员工id
		// $userid = "lijiahui_270636852";
		$users_id = $_SESSION['user_id'];
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name')->find();//拿到员工i
		// print_r($usersid);exit;
		$resultteam = M('Qymyteam')->where(array('captain'=>190))->field('id')->find();
		// print_r($resultteam);exit;
		// if(!$resultteam){
			// $this->error('亲！你还创建团队噢！赶快申请吧');
		// }
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
		$this->assign('teaminfodatas',$teaminfodatas);//所有团队
		// print_r($teaminfodatas);exit;
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