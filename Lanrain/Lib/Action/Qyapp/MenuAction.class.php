<?php
/*
*自定义菜单接口
*/
class MenuAction extends Action {
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}

    public function wap_index1(){
	 
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid,module')->find();
 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Menu';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();	
			$data['corpid']=$user['corpid'];			
			$Oauth=A('Qyapp/Wapoauth');
			$Oauth->index($data);
		} 		
		$info = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id')->find();  
		$arr = M('disturb_users')->where(array('user_id'=>$app['userid'],'uid'=>$info['id']))->field('wecha_id')->find();
		$newurl = str_replace('{wecha_id}',$arr['wecha_id'],$url);
		header("Location:".$newurl);		
	}	

    public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('id,userid,module')->find();
	    //$info = M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$data['appid']))->field('module')->find();		
		
	    $data = M('Qymenu')->where(array('user_id'=>$app['userid'],'type'=>2,'appid'=>$app['id']))->field('user_id,link,appid')->find();
		$url = $data['link'];
		if(strpos($url,'{wecha_id}') === false){
		    header("Location:".$url);
		}else{
		
			if(!$_GET['wecha_id']){

				$data['token']=$_GET['token'];
				$data['module']=$app['module'];
				$data['link']=$url;
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];			
				$Oauth=A('Qyapp/Wapoauth');
				$Oauth->index($data);
			}
		}
		
	}
	
	public function menu(){
	    $this->check();
		//自定义菜单默认在本地服务器
		$fist=M('Qymenu')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>0,'appid'=>$_GET['mid']))->field('id,name')->select();
		foreach($fist as $k=>$v){
			$fist[$k]['info']=M('Qymenu')->where(array('pid'=>$v['id'],'user_id'=>$_SESSION['user_id'],'appid'=>$_GET['mid']))->field('id,name')->select();
		}
		$token=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$_GET['mid']))->field('token')->find();
		$this->assign('token',$token);
		$this->assign('first',$fist);
		$this->display();
	}
	
	/**
	*子菜单
	**/
	public function subMenu(){
	    $this->check();
		$data=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$_GET['mid']))->find();	
		$module = $data['module'];
		$this->display($module.":navmenu");
	}	
	
	public function addfirst(){
	    $this->check();
		//自定义菜单默认在本地服务器
		if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
			$_POST['pid']=0;
		    //print_r($_POST);exit;
			$checkda=M('Qymenu')->where(array('user_id'=>$_SESSION['user_id'],'appid'=>$_POST['appid'],'pid'=>0))->count();
			if($checkda >= 3){
				echo json_encode(array('status'=>3));exit();
			}
			
			if($_POST['type'] == 1){  //关键词
				if($_POST['keyword']){
					$appinfo=M('Qyapplist')->where(array('module'=>$_POST['keyword']))->field('module')->find();
					$myapp=M('Qymyapp')->where(array('module'=>$_POST['keyword'],'userid'=>$_SESSION['user_id']))->field('token')->find();
					$_POST['link']='http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m='.$appinfo['module'].'&a=wap_index&token='.$myapp['token'];
					//$_POST['keyword']='';
				}			
			}elseif($_POST['type'] == 2){  //自定义链接
				// F('1',$_POST);
				if($_POST['link']){
					$myapp=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->field('token')->find();
					$_POST['link']=$_POST['link'].'&token='.$_POST['custom_token'];
					//$_POST['type'] = '2';
				}			
			}else{  //微信扫码等。。。
			    $_POST['keyword']='';
				$_POST['link'] = '';
			}
			$id=M('Qymenu')->add($_POST);
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
		    $id = $_GET['mid'];
			$keywords=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$id))->select();
			$this->assign('keyword',$keywords);
			$this->display();
		}
		
	}
	
	public function addnext(){
	    $this->check();
		//自定义菜单默认在本地服务器
		if(IS_POST){
			F('1',$_POST);
			$_POST['user_id']=$_SESSION['user_id'];	 
			if($_POST['type'] == 1){  //关键词
				if($_POST['keyword']){
					$appinfo=M('Qyapplist')->where(array('module'=>$_POST['keyword']))->field('module')->find();
					$myapp=M('Qymyapp')->where(array('module'=>$_POST['keyword'],'userid'=>$_SESSION['user_id']))->field('token')->find();
					$_POST['link']='http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m='.$appinfo['module'].'&a=wap_index&token='.$myapp['token'];
					//$_POST['keyword']='';
				}			
			}elseif($_POST['type'] == 2){  //自定义链接
				if($_POST['link']){
					$myapp=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->field('token')->find();
					$_POST['link']=$_POST['link'].'&token='.$_POST['custom_token'];
					//$_POST['type'] = '2';
					
				}			
			}else{  //微信扫码等。。。
			    $_POST['keyword']='';
				$_POST['link'] = '';
			}			
			$id=M('Qymenu')->add($_POST);
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
		    $id = $_GET['mid'];		    
			$info=M('Qymenu')->where(array('id'=>$_GET['pid'],'user_id'=>$_SESSION['user_id']))->find();
			$this->assign('infos',$info);
			$keywords=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$id))->select();
			//print_r($keywords);exit;
			$this->assign('keywords',$keywords);
			$this->display();
		}
		
	}
	public function save(){
		//修改自定义菜单
		if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
			if($_POST['link']){
			    $_POST['type'] = '2';
				if(strpos($_POST['link'],'&token=') !== false ){
				    
					$_POST['link'] = $_POST['link'];
				}else{
				    $_POST['link'] = $_POST['link'].'&token='.$_POST['custom_token'];
				}
			}			
			$id=M('Qymenu')->where(array('id'=>$_POST['cid']))->save($_POST);
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
			$info=M('Qymenu')->where(array('id'=>$_GET['cid']))->find();
			
			$str = explode('&token=',$info['link']);
			$info['custom_token'] = $str[1];
			$info['link'] = $str[0];
			//print_r($info);exit;
			$this->assign('info',$info);
			$keywords=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'id'=>$_GET['mid']))->field('id,name,module')->select();
			$this->assign('keyword',$keywords);
			$this->display();			
			
			
		}
	}
	public function del(){
		//修改自定义菜单
		if(IS_POST){
			$id=M('Qymenu')->where(array('id'=>$_POST['id']))->delete();
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}
	}
	public function updata(){
		if(IS_POST){
			$agentid=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->field('id,appid,token')->find();
			$list=$this->menuList($agentid['appid']);
			$menuDel=$this->menuDel($agentid['appid']);
			if($menuDel['errcode']!==0){
				$this->error('更新自定义菜单失败,请检查参数');
			}
			$list=M('Qymenu')->where(array('appid'=>$_GET['mid'],'user_id'=>$_SESSION['user_id'],'pid'=>0))->select();
			$arr=array();
			$i=0;
			foreach($list as $k=>$v){
				$arr[$i]['name']=urlencode($v['name']);
				$m=0;
				$chiarr=array();
				$childen=M('Qymenu')->where(array('appid'=>$_GET['mid'],'user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->select();
				
				if($childen){
					foreach($childen as $ke=>$va){
						if($va['type'] == '1'){  //关键词
							if($va['link']) {
								$chiarr[$m]['type']='view';
								$chiarr[$m]['url']=$va['link'];
							}else{
								$chiarr[$m]['type']='click';
								$chiarr[$m]['key']=urlencode($va['keyword']);
							}						    
						}elseif($va['type'] == '2'){  //自定义链接
							if($va['link']) {
								$chiarr[$m]['type']='view';
								$link='http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Woauth&a=wap_index&menuid='.$va['id'].'&userid='.$_SESSION['user_id'];
								$chiarr[$m]['url']=$link;
							}						
						}elseif($va['type'] == '3'){  //扫码推事件
							$chiarr[$m]['type']='scancode_push';   						
						}elseif($va['type'] == '4'){  //扫码带提示
							$chiarr[$m]['type']='scancode_waitmsg';   						
						}elseif($va['type'] == '5'){  //弹出系统拍照发图
							$chiarr[$m]['type']='pic_sysphoto';  					
						}elseif($va['type'] == '6'){  //弹出拍照或者相册发图
							$chiarr[$m]['type']='pic_photo_or_album';     						
						}elseif($va['type'] == '7'){  //弹出微信相册发图器
							$chiarr[$m]['type']='pic_weixin';  					
						}elseif($va['type'] == '8'){  //弹出地理位置选择器
							$chiarr[$m]['type']='location_select';     						
						}
						$chiarr[$m]['name']=urlencode($va['name']);
						$chiarr[$m]['key']=urlencode($va['name']);
						$chiarr[$m]['sub_button']=array();
						$m++;
					}
					
				}
				else
				{
				    if($v['type'] == '1'){
						if($v['link']){
							$arr[$i]['url']=urlencode($v['link']);
							$arr[$i]['type']='view';
						}else{
							$arr[$i]['key']=urlencode($v['keyword']);
							$arr[$i]['type']='click';
						}						
					}elseif($v['type'] == '2'){
						if($v['link']){
						    $link='http://'.$_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Woauth&a=wap_index&menuid='.$v['id'].'&userid='.$_SESSION['user_id'];
							$arr[$i]['url']=urlencode($link);
							$arr[$i]['type']='view';
						}						
					}elseif($v['type'] == '3'){  //扫码推事件
						$arr[$i]['type']='scancode_push';   						
					}elseif($v['type'] == '4'){  //扫码带提示
						$arr[$i]['type']='scancode_waitmsg';   						
					}elseif($v['type'] == '5'){  //弹出系统拍照发图
						$arr[$i]['type']='pic_sysphoto';  					
					}elseif($v['type'] == '6'){  //弹出拍照或者相册发图
						$arr[$i]['type']='pic_photo_or_album';     						
					}elseif($v['type'] == '7'){  //弹出微信相册发图器
						$arr[$i]['type']='pic_weixin';  					
					}elseif($v['type'] == '8'){  //弹出地理位置选择器
						$arr[$i]['type']='location_select';     						
					}
				    $arr[$i]['key']=urlencode($v['name']);
				
				}
				$arr[$i]['sub_button']=$chiarr;
			$i++;
			}
			$post['button']=$arr;
			$data=urldecode(json_encode($post));
			$re=$this->menuAdd($data,$agentid['appid']);
			if($re['errcode']==0){
				$this->success('更新自定义菜单更新成功');
			}else{
				$this->error('更新自定义菜单失败,请检查参数');
			}
		}
	}
	public function turn_back(){
		//安装过程中一键更新自定义菜单成官方菜单
		$checkdata=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->find();
		//dump($checkdata);exit;
		if($checkdata){
			M('Qymenu')->where(array('user_id'=>$_SESSION['user_id'],'appid'=>$checkdata['id']))->delete();
			$class_list=M('App_class')->where(array('module'=>$checkdata['module']))->select();
			foreach($class_list as $v){
				M('Qymenu')->add(array(
					'user_id'=>$_SESSION['user_id'],
					'appid'=>$checkdata['id'],
					'name'=>$v['name'],
					'pid'=>0,
					'link'=>'http://'.$_SERVER['SERVER_NAME'].$v['url'].'&token='.$checkdata['token'],
					'type'=>'1'
				));
			}
		}
		$this->success('操作成功');
	}
	
	/*******接口api*********/
   //创建自定义菜单
	public function menuAdd($arr,$agentid){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$agentid);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token['access_token'].'&agentid='.$agentid;
		$data=$arr;
		$post=$this->api_notice_increment($url_post,$data);
		$menu=json_decode($post,true);
		return $menu;
	}
	//删除自定义菜单
	public function menuDel($agentid){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$agentid);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/menu/delete?access_token='.$access_token['access_token'].'&agentid='.$agentid;
		$post=$this->curlGet($url_post);
		$menu=json_decode($post,true);
		return $menu;
	}
	
	
	//获取菜单列表
	public function menuList($agentid){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$agentid);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token['access_token'].'&agentid='.$agentid;
		$post=$this->curlGet($url_post);
		$menu=json_decode($post,true);
		return $menu;
	}
	
	public function access_token($api,$secret,$agentid){
		if($api&&secret){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
			$json=json_decode($this->curlGet($url_get), true);
		}else{
			$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->field('appid,userid')->find();
			$json=$this->access_token_get($appinfo['appid'],$appinfo['userid']);
		}
		return $json;
	}
	
	//获取组件安装后的access_token
	public function access_token_get($agentid,$user_id){  
		$suite_access_token=$this->suite_access_token($agentid,$user_id);
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_corp_token?suite_access_token='.$suite_access_token['suite_access_token'];
		$data=M('Qymyapp')->where(array('userid'=>$user_id,'appid'=>$agentid))->find();
		$user=M('Qytoken')->where(array('id'=>$user_id))->find();
		$info['suite_id']=$data['suit_id'];
		$info['auth_corpid']=$user['th_corpid'];
		$info['permanent_code']=$user['permanent_code'];
		$re=json_decode($this->https_request($url,json_encode($info)),true);
		return $re;
	}
	
	public function suite_access_token($agentid,$user_id){
		$url='https://qyapi.weixin.qq.com/cgi-bin/service/get_suite_token';
		$app=M('Qymyapp')->where(array('userid'=>$user_id,'appid'=>$agentid))->field('suit_id')->find();
		$data=M('Suiteid')->where(array('suiteid'=>$app['suit_id']))->find();
		$info['suite_id']=$data['suiteid'];
		$info['suite_secret']=$data['su_secret'];
		$info['suite_ticket']=$data['suiteticket'];
		$p=json_encode($info);
		$re=json_decode($this->api_notice_increment($url,$p),true);
		return $re;
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