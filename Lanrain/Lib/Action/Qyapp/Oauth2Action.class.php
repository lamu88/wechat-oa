<?php
/*
*oauth2验证
*
*/
class Oauth2Action extends Action {
	/*
	*data数组传值 token module corpid
	*/
	public function index(){
	dump($_SESSION);die;
		$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid=CORPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';
	
	
	
	}
	public function wap(){
		
	
	
	}
   /*  public function index($data,$action='wap_index',$pid=''){
	    if(cookie('wecha_id')){
		    $_GET['wecha_id'] = cookie('wecha_id');
			$this->redirect(U('Qyapp/'.$data['module'].'/'.$action,array('token'=>$data['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$pid)));
		}else{
			$url='http://'. $_SERVER['SERVER_NAME'].'/index.php/Qyapp/Oauth/wap_url/token/'.$data['token'].'/module/'.$data['module'].'/action/'.$action.'/pid/'.$pid;
			$oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$data['corpid'].'&redirect_uri='.$url.'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
			header('Location:'.$oauthUrl);		
		}

	}
	
	public function wap_url(){
		if($_GET['code']){
			$code=$_GET['code'];
			$userinfo =$this->getUserInfo($code,$_GET['module'],$_GET['token']);
			$wecha_id = $userinfo['UserId'];
			setcookie('wecha_id',$wecha_id,7200);
			return $wecha_id;
			//$this->redirect(U('Qyapp/'.$_GET['module'].'/'.$_GET['action'],array('token'=>$_GET['token'],'wecha_id'=>$userinfo['UserId'],'pid'=>$_GET['pid'])));
		}
	}
	
	function getUserInfo($code,$module,$token)
	{
			$app=M('qymyapp')->where(array('token'=>$token))->field('userid,type,appid')->find();
			//判断
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}else{
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
			}
			//dump($user);
			$accessClass= A('Qyapp/Common');
			$access_token=$accessClass->access_token($user['corpid'],$user['corpsecret'],$app);
			//判断结束
			$agentid=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>$module))->field('appid')->find();
			$userinfo_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token['access_token']."&code=".$code."&agentid=".$agentid['appid'];
			$userinfo_json = $this->curlGet($userinfo_url);
			$userinfo_array = json_decode($userinfo_json, true);
			return $userinfo_array;
	}
		
	 */
	
	
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
	
	
}