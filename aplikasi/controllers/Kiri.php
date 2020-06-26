<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiri extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Mod_Menu');
        $this->load->model('Mod_Dashboard');
    }

    public function view_app()
	{
		$x['data'] = $this->Mod_Menu->check_menu_kiri($this->session->userdata('user_id'));
		$x['tes'] = $this->Mod_Menu->check_menu_kanan($this->session->userdata('user_id'));
		$y['all'] = $this->Mod_Dashboard->get_total_all($this->session->userdata('id'));
		$y['ppo'] = $this->Mod_Dashboard->get_pp_total_open($this->session->userdata('id'));
		$y['gro'] = $this->Mod_Dashboard->get_gr_total_open($this->session->userdata('id'));
		$y['vco'] = $this->Mod_Dashboard->get_vc_total_open($this->session->userdata('id'));
		//$x['data1'] = $this->M_News->companyList();
		//$y['cal'] = $this->calendar->generate();
		
		$this->load->view('home/atas');
		$this->load->view('home/kiri1', $x);
		//$this->load->view('home/home');
		$this->load->view('home/home', $y);
		//$this->load->view('home/kanan');
		$this->load->view('home/bawah');
	}
}
?>