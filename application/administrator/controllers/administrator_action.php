<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_action extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
		ini_set('memory_limit', '1024M');
		if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
			ob_start("ob_gzhandler");
		} else {
			ob_start();
		}
		//date_default_timezone_set($this->madmin->POST_timezones('val'));
	}
	
	public function simpanupdateonlinedokterpas(){
		//print_r($_POST);
		if(empty($_POST['nip_nrp_nik'])){
			die('NIP / NRP /NIK wajib diisi');
		}
		if(empty($_POST['nm_pas'])){
			die('Nama wajib diisi');
		}
		if(empty($_POST['no_tlp_pas'])){
			die('No HP wajib diisi');
		}
		if(empty($_POST['nip_nrp_nik'])){
			die('NIP / NRP /NIK wajib diisi');
		}
		if(empty($_POST['poli'])){
			die('Poliklinik wajib diisi');
		}
		if(empty($_POST['spesialis'])){
			die('Spesialis wajib diisi');
		}
		if(empty($_POST['id_pas'])){
			//berrt nambah data
			$password = password_hash(sha1('dokter'), PASSWORD_DEFAULT);
			$ckk = $this->db->query("select no_reg from tb_pasien where apakah_dokter='Y' order by id_pas DESC");
			$cks = $ckk->row();
			$kodepasien = "T000000001";
			if($cks){
				$noUrut = (int) substr($cks->no_reg, 1, 9); 
				$noUrut++;
				$kodepasien = "T" . sprintf("%09s", $noUrut);
			}  
			$snbd = array(
				'no_reg' => $kodepasien,
				'nip_nrp_nik' => $_POST['nip_nrp_nik'],
				'nm_pas' => $_POST['nm_pas'],
				'no_tlp_pas' => $_POST['no_tlp_pas'],
				'pangkat_pas' => $_POST['pangkat_pas'],
				'password' => $password,
				'sudah_aktif' => 'Y',
				'apakah_dokter' => 'Y',
				'id_poli_dok' => $_POST['poli'],
				'id_spesialis_dok' => $_POST['spesialis'],
			);
			//print_r($snbd);
			//die();
			$this->db->insert('tb_pasien', $snbd);
		}else{
			$snbd = array(
				'nip_nrp_nik' => $_POST['nip_nrp_nik'],
				'nm_pas' => $_POST['nm_pas'],
				'no_tlp_pas' => $_POST['no_tlp_pas'],
				'pangkat_pas' => $_POST['pangkat_pas'],
				'id_poli_dok' => $_POST['poli'],
				'id_spesialis_dok' => $_POST['spesialis'],
			);
			$this->db->where('id_pas', $_POST['id_pas']);
			$this->db->update('tb_pasien', $snbd);
		}
		echo 'simpan';
	}
	public function simpanupdatedataagama(){
		$this->db->where('kd_agama', $_POST['kd_agama']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_agama');
		$baba = $ggdt->result();
		if(empty($_POST['kd_agama'])){
			die('Kode Agama harus diisi');
		}
		if(empty($_POST['nm_agama'])){
			die('Nama Agama harus diisi');
		}
		if(strlen($_POST['kd_agama']) != 4){
			die('Kode Agama Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_agama' => clean_data($_POST['kd_agama']),
				'nm_agama' => clean_data($_POST['nm_agama']),
			);
			if(empty($_POST['id_agama'])){
				if($baba){
					die('Agama sudah terdaftar');
				}
				$this->db->insert('tb_agama', $dataInsert);
			} else {
				if($_POST['kd_agama'] != $_POST['kd_agama_lama']){
					if($baba){
						die('Kode Agama sudah digunakan');
					}
				}
				$this->db->where('id_agama', $_POST['id_agama']);
				$this->db->update('tb_agama', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function hapusdataberita(){
		$this->db->where('id', $_POST['id']);
		$this->db->delete('api_berita');
	}
	public function rubahstatusyaok(){
		print_r($_POST);
		$this->db->where('sid', $_POST['idhs']);
		$dsjfghds = $this->db->get('api_home');
		$rgdhsfsf = $dsjfghds->row();
		if($rgdhsfsf){
			$this->db->where('sid', $_POST['idhs']);
			$this->db->delete('api_home');
		}else{
			$gshghdsd['cid'] = 23;
			$gshghdsd['sid'] = $_POST['idhs'];
			$gshghdsd['status'] = 1;
			$this->db->insert('api_home', $gshghdsd);
		}
	}
	
	public function hapusdataagama(){
		$this->db->where('id_agama', $_POST['id']);
		$this->db->delete('tb_agama');
	}
	public function hapusdatabanner(){
		$this->db->where('id', $_POST['id']);
		$this->db->delete('api_banner');
	}
	
	public function simpanupdatedatapendidikan(){
		$this->db->where('kd_pendidikan', $_POST['kd_pendidikan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_pendidikan');
		$baba = $ggdt->result();
		if(empty($_POST['kd_pendidikan'])){
			die('Kode pendidikan harus diisi');
		}
		if(empty($_POST['nm_pendidikan'])){
			die('Nama pendidikan harus diisi');
		}
		if(strlen($_POST['kd_pendidikan']) != 4){
			die('Kode pendidikan Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_pendidikan' => clean_data($_POST['kd_pendidikan']),
				'nm_pendidikan' => clean_data($_POST['nm_pendidikan']),
			);
			if(empty($_POST['id_pendidikan'])){
				if($baba){
					die('pendidikan sudah terdaftar');
				}
				$this->db->insert('tb_pendidikan', $dataInsert);
			} else {
				if($_POST['kd_pendidikan'] != $_POST['kd_pendidikan_lama']){
					if($baba){
						die('Kode pendidikan sudah digunakan');
					}
				}
				$this->db->where('id_pendidikan', $_POST['id_pendidikan']);
				$this->db->update('tb_pendidikan', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatapendidikan(){
		$this->db->where('id_pendidikan', $_POST['id']);
		$this->db->delete('tb_pendidikan');
	}
	public function simpanupdatedatastatus(){
		$this->db->where('kd_status', $_POST['kd_status']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_status');
		$baba = $ggdt->result();
		if(empty($_POST['kd_status'])){
			die('Kode status harus diisi');
		}
		if(empty($_POST['nm_status'])){
			die('Nama status harus diisi');
		}
		if(strlen($_POST['kd_status']) != 4){
			die('Kode status Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_status' => clean_data($_POST['kd_status']),
				'nm_status' => clean_data($_POST['nm_status']),
			);
			if(empty($_POST['id_status'])){
				if($baba){
					die('status sudah terdaftar');
				}
				$this->db->insert('tb_status', $dataInsert);
			} else {
				if($_POST['kd_status'] != $_POST['kd_status_lama']){
					if($baba){
						die('Kode status sudah digunakan');
					}
				}
				$this->db->where('id_status', $_POST['id_status']);
				$this->db->update('tb_status', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatastatus(){
		$this->db->where('id_status', $_POST['id']);
		$this->db->delete('tb_status');
	}
	public function simpanupdatedatawilayah(){
		$this->db->where('kd_wilayah', $_POST['kd_wilayah']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_wilayah');
		$baba = $ggdt->result();
		if(empty($_POST['kd_wilayah'])){
			die('Kode wilayah harus diisi');
		}
		if(empty($_POST['nm_wilayah'])){
			die('Nama wilayah harus diisi');
		}
		if(strlen($_POST['kd_wilayah']) != 4){
			die('Kode wilayah Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_wilayah' => clean_data($_POST['kd_wilayah']),
				'nm_wilayah' => clean_data($_POST['nm_wilayah']),
			);
			if(empty($_POST['id_wilayah'])){
				if($baba){
					die('wilayah sudah terdaftar');
				}
				$this->db->insert('tb_wilayah', $dataInsert);
			} else {
				if($_POST['kd_wilayah'] != $_POST['kd_wilayah_lama']){
					if($baba){
						die('Kode wilayah sudah digunakan');
					}
				}
				$this->db->where('id_wilayah', $_POST['id_wilayah']);
				$this->db->update('tb_wilayah', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatakatberita(){
		if(empty($_POST['nama_kat'])){
			die('Nama kategori harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'cat_id' => 23,
				'name' => clean_data($_POST['nama_kat']),
				'img' => 'kespraapi/subcat/berita.png',
			);
			if(empty($_POST['id_kat'])){
				$this->db->insert('api_subkatberita', $dataInsert);
			} else {
				$this->db->where('id', $_POST['id_kat']);
				$this->db->update('api_subkatberita', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatedatakatspesialis(){
		if(empty($_POST['nama_kat'])){
			die('Spesialis harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'name' => clean_data($_POST['nama_kat']),
			);
			if(empty($_POST['id_kat'])){
				$this->db->insert('api_spesialis', $dataInsert);
			} else {
				$this->db->where('id', $_POST['id_kat']);
				$this->db->update('api_spesialis', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatakatberita(){
		$this->db->where('id', $_POST['id']);
		$this->db->delete('api_subkatberita');
	}
	public function hapusdatakatspesialis(){
		$this->db->where('id', $_POST['id']);
		$this->db->delete('api_spesialis');
	}
	public function simpanupdatepengumumonline(){
		//print_r($_POST);
		foreach($_POST as $rgdb => $rsgd){
			$dataInsert = array (
				'pvals' => $rsgd,
			);
			$this->db->where('pkeys', $rgdb);
			$this->db->update('api_lain', $dataInsert);
		}
		echo 'simpan';
	}
	
	public function hapusdatawilayah(){
		$this->db->where('id_wilayah', $_POST['id']);
		$this->db->delete('tb_wilayah');
	}
	public function simpanupdatedataicd(){
		if(empty($_POST['poli'])){
			die('Poliklinik harus diisi');
		}
		if(empty($_POST['nm_icd'])){
			die('Nama icd harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'id_poli' => clean_data($_POST['poli']),
				'nm_icd' => clean_data($_POST['nm_icd']),
				'alias_icd' => clean_data($_POST['alias_icd']),
			);
			if(empty($_POST['id_icd'])){
				
				$this->db->insert('tb_icd', $dataInsert);
			} else {
				$this->db->where('id_icd', $_POST['id_icd']);
				$this->db->update('tb_icd', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatapaketkonsul(){
		if(empty($_POST['nama_pkt'])){
			die('Nama harus diisi');
		}
		if(empty($_POST['isi_pkt'])){
			die('Detail harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nama_pkt' => clean_data($_POST['nama_pkt']),
				'isi_pkt' => clean_data($_POST['isi_pkt']),
			);
			if(empty($_POST['idc'])){
				
				$this->db->insert('tb_reff_konsul', $dataInsert);
			} else {
				$this->db->where('idc', $_POST['idc']);
				$this->db->update('tb_reff_konsul', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatedataaero(){
		if(empty($_POST['poli'])){
			die('Poliklinik harus diisi');
		}
		if(empty($_POST['nm_aero'])){
			die('Nama Pemeriksaan harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'id_poli' => clean_data($_POST['poli']),
				'nm_aero' => clean_data($_POST['nm_aero']),
				'alias_aero' => clean_data($_POST['alias_aero']),
			);
			if(empty($_POST['id_aero'])){
				
				$this->db->insert('tb_aeroklinik', $dataInsert);
			} else {
				$this->db->where('id_aero', $_POST['id_aero']);
				$this->db->update('tb_aeroklinik', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdataicd(){
		$this->db->where('id_icd', $_POST['id']);
		$this->db->delete('tb_icd');
	}
	public function hapusdatapaketkonsul(){
		$this->db->where('idc', $_POST['id']);
		$this->db->delete('tb_reff_konsul');
	}
	public function hapusdataaero(){
		$this->db->where('id_aero', $_POST['id']);
		$this->db->delete('tb_aeroklinik');
	}
	public function simpanupdatedatakondisi(){
		//print_r($_POST);
		//die();
		$this->db->where('kd_kondisi', $_POST['kd_kondisi']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_kondisi');
		$baba = $ggdt->result();
		if(empty($_POST['kd_kondisi'])){
			die('Kode kondisi harus diisi');
		}
		if(empty($_POST['nm_kondisi'])){
			die('Nama kondisi harus diisi');
		}
		if(strlen($_POST['kd_kondisi']) != 4){
			die('Kode kondisi Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_kondisi' => clean_data($_POST['kd_kondisi']),
				'nm_kondisi' => clean_data($_POST['nm_kondisi']),
				'status_grounded' => clean_data($_POST['status_grounded']),
			);
			if(empty($_POST['id_kondisi'])){
				if($baba){
					die('kondisi sudah terdaftar');
				}
				$this->db->insert('tb_kondisi', $dataInsert);
			} else {
				if($_POST['kd_kondisi'] != $_POST['kd_kondisi_lama']){
					if($baba){
						die('Kode kondisi sudah digunakan');
					}
				}
				$this->db->where('id_kondisi', $_POST['id_kondisi']);
				$this->db->update('tb_kondisi', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatastakes(){
		$this->db->where('nm_stakes', $_POST['nm_stakes']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_stakes');
		$baba = $ggdt->result();
		if(empty($_POST['nm_stakes'])){
			die('Nama stakes harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nm_stakes' => clean_data($_POST['nm_stakes']),
			);
			if(empty($_POST['id_stakes'])){
				if($baba){
					die('stakes sudah terdaftar');
				}
				$this->db->insert('tb_stakes', $dataInsert);
			} else {
				if($_POST['nm_stakes'] != $_POST['nm_stakes_lama']){
					if($baba){
						die('Nama stakes sudah digunakan');
					}
				}
				$this->db->where('id_stakes', $_POST['id_stakes']);
				$this->db->update('tb_stakes', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatasaran(){
		$this->db->where('nm_saran', $_POST['nm_saran']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_saran');
		$baba = $ggdt->result();
		if(empty($_POST['nm_saran'])){
			die('Nama saran harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nm_saran' => clean_data($_POST['nm_saran']),
				'nm_saran_en' => clean_data($_POST['nm_saran_en']),
			);
			if(empty($_POST['id_saran'])){
				if($baba){
					die('saran sudah terdaftar');
				}
				$this->db->insert('tb_saran', $dataInsert);
			} else {
				if($_POST['nm_saran'] != $_POST['nm_saran_lama']){
					if($baba){
						die('Nama saran sudah digunakan');
					}
				}
				$this->db->where('id_saran', $_POST['id_saran']);
				$this->db->update('tb_saran', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatacatatan_dinas(){
		
		$this->db->where('nm_ctd', $_POST['nm_ctd']);
		$this->db->where('jenis_catatan', $_POST['jenis_catatan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_catatan_dinas');
		$baba = $ggdt->result();
		if(empty($_POST['nm_ctd'])){
			die('Nama Catatan harus diisi');
		}
		if(empty($_POST['jenis_catatan'])){
			die('Jenis Catatan harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nm_ctd' => clean_data($_POST['nm_ctd']),
				'jenis_catatan' => clean_data($_POST['jenis_catatan']),
			);
			if(empty($_POST['id_ctd'])){
				if($baba){
					die('Catatan sudah terdaftar');
				}
				$this->db->insert('tb_catatan_dinas', $dataInsert);
			} else {
				if($_POST['nm_ctd'] != $_POST['nm_ctd_lama']){
					if($baba){
						die('Nama Catatan sudah digunakan');
					}
				}
				$this->db->where('id_ctd', $_POST['id_ctd']);
				$this->db->update('tb_catatan_dinas', $dataInsert);
			}
			echo 'simpan';
		}
	}
	
	public function simpanupdatedatakelainangigi(){
		$this->db->where('kode_kelainan', $_POST['kode_kelainan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_kelainan_gigi');
		$baba = $ggdt->result();
		if(empty($_POST['kode_kelainan'])){
			die('Kode Kelainan harus diisi');
		}
		if(empty($_POST['kelainan'])){
			die('Nama Kelainan harus diisi');
		}
		
		if($_POST){
			$dataInsert = array (
				'kode_kelainan' => clean_data($_POST['kode_kelainan']),
				'kelainan' => clean_data($_POST['kelainan']),
			);
			if(empty($_POST['id_kln'])){
				if($baba){
					die('kondisi sudah terdaftar');
				}
				$this->db->insert('tb_kelainan_gigi', $dataInsert);
			} else {
				if($_POST['kode_kelainan'] != $_POST['kode_kelainan_lama']){
					if($baba){
						die('Kode kondisi sudah digunakan');
					}
				}
				$this->db->where('id_kln', $_POST['id_kln']);
				$this->db->update('tb_kelainan_gigi', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatakondisi(){
		$this->db->where('id_kondisi', $_POST['id']);
		$this->db->delete('tb_kondisi');
	}
	public function hapusdatacatatan_dinas(){
		$this->db->where('id_ctd', $_POST['id']);
		$this->db->delete('tb_catatan_dinas');
	}
	public function hapusdatastakes(){
		$this->db->where('id_stakes', $_POST['id']);
		$this->db->delete('tb_stakes');
	}
	public function hapusdatasaran(){
		$this->db->where('id_saran', $_POST['id']);
		$this->db->delete('tb_saran');
	}
	
	public function simpanupdatedatains(){
		$this->db->where('kd_ins', $_POST['kd_ins']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_instalasi');
		$baba = $ggdt->result();
		if(empty($_POST['kd_ins'])){
			die('Kode Poliklinik harus diisi');
		}
		if(empty($_POST['nm_ins'])){
			die('Nama Poliklinik harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'kd_ins' => clean_data($_POST['kd_ins']),
				'nm_ins' => clean_data($_POST['nm_ins']),
				'type_ins' => clean_data($_POST['type_ins']),
				'lantai' => clean_data($_POST['lantai']),
				'order_ins' => clean_data($_POST['order_ins']),
				'order_baru' => clean_data($_POST['order_baru']),
				'order_evaluasi' => clean_data($_POST['order_evaluasi']),
				'in_english_ins' => clean_data($_POST['in_english_ins']),
				'set_stakes' => clean_data($_POST['set_stakes']),
				'uri' => "pelayanan",
			);
			if(empty($_POST['id_ins'])){
				if($baba){
					die('Poliklinik sudah terdaftar');
				}
				$this->db->insert('tb_instalasi', $dataInsert);
			} else {
				if($_POST['kd_ins'] != $_POST['kd_ins_lama']){
					if($baba){
						die('Kode Poliklinik sudah digunakan');
					}
				}
				$this->db->where('id_ins', $_POST['id_ins']);
				$this->db->update('tb_instalasi', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatedatapekerjaan(){
		$this->db->where('kd_pekerjaan', $_POST['kd_pekerjaan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_pekerjaan');
		$baba = $ggdt->result();
		if(empty($_POST['kd_pekerjaan'])){
			die('Kode pekerjaan harus diisi');
		}
		if(empty($_POST['nm_pekerjaan'])){
			die('Nama pekerjaan harus diisi');
		}
		if(strlen($_POST['kd_pekerjaan']) != 4){
			die('Kode pekerjaan Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_pekerjaan' => clean_data($_POST['kd_pekerjaan']),
				'nm_pekerjaan' => clean_data($_POST['nm_pekerjaan']),
				'list_pangkat' => clean_data($_POST['list_pangkat']),
			);
			if(empty($_POST['id_pekerjaan'])){
				if($baba){
					die('pekerjaan sudah terdaftar');
				}
				$this->db->insert('tb_pekerjaan', $dataInsert);
			} else {
				if($_POST['kd_pekerjaan'] != $_POST['kd_pekerjaan_lama']){
					if($baba){
						die('Kode pekerjaan sudah digunakan');
					}
				}
				$this->db->where('id_pekerjaan', $_POST['id_pekerjaan']);
				$this->db->update('tb_pekerjaan', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatapekerjaan(){
		$this->db->where('id_pekerjaan', $_POST['id']);
		$this->db->delete('tb_pekerjaan');
	}
	public function hapusdatains(){
		$this->db->where('id_ins', $_POST['id']);
		$this->db->delete('tb_instalasi');
	}
	public function simpanupdatedatabayar(){
		$this->db->where('kd_bayar', $_POST['kd_bayar']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_bayar');
		$baba = $ggdt->result();
		if(empty($_POST['kd_bayar'])){
			die('Kode bayar harus diisi');
		}
		if(empty($_POST['nm_bayar'])){
			die('Nama bayar harus diisi');
		}
		if(strlen($_POST['kd_bayar']) != 4){
			die('Kode bayar Hanya 4 digit');
		}
		if($_POST){
			$dataInsert = array (
				'kd_bayar' => clean_data($_POST['kd_bayar']),
				'nm_bayar' => clean_data($_POST['nm_bayar']),
			);
			if(empty($_POST['id_bayar'])){
				if($baba){
					die('bayar sudah terdaftar');
				}
				$this->db->insert('tb_bayar', $dataInsert);
			} else {
				if($_POST['kd_bayar'] != $_POST['kd_bayar_lama']){
					if($baba){
						die('Kode bayar sudah digunakan');
					}
				}
				$this->db->where('id_bayar', $_POST['id_bayar']);
				$this->db->update('tb_bayar', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatabayar(){
		$this->db->where('id_bayar', $_POST['id']);
		$this->db->delete('tb_bayar');
	}
	public function simpanupdatedatadinas(){
		$this->db->where('nm_dinas', $_POST['nm_dinas']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_dinas');
		$baba = $ggdt->result();
		if(empty($_POST['tipe_dinas'])){
			die('Type dinas harus diisi');
		}
		if(empty($_POST['nm_dinas'])){
			die('Nama dinas harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'tipe_dinas' => clean_data($_POST['tipe_dinas']),
				'nm_dinas' => clean_data($_POST['nm_dinas']),
				'ila_medex' => clean_data($_POST['ila_medex']),
			);
			if(empty($_POST['id_dinas'])){
				if($baba){
					die('Nama dinas sudah terdaftar');
				}
				$this->db->insert('tb_dinas', $dataInsert);
			} else {
				if($_POST['nm_dinas'] != $_POST['nm_dinas_lama']){
					if($baba){
						die('Nama dinas sudah digunakan');
					}
				}
				$this->db->where('id_dinas', $_POST['id_dinas']);
				$this->db->update('tb_dinas', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatadinas(){
		$this->db->where('id_dinas', $_POST['id']);
		$this->db->delete('tb_dinas');
	}
	public function simpanupdatedatajawatan(){
		$this->db->where('kd_jawatan', $_POST['kd_jawatan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_jawatan');
		$baba = $ggdt->result();
		if(empty($_POST['tipe_jawatan'])){
			die('Type jawatan harus diisi');
		}
		if(empty($_POST['kd_jawatan'])){
			die('Kode jawatan harus diisi');
		}
		if(empty($_POST['nm_jawatan'])){
			die('Nama jawatan harus diisi');
		}
		$default = "N";
		if(is_array($_POST['default_jawatan'])){
			$default = "Y";
		}
		if($_POST){
			$dataInsert = array (
				'tipe_jawatan' => clean_data($_POST['tipe_jawatan']),
				'kd_jawatan' => clean_data($_POST['kd_jawatan']),
				'nm_jawatan' => clean_data($_POST['nm_jawatan']),
				'default_jawatan' => $default,
				'alamat_jawatan' => clean_data($_POST['alamat_jawatan']),
				'no_tlp_jawatan' => clean_data($_POST['no_tlp_jawatan']),
			);
			if(empty($_POST['id_jawatan'])){
				if($baba){
					die('Nama jawatan sudah terdaftar');
				}
				$this->db->insert('tb_jawatan', $dataInsert);
			} else {
				if($_POST['kd_jawatan'] != $_POST['kd_jawatan_lama']){
					if($baba){
						die('Kode jawatan sudah digunakan');
					}
				}
				$this->db->where('id_jawatan', $_POST['id_jawatan']);
				$this->db->update('tb_jawatan', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatedatadok(){
		$this->db->where('kd_dok', $_POST['kd_dok']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_dokter');
		$baba = $ggdt->result();
		if(empty($_POST['kd_dok'])){
			die('Kode Dokter harus diisi');
		}
		if(empty($_POST['nm_dok'])){
			die('Nama Dokter harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'kd_dok' => clean_data($_POST['kd_dok']),
				'nm_dok' => clean_data($_POST['nm_dok']),
				'nip_nrp' => clean_data($_POST['nip_nrp']),
				'pangkat_en' => clean_data($_POST['pangkat_en']),
				'pangkat' => clean_data($_POST['pangkat']),
				'golongan' => clean_data($_POST['golongan']),
				'ttddok' => clean_data($_POST['tandatanganbase']),
			);
			if(empty($_POST['id_dok'])){
				if($baba){
					die('dok sudah terdaftar');
				}
				$this->db->insert('tb_dokter', $dataInsert);
			} else {
				if($_POST['kd_dok'] != $_POST['kd_dok_lama']){
					if($baba){
						die('Kode Dokter sudah digunakan');
					}
				}
				$this->db->where('id_dok', $_POST['id_dok']);
				$this->db->update('tb_dokter', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatadok(){
		$this->db->where('id_dok', $_POST['id']);
		$this->db->delete('tb_dokter');
	}
	public function simpanupdatedatauser(){
		$this->db->where('username', $_POST['username']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_user');
		$baba = $ggdt->result();
		if(empty($_POST['username'])){
			die('Username harus diisi');
		}
		if(empty($_POST['level'])){
			die('Level harus diisi');
		}
		if(empty($_POST['nmlengkap'])){
			die('Nama Lengkap harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nmlengkap' => clean_data($_POST['nmlengkap']),
				'no_hp' => clean_data($_POST['no_hp']),
				'level' => clean_data($_POST['level']),
				'email' => clean_data($_POST['email']),
				'nip_nik' => clean_data($_POST['nip_nik']),
			);
			if(empty($_POST['id_user'])){
				if($baba){
					die('user sudah terdaftar');
				}
				if(empty($_POST['password'])){
					die('Password harus diisi');
				}
				$dataInsert['username'] = clean_data($_POST['username']);
				$dataInsert['password'] = md5(clean_data($_POST['password']));
				$this->db->insert('tb_user', $dataInsert);
			} else {
				if($_POST['username'] != $_POST['username_lama']){
					if($baba){
						die('Kode userter sudah digunakan');
					}
				}
				$this->db->where('id_user', $_POST['id_user']);
				$this->db->update('tb_user', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatauser(){
		$this->db->where('id_user', $_POST['id']);
		$this->db->delete('tb_user');
	}
	public function hapusdatajawatan(){
		$this->db->where('id_jawatan', $_POST['id']);
		$this->db->delete('tb_jawatan');
	}
	public function hapusdatadetailperiksa(){
		$this->db->where('id_pem', $_POST['id']);
		$this->db->delete('tb_pemeriksaan');
	}
	public function gantipassword(){
		if(empty($_POST['passwordbaru'])){
			die('Password baru harus diisi');
		}
		if(empty($_POST['konfirmasi'])){
			die('Konfirmasi harus diisi');
		}
		if($_POST['konfirmasi'] != $_POST['passwordbaru']){
			die('Konfirmasi tidak sesuai');
		}
		$dataInsert['password'] = md5(clean_data($_POST['passwordbaru']));
		$this->db->where('id_user', $_POST['id_user']);
		$this->db->update('tb_user', $dataInsert);
		echo 'simpan';
	}
	public function simpanpenggunabersama(){
		$this->db->where("user_utama", $_POST['idutama']);
		$this->db->delete("tb_userbersama");
		if(is_array($_POST['iduser'])){
			foreach($_POST['iduser'] as $vs){
				$srg['user_utama'] = $_POST['idutama'];
				$srg['user_pengikut'] = $vs;
				$this->db->insert("tb_userbersama", $srg);
			}
		}
		echo 'simpan';
	}
	public function simpanupdatedatagrouppemeriksaan(){
		if(!isset($_POST['id_ins_ajax'])){
			die('Pilih Poliklinik / Penunjang Terlebih dahulu');
		}
		$this->db->where('kd_grouptindakan', $_POST['kd_grouptindakan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_grouptind');
		$baba = $ggdt->result();
		if(empty($_POST['kd_grouptindakan'])){
			die('Kode Group Pemeriksaan harus diisi');
		}
		if(empty($_POST['nm_grouptindakan'])){
			die('Nama Group Pemeriksaan harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'kd_grouptindakan' => clean_data($_POST['kd_grouptindakan']),
				'nm_grouptindakan' => clean_data($_POST['nm_grouptindakan']),
				'orderdata' => clean_data($_POST['orderdata']),
				'order_evalusi_group' => clean_data($_POST['order_evalusi_group']),
				'id_ins' => clean_data($_POST['id_ins_ajax']),
				'en_english_group' => clean_data($_POST['en_english_group']),
			);
			if(empty($_POST['id_grouptindakan'])){
				if($baba){
					die('Kode Group Pemeriksaan sudah terdaftar');
				}
				$this->db->insert('tb_grouptind', $dataInsert);
			} else {
				if($_POST['kd_grouptindakan'] != $_POST['kd_grouptindakan_lama']){
					if($baba){
						die('Kode Group Pemeriksaan sudah digunakan');
					}
				}
				$this->db->where('id_grouptindakan', $_POST['id_grouptindakan']);
				$this->db->update('tb_grouptind', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatedatagroupdepartemn(){
		if(!isset($_POST['id_jawatan'])){
			die('Pilih Jawatan Terlebih dahulu');
		}
		if(empty($_POST['nm_dept'])){
			die('Nama Bagian harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'nm_dept' => clean_data($_POST['nm_dept']),
				'id_jawatan' => clean_data($_POST['id_jawatan']),
			);
			if(empty($_POST['id_dept'])){
				$this->db->insert('tb_departmen', $dataInsert);
			} else {
				$this->db->where('id_dept', $_POST['id_dept']);
				$this->db->update('tb_departmen', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapusdatagrouppemeriksaan(){
		$this->db->where('id_grouptindakan', $_POST['id']);
		$this->db->delete('tb_grouptind');
	}
	public function hapusdatadept(){
		$this->db->where('id_dept', $_POST['id']);
		$this->db->delete('tb_departmen');
	}
	public function simpanupdatedetailpemeriksaan(){
		$this->db->where('det_nm_pemeriksaan', $_POST['det_nm_pemeriksaan']);
		$this->db->where('id_ins_periksa', $_POST['id_ins_periksa']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_pemeriksaan');
		$baba = $ggdt->result();
		
		//print_r($_POST);
		$header_chamber = "";
		$det_nilai_normal = "";
		$parent_chamber = "0";
		$det_jenis_pemeriksaan = "textfield";
		if(empty($_POST['det_nm_pemeriksaan'])){
				die("Isi Nama pemeriksaan terlebih dahulu");
			}
		if(isset($_POST['header_chamber'])){
			$header_chamber = "Y";
		}
		if(isset($_POST['parent_chamber'])){
			$parent_chamber = $_POST['parent_chamber'];
		}
		if(isset($_POST['det_nilai_normal'])){
			if(empty($_POST['det_type_pemeriksaan'])){
				die("Pilih Type pemeriksaan terlebih dahulu");
			}
			if($_POST['det_type_pemeriksaan'] == 'tetap'){
				if(empty($_POST['det_jenis_pemeriksaan'])){
					die("Pilih Jenis pemeriksaan terlebih dahulu");
				}
				if(empty($_POST['det_pilihan_pemeriksaan'])){
					die("Buat minimal 1 pilihan...");
				}
			}
			if($_POST['det_type_pemeriksaan'] == 'range'){
				if(empty($_POST['det_range_pemeriksaan_awal'])){
					die("Isi range awal terlebih dahulu");
				}
				if(empty($_POST['det_range_pemeriksaan_akhir'])){
					die("Isi range akhir terlebih dahulu");
				}
				if($_POST['det_range_pemeriksaan_awal'] > $_POST['det_range_pemeriksaan_akhir']){
					die("Periksa kembali range data anda");
				}
			}
			$det_jenis_pemeriksaan = $_POST['det_jenis_pemeriksaan'];
			$det_nilai_normal = "Y";
			
		}
			$dataInsert = array(
				'det_nilai_normal' =>  clean_data($det_nilai_normal),
				'det_nm_pemeriksaan' => clean_data($_POST['det_nm_pemeriksaan']),
				'saran_pemeriksaan' => clean_data($_POST['saran_pemeriksaan']),
				'det_type_pemeriksaan' => clean_data($_POST['det_type_pemeriksaan']),
				'det_jenis_pemeriksaan' => clean_data($det_jenis_pemeriksaan),
				'det_pilihan_pemeriksaan' => clean_data($_POST['det_pilihan_pemeriksaan']),
				'det_range_pemeriksaan_awal' => clean_data($_POST['det_range_pemeriksaan_awal']),
				'det_range_pemeriksaan_akhir' => clean_data($_POST['det_range_pemeriksaan_akhir']),
				'det_satuan_pemeriksaan' => clean_data($_POST['det_satuan_pemeriksaan']),
				'det_order_pemeriksaan' => clean_data($_POST['det_order_pemeriksaan']),
				'id_ins_periksa' => clean_data($_POST['id_ins_periksa']),
				'in_english_pem' => clean_data($_POST['in_english_pem']),
				'kd_group' => 'DEF_GROUP_TIND',
				'header_chamber' => $header_chamber,
				'parent_chamber' => $parent_chamber,
			);
			if(empty($_POST['id_pem'])){
				if($baba){
					die('Nama Pemeriksaan sudah terdaftar');
				}
				$this->db->insert('tb_pemeriksaan', $dataInsert);
			} else {
				if($_POST['det_nm_pemeriksaan'] != $_POST['det_nm_pemeriksaan_lama']){
					if($baba){
						die('Nama Pemeriksaan sudah digunakan');
					}
				}
				$this->db->where('id_pem', $_POST['id_pem']);
				$this->db->update('tb_pemeriksaan', $dataInsert);
			}
			echo 'simpan';
	}
	public function updatehargatindpaket(){
		//print_r($_POST);
		if($_POST['jenis'] == "P"){
			$gsbabs['harga_paket'] = $_POST['isi'];
			$this->db->where('id_paket', $_POST['id']);
			$this->db->update('tb_paket', $gsbabs);
		}
		if($_POST['jenis'] == "T"){
			$gsbabs['js_rs_tind'] = $_POST['isi'];
			$this->db->where('id_tind', $_POST['id']);
			$this->db->update('tb_tindakan', $gsbabs);
		}
	}
	public function simpanupdatetindakanmcu(){
		//print_r($_POST);
		$this->db->where('kd_tind', $_POST['kd_tind']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_tindakan');
		$baba = $ggdt->result();
		if(empty($_POST['kd_tind'])){
			die('Kode tindakan harus diisi');
		}
		if(empty($_POST['nm_tind'])){
			die('Nama tindakan harus diisi');
		}
		if(isset($_POST['kd_grouptind'])){
			if(empty($_POST['kd_grouptind'])){
				die('Group harus diisi');
			}
		}
		$tampil = "";
		if(!isset($_POST['tampil_di_pemeriksaan'])){
			$tampil = "N";
		}
		$setpem = "";
		if(isset($_POST['set_pemeriksaan_fisik'])){
			$setpem = "Y";
		}
		$setgigi = "";
		if(isset($_POST['set_struktur_gigi'])){
			$setgigi = "Y";
		}
		$setcet = "";
		if(isset($_POST['ket_cetak_pemeriksaan_pasien'])){
			$setcet = "Y";
		}
		$settanpastakes = "";
		if(isset($_POST['jangan_tampil_stakes'])){
			$settanpastakes = "Y";
		}
		if($_POST){
			$dataInsert = array (
				'kd_tind' => clean_data($_POST['kd_tind']),
				'nm_tind' => clean_data($_POST['nm_tind']),
				'js_dok_tind' => clean_data($_POST['js_dok_tind']),
				'js_rs_tind' => clean_data($_POST['js_rs_tind']),
				'id_ins_tind' => clean_data($_POST['id_ins_ajax']),
				'tampil_di_pemeriksaan' => $tampil,
				'set_pemeriksaan_fisik' => $setpem,
				'set_struktur_gigi' => $setgigi,
				'order_form_baru' => clean_data($_POST['order_form_baru']),
				'order_tindakan' => clean_data($_POST['order_tindakan']),
				'lantai_tind' => clean_data($_POST['lantai_tind']),
				'stakes_tindakan' => clean_data($_POST['stakes_tindakan']),
				'keterangan_tind' => clean_data($_POST['keterangan_tind']),
				'ket_cetak_pemeriksaan_pasien' => $setcet,
				'jangan_tampil_stakes' => $settanpastakes,
			);
			if(isset($_POST['kd_grouptind'])){
				$dataInsert['kd_grouptind'] = $_POST['kd_grouptind'];
			} else {
				$dataInsert['kd_grouptind'] = 'DEF_GROUP_TIND';
			}
			if(empty($_POST['id_tind'])){
				if($baba){
					die('Tindakan sudah terdaftar');
				}
				$this->db->insert('tb_tindakan', $dataInsert);
			} else {
				if($_POST['kd_tind'] != $_POST['kd_tind_lama']){
					if($baba){
						die('Kode tindakan sudah digunakan');
					}
				}
				$this->db->where('id_tind', $_POST['id_tind']);
				$this->db->update('tb_tindakan', $dataInsert);
			}
			echo 'simpan';
		}	
	}
	public function hapusdatatindakan(){
		$this->db->where('id_tind', $_POST['id']);
		$this->db->delete('tb_tindakan');
	}
	public function simpanupdatepenglabawal(){
		foreach($_POST AS $ke => $ra){
			$app['app_val'] = $ra;
			$this->db->where("app_key", $ke);
			$this->db->update("tb_setting", $app);
		}
		echo "simpan";
	}
	public function simpansetheadertind(){
		//print_r(strip_tags(trim(($_POST['val']))));
		$dtInse['header_app_tind'] = clean_data($_POST['val']);
		$this->db->where('id_tind', clean_data($_POST['id']));
		$this->db->update('tb_tindakan', $dtInse);
	}
	public function simpandetailtambahajaxpem(){
		//print_r($_POST);
		//die();
		//pertama adalah hapus semua yang tindakan nya yang diloop
		//penting jangan ada relasi ketabel pemeriksaan meta_key
		$this->db->where('id_tind', $_POST['kd_tind_simp']);
		$this->db->delete('tb_pemeriksaan_meta');
		if(is_array($_POST['cek'])){
			foreach($_POST['cek'] as $dg => $dr){
				//cek apakah sudah ada datanya ya
				$dtt = array(
					'id_pem' => $dg, 
					'id_tind' => clean_data($_POST['kd_tind_simp']), 
				);
				$this->db->insert('tb_pemeriksaan_meta', $dtt);
			}
		}
		
		foreach($_POST['periksaok'] as $kbb => $vsvv){
			$sia[] = array(
				'id_pem' => $kbb, 
				'nomorbuku' => trim($vsvv), 
			);
				
		}
		if(is_array($sia)){
			$this->db->update_batch('tb_pemeriksaan', $sia, 'id_pem');
		}
		echo 'Insert';
	}
	public function simpandetailtmbhpempolibaru(){
		//pertama adalah hapus semua yang tindakan nya yang diloop
		//penting jangan ada relasi ketabel pemeriksaan meta_key
		$this->db->where('id_tind', $_POST['kd_tind_simp']);
		$this->db->delete('tb_pemeriksaan_meta');
		if(is_array($_POST['cek'])){
			foreach($_POST['cek'] as $dg => $dr){
				//cek apakah sudah ada datanya ya
				$dtt = array(
					'id_pem' => $dg, 
					'id_tind' => clean_data($_POST['kd_tind_simp']), 
				);
				$this->db->insert('tb_pemeriksaan_meta', $dtt);
			}
		}
		
		foreach($_POST['periksaok'] as $kbb => $vsvv){
			$sia[] = array(
				'id_pem' => $kbb, 
				'nomorbuku' => trim($vsvv), 
			);
				
		}
		if(is_array($sia)){
			$this->db->update_batch('tb_pemeriksaan', $sia, 'id_pem');
		}
		echo 'Insert';
	}
	public function simpanpemeriksaanlabrsau(){
		if($_POST['header_lap_lab'] == 'Y'){
			$dty = array (
				'kd_group' => clean_data($_POST['kd_group']),
				'kd_pem' => clean_data($_POST['kd_pem']),
				'nm_pem' => clean_data($_POST['nm_pem']),
				'id_user' => $this->session->userdata('id_user'),
				'setheader_lab' => $_POST['header_lap_lab'],
				'kontrol_normal' => $_POST['kontrol_normal'],
				'in_english_pem' => $_POST['in_english_pem'],
				'id_ins_periksa' => '2',
			);
		} else {
			if(empty($_POST['nm_pem']))die('Nama Pemeriksaan Harus Diisi');
			if(empty($_POST['satuan']))die('Satuan Harus Diisi');
			if(empty($_POST['nilai_rujukan']))die('Nilai Rujukan Harus Diisi');
			$this->db->where('kd_group', clean_data($_POST['kd_group']));
			$this->db->where('nm_pem', clean_data($_POST['nm_pem']));
			$jay = $this->db->get('tb_pemeriksaan');
			$yut = $jay->result();
			$dty = array (
				'kd_group' => clean_data($_POST['kd_group']),
				'kd_pem' => clean_data($_POST['kd_pem']),
				'nm_pem' => clean_data($_POST['nm_pem']),
				'in_english_pem' => $_POST['in_english_pem'],
				'satuan' => clean_data($_POST['satuan']),
				'nilai_rujukan' => $_POST['nilai_rujukan'],
				'hight' => $_POST['hight']['umum'],
				'low' => $_POST['low']['umum'],
				'hight_laki' => $_POST['hight']['laki'],
				'low_laki' => $_POST['low']['laki'],
				'hight_perempuan' => $_POST['hight']['perempuan'],
				'low_perempuan' => $_POST['low']['perempuan'],
				'hight_anak' => $_POST['hight']['anak'],
				'low_anak' => $_POST['low']['anak'],
				'hight_bayi' => $_POST['hight']['bayi'],
				'low_bayi' => $_POST['low']['bayi'],
				'hight_bayi3-5' => $_POST['hight']['bayi_baru1'],
				'low_bayi3-5' => $_POST['low']['bayi_baru1'],
				'hight_bayi1-2' => $_POST['hight']['bayi_baru2'],
				'low_bayi1-2' => $_POST['low']['bayi_baru2'],
				'positif_negatif' => $_POST['positif_negatif'],
				'type_tampil' => $_POST['type_tampil'],
				'id_user' => $this->session->userdata('id_user'),
				'kontrol_normal' => $_POST['kontrol_normal'],
				'id_ins_periksa' => '2',
			);
		}
		if(empty($_POST['id_pem'])){
			if($yut)die('Jenis Pemeriksaan Sudah terdaftar ');
			$dty['tglmsk'] = date("Y-m-d H:i:s");
			$jk = $this->db->insert('tb_pemeriksaan', $dty);
		} else {
			$this->db->where('id_pem', $_POST['id_pem']);
			$jk = $this->db->update('tb_pemeriksaan', $dty);
		}
		if($jk)echo 'Insert';
	}
	public function hapuspemeriksaanlab(){
		$this->db->where('id_pem', $_POST['ID']);
		$this->db->delete('tb_pemeriksaan');
	}
	public function simpanupdatesyairradiologi(){
		if(!$_POST){
			die("Pilih tindakan terlebih dahulu");
		}
		$faf['syair_radiologi'] = $_POST['syair_radiologi'];
		$this->db->where('id_tind', $_POST['id_tindakan']);
		$this->db->update('tb_tindakan', $faf);
		echo 'simpan';
	}
	public function simpanupdatepaketmcusatu(){
		//AMBIL KODENYA YAAAAA
		$this->db->where('nm_paket', $_POST['nm_paket']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_paket');
		$baba = $ggdt->result();
		if($_POST){
			$dataInsert = array (
				'nm_paket' => clean_data($_POST['nm_paket']),
				'harga_paket' => clean_data($_POST['harga_paket']),
				'jenis_paket' => 'P',
			);
			if(empty($_POST['id_paket'])){
				if($baba){
					die('Nama Paket terdaftar');
				}
				//buat kode pemeriksaannya yaaa
				$this->db->select_max('kd_paket', 'kd_paket_max');
				$this->db->limit('1');
				$max = $this->db->get('tb_paket');
				$maxs = $max->result();
				$noUrut = (int) substr($maxs[0]->kd_paket_max, 3, 4); 
				$noUrut++;
				$newIDB = "MCU". sprintf("%04s", $noUrut);
				$urut = $newIDB;
				$dataInsert['kd_paket'] = $urut;
				$this->db->insert('tb_paket', $dataInsert);
			} else {
				if($_POST['nm_paket'] != $_POST['nm_paket_lama']){
					if($baba){
						die('Nama Paket sudah digunakan');
					}
				}
				$this->db->where('id_paket', $_POST['id_paket']);
				$this->db->update('tb_paket', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function hapuspaketmcu(){
		$this->db->where('id_paket', $_POST['id']);
		$this->db->delete('tb_paket');
	}
	public function hapusrincianpaketmcu(){
		$this->db->where('id_paket_meta', $_POST['id']);
		$this->db->delete('tb_paket_meta');
	}
	public function simpanrincianpaketdetailmcu(){
		//print_r($_POST);
		if($_POST['idpaket'] == ""){
			die("Pilih Paket Terlebih dahulu");
		}
		$this->db->where('id_paket', $_POST['idpaket']);
		$this->db->where('id_tind', $_POST['idtind']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_paket_meta');
		$baba = $ggdt->result();
		if($baba){
			die("Rincian sudah dipilih");
		}
		$fffa = array(
			'id_paket' => $_POST['idpaket'],
			'id_tind' => $_POST['idtind'],
		);
		$this->db->insert('tb_paket_meta', $fffa);
		echo 'simpan';
	}
	public function simpanupdatefilterkonsul(){
		//print_r($_POST);
		$this->db->where('id_pem', $_POST['idpem']);
		$this->db->where('id_tind', $_POST['idtind']);
		$this->db->where('unicode_transaksi', $_POST['kdtransaksi']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_register_filterdata');
		$baba = $ggdt->result();
		if($baba){
			$this->db->where('id_fil', $baba[0]->id_fil);
			$this->db->delete('tb_register_filterdata');
			
		} else {
			$fffa = array(
				'id_pem' => $_POST['idpem'],
				'id_tind' => $_POST['idtind'],
				'id_paket' => '1',
				'unicode_transaksi' => $_POST['kdtransaksi'],
				'type_filter' => 'KURANG',
				'id_ins' => $_POST['idins'],
				'darikonsul' => 'Y',
			);
			$this->db->insert('tb_register_filterdata', $fffa);
		}
		die("Perubahan Berhasil Disimpan");
	}
	public function simpanupdatefiltermcu(){
		//print_r($_POST);
		$this->db->where('id_pem', $_POST['idpem']);
		$this->db->where('id_tind', $_POST['idtind']);
		$this->db->where('id_paket', $_POST['idpaket']);
		$this->db->where('unicode_transaksi', $_POST['kdtransaksi']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_register_filterdata');
		$baba = $ggdt->result();
		if($baba){
			$this->db->where('id_fil', $baba[0]->id_fil);
			$this->db->delete('tb_register_filterdata');
			
		} else {
			$fffa = array(
				'id_pem' => $_POST['idpem'],
				'id_tind' => $_POST['idtind'],
				'id_paket' => $_POST['idpaket'],
				'unicode_transaksi' => $_POST['kdtransaksi'],
				'type_filter' => 'KURANG',
				'id_ins' => $_POST['idins'],
			);
			$this->db->insert('tb_register_filterdata', $fffa);
		}
		die("Perubahan Berhasil Disimpan");
	}
		public function simpantambahkanbiaya(){
		$this->db->where('id_tind', $_POST['idtind']);
		$this->db->limit('1');
		$nnh = $this->db->get('tb_tindakan');
		$nnm = $nnh->row();
		//---------------------------------------------
		$this->db->where('id_tind', $_POST['idtind']);
		$this->db->where('id_paket', $_POST['idpaket']);
		$this->db->where('unicode_transaksi', $_POST['kdtransaksi']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_register_filterdata');
		$baba = $ggdt->row();
		if($baba){
			$this->db->where('id_fil', $baba->id_fil);
			$this->db->delete('tb_register_filterdata');
			
			//juga hapus diregister pemeriksan juga
			if($baba->sinkron_register == "Y"){
				$this->db->where('pemeriksaan_tambahan', 'Y');
				$this->db->where('kode_transaksi', $_POST['kdtransaksi']);
				$this->db->where('id_tind_pem', $_POST['idtind']);
				$this->db->where('id_paket', $_POST['idpaket']);
				$this->db->delete('tb_register_pemeriksaan');
			}
			
		} else {
			$fffa = array(
				'id_tind' => $_POST['idtind'],
				'id_paket' => $_POST['idpaket'],
				'unicode_transaksi' => $_POST['kdtransaksi'],
				'type_filter' => 'TAMBAH',
				'id_ins' => $_POST['idins'],
				'hargatindakan' => $nnm->js_rs_tind,
				'jasadokter' => $nnm->js_dok_tind,
			);
			$this->db->insert('tb_register_filterdata', $fffa);
		}
		die("Perubahan Berhasil Disimpan");
	}
	public function simpanupdatedetailpemeriksaanrad(){
		$this->db->where('rad_namapemeriksaan', $_POST['rad_namapemeriksaan']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_pemeriksaan');
		$baba = $ggdt->result();
		if(empty($_POST['rad_namapemeriksaan'])){
			die('Pemeriksaan harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'kd_group' => clean_data($_POST['id_grouprad']),
				'id_ins_periksa' => '3',
				'rad_namapemeriksaan' => clean_data($_POST['rad_namapemeriksaan']),
				'rad_nilainormal' => $_POST['rad_nilainormal'],
				'det_order_pemeriksaan' => $_POST['det_order_pemeriksaan'],
				'in_english_pem' => $_POST['in_english_pem'],
			);
			if(empty($_POST['id_pem'])){
				if($baba){
					die('Pemeriksaan sudah terdaftar');
				}
				$this->db->insert('tb_pemeriksaan', $dataInsert);
			} else {
				if($_POST['rad_namapemeriksaan'] != $_POST['rad_namapemeriksaan_lama']){
					if($baba){
						die('Pemeriksaan sudah digunakan');
					}
				}
				$this->db->where('id_pem', $_POST['id_pem']);
				$this->db->update('tb_pemeriksaan', $dataInsert);
			}
			echo 'simpan';
		}
	}
	public function simpanupdatependaftaranmcu(){
		//print_r($_POST);
		//die();
		if(empty($_POST['nip_nrp_nik'])){ 
			DIE('NIP/NRP/NIK wajib diisi');
		}
		 
		
		if(empty($_POST['nm_pas'])){ 
			DIE('Nama Wajib diisi');
		}
		if(!isset($_POST['jenkel_pas'])){ 
			DIE('Jenis Kelamin diisi');
		}
		//if(empty($_POST['id_agama'])){ 
		//	DIE('Agama Wajib diisi');
		//}
		if(empty($_POST['tgl_lhr_pas'])){ 
			DIE('Tanggal lahir Wajib diisi');
		}
		if(empty($_POST['alamat_pas'])){ 
			DIE('Alamat Wajib diisi');
		}
		//if(empty($_POST['id_pendidikan'])){ 
			//DIE('Pendidikan Wajib diisi');
		//}
		if(empty($_POST['nm_pekerjaan'])){ 
			//DIE('Pekerjaan Wajib diisi');
		}
		if(empty($_POST['id_paket'])){ 
			DIE('Paket Wajib diisi');
		}
		if(empty($_POST['cara_bayar'])){ 
			DIE('Cara Bayar Wajib diisi');
		}
		
		//pertama ambil pemeriksaan tambahan kalau ada
		$cektambahan = "select a.*, b.kd_grouptind from tb_register_filterdata a, tb_tindakan b where a.id_tind=b.id_tind and a.unicode_transaksi='".clean_data($_POST['kode_transaksi'])."' and a.type_filter='TAMBAH' and a.sinkron_register='' and a.id_paket=".clean_data($_POST['id_paket'])." ";
		$gettambahan = $this->db->query($cektambahan);
		$loptambahan = $gettambahan->result();
		//print_r($loptambahan);
		//die();
		
		$this->db->select('nm_dinas, tipe_dinas');
		$this->db->where('id_dinas', $_POST['id_dinas']);
		$this->db->limit('1');
		$dinss  = $this->db->get('tb_dinas');
		$getdn = $dinss->row();
		
		if(empty($getdn->tipe_dinas)){
			die("Hubungi Administrator untuk setting tipe Dinas / Non Dinas");
		}
		
		
		$typejwt = $getdn->tipe_dinas;
		$kodepasien = $_POST['id_pas'];
		$nomorfile  = $_POST['id_reg'];
		//script jika pasien baru-----------------------------------
		if(empty($_POST['id_pas'])){
			//langkah pertama adalah buat idpas kalau dia pasien baru
			$ckk = $this->db->query("select max(no_reg) as no_reg_new from tb_pasien where no_reg like '".$typejwt."%'");
			$cks = $ckk->row();
			if($cks->no_reg_new == ""){
				$kodepasien = $typejwt."000000001";
			}else {
				$noUrut = (int) substr($cks->no_reg_new, 1, 9); 
				$noUrut++;
				$kodepasien = $typejwt . sprintf("%09s", $noUrut);
			}
		}
		
		//print_r($getdn);
		//die();
		//script jika register baru-----------------------------------
		if(empty($_POST['id_reg'])){
			if($getdn->tipe_dinas == "D"){
				//langkah pertama adalah buat idpas kalau dia pasien baru
				$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%-".clean_data($getdn->nm_dinas)."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y')."' ");
				$ggt = $yyy->row();
				if($ggt->urut_file_new == ""){
					$nomorfile = "01-". clean_data($getdn->nm_dinas) ."/". date("m-Y");
				}else {
					$noUrut  = $ggt->urut_file_new; 
					$newurut = $noUrut+1;
					$getkemurut = sprintf("%02s", $newurut);
					$nomorfile = $getkemurut . "-". clean_data($getdn->nm_dinas) ."/". date("m-Y");
				}
			} else{
				//langkah pertama adalah buat idpas kalau dia pasien baru
				$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%-".clean_data($_POST['cara_bayar'])."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y')."' ");
				$ggt = $yyy->row();
				if($ggt->urut_file_new == ""){
					$nomorfile = "01-". clean_data($_POST['cara_bayar']) ."/". date("m-Y");
				}else {
					$noUrut  = $ggt->urut_file_new; 
					$newurut = $noUrut+1;
					$getkemurut = sprintf("%02s", $newurut);
					$nomorfile = $getkemurut . "-". clean_data($_POST['cara_bayar']) ."/". date("m-Y");
				}
			}
		}
		//print_r($_POST);
		//die();
		//end script jika register baru-----------------------------------
		//-----disini mulai simpan data yaaa
		$datapasien = array(
			'no_reg' => $kodepasien,
			'preposisi' => clean_data($_POST['preposisi']),
			'nm_pas' => clean_data($_POST['nm_pas']),
			'tmp_lahir_pas' => clean_data($_POST['tmp_lahir_pas']),
			'tgl_lhr_pas' => date("Y-m-d", strtotime($_POST['tgl_lhr_pas'])),
			'jenkel_pas' => clean_data($_POST['jenkel_pas']),
			'id_agama' => clean_data($_POST['id_agama']),
			'alamat_pas' => clean_data($_POST['alamat_pas']),
			'no_ktp_pas' => clean_data($_POST['no_ktp_pas']),
			'no_tlp_pas' => clean_data($_POST['no_tlp_pas']),
			'nm_pekerjaan' => clean_data($_POST['nm_pekerjaan']),
			'jabatan_pas' => clean_data($_POST['jabatan_pas']),
			'id_jawatan' => clean_data($_POST['id_jawatan']),
			'kawin_pas' => clean_data($_POST['kawin_pas']),
			'id_dinas' => clean_data($_POST['id_dinas']),
			'kesatuan_pas' => clean_data($_POST['kesatuan_pas']),
			'pangkat_pas' => clean_data($_POST['pangkat_pas']),
			'bangsa_pas' => clean_data($_POST['bangsa_pas']),
			'id_pendidikan' => clean_data($_POST['id_pendidikan']),
			'gol_darah' => clean_data($_POST['gol_darah']),
			'nip_nrp_nik' => clean_data($_POST['nip_nrp_nik']),
			'dept_pas' => clean_data($_POST['dept_pas']),
		);
		if(empty($_POST['id_pas'])){
			$datapasien['tgl_daftar'] = date("Y-m-d H:i:s");
			$this->db->insert('tb_pasien', $datapasien);
		}else {
			$this->db->where('no_reg', $kodepasien);
			$this->db->update('tb_pasien', $datapasien);
		}
		//lanjut simpan registernya yaaaa
		$urut_file = explode("-", $nomorfile);
		$dataregister = array(
			'kode_transaksi' => clean_data($_POST['kode_transaksi']),
			'id_dinas_dua' => clean_data($_POST['id_dinas']),
			'no_filemcu' => $nomorfile,
			'urut_file' => (int) clean_data($urut_file[0]),
			'no_reg' => clean_data($kodepasien),
		);
		
		if(!empty($_POST['id_ol'])){
			$optoll['sudah_didaftarkan'] = "Y";
			$optoll['unicode_regs'] = clean_data($_POST['kode_transaksi']);
			$this->db->where('id', $_POST['id_ol']);
			$this->db->update('api_booking', $optoll);
		}
		$dataregister['tgl_awal_reg'] = date("Y-m-d H:i:s", strtotime($_POST['tgl_awal_reg']));
		$dataregister['cara_bayar'] = clean_data($_POST['cara_bayar']);
		if(!empty($_POST['id_reg'])){
			//maka update saja ya dan bearkhir sampai disini.....
			if($_POST['cara_bayar_lama'] != $_POST['cara_bayar']){
				//mari update ditabel transaksinya
				$newupdatetransa['cara_bayar'] = $_POST['cara_bayar'];
				$this->db->where('kode_transaksi', clean_data($_POST['kode_transaksi']));
				$this->db->update('tb_transaksi', $newupdatetransa);
			}
			$this->db->where('no_filemcu', $_POST['id_reg']);
			$this->db->update('tb_register', $dataregister);
		}else {
			//maka simpan ketabel lainnya yaaaa
			$dataregister['id_paket'] = clean_data($_POST['id_paket']);
			$this->db->insert('tb_register', $dataregister);
			//lanjutkan simpan ketabel  tb_register_pemeriksaan
			$fsgd = "select a.id_tind, b.id_ins_tind, b.kd_grouptind from tb_paket_meta a, tb_tindakan b where a.id_tind=b.id_tind and a.id_paket='".clean_data($_POST['id_paket'])."' ";
			$absc = $this->db->query($fsgd);
			$gfsd = $absc->result();
			if($gfsd){
					foreach($gfsd as $bsd){
						$datapemeriksaan[] = array(
							'kode_transaksi' => clean_data($_POST['kode_transaksi']),
							'id_tind_pem' => $bsd->id_tind,
							'id_ins_tind_pem' => $bsd->id_ins_tind,
							'kd_grouptind' => $bsd->kd_grouptind,
							'id_paket' => clean_data($_POST['id_paket']),
						);
						
						//saatnya simpan juga detail pemeriksaane yaaaaaaaa
						//INI GA JADI DISIMPAN SEKARANG, SIMPANE NGKO NEK WIS PAS INPUT YA
						//MEN KETIKA ANA PERUBAHAN NANG INPUTE NGUPDATE
						/*$this->db->select('id_pem');
						$this->db->where('id_tind', $bsd->id_tind);
						$tmds  = $this->db->get('tb_pemeriksaan_meta');
						$kusd = $tmds->result();
						if($kusd){
							foreach($kusd as $wes){
								$datadetailpemeriksaan = array(
									'kode_transaksi' => clean_data($_POST['kode_transaksi']),
									'id_tind_detpem' => $bsd->id_tind,
									'id_ins_tind_detpem' => $bsd->id_ins_tind,
									'kd_grouptind' => $bsd->kd_grouptind,
									'id_pem_deb' => $wes->id_pem,
									'id_paket' => clean_data($_POST['id_paket']),
								);
								$this->db->insert('tb_register_detailpemeriksaan', $datadetailpemeriksaan);
							}
						}*/
					}
					
					if(is_array($datapemeriksaan)){
						$this->db->insert_batch('tb_register_pemeriksaan', $datapemeriksaan);
					}
			}
			
			
			//saatnya simpan transaksinya yaaaa
			$this->db->select('harga_paket');
			$this->db->where('id_paket', $_POST['id_paket']);
			$this->db->limit('1');
			$jhdn  = $this->db->get('tb_paket');
			$nhsv = $jhdn->result();
			if($nhsv){
				$datatransaksi = array(
					'kode_transaksi' => clean_data($_POST['kode_transaksi']),
					'id_paket' => clean_data($_POST['id_paket']),
					'cara_bayar' => clean_data($_POST['cara_bayar']),
					'harga' => $nhsv[0]->harga_paket,
				);
				$this->db->insert('tb_transaksi', $datatransaksi);
			}
		}
		
		
		//saatnya simpan pemeriksaan tambahan jika ada
		if($loptambahan){
			foreach($loptambahan as $lpptmb){
					$datatambahan[] = array(
						'kode_transaksi' => clean_data($_POST['kode_transaksi']),
						'id_tind_pem' => $lpptmb->id_tind,
						'id_ins_tind_pem' => $lpptmb->id_ins,
						'kd_grouptind' => $lpptmb->kd_grouptind,
						'id_paket' => clean_data($_POST['id_paket']),
						'pemeriksaan_tambahan' => 'Y',
					);
					$dataupdate[] = array(
						'id_fil' => $lpptmb->id_fil,
						'sinkron_register' => 'Y',
					);
			}
			if(is_array($datatambahan)){
				$this->db->insert_batch('tb_register_pemeriksaan', $datatambahan);
			}
			if(is_array($dataupdate)){
				$this->db->update_batch('tb_register_filterdata', $dataupdate, 'id_fil');
			}
		}
		
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'SIMPANUPDATEDAFTAR',
			'sub_type'   	=> $_POST['kode_transaksi'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		echo 'simpan';
	}
	
	public function sinkronkanpaket(){
		//lanjutkan simpan ketabel  tb_register_pemeriksaan
			$fsgd = "select a.id_tind, b.nm_tind, b.id_ins_tind, b.kd_grouptind from tb_paket_meta a, tb_tindakan b where a.id_tind=b.id_tind and a.id_paket='".clean_data($_POST['idpaket'])."' ";
			$absc = $this->db->query($fsgd);
			$gfsd = $absc->result();
			if($gfsd){
					foreach($gfsd as $bsd){
						//cek apakah ada yng belum masuk ya
						$this->db->select('id_tind_pem');
						$this->db->where('kode_transaksi', clean_data($_POST['kode']));
						$this->db->where('id_tind_pem', $bsd->id_tind);
						$this->db->where('id_paket', clean_data($_POST['idpaket']));
						$gdgh = $this->db->get('tb_register_pemeriksaan');
						$dgfs = $gdgh->row();
						if(!$dgfs){
							$tmnbhggs[$bsd->id_tind] = $bsd->nm_tind;
							$datapemeriksaan[] = array(
								'kode_transaksi' => clean_data($_POST['kode']),
								'id_tind_pem' => $bsd->id_tind,
								'id_ins_tind_pem' => $bsd->id_ins_tind,
								'kd_grouptind' => $bsd->kd_grouptind,
								'id_paket' => clean_data($_POST['idpaket']),
							);
						}
					}
					//print_r($datapemeriksaan);
					if(is_array($datapemeriksaan)){
						$this->db->insert_batch('tb_register_pemeriksaan', $datapemeriksaan);
					}
					
			}
			
			if(is_array($tmnbhggs)){
				die("Berhasil mensinkronkan (".implode(", ", $tmnbhggs).") kedalam transaksi Pasien");
			}else{
				die("Data Sudah Sinkron");
			}
					
					
	}
	public function hapusregistrasipasien(){
		//hapus juga yang ada difilter
		$this->db->where('unicode_transaksi', $_POST['kod']);
		$this->db->delete('tb_register_filterdata');
		$this->db->where('id_reg', $_POST['id']);
		$this->db->delete('tb_register');
	}
	public function gantipaketregistrasi(){
		
		//print_r($_POST);
		//DIE();
		if(empty($_POST['id_paket'])){
			die('Pilih paket terlebih dahulu');
		}
	/*	$this->db->where('type_filter', 'KURANG');
		$this->db->where('unicode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_filterdata');
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_detailpemeriksaan');
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_pemeriksaan');
	*/
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_transaksi');
		//saatnya simpan dan update
		$dataregister['id_paket'] = clean_data($_POST['id_paket']);
		$this->db->where('id_reg', $_POST['idreg']);
		$this->db->update('tb_register', $dataregister);
		//saatnya buat paketnya lagi yaaa
		//lanjutkan simpan ketabel  tb_register_pemeriksaan
			$fsgd = "select a.id_tind, b.id_ins_tind, b.kd_grouptind from tb_paket_meta a, tb_tindakan b where a.id_tind=b.id_tind and a.id_paket='".clean_data($_POST['id_paket'])."' ";
			$absc = $this->db->query($fsgd);
			$gfsd = $absc->result();
			if($gfsd){
					foreach($gfsd as $bsd){
						//pertama cek apakah dipaket sebelumnya ada pemeriksaan itu ap ga
						$this->db->select('id_reg_pem');
						$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
						$this->db->where('id_tind_pem', $bsd->id_tind);
						$cekdatasardulu = $this->db->get('tb_register_pemeriksaan');
						$sekdatasardulu = $cekdatasardulu->row();
						if($sekdatasardulu){
							$datapemeriksaanbaruupdate[] = array(
								'id_reg_pem' => $sekdatasardulu->id_reg_pem,
								'id_paket' => clean_data($_POST['id_paket']),
							);
							
							$apdetnewkodsbarukaloada['id_paket'] = $_POST['id_paket'];
							$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
							$this->db->where('id_tind_detpem', $bsd->id_tind);
							$this->db->update('tb_register_detailpemeriksaan', $apdetnewkodsbarukaloada);
						}else{
							$datapemeriksaanbarusimpan[] = array(
								'kode_transaksi' => clean_data($_POST['kode_transaksi']),
								'id_tind_pem' => $bsd->id_tind,
								'id_ins_tind_pem' => $bsd->id_ins_tind,
								'kd_grouptind' => $bsd->kd_grouptind,
								'id_paket' => clean_data($_POST['id_paket']),
							);
						}
					}
					
					//simpan
					if(is_array($datapemeriksaanbarusimpan)){
						$this->db->insert_batch('tb_register_pemeriksaan', $datapemeriksaanbarusimpan);
					}
					
					//update
					if(is_array($datapemeriksaanbaruupdate)){
						$this->db->update_batch('tb_register_pemeriksaan', $datapemeriksaanbaruupdate, 'id_reg_pem');
					}
					
					//selanjutnya adalah hapus yang ga ada
					$apdetnewkodsbarukaloada['id_paket'] = $_POST['id_paket'];
					$this->db->where('unicode_transaksi', $_POST['kode_transaksi']);
					$this->db->update('tb_register_filterdata', $apdetnewkodsbarukaloada);
					
					//yang tambahan juga diapdet yaaaaaaaaaaaa
					$apdetnewkodsbarukaloada['id_paket'] = $_POST['id_paket'];
					$this->db->where('pemeriksaan_tambahan', 'Y');
					$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
					$this->db->update('tb_register_pemeriksaan', $apdetnewkodsbarukaloada);
					
					//selanjutnya apdet yang pemeriksaan tambahan didetail
					$this->db->select('id_tind_pem');
					$this->db->where('pemeriksaan_tambahan', 'Y');
					$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
					$getpemtambahanok = $this->db->get('tb_register_pemeriksaan');
					$setpemtambahanok = $getpemtambahanok->result();
					foreach($setpemtambahanok as $fddckkpp){
							$apdetnewkodsbarukaloada['id_paket'] = $_POST['id_paket'];
							$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
							$this->db->where('id_tind_detpem', $fddckkpp->id_tind_pem);
							$this->db->update('tb_register_detailpemeriksaan', $apdetnewkodsbarukaloada);
					}
					
					
					
					
					
					//hapus yang setelah apdet ga adaaaaaaa
					$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
					$this->db->where("id_paket <> ".$_POST['id_paket']." ");
					$this->db->delete('tb_register_pemeriksaan');
					
					$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
					$this->db->where("id_paket <> ".$_POST['id_paket']." ");
					$this->db->delete('tb_register_detailpemeriksaan');
					
					
					
					
					
			}
			//saatnya simpan transaksinya yaaaa
			$this->db->select('harga_paket');
			$this->db->where('id_paket', $_POST['id_paket']);
			$this->db->limit('1');
			$jhdn  = $this->db->get('tb_paket');
			$nhsv = $jhdn->result();
			if($nhsv){
				$datatransaksi = array(
					'kode_transaksi' => clean_data($_POST['kode_transaksi']),
					'id_paket' => clean_data($_POST['id_paket']),
					'cara_bayar' => clean_data($_POST['cara_bayar']),
					'harga' => $nhsv[0]->harga_paket,
				);
				$this->db->insert('tb_transaksi', $datatransaksi);
			}
			echo 'simpan';
	}
	public function simpanupdatependaftarankonsul(){
		//print_r($_POST);
		
		if(empty($_POST['nip_nrp_nik'])){ 
			DIE('NIP/NRP/NIK wajib diisi');
		}
		
		if(empty($_POST['nm_pas'])){ 
			DIE('Nama Wajib diisi');
		}
		if(!isset($_POST['jenkel_pas'])){ 
			DIE('Jenis Kelamin diisi');
		}
		if(empty($_POST['id_agama'])){ 
			//DIE('Agama Wajib diisi');
		}
		if(empty($_POST['tgl_lhr_pas'])){ 
			DIE('Tanggal lahir Wajib diisi');
		}
		if(empty($_POST['alamat_pas'])){ 
			DIE('Alamat Wajib diisi');
		}
		if(empty($_POST['id_pendidikan'])){ 
			//DIE('Pendidikan Wajib diisi');
		}
		if(empty($_POST['nm_pekerjaan'])){ 
			//DIE('Pekerjaan Wajib diisi');
		}
		if(empty($_POST['cara_bayar'])){ 
			DIE('Cara Bayar Wajib diisi');
		}
		if(!is_array($_POST['list_pemeriksaan'])){
			DIE('Pilih minimal 1 Pemeriksaan');
		}
				foreach($_POST['list_pemeriksaan'] as $fd){
					if(!empty($fd)){
						if(is_numeric($fd)){
							$pemeriksaancek[] = 1;
						}
					}
				}
				
		if(!is_array($pemeriksaancek)){
			DIE('Pilih minimal 1 Pemeriksaan');
		}
		
		
		
		
		$this->db->select('nm_dinas, tipe_dinas');
		$this->db->where('id_dinas', $_POST['id_dinas']);
		$this->db->limit('1');
		$dinss  = $this->db->get('tb_dinas');
		$getdn = $dinss->row();
		
		
		if(empty($getdn->tipe_dinas)){
			die("Hubungi Administrator untuk setting tipe Dinas / Non Dinas");
		}
		
		$typejwt = $getdn->tipe_dinas;
		$kodepasien = $_POST['id_pas'];
		$nomorfile  = $_POST['id_reg'];
		//script jika pasien baru-----------------------------------
		if(empty($_POST['id_pas'])){
			//langkah pertama adalah buat idpas kalau dia pasien baru
			$ckk = $this->db->query("select max(no_reg) as no_reg_new from tb_pasien where no_reg like '".$typejwt."%'");
			$cks = $ckk->result();
			if($cks[0]->no_reg_new == ""){
				$kodepasien = $typejwt."000000001";
			}else {
				$noUrut = (int) substr($cks[0]->no_reg_new, 1, 9); 
				$noUrut++;
				$kodepasien = $typejwt . sprintf("%09s", $noUrut);
			}
		}
		//script jika register baru-----------------------------------
		if(empty($_POST['id_reg'])){
			
			if($getdn->tipe_dinas == "D"){
				//langkah pertama adalah buat idpas kalau dia pasien baru
				$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%KS-".clean_data($getdn->nm_dinas)."/%' and konsul='Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y')."' ");
				$ggt = $yyy->result();
				if($ggt[0]->urut_file_new == ""){
					$nomorfile = "01-KS-". clean_data($getdn->nm_dinas) ."/". date("m-Y");
				}else {
					$noUrut  = $ggt[0]->urut_file_new; 
					$newurut = $noUrut+1;
					$getkemurut = sprintf("%02s", $newurut);
					$nomorfile = $getkemurut . "-KS-". clean_data($getdn->nm_dinas) ."/". date("m-Y");
				}
			} else {
				//langkah pertama adalah buat idpas kalau dia pasien baru
				$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%".clean_data($_POST['cara_bayar'])."%' and konsul='Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y')."' ");
				$ggt = $yyy->result();
				if($ggt[0]->urut_file_new == ""){
					$nomorfile = "01-KS-". clean_data($_POST['cara_bayar']) ."/". date("m-Y");
				}else {
					$noUrut  = $ggt[0]->urut_file_new; 
					$newurut = $noUrut+1;
					$getkemurut = sprintf("%02s", $newurut);
					$nomorfile = $getkemurut . "-KS-". clean_data($_POST['cara_bayar']) ."/". date("m-Y");
				}
			}
		}
		//end script jika register baru-----------------------------------
		//-----disini mulai simpan data yaaa
		$datapasien = array(
			'no_reg' => $kodepasien,
			'preposisi' => clean_data($_POST['preposisi']),
			'nm_pas' => clean_data($_POST['nm_pas']),
			'tmp_lahir_pas' => clean_data($_POST['tmp_lahir_pas']),
			'tgl_lhr_pas' => date("Y-m-d", strtotime($_POST['tgl_lhr_pas'])),
			'jenkel_pas' => clean_data($_POST['jenkel_pas']),
			'id_agama' => clean_data($_POST['id_agama']),
			'alamat_pas' => clean_data($_POST['alamat_pas']),
			'no_ktp_pas' => clean_data($_POST['no_ktp_pas']),
			'no_tlp_pas' => clean_data($_POST['no_tlp_pas']),
			'nm_pekerjaan' => clean_data($_POST['nm_pekerjaan']),
			'jabatan_pas' => clean_data($_POST['jabatan_pas']),
			'id_jawatan' => clean_data($_POST['id_jawatan']),
			'kawin_pas' => clean_data($_POST['kawin_pas']),
			'id_dinas' => clean_data($_POST['id_dinas']),
			'perusahaan_konsul' => clean_data($_POST['perusahaan_konsul']),
			'kesatuan_pas' => clean_data($_POST['kesatuan_pas']),
			'pangkat_pas' => clean_data($_POST['pangkat_pas']),
			'bangsa_pas' => clean_data($_POST['bangsa_pas']),
			'id_pendidikan' => clean_data($_POST['id_pendidikan']),
			'gol_darah' => clean_data($_POST['gol_darah']),
			'nip_nrp_nik' => clean_data($_POST['nip_nrp_nik']),
			'dept_pas' => clean_data($_POST['dept_pas']),
		);
		if(empty($_POST['id_pas'])){
			$datapasien['tgl_daftar'] = date("Y-m-d H:i:s");
			$this->db->insert('tb_pasien', $datapasien);
		}else {
			$this->db->where('no_reg', $kodepasien);
			$this->db->update('tb_pasien', $datapasien);
		}
		//lanjut simpan registernya yaaaa
		$urut_file = explode("-", $nomorfile);
		$dataregister = array(
			'maksud_pemeriksaan' => $_POST['maksud_pemeriksaan'],
			'id_dinas_dua' => clean_data($_POST['id_dinas']),
			'kode_transaksi' => clean_data($_POST['kode_transaksi']),
			'no_filemcu' => $nomorfile,
			'urut_file' => (int) clean_data($urut_file[0]),
			'no_reg' => clean_data($kodepasien),
			'id_paket' => '1',
			'konsul' => 'Y',
			'kode_transaksi_utama' => clean_data($_POST['referensi_nofile']),
		);
		$dataregister['tgl_awal_reg'] = date("Y-m-d H:i:s", strtotime($_POST['tgl_awal_reg']));
		$dataregister['cara_bayar'] = clean_data($_POST['cara_bayar']);
		if(!empty($_POST['id_reg'])){
			//maka update saja ya dan bearkhir sampai disini.....
			//maka update saja ya dan bearkhir sampai disini.....
			if($_POST['cara_bayar_lama'] != $_POST['cara_bayar']){
				//mari update ditabel transaksinya
				$newupdatetransa['cara_bayar'] = $_POST['cara_bayar'];
				$this->db->where('kode_transaksi', clean_data($_POST['kode_transaksi']));
				$this->db->update('tb_transaksi', $newupdatetransa);
			}
			$this->db->where('no_filemcu', $_POST['id_reg']);
			$this->db->update('tb_register', $dataregister);
		}else {
			//maka simpan ketabel lainnya yaaaa
			$this->db->insert('tb_register', $dataregister);
				$tmbhpks = " and (";
				foreach($_POST['list_pemeriksaan'] as $fd){
					if(!empty($fd)){
						if(is_numeric($fd)){
							$tmbhpks .= " b.id_tind='".$fd."' OR ";
						}
					}
				}
				$tmbhpks .= ")*****";
				$tmbhpks = str_replace(" OR )*****", " ) ", $tmbhpks);
			$mm = "select b.id_tind, b.id_ins_tind, b.kd_grouptind from tb_tindakan b where 1=1 ";
			$mm .= $tmbhpks;
			$absc = $this->db->query($mm);
			$gfsd = $absc->result();
			if($gfsd){
					foreach($gfsd as $bsd){
						$datapemeriksaan = array(
							'kode_transaksi' => clean_data($_POST['kode_transaksi']),
							'id_tind_pem' => $bsd->id_tind,
							'id_ins_tind_pem' => $bsd->id_ins_tind,
							'kd_grouptind' => $bsd->kd_grouptind,
							'id_paket' => '1',
						);
						$this->db->insert('tb_register_pemeriksaan', $datapemeriksaan);
						//saatnya simpan juga detail pemeriksaane yaaaaaaaa
						//INI GA JADI DISIMPAN SEKARANG, SIMPANE NGKO NEK WIS PAS INPUT YA
						//MEN KETIKA ANA PERUBAHAN NANG INPUTE NGUPDATE
						/*
						$this->db->select('id_pem');
						$this->db->where('id_tind', $bsd->id_tind);
						$tmds  = $this->db->get('tb_pemeriksaan_meta');
						$kusd = $tmds->result();
						if($kusd){
							foreach($kusd as $wes){
								$datadetailpemeriksaan = array(
									'kode_transaksi' => clean_data($_POST['kode_transaksi']),
									'id_tind_detpem' => $bsd->id_tind,
									'id_ins_tind_detpem' => $bsd->id_ins_tind,
									'kd_grouptind' => $bsd->kd_grouptind,
									'id_pem_deb' => $wes->id_pem,
									'id_paket' => '1',
								);
								$this->db->insert('tb_register_detailpemeriksaan', $datadetailpemeriksaan);
							}
						}*/
					}
			}
			//saatnya simpan transaksinya yaaaa tindakanya yaaaaaaaa
			foreach($_POST['list_pemeriksaan'] as $fd){
				$this->db->select('id_tind, js_dok_tind,  js_rs_tind');
				$this->db->where('id_tind', $fd);
				$this->db->limit('1');
				$jhdn  = $this->db->get('tb_tindakan');
				$nhsv = $jhdn->result();
				if($nhsv){
					$datatransaksi = array(
						'kode_transaksi' => clean_data($_POST['kode_transaksi']),
						'id_paket' => '1',
						'cara_bayar' => clean_data($_POST['cara_bayar']),
						'id_tind' => $nhsv[0]->id_tind,
						'harga_pemeriksaan' => $nhsv[0]->js_rs_tind,
						'jasa_dokter' => $nhsv[0]->js_dok_tind,
						'trans_konsul' => 'Y',
					);
					$this->db->insert('tb_transaksi', $datatransaksi);
				}
			}
		}
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'SIMPANUPDATEKONSUL',
			'sub_type'   	=> $_POST['kode_transaksi'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		
		
		echo 'simpan';
		
	}
	public function gantipemeriksaankonsulya(){
		if(!is_array($_POST['pemeriksaan'])){
			die('Pilih minimal 1 pemeriksaan');
		}
		$this->db->where('type_filter', 'KURANG');
		$this->db->where('unicode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_filterdata');
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_detailpemeriksaan');
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_register_pemeriksaan');
		$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
		$this->db->delete('tb_transaksi');
		//saatnya simpan dan update
		$tmbhpks = " and (";
				foreach($_POST['pemeriksaan'] as $fd){
					if(!empty($fd)){
						if(is_numeric($fd)){
							$tmbhpks .= " b.id_tind='".$fd."' OR ";
						}
					}
				}
				$tmbhpks .= ")*****";
				$tmbhpks = str_replace(" OR )*****", " ) ", $tmbhpks);
			$mm = "select b.id_tind, b.id_ins_tind, b.kd_grouptind from tb_tindakan b where 1=1 ";
			$mm .= $tmbhpks;
			$absc = $this->db->query($mm);
			$gfsd = $absc->result();
			if($gfsd){
					foreach($gfsd as $bsd){
						$datapemeriksaan = array(
							'kode_transaksi' => clean_data($_POST['kode_transaksi']),
							'id_tind_pem' => $bsd->id_tind,
							'id_ins_tind_pem' => $bsd->id_ins_tind,
							'kd_grouptind' => $bsd->kd_grouptind,
							'id_paket' => '1',
						);
						
						$this->db->insert('tb_register_pemeriksaan', $datapemeriksaan);
						//saatnya simpan juga detail pemeriksaane yaaaaaaaa
						//INI GA JADI DISIMPAN SEKARANG, SIMPANE NGKO NEK WIS PAS INPUT YA
						//MEN KETIKA ANA PERUBAHAN NANG INPUTE NGUPDATE
						/*
						$this->db->select('id_pem');
						$this->db->where('id_tind', $bsd->id_tind);
						$tmds  = $this->db->get('tb_pemeriksaan_meta');
						$kusd = $tmds->result();
						if($kusd){
							foreach($kusd as $wes){
								$datadetailpemeriksaan = array(
									'kode_transaksi' => clean_data($_POST['kode_transaksi']),
									'id_tind_detpem' => $bsd->id_tind,
									'id_ins_tind_detpem' => $bsd->id_ins_tind,
									'kd_grouptind' => $bsd->kd_grouptind,
									'id_pem_deb' => $wes->id_pem,
									'id_paket' => '1',
								);
								$this->db->insert('tb_register_detailpemeriksaan', $datadetailpemeriksaan);
							}
						}*/
					}
			}
			//saatnya simpan transaksinya yaaaa tindakanya yaaaaaaaa
			foreach($_POST['pemeriksaan'] as $fd){
				$this->db->select('id_tind, js_dok_tind,  js_rs_tind');
				$this->db->where('id_tind', $fd);
				$this->db->limit('1');
				$jhdn  = $this->db->get('tb_tindakan');
				$nhsv = $jhdn->result();
				if($nhsv){
					$datatransaksi = array(
						'kode_transaksi' => clean_data($_POST['kode_transaksi']),
						'id_paket' => '1',
						'cara_bayar' => clean_data($_POST['cara_bayar']),
						'id_tind' => $nhsv[0]->id_tind,
						'harga_pemeriksaan' => $nhsv[0]->js_rs_tind,
						'jasa_dokter' => $nhsv[0]->js_dok_tind,
						'trans_konsul' => 'Y',
					);
					$this->db->insert('tb_transaksi', $datatransaksi);
				}
			}
		echo 'simpan';
	}
	public function simpanpemeriksaanpoliklinik(){
				
		if(!empty($_FILES['userfile']['name'][0])){
			
			$config['upload_path'] = './fotogigi/';
			$config['allowed_types'] = 'jpeg|jpg|png|pdf|doc|docx';
			$config['max_size']  = 2048;
			$config['overwrite']  = FALSE;
			$config['encrypt_name']  = TRUE;
			$config['remove_spaces']  = TRUE;
			$this->load->library('upload', $config);
			
			
			foreach($_FILES['userfile'] as $key => $val){
				$i = 1;
				 foreach($val as $v){
					$field_name = "file_".$i;
					$_FILES[$field_name][$key] = $v;
					$i++;
				 }
			}
			unset($_FILES['userfile']);
			$error = array();
			$success = array();
			foreach($_FILES as $field_name => $file){
				 if ( !$this->upload->do_upload($field_name)){
					$error[] = $this->upload->display_errors();
				 }
				 else{
					$success[] = $this->upload->data();
				 }
			}
			if(count($error) > 0){
				die(strip_tags(implode(", ", $error)));
			}
		
			$dataInsertgb = array (
				'imagegigi' => $success[0]['file_name'],
			);
			$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
			$this->db->update("tb_register", $dataInsertgb);
		}
		
		
		$parentchamber = '0';
		if(isset($_POST['id_parent'])){
			$parentchamber = $_POST['id_parent'];
		}
		if(is_array($_POST['pemreg'])){
			$datregnya['keluhan_utama'] = clean_data($_POST['pemreg']['keluhan_utama']);
			$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
			$this->db->update("tb_register", $datregnya);
		}
		if(is_array($_POST['uppasien'])){
			//$detpasupt['riwayat_alergi'] = clean_data($_POST['uppasien']['riwayat_alergi']);
			$detpasupt['riwayat_kesehatan_pasien'] = clean_data($_POST['uppasien']['riwayat_kesehatan_pasien']);
			$detpasupt['riwayat_kesehatan_keluarga'] = clean_data($_POST['uppasien']['riwayat_kesehatan_keluarga']);
			$detpasupt['kebiasaan'] = clean_data($_POST['uppasien']['kebiasaan']);
			$this->db->where("no_reg", $_POST['noreg_pas']);
			$this->db->update("tb_pasien", $detpasupt);
		}
		//kie wis ora ana pindah ke pemkhsusu karena masuk kelainnan jika diisi
		if(is_array($_POST['getriwayat'])){
			$this->db->where("no_reg", $_POST['noreg_pas']);
			$this->db->delete("tb_pasien_riwayat");
			foreach($_POST['getriwayat'] as $nms => $bsf){
				foreach($bsf as $sdh => $sfa){
					//mari kita simpan
					if(!empty($sfa)){
						//print_r($sfa);
						//$sfa = $sfa == "on" ? "" : $sfa;
						$drsk = array(
							'no_reg' => $_POST['noreg_pas'],
							'riwayatkey' => $nms,
							'riwayathasil' => $sdh,
							'riwayat_lainnya' => $sfa,
						);
						$this->db->insert("tb_pasien_riwayat", $drsk);
					}
					
				}
			}
		}
		
		
		if(is_array($_POST['pemkhusus'])){
			$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
			$this->db->where("apakah_riwayat", "Y");
			$this->db->delete("tb_register_detailpemeriksaan");
			foreach($_POST['pemkhusus'] as $hyd => $gts){
				$jllssd = "";
				$apakahriwayat = "";
				if($hyd == "keterangan_td"){
					if(strtolower($hyd) != "normal"){
						$jllssd = "Y";
					}
				}
				if($hyd == "ketimt"){
					if(strtolower($hyd) != "normal"){
						$jllssd = "Y";
					}
				}
				
				
				
				$expldd = explode("___", $hyd);
				if($expldd[0] == "riwayatpasien" OR $expldd[0] == "riwayatkeluarga"){
					$jllssd = "Y";
					$apakahriwayat = "Y";
					
					if($expldd[1] == "Lainnya"){
						if(empty($gts)){
							$jllssd = "";
						}
					}
				}
				$pemkhususnya = array(
					'kode_transaksi' => $_POST['kode_transaksi'],
					'id_tind_detpem' => $_POST['id_tind_detpem'],
					'id_ins_tind_detpem' => $_POST['id_ins_tind_detpem'],
					'kd_grouptind' => $_POST['kd_grouptind'],
					'id_pem_deb' => 0,
					'id_paket' => $_POST['id_paket'],
					'hasilnya' => $gts,
					'adakelainan' => $jllssd,
					'ketkelainanlainnya' => "",
					'apakah_riwayat' => $apakahriwayat,
					'apakah_pemeriksaan_khusus' => "Y",
					'nama_pemeriksaan_khusus' => $hyd,
				);
				$this->db->select("id_reg_detpem");
				$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
				$this->db->where("nama_pemeriksaan_khusus", $hyd);
				$this->db->where("apakah_pemeriksaan_khusus", "Y");
				//$this->db->limit("1");
				$jshdc = $this->db->get("tb_register_detailpemeriksaan");
				$nhdsv = $jshdc->result();
				if($nhdsv){
					foreach($nhdsv as $svdvv){
						$this->db->where('id_reg_detpem', $svdvv->id_reg_detpem);
						$this->db->update('tb_register_detailpemeriksaan', $pemkhususnya);
					}
				}else {
					$this->db->insert('tb_register_detailpemeriksaan', $pemkhususnya);
				}
			}
		}
		if(is_array($_POST['pemeriksaangigi'])){
			foreach($_POST['pemeriksaangigi'] as $hyd => $gts){
				$nnhgd = "";
				$gts = clean_data($gts);
				if(!empty($gts)){
					$nnhgd = "Y";
				}
				$absjogja = array(
					'kode_transaksi' => $_POST['kode_transaksi'],
					'id_tind_detpem' => $_POST['id_tind_detpem'],
					'id_ins_tind_detpem' => $_POST['id_ins_tind_detpem'],
					'kd_grouptind' => $_POST['kd_grouptind'],
					'id_pem_deb' => 0,
					'id_paket' => $_POST['id_paket'],
					'hasilnya' => $gts,
					'adakelainan' => $nnhgd,
					'ketkelainanlainnya' => "",
					'apakah_struktur_gigi' => "Y",
					'posisi_struktur_gigi' => $hyd,
				);
				$this->db->select("id_reg_detpem");
				$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
				$this->db->where("posisi_struktur_gigi", $hyd);
				$this->db->where("apakah_struktur_gigi", "Y");
				//$this->db->limit("1");
				$jshdc = $this->db->get("tb_register_detailpemeriksaan");
				$nhdsv = $jshdc->result();
				if($nhdsv){
					foreach($nhdsv as $svdvv){
						$this->db->where('id_reg_detpem', $svdvv->id_reg_detpem);
						$this->db->update('tb_register_detailpemeriksaan', $absjogja);
					}
				}else {
					$this->db->insert('tb_register_detailpemeriksaan', $absjogja);
				}
			}
		}
		if(!is_array($_POST['set_nilai_normal'])){
			die('Pilih minimal 1 Pemeriksaan');
		}
		foreach($_POST['set_nilai_normal'] as $bd => $bl){
			//sing penting adalah set ada kelainan apa tidak
			$kesimpulan_det_pemeriksaan = "";
			if(isset($_POST['kesimpulan_det_pemeriksaan'])){
				$kesimpulan_det_pemeriksaan = $_POST['kesimpulan_det_pemeriksaan'];
			}
			$adakelainan = "";
			$ketkelainanlainnya = "";
			$hasilnya = $_POST['detpemeriksaan'][$bd];
			if(clean_data($bl) != ""){
				if($_POST['type_pemeriksaan'][$bd] == "tetap"){
					$hasilnya = $_POST['detpemeriksaan'][$bd];
					if(!empty($_POST['kelainandetpemeriksaan'][$bd])){
						$adakelainan = "Y";
						$ketkelainanlainnya = clean_data($_POST['kelainandetpemeriksaan'][$bd]);
						$hasilnya = "Lainnya";
						if($_POST['kelainandetpemeriksaan'][$bd] == "-"){
							$adakelainan = "";
						}
					}else {
						if($_POST['detpemeriksaan'][$bd] != $_POST['defaultnormal'][$bd]){
							$adakelainan = "Y";
							$hasilnya = $_POST['detpemeriksaan'][$bd];
						}
					}
				}
				if($_POST['type_pemeriksaan'][$bd] == "range"){
					if($_POST['detpemeriksaan'][$bd] < $_POST['range_pemeriksaan_awal'][$bd] OR $_POST['detpemeriksaan'][$bd] > $_POST['range_pemeriksaan_akhir'][$bd]){
						$adakelainan = "Y";
					}
				}
			}
			$datasimp = array(
				'kode_transaksi' => $_POST['kode_transaksi'],
				'id_tind_detpem' => $_POST['id_tind_detpem'],
				'id_ins_tind_detpem' => $_POST['id_ins_tind_detpem'],
				'kd_grouptind' => $_POST['kd_grouptind'],
				'id_pem_deb' => $bd,
				'id_paket' => $_POST['id_paket'],
				'hasilnya' => $hasilnya,
				'adakelainan' => $adakelainan,
				'ketkelainanlainnya' => $ketkelainanlainnya,
				'id_parent_chamber' => $parentchamber,
				'kesimpulan_det_pemeriksaan' => $kesimpulan_det_pemeriksaan,
			);
			
				$this->db->select("id_reg_detpem");
				$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
				$this->db->where("id_tind_detpem", $_POST['id_tind_detpem']);
				$this->db->where("id_pem_deb", $bd);
				//$this->db->limit("1");
				$jshdc = $this->db->get("tb_register_detailpemeriksaan");
				$nhdsv = $jshdc->result();
				if($nhdsv){
					foreach($nhdsv as $svdvv){
						$this->db->where('id_reg_detpem', $svdvv->id_reg_detpem);
						$this->db->update('tb_register_detailpemeriksaan', $datasimp);
					}
				}else {
					$this->db->insert('tb_register_detailpemeriksaan', $datasimp);
				}
			
			
			/*if(empty($_POST['id_reg_detpem'][$bd])){
				$this->db->insert('tb_register_detailpemeriksaan', $datasimp);
			}else {
				$this->db->where('id_reg_detpem', $_POST['id_reg_detpem'][$bd]);
				$this->db->update('tb_register_detailpemeriksaan', $datasimp);
			}*/
		}
		
			
			$stakestb = $_POST['stakes_tb'];
			$stakesimt = $_POST['stakes_imt'];
			$stakesanamnesa = $_POST['stakes_anamnesa'];
			$stakestensi = $_POST['stakes_tensi'];
			
			if(isset($_POST['stakes_tb']) OR $_POST['stakes_imt'] OR $_POST['stakes_anamnesa'] or $_POST['stakes_tensi']){
				$pipi[1] = $_POST['stakes_tb'];
				$pipi[2] = $_POST['stakes_imt'];
				$pipi[3] = $_POST['stakes_anamnesa'];
				$pipi[4] = $_POST['stakes_tensi'];
				$_POST['stakes'] = max($pipi);
			}
			$stakesutama = $_POST['stakes'];
			$sudahpemrik['kesimpulan_pemeriksaan'] = clean_data($_POST['kesimpulan_pemeriksaan']);
			$sudahpemrik['saran_pemeriksaan'] = clean_data($_POST['saran_pemeriksaan']);
			if(isset($_POST['stakes'])){
				$sudahpemrik['val_stakes'] = clean_data($stakesutama);
			}
			$sudahpemrik['stakes_tb'] = clean_data($stakestb);
			$sudahpemrik['stakes_imt'] = clean_data($stakesimt);
			$sudahpemrik['stakes_anamnesa'] = clean_data($stakesanamnesa);
			$sudahpemrik['stakes_tensi'] = clean_data($stakestensi);
			$sudahpemrik['sudah_pemeriksaan'] = 'Y';
			$this->db->where('kode_transaksi', $_POST['kode_transaksi']);
			$this->db->where('id_tind_pem', $_POST['id_tind_detpem']);
			$this->db->update('tb_register_pemeriksaan', $sudahpemrik);
			
			
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'INPUTPEMERIKSAAN',
			'sub_type'   	=> $_POST['kode_transaksi'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
					
		
		echo 'simpan';
		
		
		
	}
	public function simpanpemeriksaanrad(){
		//print_r($_POST);
		if(!is_array($_POST['id_tind_detpem'])){
			die("Pilih minimal 1 Pemeriksaan");
		}
		foreach($_POST['id_tind_detpem'] as $gs => $fs){
			foreach($_POST['detpemeriksaan'][$gs] as $key => $val){
				$adakelainan = "";
				if(!isset($_POST['statusnormal'][$gs][$key])){
					$adakelainan = "Y";
					$lopkel[] = 1;
				}
				$datasimp = array(
					'kode_transaksi' => $_POST['kode_transaksi'][$gs],
					'id_tind_detpem' => $gs,
					'id_ins_tind_detpem' => $_POST['id_ins_tind_detpem'][$gs],
					'kd_grouptind' => $_POST['kd_grouptind'][$gs],
					'id_pem_deb' => $key,
					'id_paket' => $_POST['id_paket'][$gs],
					'hasilnya' => $val,
					'adakelainan' => $adakelainan,
					'ketkelainanlainnya' => "",
				);
				if(empty($_POST['id_reg_detpem'][$gs][$key])){
					$this->db->insert('tb_register_detailpemeriksaan', $datasimp);
				}else {
					$this->db->where('id_reg_detpem', $_POST['id_reg_detpem'][$gs][$key]);
					$this->db->update('tb_register_detailpemeriksaan', $datasimp);
				}
			}
			//saatnya simpan kesannya yaaaa
			$kesanstatus = 'normal';
			if(is_array($lopkel)){
				$kesanstatus = 'abnormal';
			}
			$datakesan['kesanstatus'] = $kesanstatus;
			$datakesan['kesantext'] = $_POST['kesantext'][$gs];
			$this->db->where("kode_transaksi", $_POST['kode_transaksi'][$gs]);
			$this->db->where("id_tind_pem", $gs);
			$this->db->where("id_paket", $_POST['id_paket'][$gs]);
			$this->db->update("tb_register_pemeriksaan", $datakesan);
			
			//selanjutnya adalah simpan stakesnya yaaa
			$stakks['sudah_pemeriksaan'] = 'Y';
			$stakks['kesimpulan_pemeriksaan'] = clean_data($_POST['kesimpulan_pemeriksaan']);
			$stakks['saran_pemeriksaan'] = clean_data($_POST['saran_pemeriksaan']);
			$stakks['val_stakes'] = clean_data($_POST['stakes']);
			$this->db->where('kode_transaksi', $_POST['kode_transaksi'][$gs]);
			$this->db->where('id_ins_tind_pem',$_POST['id_ins_tind_detpem'][$gs]);
			$this->db->update('tb_register_pemeriksaan', $stakks);
			
			$kodetransaksiiiihist = $_POST['kode_transaksi'][$gs];
		}
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'INPUTRAD',
			'sub_type'   	=> $kodetransaksiiiihist,
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		echo 'simpan';
	}
	public function simpanpemeriksaanlab(){
		
		if(is_array($_POST['id_transkeu'])){
			foreach($_POST['id_transkeu'] as $mm){
				//selanjutnya cek apakah ada nilai yang diisi
				foreach($_POST['nilai'][$mm] as $key => $val){
					//jadi disini tampilkan yang  nilainya tidak kosong atau yang diset header
					if($val != "" OR $_POST['setheader'][$mm][$key] == 'Y'){
						//print_r($val);
						//die();
						if($_POST['setheader'][$mm][$key] == "N"){
							$hitungjuga[] = 1;
						}
						//saatnya kita simpan data ya
						$pem = $this->madmin->get_value('id_pem', $key, 'tb_pemeriksaan');
						$bntang = 'N';
						
						//mari kita cek apakah nantinya dapat bintang atau tidak
						if($_POST['type_tampil'][$mm][$key] == 'perumur_jenkel'){
							//nah ini yang paling ribet
							$umur = get_umur($_POST['tgllahir']);
							
							$gtm = explode(", ", $umur);
							$amm = explode(" ", $gtm[0]);
							if($amm[1] == 'TH'){
								$thun = $amm[0];
							} else if($amm[1] == 'BL'){
								$bln = $amm[0];
							} else if($amm[1] == 'HR'){
								$hari = $amm[0];
							}
							
							//print_r($amm);
							//yang pertama adalah jika ketemunya hari atau bulan
							//kita mulai filter DARI YANG PALING KECIL
							if($hari == true){
								
								//jika hari maka pilihannya hanya antara bayi baru lahir
								if($hari <= 2){
									//berarti bayi baru lahir 1-2 hari
									$low1 = 'low_bayi1-2';
									$hight1 = 'hight_bayi1-2';
									if($val < $pem[0]->$low1 OR $val > $pem[0]->$hight1){
										$bntang = 'Y';
									}
								} else if($hari <= 5){
									//berarti bayi baru lahir 1-2 hari
									$low1 = 'low_bayi3-5';
									$hight1 = 'hight_bayi3-5';
									if($val < $pem[0]->$low1 OR $val > $pem[0]->$hight1){
										$bntang = 'Y';
									}
								} else {
									if($val < $pem[0]->low_bayi OR $val > $pem[0]->hight_bayi){
										$bntang = 'Y';
									}
								}
							} else if($bln == true){
								if($val < $pem[0]->low_bayi OR $val > $pem[0]->hight_bayi){
									$bntang = 'Y';
								}
							} else {
							//	print_r($thun);
							//	die();
								if($thun <= $this->madmin->Get_setting('rsau_lab_umur_bayi')){
									if($val < $pem[0]->low_bayi OR $val > $pem[0]->hight_bayi){
										$bntang = 'Y';
									}
								} else if($thun <= $this->madmin->Get_setting('rsau_lab_umur_anak')){
									if($val < $pem[0]->low_anak OR $val > $pem[0]->hight_anak){
										$bntang = 'Y';
									}
								} else {
									if($_POST['jenkel'] == 'P'){
										if($val < $pem[0]->low_perempuan OR $val > $pem[0]->hight_perempuan){
											$bntang = 'Y';
										}
									} else {
										//echo $val ." -- ". $pem[0]->low_laki . " -- ". $pem[0]->hight_laki;
										if($val < $pem[0]->low_laki OR $val > $pem[0]->hight_laki){
											
											$bntang = 'Y';
										}
									}
								}
							}
							
						}
						
						//die();
						if($_POST['type_tampil'][$mm][$key] == 'umum' OR $_POST['type_tampil'][$mm][$key] == ''){
							if($pem[0]->low == '0' AND $pem[0]->hight == '0'){
								if(strtolower($val) != strtolower($pem[0]->nilai_rujukan)){
									$bntang = 'Y';
									//jika sama dengan bahasa inggris jangan dibuat bintang
									$nilairujukaninggris = $this->madmin->rsau_postifif_negatif_en(ucwords($pem[0]->nilai_rujukan));
									if(!empty($nilairujukaninggris)){
										if(strtolower($nilairujukaninggris) == strtolower($val)){
											$bntang = '';
										}
									}
								}
							} else {
								if($val < $pem[0]->low OR $val > $pem[0]->hight){
									$bntang = 'Y';
								}
							}
						}
						if($_POST['type_tampil'][$mm][$key] == 'positif_negatif'){
							if($val != $pem[0]->positif_negatif){
								$bntang = 'Y';
							}
						}
						
						if($_POST['type_tampil'][$mm][$key] == 'range_angka'){
							$pecahdata = explode("-", $val);
							$nilaibawah = trim(trim($pecahdata[0]));
							$nilaiatas = trim(trim($pecahdata[1]));
							if(($nilaibawah < $pem[0]->low OR $nilaibawah > $pem[0]->hight) OR ($nilaiatas < $pem[0]->low OR $nilaiatas > $pem[0]->hight)){
								$bntang = 'Y';
							}
							//print_r($pem);
							//print_r($pecahdata);
							//die();
							
						}
						
						$kontrolnya = "";
						if($_POST['kontrol_normal'][$mm][$key]){
							$kontrolnya = $_POST['kontrol_normal'][$mm][$key];
						}
						
						$amms = array(
							'kode_transaksi' => $_POST['no_lab'],
							'id_tind_detpem' => $_POST['id_tind'][$mm],
							'id_ins_tind_detpem' => '2',
							'kd_grouptind' => $_POST['kdgroup'][$mm],
							'id_pem_deb' => $key,
							'id_paket' => $_POST['id_paket'],
							'hasilnya' => $val,
							'adakelainan' => $bntang,
							'ketkelainanlainnya' => "",
							'setheaderhasil' => $_POST['setheader'][$mm][$key],
							'kontrol_hasil_pem' => $kontrolnya,
						);
						
						///penambahan cekricekk terakhir sebelum simpan--------------------
						$this->db->select("id_reg_detpem");
						$this->db->where("kode_transaksi", $_POST['no_lab']);
						$this->db->where("id_tind_detpem", $_POST['id_tind'][$mm]);
						$this->db->where("id_paket", $_POST['id_paket']);
						$this->db->where("id_pem_deb", $key);
						$cekdatalabs = $this->db->get("tb_register_detailpemeriksaan");
						$getdatalabs = $cekdatalabs->row();
						if($getdatalabs){
							$this->db->where('id_reg_detpem', $getdatalabs->id_reg_detpem);
							$asnna  = $this->db->update('tb_register_detailpemeriksaan', $amms);
						}else{
							$asnna  = $this->db->insert('tb_register_detailpemeriksaan', $amms);
						}
						///-----end cek ricek data----------------------------------------
						
						
						/*
						if($_POST['id_hasil'][$mm][$key] != ""){
							$this->db->where('id_reg_detpem', $_POST['id_hasil'][$mm][$key]);
							$asnna  = $this->db->update('tb_register_detailpemeriksaan', $amms);
						} else {
							$asnna  = $this->db->insert('tb_register_detailpemeriksaan', $amms);
						}*/
						
						
					}
				}
			}
		}
		//selanjutnya adalah simpan stakesnya yaaa
			$stakks['sudah_pemeriksaan'] = 'Y';
			$stakks['kesimpulan_pemeriksaan'] = clean_data($_POST['kesimpulan_pemeriksaan']);
			$stakks['saran_pemeriksaan'] = clean_data($_POST['saran_pemeriksaan']);
			$stakks['val_stakes'] = clean_data($_POST['stakes']);
			$this->db->where('kode_transaksi', $_POST['no_lab']);
			$this->db->where('id_ins_tind_pem', '2');
			$this->db->update('tb_register_pemeriksaan', $stakks);
			
		//saatnya cek  untuk no lab
		$this->db->where("kode_transaksi", $_POST['no_lab']);
		$sffdd = $this->db->get("tb_register");
		$fssss = $sffdd->row();
		if($fssss->no_lab_mcu < 1){
			//jika kosong apdet
			$gdggs = "select max(no_lab_mcu) as nolb from tb_register where DATE_FORMAT(tgl_awal_reg, '%Y%m')='".date("Ym", strtotime($fssss->tgl_awal_reg))."' ";
			$gsfdd = $this->db->query($gdggs);
			$erwdd = $gsfdd->row();
			$nexttkl = $erwdd->nolb+1;
			$sdfdf['no_lab_mcu'] = $nexttkl;
		}
		if(is_array($_POST['darahtepi'])){
			$sdfdf['hasil_darah_tepi'] = serialize($_POST['darahtepi']);
			
		}else{
			$sdfdf['hasil_darah_tepi'] = "";
		}
		$this->db->where('id_reg', $fssss->id_reg);
		$this->db->update('tb_register', $sdfdf);
		
		
	
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'INPUTLAB',
			'sub_type'   	=> $_POST['no_lab'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		echo 'simpan';
	}
	public function simpandetailevaluasipasien(){
		//print_r($_POST);
		$this->db->where('ket_resume', 'info_pasien');
		$this->db->where('no_resume', $_POST['no_resume']);
		$this->db->limit('1');
		$ggdt = $this->db->get('tb_resume_pasien');
		$baba = $ggdt->result();
		if(empty($_POST['resume_dokter'])){
			die('Dokter harus diisi');
		}
		if(empty($_POST['no_resume'])){
			die('Nomor Resume harus diisi');
		}
		if($_POST){
			$dataInsert = array (
				'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
				'no_resume' => clean_data($_POST['no_resume']),
				'tgl_resume' => date("Y-m-d H:i:s",strtotime($_POST['tgl_resume'])),
				'id_dokter' => clean_data($_POST['resume_dokter']),
				'ket_resume' => 'info_pasien',
			);
			if(empty($_POST['id_res'])){
				if($baba){
					die('No Resume sudah terdaftar');
				}
				$this->db->insert('tb_resume_pasien', $dataInsert);
			} else {
				$this->db->where('id_res', $_POST['id_res']);
				$this->db->update('tb_resume_pasien', $dataInsert);
			}
			//print_r($_POST);
			echo 'simpan';
		}
	}
	public function simpanupdatedatapembayaran(){
		//print_r($_POST);
		//mari kia mulai simpan
		//buat pengalihan 
		$pengalihan = clean_data($_POST['pengalihan']);
		$totbiaya = clean_data($_POST['total_biaya']);
		if($pengalihan > $totbiaya){
			$pengalihan = $totbiaya;
		}
		$dibayar = $totbiaya-$pengalihan;
		$datsimpan = array(
			'kode_transaksi' => $_POST['kode_transaksi'],
			'total_biaya' => $totbiaya,
			'pengalihan' => $pengalihan,
			'dibayar' => $dibayar,
			'id_kasir' => $this->session->userdata('id_user'),
		);
			if(empty($_POST['id_bayar'])){
				$datsimpan['tgl_bayar'] = date("Y-m-d H:i:s");
				$this->db->insert('tb_pembayaran', $datsimpan);
			} else {
				$this->db->where('id_bayar', $_POST['id_bayar']);
				$this->db->update('tb_pembayaran', $datsimpan);
			}
			//mari kita update registernya bahwa sudah bayar
			$dtn['dibayar_kasir'] = "Y";
			$this->db->where("kode_transaksi", $_POST['kode_transaksi']);
			$this->db->update('tb_register', $dtn);
			echo 'simpan';	
	}
	public function batalkantransaksipembayaran(){
		$this->db->where('id_bayar', $_POST['id_bayar_batal']);
		$this->db->delete('tb_pembayaran');
			$dtn['dibayar_kasir'] = "Y";
			$this->db->where("kode_transaksi", $_POST['kode_transaksi_batal']);
			$this->db->update('tb_register', $dtn);
		echo 'simpan';	
		
	}
	public function simpandetailanamnesapasien(){
		if($_POST){
			$dataInsert = array (
				'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
				'ket_resume' => 'anamnesa',
				'isi_anamnesa' => $_POST['anamnesanyaya'],
			);
			if(empty($_POST['id_res'])){
				$this->db->insert('tb_resume_pasien', $dataInsert);
			} else {
				$this->db->where('id_res', $_POST['id_res']);
				$this->db->update('tb_resume_pasien', $dataInsert);
			}
			//print_r($_POST);
			
			//historyy------------------------------------------------
			$myip 		= getRealIpAddr();
			$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
			$mymac 	= getRealMAcname($myip);
			$dtIns = array (
				'att_his'    	=> serialize($_POST),
				'tanggal' 	 	=> date("Y-m-d H:i:s"),
				'id_user' 	 	=> $this->session->userdata('id_user'),
				'type'   	 	=> 'EVALANAMNESA',
				'sub_type'   	=> $_POST['kode_transaksi_resume'],
				'ip_data'    	=> $myip,
				'mac_name'  	=> $mymac,
				'browser_name'   => $mybrowser,
				'modul_pas'   => $this->session->userdata('nm_ins'),
			);
			$slc = $this->db->insert('tb_history', $dtIns);
			echo 'simpan';
		}
	}
	public function simpanpemeriksaantambahan(){
		if($_POST){
			foreach($_POST['pemeriksaan'] as $ke => $sb){
				$dataInsert = array (
					'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
					'nama_kelainan' => $ke,
					'isi_kelainan' => $sb,
					'ket_resume' => 'periksatambahan',
				);
				if(empty($_POST['id_res'][$ke])){
					$this->db->insert('tb_resume_pasien', $dataInsert);
				} else {
					$this->db->where('id_res', $_POST['id_res'][$ke]);
					$this->db->update('tb_resume_pasien', $dataInsert);
				}
				//print_r($_POST);
			}
			
			//historyy------------------------------------------------
			$myip 		= getRealIpAddr();
			$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
			$mymac 	= getRealMAcname($myip);
			$dtIns = array (
				'att_his'    	=> serialize($_POST),
				'tanggal' 	 	=> date("Y-m-d H:i:s"),
				'id_user' 	 	=> $this->session->userdata('id_user'),
				'type'   	 	=> 'EVALPEMERIKSAANTAMBAHAN',
				'sub_type'   	=> $_POST['kode_transaksi_resume'],
				'ip_data'    	=> $myip,
				'mac_name'  	=> $mymac,
				'browser_name'   => $mybrowser,
				'modul_pas'   => $this->session->userdata('nm_ins'),
			);
			$slc = $this->db->insert('tb_history', $dtIns);
			echo 'simpan';
		}
	}
	public function updatekesantindakan(){
		$dataInsert['kesan_normal'] = $_POST['val'];
		$this->db->where('id_tind', $_POST['id']);
		$this->db->update('tb_tindakan', $dataInsert);
	}
	public function simpandetaildiagnosakelainan(){
		if(!is_array($_POST['kelainan_key'])){
			//die('Pilih minimal 1 Diagnosa/Kelainan');
		}
		//karena tidak terhubung dengan manapun maka pertama delete semua kemudian baru simpan ulang
		/*$this->db->where('kode_transaksi', $_POST['kode_transaksi_resume']);
		$this->db->where('ket_resume', 'diagnosakelainan');
		$this->db->delete('tb_resume_pasien');
		*/
		foreach($_POST['urut_kelainan'] as $sg => $av){
			
			$isikelainanoksave = $_POST['isi_kelainan'][$sg];
			if($_GET['sinkronulang'] == "Y"){
				$isikelainanoksave = $_POST['diagnosa_kelainan_realtime'][$sg];
			}
			$aktifdiagnosakelainan = "N";
			if(isset($_POST['kelainan_key'][$sg])){
				$aktifdiagnosakelainan = "Y";
			}
			
			$this->db->select('id_res');
			$this->db->where('ket_resume', 'diagnosakelainan');
			$this->db->where('kelainan_key', $sg);
			$this->db->where('kode_transaksi', clean_data($_POST['kode_transaksi_resume']));
			$sssa = $this->db->get('tb_resume_pasien');
			$respas = $sssa->row();
		
			if($respas){
				$dataapdet = array (
					'urut_kelainan' => $_POST['urut_kelainan'][$sg],
					'huruf_stakes' => $_POST['huruf_stakes'][$sg],
					'nama_kelainan' => $_POST['nama_kelainan'][$sg],
					'isi_kelainan' => $isikelainanoksave,
					'kesimpulan_kelainan' => $_POST['isi_kesimpulan'][$sg],
					'saran_kelainan' => $_POST['isi_saran'][$sg],
					'stakes_kelainan' => $_POST['stakes_kelainan'][$sg],
					'kelainan_key' => $sg,
					'aktif_diagnosakelainan' => $aktifdiagnosakelainan,
					'tlgupdate' => date('Y-m-d H:i:s'),
					'id_user' => $this->session->userdata('id_user'),
					'darimenu' => 'resume',
				);
				$this->db->where("id_res", $respas->id_res);
				$this->db->update('tb_resume_pasien', $dataapdet);
			}else{
				$dataInsert = array (
					'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
					'ket_resume' => 'diagnosakelainan',
					'urut_kelainan' => $_POST['urut_kelainan'][$sg],
					'huruf_stakes' => $_POST['huruf_stakes'][$sg],
					'nama_kelainan' => $_POST['nama_kelainan'][$sg],
					'isi_kelainan' => $isikelainanoksave,
					'kesimpulan_kelainan' => $_POST['isi_kesimpulan'][$sg],
					'saran_kelainan' => $_POST['isi_saran'][$sg],
					'stakes_kelainan' => $_POST['stakes_kelainan'][$sg],
					'kelainan_key' => $sg,
					'aktif_diagnosakelainan' => $aktifdiagnosakelainan,
					'tglsimpan' => date('Y-m-d H:i:s'),
					'id_user' => $this->session->userdata('id_user'),
					'darimenu' => 'resume',
				);
				$this->db->insert('tb_resume_pasien', $dataInsert);
			}
			
			
		}
		
		//historyy------------------------------------------------
			$myip 		= getRealIpAddr();
			$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
			$mymac 	= getRealMAcname($myip);
			$dtIns = array (
				'att_his'    	=> serialize($_POST),
				'tanggal' 	 	=> date("Y-m-d H:i:s"),
				'id_user' 	 	=> $this->session->userdata('id_user'),
				'type'   	 	=> 'EVALDIAGNOSAKELAINAN',
				'sub_type'   	=> $_POST['kode_transaksi_resume'],
				'ip_data'    	=> $myip,
				'mac_name'  	=> $mymac,
				'browser_name'   => $mybrowser,
				'modul_pas'   => $this->session->userdata('nm_ins'),
			);
			$slc = $this->db->insert('tb_history', $dtIns);
		echo 'simpan';
	}
	public function simpankesimpulandansaran(){
		//print_r($_POST);
		//die();
		foreach($_POST['isinya'] as $ke => $av){
			if($ke == "keterangan_sehat" OR $ke == "catatan_tambahan_dinas" OR $ke == "ketgrounded"){
				$isinya = $av;
				
				if($ke == "keterangan_sehat"){
					$statusgrounded['pas_grounded'] = "";
					//disini dicek apakah seting 
					$this->db->select('status_grounded');
					$this->db->where('id_kondisi', $av);
					$cekkond = $this->db->get('tb_kondisi');
					$getkond = $cekkond->row();
					if($getkond){
						if($getkond->status_grounded == "Ya"){
							//cek apakah paketnya grounded apa ga
							$this->db->select('auto_grounded');
							$this->db->where('id_paket', $_POST['id_paket_resume']);
							$hndbbs = $this->db->get('tb_paket');
							$sbdnsd = $hndbbs->row();
							if($sbdnsd){
								if($sbdnsd->auto_grounded == "Y"){
									$statusgrounded['pas_grounded'] = "Y";
								}
							}
							
						}
					}
				//saatnya apdetttt
					$this->db->where('kode_transaksi', $_POST['kode_transaksi_resume']);
					$this->db->update('tb_register', $statusgrounded);
				}
			}else {
				$isinya = serialize($av);
			}
			$dataInsert = array (
				'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
				'ket_resume' => 'kesimpulansaran',
				'nama_kesansaran' => $ke,
				'isi_kesansaran' => $isinya,
			);
				if(empty($_POST['idnya'][$ke])){
					$this->db->insert('tb_resume_pasien', $dataInsert);
				} else {
					$this->db->where('id_res', $_POST['idnya'][$ke]);
					$this->db->update('tb_resume_pasien', $dataInsert);
				}
			//$this->db->insert('tb_resume_pasien', $dataInsert);
		}
		foreach($_POST['getstakes'] as $ke => $av){
			$dataUpt = array (
				'kode_transaksi' => clean_data($_POST['kode_transaksi_resume']),
				'ket_resume' => 'kesimpulansaran',
				'nama_kesansaran' => $ke,
				'isi_kesansaran' => $av,
				'apakah_stakessaran' => 'Y',
			);
			//update juga stakes yang ada dikelainan
			/*$snh['stakes_kelainan'] = $av;
			$this->db->where("ket_resume", "diagnosakelainan");
			$this->db->where("kode_transaksi", $_POST['kode_transaksi_resume']);
			$this->db->where("huruf_stakes", $ke);
			$this->db->update('tb_resume_pasien', $snh);
			*/
			
				if(empty($_POST['idstakes'][$ke])){
					$this->db->insert('tb_resume_pasien', $dataUpt);
				} else {
					$this->db->where('id_res', $_POST['idstakes'][$ke]);
					$this->db->update('tb_resume_pasien', $dataUpt);
				}
			//$this->db->insert('tb_resume_pasien', $dataInsert);
		}
		
		
		//saatnya update def ttf
		if(!empty($_POST['ttdkatim'])){
			$defdoks['def_ttd'] = $_POST['ttdkatim'];
			$this->db->where('kode_transaksi', $_POST['kode_transaksi_resume']);
			$this->db->update('tb_register', $defdoks);
		}
		
		
		//historyy------------------------------------------------
			$myip 		= getRealIpAddr();
			$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
			$mymac 	= getRealMAcname($myip);
			$dtIns = array (
				'att_his'    	=> serialize($_POST),
				'tanggal' 	 	=> date("Y-m-d H:i:s"),
				'id_user' 	 	=> $this->session->userdata('id_user'),
				'type'   	 	=> 'EVALKESIMPULANDARAN',
				'sub_type'   	=> $_POST['kode_transaksi_resume'],
				'ip_data'    	=> $myip,
				'mac_name'  	=> $mymac,
				'browser_name'   => $mybrowser,
				'modul_pas'   => $this->session->userdata('nm_ins'),
			);
			$slc = $this->db->insert('tb_history', $dtIns);
			
			
		echo 'simpan';
	}
	public function simpanrincianpaketdetailmcusamakan(){
		//print_r($_POST['idpaketsama']);die();
		if($_POST['idpaket'] == ""){
			die("Pilih Paket Terlebih dahulu");
		}
		$this->db->where('id_paket', $_POST['idpaketsama']);
		$ggdt = $this->db->get('tb_paket_meta');
		$baba = $ggdt->result();
		foreach($baba as $val){
			$fffa = array(
				'id_paket' => $_POST['idpaket'],
				'id_tind' => $val->id_tind,
			);
			$this->db->insert('tb_paket_meta', $fffa);
		}
		echo 'simpan';
	}
	
	public function simpankelainangigiok(){
		
		$absjogja = array(
			'kode_transaksi' => $_POST['kdtrans'],
			'id_tind_detpem' => $_POST['idtind'],
			'id_ins_tind_detpem' => $_POST['idins'],
			'kd_grouptind' => $_POST['idgroup'],
			'id_pem_deb' => 0,
			'id_paket' => $_POST['idpaket'],
			'hasilnya' => $_POST['kelainan'],
			'adakelainan' => 'Y',
			'ketkelainanlainnya' => "",
			'apakah_struktur_gigi' => "Y",
			'posisi_struktur_gigi' => $_POST['posisi'],
			'id_pem_sinkron_odonto' => $_POST['idpem'],
			'warna_kelainan_gigi' => $_POST['warna'],
		);
		
				$this->db->select("id_reg_detpem");
				$this->db->where("kode_transaksi", $_POST['kdtrans']);
				$this->db->where("posisi_struktur_gigi", $_POST['posisi']);
				$this->db->where("apakah_struktur_gigi", "Y");
				$this->db->limit("1");
				$jshdc = $this->db->get("tb_register_detailpemeriksaan");
				$nhdsv = $jshdc->row();
				if($nhdsv){
					$this->db->where('id_reg_detpem', $nhdsv->id_reg_detpem);
					$this->db->update('tb_register_detailpemeriksaan', $absjogja);
				}else {
					$this->db->insert('tb_register_detailpemeriksaan', $absjogja);
				}
				
	}
	public function hapuspilihodonto(){
		$this->db->where('id_reg_detpem', $_POST['id']);
		$this->db->delete('tb_register_detailpemeriksaan');
	}
	public function hapusdatakelainangigi(){
		$this->db->where('id_kln', $_POST['id']);
		$this->db->delete('tb_kelainan_gigi');
	}
	
	public function rubahuntuksetkelainan(){
		$gdhdf['id_pemeriksaan']  = $_POST['isi'];
		$this->db->where('id_kln', $_POST['id']);
		$this->db->update('tb_kelainan_gigi', $gdhdf);
	}
	public function rubahstatusbahasa(){
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->limit("1");
		$jshdc = $this->db->get("tb_paket");
		$nhdsv = $jshdc->row();
		$gsvdvns = "Y";
		if($nhdsv->en_hasil == "Y"){
			$gsvdvns = "";
		}
		
		$gdhdf['en_hasil']  = $gsvdvns;
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->update('tb_paket', $gdhdf);
	}
	
	public function rubahstatuscasistni(){
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->limit("1");
		$jshdc = $this->db->get("tb_paket");
		$nhdsv = $jshdc->row();
		$gsvdvns = "Y";
		if($nhdsv->casis_tni == "Y"){
			$gsvdvns = "";
		}
		
		$gdhdf['casis_tni']  = $gsvdvns;
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->update('tb_paket', $gdhdf);
	}
	public function rubahstatusautodinas(){
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->limit("1");
		$jshdc = $this->db->get("tb_paket");
		$nhdsv = $jshdc->row();
		$gsvdvns = "Y";
		if($nhdsv->auto_dinas == "Y"){
			$gsvdvns = "";
		}
		
		$gdhdf['auto_dinas']  = $gsvdvns;
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->update('tb_paket', $gdhdf);
	}
	public function rubahstatautopaketpas(){
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->limit("1");
		$jshdc = $this->db->get("tb_paket");
		$nhdsv = $jshdc->row();
		$gsvdvns = "Y";
		if($nhdsv->tampil_online == "Y"){
			$gsvdvns = "";
		}
		
		$gdhdf['tampil_online']  = $gsvdvns;
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->update('tb_paket', $gdhdf);
	}
	public function rubahstatusautogrounded(){
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->limit("1");
		$jshdc = $this->db->get("tb_paket");
		$nhdsv = $jshdc->row();
		$gsvdvns = "Y";
		if($nhdsv->auto_grounded == "Y"){
			$gsvdvns = "";
		}
		
		$gdhdf['auto_grounded']  = $gsvdvns;
		$this->db->where("id_paket", $_POST['idp']);
		$this->db->update('tb_paket', $gdhdf);
	}
	public function rubahhasilkesimpulanlab(){
		//print_r($_POST);
		$this->db->select('id_res');
		$this->db->where('ket_resume', 'diagnosakelainan');
		$this->db->where('nama_kelainan', 'Laboratorium');
		$this->db->where('kode_transaksi', $_POST['kd']);
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->row();
		if($respas){
			$dghdsghd = array(
				'isi_kelainan' => $_POST['kets'],
				'kesimpulan_kelainan' => $_POST['isi'],
				'tlgupdate' => date('Y-m-d H:i:s'),
				'id_user' => $this->session->userdata('id_user'),
				'kesimpulan_kelainan' => $_POST['isi'],
				'darimenu' => 'hasilmcu',
			);
			$this->db->where("id_res", $respas->id_res);
			$this->db->update('tb_resume_pasien', $dghdsghd);
		}else{
			$dghdsghd = array(
				'kode_transaksi' => $_POST['kd'],
				'tgl_resume' => date('Y-m-d H:i:s'),
				'ket_resume' => 'diagnosakelainan',
				'urut_kelainan' => '11',
				'huruf_stakes' => 'U',
				'nama_kelainan' => 'Laboratorium',
				'isi_kelainan' => $_POST['kets'],
				'kesimpulan_kelainan' => $_POST['isi'],
				'tglsimpan' => date('Y-m-d H:i:s'),
				'tlgupdate' => date('Y-m-d H:i:s'),
				'id_user' => $this->session->userdata('id_user'),
				'kelainan_key' => '11U',
				'darimenu' => 'hasilmcu',
			);
			$this->db->insert('tb_resume_pasien', $dghdsghd);
		}
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'RUBAHKESIMPULANLAB',
			'sub_type'   	=> $_POST['kd'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		echo "simpan";
	}
	
	public function simpanpemeriksaancampuran(){

		if(!is_array($_POST['set_nilai_normal'])){
			die('Pilih minimal 1 Pemeriksaan');
		}
		foreach($_POST['set_nilai_normal'] as $gsgg => $sdfgd){
			foreach($sdfgd as $bd => $bl){
			$adakelainan = "";
			$ketkelainanlainnya = "";
			$hasilnya = $_POST['detpemeriksaan'][$gsgg][$bd];
			if(clean_data($bl) != ""){
				if($_POST['type_pemeriksaan'][$gsgg][$bd] == "tetap"){
					$hasilnya = $_POST['detpemeriksaan'][$gsgg][$bd];
					if(!empty($_POST['kelainandetpemeriksaan'][$gsgg][$bd])){
						$adakelainan = "Y";
						$ketkelainanlainnya = clean_data($_POST['kelainandetpemeriksaan'][$gsgg][$bd]);
						$hasilnya = "Lainnya";
						if($_POST['kelainandetpemeriksaan'][$gsgg][$bd] == "-"){
							$adakelainan = "";
						}
					}else {
						if($_POST['detpemeriksaan'][$gsgg][$bd] != $_POST['defaultnormal'][$gsgg][$bd]){
							$adakelainan = "Y";
							$hasilnya = $_POST['detpemeriksaan'][$gsgg][$bd];
						}
					}
				}
				if($_POST['type_pemeriksaan'][$gsgg][$bd] == "range"){
					if($_POST['detpemeriksaan'][$gsgg][$bd] < $_POST['range_pemeriksaan_awal'][$gsgg][$bd] OR $_POST['detpemeriksaan'][$gsgg][$bd] > $_POST['range_pemeriksaan_akhir'][$gsgg][$bd]){
						$adakelainan = "Y";
					}
				}
			}
			$datasimp = array(
				'kode_transaksi' => $_POST['kode_transaksi'][$gsgg],
				'id_tind_detpem' => $_POST['id_tind_detpem'][$gsgg],
				'id_ins_tind_detpem' => $_POST['id_ins_tind_detpem'][$gsgg],
				'kd_grouptind' => $_POST['kd_grouptind'][$gsgg],
				'id_pem_deb' => $bd,
				'id_paket' => $_POST['id_paket'][$gsgg],
				'hasilnya' => $hasilnya,
				'adakelainan' => $adakelainan,
				'ketkelainanlainnya' => $ketkelainanlainnya,
			);
				$this->db->select("id_reg_detpem");
				$this->db->where("kode_transaksi", $_POST['kode_transaksi'][$gsgg]);
				$this->db->where("id_tind_detpem", $_POST['id_tind_detpem'][$gsgg]);
				$this->db->where("id_pem_deb", $bd);
				//$this->db->limit("1");
				$jshdc = $this->db->get("tb_register_detailpemeriksaan");
				$nhdsv = $jshdc->result();
				if($nhdsv){
					foreach($nhdsv as $svdvv){
						$this->db->where('id_reg_detpem', $svdvv->id_reg_detpem);
						$this->db->update('tb_register_detailpemeriksaan', $datasimp);
					}
				}else {
					$this->db->insert('tb_register_detailpemeriksaan', $datasimp);
				}
				
			/*if(empty($_POST['id_reg_detpem'][$gsgg][$bd])){
				$this->db->insert('tb_register_detailpemeriksaan', $datasimp);
			}else {
				$this->db->where('id_reg_detpem', $_POST['id_reg_detpem'][$gsgg][$bd]);
				$this->db->update('tb_register_detailpemeriksaan', $datasimp);
			}*/  
		}
		
		
		$stakesutama = $_POST['stakes'][$gsgg];
			$sudahpemrik['kesimpulan_pemeriksaan'] = clean_data($_POST['kesimpulan_pemeriksaan'][$gsgg]);
			$sudahpemrik['saran_pemeriksaan'] = clean_data($_POST['saran_pemeriksaan'][$gsgg]);
			$sudahpemrik['val_stakes'] = clean_data($stakesutama);
			$sudahpemrik['sudah_pemeriksaan'] = 'Y';
			$this->db->where('kode_transaksi', $_POST['kode_transaksi'][$gsgg]);
			$this->db->where('id_tind_pem', $_POST['id_tind_detpem'][$gsgg]);
			$this->db->update('tb_register_pemeriksaan', $sudahpemrik);
	}

		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'INPUTPEMERIKSAAN',
			'sub_type'   	=> $_POST['kode_transaksi'][$gsgg],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
					
		
		echo 'simpan';
	}
	
	public function simpanupdatetampildatagrounded(){
		//print_r($_POST);
		if(!empty($_POST['tele_grounded'])){
			$sttgriund = 0;
		}
		if(!empty($_POST['tele_cabut'])){
			$sttgriund = 1;
		}
		if(!empty($_POST['tele_rilis'])){
			$sttgriund = 2;
		}
		$dghdsghd = array(
			'tele_grounded' => $_POST['tele_grounded'],
			'tele_cabut' => $_POST['tele_cabut'],
			'tele_rilis' => $_POST['tele_rilis'],
			'keterangan_grounded' => $_POST['keterangan_grounded'],
			'status_grounded' => $sttgriund,
		);
		$this->db->where("kode_transaksi",$_POST['kode_transaksi_grounded']);
		$this->db->update('tb_register', $dghdsghd);
		echo "simpan";
	}
	
	public function tambahkandiagnosapenyakit(){
		$smpdiagn['kode_transaksi'] = $_POST['kodetrs'];
		$smpdiagn['id_ins'] = $_POST['idins'];
		$smpdiagn['tgl_simpan'] = date("Y-m-d H:i:s");
		$smpdiagn['id_user'] = $this->session->userdata('id_user');
		$this->db->insert('tb_register_diagnosa', $smpdiagn);
		echo "simpan";
	}
	public function tambahkandiagnosapenyakitpertind(){
		//print_r($_POST);
		//die();
		$smpdiagn['kode_transaksi'] = $_POST['kodetrs'];
		$smpdiagn['id_ins'] = $_POST['idins'];
		$smpdiagn['id_tind_dg'] = $_POST['idtind'];
		$smpdiagn['tgl_simpan'] = date("Y-m-d H:i:s");
		$smpdiagn['id_user'] = $this->session->userdata('id_user');
		$this->db->insert('tb_register_diagnosa', $smpdiagn);
		echo "simpan";
	}
	
	public function hapuskandiagnosapenyakit(){
		$this->db->where('id_dgs', $_POST['ids']);
		$this->db->delete('tb_register_diagnosa');
		echo "simpan";
	}
	public function rubahkandiagnosapenyakit(){
		$smpdiagn['id_diag'] = $_POST['isi'];
		$this->db->where('id_dgs', $_POST['ids']);
		$this->db->update('tb_register_diagnosa', $smpdiagn);
		echo "simpan";
	}
	
	
	public function simpanupdaterevisiurutankiri(){
		//print_r($_POST);
		if($_POST['jenis_revisi'] == "D"){
			//PERTAMA PECAH Data
			$exp = explode("****", $_POST['urutbaru']);
			$urutangka = $exp[0];
			$urutlain = $exp[1];
			//cek dlu
			$yyy = $this->db->query("select id_reg from tb_register where no_filemcu like '%-".clean_data($_POST['nama_urut'])."/%' and konsul <> 'Y' and urut_file=".$urutangka." and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tgl_urut']))."' ");
			$ggt = $yyy->row();
			if($ggt){
				die("Nomor Urut sudah digunakan, silahkan refresh dan ulangi...");
			}
			//jika dinas yang dirubah ditabel pasien dan tabel register
			$updatereg['no_filemcu'] = $urutlain;
			$updatereg['urut_file'] = $urutangka;
			$updatereg['id_dinas_dua'] = $_POST['ppcomborevisidinas'];
			$this->db->where('id_reg', $_POST['id_reg']);
			$this->db->update('tb_register', $updatereg);
			
			//selanjutnya adalah update data pasien
			$updatepas['id_dinas'] = $_POST['ppcomborevisidinas'];
			$this->db->where('no_reg', $_POST['no_reg']);
			$this->db->update('tb_pasien', $updatepas);
			//print_r($updatereg);
		}
		
		
		if($_POST['jenis_revisi'] == "N"){
			//PERTAMA PECAH Data
			$exp = explode("****", $_POST['urutbaru']);
			$urutangka = $exp[0];
			$urutlain = $exp[1];
			//cek dlu
			$yyy = $this->db->query("select id_reg from tb_register where no_filemcu like '%-".clean_data($_POST['nama_urut'])."/%' and konsul <> 'Y' and urut_file=".$urutangka." and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tgl_urut']))."' ");
			$ggt = $yyy->row();
			if($ggt){
				die("Nomor Urut sudah digunakan, silahkan refresh dan ulangi...");
			}
			//jika dinas yang dirubah ditabel pasien dan tabel register
			$updatereg['no_filemcu'] = $urutlain;
			$updatereg['urut_file'] = $urutangka;
			$updatereg['cara_bayar'] = $_POST['nama_urut'];
			$updatereg['id_dinas_dua'] = $_POST['ppcomborevisinon'];
			$this->db->where('id_reg', $_POST['id_reg']);
			$this->db->update('tb_register', $updatereg);
			
			//selanjutnya adalah update data pasien
			$updatepas['id_dinas'] = $_POST['ppcomborevisinon'];
			$this->db->where('no_reg', $_POST['no_reg']);
			$this->db->update('tb_pasien', $updatepas);
			//print_r($updatereg);
		}
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'REVISIURUT',
			'sub_type'   	=> $_POST['kode_transaksi'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		
		echo "simpan";
	}
	
	
	public function simpanupdatepembayaranpasienduakiri(){
		//print_r($_POST);
		if(empty($_POST['pcbayar'])){
			die("Pembayaran wajib diisi...");
		}
		if($_POST['pctotal'] > $_POST['pcbayar']){
			die("Pembayaran tidak mencukupi...");
		}
		$gsbdv = array(
			'kode_transaksi' => $_POST['kode_transaksi'],
			'pcjumlah' => $_POST['pcjumlah'],
			'pcdiskon' => $_POST['pcdiskon'],
			'pcsubtotal' => $_POST['pcsubtotal'],
			'pctotal' => $_POST['pctotal'],
			'pcbayar' => $_POST['pcbayar'],
			'pckembali' => $_POST['pckembali'],
			'tglbayar' => date("Y-m-d H:i:s"),
			'idkasir' => $this->session->userdata('id_user'),
			'pmeta' => serialize($_POST['pdetail']),
		);
		$this->db->insert('tb_pembayaran', $gsbdv);
		$gsbbsb['sudah_bayar'] = "Y";
		$this->db->where('id_reg', $_POST['id_reg']);
		$this->db->update('tb_register', $gsbbsb);
		
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'SIMPANPEMBAYARAN',
			'sub_type'   	=> $_POST['kode_transaksi'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		
		
		echo "simpan";
	}
	
	public function batalbayarpasien(){
		$this->db->where('kode_transaksi', $_POST['id']);
		$this->db->delete('tb_pembayaran');
		
		$gsbbsb['sudah_bayar'] = "";
		$this->db->where('kode_transaksi', $_POST['id']);
		$this->db->update('tb_register', $gsbbsb);
		
		//historyy------------------------------------------------
		$myip 		= getRealIpAddr();
		$mybrowser 	= $_SERVER['HTTP_USER_AGENT'];
		$mymac 	= getRealMAcname($myip);
		$dtIns = array (
			'att_his'    	=> serialize($_POST),
			'tanggal' 	 	=> date("Y-m-d H:i:s"),
			'id_user' 	 	=> $this->session->userdata('id_user'),
			'type'   	 	=> 'BATALBAYAR',
			'sub_type'   	=> $_POST['id'],
			'ip_data'    	=> $myip,
			'mac_name'  	=> $mymac,
			'browser_name'   => $mybrowser,
			'modul_pas'   => $this->session->userdata('nm_ins'),
		);
		$slc = $this->db->insert('tb_history', $dtIns);
		
		
		echo "simpan";
	}
	
	
}