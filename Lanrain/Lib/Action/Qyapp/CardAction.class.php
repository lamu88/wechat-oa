<?php
/**
*微名片
**/
class CardAction extends Action{
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
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
		
	/**
	*名片设置
	**/
	public function index(){ 
        $this->check();	
		if(IS_POST){
		    //dump($_POST);exit;
			$data = array();
			$personal = array();
			$contact = array();
			$company = array();
			$other = array();
			$data['user_id']=$_SESSION['user_id'];
            //个人默认部分
            $personal['default']['chinaname'] = $_POST['chinaname'];
            $personal['default']['englishname'] = $_POST['englishname'];			
            //新增部分
			$i = 0;
            if($_POST['personal']){
				foreach($_POST['personal'] as $k=>$v){
				    if(!empty($v['name'])){
						if($v['status'] == 'on'){
							$personal['add'][$i]['status'] = 1;
						}else{
						    $personal['add'][$i]['status'] = 0;
						}
						$personal['add'][$i]['name'] = $v['name'];	
						$personal['add'][$i]['icon'] = $v['icon'];	
						$i++;
					}

				}			
			}						
			$data['geren'] = serialize($personal);

            //默认部分
            $contact['default']['mobile'] = $_POST['mobile'];
            $contact['default']['telephone'] = $_POST['telephone'];	
            $contact['default']['mail'] = $_POST['mail'];
            $contact['default']['weixin'] = $_POST['weixin'];				
            //新增部分
			$j = 0;
            if($_POST['contact']){
				foreach($_POST['contact'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$contact['add'][$j]['status'] = 1;
						}else{
						    $contact['add'][$j]['status'] = 0;
						}
						$contact['add'][$j]['name'] = $v['name'];
						$contact['add'][$j]['icon'] = $v['icon'];							
						$j++;
                    }						
				}			
			}			
			$data['shouji'] = serialize($contact);

            //默认部分
            $company['default']['companyname'] = $_POST['companyname'];
            $company['default']['companyaddress'] = $_POST['companyaddress'];			
            //新增部分	
			$m = 0;
            if($_POST['company']){
				foreach($_POST['company'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$company['add'][$m]['status'] = 1;
						}else{
						    $company['add'][$m]['status'] = 0;
						}
						$company['add'][$m]['name'] = $v['name'];	
						$company['add'][$m]['icon'] = $v['icon'];							
						$m++;
                    }						
				}			
			}		
			$data['gongshi'] = serialize($company);

            //默认部分
			
            //新增部分	
			$n = 0;
            if($_POST['other']){
				foreach($_POST['other'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$other['add'][$n]['status'] = 1;
						}else{
						    $other['add'][$n]['status'] = 0;
						}
						$other['add'][$n]['name'] = $v['name'];	
						$other['add'][$n]['icon'] = $v['icon'];							
						$n++;
                    }						
				}			
			}				
			$data['newqita'] = serialize($other);			
			if(M("qycard_conf")->where(array('user_id'=>$data['user_id']))->find()){
				if(M("qycard_conf")->where(array('user_id'=>$data['user_id']))->save($data)){
					 $this->success('设置成功'); 
				}else{
					$this->error('设置失败'); 
				}
			}else{
				if(M("qycard_conf")->add($data)){
					
				  $this->success('设置成功'); 
				}else{
				
				$this->error('设置失败'); 
					}
			   }			
		}else{
		    $info=M("qycard_conf")->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($info){
			   $geren = unserialize($info['geren']);
			   $geren_default = $geren['default'];
			   $geren_add = $geren['add'];				   
			   $shouji = unserialize($info['shouji']);  
			   $shouji_default = $shouji['default'];
			   $shouji_add = $shouji['add'];			   
			   $gongshi = unserialize($info['gongshi']); 
			   $gongshi_default = $gongshi['default'];
			   $gongshi_add = $gongshi['add'];			   
			   $newqita = unserialize($info['newqita']); 
			   $newqita_default = $newqita['default'];
			   $newqita_add = $newqita['add'];			   
			   $this->assign("geren_default",$geren_default);		
			   $this->assign("geren_add",json_encode($geren_add));	
			   $this->assign("shouji_default",$shouji_default);	
			   $this->assign("shouji_add",json_encode($shouji_add));	
			   $this->assign("gongshi_default",$gongshi_default);	
			   $this->assign("gongshi_add",json_encode($gongshi_add));	
			   $this->assign("newqita_default",$newqita_default);	
			   $this->assign("newqita_add",json_encode($newqita_add));	   
		       $this->display('config');			   
			}else{
		       $this->display('unconfig');			
			}

		}
	}

	/**
	*名片设置
	**/
	public function conf(){ 
        $this->check();	
		if(IS_POST){
			$data = array();
			$personal = array();
			$contact = array();
			$company = array();
			$other = array();
			$data['user_id']=$_SESSION['user_id'];
            //个人默认部分
            $personal['default']['chinaname'] = $_POST['chinaname'];
            $personal['default']['englishname'] = $_POST['englishname'];			
            //新增部分
			$i = 0;
            if($_POST['personal']){
				foreach($_POST['personal'] as $k=>$v){
				    if(!empty($v['name'])){
						if($v['status'] == 'on'){
							$personal['add'][$i]['status'] = 1;
						}
						$personal['add'][$i]['name'] = $v['name'];	
						$i++;
					}

				}			
			}						
			$data['geren'] = serialize($personal);

            //默认部分
            $contact['default']['mobile'] = $_POST['mobile'];
            $contact['default']['telephone'] = $_POST['telephone'];	
            $contact['default']['mail'] = $_POST['mail'];
            $contact['default']['weixin'] = $_POST['weixin'];				
            //新增部分
			$j = 0;
            if($_POST['contact']){
				foreach($_POST['contact'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$contact['add'][$j]['status'] = 1;
						}
						$contact['add'][$j]['name'] = $v['name'];	
						$j++;
                    }						
				}			
			}			
			$data['shouji'] = serialize($contact);

            //默认部分
            $company['default']['companyname'] = $_POST['companyname'];
            $company['default']['companyaddress'] = $_POST['companyaddress'];			
            //新增部分	
			$m = 0;
            if($_POST['company']){
				foreach($_POST['company'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$company['add'][$m]['status'] = 1;
						}
						$company['add'][$m]['name'] = $v['name'];	
						$m++;
                    }						
				}			
			}		
			$data['gongshi'] = serialize($company);

            //默认部分
			
            //新增部分	
			$n = 0;
            if($_POST['other']){
				foreach($_POST['other'] as $k=>$v){
				    if(!empty($v['name'])){				
						if($v['status'] == 'on'){
							$other['add'][$n]['status'] = 1;
						}
						$other['add'][$n]['name'] = $v['name'];	
						$n++;
                    }						
				}			
			}				
			$data['newqita'] = serialize($other);			
			if(M("qycard_conf")->where(array('user_id'=>$data['user_id']))->find()){
				if(M("qycard_conf")->where(array('user_id'=>$data['user_id']))->save($data)){
					 $this->success('设置成功'); 
				}else{
					$this->error('设置失败'); 
				}
			}else{
				if(M("qycard_conf")->add($data)){
					
				  $this->success('设置成功'); 
				}else{
				
				$this->error('设置失败'); 
					}
			   }			
		}else{
		    $info=M("qycard_conf")->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($info){
			   $geren = unserialize($info['geren']);
			   $geren_default = $geren['default'];
			   $geren_add = $geren['add'];			   
			   $shouji = unserialize($info['shouji']);  
			   $shouji_default = $shouji['default'];
			   $shouji_add = $shouji['add'];			   
			   $gongshi = unserialize($info['gongshi']); 
			   $gongshi_default = $gongshi['default'];
			   $gongshi_add = $gongshi['add'];			   
			   $newqita = unserialize($info['newqita']); 
			   $newqita_default = $newqita['default'];
			   $newqita_add = $newqita['add'];			   
			   $this->assign("geren_default",$geren_default);		
			   $this->assign("geren_add",json_encode($geren_add));	
			   $this->assign("shouji_default",$shouji_default);	
			   $this->assign("shouji_add",json_encode($shouji_add));	
			   $this->assign("gongshi_default",$gongshi_default);	
			   $this->assign("gongshi_add",json_encode($gongshi_add));	
			   $this->assign("newqita_default",$newqita_default);	
			   $this->assign("newqita_add",json_encode($newqita_add));	   
		       $this->display('config');			   
			}else{
		       $this->display('unconfig');			
			}

		}
	}
	
	/**
	*模板设置
	**/
	public function tpl_set(){
        $this->check();	
        if(IS_POST){
		    //print_r($_POST);exit;
		    if(M("qycard_conf")->where(array('user_id'=>$_SESSION['user_id']))->find()){
			//$data['muban']=$_POST['temp'];
			$data['muban']=trim($_POST['card_id']);
			M("qycard_conf")->where(array('user_id'=>$_SESSION['user_id']))->save($data);
						  $this->success('模板设置成功'); 
			}else{
			
				$this->error('请先设置个人信息'); 
			
			}
		}else{
		    $mycc=M("qycard_conf")->where(array('user_id'=>$_SESSION['user_id']))->find();
		
			$this->assign("whos",$mycc['muban']);
			
		   $this->display();
		}
	}
	
	/**
	*名片管理
	**/
	public function cardManage(){
        $this->check();	
		if($_SESSION['username']==''){
			$this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		$map['user_id'] = $_SESSION['user_id'];
		if(IS_POST){
			//$username = trim($_POST['username']);
			if(strstr($_POST['username'],'(')){
				$username = substr($_POST['username'],0,strpos($_POST['username'],'('));				
			}else{
				$username=trim($_POST['username']);					
			} 				
			$map['userinfo'] = array('like','%'.$username.'%');
		}
		$count      = M('qyusercard')->where($map)->count();
		$Page       = new Page($count,15);
		$data = M('qyusercard')->order('id desc')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		$show       = $Page->show();	
		
		foreach($data as $k=>$v){
			$datas[$k]=$v;
			$datas[$k]['userinfo']=unserialize($v['userinfo']);
			$datas[$k]['connectinfo']=unserialize($v['connectinfo']);
			$datas[$k]['companyinfo']=unserialize($v['companyinfo']);
		}
		$this->assign('username',$username);
		$this->assign('data',$datas);
		$this->assign('page',$show);
		$this->display();
	}

	/**
	*名片修改
	**/
	public function edit(){ 
        $this->check();	
        if(IS_POST){		
		    $id = M('qyusercard')->where(array('id'=>$_POST['id']))->save($_POST);
			if($id){
			    $this->success('修改成功',U('Card/cardManage',array('mid'=>$_GET['mid'])));  			    
			}else{
			    $this->error('修改失败');			
			}
		}else{
			$id = $this->_get('id');
			$data = M('qyusercard')->where(array('id'=>$id))->find();
			$this->assign('data',$data);
			$this->display();		
		}
	}
	
	/**
	*名片删除
	**/
	public function del(){ 
        $this->check();
		if(IS_POST){
			$data = M('qyusercard')->where(array('id'=>$_POST['id']))->find();
			if(M('qyusercard')->where(array('id'=>$data['id']))->delete()){
				echo json_encode(array('status'=>1));
			}
			
		}	
	}	
	
	/**
	*名片详情
	**/
	public function cardInfo(){
        $this->check();
		$id = $this->_get('id');
		$data = M('qyusercard')->where(array('id'=>$id))->find();
		$data['userinfo']=unserialize($data['userinfo']);
		$data['connectinfo']=unserialize($data['connectinfo']);
		$data['companyinfo']=unserialize($data['companyinfo']);
		$data['otherinfo']=unserialize($data['otherinfo']);
		$this->assign('data',$data);
		$this->display();
	}
	
	
	public function tpl(){
        $this->check();	
	    $info = M('Qycard_conf')->where(array('user_id'=>$_SESSION['user_id']))->find();
		$data=M('Qycard_tpl')->select();
		$this->assign('data',$data);
		$this->assign('info',$info);		
		$this->display();
	}
	
	
	/*
	*名片手机端
	*	
	*/
	
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Card';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data);
			}
			$father=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>0))->find();
			$this->assign('father',$father);
			$listde=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$father['wxid']))->select();
			$this->assign('de',$listde);
			$map['depart']=array('like','%|0|%');
			$map['user_id']=$app['userid'];
			$users=M('Qyusercard')->where($map)->select();
			$this->assign('users',$users);
		//	dump($users);
			$this->display();
	}
	
	
	public function wap_list(){
	
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$father=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$_GET['id']))->find();
			$this->assign('father',$father);
			
			$listde=M('Department')->where(array('user_id'=>$app['userid'],'wxpid'=>$father['wxid']))->select();
			$this->assign('de',$listde);
			$map['depart']=array('like','%;'.$_GET['id'].';%');
			$map['user_id']=$app['userid'];
			$users=M('Qyusercard')->where($map)->select();
			foreach($users as $k=>$v){
				$userss[$k]=$v;
				$userss[$k]['info']=unserialize($v['userinfo']);
				// $userss[$k]['connectinfo']=unserialize($v['connectinfo']);
				// $userss[$k]['companyinfo']=unserialize($v['companyinfo']);
				// $userss[$k]['otherinfo']=unserialize($v['otherinfo']);
			}
			$this->assign('users',$userss);
			//dump($userss);
			
			$this->display();
	}
	
	
	
	//联系人
	public function wap_all(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		$map['user_id']=$app['userid'];
		$users=M('Qyusercard')->where($map)->select();
		foreach($users as $k=>$v){
			$user[$k]=$v;
			$user[$k]['user']=unserialize($v['userinfo']);
		}
		$this->assign('users',$user);
		$this->display();
	}
	
	//名片内容信息
	public function wap_card_info(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		$map['user_id']=$app['userid'];
		$map['id']=$_GET['id'];
		$userinfo=M('Qyusercard')->where($map)->find();
		$this->assign('userinfo',$userinfo);
		$this->display();
	}
	
	
	//我的名片夹
	public function wap_my_card(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Card';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_my_card');
			exit();
		}
		if(IS_POST){
			$cardname =  $_POST['cardname'];
			$where['name']=array('like','%'.$cardname.'%');
			$where['user_id'] = $app['userid'];
			$userslike = M('Qyusers')->where($where)->field('id,name')->select();
			if($userslike){
				foreach($userslike as $val){
				// print_r()
					if($val){
							$map['otherid'] = array('in',$val['id']);
					}
			
				}
				
			}else{
				// $this->ajaxReturn("");
				 $this->error('已经很努力查找了');		
			}
			
			// print_r($userslike);exit;
		}
		$map['user_id']=$app['userid'];
		$map['wecha_id']=$_GET['wecha_id'];
		$cardlist=M('Qycard_file')->where($map)->select();
		foreach($cardlist as $k=>$v){
			if($v && $v['otherid']){
				$token = M('Qytoken')->where(array('id'=>$v['user_id']))->field('qyname')->find();
				$list[$k]=$v;
				$user=M('Qyusers')->where(array('id'=>$v['otherid']))->order('name ASC')->find();
				$user['qyname'] =$token['qyname'];
				$pid = array_filter(explode(';',$user['pid']));
				if($pid){
					$where['wxid'] = array('in',$pid);
					$Department = M('Department')->where($where)->field('name')->select();
					$user['pid'] = $Department;
				}
				$list[$k]['user']=$user;
			}
		}

		$pinyin =	new PinyinAction();
		foreach($list as $key=>$val){
		
			$username= $val['user']['name'];
			$pinyinusername = $pinyin->pinyin($username,1);
			$fileusername =  strtoupper(substr($pinyinusername,0,1));
			$kkk[$fileusername][] = $val;

		}
		ksort($kkk);
		// print_r($kkk);exit;
		$this->assign('cardlist',$kkk);
		$this->display();
	}
	
	
	/***
	*我的名片
	***/
	public function wap_card_set(){
		//print_r($_POST);exit;
		if(IS_POST){
		    
			$app=M('qymyapp')->where(array('token'=>$_POST['token']))->field('userid')->find();
			$users=M('Qyusers')->where(array('userid'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			$data['user_id']=$app['userid'];
			$data['depart']=$users['pid'];
			$data['wecha_id']=$_POST['wecha_id'];
			$data['userinfo']=serialize($users);
			$data['connectinfo']=serialize($_POST['con']);
			$data['companyinfo']=serialize($_POST['com']);
			$data['otherinfo']=serialize($_POST['other']);
			$data['time']=time();
			$data['tpl']=trim($_POST['selectImg']);			
			$check=M('Qyusercard')->where(array('wecha_id'=>$_POST['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){
				// print_r($check);exit;
				if(M('Qyusercard')->where(array('id'=>$check['id']))->save($data)){
					$this->redirect(U('wap_card_set',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'])));
				}
			}else{
				// echo 1;
				if(M('Qyusercard')->add($data)){
					$this->redirect(U('wap_card_set',array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'])));
				}
			}
			
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$users=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			//dump($users);exit;
			$this->assign('user',$users);
			$check=M('Qyusercard')->where(array('wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
			if($check){
				$conf=$check;
				$conn=unserialize($conf['connectinfo']);
				$this->assign('conn',$conn);
				$companyinfo=unserialize($conf['companyinfo']);
				$this->assign('companyinfo',$companyinfo);
				$otherinfo=unserialize($conf['otherinfo']);
				$this->assign('otherinfo',$otherinfo);
				
			}
			$conf=M("qycard_conf")->where(array('user_id'=>$app['userid']))->find();
			$geren=$this->get_serialize(unserialize($conf['geren']));
			$this->assign('geren',$geren);
//dump($geren);exit;			
			$connect=$this->get_serialize(unserialize($conf['shouji']));
			$this->assign('connect',$connect);
			$comp=$this->get_serialize(unserialize($conf['gongshi']));
			$this->assign('comp',$comp);
			$other=$this->get_serialize(unserialize($conf['newqita']));
			$this->assign('other',$other);
			
			//dump($conf);exit;
			$this->display();
		}
	}
	
    public function wap_choose(){
	    $data = M('Qycard_tpl')->select();
		$this->assign('data',$data);		
		$this->display();		
	}	
	
	public function wap_card_my(){
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			if(!$_GET['wecha_id']){
				$data['token']=$_GET['token'];
				$data['module']='Card';
				$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
				$data['corpid']=$user['corpid'];
				$Oauth=A('Qyapp/Oauth');
				$Oauth->index($data,'wap_card_my',$_GET['pid']);
				die();
			}
			$record=M('Qyusercard')->where(array('id'=>$_GET['pid']))->find();
			$connect=unserialize($record['connectinfo']);
			foreach($connect as $k=>$v){
				$connects[$k]['name']=$k;
				$connects[$k]['value']=$v;
			}
			// print_r($_GET['pid']);exit;
			$this->assign('connect',$connects);
			$comp=unserialize($record['companyinfo']);
			foreach($comp as $ke=>$ve){
				$comps[$ke]['name']=$ke;
				$comps[$ke]['value']=$ve;
			}
			$this->assign('comp',$comps);
			//dump($comps);
			$other=unserialize($record['otherinfo']);
			foreach($other as $keq=>$veq){
				$others[$keq]['name']=$keq;
				$others[$keq]['value']=$veq;
			}
			$this->assign('other',$others);
			$userinfo=unserialize($record['userinfo']);
			$this->assign('user',$userinfo);
			// echo $record['tpl'];exit;
			$tpl = $record['tpl']?$record['tpl']:0;
			$content= $this->fetch('./Tpl/Qyapp/Card/card/card'.$tpl.'/index.html');
			$this->assign('content',$content);//获取名片模版
			
			$my=M('Qyusercard')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_GET['wecha_id']))->field('id')->find();
			$this->assign('my',$my);
			if($my['id']==$_GET['pid']){
				$this->assign('check',1);
			}
			 if(M('Qycard_file')->where(array('pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find()){
				$this->assign('haven',1);
			 }
			
			$this->display();
	}
	
	//加入我的名片
	public function opend(){
		if($_POST['wecha_id']){
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
			$user = M('Qyusers')->where(array('userid'=>$_POST['others'],'user_id'=>$app['userid']))->find();
			$data['wecha_id'] = $_POST['wecha_id'];
			$data['others'] = $_POST['others'];
			$data['pid'] = $_POST['pid'];
			$data['otherid'] = $user['id'];
			$data['time']=time();
			$data['user_id']=$app['userid'];
			//判断是否已经保存
			$where['wecha_id'] = $_POST['wecha_id'];
			$where['others'] = $_POST['others'];
			$where['pid'] = $_POST['pid'];
			$Qycard_file = M('Qycard_file')->where($where)->find();
			if($Qycard_file){
				echo json_encode(array('status'=>2));
				
			}else{
				if(M('Qycard_file')->add($data)){
					echo json_encode(array('status'=>1));			
				}else{
					echo json_encode(array('status'=>0));
				}
				
			}
			
		}
	}
	
	//回赠我的名片
	public function backTo(){
		if(IS_POST){
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('appid,userid')->find();
			$pid = M('Qyusercard')->where(array('user_id'=>$app['userid'],'wecha_id'=>$_POST['wecha_id']))->find();
			$inin['touser']=$_POST['others'];
			$Msg=A('Qyapp/Msg');
			$inin['title']="您好!".$_POST['wecha_id']."回赠了您一张名片";
			$inin['description']="请您点击查看";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Card&a=wap_card_my&userid='.$_POST['wecha_id'].'&token='.$_GET['token'].'&pid='.$pid['id'].'&wecha_id='.$_POST['others'];
			
			$inin["agentid"]=$app['appid'];
			//F('huiurl',$inin);
			$msg=$Msg->msg_send_all($inin,$app['userid']);
			if($msg['errcode']==0){
				echo json_encode(array('status'=>1));	
			}else{
				echo json_encode(array('status'=>0));	
			}
		}
	}
	
	function get_serialize($data){
		$arr=array();
		foreach($data['default'] as $k=>$v){
			if($v['status']=='on'){
				//$da[$k]=$v['name'];
				array_push($arr,$v['name']);
			}
		}
		
		foreach($data['add'] as $va){
			if($va['status']==1){
				//$da[$k]=$v['name'];
				array_push($arr,$va['name']);
			}
		}
		
		return $arr;
		
	}
	
	
	
	
}