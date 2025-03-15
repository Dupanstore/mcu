<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		//error_reporting(E_ALL^E_NOTICE);
		error_reporting(0);
		date_default_timezone_set($this->madmin->Get_timezones('val'));
	}
	
	public function registerpas(){ 
		$req = apache_request_headers();
		
		if ($req['x-username'] != "ollakespra2023") {
			
			die("Gagal Terhubung Server");
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die("Gagal Terhubung Server");
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die("Gagal Terhubung Server");
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		//print_r($bbd);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		
		$nama_lengkap = $bbd->request->t_data->nama_lengkap;
		$nip_nrp_nik = $bbd->request->t_data->nip_nrp_nik;
		$no_ktp = $bbd->request->t_data->no_ktp;
		$jenis_kelamin = $bbd->request->t_data->jenis_kelamin;
		$tempat_lahir = $bbd->request->t_data->tempat_lahir;
		$tanggal_lahir = $bbd->request->t_data->tanggal_lahir;
		$alamat = $bbd->request->t_data->alamat;
		$agama = $bbd->request->t_data->agama;
		$telp = $bbd->request->t_data->telp;
		$pendidikan = $bbd->request->t_data->pendidikan;
		$marital = $bbd->request->t_data->marital;
		$pekerjaan = $bbd->request->t_data->pekerjaan;
		
		
		if ($validuser != "req123Lpgst") {
			die("Gagal Terhubung Server");
		}
		if ($validpass != "nG4fJ0jmnv8") {
			die("Gagal Terhubung Server");
		}
		//CEKRICEKKKK
		$typejwt = "P";
		$ckk = $this->db->query("select max(no_reg) as no_reg_new from tb_pasien where no_reg like '".$typejwt."%'");
		$cks = $ckk->row();
		if($cks->no_reg_new == ""){
			$kodepasien = $typejwt."000000001";
		}else {
			$noUrut = (int) substr($cks->no_reg_new, 1, 9); 
			$noUrut++;
			$kodepasien = $typejwt . sprintf("%09s", $noUrut);
		}
		
		$datapasien = array(
			'no_reg' => $kodepasien,
			'nm_pas' => clean_data($nama_lengkap),
			'tmp_lahir_pas' => clean_data($tempat_lahir),
			'tgl_lhr_pas' => date("Y-m-d", strtotime($tanggal_lahir)),
			'jenkel_pas' => clean_data($jenis_kelamin),
			'id_agama' => clean_data($agama),
			'alamat_pas' => clean_data($alamat),
			'no_ktp_pas' => clean_data($no_ktp),
			'no_tlp_pas' => clean_data($telp),
			'nm_pekerjaan' => clean_data($pekerjaan),
			'kawin_pas' => clean_data($marital),
			'id_pendidikan' => clean_data($pendidikan),
			'nip_nrp_nik' => clean_data($nip_nrp_nik),
		);
		
		$this->db->where("no_ktp_pas", $no_ktp);
		$ceki = $this->db->get("tb_pasien");
		$ceko = $ceki->row();
		if($ceko){
			die("Data Sudah Terdaftar..");
		}
			$datapasien['tgl_daftar'] = date("Y-m-d H:i:s");
			$this->db->insert('tb_pasien', $datapasien);
			print_r("success");
		
	}
	
	
	public function cetakhasilkesimpulansaranframe(){
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select tb_register.kode_transaksi, tb_register.tgl_awal_reg, tb_register.cara_bayar, tb_register.no_filemcu, tb_paket.nm_paket from  tb_register, tb_paket, tb_pasien 
		where tb_register.no_reg=tb_pasien.no_reg 
		and tb_register.id_paket=tb_paket.id_paket 
		and tb_pasien.id_pas='".$id_pas."'  
		and tb_register.konsul=''
		order by tb_register.id_reg DESC ";
		$data = $this->db->query($_log);
		$query = $data->row();
		//print_r($query);
		if(!$query){
			die("Tidak Menemukan Data..");
		}
		$diti['query'] = $query;
		$this->load->view('cetakhasilkesimpulansaranframe', $diti);
	}
	public function getmcudata(){
		if(empty($_GET['uid'])){
			$returnArr = array("ResponseCode"=>"400","Result"=>"false","ResponseMsg"=>"Data Tidak Ditemukan");
			echo json_encode($returnArr);
			die();
		}
		$que = "select b.tgl_lhr_pas, a.def_ttd, a.id_paket, a.kode_transaksi, a.no_reg, tgl_awal_reg, a.id_reg, a.no_filemcu, b.pangkat_pas, b.nip_nrp_nik, b.id_jawatan, b.id_pas, b.nm_pas, b.no_tlp_pas, a.id_dinas_dua, b.alamat_pas, c.autosert, c.nm_paket from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket ";
		$que .= " and a.qr_code_keys='".$_GET['uid']."' ";
		$gsv = $this->db->query($que);
		$sdb = $gsv->row();
		
		//$sertifikat = "B";
		$sertifikat = "C";
		//print_r($que);
		if($sdb){
			$this->db->where("id_jawatan", $sdb->id_jawatan);
			$sbdvd = $this->db->get('tb_jawatan');
			$gsdbv = $sbdvd->row();
			$sdb->nmjawatan = $gsdbv->nm_jawatan;
			
			//ambil data resume
			$sdb->ketresume = "";
			$sdb->ketresume_en = "";
			$sdb->jenisdata = "N";
			
			$this->db->where("nama_kesansaran", "keterangan_sehat");
			$this->db->where("kode_transaksi", $sdb->kode_transaksi);
			$msndd = $this->db->get('tb_resume_pasien');
			$sdwew = $msndd->row();
			if(!empty($sdwew->isi_kesansaran)){
				//amnil keterangan resumeeeeee
				$this->db->select("nm_kondisi, sert_khusus");
				$this->db->where("id_kondisi", $sdwew->isi_kesansaran);
				$snsds = $this->db->get("tb_kondisi");
				$asnna = $snsds->row();
				$sdb->ketresume = $asnna->nm_kondisi;
				$sdb->ketresume_en = $asnna->nm_kondisi_en;
			}
			
			
			if($sdb->id_dinas_dua > 0){
				$this->db->select("tipe_dinas, sertifikat_khusus, ila_medex");
				$this->db->where("id_dinas", $sdb->id_dinas_dua);
				$ksdnss = $this->db->get("tb_dinas");
				$skjjks = $ksdnss->row();
				if(!empty($skjjks->tipe_dinas)){
					$sdb->jenisdata = $skjjks->tipe_dinas;
				}
				if($skjjks->sertifikat_khusus == "Y"){
					if($asnna->sert_khusus == "Y"){
						//$sertifikat = "K";
					}
				}
				$sdb->ila_medex = $skjjks->ila_medex;
				
			}
			
			if($sdb->autosert == "Y"){
				$sertifikat = "K";
			}
			
			
			//$sertifikat = "K";
			$sdb->jenis_sertifikat = $sertifikat;
			
			if($sdb->def_ttd > 0){
				$this->db->where('id_dok', $sdb->def_ttd);
				$cmb1 = $this->db->get('tb_dokter');
				$cmb1 = $cmb1->row();
				$sdb->tandatangan = $cmb1->nm_dok;
			}else{
				$this->db->where('id_dok', is_def_ttdkatim());
				$cmb1 = $this->db->get('tb_dokter');
				$cmb1 = $cmb1->row();
				$sdb->tandatangan = $cmb1->nm_dok;
			}
			
			if($sdb->jenis_sertifikat == "K"){
				//ambil chamber f1
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 198);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c1 = $sopp->kesimpulan_det_pemeriksaan;
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 202);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c2 = $sopp->kesimpulan_det_pemeriksaan;
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 412);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c3 = $sopp->kesimpulan_det_pemeriksaan;
				
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 203);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c4 = $sopp->kesimpulan_det_pemeriksaan;
				
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 200);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c5 = $sopp->kesimpulan_det_pemeriksaan;
				
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 199);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c6 = $sopp->kesimpulan_det_pemeriksaan;
				
				$this->db->select("kesimpulan_det_pemeriksaan");
				$this->db->where("kode_transaksi", $sdb->kode_transaksi);
				$this->db->where("id_tind_detpem", 6630);
				$this->db->where("id_parent_chamber", 411);
				$this->db->limit("1");
				$sapp = $this->db->get("tb_register_detailpemeriksaan");
				$sopp = $sapp->row();
				$sdb->c7 = $sopp->kesimpulan_det_pemeriksaan;
			}

			
			//sekarang cek dinas non dnas
			
			$returnArr = array("ResponseCode"=>"200","Result"=>$sdb,"ResponseMsg"=>"Ok");
		}else{
			$returnArr = array("ResponseCode"=>"400","Result"=>"false","ResponseMsg"=>"Data Tidak Ditemukan");
		}
		echo json_encode($returnArr);
		//print_r($returnArr);
	}
	
	public function getantigendata(){
		$this->load->view('getantigendata');
	}
	public function getloginapp(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$tgllhr = $bbd->request->t_data->Password;
		$weeeee = substr($tgllhr, 0, 4)."-".substr($tgllhr, 4, 2)."-".substr($tgllhr, 6, 2);
		
		$noreg = $bbd->request->t_data->Username;
		
		if (strlen($noreg) < 6) {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Minimal 6 Karakter";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		$_log = "select * from  tb_pasien ";
		$_log .= "where (no_reg='".$noreg."' OR no_ktp_pas='".$noreg."' OR nip_nrp_nik='".$noreg."') and tgl_lhr_pas='".$weeeee."' ";
		$data = $this->db->query($_log);
		$query = $data->row();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username / Tanggal Lahir Tidak Sesuai";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
	}
	
	
	
	public function savegeneratebooking(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		
			
			
			
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		
		$id_pas = $bbd->request->t_data->id_pas;
		$tgl_lhr = $bbd->request->t_data->tgl_lhr;
		$tanggal_daftar = $bbd->request->t_data->tanggal_daftar;
		$id_paket = $bbd->request->t_data->id_paket;
		$id_bayar = $bbd->request->t_data->id_bayar;
		$kode_unik = $bbd->request->t_data->kode_unik;
		
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  api_booking where nomor='".$id_pas."' and tglbooking='".$tanggal_daftar."' ";
		$data = $this->db->query($_log);
		$query = $data->row();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Anda Sudah Melakukan Booking Online untuk tanggal ". $tanggal_daftar;
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}else{
			//saatnya simpan data
			$sgfdfd = array(
				'msg' => $tanggal_daftar.' / '.$kode_unik,
				'nomor' => $id_pas,
				'tglbooking' => $tanggal_daftar,
				'tglsimpan' => date("Y-m-d H:i:s"),
				'id_paket' => $id_paket,
				'cara_byr' => $id_bayar,
			);
			$this->db->insert("api_booking", $sgfdfd);
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = 'success';
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	public function getprinthasil(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		$idmcu = $bbd->request->t_data->idmcu;
		$idpaket = $bbd->request->t_data->idpaket;
		$data['idmcu'] = $idmcu;
		$data['idpaket'] = $idpaket;
		$data['id_pas'] = $id_pas;
		
		if ($validuser != "req123Lpgst") {
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			die();
		}
		
		$this->load->view('rest/getprinthasil', $data);
	}
	public function getprintresume(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		$idmcu = $bbd->request->t_data->idmcu;
		$idpaket = $bbd->request->t_data->idpaket;
		$data['idmcu'] = $idmcu;
		$data['idpaket'] = $idpaket;
		$data['id_pas'] = $id_pas;
		
		if ($validuser != "req123Lpgst") {
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			die();
		}
		
		$this->load->view('rest/getprintresume', $data);
	}
	public function getresumepemeriksaan(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		$idreg = $bbd->request->t_data->idreg;
		$idmcu = $bbd->request->t_data->idmcu;
		$idpaket = $bbd->request->t_data->idpaket;
		$data['idmcu'] = $idmcu;
		$data['idpaket'] = $idpaket;
		$data['id_pas'] = $id_pas;
		
		if ($validuser != "req123Lpgst") {
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			die();
		}
		
		$this->load->view('rest/getresumepemeriksaan', $data);
	}
	
	
	public function gethasilpemeriksaan(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		$idreg = $bbd->request->t_data->idreg;
		$idmcu = $bbd->request->t_data->idmcu;
		$idpaket = $bbd->request->t_data->idpaket;
		$data['idmcu'] = $idmcu;
		$data['idpaket'] = $idpaket;
		$data['id_pas'] = $id_pas;
		
		if ($validuser != "req123Lpgst") {
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			die();
		}
		
		$this->load->view('rest/gethasilpemeriksaan', $data);
	}
	
	
	public function getidregterakhir(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		if ($validuser != "req123Lpgst") {
			
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			
			die();
		}
		
		
		$_log = "select tb_register.id_reg, tb_register.tgl_awal_reg, tb_register.cara_bayar, tb_register.no_filemcu, tb_paket.nm_paket from  tb_register, tb_paket, tb_pasien 
		where tb_register.no_reg=tb_pasien.no_reg 
		and tb_register.id_paket=tb_paket.id_paket 
		and tb_pasien.id_pas='".$id_pas."'  
		and tb_register.konsul='' and tb_register.publikasikan='Y'
		order by tb_register.id_reg DESC ";
		$data = $this->db->query($_log);
		$query = $data->row();
		echo $query->id_reg;
		die();
		
	}
	
	
	
	
	public function getdetailkunjungan(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		$idreg = $bbd->request->t_data->idreg;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select tb_register.kode_transaksi, tb_register.qr_code_keys, tb_register.id_dinas_dua, tb_register.id_paket, tb_register.id_reg, tb_register.tgl_awal_reg, tb_register.cara_bayar, tb_register.no_filemcu, tb_paket.nm_paket from  tb_register, tb_paket, tb_pasien 
		where tb_register.no_reg=tb_pasien.no_reg 
		and tb_register.id_paket=tb_paket.id_paket 
		and tb_pasien.id_pas='".$id_pas."'  and tb_register.id_reg=".$idreg."
		order by tb_register.id_reg DESC ";
		$data = $this->db->query($_log);
		$query = $data->row();
		
		
		$this->db->where("nama_kesansaran", "keterangan_sehat");
		$this->db->where("kode_transaksi", $query->kode_transaksi);
		$msndd = $this->db->get('tb_resume_pasien');
		$sdwew = $msndd->row();
		if(!empty($sdwew->isi_kesansaran)){
			//amnil keterangan resumeeeeee
			$this->db->select("nm_kondisi, sert_khusus");
			$this->db->where("id_kondisi", $sdwew->isi_kesansaran);
			$snsds = $this->db->get("tb_kondisi");
			$asnna = $snsds->row();
			$sdb->ketresume = $asnna->nm_kondisi;
		}
		
		$sdhgdwver = "select auto_grounded, auto_dinas from tb_paket where id_paket=".$query->id_paket." ";
		$eretryete = $this->db->query($sdhgdwver);
		$sjhdgrher = $eretryete->row();
		//print_r($query);
		
		$sdhgdwver = "select sertifikat_khusus, tipe_dinas from tb_dinas where id_dinas=".$query->id_dinas_dua." ";
		$eretryete = $this->db->query($sdhgdwver);
		$incekkodedinas = $eretryete->row();
		$pangkasnoreg = "N";
		$sertifikat = "B";
		if($incekkodedinas){
			if(!empty($incekkodedinas->tipe_dinas)){
				$pangkasnoreg = $incekkodedinas->tipe_dinas;
			}
			if($incekkodedinas->sertifikat_khusus == "Y"){
				if($asnna->sert_khusus == "Y"){
					$sertifikat = 'K';
				}
			}
		}
		
		if($pangkasnoreg == "N"){
			if($sjhdgrher->auto_dinas =="Y"){
				$pangkasnoreg = 'D';
			}
		}
		
		$query->jenisdinas = $pangkasnoreg;
		$query->sertifikat = $sertifikat;
		$query->ketresume = $asnna->nm_kondisi;
		
		
		
		header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		
	}
	
	
	public function getriwayatkunjungan(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select tb_register.id_reg, tb_register.tgl_awal_reg, tb_register.cara_bayar, tb_register.no_filemcu, tb_paket.nm_paket from  tb_register, tb_paket, tb_pasien 
		where tb_register.no_reg=tb_pasien.no_reg 
		and tb_register.id_paket=tb_paket.id_paket 
		and tb_pasien.id_pas='".$id_pas."'  
		and tb_register.konsul='' and tb_register.publikasikan='Y'
		order by tb_register.id_reg DESC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		
	}
	
	
	public function getdatalistbooking(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$id_pas = $bbd->request->t_data->id_pas;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  api_booking, tb_paket 
		where api_booking.id_paket=tb_paket.id_paket 
		and api_booking.nomor='".$id_pas."' 
		order by api_booking.id DESC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		
	}
	
	public function getdatacarabayar(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  tb_bayar where id_bayar > 1 order by id_bayar ASC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	
	
	
	public function getdetailartikel(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		$getid = $bbd->request->t_data->id;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  api_berita where id=".$getid." ";
		$data = $this->db->query($_log);
		$query = $data->row();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	
	public function getberitaall(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select id,pname,date,pimg,prel from  api_berita where 1=1 order by date DESC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	public function getberitaterkini(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select id,pname,date,pimg,prel from  api_berita where 1=1 order by date DESC limit 5 ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	
	public function getdatapaket(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  tb_paket where tampil_online='Y' order by id_paket ASC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	public function getdataspesialis(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($req['x-password'] != "ww333bbSukses") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Password Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		
		$validuser = $bbd->request->t_data->Username;
		$validpass = $bbd->request->t_data->Password;
		if ($validuser != "req123Lpgst") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		if ($validpass != "nG4fJ0jmnv8") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Kredential";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		
		$_log = "select * from  api_spesialis order by id ASC ";
		$data = $this->db->query($_log);
		$query = $data->result();
		//print_r($query);
		
		if($query){
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $query;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Invalid Query";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
		
	}
	
	
	
	
	public function gethistory(){ 
		$req = apache_request_headers();
		if ($req['x-username'] != "ollakespra2023") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username Tidak Terdaftar";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Gunakan Metode POST";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
		}
		$varcontent = file_get_contents("php://input");
		$bbd = json_decode($varcontent);
		$weeeee = $bbd->request->t_data->Password;
		//print_r($bbd);
		//die();
		$_log = "select * from  tb_pasien ";
		$_log .= "where (nip_nrp_nik='".$bbd->request->t_data->Username."' OR no_ktp_pas='".$bbd->request->t_data->Username."') and tgl_lhr_pas='".$weeeee."' ";
		$data = $this->db->query($_log);
		$query = $data->row();
		//print_r($query);
		if($query){
			//ambil dataaaaa
			$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas, b.alamat_pas, c.nm_paket from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket ";
			
			$que 	.= " and a.no_reg='".$bbd->request->t_data->Noreg."' ";
			$gsv = $this->db->query($que);
			$sfc = $gsv->result();
			header('Content-Type: application/json');
			header('HTTP/1.1 200 Ok');
			$response['metadata']['message'] = $sfc;
			$response['metadata']['code'] = "200";
			die(json_encode($response));
			die();
		}else{
			header('Content-Type: application/json');
			header('HTTP/1.1 201 Gagal');
			$response['metadata']['message'] = "Username / Tanggal Lahir Tidak Sesuai";
			$response['metadata']['code'] = "201";
			die(json_encode($response));
			die();
			
		}
	}
	
}

