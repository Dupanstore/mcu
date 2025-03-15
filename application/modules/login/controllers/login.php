<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		error_reporting(E_ALL^E_NOTICE);
		//error_reporting(0);
		date_default_timezone_set($this->madmin->Get_timezones('val'));
		$this->app_title = 'Login Page';
	}
	
	public function index(){
		if($this->session->userdata('id_user')){
			redirect(base_url('administrator'));
		}
		$data['title'] = 'Halaman Login MCU'; 
		$this->load->view('login/new/index', $data);
	}
	
	function logout() {
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url('login/index/'));
	}
	
	function gantipass(){
		//print_r ($_POST);
		//cek userid
		$cek = $this->mglobal->Get_value('id_log', $_POST['userid'], 'tb_login');
		if($this->session->userdata('nm_ins') != 'Administrator'){
			if($cek[0]->pass_log != md5(clean_data($_POST['passlama'])))die('Password lama tidak sesuai');
		}
		$dataIns['pass_log'] = md5(clean_data($_POST['passbaru']));
		$this->db->where('id_log', $_POST['userid']);
		$dm = $this->db->update('tb_login', $dataIns);
		if($dm)echo('simpan');
	}
	
	public function indexbaru(){
		if ($this->session->userdata('id_log')){
			if($this->session->userdata('simkep')){
				redirect(base_url('keperawatan'));
			} else {
				redirect(base_url($this->session->userdata('tag_mod') .'/'. $this->session->userdata('slug_ins')));
			}
		}
		$data['title'] = 'Halaman Login Aplikasi SIM RST Berbasis Klinis'; 
		$srr = '';
		if($this->uri->segment(3)){
			$srr = " and id_mod = '". $this->uri->segment(3) ."' ";
		}
		$data['query']  = $this->madmin->get_modul($srr);
		$this->load->view('login/new/index', $data);
	}
	public function perbaikidatareg(){
		//didapat dari url di detail pasien
		$this->load->view('perbaikidatareg', $data);
	}
}

