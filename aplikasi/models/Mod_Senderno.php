<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_Senderno extends CI_Model
{
	var $table = 'master_sender_no';
	var $column_order = array('title','senderno','capacity'); //set column field database for datatable orderable
	var $column_search = array('title', 'senderno', 'description'); //set column field database for datatable searchable
	var $order = array('id' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->db2 = $this->load->database('b', TRUE);
	}

	public function cbproduct()
	{
		$sqlcpy = "SELECT id,title FROM product_api WHERE active = 1 ORDER BY id";
		$query = $this->db->query($sqlcpy);
		return $query;
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.id, a.api_id, b.title, a.senderno, a.capacity, a.description,a.ftrial as factive,case when a.ftrial = 1 THEN \'Live\' ELSE \'Trial\' end as active');
		$this->db->from('master_sender_no a, product_api b'); 
		$this->db->where('a.api_id = b.id AND b.active = 1 AND 1=1');
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

	public function view_dtl($id)
	{
		//id,reg_no,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at
		$this->db->select('a.id, a.api_id product_id, b.title product_name, a.senderno, a.capacity, a.description,a.fstatus as factive,a.ftrial as ftrial,case when a.ftrial = 1 THEN \'Live\' ELSE \'Trial\' END trial,case when a.fstatus = 1 THEN \'Active\' ELSE \'Inactive\' end as active');
		$this->db->from('master_sender_no a, product_api b'); 
		$this->db->where('a.api_id = b.id AND b.active = 1 AND 1=1');
		$this->db->where('a.id',$id);
		$query = $this->db->get();

		//return $query->result_array();
		return $query->row();
		
	}

	public function cek_validasi($senderno)
	{
		$select = "select count(*) as hasil from master_sender_no where senderno = '".$senderno."' ";
		$hasil = $this->db->query($select);
		return $hasil->result_array();
	}
	
 	public function Ins_Sender($data)
	{
		//print_r($data);
		//exit;
		
		$this->load->helper('url');
		
		$api_id 			= $data['api_id'];
		$senderno 			= $data['senderno'];
		$capacity 			= $data['capacity'];
		$description 		= $data['description'];
		$trial 				= $data['trial'];
		$loginid 			= $data['loginid'];

		//id,api_id,senderno,capacity,description,ftrial,fstatus,create_by,create_at,update_by,update_at
		$sqlin = "INSERT INTO master_sender_no (api_id,senderno,capacity,description,ftrial,fstatus,create_by,create_at,update_by,update_at) VALUES (".$api_id.",'".$senderno."',".$capacity.",'".$description."',".$trial.",1,'".$loginid."',NOW(),'','1900-01-01 00:00:00');";
		$query = $this->db->query($sqlin);

		return $query;
	}

 	public function Update_Sender($where, $data)
	{
		//print_r($data);
		//exit;
		
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

    function hapus($id){
        //$id=$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('master_sender_no');
        return $result;
    }
}
?>