<?php
/*
*树形结构
*
*/
class TreeAction extends Action {
	public function _initialize() {		
		if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}
	
	//通讯录
	public function department(){
		    $info = M('Department')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>0))->find();
			$node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : $info['id'];
			$node =M('Department')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$node))->find();
			$common = A('Qyapp/Common');
			if($node){
				//0获取全部员工，1获取已关注成员列表，2获取禁用成员列表，4获取未关注成员列表。
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
				
				if(!$_GET['status']){
					$_GET['status']=0;//默认获取全部员工
				}
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];
				$List=json_decode($this->curlGet($url_get),true);
				$memberList="";
				foreach ($List['userlist'] as $k=>$v){
					$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
					$memberinfo=json_decode($this->curlGet($url_get),true);
					$memberList[$k]=$memberinfo;
					$memberList[$k]['leaderuserid']=$node['leaderuserid'];
				}
				$this->assign('node',$node);
				$this->assign('userlist',$memberList);
				$this->display();				
			}else{
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
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
					$memberList[$k]['leaderuserid']=$node['leaderuserid'];
					$memberList[$k]=$memberinfo;
				}
				$this->assign('node',$node);
				$this->assign('userlist',$memberList);
	
			//更新通讯录
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
			if($access_token['expires_in']!=7200){
				$this->error('企业号设置有误',U('Userinfo/bind'));
			}
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token['access_token'];
			$departList=json_decode($this->curlGet($url_get),true);
			//更新根目录
			$checkc=M('Department')->where(array('wxid'=>1,'wxpid'=>0,'user_id'=>$_SESSION['user_id']))->find();
			if(!$checkc){
					if(!$departList['department'][0]['name']) $departList['department'][0]['name']="企业号通讯录";
					M('Department')->add(array('name'=>$departList['department'][0]['name'],'wxid'=>1,'wxpid'=>0,'lft'=>0,'rgt'=>2,'user_id'=>$_SESSION['user_id'],'pid'=>0));
			}
			foreach($departList['department'] as $k=>$v){
				$check=M('Department')->where(array('wxid'=>$v['id'],'wxpid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->find();
				if($check){
					M('Department')->where(array('wxid'=>$v['id'],'wxpid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->save(array('name'=>$v['name']));
				}else{
					$pid=M('Department')->where(array('wxid'=>$v['parentid'],'user_id'=>$_SESSION['user_id']))->find();
					$wx['wxid']=$v['id'];
					$wx['wxpid']=$v['parentid'];
					$Tree = A("Qyapp/Tree");
					$temp =$Tree->mk($pid['id'],0,array('name' =>$v['name']),$wx);
				}
			
			}
			$info=M('Department')->where(array('user_id'=>$_SESSION['user_id']))->select();
			$arr = $this->getTree($info,0);
            $arr[0]['state']= array('selected'=>"true");			
            $depart = json_encode($arr);		
			str_replace("\"true\"","true",$depart);
			$this->assign('department',$depart);			
			$this->display();
		
		}
	}	
	
	/**
	*获取数据
	**/
	public function myTree(){
	    $this->display();
	}
	/**
	*获取成员列表
	**/
	public function userList(){
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
			$memberList[$k]['leaderuserid']=$node['leaderuserid'];
			$memberList[$k]=$memberinfo;
		}
		$this->assign('userlist',$memberList);    
	    $this->display();
	}	

	/**
	*获取数据
	**/
	public function members(){
		$result =M('Department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>0))->find();
		$nodeid = isset($_GET['id']) ? $_GET['id'] : $result['id'];
		$node =M('Department')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$nodeid))->find();
		$common = A('Qyapp/Common');
		if($node){
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
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];
			$List=json_decode($this->curlGet($url_get),true);
			$memberList="";
			foreach ($List['userlist'] as $k=>$v){
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
				$memberinfo=json_decode($this->curlGet($url_get),true);
				$memberList[$k]=$memberinfo;
				$memberList[$k]['leaderuserid']=$node['leaderuserid'];
			}
			$this->assign('nodeid',$nodeid);			
			$this->assign('node',$node);
			$this->assign('userlist',$memberList);
			$this->display();				
		}else{
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
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
				$memberList[$k]['leaderuserid']=$node['leaderuserid'];
				$memberList[$k]=$memberinfo;
			}
			$this->assign('node',$node);
			$this->assign('nodeid',$nodeid);	
			$this->assign('userlist',$memberList);
			$this->display();	
		}	
	}	
	
	/**
	*获取指定的部门下的成员
	**/
	public function getMember(){
	    $nodeid = $_GET['nodeid'];
		//dump($_GET);exit;
        if(!$nodeid){
		    $this->error('参数错误');
		}
		$node =M('Department')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$nodeid))->find();
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
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];
		$List=json_decode($this->curlGet($url_get),true);
		$memberList="";
		foreach ($List['userlist'] as $k=>$v){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
			$memberinfo=json_decode($this->curlGet($url_get),true);
			$memberList[$k]=$memberinfo;
			$memberList[$k]['leaderuserid']=$node['leaderuserid'];
		}
		$this->assign('nodeid',$nodeid);			
		$this->assign('node',$node);
		$this->assign('userlist',$memberList);
		$this->display('Tree:members');
	}
	
	/**
	*获取指定的成员
	**/
	public function getOne(){
	    $nodeid = $_GET['nodeid'];
        if(!$nodeid){
		    $this->error('参数错误');
		}
		$userid = substr($_GET['name'],0,strpos($_GET['name'],'('));
		$node =M('Department')->where(array('id'=>$nodeid))->find();
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
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
		$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];
		$List=json_decode($this->curlGet($url_get),true);
		$memberList="";
		foreach ($List['userlist'] as $k=>$v){
		    if($v['userid'] == $userid){
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
				$memberinfo=json_decode($this->curlGet($url_get),true);			
			    $memberList[0]=$memberinfo;
			    $memberList[0]['leaderuserid']=$node['leaderuserid'];				
			}
		}
		$this->assign('nodeid',$nodeid);			
		$this->assign('node',$node);
		$this->assign('userlist',$memberList);
		$this->display('Tree:members');
	}	
	
	/**
	*获取数据
	**/
	public function operate(){
		$rslt = null;
		if($_GET['operation'] == 'get_content'){
			$node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : 0;
			$node =M('Department')->where(array('id'=>$node))->find();
			$common = A('Qyapp/Common');
			if($node){
				//0获取全部员工，1获取已关注成员列表，2获取禁用成员列表，4获取未关注成员列表。
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				
				$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
				
				if(!$_GET['status']){
					$_GET['status']=0;//默认获取全部员工
				}
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$node['wxid'].'&fetch_child=0&status='.$_GET['status'];
				$List=json_decode($this->curlGet($url_get),true);
				$memberList="";
				foreach ($List['userlist'] as $k=>$v){
					$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
					$memberinfo=json_decode($this->curlGet($url_get),true);
					$memberList[$k]=$memberinfo;
					$memberList[$k]['leaderuserid']=$node['leaderuserid'];
				}
				$this->assign('node',$node);
				$this->assign('userlist',$memberList);
				$this->display();				
			}else{
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
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
					$memberList[$k]['leaderuserid']=$node['leaderuserid'];
					$memberList[$k]=$memberinfo;
				}
				$this->assign('node',$node);
				$this->assign('userlist',$memberList);
				$this->display();	
			}		
		}else{
		
			switch($_GET['operation']) {
				case 'analyze':
					var_dump($this->analyze(true));
					die();
					break;
				case 'get_node':
					$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
					$temp = $this->get_children($node);
					$rslt = array();
					foreach($temp as $v) {
						$rslt[] = array('id' => $v['id'], 'text' => $v['name'], 'children' => ($v['rgt'] - $v['lft'] > 1));
					}
					break;
				case 'create_node':
					$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
					$temp = $this->add_node_c($node, isset($_GET['position']) ? (int)$_GET['position'] : 0, array('name' => isset($_GET['text']) ? $_GET['text'] : '新部门'));
					$rslt = array('id' => $temp);
					break;
				case 'rename_node':
					$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
					$rslt = $this->save_node_c($node, array('name' => isset($_GET['text']) ? $_GET['text'] : '重命名'));
					break;
				case 'delete_node':
					$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
					$rslt = $this->delete_node_c($node);
					break;
				default:
					throw new Exception('Unsupported operation: ' . $_GET['operation']);
					break;
			}
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($rslt);
		}

	}
	
	public function delete_node_c($id)
	{
		//先删除微信那边
		$Userlist=A('Qyapp/Userlist');
		$departDel=$Userlist->departDel($id);
		if($departDel['errcode']==0){
			//删除成功
			$rslt = $this->rm($id);
			return $rslt;
		}else{
			return false;
		}
	}
	
	//修改
	public function save_node_c($id,$data){
		$Userlist=A('Qyapp/Userlist');
		$node =M('Department')->where(array('id'=>$id))->find();
		$data['wxpid']=$node['wxpid'];
		$data['wxid']=$node['wxid'];
		$departDel=$Userlist->departSave($id,$data);
		
		if($departDel['errcode']==0){
			//修改成功
			$rslt = $this->rn($id,$data);
			return $rslt;
		}else{
			return false;
		}
	}
	
	//新增
	public function add_node_c($node,$position,$data){
		$Userlist=A('Qyapp/Userlist');
		$dat['wxpid']=$node;
		$dat['name']=$data['name'];
		$departAdd=$Userlist->departAdd($id,$dat);
		if($departAdd['errcode']==0){
			$rslt = $this->mk($node,$position,$data);
			return $rslt;
		}else{
			return false;
		}
	
	
	}
	
	//成员列表
    public function memberList($id){
		if($id){
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
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token['access_token'].'&department_id='.$id.'&fetch_child=0&status='.$_GET['status'];
			$List=json_decode($this->curlGet($url_get),true);
			$memberList="";
			foreach ($List['userlist'] as $k=>$v){
				$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$v['userid'];
				$memberinfo=json_decode($this->curlGet($url_get),true);
				$memberList[$k]=$memberinfo;
			}
			$this->assign('userlist',$memberList);
			$this->display();
			return $memberList;
		}
	}	
	
	/*
	*获取节点
	*/	
	public function get_node($id, $options = array()) {
		$node = M('Department')->where(array('id'=>$id,'user_id'=>$_SESSION['user_id']))->find();
		if(isset($options['with_children'])) {
			$node['children'] = $this->get_children($id, isset($options['deep_children']));
		}
		if(isset($options['with_path'])) {
			$node['path'] = $this->get_path($id);
		}
		
		return $node;
	}

	/*
	*获取子节点
	* id 
	*是否用递归
	*/	
	public function get_children($id,$recursive = false) {
		if($recursive) {
			$node = $this->get_node($id);
		    $result = M('Department')->where(array('lft'=>$node['lft'],'rgt'=>$node['rgt'],'user_id'=>$_SESSION['user_id']))->order('lft asc')->select();			
		}else {
		    $result = M('Department')->where(array('pid'=>$id,'user_id'=>$_SESSION['user_id']))->order('pos asc')->select();		
			
		}
		return $result;
	}

	/*
	*获取路径
	*/	
	public function get_path($id) {
		$node = $this->get_node($id);
		$sql = false;
		if($node) {
		    $result = M('Department')->where(array('lft'=>$node['lft'],'rgt'=>$node['rgt']))->order('lft asc')->select();
		}
		return $result ? $result : false;
	}

	/*
	*创建目录
	*/	
	public function mk($parent, $position = 0, $data = array(),$wx =array()){
		$parent = (int)$parent;
		if($parent == 0) { $this->error('参数错误'); }
		$parent = $this->get_node($parent, array('with_children'=> true));
		if(!$parent['children']) { $position = 0; }
		if($parent['children'] && $position >= count($parent['children'])) { $position = count($parent['children']); }
		$sql = array();
		$par = array();

		// PREPARE NEW PARENT 
		// update positions of all next elements
		$sql[] = "UPDATE tp_department SET pos = pos + 1 WHERE pid =".(int)$parent['id']." and pos >= ".$position;
		$par[] = false;

		// update left indexes
		$ref_lft = false;
		if(!$parent['children']) {
			$ref_lft = $parent['rgt'];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_lft = $parent['rgt'];
		}
		else {
			$ref_lft = $parent['children'][(int)$position]['lft'];
		}
		$sql[] = "UPDATE tp_department SET lft = lft + 2 WHERE lft >=".$ref_lft;
		$par[] = false;

		// update right indexes
		$ref_rgt = false;
		if(!$parent['children']) {
			$ref_rgt = $parent['rgt'];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_rgt = $parent['rgt'];
		}
		else {
			$ref_rgt = $parent['children'][(int)$position]['lft'] + 1;
		}
		$sql[] = "UPDATE tp_department SET rgt = rgt + 2 WHERE rgt >=".(int)$ref_rgt;
        $options = array(	'structure'	=> array(			              
											'left'			=> 'lft',
											'right'			=> 'rgt',
											'level'			=> 'lvl',
											'parent_id'		=> 'pid',
											'position'		=> 'pos')
			);
		$tmp = array();
		foreach($options['structure'] as $k => $v) {
			switch($k) {
				case 'name': 
					$tmp[] = $data['name'];
					$info['name'] = $data['name'];
					break;						
				case 'left': 
					$tmp[] = (int)$ref_lft;
					$info['lft'] = (int)$ref_lft;
					break;
				case 'right': 
					$tmp[] = (int)$ref_lft + 1;
					$info['rgt'] = (int)$ref_lft + 1;
					break;
				case 'level': 
					$tmp[] = (int)$parent[$v] + 1;
					$info['lvl'] = (int)$parent[$v] + 1;
					break;
				case 'parent_id': 
					$tmp[] = $parent['id'];
					$info['pid'] = $parent['id'];
					break;
				case 'position': 
					$tmp[] = $position;
					$info['pos'] = $position;
					break;
				default:
					$tmp[] = null;
			}
		}
		$Model = new Model();
		foreach($sql as $k => $v) { 
			$Model->query($v);
		}
		$info['name'] = $data['name'];
		$info['user_id'] = $_SESSION['user_id'];
		$info['wxpid'] = $wx['wxpid'];
		$info['wxid'] = $wx['wxid'];
		if(!empty($info['wxpid'])&!empty($info['wxid'])){
			$resultid = M('Department')->add($info);
		}
		if($data && count($data)) {
		    $node =$resultid;
			if(!$this->rn($node,$data)) {
				$this->rm($node);
			}
		}
		return $node;
	}
	
	/*
	*
	*/	
	public function mv($id, $parent, $position = 0) {
		$id			= (int)$id;
		$parent		= (int)$parent;
		if($parent == 0 || $id == 0 || $id == 1) { 
			throw new Exception('Cannot move inside 0, or move root node');
		}

		$parent		= $this->get_node($parent, array('with_children'=> true, 'with_path' => true));
		$id			= $this->get_node($id, array('with_children'=> true, 'deep_children' => true, 'with_path' => true));
		if(!$parent['children']) { 
			$position = 0; 
		}
		if($id[$this->options['structure']['parent_id']] == $parent[$this->options['structure']['id']] && $position > $id[$this->options['structure']['position']]) {
			$position ++;
		}
		if($parent['children'] && $position >= count($parent['children'])) { 
			$position = count($parent['children']); 
		}
		if($id[$this->options['structure']['left']] < $parent[$this->options['structure']['left']] && $id[$this->options['structure']['right']] > $parent[$this->options['structure']['right']]) {
			throw new Exception('Could not move parent inside child');
		}

		$tmp = array();
		$tmp[] = (int)$id[$this->options['structure']["id"]];
		if($id['children'] && is_array($id['children'])) {
			foreach($id['children'] as $c) { 
				$tmp[] = (int)$c[$this->options['structure']["id"]];
			}
		}
		$width = (int)$id[$this->options['structure']["right"]] - (int)$id[$this->options['structure']["left"]] + 1;

		$sql = array();

		// PREPARE NEW PARENT
		// update positions of all next elements
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["position"]." = ".$this->options['structure']["position"]." + 1 
			WHERE 
				".$this->options['structure']["id"]." != ".(int)$id[$this->options['structure']['id']]." AND 
				".$this->options['structure']["parent_id"]." = ".(int)$parent[$this->options['structure']['id']]." AND 
				".$this->options['structure']["position"]." >= ".$position."
			";

		// update left indexes
		$ref_lft = false;
		if(!$parent['children']) {
			$ref_lft = $parent[$this->options['structure']["right"]];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_lft = $parent[$this->options['structure']["right"]];
		}
		else {
			$ref_lft = $parent['children'][(int)$position][$this->options['structure']["left"]];
		}
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["left"]." = ".$this->options['structure']["left"]." + ".$width." 
			WHERE 
				".$this->options['structure']["left"]." >= ".(int)$ref_lft." AND 
				".$this->options['structure']["id"]." NOT IN(".implode(',',$tmp).") 
			";
		// update right indexes
		$ref_rgt = false;
		if(!$parent['children']) {
			$ref_rgt = $parent[$this->options['structure']["right"]];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_rgt = $parent[$this->options['structure']["right"]];
		}
		else {
			$ref_rgt = $parent['children'][(int)$position][$this->options['structure']["left"]] + 1;
		}
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["right"]." = ".$this->options['structure']["right"]." + ".$width." 
			WHERE 
				".$this->options['structure']["right"]." >= ".(int)$ref_rgt." AND 
				".$this->options['structure']["id"]." NOT IN(".implode(',',$tmp).") 
			";

		// MOVE THE ELEMENT AND CHILDREN
		// left, right and level
		$diff = $ref_lft - (int)$id[$this->options['structure']["left"]];

		if($diff > 0) { $diff = $diff - $width; }
		$ldiff = ((int)$parent[$this->options['structure']['level']] + 1) - (int)$id[$this->options['structure']['level']];
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["right"]." = ".$this->options['structure']["right"]." + ".$diff.", 
					".$this->options['structure']["left"]." = ".$this->options['structure']["left"]." + ".$diff.", 
					".$this->options['structure']["level"]." = ".$this->options['structure']["level"]." + ".$ldiff." 
				WHERE ".$this->options['structure']["id"]." IN(".implode(',',$tmp).") 
		";
		// position and parent_id
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["position"]." = ".$position.",
					".$this->options['structure']["parent_id"]." = ".(int)$parent[$this->options['structure']["id"]]." 
				WHERE ".$this->options['structure']["id"]."  = ".(int)$id[$this->options['structure']['id']]." 
		";

		// CLEAN OLD PARENT
		// position of all next elements
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["position"]." = ".$this->options['structure']["position"]." - 1 
			WHERE 
				".$this->options['structure']["parent_id"]." = ".(int)$id[$this->options['structure']["parent_id"]]." AND 
				".$this->options['structure']["position"]." > ".(int)$id[$this->options['structure']["position"]];
		// left indexes
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["left"]." = ".$this->options['structure']["left"]." - ".$width." 
			WHERE 
				".$this->options['structure']["left"]." > ".(int)$id[$this->options['structure']["right"]]." AND 
				".$this->options['structure']["id"]." NOT IN(".implode(',',$tmp).") 
		";
		// right indexes
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["right"]." = ".$this->options['structure']["right"]." - ".$width." 
			WHERE 
				".$this->options['structure']["right"]." > ".(int)$id[$this->options['structure']["right"]]." AND 
				".$this->options['structure']["id"]." NOT IN(".implode(',',$tmp).") 
		";

		foreach($sql as $k => $v) {
			//echo preg_replace('@[\s\t]+@',' ',$v) ."\n";
			try {
				$this->db->query($v);
			} catch(Exception $e) {
				$this->reconstruct();
				throw new Exception('Error moving');
			}
		}
		return true;
	}

	public function cp($id, $parent, $position = 0) {
		$id			= (int)$id;
		$parent		= (int)$parent;
		if($parent == 0 || $id == 0 || $id == 1) {
			throw new Exception('Could not copy inside parent 0, or copy root nodes');
		}

		$parent		= $this->get_node($parent, array('with_children'=> true, 'with_path' => true));
		$id			= $this->get_node($id, array('with_children'=> true, 'deep_children' => true, 'with_path' => true));
		$old_nodes	= $this->db->get("
			SELECT * FROM ".$this->options['structure_table']." 
			WHERE ".$this->options['structure']["left"]." > ".$id[$this->options['structure']["left"]]." AND ".$this->options['structure']["right"]." < ".$id[$this->options['structure']["right"]]." 
			ORDER BY ".$this->options['structure']["left"]."
		");
		if(!$parent['children']) { 
			$position = 0; 
		}
		if($id[$this->options['structure']['parent_id']] == $parent[$this->options['structure']['id']] && $position > $id[$this->options['structure']['position']]) {
		}
		if($parent['children'] && $position >= count($parent['children'])) { 
			$position = count($parent['children']); 
		}

		$tmp = array();
		$tmp[] = (int)$id[$this->options['structure']["id"]];
		if($id['children'] && is_array($id['children'])) {
			foreach($id['children'] as $c) { 
				$tmp[] = (int)$c[$this->options['structure']["id"]];
			}
		}
		$width = (int)$id[$this->options['structure']["right"]] - (int)$id[$this->options['structure']["left"]] + 1;

		$sql = array();

		// PREPARE NEW PARENT
		// update positions of all next elements
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["position"]." = ".$this->options['structure']["position"]." + 1 
			WHERE 
				".$this->options['structure']["parent_id"]." = ".(int)$parent[$this->options['structure']['id']]." AND 
				".$this->options['structure']["position"]." >= ".$position."
			";

		// update left indexes
		$ref_lft = false;
		if(!$parent['children']) {
			$ref_lft = $parent[$this->options['structure']["right"]];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_lft = $parent[$this->options['structure']["right"]];
		}
		else {
			$ref_lft = $parent['children'][(int)$position][$this->options['structure']["left"]];
		}
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["left"]." = ".$this->options['structure']["left"]." + ".$width." 
			WHERE 
				".$this->options['structure']["left"]." >= ".(int)$ref_lft." 
			";
		// update right indexes
		$ref_rgt = false;
		if(!$parent['children']) {
			$ref_rgt = $parent[$this->options['structure']["right"]];
		}
		else if(!isset($parent['children'][$position])) {
			$ref_rgt = $parent[$this->options['structure']["right"]];
		}
		else {
			$ref_rgt = $parent['children'][(int)$position][$this->options['structure']["left"]] + 1;
		}
		$sql[] = "
			UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["right"]." = ".$this->options['structure']["right"]." + ".$width." 
			WHERE 
				".$this->options['structure']["right"]." >= ".(int)$ref_rgt." 
			";

		// MOVE THE ELEMENT AND CHILDREN
		// left, right and level
		$diff = $ref_lft - (int)$id[$this->options['structure']["left"]];

		if($diff <= 0) { $diff = $diff - $width; }
		$ldiff = ((int)$parent[$this->options['structure']['level']] + 1) - (int)$id[$this->options['structure']['level']];

		// build all fields + data table
		$fields = array_combine($this->options['structure'], $this->options['structure']);
		unset($fields['id']);
		$fields[$this->options['structure']["left"]] = $this->options['structure']["left"]." + ".$diff;
		$fields[$this->options['structure']["right"]] = $this->options['structure']["right"]." + ".$diff;
		$fields[$this->options['structure']["level"]] = $this->options['structure']["level"]." + ".$ldiff;
		$sql[] = "
			INSERT INTO ".$this->options['structure_table']." ( ".implode(',',array_keys($fields))." )
			SELECT ".implode(',',array_values($fields))." FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']["id"]." IN (".implode(",", $tmp).") 
			ORDER BY ".$this->options['structure']["level"]." ASC";

		foreach($sql as $k => $v) {
			try {
				$this->db->query($v);
			} catch(Exception $e) {
				$this->reconstruct();
				throw new Exception('Error copying');
			}
		}
		$iid = (int)$this->db->insert_id();

		try {
			$this->db->query("
				UPDATE ".$this->options['structure_table']." 
					SET ".$this->options['structure']["position"]." = ".$position.",
						".$this->options['structure']["parent_id"]." = ".(int)$parent[$this->options['structure']["id"]]." 
					WHERE ".$this->options['structure']["id"]."  = ".$iid." 
			");
		} catch(Exception $e) {
			$this->rm($iid);
			$this->reconstruct();
			throw new Exception('Could not update adjacency after copy');
		}
		$fields = $this->options['data'];
		unset($fields['id']);
		$update_fields = array();
		foreach($fields as $f) {
			$update_fields[] = $f.'=VALUES('.$f.')';
		}
		$update_fields = implode(',', $update_fields);
		if(count($fields)) {
			try {
				$this->db->query("
						INSERT INTO ".$this->options['data_table']." (".$this->options['data2structure'].",".implode(",",$fields).") 
						SELECT ".$iid.",".implode(",",$fields)." FROM ".$this->options['data_table']." WHERE ".$this->options['data2structure']." = ".$id[$this->options['data2structure']]." 
						ON DUPLICATE KEY UPDATE ".$update_fields." 
				");
			}
			catch(Exception $e) {
				$this->rm($iid);
				$this->reconstruct();
				throw new Exception('Could not update data after copy');
			}
		}

		// manually fix all parent_ids and copy all data
		$new_nodes = $this->db->get("
			SELECT * FROM ".$this->options['structure_table']." 
			WHERE ".$this->options['structure']["left"]." > ".$ref_lft." AND ".$this->options['structure']["right"]." < ".($ref_lft + $width - 1)." AND ".$this->options['structure']["id"]." != ".$iid."
			ORDER BY ".$this->options['structure']["left"]."
		");
		$parents = array();
		foreach($new_nodes as $node) {
			if(!isset($parents[$node[$this->options['structure']["left"]]])) { $parents[$node[$this->options['structure']["left"]]] = $iid; }
			for($i = $node[$this->options['structure']["left"]] + 1; $i < $node[$this->options['structure']["right"]]; $i++) {
				$parents[$i] = $node[$this->options['structure']["id"]];
			}
		}
		$sql = array();
		foreach($new_nodes as $k => $node) {
			$sql[] = "
				UPDATE ".$this->options['structure_table']." 
				SET ".$this->options['structure']["parent_id"]." = ".$parents[$node[$this->options['structure']["left"]]]." 
				WHERE ".$this->options['structure']["id"]." = ".(int)$node[$this->options['structure']["id"]]."
			";
			if(count($fields)) {
				$up = "";
				foreach($fields as $f)
				$sql[] = "
					INSERT INTO ".$this->options['data_table']." (".$this->options['data2structure'].",".implode(",",$fields).") 
					SELECT ".(int)$node[$this->options['structure']["id"]].",".implode(",",$fields)." FROM ".$this->options['data_table']." 
						WHERE ".$this->options['data2structure']." = ".$old_nodes[$k][$this->options['structure']['id']]." 
					ON DUPLICATE KEY UPDATE ".$update_fields." 
				";
			}
		}
		//var_dump($sql);
		foreach($sql as $k => $v) {
			try {
				$this->db->query($v);
			} catch(Exception $e) {
				$this->rm($iid);
				$this->reconstruct();
				throw new Exception('Error copying');
			}
		}
		return $iid;
	}

	/**
	*删除操作
	**/
	public function rm($id) {
		$cc=$id;
		$id = (int)$id;
		if(!$id || $id === 1) { $this->eroor('Could not create inside roots'); }
		$data = $this->get_node($id, array('with_children' => true, 'deep_children' => true));
		$lft = (int)$data['lft'];
		$rgt = (int)$data['rgt'];
		$pid = (int)$data['pid'];
		$pos = (int)$data['pos'];
		$dif = $rgt - $lft + 1;

		$sql = array();
		$sql[] = "delete from tp_department where lft >= ".(int)$lft." and rgt <=".(int)$rgt;
		$sql[] = "update tp_department set lft = lft - ".$dif." where lft > ".$rgt;
		$sql[] = "update tp_department set rgt = rgt - ".$dif." where rgt > ".$lft;
		$sql[] = "update tp_department set pos = pos - 1 where pid = ".$pid." and pos >".$pos;
			$tmp = array();
			$tmp[] = (int)$data['id'];
			if($data['children'] && is_array($data['children'])) {
				foreach($data['children'] as $v) {
					$tmp[] = (int)$v['id'];
				}
			$sql[] = "DELETE FROM tp_department WHERE id IN (".implode(',',$tmp).")";
			}

		foreach($sql as $v) {
			$Model = new Model();
			$Model->query($v);
		}
		return true;
	}

	/**
	*重命名
	**/
	public function rn($id, $data){
		$result = M('Department')->where(array('id'=>(int)$id))->find();
		if(!$result) {
			$this->error('部门不存在');
		}
		if(isset($data['name'])) {		
		    M('Department')->where(array('id'=>$id))->save($data);			
		}
		return true;
	}
	
	
	
	
	//添加部门
	 public function departAdd($departName,$id){
			if($departName=="新部门"){
				$departList['errmsg']=1;
				return $departList;
			}
			$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
			$appinfo=M('Qymyapp')->where(array('userid'=>$_SESSION['user_id'],'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$$common = A('Qyapp/Common');
			$access_token=$common->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"],$user['id']);
				
				
			$url_creat='https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token='.$access_token['access_token'];
			$data='{
				   "name": "'.$departName.'",
				   "parentid": "'.$id.'",
				   "order": "'.$id.'"
				   }';
			$post=$this->api_notice_increment($url_creat,$data);
			$departList=json_decode($post,true);
			return $departList;
	}

	public function analyze($get_errors = false) {
		$report = array();
		if((int)$this->db->one("SELECT COUNT(".$this->options['structure']["id"].") AS res FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']["parent_id"]." = 0") !== 1) {
			$report[] = "No or more than one root node.";
		}
		if((int)$this->db->one("SELECT ".$this->options['structure']["left"]." AS res FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']["parent_id"]." = 0") !== 1) {
			$report[] = "Root node's left index is not 1.";
		}
		if((int)$this->db->one("
			SELECT 
				COUNT(".$this->options['structure']['id'].") AS res 
			FROM ".$this->options['structure_table']." s 
			WHERE 
				".$this->options['structure']["parent_id"]." != 0 AND 
				(SELECT COUNT(".$this->options['structure']['id'].") FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']["id"]." = s.".$this->options['structure']["parent_id"].") = 0") > 0
		) {
			$report[] = "Missing parents.";
		}
		if(
			(int)$this->db->one("SELECT MAX(".$this->options['structure']["right"].") AS res FROM ".$this->options['structure_table']) / 2 != 
			(int)$this->db->one("SELECT COUNT(".$this->options['structure']["id"].") AS res FROM ".$this->options['structure_table'])
		) {
			$report[] = "Right index does not match node count.";
		}
		if(
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["right"].") AS res FROM ".$this->options['structure_table']) != 
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["left"].") AS res FROM ".$this->options['structure_table']) 
		) {
			$report[] = "Duplicates in nested set.";
		}
		if(
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["id"].") AS res FROM ".$this->options['structure_table']) != 
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["left"].") AS res FROM ".$this->options['structure_table']) 
		) {
			$report[] = "Left indexes not unique.";
		}
		if(
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["id"].") AS res FROM ".$this->options['structure_table']) != 
			(int)$this->db->one("SELECT COUNT(DISTINCT ".$this->options['structure']["right"].") AS res FROM ".$this->options['structure_table']) 
		) {
			$report[] = "Right indexes not unique.";
		}
		if(
			(int)$this->db->one("
				SELECT 
					s1.".$this->options['structure']["id"]." AS res 
				FROM ".$this->options['structure_table']." s1, ".$this->options['structure_table']." s2 
				WHERE 
					s1.".$this->options['structure']['id']." != s2.".$this->options['structure']['id']." AND 
					s1.".$this->options['structure']['left']." = s2.".$this->options['structure']['right']." 
				LIMIT 1")
		) {
			$report[] = "Nested set - matching left and right indexes.";
		}
		if(
			(int)$this->db->one("
				SELECT 
					".$this->options['structure']["id"]." AS res 
				FROM ".$this->options['structure_table']." s 
				WHERE 
					".$this->options['structure']['position']." >= (
						SELECT 
							COUNT(".$this->options['structure']["id"].") 
						FROM ".$this->options['structure_table']." 
						WHERE ".$this->options['structure']['parent_id']." = s.".$this->options['structure']['parent_id']."
					)
				LIMIT 1") || 
			(int)$this->db->one("
				SELECT 
					s1.".$this->options['structure']["id"]." AS res 
				FROM ".$this->options['structure_table']." s1, ".$this->options['structure_table']." s2 
				WHERE 
					s1.".$this->options['structure']['id']." != s2.".$this->options['structure']['id']." AND 
					s1.".$this->options['structure']['parent_id']." = s2.".$this->options['structure']['parent_id']." AND 
					s1.".$this->options['structure']['position']." = s2.".$this->options['structure']['position']." 
				LIMIT 1")
		) {
			$report[] = "Positions not correct.";
		}
		if((int)$this->db->one("
			SELECT 
				COUNT(".$this->options['structure']["id"].") FROM ".$this->options['structure_table']." s 
			WHERE 
				(
					SELECT 
						COUNT(".$this->options['structure']["id"].") 
					FROM ".$this->options['structure_table']." 
					WHERE 
						".$this->options['structure']["right"]." < s.".$this->options['structure']["right"]." AND 
						".$this->options['structure']["left"]." > s.".$this->options['structure']["left"]." AND 
						".$this->options['structure']["level"]." = s.".$this->options['structure']["level"]." + 1
				) != 
				(
					SELECT 
						COUNT(*) 
					FROM ".$this->options['structure_table']." 
					WHERE 
						".$this->options['structure']["parent_id"]." = s.".$this->options['structure']["id"]."
				)")
		) {
			$report[] = "Adjacency and nested set do not match.";
		}
		if(
			$this->options['data_table'] && 
			(int)$this->db->one("
				SELECT 
					COUNT(".$this->options['structure']["id"].") AS res 
				FROM ".$this->options['structure_table']." s 
				WHERE 
					(SELECT COUNT(".$this->options['data2structure'].") FROM ".$this->options['data_table']." WHERE ".$this->options['data2structure']." = s.".$this->options['structure']["id"].") = 0
			")
		) {
			$report[] = "Missing records in data table.";
		}
		if(
			$this->options['data_table'] && 
			(int)$this->db->one("
				SELECT 
					COUNT(".$this->options['data2structure'].") AS res 
				FROM ".$this->options['data_table']." s 
				WHERE 
					(SELECT COUNT(".$this->options['structure']["id"].") FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']["id"]." = s.".$this->options['data2structure'].") = 0
			")
		) {
			$report[] = "Dangling records in data table.";
		}
		return $get_errors ? $report : count($report) == 0;
	}

	public function reconstruct($analyze = true) {
		if($analyze && $this->analyze()) { return true; }

		if(!$this->db->query("" . 
			"CREATE TEMPORARY TABLE temp_tree (" . 
				"".$this->options['structure']["id"]." INTEGER NOT NULL, " . 
				"".$this->options['structure']["parent_id"]." INTEGER NOT NULL, " . 
				"". $this->options['structure']["position"]." INTEGER NOT NULL" . 
			") "
		)) { return false; }
		if(!$this->db->query("" . 
			"INSERT INTO temp_tree " . 
				"SELECT " . 
					"".$this->options['structure']["id"].", " . 
					"".$this->options['structure']["parent_id"].", " . 
					"".$this->options['structure']["position"]." " . 
				"FROM ".$this->options['structure_table'].""
		)) { return false; }

		if(!$this->db->query("" . 
			"CREATE TEMPORARY TABLE temp_stack (" . 
				"".$this->options['structure']["id"]." INTEGER NOT NULL, " . 
				"".$this->options['structure']["left"]." INTEGER, " . 
				"".$this->options['structure']["right"]." INTEGER, " . 
				"".$this->options['structure']["level"]." INTEGER, " . 
				"stack_top INTEGER NOT NULL, " . 
				"".$this->options['structure']["parent_id"]." INTEGER, " . 
				"".$this->options['structure']["position"]." INTEGER " . 
			") "
		)) { return false; }

		$counter = 2;
		if(!$this->db->query("SELECT COUNT(*) FROM temp_tree")) { 
			return false; 
		}
		$this->db->nextr();
		$maxcounter = (int) $this->db->f(0) * 2;
		$currenttop = 1;
		if(!$this->db->query("" . 
			"INSERT INTO temp_stack " . 
				"SELECT " . 
					"".$this->options['structure']["id"].", " . 
					"1, " . 
					"NULL, " . 
					"0, " . 
					"1, " . 
					"".$this->options['structure']["parent_id"].", " . 
					"".$this->options['structure']["position"]." " . 
				"FROM temp_tree " . 
				"WHERE ".$this->options['structure']["parent_id"]." = 0"
		)) { return false; }
		if(!$this->db->query("DELETE FROM temp_tree WHERE ".$this->options['structure']["parent_id"]." = 0")) {
			return false;
		}

		while ($counter <= $maxcounter) {
			if(!$this->db->query("" . 
				"SELECT " . 
					"temp_tree.".$this->options['structure']["id"]." AS tempmin, " . 
					"temp_tree.".$this->options['structure']["parent_id"]." AS pid, " . 
					"temp_tree.".$this->options['structure']["position"]." AS lid " . 
				"FROM temp_stack, temp_tree " . 
				"WHERE " . 
					"temp_stack.".$this->options['structure']["id"]." = temp_tree.".$this->options['structure']["parent_id"]." AND " . 
					"temp_stack.stack_top = ".$currenttop." " . 
				"ORDER BY temp_tree.".$this->options['structure']["position"]." ASC LIMIT 1"
			)) { return false; }

			if($this->db->nextr()) {
				$tmp = $this->db->f("tempmin");

				$q = "INSERT INTO temp_stack (stack_top, ".$this->options['structure']["id"].", ".$this->options['structure']["left"].", ".$this->options['structure']["right"].", ".$this->options['structure']["level"].", ".$this->options['structure']["parent_id"].", ".$this->options['structure']["position"].") VALUES(".($currenttop + 1).", ".$tmp.", ".$counter.", NULL, ".$currenttop.", ".$this->db->f("pid").", ".$this->db->f("lid").")";
				if(!$this->db->query($q)) {
					return false;
				}
				if(!$this->db->query("DELETE FROM temp_tree WHERE ".$this->options['structure']["id"]." = ".$tmp)) {
					return false;
				}
				$counter++;
				$currenttop++;
			}
			else {
				if(!$this->db->query("" . 
					"UPDATE temp_stack SET " . 
						"".$this->options['structure']["right"]." = ".$counter.", " . 
						"stack_top = -stack_top " . 
					"WHERE stack_top = ".$currenttop
				)) { return false; }
				$counter++;
				$currenttop--;
			}
		}

		$temp_fields = $this->options['structure'];
		unset($temp_fields["parent_id"]);
		unset($temp_fields["position"]);
		unset($temp_fields["left"]);
		unset($temp_fields["right"]);
		unset($temp_fields["level"]);
		if(count($temp_fields) > 1) {
			if(!$this->db->query("" . 
				"CREATE TEMPORARY TABLE temp_tree2 " . 
					"SELECT ".implode(", ", $temp_fields)." FROM ".$this->options['structure_table']." "
			)) { return false; }
		}
		if(!$this->db->query("TRUNCATE TABLE ".$this->options['structure_table']."")) { 
			return false; 
		}
		if(!$this->db->query("" . 
			"INSERT INTO ".$this->options['structure_table']." (" . 
					"".$this->options['structure']["id"].", " . 
					"".$this->options['structure']["parent_id"].", " . 
					"".$this->options['structure']["position"].", " . 
					"".$this->options['structure']["left"].", " . 
					"".$this->options['structure']["right"].", " . 
					"".$this->options['structure']["level"]." " . 
				") " . 
				"SELECT " . 
					"".$this->options['structure']["id"].", " . 
					"".$this->options['structure']["parent_id"].", " . 
					"".$this->options['structure']["position"].", " . 
					"".$this->options['structure']["left"].", " . 
					"".$this->options['structure']["right"].", " . 
					"".$this->options['structure']["level"]." " . 
				"FROM temp_stack " . 
				"ORDER BY ".$this->options['structure']["id"].""
		)) { 
			return false; 
		}
		if(count($temp_fields) > 1) {
			$sql = "" . 
				"UPDATE ".$this->options['structure_table']." v, temp_tree2 SET v.".$this->options['structure']["id"]." = v.".$this->options['structure']["id"]." ";
			foreach($temp_fields as $k => $v) {
				if($k == "id") continue;
				$sql .= ", v.".$v." = temp_tree2.".$v." ";
			}
			$sql .= " WHERE v.".$this->options['structure']["id"]." = temp_tree2.".$this->options['structure']["id"]." ";
			if(!$this->db->query($sql)) {
				return false;
			}
		}
		// fix positions
		$nodes = $this->db->get("SELECT ".$this->options['structure']['id'].", ".$this->options['structure']['parent_id']." FROM ".$this->options['structure_table']." ORDER BY ".$this->options['structure']['parent_id'].", ".$this->options['structure']['position']);
		$last_parent = false;
		$last_position = false;
		foreach($nodes as $node) {
			if((int)$node[$this->options['structure']['parent_id']] !== $last_parent) {
				$last_position = 0;
				$last_parent = (int)$node[$this->options['structure']['parent_id']];
			}
			$this->db->query("UPDATE ".$this->options['structure_table']." SET ".$this->options['structure']['position']." = ".$last_position." WHERE ".$this->options['structure']['id']." = ".(int)$node[$this->options['structure']['id']]);
			$last_position++;
		}
		if($this->options['data_table'] != $this->options['structure_table']) {
			// fix missing data records
			$this->db->query("
				INSERT INTO 
					".$this->options['data_table']." (".implode(',',$this->options['data']).") 
				SELECT ".$this->options['structure']['id']." ".str_repeat(", ".$this->options['structure']['id'], count($this->options['data']) - 1)." 
				FROM ".$this->options['structure_table']." s 
				WHERE (SELECT COUNT(".$this->options['data2structure'].") FROM ".$this->options['data_table']." WHERE ".$this->options['data2structure']." = s.".$this->options['structure']['id'].") = 0 "
			);
			// remove dangling data records
			$this->db->query("
				DELETE FROM 
					".$this->options['data_table']." 
				WHERE
					(SELECT COUNT(".$this->options['structure']['id'].") FROM ".$this->options['structure_table']." WHERE ".$this->options['structure']['id']." = ".$this->options['data_table'].".".$this->options['data2structure'].") = 0 
			");
		}
		return true;
	}

	public function res($data = array()) {
		if(!$this->db->query("TRUNCATE TABLE ".$this->options['structure_table'])) { return false; }
		if(!$this->db->query("TRUNCATE TABLE ".$this->options['data_table'])) { return false; }
		$sql = "INSERT INTO ".$this->options['structure_table']." (".implode(",", $this->options['structure']).") VALUES (?".str_repeat(',?', count($this->options['structure']) - 1).")";
		$par = array();
		foreach($this->options['structure'] as $k => $v) {
			switch($k) {
				case 'id': 
					$par[] = null;
					break;
				case 'left': 
					$par[] = 1;
					break;
				case 'right': 
					$par[] = 2;
					break;
				case 'level': 
					$par[] = 0;
					break;
				case 'parent_id': 
					$par[] = 0;
					break;
				case 'position': 
					$par[] = 0;
					break;
				default:
					$par[] = null;
			}
		}
		if(!$this->db->query($sql, $par)) { return false; }
		$id = $this->db->insert_id();
		foreach($this->options['structure'] as $k => $v) {
			if(!isset($data[$k])) { $data[$k] = null; }
		}
		return $this->rn($id, $data);
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