<?php
class AppslistAction extends Action {
   public function _initialize() {
	   $Model = new Model();
	   $rt1=$Model->query("Describe  `tp_qytoken` `agency_id`;");
	   $rt2=$Model->query("Describe  `tp_qyapplist` `category`;");
	   $rt3=$Model->query("Describe  `tp_qymyapp` `category`;");
	   if(!$rt2){
		   $rt2=$Model->query("alter table tp_qyapplist add category int(4) default null"); 
	   }
	   if(!$rt3){
		   $rt3=$Model->query("alter table tp_qymyapp add category int(4) default null");
	   }
	   if($rt1){
		   $rt1=$Model->query("alter table tp_qytoken drop agency_id"); 
	   }
	}
	//我的应用
	public function appList(){
		$whose= $_SERVER['SERVER_NAME'];
		if(strpos($whose,"www.")!==false){
			$whose=substr_replace($whose, '', 0,3);
		}
		$webinfo=M('Qywebsite')->where(array('site_url'=>$whose))->find();
	    session('site_logo',$webinfo['site_logo']);
		session('site_title',$webinfo['site_title']);
		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$appList=M('Qymyapp')->where(array('status'=>1,'userid'=>$_SESSION['user_id']))->select();
		//dump($appList);exit;
		foreach($appList as $k=>$v){
			$ch=M('Qyapplist')->where(array('id'=>$v['fun_id'],'install'=>1))->find();
			if($user['type']!=1){
				if($ch['vip']<=$user['type']){
				$apps[$k]=$v;
				}
			}else{
				$apps[$k]=$v;
			}
		}
		$jichu = array();
		$sanji = array();
		$yingxiao = array();
		$hangye = array();
		$shangwu = array();
		$crm = array();
		$hudong = array();		
		foreach($apps as $key=>$val){
		    if($val['category'] == 1){
			    $jichu['head'] = '基础功能';
			    $jichu['info'] = '企业办公常用功能';				
			    $jichu['data'][] = $val;
			}elseif($val['category'] == 2){
			    $sanji['head'] = '客户管理';
			    $sanji['info'] = '企业办公常用功能';				
			    $sanji['data'][] = $val;
			}elseif($val['category'] == 3){
			    $yingxiao['head'] = '营销互动';
			    $yingxiao['info'] = '企业办公常用功能';				
			    $yingxiao['data'][] = $val;
			}elseif($val['category'] == 4){
			    $hangye['head'] = '进销存';
			    $hangye['info'] = '企业办公常用功能';				
			    $hangye['data'][] = $val;
			}elseif($val['category'] >= 5){
			    $shangwu['head'] = '其它模块';
			    $shangwu['info'] = '企业办公常用功能';				
			    $shangwu['data'][] = $val;
			}/* elseif($val['category'] == 6){
			    $crm['head'] = 'CRM系统';
			    $crm['info'] = '企业办公常用功能';				
			    $crm['data'][] = $val;
			}elseif($val['category'] == 7){
			    $hudong['head'] = '互动模块';
			    $hudong['info'] = '企业办公常用功能';				
			    $hudong['data'][] = $val;
			} */
		}
		$this->assign('user',$user);
		$this->assign('sanji',$sanji);
		$this->assign('jichu',$jichu);	
		$this->assign('yingxiao',$yingxiao);
		$this->assign('hangye',$hangye);
		$this->assign('shangwu',$shangwu);
		$this->assign('crm',$crm);
		$this->assign('hudong',$hudong);		
		//dump($jichu);exit;
		$this->display();
	}
	
