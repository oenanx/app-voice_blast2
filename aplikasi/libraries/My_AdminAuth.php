<?php
 
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
 
/**
* Description of General
*
* @author fito@freelancer
*/
class My_AdminAuth {
 
//put your code here
var $ci;
 
 public function __construct() {
	$this->ci = &get_instance();
 }
  
 	public function check_login() {
		if ($this->stat_logged() === FALSE) {
			$this->ci->my_funclib->msg_html('warning', 'Your Session has been Expired!!!<br> Please Do Login...');
			redirect(base_url());
		}
	}
 
	public function stat_logged()
	{
	  //$is_logged_in = $this->session->userdata('logged_app');
	  if($this->ci->session->userdata('admin_logged') === FALSE){
			return FALSE;
		} else {
			return TRUE;
		}
	} 
	public function ajx_http(){
		if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] <> 'XMLHttpRequest' ) ){   // access only from  HTTP X ajax url
			redirect(site_url('admin'));
		}
	}
 
}
 
?>