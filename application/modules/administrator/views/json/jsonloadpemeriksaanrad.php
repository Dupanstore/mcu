<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'orderdata';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$this->db->where('id_ins', 3);
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_grouptind', $rows, $offset);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ffds;
			print_r (json_encode($object));
?>