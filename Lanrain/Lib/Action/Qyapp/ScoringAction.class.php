<?php
class ScoringAction extends Action{
	
/*********工作岗位管理*********/
	/**
	 * 配置岗位
	 */
	public function addJob(){
		$user_id = $_SESSION['user_id'];
		if(IS_POST){
			$data['user_id'] = $user_id;//岗位名称
			$data['name'] = $_POST['name'];//岗位名称
			$data['depart'] = $_POST['depart_id'];//岗位所属部门
			$data['desc'] = $_POST['desc'];//岗位描述
			$data['smoney'] = $_POST['smoney'];//岗位试用参考工资
			$data['zmoney'] = $_POST['zmoney'];//岗位正式参考工资
			$m = M('Crmjob')->where(array('user_id'=>$_SESSION['user_id'],'name'=>$_POST['name'],'depart'=>$_POST['depart_id']))->find();//验证是否已配置该岗位
			if($m){
				$result = M('Crmjob')->save($data);
				if($result){
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
			}else{
				$result = M('Crmjob')->add($data);
				if($result){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}else{
			//部门列表,每个部门有多个岗位，每个岗位对应一个部门
			$depart = M('Department')->where(array('user_id'=>$user_id))->select();
			$this->assign('dep',$depart);
			$this->display();
		}
	}
	
	
/*********薪酬管理*********/	
	
	/**
	 * 员工列表
	 */
	public function users(){
		$User         =M('Qyusers');
		import('ORG.Util.Page');
		$count      = $User->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,25);
		$show       = $Page->show();
		$list = $User->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();	
	}
	
	/**
	 * 分配职位、设置员工领导、设置绩效关联人员
	 */
	public function usersJob(){
		$id = $_GET['uid'];//员工ID
		$user_id = $_SESSION['user_id'];
		//获取分配的岗位
		if(IS_POST){
			$value = $_POST;
			$user = M('Qyusers')->where(array('id'=>$id))->setField('job_id',$value);
		}else{
			//查询该员工所属部门
			$pid = M('Qyusers')->where(array('id'=>$id))->field('pid')->find();
			$dep = explode(';',$pid['pid']);
			$depart = array();
			foreach ($dep as $k=>$v){
				if($v){
					$dep = M('Department')->where(array('wxid'=>$v))->field('name')->find();
					$job = M('Crmjob')->where(array('depart'=>$v))->select();
					$depart[] = $dep['name'];
				}
			}
			$users = M('Qyusers')->where("user_id=$user_id AND id!=$id")->select();
			$this->assign('users',$users);//遍历员工以设置绩效关联人员和领导
			$this->assign('depart',$depart);//遍历部门
			$this->assign('job',$job);//遍历当前部门下的岗位
		}	
	}
	
	/**
	 * 制作工资表
	 */
	public function payAdd(){
		$id = $_GET['uid'];
		if(IS_POST){
			$data = $_POST;
			$total = (float)0;
			foreach ($data as $v){
				$total +=(float)$v;
			}
			$begin = date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y'))); //本月的开始日期
			$days = date('t',strtotime($m)); //上个月共多少天
			$end = date('Y-m-d', mktime(23,59,59,date('m'),$days,date('Y'))); //本月的结束日期
			$begin = strtotime($begin);
			$end = strtotime($end);
			$where['time'] = array('between',$begin,$end);
			$where['user_id'] = $_SESSION['user_id'];
			$where['uid'] = $_POST['uid'];
			$data['time'] = time();
			$result = M('Crmpayinfo')->where($where)->field('id')->find();//检测本月是否已经添加了工资
			if($result){
				$res = M('Crmpayinfo')->save($data);
				if($res){
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
			}else{
				$res = M('Crmpayinfo')->add($data);//添加工资详情
				if($res){
					$data_pay['info_id'] = $res;
					$data_pay['total'] = $total;
					$data_pay['uid'] = $res;
					$data_pay['info_id'] = $_POST['uid'];
					$data_pay['user_id'] = $_SESSION['user_id'];
					$resu = M('Crmpay')->where(array('info_id'=>$res))->find();
					if($resu){
						$re = M('Crmpay')->save($data_pay);
					}else{
						$re = M('Crmpay')->add($data_pay);//添加到员工工资列表
						$this->success('添加成功');
					}
				}else{
					$this->error('添加失败');
				}
			}
			
		}else{
			$user = M('Qyusers')->where(array('id'=>$id))->find();
			$this->assign('user',$user);
			$this->display();
		}
	}
	
	/**
	 * 员工每月工资列表
	 */
	public function payList(){
		$id = $_GET['userid'];
		$list = M('Crmpay')->where(array('user_id'=>$_SESSION['user_id'],'uid'=>$id))->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	/**
	 * 员工工资详情
	 */
	public function payInfo(){
		$id = $_GET['id'];
		$info = M('Crmpayinfo')->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$this->display();
	}
/*******绩效管理*******/	
	/**
	 * 配置KPI指标项目
	 */
	public function kpiConf(){
		if(IS_POST){
			$data = $_POST;
		}
	}
/*******评分管理*******/
	/**
	 * 配置分类
	 */
	public  function classify(){
		if(IS_POST){
			$data['name'] = $_POST['name'];
			$data['user_id'] = $_SESSION['user_id'];
			$result = M('Crmclassify')->add($data);
			if($result){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
			$user_id = $_SESSION['user_id'];
			$data = M('Crmclassify')->where(array('user_id'=>$user_id))->select();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	
	/**
	 * 配置评分项目
	 */
	public function scorConf(){
		if(IS_POST){
			$data['user_id'] = $_SESSION['user_id'];
			$data['name'] = $_POST['name'];
			$data['scor'] = $_POST['scor'];
			$data['class_id'] = $_POST['class_id'];
			$result = M('Crmitem')->add($data);
			if($result){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
			$class = M('Crmclassify')->where(array('user_id'=>$user_id))->select();
			$this->assign('class',$class);
			$this->display();
		}	
	}
	/**
	 * 管理员计分
	 */
	public function scor(){
		if(IS_POST){
			
		}
	}
	
	/**
	 * 团队列表
	 */
	public function team(){
		$list = M('Crmteam')->where(array('user_id'=>$_SESSION['user_id']))->select();
		
		$this->assign('list',$list);
		$this->display();
	}
	
	/**
	 * 团队成员列表
	 */
	public function teamUser(){
		$id = $_GET['id'];
		$users = M('Qyusers')->where(array('team_id'=>$id))->select();
		$this->assign('user',$users);
		$this->display();
	}
	
	/**
	 * 计分配置PK时间等。。。
	 */
	public function conf(){
		if(IS_POST){
			$data['user_id'] = $_SESSION['user_id'];
			$data['pktime'] = strtotime($_POST['pktime']);
			$result = M('Crmconf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($result){
				if(M('Crmconf')->save($data)){
					$this->success('修改成功');
				}else{
					$this->error('修改失败');
				}
			}else{
				if(M('Crmconf')->add($data)){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}else{
			$result = M('Crmconf')->where(array('user_id'=>$_SESSION['user_id']))->find();
			
		}
	}
}