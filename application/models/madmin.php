<?php
class Madmin extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	function Get_setting($app_name){
		$this->db->select('app_val');
		$this->db->where('app_key', $app_name);
		$this->db->limit(1);
		$_r = $this->db->get ('tb_setting');
		$_l = $_r->result();
		return $_l[0]->app_val;
	}
	function rsau_postifif_negatif($ar=false){
		$srt = array(
			'Negatif' => 'Negatif',
			'Positif' => 'Positif',
			'Tidak Periksa' => 'Tidak Periksa',
			'Positif 1/80' => 'Positif 1/80',
			'Positif 1/160' => 'Positif 1/160',
			'Positif 1/320' => 'Positif 1/320',
			'Positif 1/640' => 'Positif 1/640',
			'Positif +' => 'Positif +',
			'Positif ++' => 'Positif ++',
			'Positif +++' => 'Positif +++',
			'Positif ++++' => 'Positif ++++',
			'Reaktif' => 'Reaktif',
			'Non Reaktif' => 'Non Reaktif',
			'Ca-oxalat Positif +' => 'Ca-oxalat Positif +',
			'Ca-oxalat Positif ++' => 'Ca-oxalat Positif ++',
			'Amorf' => 'Amorf',
			'Cyl Hyalin' => 'Cyl Hyalin',
			'Cyl Granula' => 'Cyl Granula',
		);
		if($ar == true){
			return $srt[$ar];
		} else {
			return $srt;
		}
	}
	
	
	function resume_medis_en($getid){
		$sfdr = array(
				'Bedah' => 'Surgery', 
				'Kulit' => 'Skin', 
				'Umum' => 'General', 
				'Mata' => 'Ophthalmology', 
				'Gigi' => 'Dentistry', 
				'Neurologi' => 'Neurology', 
				'Paru' => 'Pulmology', 
				'USG' => 'USG', 
				'Laboratorium' => 'Laboratory',
				);
		if(isset($sfdr[$getid])){
			return $sfdr[$getid];
		}else{
			return $getid;
		}
	}
	
	function rsau_postifif_negatif_en($ar=false){
		$srt = array(
			'jam' => 'hours',
			'Kuning' => 'Yellow',
			'Negatif' => 'Negative',
			'Positif' => 'Positive',
			'Tidak Periksa' => 'No Check',
			'Positif 1/80' => 'Positive 1/80',
			'Positif 1/160' => 'Positive 1/160',
			'Positif 1/320' => 'Positive 1/320',
			'Positif 1/640' => 'Positive 1/640',
			'Positif +' => 'Positive +',
			'Positif ++' => 'Positive ++',
			'Positif +++' => 'Positive +++',
			'Positif ++++' => 'Positive ++++',
			'Reaktif' => 'Reactive',
			'Non Reaktif' => 'Non Reactive',
			'Ca-oxalat Positif +' => 'Ca-oxalat Positive +',
			'Ca-oxalat Positif ++' => 'Ca-oxalat Positive ++',
			'Amorf' => 'Amorf',
			'Cyl Hyalin' => 'Cyl Hyalin',
			'Cyl Coral' => 'Cyl Coral',
			'Normal' => 'Normality',
			'Ringan' => 'Mild',
			'Sedang' => 'Moderate',
			'Berat' => 'Severe',
			'L/dtk' => 'L/sec',
		);
		if($ar == true){
			if(isset($srt[$ar])){
				return $srt[$ar];
			}else{
				return $ar;
			}
		}else{
			return $srt;
		}
		
		
	}
	function Get_value($where, $val, $table){
		$this->db->where ($where, $val);
		$_r = $this->db->get ($table);
		$_l = $_r->result();
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
	function Get_timezones($key){
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
}
