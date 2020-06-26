<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Adm extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		//echo $this->session->userdata['session_id'];
		if (isset($this->session->userdata['logged_manager']))
		{
			redirect('administartor');
			
		}else{
			//$this->CI->load->library('url');
			redirect('manager/login');
			
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */