<?php
class IndexAction extends BaseAction{
	//前台首页
	public function index()
	{
		$news = M('News','tp_','mysql://root:lanrain456P@localhost/xingceshi'); 
		
		$arr=$news->select();
		$this->assign('arr',$arr);
		//echo "asfasf";
		//$arr=M('user')->where("username='admin'")->getField('templet');
		// $info='http://xingceshi.wxopen.cn/index.php/Admin/News/api';
		// $data=file_get_contents($info);
		// $arr=json_decode($data);
		// dump($arr);
		$this->display();
	}
	public function resetpwd()
	{
		$uid=$this->_get('uid','intval');
		$code=$this->_get('code','trim');
		$rtime=$this->_get('resettime','intval');
		$info=M('Users')->find($uid);
		if( (md5($info['uid'].$info['password'].$info['email'])!==$code) || ($rtime<time()) ){
			$this->error('非法操作',U('Index/index'));
		}
		$this->assign('uid',$uid);
		$this->display();
	}
}