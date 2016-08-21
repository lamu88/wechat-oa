<?php
/**
*遍历部门算法（获取参与此次活动的所有部门包括下级部门）
*
$getDepart=A('Qyapp/Department');
$departs=$getDepart->wap_department($_POST['depart'].'|',$_SESSION['user_id']);

查询案例
$user=M('Qyusers')->where(array('userid'=>$_GET['wecha_id'],'user_id'=>$app['userid']))->find();
$depart=explode(';',$user['pid']);
foreach($depart as $k=>$v){
	if($v){
		$arr[]='%|'.$v.'|%';
		
	}
}
$map['alldepart'] =array('like',$arr,'OR');
$map['user_id'] =$app['userid'];
$list = M('Announce_news')->where($map)->order('id desc')->limit(15)->select();
**/
class DepartmentAction extends Action{
public  $depart;
public function wap_department($data='',$user_id){
	//$data="2|3|1|";
	
	$dedata=explode('|',$data);
	unset($dedata[count($dedata)-1]);
	$i=0;
	//dump($dedata);exit;
	foreach($dedata as $v){
		$new[$i]['wxid']=$v;
		$i++;
		$user_id=$user_id;
		$row=M('Department')->where(array('user_id'=>$user_id))->field('wxid,name,wxpid')->select();
		$departs=$this->build_tree($v,$row);
	}
	//dump($this->depart.$data);exit;
	$depart=explode('|',$this->depart.$data);
	unset($depart[count($depart)-1]);
	$todepart.=implode('|',array_flip(array_flip($depart))).'|';
	return $todepart;
}

function build_tree($wxid,$rows,$data){
    $childs=$this->findChild($rows,$wxid);
    if(empty($childs)){
        return null;
    }
	foreach ($childs as $k => $v){
		  $str.=$data.$v['wxid'].'|';
	}
   foreach ($childs as $k => $v){
       $rescurTree=$this->build_tree($v['wxid'],$rows,$str);
       if( null !=   $rescurTree){ 
       $childs[$k]['childs']=$rescurTree;
       }
   }
   $this->depart.=$str;
    return true;
}
function findChild($arr,$id){
    $childs=array();
     foreach ($arr as $k => $v){
         if($v['wxpid']== $id){
            $childs[]=$v;
         }
    }
    return $childs;
}

}