	//我的应用
	public function appListnew(){
		$whose= $_SERVER['SERVER_NAME'];
		if(strpos($whose,"www.")!==false){
			$whose=substr_replace($whose, '', 0,3);
		}
		$webinfo=M('Qywebsite')->where(array('site_url'=>$whose))->find();
	    session('site_logo',$webinfo['site_logo']);
		session('site_title',$webinfo['site_title']);
		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$appList=M('Qymyapp')->where(array('status'=>1,'userid'=>$_SESSION['user_id']))->select();
		//dump($appList);exit;
		foreach($appList as $k=>$v){
			$ch=M('Qyapplist')->where(array('id'=>$v['fun_id'],'install'=>1))->find();
			if($user['type']!=1){
				if($ch['vip']<=$user['type']){
				$apps[$k]=$v;
				}
			}else{
				$apps[$k]=$v;
			}
		}
		$jichu = array();
		$sanji = array();
		$yingxiao = array();
		$hangye = array();
		$shangwu = array();
		$crm = array();
		$hudong = array();		
		foreach($apps as $key=>$val){
		    if($val['category'] == 1){
			    $jichu['head'] = '基础功能';
			    $jichu['info'] = '企业办公常用功能';				
			    $jichu['data'][] = $val;
			}elseif($val['category'] == 2){
			    $sanji['head'] = '客户管理';
			    $sanji['info'] = '企业办公常用功能';				
			    $sanji['data'][] = $val;
			}elseif($val['category'] == 3){
			    $yingxiao['head'] = '营销互动';
			    $yingxiao['info'] = '企业办公常用功能';				
			    $yingxiao['data'][] = $val;
			}elseif($val['category'] == 4){
			    $hangye['head'] = '进销存';
			    $hangye['info'] = '企业办公常用功能';				
			    $hangye['data'][] = $val;
			}elseif($val['category'] >= 5){
			    $shangwu['head'] = '其它模块';
			    $shangwu['info'] = '企业办公常用功能';				
			    $shangwu['data'][] = $val;
			}/* elseif($val['category'] == 6){
			    $crm['head'] = 'CRM系统';
			    $crm['info'] = '企业办公常用功能';				
			    $crm['data'][] = $val;
			}elseif($val['category'] == 7){
			    $hudong['head'] = '互动模块';
			    $hudong['info'] = '企业办公常用功能';				
			    $hudong['data'][] = $val;
			} */
		}
		$this->assign('user',$user);
		$this->assign('sanji',$sanji);
		$this->assign('jichu',$jichu);	
		$this->assign('yingxiao',$yingxiao);
		$this->assign('hangye',$hangye);
		$this->assign('shangwu',$shangwu);
		$this->assign('crm',$crm);
		$this->assign('hudong',$hudong);		
		//dump($jichu);exit;
		$this->display();
	}
	//应用中心
	public function appcenter(){
		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//if($user['type']!=1){
		//	$where['vip']=array('ELT',$user['type']);
		//}
		//$where['install']=1;
		//$appList=M('Qyapplist')->where($where)->select();
		$appList=M('Qyapplist')->where(array('install'=>1))->select();
		//dump($appList);exit;
		foreach ($appList as $k=>$v){
			$apps[$k]=$v;
			$c=M('Qymyapp')->where(array('fun_id'=>$v['id'],'userid'=>$_SESSION['user_id']))->find();
			if($c['status']==1){
				$apps[$k]['status']=1;
			}else{
				$apps[$k]['status']=0;
			}
			$data=M('Qyusernode')->where(array('id'=>$v['vip']))->find();
			$apps[$k]['vip']=$data['title'];
		}
		//dump($apps);exit;
		$jichu = array();
		$sanji = array();
		$yingxiao = array();
		$hangye = array();
		$shangwu = array();
		$crm = array();
		$hudong = array();		
		foreach($apps as $key=>$val){
		    if($val['category'] == 1){
			    $jichu['head'] = '基础功能';
			    $jichu['info'] = '企业办公常用功能';				
			    $jichu['data'][] = $val;
			}elseif($val['category'] == 2){
			    $sanji['head'] = '客户管理';
			    $sanji['info'] = '企业办公常用功能';				
			    $sanji['data'][] = $val;
			}elseif($val['category'] == 3){
			    $yingxiao['head'] = '营销互动';
			    $yingxiao['info'] = '企业办公常用功能';				
			    $yingxiao['data'][] = $val;
			}elseif($val['category'] == 4){
			    $hangye['head'] = '进销存';
			    $hangye['info'] = '企业办公常用功能';				
			    $hangye['data'][] = $val;
			}elseif($val['category'] >= 5){
			    $shangwu['head'] = '其它模块';
			    $shangwu['info'] = '企业办公常用功能';				
			    $shangwu['data'][] = $val;
			}/* elseif($val['category'] == 6){
			    $crm['head'] = 'CRM系统';
			    $crm['info'] = '企业办公常用功能';				
			    $crm['data'][] = $val;
			}elseif($val['category'] == 7){
			    $hudong['head'] = '互动模块';
			    $hudong['info'] = '企业办公常用功能';				
			    $hudong['data'][] = $val;
			} */
		}
		//dump($jichu);exit;
		$this->assign('user',$user);
		$this->assign('sanji',$sanji);
		$this->assign('jichu',$jichu);	
		$this->assign('yingxiao',$yingxiao);
		$this->assign('hangye',$hangye);
		$this->assign('shangwu',$shangwu);
		$this->assign('crm',$crm);
		$this->assign('hudong',$hudong);		
		//$this->assign('list',$apps);
		$this->display();
	}
	
	
	public function addapplist(){
		//查出该套件没有安装的应用
		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		if($user['type']!=1){
			$where['vip']=array('ELT',$user['type']);
		}
		$where['install']=1;
		$where['suit_id']=$_GET['suit'];
		$where['suit_appid']=array('neq','');
		$appList=M('Qyapplist')->where($where)->select();
		foreach ($appList as $k=>$v){
			$c=M('Qymyapp')->where(array('fun_id'=>$v['id'],'userid'=>$_SESSION['user_id']))->find();
			if($c['status']!=1){
				$apps[$k]=$v;
			}
			
		}
		$this->assign('list',$apps);
		$this->display();
	}
	
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
	
	public function panelInfo(){
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		$id = $this->_get('id');
		$data=M('Qymyapp')->where(array('status'=>1,'userid'=>$_SESSION['user_id'],'id'=>$id))->find();	
		//dump($data);
		$this->assign('data',$data);
		$this->display();
	}	
	
	public function choose_type(){
		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		$appinfo=M('Qyapplist')->where(array('id'=>$_GET['appid']))->find();
		if($appinfo['vip']>$user['type']){
			$appinfo['az']=1;
		}
		$this->assign('appinfo',$appinfo);
		$this->display();
	}
	
	//卸载 不是删除 只是把记录修改不让看见
	public function delApps(){
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		if(IS_POST){
			if(M('Qymyapp')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$_POST['id']))->save(array('status'=>2,'type'=>1))){
				echo json_encode(array('status'=>1));
			}
	    }
	}
	
	
}