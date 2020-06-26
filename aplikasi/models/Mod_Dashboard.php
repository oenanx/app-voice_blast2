<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_Dashboard extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_total_all($loginid)
	{
		//$loginid = $this->session->userdata('id');
		$sqlall = "SELECT DISTINCT COUNT(1) tot_call FROM trx_product_d a, trx_product_h b, account_user c WHERE a.trx_product_h_id = b.id AND b.company_id = c.company_id AND c.id = ".$loginid." AND DATE_FORMAT(a.start_call,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m');";
	    $queryall = $this->db->query($sqlall);
		return $queryall;
	}

	public function get_pp_total_open($loginid)
	{
		//$loginid = $this->session->userdata('id');
		$sqlopen = "SELECT DISTINCT COUNT(1) tot_open FROM trx_product_d a, trx_product_h b, account_user c WHERE a.trx_product_h_id = b.id AND b.company_id = c.company_id AND response = 'completed' AND c.id = ".$loginid." AND DATE_FORMAT(a.start_call,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m');";
	    $queryopen = $this->db->query($sqlopen);
		return $queryopen;
	}

	public function get_gr_total_open($loginid)
	{
		//$loginid = $this->session->userdata('id');
		$sqlopen2 = "SELECT DISTINCT COUNT(1) tot_open2 FROM trx_product_d a, trx_product_h b, account_user c WHERE a.trx_product_h_id = b.id AND b.company_id = c.company_id AND response = 'BUSY' AND c.id = ".$loginid." AND DATE_FORMAT(a.start_call,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m');";
	    $queryopen2 = $this->db->query($sqlopen2);
		return $queryopen2;
	}

	public function get_vc_total_open($loginid)
	{
		//$loginid = $this->session->userdata('id');
		$sqlopen2 = "SELECT DISTINCT COUNT(1) tot_open3 FROM trx_product_d a, trx_product_h b, account_user c WHERE a.trx_product_h_id = b.id AND b.company_id = c.company_id AND response = 'FAILED' AND c.id = ".$loginid." AND DATE_FORMAT(a.start_call,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m');";
	    $queryopen2 = $this->db->query($sqlopen2);
		return $queryopen2;
	}
}
?>