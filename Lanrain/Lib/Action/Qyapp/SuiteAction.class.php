<?php
/*
*第三方应用接口
*/
class SuiteAction extends Action {
	public $id ;
	public $appid;
	public $suiteinfo;
	public function _initialize() {
	    $Model = new Model();
		//$Model->query('alter table tp_Suiteid add permanent_code varchar(200)');
	    //$sql = 'alter table '.$this->Suiteid.' add permanent_code varchar(200)';
		$rt01=$Model->query("Describe  `tp_Suiteid` `permanent_code`;");
		if(!$rt01){
			$rt01=$Model->query("ALTER TABLE `tp_Suiteid` ADD COLUMN `permanent_code` varchar(200)");
		}		
		if($_GET['suite_id']){
			//整个套件
			$suiteinfo=M('Suiteid')->where(array('id'=>$_GET['suite_id']))->find();
			$this->id=$_GET['suite_id'];
			$this->suiteinfo=$suiteinfo;
		}else{
			if($_POST['apptype']==3){
				//多个应用
				$suiteinfo=M('Suiteid')->where(array('id'=>$_POST['suite_id']))->find();
				$this->id=$_POST['suite_id'];
				if($_POST['ch']){
					$this->appid=$_POST['ch'];
				}else{
					$this->error('不能为空');
					exit;
				}
			}else{
				//单个应用
				$appinfo=M('Qyapplist')->where(array('id'=>$_GET['id']))->field('suit_id,suit_appid')->find();
				$this->appid=$appinfo['suit_appid'];
				$this->id=$appinfo['suit_id'];
			}
		}
		
	}

	//应用单独安装
	public function pass(){
		$pre_auth_code=$this->pre_auth_code();
		$data=M('Suiteid')->where(array('id'=>$this->id))->find();
		$redirect_uri="http://".$_SERVER['SERVER_NAME']."/index.php/Qyapp/Suite/app_add/suite_id/".$data['id'];
		$url="https://qy.weixin.qq.com/cgi-bin/loginpage?suite_id=".$data['suiteid']."&pre_auth_code=".$pre_auth_code['pre_auth_code']."&redirect_uri=".$redirect_uri."&state=1";
		header("Location: ".$url);
	}
	
