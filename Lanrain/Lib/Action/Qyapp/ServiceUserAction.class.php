<?php
class ServiceUserAction extends Action
{
	public $token;
	private $data;
	private $openid;
	public function _initialize()
	{

		parent::_initialize();

		
	}
	public function wechatService()
	{
		if (IS_POST)
		{
			//D('Wxuser')->where(array('token'=>$this->token))->save(array('transfer_customer_service'=>intval($_POST['transfer_customer_service'])));
			//S('wxuser_'.$this->token,NULL);
			$this->success('设置成功');
		}
		else 
		{
			//$this->wxuser=S('wxuser_'.$this->token);
			//if (!$this->wxuser)
			//{
				//$this->wxuser=D('Wxuser')->where(array('token'=>$this->token))->find();
				//S('wxuser_'.$this->token,$this->wxuser);
			//}
			//$this->assign('info',$this->wxuser);
			$this->display();
		}
	}

	public function Login_index(){
		if(IS_POST){
			$userName=$this->_post('userName','htmlspecialchars');
			$data['userPwd']=md5($this->_post('userPwd','htmlspecialchars'));
			if($userName==false||$data['userPwd']==false){
				$this->error('帐号必须填写');
			}
			/*
			if((!strpos($userName,'@') === FALSE)){
					$user=explode('@',$userName);
					$data['userName']=$user[0];
					$data['token']=$user[1];
					if($data['userName']==false || $data['token']==false){
						$this->error('帐号格式不正确');
					}
			}else{
				$this->error('帐号格式错误');
			}
			*/
			
			$back=M('kefu_user')->where(array('userName'=>$userName,'userPwd'=>$data['userPwd']))->find();
			if($back){
				/* 
				if($userName!==$back['userName'] || $data['userPwd']!==$back['userPwd']){
					$this->error('您的登陆信息错误<br />请核实后再登陆');
				} 
				*/
				session('userId',$back['id']);
				session('name',$back['name']);
				session('token',$data['token']);
				session('userName',$back['userName']);				
				$this->success('登陆成功',U('ServiceUser/chat_index'));
			}else{
				$this->error('您的登陆信息错误<br/>请核实后再登陆');
			}
		}else{		
			$this->display();
		}
	
	}
	
	
	function chat_getTime(){
		if (!$sTime)
        return '';
    //sTime=源时间，cTime=当前时间，dTime=时间差
    $cTime      =   time();
    $dTime      =   $cTime - $sTime;
    $dDay       =   intval(date("z",$cTime)) - intval(date("z",$sTime));
    //$dDay     =   intval($dTime/3600/24);
    $dYear      =   intval(date("Y",$cTime)) - intval(date("Y",$sTime));
    //normal：n秒前，n分钟前，n小时前，日期
    if($type=='normal'){
        if( $dTime < 60 ){
            if($dTime < 10){
                return '刚刚';    //by yangjs
            }else{
                return intval(floor($dTime / 10) * 10)."秒前";
            }
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        //今天的数据.年份相同.日期相同.
        }elseif( $dYear==0 && $dDay == 0  ){
            //return intval($dTime/3600)."小时前";
            return '今天'.date('H:i',$sTime);
        }elseif($dYear==0){
            return date("m月d日 H:i",$sTime);
        }else{
            return date("Y-m-d H:i",$sTime);
        }
    }elseif($type=='mohu'){
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif( $dDay > 0 && $dDay<=7 ){
            return intval($dDay)."天前";
        }elseif( $dDay > 7 &&  $dDay <= 30 ){
            return intval($dDay/7) . '周前';
        }elseif( $dDay > 30 ){
            return intval($dDay/30) . '个月前';
        }
    //full: Y-m-d , H:i:s
    }elseif($type=='full'){
        return date("Y-m-d , H:i:s",$sTime);
    }elseif($type=='ymd'){
        return date("Y-m-d",$sTime);
    }else{
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif($dYear==0){
            return date("Y-m-d H:i:s",$sTime);
        }else{
            return date("Y-m-d H:i:s",$sTime);
        }
    }
	}
	public function ajaxList(){
		if(IS_AJAX){
			$uid=session('user_id');
			$sql="userid= ".$uid." and `enddate` > `endjoinUpDate`";
			//echo $sql;
			$data['user_id']=$uid;
			$data['endjoinUpDate']=time()-3600*24*1000;
			$data=M('kefu_user')->where($data)->limit(5)->select();
			if($data!=false){
				foreach($data as $key => $limen){
					$dataUp['time']=time();
					$dataUp['id']=$limen['id'];
					M('service_qyulist')->data($dataUp)->save();
					$userInfo=M('qyusers')->where(array('userid'=>$limen['openid']))->find();
					$list1[$key]['time']=$this->chat_getTime($limen['enddate'],'mohu');
					$list1[$key]['name']=$userInfo['name'];
					$list1[$key]['headimgurl']=$userInfo['pic'];
					$list1[$key]['id']=$userInfo['id'];
					$list1[$key]['city']=$userInfo['city'];
					$list1[$key]['openid']=$limen['userid'];
					$list1[$key]['time']=$this->chat_getTime($userInfo['time'],'normal');
				}
				echo json_encode($list1);
				M('kefu_user')->where(array('token'=>session('token'),'id'=>session('userId'),'endJoinDate'=>time()))->save();
			//dump(M('Service_user')->getLastSql());
			}
			
		}else{
			exit('erorr:3306');
		}
	
	}	
	public function chat_ajaxMain(){
		if(IS_AJAX){
			if(!$time=$this->_post('time','htmlspecialchars')){exit(1);}
			$where['token']=session('token');
			$where['openid']=$this->_post('openid','htmlspecialchars');
			$endtime=M('service_qyulist')->where($where)->find();
			//$sql='`token`=1 and `openid`=1 and `enddate` >11';
			$sql='`token`="'.$where['token'].'" and `openid`="'.$where['openid'].'" and `enddate` >'.$time;
			$list=M('Behavior')->where($sql)->order('id desc')->select();
			$SQL=M('Behavior')->getlastsql();
			if($list !=false){
				$list=array_reverse($list);
				$where['token']=session('token');
				$where['id']=session('userId');
				$where['endJoinDate']=time();
				M('Service_user')->data($where)->save();
				echo json_encode($list);
			}else{
				echo 1;
			}
			
		}else{
			exit('{eror:2031}');
		}
	
	}
	function get_appmysql($userid=''){
		$appInfo=M('Qymyapp')->where(array('userid'=>$userid,'module'=>'ServiceUser'))->find();
		return $appInfo;
	}		
	public function chat_main(){	
		
		$appInfo=$this->get_appmysql($_SESSION['user_id'],'ServiceUser');			
		if(IS_POST){		
				$data['wecha_id'] = $_POST['wecha_id'];
				$data['content'] = $_POST['content'];
				$data['gid'] = $_SESSION['userId'];
				$data['token'] = $appInfo['token'];
				$data['pic'] = '/Tpl/Qyapp/ServiceUser/Img/avatar_default17ced3.png';
				$data['time'] = date('Y-m-d',time());
				$data['gm']	 = 1;				
				$add = M('service_qyrecord')->add($data);
				if($add){
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(0);
				}					
		}
		$time = date('Y-m-d',time());
		$list = M('service_qyrecord')->where(array('token'=>$appInfo['token'],'gid'=>$_SESSION['userId'],'time'=>$time,'wecha_id'=>$_GET['wecha_id'],'gid'=>$_GET['gid']))->select();		
		$this->assign('list',$list);	
		$where['openid']=$this->_get('openid','htmlspecialchars');		
		$where['token']=$appInfo['token'];
		//$msgList=M('service_qybehavior')->field('keyword,openid,enddate')->where($where)->limit(20)->order('id desc')->select();
		$logs=M('service_qylogs')->field('enddate,keyword,openid')->where($where)->limit(20)->order('id desc')->select();
		$userInfo=M('wechat_group_list')->field('nickname,headimgurl,openid')->where($where)->find();
		foreach($msgList as $key=>$List){
			$msgList[$key]['type']=1;
		
		}
		foreach($logs as $key=>$List){
			$logs[$key]['type']=2;
		
		}
		$newarray=array_merge($msgList,$logs);
		$enddata=$logs?$this->array2sort($newarray,'enddate'):$msgList;
		$this->assign('msgList',$enddata);
		$endtime=$msgList[0];
		//dump($endtime);
		
		$userInfo['openid']=$where['openid'];
		$this->assign('endtime',$endtime['enddate']);
		$this->assign('userInfo',$userInfo);
		$this->display();
	}
	private function array2sort($a,$sort,$d='') {
		$num=count($a);
		if(!$d){
			for($i=0;$i<$num;$i++){
				for($j=0;$j<$num-1;$j++){
					if($a[$j][$sort] > $a[$j+1][$sort]){
						foreach ($a[$j] as $key=>$temp){
							$t=$a[$j+1][$key];
							$a[$j+1][$key]=$a[$j][$key];
							$a[$j][$key]=$t;
						}
					}
				}
			}
		}
		else{
			for($i=0;$i<$num;$i++){
				for($j=0;$j<$num-1;$j++){
					if($a[$j][$sort] < $a[$j+1][$sort]){
						foreach ($a[$j] as $key=>$temp){
							$t=$a[$j+1][$key];
							$a[$j+1][$key]=$a[$j][$key];
							$a[$j][$key]=$t;
						}
					}
				}
			}
		}
		return $a;
	}
	//伪造腾讯header头请求图片
	function showExternalPic(){
		$wecha_id=$this->_get('wecha_id');
		//S($this->token.'_'.$wecha_id,null);
		$token=$this->_get('token');
		$imgData = S($token.'_'.$wecha_id);
		$types = array(
			'gif'=>'image/gif',
			'jpeg'=>'image/jpeg',
			'jpg'=>'image/jpeg',
			'jpe'=>'image/jpeg',
			'png'=>'image/png',
			);
		if (!$imgData){
			$url=htmlspecialchars($_GET['url']);
			$dir = pathinfo($url);
			$host = $dir['dirname'];
			$refer = 'http://www.qq.com/';

			$ch = curl_init($url);
			curl_setopt ($ch, CURLOPT_REFERER, $refer);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
			$data = curl_exec($ch);
			curl_close($ch);
			$ext = strtolower(substr(strrchr($url,'.'),1,10));
			
			$ext='jpg';
			$type = $types[$ext] ? $types[$ext] : 'image/jpeg';
			header("Content-type: ".$type);
			echo  $data;
		}else {
			$ext='jpg';
			$type = $types[$ext] ? $types[$ext] : 'image/jpeg';
			header("Content-type: ".$type);
			echo  $imgData;
		}
	} 
	public function chat_send(){
		$this->send_info("人工客服－".session('name').":\n\r".$this->_post('keyword'),$this->_get('openid','htmlspecialchars'),session('userId'));
	}
	public function chat_send_info($content,$openid,$pid=1,$type=1){
		//查询appid appkey是否存在
		$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
		//dump($api);
		if($api['appid']==false||$api['appsecret']==false){$this->error('必须先填写【AppId】【 AppSecret】');exit;}
		//获取微信认证
		$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
		$json=json_decode($this->curlGet($url_get));
		$qrcode_url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$json->access_token;
		$data='{
			"touser":"'.$openid.'",
			"msgtype":"text",
			"text":
			{
				 "content":"'.$content.'"
			}
		}'; 
		$post=$this->api_notice_increment($qrcode_url,$data);
		$json_decode=json_decode($post);
		//
		$where['token']=session('token');
		$where['id']=session('userId');
		$where['endJoinDate']=time();
		M('Service_user')->data($where)->save();
		$checkRt=M('service_qyulist')->where(array('token'=>$where['token'],'openid'=>$openid))->find();
		if ($checkRt){
			M('service_qyulist')->where(array('token'=>$where['token'],'openid'=>$openid))->save(array('joinUpDate'=>time()));
		}else {
			
		}
		//
		if($json_decode->errmsg =='ok'){
			$GetDb=M('Service_logs');
			$add['enddate']=time();
			$add['keyword']=$content;
			$add['pid']=$pid;
			$add['openid']=$openid;
			$update=$GetDb->data($add)->add();
			echo 1;
		}else{
			echo 2;
		}
	}
	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			//dump($tmpInfo);
			return $tmpInfo;
			$js=json_decode($tmpInfo,1);
			return $js['ticket'];
		}
	}
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}	
	public function index()
	{
		$appInfo=$this->get_appmysql($_SESSION['user_id'],'ServiceUser');	
	//dump($this->data);die;
		$where['user_id']=$_SESSION['user_id'];
		$count=M('kefu_user')->where($where)->count();
		$page=new Page($count,25);
		$list=M('kefu_user')->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		$this->assign('page',$page->show());
		if ($list)
		{
			$sepTime=30*60;
			$nowTime=time();
			$time=$nowTime-$sepTime;
			
			$i=0;
			foreach ($list as $item)
			{
				$list[$i]['online']=0;
				if ($item['endJoinDate']>$time)
				{					
					$list[$i]['online']=1;
				}
				$i++;
			}
		}
		
		$this->assign('list',$list);
		$this->assign('type','list');
		$this->display(); 
		
	
	}
	
 	public function add()
	{
		$appInfo=$this->get_appmysql($_SESSION['user_id'],'ServiceUser');			
		if(IS_POST)
		{
			$db=D("kefu_user");			
				$data = $_POST;
				$data['user_id'] = $_SESSION['user_id'];
				$data['userPwd'] = md5($_POST['userPwd']);
                $id = $db ->data($data)->add();								
				if($id==true)
				{
					//M('Users')->where(array('id'=>session('uid')))->setInc('serviceUserNum');
					$this->success('操作成功');
				}
				else
				{
					$this->error('操作失败');
				}

		}
		else
		{
			//$where['id']=$this->_get('id','intval');
			//$where['session']=session('session');
			//$where['user_id']=$_SESSION['user_id'];	
			//dump($where);die;	
			//$info=M('kefu_user')->where($where)->find();			
			//$this->assign('serviceUser',$info);
			$this->display('add');
		}	
	} 
	
	public function closeService()
	{
		$where['token']=session('token');
		$endTime=time()-60*600;
		$rt=M('kefu_user')->where($where)->save(array('endJoinDate'=>$endTime));
		$this->success('操作成功');
	}
	public function edit()
	{
		if(IS_POST)
		{	
			$sql = M('kefu_user');
			$_POST['user_id'] = $_SESSION['user_id'];
			$data = $sql->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_GET['id']))->find();
			if($_POST['userPwd'] == ''){
				$this->error('密码不为空');
			}else{
				$_POST['userPwd'] = md5($_POST['userPwd']);
			}				
			$up = $sql->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_GET['id']))->save($_POST);
			if($up){
				$this->success('更改成功');
			}else{
				$this->error('更改失败');
			}
			
		}
		else
		{
			$where['id']=$_GET['id'];
			//$where['session']=session('session');
			$info=M('kefu_user')->where($where)->find();
			$this->assign('serviceUser',$info);
			$this->display('add');
		}
	}
	public function chat_log()
	{
		$appInfo=$this->get_appmysql($_SESSION['user_id'],'ServiceUser');	
		$data=M('service_qyulist');
		$where['token']=$appInfo['token'];
		$count=$data->where($where)->count();
		$page=new Page($count,25);
		$list=$data->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		foreach($list as $key=>$vo)
		{
			$list[$key]['name']=D('kefu_user')->getServiceUser($vo['pid']);
		}
		$this->assign('page',$page->show());
		$this->assign('list',$list);
		$this->assign('type','list');
		$this->display();
	}
	public function del ()
	{
		M('Users')->where(array('id'=>session('uid')))->setDec('serviceUserNum');
		$this->del_id();
	}
	public function chat_log_del ()
	{
		$this->del_id('service_qylogs','Service/chat_log');
	}
}
?>
