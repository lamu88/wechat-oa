<?php
class SceneAction extends Action{
	public $scene_db;
	public $token;
	public $info;
	public function _initialize() {

		$Model = new Model();
		$rt1=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywall_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(20) NOT NULL DEFAULT '',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `portrait` varchar(150) NOT NULL DEFAULT '',
  `nickname` varchar(60) NOT NULL DEFAULT '',
  `truename` varchar(40) NOT NULL,
  `phone` char(11) NOT NULL,
  `mp` varchar(11) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `wallid` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `act_id` int(11) NOT NULL,
  `act_type` enum('1','2','3') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`wallid`),
  KEY `wecha_id` (`wecha_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		$rt111=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qysign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(20) NOT NULL,
  `Sign` int(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt11=$Model->query("CREATE TABLE IF NOT EXISTS `tp_qywechat_scene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(30) NOT NULL,
  `title` char(50) NOT NULL,
  `pic` char(100) NOT NULL,
  `intro` varchar(250) NOT NULL,
  `shake_id` int(10) unsigned NOT NULL,
  `wall_id` int(10) unsigned NOT NULL,
  `vote_id` char(25) NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `open_vote` enum('0','1') NOT NULL,
  `open_zzle` enum('0','1') NOT NULL,
  `open_lottery` enum('0','1') NOT NULL,
  `token` char(20) NOT NULL,
  `logo` char(100) NOT NULL,
  `background` char(100) NOT NULL,
  `qrcode` char(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$rt11=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qyshake_rt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `token` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(12) NOT NULL DEFAULT '',
  `count` int(10) NOT NULL DEFAULT '0',
  `shakeid` int(10) NOT NULL DEFAULT '0',
  `round` mediumint(9) NOT NULL DEFAULT '0',
  `is_scene` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shakeid` (`shakeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt2=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywall_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `pname` char(40) NOT NULL,
  `pic` char(100) NOT NULL,
  `num` mediumint(9) NOT NULL,
  `token` char(20) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL,
  `sceneid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$rt3=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywall_supperzzle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sceneid` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `vid` int(10) unsigned NOT NULL,
  `addtime` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		$rt4=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywechat_scene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(30) NOT NULL,
  `title` char(50) NOT NULL,
  `pic` char(100) NOT NULL,
  `intro` varchar(250) NOT NULL,
  `shake_id` int(10) unsigned NOT NULL,
  `wall_id` int(10) unsigned NOT NULL,
  `vote_id` char(25) NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `open_vote` enum('0','1') NOT NULL,
  `open_zzle` enum('0','1') NOT NULL,
  `open_lottery` enum('0','1') NOT NULL,
  `token` char(20) NOT NULL,
  `logo` char(100) NOT NULL,
  `background` char(100) NOT NULL,
  `qrcode` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
		$rt5=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(20) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `logo` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `startbackground` varchar(100) NOT NULL DEFAULT '',
  `background` varchar(100) NOT NULL DEFAULT '',
  `endbackground` varchar(100) NOT NULL DEFAULT '',
  `isopen` tinyint(1) NOT NULL DEFAULT '1',
  `firstprizename` varchar(50) NOT NULL DEFAULT '',
  `firstprizepic` varchar(300) NOT NULL DEFAULT '',
  `firstprizecount` mediumint(5) NOT NULL DEFAULT '0',
  `secondprizename` varchar(50) NOT NULL DEFAULT '',
  `secondprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `secondprizepic` varchar(300) NOT NULL DEFAULT '',
  `thirdprizename` varchar(50) NOT NULL DEFAULT '',
  `thirdprizepic` varchar(100) NOT NULL DEFAULT '',
  `thirdprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `fourthprizename` varchar(50) NOT NULL DEFAULT '',
  `fourthprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `fourthprizepic` varchar(100) NOT NULL DEFAULT '',
  `fifthprizename` varchar(50) NOT NULL DEFAULT '',
  `fifthprizecount` mediumint(5) NOT NULL DEFAULT '0',
  `fifthprizepic` varchar(100) NOT NULL DEFAULT '',
  `sixthprizename` varchar(50) NOT NULL DEFAULT '',
  `sixthprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `sixthprizepic` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(60) NOT NULL DEFAULT '',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `ck_msg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt6=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywall_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `wallid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(20) NOT NULL DEFAULT '',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `content` varchar(500) NOT NULL DEFAULT '',
  `picture` varchar(150) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `check_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallid` (`wallid`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt7=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywewall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acttitle` varchar(40) NOT NULL COMMENT '活动标题',
  `isact` int(1) NOT NULL DEFAULT '0' COMMENT '活动开关',
  `ifcheck` int(1) NOT NULL DEFAULT '0' COMMENT '是否审核',
  `iflottery` int(1) NOT NULL DEFAULT '1',
  `showtime` int(11) NOT NULL COMMENT '前台页面刷新间隔',
  `background` varchar(300) DEFAULT NULL COMMENT '前台页面背景',
  `marklog` varchar(100) DEFAULT NULL COMMENT '成绩记录',
  `createtime` int(20) NOT NULL COMMENT '创建时间',
  `endtime` int(20) DEFAULT NULL COMMENT '结束时间',
  `token` varchar(40) NOT NULL,
  `bonu1` int(11) DEFAULT NULL COMMENT '一等奖数量',
  `bonu2` int(11) DEFAULT NULL COMMENT '二等奖数量',
  `bonu3` int(11) DEFAULT NULL COMMENT '三等奖数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$rt8=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qyshake` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `isact` int(1) NOT NULL DEFAULT '0',
  `acttitle` varchar(40) NOT NULL,
  `isopen` int(1) NOT NULL DEFAULT '0',
  `clienttime` int(11) NOT NULL DEFAULT '3',
  `showtime` int(10) NOT NULL DEFAULT '3',
  `shownum` int(11) NOT NULL DEFAULT '10',
  `pass` varchar(150) DEFAULT NULL,
  `joinnum` int(11) DEFAULT NULL,
  `shaketype` int(11) NOT NULL DEFAULT '1',
  `token` varchar(40) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `endtime` varchar(13) DEFAULT NULL,
  `pass2` varchar(150) DEFAULT NULL,
  `pass3` varchar(150) DEFAULT NULL,
  `starttime` int(11) NOT NULL,
  `endshake` int(11) NOT NULL,
  `qrcode` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt9=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qyvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `token` varchar(50) NOT NULL,
  `type` char(5) NOT NULL,
  `picurl` varchar(500) NOT NULL,
  `showpic` tinyint(4) NOT NULL,
  `info` varchar(500) NOT NULL,
  `statdate` char(11) NOT NULL,
  `enddate` char(11) NOT NULL,
  `display` tinyint(4) NOT NULL,
  `cknums` tinyint(3) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keyword` (`keyword`),
  FULLTEXT KEY `token` (`token`),
  FULLTEXT KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt10=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qyvote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL COMMENT 'vote_id',
  `item` varchar(50) NOT NULL,
  `vcount` int(11) NOT NULL,
  `startpicurl` varchar(200) NOT NULL DEFAULT '',
  `tourl` varchar(200) NOT NULL DEFAULT '',
  `rank` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;");
		$rt11=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qywewalllog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL,
  `content` varchar(200) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `token` varchar(30) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `sncode` varchar(20) DEFAULT NULL,
  `ifcheck` int(1) DEFAULT '0',
  `ifsent` int(1) DEFAULT '0',
  `ifscheck` int(1) NOT NULL DEFAULT '0',
  `PicUrl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$rt01=$Model->query("Describe  `tp_scene_qyshake` `user_id`;");
		if(empty($rt01)){
			$rt02=$Model->query("ALTER TABLE `tp_scene_qyshake` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt03=$Model->query("Describe  `tp_scene_qyshake_rt` `user_id`;");
		if(empty($rt03)){
			$rt04=$Model->query("ALTER TABLE `tp_scene_qyshake_rt` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt05=$Model->query("Describe  `tp_scene_qytoshake` `user_id`;");
		if(empty($rt05)){
			$rt06=$Model->query("ALTER TABLE `tp_scene_qytoshake` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt07=$Model->query("Describe  `tp_scene_qyvote` `user_id`;");
		if(empty($rt07)){
			$rt08=$Model->query("ALTER TABLE `tp_scene_qyvote` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt09=$Model->query("Describe  `tp_scene_qywall` `user_id`;");
		if(empty($rt09)){
			$rt010=$Model->query("ALTER TABLE `tp_scene_qywall` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt011=$Model->query("Describe  `tp_scene_qywall_message` `user_id`;");
		if(empty($rt011)){
			$rt012=$Model->query("ALTER TABLE `tp_scene_qywall_message` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt012=$Model->query("Describe  `tp_scene_qywall_supperzzle` `user_id`;");
		if(empty($rt012)){
			$rt013=$Model->query("ALTER TABLE `tp_scene_qywall_supperzzle` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt014=$Model->query("Describe  `tp_scene_qywechat_scene` `user_id`;");
		if(empty($rt014)){
			$rt015=$Model->query("ALTER TABLE `tp_scene_qywechat_scene` ADD COLUMN `user_id` int(11) NOT NULL;");
		}	
		$rt016=$Model->query("Describe  `tp_scene_qywewall` `user_id`;");
		if(empty($rt016)){
			$rt017=$Model->query("ALTER TABLE `tp_scene_qywewall` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt018=$Model->query("Describe  `tp_scene_qywewalllog` `user_id`;");
		if(empty($rt018)){
			$rt019=$Model->query("ALTER TABLE `tp_scene_qywewalllog` ADD COLUMN `user_id` int(11) NOT NULL;");
		}			
		$rt3=$Model->query("Describe  `tp_scene_qywall_prize` `user_id`;");
		if(empty($rt3)){
			$rt2=$Model->query("ALTER TABLE `tp_scene_qywall_prize` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt4=$Model->query("Describe  `tp_scene_qywall_member` `user_id`;");
		if(empty($rt4)){
			$rt3=$Model->query("ALTER TABLE `tp_scene_qywall_member` ADD COLUMN `user_id` int(11) NOT NULL;");
		}
		$rt5=$Model->query("Describe  `tp_scene_qywall` `ck_msg`;");
		if(empty($rt5)){
			$rt6=$Model->query("ALTER TABLE `tp_scene_qywall` ADD COLUMN `ck_msg` tinyint(1) NOT NULL DEFAULT '0';");
		}
		$rt7=$Model->query("Describe  `tp_scene_qywall_message` `check_time`;");
		if(empty($rt7)){
			$rt8=$Model->query("ALTER TABLE `tp_scene_qywall_message` ADD COLUMN `check_time` int(11) ;");
		}$rt9=$Model->query("Describe  `tp_scene_qywall_member` `truename`;");
		if(empty($rt9)){
			$rt10=$Model->query("ALTER TABLE `tp_scene_qywall_member` ADD COLUMN `truename` char(11) NOT NULL ;");
		}$rt11=$Model->query("Describe  `tp_scene_qywall_member` `phone`;");
		if(empty($rt11)){
			$rt12=$Model->query("ALTER TABLE `tp_scene_qywall_member` ADD COLUMN `phone` char(11) NOT NULL ;");
		}$rt13=$Model->query("Describe  `tp_scene_qywall_member` `act_id`;");
		if(empty($rt13)){
			$rt14=$Model->query("ALTER TABLE `tp_scene_qywall_member` ADD COLUMN `act_id` int(11) NOT NULL ;");
		}$rt15=$Model->query("Describe  `tp_scene_qywall_member` `act_type`;");
		if(empty($rt15)){
			$rt16=$Model->query("ALTER TABLE `tp_scene_qywall_member` ADD COLUMN `act_type` enum('1','2','3') NOT NULL ;");
		}
		$rt17=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qyshake_rt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `token` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(12) NOT NULL DEFAULT '',
  `count` int(10) NOT NULL DEFAULT '0',
  `shakeid` int(10) NOT NULL DEFAULT '0',
  `round` mediumint(9) NOT NULL DEFAULT '0',
  `is_scene` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `shakeid` (`shakeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		$rt18=$Model->query("CREATE TABLE IF NOT EXISTS `tp_scene_qytoshake` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `token` varchar(20) NOT NULL,
  `wecha_id` varchar(30) DEFAULT NULL,
  `point` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;");
		$action_wall  	= array('wall','wall_pic','ajaxWall','ajaxWallPic');
		$action_Shake  	= array("shake","startShake","getCount","shakeRun","show_shake","getConnectNum");
		
		if(in_array(ACTION_NAME,$action_wall)){
			$Fun = 'Wall';
		}else if(in_array(ACTION_NAME,$action_Shake)){
			$Fun  = 'Shake';
		}else{
			$Fun 	= 'Scene';
		}

		//$this->canUseFunction($Fun);

		$this->token 		= session('token');
		$this->scene_db 	= D('scene_qywechat_scene');

		$scene_info = M('scene_qywechat_scene')->where(array('user_id'=>$_SESSION['user_id'],'is_open'=>'1'))->find();	
		
		if($scene_info){
			$info 	= $scene_info;
			$this->assign('sceneid',$scene_info['id']);
			if(ACTION_NAME == 'wall' || ACTION_NAME == 'wall_pic'){
				$info 	= M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$scene_info['wall_id']))->find();	
			}else if(ACTION_NAME == 'shake'){
				$info 	= M('scene_qyshake')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$scene_info['shake_id']))->find();
				$info['cheer'] 	= json_encode(explode('|', $info['cheer']));
			}
			$info['open_vote'] 		= $scene_info['open_vote'];
			$info['open_lottery'] 	= $scene_info['open_lottery'];
			$info['open_zzle'] 		= $scene_info['open_zzle'];
			$info['wall_id'] 		= $scene_info['wall_id'];
			$info['shake_id'] 		= $scene_info['shake_id'];
			$info['title'] 			= $scene_info['title'];
			$info['logo'] 			= $scene_info['logo'];
			$info['keyword'] 		= $scene_info['keyword'];
			$info['qrcode'] 		= $scene_info['qrcode'];
			$info['background'] 	= $scene_info['background'];
		}else{
			if(ACTION_NAME == 'wall'  || ACTION_NAME == 'wall_pic'){
				$info 	= M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id']))->find();
				$info['open_wall'] = 1;
				$info['cheer'] 	= json_encode(explode(',', $info['cheer']));
			}else if(ACTION_NAME == 'shake'){
				$info 	= M('scene_qyshake')->where(array('user_id'=>$_SESSION['user_id']))->find();
				$info['cheer'] 	= json_encode(explode('|', $info['cheer']));
				$info['open_shake'] = 1;
			}
		}
		//print_r($info);exit;
		//$info['wxuser'] 	= M('wxuser')->where(array('token'=>$this->token))->getField('weixin');
		
		$this->info = $info;
		$this->assign('info',$info);
		
	}
	
	function response($data,$keywordArr)
	{		
		
		$db = M('scene_qywechat_scene');
		$where = array('keyword' => $data['Content']);
		$rs = $db->where($where)->find();
		return array(
			array(
				array(
					
					'Title'=>$rs['title'],
					'Description'=>strip_tags(htmlspecialchars_decode($rs['intro'])),
					'PicUrl'=>(empty($rs['pic'])?C('site_url'):$rs['pic']),
					'Url'=>C('site_url') . '/index.php?g=Apps&m=Scene&a=wap_index&token=' . $rs['token'] . '&wecha_id=' . $data['FromUserName'] . '&id='.$rs["id"],
				)
			),
			'news'
		);
	}
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		//dump($app);die();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Scene';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
			exit();
		}	
		$id = $_GET['id'];
		$where['token']=$_GET['token'];
		//$where['wecha_id']=$_GET['wecha_id'];
		$where['id'] = $id;
		$rs = M('qywechat_scene')->where($where)->find();
		/* 判断是否已参加 */
		$mwhere 	= array('token'=>$_GET['token'],'act_id'=>$id,'act_type'=>3,'user_id'=>$_SESSION['user_id']);
		$member 	= M('scene_qywall_member')->where($mwhere)->find();
		//print_r($member);exit;
		if (!$member){
			header('location:'.U('Scene/wap_member',array('token'=>$where['token'],'wecha_id'=>$where['wecha_id'],'id'=>$id,'act_type'=>3)));
			exit();
		}
		$this->assign('info',$rs);
		$this->display();
	}
	public function wap_member(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		//dump($app);die();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Scene';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_member');
			exit();
		}	
		$db = M('scene_qywall_member');
		$get = $_GET;
		$where = array('wecha_id' => $_GET['wecha_id'],'act_id' => $_GET['id'],'token'=>$_GET['token']);
		$check = $db->where($where)->find();
		if($check){
			$this->success('本次活动已存在您的信息',U('Scene/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'act_id'=>$_GET['id'],'act_type'=>3)));
		}else{
			if(IS_POST){
				$post = $_POST;
				$post['wecha_id'] = $_GET['wecha_id'];
				$data = array_merge($get, $post); 
				$data['act_id'] = $data['id'];
				$data['act_type'] = 3;
				unset($data['id']);
				$where = array('wecha_id' => $_GET['wecha_id'],'act_id' => $data['act_id']);
				$check = $db->where($where)->find();
				$rs = $db->data($data)->add();
				if($rs){
					$this->success('恭喜您参与本次活动',U('Scene/wap_index',array('token'=>$data['token'],'wecha_id'=>$data['wecha_id'],'act_id'=>$data['act_id'],'act_type'=>3)));
				}else{
					$this->error('网络延时，请稍后再试!!');
				}
			}
			
		}
		$this->display();
	}
	
	 public function wap_vote(){
		$act_id 	= $this->_get('act_id','intval');
		$act_type 	= $this->_get('act_type','intval');
		if($act_type != 3){
			echo '参数错误';
			exit();
		}
		$vid 		= M('scene_qywechat_scene')->where(array('token'=>$_GET['token'],'id'=>$act_id))->getField('vote_id');
		$open_vote 		= M('scene_qywechat_scene')->where(array('token'=>$_GET['token'],'id'=>$act_id))->getField('open_vote');
		//print_r($vid);exit;
		if(empty($vid)){
			echo '参数错误';
			exit();
		}


		$vote_id 	= explode(',',$vid);
		$info 		= array();

		$where 		= array('token'=>$_GET['token'],'id'=>array('in',$vote_id),'type'=>'scene');
		$vote_info 	= M('scene_vqyote')->where($where)->select();
		$sub 		= array();

		foreach($vote_info as $key=>$value){
			$info[$key]['id'] 		= $value['id'];
			$info[$key]['img'] 		= $value['picurl'];
			$info[$key]['name'] 	= $value['title'];
			$info[$key]['status'] 	= $value['status'];
		}
		$this->assign('open_vote', $open_vote);
		$this->assign('vid', $vid);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function	loadStatus(){
		$vote_id 	= explode(',', $this->_get('vote_id','trim'));
		$where 		= array('token'=>$_GET['token'],'id'=>array('in',$vote_id),'type'=>'scene');
		$status 	= M('Vote')->where($where)->field('id,status')->select();

		echo json_encode($status);
	}
	
	
        /*********微现场设置*/
	public function index(){
		//$keyword_db 	= M('keyword');
		$wall	= M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id'],'isopen'=>1))->select();
		$shake 	= M('scene_qyshake')->where(array('user_id'=>$_SESSION['user_id'],'isopen'=>1))->select();				
		$scene_info = $this->scene_db->where(array('user_id'=>$_SESSION['user_id']))->find();
				
		if(IS_POST){		
			if($this->scene_db->create($_POST)){				
				if($scene_info){//修改
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');
					$_POST['wall_id'] 	= ltrim($_POST['wall_id'],',');
					$id 	= $this->_post('id','intval');
					$this->scene_db->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->save($_POST);
					$this->success('修改成功',U('Scene/index',array('mid'=>$_GET['mid'])));
					
				}else{//添加
				//print_r($_POST);exit;
					//$_POST['token'] 	= $this->token;
					$_POST['user_id'] = $_SESSION['user_id'];
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');
					$_POST['wall_id'] 	= ltrim($_POST['wall_id'],',');
					$id = $this->scene_db->add($_POST);
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');

					$this->success('添加现场成功',U('Scene/index',array('mid'=>$_GET['mid'])));
				}

			}else{
			
					$this->error('设置失败');
			}

		}else{
			$vote 	= M('scene_qyvote')->where(array('user_id'=>$_SESSION['user_id'],'type'=>'scene','id'=>array('in',explode(',', $scene_info['vote_id']))))->select();

			$this->assign('vote',$vote);
			$this->assign('id',6);
			$this->assign('info',$scene_info);
			$this->assign('wall',$wall);
			$this->assign('shake',$shake);
			$this->display('set');
		}
	}

	public function set(){
		//$keyword_db 	= M('keyword');
		$wall	= M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id'],'isopen'=>1))->select();
		$shake 	= M('scene_qyshake')->where(array('user_id'=>$_SESSION['user_id'],'isopen'=>1))->select();
		
		$scene_info = $this->scene_db->where(array('token'=>$this->token,'id'=>$this->_get('id','intval')))->find();

		if(IS_POST){
			if($this->scene_db->create($_POST)){	
				if($scene_info){//修改
					$_POST['user_id']	= $_SESSION['user_id'];
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');
					$_POST['wall_id'] 	= ltrim($_POST['wall_id'],',');
					$id 	= $this->_post('id','intval');
					$this->scene_db->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->save($_POST);
					$this->success('修改成功',U('Scene/index',array('mid'=>$_GET['mid'])));
				}else{//添加
					
					$_POST['user_id'] 	= $_SESSION['user_id'];
					//$_POST['token'] 	= $this->token;
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');
					$_POST['wall_id'] 	= ltrim($_POST['wall_id'],',');
					$id = $this->scene_db->add($_POST);
					$_POST['vote_id'] 	= ltrim($_POST['vote_id'],',');

					$this->success('添加现场成功',U('Scene/index',array('mid'=>$_GET['mid'])));
				}

			}else{
					$this->error($this->scene_db->getError());
			}

		}else{
			$vote 	= M('scene_qyvote')->where(array('token'=>$this->token,'type'=>'scene','id'=>array('in',explode(',', $scene_info['vote_id']))))->select();

			$this->assign('vote',$vote);
			$this->assign('id',6);
			$this->assign('info',$scene_info);
			$this->assign('wall',$wall);
			$this->assign('shake',$shake);
			$this->display();
		}


	}


	public function del(){
		$id = $this->_get('id','intval');
		$where 	= array('token'=>$this->token,'id'=>$id);
		if($this->scene_db->where($where)->delete()){
			M('keyword')->where(array('pid'=>$id,'token'=>$this->token,'module'=>'Scene'))->delete();
			M('scene_qywall_member')->where(array('act_id'=>$id,'act_type'=>'3','token'=>$this->token))->delete();
			M('wall_supperzzle')->where(array('sceneid'=>$id,'token'=>$this->token))->delete();
			M('wall_prize')->where(array('sceneid'=>$id,'token'=>$this->token))->delete();
			M('wall_prize_record')->where(array('sceneid'=>$id))->delete();
			$this->success('删除成功',U('Scene/index',array('token'=>$this->token)));
		}
	}
	
	public function vote_add(){
		$where 	= array('token'=>$this->token,'type'=>'scene');
		$count 	= M('Vote')->where($where)->count();
		$Page   = new Page($count,5);
		$where['status'] = 1;
		$vote 	= M('Vote')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$Page->show());
		$this->assign('vote_list',$vote);
		$this->display();
	}
        /*********微信墙现场*/
	public function wall(){	
		/* $id = $_GET['id'];
		$where	 = array('token'=>$this->token,'uid'=>$id);
		$list = M('Wewalllog')->where($where)->select();
		foreach($list as $k=>$v){
			$rs = M('userinfo')->where(array('token'=>$this->token,'wecha_id'=>$v['openid']))->find();
			$list[$k]['username'] = $rs['wechaname'];
			$list[$k]['portrait'] = $rs['portrait'];
			$list[$k]['nickname'] = $rs['wechaname'];
			if($rs['wechaname'] == ''){
				$list[$k]['username'] = '路人';
			}
		}
		$this->assign('message',$list); */
		$this->display();
	}
	public function Department(){		
		if(IS_POST){			
			$_SESSION['depart'] = $_POST['flow_area'];
		}
		$this->display();
	}
	public function Scene_Sign_wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		//dump($app);die();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Scene';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'Scene_Sign_wap_index');
			exit();
		}		
		if(IS_GET){
			$this->ajaxReturn(1);
			$data['Sign'] = $_PO ST['Sign'];
			$data['wecha_id'] = $_GET['wecha_id'];
			$check = M('scene_qysign')->where(array('wecha_id'=>$_GET['wecha_id']))->find();
			if($check){
				$this->error('签到失败，您已签过到');
			}else{
				$sign = M('scene_qysign')->add($data);
			}			
			if($sign){
				$this->success('签到成功',U('Scene/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$id,'act_type'=>3)));
			}else{
				$this->error('签到失败');
			}	
		}
		$this->display();
	}
	function get_appmysql($userid=''){
		$appInfo=M('Qymyapp')->where(array('userid'=>$userid))->find();
		return $appInfo;
	}	
	public function Scene_Sign(){			
			$appInfo=$this->get_appmysql($_SESSION['user_id'],$_GET['id']);
			$user_id = $_SESSION['user_id'];
			/* 			
			$data1 = M('Qyattendance')->order('id desc')->where(array('user_id'=>$_SESSION['user_id']))->field('depart')->select();
			foreach($data1  as $k=>$v){
				$datas[$k]=$v;				
				$v['depart']=str_replace('-','',$v['depart']);
				$depart=explode('|', $v['depart']);
				$department='';
				foreach($depart as $kee=>$vaa){
					$departmen=M('Department')->where(array('wxid'=>$vaa,'user_id'=>$_SESSION['user_id']))->field('name')->find();
					$department.=$departmen['name'].'; ';
				}
				$datas[$k]['depart']=$department;
			} 
			*/			
			$result = array();
			$post = explode(';', $_SESSION['depart']);
			$this->assign('depart',$_SESSION['depart']);				
			$users = '';
			
			foreach($post as $k=>$v){
				if($v){					
					$result = M('department')->where(array('name'=>$v,'user_id'=>$user_id))->field('wxid')->find();					
					$ids = M('Qyusers')->where(array('user_id'=>$user_id,'pid'=>array('like','%'.$result['wxid'].';%')))->field('id,name,pic,userid')->select();						
					
					foreach($ids as $key=>$val){
						$arr[] = $val['userid'];
					} 
									
					//array_column($ids, 'id');					
					$temp = implode(',',$arr);					
					$users .= $temp.',';
					
				}
			}
			
			foreach($arr as $key=>$val){
				$sign = M('scene_qysign')->where(array('wecha_id'=>$val))->find();
				$arr1[]  = $sign;
				
			}
			
			$arr = trim($users,',');			
			$where['user_id'] = $_SESSION['user_id'];
			$where['uid'] = array('in',$arr);	
									
			$count      = M('Qyattendance_record')->where($where)->count();
			$Page       = new Page($count,20);
			$res = M('Qyattendance_record')->order('id desc')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			$show       = $Page->show();			
			$data = array();
			
			foreach($res as $k=>$v){
			    $data[$k] = $v;
				$users = M('qyusers')->where(array('userid'=>$v['name'],'user_id'=>$user_id))->field('id,name,pid,pic')->find();				
				//$arr = M('qyusers')->where(array('userid'=>$v['name'],'user_id'=>$user_id))->field('id,name')->find();
				$data[$k]['name'] = $users['name'];
				$data[$k]['pic'] = $users['pic'];
				$arr = explode(';',$users['pid']);
				if($arr){
				    $str = '';
				    foreach($arr as $key=>$val){
					    if($val){
						    $dept = M('department')->where(array('wxid'=>$val,'user_id'=>$user_id))->field('id,name')->find();
							$str .= $dept['name'].';';
						}
					}
				}
				
				$data[$k]['departmnet'] = $str;
			}
			
			//二维码图片
			//引入phpqrcode库文件
			include('phpqrcode.php'); 
			// 二维码数据 
			$data2 = C('outh_host').'/index.php?g=Qyapp&m=Scene&a=Scene_Sign_wap_index&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&id='.$thisForm['id'];
			// 生成的文件名 			
			$filename = $this->createNonceStr();; 
			// 纠错级别：L、M、Q、H 
			$errorCorrectionLevel = 'L'; 
			// 点的大小：1到10 
			$matrixPointSize = 4;  
			//创建一个二维码文件 
			$code = new QRcode();
			$imgSrc = $code->png($data2, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
			//输入二维码到浏览器
			//$imgSrc = $code->png($data); 
			//$imgSrc=generateQRfromGoogle(C('site_url').'/index.php?g=Apps&m=Selfform&a=wap_submitInfo&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$thisForm['id']);
			
			$this->assign('sign',$arr1);
			$this->assign('imgSrc',$filename);	
			$this->assign('data',$ids);
			$this->assign('page',$show);		
			$this->display();
	}
	
	public function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
		  $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	
	public function ajaxwall(){
		$rs = M('scene_qywewall')->where(array('isact'=>1))->find();
		if(!$rs){
			$result = array('err'=>1);
			echo json_encode($result);
		}
		$where	 = array('uid'=>1);
		$list = M('scene_qywewalllog')->where($where)->order('id desc')->limit('0','5')->select();
		foreach($list as $k=>$v){
			$rs = M('userinfo')->where(array('token'=>$this->token,'wecha_id'=>$v['openid']))->find();
			$list[$k]['username'] = $rs['wechaname'];
			$list[$k]['portrait'] = $rs['portrait'];
			$list[$k]['nickname'] = $rs['wechaname'];
			if($rs['wechaname'] == ''){
				$list[$k]['username'] = '路人';
			}
		} 
		//F('result',$result);
		$result = array('err'=>0,'res'=>$list);
		echo json_encode($result);
	}

	public function wall_pic(){
		$sceneid = $this->_get('sceneid','intval');
		$where	= array('token'=>$this->token,'wallid'=>$this->info['id']);
		$message= $this->_getWallList($where,'check_time desc,time desc',5,$sceneid,'pic');
		
		$this->assign('sceneid',$sceneid);
		$this->assign('message',$message);
		$this->display();
	}
	public function check_msg(){
		if(!$_GET['uid']){
			$list = M('scene_qywewalllog')->where(array('token'=>$this->token))->select();
			foreach($list as $k=>$v){
				$rs = M('userinfo')->where(array('token'=>$this->token,'wecha_id'=>$v['openid']))->find();
				$list[$k]['username'] = $rs['wechaname'];
				if($rs['wechaname'] == ''){
					$list[$k]['username'] = '路人';
				}
			}
		}else{
			$user = M('scene_qywall_member')->where(array('id'=>$_GET['uid']))->find();
			$openid = $user['wecha_id'];
			$list = M('scene_wewalllog')->where(array('token'=>$this->token,'openid'=>$openid))->select();
			foreach($list as $k=>$v){
				$rs = M('userinfo')->where(array('token'=>$this->token,'wecha_id'=>$v['openid']))->find();
				$list[$k]['username'] = $rs['wechaname'];
				if($rs['wechaname'] == ''){
					$list[$k]['username'] = '路人';
				}
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
	public function del_msg(){
		$id = $_GET['id'];
		$rs = M('scene_wewalllog')->where(array('id'=>$id))->delete();
		if($rs){
			$this->success('删除成功！');
		}else{
			$this->error('网络延迟，请稍后再试！');
		}
	}

	

        /*********摇一摇现场*/
	public function Shake(){
	
		$id 		= $this->_get('id','intval');
		$sceneid 	= $this->_post('sceneid','intval');
		
		if($sceneid){
			$is_scene = '1';
		}else{
			$is_scene = '0';
		}
		$shakeid = M('qywechat_scene')->where(array('id'=>$_POST['act_id']))->find();
		
		$round = M('scene_qyshake_rt')->where(array('user_id'=>$_SESSION['user_id'],'shakeid'=>$id,'is_scene'=>$is_scene))->max('round');
		//dump($round);die;
		$this->assign('round',$round+1);
		$this->display();
	}
	public function wap_shake(){
		$data=array();
		$rs1 = M('scene_wall_member')->where($_GET)->find();
		//print_r($rs1);exit;
		$data['phone'] 		= $rs1['phone'];
		$data['token'] 		= $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$ifact=M('scene_shake')->where(array('token'=>$data['token'],'isopen'=>array('neq',2)))->find();
		
		if($ifact==false){echo '<script>alert ("商家目前没有进行中的摇一摇活动")</script>'; return;}
		$exst=M('Toshake')->where(array('wecha_id'=>$data['wecha_id']))->select();
		if($exst==false){M('Toshake')->add($data);}
		$data['act_id'] = $_GET['act_id'];
		$this->assign('info',$data);
		$this->assign('ctime',$ifact['clienttime']);
		$this->assign('music',$ifact['pass3']);
		$this->display();	
	}
	public function shakeadd(){
		$_data['wecha_id'] = $_POST['wecha_id'];
		$_data['token'] = $_POST['token'];
		$_data['phone'] = $_POST['phone'];
		$_data['is_scene'] = 1;
		$_data['round'] = 0;
		$shakeid = M('qywechat_scene')->where(array('id'=>$_POST['act_id']))->find();
		$_data['shakeid'] = $shakeid['shake_id'];
		M('scene_qyshake_rt')->add($_data);
	}
	public function repoint(){
		$shakeid = M('qywechat_scene')->where(array('id'=>$_POST['act_id']))->find();
		$exst=M('scene_qyshake')->where(array('id'=>$shakeid['shake_id']))->find();
		if($exst['isact'] == 0){echo '1'; return;}
		$rs = M('scene_qyshake_rt')->where($_POST)->order('id desc')->find();
		$_POST['id'] = $rs['id'];
		M('scene_qyshake_rt')->where($_POST)->order('id desc')->save(array('count'=>$_POST['point'],'is_scene'=>1));
	}
	public function startShake(){
		$result = M('scene_qyshake')->where(array('token'=>$this->token,'id'=>$this->_get('id','intval')))->save(array('isact'=>'1','endtime'=>time()));	

		if($result){
			$result = array('err'=>0);
		}else{
			$result = array('err'=>1,'info'=>'游戏意外中断，请重新开始');
			M('scene_qyshake')->where(array('token'=>$this->token,'id'=>$this->_get('id','intval')))->save(array('isact'=>'0','endtime'=>''));
		}	
		echo json_encode($result);
	}

	public function getConnectNum(){
		$sceneid 	= $this->_post('sceneid','intval');
		$id 		= $this->_post('id','intval');
		$where 		= array('token'=>$this->token);
		if($sceneid){
			$where['act_type'] 	= '3';
			$where['act_id'] 	= $sceneid;
		}else{
			$where['act_type'] 	= '2';
			$where['act_id'] 	= $id;
		}
		$count 		= M('scene_qywall_member')->where($where)->count();
		echo $count;
	}
	
	public function getCount(){
		$result	= M('Toshake')->where(array('token'=>$this->_get('token'),'shakeid'=>intval($this->_get('id','intval'))))->limit(0,80)->order('count desc')->select();
		$js 	= json_encode($result);
		echo $js;	
	}
	
	/*摇一摇数据*/
	public function shakeRun(){
		$id  		= $this->_get('id','intval');
		$sceneid 	= $this->_get('sceneid','intval');
		$shake_db 	= M('scene_qyshake');
		$rt_db 		= M('scene_qyshake_rt');
		$member_db 	= M('scene_qywall_member');
		if($sceneid){
			$is_scene = '1';
			$act_type = '3';
			$act_id   = $sceneid;
		}
		$shake_info = $shake_db->where(array('id'=>$id,'token'=>$this->token,'shaketype'=>1,'isopen'=>1))->find();
		$where['is_scene'] = $is_scene;
		$where['token'] = $this->token;
		$where['shakeid'] = $id;
		$where['round'] = 0;
		$where['count'] = array('egt',$shake_info['endshake']);
		$is_end 	= $rt_db->where($where)->find();
		F('s1',$is_end);
		$result 	= array();
		if($is_end || ($shake_info['endtime'] > time())){  //游戏是否结束
			$result['status'] 		= 1;
			$result['info']		= '游戏已经结束';
			$user 	= $rt_db->where(array('shakeid'=>$id,'token'=>$this->token,'round'=>0,'is_scene'=>$is_scene))->order('count desc')->limit(3)->select();	
			
			foreach ($user as $key => $value) {
				$uwhere= array('wecha_id'=>$value['wecha_id'],'act_id'=>$act_id,'act_type'=>$act_type);
				$u_info = $member_db->where($uwhere)->find();
				
				$user[$key]['name'] 		= $u_info['nickname'];
				$user[$key]['portrait'] 	= $u_info['portrait'];
			}
			$result['res'] 		= $user;
			$max_round = $rt_db ->where(array('token'=>$this->token,'shakeid'=>$id,'is_scene'=>$is_scene))->max('round');
			$rt_db ->where(array('token'=>$this->token,'shakeid'=>$id,'round'=>0,'is_scene'=>$is_scene))->save(array('round'=>$max_round+1));	
			M('scene_qyshake')->where(array('token'=>$this->token,'id'=>$id))->save(array('isact'=>'0'));
		}else{/*返回摇一摇时时数据*/
			$user = $rt_db->where(array('token'=>$this->token,'shakeid'=>$id,'round'=>0,'is_scene'=>$is_scene))->order('count desc')->limit($shake_info['shownum'])->select();	
			/*获取现场或者单独摇一摇的参与用户*/
			foreach ($user as $key => $value) {
				$uwhere= array('wecha_id'=>$value['wecha_id'],'act_id'=>$act_id,'act_type'=>$act_type);
				$u_info = $member_db->where($uwhere)->find();

				$user[$key]['nickname'] 	= $u_info['nickname'];
				$user[$key]['portrait'] 	= $u_info['portrait'];
				$user[$key]['mLeft'] 		= $this->percent($value['count'],$shake_info['endshake']);
			}
			$result['status'] 	= 0;
			$result['res'] 		= $user;
		}
		F('result',$result);
		echo json_encode($result);
	}

	public function show_shake(){
		$id 		= $this->_get('id','intval');
		$sceneid 	= $this->_get('sceneid','intval');
		$round 		= $this->_get('round','intval');
		//print_r($_GET);exit;
		if($_GET['uid']){
			$id  = $_GET['pid'];
			$user_openid = M('wall_member')->where(array('id'=>$_GET['uid']))->find();
			$this->assign('uid',$_GET['uid']);
			$this->assign('user_id',$user_openid['wecha_id']);
		}
		if($sceneid){
			$is_scene = '1';
		}else{
			$is_scene = '0';
		}
		$max 		= M('scene_qyshake_rt')->where(array('is_scene'=>$is_scene,'token'=>$this->token,'shakeid'=>$id,'round'=>array('neq',0)))->order('round desc,count desc')->group('round')->order('round asc')->getField('round',true);
		
		if(empty($round)){
			$round 	= $max[0];
		}	

		$data = M('scene_qyshake_rt')->where(array('is_scene'=>$is_scene,'token'=>$this->token,'shakeid'=>$id,'round'=>$round))->order('count desc')->select();
		foreach ($data as $key => $value) {
			$where = array('token'=>$this->token,'wecha_id'=>$value['wecha_id']);
			if($sceneid){
				$where['act_type'] = 3;
				$where['act_id'] = $sceneid;
			}else{
				$where['act_type'] = 2;
				$where['act_id'] = $id;
			}
			$data[$key]['name'] 	= M('Wall_member')->where($where)->getField('nickname');
			$data[$key]['head'] 	= M('Wall_member')->where($where)->getField('portrait');
		}
		
		$this->assign('id',$id);
		$this->assign('round',$round);
		$this->assign('max',$max);
		$this->assign('data',$data);
		$this->display();
	}


	/*现场粉丝*/
	public function show_fans(){
		$id 		= $this->_get('id','intval');
		$keyword 	= $this->_post('keyword','trim');
		$where 		= array('token'=>$this->token,'act_id'=>$id,'act_type'=>'3');
		
		if(!empty($keyword)){
			$where['nickname|truename']	= array('like','%'.$keyword.'%');
		}

		$count		= M('Wall_member')->where($where)->count();
		$Page 		= new Page($count,15);
		$list 		= M('Wall_member')->where($where)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$scene 	 	= M('qywechat_scene')->where(array('token'=>$this->token,'id'=>$id))->field('wall_id,shake_id,vote_id')->find();

		$this->assign('sceneid',$id);
		$this->assign('scene',$scene);
		$this->assign('page',$Page->show());
		$this->assign('list',$list);
		$this->display();

	}

	public function del_fens(){
		$id 		= $this->_get('id','intval');
		$sceneid 	= $this->_get('sceneid','intval');
		$where 		= array('token'=>$this->token,'id'=>$id,'act_type'=>'3');
		$wecha_id  	= M('qywall_member')->where($where)->getField('wecha_id');
		$scene_info = M('qywechat_scene')->where(array('token'=>$this->token,'sceneid'=>$sceneid))->find();
		if(M('scene_qywall_member')->where($where)->delete()){
			M('scene_qyshake_rt')->where(array('token'=>$this->token,'is_scene'=>'1','wecha_id'=>$wecha_id))->delete();

			M('scene_qywall_message')->where(array('token'=>$this->token,'is_scene'=>'1','wallid'=>$scene_info['wall_id'],'uid'=>$id))->delete();
			M('wall_prize_record')->where(array('token'=>$this->token,'sceneid'=>$sceneid,'uid'=>$id))->delete();

			$this->success('删除成功',U('Scene/show_fans',array('token'=>$this->token,'id'=>$sceneid)));
		}
	}

	//百分比计算
	function percent($p,$t,$offset=0){
		if($t==0){
			$val = 1;
		}else{
			$val = $p/$t;
		}
		$num = sprintf('%.2f%%',($val+$offset)*100);
		return $num;
	}	
       /*******抽奖现场*/
	public function Lottery(){
		$prize = M('scene_qywall_prize')->where(array('user_id'=>$_SESSION['user_id']))->order('sort desc,id asc')->select();

		$users = M('scene_qywall_member')->where(array('user_id'=>$_SESSION['user_id'],'act_type'=>'3','act_id'=>$this->_get('sceneid','intval')))->count();
		
		//print_r($prize);print_r($users);exit;
		$this->assign('users',$users);
		$this->assign('prize',$prize);

		$this->display();	
	}


	//奖品名额
	public function prize_data(){
		$pid 		= $this->_get('pid','intval');
		$id 		= $this->_get('id','intval');
		$where 		= array('token'=>$this->token,'id'=>$pid,'sceneid'=>$id);
		$num 		= M('Wall_prize')->where($where)->getField("num");	

		$p_num 		= M('Wall_prize_record')->where(array('sceneid'=>$id,'prize'=>$pid))->count();
		$prize_user = M('Wall_prize_record')->where(array('sceneid'=>$id,'prize'=>$pid))->order('time asc')->select();

		foreach($prize_user as $key=>$value){
			$user_info = M('Wall_member')->where(array('id'=>$value['uid'],'act_id'=>$id,'act_type'=>'3'))->find();

			$prize_user[$key]['nickname'] = $user_info['nickname'];
			$prize_user[$key]['portrait'] = $user_info['portrait'];
		}

		$data 		= array('prize_num'=>$num-$p_num,'prize_user'=>$prize_user);
		echo json_encode($data);
	}

	//摇奖
	public function get_lottery(){
		$pid  	= $this->_get('pid','intval');
		$id 	= $this->_get('id','intval');
		$info 	= M('Wall_member')->where(array('token'=>$this->token,'act_id'=>$id,'act_type'=>'3'))->order('time desc')->limit(50)->select();

		$result = array();	

		$prize_num 	= M('wall_prize')->where(array('id'=>$pid,'token'=>$this->token,'sceneid'=>$id))->getField('num');
		$prize_user = M('wall_prize_record')->where(array('sceneid'=>$id,'prize'=>$pid))->count();

		if($prize_num <= $prize_user){
			$result['err'] 	= 2;
			$result['info'] = '该奖项名额已经用完';
			
			echo json_encode($result);
			exit;
		}
		if($info){
			$result['err'] 	= 0;
			$result['res'] = $info;
		}else{
			$result['err'] 	= 1;
			$result['info'] = '还没人有参加！';
		}
		echo json_encode($result);
	}
        //确认中奖
	public function lottery_ok(){
		$member_db 	= M('Wall_member');
		$record_db	= M('wall_prize_record');
		$prize_db 	= M('wall_prize');

		$pid  	= $this->_get('pid','intval');
		$id 	= $this->_get('id','intval');
		
		$arr 	= $member_db->where(array('act_id'=>$id,'act_type'=>'3'))->getField('id',true);
		$key 	= array_rand($arr);
		$info 	= $member_db->where(array('act_id'=>$id,'act_type'=>'3','id'=>$arr[$key]))->select();
		//print_r($info);exit;
		if($info){
			$data['uid'] 	= $arr[$key]; 
			$data['sceneid'] = $id;
			$data['prize'] 	= $pid;
			$data['time'] 	= time();

			$record_db->add($data);
			echo json_encode($info);
		}
	}
        /*实时更新人数*/
	public function loadUser(){
		$sceneid = $this->_get('id','intval');
		$where = array('act_id'=>$sceneid,'act_type'=>3);
		$count = M('Wall_member')->where($where)->count();
		echo json_encode(array('err'=>0,'count'=>$count));
	}
        /*显示奖品信息*/
	public function show_prize(){
		$sceneid 	= $this->_get('id','intval');
		$prize_info = M('wall_prize')->where(array('token'=>$this->token,'sceneid'=>$sceneid))->order('sort desc,id desc')->select();

		$this->assign('prize_info',$prize_info);
		$this->display();
	}
        /*显示中奖记录*/
	public function show_plog(){
		$sceneid 	= $this->_get('id','intval');
		$pid 		= $this->_get('pid','intval');
		$prize_info = M('Wall_prize')->where(array('token'=>$this->token,'sceneid'=>$sceneid))->order('sort desc,id desc')->select();
		
		if(empty($pid)){
			$pid 	= $prize_info[0]['id'];
		}

		$user = M('Wall_prize_record')->where(array('sceneid'=>$sceneid,'prize'=>$pid))->select();

		foreach ($user as $key => $value) {
			$where = array('act_id'=>$sceneid,'act_type'=>3,'id'=>$value['uid']);
			$user_info = M('Wall_member')->where($where)->field('portrait,nickname')->find();
			
			$user[$key]['name'] = $user_info['nickname'];
			$user[$key]['head'] = $user_info['portrait'];
		}
		print_r($pid);
		$this->assign('pid',$pid);
		$this->assign('user',$user);
		$this->assign('prize_info',$prize_info);
		$this->display();
	}
        /*奖品首页*/
	public function prize(){
		$sceneid 	= $this->_get('id','intval');
		$where 	= array('sceneid'=>$sceneid,'token'=>$this->token);
		$count 	= M('Wall_prize')->where($where)->count();

		
		$Page   = new Page($count,15);
		$list 	= M('Wall_prize')->where($where)->order('sort desc,id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('sceneid',$sceneid);
		$this->assign('list',$list);
		$this->assign('page',$Page->show());
		$this->display();
	}
        /*奖品设置*/
	public function prize_set(){
		$prize_db 	= D('scene_qywall_prize');
		//$sceneid 	= $this->_get('sceneid','intval');
		//$pid 		= $this->_get('pid','intval');
		$prize_info = $prize_db->where(array('user_id'=>$_SESSION['user_id']))->find();

		if(IS_POST){
			if($prize_db->create()){
				if($prize_info){
					$_POST['token']		= $this->token;
					$prize_db->where(array('user_id'=>$_SESSION['user_id']))->save($_POST);

					$this->success('修改成功',U('Scene/prize_set',array('mid'=>$_GET['mid'])));

				}else{
					$_POST['user_id'] = $_SESSION['user_id'];
					//$_POST['token']		= $this->token;
					//$_POST['sceneid']		= $sceneid;
					$prize_db->add($_POST);
					$this->success('添加成功',U('Scene/prize_set',array('mid'=>$_SESSION['user_id'])));
				}
			}else{
                $this->error($prize_db->getError());
            }
		}else{

			$this->assign('info',$prize_info);
			$this->assign('sceneid',$sceneid);
			$this->display();
		}
	}

	public function prize_del(){
		$sceneid 	= $this->_get('sceneid','intval');
		$id 		= $this->_get('pid','intval');
		if(M('Wall_prize')->where(array('token'=>$this->token,'id'=>$id,'sceneid'=>$sceneid))->delete()){
			//M('wall_prize')->where(array('prize'=>$id,'sceneid'=>$sceneid,'token'=>$this->token))->delete();
			$this->success('删除成功',U('Scene/prize',array('token'=>$this->token,'id'=>$sceneid)));
		}
	}

	public function prizeRecords(){
		$where['token']		= $this->token;
		$where['prize']		= $this->_get('pid','intval');
		$where['sceneid'] 	= $this->_get('sceneid','intval');
		$prize = M('Wall_prize')->where(array('id'=>$where['prize']))->find();
		$this->assign('prizename',$prize['name']);
		$recordsArr			= M('Wall_prize_record')->where($where)->select();

		foreach($recordsArr as $key=>$value){
			$user = M('wall_member')->where(array('act_type'=>'3','act_id'=>$where['sceneid'],'id'=>$value['uid']))->field('portrait,nickname')->find();
			$recordsArr[$key]['nickname'] 	= $user['nickname'];
			$recordsArr[$key]['portrait'] 	= $user['portrait'];
			$recordsArr[$key]['prize_name']	= M('wall_prize')->where(array('token'=>$this->token,'sceneid'=>$value['sceneid'],'id'=>$value['prize']))->getField('pname');
		}

		$this->assign('empty','没有找到相关记录');
		$this->assign('records',$recordsArr);
		$this->display();

	}
    /*******投票现场*/
	public function vote(){
		$vote_list 	= M('scene_qyvote')->where(array('user_id'=>$_SESSION['user_id'],'id'=>array('in',$this->info['vote_id'])))->select();	
		$now 		= time();
		foreach ($vote_list as $key => $value) {
			if($value['enddate'] < $now && $value['status'] == 0){
				$vote_list[$key]['is_end'] = 1;
			}else{
				$vote_list[$key]['is_end'] = 0;
			}
		}
		$this->assign('vote_list',$vote_list);
		$this->display();
	}

	public function get_vote(){
		$vote_id 	= $this->_get('vote_id','intval');
		$scene_id 	= $this->_get('scene_id','intval');

		$vote_item 	= M('scene_qyvote_item')->where(array('vid'=>$vote_id))->order('id desc')->select();
		$result 	= array();
		if($vote_item){
			$result['err'] 		= 0;
			$result['res'] 		= $vote_item;
		}else{
			$result['err'] = 1;
			$result['res'] = "没有找到投票选项";
		}
		echo json_encode($result);
	}
    /*开始投票*/
	public function vote_start(){
		$vote_id	= $this->_get('vote_id','intval');
		$offset 	= M('scene_qyvote')->where(array('token'=>$this->token,'id'=>$vote_id,'status'=>0))->save(array('status'=>1));	

		$result['err'] 	= 0;
		$result['msg'] 	= '投票已经开启';

		echo json_encode($result);
	}
    /*投票状态更新*/
	public function ajaxVcount(){
		$vote_id	= $this->_get('vote_id','intval');
		$vote_info 	= M('scene_qyvote')->where(array('token'=>$this->token,'id'=>$vote_id))->find();
		$res 		= M('scene_qyvote_item')->where(array('vid'=>$vote_id))->field('id,vcount')->select();	
	
		$result['res'] 	= $res;

		$time = time();
		if($vote_info['statdate'] < $time && $vote_info['enddate'] > $time){
			$result['flag'] = 1;
		}else{
			$result['flag'] = 0;
		}
		
		echo json_encode($result);
	}
    /*结束投票*/
	public function vote_stop(){
		$vote_id	= $this->_get('vote_id','intval');
		$now 		= time();
		$offset 	= M('scene_qyvote')->where(array('token'=>$this->token,'id'=>$vote_id))->save(array('status'=>0,'statdate'=>$now-1,'enddate'=>$now-1));
		if($offset=1){
			$result['err'] = 0;
			$id 	= M('scene_qyvote_item')->where(array('vid'=>$vote_id))->order('vcount desc')->getField('id',true);
			$id 	= array_flip($id);
			$res 	= M('scene_qyvote_item')->where(array('vid'=>$vote_id))->order('id desc')->select();
			foreach ($res as $key => $value) {
				$res[$key]['ranks'] = $id[$value['id']]+1;
			}
			$result['res'] = $res;
		}

		echo json_encode($result);
	}


	public function vote_count(){
		$vote_id 			= $this->_get('vote_id','intval');
		$result['count'] 	= count($this->_getMember('vote_id',$vote_id,'','id'));
		$result['fcount'] 	= M('Vote_record')->where(array('vid'=>$vote_id))->count();

		echo json_encode($result);
	}

	public function show_vote(){
		$vote_id 	= $this->_get('id','intval');
		$now 		= time();
		$vote_info 	= M('scene_qyvote')->where(array('token'=>$this->token,'id'=>$vote_id,'status'=>0,'enddate'=>array('lt',$now)))->find();
		if($vote_info){
			$res 	= M('scene_qyvote_item')->where(array('vid'=>$vote_info['id']))->order('vcount desc')->select();
		}

		$this->assign('vote',$res);
		$this->display();
	}
    /*********对对碰现场*/
	public function supperzzle(){


		$this->display();
	}

	public function defUser(){

		$sceneid 	= $this->_get('sceneid','intval');
		$result 	= array();
		$male		= $this->_getMember('id',$sceneid,'','list',array('sex'=>1));
		$female		= $this->_getMember('id',$sceneid,'','list',array('sex'=>2));

		$maleCount	= count($this->_getMember('id',$sceneid,'','id',array('sex'=>1)));
		$femaleCount= count($this->_getMember('id',$sceneid,'','id',array('sex'=>2)));

		if(empty($maleCount) || empty($femaleCount)){
			$result['err'] = 1;
			$result['msg'] = '剩余玩家不足以配对！';	
		}else{
			$result['err'] 		= 0;
			$result['data']['list']['male'] 	= $male;
			$result['data']['list']['female'] 	= $female;
		}

		$result['data']['maleCount']	= $maleCount;
		$result['data']['femaleCount']	= $femaleCount;

		echo json_encode($result);
	}

	public function add_slog(){
		$_POST['addtime'] 	= time();
		$_POST['token']		= $this->token;
		M('scene_qywall_supperzzle')->add($_POST);
	}

	public function supperzzle_log(){
		$sceneid= $this->_get('id','intval');
		$sid 	= $this->_get('sid','intval');
		$count 	= M('scene_qywall_supperzzle')->where(array('sceneid'=>$sceneid))->order('addtime desc')->getField('id',true);
		if(empty($sid)){
			$sid = $count[0];
		}

		$info  	= M('scene_qywall_supperzzle')->where(array('sceneid'=>$sceneid,'id'=>$sid))->order('addtime desc')->find();
		$n_info = $this->supperzzle_user($info['nid'],$sceneid);
		$v_info = $this->supperzzle_user($info['vid'],$sceneid);
		
		$info['n_name'] = $n_info['nickname'];
		$info['n_head'] = $n_info['portrait'];

		$info['v_name'] = $v_info['nickname'];
		$info['v_head'] = $v_info['portrait'];

		$this->assign('sceneid',$sceneid);
		$this->assign('info',$info);
		$this->assign('count',$count);
		$this->display();
	}

	public function supperzzle_user($id,$sceneid){
		$where 	= array('token'=>$this->token,'act_type'=>'3','act_id'=>$sceneid,'id'=>$id);
		$user 	= M('scene_qywewall_member')->where($where)->field('nickname,portrait')->find();
		return $user;
	}
        /*******公共部分*/
	/*获取参与活动用户*/
 	public function _getMember($field,$id,$limit="",$return="list",$ext=''){
 		$member_db 	= M('scene_qywall_member');
		$scene_db 	= M('scene_qywechat_scene');
 		$act_id 	= $scene_db->where(array('token'=>$this->token,'is_open'=>'1',"$field"=>$id))->getField('id');
		//有开启微现场就取微现场的用户  否则取个人id活动
		if($act_id){  
			$where 	= array('token'=>$this->token,'act_id'=>$act_id,'act_type'=>'3');
		}else{
			if($field == 'shake_id'){
				$where 	= array('token'=>$this->token,'act_id'=>$id,'act_type'=>'2');
			}else if($field == 'wall_id'){
				$where 	= array('token'=>$this->token,'act_id'=>$id,'act_type'=>'1');
			}	
		}
		if($ext){
			$where = array_merge($where,$ext);
		}
		if($return == 'list'){
			$user = $member_db->where($where)->limit($limit)->select();
		}else if($return == 'id'){
			$user = $member_db->where($where)->limit($limit)->getField('id',true);
		}

		return $user;
 	}


	public function header(){
		$this->display();
	}
	public function footer(){

		$this->display();
	}

	public function Wewall_add(){
		$db=M('scene_qywewall');
		$where['token']=session('token');
		$where['isact']=array('neq',2);
		$exst=$db->where($where)->select();
		if($exst!=false){$this->error('已存在已激活的活动',U('Wewall/index',array('token'=>session('token'))));}
		else{
			$data = M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id']))->find();
			//dump($data);die;
			$this->assign('data',$data);
			$this->assign('token',session('token'));
			$this->display();
		}

	}
	public function Wewall_insert()
	{
		if(IS_POST){
			$data = M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id']))->find();
			if($data){
				M('scene_qywewall')->where(array('user_id'=>$_SESSION['user_id']))->save($_POST);
				$this->success('修改成功',U('Scene/Wewall_add',array('mid'=>$_GET['mid'])));
			}else{
				$_POST['user_id'] = $_SESSION['user_id'];
				$_POST['isact'] = 1;
				M('scene_qywewall')->add($_POST);
				$this->success('添加成功',U('Scene/Wewall_add',array('mid'=>$_GET['mid'])));
			}
		}else{
			$this->error('操作失败');
		}
		//$this->all_insert();
	}

	public function Shake_add(){
		
		$db=M('scene_qyshake');
		$where['user_id']=$_SESSION['user_id'];
		$where['isopen']=array('neq',2);
		$exst=$db->where($where)->find();
		//$this->assign('token',session('token'));
		//if($exst!=false){$this->error('已存在已激活的活动',U('Shake/index',array('token'=>session('token'))));}
		//else
		
			$info=M('Qymyapp')->where(array('id'=>$_GET['mid'],'userid'=>$_SESSION['user_id']))->find();
		
			$this->assign('info',$info);
			
		$this->assign('exst',$exst);		
		$this->display();
	}
	public function Shake_insert()
	{
		$_POST['user_id'] = $_SESSION['user_id'];
		$_POST['isopen'] = 1;
		if(IS_POST){			
			$shake = M('scene_qyshake');
			$where = array('user_id'=>$_POST['user_id']);
			$check = $shake->where($where)->find();
			if($check){
				$shake->where($where)->save($_POST);
				$this->success('修改成功');
			}else{
				$add = $shake->add($_POST);
				$this->success('添加成功');
			}

		}else{
			$this->error('添加失败');
		}
		
	}
	public function Shake_wap_index(){		
		
		$data=array();
		$data['phone'] 		= $this->_get('phone');
		$data['token'] 		= $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$ifact=M('scene_qyshake')->where(array('user_id'=>$_SESSION['user_id'],'isopen'=>array('neq',2)))->find();
		if($ifact==false){echo '<script>alert ("商家目前没有进行中的摇一摇活动")</script>'; return;}
		$exst=M('scene_qytoshake')->where(array('wecha_id'=>$data['wecha_id']))->select();
		//if($exst==false){M('scene_qytoshake')->add($data);}
		$this->assign('info',$data);
		$this->assign('ctime',$ifact['clienttime']);
		$this->assign('music',$ifact['pass3']);
		$this->display();		
	}	
    public function SceneVote_index(){
		$this->display();
    }
	
    public function SceneVote_add(){
	    $this->assign('type',$_GET['type']);
		//print_r($_GET);exit;
        if (IS_POST)
		{	
			
			$checkv = M('scene_qyvote')->where(array('user_id'=>$_SESSION['user_id']))->find();
			//dump($checkv);die;
			if($checkv){			
            $data              = D('scene_qyvote');
            $pdata['id']       = $checkv['id'];
            //$pdata['token']    = session('token');
            $pdata['type']     = $_GET['type'];
            $pdata['statdate'] = strtotime($_POST['statdate']);
            $pdata['enddate']  = strtotime($_POST['enddate']);
			$pdata['cknums']   = $_POST['cknums'];
			//$pdata['keyword']   = $this->_post('keyword');
			if($_POST['cknums_type']=='0')
				$pdata['cknums']=1;
            
            $pdata['display']  = $_POST["display"];
            $pdata['info']     = strip_tags($_POST["info"]);
			$pdata['picurl']   = $_POST["picurl"];
            $pdata['title']    = $_POST["title"];
			$pdata['user_id']  = $_SESSION['user_id'];
			$pdata['showpic']    = $_POST["showpic"];
            $where = array(
                //'id' => $pdata['id'],
                //'token' => session('token')
				'user_id' => $_SESSION['user_id']
            );
            $check             = $data->where($where)->find();
            if ($check == false)
                $this->error('非法操作');
				
            if (empty($_REQUEST['add'])) 
			{
                $this->error('投票选项必须填写');
                exit;
            }
            $t_item = M('scene_qyvote_item');
            $datas  = $_REQUEST['add'];			
			 foreach ($datas as $ke => $value) 
			 {
				foreach ($value as $k => $v) 
				{
					$item_add[$k][$ke] = $v;
				}
			}
			
            $isnull = $t_item->where('vid=' . $checkv['id'])->find();		
            foreach ($item_add as $k => $v) 
			{
                $i_id['id'] = $v['id'];
                if ($i_id['id'] != '')
				{
                    $data2['item']   = $v['item'];
                    $data2['rank']   = $v['rank'];
                    $data2['vcount'] = $v['vcount'];
                    if ($_GET['type'] == 'img') 
					{
                        $data2['startpicurl'] = $v['startpicurl'];
                        $data2['tourl']       = $v['tourl'];
                    }
                    $m = $t_item->where('id=' . $i_id['id'])->save($data2);
                }else{
				
					$data3['item']   = $v['item'];
                    $data3['rank']   = $v['rank'];
                    $data3['vid']   = $pdata['id'];
                    $data3['vcount'] = $v['vcount'];
                    if ($_POST['type'] == 'img') 
					{
                        $data3['startpicurl'] = $v['startpicurl'];
                        $data3['tourl']       = $v['tourl'];
                    }
					if(!empty($v['item'])){
						$n = $t_item->add($data3);
					}
				
				}
				//echo 123;die;
            }  
			//dump($pdata['keyword']);
			//exit;
			if ($data->save($pdata) || $m || $n)
			{
				//$data1['pid']    = $pdata['id'];
				//$data1['module'] = 'Vote';
				//$data1['token']  = session('token');
				//$da['keyword']   = trim($pdata['keyword']);
				//dump(trim($pdata['keyword']));exit;
				
				//M('Keyword')->where($data1)->save($da);
				$this->success('修改成功');
			} 
			else 
			{
				//echo 123;die;
				$this->error('操作失败');
			}			
			}else{
			
			$adds = $_REQUEST['add'];
            if (empty($adds)) 
			{
                $this->error('投票选项你还没有填写');
                exit;
            }
            foreach ($adds as $ke => $value) 
			{
                foreach ($value as $k => $v) {
                    $item_add[$k][$ke] = $v;
                }
            }			
            $data              = D('scene_qyvote');          
            //$_POST['token']    = session('token'); 
			$_POST['user_id']  = $_SESSION['user_id'];	
            $_POST['statdate'] = strtotime($_POST['statdate']);
            $_POST['enddate']  = strtotime($_POST['enddate']);
			
			
			if($_POST['cknums_type']==0)
				 $_POST['cknums']=1;
            $t_item            = M('scene_qyvote_item');
			
            if ($data->create()) 
			{
                if ($id = $data->add()) 
				{
					//if(!M('Keyword')->add(array('pid'=>$id,'token'=>$_POST['token'],'module'=>'Vote','keyword'=>$_POST['keyword'])))
					//	 $this->error('服务器繁忙,请稍候再试');
                    foreach ($item_add as $k => $v) 
					{
						$data2['user_id'] 	 = $_SESSION['user_id'];
                        $data2['vid']    = $id;
                        $data2['item']   = $v['item'];
                        $data2['rank']   = $v['rank'];
                        $data2['vcount'] = $v['vcount'];
                        if ($_POST['type'] == 'img') 
						{
                            $data2['startpicurl'] = $v['startpicurl'];
                            $data2['tourl']       = $v['tourl'];
                        }
                        $t_item->add($data2);
                    }
                    //$data1['pid']     = $id;
                    //$data1['module']  = 'Vote';
                    //$data1['token']   = session('token');
                    //$data1['keyword'] = trim($_POST['keyword']);
                    //M('Keyword')->add($data1);
                    //$user = M('Users')->where(array(
                    //    'id' => session('uid')
                    //))->setInc('activitynum');
                    $this->success('添加成功');
                } 
				else 
				{
                    $this->error('服务器繁忙,请稍候再试');
                }
            } 
			else
			{
                $this->error('添加失败');
            }
			}
        }else{
            //$id    = $this->_get('id');
            $where = array(
                //'id' => $id,
                //'token' => session('token')
				'user_id' => $_SESSION['user_id'] 
            );
			
            $data  = M('scene_qyvote');
            $check = $data->where($where)->find();
            //if ($check == false)
            //    $this->error('非法操作');
			if($check){
				$items = M('scene_qyvote_item')->where('vid=' . $check['id'])->select();
			}	
            //$items = M('scene_qyvote_item')->where('vid=' . $id)->select();
			//$this->assign('token',session('token'));
			//print_r($check);exit;
            $this->assign('items', $items);
            $this->assign('vo', $check);			
            $this->display();
        }		
    }
	public function SceneVote_wap_index()
    {           
        $token    = $_GET['token'];
        $wecha_id = $_GET['wecha_id'];
        $id       = $_GET['id'];
        $t_vote   = M('scene_qyvote');
        $t_record = M('scene_qyvote_record');
        $where    = array(
            //'token' => $token,
            //'id' => $id
			'user_id' => $_SESSION['user_id']
        );
        $vote     = $t_vote->where($where)->find();
		
		$arr = M('scene_qyvote')->where($where)->find();
	
		$now = time()+8*3600;
			if($arr['enddate'] < $now){
				$arr['time'] = 2;
			}else if($arr['statdate'] > $now){
				$arr['time'] = 0;
			}else{
				$arr['time'] = 1;
			}
		
		$this->assign('shijian',$arr);
		
		
        if (empty($vote)) 
		{
            exit('非法操作');
        }
        $vote_item = M('scene_qyvote_item')->where('vid=' . $vote['id'])->select();
        $this->assign('count',count($vote_item ));
        $where       = array(
            'wecha_id' => $wecha_id,
            'vid' => $id
        );
        $vote_record = $t_record->where($where)->find();
        $total       = count($vote_item );  

		$i = 0;
		foreach ($vote_item as $k => $v){
			$i = $i + $v['vcount'];
		}
		
        foreach ($vote_item as $k => $value) 
		{
            $vote_item[$k]['per'] = (number_format(($value['vcount'] / $i), 4)) * 100;
        }
		
        $this->assign('vote_item', $vote_item);
        $this->assign('vote', $vote);
        $this->display();
    }
    public function SceneVote_wap_add_vote()
    {
        $token    = $_POST['token'];
        $wecha_id = $_POST['wecha_id'];
        $tid      = $_POST['tid'];
        $chid     = rtrim($_POST['chid'], ',');
        $recdata  = M('scene_qyvote_record');
        $where    = array(
            'vid' => $tid,
            'wecha_id' => $wecha_id
        );
        $recode   = $recdata->where($where)->find();
        if ($recode != '' || $wecha_id == '') {
            $arr = array(
                'success' => 0
            );
            echo json_encode($arr);
            exit;
        }
        $data      = array(
            'item_id' => $chid,
            'vid' => $tid,
            'wecha_id' => $wecha_id,
            'touch_time' => time(),
            'touched' => 1
        );
        $ok        = $recdata->add($data);
        $map['id'] = array(
            'in',
            $chid
        );
        $t_item    = M('scene_qyvote_item');
        $t_item->where($map)->setInc('vcount');
        $total      = M('scene_qyvote_record')->where('vid=' . $tid)->count('touched');
        $item_count = M('scene_qyvote_item')->where('vid=' . $tid)->select();
        foreach ($item_count as $value) {
            $per[$value['id']] = (number_format(($value['vcount'] / $total), 4)) * 100;
        }
        $arr = array(
            'success' => 1,
            'token' => $token,
            'wecha_id' => $wecha_id,
            'tid' => $tid,
            'chid' => $chid,
            'arrpre' => $per
        );
        echo json_encode($arr);
        exit;
    }	
}
?>