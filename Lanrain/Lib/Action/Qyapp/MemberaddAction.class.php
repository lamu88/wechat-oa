<?php
/*
*管理成员
*
*/
class MemberaddAction extends Action {

    /**
	* ecshop代理商的用户增加
	**/
    public function agentAdd(){
			if(IS_POST){
			    //F('qrrrqqq',$_POST);exit;
			    if(!$result = M('Qyusers')->where(array('mobile'=>$_POST['tel']))->find()){
					$dname=trim($_POST['departname']);//部门
					$res = M('Department')->where(array('name'=>$dname))->field('wxid')->find();
					$department=$res['wxid'];
					$user_id = M('qytoken')->where(array('username'=>$_POST['username']))->find();
					//判断
						$appinfo=M('Qymyapp')->where(array('userid'=>$user_id['id'],'status'=>1,'type'=>2))->find();
						if($appinfo){
							$user['corpid']='';
							$user['corpsecret']='';
						}
					$access_token=$this->access_token($user_id['corpid'],$user_id['corpsecret'],$appinfo["appid"]);
					$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
					$data='{
						   "userid": "'.$_POST['user_id'].'", 
						   "name": "'.$_POST['user_name'].'",
						   "department": ['.$department.'],
						   "position": "",
						   "mobile": "'.$_POST['tel'].'",
						   "gender": 1,
						   "tel": "",
						   "email": "'.$_POST['email'].'",
						   "weixinid": "",
						   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
							}';
					$post=$this->api_notice_increment($url_creat,$data);
					$departList=json_decode($post,true);
					if($departList['errmsg']=='created'){
						$user=$this->memberInfo_get($_POST['userid'],$user_id['id']);//$_POST['userid']为成员唯一标识（手动填写）
						if($user){
						
						    $info = array();
							$info['user_id'] = $user_id['id'];
							$info['uid'] = $user['id'];
							$info['name'] = $user['name'];
							$info['parent_id'] = $_POST['departid'];
							$info['mobie'] = $_POST['tel'];	
							$info['wxid'] = $_POST['wxid'];	
							$info['email'] = $_POST['email'];							
						    M('Disturb_users')->add($info);
						    echo 1;
						}else{
						
						}
						
					}else{
						$users = M('Qyusers')->where(array('userid'=>$_POST['userid'],'user_id'=>$user_id['id']))->find();
						if($users){
							echo 2;
						}else{
							echo 3;
						}
						
					}				
				}
			}

		
	}

	//创建成员
    public function memberAdd(){
			$ids=explode(',',$_POST['departid']);//部门id
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$department=implode(", ",$wxarr);
			$user_id = M('qytoken')->where(array('username'=>$_POST['username']))->find();
			//$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			//判断
				$appinfo=M('Qymyapp')->where(array('userid'=>$user_id['id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
			$access_token=$this->access_token($user_id['corpid'],$user_id['corpsecret'],$appinfo["appid"]);
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
			$data='{
				   "userid": "'.$_POST['userid'].'", 
				   "name": "'.$_POST['name'].'",
				   "department": ['.$department.'],
				   "position": "'.$_POST['position'].'",
				   "mobile": "'.$_POST['mobile'].'",
				   "gender": 1,
				   "tel": "'.$_POST['tel'].'",
				   "email": "'.$_POST['email'].'",
				   "weixinid": "'.$_POST['weixinid'].'",
				   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
					}';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			if($departList['errmsg']=='created'){
				$user=$this->memberInfo_get($_POST['userid'],$user_id['id']);//$_POST['userid']为成员唯一标识（手动填写）
				echo 1;
			}else{
				$users = M('Qyusers')->where(array('userid'=>$_POST['userid'],'user_id'=>$user_id['id']))->find();
				if($users){
					echo 2;
				}else{
					echo 3;
				}
				
			}
		
	}	
	

	//获取成员详细信息用来调用 
	function memberInfo_get($id,$user_id=''){
		$where['userid']=$id;
		if($user_id)  $where['user_id']=$user_id;
		$chick=M('Qyusers')->where($where)->find();
		if($chick){
			$memberinfo=json_encode($chick);
		}else{
			$user=M('qytoken')->where(array('id'=>$user_id))->find();
			//$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			//判断
			$appinfo=M('Qymyapp')->where(array('userid'=>$user_id,'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"]);
			
			
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$id;
			$memberinfo=$this->curlGet($url_get);
			$info=json_decode($memberinfo,true);
			$name=$this->save_pic($info['avatar']);
			foreach($info['department'] as $k=>$v){
				$str.=$v.';';
			}
			$info['pid']=';'.$str;
			$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
			$info['avatar']=$info['pic'];
			$info['user_id']=$user_id;
			$memberinfo=json_encode($info);
			if(!$user_id) $info['user_id']=$user_id;
			if($info['userid']){
				$id=M('Qyusers')->add($info);
			}
		}
		return $memberinfo;	
	}
	//save the pic
	
	function save_pic($url){
		$timeout=60;
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$temp = curl_exec($ch);
			$status=curl_getinfo($ch);
			$name='icon/'.$this->getToken(8).time().'.jpg';
			if(@file_put_contents($name, $temp) && !curl_error($ch)) {
				return $name;
			}
	}
	//token
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
		$re=json_decode($this->api_notice_increment($url,$p),true);
		return $re;
	}
	
	
	
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
	
	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{			
			return $tmpInfo;
			$js=json_decode($tmpInfo,1);
			return $js['ticket'];
		}
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
	
	function getToken($length){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];
		}
		return $str;
	}
}