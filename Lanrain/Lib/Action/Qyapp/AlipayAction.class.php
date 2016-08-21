<?php
class AlipayAction extends UserAction{
	public $token;
	public $wecha_id;
	public $alipayConfig;
	public function __construct(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
		//读取配置
		$alipay_config_db=M('Alipay_config');
		$this->alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
	}
	
	public function pay(){
		//echo 111;die;
		//参数数据
		//echo '支付成功';exit;
		$orderName=$_GET['orderName'];
		$orderid=$_GET['orderName'];
		
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//before
		//echo 111;die;
		//$payHandel=new payHandle($this->token,$_GET['from']);
		//$orderInfo=$payHandel->beforePay($orderid);
		$price=$_GET['price'];
		
		dump($_GET);die;
		if(!$price)exit('必须有价格才能支付');
		$from=isset($_GET['from'])?$_GET['from']:'shop';
		$alipayConfig = $this->alipayConfig;
		//dump($alipayConfig);die;
		//反序列化得到支付的配置信息
		$now_pay_type = '';
		if($alipayConfig){
			$pay_setting = array();
			$config_info = json_decode($alipayConfig['info'],true);
			//print_r($config_info);exit;
			foreach($config_info as $key=>$value){
				if(is_array($value)){
					if($value['open']){
						$key = ($key == 'alipay') ? 'Alipaytype' : ucwords($key);
						$pay_setting[$key] = $value;
						$now_pay_type = $key;
					}
				}
			}
		}
		if(empty($alipayConfig) || empty($now_pay_type)){
			$now_pay_type = 'Alipaytype';
		}
		if(count($pay_setting) == 1){
			if($now_pay_type == 'Weixin'){
				header('Location:/index.php?g=Qyapp&m=Weixin&a=pay&price='.$price.'&orderName='.$orderName.'&single_orderid='.$orderid.'&showwxpaytitle=1&from='.$from.'&token='.$this->token.'&wecha_id='.$this->wecha_id);
			}else if($now_pay_type != 'Platform'){
				header('Location:/index.php?g=Qyapp&m='.$now_pay_type.'&a=pay&price='.$price.'&orderName='.$orderName.'&single_orderid='.$orderid.'&from='.$from.'&token='.$this->token.'&wecha_id='.$this->wecha_id);
			}
		}
		/* if($alipayConfig['open'] == 0){
			$pay_setting['Daofu'] =0;
			$pay_setting['Dianfu'] =0;
		} */
		$this->assign('price',$price);
		$this->assign('orderName',$orderName);
		$this->assign('orderid',$orderid);
		$this->assign('from',$from);
		$this->assign('token',$this->token);
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('is_open',$alipayConfig['open']);
		$this->assign('pay_setting',$pay_setting);
		$this->display();
	}
	public function go_pay(){
		if($_GET['pay_type'] == 'Weixin'){
			header('Location:/index.php?g=Qyapp&m=Weixin&a=pay&price='.$_GET['price'].'&orderName='.$_GET['orderName'].'&single_orderid='.$_GET['orderid'].'&showwxpaytitle=1&from='.$_GET['from'].'&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id']);
		}else{
			header('Location:/index.php?g=Qyapp&m='.$_GET['pay_type'].'&a=pay&price='.$_GET['price'].'&orderName='.$_GET['orderName'].'&single_orderid='.$_GET['orderid'].'&from='.$_GET['from'].'&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&platform='.intval($_GET['platform']));
		}
	}
	
	public function index(){
		if (C('agent_version')){
			$group=M('User_group')->field('id,name,price')->where('price>0 AND agentid='.$this->agentid)->select();
		}else {
			$group=M('User_group')->field('id,name,price')->where('price>0')->select();
		}
		$user=M('User_group')->field('price')->where(array('id'=>session('gid')))->find();
		$this->assign('group',$group);
		$this->assign('user',$user);
		$this->display();
	}
	public function vip(){
		if (C('agent_version')){
			$group=M('User_group')->field('id,name,price')->where('price>0 AND agentid='.$this->agentid)->select();
		}else {
			$group=M('User_group')->field('id,name,price')->where('price>0')->select();
		}
		$user=M('User_group')->field('price')->where(array('id'=>session('gid')))->find();
		$this->assign('group',$group);
		$this->assign('user',$user);
		$this->display();
	}
	public function vip_post (){
		$month=intval($_POST['num']);
		//检查费用
		$groupid=intval($_POST['gid']);
		$thisGroup=M('User_group')->where(array('id'=>$groupid))->find();
		$needFee=intval($thisGroup['price'])*$month;
		$moneyBalance=$this->user['moneybalance'];
		///
		$wxusers=M('Wxuser')->where(array('uid'=>$this->user['id']))->select();
		//
		if ($this->isAgent){
			$pricebyMonth=intval($this->thisAgent['wxacountprice'])/12;
			$price=$pricebyMonth*count($wxusers)*$month;
			if ($price>$this->thisAgent['moneybalance']){
				$this->error('请联系您的站长处理');
			}
		}
		//
		if ($needFee<$moneyBalance||$needFee==$moneyBalance){
			//
			$users_db=D('Users');
			$users_db->where(array('id'=>$this->user['id']))->save(array('viptime'=>$this->user['viptime']+$month*30*24*3600,'status'=>1,'gid'=>$groupid));
			//$users_db->where(array('id'=>$this->user['id']))->save(array('viptime'=>time()+$month*30*24*3600,'status'=>1,'gid'=>$groupid));
			//
			$gid=$groupid+1;
			$functions=M('Function')->where('gid<'.$gid)->select();
			$str='';
			if ($functions){
				$comma='';
				foreach ($functions as $f){
					$str.=$comma.$f['funname'];
					$comma=',';
				}
			}
			//
			$token_open_db=M('Token_open');
			
			if ($wxusers){
				foreach ($wxusers as $wxu){
					$token_open_db->where(array('token'=>$wxu['token']))->save(array('queryname'=>$str));
				}
			}
			$indent=array();
			$indent['id']=time();
			//
			$spend=0-$needFee;
			M('Indent')->data(array('uid'=>session('uid'),'month'=>$month,'title'=>'购买服务','uname'=>$this->user['username'],'gid'=>$groupid,'create_time'=>time(),'indent_id'=>$indent['id'],'price'=>$spend,'status'=>1))->add();
			M('Users')->where(array('id'=>$this->user['id']))->setDec('moneybalance',intval($needFee));
			//
			if ($this->isAgent){
				$pricebyMonth=intval($this->thisAgent['wxacountprice'])/12;
				if ($wxusers){
				$price=$pricebyMonth*count($wxusers)*$month;
				M('Agent')->where(array('id'=>$this->thisAgent['id']))->setDec('moneybalance',$price);
				M('Agent_expenserecords')->add(array('agentid'=>$this->thisAgent['id'],'amount'=>(0-$price),'des'=>$this->user['username'].'(uid:'.$this->user['id'].')延期'.$month.'个月，共'.count($wxusers).'个公众号','status'=>1,'time'=>time()));
				}
			}
			//
			$this->success('处理成功，请退出重新登陆才会生效',U('User/Index/index'));
		}else{
			$this->success('余额不足，请先充值',U('User/Alipay/index'));
		}
	}
	public function redirectPost(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		//price ,uname,uid,groupid,num 月
		$url=str_replace('.cn','.com',C('site_url'));
		header('Location:'.$url.'/index.php?g=Qyapp&m=Alipay&a=post&price='.$this->_post('price').'&uname='.$this->_post('uname').'&uid='.session('uid').'&groupid='.$this->_post('group').'&num='.$this->_post('num'));
	}
	public function post(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		import("@.ORG.Alipay.AlipaySubmit");
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		//服务器异步通知页面路径
		$notify_url = C('site_url').U('Apps/Alipay/notify');
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$return_url = C('site_url').U('Apps/Alipay/return_url');
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		//卖家支付宝帐户
		$seller_email =trim(C('alipay_name'));
		 //商户订单号
		$out_trade_no = $this->user['id'].'_'.time();
		//商户网站订单系统中唯一订单号，必填
		//订单名称
		$subject ='充值vip'.$this->_post('group').'会员'.$this->_post('num').'个月';
		//必填
		//付款金额
		$total_fee =(int)$_POST['price'];

        $body = 'vip高级会员服务费';
        //商品展示地址
        $show_url = C('site_url').U('Home/Index/price');
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
		$body = $subject;
		$data=M('Indent')->data(			
		array('uid'=>session('uid'),'month'=>intval($this->_post('num')),'title'=>$subject,'uname'=>$this->_post('uname'),'gid'=>$this->_post('gid'),'create_time'=>time(),'indent_id'=>$out_trade_no,'price'=>$total_fee))->add();
		$show_url = rtrim(C('site_url'),'/');

		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service" => "create_direct_pay_by_user",
			"partner" =>trim(C('alipay_pid')),
			"payment_type"	=> $payment_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"seller_email"	=> $seller_email,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"show_url"	=> $show_url,
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			"_input_charset"	=>trim(strtolower('utf-8'))
		);

	//建立请求
	$alipaySubmit = new AlipaySubmit($this->setconfig());
	$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	echo $html_text;
	}
	public function recharge(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		import("@.ORG.Alipay.AlipaySubmit");
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		//服务器异步通知页面路径
		$notify_url = C('site_url').U('Apps/Alipay/notify');
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$return_url = C('site_url').U('Apps/Alipay/charge_return');
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		//卖家支付宝帐户
		$seller_email =trim(C('alipay_name'));
		//商户订单号
		$out_trade_no = $this->user['id'].'_'.time();
		//商户网站订单系统中唯一订单号，必填
		//订单名称
		$subject ='充值';
		//必填
		//付款金额
		$total_fee =floatval($_POST['price']);

		$body = '会员充值';
		//商品展示地址
		$show_url = C('site_url').U('Home/Index/price');
		//需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

		//防钓鱼时间戳
		$anti_phishing_key = "";
		//若要使用请调用类文件submit中的query_timestamp函数

		//客户端的IP地址
		$exter_invoke_ip = "";
		//非局域网的外网IP地址，如：221.0.0.1
		$body = $subject;
		$data=M('Indent')->data(
		array('uid'=>session('uid'),'month'=>0,'title'=>$subject,'uname'=>$this->_post('uname'),'gid'=>0,'create_time'=>time(),'indent_id'=>$out_trade_no,'price'=>$total_fee))->add();
		$show_url = rtrim(C('site_url'),'/');

		//构造要请求的参数数组，无需改动
		$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" =>trim(C('alipay_pid')),
		"payment_type"	=> $payment_type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"seller_email"	=> $seller_email,
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"show_url"	=> $show_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=>trim(strtolower('utf-8'))
		);
		//建立请求
		$alipaySubmit = new AlipaySubmit($this->setconfig());
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
	}
	public function setconfig(){
		$alipay_config['partner']		= trim(C('alipay_pid'));
		//安全检验码，以数字和字母组成的32位字符
		$alipay_config['key']			= trim(C('alipay_key'));
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		//签名方式 不需修改
		$alipay_config['sign_type']    = strtoupper('MD5');
		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= strtolower('utf-8');
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = getcwd().'\\Lanrain\\Lib\\ORG\\Alipay\\cacert.pem';
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';		
		return $alipay_config;
	}
	public function add(){
		$this->index();
	}
	public function charge_return (){
		import("@.ORG.Alipay.AlipayNotify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();	
		if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');
			//支付宝交易号
			$trade_no =  $this->_get('trade_no');
			//交易状态
			$trade_status =  $this->_get('trade_status');
			if( $this->_get('trade_status') == 'TRADE_FINISHED' ||  $this->_get('trade_status') == 'TRADE_SUCCESS') {
				$indent=M('Indent')->where(array('indent_id'=>$out_trade_no))->find();
				if($indent!=false){
					if($indent['status']==1){$this->error('该订单已经处理过,请勿重复操作');}
					M('Users')->where(array('id'=>$indent['uid']))->setInc('money',intval($indent['price']));
					M('Users')->where(array('id'=>$indent['uid']))->setInc('moneybalance',intval($indent['price']));
					$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
					if($back!=false){
						$this->success('充值成功',U('Apps/Index/index'));
					}else{
						$this->error('充值失败,请在线客服,为您处理',U('Apps/Index/index'));
					}
				}else{
					$this->error('订单不存在',U('Apps/Index/index'));

				}
			}else {
			  $this->error('充值失败，请联系官方客户');
			}
		}else {
			$this->error('不存在的订单');
		}
	}
	//同步数据处理
	public function return_url (){
		import("@.ORG.Alipay.AlipayNotify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();	
		if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');
			//支付宝交易号
			$trade_no =  $this->_get('trade_no');
			//交易状态
			$trade_status =  $this->_get('trade_status');
			if( $this->_get('trade_status') == 'TRADE_FINISHED' ||  $this->_get('trade_status') == 'TRADE_SUCCESS') {
				$indent=M('Indent')->where(array('indent_id'=>$out_trade_no))->find();
				if($indent!=false){
					if($indent['status']==1){$this->error('该订单已经处理过,请勿重复操作');}
					M('Users')->where(array('id'=>$indent['uid']))->setInc('money',intval($indent['price']));
					M('Users')->where(array('id'=>$indent['uid']))->setInc('moneybalance',intval($indent['price']));
					$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
					if($back!=false){
						$month=intval($indent['month']);
						//检查费用
						$groupid=intval($indent['gid']);
						$thisGroup=M('User_group')->where(array('id'=>$groupid))->find();
						$needFee=intval($thisGroup['price'])*$month;
						$moneyBalance=$this->user['moneybalance']+$indent['price'];
						if ($needFee<$moneyBalance){
							//
							$users_db=D('Users');
							$users_db->where(array('id'=>$indent['uid']))->save(array('viptime'=>$this->user['viptime']+$month*30*24*3600,'status'=>1,'gid'=>$indent['gid']));
							//
							$gid=$indent['gid']+1;
							$functions=M('Function')->where('gid<'.$gid)->select();
							$str='';
							if ($functions){
								$comma='';
								foreach ($functions as $f){
									$str.=$comma.$f['funname'];
									$comma=',';
								}
							}
							//
							$token_open_db=M('Token_open');
							$wxusers=M('Wxuser')->where(array('uid'=>$indent['uid']))->select();
							if ($wxusers){
								foreach ($wxusers as $wxu){
									$token_open_db->where(array('token'=>$wxu['token']))->save(array('queryname'=>$str));
								}
							}
							//
							$spend=0-$needFee;
							M('Indent')->data(array('uid'=>session('uid'),'month'=>$month,'title'=>'购买服务','uname'=>$this->user['username'],'gid'=>$groupid,'create_time'=>time(),'indent_id'=>$indent['id'],'price'=>$spend,'status'=>1))->add();
							M('Users')->where(array('id'=>$indent['uid']))->setDec('moneybalance',intval($needFee));
							//
							$this->success('充值成功并购买成功',U('Apps/Index/index'));
						}else{
							$this->success('充值成功但您的余额不足',U('Apps/Index/index'));
						}
					}else{
						$this->error('充值失败,请在线客服,为您处理',U('Apps/Index/index'));
					}
				}else{
					$this->error('订单不存在',U('Apps/Index/index'));

				}
			}else {
			  $this->error('充值失败，请联系官方客户');
			}
		}else {
			$this->error('不存在的订单');
		}
	}
	public function notify(){
		import("@.ORG.Alipay.alipay_notify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
				
	}
	
}



?>