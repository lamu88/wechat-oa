<?phpclass IndexAction extends Action {	public $result = array();		public $ret = '';	public $logo;		public $copyright;		function _initialize(){		$data=M('Qywebsite')->where(array('uid'=>1))->find();		if(empty($data['copyright'])){			$this->logo = '';					}else{			$this->copyright = $data['copyright'];					}		if(!isset($_GET['mid']) || empty($_GET['mid'])){			$mymodule = M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>MODULE_NAME))->find();			$_GET['mid'] = $mymodule['id'];		}		$this->assign('logo',$this->logo);	            			}		private function check(){		if($_SESSION['username']==''){			   $this->error('非法操作',U('Weiyi/Weiyi/login'));		}	}			    public function index(){        $this->check();		$user=M('Qytoken')->where(array('id'=>$_SESSION['user_id']))->find();		$appList=M('Qymyapp')->where(array('status'=>1,'userid'=>$_SESSION['user_id']))->select();		foreach($appList as $k=>$v){			$ch=M('Qyapplist')->where(array('id'=>$v['fun_id'],'install'=>1))->find();			if($user['type']!=1){				if($ch['vip']<=$user['type']){				$apps[$k]=$v;				}			}else{				$apps[$k]=$v;			}		}		$this->assign('user',$user);		$this->assign('list',$apps);			$this->display();    }			//通讯录	public function userList(){	    $this->check();		$node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : 0;		$node =M('Department')->where(array('id'=>$node))->find();		$common = A('Qyapp/Common');		if($node){			//0获取全部员工，1获取已关注成员列表，2获取禁用成员列表，4获取未关注成员列表。			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();			if($appinfo){				$user['corpid']='';				$user['corpsecret']='';			}			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);						if(!$_GET['status']){				$_GET['status']=0;//默认获取全部员工			}			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];			$List=json_decode($this->curlGet($url_get),true);			$memberList="";			foreach ($List['userlist'] as $k=>$v){				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];				$memberinfo=json_decode($this->curlGet($url_get),true);				$memberList[$k]=$memberinfo;				$memberList[$k]['leaderuserid']=$node['leaderuserid'];			}			$this->assign('node',$node);			$this->assign('userlist',$memberList);			$this->display();						}else{			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();			if($appinfo){				$user['corpid']='';				$user['corpsecret']='';			}			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);									if(!$_GET['status']){				$_GET['status']=0;//默认获取全部员工			}			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$_GET['Did'].'&fetch_child=0&status='.$_GET['status'];			$List=json_decode($this->curlGet($url_get),true);			$memberList="";			foreach ($List['userlist'] as $k=>$v){				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];				$memberinfo=json_decode($this->curlGet($url_get),true);				$memberList[$k]['leaderuserid']=$node['leaderuserid'];				$memberList[$k]=$memberinfo;			}			$this->assign('node',$node);			$this->assign('userlist',$memberList);		//更新通讯录			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();			if($appinfo){				$user['corpid']='';				$user['corpsecret']='';			}			$commom = A('Qyapp/Common');			$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$appinfo['userid']);			if($access_token['expires_in']!=7200){				$this->error('企业号设置有误',U('Userinfo/bind'));			}			$url_get='https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token['access_token'];			$departList=json_decode($this->curlGet($url_get),true);			$checkc=M('Department')->where(array('wxid'=>1,'wxpid'=>0,'user_id'=>$_SESSION['user_id']))->find();			if(!$checkc){					if(!$departList['department'][0]['name']) $departList['department'][0]['name']="企业号通讯录";					M('Department')->add(array('name'=>$departList['department'][0]['name'],'wxid'=>1,'wxpid'=>0,'lft'=>0,'rgt'=>2,'user_id'=>$_SESSION['user_id'],'pid'=>0));			}			foreach($departList['department'] as $k=>$v){				$check=M('Department')->where(array('wxid'=>$v['id'],'wxpid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->find();				if($check){					M('Department')->where(array('wxid'=>$v['id'],'wxpid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->save(array('name'=>$v['name']));				}else{					$pid=M('Department')->where(array('wxid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->find();					$wx['wxid']=$v['id'];					$wx['wxpid']=$v['parentid'];					$Tree = A("Qyapp/Tree");					$temp =$Tree->mk($pid['id'],0,array('name' =>$v['name']),$wx);				}						}			$info=M('Department')->where(array('user_id'=>$_SESSION['user_id']))->select();			$arr = $this->getTree($info,0);			$arr[0]['state']= array('selected'=>"true");						$depart = json_encode($arr);					str_replace("\"true\"","true",$depart);			$this->assign('department',$depart);						$this->display();				}	}    	public function getTree($data,$pid){	    $tree = '';		foreach($data as $k=>$v){		    if($v['pid'] == $pid){			    $v['text'] = $v['name'];			    $v['children'] = $this->getTree($data,$v['id']);				$tree[] = $v;			}		}		return $tree;	}		//一键同步通讯录	public function userup(){		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();				//判断		$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();		if($appinfo){			$user['corpid']='';			$user['corpsecret']='';		}		$commom = A('Qyapp/Common');		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$appinfo['userid']);		if($access_token['expires_in']!=7200){			$this->error('企业号设置有误',U('Userinfo/bind'));		}		M('Department')->where(array('userid'=>$_SESSION['user_id']))->delete();				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token='.$access_token['access_token'].'&department_id=1&fetch_child=1&status=0';		$userList=json_decode($this->curlGet($url_get),true);		$userids='';		foreach($userList['userlist'] as $k=>$v){			$che=M('Qyusers')->where(array('userid'=>$v['userid'],'user_id'=>$_SESSION['user_id']))->find();			if(!$che){				$info=$v;				foreach($info['department'] as $ke=>$ve){					$str.=$ve.';';				}				$info['pid']=';'.$str;				$info['pic']=$info['avatar'];				$info['user_id']=$_SESSION['user_id'];				M('Qyusers')->add($info);			}else{				//部门调整				$info=$v;				$str='';				foreach($info['department'] as $ke=>$ve){					$str.=$ve.';';				}				$info['pid']=';'.$str;				$info['pic']=$info['avatar'];				$info['user_id']=$_SESSION['user_id'];				M('Qyusers')->where(array('id'=>$che['id']))->save($info);			}			$userids.=$v['userid'].';';		}				$users=M('Qyusers')->where(array('user_id'=>$_SESSION['user_id']))->field('userid,id')->select();		foreach($users as $ke=>$ve){			$chec=strstr($userids,$ve['userid'].';');			if($chec==false){				M('Qyusers')->where(array('id'=>$ve['id']))->delete();			}		}		$this->success('更新成功');		}	public function mk($parent, $position = 0, $data = array(),$wx =array()) {		$parent = (int)$parent;		if($parent == 0) { $this->error('参数错误'); }		$parent = R( 'Tree/get_node',array($parent, array('with_children'=> true)));		if(!$parent['children']) { $position = 0; }		if($parent['children'] && $position >= count($parent['children'])) { $position = count($parent['children']); }		$sql = array();		$par = array();		// PREPARE NEW PARENT 		// update positions of all next elements		$sql[] = "UPDATE tp_department SET pos = pos + 1 WHERE pid =".(int)$parent['id']." and pos >= ".$position;		$par[] = false;		// update left indexes		$ref_lft = false;		if(!$parent['children']) {			$ref_lft = $parent['rgt'];		}		else if(!isset($parent['children'][$position])) {			$ref_lft = $parent['rgt'];		}		else {			$ref_lft = $parent['children'][(int)$position]['lft'];		}		$sql[] = "UPDATE tp_department SET lft = lft + 2 WHERE lft >=".$ref_lft;		$par[] = false;		// update right indexes		$ref_rgt = false;		if(!$parent['children']) {			$ref_rgt = $parent['rgt'];		}		else if(!isset($parent['children'][$position])) {			$ref_rgt = $parent['rgt'];		}		else {			$ref_rgt = $parent['children'][(int)$position]['lft'] + 1;		}		$sql[] = "UPDATE tp_department SET rgt = rgt + 2 WHERE rgt >=".(int)$ref_rgt;        $options = array(	'structure'	=> array(			              											'left'			=> 'lft',											'right'			=> 'rgt',											'level'			=> 'lvl',											'parent_id'		=> 'pid',											'position'		=> 'pos')			);		$tmp = array();		foreach($options['structure'] as $k => $v) {			switch($k) {					case 'name': 					$tmp[] = $data['name'];					$info['name'] = $data['name'];					break;										case 'left': 					$tmp[] = (int)$ref_lft;					$info['lft'] = (int)$ref_lft;					break;				case 'right': 					$tmp[] = (int)$ref_lft + 1;					$info['rgt'] = (int)$ref_lft + 1;					break;				case 'level': 					$tmp[] = (int)$parent[$v] + 1;					$info['lvl'] = (int)$parent[$v] + 1;					break;				case 'parent_id': 					$tmp[] = $parent['id'];					$info['pid'] = $parent['id'];					break;				case 'position': 					$tmp[] = $position;					$info['pos'] = $position;					break;				default:					$tmp[] = null;			}		}		$Model = new Model();		foreach($sql as $k => $v) { 			$Model->query($v);		}				$info['name'] = $data['name'];		$info['user_id'] = $_SESSION['user_id'];		$info['wxpid'] = $wx['wxpid'];		$info['wxid'] = $wx['wxid'];		$resultid = M('Department')->add($info);		return $node;	}		function curlGet($url){		$ch = curl_init();		$header = "Accept-Charset: utf-8";		curl_setopt($ch, CURLOPT_URL, $url);		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		$temp = curl_exec($ch);		return $temp;	}		function https_request($url, $data = null)		{			$curl = curl_init();			curl_setopt($curl, CURLOPT_URL, $url);			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);			if (!empty($data)){				curl_setopt($curl, CURLOPT_POST, 1);				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			}			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);			$output = curl_exec($curl);			curl_close($curl);			return $output;		}		}