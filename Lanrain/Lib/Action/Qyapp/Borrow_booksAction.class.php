<?php
class Borrow_booksAction extends Action{
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
	
//用户列表	
	public function index(){
        $this->check();	
		$db=M('qybook_userinfo');
		$where['user_id']=session('user_id');
		
		if(IS_POST){
			if($_POST['username'] !=''){
				$username=$_POST['username'];
				$where['user_name']=array('like',array("%$username","%$username%","$username%"),'or');
			}
			if($_POST['tel'] != ''){
				$where=$_POST['tel'];
			}
		}
		
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();		
				
		$this->assign('page',$page->show());
		$this->assign('info',$data);
		$this->display();
	}
	//配置
	public function set(){
        $this->check();		
		$home=M('qyhome')->where(array('user_id'=>session('user_id')))->find();
		if(IS_POST){
		    //dump($_POST);exit;
			$_POST['user_id']=session('user_id');
			if($home==false){
				$data = $_POST;
				$home = M('qyhome')->data($data)->add();
				if($home)
					$this->success('添加成功！');
				else
					$this->error('添加失败！');
			}else{
				$data = $_POST;
				$home = M('qyhome')->where(array('user_id'=>session('user_id')))->data($data)->save();
				if($home)
					$this->success('修改成功！');
				else
					$this->error('修改失败！');
			}
		}else{
			$this->assign('home',$home);
			$this->display();
		}
	}
//用户列表	
	public function users(){
        $this->check();	
		$db=M('qybook_userinfo');
		$where['user_id']=session('user_id');
		
		if(IS_POST){
			if($_POST['username'] !=''){
				$username=$_POST['username'];
				$where['user_name']=array('like',array("%$username","%$username%","$username%"),'or');
			}
			if($_POST['tel'] != ''){
				$where=$_POST['tel'];
			}
		}
		
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();		
				
		$this->assign('page',$page->show());
		$this->assign('info',$data);
		$this->display();
	}
//用户详情	
	public function usersInfo(){
        $this->check();	
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('qybook_userinfo')->where(array('id'=>$id,'user_id'=>$user_id))->find();
		$this->assign('info',$data);
		$this->display();
	}
//删除用户	
	public function users_Del(){
        $this->check();	
		$id=intval($_POST['id']);
		if($id != ''){
			$user_id = $_SESSION['user_id'];
			$i=M('qybook_userinfo')->where(array('id'=>$id,'user_id'=>$user_id))->delete();
			if($i){
				$this->ajaxReturn("1");
			}else{
				$this->ajaxReturn("0");
			}
		}
	}
//修改用户
	public function users_edit(){
        $this->check();		
		if(IS_POST){
			$id=intval($_POST['id']);
			$i=M('qybook_userinfo')->where(array('id'=>$id))->save($_POST);
			if($i){
				$this->success('修改成功',U('Borrow_books/users',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('操作失败');
			}
		}else{
			$id=$this->_get('id','intval');
			$info=M('qybook_userinfo')->find($id);
			$this->assign('info',$info);
			$this->display(); 
		}
	}
//一个用户的所有借书情况
	public function users_borrows(){
        $this->check();	
		$wecha_id=$_GET['wecha_id'];
		$user_id=session('user_id');
		if($wecha_id){
			$db=M('qybook_users');
			$count=$db->where(array('user_id'=>$user_id,'wecha_id'=>$wecha_id))->count();
			$page=new Page($count,25);
			$data=$db->order('id desc')->where(array('user_id'=>$user_id,'wecha_id'=>$wecha_id))->limit($page->firstRow.','.$page->listRows)->select();		
			foreach($data as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$data[$k]['className']=$res['name'];//分类名
			}
			$this->assign('page',$page->show());
			$this->assign('info',$data);
		}
		$this->display();
	}
	public function cat()
	{
        $this->check();	
		$db=M('qybook_classify');
		$where['user_id']=session('user_id');
		if(isset($_GET['pid'])){
		    $pid = $_GET['pid'];
			$where['pid']=$_GET['pid'];
			$this->assign('id',$id);
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$data=$db->where($where)->order('sorts asc')->limit($page->firstRow.','.$page->listRows)->select();
						
		}else{
			//print_r($where);exit;
			$where['pid']=0;
		    $pid = 0;				
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$data=$db->where($where)->order('sorts asc')->limit($page->firstRow.','.$page->listRows)->select();		
		}	
		$this->assign('pid',$pid);		
		$this->assign('page',$page->show());
		$this->assign('data',$data);
		$this->display();		
	
	}	
//一个分类下的书库
	public function cat_room(){
        $this->check();	
		$id=intval($_GET['id']);
		$user_id=session('user_id');
		if($id){
			$db=M('qybook_room');
			$count=$db->where(array('book_id'=>$id,'user_id'=>$user_id))->count();
			$page=new Page($count,25);
			$info=$db->order('id desc')->where(array('book_id'=>$id,'user_id'=>$user_id))->limit($page->firstRow.','.$page->listRows)->select();
			foreach($info as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$info[$k]['className']=$res['name'];//分类名
			}
			$classify=M('qybook_classify')->where($where)->select();
			$this->assign('classify',$classify);
			$this->assign('page',$page->show());  
			$this->assign('info',$info);
		}
		$this->display();
	}
	
//删除分类	
	public function cat_Del()
	{
        $this->check();	
		$id=intval($_POST['id']);
		$i=M('qybook_classify')->where(array('id'=>$id))->delete();
		if($i){
			$this->ajaxReturn("1");
		}else{
			$this->ajaxReturn("0");
		}
	}
//添加分类	
	public function catAdd()
	{
        $this->check();	
	    if(isset($_GET['pid'])){
		   $pid = $_GET['pid'];	
		}else{
		   $pid = 0;		
		} 
	   $this->assign('pid',$pid); 	
	   $db=M('qybook_classify');
	   $pname=$db->where(array('user_id'=>session('user_id')))->select();
	   $this->assign('fidlist',$pname);
	   $this->display();
	}
	
	public function catInsert()
	{
        $this->check();	
		$_POST['user_id']=$_SESSION['user_id'];
		if(strstr($_POST['tpl_list'],"list")){
			$_POST['tpltype']='list';
		}else{
			$_POST['tpltype']='Index';
		}	
		if(M('qybook_classify')->add($_POST)){
			$this->success('添加成功',U('Borrow_books/cat',array('mid'=>$_GET['mid'],'pid'=>$_POST['pid'])));
		}else{
			$this->error('添加失败');
		}
	}
//分类详情
	public function catInfo(){
        $this->check();	
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('qybook_classify')->where(array('id'=>$id,'user_id'=>$user_id))->find();
		$this->assign('data',$data);
		$this->display();
	}
//修改分类
	public function catEdit()
	{
        $this->check();	
		if(IS_POST){
			$id=intval($_POST['id']);
			$i=M('qybook_classify')->where(array('id'=>$id))->save($_POST);
			if($i){
				$this->success('修改成功',U('Borrow_books/cat',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('操作失败');
			}
		}else{
			$id=$this->_get('id','intval');
			$info=M('qybook_classify')->find($id);
			$info['tpl_list_name']=M("qyhome_tpl")->where('action=\''.$info['tpl_list'].'\'')->getField('name');
			$info['tpl_content_name']=M("qyhome_tpl")->where('action=\''.$info['tpl_content'].'\'')->getField('name');
			$cat=M('qybook_classify')->select();
			$this->assign('cat',$cat);
			$this->assign('data',$info);
			$this->display(); 
		}
	}

	
//书库
	public function room(){
        $this->check();	
		$where['user_id']=$_SESSION['user_id'];
		$db=M('qybook_room');
		if(IS_POST){
	//按书籍名称查询
			if($_POST['searchbook_Name'] != ''){
				$book_name=$_POST['searchbook_Name'];
				$where['book_name'] = array('like',array("%$book_name%","%$book_name","$book_name%"),'or');
			}
	//按书籍分类查询  
			if($_POST['searchClass_lei'] != ''){
				$class_name=$_POST['searchClass_lei'];
				$where['name']=array('like',array("%$class_name","%$class_name%","$class_name%"),'or');
				$where['user_id']=$_SESSION['user_id'];
				$res=M('qybook_classify')->where($where)->select();
				
				if($res){
					foreach($res as $k=>$v){
						$ids[]=$v['id'];
					}
					$ids=implode(',',$ids);
					$where['book_id']=array('in',$ids);
				}
				unset($where['name']);
			}
	//按作者姓名查询		
			if($_POST['searchbook_Writer'] != ''){
				$writer=$_POST['searchbook_Writer'];
				$where['writer']=array('like',array("%$writer%","%$writer","$writer%"),'or');
			}
			
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$info=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
			
			foreach($info as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$info[$k]['className']=$res['name'];//分类名
			}
			$this->assign('page',$page->show());  
			$this->assign('info',$info);
		}else{
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$info=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
			foreach($info as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$info[$k]['className']=$res['name'];//分类名
			}
			$classify=M('qybook_classify')->where($where)->select();
			$this->assign('classify',$classify);
			$this->assign('page',$page->show());  
			$this->assign('info',$info);
		}
		$this->display();
	}
//添加书籍
	public function room_Add(){
        $this->check();	
		$fenlei=M('qybook_classify')->where(array('user_id'=>$_SESSION['user_id']))->select();
		$this->assign('fenlei',$fenlei);
		if(IS_POST){
			if($_POST['book_id'] == ''){
				$this->error('请选择分类、如无分类请先添加分类再添加书库');
			}else{
				$_POST['add_time']=time();
				$_POST['user_id']=$_SESSION['user_id'];
				$id=M('qybook_room')->add($_POST);
				if($id){
					$this->success('操作成功', U('Borrow_books/room',array('mid'=>$_GET['mid'])));
				} else {
					$this->error('操作失败', U('Borrow_books/room_Add',array('mid'=>$_GET['mid'])));
				}
			}
		}else{
			$this->display();
		}
	}
//书籍详情
	public function room_info(){
        $this->check();	
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('qybook_room')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
		$fenlei=M('qybook_classify')->where(array('id'=>$data['book_id']))->find();
		$data['className']=$fenlei['name'];//分类名
		$this->assign('info',$data);
		$this->display();
	}	
	
//修改书籍	
	public function room_edit(){
        $this->check();	
		if(IS_POST){
			$id=intval($_POST['id']);
			$i=M('qybook_room')->where(array('id'=>$id))->save($_POST);
			if($i){
				$this->success('修改成功',U('Borrow_books/room',array('mid'=>$_GET['mid'])));
			}else{
				$this->error('操作失败');
			}
		}else{
			$id=intval($_GET['id']);
			$info=M('qybook_room')->where(array('id'=>$id))->find();
			$this->assign('info',$info);
			$fenlei=M('qybook_classify')->where(array('user_id'=>$_SESSION['user_id']))->select();
			$this->assign('fenlei',$fenlei);
			$this->display();
		}
	}
//删除书籍	
	public function room_Del(){
        $this->check();	
		$id=intval($_POST['id']);
		$i=M('qybook_room')->where(array('id'=>$id))->delete();
		if($i){
			$this->ajaxReturn("1");
		}else{
			$this->ajaxReturn("0");
		}
	}
	

//借书管理
	public function msgs(){
        $this->check();	
		$db=M('qybook_users');
		$where['user_id']=session('user_id');
		
		$count1=$db->where(array('user_id'=>$_SESSION['user_id'],'status'=>1))->count();
		$count2=$db->where(array('user_id'=>$_SESSION['user_id'],'status'=>2))->count();
		$count3=$db->where(array('user_id'=>$_SESSION['user_id'],'status'=>0))->count();
		
		$this->assign('count1',$count1);
		$this->assign('count2',$count2);
		$this->assign('count3',$count3);
		
		if($_GET['status'] == 'all'){
			
		}
		if($_GET['status'] == '1'){
			$where['status']=1;
		}
		if($_GET['status'] == '2'){
			$where['status']=2;
		}
		if($_GET['status'] == '0'){
			$where['status']=0;
		}
	//搜索
		if(IS_POST){
			if($_POST['username'] != ''){
				$username=$_POST['username'];
				$where['user_name']=array('like',array("%$username","%$username%","$username%"),'or');
				
			}
			if($_POST['book_name'] != ''){
				$book_name=$_POST['book_name'];
				$where['book_name']=array('like',array("%$book_name","%$book_name%","$book_name%"),'or');
				
			}
			if($_POST['class_name'] != ''){
				
				$class_name=$_POST['class_name'];
				$where['name']=array('like',array("%$class_name","%$class_name%","$class_name%"),'or');
				$res=M('qybook_classify')->where($where)->select();
				
				if($res){
					foreach($res as $k=>$v){
						$ids[]=$v['id'];
					}
					$ids=implode(',',$ids);
					$where['book_id']=array('in',$ids);
				}
				unset($where['name']);
				
			}
			
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();		
			foreach($data as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$data[$k]['className']=$res['name'];//分类名
			}
			$this->assign('page',$page->show());
			$this->assign('info',$data);
		}else{
			
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();		
			foreach($data as $k=>$v){
				$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
				$data[$k]['className']=$res['name'];//分类名
			}
			$this->assign('page',$page->show());
			$this->assign('info',$data);
		}
		$this->display();
	}
//借书详情
	public function msgsInfo(){
        $this->check();	
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('qybook_users')->where(array('id'=>$id))->find();	
		$fenlei=M('qybook_classify')->where(array('id'=>$data['book_id']))->find();
		$data['className']=$fenlei['name'];//分类名
		$this->assign('info',$data);
		$this->display();
	}
	

//提醒该用户---单条信息发送	
	public function call(){
        $this->check();	
		if(IS_POST){
			$user_id=session('user_id');
			$id=intval($_POST['id']);
			$data=M('qybook_users')->where(array('id'=>$id))->find();
			$app=M('qymyapp')->where(array('module'=>'Borrow_books','userid'=>$user_id))->find();
			$head=M('Qyusers')->where(array('userid'=>$data['wecha_id'],'user_id'=>$user_id))->field('userid,user_id')->find();
			
			$Msg=A('Qyapp/Msg');
			$inin['touser']=$head['userid'];
			$inin['title']="您借的<".$data['book_name'].">快要到期啦";
			$inin['description']="请您尽快归还、点此查看详情";
			$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Borrow_books&a=wap_my&token='.$app['token']."&wecha_id=".$data['wecha_id'];
			$inin["agentid"]=$app['appid'];
			$msg=$Msg->msg_send_all($inin,$app['userid']);
			if($msg['errcode']==0){
				$this->ajaxReturn("1");
			}else{
				$this->ajaxReturn("0");
			}
		}
	}
//启用与禁用	
	public function ables(){
        $this->check();	
		if(IS_POST){
			$id=intval($_POST['id']);
			$status=intval($_POST['status']);
			$i=M('qybook_users')->where(array('id'=>$id))->setField('status',$status);
			if($i){
				$this->ajaxReturn("1");
	//启用与禁用通知该用户
	/*
				$user_id=session('user_id');
				$data=M('qybook_users')->where(array('id'=>$id))->find();
				$app=M('qymyapp')->where(array('token'=>$data['token']))->field('appid,userid')->find();
				$head=M('Qyusers')->where(array('userid'=>$data['wecha_id'],'user_id'=>$user_id))->field('userid,user_id')->find();
				
				$Msg=A('Qyapp/Msg');
				$inin['touser']=$head['userid'];
				$inin['title']="管理员通过您的请求啦";
				$inin['description']="查看详情请点击此处";
				$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Borrow_books&a=wap_borrowList_my&token='.$data['token']."&wecha_id=".$data['wecha_id']."&id=".$id;
				$inin["agentid"]=$app['appid'];
				$msg=$Msg->msg_send_all($inin,$app['userid']);
				//print_r($msg);exit;
				if($msg['errcode']==0){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("2");
				}
		*/
			}else{
				$this->ajaxReturn("0");
			}
		}
	}
	
//审核操作	
	public function look(){
        $this->check();	
		if(IS_POST){
			$id=intval($_POST['id']);
			$status=intval($_POST['status']);
			if($status == 1){
				$tt=M('qybook_users')->where(array('id'=>$id))->find();
				$time=time();
				$i=M('qybook_users')->where(array('id'=>$id))->setField(array('status'=>$status,'tg_time'=>$time));
				if($i){
			//审核通过后通知该用户
					$m = M('qybook_room')->where(array('id'=>$tt['room_id']))->setDec('number',1);
					$user_id=session('user_id');
					$app=M('qymyapp')->where(array('module'=>'Borrow_books','userid'=>$user_id))->find();
					$head=M('Qyusers')->where(array('userid'=>$tt['wecha_id'],'user_id'=>$user_id))->field('userid,user_id')->find();
					
					$Msg=A('Qyapp/Msg');
					$inin['touser']=$head['userid'];
					$inin['title']="管理员通过您的请求啦";
					$inin['description']="查看详情请点击此处";
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Borrow_books&a=wap_my&token='.$app['token']."&wecha_id=".$head['userid'];
					$inin["agentid"]=$app['appid'];
					$msg=$Msg->msg_send_all($inin,$app['userid']);
					if($msg['errcode']==0){
						$this->ajaxReturn(1);
					}else{
						$this->ajaxReturn(2);
					}
				}else{
					$this->ajaxReturn(0);
				}
			}
			if($status == 2){
				$tt=M('qybook_users')->where(array('id'=>$id))->find();
				$i=M('qybook_users')->where(array('id'=>$id))->setField(array('status'=>$status));
				if($i){
				//审核未通过通知该用户
					$user_id=session('user_id');
					$app=M('qymyapp')->where(array('module'=>'Borrow_books','userid'=>$user_id))->find();
					$head=M('Qyusers')->where(array('userid'=>$tt['wecha_id'],'user_id'=>$user_id))->field('userid,user_id')->find();
					$m = M('qybook_room')->where(array('id'=>$tt['room_id']))->find();
					$Msg=A('Qyapp/Msg');
					$inin['touser']=$head['userid'];
					$inin['title']="管理员未通过您的请求";
					if($m['number']<=0){
						$inin['description']=$m['book_name'].'库存量不足';
					}else{
						$inin['description'] = '查看详情请点击此处';
					}
					$inin['url']="http://". $_SERVER['SERVER_NAME'].'/index.php?g=Qyapp&m=Borrow_books&a=wap_my&token='.$app['token']."&wecha_id=".$head['userid'];
					$inin["agentid"]=$app['appid'];
					$msg=$Msg->msg_send_all($inin,$app['userid']);
					if($msg['errcode']==0){
						$this->ajaxReturn(1);
					}else{
						$this->ajaxReturn(2);
					}
				}else{
					$this->ajaxReturn(0);
				}
			}
			
				
		
		}
	}
//导出数据export
	public function export(){
		header("Content-Type: text/html; charset=utf-8");
		header("Content-type:application/vnd.ms-execl");
		header("Content-Disposition:filename=借书管理数据--".date("Y-m-d",time()).".xls");
		header("Pragma: no-cache"); 
        header("Expires: 0");
		//   以下\t代表横向跨越一格，\n 代表跳到下一行，可以根据自己的要求，增加相应的输出相，要和循环中的对应哈
		//字段
		$letterArr=explode(',',strtoupper('a,b,c,d,e,f,g'));
		$arr=array(
			array('en'=>'id','cn'=>'序号'),
			array('en'=>'book_name','cn'=>'书籍名称'),
			array('en'=>'className','cn'=>'书籍分类'),
			array('en'=>'start_time','cn'=>'借阅日'),
			array('en'=>'return_time','cn'=>'归还日'),
			array('en'=>'user_name','cn'=>'借阅人'),
			array('en'=>'status','cn'=>'审核状态'),
		);
		$chengItem=array('piaomianjia','shuifei','yingshoujine','yingfupiaomianjia','yingfushuifei','yingfujine','dailishouru','fandian','jichangjianshefei','ranyoufei');

		$i=0;
		$fieldCount=count($arr);
		$s=0;
		foreach ($arr as $f){
			if ($s<$fieldCount-1){
				echo iconv('utf-8','gbk',$f['cn'])."\t";
			}else {
				echo iconv('utf-8','gbk',$f['cn'])."\n";
			}
			$s++;
		}
		$user_id = $_SESSION['user_id'];
		$db =M('qybook_users');	
		$members   = $db->where(array('user_id'=>$user_id))->select();
		foreach($members as $k=>$v){
			$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
			$members[$k]['className']=$res['name'];
			
		}
		
		if($members){
			foreach ($members as $sn){
				$j=0;	
				foreach ($arr as $field){
					$fieldValue=$sn[$field['en']];
					switch ($field['en']){
						default:
							break;
						case 'id':
							break;
						case 'book_name':
							break;
						case 'className':
							break;
						case 'start_time':
							break;
						case 'return_time':
							break;
						case 'user_name':
							break;
						case 'status':
							if($fieldValue == 1){
								$fieldValue='已审核';
								$fieldValue=iconv('utf-8','gbk',$fieldValue);
							}else if($fieldValue == 0) {
								$fieldValue='未审核';
								$fieldValue=iconv('utf-8','gbk',$fieldValue);
							}else{
								$fieldValue='未通过';
								$fieldValue=iconv('utf-8','gbk',$fieldValue);
							}
							break;
					}
					if ($j<$fieldCount-1){
						echo $fieldValue."\t";
					}else {
						echo $fieldValue."\n";
					}
					$j++;
				}
				$i++;
			}
		}
		exit();
	}
//导入数据import
	public function import(){
		if ( $_FILES['expot']['error'] == 0){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','xls');// 设置附件上传类型
			$upload->savePath =  './Uploads/execl/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{
			// 上传成功 获取上传文件信息、以及导入数据
				$info =  $upload->getUploadFileInfo();
			
				$info=$info[0];
				$path=$info['savepath'] . $info['savename'];
				vendor('Classes.PHPExcel');
				
				require_once './Extend/Vendor/Classes/PHPExcel.php';
				require_once './Extend/Vendor/Classes/PHPExcel/IOFactory.php';
				require_once './Extend/Vendor/Classes/PHPExcel/Reader/Excel5.php';

				$objPHPExcel = PHPExcel_IOFactory::load("$path");
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				
				$arr_result=array();
				$strs=array();
				for($j=2;$j<=$highestRow;$j++)
				{ 
					unset($arr_result);
					unset($strs);
					for($k='A';$k<= $highestColumn;$k++)
					{
					 //读取单元格
						$arr_result  .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().",";
					}
					$strsaa= rtrim($arr_result,",");
					$strs=explode(",",$strsaa);
					//$strss=explode(",",$arr_result);
					//$strsa= rtrim($strss,",");
					$nameaa=$strs[3];
					$user_id=session('user_id');
					$is_class=M('qybook_classify')->where(array('name'=>$nameaa,'user_id'=>$user_id))->find();
					
					if($is_class){
						$cid=$is_class['id'];
					}else{
						$calss['name']=$strs[3];
						$calss['user_id']=session('user_id');
						$calss['pid']=0;
						$calss['status']=1;
						$calss['sorts']=1;
						$cid=M('qybook_classify')->add($calss);
					}
					if($cid != ''){
						$room['book_name']=$strs[0];
						$room['writer']=$strs[1];
						$room['number']=$strs[2];
						$room['book_No']=$strs[4];
						$room['book_press']=$strs[5];
						$room['description']=$strs[6];
						$room['book_date']=$strs[7];
						$room['book_id']=$cid;
						$room['user_id']=session('user_id');
						$room['add_time']=time();
						
						$id_add=M('qybook_room')->add($room);
						if($id_add){
							$this->success('成功导入',U('Borrow_books/room',array('mid'=>$_GET['mid'])));
							unlink($path);//删除上传的文件
						}else{
							$this->error('导入失败,请检查是否正确');
						}
					}
				}
			}
		}else{
			$this->error("您还没上传文件呢");
		}
	}
	
//读者留言管理
	public function message(){
        $this->check();	
		$db=M('qybook_message');
		$where['user_id']=session('user_id');	
		
		if(IS_POST){
			if($_POST['username'] !=''){
				$username=$_POST['username'];
				$where['user_name']=array('like',array("%$username","%$username%","$username%"),'or');
			}
			if($_POST['tel'] != ''){
				$where['tel']=$_POST['tel'];
			}
		}
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();		
				
		$this->assign('page',$page->show());
		$this->assign('info',$data);
		$this->display();
	}
//读者留言详情
	public function message_info(){
        $this->check();	
		$id = $this->_GET('id');
		$user_id = $_SESSION['user_id'];
		$data=M('qybook_message')->where(array('id'=>$id,'user_id'=>$user_id))->find();	
		$this->assign('info',$data);
		$this->display();
	}
//删除读者留言
	public function message_Del(){
        $this->check();	
		$id=intval($_POST['id']);
		$i=M('qybook_message')->where(array('id'=>$id))->delete();
		if($i){
			$this->ajaxReturn("1");
		}else{
			$this->ajaxReturn("0");
		}
	}
/********************************手机端*****************************************/
//首页
	public function wap_index(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_index');
			exit();
		}
		$list = M('Qybook_classify')->where(array('user_id'=>$app['userid']))->select();
			// print_r($list);exit;
		$this->assign('list',$list);
			
		$this->display();
	}
	//分类书目书籍
	public function wap_list(){
	
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		$id = $_GET['id'];//得到分类ID
		$class = M('Qybook_classify')->where(array('id'=>$id))->field('id,name')->find();
		$list = M('Qybook_room')->where(array('user_id'=>$app['userid'],'book_id'=>$id))->select();
		foreach($list as $k=>$v){
			//$name = M('Qybook_classify')->where(array('id'=>$id))->field('id,name')->find();
			//$list[$k]['class'] = $name['name'];
			$list[$k]['description'] = mb_substr($v['description'],0,15,'utf8').'...';
		}
		$this->assign('class',$class);
		$this->assign('list',$list);
		$this->assign('name',$name);

		$this->display();
	}
	//申请借书	
	public function wap_book_info(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_book_info');
			exit();
		}
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();	
		$gid=intval($_GET['id']);
		$info=M("qybook_room")->where(array('id'=>$gid))->find();
		$this->assign('info',$info);
		$this->display();
	}
	
	public function wap_borrow(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		$start_time=strtotime($_POST['start_time']);
		$id = $_POST['id'];
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->field('id,name')->find();
		$info=M("qybook_room")->where(array('id'=>$id))->find();	
		if($start_time&&$id){
				$db=M('qybook_users');
				$data['add_time']=time();
				$data['room_id']=$id;
				$data['wecha_id']=$_GET['wecha_id'];
				$data['user_id']=$app['userid'];
				$data['user_name']=$userinfo['name'];
				$data['book_name']=$info['book_name'];
				$data['start_time']=$start_time;
				$result = M('qybook_users')->where(array('room_id'=>$id,'wecha_id'=>$_GET['wecha_id'],'user_id'=>$app['userid'],'is_return'=>0))->find();//1表示已借阅该书并且未归还
				if($result){
					$this->ajaxReturn(1);//已借阅该书
				}else{
					$id=M('qybook_users')->add($data);
					if($id){
						$this->ajaxReturn(2);//借阅成功
					}else{
						$this->ajaxReturn(3);//借阅失败
				}
			}
		}else{
			$this->ajaxReturn(4);
		}
	}
	
	//我的借阅
	public function wap_my(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_my');
			exit();
		}
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();
		$where['user_id']=$app['userid'];
		$where['wecha_id']=$_GET['wecha_id'];
		//$where['status']=1;//通过审核
		$count==M('qybook_users')->where($where)->count();
		$page=new Page($count,10);
		$borrow_bookinfo=M('qybook_users')->order("start_time")->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		foreach($borrow_bookinfo as $k=>$v){
			$book = M('Qybook_room')->where(array('id'=>$v['room_id']))->find();
			$res=M('qybook_classify')->where(array('id'=>$book['book_id']))->find();
			$borrow_bookinfo[$k]['className']=$res['name'];//分类名
			$borrow_bookinfo[$k]['name'] = $book['book_name'];
		}
		$this->assign("list",$borrow_bookinfo);
		$this->assign('page',$page->show());
		$this->display();
	}
	//全部图书
	public function wap_all(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_all');
			exit();
		}
		$list = M('Qybook_room')->where(array('user_id'=>$app['userid']))->select();
		foreach($list as $k=>$v){
			$name = M('Qybook_classify')->where(array('id'=>$v['book_id']))->field('id,name')->find();
			$list[$k]['class'] = $name['name'];
			$list[$k]['description'] = mb_substr($v['description'],0,15,'utf8').'...';
		}
		$this->assign('list',$list);
		$this->display();
	}
	//图书续借
	public function wap_reader_xu(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_reader_xu');
			exit();
		}
		if(IS_POST){
			$id = $_POST['id'];
			$time = strtotime($_POST['return_time']);
			$data = M('qybook_users')->where(array('id'=>$id))->find();
			if($data){
				if($time<$data['start_time']){
					$this->ajaxReturn(1);//续借时间不能小于开始时间
				}else{
					if($data['status']==1){
						$status = M('qybook_users')->where(array('id'=>$id))->setField(array('status'=>0,'xu_time'=>$time));
						if($status){
							$this->ajaxReturn(2);//续借成功等待管理员审核
						}else{
							$this->ajaxReturn(3);//续借失败
						}
					}else{
						$status = M('qybook_users')->where(array('id'=>$id))->setField(array('xu_time'=>$time));
						if($status){
							$this->ajaxReturn(2);//续借成功等待管理员审核
						}else{
							$this->ajaxReturn(3);//续借失败
						}
					}
				}
			}else{
				$this->ajaxReturn(4);//你还未借阅该书
			}
			
		}
		$id=$_GET['id'];
		$info=M('qybook_users')->where(array('id'=>$id))->find();
		$result = M('qybook_room')->where(array('id'=>$info['room_id']))->find();
		$this->assign('info',$info);
		$this->assign('data',$result);
		$this->display();		
	}
	//书目检索	
	public function wap_bookList_Search(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		
		$fenlei=M('qybook_classify')->where(array('user_id'=>$app['userid']))->select();
		$this->assign('fenlei',$fenlei);
		$this->display();
	}
	
