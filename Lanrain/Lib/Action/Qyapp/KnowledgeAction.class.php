<?php
/**
 * 企业知识库
 * 
 *
 */
class KnowledgeAction extends Action{
	public $logo;	
	public $copyright;
	function _initialize(){
				
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
	public function index(){
	    $this->check();
		$list = M('Qyknow_folder')->order('ctime desc')->where(array('user_id'=>$_SESSION['user_id']))->select();
		foreach ($list as $k=>$v){
			$wxid = explode(',', $v['pid']);
			$depart = '';
			foreach ($wxid as $vo){
				$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
				$depart .= $dep.';'; 
			}	
			$list[$k]['dep'] = $depart;
			if($v['power']==1){
				$list[$k]['power'] = '允许转发邮箱';
			}else{
				$list[$k]['power'] = '不允许转发邮箱';
			}
			
			$num = M('Qyknow_files')->where(array('user_id'=>$_SESSION['user_id'],'folder_id'=>$v['id']))->count();
			$list[$k]['num'] = $num;
		}
		$this->assign('list',$list);
		$this->display();
	}
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
		
	/**
	 * 文件夹管理
	 */
	public function folder(){
	    $this->check();
		$list = M('Qyknow_folder')->order('ctime desc')->where(array('user_id'=>$_SESSION['user_id']))->select();
		foreach ($list as $k=>$v){
			$wxid = explode(',', $v['pid']);
			$depart = '';
			foreach ($wxid as $vo){
				$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
				$depart .= $dep.';'; 
			}	
			$list[$k]['dep'] = $depart;
			if($v['power']==1){
				$list[$k]['power'] = '允许转发邮箱';
			}else{
				$list[$k]['power'] = '不允许转发邮箱';
			}
			
			$num = M('Qyknow_files')->where(array('user_id'=>$_SESSION['user_id'],'folder_id'=>$v['id']))->count();
			$list[$k]['num'] = $num;
		}
		$this->assign('list',$list);
		$this->display();
	}
	
	public function folderInfo(){
		$id = intval($this->_get('id'));
		$data = M('Qyknow_folder')->where(array('id'=>$id))->find();
		$wxid = explode(',', $data['pid']);
		$depart = '';
		foreach ($wxid as $vo){
			$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
			$depart .= $dep.';'; 
		}
		if($data['power']==1){
				$data['power'] = '允许转发邮箱';
			}else{
				$data['power'] = '不允许转发邮箱';
			}
		$num = M('Qyknow_files')->where(array('user_id'=>$_SESSION['user_id'],'folder_id'=>$data['id']))->count();
		$data['num'] = $num;
		$data['dep'] = $depart;
		$this->assign('data',$data);
		$this->display();
	}
	/**
	 * 文件夹添加
	 */
	public function addFolder(){
		$id = $_GET['id'];
		$result = M('Qyknow_folder')->where(array('id'=>$id))->find();
		$wxid = explode(',', $result['pid']);
		$depart = '';
		foreach ($wxid as $vo){
			$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
			$depart .= $dep.';'; 
		}
		$result['dep'] = $depart;
		$this->assign('data',$result);
		if(IS_POST){
				$data['name'] = $_POST['name'];
				$folderPath = "./Uploads/Knowledge/".$data['name']."";
				//创建文件夹
				if(!file_exists($folderPath)){
					mkdir(iconv("UTF-8", "GBK", $folderPath),777);//创建中文名称文件夹
				}
				if($_POST['power']){
					$data['power'] = 1;//表示允许转发邮箱
				}else{
					$data['power'] = 0;//表示不允许转发邮箱
				}
				$depart = explode(';',$_POST['depart']);
				$department = array();
				foreach($depart as $v){
					if($v){
						$department[] = M('Department')->where(array('name'=>$v,'user_id'=>$_SESSION['user_id']))->getField('wxid');	
					}
				}
				$data['pic'] = $_POST['pic'];
				$data['pid'] = implode(',', $department);
				$data['ctime'] = time();
				$data['user_id'] = $_SESSION['user_id'];
				$data['display'] = $_POST['display'];//1表示公开显示，0表示不公开显示
				if($id){
					if($_POST['method']==0){ //0表示保存，1表示保存并跳转到添加文档
						$res = M('Qyknow_folder')->where(array('id'=>$id))->save($data);
						if($res){
							$this->success('修改成功',U('folder',array('mid'=>$_GET['mid'])));
						}else{
							$this->error('修改失败',U('folder',array('mid'=>$_GET['mid'])));
						}
					}else{
						$arr1 = M('Qyknow_folder')->where(array('id'=>$id))->save($data);
						if($arr1){
							$this->success('修改成功',U('addFolder',array('mid'=>$_GET['mid'])));
						}else{
							$this->error('修改失败',U('addFolder',array('mid'=>$_GET['mid'])));
						}	
					}
				}else{
					if($_POST['method']==0){ //0表示保存，1表示保存并跳转到添加文档
						$result = M('Qyknow_folder')->add($data);
						if($result){
							$this->success('添加成功',U('folder',array('mid'=>$_GET['mid'])));
						}else{
							$this->error('添加失败',U('folder',array('mid'=>$_GET['mid'])));
						}
					}else{
						
						$arr = M('Qyknow_folder')->add($data);
						if($arr){
							$this->success('添加成功',U('addFiles',array('mid'=>$_GET['mid'])));
						}else{
							$this->error('添加失败',U('addFolder',array('mid'=>$_GET['mid'])));
						}	
					}
				}
			
		}else{
		  $this->display();
		}
	}
	public function delFolder(){
		$id = $_GET['id'];
		$result = M('Qyknow_folder')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->delete();
		$this->ajaxReturn($result);
		if($result){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
		
	}
	
	
	/**
	 * 文档管理
	 */
	public function files(){
		$id = $_GET['id'];
		$where['user_id'] = $_SESSION['user_id'];
		if($id){
			$where['folder_id']=$id;
		}
		$list = M('Qyknow_folder')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('arr',$list);
		
		$data = M('Qyknow_files')->where($where)->select();
		foreach ($data as $k=>$v){
			$wxid = explode(',', $v['pid']);
			$depart = '';
			foreach ($wxid as $vo){
				$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
				$depart .= $dep.';'; 
			}
			$name = M('Qyknow_folder')->where(array('id'=>$v['folder_id'],'user_id'=>$_SESSION['user_id']))->find();	
			$data[$k]['name'] = $name['name'];
			$data[$k]['dep'] = $depart;
			if($v['power']==1){
				$data[$k]['power'] = '允许转发邮箱';
			}else{
				$data[$k]['power'] = '不允许转发邮箱';
			}
			
		}
		$this->assign('list',$data);
		$this->display();
	}
	public function filesInfo(){
		$id = intval($this->_get('id'));
		$data = M('Qyknow_files')->where(array('id'=>$id))->find();
		$wxid = explode(',', $data['pid']);
		$depart = '';
		foreach ($wxid as $vo){
			$dep = M('Department')->where(array('wxid'=>$vo,'user_id'=>$_SESSION['user_id']))->getField('name');
			$depart .= $dep.';'; 
		}
		if($data['power']==1){
				$data['power'] = '允许转发邮箱';
			}else{
				$data['power'] = '不允许转发邮箱';
			}
		$name = M('Qyknow_folder')->where(array('id'=>$data['folder_id']))->find();
		$data['folder'] = $name['name'];
		$data['dep'] = $depart;
		$num = M('Qyknow_record')->where(array('files_id'=>$data['id']))->find();
		$this->assign('data',$data);
		$this->assign('num',$num);
		$this->display();
	}
	/**
	 * 文档添加
	 */
	public function addFiles(){
		$list = M('Qyknow_folder')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('list',$list);
		
		//文件上传
		if($_FILES){
			$name = $_POST['classid'];
			$fname = $_FILES['pic']['name'];
			$size = $_FILES['pic']['size'];
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','txt');// 设置附件上传类型
			$upload->savePath =  "./Uploads/Knowledge/$name/";// 设置附件上传目录
			if(!$upload->upload()) {
			$this->error($upload->getErrorMsg());
			}else{
			$info =  $upload->getUploadFileInfo();
			}
			$data['url'] = $info[0]['savepath'].$info[0]['savename'];
			$data['fname'] = $fname;
			$data['size'] = round($size/1024,3);
		}
		if(IS_POST){
			$data['title'] = $_POST['title'];
			$data['info'] = $_POST['info'];
			$data['folder_id'] = $_POST['classid'];
			$name = M('Qyknow_folder')->where(array('id'=>$data['folder_id']))->find();
			$folderPath = "./Uploads/Knowledge/".$name['name']."/";
			$namePath=iconv("UTF-8", "GBK", $folderPath.$data['title']);
			if($fp=fopen("$namePath.txt",'w')){
				$title=$data['title'];
				$txt = "$title\n";
				fwrite($fp, $txt);
				$title=$data['info'];
				$txt = "$title\n";
				fwrite($fp, $txt);
				fclose($fp);
			}
			if($_POST['power']){
				$data['power'] = 1;//表示允许转发邮箱
			}else{
				$data['power'] = 0;//表示不允许转发邮箱
			}
			$depart = explode(';',$_POST['depart']);
			$department = array();
			foreach($depart as $v){
				if($v){
					$department[] = M('Department')->where(array('name'=>$v,'user_id'=>$_SESSION['user_id']))->getField('wxid');	
				}
			}
			$data['pid'] = implode(',', $department);
			$data['ctime'] = time();
			$data['user_id'] = $_SESSION['user_id'];
			$data['display'] = $_POST['display'];//1表示公开显示，0表示不公开显示
			$data['furl'] = $folderPath.$data['title'].'.txt';
			if($_POST['method']==0){ //0表示保存，1表示保存并跳转到添加文档
				$result = M('Qyknow_files')->add($data);
				if($result){
					$app=M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>'Konwledge'))->field('appid,token')->find();
					$Msg=A('Qyapp/Msg');
					$inin['title']="新文档来袭";
					$inin['description']=$data['title'].date("Y-m-d h:i", $data['ctime']);
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Konwledge&a=wap_index&token='.$app['token'].'&pid='.$arr;
					$inin["agentid"]=$app['appid'];
					$inin['toparty']=$department;
					$msc=$Msg->msg_send_depart($inin,$data['user_id']);
					$data1['files_id'] = $result;
					$data1['user_id'] = $_SESSION['user_id'];
					$record = M('Qyknow_record')->add($data1);
					if($record){
						$this->success('添加成功',U('files',array('mid'=>$_GET['mid'])));
					}
				}else{
					$this->error('添加失败',U('files',array('mid'=>$_GET['mid'])));
				}
			}else{
				$arr = M('Qyknow_files')->add($data);
				if($arr){
					$app=M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>'Konwledge'))->field('appid,token')->find();
					$Msg=A('Qyapp/Msg');
					$inin['title']="新文档来袭";
					$inin['description']=$data['title'].date("Y-m-d h:i", $data['ctime']);
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Konwledge&a=wap_index&token='.$app['token'].'&pid='.$arr;
					$inin["agentid"]=$app['appid'];
					$inin['toparty']=$department;
					$msc=$Msg->msg_send_depart($inin,$data['user_id']);
					$data1['files_id'] = $arr;
					$data1['user_id'] = $_SESSION['user_id'];
					$record = M('Qyknow_record')->add($data1);
					if($record){
						$this->success('添加成功',U('addFiles',array('mid'=>$_GET['mid'])));
					}
				}else{
					$this->error('添加失败',U('addFiles',array('mid'=>$_GET['mid'])));
				}	
			}
		}
		$this->display();
	}
	public function delFiles(){
		$id = $_GET['id'];
		$result = M('Qyknow_files')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->delete();
		$this->ajaxReturn($result);
		if($result){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}
	
	
	
	/**
	 * 反馈信息
	 */
	public function back(){
		$where['user_id'] = $_SESSION['user_id'];
		
		//按状态查询
		if($_GET['status']){
			if($_GET['status']==1){
				$where['status'] = 0;
			}else{
				$where['status'] = 1;
			}
		}
		//按文档名称查询
		if(IS_POST){
			$name = $_POST['name'];
			$id = M('Qyknow_files')->where(array('title'=>$name,'user_id'=>$_SESSION['user_id']))->find();
			$where['file_id'] = $id['id'];
		}
		$data = M('Qyknow_feed')->where($where)->select();
		foreach($data as $k=>$v){
			$department = '';
			$user = M('Qyusers')->where(array('userid'=>$v['uid'],'user_id'=>$_SESSION['user_id']))->find();
			$pid = explode(';', $user['pid']);
			foreach ($pid as $va){
				if($va){
					$depart = M('Department')->where(array('wxid'=>$va,'user_id'=>$_SESSION['user_id']))->find();
					$department .=$depart['name'].';';
				}
			}
			if($v['status']==1){
				$data[$k]['status'] = '已读';
			}else{
				$data[$k]['status'] = '未读';
			}
			$data[$k]['dep'] = $department;
		}
		$this->assign('list',$data);
		$this->display();
	}
	public function backInfo(){
		$id = intval($this->_get('id'));
		$result = M('Qyknow_feed')->where(array('id'=>$id))->find();
		$data = M('Qyknow_files')->where(array('id'=>$result['file_id']))->find();
		$user = M('Qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$result['uid']))->find();
		$wxid = explode(';',$user['pid']);
		$depart = '';
		foreach ($wxid as $v){
			if($v){
				$dep = M('Department')->where(array('wxid'=>$v,'user_id'=>$_SESSION['user_id']))->getField('name');
				$depart .= $dep.';';
			} 
		}
		$result['dep'] = $depart;
		$result['name'] = $user['name'];
		$result['title'] = $data['title'];
		$this->assign('data',$result);
		$this->display();
	}
	public function delFeed(){
		$id = $_POST['id'];
		$result = M('Qyknow_feed')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->delete();
		if($result){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
		
	}
	/**
	 * 数据统计
	 */
	public function info(){
		$result = M('Qyknow_folder')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('arr',$result);
		$where['user_id'] = $_SESSION['user_id'];
		$data = M('Qyknow_files')->where($where)->select();
		foreach ($data as $k=>$v){
			$department = '';
			$folder = M('Qyknow_folder')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$v['folder_id']))->find();
			$data[$k]['folder'] = $folder['name'];
			$arr = explode(',', $v['pid']);
			foreach ($arr as $va){
				if($va){
					$depart = M('Department')->where(array('wxid'=>$va,'user_id'=>$_SESSION['user_id']))->find();
					$department .=$depart['name'].';';
				}
			}
			if($data['power']==1){
				$data[$k]['power'] = '允许转发邮箱';
			}else{
				$data[$k]['power'] = '不允许转发邮箱';
			}
			$data[$k]['dep'] = $department;
			$num = M('Qyknow_record')->where(array('files_id'=>$v['id']))->find();
			$data[$k]['feed'] = $num['feed'];
			$data[$k]['praise'] = $num['praise'];
			$data[$k]['collect'] = $num['collect'];
			$data[$k]['relay'] = $num['relay'];
			$data[$k]['download'] = $num['download'];
		}
		$this->assign('list',$data);
		$this->display();
	}
	
/**********wap*********/
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();
		} 
		//知识库
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$where['user_id'] = $app['userid'];
			$where['name'] = array('like',"%".$_POST['search']."%");
			$data =  M('Qyknow_folder')->where($where)->select();
			if($data){
				$list = $data;
				foreach($list as $k=>$v){
					$map['folder_id'] = $v['id'];
					$map['title'] = array('like',"%".$_POST['search']."%");
					$files = M('Qyknow_files')->where($map)->field('id,title')->select();
					if($files){
						$list[$k]['files'] = $files;
					}else{
						$files = M('Qyknow_files')->where(array('folder_id'=>$v['id']))->field('id,title')->select();
						$list[$k]['files'] = $files;
					}
				}
			}else{
				$con['user_id'] = $app['userid'];
				$con['title'] = array('like',"%".$_POST['search']."%");
				$result =  M('Qyknow_files')->where($con)->select();
				foreach($result as $ke=>$vo){
					$re =  M('Qyknow_folder')->where(array('id'=>$vo['folder_id']))->find();
					$list[$ke]['id'] = $re['id'];
					$list[$ke]['name']	= $re['name'];
					$list[$ke]['files'][$re['id']]['id'] = $vo['id'];
					$list[$ke]['files'][$re['id']]['title'] = $vo['title'];
				}		
			}
		}else{
			$list = M('Qyknow_folder')->order('ctime')->where(array('user_id'=>$app['userid']))->select();
			foreach($list as $k=>$v){
				$files = M('Qyknow_files')->where(array('folder_id'=>$v['id']))->field('id,title')->select();
				$list[$k]['files'] = $files;
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
	public function wap_list(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		$files = M('Qyknow_files')->where(array('folder_id'=>$_GET['id'],'user_id'=>$app['userid']))->select();
		//print_r($files);exit;
		if($_POST){
			$where['folder_id']=$_GET['id'];
			$where['title']=array('like',"%".$_POST["search"]."%");
			$files = M('Qyknow_files')->where($where)->select();
		}
		$this->assign('list',$files);
		$this->display();
	}
	public function wap_info(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_info');
			exit();
		}
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		//文档
		$id = $_GET['id'];
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id,name')->find();
		$result = M('Qyknow_files')->where(array('id'=>$id))->find();
		$url = substr($result['url'],1);
		$result['uploadurl'] = "".$_SERVER['SERVER_NAME']."".$url."";
		$this->assign('data',$result);
		$rel=M('Qyknow_record')->where(array('files_id'=>$id,'user_id'=>$app['userid']))->find();
		$this->assign('record',$rel);
		$status = M('Qyknow_collect')->where(array('file_id'=>$id,'uid'=>$user['id'],'user_id'=>$app['userid']))->find();
		// print_r($status);exit;
		$this->assign('status',$status);
		$this->display();
	}
	public function wap_my(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_my');
			exit();
		}
		//我的收藏
		$id = $_POST['id'];//获取加入收藏的文档的id
		$praise = $_POST['praise'];
		if($praise==1){
			$set = M('Qyknow_record')->where(array('files_id'=>$id))->setInc('praise',1);
			if($set){
				$value = M('Qyknow_record')->where(array('files_id'=>$id))->getField('praise');
				if($value){
					$this->ajaxReturn($value);
				}
			}
		}
		if($praise==2){
			$set = M('Qyknow_record')->where(array('files_id'=>$id))->setDec('praise',1);
			if($set){
				$value = M('Qyknow_record')->where(array('files_id'=>$id))->getField('praise');
				if($value){
					$this->ajaxReturn($value);
				}
			}		
		}
		$arr['files_id'] = $id;
		$arr['user_id'] = $app['userid'];
		$status = $_POST['status'];
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id,name')->find();
		if($status==1){//收藏状态1表示收藏此文档
			$data=M('Qyknow_collect')->where(array('file_id'=>$id,'user_id'=>$app['userid'],'uid'=>$user['id'],'status'=>$status))->find();
			if($data){
				$this->ajaxReturn(3);
			}else{
				$collect=M('Qyknow_collect')->add(array(
					'file_id'=>$id,
					'name'=>$_GET['wecha_id'],
					'user_id'=>$app['userid'],
					'time'=>time(),
					'status'=>$status,
					'uid'=>$user['id']
				));
				if($collect){
					$set = M('Qyknow_record')->where(array('files_id'=>$id))->setInc('collect',1);
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(2);
				}
			}
			
		}if($status==2){//取消收藏
			// $this->ajaxReturn(1);
			$del = M('Qyknow_collect')->where(array('file_id'=>$id))->delete();
			if($del){
				$set = M('Qyknow_record')->where(array('files_id'=>$id))->setDec('collect',1);
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(2);
			}
		}
	}
	
	public function wap_collect(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_collect');
			exit();
		}
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('id,name')->find();
		$data = M('Qyknow_collect')->where(array('uid'=>$user['id'],'user_id'=>$app['userid']))->select();
		foreach($data as $k=>$v){
			$result = M('Qyknow_files')->where(array('id'=>$v['file_id']))->find();
			$data[$k]['name'] = $result['title'];
			$name = M('Qyknow_folder')->where(array('id'=>$result['id']))->field('name')->find();
			$data[$k]['form'] = $name['name'];
		}
		// print_r($data);exit;
		$this->assign('list',$data);
		$this->display();

	}
	/**
	 * 删除我的收藏
	 */
	 public function wap_mydel(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_mydel');
			exit();
		}
		 if(IS_POST){
			 $id = $_POST['id'];
			 if($id){
				  $del = M('Qyknow_collect')->where(array('id'=>$id))->delete();
				  if($del){
					  $this->ajaxReturn(1);
				  }else{
					  $this->ajaxReturn(0); 
					  
				  }
			 }else{
				 $this->error("非法操作");
			 }
			
		 }
		 
	 }
	 
	/**
	 * 反馈
	 */
	public function wap_feed(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Knowledge';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_feed');
			exit();
		}
		$id = $_GET['id'];
		if(IS_POST){
			$arr['info'] = $_POST['info'];
			$arr['file_id'] = $_POST['id'];
			$arr['user_id'] = $app['userid'];
			$arr['uid'] = $_GET['wecha_id'];
			$arr['time'] = time();
			if($arr['info']){
				$result = M('Qyknow_feed')->add($arr);
				if($result){
					$set = M('Qyknow_record')->where(array('files_id'=>$_POST['id']))->setInc('feed',1);
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(2);
				}
			}else{
				$this->ajaxReturn(3);
			}
		}else{
			$result = M('Qyknow_files')->where(array('id'=>$id))->field('id,title')->find();
			$this->assign('data',$result);
		}
		$this->display();
	}
	//文档下载
	
	//上传多媒体文件
	
	public function upload(){
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$user=M('qytoken')->where(array('id'=>$app['userid']))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			$php_path=str_replace('\\', '/',dirname(__FILE__));		
			$php_path=substr($php_path,0,strlen($php_path)-24);	
			$save_path=$php_path.'Uploads/Knowledge/24/book_pic.jpg';
			$data['media']="@".$save_path;
			$url = 'https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token['access_token'].'&type=file';
			$post = $this->https_request($url,$data);
			$json = json_decode($post,true);
			print_r($json);
	}
	
	
	
	
	
	
	
	
    public function uploadMedia($url,$data){ 
        $ch = curl_init($url) ;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch) ;
        if (curl_errno($ch)) {
         return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
	
	function saveMedia($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
       
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);
        
        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time().rand(100,999).".{$fileExt}";
        $dirname = "./wximages/";
        if(!file_exists($dirname)){
            mkdir($dirname,0777,true);
        }
        file_put_contents($dirname.$filename,$media['mediaBody']);
        return $dirname.$filename;
    }
	
	function wap_common($token){
        //if( strpos($_SERVER['HTTP_USER_AGENT'], 'DingTalk') === false)  {
		//	echo '请在钉钉浏览器下访问';exit;
		//}		
		$app = S('app_'.$token);
		if(!$app){
			$app = M('qymyapp')->where(array('token'=>$token))->find();
			S('app_'.$token,$app);
		}
		if(!$_GET['wecha_id']){
			if(cookie($app['user_id'].'_'.'wecha_id')){
				$_GET['wecha_id'] = str_replace($app['user_id'].'_','',cookie('wecha_id'));
			}else{
				$corp = S('token_'.$token);
				if(!$corp){
					$corp = M('qytoken')->where(array('id'=>$app['userid']))->find();
					S('token_'.$token,$corp,7200);
				}	
				$Oauth=A('Qyapp/Oauth');
				$Oauth->wap_oauth($corp,$app,MODULE_NAME,ACTION_NAME,$_GET);		
			}
		}	
		return $app;    
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function uploadFile(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$user=M('qytoken')->where(array('id'=>$app['userid']))->find();
			$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
		$url='https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token='.$access_token['access_token'].'&media_id=1ILb3-wsqPaX-Ov1zOcSq2_wKIJN103HJUYF1ulbaH7PS8CEBSqdWxfXeznF-VQi6xr7aLGxoAA0FKptVbA4SBw';
		$data = $this->curlGet($url);
		$da = json_decode($$data,true);
		print_r($da);
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
	public function file_post_to($url,$data)
	{
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_POST, 1);  
		curl_setopt($ch, CURLOPT_URL,$url);  
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		$temp=curl_exec($ch); 
		curl_close ($ch);
		
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
}