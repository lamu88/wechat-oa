<?php

/* 
	Code by 毛豆 (QQ:507438722)
	2014-9-10
	功    能：快递查询(可根据订单号智能匹配快递公司)，目前只支持常见快递公司
	版    本：1.0
	操作方法：快递+订单号，例如：快递V208960868
*/

class KuaidiAction extends Action {
	
    function response($data,$keywordArr){
		$text = substr($data['Content'],6,100);	
		F('t',$text);
		$kuaidi_url='http://m.kiees.cn/yto.php?wen='.$text; 
		F('d',$kuaidi_url);
		$str = '<a href='http://m.kuaidi100.com/index_all.html?type=顺丰&postid=V208960868'>您好，您查询的【顺丰】单号为【V208960868】请点击查看详情</a>';
		return  array($str,'text');
		/* $p = "%<tbody[^>]*>(.*?)<\/tbody>%si";
		
		preg_match_all($p, $kuaidi_handle, $arr); */
		/* return array (
    			array (
    					array (
								'Title'=>$title,
    							'Url'=>$kuaidi_url,
								
    					)
    			)
    			,
    			'news'
    	)
    	; */
		/* $kuaidi_xml    = simplexml_load_string($kuaidi_handle);	
		$item_nums = count($kuaidi_xml -> Data -> Order);	
	

		if ($kuaidi_xml -> ErrCode !=0){
			switch ($kuaidi_xml -> ErrCode){  
				case 1: 
					$re_str = "快递KEY无效";            break;
				case 2:
					$re_str = "快递代号无效";           break;
				case 3:
					$re_str = "访问次数达到最大额度";   break;
				case 4:
					$re_str = "查询服务器返回错误";     break;
				case 5:
					$re_str = "程序执行错误";           break;
			}

			return array($re_str,'text');     
		}else{		
			$news_h = array('Title' => $kuaidiName_cn,'Description' => '','PicUrl' => 'http://www.youdi.com/uploads/2%282%29.jpg','Url' =>'http://www.aikuaidi.cn/');
			$news_r = array('Title' => ".暂无更多...",'Description' => '','PicUrl' => '','Url' => '');

			$news[] = array('Title' => $news_h['Title'],'Description' => $news_h['Description'],'PicUrl' => $news_h['PicUrl'],'Url' => $news_h['Url']);
			
			foreach($kuaidi_xml -> Data -> Order as $a){
				//$m.="{$a->Time}  {$a->Content}";       
				
				$news[] = array(
					'Title'        => $a->time,    
					'Description'  => $this->transTime($a->Time)."  ".$a->Content,  
					'PicUrl'       => '',
					'Url'          => ''
					);
			}

			if ($item_nums < 8){   
				$news[] = array('Title' => $news_r['Title'],'Description' => $news_r['Description'],'PicUrl' => $news_r['PicUrl'],'Url' => $news_r['Url']);
				return array($news,'news');
			}else{  

				$A8[] = array('Title' => $news_h['Title'],'Description' => $news_h['Description'],'PicUrl' => $news_h['PicUrl'],'Url' => $news_h['Url']);
				//$A8[] = array_slice($news,$item_nums - 8,8);
				for ($i = 8; $i > 0; $i --){ 
					$A8[] = array('Title' => $news[$item_nums - $i]['Description'],'Description' => $news[$item_nums - $i]['Title'],'PicUrl' => $news[$item_nums - $i]['PicUrl'],'Url' => $news[$item_nums - $i]['Url']);
				}
				$A8[] = array('Title' => $news_r['Title'],'Description' => $news_r['Description'],'PicUrl' => $news_r['PicUrl'],'Url' => $news_r['Url']);

				return array($A8,'news');
			}
		} */
    }

	private function getExpressCom($number){

		switch(strlen($number)){

			case 8:
			case 9:
				$result = "德邦:debang";
				break;
			case 10:  
				if(preg_match("/^[1|2|3|6|8|v|V]\d{9}$|^7[2-3]\d{8}$|^90\d{8}$/", $number)){
					$result = "圆通:yuantong";
				}
				else if(preg_match("/^[0|9]\d{9}$|^78\d{8}$/", $number)){
					$result = "宅急送:zhaijisong";
				}else{
					$result = strlen($number)."无法智能查询\n请转用常规方式。";
				}
				break;
			case 12:
				if(preg_match("/^58\d{10}$|^560\d{9}$|^88\d{10}$/", $number)){
					$result = "天天:tiantian";
				}		
				else if(preg_match("/^[2-6]6\d{10}$|^22\d{10}$/", $number)){
					$result = "申通:shentong";
				}
				else if(preg_match("/^21\d{10}$|^35\d{10}/", $number)){
					$result = "汇通:huitong";
				}		
				else if(preg_match("/^7\d{11}$|^2008\d{8}$|^010\d{9}$|^6\d{11}$/", $number)){
					$result = "中通:zhongtong";
				}
				else if(preg_match("/^[0|1|2|3|4|5|9]\d{11}$/", $number)){
					$result = "顺丰:shunfeng";
				}else{
					$result = strlen($number) . "无法智能查询\n请转用常规方式。";
				}
				break;
			case 13:
				if(preg_match("/^1[2|6|7|9]\d{11}$|^1000\d{9}$|^8000\d{9}$/", $number)){
					$result = "韵达:yunda";
				}
				else if(preg_match("/^5\d{12}$|^11\d{11}$|^10\d{11}$|^e\d{12}$|^[a-z]{2}\d{9}[a-z]{2}$/", strtolower($number))){
					$result = "ems:ems";
				}
				break;
			default:
				$result = strlen($number) . "无法智能查询\n请转用常规方式。";
				break;
		}

		return $result;
	}

	private function transTime($timeStr){

		$start = strpos($timeStr, '-') +1;
		$end   = strripos($timeStr, ':') -1;
		$result = substr($timeStr,$start,$end - $start + 1);

		return $result;
	}

}
?>