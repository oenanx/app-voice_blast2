<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upl_Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_User');
        $this->load->model('Mod_Api');
		$this->load->model('Mod_Upload');
		$this->load->helper(array('url','html','form'));
	}
	
    public function index()
    {
		if($this->Mod_login->logged_id())
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
            $y['company'] = $this->Mod_User->srccompany();
            $y['product'] = $this->Mod_Api->cbproduct();
		
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/apps', $y);
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
		$list = $this->Mod_Upload->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $dtTable) {
			//$no++;
			$row = array();
			$row[] = $dtTable->id;
			$row[] = $dtTable->company_name;
			$row[] = $dtTable->product_name;
			$row[] = $dtTable->title;
			$row[] = $dtTable->format_message;
			$row[] = $dtTable->status_name;
			//$row[] = $dtTable->active;

			//add html for action  <i class="fa fa-caret-down"></i>
			$row[] = '<div class="btn-group" align="center">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
						<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(359px, 38px, 0px);">
						<li>
							<a class="dropdown-item" href="#" title="View" id="view" onclick="view_trx('."'".$dtTable->id."'".')"><i class="fa fa-eye"></i> View</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" title="Edit" id="edit" onclick="edit_trx('."'".$dtTable->id."'".')"><i class="fa fa-edit"></i> Edit</a>
						</li>
							<div class="dropdown-divider"></div>
						<li>	
							<a class="dropdown-item" href="#" title="Delete" id="delete" onclick="del_trx('."'".$dtTable->id."'".')"><i class="fa fa-trash"></i> Delete</a>
						</li>
						</ul>
					  </div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mod_Upload->count_all(),
						"recordsFiltered" => $this->Mod_Upload->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function view_trx($id)
	{
        if($this->Mod_login->logged_id())
        {
			$this->load->helper('url');
			
			//$data = $this->Mod_Upload->view_dtl($id);
			$data = $this->Mod_Upload->get_by_view_header($id);
			echo json_encode($data);
		}
		else
		{
            redirect("Home");
		}
	}

	public function view_trx_sch($id)
	{
        if($this->Mod_login->logged_id())
        {
			$this->load->helper('url');
			
			$data2 = $this->Mod_Upload->get_by_view_schedule($id);
			echo json_encode($data2);
		}
		else
		{
            redirect("Home");
		}
	}

	public function view_trx_dtl($id)
	{
        if($this->Mod_login->logged_id())
        {
			$this->load->helper('url');
			
			$data1 = $this->Mod_Upload->get_by_view_detail($id);
			echo json_encode($data1);
		}
		else
		{
            redirect("Home");
		}
	}

	public function update_api()
	{
		if($this->Mod_login->logged_id())
        {
			$data1 = array(
				//id,company_id,product_id,title,format_message,description,start_date,end_date,status_id,create_by,create_date,update_by,update_at
				//'id' 				=> $this->input->post('id2'),
				'company_name' 		=> $this->input->post('cname2'),
				'product_name' 		=> $this->input->post('pname2'),
				'title' 			=> $this->input->post('title2'),
				'format_message' 	=> $this->input->post('fmsg2'),
				'description' 		=> $this->input->post('desc2'),
				'start_date' 		=> $this->input->post('start_date2'),
				'end_date' 			=> $this->input->post('end_date2'),
				'status_id' 		=> $this->input->post('status2'),
				'update_by' 		=> $this->session->userdata('id'),
			);

			$this->Mod_Upload->Update_hdr(array('id' => $this->input->post('id2')), $data1);
			
			$data2 = array(
				//id,trx_product_h_id,batchid,start_datetime,end_datetime,active,create_by,create_at,update_by,update_at
				//'id' 				=> $this->input->post('id2'),
				//'batchid' 			=> $this->input->post('batchid2'),
				'start_date' 		=> $this->input->post('startdate2'),
				'end_date' 			=> $this->input->post('enddate2'),
				'start_datetime' 	=> $this->input->post('starttime2'),
				'end_datetime' 		=> $this->input->post('endtime2'),
				'active' 			=> $this->input->post('active2'),
				'update_by' 		=> $this->session->userdata('id'),
			);

			$this->Mod_Upload->Update_sch(array('trx_product_h_id' => $this->input->post('id2'), 'batchid' => $this->input->post('batchid2')), $data2);
			
			
			/*
			$data3 = array(
				//id,trx_product_h_id,trx_schedule_id,phone,name,overdue,amount,status_calllback,last_call,count_call
				//'id' 				=> $this->input->post('id2'),
				//'trx_schedule_id' 	=> $this->input->post('schid2'),
				'phone' 			=> $this->input->post('phone2'),
				'name' 				=> $this->input->post('name2'),
				'overdue' 			=> $this->input->post('overdue2'),
				'amount' 			=> $this->input->post('amount2'),
			);

			$this->Mod_Upload->Update_dtl(array('trx_product_h_id' => $this->input->post('id2'), 'trx_schedule_id' => $this->input->post('schid2')), $data3);
			*/
			
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
			$data=$this->Mod_Upload->hapus($id);
			echo json_encode($data);
		}
		else
		{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("Home");
        }
    }

	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('company_id') == '')
        {
            $data['inputerror'][] = 'company_id';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('prod_id') == '')
        {
            $data['inputerror'][] = 'prod_id';
            $data['error_string'][] = 'Harus di pilih';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('form_message') == '')
        {
            $data['inputerror'][] = 'form_message';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('startdate') == '')
        {
            $data['inputerror'][] = 'startdate';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('endate') == '')
        {
            $data['inputerror'][] = 'endate';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('description') == '')
        {
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'Harus di isi';
            $data['status'] = FALSE;
        }

		/*
		for($i = 1; $i <= count($this->input->post('typeid')); $i++)
		{			
			if($this->input->post('typeid')[$i] == '')
			{
				$data['inputerror'][$i] = 'typeid';
				$data['error_string'][$i] = 'Harus di isi';
				$data['status'] = FALSE;
			}
		}
		
		for($i = 1; $i <= count($this->input->post('item_name')); $i++)
		{			
			if($this->input->post('item_name')[$i] == '')
			{
				$data['inputerror'][$i] = 'item_name';
				$data['error_string'][$i] = 'Harus di isi';
				$data['status'] = FALSE;
			}
		}

		for($i = 1; $i <= count($this->input->post('qty')); $i++)
		{			
			if($this->input->post('qty')[$i] == '')
			{
				$data['inputerror'][$i] = 'qty';
				$data['error_string'][$i] = 'Harus di isi';
				$data['status'] = FALSE;
			}
		}

		for($i = 1; $i <= count($this->input->post('uom')); $i++)
		{			
			if($this->input->post('uom')[$i] == '')
			{
				$data['inputerror'][$i] = 'uom';
				$data['error_string'][$i] = 'Harus di pilih';
				$data['status'] = FALSE;
			}
		}
		*/
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	public function upload()
    {
			 //upload file
       	include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        //$fileInfos = array();
        
        $trx_product_h_id['trx_product_h_id'] = $this->Mod_Upload->Ins_trx_h($_POST);
        //print_r($trx_product_h_id['trx_product_h_id']);
        $data = $_POST;
        $h_id = $trx_product_h_id['trx_product_h_id'];
        $filelength = count($_FILES['file']['name']);
   
		$format = $_POST['form_message'];
		if (isset($_FILES['file']['name'])) 
		{
			for($i=0; $i < $filelength; $i++)	
			{				
				$_FILES['wew']['name']     = $_FILES['file']['name'][$i]; 
				$_FILES['wew']['type']     = $_FILES['file']['type'][$i]; 
				$_FILES['wew']['tmp_name'] = $_FILES['file']['tmp_name'][$i]; 
				$_FILES['wew']['error']     = $_FILES['file']['error'][$i]; 
				$_FILES['wew']['size']     = $_FILES['file']['size'][$i]; 
				
				$config['upload_path'] = 'excel/';
				$config['allowed_types'] = 'xlsx|xls|csv';
				$config['max_filename'] = '255';
				$config['encrypt_name'] = false;
				$config['max_size'] = '2048'; //1 MB]
				//$config['file_name'] = $_FILES['file']['name'][$i];

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('wew'))
				{ 
					// Uploaded file data 

					for($k=0; $k < count($this->upload->do_upload('wew')); $k++)
					{
						$data_sch = array(
							'batchid' 	=> $i + 1,
							'start_date' => $_POST['start_date'][$i],
							'end_date' 	=> $_POST['end_date'][$i],
							'starttime' => $_POST['starttime'][$i],
							'endtime' 	=> $_POST['endtime'][$i],
							'status1' 	=> $_POST['status1'][$i],	
						);

						$trx_sch_id['trx_sch_id']=$this->Mod_Upload->Ins_sch($h_id,$data_sch);
						
						$sch_id = $trx_sch_id['trx_sch_id'];
						$data_upload = $this->upload->data();
						//print_r($data_upload);

						$excelreader = new PHPExcel_Reader_Excel2007();
						$loadexcel   = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
						//$loadexcel   = $excelreader->load('excel/'.$userfile); // Load file yang telah diupload ke folder excel
						$sheet       = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

						$flag = true;
						$j=0;
						foreach ($sheet as $row) 
						{
							if($flag)
							{
								$flag =false;
								continue;
							}
					  
							$result[$j]['phone']   = $row['A'];
							$result[$j]['name']    = $row['B'];
							$result[$j]['overdue'] = $row['C'];
							$result[$j]['amount']  = $row['D'];

							$result[$j]['template'] = str_replace("#overdue",$result[$j]['overdue'],str_replace("#amount",$result[$j]['amount'],str_replace("#name",$result[$j]['name'],$format)));
							$j++;
						}

						$upl[$k] = $result;
						$this->Mod_Upload->Ins_trx_d($h_id,$sch_id,$upl[$k]);
						//unlink(realpath('excel/'.$userfile));
						
						//print_r($data2[$k]);
					}
				}
				else
				{  
					//$errorUploadType .= $_FILES['file']['name'].' | ';  
				} 
			}
		} 
		else 
		{
			echo 'Please choose a file';
		}
		//unlink(realpath('excel/'.$data_upload['file_name']));
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
    }

}
?>