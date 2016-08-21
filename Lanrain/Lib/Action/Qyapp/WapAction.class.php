<?php
class WapAction extends BaseAction{
	private $tpl;	//微信公共帐号信息
	private $info;	//分类信息
	private $info2;	//2级分类信息
	private $wecha_id;
	private $copyright;
	public $company;
	public $token;
	//public $weixinUser;
	public $homeInfo;
	public function _initialize()
	{
		$this->token=$this->_get('token','trim');
		$this->wecha_id=$this->_get('wecha_id');
		$where['token']=$this->token;
		//$tpl=D('Wxuser')->where($where)->find();
		$class_tpl=M('qyclassify')->where(array('token'=>$this->_get('token'),'id'=>$this->_get('classid')))->find();	
		
		//$this->weixinUser=$tpl;		
		$info=M('qyclassify')->where(array('token'=>$this->_get('token'),'status'=>1))->order('sorts desc')->select();
		//dump($info);exit;
		$info=$this->convertLinks($info);//加外链等信息
		foreach($info AS $k=>$v)
		{
			if($v['pid']==0){
				$_p_category[$v['id']]=$v;
				$_p_category[$v['id']]['sub']=false;
				unset($info[$k]);
			}			
		}
		foreach($info AS $k=>$v){
			if(isset($_p_category[$v['pid']])){
				$_p_category[$v['pid']]['sub'][]=$v;
			}
		}
		$info=$_p_category;
		
		$info2=M('qyclassify')->where(array('token'=>$this->_get('token'),'status'=>1,'pid'=>array('gt',0)))->order('sorts desc')->select();
		$info2=$this->convertLinks($info2);//加外链等信息	
		$homeInfo=M('home')->where(array('token'=>$this->token))->find();
		//
		$catemenu_db=M('zhu_menu');
		$catemenu=$catemenu_db->where(array('token'=>$this->token,'status'=>1))->order('orders desc')->select();
		$menures=array();
		if ($catemenu)
		{	$res=array();
			$rescount=0;
			foreach ($catemenu as $val)
			{
				$val['url']=$this->getLink($val['url']);
				$res[$val['id']]=$val;
				if ($val['pid']==0){
					$val['vo']=array();
					$menures[$val['id']]=$val;
					$menures[$val['id']]['k']=$rescount;
					$rescount++;
				}
			}
			foreach ($catemenu as $val)
			{
				$val['url']=$this->getLink($val['url']);
				if ($val['pid']>0){
					array_push($menures[$val['pid']]['vo'],$val);
				}
			}
		}
		$catemenu=$menures;
		$this->assign('catemenu',$catemenu);
		//判断菜单风格
		$styleset_db=M('home');
		$radiogroup=$homeInfo['radiogroup'];
		if($radiogroup==false)
		{
			$radiogroup=0;
		}
		
		$cateMenuFileName='tpl/Apps/Wap/Custom/menuStyle'.$radiogroup.'.html';
		$this->assign('cateMenuFileName',$cateMenuFileName);
		$this->assign('radiogroup',$radiogroup);
		$gid=D('Users')->field('gid')->find($tpl['uid']);
		$this->userGroup=M('User_group')->where(array('id'=>$gid['gid']))->find();
		$this->copyright=$this->userGroup['iscopyright'];
		$this->info=$info;
		$this->info2=$info2;
		$tpl['color_id']=intval($tpl['color_id']);		
		$this->tpl_index=TMPL_PATH."Apps/Wap/Index/".$tpl["tpltypename"].'/index.html';
		if($class_tpl['tpl_list'])
			$this->tpl_list=TMPL_PATH."Apps/Wap/".$class_tpl['tpltype'].'/'.$class_tpl['tpl_list'].'/index.html';			
		else
			$this->tpl_list=TMPL_PATH."Apps/Wap/list/".$tpl["tpllistname"].'/index.html';
			
		//内容页模板
		$cof=M('Img')->where(array('id'=>$_GET['id']))->find();
		$cotpl=M('qyclassify')->where(array('id'=>$cof['classid']))->find();
		if($cotpl['tpl_content']){
		$this->tpl_content=TMPL_PATH."Apps/Wap/Content/".$cotpl['tpl_content'].'/index.html';
		}
		else{
			$this->tpl_content=TMPL_PATH."Apps/Wap/Content/".$tpl["tplcontentname"].'/index.html';	
		}
				
		//echo $this->tpl_content;
		$this->tpl=$tpl;
		$company_db=M('company');
		$this->company=$company_db->where(array('token'=>$this->token,'isbranch'=>0))->find();
		$this->assign('company',$this->company);
		//
		$homeInfo=M('home')->where(array('token'=>$this->token))->find();
		$this->assign('homeInfo',$homeInfo);
		//
		$this->assign('token',$this->token);
		//
		$this->assign('copyright',$this->copyright);
		//plugmenus
		$plugMenus=$this->_getPlugMenu();
		$this->assign('plugmenus',$plugMenus);
		$this->assign('showPlugMenu',count($plugMenus));
	}
	
