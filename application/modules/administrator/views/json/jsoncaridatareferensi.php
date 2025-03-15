<?php
		$this->db->select('id_reg');
		$this->db->from('tb_register');
		$this->db->where("konsul <> 'Y' ");
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select a.kode_transaksi, a.id_reg, a.no_filemcu, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y') as tgl_awal_reg_new, b.id_pas, b.no_reg, b.nip_nrp_nik, b.nm_pas, b.no_tlp_pas, b.alamat_pas, c.nm_paket from tb_register a, tb_pasien b, tb_paket c ";
		$que 	 .= "where a.no_reg=b.no_reg ";
		$que 	 .= "and a.id_paket=c.id_paket ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (a.no_filemcu like '%".strip_tags(trim($_POST['cari']))."%' OR b.no_reg like '%".strip_tags(trim($_POST['cari']))."%' OR  b.nm_pas like '%".strip_tags(trim($_POST['cari']))."%' OR b.alamat_pas like '%".strip_tags(trim($_POST['cari']))."%' OR b.nip_nrp_nik like '%".strip_tags(trim($_POST['cari']))."%' OR b.no_tlp_pas like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		$que 	.= " and konsul <> 'Y' ";
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ffds;
			print_r (json_encode($object));
?>