	public function app_add(){
		$suiteinfo=$this->suiteinfo;
		$installinfo=$this->auth_code($_GET['auth_code']);
		F('appinfo',$installinfo);
		//新增应用
		$agents=$installinfo['auth_info']['agent'];
		$suite_access_token=$this->suite_access_token();
		$set_data['suite_access_token']=$suite_access_token['suite_access_token'];
		$set_data['suit_id']=$suiteinfo['suiteid'];
		$set_data['auth_corpid']=$installinfo['auth_corp_info']['corpid'];
		$set_data['permanent_code']=$installinfo['permanent_code'];
		F('set_data',$set_data);
		foreach($agents as $k=>$v){
			$appinfo=M('Qyapplist')->where(array('name'=>$v['name']))->find();
			
			//判断是否安装过该应用(包括曾近安装过)
			$checkdate=M('Qymyapp')->where(array('name'=>$v['name'],'userid'=>$_SESSION['user_id']))->find();
			if($appinfo){
					//循环给应用设置可信域名
				$agentinfo['agentid']=$v['agentid'];
				if($v['api_group'][0]=='get_location'){
					$agentinfo['report_location_flag']=2;
				}
				$agentinfo['isreportuser']=1;
				$agentinfo['redirect_domain']=$_SERVER['SERVER_NAME'];
				$set_data['appinfo']=$agentinfo;
				$set_re=$this->set_agent($set_data);
				if(!$checkdate){
					$id=M('Qymyapp')->add(array(
						'fun_id'=>$appinfo['id'],'userid'=>$_SESSION['user_id'],
						'name'=>$appinfo['name'],'desc'=>$appinfo['desc'],
						'logo'=>$appinfo['logo'],'outh_host'=>$_SERVER['SERVER_NAME'],
						'module'=>$appinfo['module'],
						'appid'=>$v['agentid'],
						'status'=>1,
						'type'=>2,
						'suit_id'=>$suiteinfo['suiteid'],
						'token'=>$this->getToken(6).time(),
						'encodingkey'=>$this->getToken(43),
						'category'=>$appinfo['category']
					));
				}else{
					if($checkdate['status']!=1){
						$id=M('Qymyapp')->where(array('id'=>$checkdate['id']))->save(array(
						'fun_id'=>$appinfo['id'],'userid'=>$_SESSION['user_id'],
						'name'=>$appinfo['name'],'desc'=>$appinfo['desc'],
						'logo'=>$appinfo['logo'],'outh_host'=>$_SERVER['SERVER_NAME'],
						'module'=>$appinfo['module'],
						'appid'=>$v['agentid'],
						'status'=>1,
						'type'=>2,
						'suit_id'=>$suiteinfo['suiteid'],
						'token'=>$this->getToken(6).time(),
						'encodingkey'=>$this->getToken(43),
						'category'=>$appinfo['category']
						));
					}
						//重复安装无效
						//if($checkdate['']){
							//M('Qymyapp')->where(array('id'=>$checkdate['id']))->save(array('type'=>2));
						//}
				}
			}else{
				$this->error('安装出错，请重试！',U('Appslist/appList'));
			}
		}
		if($installinfo['permanent_code']){
			$data=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->field('permanent_code')->find();
			if(!$data['permanent_code']){
				M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->save(array('permanent_code'=>$installinfo['permanent_code'],'th_corpid'=>$installinfo['auth_corp_info']['corpid']));
			}
		}
		M('Suiteid')->where(array('suiteid'=>$suiteinfo['suiteid']))->save(array('permanent_code'=>$installinfo['permanent_code']));
		$this->redirect(U('Appslist/appList'));
		exit();
	}
	//获取永久授权码
	public function auth_code($auth_code){
		$suite_access_token=$this->suite_access_token();
		if($this->id){
			$suite_id = $this->id;
		}else{
			$suite_id = $_GET['suite_id'];
		}
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_permanent_code?suite_access_token='.$suite_access_token['suite_access_token'];
		$data=M('Suiteid')->where(array('id'=>$suite_id))->find();
		$info['suite_id']=$data['suiteid'];
		$info['auth_code']=$auth_code;
		$re=json_decode($this->https_request($url,json_encode($info)),true);
		
		return $re;
	}
	
	//获取预授权码
   public function pre_auth_code(){
		$suite_access_token=$this->suite_access_token();
		//F('re',$suite_access_token);
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_pre_auth_code?suite_access_token='.$suite_access_token['suite_access_token'];
		$data=M('Suiteid')->where(array('id'=>$this->id))->find();
		$info['suite_id']=$data['suiteid'];
		$info['appid']=$this->appid;//单独应用的授权
		$re=json_decode($this->https_request($url,json_encode($info)),true);
		return $re;
	}
   //获取应用套件令牌
	public function suite_access_token(){  
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_suite_token';
		if($this->id){
			$suite_id = $this->id;
		}else{
			$suite_id = $_GET['suite_id'];
		}
		$data=M('Suiteid')->where(array('id'=>$suite_id))->find();
		$info['suite_id']=$data['suiteid'];
		$info['suite_secret']=$data['su_secret'];
		$info['suite_ticket']=$data['suiteticket'];
		$p=json_encode($info);
		$re=json_decode($this->https_request($url,$p),true);
		return $re;
	}
	public function access_token($api,$secret){
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
		$json=json_decode($this->curlGet($url_get), true);
		return $json;
	}
	
	
	//接口群
	//1.设置授权过来的应用 主要是授权域名和地理位置的开启
	public function set_agent($data){
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/set_agent?suite_access_token='.$data['suite_access_token'];
		$info['suite_id']=$data['suit_id'];
		$info['auth_corpid']=$data['auth_corpid'];
		$info['permanent_code']=$data['permanent_code'];
		$info['agent']=$data['appinfo'];
		$p=json_encode($info);
		$re=json_decode($this->https_request($url,$p),true);
		return $re;
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
	
	function https_request($url, $data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
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