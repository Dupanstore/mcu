<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'c.no_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select DATE_FORMAT(b.tgl_awal_reg, '%d/%m/%Y') as newtgl, b.kode_transaksi, b.id_paket, d.id_tind, d.nm_tind, c.*, case when (select count(adakelainan) from tb_register_detailpemeriksaan where kode_transaksi=a.kode_transaksi and id_paket=a.id_paket and id_pem_deb IN (368,369,370, 373) and adakelainan='Y') > 0 THEN 'POSITIF/REAKTIF' else 'NEGATIF/NON REAKTIF' end as hasilnama from tb_register_pemeriksaan a, tb_register b, tb_pasien c, tb_tindakan d
					where a.kode_transaksi=b.kode_transaksi and b.no_reg=c.no_reg and a.id_tind_pem=d.id_tind and a.id_tind_pem IN (6658, 6667) ";
		$que 	.= " and b.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		if (@!empty($_GET['filter_keyword'])){
			$que 	.= " and (c.no_reg like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR  c.nm_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR c.alamat_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR nip_nrp_nik like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR c.no_tlp_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%')";
		}
		//print_r($que);
		$gsv = $this->db->query($que);
		$data['totals'] = $gsv->num_rows();
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ffds;
			print_r (json_encode($object));
?>