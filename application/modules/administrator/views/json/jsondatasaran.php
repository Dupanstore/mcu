<?php
	$this->db->select('id_saran');
		$this->db->from('tb_saran');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_saran';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('nm_saran', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_saran', $rows, $offset);
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>