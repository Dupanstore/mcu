<?php
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_ins';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$this->db->where("hidden <> 'Y'");
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_instalasi', $rows, $offset);
			$object = new stdClass();
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>