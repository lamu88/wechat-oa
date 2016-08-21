<?php
/**
 *网站路由配置
 *@package YiCms
 *@author YiCms
 **/
return array(
	/*路由设置*/
	'URL_MODEL' 			=>	0,				//URL访问模式
	'URL_ROUTER_ON'   		=> true, 			//开启路由
	'URL_HTML_SUFFIX'		=>'shtml',			//伪静态后缀
	'URL_ROUTE_RULES' 		=> array( 			//定义路由规则
		'api/:token'        => 'Home/Wxopen/index',
		'show/:token'        => 'Apps/Adma/wap_index',
		'qy/:token'        => 'Home/Qiye/index',
		'sui/:token'        => 'Home/Suite/index',
		'msg/:sid'        => 'Home/Suite/msg',
		'login/:code'     =>'Home/Login/code',
		
	),
);