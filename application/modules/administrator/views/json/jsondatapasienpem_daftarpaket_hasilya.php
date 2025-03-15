<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
			$fghb = "select   tb_paket.nm_paket,  tb_register.no_filemcu, tb_register.no_reg, tb_pasien.nip_nrp_nik, tb_pasien.nm_pas, tb_pasien.jenkel_pas, tb_jawatan.nm_jawatan,  tb_pasien.no_tlp_pas from  tb_register, tb_pasien,  tb_jawatan, tb_paket ";
			$fghb .= " where tb_register.no_reg=tb_pasien.no_reg and tb_pasien.id_jawatan=tb_jawatan.id_jawatan and tb_register.id_paket=tb_paket.id_paket ";
			//selanjutnya mari kita filter
			if(!empty($_POST['cari'])){
				$fghb 	.= " and (tb_register.no_reg like '%".strip_tags(trim($_POST['cari']))."%' OR  tb_pasien.nm_pas like '%".strip_tags(trim($_POST['cari']))."%' OR tb_pasien.alamat_pas like '%".strip_tags(trim($_POST['cari']))."%' OR tb_pasien.nip_nrp_nik like '%".strip_tags(trim($_POST['cari']))."%' OR tb_register.no_filemcu like '%".strip_tags(trim($_POST['cari']))."%')";
			}
			if(!empty($_GET['kunjungan_ke'])){
				$fghb .= " and  tb_register.kunjungan_ke='".$_GET['kunjungan_ke']."' ";
			}
			if($_GET['id_cabang'] != "1"){
				$fghb .= " and  tb_pasien.id_cabang='".$_GET['id_cabang']."' ";
			}
			if($_GET['id_unit'] != "1"){
				$fghb .= " and  tb_pasien.id_unit='".$_GET['id_unit']."' ";
			}
			if(!empty($_GET['id_paket'])){
				$fghb .= " and tb_register.id_paket='".$_GET['id_paket']."' ";
			}
			if(!empty($_GET['id_jenkel'])){
				$fghb .= " and jenkel_pas='".$_GET['id_jenkel']."' ";
			}
			if($_GET['nm_daftarpaket']){
				$fghb .= " and nm_paket='".$_GET['nm_daftarpaket']."' ";
			}
			
			$fghb .= " group by tb_register.kode_transaksi ";
			$ulaik = $this->db->query($fghb);
			$tottt = $ulaik->num_rows();
		$fghb 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($fghb);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $tottt;
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>