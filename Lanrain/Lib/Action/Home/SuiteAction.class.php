<?php
class SuiteAction extends Action {
	public function index()
	{
		include_once "wxBizMsgCrypt.php";
		$info=M('Suiteid')->where(array('token'=>$_GET['token']))->find();
		$encodingAesKey = $info['apkey'];
		$token = $info['token'];
		$corpId =$info['suiteid']; //这里已正确填写自己的suiteid
		$sReqMsgSig = $_GET['msg_signature'];  
		$sReqTimeStamp = $_GET['timestamp'];  
		$sReqNonce = $_GET['nonce'];  
		$sReqData = file_get_contents("php://input");
		//echo $sReqData;exit;
		//$sVerifyEchoStr = $_GET['echostr'];  
		$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);   
		$sMsg = "";
		$errCode = $wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData, $sMsg);
		if ($errCode == 0){
			$xml = new DOMDocument();  
			$xml->loadXML($sMsg);   
			$SuiteId = $xml->getElementsByTagName('SuiteId')->item(0)->nodeValue;  
			$InfoType = $xml->getElementsByTagName('InfoType')->item(0)->nodeValue;  
			$TimeStamp = $xml->getElementsByTagName('TimeStamp')->item(0)->nodeValue;  
			$SuiteTicket = $xml->getElementsByTagName('SuiteTicket')->item(0)->nodeValue;  
			if($SuiteTicket){
				M('Suiteid')->where(array('id'=>$info['id']))->save(array('suiteticket'=>$SuiteTicket));
			}
		}
	}
	
	public function msg()
	{
		include_once "wxBizMsgCrypt.php"; 
		$data=M('Suiteid')->where(array('id'=>$_GET['sid']))->find();
		//F('datacc',$_GET);
		$encodingAesKey = $data['apkey'];
		$token = $data['token'];
		$sReqMsgSig = $_GET['msg_signature'];  
		$sReqTimeStamp = $_GET['timestamp'];  
		$sReqNonce = $_GET['nonce']; 
		$sReqData = file_get_contents("php://input");
		$xmls = new DOMDocument();  
		$xmls->loadXML($sReqData); 
		$corpId = $xmls->getElementsByTagName('ToUserName')->item(0)->nodeValue;  //获取用户
		$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);   
		$sMsg = "";
		$errCode = $wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData, $sMsg);
		if ($errCode == 0){
			$xml = new DOMDocument();  
			$xml->loadXML($sMsg);  			
			$reqToUserName = $xml->getElementsByTagName('ToUserName')->item(0)->nodeValue;  
			$reqFromUserName = $xml->getElementsByTagName('FromUserName')->item(0)->nodeValue;  
			$reqCreateTime = $xml->getElementsByTagName('CreateTime')->item(0)->nodeValue;  
			$reqMsgType = $xml->getElementsByTagName('MsgType')->item(0)->nodeValue;  
			$reqContent = $xml->getElementsByTagName('Content')->item(0)->nodeValue;  
			$reqMsgId = $xml->getElementsByTagName('MsgId')->item(0)->nodeValue;  
			$AgentID = $xml->getElementsByTagName('AgentID')->item(0)->nodeValue; //应用ID
			//获取用户 user_id
			$userinfo=M('Qytoken')->where(array('th_corpid'=>$corpId))->field('id')->find();//$corpId是唯一的  
			if($reqMsgType=='event'){
			//自定义菜单事件推送
				$reqContent=$EventKey;
				//位置获取事件 每五秒钟获取一次用户地址
				$Event=$xml->getElementsByTagName('Event')->item(0)->nodeValue;  
				$user['Latitude']=$xml->getElementsByTagName('Latitude')->item(0)->nodeValue;  
				$user['Longitude']=$xml->getElementsByTagName('Longitude')->item(0)->nodeValue;  
				$user['Precision']=$xml->getElementsByTagName('Precision')->item(0)->nodeValue;  
				$user['userid']=$reqFromUserName; 
				if($user['Latitude']){
					$ak=M('Qywebsite')->where(array('site_url'=> $_SERVER['SERVER_NAME']))->find();
					$url='http://api.map.baidu.com/geoconv/v1/?coords='.$user['Longitude'].','.$user['Latitude'].'&ak='.$ak['baidu_map_api'].'&output=json';
					$local=json_decode($this->curlGet($url),true);
					$user['Latitude']=$local['result'][0]['y'];  
					$user['Longitude']=$local['result'][0]['x'];  
					S("local_".$reqFromUserName,$user,300);
				}
			}
			$infos=M('Qymyapp')->where(array('userid'=>$userinfo['id'],'name'=>$reqContent))->find();
			if($infos){
				$data['reqFromUserName']=$reqFromUserName;
				$data['corpId']=$corpId;
				$data['sReqTimeStamp']=$sReqTimeStamp;
				$data['title']=$infos['name'];
				$data['description']=$infos['desc'];
				$data['picurl']=$infos['reply_img']?$infos['reply_img']:$infos['logo'];
				$data['picurl']='http://'.$infos['outh_host'].$data['picurl'];
				$data['url']='http://'.$infos['outh_host'].'/index.php?g=Qyapp&m='.$infos['module'].'&a=wap_index&token='.$infos['token'];
				$sRespData=$this->news_one($data);
			}
			$sEncryptMsg = ""; //xml格式的密文  
			$errCode = $wxcpt->EncryptMsg($sRespData, $sReqTimeStamp, $sReqNonce, $sEncryptMsg);  
			if ($errCode == 0)
			{
				print($sEncryptMsg);  
			}else
			{
				print($errCode . "\n\n");  
			}
			
		}
	}
	
	
	
	/******响应消息类型****/
	//text消息
	public function text(){
		$str=
		"<xml>
   <ToUserName><![CDATA[toUser]]></ToUserName>
   <FromUserName><![CDATA[fromUser]]></FromUserName> 
   <CreateTime>1348831860</CreateTime>
   <MsgType><![CDATA[text]]></MsgType>
   <Content><![CDATA[this is a test]]></Content>
</xml>";

	}
	
	//image消息
	public function image(){
		$str=
		"<xml>
   <ToUserName><![CDATA[toUser]]></ToUserName>
   <FromUserName><![CDATA[fromUser]]></FromUserName>
   <CreateTime>1348831860</CreateTime>
   <MsgType><![CDATA[image]]></MsgType>
   <Image>
       <MediaId><![CDATA[media_id]]></MediaId>
   </Image>
</xml>";
	}
	
	//news
	public function news_one($data){
		$str=
			"<xml>
   <ToUserName><![CDATA[".$data['reqFromUserName']."]]></ToUserName>
   <FromUserName><![CDATA[".$data['corpId']."]]></FromUserName>
   <CreateTime>".$data['sReqTimeStamp']."</CreateTime>
   <MsgType><![CDATA[news]]></MsgType>
   <ArticleCount>1</ArticleCount>
   <Articles>
       <item>
           <Title><![CDATA[".$data['title']."]]></Title> 
           <Description><![CDATA[".$data['description']."]]></Description>
           <PicUrl><![CDATA[".$data['picurl']."]]></PicUrl>
           <Url><![CDATA[".$data['url']."]]></Url>
       </item>
   </Articles>
</xml>";

	return $str;
	}
	
	
}
?>