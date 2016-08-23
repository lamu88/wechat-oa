<?php
/*
*应用store
*
*/
class AppstoreAction extends Action {
	
	//应用中心
	public function appcenter(){
		$appList=M('Qyapplist')->where(array('install'=>1))->select();
		$this->assign('list',$appList);
		$this->display();
	}
	
	public function appList(){
		$post_data['type']='appList';
		$rc=M('Qywebsite')->where(array('uid'=>$_SESSION['uid']))->find();
		$post_data['url']=$rc['site_url'];
		
		$applist=$this->https_request('http://app.workweixin.com/index.php/Market/Index/index',$post_data);
		//dump($applist);
		$List=json_decode($applist,true);
	
		if($List!=null){
			$HTTP_HOST = $_SERVER['HTTP_HOST'];
			$code = 'wy'.$HTTP_HOST.'qy';
			$md5code = md5(md5(md5(md5(md5($code)))));
			F(md5('weiyi'),$md5code);	
			
		}	
		
		$li_app=array();
		foreach ($List['msg'] as $ke=>$va){
			$ch=M('Qyapplist')->where(array('module'=>$va['action'],'install'=>1))->field('date')->find();
			
			$li_app[$ke]=$va;
			if($ch){
				//已经安装
				$li_app[$ke]['upstatus']=1;
				//是否需要升级
				if($va['update']>$ch['date']){
					$li_app[$ke]['upstatus']=2;
				}
			}
		}
		
		$this->assign('list',$li_app);
		$this->display();
	}
	public function appInfo(){
		$post_data['type']='appInfo';
		$post_data['id']=$_GET['id'];
		$post_data['url']=$_SERVER['HTTP_HOST'];
		$appInfo=$this->https_request('http://app.workweixin.com/index.php/Market/Index/index',$post_data);
		$info=json_decode($appInfo,true);
		//判断是否安装
		$isinstall=M('Qyapplist')->where(array('module'=>$info['msg']['action'],'install'=>1))->field('id,date')->find();
		$this->assign('isinstall',$isinstall);
		$this->assign('info',$info['msg']);
		
		//获取更新记录
		$post_arr['type']='gongneng_record';
		$post_arr['id']=$_GET['id'];		
		$gongneng_record=$this->https_request('http://app.workweixin.com/index.php/Market/Index/query',$post_arr);
		$gongneng_record=json_decode($gongneng_record,true);
		//dump($gongneng_record);die;
		$this->assign('up_record',$gongneng_record['msg']);
		$this->display();
	}
	
	//安装应用信息
	public function install(){
		$post_data['type']='appInfo';
		$post_data['id']=$_GET['id'];
		$appInfo=$this->https_request('http://app.workweixin.com/index.php/Market/Index/index',$post_data);
		$info=json_decode($appInfo,true);
		$this->assign('info',$info['msg']);
		$this->display();
	}
	
	
	//安装 解压 覆盖   （包含了更新）
	public function install_d(){
		
		$post_data['type']='install';
		$post_data['id']=$_GET['appid'];
		$post_data['url']=$_SERVER['HTTP_HOST'];
		$appInfo=$this->https_request('http://app.workweixin.com/index.php/Market/Index/index',$post_data);
		$info=json_decode($appInfo,true);
		
		if($info['msgcode']==1004){
		    
		   $this->error('您的域名还没授权，请联系官方授权');

		}
		
		if($info['msgcode']==1000){
			//下载
			$msg=$info['msg'];
			$filePath=$msg["attach_file"];
			$thumbPath=$msg["icon"];
			$fileTemp='./Data/Conf/logs/Temp/action_'.$msg["action"].strrchr($filePath,'.');//存放路劲
			$thumbTemp='./Static/thumb/thumb_'.$msg["action"].strrchr($msg["icon"],'.');
			$file=$this->httpcopy($filePath,$fileTemp);
			$thumb=$this->httpcopy($thumbPath,$thumbTemp);
			if($file['http_code']==200 && $thumb["http_code"]==200){
				//应用下载成功
				$savePath=ROOT_PATH;
				$zip=new Phpzip();				
				$zstatus=$zip->unZip($fileTemp,$savePath);
				if($zstatus)
				{
					//解压成功并覆盖
					if(file_exists($fileTemp)) unlink($fileTemp);
						//安装后写入数据  写数据方法向Qyapplist 里面写入数据 如果这个类型的数据已经有了就修改install字段为1
						$che=M('Qyapplist')->where(array('module'=>$msg['action']))->field('id')->find();
						if($che){
							$action=M('Qyapplist')->where(array('id'=>$che['id']))->save(array('install'=>1));
						}else{
							$action=M('Qyapplist')->add(
								array(
									'name'=>$msg['name'],
									'desc'=>$msg['desc'],
									'logo'=>$thumbTemp,
									'times'=>0,
									'type'=>1,
									'module'=>$msg['action'],
									'vip'=>0,
									'install'=>1,
									
								));
						}
						
						if($action!==null){
							if($action==0){
								$upm=M('Qyapplist')->where(array('id'=>$che['id']))->save(array('date'=>$msg['update']));
								$this->success('应用更新成功');
							}else{
								M('Qyapplist')->where(array('id'=>$che['id']))->save(array('category'=>$msg['fun_type']));
								$this->success('应用安装成功');
							}
						}else{
							$this->error('应用安装失败！');
						}
				}else
				{
					//$this->json_post($this->url_market,array('MsgType'=>'uninstall','order_num'=>$json["order_num"],'Host'=>$this->data["Host"]));
					$this->error('应用解压失败！');					
				}		
			}else{
				$this->error('应用下载！');
			}
		}
	}
	
