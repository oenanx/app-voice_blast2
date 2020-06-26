<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_User extends CI_Model
{
	var $table = 'account_user';
	var $column_order = array('user_name','full_name','company_name'); //set column field database for datatable orderable
	var $column_search = array('user_name','full_name','company_name'); //set column field database for datatable searchable
	var $order = array('id' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.id,user_name,full_name,company_id,company_name,account_group_id,group_name,a.active as factive,case when a.active = 1 THEN \'Active\' ELSE \'Inactive\' end as active');
		$this->db->from('account_user a,account_company b,account_group c'); 
		$this->db->where('a.company_id = b.id AND a.account_group_id = c.id AND a.active = 1 AND 1=1');
		$this->db->order_by('a.id', 'ASC');
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function cbcompany()
	{
		$sqlcpy = "SELECT id,company_name FROM account_company WHERE active = 1 ORDER BY id";
		$query = $this->db->query($sqlcpy);
		return $query;
	}

	public function srccompany()
	{
		$sqlsrc = "SELECT DISTINCT a.id,company_name FROM account_company a, account_user b WHERE a.id = b.company_id AND a.active = 1 AND b.id = ".$this->session->userdata('id')." ORDER BY company_name;";
		$query = $this->db->query($sqlsrc);
		return $query;
	}

	//public function cbsenderno()
	//{
		//$sqlgrp = "SELECT id,senderno FROM master_sender_no ORDER BY id";
		//$query = $this->db->query($sqlgrp);
		//return $query;
	//}

	public function cbgroup()
	{
		$sqlgrp = "SELECT id,group_name FROM account_group ORDER BY id";
		$query = $this->db->query($sqlgrp);
		return $query;
	}

	public function cbmenu()
	{
		$sqlgrp = "SELECT id,description FROM master_menu WHERE fmenu = 1 ORDER BY id;";
		$query = $this->db->query($sqlgrp);
		return $query;
	}

	public function cbmenu_user()
	{
		$sqlgrp = "SELECT x.id,x.description FROM master_menu x, user_menu y WHERE x.id = y.menuid AND y.userid = '".$this->session->userdata('user_id')."' ORDER BY id;";
		$query = $this->db->query($sqlgrp);
		return $query;
	}

	public function view_dtl($id)
	{
		$sqlQuery = "SELECT a.id,a.user_name,full_name,divisi_name,passwd,company_id,company_name,account_group_id,group_name,a.active as factive,case when a.active = 1 THEN 'Active' ELSE 'Inactive' end as active, (SELECT GROUP_CONCAT(y.description) FROM user_menu x, master_menu y WHERE x.menuid = y.id AND x.userid = a.user_name) as menus FROM account_user a,account_company b,account_group c WHERE a.company_id = b.id AND a.account_group_id = c.id AND a.active = 1 AND a.id = '".$id."';";
		$query = $this->db->query($sqlQuery);
		//return $query->result();
		return $query->row();		
	}

	public function view_mnu($id)
	{
		$sqlQuery = "SELECT x.id as menu_id,x.description FROM master_menu x, user_menu y WHERE x.id = y.menuid AND y.userid = (SELECT DISTINCT user_name FROM account_user WHERE id = '".$id."') ORDER BY x.id;";
		$query = $this->db->query($sqlQuery);
		return $query->result();
		//return $query;		
	}

	public function cek_validasi($user_name)
	{
		$select = "select count(*) as hasil from account_user where user_name = '".$user_name."' ";
		$hasil = $this->db->query($select);
		return $hasil->result_array();
	}
	
	public function cek_password($passwd,$confirm_passwd)
	{
		if ( $passwd == $confirm_passwd )
		{
			$select = "select 1 as hasil2;";
			$hasil2 = $this->db->query($select);
			return $hasil2->result_array();
		}
		else
		{
			$select = "select 0 as hasil2;";
			$hasil2 = $this->db->query($select);
			return $hasil2->result_array();
		}
	}
	
 	public function Ins_User($data)
	{
		//print_r($data);
		//exit;
		
		$this->load->helper('url');
		
		$loginid = $this->session->userdata('id');
		$userid = $this->session->userdata('user_id');
		
		$user_name = $data['user_name'];
		$full_name = $data['full_name'];
		$divisi_name = $data['divisi_name'];
		$passwd = $data['passwd'];
		$company_name = $data['company_name'];
		$group_name = $data['group_name'];
		$menus = $data['menus'];
		//$product = $data['product'];
		//$senderno = $data['senderno'];

		//id,user_name,full_name,divisi_name,passwd,company_id,account_group_id,active,create_by,create_at,update_by,update_at
		$sqlin = "INSERT INTO account_user VALUES (0,'".$user_name."','".$full_name."','".$divisi_name."','".$passwd."',".$company_name.",".$group_name.",1,'".$loginid."',NOW(),'','1900-01-01 00:00:00');";
		$query = $this->db->query($sqlin);
		
		foreach ($menus as $menuid) 
		{
			$sqlacc = "INSERT INTO user_menu VALUES (0,'".$user_name."',".$menuid.");";
			$this->db->query($sqlacc);
		}

		return $query;
	}

 	//public function Update_User($where, $data)
 	public function Update_User($data)
	{
		//print_r($data);
		//exit;
		
		//$this->db->update($this->table, $data, $where);
		//return $this->db->affected_rows();
		$this->load->helper('url');
		
		$loginid = $this->session->userdata('id');
		
		$id = $data['id'];
		$user_name = $data['user_name'];
		$full_name = $data['full_name'];
		$divisi_name = $data['divisi_name'];
		$passwd = $data['passwd'];
		$company_id = $data['company_id'];
		$account_group_id = $data['account_group_id'];
		$active = $data['active'];
		//$senderno_id = $data['senderno_id'];

		//id,user_name,full_name,divisi_name,passwd,company_id,account_group_id,active,create_by,create_at,update_by,update_at
		$sqlin = "UPDATE account_user SET user_name = '".$user_name."',full_name = '".$full_name."',divisi_name = '".$divisi_name."',passwd = '".$passwd."',company_id = '".$company_id."',account_group_id = '".$account_group_id."',active = ".$active.",update_by = '".$loginid."',update_at = NOW() WHERE id = ".$id.";";
		$query = $this->db->query($sqlin);

		return $query;
	}

    function hapus($id){
        //$id=$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('account_user');
        return $result;
    }
}
?>