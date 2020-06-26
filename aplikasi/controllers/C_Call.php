<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Call extends CI_Controller
{
	var $API ="";
	
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
		$this->load->model('Mod_Call');

		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		//$this->load->helper('form');
		//$this->load->helper('url');
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
			$this->load->view('home/calls', $y);
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
	
	public function dtTables()
	{
		$list = $this->Mod_Call->get_datatables();
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
						"recordsTotal" => $this->Mod_Call->count_all(),
						"recordsFiltered" => $this->Mod_Call->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function call()
	{
		$this->load->helper('url');
		
		$batchid = $this->input->post('batches');
		
		//print_r($batchid);
		//exit();
		//$exe = array();
		$exe = $this->Mod_Call->exec_per_id($batchid);
		//print_r($exe);
		//echo count($exe);
		//exit();
		for($i = 0; $i < count($exe); $i++)
		{
			//print_r($exe[$i]);
			//echo $exe[$i]['message'];
			//echo "<br />";
			//echo $exe[$i]['phone'];
			//echo "<br />";

			//$statusCallBack = 'http://waithook.com/testing_462?StatusCallbackEvent=initiated,ringing,answered,completed';
			
			
			$output = shell_exec("curl -d -X POST ".$exe[$i]['api']);
			//echo "<pre>$output</pre>";
			//echo "<br />";
			//echo "<br />";

			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, 'http://waithook.com/testing_462');

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);

			if (curl_errno($ch))
			{
				print "Error: " . curl_error($ch);
				//call failed
				$this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES CALL GAGAL! Error : ' . curl_error($ch) .'</b></div>');
				redirect('C_Call/');
			}
			else
			{
				// Show me the result
				//echo "<pre>$data</pre>";
				//echo "<br />";
				//echo "<br />";
				
				//$body = file_get_contents("http://waithook.com/testing_462");
				//$webhook = json_decode($body, true);

				//echo "Here are the URLs: <br /><br />";
				
				//print_r($webhook["body"]);
				
				$upd = $this->Mod_Call->result_per_id($data, $exe[$i]['phone']);
				//$upd = $this->Mod_Call->result_per_id($output, $exe[$i]['phone']);
			}

		}
		curl_close($ch);
		//exit();
		
		//call success
		$this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES CALL BERHASIL!</b></div>');
		echo json_encode(array("status" => TRUE));
		//redirect('C_Call/');

		//print_r($data);
		//exit();
		//echo json_encode($data);
		
	}
}	
?>