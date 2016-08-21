<?php
/**
*悬赏招聘
**/
class HiringAction extends Action{
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
*首页
**/
public function conf(){
    $this->check();
    $count1      = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id']))->count();  //所有职位
    $count2      = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->count();  //发布中	
	$count3      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id']))->count();  //所有简历
	$count4      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'is_read'=>0))->count();  //未读简历
	$count5      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'is_employed'=>1))->count();  //成功录用
    $sum1      = M('qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id']))->sum('money');  //提现总额
	$sum2      = M('qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->sum('money');  //兑现总额
	$count6     = M('qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id'],'status'=>0))->count();  //待审核提现
	
	//悬赏金额计算
	//悬赏总额
	$allSum=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id']))->sum('money');
	$this->assign('allSum',$allSum);
	
	
	
	
	//分享
	$shareSum=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>2))->sum('money');
	$this->assign('shareSum',$shareSum);
	$sharecount=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>2))->count();
	$this->assign('sharecount',$sharecount);
	//简历投递
	$getSum=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>1))->sum('money');
	$this->assign('getSum',$getSum);
	$getcount=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>1))->count();
	$this->assign('getcount',$getcount);
	//成功录用
	$successSum=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>3))->sum('money');
	$this->assign('successSum',$successSum);
	$successcount=M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'type'=>3))->count();
	$this->assign('successcount',$successcount);
	$res = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
	$leftsum=$res['reward_sum']-$allSum;
	if($leftsum>0) 	$this->assign('leftsum',$leftsum);
	$this->assign('res',$res);	
	$this->assign('count1',$count1);
	$this->assign('count2',$count2);
	$this->assign('count3',$count3);
	$this->assign('count4',$count4);
	$this->assign('count5',$count5);
	$this->assign('count6',$count6);
	$this->assign('sum1',$sum1);
	$this->assign('sum2',$sum2);	
	$this->display('conf');
}
/**
*增加悬赏总金额
**/
public function addMoney(){
    $this->check();
        if(IS_POST){
			$res = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($res){
				if($res['reward_sum']){
					$data['reward_sum'] = $res['reward_sum']+$_POST['addmoney'];				
				}else{
					$data['reward_sum'] = $_POST['addmoney'];
				}
				$id = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->save($data); 				
			}else{
				$data['reward_sum'] = $_POST['addmoney'];
				$data['user_id'] = $_SESSION['user_id']; 					
				$id = M('qyhiring_default')->add($data);				
			}
			if($id){
				$this->success('增加成功',U('Hiring/conf',array('mid'=>$_GET['mid'])));			
			}else{
				$this->error('增加失败');
			}			
			
		}

}
/**
*提现的最低金额
**/	
public function upMoney(){  
    $this->check();
    if(IS_POST){
			$res = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($res){
				if($res['withdrawal_sum']){
					$data['withdrawal_sum'] = $res['withdrawal_sum']+$_POST['updatemoney'];				
				}else{
					$data['withdrawal_sum'] = $_POST['updatemoney'];
				}		
				$id = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->save($data); 				
			}else{
				$data['withdrawal_sum'] = $_POST['updatemoney'];
				$data['user_id'] = $_SESSION['user_id']; 					
				$id = M('qyhiring_default')->add($data);				
			}
			
			if($id){
				$this->success('调整成功',U('Hiring/conf',array('mid'=>$_GET['mid'])));			
			}else{
				$this->error('调整失败');
			}	
	}    
}
/**
*职位管理
**/	
public function position(){
    $this->check();
    $status = $_GET['status'];
	if(isset($status)){
		$count      = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_position')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
	    $this->assign('status',$status);		
	}else{
		$count      = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_position')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}
	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();	
}
/**
*职业信息
**/	
public function positionInfo(){
    $this->check();
    $id = $this->_get('id');
    $data = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
	$this->assign('data',$data);
	$this->display();
} 
/**
*发布职位
**/
public function addPosition(){
    $this->check();
    if(IS_POST){ 
		$data = array();
		$data = $_POST;
		$data['end_time'] = strtotime($_POST['end_time']);
		$data['create_time'] = time();
		$data['user_id'] = $_SESSION['user_id']; 		
		$data['status'] = 1;		
		$data['defaultemail'] = serialize($_POST['defaultemail']);
		$data['defaultreward'] = serialize($_POST['defaultreward']);
		$fill['status'] = $_POST['defaultfill']['status'];
		$fill['default'] = $_POST['defaultfill']['default'];
		$fill['add'] = $_POST['defaultfill']['add'];
		$data['defaultfill'] = serialize($fill);		
		$id = M('qyhiring_position')->add($data);
		if($id){
			$res = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if($res){
				if($_POST['defaultemail']['status'] == 'on'){			
				    $default['defaultemail'] = $data['defaultemail'];				
				}
				if($_POST['defaultreward']['status'] == 'on'){				
				    $default['defaultreward'] = $data['defaultreward'];				
				}
				if($_POST['defaultfill']['status'] == 'on'){				
				    $default['defaultfill'] = $data['defaultfill'];				
				}				
				$result1 = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->save($default);
				if($result1){
			        $this->success('添加成功',U('Hiring/position',array('mid'=>$_GET['mid'])));				
				}else{
		            $this->error('添加失败');					
				}
			}else{
				$default['user_id'] = $_SESSION['user_id'];	
				if($_POST['defaultemail']['status'] == 'on'){
				    $default['defaultemail'] = $data['defaultemail'];				
				}
				if($_POST['defaultreward']['status'] == 'on'){
				    $default['defaultreward'] = $data['defaultreward'];				
				}
				if($_POST['defaultfill']['status'] == 'on'){
				    $default['defaultfill'] = $data['defaultfill'];				
				}				
                $result2 = M('qyhiring_default')->add($default);	
				if($result2){
			        $this->success('添加成功',U('Hiring/position',array('mid'=>$_GET['mid'])));				
				}else{
		            $this->error('添加失败');					
				}				
			}			
		}else{
		    $this->error('添加失败');	 	
		}
		
	}else{
		$data = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
		$defaultemail = unserialize($data['defaultemail']);
		$email_status = $defaultemail['status'];
		$email_value = $defaultemail['value'];	
		$defaultreward = unserialize($data['defaultreward']);
		$reward_status = $defaultreward['status'];
		$reward_value = $defaultreward['value'];	
		$defaultfill = unserialize($data['defaultfill']);
		$fill_status = $defaultfill['status'];
		$fill_default = $defaultfill['default'];
		$fill_add = $defaultfill['add'];	
		$this->assign('email_status',$email_status);
		$this->assign('email_value',$email_value);
		$this->assign('reward_status',$reward_status);
		$this->assign('reward_value',$reward_value);
		$this->assign('fill_status',$fill_status);
		$this->assign('fill_default',$fill_default); 
		$this->assign('fill_defaults',$fill_default);	
		$this->assign('fill_add',json_encode($fill_add));	
		$this->display();
	}
}

/**
*修改职位
**/
public function editPosition(){
    $this->check();
    if(IS_POST){
		$data = array();
		$data = $_POST;
		$data['end_time'] = strtotime($_POST['end_time']);
		$data['create_time'] = time();
		$data['user_id'] = $_SESSION['user_id']; 		
		$data['status'] = 1;		
		$data['defaultemail'] = serialize($_POST['defaultemail']);
		$data['defaultreward'] = serialize($_POST['defaultreward']);
		$fill['status'] = $_POST['defaultfill']['status'];
		$fill['default'] = $_POST['defaultfill']['default'];
		$fill['add'] = $_POST['defaultfill']['add'];
		$data['defaultfill'] = serialize($fill);		
		$id = M('qyhiring_position')->where(array('id'=>$_POST['id']))->save($data);
		if($id){
			$res = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if($res){
				if($_POST['defaultemail']['status'] == 'on'){
				    $default['defaultemail'] = $data['defaultemail'];				
				}
				if($_POST['defaultreward']['status'] == 'on'){
				    $default['defaultreward'] = $data['defaultreward'];				
				}
				if($_POST['defaultfill']['status'] == 'on'){
				    $default['defaultfill'] = $data['defaultfill'];				
				}				
				$result = M('qyhiring_default')->where(array('user_id'=>$_SESSION['user_id']))->save($default);
				if($result){
			        $this->success('修改成功',U('Hiring/position',array('mid'=>$_GET['mid'])));				
				}else{
		            $this->error('修改失败');					
				}
			}else{
				$default['user_id'] = $_SESSION['user_id'];	
				if($_POST['defaultemail']['status'] == 'on'){
				    $default['defaultemail'] = $data['defaultemail'];				
				}
				if($_POST['defaultreward']['status'] == 'on'){
				    $default['defaultreward'] = $data['defaultreward'];				
				}
				if($_POST['defaultfill']['status'] == 'on'){
				    $default['defaultfill'] = $data['defaultfill'];				
				}				
                $result = M('qyhiring_default')->add($default);	
				if($result){
			        $this->success('修改成功',U('Hiring/position',array('mid'=>$_GET['mid'])));				
				}else{
		            $this->error('修改失败');					
				}				
			}				
		}else{
		    $this->error('修改失败');	 	
		}		
	}else{
		$id = $this->_get('id');   
		$data = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
		$defaultemail = unserialize($data['defaultemail']);
		$email_status = $defaultemail['status'];
		$email_value = $defaultemail['value'];	
		$defaultreward = unserialize($data['defaultreward']);
		$reward_status = $defaultreward['status'];
		$reward_value = $defaultreward['value'];	
		$defaultfill = unserialize($data['defaultfill']);
		$fill_status = $defaultfill['status'];
		$fill_default = $defaultfill['default'];
		$fill_add = $defaultfill['add'];	
		$this->assign('data',$data);	
		$this->assign('email_status',$email_status);
		$this->assign('email_value',$email_value);
		$this->assign('reward_status',$reward_status);
		$this->assign('reward_value',$reward_value);
		$this->assign('fill_status',$fill_status);
		$this->assign('fill_default',$fill_default); 
		$this->assign('fill_defaults',$fill_default);	
		$this->assign('fill_add',json_encode($fill_add));	
		$this->display();	
	}

}

/**
*删除
**/
public function delPosition(){
    $this->check();
	if(IS_POST){
		$data = M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
		if(M('qyhiring_position')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['id']))->delete()){
			echo json_encode(array('status'=>1));
		}
	
	}
}

