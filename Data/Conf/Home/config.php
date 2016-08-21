<?php
$arr=M('user')->where("username='admin'")->getField('templet');
return array(
	'TMPL_FILE_DEPR'=>'_',
	'DEFAULT_THEME'=>$arr,
);