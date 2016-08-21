<?php
class DistributionAction extends Action{
	
	private $param;
	private $url;	
	function _initialize(){
	    $this->param = '';
	    //远程服务器网站数据库的信息
		$result = M('Disturb_menu')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($result){
			$yuming = $result['link'];
			$file = $result['file'];
			$this->url  = ''.$yuming.'/'.$file.'';
		}
		
	}	
	
	/**
	*人员列表
	**/
    public function userList1(){
	    
	    $this->action = 'userList';
		$url  = $this->url;
		$post_data = 'param='.$this->action; 
		//$result = $this->postData($url,$post_data);
		$result = file_get_contents($this->url.'?param='.$this->action);
        $data = json_decode($result, true);
		$this->assign('data',$data);
		$this->display();
 		
	}
	
	/**
	*订单列表
	**/
    public function orderList1(){
    //public function index(){	
	    $this->action = 'orderList';
		$url  = $this->url;
		$post_data = 'param='.$this->action; 
		$result = file_get_contents($this->url.'?param='.$this->action);
        $data = json_decode($result, true);
		$this->assign('data',$data);
		$this->display();	
	}

	/**
	*产品管理
	**/
    public function product1(){
	    $this->action = 'product';
		$url  = $this->url;
		$post_data = 'param='.$this->action; 
		$result = file_get_contents($this->url.'?param='.$this->action);
        $data = json_decode($result, true);
		$this->assign('data',$data);
		$this->display();	
	}

	/**
	*推广管理
	**/
    public function expandList1(){
	    $this->action = 'expandList';
		$url  = $this->url;
		$post_data = 'param='.$this->action; 
		$result = file_get_contents($this->url.'?param='.$this->action);
        $data = json_decode($result, true);
		$this->assign('data',$data);
		$this->display();	
	}	
	
/* 	private function postData($url,$data){

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_POST, 1);  
		curl_setopt($ch, CURLOPT_HEADER, 0);  
		curl_setopt($ch, CURLOPT_URL,$url);  
		//为了支持cookie  
		//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		$back = curl_exec($ch);
		return $back;
	
	} */
	
