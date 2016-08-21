<?php
class CallAction extends Action{


	public function index()
	{
		//子帐号
		$subAccountSid= 'aaf98f894c273858014c28aac7ce00c0';

		//子帐号Token
		$subAccountToken= 'c85a020705274f478a60f45f35781ccf';

		//VoIP帐号
		$voIPAccount= '85348300000001';								

		//VoIP密码
		$voIPPassword= 'emt7gdjw';

		//应用Id
		$appId='aaf98f894c273858014c28aac7b300bf';

		//请求地址，格式如下，不需要写https://
		$serverIP='sandboxapp.cloopen.com';

		//请求端口 
		$serverPort='8883';

		//REST版本号
		$softVersion='2013-12-26';
		$url='https://sandboxapp.cloopen.com:8883/'.$softVersion.'/SubAccounts/'.$subAccountSid.'/Calls/Callback';
		$data = array(
			'from'=>'13308658831',
			'to'=>'13308656826'
		);
		$post=$this->curlpost($url,$data);
		$menu=json_decode($post,true);
		print_r($post);
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
	function curlpost($url, $data){
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
	
	
}


//Demo调用 
//landingCall("被叫号码","语音文件名称","文本内容","显示的主叫号码","循环播放次数","外呼通知状态通知回调地址"); 
?>
