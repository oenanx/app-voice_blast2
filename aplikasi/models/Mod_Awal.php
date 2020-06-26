<?php
defined('BASEPATH') OR exit('no direct script access allowed'); 

class Mod_Awal extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db = $this->load->database('b', TRUE);
	}
	
	//public function newsList()
	//{
		//$sqlList = "SELECT company_name, COUNT(1) Jml FROM news a, master_company b WHERE a.company_id = b.id GROUP BY company_name;";
		//$query = $this->db->query($sqlList);
		//return $query;
	//}	
	
	//public function newsQuery()
	//{
		//$sqlQuery = "SELECT a.id, a.news_title, DATE_FORMAT(a.crtdate,'%e %M %Y') crtdate, a.news_body, b.departemen FROM news a, master_user b WHERE a.crtby = b.userid ORDER BY a.crtdate DESC;";
		//$query = $this->db->query($sqlQuery);
		//return $query;
	//}	
}
?>