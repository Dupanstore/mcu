<?php
class Madmin extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
	
	function get_id_rs(){
		$this->db->where ('app_key', 'app_name');
		$_r = $this->db->get ('tb_setting');
		$_l = $_r->result();
		return $_l[0]->app_val;
	}
	
	public function cekpasienaktif($rm){
		$hari = "select a.id_reg from tb_register a where a.no_rm_pas_reg='".$rm."' and a.apakah_sudah_pulang <> 'Y' limit 1  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	
	public function getidinsbyregmeta($rmeta){
		$hari = "select id_pol_reg from tb_register_meta where id_reg_meta=".$rmeta." ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf->id_pol_reg;
	}
	public function getkelasbyidins($rmeta){
		$hari = "select id_kelas from tb_instalasi where id_ins=".$rmeta." ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf->id_kelas;
	}
	
	public function getdatapasbym($rm){
		$hari = "select a.no_rm_pas, a.nama_pas, a.ktp_pas, a.jenkel_pas, a.alamat_pas from tb_pasien a where a.no_rm_pas='".$rm."' limit 1  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	public function getpaketmandiri($idins){
		$hari = "select a.id_paket_mandiri from tb_tindakan_registrasi a where a.id_ins='".$idins."'  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	
	public function getnamadeb($iddeb){
		$hari = "select nm_deb from tb_debitur where id_deb=$iddeb limit 1 ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf->nm_deb;
	}
	
	public function getpendaftaranbycode($kode){
		$hari = "select * from tb_daftaronline where keyol='".$kode."' and statusonline='W' limit 1 ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	function is_id_vk(){
		$this->db->select('id_ins');
		$this->db->where('apakah_vk', 'Y');
		$_r = $this->db->get ('tb_instalasi');
		$_l = $_r->row();
		return $_l->id_ins;
	}
	function is_rupadaksa(){
		$aa = array ('Bunuh diri', 'Pembunuhan', 'Kecelakaan');
		return $aa;
	}
	function is_yatidak(){
		$aa = array ('Ya', 'Tidak');
		return $aa;
	}
	function is_keadaankeluar(){
		$aa = array ('Sembuh', 'Membaik', 'Memburuk', 'Seperti semula', 'Meninggal < 48 jam', 'Meninggal >= 48 Jam');
		return $aa;
	}
	function is_carakeluar(){
		//$aa = array ('Pulang Atas Permintaan Sendiri', 'Dirawat', 'Persetujuan', 'Pulang Paksa', 'Dirujuk ke', 'Melarikan Diri');
		$aa = array ('Dirawat', 'Izin Dokter', 'Pindah Rumah Sakit', 'Permintaan Sendiri', 'Melarikan diri');
		return $aa;
	} 
	function rsau_postifif_negatif($ar=false){
		$srt = array(
			'Negatif' => 'Negatif',
			'Positif' => 'Positif',
			'1/80' => '1/80',
			'1/160' => '1/160',
			'1/180' => '1/180',
			'1/320' => '1/320',
			'1/640' => '1/640',
			'1+' => '1+',
			'2+' => '2+',
			'3+' => '3+',
			'4+' => '4+',
			'Trace' => 'Trace',
			'+ -' => '+ -',
			'Normal' => 'Normal',
			'Tidak Normal' => 'Tidak Normal',
			'Reaktif' => 'Reaktif',
			'Non Reaktif' => 'Non Reaktif',
		);
		if($ar == true){
			return $srt[$ar];
		} else {
			return $srt;
		}
	}
	function is_laporan_custom($uri){
			$sall = "";
			if(!empty($uri)){
				$this->db->where('uri_dtm', $uri);
				$fghj = $this->db->get('tb_dotmetrik');
				$gbnd = $fghj->result();
				if($gbnd){
					$this->db->where ('app_key', 'new_letter_spacing');
					$sdsda = $this->db->get('tb_setting');
					$nmsda = $sdsda->row();
					$sall = '<style>body{'.$nmsda->app_val.'}</style>';
				}else{
					$sall = "";
				}
			}
			return $sall;
	}
	function get_setting($app_name){
		$this->db->where ('app_key', $app_name);
		$_r = $this->db->get ('tb_setting');
		$_l = $_r->result();
		if($app_name == "lap_head"){
			if($_GET['type']){
				if($_GET['type'] != "excel"){
					$imn = '<img src="'.base_url('assets/logo/logo.png').'" style="width:80px;">';
				}
			}else {
				$imn = '<img src="'.base_url('assets/logo/logo.png').'" style="width:80px;">';
			}
			return "<div align='left' style='margin:0;padding:0;margin-left:-10%'><table><tr><td style='vertical-align:top;'>".$imn."</td><td style='vertical-align:top;'>".  $_l[0]->app_val ."</td></tr></table></div>";

		}else{
			return  $_l[0]->app_val;

		}
	}
	function get_value($where, $val, $table){
		$this->db->where ($where, $val);
		$_r = $this->db->get ($table);
		$_l = $_r->result();
		return $_l;
	}
	function radiologi_get_film($xx=false){
		$ayy = array('8x10' => '8x10', '10x14' => '10x14', '14x17' => '14x17');
		if($xx){
			return $ayy[$xx];
		} else {
			return $ayy;
		}
	}
	function get_value_limit($select, $where=array(), $table){
		if($select != ""){
		$this->db->select($select);
		}
		foreach($where as $ke => $va){
			$this->db->where($ke, $va);
		}
		$this->db->limit(1);
		$_r = $this->db->get($table);
		$_l = $_r->row();
		return $_l;
	}
	function admin_getsetting($app_name){
		$this->db->select('app_val');
		$this->db->where('app_key', $app_name);
		$this->db->limit(1);
		$_r = $this->db->get ('tb_setting');
		$_l = $_r->result();
		return $_l[0]->app_val;
	}
	function get_timezones($key){
		$this->db->where ('app_key', 'timezones');
		$_r = $this->db->get ('tb_setting');
		$_l = $_r->result();
		$sm = explode('***', $_l[0]->app_val);
		if($key == 'key'){
			return $sm[0];
		} else {
			return trim($sm[1]);
		}
	}
	function model_pemeriksaan($id=false){
		if ($id){
			$this->db->where('id_pemeriksaan',$id);
		}	
			$mpem = $this->db->get('tb_pemeriksaan');
			$hpem = $mpem->result();
		if ($hpem){
		foreach ($hpem as $val){
			$isi[$val->id_pemeriksaan]=$val->nm_pemeriksaan;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	function model_poliklinik($id=false){
		if ($id){
			$this->db->where('id_poli',$id);
		}	
			$mpol = $this->db->get('tb_poliklinik');
			$hpol = $mpol->result();
		if ($hpol){
		foreach ($hpol as $val){
			$isi[$val->id_poli]=$val->nm_poli;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	function model_babi($id=false){
		if ($id){
			$this->db->where('id_poli',$id);
		}	
		$this->db->where('tipe_poli', 'P');
		$this->db->or_where('tipe_poli', 'J');
			$mpol = $this->db->get('tb_poliklinik');
			$hpol = $mpol->result();
		if ($hpol){
		foreach ($hpol as $val){
			$isi[$val->id_poli]=$val->nm_poli;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	
	function model_agama($id=false){
		if ($id){
			$this->db->where('id_agama',$id);
		}	
			$maga = $this->db->get('tb_agama');
			$haga = $maga->result();
		if ($haga){
		foreach ($haga as $val){
			$isi[$val->id_agama]=$val->nm_agama;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	
	function model_pekerjaan($id=false){
		if ($id){
			$this->db->where('id_pekerjaan',$id);
		}	
			$maga = $this->db->get('tb_pekerjaan');
			$haga = $maga->result();
		if ($haga){
		foreach ($haga as $val){
			$isi[$val->id_pekerjaan]=$val->nm_pekerjaan;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
		
	function model_jawatan($id=false){
		if ($id){
			$this->db->where('id_jawatan',$id);
		}	
			$mjaw = $this->db->get('tb_jawatan');
			$hjaw = $mjaw->result();
		if ($hjaw){
		foreach ($hjaw as $val){
			$isi[$val->id_jawatan]=$val->nm_jawatan;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	
	function model_dinas($id=false){
		if ($id){
			$this->db->where('id_dinas',$id);
		}	
			$mdin = $this->db->get('tb_dinas');
			$hdin = $mdin->result();
		if ($hdin){
		foreach ($hdin as $val){
			$isi[$val->id_dinas]=$val->nm_dinas;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	
		function model_pangkat($id=false){
		if ($id){
			$this->db->where('id_pekerjaan',$id);
		}	
			$mdin = $this->db->get('tb_pekerjaan');
			$hdin = $mdin->result();
		if ($hdin){
		foreach ($hdin as $val){
			$isi[$val->id_pekerjaan]=$val->list_pangkat;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
		}
		
		function model_bayar($id=false){
		if ($id){
			$this->db->where('id_bayar',$id);
		}	
			$mdin = $this->db->get('tb_bayar');
			$hdin = $mdin->result();
		if ($hdin){
		foreach ($hdin as $val){
			$isi[$val->id_bayar]=$val->nm_bayar;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
		}

		function model_sesi($id=false){
		if ($id){
			$this->db->where('id_sesi',$id);
		}	
			$mdin = $this->db->get('tb_jawatan_sesi');
			$hdin = $mdin->result();
		if ($hdin){
		foreach ($hdin as $val){
			$isi[$val->id_sesi]=$val->nm_sesi;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
		}
	// SAHUD YAHUD................................................
	function model_paket($id=false){
		if ($id){
			$this->db->where('id_paket',$id);
		}	
			$mpem = $this->db->get('tb_paket');
			$hpem = $mpem->result();
		if ($hpem){
		foreach ($hpem as $val){
			$isi[$val->id_paket]=$val->nm_paket;
		}
		if ($id){
			return $isi[$id];
		}else{
		return $isi;
		}	
		}
		else {
		return false;
		}
	}
	// YA YA YA HUD.................................................
	
	
	//START ABY...............
	function rm_jenispelayanan(){
		$this->db->order_by('nama', 'ASC');
		$_l = $this->db->get("rm_jenispelayanan");
		$_r = $_l->result();
		return $_r;
	}
	function is_jenis(){
		$this->db->where('kat_jenis', 'F');
		$this->db->order_by('nm_jenis', 'ASC');
		$_l = $this->db->get("farm_jenis");
		$_r = $_l->result();
		return $_r;
	}
	
	function is_jenis_logistik(){
		$_l = $this->db->query("select * from farm_jenis where kat_jenis IN ('G', 'I', 'A')");
		$_r = $_l->result();
		return $_r;
	}
	function is_jlogistik(){
		$this->db->where('kat_jenis', 'L');
		$this->db->order_by('nm_jenis', 'ASC');
		$_l = $this->db->get("farm_jenis");
		$_r = $_l->result();
		return $_r;
	}
	function is_jlogistikdua($gvs){
		$this->db->where('kat_jenis', $gvs);
		$this->db->order_by('nm_jenis', 'ASC');
		$_l = $this->db->get("farm_jenis");
		$_r = $_l->result();
		return $_r;
	}
	function is_pabrik(){
		$this->db->order_by('pabrik', 'ASC');
		$_l = $this->db->get("farm_pabrik");
		$_r = $_l->result();
		return $_r;
	}
	function is_kategori(){
		$_l = $this->db->get("farm_kat_obat");
		$_r = $_l->result();
		return $_r;
	}
	function is_satuan(){
		$_l = $this->db->get("farm_satuan");
		$_r = $_l->result();
		return $_r;
	}
	function is_satuan_semua($jensd){
		$this->db->where("jenis_modul", $jensd);
		$_l = $this->db->get("farm_satuan");
		$_r = $_l->result();
		return $_r;
	}
	function is_kelasterapi(){
		$_l = $this->db->get("farm_kelas_terapi");
		$_r = $_l->result();
		return $_r;
	}
	function jenis_obat(){
		$_l = $this->db->get(" farm_jenis_obat");
		$_r = $_l->result();
		return $_r;
	}
	function is_rm_jenisrs(){
		$_k = $this->db->get('rm_jenisrs');
		$_v = $_k->result();
		return $_v;
	}
	function is_kelasrs($sj){
		$as = array ('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', '1' => '1', '2' => '2', '3' => '3', '4' => '4', 'Tanpa Kelas' => 'Tanpa Kelas');
		if($sj == true){
			return $as[$sj];
		} else {
			return $as;
		}
	}
	function is_rm_penyelenggaraswasta(){
		$_k = $this->db->get('rm_penyelenggaraswasta');
		$_v = $_k->result();
		return $_v;
	}
	function is_sudahbelum(){
		$aa = array ('Sudah', 'Belum');
		return $aa;
	}
	function is_pentahapan(){
		$aa = array ('5 Pelayanan', '12 Pelayanan', '16 Pelayanan');
		return $aa;
	}
	function is_statusnya(){
		$aa = array ('Penuh', 'Bersyarat', 'Gagal');
		return $aa;
	}
	
	//bpjs
	function bpjs_get_att($att){
		$data = $this->madmin->get_setting('bpjs_user_key');
		$secretKey = $this->madmin->get_setting('bpjs_password_key');
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		if($att == "X-cons-id"){
			return $data;
		}
		if($att == "X-timestamp"){
			return $tStamp;
		}
		if($att == "X-signature"){
			return $encodedSignature;
		}
	}
	
	
	
	function newbpjs_getdata($att){
		$data = "23045";
		$secretKey = "3tL00A264A";
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		if($att == "X-cons-id"){
			return $data;
		}
		if($att == "X-timestamp"){
			return $tStamp;
		}
		if($att == "X-signature"){
			return $encodedSignature;
		}
		if($att == "X-userkey"){
			return "b390b98118c4ce57ae45b3d0e8f3832a";
		}
		if($att == "X-passwordkey"){
			return $secretKey;
		}
	}
	
	
	function newantrian_getdata($att){
		$data = "23045";
		$secretKey = "3tL00A264A";
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		if($att == "X-cons-id"){
			return $data;
		}
		if($att == "X-timestamp"){
			return $tStamp;
		}
		if($att == "X-signature"){
			return $encodedSignature;
		}
		if($att == "X-userkey"){
			return "3a76a2f8bb70c7a2aa5983ee315b5d6c";
		}
		if($att == "X-passwordkey"){
			return $secretKey;
		}
	}
	
	
	function get_ambulance($where = ''){
		if(!empty($where)) $this->db->like ('nm_amb', $where);
		$this->db->order_by('nm_amb', 'ASC');
		$_k = $this->db->get('tb_ambulan');
		$_v = $_k->result();
		return $_v;
	}
	function is_ip_addr($ip){
		if($ip == "::1"){
			return 2;
		}else {
			$this->db->where('ip_add_sys ', $ip);
			$_r = $this->db->get ('tb_reg_ip');
			$_l = $_r->row();
			if($_l){
				return 2;
			} else {
				return 3;
			}
		}
	}
	function kop_get_kodeakun($where = '', $total= false){
		$_q = "select * from akun_kodeakun ";
		if($where != ''){
			$_q .= $where;
		}
		$_k = $this->db->query($_q);
		$_v = $_k->result();
		if($total == true){
			return $_k;
		} else {
			return $_v;
		}
	}
	
	
	//validasiiii
	function validasi_closing_checkout_transaksi($idreg){
		if(empty($idreg)){
			die("Register Tidak Ditemukan");
		}
		$this->db->select('apakah_sudah_pulang, closing_transaksi_tindakan');
		$this->db->where('id_reg', $idreg);
		$this->db->limit(1);
		$aisa = $this->db->get('tb_register');
		$sias = $aisa->row();
		if($sias->apakah_sudah_pulang == "Y"){
			die("Transaksi Sudah Ditutup, Hubungi Administrator untuk membuka Transaksi..");
		}
		if($sias->closing_transaksi_tindakan == "Y"){
			die("Dalam Proses Kasir, Konfirmasi ke Kasir untuk membuka Closing Transaksi..");
		}
		//print_r($sias);
	}
	function validasi_closing_checkout_transaksi_luar($idreg){
		if(empty($idreg)){
			die("Register Tidak Ditemukan");
		}
		$this->db->select('apakah_sudah_pulang, closing_transaksi_tindakan');
		$this->db->where('id_luar', $idreg);
		$this->db->limit(1);
		$aisa = $this->db->get('tb_pas_luar');
		$sias = $aisa->row();
		if($sias->apakah_sudah_pulang == "Y"){
			die("Transaksi Sudah Ditutup, Hubungi Administrator untuk membuka Transaksi..");
		}
		if($sias->closing_transaksi_tindakan == "Y"){
			die("Dalam Proses Kasir, Konfirmasi ke Kasir untuk membuka Closing Transaksi..");
		}
		//print_r($sias);
	}
	public function getbpjspenjamin($tmp){
		$hari = "select * from tb_debitur where kat_bpjs='Y' limit 1 ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf->$tmp;
	}
	
	public function getiddokterotomatis($idins){
		$har = date('w');
		$ruang = $idins;
		$hari = "select a.id_pra, a.jam_mulai, a.jam_selesai, b.id_user, b.nmlengkap, c.nm_instalasi from tb_praktekdokter a,  tb_user b, tb_instalasi c where a.id_dok=b.id_user and a.id_sub=c.id_ins and a.id_hari='".$har."' and a.status_aktif='A' and c.id_ins='".$ruang."' order by a.jam_mulai ASC ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->result();
		$jadwaldok = array();
		foreach($gsf as $kkd){
			$trx1 = (int) str_replace(":", "", $kkd->jam_mulai);
			$trx2 = (int) str_replace(":", "", $kkd->jam_selesai);
			$angkas = (int) 900;
			if($angkas >= $trx1 and $angkas <= $trx2){
				$jadwaldok['id_dok'] = $kkd->id_user;
				break;
			}
		}
		//print_r();
		return $jadwaldok;
	}
	
	public function getruangbykelas($ikd){
		$hari = "select b.nm_instalasi, b.id_ins from  tb_rawat_inap a, tb_instalasi b where a.id_sub_raw=b.id_ins and b.type='ri' and a.id_kel_raw='".$ikd."' and  b.nm_instalasi <> 'Ruang -' and b.apakah_tampildimandiri='' group by b.nm_instalasi order by b.nm_instalasi ASC  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->result();
		return $gsf;
	}
	
	public function getruangicu($ikd){
		$hari = "select b.nm_instalasi, b.id_ins from  tb_instalasi b where  b.id_ins='".$ikd."'  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->result();
		return $gsf;
	}
	
	public function getkapasitasruang($kel,$idins){
		//filter mcu
		$ghsdsd = "";
		if($kel != "999"){
			$ghsdsd .= "and a.id_kel_raw='".$kel."'";
		}
		$hari = "select count(no_raw) as ttls from tb_rawat_inap a where a.bed_nonaktif='' and a.apakah_bed_bayangan='' $ghsdsd and  a.id_sub_raw='".$idins."' ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	
	public function getstatusterisi($kel,$idins){
		$ghsdsd = "";
		if($kel != "999"){
			$ghsdsd .= "and a.id_kel_raw='".$kel."'";
		}
		$hari = "select count(id_inap) as ttls from tb_pas_rawat_inap x, tb_register y, tb_rawat_inap a where x.id_reg_inap=y.id_reg and x.id_raw_inap=a.no_raw and a.bed_nonaktif='' and a.apakah_bed_bayangan='' $ghsdsd and  a.id_sub_raw='".$idins."' and x.sudah_checkout <> 'Y' and y.apakah_sudah_pulang<>'Y' ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
	
	public function getdokterbyhari($har){
		$hari = "select a.*, b.nmlengkap, c.nm_instalasi from tb_praktekdokter a,  tb_user b, tb_instalasi c where a.id_dok=b.id_user and a.id_sub=c.id_ins and a.id_hari='".$har."' and a.status_aktif='A' order by a.id_sub ASC ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->result();
		return $gsf;
	}
	
	public function gettitipanpasienbyreg($get){
		$idkelasttp = "0";
		$this->db->select("pasien_titip");
		$this->db->where("id_reg", $get);
		$gsvdv = $this->db->get('tb_register');
		$gsbbd = $gsvdv->row();
		$titippas = $gsbbd->pasien_titip;
		if($gsbbd->pasien_titip == "Y"){
			$bsvdd = "select id_kelas_titipan from tb_pas_rawat_inap where id_reg_inap=".$get." and id_kelas_titipan > 0 ";
			$hnsbd = $this->db->query($bsvdd);
			$hsmfd = $hnsbd->row();
			$idkelasttp = $hsmfd->id_kelas_titipan;
		}
		$gsbvd['pasien_titip'] = $titippas;
		$gsbvd['id_kelas_titipan'] = $idkelasttp;
		return $gsbvd;
	}
	
	
	public function is_bgimg($har, $jnn){
		$hari = "select ".$jnn." from tb_user where id_user=".$har." ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		if($jnn == "tmp_background"){
			$backkk = "#15558D";
			if($gsf){
				if(!empty($gsf->$jnn)){
					$backkk = $gsf->$jnn;
				}else{
					$backkk = "#15558D";
				}
			}
		}
		if($jnn == "tmp_background_part"){
			$backkk = "1000%";
			if($gsf){
				if(!empty($gsf->$jnn)){
					if($gsf->$jnn == "prt"){
						$backkk = "100px";
					}
				}else{
					$backkk = "1000%";
				}
			}
		}
		return $backkk;
	}
	
	public function getnoantribydok($har,$idpol, $iddok){
		$hari = "select a.* from tb_praktekdokter a where a.id_hari='".$har."' and a.id_sub=$idpol and a.id_dok=$iddok  ";
		$sdk = $this->db->query($hari);
		$gsf = $sdk->row();
		return $gsf;
	}
}