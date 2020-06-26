<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db = $this->load->database('default', TRUE);
    }

    function check_menu_kiri($field1)
    {
        $sqlmenu = "SELECT menu, a.description FROM master_menu a, user_menu b WHERE a.id = b.menuid AND b.userid = '".$field1."';";
	    $querymenu = $this->db->query($sqlmenu);
	    return $querymenu;
		//return $querymenu->row_array();
    }
}
