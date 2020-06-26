<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_Product extends CI_Model
{
	var $table = 'product_master';
	//var $table2 = 'trx_pp_d';
	var $column_order = array('product_name','product_description','active'); //set column field database for datatable orderable
	var $column_search = array('product_name', 'product_description'); //set column field database for datatable searchable
	var $order = array('id' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->db2 = $this->load->database('b', TRUE);
	}
	
	private function _get_datatables_query()
	{
		$this->db->select('id,product_name,product_description,case when active = 1 THEN \'Active\' ELSE \'Inactive\' end as active');
		$this->db->from('product_master'); 
		//$this->db2->where('fstatus = 1 AND 1=1');
		$this->db->order_by('id', 'ASC');
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
		$this->db->select('id, product_name, product_description, active as factive, case when active = 1 THEN \'Active\' ELSE \'Inactive\' end as active');
		$this->db->from('product_master'); 
		$this->db->where('id',$id);
		$query = $this->db->get();

		//return $query->result_array();
		return $query->row();
		
	}

	public function cek_validasi($prod_name)
	{
		$select = "select count(*) as hasil from product_master where product_name = '".$prod_name."' ";
		$hasil = $this->db->query($select);
		return $hasil->result_array();
	}
	
 	public function Ins_Product($data)
	{
		//print_r($data);
		//exit;
		
		$this->load->helper('url');
		
		$loginid = $this->session->userdata('id');
		
		$prod_name = $data['prod_name'];
		$prod_desc = $data['prod_desc'];

		//id,product_name,product_description,active,create_by,create_at,update_by,update_at
		$sqlin = "INSERT INTO product_master VALUES (0,'".$prod_name."','".$prod_desc."',1,'".$loginid."',NOW(),'','1900-01-01 00:00:00');";
		$query = $this->db->query($sqlin);

		return $query;
	}

 	public function Update_Product($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

    function hapus($id){
        //$id=$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('product_master');
        return $result;
    }
}
?>