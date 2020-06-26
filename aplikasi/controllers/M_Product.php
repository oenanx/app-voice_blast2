<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Product');
        
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
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/product');
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
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/product');
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
		$list = $this->Mod_Product->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			$row = array();
			$row[] = $dtTable->id;
			$row[] = $dtTable->product_name;
			$row[] = $dtTable->product_description;
			$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_prod('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_prod('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_prod('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Product->count_all(),
						"recordsFiltered" => $this->Mod_Product->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function view_product($id)
    {
        if($this->Mod_login->logged_id())
        {
            $this->load->helper('url');
			$data = $this->Mod_Product->view_dtl($id);
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
 
        if($this->input->post('prod_name') == '')
        {
            $data['inputerror'][] = 'prod_name';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('prod_desc') == '')
        {
            $data['inputerror'][] = 'prod_desc';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
	public function ins_product()
	{
		$this->_validate();

		$prod_name = $this->input->post('prod_name');

		$hasil = $this->Mod_Product->cek_validasi($prod_name);
        $cek = $hasil[0]['hasil'];

		if ($cek == 0)
		{
			$data = array(
				'prod_name' => $this->input->post('prod_name'),
				'prod_desc' => $this->input->post('prod_desc'),
			);

			$this->Mod_Product->Ins_Product($data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{
			echo json_encode(array("status_data_sama" => FALSE));
		}

		//$data['product_name'] = $this->input->post('prod_name');
		//$data['product_description'] = $this->input->post('prod_desc');
	}

	public function update_product()
	{
		if($this->Mod_login->logged_id())
        {
			$data = array(					
				//'id' => $this->input->post('id2'),
				'product_name' => $this->input->post('prod_name2'),
				'product_description' => $this->input->post('prod_desc2'),
				'active' => $this->input->post('status2'),
				'update_by' => $this->session->userdata('user_id'),
			);

			$this->Mod_Product->Update_Product(array('id' => $this->input->post('id2')), $data);
			echo json_encode(array("status" => TRUE));
		}
		else
		{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
	}

    public function delete_product($id)
	{
		if($this->Mod_login->logged_id())
        {
			$data=$this->Mod_Product->hapus($id);
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