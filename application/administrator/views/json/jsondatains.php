<?php
	$this->db->select('id_ins');
		$this->db->from('tb_instalasi');
		//$this->db->where('type_ins', "P"); 
		$this->db->where('uri', "pelayanan");
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_ins';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('nm_ins', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->where('uri', "pelayanan");
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_instalasi', $rows, $offset);
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>