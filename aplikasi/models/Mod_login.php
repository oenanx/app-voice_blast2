<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_login extends CI_Model
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

/*
    public function upd($where,$data)
    {
        $id = $data['user'];
        $passold = $data['passo'];
        $passhashold = $data['passhashold'];
        $passnew = $data['passnew'];
        $passnew1 = $data['passnew1'];
        $hashed_passwordold = password_hash($passold, PASSWORD_DEFAULT);
        $hashed_passwordnew = password_hash($passnew, PASSWORD_DEFAULT);


        $update = "Update db_user.master_user set password = '$hashed_passwordnew', pword = '$passnew' where userid = '$id' AND password = '$passhashold' AND pword = '$passold'";
        $this->db->query($update);
        return $this->db->affected_rows();
    }
*/
}
?>