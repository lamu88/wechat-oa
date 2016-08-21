<?php
/*
*管理成员
*
*/
class MemberAction extends Action {
	public $logo;	
	public $copyright;
	function _initialize(){
		$data=M('Qywebsite')->where(array('uid'=>1))->find();
		if(empty($data['copyright'])){
			$this->logo = '';			
		}else{
			$this->logo = $data['site_logo'];			
		}
		if(!isset($_GET['mid']) || empty($_GET['mid'])){
			$mymodule = M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>MODULE_NAME))->find();
			$_GET['mid'] = $mymodule['id'];
		}
		$this->assign('logo',$this->logo);	            		
	}
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
		
	//成员列表
    public function memberList(){
		if($_GET['Did']){
			//0获取全部员工，1获取已关注成员列表，2获取禁用成员列表，4获取未关注成员列表。
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$common = A('Qyapp/Common');
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			if(!$_GET['status']){
				$_GET['status']=0;//默认获取全部员工
			}
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$_GET['Did'].'&fetch_child=0&status='.$_GET['status'];
			$List=json_decode($this->curlGet($url_get),true);
			$memberList="";
			foreach ($List['userlist'] as $k=>$v){
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
				$memberinfo=json_decode($this->curlGet($url_get),true);
				$memberList[$k]=$memberinfo;
			}
			$this->assign('userlist',$memberList);
			$this->display();
		}
	}
	
	//成员列表
    public function profile(){
			$this->display();
	}	
	
	//创建成员
    public function memberAdd(){
			if(IS_POST){
			
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$department=implode(", ",$wxarr);
			
			$_POST['tel']=$_POST['t1'].'-'.$_POST['t2'].'-'.$_POST['t3'].
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				$common = A('Qyapp/Common');
				$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
			$data='{
				   "userid": "'.$_POST['userid'].'",
				   "name": "'.$_POST['name'].'",
				   "department": ['.$department.'],
				   "position": "'.$_POST['position'].'",
				   "mobile": "'.$_POST['mobile'].'",
				   "gender": "'.$_POST['gender'].'",
				   "tel": "'.$_POST['tel'].'",
				   "email": "'.$_POST['email'].'",
				   "weixinid": "'.$_POST['weixinid'].'",
				   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
					}';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			if($departList['errmsg']=='created'){
				$_POST['pid']=$department;
				$user=$this->memberInfo_get($_POST['userid'],$_SESSION['user_id']);
				$this->success('添加成功');
			}else{
				$this->success('添加失败');
			
			}
		}else{
			$this->display();
		}
	}	

	//修改成员
    public function editMember(){
		$common = A('Qyapp/Common');
		if(IS_POST){
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$department=implode(", ",$wxarr);
			$_POST['tel']=$_POST['t1'].'-'.$_POST['t2'].'-'.$_POST['t3'];
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
				
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token='.$access_token['access_token'];
			$data='{
				   "userid": "'.$_POST['userid'].'",
				   "name": "'.$_POST['name'].'",
				   "department": ['.$department.'],
				   "position": "'.$_POST['position'].'",
				   "mobile": "'.$_POST['mobile'].'",
				   "gender": "'.$_POST['gender'].'",
				   "tel": "'.$_POST['tel'].'",
				   "email": "'.$_POST['email'].'",
				   "weixinid": "'.$_POST['weixinid'].'"
					}';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			if($departList['errmsg']=='updated'){
				$_POST['pid']=$department;
				$user=$this->memberInfo_get($_POST['userid'],$_SESSION['user_id']);
				unset($_POST['pid']);
				$_POST['department'] = $_POST['depart'];
				M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$_POST['userid']))->save($_POST);
				$this->success('更新成功');
			}else{
				$this->success('更新失败');
			}
		}else{
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
				
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$_GET['userid'];
			$memberinfo=json_decode($this->curlGet($url_get),true);
			$this->assign('memberinfo',$memberinfo);
			$str='';
			foreach($memberinfo['department'] as $k=>$v){
				$info=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
				$str.=$info['name'].';';
			
			}
			$this->assign('str',$str);
			$this->display();
		}
	}
	
	
	public function addleader(){
		if($_POST){
			$userinfo=M('Qyusers')->where(array('id'=>$_GET['id']))->field('id,name')->find();
			if(M('Department')->where(array('id'=>$_GET['nodeid']))->save(array('leaderid'=>$_GET['id'],'leaderuserid'=>$userinfo['name'],'leadername'=>$_POST['name']))){
				$this->success('设置成功');
			}else{
			
				$this->error('设置失败');
			}
		
		}else{
			$this->display();
		}
		
	}
	
	
	//删除成员
    public function delMember(){
		if($_POST['userid']){
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$common = A('Qyapp/Common');
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token='.$access_token['access_token'].'&userid='.$_POST['userid'];
			$departDel=json_decode($this->curlGet($url_get));
			if($departDel){
				M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$_POST['userid']))->delete();//删除本地信息
				echo json_encode(array('status'=>1));
			}
		}
	}
	//禁用成员
	public function forbidden(){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
		if($appinfo){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$common = A('Qyapp/Common');
		$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
		$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token='.$access_token['access_token'];
		$data='{
			   "userid": "'.$_POST['userid'].'",
			   "enable": 0
				}';
		$post=$this->api_notice_increment($url_creat,$data);
		$departList=json_decode($post,true);
		if($departList['errmsg']=='updated'){
			M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$_POST['userid']))->save(array('enable'=>0));//更新本地信息
			echo json_encode(array('status'=>1));
		}
	}
	
	//开启成员
	public function start(){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
		if($appinfo){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$common = A('Qyapp/Common');
		$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
		
		
		$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token='.$access_token['access_token'];
		$data='{
			   "userid": "'.$_POST['userid'].'",
			   "enable": 1
				}';
		$post=$this->api_notice_increment($url_creat,$data);
		$departList=json_decode($post,true);
		if($departList['errmsg']=='updated'){
			M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$_POST['userid']))->save(array('enable'=>1));//更新本地信息
			echo json_encode(array('status'=>1));
		}
	}

	//移动成员
    public function moveMember(){
		if(IS_POST){
		    $userid = $_POST['userid']; 
			$moveto = $_POST['moveto']; 
			$user_id = $_SESSION['user_id'];
			$user = $this->memberInfo_get($userid,$user_id);
			$users = json_decode($user,true);
		    //先删除该成员然后再在指定的部门下新增
			if($this->del($userid)){
			    if($this->add($moveto,$users)){
				    echo json_encode(array('status'=>1));
				}else{
				    echo json_encode(array('status'=>0));
				}
			    
			}else{
			    echo json_encode(array('status'=>0));
			};
		}
	}
	
	
	
	
	//获取成员详细信息
	public function memberInfo(){
		$where['userid']=$_GET['id'];
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
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$common = A('Qyapp/Common');
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$_GET['id'];
			$memberinfo=$this->curlGet($url_get);
			$info=json_decode($memberinfo,true);
			$name=$this->save_pic($info['avatar']);
			foreach($info['department'] as $k=>$v){
				$infos=M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->field('name')->find();
				$str.=$infos['name'];
				$CC.=$v.';';
			}
			$info['pid']=';'.$CC;
			$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
			$info['avatar']=$info['pic'];
			$memberinfo=json_encode($info);
			if(!$user_id) $info['user_id']=$_SESSION['user_id'];
		}
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
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$common = A('Qyapp/Common');
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			
			
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
	//save the pic
	
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
			}
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
	
	//删除成员
   public function del($userid){
		if($userid){
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$commom = A('Qyapp/Common');
			$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$appinfo['userid']);
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token='.$access_token['access_token'].'&userid='.$userid;
			$departDel=json_decode($this->curlGet($url_get),true);
			if($departDel){
				M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$userid))->delete();//删除本地信息
				return true;
			}else{
			    return false;
			}
		}else{
		    return false;
		}
	}	
	
	//创建成员
    public function add($moveto,$info){
		if($info){
			$ids=explode(';',$moveto);
			$m = 0;
			foreach($ids as $k=>$v){
			    if($v){
					$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				    $wxarr[$m]=$wxid['wxid'];
                    $m++;					
				}
			}
			$department=implode(", ",$wxarr);
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			//判断
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				$commom = A('Qyapp/Common');
				$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$appinfo['userid']);
			
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
			$data='{
				   "userid": "'.$info['userid'].'",
				   "name": "'.$info['name'].'",
				   "department": ['.$department.'],
				   "position": "'.$info['position'].'",
				   "mobile": "'.$info['mobile'].'",
				   "gender": "'.$info['mobile'].'",
				   "tel": "'.$info['tel'].'",
				   "email": "'.$info['email'].'",
				   "weixinid": "'.$info['weixinid'].'",
				   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
					}';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			if($departList['errmsg']=='created'){
				$info['pid']=$department;
				$user=$this->memberInfo_get($info['userid'],$_SESSION['user_id']);
				return true;
			}else{
				return false;
			
			}
	    }else{
	      return false;
	    }	
}
}