//读者留言
	public function wap_message(){
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_message');
			exit();
		}
		$username=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();
		$userinfo=M('qybook_userinfo')->where(array('wecha_id'=>$_GET['wecha_id']))->find();
		$userinfo['name']=$username['name'];
		if(IS_POST){
			if($_POST['email'] == ''){
				$_POST['email']=$userinfo['email'];
			}
			if($_POST['tel'] == ''){
				$_POST['tel']=$userinfo['tel'];
			}
			$_POST['user_id']=$app['userid'];
			$_POST['wecha_id']=$_GET['wecha_id'];
			$_POST['token']=$_GET['token'];
			$_POST['user_name']=$userinfo['name'];
			$_POST['add_time']=time();
			
			$id=M('qybook_message')->add($_POST);
			if($id){
				$this->ajaxReturn("1");
			}else{
				$this->ajaxReturn("0");
			}
		}
		
		$this->assign("userinfo",$userinfo);
		$this->display();
	}
//服务指南
	public function wap_service_Guide(){
	
	}
//个人资料	
	public function wap_personal_data(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();
		$where['wecha_id']=$_GET['wecha_id'];
		$where['user_id']=$app['userid'];
		$data=M('qybook_userinfo')->where($where)->find();
		
		if(IS_POST){	
			if(intval($_POST['id']) != ''){
				$where['id']=$_POST['id'];
				$save=M('qybook_userinfo')->where($where)->save($_POST);
				if($save){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("0");
				}
			}else{
				$_POST['user_id']=$app['userid'];
				$_POST['wecha_id']=$_GET['wecha_id'];
				$_POST['token']=$_GET['token'];
				$_POST['add_time']=time();
				$_POST['user_name']=$userinfo['name'];
				$id=M('qybook_userinfo')->add($_POST);
				if($id){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("0");
				}
			}	
			/* if($data){
				$id=M('qybook_userinfo')->where($where)->save($_POST);
				if($id){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("0");
				}
			}else{
				$_POST['user_id']=$app['userid'];
				$_POST['wecha_id']=$_GET['wecha_id'];
				$_POST['token']=$_GET['token'];
				$_POST['add_time']=time();
				$_POST['user_name']=$userinfo['name'];
				$id=M('qybook_userinfo')->add($_POST);
				if($id){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("0");
				}
			} */
		}
		//dump($userinfo);die;
		F('userinfo',$userinfo);
		$this->assign('data',$data);	
		$this->assign('userinfo',$userinfo); 
		$this->display();
		
	}

