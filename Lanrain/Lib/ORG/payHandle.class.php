<?php 
	final class payHandle { 
	public $from; 
	public $db; 
	public $payType; 
	public $token; 
	public function __construct($token,$from,$paytype='tenpay') { 
		$this->from=$from;
		//$this->from=$from?$from:'Groupon';
		//$this->from=$this->from!='groupon'?$this->from:'Groupon'; 
	
		/* switch (strtolower($this->from)){ default: 
		//case 'groupon': $this->db=M('product_cart'); break;
		//case 'store': $this->db=M('store_cart'); break; 
		case 'repast': 
			$this->db=M('Dish_order'); break; 
		case 'hotels': 
			$this->db=M('Hotels_order'); break; 
		case 'business': 
			$this->db=M('Reservebook'); break; 
		case 'card':  */
			$this->db=M('qybonus_record'); //break; 
		//} 
		 $this->token=$token; 
		 $this->payType=$paytype; 
		 $this->db=M('qybonus_record');
		 /* if($this->from == 'Yiyuan'){$this->db=M('hotels_order');}
		 if($this->from == 'Bargain'){$this->db=M('Bargain_order');}
		 if($from == 'Ganxi'){
			$this->db=M('Product_cart'); 
		}
		if($from == 'Groupon'){
			$this->db=M('Product_cart'); 
		}
		if($from == 'Commission'){
			$this->db=M('Commission_cart'); 
		}
		if($from == 'Ecs'){
			$this->db=M('ecs_order'); 
		}
		 if($this->from == 'Membercard'){$this->db=M('hotels_order');}	
		}  */
	}
	public function getFrom(){ 

		return $this->from; 
		} 
	public function beforePay($id){ 
		$thisOrder=$this->db->where(array('token'=>$this->token,'orderid'=>$id))->find(); 
		//print_r($this->token);die;
		switch (strtolower($this->from)){ 
		default: 
		$price=$thisOrder['price']; 
		break; 
		case 'business': $price=$thisOrder['payprice']; 
		break; 
		} 
		return array('orderid'=>$thisOrder['orderid'],'price'=>$price,'wecha_id'=>$thisOrder['wecha_id'],'token'=>$thisOrder['token']); 
	} 

	public function afterPay($id,$transaction_id='') 
		{ 
		$thisOrder=$this->beforePay($id); 
		$wecha_id=$thisOrder['wecha_id']; 
		$member_card_create_db=M('Member_card_create');
		$userCard=$member_card_create_db->where(array('token'=>$this->token,'wecha_id'=>$wecha_id))->find();
		$userinfo_db=M('Userinfo'); if ($userCard){ $member_card_set_db=M('Member_card_set'); 
		$thisCard=$member_card_set_db->where(array('id'=>intval($userCard['cardid'])))->find(); 
		if ($thisCard){ 
			$set_exchange = M('Member_card_exchange')->where(array('cardid'=>intval($thisCard['id'])))->find(); 
			$arr['token']=$this->token; $arr['wecha_id']=$wecha_id; $arr['expense']=$thisOrder['price']; $arr['time']=time();
			$arr['cat']=99; $arr['staffid']=0; $arr['score']=intval($set_exchange['reward'])*$arr['expense']; 
			if(isset($_GET['redirect']))
			{
			$infoArr = explode('|',$_GET['redirect']); $param = explode(',',$infoArr[1]); if($param){ 
			foreach ($param as $pa){ $pas=explode(':',$pa); if($pas[0] == 'itemid'){ $arr['itemid']=$pas[1]; } } } } 
			M('Member_card_use_record')->add($arr); 
			$thisUser = $userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->find(); 
			$userArr=array(); $userArr['total_score']=$thisUser['total_score']+$arr['score']; 
			$userArr['expensetotal']=$thisUser['expensetotal']+$arr['expense']; 
			$userinfo_db->where(array('token'=>$this->token,'wecha_id'=>$arr['wecha_id']))->save($userArr); } } $order_model=$this->db; 

			$order_model->where(array('orderid'=>$id))->setField('paid',1); 
			if (strtolower($this->getFrom())=='groupon'){ 

			$order_model->where(array('orderid'=>$thisOrder['orderid']))->save(array('transactionid'=>$transaction_id,'paytype'=>$this->payType)); 
			} 
			return $thisOrder; 
			} 
		
		}