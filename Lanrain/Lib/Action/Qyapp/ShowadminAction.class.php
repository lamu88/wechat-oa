<?php
/**
*权限管理
**/
class ShowadminAction extends Action{


public function _initialize() {
		if($_SESSION['username']==''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
		if($_SESSION['node_id']!=''){
		   $this->error('非法操作',U('Weiyi/Weiyi/login'));
		}
	}

public function index(){
	$this->display();
}

public function nlist(){
    $info=M('group')->where(array('uid'=>$_SESSION['user_id']))->select();
	$this->assign('info',$info);
	$this->assign('infos',$info);		
	$this->display();
}
/*  管理组信息管理  */
public function editgroup(){
 if(IS_POST){
   	  $id=$_GET['id'];
	  if($_POST['password']!=''){
		  $info=M('group')->where($id)->save();
	  }else{
		  $info=M('group')->where($id)->save(array('position'=>$_POST['position'],'group'=>$_POST['group']));
	  }
		  if($info){
			echo json_encode(array('status'=>1));//添加成功
		  }else{
			echo json_encode(array('status'=>2));//添加失败
		  }
   }else{
		$info=M('group')->where(array('id'=>$_GET['id']))->find();
		$this->assign('info',$info);
		$this->display();
	}
}

/*  添加管理组 */
public function addGroup(){
 if(IS_POST){
	  $name = trim($_POST['name']);
	  $info=M('group')->add(array('name'=>$name));
	  if($info){
		echo json_encode(array('status'=>1));//添加成功
	  }else{ 
		echo json_encode(array('status'=>2));//添加失败
	  }
   }else{
       $this->display();
   }
   
}

/*  删除应用  */
public function delgroup(){
	if(IS_POST){
		$data = M('group')->where(array('id'=>$_POST['id']))->find();
		if(M('group')->where(array('id'=>$data['id']))->delete()){
			echo json_encode(array('status'=>1));
		}
	}	
}

/*  应用权限  */
public function appgroup(){
	$node=M('qyapplist')->where(array('id'=>$_GET['id']))->select();
	$this->assign('info',$node);
	$this->display();
}
/*  应用详情  */
public function appInfo(){
	$id = $this->_get('id');
	$data = M('qyapplist')->where(array('id'=>$id))->find();
	$this->assign('data',$data);
	$this->display();	
}
/*  删除应用  */
public function delapp(){
	if(IS_POST){
		$data = M('group')->where(array('id'=>$_POST['id']))->find();
		if(M('group')->where(array('id'=>$data['id']))->delete()){
			echo json_encode(array('status'=>1));
		}
	}	
}
/*  通讯录权限管理  */
public function setuserrule(){
	  if(IS_POST){
	  $res=M('group_list')->where(array('uid'=>$_POST['id']))->save($_POST);
	  if($res){
	  	echo json_encode(array('status'=>0));//添加成功
	  }else{
	  	echo json_encode(array('status'=>1));//添加失败
	  }
   }else{
		$info=M('group_list')->where(array('uid'=>$_GET['id']))->find();
		if(!$info){
			$res=M('group_list')->add(array('uid'=>$_GET['id'],'setuserrule'=>0));
		}
		$this->assign('infos',$info);
		$node=M(group)->where(array('id'=>$_GET['id']))->find();
		$this->assign('info',$node);
		$this->display();
   }
	
}
/*组织架构权限管理*/
public function setorgrule(){
  if(IS_POST){
	  $res=M('group_list')->where(array('uid'=>$_POST['id']))->save($_POST);
	  if($res){
	  	echo json_encode(array('status'=>0));//添加成功
	  }else{
	  	echo json_encode(array('status'=>1));//添加失败
	  }
   }else{
			$info=M('group_list')->where(array('uid'=>$_GET['id']))->find();
			if(!$info){
				$res=M('group_list')->add(array('uid'=>$_GET['id'],'setorgrule'=>0));
			}
			$this->assign('infos',$info);
			$node=M(group)->where(array('id'=>$_GET['id']))->find();
			$this->assign('info',$node);
			$this->display();
   }
}

public function Group(){
	if(IS_POST){
        if($_POST['name'] == false || $_POST['group'] == false || $_POST['position'] == false){
			//echo json_encode(array('status'=>0));//帐号必须填写
			//exit;
	        $this->error('帐号必须填写');			
        }
		$_POST['uid']=$_SESSION['user_id'];
			$res=M('group')->where(array('name'=>$_POST['name']))->select();
			if(!$res){
			    $info=M('group')->add(array('name'=>$_POST['name'],'uid'=>$_POST['uid'],'pwd'=>md5($_POST['password']),'position'=>$_POST['position'],'group'=>$_POST['group']));
				if($info){
				   	//echo json_encode(array('status'=>1));//添加成功
					$this->success('添加成功',U('Showadmin/Group'));
				}else{
				  	//echo json_encode(array('status'=>2));//添加失败
					$this->error('添加失败');
				}
			}else{
				//echo json_encode(array('status'=>3));//添加失败
				$this->error('添加失败');				
			}
    }else{ 
		$info=M('group')->where(array('uid'=>$_SESSION['user_id']))->select();
		$this->assign('info',$info);
		$this->assign('infos',$info);		
		$this->display();		
	}
  }

/**
*赏金信息
**/	
public function adminInfo(){
    if($_SESSION['username']==''){
		$this->error('非法操作',U('Weiyi/Weiyi/login'));
	}
    $id = $this->_get('id');
	//M(group)->where(array('uid'=>$_SESSION['user_id']))->select();
    $data = M('group')->where(array('user_id'=>$_SESSION['user_id'],'id'=>$id))->find();
	//print_r($data);
	$this->assign('data',$data);
	$this->display();
}  
  
  
}