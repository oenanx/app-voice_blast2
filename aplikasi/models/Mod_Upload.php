<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Upload extends CI_Model 
{	
	var $table = 'trx_product_h a, account_company b, product_master c';
	var $column_order = array('c.product_name','b.company_name','a.title','status_name'); //set column field database for datatable orderable
	var $column_search = array('c.product_name','b.company_name','a.title'); //set column field database for datatable searchable
	var $order = array('a.id' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query()
	{
		$this->db->select('a.id, a.product_id, c.title product_name, a.company_id, b.company_name, a.title, a.format_message, a.description, a.status_id as status_id, CASE WHEN a.status_id = 0 THEN \'OPEN\' WHEN a.status_id = 1 THEN \'START\' WHEN a.status_id = 2 THEN \'COMPLETE\' ELSE \'CANCELED\' END as status_name');
		$this->db->from('trx_product_h a, account_company b, product_api c'); 
		$this->db->where('a.company_id = b.id AND a.product_id = c.id AND 1=1');
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
	    $select1 = "SELECT a.id, a.company_id, b.company_name, a.product_id, c.title product_name, a.title, a.format_message, a.description, a.start_date, a.status_id as status_id, CASE WHEN a.status_id = 0 THEN 'OPEN' WHEN a.status_id = 1 THEN 'START' WHEN a.status_id = 2 THEN 'COMPLETE' ELSE 'CANCELED' END as status_name, d.batchid, d.start_datetime, d.end_datetime, d.active as factive, CASE WHEN d.active = 1 THEN 'Active' ELSE 'Inactive' END active FROM trx_product_h a, account_company b, product_api c, trx_schedule d  WHERE a.company_id = b.id AND a.product_id = c.id AND a.id = d.trx_product_h_id AND a.id = ".$id.";";
	    $query1 = $this->db->query($select1);
		//return $query1->result_array();
		return $query1->row();
	}

	public function get_by_view_header($id)
	{
	    $select1 = "SELECT a.id, a.product_id, c.title product_name, a.company_id, b.company_name, a.title, a.format_message, a.description, a.start_date, a.end_date, a.status_id as status_id, CASE WHEN a.status_id = 0 THEN 'OPEN' WHEN a.status_id = 1 THEN 'START' WHEN a.status_id = 2 THEN 'COMPLETE' ELSE 'CANCELED' END as status_name FROM trx_product_h a, account_company b, product_api c WHERE a.company_id = b.id AND a.product_id = c.id AND a.id = ".$id.";";
	    $query1 = $this->db->query($select1);
		//return $query1->result_array();
		return $query1->row();
	}

	public function get_by_view_detail($id)
	{
	    $select2 = "SELECT a.id, a.trx_schedule_id, d.company_name, e.title product_name, a.phone, a.`name`, a.overdue, a.amount FROM trx_product_d a, trx_schedule b, trx_product_h c, account_company d, product_api e WHERE a.trx_schedule_id = b.id AND a.trx_product_h_id = c.id AND c.company_id = d.id AND c.product_id = e.id AND c.id = ".$id.";";
	    $query2 = $this->db->query($select2);
	    return $query2->result_array();
	}

	public function get_by_view_schedule($id)
	{
	    $select3 = "SELECT a.id, c.title product_name, a.batchid, a.start_date as startdate, a.end_date as enddate, start_datetime, end_datetime, a.active as factive, CASE WHEN a.active = 1 THEN 'Active' ELSE 'Inactive' END active, (SELECT COUNT(trx_schedule_id) FROM trx_product_d WHERE trx_schedule_id = a.id AND trx_product_h_id = b.id) jml_data FROM trx_schedule a, trx_product_h b, product_api c WHERE a.trx_product_h_id = b.id AND b.product_id = c.id AND b.id = ".$id.";";
	    $query3 = $this->db->query($select3);
	    return $query3->result_array();
	}

 	public function Ins_trx_h($data)
	{
		$this->load->helper('url');
		
		$loginid = $this->session->userdata('id');

		$company_id 	 =  $data['company_id'];
		$product_id      =  $data['prod_id'];
		$title      	 =  $data['title'];
		$format_message  =  $data['form_message'];
		$description     =  $data['description'];
		$start_date      =  $data['startdate'];
		$end_date        =  $data['endate'];
		$call_retry		 =	$data['call_retry'];
		
		//id,company_id,product_id,title,format_message,description,start_date,end_date,call_retry,status_id,create_by,create_date,update_by,update_at
		$sqlin = "INSERT INTO trx_product_h (company_id,product_id,title,format_message,description,start_date,end_date,call_retry,status_id,create_by,create_date) VALUES (".$company_id.",".$product_id.",'".$title."','".$format_message."','".$description."','".$start_date."','".$end_date."',".$call_retry.",0,".$loginid.",NOW());";
		$query = $this->db->query($sqlin);

		//Ambil id trx_product_h
		$trx_product_h_id = $this->db->insert_id();

		return $trx_product_h_id;
	}

	public function Ins_sch($h_id,$data_sch)
	{
		/*exit();*/
		$this->load->helper('url');
		$trx_product_h_id = $h_id;
		$loginid = $this->session->userdata('id');
		//$ch = "SELECT CASE WHEN MAX(batchid) IS NULL THEN 1 ELSE MAX(batchid) + 1 END as batchid FROM trx_schedule WHERE trx_product_h_id = ".$trx_product_h_id.";";
		//$check = $this->db->query($ch);
		//foreach ($check->result() as $rowcek)
		//{
			//$batchid = $rowcek->batchid;
		//}

		$batchid = "";
		$ch = "select (UNIX_TIMESTAMP(NOW(3))*1000) as batchid;";
		$check = $this->db->query($ch);
		foreach ($check->result() as $rowcek)
		{
			$batchid = $rowcek->batchid;
		}

		$sqlin2 = "INSERT INTO trx_schedule (trx_product_h_id,batchid,start_date,end_date,start_datetime,end_datetime,active,create_by,create_at) VALUES (".$trx_product_h_id.",UNIX_TIMESTAMP(NOW(3))*1000,'".$data_sch['start_date']."','".$data_sch['end_date']."','".$data_sch['starttime']."','".$data_sch['endtime']."',".$data_sch['status1'].",".$loginid.",NOW());";
		$query2 = $this->db->query($sqlin2);

		$trx_sch_id = $this->db->insert_id();

		return $trx_sch_id;

	}

 	public function Ins_trx_d( $h_id,$sch_id,$upl)
	{

		$this->load->helper('url');
		$trx_product_h_id = $h_id;
		$loginid = $this->session->userdata('id');
		
		for($i = 0; $i < count($upl); $i++)
		{
			//Ambil id trx_schedule
			//$trx_schedule_id = $this->db->insert_id();
			$trx_schedule_id = $sch_id;

			$phone 		 = $upl[$i]['phone'];
			$name        = $upl[$i]['name'];
			//$overdue   	 = $upl[$i]['overdue'];
			//$amount    	 = $upl[$i]['amount'];
			$template	 = $upl[$i]['template'];
			
			//id,trx_product_h_id,trx_schedule_id,phone,name,message,status_calllback,last_call
			$sqlin3 = "INSERT INTO trx_product_d (trx_product_h_id,trx_schedule_id,phone,name,message) VALUES (".$trx_product_h_id.",".$trx_schedule_id.",'".$phone."','".$name."','".$template."');";
			$query3 = $this->db->query($sqlin3);
		}
		//exit();


		return $query3;

	}
}
?>