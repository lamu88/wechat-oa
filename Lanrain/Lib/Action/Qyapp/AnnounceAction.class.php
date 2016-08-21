<?php
/**
*任务协作
**/
class AnnounceAction extends Action{
	public  $depart;
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
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
	
	
	public function index(){
        $this->check();
		$count      = M('Announce_news')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('Announce_news')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}	
	
	public function conf(){
        $this->check();
		$count      = M('Announce_news')->where(array('user_id'=>$_SESSION['user_id']))->count();
		$Page       = new Page($count,15);
		$data = M('Announce_news')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}	
	

	
/**
*详情
**/
public function info(){
    $this->check();
	$info=M('Announce_news')->where(array('id'=>$_GET['id']))->find();
	//dump($info);
	$this->assign('info',$info);
	$this->display();
}

/**
*删除
**/
public function del(){
    $this->check();
    $id = $this->_POST('id');
    $user_id = $_SESSION['user_id'];
	$info=M('Announce_news')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
}

/*******************************企业公告手机部分*******************************************/
/**
*手机首页
**/

//'我'发出公告
public function wap_index(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Announce';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_index');
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
	//默认是发出
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
	$list = M('Announce_news')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']))->order('time desc')->select();
	foreach($list as $k=>$v){
		$pic = explode(',',$v['pic']);
		foreach($pic as $vo){
			if($vo){
				$find=M('Announce_pic')->where(array('id'=>$vo))->find();
				$list[$k]['img'][] = $find['picurl'];
			}
		}
	}
	$this->assign('list',$list);
	//print_r($list);exit;
	$this->display();  
}



//'我'发出公告
public function wap_sent(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Announce';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_sent');
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
	//默认是发出
	$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
	$str = "|".$user['id']."|";
	$map['touser'] = array('like','%'.$str.'%');
	$map['user_id'] = $app['userid'];
	$list = M('Announce_news')->where($map)->order('time')->select();
	foreach($list as $k=>$v){
		$pic = explode(',',$v['pic']);
		foreach($pic as $vo){
			if($vo){
				$find=M('Announce_pic')->where(array('id'=>$vo))->find();
				$list[$k]['img'][] = $find['picurl'];
			}
		}
	}
	$this->assign('list',$list);
	//print_r($list);exit;
	$this->display();  
}




//发出公告
/* public function wap_sent11111(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		//默认是发出
		$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
		$depart=explode(';',$user['pid']);
		foreach($depart as $k=>$v){
			if($v){
				$arr[]='%|'.$v.'|%';
				
			}
		}
		//dump($arr);
		$map['alldepart'] =array('like',$arr,'OR');
		
		//$map['touser'] =array('like','%'.$user['userid'].'%');
		// $where['_logic'] = 'or';
		// $where['_complex'] = $map;
		 $map['user_id'] =$app['userid'];
		$list = M('Announce_news')->where($map)->order('id desc')->limit(15)->select();
		
	//	dump($where);
		
		
		foreach($list as $k=>$v){
			$lists[$k]=$v;
			$lists[$k]['user']=M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$app['userid']))->field('pic')->find();
		}
		$this->assign('list',$lists);
		$this->display();  
} */

