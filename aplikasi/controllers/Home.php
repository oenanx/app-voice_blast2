<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_login');
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Dashboard');
    }

    public function index()
    {
		//var $log = $this->Mod_login->logged_id();
		if($this->Mod_login->logged_id() != FALSE)
		{
			//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
			$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
			$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
 			$y['all'] = $this->Mod_Dashboard->get_total_all($this->session->userdata('id'));
 			$y['ppo'] = $this->Mod_Dashboard->get_pp_total_open($this->session->userdata('id'));
			$y['gro'] = $this->Mod_Dashboard->get_gr_total_open($this->session->userdata('id'));
			$y['vco'] = $this->Mod_Dashboard->get_vc_total_open($this->session->userdata('id'));
			
			$this->load->view('home/atas');
			$this->load->view('home/kiri1', $x);
			$this->load->view('home/home', $y);
			//$this->load->view('home/kanan');
			$this->load->view('home/bawah');

		}
		else
		{
			//jika session belum terdaftar
			//set form validation
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			//set message form validation
			$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
				<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

			//cek validasi
			if ($this->form_validation->run() == TRUE) 
			{
                //get data dari FORM
                $username = $this->input->post("username", TRUE);
                $password = $this->input->post("password", TRUE);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                //checking data via model
                $checking = $this->Mod_login->check_login(array('userid' => $username), array('pword' => $password));
				//echo count($checking);
				//exit();
                //jika ditemukan, maka create session
                if ($checking != FALSE) 
				{
					foreach ($checking as $apps) 
					{
						$session_data = array(
						   'id'    => $apps->id,
						   'user_id'    => $apps->user_name,
						   'pass'       => $apps->passwd,
						   'user_name'  => $apps->full_name,
						   //'user_email' => $apps->email,
						   //'nama_dept'  => $apps->departemen,
						   //'gender' 	=> $apps->sex,
						   //'appcode'	=> array($apps->appid)
						);
						//set session userdata
						//print_r($session_data);
						$this->session->set_userdata($session_data);
					}
					
					redirect('/Kiri/view_app/');
                }
				else
				{
                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                        <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';

					$this->session->sess_destroy();
					//$this->load->view('templates/kiri', $z);
					//$this->load->view('templates/tengah', $k);
					$this->load->view('templates/atas');
					//$this->load->view('templates/kiri');
					$this->load->view('templates/tengah');
					//$this->load->view('templates/kanan', $data);
					$this->load->view('templates/bawah');
                }

            }
			else
			{
				//$z['data'] = $this->Mod_Awal->newsList();
				//$k['data'] = $this->Mod_Awal->newsQuery();
				
				//echo $this->my_funclib->strcut("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.", 5);
				//echo "<br /><br /><br />";
			
				
				$this->session->sess_destroy();
                //$this->load->view('templates/kiri', $z);
                //$this->load->view('templates/tengah', $k);
                $this->load->view('templates/atas');
				//$this->load->view('templates/kiri');
				$this->load->view('templates/tengah');
                //$this->load->view('templates/kanan');
                $this->load->view('templates/bawah');
            }
        }
    }
	
	public function cek()
	{
		//var $log1 = $this->Mod_login->logged_id();
		if($this->Mod_login->logged_id() != FALSE)
		{
			//var $data = $this->Mod_login->logged_id();
			//echo json_encode($data);
			//print_r($this->Mod_login->logged_id());
			//exit();
			echo json_encode($this->Mod_login->logged_id());
		}
		else
		{
			//$z['data'] = $this->Mod_Awal->newsList();
			//$k['data'] = $this->Mod_Awal->newsQuery();
				
			$this->session->sess_destroy();
			//$this->load->view('templates/kiri', $z);
			//$this->load->view('templates/tengah', $k);
			$this->load->view('templates/atas');
			//$this->load->view('templates/kiri');
			$this->load->view('templates/tengah');
			//$this->load->view('templates/kanan');
			$this->load->view('templates/bawah');
		}
	}

    public function logout()
    {
        $this->session->sess_destroy();

		$this->load->view('templates/atas');
		//$this->load->view('templates/kiri');
		$this->load->view('templates/tengah');
		//$this->load->view('templates/kanan');
		$this->load->view('templates/bawah');
    }

}
?>