	//卸载
	function uninstall()
	{
		$appid=$this->_get('appid','intval',0);
	
		if($appid)
		{
			$app=M("Qyapplist")->field('id,module')->where(array('id'=>$appid))->find();
			if($app){
				$del=M("Qyapplist")->where(array('id'=>$appid))->save(array('install'=>0));//这里不删除应用数据
				
				if($del){
					$post=array('type'=>'uninstall','module'=>$app['module']);
					$json=$this->https_request('http://app.workweixin.com/index.php/Market/Index/index',$post);
					$json=json_decode($json,true);
					if($json['msgcode']==1000){
						//删除文件
						$file=LIB_PATH.'Action/Qyapp/'.$app["module"].'Action.class.php';
						
						$tpl=TMPL_PATH.'Qyapp/'.$app["module"];	
						if(file_exists($file))
							unlink($file);
						if(is_dir($tpl))
						{						
							$dir=new File();
							$dir->del_dir($tpl);
						}
						$this->success('应用卸装成功！',U('App/appcenter'));
					}else{
						$this->error('您和应用商店对接不正确!');
					}
				}
			}else{
				$this->error('您还未安装此应用!');
			}
		}
	}
	
	
	
	
	/***************版本升级*******************/
	
	public function version(){
		//获取版本信息
		$post_data['type']='versionInfo';
		$versionInfo=$this->https_request('http://app.workweixin.com/index.php/Market/Index/query',$post_data);
		//dump($versionInfo);
		$info=json_decode($versionInfo,true);
		$this->assign('info',$info['msg']);
		//读取本文件的版本号
		$files = './Lanrain/Lib/Action/Yi/VersioninfoAction.class.php';
		$contents = file_get_contents($files);
		//dump($contents);die;
		$this->assign('nowversion',$contents);
		//判断是否有安装
		$nowversion=str_replace('.','',$info['msg']['No_id']);
		$contents=str_replace('.','',$contents);
		if($nowversion>$contents){
			$this->assign('status',1);		
		}
		//获取更新记录
		$post_data['type']='up_record';
		$up_record=$this->https_request('http://app.workweixin.com/index.php/Market/Index/query',$post_data);
		$up_record=json_decode($up_record,true);
		
		$this->assign('up_record',$up_record['msg']);
		
		$this->display();
	}


	public function query(){
		if($_POST['query']==1){
			//echo json_encode(array('status'=>1));
			//一键更新步骤  发出去自己的版本和自己需要更新的请求，根据返回的文件包 下载并解压到本地 执行数据库  返回更新成功一个版本，向文件写入最高版本
			$files = './Lanrain/Lib/Action/Yi/VersioninfoAction.class.php';
		$contents = file_get_contents($files); //读取版本号
			
			$post_data['type']='version_up';
			$post_data['p_v']=$contents;
			$post_data['url']=$_SERVER['HTTP_HOST'];
			$versionInfo=$this->https_request('http://app.workweixin.com/index.php/Market/Index/query',$post_data);
			
			$content=json_decode($versionInfo,true);
			if($content['msgcode']==1004) {echo json_encode(array('status'=>7));exit;}//您未经授权
			if($content['msgcode']==1003) {echo json_encode(array('status'=>2));exit;}//您已经是最新版本
			$fileTemp='./Data/Conf/logs/Temp/updatax_'.$content['msg']["id"].strrchr($content['msg']['path'],'.');//存放路劲
			if(file_exists('')) unlink($fileTemp);
			$down_file=$this->httpcopy('http://'.$content['msg']['path'],$fileTemp);
			if(!$down_file['http_code']){
				echo json_encode(array('status'=>3));exit;//下载失败
			}
			import("ORG.Util.Phpzip");
			$zip = new Phpzip();
			$status=$zip->unZip($fileTemp,ROOT_PATH);
			unlink($fileTemp);
			if(!$status){
			
				echo json_encode(array('status'=>5));exit;
			}
			$sql_file='sql.sql';
			if(file_exists($sql_file))
			{
				$sql= file($sql_file);
				$this->sql_query($sql);
				unlink($sql_file);
			} 
			
			file_put_contents($files,$content['msg']['No_id']);
			echo json_encode(array('status'=>6));
			exit;
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
			curl_setopt($ch, CURLOPT_REFERER,'http://'.$_SERVER["SERVER_NAME"]);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($curl);
			curl_close($curl);
			return $output;
		}
		
	private function httpcopy($url, $file="", $timeout=60)
	{
		$file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
		$dir = pathinfo($file,PATHINFO_DIRNAME);
		!is_dir($dir) && @mkdir($dir,0755,true);
		$url = str_replace(" ","%20",$url);
		if(function_exists('curl_init')) {		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$temp = curl_exec($ch);
			$status=curl_getinfo($ch);			
			if(file_exists($file))
				unlink($file);
			if(@file_put_contents($file, $temp) && !curl_error($ch)) {
				return $status;
			} else {
				return false;
			}
		}else{
			$opts = array(
				"http"=>array(
				"method"=>"GET",
				"header"=>"",
				"timeout"=>$timeout)
			);
			$context = stream_context_create($opts);
			if(@copy($url, $file, $context)) {
				return $file;
			} else {
				return false;
			}
		}
	}
	
	

	
	
	
	
	
	
	
}