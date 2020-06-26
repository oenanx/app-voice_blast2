<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model
{
    //fungsi cek session
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db = $this->load->database('default', TRUE);
    }

    function logged_id()
    {
		if ($this->session->userdata('user_id') == "")
		{
			return FALSE;
		}
		else
		{
			return $this->session->userdata('user_id');
		}
    }

    //fungsi check login
    function check_login($field1, $field2)
    {
        //$sql = "SELECT DISTINCT a.userid, a.password,a.pword,a.realname, a.departemen departemen,a.email,a.sex,b.appid,c.appname from db_user.master_user a, db_user.user_app b, db_user.master_app c WHERE a.userid = b.userid AND b.appid = c.appid AND a.userid = '".$field1['userid']."' AND a.pword = '".$field2['pword']."';";
		$sql = "SELECT * FROM account_user WHERE user_name = '".$field1['userid']."' AND passwd = '".$field2['pword']."';";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return FALSE;
        } 
		else 
		{
            return $query->result();
        }
    }
}
?>