<?php
/**
*文件上传
**/
class UploadfileAction extends Action{
	function _initialize(){
        	
	}
	
	public function upload(){
	    $is_url = $_GET['is_url'];
	    $file_type = $_GET['file_type'];		
	    $config = M('qyagent_config')->where(array('user_id'=>$_SESSION['user_id']))->find();
		if($config['upload_type'] == 'upyun'){
		    $upload = A('Qyapp/Upyun');
			$upload->kindedtiropic();
		}elseif($config['upload_type'] == 'local'){
		    $upload = A('Qyapp/Adminupload');
			$upload->ajaxUpload($is_url,$file_type);
		}else{
		    $upload = A('Qyapp/Adminupload');
			$upload->ajaxUpload($is_url,$file_type);		
		}
	}	
	
	
}