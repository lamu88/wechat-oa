<?php
/*
*oauth2验证
*
*/
class OauthAction extends Action {
    /**
	* @param string $corpid  token表中存放的企业号corpid	
	* @param string $token   myapp表中的应用token,一般从$_GET中获取  
	* @param string $module  应用模块的英文名称，如任务协作为Task,企业邮箱为Email
	* @param string $action  Oauth验证后跳转的指定页面,默认值为wap_index,如为空,则跳转到该应用模块下默认的wap_index页面
	* @param array  $param   需要传递的参数，请用一维数组表示，可传递多个参数
	*/
    public function wap_oauth($corpid,$token,$module,$action='wap_index',$param){		
        $str = '';			
		if(!empty($param) && is_array($param)){	
			foreach($param as $key=>$val){
				$str.= '/'.$key.'/'.$val;
			}			    
		}
	    if(cookie('wecha_id')){
		    $_GET['wecha_id'] = str_replace('wx_','',cookie('wecha_id'));
			$this->redirect(U('Qyapp/'.$module.'/'.$action,array('token'=>$token,'wecha_id'=>$_GET['wecha_id'])).$str);
		}else{
            $target = 'http://'.$_SERVER['SERVER_NAME'].'/index.php/Qyapp/Oauth/wap_url/token/'.$token.'/module/'.$module.'/action/'.$action.$str;
			$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$corpid.'&redirect_uri='.$target.'&response_type=code&scope=snsapi_base'.$str.'#wechat_redirect';				
			header('Location:'.$url);			
		}
	}
	/*
	*data数组传值 token module corpid
	*/
    public function index($data,$action='wap_index',$pid='1'){
	    if(cookie('wecha_id')){
		    $_GET['wecha_id'] = str_replace('wx_','',cookie('wecha_id'));
			$this->redirect(U('Qyapp/'.$data['module'].'/'.$action,array('token'=>$data['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$pid)));
		}else{
		
			$url='http://'. $_SERVER['SERVER_NAME'].'/index.php/Qyapp/Oauth/wap_url/token/'.$data['token'].'/module/'.$data['module'].'/action/'.$action.'/pid/'.$pid;
			$oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$data['corpid'].'&redirect_uri='.$url.'/response_type/code/scope/snsapi_base/state/STATE#wechat_redirect';
			header('Location:'.$oauthUrl);		
		}

	}
	
	public function wap_url(){
	
		if($_GET['code']){
			$code=$_GET['code'];
			$userinfo =$this->getUserInfo($code,$_GET['module'],$_GET['token']);
			$wecha_id = $userinfo['UserId'];
			setcookie('wecha_id','wx_'.$wecha_id,7200);
			$_GET['wecha_id'] = $userinfo['UserId'];
			$_GET['DeviceId'] = $userinfo['DeviceId'];
			unset($_GET['_URL_']);
			unset($_GET['code']);
			$this->redirect(U('Qyapp/'.$_GET['module'].'/'.$_GET['action'],$_GET));
		}
	}
	

		
	function getUserInfo($code,$module,$token)
	{
			$app=M('qymyapp')->where(array('token'=>$token))->field('userid,type,appid')->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}else{
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
			}
			//$accessClass= A('Qyapp/Common');
			//$access_token=$accessClass->access_token($user['corpid'],$user['corpsecret'],$app['appid'],$app['userid']);
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app);
			//判断结束
			$agentid=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>$module))->field('appid')->find();
			$userinfo_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token['access_token']."&code=".$code."&agentid=".$agentid['appid'];
			$userinfo_json = $this->curlGet($userinfo_url);
			$userinfo_array = json_decode($userinfo_json, true);
			return $userinfo_array;
	}	
	
	
/* 	function curlGet($url){
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
	} */
	
	private function access_token($corpid,$corpsecret,$app){
		if($corpid&&$corpsecret){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$corpid.'&corpsecret='.$corpsecret;
			$accessToken=json_decode($this->curlGet($url_get), true);
		}else{
			$accessToken=$this->access_token_get($app['appid'],$app['userid']);
		}
		return $accessToken;
	}

	public function access_token_get($agentid,$user_id){ 
		$suite_access_token=$this->suite_access_token($agentid,$user_id);
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_corp_token?suite_access_token='.$suite_access_token['suite_access_token'];
		$data=M('Qymyapp')->where(array('userid'=>$user_id,'appid'=>$agentid))->find();
		$user=M('Qytoken')->where(array('id'=>$user_id))->find();
		$info['suite_id']=$data['suit_id'];
		$info['auth_corpid']=$user['th_corpid'];
		//$suit=M('suiteid')->where(array('suiteid'=>$data['suit_id']))->find();
		$info['permanent_code']=$data['permanent_code'];
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
	
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}	
}