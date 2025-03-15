<?php
		$this->db->select('id_pas');
		$this->db->from('tb_pasien');
		//$this->db->where('id_ins_tind', $this->uri->segment(3));
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'no_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_pasien where 1=1 ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (no_reg like '%".strip_tags(trim($_POST['cari']))."%' OR  nm_pas like '%".strip_tags(trim($_POST['cari']))."%' OR alamat_pas like '%".strip_tags(trim($_POST['cari']))."%' OR nip_nrp_nik like '%".strip_tags(trim($_POST['cari']))."%' OR no_tlp_pas like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		//$que 	.= " and id_ins_tind='".$this->uri->segment(3)."' ";
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ffds;
			print_r (json_encode($object));
?>