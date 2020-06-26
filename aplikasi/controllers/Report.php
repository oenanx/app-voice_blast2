<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
	var $API ="";
	
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
		$this->load->model('Mod_Call');

		$this->load->library('curl');
    }
	
    public function index()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
			//$y['dataApi'] = json_decode($this->curl->simple_get($this->API.'/kontak'));
            //$y['company'] = $this->Mod_User->srccompany();
			$y['campaign'] = $this->Mod_Call->campaignList();
            //$y['batch'] = $this->Mod_Call->batchList();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/report', $y);
			//$this->load->view('home/kanan');
			$this->load->view('home/bawah');
		}
		else
		{
			$this->session->sess_destroy();
			$this->load->view('templates/atas');
			$this->load->view('templates/tengah');
			//$this->load->view('templates/kanan');
			$this->load->view('templates/bawah');
		}
	}
 
    function get_batch(){
        $campaign_id = $this->input->post('id',TRUE);
        $data = $this->Mod_Call->batchList($campaign_id)->result();
        echo json_encode($data);
    }
	
	public function dtTables_rpt()
	{
		$list = $this->Mod_Call->get_datatables_rpt();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			//'c.id, b.batchid, c.phone, c.name, c.status_calllback, c.count_call, c.start_call, c.end_call, c.duration
			$row = array();
			//$row[] = $dtTable->id;
			$row[] = $dtTable->batchid;
			$row[] = $dtTable->phone;
			$row[] = $dtTable->nama;
			//$row[] = $dtTable->status_calllback;
			$row[] = $dtTable->callsid;
			$row[] = $dtTable->response;
			$row[] = $dtTable->count_call;
			$row[] = $dtTable->start_call;
			$row[] = $dtTable->end_call;
			$row[] = $dtTable->duration;
			$row[] = $dtTable->count_retry;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Call->count_all_rpt(),
						"recordsFiltered" => $this->Mod_Call->count_filtered_rpt(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}	
?>