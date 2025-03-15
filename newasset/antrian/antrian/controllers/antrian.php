<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Antrian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		date_default_timezone_set($this->madmin->Get_timezones('val'));
		//ini_set('display_errors','On');
		//error_reporting(E_ALL | E_STRICT);
		error_reporting(0);
		if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
			ob_start("ob_gzhandler");
		} else {
			ob_start();
		}
		$this->u1 = $this->uri->segment(1);
		$this->u2 = $this->uri->segment(2);
		$this->u3 = $this->uri->segment(3);
		$this->u4 = $this->uri->segment(4);
		$this->u5 = $this->uri->segment(5);
		$this->u6 = $this->uri->segment(6);
		$this->u7 = $this->uri->segment(7);
		$this->u8 = $this->uri->segment(8);
		$this->u9 = $this->uri->segment(9);
		$this->u10 = $this->uri->segment(10);
		$this->u11 = $this->uri->segment(11);
		$this->u12 = $this->uri->segment(12);
		$this->u13 = $this->uri->segment(13);
		$this->u14 = $this->uri->segment(14);
		$this->u15 = $this->uri->segment(15);
		$this->app_title = 'Antrian Pasien';
		$this->home_link = $this->uri->segment(1);
	}
	
	public function index(){
		$data['title'] = 'Halaman Login Aplikasi SIM RST Berbasis Klinis'; 
		$this->load->view('index', $data);
	}
	public function testing(){
		$data['title'] = 'Halaman Login Aplikasi SIM RST Berbasis Klinis'; 
		$this->load->view('testing', $data);
	}
	public function getajaxantrian(){
		$data['title'] = 'Halaman Login Aplikasi SIM RST Berbasis Klinis'; 
		$this->load->view('getajaxantrian', $data);
	}
	public function pendaftaran(){
		$this->load->view('pendaftaran', $data);
	}
	public function poliklinik(){
		$this->load->view('poliklinik', $data);
	}
	public function farmasi(){
		$this->load->view('farmasi', $data);
	}
	public function ranap(){
		$this->load->view('ranap', $data);
	}
	public function kelaskiri(){
		$this->load->view('kelaskiri', $data);
	}
	public function cetakranap(){
		$this->load->view('cetakranap', $data);
	}
}

