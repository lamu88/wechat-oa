<?php
class JsssdkAction extends Action{

  private $corpid;
  private $corpsecret;
  private $app;
  private $appId;
  public function wap_index($corpid,$corpsecret,$app){
	// $conf=M('Diymen_set')->where(array('token'=>$token))->find();
	// $this->appId = $conf['appid'];
    // $this->appSecret = $conf['appsecret'];
	$this->corpid = $corpid;
	$this->corpsecret = $corpsecret;
	$this->app = $app;
	$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
//	dump('werwer');
	// $info['suite_id']=$data['suit_id'];
	// $info['auth_corpid']=$user['th_corpid'];
	if(!$this->corpid){
		$this->appId=$user['th_corpid'];
	}else{
		$this->appId=$this->corpid;
	}
	$signPackage = $this->getSignPackage();
	// F('123',$signPackage);
	return $signPackage; 
  }
  
  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();
	
	//dump('sdfsdf');
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $timestamp = time();
    $nonceStr = $this->createNonceStr();
    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
    $signature = sha1($string);
    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
	//dump($signPackage);
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }
  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    if ($data->expire_time < time()) {
		//$accessClass= A('Qyapp/Common');
		$accessToken=$this->access_token($this->corpid,$this->corpsecret,$this->app);
	F('accessToken',$accessToken);
      $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=".$accessToken['access_token'];
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }
	F('1',$ticket);
    return $ticket;
  }

  private function getAccessToken() {
	//把acccesstoken  存入缓存中  并且已json的数据类型保存
	$data = S($this->appId.'_access_token');
	//F('appId333',$this->appId);
    if ($data->expire_time < time()) {
      $url = "http://123.56.104.254/index.php?g=Home&m=Kao&a=index&sn=6252151200050";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;
      if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
		//S($this->appId.'_access_token',json_encode($data));
      }
    } else{
      $access_token = $data->access_token;
    }
    return $access_token;
  }
  
  public function access_token($api,$secret,$appid,$userid){
		if($api&&$secret){
			$url='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
			$json=json_decode($this->httpGet($url), true);
		}
		return $json;
	}

  
  
  function httpGet($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}	
		
}
?>