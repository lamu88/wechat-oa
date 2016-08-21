<?php
/*
*用户登录
*
*/
class OrganicAction extends Action {
    //public $arr;
	public $arr = array();	
	public $ret = '';	
    /**
	*首页
	**/
	public function index(){
		if($_SESSION['node_id']){
			$node=M('Group_list')->where(array('uid'=>$_SESSION['node_id']))->find();
			if(!$node){
				$this->error('您权限未被开启',array('Index/index'));
			}else{
				$_SESSION['node']=$node;
			}
		}			
		$leader=M('department')->where(array('user_id'=>$_SESSION['user_id'],'wxpid'=>0))->find();
		$this->assign('leader',$leader);
		$data=M('department')->where(array('user_id'=>$_SESSION['user_id']))->select();	
		if($data){
			foreach($data as $k=>$v){
				$nodes[$v['wxid']] = $v;    
			}
		}
		//dump($nodes);exit;
		$this->arr = $nodes;	
		$str = '<ul>';
		$str .= $this->get_tree(0);	
		$str .= '</ul>';
		$this->assign('str',$str);
		//echo $str;exit;
		$this->assign('qyname',$_SESSION['qyname']);
		$this->display();        	    
	}
	
	function getTree($data,$pid)
	{
		$tree = '';
		foreach($data as $k => $v)
		{
		   if($v['wxpid'] == $pid)
		   {         
			$v['pid'] =$this->getTree($data, $v['id']);
			$tree[] = $v;
		   }
		}
		return $tree;
	}	