/**
*添加任务操作
*/ 
public function wap_add_task(){
	if(IS_POST){
		F('post11',$_POST);
	    //dump($_POST);exit;
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('id,appid,userid,type')->find();
		F('$_POST',$_POST);
		$data = array();
		$data['user_id'] = $app['userid'];  	
		$data['wecha_id'] = $_POST['wecha_id'];  		 
		$data['touser'] ='|'.trim($_POST['touser']);		
		$data['todepart'] = '|'.trim($_POST['todepart']);		 
		$data['title'] = $_POST['title']; 
		$data['content'] = $_POST['content']; 
		$data['time'] = time();	 //创建时间	
		if($_POST['pic']){
			$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			F('pic02',$user);
			$save_dir = "./Uploads/Announce/".$app['userid']."/".$_POST['wecha_id']."/";
			
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			F('pic01',$access_token);
			$pic = explode(',',$_POST['pic']);
			$fileUrl = '';
			foreach($pic as $v){
				if($v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					$picFind=M('Announce_pic')->where(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']))->find();
					if(!$picFind){
						$add = M('Announce_pic')->add(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']));
						if($add){
							$fileUrl .= $add.',';
						}
					}
				}
			}
			$data['pic'] = $fileUrl;
		} 
		F('pic',$filePath);
		$userinfo=M('Qyusers')->where(array('user_id'=>$app['userid']))->select();
		
		$u = M('department')->select();
		F('rets',$u);
		//获取用户
		$users=explode('|',$_POST['touser']);
		foreach($users as $k=>$v){
			if($v){
				$userinfo=M('Qyusers')->where(array('id'=>$v))->field('userid')->find();
				$touser.=$userinfo['userid']."|";
			}
		}
		//获取部门
		$data['alldepart']='|'.$this->wap_department($_POST['todepart']);
		F('dddda',$data);
        if($id=M('Announce_news')->add($data)){
			//群发消息
			 $head=M('Qyusers')->where(array('id'=>$data['head']))->field('userid')->find();
			 $Msg=A('Qyapp/Msg');
			 $inin['touser']=$touser;
			 $inin['toparty']= str_replace('|=','',$_POST['todepart'].'=');
			 $inin['title']=$_POST['title'];
			 $inin['description']="请您点击查看";
			 $inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Announce&a=wap_act_info&token='.$_GET['token'].'&pid='.$id;
			 $inin["agentid"]=$app['appid'];
			 $msg=$Msg->msg_send_all($inin,$app['userid']);
			 F('inin',$inin);
			 F('msg',$msg);
			 if($msg['errcode']==0){
				//$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$id)));
				$this->ajaxReturn($id);//发送成功
			 }else{
				M('Announce_news')->where(array('id'=>$id))->delete();
				//$this->redirect();
				$this->ajaxReturn(10);//发送消息失败，删除当前公告
			 }	
		}else{
			//$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
			$this->ajaxReturn(20);//发送公告失败		
		}
		
	}else{		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
		//dump($app);exit;
		//dump($_GET);exit;
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Announce';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_add_task');
			exit();
		}
		//JSSDK调用
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);
		
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
		
	    $this->display();
	}
}
//编辑公告
public function wap_edit_task(){
	if(IS_POST){
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('id,appid,userid,type')->find();
		$data = array();
		$data['user_id'] = $app['userid'];  	
		$data['wecha_id'] = $_POST['wecha_id'];  		 
		$data['touser'] ='|'.trim($_POST['touser']);		
		$data['todepart'] = '|'.trim($_POST['todepart']);		 
		$data['title'] = $_POST['title']; 
		$data['content'] = $_POST['content']; 
		$data['time'] = time();	 //创建时间	
		if($_POST['pic']){			
			$user=M('Qytoken')->where(array('id'=>$app['userid']))->find();
			if($app['type']==2){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$save_dir = "./Uploads/Announce/".$app['userid']."/".$_POST['wecha_id']."/";
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$app["appid"]);
			
			$pic = explode(',',$_POST['pic']);
			$fileUrl = '';
			foreach($pic as $v){
				if($v){
					$url = "https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token['access_token']."&media_id=".$v."";
					$filePath = $this->saveMedia($url,$save_dir);
					$picFind=M('Announce_pic')->where(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']))->find();
					if(!$picFind){
						$add = M('Announce_pic')->add(array('user_id'=>$user['id'],'picurl'=>$filePath,'wecha_id'=>$_POST['wecha_id']));
						if($add){
							$fileUrl .= $add.',';
						}
					}
				}
			}
			$data['pic'] = $fileUrl;

		} 
		
		//获取用户
		$users=explode('|',$_POST['touser']);
		foreach($users as $k=>$v){
			if($v){
				$userinfo=M('Qyusers')->where(array('id'=>$v))->field('userid')->find();
				$touser.=$userinfo['userid']."|";
			}
		}
		//获取部门
		$data['alldepart']='|'.$this->wap_department($_POST['todepart']);
		
		//dump($data);exit;
        if($id=M('Announce_news')->where(array('id'=>$_POST['news_id']))->save($data)){
			//群发消息
			 $head=M('Qyusers')->where(array('id'=>$data['head']))->field('userid')->find();
			 $Msg=A('Qyapp/Msg');
			 $inin['touser']=$touser;
			 $inin['toparty']= str_replace('|=','',$_POST['todepart'].'=');
			 $inin['title']=$_POST['title'];
			 $inin['description']="请您点击查看";
			 $inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Announce&a=wap_index&token='.$_GET['token'];
			 $inin["agentid"]=$app['appid'];
			 $msg=$Msg->msg_send_all($inin,$app['userid']);
			 if($msg['errcode']==0){
				//$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$id)));
				$this->ajaxReturn($id);//发送成功
			 }else{
				M('Announce_news')->where(array('id'=>$_POST['news_id']))->delete();
				//$this->redirect();
				$this->ajaxReturn(0);//发送消息失败，删除当前公告
			 }	
		}else{
			//$this->redirect(U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
			$this->ajaxReturn(0);//发送公告失败		
		}
		
	}else{
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
		if(!$_GET['wecha_id']){
			if($_COOKIE["wecha_id"]){
				$_GET['wecha_id']=$_COOKIE["wecha_id"];
			}else{
				$data['token']=$_GET['token'];
				$data['module']='Announce';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_add_task');
				exit();
			}
		}
		setcookie("wecha_id", $_GET['wecha_id'], time()+7200);
		//JSSDK调用
		$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid,corpsecret')->find();
		$Jsssdk=A('Qyapp/Jsssdk');
		$jsssdk_info=$Jsssdk->wap_index($user['corpid'],$user['corpsecret'],$app);
		$this->assign('jsssdk_info',$jsssdk_info);

		if($_GET['pid']){
			$list = M('Announce_news')->where(array('id'=>$_GET['pid']))->find();
			$toudepart = explode('|',$list['todepart']);
			$departname = "";
			foreach($toudepart as $value){
				if($value){
					$toudep=M('Department')->where(array('id'=>$value))->field('name,id')->find();
					$departname .=$toudep['name'].'|';
					$departid .=$toudep['id'].'|';
				}
			}
			$list['todepart'] = $departname;
			$list['todepartid'] = $departid;
			$touser = explode('|',$list['touser']);
			$touname = "";
			foreach($touser as $valu){
				if($valu){
					$tousers=M('Qyusers')->where(array('id'=>$valu))->field('name,id')->find();
					$touname .=$tousers['name'].'|';
					$touid .=$tousers['id'].'|';
				}
			}
			$list['touser'] = $touname;
			$list['touserid'] = $touid;
			$pic = explode(',',$list['pic']);
			foreach($pic as $val){
				if($val){
					$img=M('Announce_pic')->where(array('id'=>$val))->find();
					$imgs[]=$img['picurl'];
				}
			}
			$this->assign('imgs',$imgs);
	//dump($list);exit;
			$this->assign('data',$list);
		}
	    $this->display();
	}
}
public function wap_act_info(){
	$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	$news=M('Announce_news')->where(array('id'=>$_GET['pid']))->find();
	//查找用户
	$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$news['wecha_id']))->field('name,pic')->find();
	$news['user'] = $user['name'];
	$pic = array_filter(explode(',',$news['pic']));
	//dump($pic);exit;
	foreach($pic as $k=>$v){
		if($v){
			$find=M('Announce_pic')->where(array('id'=>$v))->find();
			$img[$k] = $find['picurl'];
		}
	}
	$zan = M('Announce_praise')->where(array('news_id'=>$_GET['pid'],'user_id'=>$app['userid']))->count();
	$number = M('Announce_comment')->where(array('news_id'=>$_GET['pid'],'user_id'=>$app['userid']))->count();
	$comment = M('Announce_comment')->where(array('news_id'=>$_GET['pid'],'user_id'=>$app['userid']))->select();
	foreach($comment as $k=>$vo){
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$vo['wecha_id']))->field('name,pic')->find();
		$comment[$k]['name'] = $user['name'];
		$comment[$k]['pic'] = $user['pic'];
	}
	//dump($img);exit;
	$this->assign('numzan',$zan);//赞
	$this->assign('number',$number);//评论总数
	$this->assign('comment',$comment);//评论详情
	$this->assign('news',$news);//公告
	$this->assign('picture',$img);//公告图片
	$this->display(); 
}
//点赞
public function wap_praise(){
	if(IS_POST){
		$app = $app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$data['news_id'] = $_POST['id'];//公告ID
		$data['time'] = time();//点赞时间
		$data['wecha_id'] = $_POST['wecha_id'];//点赞用户
		$data['user_id'] = $app['userid'];
		$btime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$etime = mktime(23,59,59,date('m'),date('d'),date('Y'));
		$map['news_id'] = $_POST['id'];
		$map['wecha_id'] = $_POST['wecha_id'];
		$map['time']  = array('between',''.$btime.','.$etime.'');
		$check = M('Announce_praise')->where($map)->find();
		if($check){
			$this->ajaxReturn(1);//你今天已经点过赞了
		}else{
			$add = M('Announce_praise')->add($data);
			if($add){
				$this->ajaxReturn(2);//点赞成功
			}
		}
		
	}
}

