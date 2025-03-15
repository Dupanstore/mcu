<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek_login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		date_default_timezone_set($this->madmin->Get_timezones('val'));
		$this->app_title = 'Login Page';
	}
	public function index(){
		//print_r ($_POST);
		if($_POST){
			foreach ($_POST as $_b => $_c){
				if($_c == ''){
					echo 'Gagal';
					die();
				}
			}
			$_log = "select * from  tb_user, tb_instalasi ";
			$_log .= "where tb_user.level=tb_instalasi.id_ins ";
			$_log .= "and tb_user.username='". clean_data($_POST['user_log']) ."' limit 1";
			$data = $this->db->query($_log);
			$query = $data->result();
				if(!$query){
					echo 'Gagal';
					die();
				}
				else if($query[0]->password != md5(clean_data($_POST['pass_log']))){
					echo 'Gagal';
					die();
				}
				else {
					//jika bukan admin dan user, password benar tapi klik modulnya salah
					$this->session->set_userdata($query[0]);
					//$angga = $query[0]->type_login;
					echo base_url('administrator');
					die();
				}
		}
	}
}