	public function classify()
	{
		$this->assign('info',$this->info);
		$this->assign('tpl_path',WAPTPL_PATH.'Index');
		$this->assign('tpl_path',WAPTPL_PATH."Index/".$this->tpl["tpltypename"]);
		$this->display($this->tpl_index);
	}
	public function index()
	{	//获取当前域名
		$this->assign('url','http://'.$_SERVER['SERVER_NAME']);
		$this->wecha_id=$_GET['wecha_id'];		
		if ($this->homeInfo['advancetpl'])
		{
			echo '<script>window.location.href="/cms/index.php?token='.$this->token.'&wecha_id='.$this->wecha_id.'";</script>';
			exit();
		}		
		$where['token']=$this->_get('token');
		$where['tip']=1;
		$flash=M('Flash')->where($where)->select();	
		$where['tip']=2;
		$flashbg=M('Flash')->where($where)->select();	
		$count=count($flash);
		$countbg=count($flashbg);
		foreach($flash AS $k=>$v)
		{
			if($v['url']=='')
				$flash[$k]['url']='javascript:void();';
		}		
		$i = 0;
		foreach($this->info as $v){
			if($i==0){
				$logo = $v;
			}
			$i++;
		}
		//dump($flash);exit;
		
		$this->assign('flashbg',$flashbg);
		$this->assign('id',$_GET['classid']); 
		$this->assign('img',$logo['img']); 
		$this->assign('flash',$flash);
		
		//dump($this->info);
		$this->assign('info',$this->info);
		$this->assign('info2',$this->info2);
		$this->assign('num',$count);
		$this->assign('num1',$countbg);
		/*
		$classid=$this->_get('classid');
		if(empty($classid)){
			$classid=0;
		}
		$WhereAll['status']=1;
		$WhereAll['pid']=$classid;
		$WhereAll['token']=$this->_get('token');
        $new=M('classify')->where($WhereAll)->order('sorts desc')->select();	
		if($new)
		{	$new=$this->convertLinks($new);
			$this->assign('info',$new);
		}*/
		
		if($this->_get('tpl'))
		{
            $this->tpl['tpltypeid']=$this->_get('tpl');	
			if($this->_get('tpl')<10)
			{
				$i=$this->_get('tpl');
				$moban='0'.$i;
			}
			else
			{
				$moban=$this->_get('tpl');
			}
			$this->tpl['tpltypename']='tpl_1'.$moban.'_index';
		}
		$this->assign('tpl_path',WAPTPL_PATH."Index/".$this->tpl["tpltypename"]);
		if($this->homeInfo['bjdh']!=''&&$this->homeInfo['bjdh']!=0){
		$this->assign('bjdh','<div id="leafContainer"></div>
<style>
.mainmenu{
z-index:3
}
 #leafContainer 
{
    position: fixed;
    z-index:2;
width:100%;
    height: 690px;
top:0;
overflow:hidden;
}
 #leafContainer > div 
{
    position: absolute;
    max-width: 100px;
    max-height: 100px;
    -webkit-animation-iteration-count: infinite, infinite;
    -webkit-animation-direction: normal, normal;
    -webkit-animation-timing-function: linear, ease-in;
}
#leafContainer > div > img {
     position: absolute;
     width: 100%;
     -webkit-animation-iteration-count: infinite;
     -webkit-animation-direction: alternate;
     -webkit-animation-timing-function: ease-in-out;
     -webkit-transform-origin: 50% -100%;
}
 @-webkit-keyframes fade
{
    0%   { opacity: 1; }
    95%  { opacity: 1; }
    100% { opacity: 0; }
}
 @-webkit-keyframes drop
{
       0%   { -webkit-transform: translate(0px, -50px); }
    100% { -webkit-transform: translate(0px, 650px); }
}
 @-webkit-keyframes clockwiseSpin
{
    0%   { -webkit-transform: rotate(-50deg); }
    100% { -webkit-transform: rotate(50deg); }
}
 @-webkit-keyframes counterclockwiseSpinAndFlip 
{
    0%   { -webkit-transform: scale(-1, 1) rotate(50deg); }
    100% { -webkit-transform: scale(-1, 1) rotate(-50deg); }
}
 </style>
<script src="'.RES.'/css/bjdh/'.$this->homeInfo['bjdh'].'/bjdh'.$this->homeInfo['bjdh'].'.js" type="text/javascript"></script>');
		}
		
		
		//幻灯片
			$flashbg=M('Flash')->where(array('token'=>$_GET['token']))->select();
			// $allflash=$this->convertLinks($allflash);
			
			// $flash=array();
			// $flashbg=array();
			// foreach ($allflash as $af){
				// if ($af['tip']==1){
					// array_push($flash,$af);
				// }elseif ($af['tip']==2) {
					// array_push($flashbg,$af);
				// }
			// }
			// dump($flashbg);exit;
			$this->assign('flashbg',$flashbg);
		
		$ntpl=$this->tpl;
		$home=M('Home')->where(array('token'=>$_GET['token']))->find();
		$ntpl['wxname']=$ntpl['wxname'].'</title>'.stripslashes($home['zhidahao']);
        $this->assign('tpl',$ntpl);
		$this->assign('bjmp3',$this->homeInfo['bjmp3']);
	    $this->assign('tongji',$this->homeInfo['tongji']);
		$this->display($this->tpl_index);
	}
	