//常见问题	
	public function wap_problem(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		$this->display();
	}

//读者借阅信息	----通过了才算
	public function wap_borrowList(){
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();
		
		$where['user_id']=$app['userid'];
		$where['wecha_id']=$_GET['wecha_id'];
		$where['status']=1;//通过审核
		$count==M('qybook_users')->where($where)->count();
		$page=new Page($count,10);
		$borrow_bookinfo=M('qybook_users')->order("id desc")->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		foreach($borrow_bookinfo as $k=>$v){
			$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
			$borrow_bookinfo[$k]['className']=$res['name'];//分类名
		}
		$this->assign("borrow_bookinfo",$borrow_bookinfo);
		$this->assign('page',$page->show());
		$this->display();
	}
//读者借阅信息	----通过了才算
	public function wap_borrowList_my(){
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		
		$where['id']=$_GET['id'];
		$borrow_bookinfo=M('qybook_users')->where($where)->find();
		if($borrow_bookinfo){
			$res=M('qybook_room')->where(array('book_name'=>$borrow_bookinfo['book_name'],'book_id'=>$borrow_bookinfo['book_id'],'user_id'=>$borrow_bookinfo['user_id']))->find();
			$borrow_bookinfo['writer']=$res['writer'];
			$borrow_bookinfo['book_press']=$res['book_press'];
			$borrow_bookinfo['book_date']=$res['book_date'];
		}
		$this->assign("list",$borrow_bookinfo);
		$this->display();
	}	
	public function wap_book_roomList(){
		
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		
		$db=M("qybook_room");
		if(IS_GET){
		//按书籍名称搜索
			if($_GET['search_v'] == 1){
				$book_name=$_GET['keyword'];
				$where['book_name'] = array('like',array("%$book_name%","%$book_name","$book_name%"),'or');
			}
		//按作者姓名搜索
			if($_GET['search_v'] == 3){
				//$where['writer']=$_POST['keyword'];
				$writer=$_GET['keyword'];
				$where['writer'] = array('like',array("%$writer%","%$writer","$writer%"),'or');
			}
		//按出版社搜索
			if($_GET['search_v'] == 2){
				//$where['book_press']=$_POST['keyword'];
				$book_press=$_GET['keyword'];
				$where['book_press'] = array('like',array("%$book_press%","%$book_press","$book_press%"),'or');
			}
		//按书籍分类搜索
			if($_GET['search_v'] == 4){
				$where['book_id']=$_GET['keyword'];
			}
		}
		$where['user_id']=$app['userid'];
		$count=$db->where($where)->count();
		$page=new Page($count,10);
		$data=$db->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		foreach($data as $k=>$v){
			$res=M('qybook_classify')->where(array('id'=>$v['book_id']))->find();
			$data[$k]['className']=$res['name'];//分类名
		}
		$this->assign('page',$page->show());  
		$this->assign('data',$data);
		
		$this->display();
	}

	
