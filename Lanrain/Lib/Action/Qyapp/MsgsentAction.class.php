<?php
/*
*企业邮箱
*
*/
class MsgsentAction extends Action {
	/* public function _initialize() {
		if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	} */
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
	public function sent(){
		$user_id=1;
		//微信考勤提醒
		$map['date']=array('neq',date('Ymd'));
		$attendance=M('Qyattendance')->where($map)->select();
		foreach($attendance as $ke=>$va){
			$conf=M('Qyattendance_conf')->where(array('user_id'=>$va['user_id']))->find();
			$va['depart']=str_replace('-','',$va['depart']);
			$worktime=strtotime(date('Y-m-d').' '.$va['w_start']);
			$lefttime=strtotime(date('Y-m-d').' '.$va['w_stop']);
			if($va['work_type']==1){
				if(time()<=$worktime+$conf['mor_o_time']){
					//上班
					if(($worktime-$conf['mor_o_time'])<=time()){
						$data['title']=$conf['mor_o_content'];
						$data['depart']=$va['depart'];
						//echo 'werwer';
						//$action='wap_index';
						$this->sent_ac($va['user_id'],'Attendance',$data,'wap_index');
						M('Qyattendance')->where(array('id'=>$va['id']))->save(array('date',date('Ymd')));
					}
				}else{
					//下班
					if(($lefttime-$conf['mor_o_time'])<=time()){
						//
						$data['title']=$conf['aft_o_content'];
						$data['depart']=$va['depart'];
						$this->sent_ac($va['user_id'],'Attendance',$data,'wap_out');
						M('Qyattendance')->where(array('id'=>$va['id']))->save(array('date'=>date('Ymd')));
					}
				}
			}else{
				//下班
				
				$maps['conf_id']=$va['id'];
				$maps['conf_type']=2;
				$maps['user_id']=$va['user_id'];
				$maps['dates']=array('neq',date('Ymd'));
				$users=M('Qyattendance_record')->where($maps)->select();
				foreach($users as $u=>$ui){
					$cc=(time()-$ui['creatime'])-($va['work_t_houer']*3600+$va['work_t_minute']*60);
					// echo $cc;
					if($cc>=0){
						// $bb=(time()-$ui['creatime'])-($va['long_houer']*3600+$va['long_minute']*60);
						// if($bb>=0){
						// }
						$data['title']=$conf['aft_t_content'];
						$data['touser']=$ui['name'];
						$sss=$this->sent_user($va['user_id'],'Attendance',$data,'wap_out');
						if($sss['errcode']==0){
							M('Qyattendance_record')->where(array('id'=>$ui['id']))->save(array('dates'=>date('Ymd')));
							echo "发送成功";
						}
					}
				}
			}
			
		}
	}
	
	
	//投票定时任务
	public function vote_sent(){
		
		
	
	
	
	
	}
	
	
	public function sent_ac($userid,$module,$data,$action='wap_index'){
		$app=M('qymyapp')->where(array('user_id'=>$userid,'module'=>$module))->field('appid,token')->find();
		$Msg=A('Qyapp/Msg');
		$inin['title']=$data['title'];
		$inin['description']=$data['title'].'时间:'.date("Y-m-d h:i");
		$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m='.$module.'&a='.$action.'&token='.$app['token'].'&pid='.$data['id'];
		$inin["agentid"]=$app['appid'];
		$inin['toparty']=$data['depart'];
		$msc=$Msg->msg_send_depart($inin,$userid);
		return $msc;
	}
	
	
	public function sent_user($userid,$module,$data,$action='wap_index'){
		$app=M('qymyapp')->where(array('user_id'=>$userid,'module'=>$module))->field('appid,token')->find();
		$Msg=A('Qyapp/Msg');
		$inin['title']=$data['title'];
		$inin['description']=$data['title'].'时间:'.date("Y-m-d H:i");
		$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m='.$module.'&a='.$action.'&token='.$app['token'].'&pid='.$data['id'];
		$inin["agentid"]=$app['appid'];
		$inin['touser']=$data['touser'];
		$msc=$Msg->msg_send_all($inin,$userid);
		return $msc;
	}
	
	
}