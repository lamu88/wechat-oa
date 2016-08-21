<?php
/**
*报销管理
**/
class BonusAction extends Action{
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
			   $this->error('非法操作',U('Qyapp/Public/login'));
		}
	}	
		
/**
*配置审核人
**/
	public function index(){
		if(IS_POST){
			$_POST['userid']=$_SESSION['user_id'];
			if(M('qybonus_conf')->where(array('userid'=>$_POST['userid']))->save($_POST)){
			  $this->success('设置成功',U('Bonus/index',array('mid'=>$_GET['mid']))); 
			}else{
				if(M('qybonus_conf')->add($_POST)){
					 $this->success('设置成功',U('Bonus/index',array('mid'=>$_GET['mid']))); 
				}else{
					$this->error('设置失败');
				}
			}		
		}else{
			$data=M('qybonus_conf')->where(array('userid'=>$_SESSION['user_id']))->find();
			$this->assign('conf',$data);
			$this->display();
			
		}
		
	}
	public function set(){
		if(IS_POST){
			$_POST['userid']=$_SESSION['user_id'];
			$_POST['time']=time();
			$_POST['remaining']=$_POST['allmoney'];
			if(M('qybonus_list')->add($_POST)){
					 $this->success('设置成功',U('Bonus/set',array('mid'=>$_GET['mid']))); 
				}else{
					$this->error('设置失败');
				}
		}else{
			$data=M('qybonus_list')->where(array('userid'=>$_SESSION['user_id']))->select();
			$this->assign('data',$data);
			$this->display();
		}
		
		
	}
	public function typeInfo(){
		$data=M('qybonus_list')->where(array('id'=>$_GET['id']))->find();
		$this->assign('data',$data);
		$this->display();
		
	}
	public function info(){
		$data=M('qybonus_list')->where(array('id'=>$_GET['id']))->find();
		$info=M('qybonus_info')->where(array('setid'=>$_GET['id'],'userid'=>$_SESSION['user_id']))->select();

		 foreach($info as $k=>$v){
			 $user=M('qyusers')->where(array('userid'=>$v['uid']))->find();
			 $arr = explode(';',$user['pid']);
			  if($arr){
				  $str = '';
				 foreach($arr as $key => $c){
					 if($c){
						 $dep=M('department')->where(array('wxid'=>$c))->find();
						 $str.= $dep['name'].'&nbsp;&nbsp;';
					 }
					 
				 }
			 } 
			 $info[$k]['department'] = $str;
			 $info[$k]['name'] = $user['name'];
			 $info[$k]['position'] = $user['position'];		
			 $info[$k]['pid'] = $user['pid'];	
		}
		$this->assign('info',$info);
		$this->assign('data',$data);
		$this->display();
		 
	 }
	public function del(){
		F('22','22');
		if(M('qybonus_list')->where(array('id'=>$_POST['id']))->save(array('ststus'=>0))){
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));
		}
	}
	public function open(){
		if(M('qybonus_list')->where(array('id'=>$_POST['id']))->save(array('ststus'=>1))){
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));
		}
		
	}
/*----wap-----*/
	public function wap_add(){
		if(IS_POST){
			if(!$_POST['']){
			print_r($_POST);die;
		}else{
			$this->display();
		}
	}
	public function wap_my(){
		$bonus=M('qybonus_info')->where(array('uid'=>$_GET['wecha_id']))->select();
		$bonus_num = 0;
		$bonus_money = 0;
        foreach($bonus as $k=>$v){
		    $bonus_num++;
			$bonus_money += $v['money'];
		}
		$data1['num'] = $bonus_num;
		$data1['total'] = $bonus_money;		
		$data1['list'] = $bonus;				
		$my=M('qybonus_list')->where(array('uid'=>$_GET['wecha_id']))->select();
		$my_num = 0;
		$my_money = 0;
        foreach($my as $k=>$v){
		    $my_num++;
			$my_money += $v['money'];
		}
		$data2['num'] = $my_num;
		$data2['total'] = $my_money;	
		$data2['list'] = $my;		
		$this->assign('data1',$data1);
		$this->assign('data2',$data2);
		$this->display();
		
	}
	
	/*领取红包//红包列表*/
	public function wap_bonus(){
		//$_GET['wecha_id']=rand(1111,9999);
		$bonus=M('qybonus_list')->where(array('id'=>$_GET['id']))->find();
		$my=M('qybonus_info')->where(array('setid'=>$_GET['id'],'userid'=>$_GET['wecha_id']))->find();
		//判断是否领取
		//dump($bonus);die;
		if(!$my && $bonus['addnuber']<$bonus['nuber'] ){
			//普通红包
			if($bonus['status']=='1'){
				$mybonus=$bonus['money'];
			}else{
				//拼手气红包
				$my=$bonus['money']/$bonus['nuber'];
				$data=rand($my*100/4,$my*100*5);
				$mybonus=$data/100;
				if(($bonus['money']-$bonus['ramaining'])<$mybonus  ){
					$mybonus=$bonus['money']-$bonus['ramaining'];
				}
			}
			if($mybonus){
				M('qybonus_list')->where(array('id'=>$_GET['id']))->save(array('ramaining'=>$bonus['ramaining']+$mybonus,'addnuber'=>$bonus['addnuber']+1,'time'=>time()));
				M('qybonus_info')->add(array('setid'=>$_GET['id'],'money'=>$mybonus,'userid'=>$_GET['wecha_id'],'name'=>$bonus['userid'],'addtime'=>time()));
			
			}
			
		}
		if($bonus['status']=='1'){
			$zong=$bonus['nuber']*$bonus['money'];
		}else{
			$zong=$bonus['money'];
		}
		
		$list=M('qybonus_info')->where(array('setid'=>$_GET['id']))->select();
		$this->assign('zong',$zong);
		$this->assign('bonus',$bonus);
		$this->assign('list',$list);
		$this->display();
		
	}
	public function wap_pay(){
		//userid转换成openid接口
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,type,appid')->find();
		//if($app['type']==2){
			$user['corpid']='wxc99884aeecdd5f05';
			$user['corpsecret']='ZupUINSKdIWvIUOjK34IpMH7qU7REeQ-tbnC-SC7kAm1dwNuL_Wc6x5tsi2Qwiy-';
		//}else{
			//$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		//}
		$Oauth=A('Qyapp/Common');
		$access_token=$Oauth->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
		$p='{
		   "userid": "lanrain",
		   "agentid": "'.$app["appid"].'"
		}';
		$url='https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_openid?access_token='.$access_token['access_token'];
		$re=json_decode($this->api_notice_increment($url,$p),true);
		$totalprice=20;
		$orderid='wx';
		$orderid='wx120110';
		header('Location:/wxpay/index.php?g=Qyapp&m=Weixin&a=pay&price='.$totalprice.'&orderName='.$orderid.'&single_orderid='.$orderid.'&showwxpaytitle=1&from=Bonus&token='.$_GET['token'].'&wecha_id='.$re['openid']);
			
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