	public function userAdd(){
		if(IS_POST){
			F('userdata',$_POST);
			exit;
			//*******新成员的添加****//
			$data['uid'] = $_POST['user_id'];//人员在商城端的ID
			$data['name'] = $_POST['name'];//人员名称
			
			//得到公司id
			//$user_id = M('qytoken')->where(array('username'=>$_POST['username']))->find();
			//如果手机号不为空，则以手机号为唯一标识添加用户到微信端
			if($_POST['mobile']){
				$appinfo=M('Qymyapp')->where(array('userid'=>$user_id['id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				$access_token=$this->access_token($user_id['corpid'],$user_id['corpsecret'],$appinfo["appid"]);
				$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
				$data='{
					   "userid": "'.$_POST['mobile'].'", 
					   "name": "'.$_POST['mobile'].'",
					   "department": ['.$department.'],
					   "position": "'.$_POST['position'].'",
					   "mobile": "'.$_POST['mobile'].'",
					   "gender": 1,
					   "tel": "'.$_POST['tel'].'",
					   "email": "'.$_POST['email'].'",
					   "weixinid": "'.$_POST['weixinid'].'",
					   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
						}';
				$post=$this->api_notice_increment($url_creat,$data);
				$departList=json_decode($post,true);
				if($departList['errmsg']=='created'){
					$user=$this->memberInfo_get($_POST['mobile'],$user_id['id']);//$_POST['mobile']为成员唯一标识
					echo 1;//添加成功
				}else{
					$users = M('Qyusers')->where(array('userid'=>$_POST['mobile'],'user_id'=>$user_id['id']))->find();
					if($users){
						echo 2;//已存在
					}else{
						echo 3;//添加失败，必须添加手机号或其他错误
					}
				}	
			}else{
				echo 0;//手机号码是用户唯一标识
				exit;
			}
			$data['mobile'] = $_POST['mobile'];
			$result = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id'],'uid'=>$data['uid']))->find();
			if(!result){
				$add = M('Disturb_users')->add($data);
				if($add){
					echo 1;//添加成功，返回1
				}else{
					echo 2;//添加失败，返回2
				}
			}
		}
		
	}
	
	
	
	
	//人员列表
	//public function userList(){
	public function index(){
		/* if(IS_POST){
			//F('userdata',$_POST);
			//新成员的添加
			$data['uid'] = $_POST['user_id'];//人员在商城端的ID
			$data['name'] = $_POST['name'];//人员名称
			if($_POST['parent_id']){
				$data['parent_id'] = $_POST['parent_id'];//上级id
			}else{
				$data['parent_id'] = 0;//表示没有上级
			}
			//得到公司id
			$user_id = M('qytoken')->where(array('username'=>$_POST['username']))->find();
			//如果手机号不为空，则以手机号为唯一标识添加用户到微信端
			if($_POST['mobile']){
				$appinfo=M('Qymyapp')->where(array('userid'=>$user_id['id'],'status'=>1,'type'=>2))->find();
				if($appinfo){
					$user['corpid']='';
					$user['corpsecret']='';
				}
				$access_token=$this->access_token($user_id['corpid'],$user_id['corpsecret'],$appinfo["appid"]);
				$url_creat='https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token='.$access_token['access_token'];
				$data='{
					   "userid": "'.$_POST['mobile'].'", 
					   "name": "'.$_POST['mobile'].'",
					   "department": ['.$department.'],
					   "position": "'.$_POST['position'].'",
					   "mobile": "'.$_POST['mobile'].'",
					   "gender": 1,
					   "tel": "'.$_POST['tel'].'",
					   "email": "'.$_POST['email'].'",
					   "weixinid": "'.$_POST['weixinid'].'",
					   "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
						}';
				$post=$this->api_notice_increment($url_creat,$data);
				$departList=json_decode($post,true);
				if($departList['errmsg']=='created'){
					$user=$this->memberInfo_get($_POST['mobile'],$user_id['id']);//$_POST['mobile']为成员唯一标识
					echo 1;//添加成功
				}else{
					$users = M('Qyusers')->where(array('userid'=>$_POST['mobile'],'user_id'=>$user_id['id']))->find();
					if($users){
						echo 2;//已存在
					}else{
						echo 3;//添加失败，必须添加手机号或其他错误
					}
				}	
			}else{
				echo 0;//手机号码是用户唯一标识
				exit;
			}
			$data['mobile'] = $_POST['mobile'];
			$result = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id'],'uid'=>$data['uid']))->find();
			if(!result){
				$add = M('Disturb_users')->add($data);
				if($add){
					echo 1;//添加成功，返回1
				}else{
					echo 2;//添加失败，返回2
				}
			}
		} */
		//$list = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id']))->select();
		//$this->assign('data',$list);
		//$this->display();	
		
	    $this->action = 'userList';
		$url  = $this->url;
		$post_data = 'param='.$this->action; 
		//$result = $this->postData($url,$post_data);
		$result = file_get_contents($this->url.'?param='.$this->action);
        $data = json_decode($result, true);
		//dump($data);exit;
		//print_r($data);exit;
		//dump($data);exit;
		//print_r($data);exit;
		import("ORG.Util.Page");
		$count      = count($data);
		$Page       = new Page($count,25);
		$data = array_slice($data,$Page->firstRow,$Page->listRows);
		$show       = $Page->show();
		$this->assign('data',$data);
		$this->assign('page',$show);
		$this->display();
	}
	public function userInfo(){
		//$id = $_GET['id'];
		
		$this->display();
	}
	//我的推荐
	/* public function my($list=array(),$id = 0,$level = 0){
		$list = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id'],'parent_id'=>$id))->field('uid,parent_id')->select();//我的直接下级
		$userdata = '';
		if($list){
			foreach ($list as $k=>$v){	
					$id = $v['uid'];
					$v['level'] = ++$level;
					if($id!=null){
						$v['data'] = $this->my($id,$v['level']);
						$userdata[] = $v;
						$level--;
					}

			}
			
			return $data;
		}

	}*/
	
  	function my($id = 0,$data=array(),$level = 1){
		$list = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id'],'parent_id'=>$id))->field('uid,parent_id')->select();//我的直接下级
		if($list){
			foreach ($list as $v){	
				$v['level'] = $level;
				$data[] = $v;
				$id = $v['uid'];
				$data = $this->my($id,$data,$level+1);
			}
		}
	return $data;
	}
	
	//我的分成规则
	public function info(){
		$id = $_GET['uid'];
		$m = M('Disturb_users')->where(array('user_id'=>$_SESSION['user_id'],'uid'=>$id))->find();
		$rule = $m['rule'];
		$this->assign('data',$rule);
		$this->display();	
	/*	$data = array();
		$arr = array();
		if($id){
			$list = $this->my($id);
			foreach ($list as $v){
				$data[] = $v['level'];
			}
		}
		$data = array_unique($data);
		foreach ($data as $vo){
			foreach ($list as $va){
				if($va['level']==$vo){
					$arr[$vo] .= $va['uid'].',';
				}
			}
		}
		$this->assign('data',$arr);
		$this->display();*/
		
	}
	
	
	//我推荐的成员以及分成详情
	public function myDis(){
		if(IS_POST){
			$data = array();
			$post = $_POST['logdb'];//用户传递我推荐的订单信息
			$rule = $_POST['affdb'];//用户传递分成规则信息
			$user = $_POST['userid'];
			$data['user_id'] = $_POST['user_id'];//公司id
			if($data['user_id']){
				$m = M('Disturb_users')->where(array('user_id'=>$data['user_id'],'uid'=>$user))->setField('rule',$rule);
			}
			foreach ($post as $v){
				$data['order_sn'] = $v['order_sn'];//订单号
				$data['money'] = $v['money'];//现金分成
				$data['point'] = $v['point'];//积分分成
				$data['separate_type'] = $v['separate_type'];//分成方式
				$data['is_separate'] = $v['is_separate'];//分成状态
				$result = M()->where(array('user_id'=>$_SESSION['user_id'],'order_sn'=>$v['order_sn']))->find();
				if($result){
					$save = M('Disturb_my')->where(array('user_id'=>$data['user_id'],'order_sn'=>$data['order_sn']))->save($data);
					if($save){
						echo 1;//更新成功
					}else{
						echo 2;//更新失败
					}
				}else{
					$add = M('Disturb_my')->add($data);
					if($save){
						echo 3;//添加成功
					}else{
						echo 4;//添加失败
					}
				}
			}
		}
		
		$this->display();
	}
	
	public function product(){
		if(IS_POST){
			/* $data['goods_id'] = $_POST['goods_id'];
			$data['goods_name'] = $_POST['goods_name'];
			$data['goods_sn'] = $_POST['goods_sn'];
			$data['price'] = $_POST['goods_price'];
			if($_POST['username']){
				$token = M('qytoken')->where(array('username'=>$_POST['username']))->find();
				$data['user_id'] = $token['id'];
				$result = M('Disturb_product')->where(array('user_id'=>$token['id'],'goods_id'=>$_POST['goods_id']))->find();
				if($result){
					$save = M('Disturb_product')->where(array('user_id'=>$token['id'],'goods_id'=>$_POST['goods_id']))->save($data);
					if($save){
						echo 1;//更新成功
					}else{
						echo 2;//更新失败
					}
				}else{
					$add = M('Disturb_product')->add($data);
					if($add){
						echo 1;//更新成功
					}else{
						echo 2;//更新失败
					}
				}
				
			} */
			
			$data['goods_id'] = $_POST['goods_id'];
			$data['scale'] = $_POST['scale'];
			$data['user_id'] = $_SESSION['user_id'];
			$result = M('Disturb_product')->where(array('goods_id'=>$_POST['goods_id'],'user_id'=>$_SESSION['user_id']))->find();
			if($result){
				$save = M('Disturb_product')->where(array('goods_id'=>$_POST['goods_id'],'user_id'=>$_SESSION['user_id']))->setField('scale',$data['scale']);
				if($save){
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(2);
				}
			}else{
				$add = M('Disturb_product')->add($data);
				if($add){
					$this->ajaxReturn(3);
				}else{
					$this->ajaxReturn(4);
				}
			}
			
		}else{
			$this->action = 'product';
			$url  = $this->url;
			$post_data = 'param='.$this->action; 
			$result = file_get_contents($this->url.'?param='.$this->action);
			$data = json_decode($result, true);
			//dump($data);exit;
			foreach($data as $k=>$v){
				$list = M('Disturb_product')->where(array('goods_id'=>$v['goods_id'],'user_id'=>$_SESSION['user_id']))->field('id,scale')->find();
				if($list){
					$number = $list['scale']*100;
					$data[$k]['scale'] = $number.'%';	
				}
							
			}
			
			$this->assign('data',$data);
			$this->display();		
		}
		//$list = M('Disturb_product')->where(array('user_id'=>$_SESSION['user_id']))->select();
		//$this->assign('data',$list);
		//$this->display();
	}
	//产品详情
	public function goodsInfo(){
		$id = $_GET['id'];
		if($id){
			$data = M('Disturb_product')->where(array('id'=>$id))->find();
			
		}
		$this->assign('id',$id);
		$this->display();
	}
	public function goodsEdit(){
		if(IS_POST){
			$id = $_POST['goods_id'];
			$scale = $_POST['scale'];
			$save = M('Disturb_product')->where(array('id'=>$id))->setField('scale',$scale);
			if($save){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}
		$id = $_GET['id'];
		if($id){
			$data = M('Disturb_product')->where(array('id'=>$id))->find();
			
		}
		$this->assign('data',$data);
		$this->display();
	}
	
	public function goodsDel(){
		if(IS_POST){
		$id = $_POST['id'];
		if($id){
			$data = M('Disturb_product')->where(array('id'=>$id))->delete();
			if($data){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(2);
			}
		}
		}
	}
	//推广管理
	public function expandList(){
		$list = M('Disturb_gener')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('data',$list);
		$this->display();
	}
	
	//修改推广
	public function expandEdit(){
		if(IS_POST){
			$id = $_POST['id'];
			$data['gen_name'] = $_POST['gen_name'];
			$data['gen_info'] = $_POST['gen_info'];
			$data['gen_link'] = $_POST['gen_link'];
			$save = M('Disturb_gener')->where(array('id'=>$id))->save($data);
			if($save){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}
		$id = $_GET['id'];
		if($id){
			$data = M('Disturb_gener')->where(array('id'=>$id))->find();
			
		}
		$this->assign('data',$data);
		$this->display();
	}
	//添加推广
	public function expandAdd(){
		if(IS_POST){
			$_POST['user_id'] = $_SESSION['user_id'];
			$_POST['time'] = time(); 
			$add = M('Disturb_gener')->add($_POST);
			if($add){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}
		$this->display();
	}
	
	//推广详情
	public function expandInfo(){
		$id = $_GET['id'];
		if($id){
			$data = M('Disturb_gener')->where(array('id'=>$id))->find();
		}
		$this->assign('data',$data);
		$this->display();
	}
	//删除推广
	public function expandDel(){
		if(IS_POST){
		$id = $_POST['id'];
		if($id){
			$data = M('Disturb_gener')->where(array('id'=>$id))->delete();
			if($data){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(2);
			}
		}
		}
	}
	//发布推广
	public function expandPut(){
		if(IS_POST){
			$id = $_POST['id'];
			if($id){
			$array = array('status'=>1,'time'=>time());
			$status =  M('Disturb_gener')->where(array('id'=>$id))->find();
			if($status['status'] == 1){
				$this->ajaxReturn(3);
			}else{
				$data = M('Disturb_gener')->where(array('id'=>$id))->setField($array);
				if($data){
					$this->ajaxReturn(1);
				}else{
					$this->ajaxReturn(2);
				}
			}
			
			}
		}
	}
	
	
	
//调用商城订单数据实现佣金的统计分配
	//商城订单由服务号传递过来,同时传递该订单的uid,即上线的id
	//企业号显示订单列表
	public function orderList(){
	 if(IS_POST){
		 //F('disdata',$_POST);
		//订单处理
		foreach($_POST['order'] as $k=>$v){
			$data['user_id'] = $v['token'];
			$data['order_id'] = $v['order_id'];//订单ID
			$data['order_sn'] = $v['order_sn'];//订单号
			$data['order_status'] = $v['order_status'];//订单状态
			$data['pay_status'] = $v['pay_status'];//付款状态
			$data['uid'] = $v['user_id'];//下订单用户
			$data['goods_id'] = $v['product']['goods_id'];//产品ID
			$data['goods_name'] = $v['product']['goods_name'];//产品名称
			$data['goods_sn'] = $v['product']['goods_sn'];//产品编号
			$data['market_price'] = $v['product']['market_price'];//产品市场价
			$data['goods_price'] = $v['product']['goods_price'];//产品价格
			$data['goods_attr'] = $v['product']['goods_attr'];//产品颜色
			$result = M('Disturb_order')->where(array('user_id'=>$_data['user_id'],'order_id'=>$data['order_id']))->find();
			if($result){
				$save = M('Disturb_order')->where(array('user_id'=>$_data['user_id'],'order_id'=>$data['order_id']))->save($data);
			}else{
				$add = M('Disturb_order')->add($data);
			}
		}
	 	if(!$_POST['mobile']){
			echo 1;exit;//没有手机号码
		}
	 	$users = M('Disturb_order')->add($_POST);
	 }else{
	 	//$list = M('Disturb_order')->where(array('user_id'=>$_SESSION['user_id']))->select();//订单列表
	 	//$this->assign('list',$list);
	 	//$this->display();
	    $this->action = 'orderList';
		$url  = $this->url;
		//$post_data = 'param='.$this->action; 
		$result = file_get_contents($url.'?param='.$this->action);
        $data = json_decode($result, true);
		//print_r($data);exit;		
		$this->assign('data',$data);
		$this->display();		
		
	 }
	}
	
	public function menu(){
		if(IS_POST){
			$data['user_id'] = $_SESSION['user_id'];
			$data['link'] = $_POST['menu'];
			$data['file'] = $_POST['file'];
			if(preg_match('/^[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+.?/', $data['link'])){
				$result = M('Disturb_menu')->where(array('user_id'=>$_SESSION['user_id']))->find();
				if($result){
				$save = M('Disturb_menu')->where(array('user_id'=>$_SESSION['user_id']))->save($data);
				if($save){
					$this->success('修改成功');
					}else{
					$this->error('修改失败');
				}
				}else{
				$add = M('Disturb_menu')->add($data);
				if($add){
					$this->success('设置成功');
				}else{
					$this->error('设置失败');
				}
				}
			}else{
				$this->error('域名格式错误');
			}
			
		}
		$menu = M('Disturb_menu')->where(array('user_id'=>$_SESSION['user_id']))->find();
		$this->assign('menu',$menu);
		$this->display();
	}
	
	
	
	
	
//**********手机端**********//
	//首页显示分成规则,我的推荐
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Distribution';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
		}
		$uid = $_GET['wecha_id'];
		$wxid = M('Disturb_wxusers')->where(array('mobile'=>$uid))->find();
		header('location:http://ec.ilovety.cn/mobile/user.php?act=affiliate&wxid='.$wxid['wxid'].'');
		
	
	
	}
	//我的明细
	public function wap_money(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Distribution';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
		}
		if(IS_POST){
			
		}
		$uid = M('Disturb_users')->where(array('user_id'=>$app['userid'],'mobile'=>$_GET['wecha_id']))->find();
		$list = M('Disturb_my')->order('time')->where(array('user_id'=>$app['userid'],'uid'=>$uid['uid']))->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	//我的资料
	public function wap_my(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Distribution';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
		}
		if(IS_POST){
			$user = M('Disturb_users')->where(array('user_id'=>$app['userid'],'mobile'=>$_GET['wecha_id']))->field('id,mobile')->find();
			if($user){
				$data = array('bankcard'=>$_POST['bankcard'],'email'=>$_POST['email'],'wxid'=>$_POST['wxid']);
				$save = M('Disturb_users')->where(array('user_id'=>$app['userid'],'mobile'=>$_POST['wecha_id']))->setField($data);
				if($save){
					$this->ajaxReturn(1);//提交成功
				}else{
					$this->ajaxReturn(2);//提交失败
				}
				
			}else{
				$this->ajaxReturn(3);//没有用户

			}
		}
		$this->display();
	}
	
	
	
	
	
	
	//获取成员详细信息用来调用 
	function memberInfo_get($id,$user_id=''){
		$where['userid']=$id;
		if($user_id)  $where['user_id']=$user_id;
		$chick=M('Qyusers')->where($where)->find();
		if($chick){
			$memberinfo=json_encode($chick);
		}else{
			$user=M('qytoken')->where(array('id'=>$user_id))->find();
			//$access_token=$this->access_token($user['corpid'],$user['corpsecret']);
			//判断
			$appinfo=M('Qymyapp')->where(array('userid'=>$user_id,'status'=>1,'type'=>2))->find();
			if($appinfo){
				$user['corpid']='';
				$user['corpsecret']='';
			}
			$access_token=$this->access_token($user['corpid'],$user['corpsecret'],$appinfo["appid"]);
			
			
			$url_get='https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token['access_token'].'&userid='.$id;
			$memberinfo=$this->curlGet($url_get);
			$info=json_decode($memberinfo,true);
			$name=$this->save_pic($info['avatar']);
			foreach($info['department'] as $k=>$v){
				$str.=$v.';';
			}
			$info['pid']=';'.$str;
			$info['pic']='http://'.$_SERVER['SERVER_NAME'].'/'.$name;
			$info['avatar']=$info['pic'];
			$info['user_id']=$user_id;
			$memberinfo=json_encode($info);
			if(!$user_id) $info['user_id']=$user_id;
			if($info['userid']){
				$id=M('Qyusers')->add($info);
			}
		}
		return $memberinfo;	
	}
	//save the pic
	
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
	//token
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
	
	function getData(){
	    if(IS_POST){
		    $data['user_id'] = $_SESSION['user_id'];		
		    $data['uid'] = $_POST['user_id'];
			$data['wxid'] = $_POST['wxid'];
			$data['mobile'] = $_POST['tel'];
			$data['email'] = $_POST['email'];
			$data['name'] = $_POST['username'];	
			$data['parent_id'] = $_POST['departid'];			
		    M('Disturb_users')->add($data);
		}
	}
	
	
	
}