/**
*简历管理
**/	
public function resume(){
    $this->check();
	if(isset($_GET['is_read'])){
		$count      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'is_read'=>$_GET['is_read']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_resume')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'is_read'=>$_GET['is_read']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show(); 
	    $status = 0;		
		$this->assign('is_read',$_GET['is_read']);
	}elseif(isset($_GET['is_collect'])){
		$count      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'is_collect'=>$_GET['is_collect']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_resume')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'is_collect'=>$_GET['is_collect']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
	    $status = 0;		
		$this->assign('is_collect',$_GET['is_collect']);		
	}elseif(isset($_GET['is_employed'])){
		$count      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'is_employed'=>$_GET['is_employed']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_resume')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'is_employed'=>$_GET['is_employed']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
	    $status = 0;		
		$this->assign('is_employed',$_GET['is_employed']);		
	}else{
		$count      = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_resume')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
	    $status = 1;				
	}
	$this->assign('status',$status);	
	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}
/**
*简历信息
**/	
public function resumeInfo(){
    $this->check();
    $id = $this->_get('id');
    $data = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
	if($data['is_read'] == 2){
	    M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->save(array('is_read'=>1));	
	}
	$this->assign('data',$data);
	$this->display();
}
/**
*收藏简历
**/
public function collectResume(){
    $this->check();
	if(IS_POST){
		$data = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
		if(M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['id']))->save(array('is_collect'=>1))){
			echo json_encode(array('status'=>1));
		}
	
	}
}
/**
*录用简历
**/
public function employedResume(){
    $this->check();
		if(IS_POST){
			$data = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
			if(M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['id']))->save(array('is_employed'=>$_POST['employed']))){
				//录用加奖励
				if($_POST['employed']==1){
					//加奖励
					$position=M('Qyhiring_position')->where(array('id'=>$data['pid']))->field('defaultreward')->find();
				
					$payinfo=unserialize($position['defaultreward']);
					if($payinfo['value']['employed']==0){  //随机
						$money=rand(0,$payinfo['value']['employedset']);
					}elseif($payinfo['value']['employed']==1){  //规定赏金
						$money=$payinfo['value']['employedset'];
					}else{  //无赏金
						$money=0;
					}
					
					$user=M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$data['wecha_id']))->find();
					$mid=M('Qyhiring_reward')->add(array(
						'user_id'=>$_SESSION['user_id'],
						'money'=>$money,
						'time'=>time(),
						'event'=>'录用悬赏',
						'name'=>$user['userid'],
						'telphone'=>$user['mobile'],
						'department'=>$user['pid'],
						'type'=>3,
						'wecha_id'=>$data['wecha_id']
					));
					
				}
				
				echo json_encode(array('status'=>1));
			}
		
	    }
}
/**
*删除简历
**/
public function delResume(){
    $this->check();
		if(IS_POST){
			$data = M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
			if(M('qyhiring_resume')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}
		
	    }
}
/**
*赏金管理
**/	
public function reward(){
    $this->check();
    $status = $_GET['status'];
	//echo $status;exit;
	if($status){
		$count      = M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_reward')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}else{
		$count      = M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('qyhiring_reward')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}

	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}
