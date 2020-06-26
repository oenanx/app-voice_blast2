<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Company');
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
            $y['sender'] = $this->Mod_Company->cbsender();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/company', $y);
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
            $y['product'] = $this->Mod_Senderno->cbproduct();
            $y['sender'] = $this->Mod_Company->cbsender();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/company', $y);
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
		$list = $this->Mod_Company->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			$row = array();
			//$row[] = $dtTable->id;
			$row[] = $dtTable->reg_no;
			$row[] = $dtTable->company_name;
			$row[] = $dtTable->phone_fax;
			$row[] = $dtTable->count_current;
			$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_company('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_company('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>	
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_company('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Company->count_all(),
						"recordsFiltered" => $this->Mod_Company->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function view_cpy($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$data = $this->Mod_Company->view_dtl($id);
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
 
        if($this->input->post('cpy_name') == '')
        {
            $data['inputerror'][] = 'cpy_name';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('ph_fax') == '')
        {
            $data['inputerror'][] = 'ph_fax';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('addr') == '')
        {
            $data['inputerror'][] = 'addr';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('addr_bill') == '')
        {
            $data['inputerror'][] = 'addr_bill';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('cpy_email') == '')
        {
            $data['inputerror'][] = 'cpy_email';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('bill_email') == '')
        {
            $data['inputerror'][] = 'bill_email';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('startdate') == '')
        {
            $data['inputerror'][] = 'startdate';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('enddate') == '')
        {
            $data['inputerror'][] = 'enddate';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('api_id') == '')
        {
            $data['inputerror'][] = 'api_id';
            $data['error_string'][] = 'Harus di isi';
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
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	public function ins_cpy()
	{
		$this->_validate();

		$cpy_name = $this->input->post('cpy_name');

		$hasil = $this->Mod_Company->cek_validasi($cpy_name);
        $cek = $hasil[0]['hasil'];

		if ($cek == 0)
		{
			$data = array(
				'cpy_name' 		=> $this->input->post('cpy_name'),
				'ph_fax' 		=> $this->input->post('ph_fax'),
				'addr' 			=> $this->input->post('addr'),
				'addr_bill' 	=> $this->input->post('addr_bill'),
				'cpy_email' 	=> $this->input->post('cpy_email'),
				'bill_email' 	=> $this->input->post('bill_email'),
				'startdate' 	=> $this->input->post('startdate'),
				'enddate'	 	=> $this->input->post('enddate'),
				'notes' 		=> $this->input->post('notes'),
				'api_id' 		=> $this->input->post('api_id'),
				'senderno' 		=> $this->input->post('senderno'),
				'capacity'		=> $this->input->post('capacity'),
				'loginid'		=> $this->session->userdata('id'),
			);

			$this->Mod_Company->Ins_Company($data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
			echo json_encode(array("status_data_sama" => FALSE));
		}

		//$data['product_name'] = $this->input->post('prod_name');
		//$data['product_description'] = $this->input->post('prod_desc');
	}

	public function update_cpy()
	{
		if($this->Mod_login->logged_id())
        {
			$data = array(
				//id,company_name,address,address_billing,phone_fax,email_company,email_billing,notes,active,start_date,end_date,create_by,create_at,update_by,update_at
				//'id' => $this->input->post('id2'),
				'company_name' 		  => $this->input->post('cpy_name2'),
				'address' 			  => $this->input->post('cpy_addr2'),
				'address_billing'	  => $this->input->post('bill_addr2'),
				'phone_fax' 		  => $this->input->post('phone2'),
				'email_company' 	  => $this->input->post('cpy_email2'),
				'email_billing'		  => $this->input->post('bill_email2'),
				'notes' 			  => $this->input->post('notes2'),
				'active' 			  => $this->input->post('status2'),
				'start_date'		  => $this->input->post('startdate2'),
				'end_date' 			  => $this->input->post('enddate2'),
				'api_id' 			  => $this->input->post('api_id2'),
				'senderno_id' 		  => $this->input->post('senderno2'),
				'count_current'		  => $this->input->post('current2'),
				'update_by' 		  => $this->session->userdata('id'),
			);

			$this->Mod_Company->Update_Company(array('id' => $this->input->post('id2')), $data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
	}

    public function delete_cpy($id)
	{
		if($this->Mod_login->logged_id())
        {
			$data=$this->Mod_Company->hapus($id);
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