<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Api');
    }
	
    public function index()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
            //$y['product'] = $this->Mod_Api->cbproduct();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/api');
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
	
    public function menus()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
            //$y['product'] = $this->Mod_Api->cbproduct();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/api');
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

	public function dtTables()
	{
		$list = $this->Mod_Api->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dtTable) {
			$no++;
			$row = array();
			$row[] = $no; //$dtTable->id;
			$row[] = $dtTable->title;
			$row[] = $dtTable->api_auth;
			//$row[] = $dtTable->api_url;
			//$row[] = $dtTable->webservice;
			$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_api('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_api('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>	
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_api('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Api->count_all(),
						"recordsFiltered" => $this->Mod_Api->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function view_apis($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$data = $this->Mod_Api->view_dtl($id);
			//print_r($data);
			//exit();
			echo json_encode($data);
        }
        else
        {
            redirect("Home");
        }
    }

	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('api_auth') == '')
        {
            $data['inputerror'][] = 'api_auth';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('api_url') == '')
        {
            $data['inputerror'][] = 'api_url';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('web_svc') == '')
        {
            $data['inputerror'][] = 'web_svc';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	public function ins_api()
	{
		$this->_validate();

		//$prod_id = $this->input->post('prod_id');

		//$hasil = $this->Mod_Api->cek_validasi($prod_id);
        //$cek = $hasil[0]['hasil'];

		//if ($cek == 0)
		//{
			$data = array(
				'title' 			=> $this->input->post('title'),
				'api_auth' 			=> $this->input->post('api_auth'),
				'api_url' 			=> $this->input->post('api_url'),
				'web_svc' 			=> $this->input->post('web_svc'),
				'api_keterangan'	=> $this->input->post('api_keterangan'),
				'loginid' 			=> $this->session->userdata('id'),
			);

			$this->Mod_Api->Ins_Api($data);
			echo json_encode(array("status" => TRUE));
		//}
		//else
		//{
			//echo json_encode(array("status_data_sama" => FALSE));
		//}
	}

	public function update_api()
	{
		if($this->Mod_login->logged_id())
        {
			$data = array(
				//id,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at
				//'id' => $this->input->post('id2'),
				'title' 		  	  => $this->input->post('title2'),
				'api_auth' 			  => $this->input->post('auth2'),
				'api_url'	  		  => $this->input->post('url2'),
				'webservice' 		  => $this->input->post('svc2'),
				'active' 			  => $this->input->post('status2'),
				'api_keterangan'	  => $this->input->post('api_keterangan2'),
				'update_by' 		  => $this->session->userdata('id'),
			);

			$this->Mod_Api->Update_Api(array('id' => $this->input->post('id2')), $data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
	}

    public function delete_api($id)
	{
		if($this->Mod_login->logged_id())
        {
			$data=$this->Mod_Api->hapus($id);
			echo json_encode($data);
		}
		else
		{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
    }
}
?>