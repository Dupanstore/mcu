<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		date_default_timezone_set($this->madmin->Get_timezones('val'));
		//ini_set('display_errors','On');
		//error_reporting(E_ALL | E_STRICT);
		error_reporting(0);
		if(!$this->session->userdata('level')){
			redirect('login/logout');
			die();
		}
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
		$this->app_title = 'Panel Adminstrator';
		$this->home_link = $this->uri->segment(1);
	}
	//MAS LATIEF........................................................................
	public function index(){
		$data['title']  = 'Modul Administrator'; 
		$data['bread']	= 'Dashboard';
		$data['acthome']	= 'active';
		$this->load->view('index', $data);
	}
	public function home(){
		$this->load->view('home', $data);
	}
	public function masteragama(){
		$this->load->view('masteragama', $data);
	}
	public function ajaxdataagama(){
		$this->load->view('ajax/ajaxdataagama', $data);
	}
	public function jsondataagama(){
		$this->load->view('json/jsondataagama', $data);
	}
	public function masterpendidikan(){
		$this->load->view('masterpendidikan', $data);
	}
	public function ajaxdatapendidikan(){
		$this->load->view('ajax/ajaxdatapendidikan', $data);
	}
	public function jsondatapendidikan(){
		$this->load->view('json/jsondatapendidikan', $data);
	}
	public function masterstatus(){
		$this->load->view('masterstatus', $data);
	}
	public function ajaxdatastatus(){
		$this->load->view('ajax/ajaxdatastatus', $data);
	}
	public function jsondatastatus(){
		$this->load->view('json/jsondatastatus', $data);
	}
	public function masterwilayah(){
		$this->load->view('masterwilayah', $data);
	}
	public function ajaxdatawilayah(){
		$this->load->view('ajax/ajaxdatawilayah', $data);
	}
	public function jsondatawilayah(){
		$this->load->view('json/jsondatawilayah', $data);
	}
	public function mastericd(){
		$this->load->view('mastericd', $data);
	}
	public function ajaxdataicd(){
		$this->load->view('ajax/ajaxdataicd', $data);
	}
	public function jsondataicd(){
		$this->load->view('json/jsondataicd', $data);
	}
	public function masterkondisi(){
		$this->load->view('masterkondisi', $data);
	}
	public function masterstakes(){
		$this->load->view('masterstakes', $data);
	}
	public function mastersaran(){
		$this->load->view('mastersaran', $data);
	}
	public function mastercatatan(){
		$this->load->view('mastercatatan', $data);
	}
	public function masterkelainangigi(){
		$this->load->view('masterkelainangigi', $data);
	}
	public function ajaxdatakondisi(){
		$this->load->view('ajax/ajaxdatakondisi', $data);
	}
	public function ajaxdatasaran(){
		$this->load->view('ajax/ajaxdatasaran', $data);
	}
	public function ajaxdatacatatan_dinas(){
		$this->load->view('ajax/ajaxdatacatatan_dinas', $data);
	}
	public function ajaxdatastakes(){
		$this->load->view('ajax/ajaxdatastakes', $data);
	}
	
	public function ajaxdatakelainangigi(){
		$this->load->view('ajax/ajaxdatakelainangigi', $data);
	}
	public function jsondatakondisi(){
		$this->load->view('json/jsondatakondisi', $data);
	}
	public function jsondatasaran(){
		$this->load->view('json/jsondatasaran', $data);
	}
	public function jsondatacatatan_dinas(){
		$this->load->view('json/jsondatacatatan_dinas', $data);
	}
	
	public function jsondatastakes(){
		$this->load->view('json/jsondatastakes', $data);
	}
	
	public function jsondatakelainangigi(){
		$this->load->view('json/jsondatakelainangigi', $data);
	}
	public function masterins(){
		$this->load->view('masterins', $data);
	}
	public function ajaxdatains(){
		$this->load->view('ajax/ajaxdatains', $data);
	}
	public function jsondatains(){
		$this->load->view('json/jsondatains', $data);
	}
	public function masterpekerjaan(){
		$this->load->view('masterpekerjaan', $data);
	}
	public function ajaxdatapekerjaan(){
		$this->load->view('ajax/ajaxdatapekerjaan', $data);
	}
	public function jsondatapekerjaan(){
		$this->load->view('json/jsondatapekerjaan', $data);
	}
	public function masterbayar(){
		$this->load->view('masterbayar', $data);
	}
	public function ajaxdatabayar(){
		$this->load->view('ajax/ajaxdatabayar', $data);
	}
	public function jsondatabayar(){
		$this->load->view('json/jsondatabayar', $data);
	}
	public function masterdinas(){
		$this->load->view('masterdinas', $data);
	}
	public function ajaxdatadinas(){
		$this->load->view('ajax/ajaxdatadinas', $data);
	}
	public function jsondatadinas(){
		$this->load->view('json/jsondatadinas', $data);
	}
	public function masterjawatan(){
		$this->load->view('masterjawatan', $data);
	}
	public function ajaxdatajawatan(){
		$this->load->view('ajax/ajaxdatajawatan', $data);
	}
	public function jsondatajawatan(){
		$this->load->view('json/jsondatajawatan', $data);
	}
	public function masterdok(){
		$this->load->view('masterdok', $data);
	}
	public function ajaxdatadok(){
		$this->load->view('ajax/ajaxdatadok', $data);
	}
	public function jsondatadok(){
		$this->load->view('json/jsondatadok', $data);
	}
	public function masteruser(){
		$this->load->view('masteruser', $data);
	}
	public function ajaxdatauser(){
		$this->load->view('ajax/ajaxdatauser', $data);
	}
	public function jsondatauser(){
		$this->load->view('json/jsondatauser', $data);
	}
	public function ajaxdatapass(){
		$this->load->view('ajax/ajaxdatapass', $data);
	}
	public function ajaxuserbersama(){
		$this->load->view('ajax/ajaxuserbersama', $data);
	}
	public function jsonpenggunabersama(){
		$this->load->view('json/jsonpenggunabersama', $data);
	}
	public function mastergroupperiksan(){
		$this->load->view('mastergroupperiksan', $data);
	}
	public function masterdepartmen(){
		$this->load->view('masterdepartmen', $data);
	}
	public function jsongrouptambahpoli(){
		$this->load->view('json/jsongrouptambahpoli', $data);
	}
	public function jsongrouptambahjawatan(){
		$this->load->view('json/jsongrouptambahjawatan', $data);
	}
	public function jsondatagrouptindakan(){
		$this->load->view('json/jsondatagrouptindakan', $data);
	}
	public function jsondatanewdepartmen(){
		$this->load->view('json/jsondatanewdepartmen', $data);
	}
	public function ajaxdatagrouptindakan(){
		$this->load->view('ajax/ajaxdatagrouptindakan', $data);
	}
	public function ajaxdatanewdepartmen(){
		$this->load->view('ajax/ajaxdatanewdepartmen', $data);
	}
	public function masterdetailpemeriksaan(){
		$this->load->view('masterdetailpemeriksaan', $data);
	}
	public function jsongroupdetailpoli(){
		$this->load->view('json/jsongroupdetailpoli', $data);
	}
	public function ajaxdetailtambahperiksa(){
		$this->load->view('ajax/ajaxdetailtambahperiksa', $data);
	}
	public function jsondatadetailpemeriksaan(){
		$this->load->view('json/jsondatadetailpemeriksaan', $data);
	}
	public function mastertindakan(){
		$this->load->view('mastertindakan', $data);
	}
	public function jsonsemuapolipenu(){
		$this->load->view('json/jsonsemuapolipenu', $data);
	}
	public function jsondatatindakanmcu(){
		$this->load->view('json/jsondatatindakanmcu', $data);
	}
	public function ajaxtambahtindakan(){
		$this->load->view('ajax/ajaxtambahtindakan', $data);
	}
	public function penglaborat(){
		$this->load->view('penglaborat', $data);
	}
	public function jsonloadpemeriksaanlab(){
		$this->load->view('json/jsonloadpemeriksaanlab', $data);
	}
	public function jsonloadpemeriksaanrad(){
		$this->load->view('json/jsonloadpemeriksaanrad', $data);
	}
	public function ajaxkonfigurasipemeriksaanlab(){
		$this->load->view('ajax/ajaxkonfigurasipemeriksaanlab', $data);
	}
	public function ajaxloadbukadetailpemeriksaan(){
		$this->load->view('ajax/ajaxloadbukadetailpemeriksaan', $data);
	}
	public function ajaxtambahpemlaborat(){
		$this->load->view('ajax/ajaxtambahpemlaborat', $data);
	}
	public function ajaxtambahdetailpemsatuya(){
		$this->load->view('ajax/ajaxtambahdetailpemsatuya', $data);
	}
	public function jsondatatindakandetpem(){
		$this->load->view('json/jsondatatindakandetpem', $data);
	}
	public function ajaloaddetpemeriksaanpoli(){
		$this->load->view('ajax/ajaloaddetpemeriksaanpoli', $data);
	}
	public function pengradiologi(){
		$this->load->view('pengradiologi', $data);
	}
	public function jsondatatindakanrad(){
		$this->load->view('json/jsondatatindakanrad', $data);
	}
	public function ajaxtampilsyairradiologi(){
		$this->load->view('ajax/ajaxtampilsyairradiologi', $data);
	}
	public function tarifpaketmcu(){
		$this->load->view('tarifpaketmcu', $data);
	}
	public function jsonloadpaketmcu(){
		$this->load->view('json/jsonloadpaketmcu', $data);
	}
	public function ajaxtambahpaketmcu(){
		$this->load->view('ajax/ajaxtambahpaketmcu', $data);
	}
	public function ajaxdetailtarifmcuya(){
		$this->load->view('ajax/ajaxdetailtarifmcuya', $data);
	}
	public function ajaxrincianpemeriksaan(){
		$this->load->view('ajax/ajaxrincianpemeriksaan', $data);
	}
	public function ajaxrincianpemeriksaansamain(){
		$this->load->view('ajax/ajaxrincianpemeriksaansamain', $data);
	}
	public function ajaxposisigigikelainan(){
		$this->load->view('ajax/ajaxposisigigikelainan', $data);
	}
	public function jsondapattindakanmcudaripaketsamain(){
		$this->load->view('json/jsondapattindakanmcudaripaketsamain', $data);
	}
	public function jsondapatkanisikelainangigiodonto(){
		$this->load->view('json/jsondapatkanisikelainangigiodonto', $data);
	}
	public function jsondapattindakanmcudaripaket(){
		$this->load->view('json/jsondapattindakanmcudaripaket', $data);
	}
	public function jsondetailtarifmcuya(){
		$this->load->view('json/jsondetailtarifmcuya', $data);
	}
	//BAGIAM PENDAFTARAN
	public function pendaftaranpasien(){
		$this->load->view('pendaftaranpasien', $data);
	}
	public function cetakpemeriksaanpasien(){
		$this->load->view('cetakpemeriksaanpasien', $data);
	}
	public function cetakpemeriksaanpasienframe(){
		$this->load->view('frame/cetakpemeriksaanpasienframe', $data);
	}
	public function cetakpemeriksaankonsulframe(){
		$this->load->view('frame/cetakpemeriksaankonsulframe', $data);
	}
	public function cetakpemeriksaankonsul(){
		$this->load->view('cetakpemeriksaankonsul', $data);
	}
	public function cetakkonsul(){
		$this->load->view('cetakkonsul', $data);
	}
	public function ajaxpendaftaranpasien(){
		$this->load->view('ajax/ajaxpendaftaranpasien', $data);
	}
	public function getdatalistpemeriksaan(){
			$r=0;
			if(isset($_GET['kode_transaksi'])){
				$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
				$hdys = $this->db->get('tb_transaksi');
				$bekap = $hdys->result();
				foreach($bekap as $bsd){
					$ceks[$bsd->id_tind] = 1;
				}
			}
			//gantipemeriksaantampil didapat ketika mau ganti pemeriksaan yaaaa
			if(isset($_GET['gantipemeriksaantampil'])){
				$this->db->where('kode_transaksi', $_GET['gantipemeriksaantampil']);
				$hdys = $this->db->get('tb_transaksi');
				$bekap = $hdys->result();
				foreach($bekap as $bsd){
					$cekpilih[$bsd->id_tind] = 1;
				}
			}
			$this->db->order_by('nm_tind', 'ASC');
			//$this->db->limit('1');
			$jjus = $this->db->get('tb_tindakan');
			$tsts = $jjus->result();
			if($tsts){
				if(!isset($_GET['kode_transaksi'])){
					foreach($tsts as $fa){
						$y=$r++;
						$singa[$y]->id = $fa->id_tind;
						$singa[$y]->text = $fa->nm_tind;
						if($cekpilih[$fa->id_tind]){
							$singa[$y]->selected = "true";
						}
					}
				}else {
					foreach($tsts as $fa){
						if($ceks[$fa->id_tind]){
							$y=$r++;
							$singa[$y]->id = $fa->id_tind;
							$singa[$y]->text = $fa->nm_tind;
							$singa[$y]->selected = "true";
						}
					}
				}
			}
		print_r(json_encode($singa));
	}
	public function tampilkandaftarpemeriksaansaya(){
		//print_r($_POST);
		if(is_array($_POST['arrpem'])){
			foreach($_POST['arrpem'] as $gsf){
				$this->db->select('nm_tind');
				$this->db->where('id_tind', $gsf);
				$this->db->limit(1);
				$fvs = $this->db->get('tb_tindakan');
				$fve = $fvs->result();
				if($fve){
					$lops[] = "<b style='color:blue'>". $fve[0]->nm_tind ."</b>";
				}
			}
		}
		if(is_array($lops)){
			echo implode(", ", $lops);
		}else {
			echo '<b>-</b>';
		}
	}
	
	public function getnamadinas(){
		//$singa = new stdClass();
			$r=0;
			//$this->db->limit('1');
			$this->db->select('id_dinas, nm_dinas');
			$this->db->order_by('nm_dinas', 'ASC');
			$cmb1 = $this->db->get('tb_dinas');
			$cmb1 = $cmb1->result();
			if($cmb1){
					foreach($cmb1 as $fa){
						$y=$r++;
						$singa[$y]->id = $fa->id_dinas;
						$singa[$y]->text = $fa->nm_dinas;
					}
			}
		print_r(json_encode($singa));
	}
	
	public function getnamadinasilamedex(){
		//$singa = new stdClass();
			$r=0;
			//$this->db->limit('1');
			$this->db->like('ila_medex', 'ila');
			$this->db->or_like('ila_medex', 'medex');
			$this->db->select('id_dinas, nm_dinas');
			$this->db->order_by('nm_dinas', 'ASC');
			$cmb1 = $this->db->get('tb_dinas');
			$cmb1 = $cmb1->result();
			if($cmb1){
					foreach($cmb1 as $fa){
						$y=$r++;
						$singa[$y]->id = $fa->id_dinas;
						$singa[$y]->text = $fa->nm_dinas;
					}
			}
		print_r(json_encode($singa));
	}
	
	
	public function getdatapangkatjson(){
		//$singa = new stdClass();
		$singa[0]->id = "";
		$singa[0]->text = "-";
		if(isset($_GET['pangkat'])){
			if($_GET['pangkat'] == ""){
				$singa[0]->selected = "true";
			}
		} else {
			$singa[0]->selected = "true";
		}
		if($_GET['nmpek']){
			$r=1;
			$this->db->where('nm_pekerjaan', clean_data($_GET['nmpek']));
			$this->db->limit('1');
			$jjus = $this->db->get('tb_pekerjaan');
			$tsts = $jjus->result();
			if($tsts){
				if($tsts[0]->list_pangkat != ""){
					$gat = explode(", ", $tsts[0]->list_pangkat);
					foreach($gat as $fa){
						$y=$r++;
						if(isset($_GET['pangkat'])){
							if($_GET['pangkat'] == clean_data($fa)){
								$singa[$y]->selected = "true";
							}
						}
						$ggg = clean_data($fa);
						$singa[$y]->id = $ggg;
						$singa[$y]->text = $ggg;
					}
				}
			}
		}
		print_r(json_encode($singa));
	}
	public function getdatadepartmen(){
		//$singa = new stdClass();
		$singa[0]->id = "";
		$singa[0]->text = "-";
		if(isset($_GET['id_dept'])){
			if($_GET['id_dept'] == ""){
				$singa[0]->selected = "true";
			}
		} else {
			$singa[0]->selected = "true";
		}
		if($_GET['id_jawatan']){
			$r=1;
			$this->db->where('id_jawatan', clean_data($_GET['id_jawatan']));
			//$this->db->limit('1');
			$jjus = $this->db->get('tb_departmen');
			$tsts = $jjus->result();
			if($tsts){
					foreach($tsts as $fa){
						$y=$r++;
							if($fa->id_dept == $_GET['id_dept']){
								$singa[$y]->selected = "true";
							}
						$singa[$y]->id = $fa->id_dept;
						$singa[$y]->text = $fa->nm_dept;
					}
			}
		}
		print_r(json_encode($singa));
	}
	public function jsoncaridatapasien(){
		$this->load->view('json/jsoncaridatapasien', $data);
	}
	
	public function jsoncaririwayatpasienok(){
		$this->load->view('json/jsoncaririwayatpasienok', $data);
	}
	public function tampilkanfilterriwayat(){
		$this->load->view('tampilkanfilterriwayat', $data);
	}
	
	public function jsonkomponenbiayadaftar(){
		//print_r($this->uri->segment(4));
		$this->load->view('json/jsonkomponenbiayadaftar', $data);
	}
	public function jsontambahbiayapaket(){
		$this->load->view('json/jsontambahbiayapaket', $data);
	}
	public function jsondatadetailpemeriksaanrad(){
		$this->load->view('json/jsondatadetailpemeriksaanrad', $data);
	}
	public function jsondatatindakandetpemrad(){
		$this->load->view('json/jsondatatindakandetpemrad', $data);
	}
	public function ajaxdetailtambahperiksarad(){
		$this->load->view('ajax/ajaxdetailtambahperiksarad', $data);
	}
	public function ajaloaddetpemeriksaanrad(){
		$this->load->view('ajax/ajaloaddetpemeriksaanrad', $data);
	}
	public function jsondataregistrasiharian(){
		$this->load->view('json/jsondataregistrasiharian', $data);
	}
	public function pendaftarankonsul(){
		$this->load->view('pendaftarankonsul', $data);
	}
	public function ajaxpendaftarankonsul(){
		$this->load->view('ajax/ajaxpendaftarankonsul', $data);
	}
	public function jsoncaridatareferensi(){
		$this->load->view('json/jsoncaridatareferensi', $data);
	}
	public function jsonkomponenbiayakonsul(){
		$this->load->view('json/jsonkomponenbiayakonsul', $data);
	}
	public function jsondataregistrasikonsul(){
		$this->load->view('json/jsondataregistrasikonsul', $data);
	}
	public function gantipaketpemeriksaan(){
		$this->load->view('ajax/gantipaketpemeriksaan', $data);
	}
	public function inputpemeriksaan(){
		$this->load->view('inputpemeriksaan', $data);
	}
	public function kesimpulanlaboratorium(){
		$this->load->view('kesimpulanlaboratorium', $data);
	}
	public function jsonpasienpemeriksaan(){
		$this->load->view('json/jsonpasienpemeriksaan', $data);
	}
	public function jsonhomedata(){
		$this->load->view('json/jsonhomedata', $data);
	}
	public function jsonpasienevaluasi(){
		$this->load->view('json/jsonpasienevaluasi', $data);
	}
	public function jsonpasienkesimpulanlaborat(){
		$this->load->view('json/jsonpasienkesimpulanlaborat', $data);
	}
	
	public function jsonpasienpembayaran(){
		$this->load->view('json/jsonpasienpembayaran', $data);
	}
	public function jsonlapilamedex(){
		$this->load->view('json/jsonlapilamedex', $data);
	}
	public function cetaklapilamedexframe(){
		$this->load->view('frame/cetaklapilamedexframe', $data);
	}
	public function cetaklapcasisframe(){
		$this->load->view('frame/cetaklapcasisframe', $data);
	}
	public function inputpembayaranpasien(){
		$this->load->view('inputpembayaranpasien', $data);
	}
	public function cetakkwitansipasienframe(){
		$this->load->view('frame/cetakkwitansipasienframe', $data);
	}
	public function tampilkandetailpemeriksaandaripasien(){
		$this->load->view('tampilkandetailpemeriksaandaripasien', $data);
	}
	public function jsondatapemeriksaanperpasien(){
		$this->load->view('json/jsondatapemeriksaanperpasien', $data);
	}
	public function inputisidetailpemeriksaan(){
		if($_GET['idins'] == "2"){
			$this->load->view('inputisidetailpemeriksaanlab', $data);
		} else if($_GET['idins'] == "3"){
			$this->load->view('inputisidetailpemeriksaanrad', $data);
		}else if($_GET['idins'] == "4"){
			$this->load->view('inputisidetailpemeriksaanchamber', $data);
		} else {
			$this->load->view('inputisidetailpemeriksaan', $data);
		}
	}
	public function historypemeriksaan(){
		$this->load->view('historypemeriksaan');
	}
	public function historypemeriksaanrad(){
		$this->load->view('historypemeriksaanrad');
	}
	public function hitungbmtya(){
		//MARI KITA HITUNG BMT
		if(is_numeric($_POST['brt']) AND is_numeric($_POST['tgg'])){
			$tnggbdn1 = $_POST['tgg']/100;
			$tnggbdn3 = $tnggbdn1*$tnggbdn1;
			$imt = $_POST['brt']/$tnggbdn3;
			$imt2 = round($imt, 2);
			$max = $tnggbdn3*24.9;
			$max = round($max, 2);
			$ideal = $max-10;
			$min = $max-20;
			
			$katakata = cek_bmi($imt2);
			if($katakata == "Overweight"){
				$katakata .= " ". round($_POST['brt']-$max) ." kg";
			}
			if($katakata == "Obesitas"){
				$katakata .= " ". round($_POST['brt']-$max) ." kg";
			}
			if($katakata == "Underwight"){
				$katakata .= " ". round($max-$_POST['brt']) ." kg";
			}
			echo $imt2 ."__".$katakata ."__".$max."__".$ideal."__".$min;
		}
	}
	public function jsondapatdetailchamber(){
		$this->load->view('json/jsondapatdetailchamber', $data);
	}
	public function jsondatamenueval(){
		$this->load->view('json/jsondatamenueval', $data);
	}
	public function ajaxdetailpemeriksaanchamber(){
		$this->load->view('ajax/ajaxdetailpemeriksaanchamber', $data);
	}
	public function evaluasipasien(){
		$this->load->view('evaluasipasien', $data);
	}
	public function inputpembayaran(){
		$this->load->view('inputpembayaran', $data);
	}
	public function inputevaluasipasien(){
		$this->load->view('inputevaluasipasien', $data);
	}
	public function cetaklabframe(){
		$this->load->view('frame/cetaklabframe', $data);
	}
	public function cetaklabframedua(){
		$this->load->view('frame/cetaklabframedua', $data);
	}
	
	public function daftardetailevaluasi(){
		if($this->u3 == "sttpemeriksaan"){
			$this->load->view('daftardetailevaluasisttpemeriksaan', $data);
		}
		if($this->u3 == "anamnesa"){
			$this->load->view('daftardetailevaluasianamnesa', $data);
		}
		if($this->u3 == "periksatambahan"){
			$this->load->view('daftardetailevaluasiperiksatambahan', $data);
		}
		if($this->u3 == "diagnosakelainan"){
			$this->load->view('daftardetailevaluasidiagnosakelainan', $data);
		}
		if($this->u3 == "kesimpulansaran"){
			$this->load->view('daftardetailevaluasikesimpulansaran', $data);
		}
		//echo $this->u3;
	}
	public function ajaxfiltercetakdatareg(){
		$this->load->view('ajax/ajaxfiltercetakdatareg', $data);
	}
	public function ajaxfiltercetakdataregkonsul(){
		$this->load->view('ajax/ajaxfiltercetakdataregkonsul', $data);
	}
	public function cetakdataexcelmcu(){
		$this->load->view('cetakdataexcelmcu', $data);
	}
	public function cetakdataexcelmcukonsul(){
		$this->load->view('cetakdataexcelmcukonsul', $data);
	}
	public function importdatapasien(){
		//ambil data untuk databse dan password
		$database = $this->madmin->Get_setting('mcu_database');
		$password = $this->madmin->Get_setting('mcu_passdb');
		$data['database'] = $database;
		$data['pasword']  = $password;
		$this->load->view('importdatapasien', $data);
	}
	public function cetaktatacaraimportpasien(){
		$this->load->view('cetaktatacaraimportpasien', $data);
	}
	public function cetakkwitansipasien(){
		$this->load->view('cetakkwitansipasien', $data);
	}
	public function cetakhasilkesimpulansaranframe(){
		$this->load->view('frame/cetakhasilkesimpulansaranframe', $data);
	}
	public function cetakhasilkesimpulansaranframepdf(){
		$this->load->view('frame/cetakhasilkesimpulansaranframepdf', $data);
	}
	public function cetakresumekesimpulansaranframe(){
		$this->load->view('frame/cetakresumekesimpulansaranframe', $data);
	}
	
	public function cetakresumekesimpulansaranframepdf(){
		$this->load->view('frame/cetakresumekesimpulansaranframepdf', $data);
	}
	
	
	public function cetakresumekesimpulansaranframeumum(){
		$this->load->view('frame/cetakresumekesimpulansaranframeumum', $data);
	}
	public function tagihanpasien(){
		$this->load->view('tagihanpasien', $data);
	}
	public function lapilamedex(){
		$this->load->view('lapilamedex', $data);
	}
	public function lapmcucasis(){
		$this->load->view('lapmcucasis', $data);
	}
	public function tampilcetakbukunondinas(){
		$this->load->view('tampilcetakbukunondinas', $data);
	}
	public function cetaklapkasirbiasaframe(){
		$this->load->view('frame/cetaklapkasirbiasaframe', $data);
	}
	public function cetaklapkasirkemenkesframe(){
		$this->load->view('frame/cetaklapkasirkemenkesframe', $data);
	}
	public function cetaklapkasirkemenkesarsipframe(){
		$this->load->view('frame/cetaklapkasirkemenkesarsipframe', $data);
	}
	public function cetaklapkasircnoocframe(){
		$this->load->view('frame/cetaklapkasircnoocframe', $data);
	}
	public function cetaklapkasircnoocarsipframe(){
		$this->load->view('frame/cetaklapkasircnoocarsipframe', $data);
	}
	public function cetakkartu(){
		$this->load->view('cetakkartu', $data);
	}
	public function tampilkanodontogramok(){
		$this->load->view('tampilkanodontogramok', $data);
	}
	public function mcuanalisis(){
		$this->load->view('mcuanalisis', $data);
	}
	public function laporanlaporan(){
		$this->load->view('laporanlaporan', $data);
	}
	public function ajaxplaporanlaporan(){
		if($this->u3 == "a3"){
			$this->load->view('ajax/ajaxpriwayatpasien', $data);
		}else{
			$this->load->view('ajax/ajaxplaporanlaporan', $data);
		}
	}
	
	public function jsonkelompokanalisa(){
		$this->load->view('json/jsonkelompokanalisa', $data);
	}
	
	public function ayocetakcetak(){
		if($_GET['urilaporan'] == "a1"){
			$this->load->view('cetak/ayocetakcetak1', $data);
		}
		if($_GET['urilaporan'] == "a2"){
			$this->load->view('cetak/ayocetakcetak2', $data);
		}
	}
	
	
	public function analisa1(){
		//print_r($_GET);
		if($_GET['idins'] == "diagnosaicd"){
			//kalo 2 masukknya laborat yaaaaa
			$this->load->view('analisadata/diagnosaicdsatu', $data);
		} else if($_GET['idins'] == "diagnosakesehatan"){
			//kalo 2 masukknya laborat yaaaaa
			$this->load->view('analisadata/diagnosakesehatan', $data);
		} else if($_GET['idins'] == "4"){
			//kalo 2 masukknya laborat yaaaaa
			if($_GET['urikey'] != "pemfisik"){
				$this->load->view('analisadata/pemeriksaanlainnyahasil', $data);
			} else {
				$this->load->view('analisadata/detailpemeriksaanfisik', $data);
			}
		} else if($_GET['idins'] == "3"){
			$this->load->view('analisadata/pemeriksaanradiologianalisa', $data);
		} else if($_GET['idins'] == "2"){
			$this->load->view('analisadata/pemeriksaanlaboratanalisa', $data);
		} else if($_GET['idins'] == "daftarpeserta"){
			$this->load->view('analisadata/pemeriksaandaftarpaket', $data);
		} else {
			$this->load->view('errormode', $data);
		}	
	}
	public function analisa2(){
		//print_r($_GET);
		if($_GET['idins'] == "diagnosaicd"){
			//kalo 2 masukknya laborat yaaaaa
			$this->load->view('analisadata/diagnosaicd', $data);
		} else if($_GET['idins'] == "diagnosakesehatan"){
			//kalo 2 masukknya laborat yaaaaa
			$this->load->view('analisadata/diagnosakesehatandua', $data);
		} else if($_GET['idins'] == "4"){
			//kalo 2 masukknya laborat yaaaaa
			if($_GET['urikey'] != "pemfisik"){
				$this->load->view('analisadata/pemeriksaanlainnyahasildua', $data);
			}else {
				$this->load->view('analisadata/kosongandua', $data);
			}
		} else if($_GET['idins'] == "3"){
			$this->load->view('analisadata/pemeriksaanradiologianalisadua', $data);
		} else if($_GET['idins'] == "2"){
			$this->load->view('analisadata/pemeriksaanlaboratanalisadua', $data);
		} else if($_GET['idins'] == "daftarpeserta"){
			$this->load->view('analisadata/pemeriksaandaftarpaketdua', $data);
		} else {
			$this->load->view('errormode', $data);
		}
	}
	public function analisa3(){
		//print_r($_GET);
		if($_GET['id'] == "bmigizi"){
			$this->load->view('analisafisik/bmigizi', $data);
		} else if($_GET['id'] == "tekanandarah"){
			$this->load->view('analisafisik/fisiktekanandarah', $data);
		}  else {
			$this->load->view('analisafisik/pemeriksaanfisiklain', $data);
		}
	}
	public function analisa4(){
		//print_r($_GET);
		if($_GET['id'] == "bmigizi"){
			$this->load->view('analisafisik/bmigizidua', $data);
		}else if($_GET['id'] == "tekanandarah"){
			$this->load->view('analisafisik/fisiktekanandarahdua', $data);
		} else {
			$this->load->view('analisafisik/pemeriksaanfisiklaindua', $data);
		}
	}
	public function jsondatapasienpem_daftarpaket_hasilya(){
		$this->load->view('json/jsondatapasienpem_daftarpaket_hasilya', $data);
	}
	public function jsondatapasienkeseatan_pasien_kerjaya(){
		$this->load->view('json/jsondatapasienkeseatan_pasien_kerjaya', $data);
	}
	
	public function tampilkanhasiltekanandarah(){
		//print_r($_POST);
		if(!empty($_POST['td1']) and !empty($_POST['td2'])){
			echo hitungtekanandarah($_POST['td1'], $_POST['td2']);
		}else{
			echo "";
		}
	}
	
	public function cetakresumekesimpulansaranframeumumtemplate(){
		$this->load->view('frame/cetakresumekesimpulansaranframeumumtemplate', $data);
	}
	
	public function cetakresumekesimpulansaranframeumumsetup(){
		$this->load->view('frame/cetakresumekesimpulansaranframeumumsetup', $data);
	}
	public function cetakresumepemeriksaanbukutemplate(){
		$this->load->view('cetakresumepemeriksaanbukutemplate', $data);
	}
	
	public function khususlatief(){
		$this->db->where("nama_kesansaran", "catatan_tambahan_dinas");
		$fdvhsdbf = $this->db->get('tb_resume_pasien');
		$andsbndf = $fdvhsdbf->result();
		foreach($andsbndf as $rgdhsf){
			if(!empty($rgdhsf->isi_kesansaran)){
				$this->db->where('id_ctd', trim(trim($rgdhsf->isi_kesansaran)));
				$cmb1 = $this->db->get('tb_catatan_dinas');
				$cmb1 = $cmb1->row();
				if($cmb1){
					$snbgnf['isi_kesansaran'] = $cmb1->nm_ctd;
					print_r($snbgnf['isi_kesansaran']);
					//$this->db->where('id_res', $rgdhsf->id_res);
					//$this->db->update('tb_resume_pasien', $snbgnf);
				}
			}
		}
		
	}
	public function perbaikisgot(){
		$svvd = "select kode_transaksi, id_reg_detpem, id_tind_detpem, id_pem_deb from tb_register_detailpemeriksaan where id_pem_deb IN (33, 34) ";
		$gsvd = $this->db->query($svvd);
		$fsvd = $gsvd->result();
		foreach($fsvd as $fvdvsw){
			$nami = 0;
			if($fvdvsw->id_pem_deb == 33){
				$nami = 5281;
			}
			if($fvdvsw->id_pem_deb == 34){
				$nami = 5280;
			}
			//echo $fvdvsw->id_tind_detpem . " -- > ".$nami ."<hr />";
			$vdcsb[$fvdvsw->kode_transaksi][$fvdvsw->id_reg_detpem] = 1;
			if(count($vdcsb[$fvdvsw->kode_transaksi]) > 2){
				echo $fvdvsw->kode_transaksi ."<hr />";
			}
			//$this->db->where('id_reg_detpem', $fvdvsw->id_reg_detpem);
			//$this->db->update('tb_register_detailpemeriksaan', $vdcsb);
			
			
		}
		//print_r($vsvdb);
	}
	
	
	public function cetakpilihan(){
		$this->load->view('cetakpilihan', $data);
	}
	
	public function cetakrapid(){
		$this->load->view('cetakrapid', $data);
	}
	
	
	
}