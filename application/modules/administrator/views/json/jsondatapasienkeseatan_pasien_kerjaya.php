<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
			$fghb = "select   nm_kondisi,  tb_register.no_filemcu, tb_register.no_reg, tb_pasien.nip_nrp_nik, tb_pasien.nm_pas, tb_pasien.jenkel_pas, tb_jawatan.nm_jawatan,  tb_pasien.no_tlp_pas from  tb_resume_pasien, tb_kondisi, tb_register, tb_pasien,  tb_jawatan ";
			$fghb .= " where tb_resume_pasien.isi_kesansaran=tb_kondisi.id_kondisi and tb_resume_pasien.kode_transaksi=tb_register.kode_transaksi and tb_register.no_reg=tb_pasien.no_reg and tb_pasien.id_jawatan=tb_jawatan.id_jawatan and nama_kesansaran='keterangan_sehat' ";
			//selanjutnya mari kita filter
			if(!empty($_POST['cari'])){
				$fghb 	.= " and (tb_register.no_reg like '%".strip_tags(trim($_POST['cari']))."%' OR  tb_pasien.nm_pas like '%".strip_tags(trim($_POST['cari']))."%' OR tb_pasien.alamat_pas like '%".strip_tags(trim($_POST['cari']))."%' OR tb_pasien.nip_nrp_nik like '%".strip_tags(trim($_POST['cari']))."%' OR tb_register.no_filemcu like '%".strip_tags(trim($_POST['cari']))."%')";
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
			if($_GET['nm_diag_kes']){
				$fghb .= " and  nm_kondisi='".$_GET['nm_diag_kes']."' ";
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