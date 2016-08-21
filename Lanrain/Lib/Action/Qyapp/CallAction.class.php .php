<?php
class CallAction extends Action{

	//include_once "CCPRestSDK.php";  

	//子帐号
	public function index()
	{
	echo 111;
	}
	
	
	//public function callBack($from,$to,$customerSerNum,$fromSerNum,$promptTone,$userData,$maxCallTime,$hangupCdrUrl)
	public function callBack()
	{
		include_once "CCPRestSDK.php"; 
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

		//被叫电话号码
		$to='13308658831';
		
		//主叫电话号码
		$from='13308656826';
	
	    $hangupCdrUrl='http://qy.wxopen.cn/';
			// 初始化REST SDK
			global $appId,$subAccountSid,$subAccountToken,$voIPAccount,$voIPPassword,$serverIP,$serverPort,$softVersion;
			$rest = new REST($serverIP,$serverPort,$softVersion);
			$rest->setSubAccount($subAccountSid,$subAccountToken,$voIPAccount,$voIPPassword);
			$rest->setAppId($appId);
		
			// 调用回拨接口
			echo "Try to make a callback,called is $to <br/>";
			$result = $rest->callBack($from,$to,$customerSerNum,$fromSerNum,$promptTone,$userData,$maxCallTime,$hangupCdrUrl);
			if($result == NULL ) {
				echo "result error!";
				break;
			}
			if($result->statusCode!=0) {
				echo "error code :" . $result->statusCode . "<br>";
				echo "error msg :" . $result->statusMsg . "<br>";
				//TODO 添加错误处理逻辑
			} else {
				echo "callback success!<br>";
				// 获取返回信息
				$callback = $result->CallBack;
				echo "callSid:".$callback->callSid."<br/>";
				echo "dateCreated:".$callback->dateCreated."<br/>";
			   //TODO 添加成功处理逻辑 
			}        
	    }
    }
}

//Demo调用 
//landingCall("被叫号码","语音文件名称","文本内容","显示的主叫号码","循环播放次数","外呼通知状态通知回调地址"); 
?>
