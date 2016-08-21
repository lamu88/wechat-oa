<?php
/*
*群发接口
*/
class MsgAction extends Action {
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
		
	//应用列表
	public function appMsg(){
		$appList=M('Qymyapp')->where(array('status'=>1,'userid'=>$_SESSION['user_id']))->select();
		$this->assign('list',$appList);
		$this->display();
	}
	
	
	//群发信息
	public function group_post(){
		$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
		$this->assign('appinfo',$appinfo);
		$this->display();
	}
	
	//图片信息
	public function image_post(){
		$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
		$this->assign('appinfo',$appinfo);
		$this->display();
	}
	
	
	//图文群发
	public function news_post(){
		$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
		$this->assign('appinfo',$appinfo);
		$list=M('Qyimgnews')->where(array('user_id'=>$_SESSION['user_id']))->order('id desc')->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	//voice
	public function voice_post(){
		if(IS_POST){
			//只能上传mp3,wma,wav,amr格式！
			if($_FILES['file']['name']){
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 10145728 ;// 设置附件上传大小
				$upload->allowExts  = array('mp3','wma','wav','amr');// 设置附件上传类型
				$upload->savePath =  "./TempFile/admin/voice/";// 设置附件上传目录
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());
				}else{
					$info =  $upload->getUploadFileInfo();
				}
				$data['url'] = '/TempFile/admin/voice/'.$info[0]['savename'];
			}
			if($_SESSION['user_id']){
				$common=A('Qyapp/Common');
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$id=M('Qyfile')->add(array(
				'user_id'=>$_SESSION['user_id'],
				'media_id'=>$post['media_id'],
				'created_time'=>time(),
				'type'=>'voice',
				'path'=>'http://'.$_SERVER['HTTP_HOST'].$data['url'],
				'title'=>$_FILES["file"]["name"]));
				if($id){
					$this->success( "上传文件成功");
				}else{
					$this->error( "上传失败请检查文件大小或配置");
				}
			}else{
				$this->error( "与微信对接失败");
			}
		}else{
			$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
			$this->assign('appinfo',$appinfo);
			$time=time()-3600*24*3;
			$list=M('Qyfile')->where(array('user_id'=>$_SESSION['user_id'],'type'=>'voice','created_time'=>array('gt',$time)))->limit(10)->select();
			$this->assign('list',$list);
			$this->display();
		}
	}
	
	//视频群发
	public function vidio_post(){
		if(IS_POST){
			//只能上传rm,rmvb,wmv,avi,mpg,mpeg,mp4格式！
			if($_FILES['file']['name']){
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 10145728 ;// 设置附件上传大小
				$upload->allowExts  = array('rm', 'rmvb','wmv','avi','mpg','mpeg','mp4');// 设置附件上传类型
				$upload->savePath =  "./TempFile/admin/vidio/";// 设置附件上传目录
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());
				}else{
					$info =  $upload->getUploadFileInfo();
				}
				$data['url'] = '/TempFile/admin/vidio/'.$info[0]['savename'];
			}
			if($_SESSION['user_id']){
				$common=A('Qyapp/Common');
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				$id=M('Qyfile')->add(array(
				'user_id'=>$_SESSION['user_id'],
				'media_id'=>$post['media_id'],
				'created_time'=>time(),
				'type'=>'vidio',
				'path'=>'http://'.$_SERVER['HTTP_HOST'].$data['url'],
				'title'=>$_FILES["file"]["name"]));
				if($id){
					$this->success( "上传文件成功");
				}else{
					$this->error( "上传失败请检查文件大小或配置");
				}
			}else{
				$this->error( "与微信对接失败");
			}
		}else{
			$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
			$this->assign('appinfo',$appinfo);
			$time=time()-3600*24*3;
			$list=M('Qyfile')->where(array('user_id'=>$_SESSION['user_id'],'type'=>'vidio','created_time'=>array('gt',$time)))->order('id desc')->limit(10)->select();
			$this->assign('list',$list);
			$this->display();
		}
	}
	
	//
	
	//文件群发
	public function file_post(){
		if(IS_POST){
			//能上传txt,xml,pdf,zip,doc,ppt,xls,docx,pptx,xlsx格式！
			if($_FILES['file']['name']){
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 10145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','txt','doc','ppt','xls','pdf','docx','xlsx','zip','rar');// 设置附件上传类型
				$upload->savePath =  "./TempFile/admin/file/";// 设置附件上传目录
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());
				}else{
					$info =  $upload->getUploadFileInfo();
				}
				$data['url'] = '/TempFile/admin/file/'.$info[0]['savename'];
			}
			if($_SESSION['user_id']){
				$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				//$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
				//判断
				$id=M('Qyfile')->add(array(
					'user_id'=>$_SESSION['user_id'],
					'media_id'=>$pic['media_id'],
					'created_time'=>time(),
					'type'=>'file',
					'path'=>'http://'.$_SERVER['HTTP_HOST'].$data['url'],
					'title'=>$_FILES["file"]["name"]
				));
				$this->success( "上传文件成功");
			}else{
				$this->error( "与微信对接失败");
			}
		}else{
			$appinfo=M('Qymyapp')->where(array('id'=>$_GET['id']))->find();
			$this->assign('appinfo',$appinfo);
			$time=time()-3600*24*3;
			$list=M('Qyfile')->where(array('user_id'=>$_SESSION['user_id'],'type'=>'file','created_time'=>array('gt',$time)))->order('id desc')->limit(10)->select();
			foreach($list as $k=>$v){
				$type=explode('.',$v['title']);
				$arr[$k]=$v;
				$arr[$k]['type']=$type[1];
			}
			//dump($arr);
			$this->assign('list',$arr);
			$this->display();
		}
	}
	
	//新增单图文
	public function add_new(){
		if(IS_POST){
			$_POST['user_id']=$_SESSION['user_id'];
			$_POST['time']=time();
			$_POST['content']=$_POST['info'];
			$_POST['pic']=$_POST['thumb_media_id'];
			$img=M('Qyimg')->where(array('pic'=>$_POST['thumb_media_id'],'user_id'=>$_SESSION['user_id']))->find();
			$_POST['thumb_media_id']=$img['media_id'];
			$id=M('Qyimgnews')->add($_POST);
			$this->redirect(U('Msg/group_post',array('id'=>$_POST['a_id'])));
		}else{
			if($_GET['id']){
				
			}
			$appinfo=M('Qymyapp')->where(array('id'=>$_GET['a_id']))->find();
			$this->assign('appinfo',$appinfo);
			$this->display();
		}
	}
	
	
	//群发操作
	public function post(){
		$data['touser']='';//个人
		$data['toparty']="1|2|3";//部门
		$data['totag']='';//标签
		$ids=explode(',',$_POST['departid']);
		foreach($ids as $k=>$v){
			$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
			$wxarr[$k]=$wxid['wxid'];
		}
		$data['toparty']=implode("|",$wxarr);
		//获取应用id
		$app=M('Qymyapp')->where(array('id'=>$_POST['agentid']))->field('appid')->find();
		$data['agentid']=$app['appid'];
		F('post1',$_POST);
		if($_POST['type']=='text'){
			//文本信息
			$data['msgtype']="text";
			$data["content"]=$_POST['content'];
			$info=$this->text($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}elseif($_POST['type']=="image"){
			//图片信息
			$data["content"]=$_POST['content'];
			$data['msgtype']="image";
			$info=$this->image($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}elseif($_POST['type']=="mpnews"){
			//单图文
			$data['info']=M('Qyimgnews')->where(array('id'=>$_POST['content']))->find();
			$info=$this->mpnews_one($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}elseif($_POST['type']=="voice"){
			$file=M('Qyfile')->where(array('id'=>$_POST['fileid'],'user_id'=>$_SESSION['user_id']))->find();
			$data['msgtype']="voice"; 
			$data['path']=$file['path'];
			$info=$this->voice($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}elseif($_POST['type']=="vidio"){
			$file=M('Qyfile')->where(array('id'=>$_POST['fileid'],'user_id'=>$_SESSION['user_id']))->find();
			$data['msgtype']="video";
			$data['path']=$file['path'];
			$info=$this->video($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}elseif($_POST['type']=="file"){
			$file=M('Qyfile')->where(array('id'=>$_POST['fileid'],'user_id'=>$_SESSION['user_id']))->find();
			$data['msgtype']="file";
			$data['path']=$file['path'];
			$info=$this->file($data);
			if($info['errmsg']=="ok"){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}
	}
	
	
	
	
	/******发送信息接口群*********/
	//text消息
	public function text($data=''){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$data='{
			   "touser": "'.$data["touser"].'",
			   "toparty": " '.$data["toparty"].' ",
			   "totag": " '.$data["toparty"].' ",
			   "msgtype": "text",
			   "agentid": " '.$data["agentid"].' ",
			   "text": {
				   "content": " '.$data["content"].' "
			   },
			   "safe":"0"
			}';
		$post=$this->api_notice_increment($url_post,$data);
		
		$departList=json_decode($post,true);
		return $departList;
	}
	//image消息
	public function image($data){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		//判断	
		$url_postimage='https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token['access_token'].'&type=image';
		$pic = $this->getmedia_id($url_postimage,$data['content']);
		$data1='{
			   "touser": "'.$data["touser"].'",
			   "toparty": "'.$data["toparty"].'",
			   "msgtype": "image",
			   "agentid": "'.$data["agentid"].'",
			   "image": {
				   "media_id": "'.$pic['media_id'].'"
			   }
			}';
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$post=$this->api_notice_increment($url_post,$data1);
		$departList=json_decode($post,true);
		return $departList;
	}
	
	function getmedia_id($url,$filename){
		$php_path=str_replace('\\', '/',dirname(__FILE__));		
		$php_path=substr($php_path,0,strlen($php_path)-24);
		$filename = str_replace('http://'.$_SERVER['HTTP_HOST'].'/','',$filename);
		$save_path=$php_path.$filename;
		$filepath['media'] = "@".$save_path;
		F('filepath',$filepath);
		$result =$this->api_notice_increment($url,$filepath);
		F('result',$result);
		return json_decode($result,true);
	}
	//voice消息  只能上传mp3,wma,wav,amr格式
	public function voice($data=''){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_postimage='https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token['access_token'].'&type=voice';
		$voice = $this->getmedia_id($url_postimage,$data['path']);
		$data1='{
			   "touser": "'.$data["touser"].'",
			   "toparty": "'.$data["toparty"].'",
			   "totag": " TagID1 | TagID2 ",
			   "msgtype": "voice",
			   "agentid": "'.$data["agentid"].'",
			   "voice": {
				   "media_id": "'.$voice['media_id'].'"
			   },
			   "safe":"0"
			}';
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$post=$this->api_notice_increment($url_post,$data1);
		$departList=json_decode($post,true);
		return $departList;
	}
	
	//video消息 大小: 不超过20M, 格式: rm, rmvb, wmv, avi, mpg, mpeg, mp4
	public function video($data=''){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$url_postimage='https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token['access_token'].'&type=video';
		$video = $this->getmedia_id($url_postimage,$data['path']);
		F('video',$video);
		$data='{
			   "touser": "'.$data["touser"].'",
			   "toparty": " '.$data["toparty"].' ",
			   "msgtype": "video",
			   "agentid": " '.$data["agentid"].' ",
			   "video": {
				   "media_id": "'.$video['media_id'].'"
			   },
			   "safe":"0"
			}';
		$post=$this->api_notice_increment($url_post,$data);
		$departList=json_decode($post,true);
		return $departList;
	}
	//file消息
	
	public function file($data=''){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$url_postimage='https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token['access_token'].'&type=file';
		$file = $this->getmedia_id($url_postimage,$data['path']);
		$data='{
			   "touser": "'.$data["touser"].'",
			   "toparty": " '.$data["toparty"].' ",
			   "msgtype": "file",
			   "agentid": " '.$data["agentid"].' ",
			   "file": {
				   "media_id": "'.$file['media_id'].'"
			   },
			   "safe":"0"
			}';
		$post=$this->api_notice_increment($url_post,$data);
		$departList=json_decode($post,true);
		return $departList;
	}
	//news消息
	//mpnews消息
	//手机端群发消息
	public function msg_send_all($data,$con){
		$user=M('qytoken')->where(array('id'=>$con))->find();
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$data['userid']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$data='{
			   "touser": "'.$data["touser"].'",
			   "toparty": "'.$data["toparty"].'",
			   "msgtype": "news",
			   "agentid": " '.$data["agentid"].' ",
			   "news": {
					   "articles":[
						   {
							   "title": "'.$data["title"].'",
							   "description": "'.$data["description"].'",
							   "url": "'.$data['url'].'"
						   }
					   ]
				   }
				}';
		$post=$this->api_notice_increment($url_post,$data);
		F('post1',$post);
		$departList=json_decode($post,true);
		F('dede',$departList);
		return $departList;
	}
	
	//department post to all party
	public function msg_send_depart($data,$con){
		$user=M('qytoken')->where(array('id'=>$con))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$data='{
			   "toparty": "'.$data["toparty"].'",
			   "msgtype": "news",
			   "agentid": " '.$data["agentid"].' ",
			   "news": {
					   "articles":[
						   {
							   "title": "'.$data["title"].'",
							   "description": "'.$data["description"].'",
							   "url": "'.$data['url'].'"
						   }
					   ]
				   }
				}';

		$post=$this->api_notice_increment($url_post,$data);

		$departList=json_decode($post,true);
		return $departList;
	}
	
	
	public function mpnews_one($data=''){
		$user=M('qytoken')->where(array('id'=>$_SESSION['user_id']))->find();
		//判断
		$appinfo=M('Qymyapp')->where(array('appid'=>$data["agentid"],'userid'=>$_SESSION['user_id']))->find();
		if($appinfo['type']==2){
			$user['corpid']='';
			$user['corpsecret']='';
		}
		$commom = A('Qyapp/Common');
		$access_token=$commom->access_token($user['corpid'],$user['corpsecret'],$data["agentid"],$appinfo['userid']);
		$url_post='https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token='.$access_token['access_token'];
		$data = '{
			   "touser": "'.$data["touser"].'",
			   "toparty": "'.$data["toparty"].'",
			   "agentid": "'.$data["agentid"].'",
			   "msgtype": "news",
			   "news": {
				   "articles":[
					   {
						   "title": "'.$data['info']["title"].'",
						   "description": "'.$data['info']["desc"].'",
						   "url": "'.$data['info']["link"].'",
						   "picurl": "'.$data['info']["pic"].'"
					   },
				   ]
			   }
			}';
		$post=$this->api_notice_increment($url_post,$data);F('post',$post);
		$departList=json_decode($post,true);
		return $departList;
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