/******************************-----------------保留着******************************************/////	
//修改密码	
	public function wap_change_Password(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		if($_GET['login_status'] != 1){
			$this->redirect(U('Borrow_books/wap_login',array('wecha_id'=>$_GET['wecha_id'],'token'=>$_GET['token'])));
		}else{
			//用户信息、部门查询	
			$userinfo=M('Qyusers')->where(array('userid'=>$_GET['wecha_id']))->find();	
			$this->assign('userinfo',$userinfo); 
			if($_POST['password'] != ''){
				$psd=md5($_POST['password']);
				//$where['token']=$_GET['token'];
				$where['wecha_id']=$_GET['wecha_id'];
				$where['user_id']=$app['userid'];
				$data=M('qybook_login')->where($where)->find();
				if($psd == $data['password']){
					$this->ajaxReturn("1");
				}else{
					$this->ajaxReturn("0");
				}
			}
			$this->display();
		}
	}
	//用户绑定登陆	
	public function wap_login(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		if(IS_POST){
			$db=M('qybook_login');
			$where['user_id']=$app['userid'];
			$where['username']=$_POST['username'];
			$where['password']=md5($_POST['password']);
			$data=$db->where($where)->find();
			if($data){
				$data['msg']=1;
				$this->ajaxReturn($data);
			}else{
				$data['msg']=0;
				$this->ajaxReturn($data);
			}
		}
		$this->display();
	}
//用户注册绑定	
	public function wap_reg(){
		$app=M('qymyapp')->where(array('token'=>$_GET['token']))->field('userid')->find();
		if(!$_GET['wecha_id']){
			$data['token']=$_GET['token'];
			$data['module']='Borrow_books';
			$user=M('qytoken')->where(array('id'=>$app['userid']))->field('corpid')->find();
			$data['corpid']=$user['corpid'];
			$Oauth=A('Qyapp/Oauth');
			$Oauth->index($data,'wap_list');
			exit();
		}
		$db=M('qybook_login');
		if(IS_POST){
			
			$_POST['add_time']=time();
			$_POST['password']=md5($_POST['password']);
			$_POST['wecha_id']=$_GET['wecha_id'];
			$_POST['user_id']=$app['userid'];
			$_POST['token']=$_GET['token'];
			$id=$db->add($_POST);
			if($id){
				$i=$db->where(array('id'=>$id))->setField('login_status',1);
				if($i){
					$data=$db->where(array('id'=>$id))->find();
					$data['msg']=1;
					$this->ajaxReturn($data);
				}else{
					$this->ajaxReturn("2");
				}
			}else{
				$this->ajaxReturn("0");
			}
		}
	}
	
}
?>