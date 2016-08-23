<?php
/*
*Administrator
*2014-3-26
*/
class AppMenuModel extends Model
{		
	function getTokenMenu($token)	
	{
		$addons=A("Apps/Weiyi");
		$safe=$addons->safe();					
		$funs=M("TokenOpen")->where(array('token'=>$token))->field('queryname')->find();		
		
		if(empty($funs))
			return false;
													
		$menu=M("Function")->where(array(
			'funname'=>array('IN',$funs["queryname"]),
			'apptype'=>2
		))->field('app_id,name AS appName,funname AS action,eTime')->select();		
		
		if(empty($menu))
			return false;
		return $menu;
	}
	
	function keyMatch($token)
	{
		$TokenOpen=M("TokenOpen")->where(array(
			'token'=>$token			
		))->getField('queryname');
    
		if($TokenOpen)
		{			
			$TokenOpen=trim($TokenOpen.',Text,Img,ReplyInfo',',');	
			$addons_access=M("Function")->where(array(
				'eTime'=>array('gt',NOW_TIME),
				'app_type'=>array('lt',3),
				'funname'=>array("IN",$TokenOpen)
			))->field(array(
				'app_id',
				'eTime',
				'funname'=>'action',
				'keyword',
				'app_type'=>'type'
			))->select();
			
			$modules='';
			$appSel=array();
			foreach ($addons_access AS $v)
			{				
				if($v['type']==1)
				{
					$v['type']=2;
					$appSel[]=$v;				
				}
				else
				{
					$modules.=$v['action'].',';
					$app_id[$v['action']]=$v['app_id'];
				}						
			}
			$modules=$modules.'Img,Text,ReplyInfo';	
          
			$keyWord=M("Keyword")->where(array(
					'token'=>$token,
					'module'=>array("IN",$modules)
			))->field(array(
					'keyword',
					'module'=>'action',
					'type',
					'pid'
			))->select();	
            F("keyword",$keyWord);			
			if($keyWord)
			{					
				foreach ($keyWord AS $k=>$v)
				{					
					if($v["type"]==2)					
					{
						if(isset($app_id[$v['action']]))
							$v['app_id']=$app_id[$v['action']];
						array_unshift($appSel,$v);
					}
					else					
					{
						if(isset($app_id[$v['action']]))
							$v['app_id']=$app_id[$v['action']];
						$word[$v["keyword"]]=$v;
					}
				}
			}			
			$list['mhcx']=$appSel;
			$list["jqcx"]=$word;
			return $list;
		}else return false;		
	}
}
?>