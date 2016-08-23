<?php
class QytokenModel extends Model{

	//自动验证
	protected $_validate=array(
		array('username','require','用户名称必须填写！',1,'',3),
		array('password','require','用户密码必须填写！',0,'',3),
		array('cf_password','password','两次密码不一致',0,'confirm'), 
		array('username','','用户名称已经存在！',1,'unique',1), // 新增修改时候验证username字段是否唯一

	);
	
	protected $_auto = array (
		array('password','md5',self::MODEL_BOTH,'function'),
		array('cf_password','md5',self::MODEL_BOTH,'function'),

	);
	
	
	public function getgid(){
		return 1;
	}
}



