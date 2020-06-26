<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Call extends CI_Model 
{	
	//var $table = 'tmp_api';
	var $table = 'trx_product_d';
	//var $column_order = array('id', 'batchid', 'phone', 'api', 'result'); //set column field database for datatable orderable
	var $column_order = array('batchid', 'phone', 'nama', 'start_call'); //set column field database for datatable orderable
	//var $column_search = array('phone','api','result'); //set column field database for datatable searchable
	var $column_search = array('batchid','phone','nama','callsid'); //set column field database for datatable searchable
	var $order = array('start_call' => 'asc' ); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function batchList($campaign_id)
	{
		$loginid = $this->session->userdata('id');
		$sqlcom = "SELECT DISTINCT a.batchid FROM trx_schedule a, trx_product_h b, account_user c WHERE a.trx_product_h_id = b.id AND b.company_id = c.company_id AND b.id = '".$campaign_id."' AND c.id = ".$loginid." ORDER BY a.batchid;";
		$query = $this->db->query($sqlcom);
		return $query;
	}	

	public function campaignList()
	{
		$loginid = $this->session->userdata('id');
		$sqlcom1 = "SELECT DISTINCT b.id, b.title FROM trx_product_h b, account_user c WHERE b.company_id = c.company_id AND c.id = ".$loginid." ORDER BY b.title;";
		$query1 = $this->db->query($sqlcom1);
		return $query1;
	}
	
	private function _get_datatables_query()
	{
		$loginid = $this->session->userdata('id');
		if($this->input->post('batches') == "")
        {
            $this->db->where('b.batchid', "");
        }
		else 
        {
            $this->db->where('b.batchid', $this->input->post('batches'));
        }
		$this->db->select('c.id, b.batchid, c.phone, c.name as nama, c.callsid, c.status_calllback, c.response, c.count_call, c.start_call, c.end_call, c.duration, c.count_retry');
		$this->db->from('trx_schedule b'); 
		$this->db->join('trx_product_h a', 'a.id = b.trx_product_h_id', 'inner');
		$this->db->join('trx_product_d c', 'b.id = c.trx_schedule_id AND b.trx_product_h_id = c.trx_product_h_id', 'inner');
		$this->db->join('account_user d', 'a.company_id = d.company_id', 'inner');
		$this->db->where('d.id', $loginid);
		//$this->db->where('company_id = (SELECT DISTINCT company_id FROM account_user WHERE id = ".$loginid.") AND 1=1');
		$this->db->order_by('c.start_call', 'ASC');
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


	
	private function _get_datatables_query_rpt()
	{
		$loginid = $this->session->userdata('id');
		$batches = $this->input->post('batches');
		$responses = $this->input->post('responses');
		$this->db->select('c.id, b.batchid, c.phone, c.name as nama, c.callsid, c.status_calllback, c.response, c.count_call, c.start_call, c.end_call, c.duration, c.count_retry');
		$this->db->from('trx_schedule b'); 
		$this->db->join('trx_product_h a', 'a.id = b.trx_product_h_id', 'inner');
		$this->db->join('trx_product_d c', 'b.id = c.trx_schedule_id AND b.trx_product_h_id = c.trx_product_h_id', 'inner');
		$this->db->join('account_user d', 'a.company_id = d.company_id', 'inner');
		//$this->db->where('d.id', $loginid, 'b.batchid', $this->input->post('batches'), 'c.response', $this->input->post('responses'));
		$this->db->where('DATE_FORMAT(c.start_call,\'%Y%m\') = DATE_FORMAT(curdate(),\'%Y%m\') AND 1=1');
		if($batches == "" && $responses == "" ||  $responses == "ALL")
        {
            $this->db->where('d.id', $loginid);
        }
		else if($batches !== "" && $responses == "")
        {
            //$this->db->where('d.id', $loginid, 'b.batchid', $batches);
			$this->db->where('d.id = "'.$loginid.'" AND b.batchid = "'.$batches.'" ');
        }
		else if($batches == "" && $responses !== "")
        {
            //$this->db->where('d.id', $loginid, 'c.response', $responses);
			$this->db->where('d.id = "'.$loginid.'" AND c.response = "'.$responses.'" ');
        }
		else
		{
			$this->db->where('d.id = "'.$loginid.'" AND c.response = "'.$responses.'" AND b.batchid = "'.$batches.'" ');			
		}
		$this->db->order_by('c.start_call', 'ASC');

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

	function get_datatables_rpt()
	{
		$this->_get_datatables_query_rpt();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_rpt()
	{
		$this->_get_datatables_query_rpt();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_rpt()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	
	private function _get_datatables_query_rpt_sum()
	{
		$loginid = $this->session->userdata('id');
		$campaign = $this->input->post('campaign');

		if($campaign !== "")
        {
			$this->db->select('y.title as Campaign_title, y.start_date, y.end_date, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) as Completed, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'BUSY\' and trx_product_h_id = y.id) as Busy, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'FAILED\' and trx_product_h_id = y.id) as Failed, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'canceled\' and trx_product_h_id = y.id) as Canceled, CASE WHEN (SELECT SUM(duration) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) IS NULL THEN 0 ELSE (SELECT SUM(duration) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) END as Dur_Completed');
			$this->db->from('trx_product_d x'); 
			$this->db->join('trx_product_h y', 'y.id = x.trx_product_h_id', 'inner');
			$this->db->where('1=1');
			//$this->db->where('DATE_FORMAT(x.start_call,\'%Y%m\') = DATE_FORMAT(curdate(),\'%Y%m\')');
			if($campaign == "All")
			{
				$this->db->where('DATE_FORMAT(x.start_call,\'%Y%m\') = DATE_FORMAT(curdate(),\'%Y%m\')');
			}
			
			if($campaign !== "All")
			{
				$this->db->where('DATE_FORMAT(x.start_call,\'%Y%m\') = DATE_FORMAT(curdate(),\'%Y%m\') AND y.id = "'.$campaign.'" ');
			}
			$this->db->group_by('Campaign_title', 'start_date', 'end_date');
			$this->db->order_by('y.id', 'ASC');
		}
		else 
		{
			$this->db->select('y.title as Campaign_title, y.start_date, y.end_date, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) as Completed, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'BUSY\' and trx_product_h_id = y.id) as Busy, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'FAILED\' and trx_product_h_id = y.id) as Failed, (SELECT COUNT(response) FROM trx_product_d WHERE response = \'canceled\' and trx_product_h_id = y.id) as Canceled, CASE WHEN (SELECT SUM(duration) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) IS NULL THEN 0 ELSE (SELECT SUM(duration) FROM trx_product_d WHERE response = \'completed\' and trx_product_h_id = y.id) END as Dur_Completed');
			$this->db->from('trx_product_d x'); 
			$this->db->join('trx_product_h y', 'y.id = x.trx_product_h_id', 'inner');
			$this->db->where('DATE_FORMAT(x.start_call,\'%Y%m\') = DATE_FORMAT(curdate(),\'%Y%m\') AND y.id = "" ');
			$this->db->group_by('Campaign_title', 'start_date', 'end_date');
			$this->db->order_by('y.id', 'ASC');
		}
	
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

	function get_datatables_rpt_sum()
	{
		$this->_get_datatables_query_rpt_sum();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_rpt_sum()
	{
		$this->_get_datatables_query_rpt_sum();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_rpt_sum()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function update_startTime($data, $phone)
	{
		$update1 = "UPDATE trx_product_d SET start_call = NOW() WHERE phone = '".$phone."';";
	    $query1 = $this->db->query($update1);		
		return $query1;
	}

	public function result_per_id($data, $phone)
	{
		//$update = "UPDATE tmp_message SET result = '".$data."' WHERE phone = '".$phone."';";
		$update = "UPDATE tmp_api SET result = '".$data."' WHERE phone = '".$phone."';";
	    $query = $this->db->query($update);		

		$update1 = "UPDATE trx_product_d SET count_call = count_call + 1 WHERE phone = '".$phone."';";
	    $query1 = $this->db->query($update1);		
		//return $query1;
		
		$update2 = "UPDATE trx_product_d SET end_call = NOW() WHERE phone = '".$phone."';";
	    $query2 = $this->db->query($update2);		

		$update3 = "UPDATE trx_product_d SET duration = TIMESTAMPDIFF(SECOND,start_call,end_call) WHERE phone = '".$phone."';";
	    $query3 = $this->db->query($update3);		
		return $query3;
	}

	public function exec_per_id($batchid)
	{
		//print_r($batchid);
		//exit();
		$loginid = $this->session->userdata('id');
	    $selectx = "CALL exe_call($loginid, $batchid);";
	    $queryx = $this->db->query($selectx);
		
	    //$select = "SELECT api FROM tmp_api ORDER BY id;";
	    //$query = $this->db->query($select);		

		//return $query->result_array();


	    //$selectx = "CALL exe_message($loginid);";
	    //$queryx = $this->db->query($selectx);
		
	    $select = "SELECT api,phone FROM tmp_api ORDER BY id;";
	    $query = $this->db->query($select);		

		return $query->result_array();
	}

}
?>