/**
*赏金信息
**/	
public function rewardInfo(){
    $this->check();
    $id = $this->_get('id');
    $data = M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
	//print_r($data);
	$this->assign('data',$data);
	$this->display();
}

/*
*提现记录
*/
public function money_get(){
    $this->check();
	if($status){
		$count      = M('Qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->count();
		$Page       = new Page($count,15);
		$data = M('Qyhiring_pay')->order('id desc')->where(array('user_id'=>$_SESSION['user_id'],'status'=>$status))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}else{
		$count      = M('Qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('Qyhiring_pay')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
	}
	$this->assign('data',$data);
	$this->assign('page',$show);
	$this->display();
}

public function payInfo(){
    $this->check();	
	$payinfo=M('Qyhiring_pay')->where(array('id'=>$_GET['id']))->find();
	$this->assign('data',$payinfo);
	$this->display();



}

/**
*提现通过审核
**/
public function passpay(){
    $this->check();
		if(IS_POST){
			$data = M('Qyhiring_pay')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->save(array('status'=>1));
			if($data){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>1));
			}
	    }
}


/**
*删除简历
**/
public function delReward(){
    $this->check();
		if(IS_POST){
			$data = M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->find();
			if(M('qyhiring_reward')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}
		
	    }
}
/**
*企业信息
**/	
public function info(){
    $this->check();
	$where['user_id']=$_SESSION['user_id'];
	$company=M('Qycompany')->where($where)->find();
	$this->assign('infos',$company);
	$this->display();
}
public function basic_msg(){
    $this->check();
	if(IS_POST){
		$where['user_id']=$_SESSION['user_id'];
		$_POST['user_id']=$_SESSION['user_id'];
		$check=M('Qycompany')->where($where)->find();
		if($check){
			$info=M('Qycompany')->where($where)->save($_POST);
		}else{
			$info=M('Qycompany')->add($_POST);
		}
		 if($info){
			echo json_encode(array('status'=>0));
			exit;
		}else{
			echo json_encode(array('status'=>1));
			exit;
		 }
	}
}

