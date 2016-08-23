<?php
/*
erp操作模型
*/
class ErpModel extends Model {
	
	const BARCODE = "69099999";//条形码1-8位 对于没有条形码的商品我们默认分配的代码
	public $_db;
	protected $_time;
	protected $_pkid; //数据对象主键
	protected $_pkid_lock = array ();
	protected $_data = array ();
	protected $_dataTmp = array ();
	protected $_error = array ();
	function __construct($tablename="") {
		$this->tableName = $tablename;
	}
	public function primarykey() {
		return 'cat_id';
	}
	public function tableName() {
		return  $this->tableName;
	}
	public function get_app(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		return $app['userid'];
	}
	
	/**
	 * 安全过滤数据
	 * @param string	$str		需要处理的字符
	 * @param string	$type		返回的字符类型，支持，string,int,float,html
	 * @param maxid		$default	当出现错误或无数据时默认返回值
	 * @return 		mixed		当出现错误或无数据时默认返回值
	 */
	public  function getStr($str, $type = 'string', $default = '') {
		if ($str === '')
			return $default;
		switch ($type) {
			case 'string' : //字符处理
				$_str = strip_tags ( $str );
				$_str = str_replace ( "'", '&#39;', $_str );
				$_str = str_replace ( "\"", '&quot;', $_str );
				$_str = str_replace ( "\\", '', $_str );
				$_str = str_replace ( "\/", '', $_str );
				break;
			case 'int' : //获取整形数据
				$_str = ( int ) $str;
				break;
			case 'float' : //获浮点形数据
				$_str = ( float ) $str;
				break;
			case 'html' : //获取HTML，防止XSS攻击
				$_str = self::reMoveXss ( $str );
				break;
			default : //默认当做字符处理
				$_str = strip_tags ( $str );
		}
		return $_str;
	}
	function reMoveXss($val) {
		$val = preg_replace ( '/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val );
		$search = 'abcdefghijklmnopqrstuvwxyz';
		$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$search .= '1234567890!@#$%^&*()';
		$search .= '~`";:?+/={}[]-_|\'\\';
		for($i = 0; $i < strlen ( $search ); $i ++) {
			$val = preg_replace ( '/(&#[xX]0{0,8}' . dechex ( ord ( $search [$i] ) ) . ';?)/i', $search [$i], $val ); // with a ;
			$val = preg_replace ( '/(&#0{0,8}' . ord ( $search [$i] ) . ';?)/', $search [$i], $val ); // with a ;
		}
		$ra1 = Array ('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base' );
		$ra2 = Array ('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload' );
		$ra = array_merge ( $ra1, $ra2 );
		$found = true; // keep replacing as long as the previous round replaced something
		while ( $found == true ) {
			$val_before = $val;
			for($i = 0; $i < sizeof ( $ra ); $i ++) {
				$pattern = '/';
				for($j = 0; $j < strlen ( $ra [$i] ); $j ++) {
					if ($j > 0) {
						$pattern .= '(';
						$pattern .= '(&#[xX]0{0,8}([9ab]);)';
						$pattern .= '|';
						$pattern .= '|(&#0{0,8}([9|10|13]);)';
						$pattern .= ')*';
					}
					$pattern .= $ra [$i] [$j];
				}
				$pattern .= '/i';
				$replacement = substr ( $ra [$i], 0, 2 ) . '<x>' . substr ( $ra [$i], 2 ); // add in <> to nerf the tag
				$val = preg_replace ( $pattern, $replacement, $val ); // filter out the hex tags
				if ($val_before == $val) {
					$found = false;
				}
			}
		}
		return $val;
	}
	
	public function getOrderCate($space = '|___'){
		$values = M($this->tableName)->where(array('usersid'=>$this->get_app()))->order('cat_id')->select();
		if ($values) {
			// $tree = new erp_tree();
			$tree  = A('Qyapp/Erp_tree');

			$miniupid = $delbase = '';
			$listarr = $categoryarr = array ();
			foreach ( $values as $value ) {
				if ($miniupid == '')
					$miniupid = $value ['pid'];
				$tree->setNode ( $value ['cat_id'], $value ['pid'], $value ); //循环生成
	
				
			}
			// print_r ($miniupid);exit;
			$categoryarr = $tree->getChilds ( $miniupid );
			foreach ( $categoryarr as $key => $catid ) {
				$cat = $tree->getValue ( $catid );
				$cat ['pre'] = $tree->getLayer ( $catid, $space );
				$listarr [$key] = $cat;
			}
				// print_r ($miniupid);exit;
			return $listarr;
		}
		return $values;
	}
		public function create($data){
			$data['usersid'] = $this->get_app();
			if($data['cat_id']){
			
					$values = M($this->tableName)->where(array('cat_id'=>$data['cat_id']))->save($data);
					if($values){
							return $values;
					}else{
							return 0;
					}
				
			}else{
				
				$values = M($this->tableName)->add($data);
					return $values;
			}
			
		}
		//goods
		public function getGoodsList($condition = '', $page = 1) {
			 $where['_string'] = $condition;
	
			$goodsTableName = $this->tableName ();
			$cateTableName = 'tp_Qyerp_category';
			$goodsobj = M($goodsTableName);																										//问题
			$rs =$goodsobj ->join("JOIN tp_Qyerp_category ON tp_Qyerp_category.cat_id = tp_Qyerpgoods.cat_id ")->where($where)->field('tp_Qyerpgoods.*,tp_Qyerp_category.cat_name')->select();
			// $rs = $this->select ( $condition, "{$goodsTableName}.*,{$cateTableName}.cat_name", "", "order by goods_id desc", array ("{$cateTableName}" => "{$goodsTableName}.cat_id={$cateTableName}.cat_id" ) );
			if ($rs)
				return $rs;
			return array ();
			
		}
		//处理数据goods
		public function goods_create($data){
			$data ['market_price'] = $data ['market_price'] ? $data ['market_price'] : $data ['out_price'] * 1.2;
			$data ['warn_stock'] =  0;
			$data ['creatymd'] =  date ( 'Y-m-d', time());
			$data ['creatdateline'] =  time();
			$data ['usersid'] = $this->get_app();
			if($data['goods_id']){
				$re = M('Qyerpgoods')->where(array('goods_id'=>$data['goods_id']))->save($data);
			}else{
				$re = M('Qyerpgoods')->add($data);
			}
			if($re){
				$content = $data ['goods_id'] ? "修改商品：{$data ['goods_name']}" : "新增商品：{$data ['goods_name']}";
				 $this->log_create($re,$content,0);	

				if (( int ) $data ['in_num'] > 0 and ! $data ['goods_id']) { //新增商品才可以同时入库
					// $purchaseObj = base_mAPI::get ( "m_purchase" );
					$purchase ['goods_id'] = $re;
					$purchase ['in_num'] =  $data ['in_num'];
					$purchase ['in_price'] = $data ['in_price'];
					 $this->purchase_create($purchase);
				}
				return $re;
			}else{
				return false;
			}
				
		}
		/**
	 * 日志
	 * @param int $goods_id
	 * @param string $content
	 * @param int $type 0添加商品 1入库 2出库
	 */
	function log_create($goods_id, $content, $type = 0) {
		
		$data['goods_id'] = $goods_id; 
		$data['type'] = $type; 
		$data['content'] = $this->getStr($content);; 
		$data['user_id'] = $_GET['wecha_id'];
		$data['username'] = "l"; //待处理
		$data['dateymd'] =  date("Y-m-d", time());
		$data['dateline'] =  time();
		$data['usersid'] = $this->get_app();
		$res = M('Qyerplog')->add($data);
		if ($res) {
			return $res;
		}
		// $this->setError ( 0, "保存数据失败:" . $this->getError () );
		return false;
	}
	//入库
	public function purchase_create($data){
		//return 1;
		$goods_id =  $data ['goods_id'];
		if (! goods_id or ! $data ['in_num'] or ! $data ['in_price']) {
			// $this->setError ( 0, "缺少必要参数" );
			return false;
		}

		$rs =M('Qyerpgoods')->where(array('goods_id'=>$goods_id,'usersid'=>$this->get_app()))->find();
		$content = $data ['content'] ? $data ['content'] : "增加入库：名称：{$rs ['goods_name']},数量：{$data ['in_num']}";
		$datas['goods_id'] = $goods_id;
		$datas['goods_sn'] = $rs['goods_sn'];
		$datas['goods_name'] = $rs['goods_name'];
		$datas['cat_id'] = $rs['cat_id'];
		$datas['in_num'] = $data['in_num'];
		$datas['in_price'] = $data['in_price'];
		$datas['dateymd'] =  date ( "Y-m-d", time());
		$datas['dateline'] = time();
		$datas['usersid'] = $rs['usersid'];
		$res = M('Qyerppurchase')->add($datas);
		if ($res) {
			//return false;
			$this->setStock ($goods_id); //更新库存
			$this->log_create($goods_id, $content, 1);
			return $res;
		}else{
			return false;
		}
		
		
	}
	/**
	 * 修改库存
	 * @param int $goods_id
	 * @param float $amount
	 * @param int $isadd 1加 0减
	 */
	public function setStock($goods_id, $amount = 0, $isadd = 1) {
		if (! $goods_id)
			return false;
		// $purchaseObj = base_mAPI::get ( "m_purchase" );
		$stock = $this->getStockAmount ( $goods_id );
		if ($stock) {
			$goodsobj = M('Qyerpgoods');
			$salesamount = $goodsobj->where(array('goods_id'=>$goods_id,'usersid'=>$this->get_app()))->find();

			if ($amount > 0) {
				if ($isadd == 1) {
					$data['salesamount'] = $salesamount['salesamount'] + $amount;
			
				} else {
				
					$data['salesamount'] =$salesamount['salesamount'] - $amount;
				}
			}
			$data['countamount'] = $stock['countamount'];
			$data['stock'] = $stock['stock'];
			$data['lastinymd'] =date ( "Y-m-d", time() );
			$data['lastindateline'] =time();
			$savegoodsdata = $goodsobj->where(array('goods_id'=>$goods_id))->save($data);
			if ($savegoodsdata)
				return true;
		}
		// $this->setError ( 0, "库存异常" );
		return false;
	}

	
	/**
	 * 清除data数据
	 */
	public function clearData() {
		$this->_data [( int ) $this->_pkid] = null;
	}
		/**
	 * 计算商品库存总量和进货总金额
	 * @param int $goods_id
	 * @return Array
	 */
	public function getStockAmount($goods_id) {
		if (! $goods_id)
			return false;
		$rs = $res = array ();
		// $rs = $this->select ( "goods_id = {$goods_id} and isdel=0", "in_num,out_num,in_price" )->items;
		$rs = M('Qyerppurchase')->where(array('goods_id'=>$goods_id,'isdel'=>0,'usersid'=>$this->get_app()))->field('in_num,out_num,in_price')->select();
		$c_in = $c_price = 0;
		if ($rs) {
			foreach ( $rs as $v ) {
				$stock = $v ['in_num'] - $v ['out_num'];
				$c_in += $stock;
				$c_price += $stock * $v ['in_price'];
			}
			$res ['stock'] = sprintf ( "%01.2f", $c_in );
			$res ['countamount'] = sprintf ( "%01.2f", $c_price );
			return $res;
		}
		// $this->setError ( 0, "不存在入库记录！" );
		return false;
	}
	/**
	 * 商品出库
	 * @param int $goods_id
	 * @param float $num
	 * @param int $amount 总售价
	 */
	public function outStock($goods_id, $num = 1, $amount) {
		if ($goods_id) {
			// $rs = $this->select ( "goods_id = {$goods_id} and isdel=0 and in_num>out_num", "id,in_num,out_num", "", "order by id asc" )->items; //先进先出
			$rs = M('Qyerppurchase')->where(array('goods_id'=>$goods_id,'isdel'=>0,array('in_num',array('gt','out_num')),'usersid'=>$this->get_app()))->field('id,in_num,out_num')->order('id asc')->select();
			if (! $rs) {
				$this->setError ( 0, "没有可用的库存" );
				return false;
			}
			foreach ( $rs as $v ) {
				$stock = $v ['in_num'] - $v ['out_num'];
				if ($stock >= $num) {
					// $this->update ( "id={$v['id']}", "out_num=out_num+{$num}" );
					$rs = M('Qyerppurchase')->where(array('id'=>$v['id']))->setInc('out_num',$num);
					// print_r($rs);exit;
					break;
				} else {
					// $this->update ( "id={$v['id']}", "out_num={$v['in_num']}" );
					$rs = M('Qyerppurchase')->where(array('id'=>$v['id']))->save(array('out_num'=>$v['in_num']));
					$num = $num - $stock;
				}
			}
			// $goodsObj = base_mAPI::get ( "m_goods" );
			if ($this->setStock ( $goods_id, $amount )) {
				// $logObj = base_mAPI::get ( "m_log" );
				$this->log_create ( $goods_id, "商品ID：{$goods_id}出库:{$num}", 2 );
				return true;
			} else {
				// $this->setError ( 0, "修改商品信息错误" . $goodsObj->getError () );
				return false;
			}
		}
		return false;
	}
		/**
	 * 计算商品平均进价
	 * @param array 商品ID 数组 也可是单个ID
	 */
	function getAvgPrice($goods_ids) {
		$avgrice = array ();
		if (is_array ( $goods_ids )) {
			// $goods_ids = join(",", $goods_ids);
			// $rs = $this->select ( "goods_id in({$goods_ids})", "goods_id,stock,countamount" )->items;
			$where['goods_id'] = array('in',$goods_ids);
			$rs = M('Qyerpgoods')->where($where)->select();
			if ($rs) {
				foreach ( $rs as $k => $v ) {
					$avgrice [$v ['goods_id']] = sprintf ( "%01.2f", $rs ['countamount'] / $rs ['stock'] );
				}
			}
		} else {
			// $rs = $this->selectOne ( "goods_id={$goods_ids}", "stock,countamount" );
			$rs = M('Qyerpgoods')->where(array('goods_id'=>$goods_ids))->find();
			if ($rs)
				return sprintf ( "%01.2f", $rs ['countamount'] / $rs ['stock'] );
		}
		return $avgrice;
	}
		/**
	 * 获取会员价格
	 * @param int $cardID
	 * @param int $price
	 * @return
	 */
	public function getMemberPrice($cardID, $price = 0) {
		// $mTable = $this->tableName ();
		$mTable = "tp_Qyerpmember";
		// $gTable = base_Constant::TABLE_PREFIX . 'mbgroup';  tp_Qyerpmember.realname,
		// $rs = $this->selectOne ( "{$mTable}.membercardid='{$cardID}' and {$mTable}.state=1", "{$gTable}.discount as discount,{$mTable}.mid,{$mTable}.realname,{$mTable}.membercardid", '', '', array ("{$gTable}" => "{$gTable}.mgid={$mTable}.grade" ) );
		$where['_string'] = "{$mTable}.usersid={$this->get_app()} and {$mTable}.membercardid='{$cardID}' and {$mTable}.state=1";
		$rs = M('Qyerpmember')->join('JOIN tp_qyerpmbgroup ON tp_Qyerpmember.grade = tp_qyerpmbgroup.mgid')->field('tp_qyerpmbgroup.discount as discount,tp_Qyerpmember.mid,tp_Qyerpmember.membercardid')->where($where)->find();
		if (! $rs ['discount'])
			$rs ['discount'] = 100;
		$data ['mid'] =$rs['mid'];
		$data ['membercardid'] = $rs ['membercardid'];
		// $data ['realname'] = $rs ['realname'];
		$data ['discount'] = $rs ['discount'];
		$data ['price'] = sprintf ( "%01.2f", $price * $rs ['discount'] / 100 );
		// $data ['mid'] = 2;
		return $data;
	}
	/**
	 * 计算用户的积分
	 * @param int $mid
	 */
	public function setCredit($mid) {
		// $salesObj = base_mAPI::get ( "m_sales" );
		$credit = ( int ) $this->getUserConsumption ( $mid );
		// print_r($credit);exit;
		// $rs = $this->update ( "mid={$mid}", "credit=credit+{$credit},lastdateline='{$this->_time}'" );
		// $rs = M('Qyerpmember')->where(array('mid'=>$mid))->save(array('credit'=>$credit+$credit,'lastdateline'=>time()));
		$rs = M('Qyerpmember')->where(array('mid'=>$mid,'usersid'=>$this->get_app()))->save(array('lastdateline'=>time()));
		$rss = M('Qyerpmember')->where(array('mid'=>$mid,'usersid'=>$this->get_app()))->setinc('credit',$credit);
		// print_r($rs );;exit;
		if ($rs && $rss)
			return true;
		return false;
	}
	/**
	 * 获取指定会员的消费总金额
	 * @param int $mid
	 */
	public function getUserConsumption($mid) {
		// $rs = $this->select ( "mid='{$mid}'", "sum(price*num-refund_amount) as n" )->items;//有问题
		$rs = M('Qyerpsales')->field('sum(price*num-refund_amount) as n')->where(array('mid'=>$mid,'usersid'=>$this->get_app()))->select();
		if ($rs and $mid > 0) {
			return sprintf ( "%01.2f", $rs [0] ['n'] );
		}
		return "0";
	}
		//条形码
	public function bar_code(){
			$code = self::BARCODE.$this->random(4,1);
			$SBarcode = A('Qyapp/Sbarcode');
			$code = $SBarcode->_ean13CheckDigit($code);
			return $code;
	}
		//生成条形码图片bar_code
	public function bar_codeimg($code){
			$SBarcode = A('Qyapp/Sbarcode');
			$imgsrc = $SBarcode->genBarCode($code,'png','2','');
			return $imgsrc;
	}
		/**
	 * 产生随机数
	 * @param $length 产生随机数长度
	 * @param $type 返回字符串类型
	 * @param $hash  是否由前缀，默认为空. 如:$hash = 'zz-'  结果zz-823klis
	 * @return 随机字符串 $type = 0：数字+字母
	 $type = 1：数字
	 $type = 2：字符
	 */
	public static function random($length, $type = 0, $hash = '') {
		if ($type == 0) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		} else if ($type == 1) {
			$chars = '0123456789';
		} else if ($type == 2) {
			$chars = 'abcdefghijklmnopqrstuvwxyz';
		}
		$max = strlen ( $chars ) - 1;
		mt_srand ( ( double ) microtime () * 1000000 );
		for($i = 0; $i < $length; $i ++) {
			$hash .= $chars [mt_rand ( 0, $max )];
		}
		return $hash;
	
	}
	//清空临时订单表
	public function delOrder($orderid){
		if($orderid){
			// $this->delete("order_id='{$orderid}'");
			$re = M('Qyerptempsales')->where(array('order_id'=>$orderid,'usersid'=>$this->get_app()))->delete();
			if($re){
				return true;
			}
			
		}
		// echo $orderid;exit;
		return false;
	}
	//插入订单临时表
	public function insertOrder($data,$order_id){
		if(!$order_id){
			$this->setError(0,"订单号为空！");
			return false;
		}
		$data['order_id'] = $order_id;
		$data['dateline'] = time();
		$rs = M('Qyerptempsales')->add($data);
		// $rs = $this->insert($data);
		if($rs){
			return true;
		}else{
			$this->setError(0,"插入数据出错!");
			return false;
		}
	}
	///更新临时订单表
	public function updateOrder($data){
		if($data['order_id'] and $data['goods_id']){
			$condi = "usersid ='{$this->get_app()}' and order_id='{$data['order_id']}' and goods_id={$data['goods_id']}";
			$where['_string'] = $condi;
			M('Qyerptempsales')->where($where)->save(array('num'=>$data['num']));
			return true;
		}
		return false;
	}
		/**
	 * 获取商品的实际售价和优惠情况
	 * @param int $goods_id
	 * @return Array
	 */
	public function getSalePrice($goods_sn) {
	
		$goods = M('Qyerpgoods')->where(array('goods_sn'=>$goods_sn,'usersid'=>$this->get_app()))->find();
		if (! $goods)
			return false;
		$data = array ();
		$data ['goods_name'] = $goods ['goods_name'];
		$data ['goods_sn'] = $goods ['goods_sn'];
		$data ['stock'] = $goods ['stock'];
		$data ['goods_id'] = $goods ['goods_id'];
		$data ['cat_id'] = $goods ['cat_id'];
		$data ['out_price'] = $goods ['out_price'];
		$data ['p_discount'] = 0;
		$data ['ismemberprice'] = $goods ['ismemberprice'];
		$data ['ispromote'] = $goods ['ispromote'];
		$ymd = date ( "Y-m-d", time());
		if ($goods ['ispromote'] == 1 and $ymd > $goods ['promote_start_date'] and $ymd < $goods ['promote_end_date']) {
			$data ['promote_price'] = $goods ['promote_price'];
			$data ['p_discount'] = sprintf ( "%01.2f", $goods ['out_price'] - $goods ['promote_price'] ); //促销优惠
		}
		return $data;
	}
	/**
	 * 商品退货
	 * @param int $goods_id
	 * @param float $num
	 * @param int $amount 总退款
	 */
	public function backStock($goods_id, $num = 1, $amount) {
		if ($goods_id) {
			// $rs = $this->select ( "goods_id = {$goods_id} and isdel=0 and out_num>0", "id,in_num,out_num", "", "order by id desc" )->items; //后出后进
			$where['goods_id'] = $goods_id;
			$where['usersid'] = $this->get_app();
			$where['isdel'] = 0;
			$where['out_num'] =array('gt',0);
			$rs = M('qyerppurchase')->where($where)->field('id,in_num,out_num')->order('id desc')->select();
			// print_r($rs);exit;
			if (! $rs) {
				$this->error ("该商品没有出库记录" );
				return false;
			}
			foreach ( $rs as $v ) {
				if ($v ['out_num'] >= $num) {
					// $this->update ( "id={$v['id']}", "out_num=out_num-{$num}" );
					 M('qyerppurchase')->where(array('id'=>$v['id']))->setDec('out_num',$num);//减少销售数量
					break;
				} else {
					// $this->update ( "id={$v['id']}", "out_num=0" );
						M('qyerppurchase')->where(array('id'=>$v['id']))->save(array('out_num'=>0));
					$num = $num - $v ['out_num'];
				}
			}
			// $goodsObj = base_mAPI::get ( "m_goods" );
			if ($this->setStock ( $goods_id, $amount, 0 )) {
				// $logObj = base_mAPI::get ( "m_log" );
				$this->log_create ( $goods_id, "退款商品ID：{$goods_id}数量:{$num}退款总金额：{$amount}", 2 );
				return true;
			} else {
				// $this->setError ( 0, "修改商品信息错误" . $goodsObj->getError () );
				return false;
			}
		}
		return false;
	}
		/**
	 * 取消HTML特殊字符 防止XSS
	 * @param $string 可以为字符或者数组
	 * @return $string 可以为字符或者数组
	 */
	public static function shtmlspecialchars($string) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = self::shtmlspecialchars ( $val );
			}
		} else {
			$string = $this->getStr ( $string, 'string' );
		}
		return $string;
	}
}

?>