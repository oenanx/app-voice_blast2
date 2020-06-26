<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Description of General
*
* @author fito@atlasat
*/
class My_Auth {
 
//put your code here
var $ci;
 
 public function __construct() {
	$this->ci = &get_instance();
	$this->ci->load->library('My_MsgLib');
 }
	public function check_login() {
		if ($this->stat_logged() === FALSE) {
			$this->ci->my_msglib->msg_html('warning', 'Your Session has been Expired!!!<br> Please Do Login...');
			redirect(site_url());
		}
	}
 
	public function stat_logged()
	{
	  //$is_logged_in = $this->session->userdata('logged_app');
	  if($this->ci->session->userdata('is_logged') === FALSE){
			return FALSE;
		} else {
			return TRUE;
		}
	} 
	public function ajx_http(){
		if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] <> 'XMLHttpRequest' ) ){   // access only from  HTTP X ajax url
			$this->ci->my_msglib->msg_html('warning', 'You Dont have direct access!!!<br> Please Do Login...');
			redirect(base_url());
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */