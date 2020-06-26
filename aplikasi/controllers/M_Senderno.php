<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Senderno extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Senderno');
    }
	
    public function index()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
            $y['product'] = $this->Mod_Senderno->cbproduct();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/senderno', $y);
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
            $y['product'] = $this->Mod_Senderno->cbproduct();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/senderno', $y);
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
		$list = $this->Mod_Senderno->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			$row = array();
			$row[] = $dtTable->title;
			$row[] = $dtTable->senderno;
			$row[] = $dtTable->capacity;
			$row[] = $dtTable->description;
			$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_sender('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_sender('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>	
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_sender('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Senderno->count_all(),
						"recordsFiltered" => $this->Mod_Senderno->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function view_send($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$data = $this->Mod_Senderno->view_dtl($id);
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
 
        if($this->input->post('api_id') == '')
        {
            $data['inputerror'][] = 'api_id';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('senderno') == '')
        {
            $data['inputerror'][] = 'senderno';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('capacity') == '')
        {
            $data['inputerror'][] = 'capacity';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('description') == '')
        {
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('trial') == '')
        {
            $data['inputerror'][] = 'trial';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	public function ins_send()
	{
		$this->_validate();

		$senderno = $this->input->post('senderno');

		$hasil = $this->Mod_Senderno->cek_validasi($senderno);
        $cek = $hasil[0]['hasil'];

		if ($cek == 0)
		{
			$data = array(
				'api_id'		=> $this->input->post('api_id'),
				'senderno'		=> $this->input->post('senderno'),
				'capacity'		=> $this->input->post('capacity'),
				'description'	=> $this->input->post('description'),
				'trial'			=> $this->input->post('trial'),
				'loginid' 		=> $this->session->userdata('id'),
			);

			$this->Mod_Senderno->Ins_Sender($data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
			echo json_encode(array("status_data_sama" => FALSE));
		}

		//$data['product_name'] = $this->input->post('prod_name');
		//$data['product_description'] = $this->input->post('prod_desc');
	}

	public function update_send()
	{
		if($this->Mod_login->logged_id())
        {
			$data = array(
				//id,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at
				//'id' => $this->input->post('id2'),
				'api_id'		=> $this->input->post('product_name2'),
				'senderno'		=> $this->input->post('senderno2'),
				'capacity'		=> $this->input->post('capacity2'),
				'description'	=> $this->input->post('description2'),
				'ftrial' 		=> $this->input->post('trial2'),
				'fstatus' 		=> $this->input->post('status2'),
				'update_by' 	=> $this->session->userdata('id'),
			);

			$this->Mod_Senderno->Update_Sender(array('id' => $this->input->post('id2')), $data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
	}

    public function delete_send($id)
	{
		if($this->Mod_login->logged_id())
        {
			$data=$this->Mod_Senderno->hapus($id);
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