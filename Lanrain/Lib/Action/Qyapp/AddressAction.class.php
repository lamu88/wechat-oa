<?php
/**
*通讯录
**/
class AddressAction extends Action{
	public $logo;	
	public $copyright;
	public $arr = array();	
	public $ret = '';		
	function _initialize(){
				$HTTP_HOST = $_SERVER['HTTP_HOST'];

			$data=M('Qywebsite')->where(array('uid'=>1))->find();
			if(empty($data['copyright'])){
				$this->copyright = '版权所有';
				$this->logo = '';			
			}else{
				$this->copyright = $data['copyright'];	
				$this->logo = $data['site_logo'];			
			}
			if(!isset($_GET['mid']) || empty($_GET['mid'])){
				$mymodule = M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>MODULE_NAME))->find();
				$_GET['mid'] = $mymodule['id'];
			}
			$this->assign('copyright',$this->copyright);	
			$this->assign('logo',$this->logo);	            		
	}
	
private function check(){
	if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
	}
}	
	
public function index(){
    $this->check();
	$this->redirect(U('Appmsg/conf',array('mid'=>$_GET['mid'])));	
}
public function appmanage(){
    $this->check();
	$this->display();
}	
public function wap_index2222(){

	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();

	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Address';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	}	
	
	//$cache=S($app['userid'].'_address');
	//if($cache!=date('Ymd')){
	//	S($app['userid'].'_address',date('Ymd'));
	//	$this->userup($app['userid']);
	//}
	//dump($_GET);exit;
	
	//$first=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>0))->find();
	$first=M('Department')->where(array('user_id'=>$app['userid']))->select();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	$this->assign('first',$first);
	//dump($first);exit;
	$this->display();
}

public function wap_index(){

	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if(!$_GET['wecha_id']){
		$data['token']=$_GET['token'];
		$data['module']='Address';
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
		$data['corpid']=$user['corpid'];
		$Oauth=A('Qyapp/Oauth');
		$Oauth->index($data);
	}	
	$data=M('department')->where(array('user_id'=>$app['userid']))->select();	
	if($data){
		foreach($data as $k=>$v){
			$nodes[$v['wxid']] = $v;    
		}
	}
	//dump($nodes);exit;
	$this->arr = $nodes;	
	$str = '<ul class="mod_common_list">';
	$str .= $this->get_tree(0);		
	$str .= '</ul>';
	$this->assign('str',$str);	
	//echo $str;exit;
	/* if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	} */
	//$this->assign('str',$str);
	$this->display();
}

/**
* 得到子级数组
* @param int
* @return array
*/
public function get_child($myid){
	$a = $newarr = array();
	if(is_array($this->arr)){
		foreach($this->arr as $id => $a){
			if($a['wxpid'] == $myid) $newarr[$id] = $a;
		}
	}
	return $newarr ? $newarr : false;
}

public function get_tree($myid, $str){
	
	$number=1;
	$child = $this->get_child($myid);
	if(is_array($child)){
		$total = count($child);
		foreach($child as $id=>$value){
			$haschild = $this->get_child($id);
/* 			if($myid == 0){
				if(is_array($haschild)){

					$this->ret .= '<li class="dpm" id="department_0" data-idx="0" data-path="0"><a class="m_link" href=""><img src="./Tpl/Qyapp/Address/img/guanfang.png">'.$value['name'].'</a><ul >';
					$this->get_tree($id);
					$this->ret .= '</ul></li>';	
				
				}else{
					$this->ret .= '<li class="dpm" id="department_0" data-idx="0" data-path="0" style="height:30px;line-height:30px;"><a class="m_link" href=""><img src="./Tpl/Qyapp/Address/img/guanfang.png">'.$value['name'].'</a></li>';
				}				
			}else{ */
				if(is_array($haschild)){

					$this->ret .= '<li class="dpm" id="department_0" data-idx="0" data-path="0"><a class="m_link" href="" style="display:block;"><img src="./Tpl/Qyapp/Address/img/guanfang.png">'.$value['name'].'</a><ul  class="mod_common_list">';
					$this->get_tree($id);
					$this->ret .= '</ul></li>';	
				
				}else{
					$this->ret .= '<li class="dpm" id="department_0" style="height:30px;line-height:30px;" data-idx="0" data-path="0"><a class="m_link" href=""><img src="./Tpl/Qyapp/Address/img/guanfang.png">'.$value['name'].'</a></li>';
				}				
			/* } */				

			$number++;					

		}
	}
	
	return $this->ret;
}

public function wap_list(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$father=M('Department')->where(array('user_id'=>$app['userid'],'wxid'=>$_GET['id']))->find();
	$this->assign('father',$father);
	$listde=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->select();
	$map['pid']=array('like','%;'.$_GET['id'].';%');
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	//dump($listde);
	$this->assign('users',$users);
	$this->assign('de',$listde);
	$this->display();
}


public function wap_all(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	//dump($app);exit;
	//$father=M('Department')->where(array('user_id'=>$app['userid'],'wxid'=>$_GET['id']))->find();
	//$this->assign('father',$father);
	//$listde=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->select();
	//$map['pid']=array('like','%;'.$_GET['id'].';%');
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
	$this->assign('users',$users);
	$this->assign('de',$listde);
	$this->display();
}

public function userinfo(){
	$user=M('Qyusers')->where(array('id'=>$_GET['id']))->find();
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$this->assign('user',$user);
	$pid=explode(';',$user['pid']);
	 foreach($pid as $k=>$v){
		 $infos=M('Department')->where(array('wxid'=>$v,'user_id'=>$app['userid']))->field('name')->find();
		 $str.=$infos['name'];
	 }
	// dump($str);
	 $this->assign('str',$str);
	$this->display();
}	


//一键同步通讯录
	public function userup($user_id){
		$user=M('qytoken')->where(array('id'=>$user_id))->find();
		$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
		if($access_token['expires_in']!=7200){
			$this->error('企业号设置有误',U('Userinfo/bind'));
		}
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token='.$access_token['access_token'].'&department_id=1&fetch_child=1&status=0';
		$userList=json_decode($this->curlGet($url_get),true);
		$userids='';
		foreach($userList['userlist'] as $k=>$v){
			$che=M('Qyusers')->where(array('userid'=>$v['userid'],'user_id'=>$user_id))->find();
			if(!$che){
				$info=$v;
				$name=$this->save_pic($info['avatar']);
				foreach($info['department'] as $ke=>$ve){
					$str.=$ve.';';
				}
				$info['pid']=';'.$str;
				$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
				$info['avatar']=$info['pic'];
				$info['user_id']=$user_id;
				$memberinfo=json_encode($info);
				if(!$user_id) $info['user_id']=$user_id;
				M('Qyusers')->add($info);
			}
			$userids.=$v['userid'].';';
		}
		$users=M('Qyusers')->where(array('user_id'=>$user_id))->field('userid,id')->select();
		foreach($users as $ke=>$ve){
			$chec=strstr($userids,$ve['userid'].';');
			if($chec==false){
				M('Qyusers')->where(array('id'=>$ve['id']))->delete();
			}
		}
		return true;
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







}