//评论
public function wap_comment(){
	if(IS_POST){
		$app = $app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$data['user_id'] = $app['userid'];
		$data['wecha_id'] = $_POST['wecha_id'];
		$user = M('Qyusers')->where(array('user_id'=>$app['userid'],'userid'=>$_POST['wecha_id']))->field('name,pic')->find();
		$data['news_id'] = $_POST['news_id'];
		$data['content'] = $_POST['content'];
		$data['time'] = time();
		$add = M('Announce_comment')->add($data);
		if($add){
			$result = M('Announce_comment')->where(array('id'=>$add))->find();
			$result['name'] = $user['name'];
			$result['pic'] = $user['pic'];
			$result['time'] = date('Y-m-d H:i:s',$result['time']);
			echo json_encode($result);//发表成功
			exit;
		}else{
			$this->ajaxReturn(2);//发表失败
		}
	}
}

//删除公告
public function wap_del(){
	if(IS_POST){
		$id = $_POST['id'];
		$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
		$news=M('Announce_news')->where(array('id'=>$id))->find();
		$pic = explode(',',$news['pic']);
		$del = M('Announce_news')->where(array('id'=>$id))->delete();
		if($del){
			$delComment = M('Announce_comment')->where(array('news_id'=>$id))->delete();//删除评论
			foreach($pic as $v){//删除图片
				if($v){
					$list = M('Announce_pic')->where(array('id'=>$v))->find();
					$remove = unlink($list['picurl']);
					if($remove){
						$delPic = M('Announce_pic')->where(array('id'=>$v))->delete();
					}
				}
			}
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	
}


public function wap_department($data=''){
	//$data="2|3|1|";
	$dedata=explode('|',$data);
	unset($dedata[count($dedata)-1]);
	$i=0;
	foreach($dedata as $v){
		$new[$i]['wxid']=$v;
		$i++;
		$user_id=25;
		$row=M('Department')->where(array('user_id'=>$user_id))->field('wxid,name,wxpid')->select();
		$departs=$this->build_tree($v,$row);
		
	}
	//return $todepart;
	$depart=explode('|',$this->depart.$data);
	unset($depart[count($depart)-1]);
	$todepart.=implode('|',array_flip(array_flip($depart))).'|';
	return $todepart;
	//dump($todepart);
}

function build_tree($wxid,$rows,$data){
    $childs=$this->findChild($rows,$wxid);
    if(empty($childs)){
        return null;
    }
	foreach ($childs as $k => $v){
		  $str.=$data.$v['wxid'].'|';
	}
   foreach ($childs as $k => $v){
       $rescurTree=$this->build_tree($v['wxid'],$rows,$str);
       if( null !=   $rescurTree){ 
       $childs[$k]['childs']=$rescurTree;
       }
   }
   $this->depart.=$str;
    return true;
}
function findChild($arr,$id){
    $childs=array();
     foreach ($arr as $k => $v){
        if($v['wxpid']== $id){
            $childs[]=$v;
        }
    }
    return $childs;
}

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

public function wap_depart(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
		$_SESSION['date']=$_GET['date'];
	}
	$map['user_id']=$app['userid'];
	$department=M('department')->where($map)->field('name,id')->select();
	$this->assign('department',$department);
	
	$this->display();
}	

public function wap_users(){
	$app=M('Qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
	if($_GET['from']){
		$_SESSION['from']=$_GET['from'];
		$_SESSION['ai']=$_GET['ai'];
		$_SESSION['aid']=$_GET['pid'];
	}
	$map['user_id']=$app['userid'];
	$users=M('Qyusers')->where($map)->field('name,id,pic')->select();
 	foreach($users as $k=>$v){
		if($v['name']){
			$arr[$k]=$v;
		}
	} 
	$this->assign('users',$arr);
	$this->display();
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