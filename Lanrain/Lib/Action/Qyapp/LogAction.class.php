<?php

class LogAction extends Action {

	public function _initialize()
	{
		
		$Model = new Model();
		$rt1=$Model->query("CREATE TABLE IF NOT EXISTS `tp_qylog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '日志标题',
  `content` text COMMENT '日志内容',
  `type` int(11) DEFAULT '0' COMMENT '日志类型：0为日报，1周报，2月报，3季报，4年报',
  `principal` varchar(30) DEFAULT NULL COMMENT '负责人',
  `relevance` varchar(30) DEFAULT NULL COMMENT '关联人',
  `submittype` tinyint(4) DEFAULT NULL COMMENT '提交类型 1为已提交 2为待提交',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  `userid` int(11) DEFAULT NULL COMMENT '员工id',
  `img` varchar(100) DEFAULT NULL COMMENT '图片地址id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
		$rt2=$Model->query("CREATE TABLE IF NOT EXISTS `tp_qylog_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `disorder` mediumint(8) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `user_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
		$rt3=$Model->query("CREATE TABLE IF NOT EXISTS `tp_log_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` int(11) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
		$rt4=$Model->query("CREATE TABLE IF NOT EXISTS `tp_log_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '公司ID',
  `picurl` varchar(300) DEFAULT NULL COMMENT '图片地址',
  `wecha_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
		$rt5=$Model->query("CREATE TABLE IF NOT EXISTS `tp_qycopy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logid` int(11) DEFAULT NULL COMMENT '日志表id',
  `comment` text COMMENT '评论',
  `userid` int(11) DEFAULT NULL COMMENT '员工id',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
	}

	//日志查看
	public function index(){
		$users_id = $_SESSION['user_id'];//session
		$usersid = M('Qyusers')->where(array('user_id'=>$users_id))->field('id')->select();//拿到员工id
		foreach($usersid as $val){
			 foreach($val as $v){
				$userlogid[] = $v;
			 }	
			
		}
		$where['userid'] = array('in',$userlogid);
		$where['submittype'] = 1;
		//dump($where);exit;
		//$qylogdata = M('Qylog')->where($where)->select();
		$count      = M('Qylog')->where($where)->count();
		$Page       = new Page($count,15);
		$qylogdata = M('Qylog')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();		
		$res = M('Qylog_type')->where(array('user_id'=>$users_id))->field('id,name')->select();//
		$type = array();
		foreach($res as $key=>$val){
		    $type[$val['id']] = $val;
		}
		foreach($qylogdata as $key=>$val){
			 $usernam = M('Qyusers')->where(array('id'=>$val['userid']))->field('name')->find();//拿到员工id
			 $val['name'] = $usernam['name'];
			 $qylogdatas[$key] = $val;
			 $qylogdatas[$key]['type'] = $type[$val['type']]['name'];
		}
		$show       = $Page->show();		
		$this->assign('qylogdatas',$qylogdatas);
		$this->assign('page',$show);		
		$this->display();	
	}

/**
*日志详情
**/
public function loginfo(){
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	$data=M('qylog')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
	$arr = M('qylog_type')->where(array('user_id'=>$user_id))->select();
	$type = array();
	foreach($arr as $key=>$val){
	    $type[$val['id']] = $val;
	}
	$data['type'] = $type[$data['type']]['name'];
	$this->assign('data',$data);
	$this->display();
}
	
/**
*配置报销类型
**/
public function type(){
	if(IS_POST){
	    $_POST['user_id']=$_SESSION['user_id'];	
		//print_r($_POST);exit;
		$info=M('qylog_type')->add($_POST);
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
 
	}else{
        $where['user_id'] = $_SESSION['user_id'];
	   $data=M('qylog_type')->where($where)->order('disorder desc')->select();
	   $this->assign('data',$data);
	   $this->display();
	}

}

/**
*报销类型详情
**/
public function typeinfo(){
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	//$this->assign('user_id',$user_id);
	$data=M('qylog_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
	$this->assign('data',$data);
	$this->display();
}

/**
*删除
**/
public function del(){
		$id = $_GET['id'];
		$user_id = $_SESSION['user_id'];
		$info=M('Qylog_type')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));

		}else{
			echo json_encode(array('status'=>1));
		}	

}

/**
*编辑
**/
public function edit(){
if(IS_POST){
    //print_r($_POST);exit;
    if($info=M('qylog_type')->save($_POST)){
		$this->success('添加成功',U('Log/type',array('mid'=>$_GET['mid'])));
	}else{
	    $this->error('添加失败');
	}
}else{
    $id = $this->_GET('id');
    $user_id = $_SESSION['user_id'];
	$data=M('qylog_type')->where(array('id'=>$id,'user_id'=>$user_id))->find();
	$this->assign('data',$data);
	$this->display();
}

}
	
	//查看日志内容
	public function showcontents(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Log';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
				exit();
		}
		$users = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_GET['wecha_id']))->field('name,pic,id')->find();
		// print_r($users);
		if(IS_POST){
			//评论
			 $app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$data['user_id'] = $app['userid'];
			$data['wecha_id'] = $_POST['wecha_id'];
			$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_POST['wecha_id']))->field('name,pic')->find();
			$data['log_id'] = $_POST['log_id'];
			$data['content'] = $_POST['content'];
			$data['time'] = time();
			$add = M('Log_comment')->add($data);
			if($add){
				$result = M('Log_comment')->where(array('id'=>$add))->find();
				$result['name'] = $user['name'];
				$result['pic'] = $user['pic'];
				$result['time'] = date('Y-m-d H:i:s',$result['time']);
				echo json_encode($result);//发表成功
				exit;
			}else{
				$this->ajaxReturn(2);//发表失败
			}
		
		}
		// echo $_GET['id'];exit;
		$qylogdata = M('Qylog')->where(array('id'=>$_GET['id']))->find();
		$qyuserdata = M('Qyusers')->where(array('id'=>$_GET['userid']))->field('name,pic,id')->find();
		// print_r($qyuserdata);exit;
		$img = array_filter(explode(',',$qylogdata['img']));//负责人
		$principal = array_filter(explode('|',$qylogdata['principal']));//负责人
		$relevance = array_filter(explode('|',$qylogdata['relevance']));//抄送人
		// print_r($img);exit;
		//查找图片
		if($img){
			$wheree['id'] = array('in',$img);
			$Log_pic = M('Log_pic')->where($wheree)->select();
		}
			
		//查找负责人
		if($principal){
			$where['id'] = array('in',$principal);
			$principalarr = M('Qyusers')->where($where)->field('name,pic')->select();
		}
		//查找抄送人
		if($relevance){
			$wheres['id'] = array('in',$relevance);
			$relevancearr = M('Qyusers')->where($wheres)->field('name,pic')->select();
		}
		 // print_r($qylogdata['title']);exit;
		$number = M('Log_comment')->where(array('log_id'=>$_GET['id']))->count();//'user_id'=>$_GET['userid']
		$comment = M('Log_comment')->where(array('log_id'=>$_GET['id']))->select();//'user_id'=>$_GET['userid']
		// print_r($_GET['userid']);
		// print_r($_GET['id']);exit;
		foreach($comment as $k=>$vo){
			$user = M('Qyusers')->where(array('user_id'=>$_GET['userid'],'userid'=>$vo['wecha_id']))->field('name,pic')->find();
			$comment[$k]['name'] = $user['name'];
			$comment[$k]['pic'] = $user['pic'];
		}
		
		$this->assign('qylogdata',$qylogdata);	
		$this->assign('Log_pic',$Log_pic);//图片
		$this->assign('number',$number);//评论总数
		$this->assign('comment',$comment);//评论详情
		$this->assign('principalarr',$principalarr);//负责人	
		$this->assign('relevancearr',$relevancearr);//抄送人	
		$this->assign('qyuserdata',$qyuserdata);//发布人信息
		$this->assign('users',$users);//自己信息
		$this->display();
	}

	//任务列表  默认是我参与的任务
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Log';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
		
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_index');
			}
			//$this->assign('list',$lists);
			//dump($list);
			$this->display();  
	}
	
	/**
	wap 手机页面
	**/
	//提交报告
	public function waplog(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Log';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
				//exit();
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id')->find();//拿到员工id
		// $userid = "xiuying";
		// $usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name,position,pid')->find();//拿到员工id
		$users_id = $_SESSION['user_id'];//session
		if(IS_POST){
			// print_r(222);exit;
			// $where['type'] = $_POST['logtype'];
			// $where['userid'] = 	$usersid['id'];
			// $logdata = M('Qylog')->where($where)->field('create_time,type')->find();
			 // $day = date('Ymd');
			 // $s= ($day - $logdata['create_time']);
			// if($s==0 && $logdata['logtype']==0){
				// $this->ajaxReturn(1);
				// $this->error('你今天已经提交报告了，明天才可以提交');
			// }elseif($s<7 && $logdata['logtype']==1){
				// $this->ajaxReturn(1);
				// $this->error('你今周已经提交报告了');
			// }elseif($s<30 && $logdata['logtype']==2){
				// $this->ajaxReturn(0);
				// $this->error('你今个月已经提交报告了');
			// }elseif($s<90 && $logdata['logtype']==3){
				// $this->ajaxReturn(0);
				// $this->error('你今个季度已经提交报告了');
			// }elseif($s<365 && $logdata['logtype']==4){
				// $this->ajaxReturn(0);
				// $this->error('你今年已经提交报告了');
			// }
			if($_POST['submittype']==1){
				$data['submittype'] = 1;
			}else{
				$data['submittype'] = 2;
			}
			//$data['type'] = $_POST['logtype'];//日志类型
			$data['type'] = $_POST['logtype'];//日志类型
			$data['title'] = $_POST['title'];
			if(!$data['title']){
	
				$this->ajaxReturn(0);
			
			}
			$data['content'] = $_POST['content'];
			$principal = $_POST['principal'];
			if(!$principal){//负责热
				$this->ajaxReturn(0);
			}
			 $relevance =$_POST['relevance']; 
			if(!$relevance){//抄送                    
				$this->ajaxReturn(0);
			}
			//判断是否上传图片、
			if($_POST['pic']){
				
				// $this->ajaxReturn(0);
					//存在图片就存
				$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
				
				if($app['type']==2){
					$user['corpid']='';
					$user['corpsecret']='';
		
				}
				$save_dir = "./Uploads/Log/".$app['userid']."/".$_POST['wecha_id']."/";
				$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
					
				$pic = explode(',',$_POST['pic']);
				$fileUrl = '';
				foreach($pic as $v){
					if($v){
						$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
						$filePath = $this->saveMedia($url,$save_dir);
						$picFind=M('Log_pic')->where(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']))->find();
						if(!$picFind){
							$add = M('Log_pic')->add(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']));
							if($add){
								$fileUrl .= $add.',';
							}
						}
					}
				}
				$data['img'] = $fileUrl;
			} 
			$data['create_time'] = date('Ymd');
			$data['userid'] = $usersid['id'];
			$data['principal'] = $principal;
			$data['relevance'] = $relevance;
			//F('$_POST',$_POST);
			//F('$data',$data);
			$logid = M('Qylog')->add($data);
			$principal = explode('|',$principal);
			$relevance = explode('|',$relevance);
			if($logid){
				//$this->ajaxReturn(1);
				$copytoid = array_merge_recursive($principal,$relevance);
				$copytoids = array_unique($copytoid);
				// print_r($copytoids);exit;
				foreach($copytoids as $val){
					if($val){
					  $copydata['userid'] = $val;
					  $copydata['logid'] = $logid;
					  $copydata['create_time'] = date('Ymd');
					  $copyresult[] = M('Qycopy')->add($copydata);
					}
				}
				$copyresultlenght = count($copyresult);
				$copytoidlenght = count($copytoids);
				
				if( $copyresultlenght= $copytoidlenght){
					$this->ajaxReturn(1);
				}else{
					
					$this->ajaxReturn(0);
				}
				
			}else{
				$this->ajaxReturn(0);
			}
			
		}else{
		    //echo 'aaa';exit;
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Log';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
				exit();
			}
			// $app=array('userid'=>227);
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
			$Jsssdk=A('Qyapp/Jsssdk');
			$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
			// print_r($jsssdk_info);exit;
			$this->assign('jsssdk_info',$jsssdk_info);
		// $depart=explode(';',$_SESSION['delist'.$_GET['wecha_id']]);
			if($_GET['type']){
				$depart=explode(';',$_SESSION['delist'.$_GET['wecha_id']]);
				foreach($depart as $v){
					if($v){
						$de['id'].=$v.'|';
						$department=M('Department')->where(array('user_id'=>$app['userid'],'wxid'=>$v))->field('name')->find();
						$de['name'].=$department['name'].';';	
					}
				}
				$this->assign('depart',$de);
				
				$user=explode(';',$_SESSION['userlist'.$_GET['wecha_id']]);
				foreach($user as $v){
					if($v){
						$us['id'].=$v.'|';
						$users=M('Qyusers')->where(array('id'=>$v))->field('name')->find();
						$us['name'].=$users['name'].';';	
					}
				}
				$this->assign('user',$us);
			}else{
				$_SESSION['from']='';
				$_SESSION['ai']='';
				$_SESSION['c1'.$_GET['wecha_id']]='';
				$_SESSION['c2'.$_GET['wecha_id']]='';
				$_SESSION['delist'.$_GET['wecha_id']]='';
				$_SESSION['userlist'.$_GET['wecha_id']]='';
			}
			// $usersdata = M('Qyusers')->where('user_id='.$users_id)->select();
			// $this->assign('usersdata',$usersdata);
		}
		// $usersdata = M('Qyusers')->where('user_id='.$users_id)->select();
		// $this->assign('usersdata',$usersdata);
		// print_r($_POST);exit;
		$type=M('qylog_type')->where(array('user_id'=>$app['userid']))->field('id,name')->select();
		$this->assign('type',$type);
        //dump($type);exit;		
		$this->display();	
	}
	//提交报告
	public function wapsubmittype(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Log';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();	
		}
		//立即提交
		$logid = $_POST['logid'];
		if($logid){
				$qylogsavedata = M('Qylog')->where(array('id'=>$logid))->save(array('submittype'=>1));
				if($qylogsavedata){
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(0);//发表失败
					
				}
		}
	}
	//查看报告 删除报告
	Public function wapaboutMe(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Log';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();	
		}
		$wecha_id = $_GET['wecha_id'];

		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id')->find();
		
		$id = $_GET['logdel'];
		if($id){	
		// print_r($id);exit;
			$logdel = M('Qylog')->where('id='.$id)->delete();			
			if($logdel){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}

		$where['submittype'] = $_GET['submittype'];//区分查看提交类型。待提交。已提交
		if($where['submittype']){
			//$userid = "xiuying";
		//	$usersid = M('Qyusers')->where(array('userid'=>$userid))->field('id,name,position,pic')->find();//拿到员工id	
			$where['userid'] = 	$usersid['id'];
			$logdata = M('Qylog')->where($where)->select();
			// print_r($logdata);exit;
		}
		//搜索
		if(IS_POST && $_POST['title']!=null){
			$title = $_POST['title'];
			$logdata = $this->wapseach($title);	
	
			if($logdata['logdata']==1 && $logdata['logdatas']==2){
				// $this->assign('nulldata',"暂无数据");
				$this->error('没有数据');
			}
			// print_r($logdata);exit;
			if($key = array_search(2,$logdata)){
				
				unset($logdata[$key]);
			}
			if($key = array_search(1,$logdata)){
				unset($logdata[$key]);
			}
				// print_r($logdata);exit;
		}
	    $res = M('qylog_type')->where(array('user_id'=>$app['userid']))->field('id,name,status')->select();
		$type = array();
		foreach($res as $k=>$v){
		    $type[$v['id']]['name'] = $v['name'];
		}
		$ldata = array();
		if($logdata){
			foreach($logdata as $key=>$val){
			    //echo $key;
			    $ldata[$key] = $val;
				$ldata[$key]['type'] = $type[$val['type']]['name'];
 			}		
		}
		$this->assign('logdata',$ldata);	
		$this->display();
	}
	//搜索方法
	public function wapseach($title=""){
		//搜索title
		$where['title'] = array('like','%'.$title.'%');
		$logdataq = M('Qylog')->where($where)->select();
		foreach($logdataq as $val){
			$userss = M('Qyusers')->where(array('id'=>$val['userid']))->field('id,name,pic')->select();
			foreach($userss as $v){
				$logdataarr[] =array_merge($v,$val);
			}
		}
		if(!$logdataarr){
			$logdataarr=array('logdata'=>1);
		}
		//搜索名字
		$wheres['name'] = array('like','%'.$title.'%');
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Log';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
			exit();	
		}
		$wecha_id = $_GET['wecha_id'];
		$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id')->find();//自己的id
		$user_id=$app['userid'];
		$wheres['user_id'] = $user_id;
		$users = M('Qyusers')->where($wheres)->field('id,name,pic')->select();//被搜索的用户信息
		$copydata = M('Qycopy')->where(array('userid'=>$usersid['id']))->select();//自己收到的日志
		foreach($copydata as $val){
			if($val){
				foreach($users as $v){
					if($v['id'] && $val['logid']){
						$logdata= M('Qylog')->where(array('userid'=>$v['id'],'id'=>$val['logid']))->find();	
							if($logdata['id']){
								$logdata['name'] = $v['name'];
								$logdata['pic'] = $v['pic'];
							}						
					}
				}	
				$logdatas[] = $logdata;
			}
		}
		$logdatas = array_filter($logdatas);
		if(!$logdatas){
			$logdatas=array('logdatas'=>2);
		}
		$logdataall =array_merge($logdataarr,$logdatas);
		if($logdataall){	
			
			return $logdataall;
		}
	}
	//相关日志
	public function waprelevancelog(){
		if(IS_POST && $_POST['keyword']!=null){
			$title = $_POST['keyword'];
			
			$usersdatas = $this->wapseach($title);

			if($usersdatas['logdata']==1 && $usersdatas['logdatas']==2){
				$this->error('没有数据');
			}
			if($key = array_search(2,$usersdatas)){
				
				unset($usersdatas[$key]);
			}
			if($key = array_search(1,$usersdatas)){
				
				unset($usersdatas[$key]);
			}
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Log';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
				exit();
				
			}
	
			$wecha_id = $_GET['wecha_id'];
			$usersid = M('Qyusers')->where(array('userid'=>$wecha_id))->field('id')->find();
			// echo $usersid['id'];exit;
			
			$qycopy = M('Qycopy')->where(array('userid'=>$usersid['id']))->field('logid')->select();
			// echo 1;exit;
			foreach($qycopy as $val){
					$qylogdata = M('Qylog')->where(array('id'=>$val['logid'],'submittype'=>1))->find();
					$usersdata = M('Qyusers')->where(array('id'=>$qylogdata['userid']))->field('name,pic')->find();
					if($usersdata){
						$qylogdata['name'] = $usersdata['name'];
						$qylogdata['pic'] = $usersdata['pic'];
						$usersdatas[] = $qylogdata;
					}
			}
			// print_r($qycopy);exit;
		}
		// 查找往期
		$logusers_id = $_GET['logusers_id'];
		if($logusers_id){
			foreach($qycopy as $val){
				if($val){
						$qylogdata = M('Qylog')->where(array('id'=>$val['logid'],'userid'=>$logusers_id))->find();
						
						$usersdata = M('Qyusers')->where(array('id'=>$qylogdata['userid']))->field('name,pic')->find();
						// print_r($usersdata);
						if($usersdata){
							$qylogdata['name'] = $usersdata['name'];
							$qylogdata['pic'] = $usersdata['pic'];
							$logusersdatass[] = $qylogdata;
						}
				}
			}
		}
		if($logusersdatass){
		
			$usersdatas = $logusersdatass;
		}
		// print_r($usersdatas);exit;
		$this->assign('usersdatas',$usersdatas);
		$this->display();
		
	}
	//下载微信图片方法
	function saveMedia($url,$dirname){
        $ch = curl_init($url);
		$header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
       
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);
        
        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time().rand(100,999).".{$fileExt}";
        //$dirname = "./Uploads/Announce/";
        if(!file_exists($dirname)){
            mkdir($dirname,0777,true);
        }
        file_put_contents($dirname.$filename,$media['mediaBody']);
        return $dirname.$filename;
    }
	//获取access_token
	public function access_token($api,$secret,$agentid,$userid){
		if($api&&secret){
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.$api.'&corpsecret='.$secret;
			$json=json_decode($this->curlGet($url_get), true);
		}else{
			if($userid){
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$userid))->field('appid,userid')->find();
			}else{
				$appinfo=M('Qymyapp')->where(array('appid'=>$agentid,'userid'=>$_SESSION['user_id']))->field('appid,userid')->find();
			}
			$json=$this->access_token_get($appinfo['appid'],$appinfo['userid']);
		}
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
	function https_request($url, $data = null){
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
?>