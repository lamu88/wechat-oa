<?php
/*
*部门管理
*
*/
class UserlistAction extends Action {
	public function _initialize() {		
		if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}
	
	//部门列表
    // public function departList(){
		// $user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		// $access_token=$this->access_token($user['corpid'],$user['corpsecret']);
		// $url_get='https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token['access_token'];
		// $departList=json_decode($this->curlGet($url_get),true);
		// dump($departList);
		
	// }
	
	//部门列表
    public function departs(){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token['access_token'];
		$departList=json_decode($this->curlGet($url_get),true);
		//获取一级分类
		foreach($departList['department'] as $k=>$v){
			$checkdate=M('Qynav')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id'],'parentid'=>$v['parentid']))->find();
			if(!$checkdate){
				M('Qynav')->add(array('token'=>$_SESSION['token'],'user_id'=>$_SESSION['user_id'],'pid'=>$v['id'],'parentid'=>$v['parentid'],'name'=>$v['name']));
			}
		}
		$frist=M('Qynav')->where(array('user_id'=>$_SESSION['user_id'],'parentid'=>0))->find();
		$list=M('Qynav')->where(array('user_id'=>$_SESSION['user_id'],'parentid'=>1))->select();
		$this->assign('list',$list);
		$this->assign('frist',$frist);
		$this->display();
		
	}
	
	//childle 部门列表
	public function childrenList(){
		if(IS_POST){
			$list=M('Qynav')->where(array('parentid'=>$_POST['pid'],'token'=>$_POST['token']))->select();
			
			echo json_encode(array('list'=>$list,'status'=>1));
		}
		//$this->display();
		
		
		
	}
	
	
	//添加部门
    public function departAdd($id,$data)
	{
			$node =M('Department')->where(array('id'=>$data['wxpid']))->find();
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token='.$access_token['access_token'];
			$data='{
				   "name": "'.$data['name'].'",
				   "parentid": "'.$node['wxid'].'"
				   }';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			return $departList;
	}
	
	
	//save部门
    public function departSave($id,$data){
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$node =M('Department')->where(array('id'=>$id))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_save='https://qyapi.weixin.qq.com/cgi-bin/department/update?access_token='.$access_token['access_token'];
			$departName=$data['name'];
			$id=$data['wxid'];
			$parentid=$data['wxpid'];
			$saveda='{
					"id": '.$id.',
				   "name": "'.$departName.'",
				   "parentid": "'.$data['wxpid'].'"
				   }';
			$post=$this->api_notice_increment($url_save,$saveda);
			$departList=json_decode($post,true);
			return $departList;
	}
	//删除部门
    public function departDel($id){
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$node =M('Department')->where(array('id'=>$id))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/department/delete?access_token='.$access_token['access_token'].'&id='.$node['wxid'];
			$departDel=json_decode($this->curlGet($url_get),true);
			return $departDel;
	}
	
	//token
	public function access_token($api,$secret){
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
		$json=json_decode($this->curlGet($url_get), true);
		return $json;
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
	
	function api_notice_increment($url, $data){
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