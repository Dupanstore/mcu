<?php
	$this->db->select('id_periksa');
		$this->db->from('tb_pemeriksaan');
		$this->db->where('id_ins_periksa', $this->uri->segment(3));
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'det_order_pemeriksaan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('det_nm_pemeriksaan', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->where('id_ins_periksa', $this->uri->segment(3));
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_pemeriksaan', $rows, $offset);
		$ffds = $data['query']->result();
		foreach($ffds as $fssd){
			$fssd->det_nilai_normal_new = $fssd->det_nilai_normal == "Y" ? "Ada" : "Tidak";
			$ding[] = $fssd;
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ding;
			print_r (json_encode($object));
?>