<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_MsgLib {
var $ci;
	
	public function __construct() {
	//utk constructor ci library
		$this->ci = &get_instance();
	}
	

	public function msg_txt($var=false, $msg_type=false){
		if($msg_type=='hijau'){
			$alert = '<font style="color:#33CC00;">'.$var.'</font>';
		}
		if($msg_type=='biru'){
			$alert = '<font style="color:#0033CC;">'.$var.'</font>';
		}
		if($msg_type=='merah'){
			$alert = '<font style="color:#FF0000;">'.$var.'</font>';
		}
		return $alert;
		
	}	
	
	public function msg_html($msg_type=false, $var=false){		
		
			$template = '<div class="alert alert-'.$msg_type.' alert-dismissable">';
            $template .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            $template .= $var;
			$template .= '</div>';
		
		$value = $this->ci->session->set_flashdata('notify_msg', $template);
		return $value;
	}
	
	  
} 
?>