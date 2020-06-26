<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_User');
        $this->load->model('Mod_Senderno');
        
        // Load form validation library
        $this->load->library('form_validation');
    }
	
    public function index()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
            $y['company'] = $this->Mod_User->cbcompany();
            $y['group'] = $this->Mod_User->cbgroup();
            $y['menus'] = $this->Mod_User->cbmenu();
            //$y['product'] = $this->Mod_Senderno->cbproduct();
            //$y['senderno'] = $this->Mod_User->cbsenderno();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/user', $y);
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
            $y['company'] = $this->Mod_User->cbcompany();
            $y['group'] = $this->Mod_User->cbgroup();
            $y['menus'] = $this->Mod_User->cbmenu();
            //$y['product'] = $this->Mod_Senderno->cbproduct();
            //$y['senderno'] = $this->Mod_User->cbsenderno();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/user', $y);
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
		$list = $this->Mod_User->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			$row = array();
			//$row[] = $dtTable->id;
			$row[] = $dtTable->user_name;
			$row[] = $dtTable->full_name;
			$row[] = $dtTable->company_name;
			//$row[] = $dtTable->product_name;
			//$row[] = $dtTable->senderno;
			$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_usr('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_usr('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_usr('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_User->count_all(),
						"recordsFiltered" => $this->Mod_User->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function view_user($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$data = $this->Mod_User->view_dtl($id);
			echo json_encode($data);
        }
        else
        {
            redirect("Home");
        }
    }

	public function view_menu($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$dataa = $this->Mod_User->view_mnu($id);
			//print_r($dataa);
			//exit();

			echo json_encode($dataa);
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
 
        if($this->input->post('user_name') == '')
        {
            $data['inputerror'][] = 'user_name';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('full_name') == '')
        {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('passwd') == '')
        {
            $data['inputerror'][] = 'passwd';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('confirm_passwd') == '')
        {
            $data['inputerror'][] = 'confirm_passwd';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('company_name') == '')
        {
            $data['inputerror'][] = 'company_name';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('senderno') == '')
        {
            $data['inputerror'][] = 'senderno';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('group_name') == '')
        {
            $data['inputerror'][] = 'group_name';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('divisi_name') == '')
        {
            $data['inputerror'][] = 'divisi_name';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('menus') == '')
        {
            $data['inputerror'][] = 'menus';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	private function _validate_edit()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('uname2') == '')
        {
            $data['inputerror'][] = 'uname2';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('fname2') == '')
        {
            $data['inputerror'][] = 'fname2';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('dname2') == '')
        {
            $data['inputerror'][] = 'dname2';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('passwd2') == '')
        {
            $data['inputerror'][] = 'passwd2';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('cpasswd2') == '')
        {
            $data['inputerror'][] = 'cpasswd2';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('cname2') == '')
        {
            $data['inputerror'][] = 'cname2';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        //if($this->input->post('send2') == '')
        //{
            //$data['inputerror'][] = 'send2';
            //$data['error_string'][] = 'Harus di pilih';
            //$data['status'] = FALSE;
        //}

        if($this->input->post('gname2') == '')
        {
            $data['inputerror'][] = 'gname2';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('status2') == '')
        {
            $data['inputerror'][] = 'status2';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	public function ins_user()
	{
		$this->_validate();

		$user_name 			= $this->input->post('user_name');
		$passwd 			= $this->input->post('passwd');
		$confirm_passwd 	= $this->input->post('confirm_passwd');

		$hasil = $this->Mod_User->cek_validasi($user_name);
        $cek = $hasil[0]['hasil'];

		$hasil2 = $this->Mod_User->cek_password($passwd,$confirm_passwd);
        $cek2 = $hasil2[0]['hasil2'];

		if ($cek == 0 && $cek2 == 1)
		{
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'full_name' => $this->input->post('full_name'),
				'divisi_name' => $this->input->post('divisi_name'),
				'passwd' => $this->input->post('passwd'),
				'company_name' => $this->input->post('company_name'),
				'group_name' => $this->input->post('group_name'),
				'menus' => $this->input->post('menus'),
				//'product' => $this->input->post('product'),
				//'senderno' => $this->input->post('senderno'),
			);

			$this->Mod_User->Ins_User($data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
			echo json_encode(array("status_data_sama" => FALSE));
		}
	}

	public function update_user()
	{
		if($this->Mod_login->logged_id())
        {
			$this->_validate_edit();

			//$user_name 			= $this->input->post('uname2');
			$passwd 			= $this->input->post('passwd2');
			$confirm_passwd 	= $this->input->post('cpasswd2');

			//$hasil = $this->Mod_User->cek_validasi($user_name);
			//$cek = $hasil[0]['hasil'];

			$hasil2 = $this->Mod_User->cek_password($passwd,$confirm_passwd);
			$cek2 = $hasil2[0]['hasil2'];

			if ($cek2 == 1)
			{
				$data = array(					
					'id' => $this->input->post('id2'),
					'user_name' => $this->input->post('uname2'),
					'full_name' => $this->input->post('fname2'),
					'divisi_name' => $this->input->post('dname2'),
					'passwd' => $this->input->post('passwd2'),
					'company_id' => $this->input->post('cname2'),
					//'senderno_id' => $this->input->post('send2'),
					'account_group_id' => $this->input->post('gname2'),
					'active' => $this->input->post('status2'),
				);

				//$this->Mod_User->Update_User(array('id' => $this->input->post('id2')), $data);
				$this->Mod_User->Update_User($data);
				echo json_encode(array("status" => TRUE));
			}
			else
			{
				echo json_encode(array("status_data_sama" => FALSE));
			}
		}
		else
		{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
	}

    public function delete_user($id)
	{
		if($this->Mod_login->logged_id())
        {
			$data=$this->Mod_User->hapus($id);
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