public function desc(){
    $this->check();
	if(IS_POST){
		$where['user_id']=$_SESSION['user_id'];
		$_POST['user_id']=$_SESSION['user_id'];
		$check=M('Qycompany')->where($where)->find();
		if($check){
			$info=M('Qycompany')->where($where)->save($_POST);
		}else{
			$info=M('Qycompany')->add($_POST);
		}
		 if($info){
			echo json_encode(array('status'=>0));
			exit;
		}else{
			echo json_encode(array('status'=>1));
			exit;
		 }
	}
}



/**
*
**/
public function head(){
    $this->check();
	if(IS_POST){
		$where['id']=$_SESSION['user_id'];
		$check=M('Qycompany')->where($where)->find();
		if($check){
			$info=M('Qycompany')->where($where)->save(array('headpic'=>$_POST['imgurl']));
		}else{
			$info=M('Qycompany')->add(array('headpic'=>$_POST['imgurl'],'user_id'=>$_SESSION['user_id']));
		}
		 if($info){
			echo json_encode(array('status'=>0));
			exit;
		}else{
			echo json_encode(array('status'=>1));
			exit;
		 }
	
	}
}




/***********************************招聘手机端*************************************/
/**
*招聘首页
**/
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Hiring';
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
	
	$clicknum=M('Qyhiring_resume')->where(array('user_id'=>$app['userid']))->count();//总投递量
	$employednum=M('Qyhiring_resume')->where(array('user_id'=>$app['userid'],'is_employed'=>1))->count();//总录用量
	$hitsnum=M('Qyhiring_position')->where(array('user_id'=>$app['userid']))->sum('hits');//总点击量 加分享
	$positionnum=M('Qyhiring_position')->where(array('user_id'=>$app['userid']))->count();
	$this->assign('positionnum',$positionnum);
	$this->assign('employednum',$employednum);
	$this->assign('clicknum',$clicknum);
	$this->assign('hitsnum',$hitsnum);
	
	
	$list=M('Qyhiring_position')->where(array('user_id'=>$app['userid']))->order('id desc')->limit(25)->select();
	foreach($list as $k=>$v){
		$arr[$k]=$v;
		$arr[$k]['clicknum']=M('Qyhiring_resume')->where(array('user_id'=>$app['userid'],'pid'=>$v['id']))->count();
		$arr[$k]['employednum']=M('Qyhiring_resume')->where(array('user_id'=>$app['userid'],'pid'=>$v['id'],'is_employed'=>1))->count();
	}
	$this->assign('list',$arr);
	$this->display();
}
/**
*职位详情
**/
public function wap_positionInfo(){
	$position=M('Qyhiring_position')->where(array('id'=>$_GET['pid']))->find();
	$this->assign('info',$position);
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
	if($_GET['type']=='up'){
		//分享算点击量
		M('Qyhiring_position')->where(array('id'=>$_GET['pid']))->setInc('hits');
		//分享悬赏
		$payinfo=unserialize($position['defaultreward']);
		if($payinfo['value']['shares']==0){  //随机
			$money=rand(0,$payinfo['value']['shareset']);
		}elseif($payinfo['value']['shares']==1){  //规定赏金
			$money=$payinfo['value']['shareset'];
		}else{  //无赏金
			$money=0;
		}
		$user=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_POST['wecha_id']))->find();
		$mid=M('Qyhiring_reward')->add(array(
			'user_id'=>$app['userid'],
			'money'=>$money,
			'time'=>time(),
			'event'=>'分享悬赏',
			'name'=>$user['userid'],
			'telphone'=>$user['mobile'],
			'department'=>$user['pid'],
			'type'=>2,
			'wecha_id'=>$_POST['wecha_id']
		));
		$_SESSION[$_GET['wecha_id']]=1;//分享而来必须是填写
	}else{
		$_SESSION[$_GET['wecha_id']]='';
		if($app['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}else{
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		}
		//$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,')->find();
		//$data['corpid']=$user['corpid'];
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
	}
	$company=M('Qycompany')->where(array('user_id'=>$app['userid']))->find();
	//同地点的随机3个
	$list=M('Qyhiring_position')->where(array('user_id'=>$app['userid']))->limit(3)->select();
	$this->assign('list',$list);
	$this->assign('company',$company);
	$this->display();	
}

