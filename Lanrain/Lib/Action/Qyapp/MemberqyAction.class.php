<?php
/*
*管理成员
*
*/
class MemberqyAction extends Action {
	/*
	 public function _initialize() {
		if($_SESSION['username']==''){
		  // $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}
	*/
	
	//公众号查询部门id
	public function ckDept(){
		if(IS_POST){
			//print_r($_POST);echo "1111";exit;
			$user=M('qytoken')->where(array('username'=>$_POST['qy_name']))->find();
			//print_r($user);exit;
			//return  json_encode($user);
			if($user){
				$info=M('Department')->where(array('user_id'=>$user['id']))->select();
				$info['msg']=1;
				echo json_encode($info);
			}else{
				$info['msg']=0;
				echo json_encode($info);
			}
		}
	}
	
	
	//创建成员
    public function memberAdd(){
		if(IS_POST){
			$ids=explode(',',$_POST['qy_id']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$department=implode(", ",$wxarr);
			
			//$_POST['tel']=$_POST['t1'].'-'.$_POST['t2'].'-'.$_POST['t3'].
			//$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$user=M('qytoken')->where(array('username'=>$_POST['qy_name']))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
			$data='{
				   "userid": "'.$_POST['userid'].'",
				   "name": "'.$_POST['name'].'",
				   "department": ['.$department.'],
				   "position": "'.$_POST['position'].'",
				   "mobile": "'.$_POST['mobile'].'",
				   "gender": 1,
				   "tel": "'.$_POST['tel'].'",
				   "email": "'.$_POST['email'].'",
				   "weixinid": "'.$_POST['weixinid'].'",
				   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
					}';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			if($departList['errmsg']=='created'){
				$_POST['pid']=$department;
				//M('Qyusers')->add($_POST);
				$user=$this->memberInfo_get($_POST['userid'],$user['user_id']);
				echo json_encode("1");
				exit;
				//$this->success('添加成功');
			}else{
				//$this->success('添加失败');
				echo json_encode("0");
				exit;
			}
		}else{
		    //echo 'yyyyyy';exit;
			$this->display();
		}
	}	

	
	
	//获取成员详细信息
	public function memberInfo(){
		$where['userid']=$_GET['id'];
		//if($user_id)  
		$where['user_id']=$_SESSION['user_id'];
		$chick=M('Qyusers')->where($where)->find();
		if($chick){
			$info=$chick;
			$pid=explode(';',$info['pid']);
			 foreach($pid as $k=>$v){
				 $infos=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
				 $str.='<p class="form-control-static">'.$infos['name'].'</p>';
			 }
		}else{
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$_GET['id'];
			$memberinfo=$this->curlGet($url_get);
			$info=json_decode($memberinfo,true);
			
			$name=$this->save_pic($info['avatar']);
			foreach($info['department'] as $k=>$v){
				$infos=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
				$str.='<p class="form-control-static">'.$infos['name'].'</p>';
				$CC.=$v.';';
			}
			$info['pid']=';'.$CC;
			$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
			$info['avatar']=$info['pic'];
			$memberinfo=json_encode($info);
			if(!$user_id) $info['user_id']=$_SESSION['user_id'];
			
			//$id=M('Qyusers')->add($info);
		}
		//F('INFO',$info);
		$this->assign('host','http://'.$_SERVER['SERVER_NAME'].'/');
		$this->assign('str',$str);
		$this->assign('memberinfo',$info);
		$this->display();
	}
	//获取成员详细信息用来调用
	function memberInfo_get($id,$user_id=''){
		$where['userid']=$id;
		if($user_id)  $where['user_id']=$user_id;
		$chick=M('Qyusers')->where($where)->find();
		if($chick){
			$memberinfo=json_encode($chick);
		}else{
			$user=M('qytoken')->where(array('id'=>$user_id))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$id;
			$memberinfo=$this->curlGet($url_get);
			$info=json_decode($memberinfo,true);
			$name=$this->save_pic($info['avatar']);
			foreach($info['department'] as $k=>$v){
				$str.=$v.';';
			}
			$info['pid']=';'.$str;
			$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
			$info['avatar']=$info['pic'];
			$info['user_id']=$user_id;
			$memberinfo=json_encode($info);
			if(!$user_id) $info['user_id']=$_SESSION['user_id'];
			if($info['userid']){
				$id=M('Qyusers')->add($info);
			}
		}
		return $memberinfo;	
	}
	
	
	
	function save_pic($url){
		$timeout=60;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$temp = curl_exec($ch);
		$status=curl_getinfo($ch);
		$name='icon/'.$this->getToken(8).time().'.jpg';
		if(@file_put_contents($name, $temp) && !curl_error($ch)) {
			return $name;
			//F('SFSDF',$name);
		}
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
	function getToken($length){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];
		}
		return $str;
	}
}