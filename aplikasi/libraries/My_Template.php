<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_template {
			var $template_data = array();
	 
		public function set($name, $value)
		{
			 $this->template_data[$name] = $value;
		}
		
		public function load($template = '', $view = '' , $view_data = array(), $return = FALSE) {
        $this->CI =& get_instance();
        	$this->set('File_Page', $this->CI->load->view($view, $view_data, TRUE)); 
   			
      	  return $this->CI->load->view($template, $this->template_data, $return);
		}
}

?>