    /**
	* 得到子级数组
	* @param int
	* @return array
	*/
	public function get_child($myid){
		$a = $newarr = array();
		if(is_array($this->arr)){
			foreach($this->arr as $id => $a){
				if($a['wxpid'] == $myid) $newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}
	
	public function get_tree($myid, $str){
		
		$number=1;
		$child = $this->get_child($myid);
		if(is_array($child)){
		    $total = count($child);
			foreach($child as $id=>$value){
				$haschild = $this->get_child($id);
				
				if(!$value['leaderuserid']){
					$value['leaderuserid'] = '';
				}
				if(!$value['leadername']){
					$value['leadername'] = '未设置';
										    
				}	
				//if($value['wxpid'] == 0){
				//    if(!$value['leadername']){
				//	    $value['leadername'] = 'CEO'; 
				//	}   
				//}	
                if($myid == 0){
					if(is_array($haschild)){

						$this->ret .= '<li class="parent_li" style="margin-left:25px;position:relative;"><span>'.$value['name'].'（<a href="javascript:;" style="font-size:14px;font-weight:normal;text-decoration: none;">'.$value['leaderuserid'].'&nbsp;-&nbsp;'.$value['leadername'].'</a>）</span><ul>';
						$this->get_tree($id);
						$this->ret .= '</ul></li>';	
					
					}else{
						$this->ret .= '<li style="margin-left:25px"><span>'.$value['name'].'（<a href="javascript:;" style="font-size:14px;font-weight:normal;text-decoration: none;">'.$value['leaderuserid'].'&nbsp;-&nbsp;'.$value['leadername'].'</a>）</span></li>';
						//$this->ret .= '';
					}				
				}else{
					if(is_array($haschild)){

						$this->ret .= '<li class="parent_li" style="margin-left:25px;position:relative;"><span><i class="fa fa-minus-circle" style="position:absolute;top:19px;left:-14px;z-index:999;"></i>'.$value['name'].'（<a href="javascript:;" style="font-size:14px;font-weight:normal;text-decoration: none;">'.$value['leaderuserid'].'&nbsp;-&nbsp;'.$value['leadername'].'</a>）</span><ul>';
						$this->get_tree($id);
						$this->ret .= '</ul></li>';	
					
					}else{
						$this->ret .= '<li style="margin-left:25px"><span><i class="" style="padding-right:6px"></i>'.$value['name'].'（<a href="javascript:;" style="font-size:14px;font-weight:normal;text-decoration: none;">'.$value['leaderuserid'].'&nbsp;-&nbsp;'.$value['leadername'].'</a>）</span></li>';
						//$this->ret .= '';
					}				
				}				

				$number++;					

			}
		}
		
		return $this->ret;
	}	
	
	function procHtml($tree)
	{
		$html = '';
		foreach($tree as $t)
		{
			
			$pic=$t["node_pic"]; if(empty($pic)) $pic="./assets/images/avatar1.jpg";
		   if($t['pid'] == '')
		   {
			$html .= '<br><br><div class="nodes-item  node-first clearfix"> 
											<a href="javascript:;" class="pull-left no-tree-expand"></a>
											<div class="node-item  pull-left self" id="15849" data-pid="14908">
												<span class="pull-left"><img src="'.$pic.'"></span>
												<span class="pull-left m-name">'.$t["node_name"].'</span>
												<span class="pull-left m-depart"></span>
												<span class="pull-left m-profession">'.$t["position"].'</span>
												<span><i class="fa fa-plus text-muted js_tree_opera" id="b_'.$t["id"].'" onclick="btngroup('.$t["id"].',this);" ><b class="jiahao">+</b></i></span>
											</div></div>';
		   }
		   else
		   {
			$html .= '<br><br><div class="nodes-item  node-first clearfix">
											<a href="javascript:;" class="pull-left no-tree-expand"></a>
											<div class="node-item  pull-left self" id="15849" data-pid="14908">
												<span class="pull-left"><img src="'.$pic.'"></span>
												<span class="pull-left m-name">'.$t["node_name"].'</span>
												<span class="pull-left m-depart"></span>
												<span class="pull-left m-profession">'.$t["position"].'</span>
												<span><i class="fa fa-plus text-muted js_tree_opera" id="b_'.$t["id"].'" onclick="btngroup('.$t["id"].',this);" ><b class="jiahao">+</b></i></span>
											</div>';
			$html .= $this->procHtml($t['pid']);
			$html = $html."</div>";
		   }
		}
		return $html ? '<div class="nodes-items">'.$html.'</div>' : $html ;
	}
	//echo procHtml($tree);
	

	
	
	public function addfirst(){
		if(IS_POST){
			$check=M('Qy_node')->where(array('user_id'=>$_SESSION['user_id'],'node_user'=>$_POST['name']))->find();
			if($check){
				echo json_encode(array('status'=>3));exit();
			}
			
			if($_SESSION['node']['setorgrule']==0){
				//echo json_encode(array('status'=>4));exit();
			}
			
			$Member=A('Qyapp/Member');
			$memberinfo=json_decode($Member->memberInfo_get($_POST['name'],$_SESSION['user_id']),true);
			if(!$memberinfo['id']){
				echo json_encode(array('status'=>1));exit();
			}
			$id=M('Qy_node')->add(array('user_id'=>$_SESSION['user_id'],'pid'=>0,'node_user'=>$_POST['name'],'node_pic'=>$memberinfo['pic']));
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
			$this->display();
		}
		
	}
	
	
	public function addnext(){
		if(IS_POST){
			$check=M('Qy_node')->where(array('user_id'=>$_SESSION['user_id'],'node_user'=>$_POST['name']))->find();
			if($check){
				echo json_encode(array('status'=>3));exit();
			}
			if($_SESSION['node']['setorgrule']==0){
				//echo json_encode(array('status'=>4));exit();
			}
			$Member=A('Qyapp/Member');
			$memberinfo=json_decode($Member->memberInfo_get($_POST['name'],$_SESSION['user_id']),true);
			if(!$memberinfo['id']){
				echo json_encode(array('status'=>1));exit();
			}
			$id=M('Qy_node')->add(array('user_id'=>$_SESSION['user_id'],'pid'=>$_POST['pid'],'node_user'=>$_POST['name'],'node_pic'=>$memberinfo['pic']));
			if($id){
				echo json_encode(array('status'=>0));
			}else{
				echo json_encode(array('status'=>1));
			}
		}else{
			$this->display();
		}
	}
	
	public function addall(){
		if(IS_POST){
			if($_SESSION['node']['setorgrule']==0){
				echo json_encode(array('status'=>4));exit();
			}
			M('Qy_node')->add(array('user_id'=>$_SESSION['user_id'],'pid'=>0,'node_user'=>$_POST['name']));
		}
		$this->display();	
	}
	
}