<?php
	//print_r($_GET);
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'c.no_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select DATE_FORMAT(b.tgl_awal_reg, '%d/%m/%Y') as newtgl, b.kode_transaksi, b.id_paket, case when status_grounded=0 then 'GROUNDED' when status_grounded=1 then 'CABUT' else 'RILIS' end as statusterbang, c.* from tb_register b, tb_pasien c
					where b.no_reg=c.no_reg and b.pas_grounded='Y' ";
		$que 	.= " and b.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		if(is_array($_GET['id_jawatan'])){
			$que 	.= " and c.id_jawatan IN (".implode(", ", $_GET['id_jawatan']).") ";
		}
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