/**
*加赏
**/
public function wap_positionPost(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$_POST['user_id']=$app['userid'];
		$_POST['time']=time();
		$position=M('Qyhiring_position')->where(array('id'=>$_POST['pid']))->field('postname,defaultreward')->find();
		$_POST['position']=$position['postname'];
		$_POST['time']=time();
		$info=M('Qyhiring_resume')->add($_POST);
		 if($info){
			//给推荐者加赏金(收到简历悬赏)
			$payinfo=unserialize($position['defaultreward']);
			if($payinfo['value']['resume']==0){  //随机
				$money=rand(0,$payinfo['value']['resumeset']);
			}elseif($payinfo['value']['resume']==1){  //规定赏金
				$money=$payinfo['value']['resumeset'];
			}else{  //无赏金
				$money=0;
			}
			$user=M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_POST['wecha_id']))->find();
			$mid=M('Qyhiring_reward')->add(array(
				'user_id'=>$app['userid'],
				'money'=>$money,
				'time'=>time(),
				'event'=>'简历投递',
				'name'=>$user['userid'],
				'telphone'=>$user['mobile'],
				'department'=>$user['pid'],
				'type'=>1,
				'wecha_id'=>$_POST['wecha_id']
			));
			if($mid){
				echo json_encode(array('status'=>0));
				exit;
			}else{
				$info=M('Qyhiring_resume')->where(array('id'=>$info))->delete();
				echo json_encode(array('status'=>1));
				exit;
			}
		}else{
			echo json_encode(array('status'=>1));
			exit;
		 }
	}else{
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		$company=M('Qycompany')->where(array('user_id'=>$app['userid']))->find();
		$this->assign('company',$company);
		$this->display();
	}
	
	
}

