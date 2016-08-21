<?php
class LoginAction extends Action{
	public function code(){
		$code=$_GET['auth_code'];
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_provider_token';
		$webinfo=M('Qywebsite')->where(array('site_url'=> str_replace('www.','',$_SERVER['SERVER_NAME'])))->find();
		//获取应用提供商凭证
		$data='{"corpid":"'.$webinfo['corpid'].'","provider_secret":"'.$webinfo['provider_secret'].'"}';
		$re=json_decode($this->https_request($url,$data),true);
		//获取企业号管理员登录信息
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_login_info?provider_access_token='.$re['provider_access_token'];
		$data='{
			"auth_code":"'.$code.'"
		}';
		$qy=json_decode($this->https_request($url,$data),true);
		$qydata=M('Qytoken')->where(array('username'=>$qy['corp_info']['corp_name']))->find();
		if(empty($qydata['username'])){
		
			$qytoken['corpid']=$qy['corp_info']['corpid'];
			$qytoken['th_corpid']=$qy['corp_info']['corpid'];
			$qytoken['username']=$qy['corp_info']['corp_name'];
			$qytoken['headimg']=$qy['corp_info']['corp_square_logo_url'];
			$qytoken['mp']=$qy['user_info']['mobile'];
			$conf=M('Qywebsite')->where(array('site_url'=>$_SERVER['SERVER_NAME']))->find();
			$qytoken['endtime']=time()+$conf['day'];
			if($qytoken['username']){
				$id=M('Qytoken')->add($qytoken);
				if($id){
					session('user_id',$id);
					session('username',$qytoken['username']);
					session('contact',$qytoken['username']);
					session('mp',$qytoken['mp']);
					$this->redirect(U('Qyapp/Appslist/appList'));
				}else{
					$this->redirect(U('Weiyi/Weiyi/register'));
				} 
			}
		}else{
			if($res['endtime']>time()){
				session('user_id',$qydata['id']);
				session('username',$qydata['username']);
				session('contact',$qydata['username']);
				session('mp',$qydata['mp']);
				$this->redirect(U('Qyapp/Appslist/appList'));
			}else{
				$this->error('帐号已到期或者已关闭请联系管理员',U('Weiyi/Weiyi/login'));
			}
		}
	}
	
	
	function https_request($url, $data)
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
	
}