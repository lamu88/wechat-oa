<?php
class QiyeAction extends Action {
	public function index()
	{
		include_once "wxBizMsgCrypt.php";  
		//获取动态token
		$info=M('Qymyapp')->where(array('token'=>$_GET['token']))->find();
		
		$encodingAesKey = $info['encodingkey'];   
		$token = $info['token'];
		$user=M('Qytoken')->where(array('id'=>$info['userid']))->field('corpid')->find();
		
		$corpId =$user['corpid']; //这里已正确填写自己的corpid   
		$sReqMsgSig = $_GET['msg_signature'];  
		$sReqTimeStamp = $_GET['timestamp'];  
		$sReqNonce = $_GET['nonce'];  
		$sReqData = file_get_contents("php://input");
		$sVerifyEchoStr = $_GET['echostr'];
        //dump('rtrt',$_GET);
		$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);  
	
		//回调模式配置
		if($sVerifyEchoStr){			
			$sEchoStr = "";
			$errCode = $wxcpt->VerifyURL($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sVerifyEchoStr, $sEchoStr); 
			F('errCode',$errCode);	
			if ($errCode == 0) {
				print($sEchoStr);   
			} else {
				print($errCode . "\n\n");
			}
			exit;  
		}
		//接受消息
		$sMsg = ""; 
		$errCode = $wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData, $sMsg);
		F('wxcpt',$wxcpt);
		F('token',$token);
		F('encodingAesKey',$encodingAesKey);
		F('corpId',$corpId);
		F('sMsg',$sMsg);
		if ($errCode == 0){
			$xml = new DOMDocument();  
			$xml->loadXML($sMsg);   
			$reqToUserName = $xml->getElementsByTagName('ToUserName')->item(0)->nodeValue;  
			$reqFromUserName = $xml->getElementsByTagName('FromUserName')->item(0)->nodeValue;  
			$reqCreateTime = $xml->getElementsByTagName('CreateTime')->item(0)->nodeValue;  
			$reqMsgType = $xml->getElementsByTagName('MsgType')->item(0)->nodeValue;  
			$reqContent = $xml->getElementsByTagName('Content')->item(0)->nodeValue; 
			$reqMsgId = $xml->getElementsByTagName('MsgId')->item(0)->nodeValue;  
			$EventKey = $xml->getElementsByTagName('EventKey')->item(0)->nodeValue; 	
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
			
			$infos=S($info['userid'].$reqContent);
			if(!$infos){
				$infos=M('Qymyapp')->where(array('userid'=>$info['userid'],'name'=>$reqContent))->find();
				S($info['userid'].$reqContent,$infos,3600);
			}
			if($infos){
				$data['reqFromUserName']=$reqFromUserName;
				$data['corpId']=$corpId;
				$data['sReqTimeStamp']=$sReqTimeStamp;
				$data['title']=$infos['name'];
				$data['description']=$infos['desc'];
				$data['picurl']=$infos['reply_img']?$infos['reply_img']:$infos['logo'];
				$data['picurl']='http://'.$infos['outh_host'].str_replace('./','/',$data['picurl']);
				$data['url']='http://'.$infos['outh_host'].'/index.php?g=Qyapp&m='.$infos['module'].'&a=wap_index&token='.$infos['token'];
				$sRespData=$this->news_one($data);
			}else{
				//F('aadd',$reqContent);
				if($reqContent){
					//$user=S($reqFromUserName.$info['userid']);
					//if(!$user){
						$user=M('qyusers')->where(array('userid'=>$reqFromUserName))->find();
						S($reqFromUserName.$info['userid'],$user['pic'],3600);
					//}
					F('aaaa',$user['pic']);
					M('service_qyrecord')->add(array('pic'=>$user['pic'],'content'=>$reqContent,'userid'=>$info['userid'],'wecha_id'=>$reqFromUserName,'time'=>time()));
					M('qyuser')->where(array('userid'=>$reqFromUserName))->find();
					$data['time']=time();
					$user=M('service_qyulist')->where(array('wecha_id'=>$reqFromUserName,'name'=>$reqToUserName))->save($data);
					if(!$user){
						M('service_qyulist')->add(array('wecha_id'=>$reqFromUserName,'name'=>$reqToUserName,'time'=>time()));
					}
				}
				
			}
			/*  else{
				 if($reqContent){
					M('kefu_msg')->add(array('content'=>$reqContent,'userid'=>$info['userid'],'wecha_id'=>$reqFromUserName));
					$aacc=M('kefu_user')->where(array('wecha_id'=>$reqFromUserName))-find());
					F('aadd',$reqContent);
					//$data['time']=time();
						//$infosss=M('kefu_user')->where(array('wecha_id'=>$reqFromUserName))->save($data);
						
					//}else{
						M('kefu_user')->add(array('wecha_id'=>$reqFromUserName,'time'=>time()));
					//}
					$data['reqFromUserName']=$reqFromUserName;
					$data['corpId']=$corpId;
					$data['sReqTimeStamp']=$sReqTimeStamp;
					$data['content'] = $reqFromUserName;
					
					$sRespData=$this->text($data);
				}
			}  */
			/* if($reqContent=='课表'){
				$data['reqFromUserName']=$reqFromUserName;
				$data['corpId']=$corpId;
				$data['sReqTimeStamp']=$sReqTimeStamp;
				$data['content'] = '没有找到课表哦！';
				//F('data111223',$data);
				$sRespData=$this->text($data);
			} */
			
			$sEncryptMsg = ""; //xml格式的密文  
			$errCode = $wxcpt->EncryptMsg($sRespData, $sReqTimeStamp, $sReqNonce, $sEncryptMsg);  
			if ($errCode == 0)
			{
				print($sEncryptMsg);  
			}else
			{  
				print($errCode . "\n\n");  
			}
		}else{  
			print($errCode . "\n\n");  
		}
	}
	
	/******响应消息类型****/
	//text消息
	public function text($data){
		$str=
		"<xml>
		   <ToUserName><![CDATA[".$data['reqFromUserName']."]]></ToUserName>
		   <FromUserName><![CDATA[".$data['corpId']."]]></FromUserName> 
		   <CreateTime>".$data['sReqTimeStamp']."</CreateTime>
		   <MsgType><![CDATA[text]]></MsgType>
		   <Content><![CDATA[".$data['content']."]]></Content>
		</xml>";
		return $str;
	}
	
	//image消息
	public function image($data){
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
		return $str;
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
	
	
	
	//
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
?>