//赏金管理
public function wap_money(){
	//我的红包
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Hiring';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data,'wap_money');
		exit();
	}
	
	
	$list=M('Qyhiring_reward')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']))->order('id desc')->limit(20)->select();
	$this->assign('list',$list);
	
	//未提现的
	$acount=M('Qyhiring_reward')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id'],'status'=>1))->sum('money');
	$this->assign('count',$acount);
	$this->display();

}
//提现金额
public function wap_savemoney(){
	//我的红包
	$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
	$_POST['time']=time();
	$_POST['user_id']=$app['userid'];
	$id=M('Qyhiring_pay')->add($_POST);
	if($id){
		$savelist=M('Qyhiring_reward')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_POST['wecha_id'],'status'=>1))->field('id')->select();
		foreach($savelist as $v){
			M('Qyhiring_reward')->where(array('id'=>$v['id']))->save(array('status'=>0));
		}
	}
	if($id){
		echo json_encode(array('status'=>0));
		exit;
	}else{
		M('Qyhiring_resume')->where(array('id'=>$id))->delete();
		echo json_encode(array('status'=>1));
		exit;
	}
}

//提现记录
public function wap_saverecord(){
	//我的红包
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$list=M('Qyhiring_pay')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']))->order('id desc')->limit(20)->select();
	//dump($list);
	$acount=M('Qyhiring_pay')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']))->sum('money');
	$this->assign('count',$acount);
	$this->assign('list',$list);
	$this->display();
	
}




}