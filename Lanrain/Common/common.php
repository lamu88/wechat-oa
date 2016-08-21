<?php
function isAndroid(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
		return 1;
	}
	return 0;
}

function p($arr){
	echo '<pre>'.print_r($arr,true).'</pre>';
}

//无线打印!!!
function wifi_print($token,$str,$arr_data){


		/**  
		 * 发送post请求  
		 * @param string $url 请求地址  
		 * @param array $post_data post键值对数据  
		 * @return string  	 
		 */  

	function send_post($url, $post_data) {   

  
	//生成encode之后的post字符串
	  $postdata = http_build_query($post_data);   

	  $options = array(   

	    'http' => array(   

	      'method' => 'POST',   

	      'header' => 'Content-type:application/x-www-form-urlencoded',   

	      'content' => $postdata,   

	      'timeout' => 15 * 60 // 超时时间（单位:s）   

	    )   

	  );

	//设置服务器头文件与内容
	  $context = stream_context_create($options);   

	  $result = file_get_contents($url, false, $context);   

	  return $result;   

	}   




	//使用方法   

	// $post_data = array(   

	  // 'username' => 'stclair2201',   

	  // 'password' => 'handan'  

	// );   

	// send_post('http://www.qianyunlai.com', $post_data);   
	

	//生成唯一标识符
	function EncyptUrl($data , $key) {
	                 ksort($data);
	                 $__av = array_values($data);
	                 $src_string = implode(",", $__av) . $key;
	                 $md5 = md5($src_string);
	                 return $md5;
	}



	//要打印的内容
	// $content = "CC!-CC!". "---- x ---- xxx ---- x----\n";  //   居中打印
 //    $content = $content. "CC!-CC!". "1请拍照保存 2向服务员索取\n"; //   居中打印
 //    $content = $content.  "CC!-CC!用微信，360卫士，搜狗拼音扫描\n"; //   居中打印
 //    $content = $content.  "CC!-CC!". "每桌一张\n"; //   居中打印
 //    $content = $content.  "BC!-BC!". "菜谱二维码\n";  //   居中打印并加粗
 //    $content = $content.  "BC!-BC!". "菜谱二维码\n";  //  加粗打印



	//需要打印的数据
	$content = urlencode($str);
	
	//本地key，可变
	// $key= "AK47";
	$key= $arr_data['print_key'];

	$debug = 1;

	$array['type'] = "text";  				// qrcode
	$array['content'] =$content;
	$array['createtime'] = time();
	$si= EncyptUrl($array , $key);			//唯一标识符
	$array['key'] = $si;

	//第三方接口
	// $site = "http://gd002.unifw.com";
	$site = $arr_data['apiurl'];

	//GET 
	//$url = "$site/service/sendPrintData.php?content={$array['content']}&type=text&key=$si&createtime=$now";

	//POST
	$url = "$site/service/sendPrintData.php";


	

	//POST
	$post_data = $array;  
	$content = send_post($url, $post_data); 
	//GET
	//$content = file_get_contents($url);


	//echo $content;

	// if ($debug) echo "$url  \n";
		
	// if ($debug) echo "STEP 2 \n";

	// if ($debug) echo "STEP 3 \n";



}

function xmlMessage($toUser,$fromUser,$msg)
{
$xml="
<xml>
<ToUserName><![CDATA[".$toUser."]]></ToUserName>
<FromUserName><![CDATA[".$fromUser."]]></FromUserName>
<CreateTime>".time()."</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[".$msg."]]></Content>
</xml>
";
return $xml;
}

function xmlDump($data)
{
	$content="";
	foreach ($data AS $k=>$v)
		$content.="[$k]=>".$v.'\n';
	return xmlMessage($data["FromUserName"], $data["ToUserName"], $content);
}

function http_post($url, $param)
{
	//dump('ddd');
	$oCurl = curl_init ();
	
	if (stripos ( $url, "https://" ) !== FALSE) {
		curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
	}
	
	
	if (is_string ( $param )) {
		$strPOST = $param;
	} else {
		$aPOST = array ();
		foreach ( $param as $key => $val ) {
			$aPOST [] = $key . "=" . urlencode ( $val );
		}
		$strPOST = join ( "&", $aPOST );
	}
	//dump($url);
	//dump($strPOST);
	curl_setopt ( $oCurl, CURLOPT_URL, $url );
	curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $oCurl, CURLOPT_POST, true );
	curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $strPOST );
	$sContent = curl_exec ($oCurl);
	$aStatus = curl_getinfo($oCurl);
	//dump($sContent);
	//dump($aStatus);
	curl_close ($oCurl);
	if (intval ( $aStatus ["http_code"] ) == 200) {
		return $sContent;
	} else {
		return false;
	}
}

// 获取当前用户的Token
function get_token() 
{
	if (! empty ( $_REQUEST ['token'] )) {
		session ( 'token', $_REQUEST ['token'] );
	}
	$token = session ( 'token' );

	if (empty ( $token )) {
		return - 1;
	}
	return $token;
}


?>