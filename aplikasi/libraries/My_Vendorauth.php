<?php
 
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
 
/**
* Description of General
*
* @author fito@vivere
*/
class My_Vendorauth {
 
//put your code here
var $ci;
 
 public function __construct() {
	//unutk butuh ci library
	$this->ci = &get_instance();
 }
  public function check_login() {
	if ($this->stat_logged() == FALSE) {

	    redirect(site_url('vendor/login'));
	}
 }
 
 public function stat_logged()
 {
	  if($this->ci->session->userdata('vendor_uid') == FALSE){
	 	 	return FALSE;
		} else {
			return TRUE;
		}
  } 
public function reprofile(){
		if($this->ci->session->userdata('vendor_uid') === TRUE){
	 	 	redirect(site_url('vendor/profile'));
	  } else {
			return FALSE;
		}
}

 
}
 
?>