<?php
/*
/*
*在线考试
* 
*/
class TestAction extends Action{
	
	public $logo;	
	public $copyright;
	function _initialize(){
			$HTTP_HOST = $_SERVER['HTTP_HOST'];
			$code = 'wy'.$HTTP_HOST.'qy';
			$md5code = md5(md5(md5(md5(md5($code)))));
			$code = F(md5('weiyi'));
			if($code==null || $code!=$md5code){
				//$this->error('你的程序未经授权，请与我们联系，电话：13308658831！谢谢！');
			}	
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
			$Model = new Model();
			$rt1=$Model->query("CREATE TABLE IF NOT EXISTS `tp_qytest_user_check` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `paperid` int(11) NOT NULL,
	  `questionid` int(11) NOT NULL,
	  `user_id` int(11) DEFAULT NULL,
	  `sum` tinyint(6) DEFAULT NULL,
	  `wecha_id` varchar(30) DEFAULT NULL,
	  `old_score` float(6,2) DEFAULT '0.00',
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
			$rt2=$Model->query("Describe  `tp_qytest_user` `is_result`;");
			if(empty($rt2)){
				$rt3=$Model->query("ALTER TABLE `tp_qytest_user` ADD COLUMN `is_result` varchar(255) DEFAULT NULL ;");
			}
			$rt4=$Model->query("Describe  `tp_qytest_question` `answerinfo`;");
			if(empty($rt4)){
				$rt5=$Model->query("ALTER TABLE `tp_qytest_question` ADD COLUMN `answerinfo` float(6,2) DEFAULT '0.00';");
			}
			$this->assign('copyright',$this->copyright);	
			$this->assign('logo',$this->logo);	            		
	}	
	
	private function check(){
		if($_SESSION['username']==''){
			   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}	
		
	public function lists(){
	    $this->check();
		$user_id=$_SESSION['user_id'];
		$count=M('Qytest_user')->where(array('user_id'=>$user_id))->count();
		$Page       = new Page($count,25);
		$show       = $Page->show();
		$list=M('Qytest_user')->where(array('user_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order('dotime desc')->select();
		foreach($list as $k=>$v){
			$temp = M('Qytest_paper')->where(array('id'=>$v['pid']))->field('title')->find();
			$list[$k]['title'] = $temp['title'];
			$temp1 = M('Qyusers')->where(array('userid'=>$v['wecha_id'],'user_id'=>$_SESSION['user_id']))->field('name')->find();
			$list[$k]['name'] = $temp1['name'];
		}
		//print_r($list);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}	

	//试卷管理
	
	public function index(){
	    $this->check();
		if(IS_POST){			
            $data['title'] = $_POST['title'];
            $data['is_tip'] = intval($_POST['is_tip']);			
			$data['type'] = empty($_POST['type']) ? 1 : $_POST['type'];			
            $data['condition'] = empty($_POST['condition']) ? 10 : intval($_POST['condition']);				
            $data['starttime'] = strtotime($_POST['starttime']);
			$data['endtime'] = strtotime($_POST['endtime']);
			$data['sum'] = empty($_POST['sum']) ? 0 : intval($_POST['sum']);			
			$data['time'] = time();	
            $data['status'] = 0;				
			$data['user_id'] = $_SESSION['user_id'];
			$ids=explode(',',$_POST['departid']);
			foreach($ids as $k=>$v){
				$wxid=M('Department')->where(array('id'=>$v))->field('wxid')->find();
				$wxarr[$k]=$wxid['wxid'];
			}
			$data['departid'] =implode("|",$wxarr);
			
			//子部门算法
			$getDepart=A('Qyapp/Department');
			$departs=$getDepart->wap_department($_POST['departid'].'|',$_SESSION['user_id']);
			$data['alldepart']=$departs;			
			if(M('qytest_paper')->add($data)){
				$this->success('添加成功',U('Test/index',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('添加失败');			    
			}							
		
		}else{
			$user_id=$_SESSION['user_id'];
			$count=M('Qytest_paper')->where(array('user_id'=>$user_id))->count();
			$Page       = new Page($count,25);
			$show       = $Page->show();
			$result=M('Qytest_paper')->where(array('user_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
			foreach($result as $k=>$v){
			    $list[$k] = $v;
				$list[$k]['testtime'] = floor(($v['endtime'] - $v['starttime'])/60);
				$list[$k]['nums'] = M('qytest_paper_t')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$v['id']))->count();
			}
			$this->assign('list',$list);
			$this->assign('page',$show);
			$this->display();		
		
		}	

	}
	
	public function add_paper(){
	    $this->check();
		$user_id=$_SESSION['user_id'];
		$count=M('Qytest_user')->where(array('user_id'=>$user_id))->count();
		$Page       = new Page($count,25);
		$show       = $Page->show();
		$list=M('Qytest_user')->where(array('user_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order('dotime desc')->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}	
	
	/**
	*考试详情
	**/
	public function paperInfo(){
	    $this->check();
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('Qytest_paper')->where(array('id'=>$id,'user_id'=>$user_id))->find();
        $data['testtime'] = floor(($data['endtime'] - $data['starttime'])/60);		
		$this->assign('data',$data);
		$this->display();
	}	

	/**
	*考试详情
	**/
	public function detail(){
	    $this->check();
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('Qytest_paper_t')->where(array('id'=>$id,'user_id'=>$user_id))->find();
        $res=M('Qytest_config')->where(array('user_id'=>$user_id))->find();				
		$this->assign('data',$data);
		$this->display('detail_1');
	}	
	
	
	public function addQuestion(){
	    $this->check();
		$user_id=$_SESSION['user_id'];	
		if(IS_POST){	
			F('post1',$_POST);
            $pid = intval($_POST['pid']);			
            $ids = $_POST['ids'];
            $arr = explode(',',$ids);
			$num1 = count($arr)-1;
			unset($arr[$num1]);
			$res = M('qytest_paper_t')->where(array('pid'=>$pid))->select();
			$num = count($res);
            foreach($arr as $k => $v){
				$rest = M('qytest_question')->where(array('id'=>$v))->find();
				//F('rest',$rest);
				$info['user_id'] = $_SESSION['user_id'];
				$info['questionid'] = $v;	
				$info['type'] = $rest['type'];	
				$info['title'] = $rest['title'];
				$info['time'] = time();
				$info['answer'] = $rest['answer'];	
				$info['pid'] = $pid;
				$info['disorder'] = $num;					
				M('qytest_paper_t')->add($info);
				$num ++; 
			}			
		
			echo json_encode(array('status'=>1));
		}else{
		    $id = $_GET['id'];
			$count=M('Qytest_question')->where(array('user_id'=>$user_id))->count();
			$Page       = new Page($count,25);
			$show       = $Page->show();
			$list=M('Qytest_question')->where(array('user_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
			$this->assign('list',$list);
			$this->assign('page',$show);
			$this->assign('pid',$id);			
			$this->display();		
		
		}	

	}
	
	/**
	*查看试卷试题
	**/
	public function listQuestion(){
	    $this->check();
	    $user_id=$_SESSION['user_id'];
		if(IS_POST){
		    $paperid = $_POST['paperid'];
		    $titleid = $_POST['titleid'];
		    $field = $_POST['field'];
		    $val = $_POST['val'];			
			if(M('Qytest_paper_t')->where(array('user_id'=>$user_id,'pid'=>$paperid,'id'=>$titleid))->save(array($field=>$val))){
			    echo json_encode(array('status'=>1));  
			}else{
			    echo json_encode(array('status'=>0));			
			}
		}else{		
			$id = $_GET['id'];	
			$list=M('Qytest_paper_t')->where(array('user_id'=>$user_id,'pid'=>$id))->select();
			$this->assign('list',$list);		
			$this->assign('pid',$id);			
			$this->display();		
		}
	
	}
	
	/**
	*考试详情
	**/
	public function info(){
		
	    $this->check();
		$id = $_GET['id'];
		$user_id = $_SESSION['user_id'];
		//print_r($_GET['id']);print_r($_SESSION['user_id']);exit;
		$data=M('Qytest_question')->where(array('id'=>$id,'user_id'=>$user_id))->find();
        $res=M('Qytest_config')->where(array('user_id'=>$user_id))->find();
        //$data['type'] = $res['type'];
        $data['condition'] = $res['condition'];
        $data['is_tip'] = $res['is_tip'];
        $data['times'] = $res['times'];	
		if($data['type'] == 1){			
			$data['contentmsg'] = M('Qytest_option_1')->where(array('user_id'=>$user_id ,'t_id'=>$data['id']))->select();
		}elseif($data['type'] == 2){
			$data['contentmsg'] = M('Qytest_option_2')->where(array('user_id'=>$user_id ,'t_id'=>$data['id']))->select();
		}elseif($data['type'] == 3){  //多图对比
			$data['contentmsg'] = M('Qytest_option_3')->where(array('user_id'=>$user_id ,'t_id'=>$data['id']))->select();
		}elseif($data['type'] == 4){  //赞成反对
			$data['contentmsg'] = M('Qytest_option_4')->where(array('user_id'=>$user_id ,'t_id'=>$data['id']))->select();
		}
		$data01 = $data['contentmsg'];
		$this->assign('data01',$data01);		
		$this->assign('data',$data);
		$this->display();
	}
	public function infodel(){
		$this->check();
		$user_id = $_SESSION['user_id'];
		if($_POST['ids']){
			$temp = explode(',',$_POST['ids']);
			$num = count($temp) - 1;
			unset($temp[$num]);
			$jishu = 0;
			foreach($temp as $k=>$v){
				$info=M('qytest_question')->where(array('id'=>$v,'user_id'=>$user_id))->delete();
				$jishu++;
			}
			if($jishu == $num){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}
		else{
			$id = $this->_POST('id');
			$info=M('qytest_question')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
			if(!$info){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}
	}
	public function infouser(){
		$id = $_GET['id'];
		$info = M('Qytest_user')->where(array('id'=>$id))->find();
		$temp = M('qyusers')->where(array('user_id'=>$_SESSION['user_id'],'userid'=>$info['wecha_id']))->field('name')->find();//用户信息
		$temp1 = M('Qytest_paper')->where(array('id'=>$info['pid']))->find();//试卷信息
		$sumscore = '';
		$temp2=M('Qytest_paper_t')->where(array('user_id'=>$_SESSION['user_id'],'pid'=>$temp1['id']))->field('score')->select();//题目信息
		foreach($temp2 as $k=>$v){
			$info['sumscore'] += $v['score'];
		}
		$info['name'] = $temp['name'];
		$info['title'] = $temp1['title'];
		$info['count'] = count($temp2);
		$temp2 = explode(',',$info['is_result']);//答题信息
		$num = array_unique($temp2);
		$info['num'] = count($num) - 1;
		$this->assign('data',$info);
		$this->display();
	}
	public function delinfouser(){
	    $this->check();
		$user_id = $_SESSION['user_id'];
		if($_POST['ids']){
			$temp = explode(',',$_POST['ids']);
			$num = count($temp) - 1;
			unset($temp[$num]);
			$jishu = 0;
			foreach($temp as $k=>$v){
				$temp = M('Qytest_user')->where(array('id'=>$v))->find();
				$info=M('Qytest_user')->where(array('id'=>$v))->delete();
				M('Qytest_user_check')->where(array('user_id'=>$temp['user_id'],'paperid'=>$temp['pid'],'wecha_id'=>$temp['wecha_id']))->delete();
				$jishu++;
			}
			if($jishu == $num){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}
		else{
			$id = $this->_POST('id');
			$temp = M('Qytest_user')->where(array('id'=>$id,'user_id'=>$user_id))->find();
			$info = M('Qytest_user')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
			if(!$info){
				echo json_encode(array('status'=>0));
			}else{
				M('Qytest_user_check')->where(array('user_id'=>$temp['user_id'],'paperid'=>$temp['pid'],'wecha_id'=>$temp['wecha_id']))->delete();
				echo json_encode(array('status'=>1));
			}
		}
	}
	public function test_question(){
	    $this->check();
		$user_id=$_SESSION['user_id'];
		$count=M('qytest_question')->where(array('user_id'=>$user_id))->count();
		$Page       = new Page($count,25);
		$show       = $Page->show();
		$list=M('qytest_question')->where(array('user_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		//print_r($list);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}	
	
	/**
	*删除
	**/
	public function del(){
	    $this->check();
		$id = $this->_POST('id');
		$user_id = $_SESSION['user_id'];
		$info=M('Qytest_paper')->where(array('id'=>$id,'user_id'=>$user_id))->delete();	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
	}	
	
	/**
	*开始考试
	**/
	public function start(){
	    $this->check();
		$id = $this->_POST('id');
		$user_id = $_SESSION['user_id'];
		$info=M('qytest_paper')->where(array('id'=>$id,'user_id'=>$user_id))->save(array('status'=>1));	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
				
			$data = M('qytest_paper')->where(array('id'=>$_POST['id']))->find();
			$app=M('qymyapp')->where(array('userid'=>$_SESSION['user_id'],'module'=>'Test'))->field('appid,token')->find();
			$Msg=A('Qyapp/Msg');
			$inin['title']="有一个考试需要您的参与,现在就去考试";
			$inin['description']='考试名称:'.$data['title'].'考试时间:'.$data['time'];
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Test&a=wap_index&token='.$app['token'].'&pid='.$data['id'];
			$inin["agentid"]=$app['appid'];
			$inin['toparty']=$data['departid'];
			//F('app',$app);
			$info = $Msg->msg_send_depart($inin,$data['user_id']);
			if($info['errcode']==0){
				echo json_encode(array('status'=>1));//添加成功
			}else{
				echo json_encode(array('status'=>0));//群发失败
			}		
            
		}
	}	
	
	/**
	*结束考试
	**/
	public function close(){
	    $this->check();
		$id = $this->_POST('id');
		$user_id = $_SESSION['user_id'];
		$info=M('qytest_paper')->where(array('id'=>$id,'user_id'=>$user_id))->save(array('status'=>0));	
		if(!$info){
			echo json_encode(array('status'=>0));
	
		}else{
			echo json_encode(array('status'=>1));
		}
	}		

	/**
	*添加问题
	**/	
	public function add(){
	    $this->check();
		if(IS_POST){
			//print_r($_POST);exit;
			$_POST['type'] = trim($_POST['type']);  //
			$_POST['user_id'] = $_SESSION['user_id'];	
			$_POST['answerinfo'] = $_POST['answerinfo'];
            if($_POST['type'] == 1 || $_POST['type'] == 2){    //单选题或多选题
				$_POST['time'] = time();  //创建时间
				$_POST['title'] = $_POST['title'];  //
				$_POST['answer'] = $_POST['answer'];  //	
				if($resultId= M('Qytest_question')->add($_POST)){
					if(is_array($_POST['content']) && $_POST['content'] != ''){
						$result = array();
						foreach($_POST['content'] as $k=>$v){
							$result['user_id'] = $_SESSION['user_id'];
							$result['t_id'] = $resultId;  //该选项在Qytest_question表中对应的id
							$result['option_number'] = $k;  //该选项编号
							$result['disorder'] = $v['disorder'];  //该选项序号						
							$result['option_title'] = $v['option'];  //该选项名称	
							M('qytest_option_'.$_POST['type'])->add($result);                            							
						}					
					}
					
					$this->success('添加成功',U('Test/test_question',array('mid'=>$_GET['mid'])));
					exit;
				}else{
				    $this->error('添加失败');	
					exit;
				}				
			}elseif($_POST['type'] == 3){  //判断题
				$_POST['time'] = time();  //创建时间
				$_POST['title'] = $_POST['title'];  //
				$_POST['answer'] = $_POST['answer'];  //	
				$_POST['imgurl'] = $_POST['imgurl'];  //				
				if($resultId= M('Qytest_question')->add($_POST)){
					
					$this->success('添加成功',U('Test/test_question',array('mid'=>$_GET['mid'])));	
						exit;
				}else{
				    $this->error('添加失败');	
						exit;
				}				
			}elseif($_POST['type'] == 4){  //图文题
				$_POST['time'] = time();  //创建时间
				$_POST['title'] = $_POST['title'];  //
				$_POST['answer'] = $_POST['answer'];  //	
				//$_POST['imgurl'] = $_POST['imgurls'];  //				
				if($resultId= M('Qytest_question')->add($_POST)){
				
					if($_POST['GoodsImages']){
						$imgdata = array();
						foreach($_POST['GoodsImages'] as $k=>$v){
							$imgdata['user_id'] = $_SESSION['user_id'];
							$imgdata['t_id'] = $resultId;  //该选项在qyvote表中对应的id					
							$imgdata['option_number'] = $k+1;	
							//$imgdata['option_title'] = $v['title'];							
							$imgdata['option_imgurl'] = $v['imgurl'];
							$imgdata['option_info'] = $_POST['information'][$k]['info'];	
							//$result['vote_total'] = 0;	 //投票总人数	
							M('qytest_option_4')->add($imgdata); 						
						}
					    $this->success('添加成功',U('Test/test_question',array('mid'=>$_GET['mid'])));	
						exit;
				    }	
					$this->success('添加成功',U('Test/test_question',array('mid'=>$_GET['mid'])));	
					exit;
				}else{
				    $this->error('添加失败');	
					exit;					
				}				
			}			
		
			
		}else{
			$type = $this->_GET('type');
			$this->assign('type',$type);			
			if($type == 1){
				$this->display('type_1');
			}elseif($type == 2){
				$this->display('type_2');
			}elseif($type == 3){
				$this->display('type_3');
			}elseif($type == 4){
				$this->display('type_4');
			}else{
				$this->display('type_1');		
			}	
		
		}
	}
	
	public function wap_index(){	
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Test';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
		} 	 
		$map['user_id'] = $app['userid'];
		$list=M('Qytest_paper')->where($map)->order('id desc')->select();
		foreach($list as $k=>$v){
		    $data[$k] = $V;
			$data[$k]['duration'] = $v['endtime']-$v['starttime'];
			$res = M('qytest_user')->where(array('wecha_id'=>$app['userid'],'pid'=>$v['id'],'wecha_id'=>$_GET['wecha_id']))->find();
			if($res){
				$list[$k]['re'] = '1';
			}else{
				$list[$k]['re'] = '2';
			}
		}
		if(!$_GET['tip']){
			$_GET['tip'] = 1;
		}
		if($_GET['tip']){
			$arr = array();
			foreach($list as $k=>$v){
				if($_GET['tip'] == $v['re']){
					$arr[] = $v;
				}
			}
		}
		
		//dump($list);exit;
		$this->assign('list',$arr);
		$this->display();		
	}
	

	public function wap_lists(){
		if(S('app'.$_GET['token'])){
			$app=S('app'.$_GET['token']);
		}else{
			$app=M('qymyapp')->where(array('token'=>$_GET['token']))->find();
			S('app'.$_GET['token'],$app);
		}
 		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Test';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data);
		} 		
        if(IS_POST){
		    
		}else{
			$disorder = $_GET['disorder'];
			if($_GET['type'] == 1){  //上一题
			    $disorder = $disorder-1;
			}elseif($_GET['type'] == 2){  //下一题
			    $disorder = $disorder+1;			
			}else{  //第一题
			    $disorder = 0;			
			}
		    $paper=M('qytest_paper')->where(array('user_id'=>$app['userid'],'id'=>$_GET['tip']))->find();  //试卷		
			$list=M('qytest_paper_t')->where(array('user_id'=>$app['userid'],'pid'=>$paper['id'],'disorder'=>$disorder))->find();
			$temp = M('qytest_question')->where(array('user_id'=>$app['userid'],'id'=>$list['questionid']))->find();
			$num = M('qytest_paper_t')->where(array('user_id'=>$app['userid'],'pid'=>$paper['id']))->count();//题目数
			$this->assign('num',$num -1);
			$num1 = M('qytest_user')->where(array('user_id'=>$app['userid'],'pid'=>$paper['id']))->count();//参与数
			$this->assign('num1',$num1);
			//print_r(array('user_id'=>$app['userid'],'id'=>$list['questionid']));
			//print_r($temp);
			//试卷标题列表
			$data = array();	
            $data['id'] = $list['id'];			
            $data['title'] = $list['title'];
            $data['time'] = $list['time'];
            $data['answer'] = $list['answer'];
            $data['type'] = $list['type'];
            $data['disorder'] = $list['disorder'];
            $data['questionid'] = $list['questionid'];			
            $data['score'] = $list['score'];
			if($data['type'] == 1){
				$data['content'] = M('Qytest_option_1')->where(array('user_id'=>$app['userid'],'t_id'=>$data['questionid']))->select();
			}elseif($data['type'] == 2){
				$data['content'] = M('Qytest_option_2')->where(array('user_id'=>$app['userid'],'t_id'=>$data['questionid']))->select();
				
			}elseif($data['type'] == 3){  //多图对比
				$data['content'] = M('Qytest_option_3')->where(array('user_id'=>$app['userid'],'t_id'=>$data['questionid']))->select();
				$data['imgurl'] = $temp['imgurl'];
			}elseif($data['type'] == 4){  //赞成反对
				$data['content'] = M('Qytest_option_4')->where(array('user_id'=>$app['userid'],'t_id'=>$data['questionid']))->select();
			}   
			if(!$data['disorder']){
				$data['disorder'] = $_GET['disorder'];
			}
			//print_r($data);
			//print_r($list);
			//print_r($paper);
			//exit;
			if($disorder == 0){
				$data['disorder'] = 0;
			}
			$list['disorder'] = $list['disorder']+1;
			$this->assign('list',$list);
		    $this->assign('paper',$paper);	
		    $this->assign('data',$data);			
		    $this->display();			
		}
	
	}
	
	public function wap_post(){
        if(IS_POST){	
        	//F('_POST',$_POST);
		    $token = $_POST['token'];
            $select = $_POST['select'];			
		    $wecha_id = $_POST['wecha_id'];	
		    $questionid = $_POST['questionid'];
		    $paperid = $_POST['paperid'];	
		    $app=M('qymyapp')->where(array('token'=>$token))->field('userid')->find();	
				
            //判断考试时间是否结束
            $paper = M('qytest_paper')->where(array('user_id'=>$app['userid'],'id'=>$paperid))->find();	//试卷
			if($paper['status'] == 0){
			    if($paper['endtime']<time()){
			    	echo json_encode(array('status'=>0,'tip'=>'答题时间结束'));
					exit;				
				}
			}
			
			//print_r($_POST);exit;
			$question = M('qytest_paper_t')->where(array('user_id'=>$app['userid'],'pid'=>$paperid,'questionid'=>$questionid))->find();
			//F('question',$question);
			$answerinfo = M('qytest_question')->where(array('user_id'=>$app['userid'],'id'=>$questionid))->find();
			//F('answerinfo',$answerinfo);
			$user = M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->find();
			$checkwhere = array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']);
			//F('checkwhere',$checkwhere);
			$check = M('qytest_user_check')->where($checkwhere)->find();
 			if($user){  //已经存在的
				if($check){
					if($paper['sum']>0){    //判断答题次数
						if($check['sum']>$paper['sum']){
							//echo json_encode(array('status'=>0,'tip'=>'答题次数超过'.$paper['sum'].'次'));
							//exit;
						}else{
							M('qytest_user_check')->where($checkwhere)->save(array('sum'=>$check['sum'] + 1));
						}
					}
				}else{
					$checkwhere['sum'] = 1;
					M('qytest_user_check')->add($checkwhere);
				}				
			}else{  //不存在则建立用户
			    $info['user_id'] = $app['userid'];
			    $info['starttime'] = time();	
			    $info['score'] = 0;	
			    $info['wecha_id'] = $wecha_id;	
			    $info['status'] = 1;	
			    $info['times'] = 0;	
			    $info['pid'] = $paperid;
                $id1 = M('Qytest_user')->add($info);
			}		
			//判断题目是否答对
			if($question['type'] == 1){
				$res = M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->find();
				$arr = explode(',',$res['is_result']);
				if(in_array($question['id'],$arr)){
					$old_score['score'] = $check['old_score'];
				} 
				$select = str_replace('option','',$select);
				$result = M('qytest_option_1')->where(array('user_id'=>$app['userid'],'t_id'=>$question['questionid'],'id'=>$select))->find();
				//F('result',$result);F('question',$question);
				if($result){
					if($result['disorder'] == $question['answer'] ){
						if($old_score['score']){
							//$data['score'] = $res['score'] + 0;//不加分
						}else{
							$data['score'] = $res['score'] + $question['score'];//加分
						}
						$data['times'] = $res['times'] + 1;//加回答次数
						$data['is_result'] = $res['is_result'].','.$question['id'];
						M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
						M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>$question['score']));
						echo json_encode(array('status'=>1,'tip'=>$answerinfo['answerinfo']));
						exit;					
					}else{
						if($old_score['score']){
							$data['score'] = $res['score'] - $old_score['score'];//减分
							$data['is_result'] = str_replace($question['id'],'',$res['is_result']);
						}
						$data['times'] = $res['times'] + 1;//加回答次数
						M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>0));
						M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
						echo json_encode(array('status'=>0,'tip'=>'回答错误'));
						exit;					
					}				
				}else{
					echo json_encode(array('status'=>0,'tip'=>'出错了'));
					exit;				
				}

			}elseif($question['type'] == 2){
				$res = M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->find();
				$arr1 = explode(',',$res['is_result']);
				if(in_array($question['id'],$arr1)){
					$old_score['score'] = $check['old_score'];
				}
				$answer = explode(',',$question['answer']);
				$num = count($answer);
				$sorce = number_format($question['score'] / $num ,1);
				$select = str_replace('option','',$select);
				$arr = explode(',',$select);
				if(is_array($arr)){
					foreach($arr as $k=>$v){
						$result3 = M('qytest_option_2')->where(array('user_id'=>$app['userid'],'t_id'=>$question['questionid'],'id'=>$v))->find();
						if(is_array($answer)){
							if(in_array($result3['disorder'],$answer)){
								if($data['score'] == ''){
									$data['score'] = $sorce;
									$jifen = 1;
								}else{
									$data['score'] = $data['score'] + $sorce;
									$jifen ++;
								}
							}else{
								$data['score'] = 0;
								break;
							}
						}else{
							if($result3['disorder']==$answer){
								$data['score'] = $question['score'];
							}else{
								$data['score'] = 0;
								break;
							}
						}
					}
				}
				F('score',$data['score']);F('question',$question);F('jifen',$jifen);F('num',$num);
				$datascore = $data['score'];
				$data['times'] = $res['times'] + 1;//加回答次数
				if($datascore == 0){
					if($old_score['score']){
						$data['score'] = $res['score'] - $old_score['score'];//减分
						$data['is_result'] = str_replace($question['id'],'',$res['is_result']);
					}
					$data['times'] = $res['times'] + 1;//加回答次数
					M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>0));
					M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
					echo json_encode(array('status'=>0,'tip'=>'回答错误'));
					exit;	
				}else{
					if($jifen == $num){
						$datascore = $question['score'];//全选中
					}
					if($old_score['score']){
						$data['score'] = $res['score'] - $old_score['score'] + $datascore;
					}else{
						$data['score'] = $res['score'] + $datascore;
					}
					$data['times'] = $res['times'] + 1;//加回答次数
					$data['is_result'] = $res['is_result'].','.$question['id'];
					M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
					M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>$datascore));
					echo json_encode(array('status'=>1,'tip'=>$answerinfo['answerinfo']));
					exit;
				}						
			}elseif($question['type'] == 3){
				$res = M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->find();
				if($select == '' || $select == 1){
					$select = '赞成';
				}else{
					$select = '反对';
				}
				$arr = explode(',',$res['is_result']);
				if(in_array($question['id'],$arr)){
					$old_score['score'] = $check['old_score'];
				}
				//F('check',$check);F('res',$res);F('question',$question);F('select',$select);
				if($select == $question['answer']){
					if($old_score['score']){
						//$data['score'] = $res['score'] + 0;//不加分
					}else{
						$data['score'] = $res['score'] + $question['score'];//加分
					}
					$data['times'] = $res['times'] + 1;//加回答次数
					$data['is_result'] = $data['is_result'].','.$question['id'];
					M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
					M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>$question['score']));
					echo json_encode(array('status'=>1,'tip'=>$answerinfo['answerinfo']));
					exit;					
				}else{
					if($old_score['score']){
						$data['score'] = $res['score'] - $old_score['score'];//减分
						$data['is_result'] = str_replace($question['id'],'',$res['is_result']);
					}
					$data['times'] = $res['times'] + 1;//加回答次数
					M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>0));
					M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
					echo json_encode(array('status'=>0,'tip'=>'回答错误'));
					exit;					
				}
			}elseif($question['type'] == 4){
			    $res = M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->find();
				$arr = explode(',',$res['is_result']);
				 if(in_array($question['id'],$arr)){
					$old_score['score'] = $check['old_score'];
				} 
				$select = str_replace('option','',$select);
				$result = M('qytest_option_4')->where(array('user_id'=>$app['userid'],'t_id'=>$question['questionid'],'id'=>$select))->find();
				//F('check',$check);F('result',$result);F('question',$question);F('paper',$paper);
				if($result){
					if($result['option_info'] == $question['answer']){
						if($old_score['score']){
							//$data['score'] = $res['score'] + 0;//不加分
						}else{
							$data['score'] = $res['score'] + $question['score'];//加分
						}
						$data['times'] = $res['times'] + 1;//加回答次数
						$data['is_result'] = $res['is_result'].','.$question['id'];
						M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
						M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>$question['score']));
						//确定回答问题
						echo json_encode(array('status'=>1,'tip'=>$answerinfo['answerinfo']));
						exit;					
					}else{
						if($old_score['score']){
							$data['score'] = $res['score'] - $old_score['score'];//减分
							$data['is_result'] = str_replace($question['id'],'',$res['is_result']);
						}
						$data['times'] = $res['times'] + 1;//加回答次数
						M('qytest_user_check')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'paperid'=>$paperid,'questionid'=>$question['id']))->save(array('old_score'=>0));
						M('qytest_user')->where(array('user_id'=>$app['userid'],'wecha_id'=>$wecha_id,'pid'=>$paperid))->save($data);
						echo json_encode(array('status'=>0,'tip'=>'回答错误'));
						exit;					
					}				
				}else{
					echo json_encode(array('status'=>0,'tip'=>'出错了'));
					exit;				
				}		    
			}		
            //echo json_encode(array('status'=>1,''=>));			
		}
	}	
	
	
}
?>