	public function lists()
	{
		$where['token']=$this->_get('token','trim');
		$db=D('Img');	
		if($_GET['p']==false)
		{
			$page=1;
		}else{
			$page=$_GET['p'];			
		}		
		$where['classid']=$this->_get('classid','intval');
		$count=$db->where($where)->count();	
		$pageSize=8;
		$pagecount=ceil($count/$pageSize);
		
		if($page > $count){$page=$pagecount;}
		if($page >=1){$p=($page-1)*$pageSize;}
		if($p==false)
		{$p=0;}		
		
		$res=$db->where($where)->order('id DESC')->limit("{$p},".$pageSize)->select();	
		foreach($res as $k=>$v){
			$res[$k]['url'] = str_replace('{wecha_id}',$_GET['wecha_id'],$v['url']);
		}
		
		
        if(count($res)==1){
	        $data['click']=array("exp","click+1");
            $db->where("id=".$res[0]['id'])->save($data);	
        }	
		
		//首页转列表页
		foreach ($res as $k=>$v){
			$flash['info']=$v['info'];
			$flash['img']=$v['pic'];
			$flash['url']=U('Wap/content',array('id'=>$v['id'],'token'=>$_GET['token'],'classid'=>$_GET['classid']));
		}
		//dump($flash);exit;
		$this->assign('flash',$flash);
		
		
		$this->assign('page',$pagecount);
		$this->assign('p',$page);
		//判断id是否是总分类
		
		//$this->assign('info',$this->info);//总分类
		//$this->assign('info',$this->info2);//子分类
		$this->assign('info2',$this->info2);
		//dump($this->info2);
		$this->assign('tpl',$this->tpl);
	//dump($res);exit;
		$this->assign('res',$res);
		$this->assign('copyright',$this->copyright);
		if ($count==1)
		{
			
			$this->redirect(U('Apps/Wap/content',array('token'=>$_GET['token'],'id'=>$res[0]['id'],'wecha_id'=>$_GET['wecha_id'])));
			exit();
    	}
		$new=M("qyclassify")->where(array("pid"=>$this->_get("classid"),"token"=>$this->token))->select();
		if($new)
		{
			$new=$this->convertLinks($new);
			$this->assign('info',$new);
		}
		$class_tpl=M('qyclassify')->where(array('token'=>$this->_get('token'),'id'=>$this->_get('classid')))->find();	
		$this->assign('tpl_path',WAPTPL_PATH.$class_tpl['tpltype']."/".$class_tpl['tpl_list']);
		//$this->assign('tpl_path',WAPTPL_PATH."List/".$this->tpl["tpllistname"]);
		
		
		//获取幻灯片
		$zflash=M('Flash')->where(array('token'=>$this->_get('token')))->select();
		$this->assign('flash',$zflash);
		
		$this->display($this->tpl_list);
	}
	public function content($contentid=0)
	{
		$db=M('Img');
		$where['token']=$this->_get('token','trim');
		if (!$contentid)
		{
			$contentid=intval($_GET['id']);
		}
		$where['id']=array('neq',$contentid);
		$lists=$db->where($where)->limit(5)->order('uptatetime')->select();
		$where['id']=$contentid;
		$res=$db->where($where)->order('sorts DESC')->find();
		$data['click']=array("exp","click+1");
        $count=$db->where("id=".$res['id'])->save($data);
       	
		$this->assign('info',$this->info);	//分类信息
		$this->assign('lists',$lists);		//列表信息
		$this->assign('res',$res);			//内容详情;
		$this->assign('tpl',$this->tpl);				//微信帐号信息
		$this->assign('copyright',$this->copyright);	//版权是否显示
		$this->assign('tpl_path',WAPTPL_PATH."Content/".$this->tpl["tplcontentname"]);
		//echo $this->tpl_content; die();
		$this->display($this->tpl_content);
	}
	public function flash()
	{
		
		$where['token']=$this->_get('token','trim');
		$flash=M('Flash')->where($where)->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->display($this->tpl_index);
	}
	/**
	 * 获取链接
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	public function getLink($url)
	{	
		if(!$this->wecha_id)
			$this->wecha_id=$_GET['wecha_id'];
		if($url)
			return str_replace('{wecha_id}',$this->wecha_id,$url);
		else
			return $url;
	}
	public function convertLinks($arr)
	{		
		foreach($arr as $k=>$a)
		{
			if($a['url'])
			{				
				$arr[$k]['url']=str_replace('{wecha_id}',$this->wecha_id,$a['url']);
			}
			else
			{
				$arr[$k]['url']=U('Apps/Wap/lists',array('classid'=>$a['id'],'token'=>$this->token,'wecha_id'=>$this->wecha_id));;
			}
		}
		return $arr;
	}	
	public function _getPlugMenu(){
		$company_db=M('company');
		$this->company=$company_db->where(array('token'=>$this->token,'isbranch'=>0))->find();
		$plugmenu_db=M('site_plugmenu');
		$plugmenus=$plugmenu_db->where(array('token'=>$this->token,'display'=>1))->order('taxis ASC')->limit('0,4')->select();
		if ($plugmenus){
			$i=0;
			foreach ($plugmenus as $pm){
				switch ($pm['name']){
					case 'tel':
						if (!$pm['url']){
							$pm['url']='tel:'.$this->company['tel'];
						}else {
							$pm['url']='tel:'.$pm['url'];
						}
						break;
					case 'memberinfo':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Apps&m=Userinfo&a=wap_index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'nav':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Apps&m=Company&a=wap_map&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'message':
						break;
					case 'share':
						break;
					case 'home':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Apps&m=Wap&a=wap_index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'album':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Apps&m=Photo&a=wap_index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'email':
						$pm['url']='email:'.$pm['url'];
						break;
					case 'shopping':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Apps&m=Product&a=wap_index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'membercard':
						$card=M('member_card_create')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
						if (!$pm['url']){
							if($card==false){
								$pm['url']=rtrim(C('site_url'),'/').U('Apps/Card/get_card',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
							}else{
								$pm['url']=rtrim(C('site_url'),'/').U('Apps/Card/vip',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
							}
						}
						break;
					case 'activity':
						$pm['url']=$this->getLink($pm['url']);
						break;
					case 'weibo':
						break;
					case 'tencentweibo':
						break;
					case 'qqzone':
						break;
					case 'wechat':
						$pm['url']='weixin://addfriend/'.$this->weixinUser['wxid'];
						break;
					case 'music':
						break;
					case 'video':
						break;
					case 'recommend':
						$pm['url']=$this->getLink($pm['url']);
						break;
					case 'other':
						$pm['url']=$this->getLink($pm['url']);
						break;
				}
				$plugmenus[$i]=$pm;
				$i++;
			}
		}
		else 
		{//默认的
			$plugmenus=array();
			
		}
		return $plugmenus;
	}
}