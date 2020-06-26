<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_Menu extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db = $this->load->database('default', TRUE);
    }

    function check_menu_kiri($field1)
    {
		//$userid = $this->session->userdata('user_id');
		if ($field1 == "Admin" || $field1 == "admin")
		{
			$sqlmenu = "SELECT a.menu, a.description FROM master_menu a, group_menu b, account_user c WHERE a.id = b.menu_id AND b.group_id = c.account_group_id AND a.fmenu = 0 AND c.user_name = '".$field1."' ORDER BY a.id;";
			$querymenu = $this->db->query($sqlmenu);
			return $querymenu;
		}
		else
		{
			$sqlmenu = "SELECT a.menu, a.description FROM master_menu a, group_menu b, account_user c WHERE a.id = b.menu_id AND b.group_id = c.account_group_id AND a.fmenu = 1 AND c.user_name = '".$field1."' ORDER BY a.id;";
			$querymenu = $this->db->query($sqlmenu);
			return $querymenu;
		}
		//return $querymenu->row_array();
    }

    function check_menu_kanan($field2)
    {	// menu report
		//$userid2 = $this->session->userdata('user_id');
		
        $sqlmenu2 = "SELECT a.menu, a.description FROM master_menu a, group_menu b, account_user c WHERE a.id = b.menu_id AND b.group_id = c.account_group_id AND a.fmenu = 3 AND c.user_name = '".$field2."' ORDER BY a.id;";
	    $querymenu2 = $this->db->query($sqlmenu2);
	    return $querymenu2;
		//return $querymenu->row_array();
    }
}
