<?php
/*
*oauth2验证
*
*/
class WoauthAction extends Action {

	/*
	menuid是自定义菜单id   
	userid是用户id
	
	
	*/
	public function wap_index(){
		$data=M('Qymenu')->where(array('id'=>$_GET['menuid']))->find();	
		if($_GET['wecha_id']){
			$url=str_replace("{wecha_id}",$_GET['wecha_id'],$data['link']);
			header('Location:'.$url);
			
		}else{
			if(strpos($data['link'],'{wecha_id}') !== false){
				$data['userid']=$_GET['userid'];
				$data['module']='Woauth';
				$data['menuid']=$_GET['menuid'];
				$user=M('qytoken')->where(array('id'=>$_GET['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Woauth=A('Qyapp/Woauth');
				$Woauth->index($data,'wap_index');
				exit();			
			}else{
				header('Location:'.$data['link']);		
			}
		}
	}
	
	
    public function index($data,$action='wap_index',$pid=''){
		$url='http://'. $_SERVER['SERVER_NAME'].'/index.php/Qyapp/Woauth/wap_url/userid/'.$data['userid'].'/module/'.$data['module'].'/action/'.$action.'/menuid/'.$data['menuid'];
		$oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$data['corpid'].'&redirect_uri='.$url.'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
		header('Location:'.$oauthUrl);
	}
	
	public function wap_url(){
		if($_GET['code']){
			$code=$_GET['code'];
			$userinfo =$this->getUserInfo($code,$_GET['module'],$_GET['userid']);
			$this->redirect(U('Qyapp/'.$_GET['module'].'/'.$_GET['action'],array('userid'=>$_GET['userid'],'wecha_id'=>$userinfo['UserId'],'menuid'=>$_GET['menuid'])));
		}
	}
	
	function getUserInfo($code,$module,$userid)
	{
			$app=M('qymyapp')->where(array('token'=>$userid))->field('userid,type,appid')->find();
			//判断
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}else{
				$user=M('qytoken')->where(array('id'=>$userid))->field('corpid,corpsecret')->find();
			}
			$accessClass= A('Qyapp/Common');
			$access_token=$accessClass->access_token($user['corpid'],$user['corpsecret'],$app);
			//判断结束
			$agentid=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>$module))->field('appid')->find();
			$userinfo_url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$access_token['access_token']."&code=".$code."&agentid=".$agentid['appid'];
			$userinfo_json = $this->curlGet($userinfo_url);
			$userinfo_array = json_decode($userinfo_json, true);
			return $userinfo_array;
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
}