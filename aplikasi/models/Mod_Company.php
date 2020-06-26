<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_Company extends CI_Model
{
	var $table = 'account_company';
	var $column_order = array('company_name','phone_fax','email_company'); //set column field database for datatable orderable
	var $column_search = array('company_name', 'phone_fax', 'email_company'); //set column field database for datatable searchable
	var $order = array('id' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->db2 = $this->load->database('b', TRUE);
	}

	public function cbsender()
	{
		$sqlcpy = "SELECT a.id,CONCAT(senderno,' - ',b.title) senderno FROM master_sender_no a, product_api b WHERE a.api_id = b.id AND a.fstatus = 1 ORDER BY a.id";
		$query = $this->db->query($sqlcpy);
		return $query;
	}

	private function _get_datatables_query()
	{
		$this->db->select('id,reg_no,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active as factive,case when active = 1 THEN \'Active\' ELSE \'Inactive\' end as active,start_date,end_date, count_current');
		$this->db->from('account_company'); 
		//$this->db->where('fstatus = 1 AND 1=1');
		$this->db->order_by('company_name', 'ASC');
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

	public function view_dtl($id)
	{
		//id,reg_no,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at
		$this->db->select('a.id,reg_no,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,a.api_id,c.title,a.senderno_id,b.senderno,a.active as factive,case when a.active = 1 THEN \'Active\' ELSE \'Inactive\' end as active,start_date,end_date,a.count_current');
		$this->db->from('account_company a, master_sender_no b, product_api c'); 
		$this->db->where('a.senderno_id = b.id AND a.api_id = c.id AND a.active = 1 AND 1=1');
		$this->db->where('a.id',$id);
		$query = $this->db->get();

		//return $query->result_array();
		return $query->row();
		
	}

	public function cek_validasi($cpy_name)
	{
		$select = "select count(*) as hasil from account_company where company_name = '".$cpy_name."' ";
		$hasil = $this->db->query($select);
		return $hasil->result_array();
	}
	
 	public function Ins_Company($data)
	{
		//print_r($data);
		//exit;
		
		$this->load->helper('url');
		
		$cpy_name 	= $data['cpy_name'];
		$ph_fax 	= $data['ph_fax'];
		$addr 		= $data['addr'];
		$addr_bill 	= $data['addr_bill'];
		$cpy_email 	= $data['cpy_email'];
		$bill_email = $data['bill_email'];
		$startdate 	= $data['startdate'];
		$enddate 	= $data['enddate'];
		$api_id 	= $data['api_id'];
		$senderno 	= $data['senderno'];
		$notes 		= $data['notes'];
		$loginid 	= $data['loginid'];
		$capacity	= $data['capacity'];

		//id,reg_no,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at,api_id,senderno_id,count_current
		$sqlin = "INSERT INTO account_company VALUES (0,LEFT(MD5(NOW()), 20),'".$cpy_name."','".$addr."','".$addr_bill."','".$ph_fax."','".$cpy_email."','".$bill_email."','".$notes."',1,'".$startdate."','".$enddate."','".$loginid."',NOW(),'','1900-01-01 00:00:00',".$api_id.",".$senderno.",".$capacity.");";
		$query = $this->db->query($sqlin);

		return $query;
	}

 	public function Update_Company($where, $data)
	{
		//print_r($data);
		//exit;
		
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

    function hapus($id){
        //$id=$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('account_company');
        return $result;
    }
}
?>