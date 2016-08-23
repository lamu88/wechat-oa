<?php
class SmsAction extends Action{

public function index($mobile,$str){
	$url = "http://www.smsbao.com/sms?u=".C('username')."&p=".C('psd')."&m=".$mobile."&c=".$str;
	$header = "Content-type: text/xml";
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $sendurl );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
	$response = curl_exec ( $ch );
	if (curl_errno ( $ch )) {
		print curl_error ( $ch );
	}
	curl_close ( $ch );
	$list = explode ( ';', $response );
	$succ = $list [0];
	return $succ;
}
	


}