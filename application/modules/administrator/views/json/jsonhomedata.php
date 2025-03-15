<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas, b.alamat_pas from tb_register a, tb_pasien b where a.no_reg=b.no_reg ";
		
		$que 	.= " and DATE_FORMAT(a.tgl_awal_reg, '%Y%m')='".date('Ym')."' ";
		$gsv = $this->db->query($que);
		$data['totals'] = $gsv->num_rows();
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>