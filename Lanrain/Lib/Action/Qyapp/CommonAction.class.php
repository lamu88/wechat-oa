<?php
/**
*公共使用库类
**/
class CommonAction extends Action{
    
	/**
	*部门选择
	**/
	

	public function getTree($data,$pid){
	    $tree = '';
		foreach($data as $k=>$v){
		    if($v['pid'] == $pid){
			    $v['text'] = $v['name'];
			    $v['children'] = $this->getTree($data,$v['id']);
				$tree[] = $v;
			}
		}
		return $tree;
	}
	
	/**
	*自动完成
	**/
	public function searchUsers(){
		if(IS_POST){
			$users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id']))->select();
			if($users){
				foreach($users as $k=>$v){
					$info[$k]['value'] = $v['userid'].'('.$v['name'].')';
					$info[$k]['label'] = $v['userid'].'('.$v['name'].')';
					$info[$k]['name'] = $v['name'];
					$info[$k]['image'] = $v['pic'];				
				}
			}
			$arr = array('status'=>1,'data'=>$info);
			$result = json_encode($arr);
			echo $result;		
		}
	}

	public function address(){		
			$type = $_GET['type'];
			$map['user_id']=$_SESSION['user_id'];
			$data=M('Qyusers')->where($map)->order('pinyin asc')->field('name,id,pic,userid,pinyin')->select();
			foreach($data as $k=>$v){
				switch ($v['pinyin'])
				{
					case 'a':
					  $lists[0]['letter'] = 'a';
					  $lists[0]['data'][] = $v;
					  break;
					case 'b':
					  $lists[1]['letter'] = 'b';
					  $lists[1]['data'][] = $v;			  
					  break;
					case 'c':
					  $lists[2]['letter'] = 'c';			
					  $lists[2]['data'][] = $v;
					  break;
					case 'd':
					  $lists[3]['letter'] = 'd';			
					  $lists[3]['data'][] = $v;
					  break;
					case 'e':
					  $lists[4]['letter'] = 'e';			
					  $lists[4]['data'][] = $v;
					  break;
					case 'f':
					  $lists[5]['letter'] = 'f';			
					  $lists[5]['data'][] = $v;
					  break;
					case 'g':
					  $lists[6]['letter'] = 'g';			
					  $lists[6]['data'][] = $v;
					  break;
					case 'h':
					  $lists[7]['letter'] = 'h';			
					  $lists[7]['data'][] = $v;
					  break;
					case 'i':
					  $lists[8]['letter'] = 'i';			
					  $lists[8]['data'][] = $v;
					  break;
					case 'j':
					  $lists[9]['letter'] = 'j';			
					  $lists[9]['data'][] = $v;
					  break;
					case 'k':
					  $lists[10]['letter'] = 'k';
					  $lists[10]['data'][] = $v;
					  break;
					case 'l':
					  $lists[11]['letter'] = 'l';
					  $lists[11]['data'][] = $v;
					  break;
					case 'm':
					  $lists[12]['letter'] = 'm';
					  $lists[12]['data'][] = $v;
					  break;
					case 'n':
					  $lists[13]['letter'] = 'n';
					  $lists[13]['data'][] = $v;
					  break;
					case 'o':
					  $lists[14]['letter'] = 'o';
					  $lists[14]['data'][] = $v;
					  break;
					case 'p':
					  $lists[15]['letter'] = 'p';
					  $lists[15]['data'][] = $v;
					  break;
					case 'b':
					  $lists[16]['letter'] = 'b';
					  $lists[16]['data'][] = $v;
					  break;
					case 'q':
					  $lists[17]['letter'] = 'q';
					  $lists[17]['data'][] = $v;
					  break;
					case 'r':
					  $lists[18]['letter'] = 'r';
					  $lists[18]['data'][] = $v;
					  break;
					case 's':
					  $lists[19]['letter'] = 's';
					  $lists[19]['data'][] = $v;
					  break;
					case 't':
					  $lists[20]['letter'] = 't';
					  $lists[20]['data'][] = $v;
					  break;
					case 'u':
					  $lists[21]['letter'] = 'u';
					  $lists[21]['data'][] = $v;
					  break;
					case 'v':
					  $lists[22]['letter'] = 'v';
					  $lists[22]['data'][] = $v;
					  break;
					case 'w':
					  $lists[23]['letter'] = 'w';
					  $lists[23]['data'][] = $v;
					  break;
					case 'x':
					  $lists[24]['letter'] = 'x';
					  $lists[24]['data'][] = $v;
					  break;
					case 'y':
					  $lists[25]['letter'] = 'y';
					  $lists[25]['data'][] = $v;
					  break;
					case 'z':
					  $lists[26]['letter'] = 'z';
					  $lists[26]['data'][] = $v;
					  break;			  
					/* default:
					  $users[27]['letter'] = 'az';
					  $users[27]['az'][] = $v; */
				}		
				
			}	
            $this->assign('lists',$lists);	
			$users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>array('like'=>'%;'.$dept['wxid'].';%')))->select();
			$this->assign('users',$users);	
			$pid = 0;				
			$this->assign('pid',$pid);
			$dept = M('department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>0))->find();
			//print_r($dept);exit;
			if($dept){
				$sub = M('department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>$dept['wxid']))->select();
				$this->assign('sub',$sub);				
			}
			//print_r($dept);exit;
			$this->assign('dept',$dept);
			$this->assign('selected',$_GET['selected']);			
			$this->assign('sign',$_GET['sign']);			
			$this->display('address_'.$type);			
	}	

	public function sub_1(){
		$sub = M('department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>$_GET['id']))->select();
		$this->assign('sub',$sub);		
		$users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>array('like','%;'.$_GET['id'].';%')))->select();
		$this->assign('users',$users);			 
		$pid = $_GET['id'];				
		$this->assign('pid',$pid);
		$this->display();
	}
	
	public function sub_2(){
		$sub = M('department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>$_GET['id']))->select();
		$this->assign('sub',$sub);		
		$users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>array('like','%;'.$_GET['id'].';%')))->select();
		$this->assign('users',$users);			 
		$pid = $_GET['id'];				
		$this->assign('pid',$pid);
		$this->display();
	}	
	
	public function wap_address(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}	
		$type = $_GET['type'];
		$map['user_id']=$app['userid'];
		$data=M('Qyusers')->where($map)->order('pinyin asc')->field('name,id,pic,userid,pinyin')->select();
		//dump($data);exit;
		foreach($data as $k=>$v){
			switch ($v['pinyin'])
			{
				case 'a':
				  $lists[0]['letter'] = 'a';
				  $lists[0]['data'][] = $v;
				  break;
				case 'b':
				  $lists[1]['letter'] = 'b';
				  $lists[1]['data'][] = $v;			  
				  break;
				case 'c':
				  $lists[2]['letter'] = 'c';			
				  $lists[2]['data'][] = $v;
				  break;
				case 'd':
				  $lists[3]['letter'] = 'd';			
				  $lists[3]['data'][] = $v;
				  break;
				case 'e':
				  $lists[4]['letter'] = 'e';			
				  $lists[4]['data'][] = $v;
				  break;
				case 'f':
				  $lists[5]['letter'] = 'f';			
				  $lists[5]['data'][] = $v;
				  break;
				case 'g':
				  $lists[6]['letter'] = 'g';			
				  $lists[6]['data'][] = $v;
				  break;
				case 'h':
				  $lists[7]['letter'] = 'h';			
				  $lists[7]['data'][] = $v;
				  break;
				case 'i':
				  $lists[8]['letter'] = 'i';			
				  $lists[8]['data'][] = $v;
				  break;
				case 'j':
				  $lists[9]['letter'] = 'j';			
				  $lists[9]['data'][] = $v;
				  break;
				case 'k':
				  $lists[10]['letter'] = 'k';
				  $lists[10]['data'][] = $v;
				  break;
				case 'l':
				  $lists[11]['letter'] = 'l';
				  $lists[11]['data'][] = $v;
				  break;
				case 'm':
				  $lists[12]['letter'] = 'm';
				  $lists[12]['data'][] = $v;
				  break;
				case 'n':
				  $lists[13]['letter'] = 'n';
				  $lists[13]['data'][] = $v;
				  break;
				case 'o':
				  $lists[14]['letter'] = 'o';
				  $lists[14]['data'][] = $v;
				  break;
				case 'p':
				  $lists[15]['letter'] = 'p';
				  $lists[15]['data'][] = $v;
				  break;
				case 'b':
				  $lists[16]['letter'] = 'b';
				  $lists[16]['data'][] = $v;
				  break;
				case 'q':
				  $lists[17]['letter'] = 'q';
				  $lists[17]['data'][] = $v;
				  break;
				case 'r':
				  $lists[18]['letter'] = 'r';
				  $lists[18]['data'][] = $v;
				  break;
				case 's':
				  $lists[19]['letter'] = 's';
				  $lists[19]['data'][] = $v;
				  break;
				case 't':
				  $lists[20]['letter'] = 't';
				  $lists[20]['data'][] = $v;
				  break;
				case 'u':
				  $lists[21]['letter'] = 'u';
				  $lists[21]['data'][] = $v;
				  break;
				case 'v':
				  $lists[22]['letter'] = 'v';
				  $lists[22]['data'][] = $v;
				  break;
				case 'w':
				  $lists[23]['letter'] = 'w';
				  $lists[23]['data'][] = $v;
				  break;
				case 'x':
				  $lists[24]['letter'] = 'x';
				  $lists[24]['data'][] = $v;
				  break;
				case 'y':
				  $lists[25]['letter'] = 'y';
				  $lists[25]['data'][] = $v;
				  break;
				case 'z':
				  $lists[26]['letter'] = 'z';
				  $lists[26]['data'][] = $v;
				  break;			  
				/* default:
				  $users[27]['letter'] = 'az';
				  $users[27]['az'][] = $v; */
			}		
			
		}	
		//print_r($lists);exit;
		$this->assign('lists',$lists);	
		$users = M('Qyusers')->where(array('user_id'=>$app['userid'],'pid'=>array('like'=>'%;'.$dept['wxid'].';%')))->select();
		$this->assign('users',$users);	
		$pid = 0;				
		$this->assign('pid',$pid);
		$dept = M('department')->where(array('user_id'=>$app['userid'],'pid'=>0))->find();
		if($dept){
			$sub = M('department')->where(array('user_id'=>$app['userid'],'pid'=>$dept['id']))->select();
			$this->assign('sub',$sub);				
		}
		$this->assign('dept',$dept);
		$this->assign('selected',$_GET['selected']);			
		$this->assign('sign',$_GET['sign']);			
		$this->display('wap_address_'.$type);			
	}

	public function wap_sub_1(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		$sub = M('department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->select();
		$this->assign('sub',$sub);		
		$users = M('Qyusers')->where(array('user_id'=>$app['userid'],'pid'=>array('like','%;'.$_GET['id'].';%')))->select();
		$this->assign('users',$users);			 
		$pid = $_GET['id'];				
		$this->assign('pid',$pid);
		$this->display();
	}
	
	public function wap_sub_2(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
		$sub = M('department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->select();
		$this->assign('sub',$sub);		
		$users = M('Qyusers')->where(array('user_id'=>$app['userid'],'pid'=>array('like','%;'.$_GET['id'].';%')))->select();
		$this->assign('users',$users);			 
		$pid = $_GET['id'];				
		$this->assign('pid',$pid);
		$this->display();
	}	
	/**
	*检查是否存在
	**/
	public function isExist(){
		if(IS_POST){
		    //$_POST['userid'];
			if(strpos(trim($_POST['auditname']),'(') !== false){
				$auditname = substr(trim($_POST['auditname']),0,strpos(trim($_POST['auditname']),'('));
				//trim($_POST['auditname']);
				$users = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$auditname,'status'=>1))->find();
				if($users){
					echo json_encode(array('status'=>1));
				}else{
					echo json_encode(array('status'=>0));			
				}			
			}else{
				echo json_encode(array('status'=>0));				
			}			
		}
	}
	public function app($token){
		if(S('app'.$token)){
			$app=S('app'.$token);
		}else{
			$app=M('qymyapp')->where(array('token'=>$token))->find();
			S('app'.$token,$app);
		}
		return $app;
	}
	public function user($wecha_id,$userid){
		if(S('user'.$wecha_id)){
			$user=S('user'.$wecha_id);
		}else{
			$user=M('Qyusers')->where(array('userid'=>$wecha_id,'user_id'=>$userid))->find();
			S('user'.$wecha_id,$user,3600);
		}
		return $user;
	}
	public function oauth(){
		if($_COOKIE[$app['userid']]){
			$_GET['wecha_id'] = str_replace('wy_','',cookie('wecha_id'));
		}else{
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$Oauth=A('Qyapp/Oauth');
			$Oauth->wap_oauth($user['corpid'],$_GET['token'],'Task','wap_index',$_GET);
			
		}
		cookie($app['userid'],'wy_'.$_GET['wecha_id'],86400);
		
	}
	public function access_token($api,$secret,$agentid,$userid){
		if($api&&secret){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
			$json=json_decode($this->curlGet($url_get), true);
		}else{
			if($userid){
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$userid))->field('appid,userid')->find();
			}else{
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->field('appid,userid')->find();
			}
			$json=$this->access_token_get($appinfo['appid'],$appinfo['userid']);
		}
		return $json;
	}
	
	//获取组件安装后的access_token
	public function access_token_get($agentid,$user_id){  
		$suite_access_token=$this->suite_access_token($agentid,$user_id);
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_corp_token?suite_access_token='.$suite_access_token['suite_access_token'];
		$data=M('Qymyapp')->where(array('userid'=>$user_id,'appid'=>$agentid))->find();
		$user=M('Qytoken')->where(array('id'=>$user_id))->find();
		$info['suite_id']=$data['suit_id'];
		$info['auth_corpid']=$user['th_corpid'];
		$info['permanent_code']=$user['permanent_code'];
		$re=json_decode($this->https_request($url,json_encode($info)),true);
		return $re;
	}
	
	public function suite_access_token($agentid,$user_id){
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_suite_token';
		$app=M('Qymyapp')->where(array('userid'=>$user_id,'appid'=>$agentid))->field('suit_id')->find();
		$data=M('Suiteid')->where(array('suiteid'=>$app['suit_id']))->find();
		$info['suite_id']=$data['suiteid'];
		$info['suite_secret']=$data['su_secret'];
		$info['suite_ticket']=$data['suiteticket'];
		$p=json_encode($info);
		$re=json_decode($this->https_request($url,$p),true);
		return $re;
	}
	
	
	function https_request($url, $data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	function curlGet($url){
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data=curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}