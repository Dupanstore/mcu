<?php
		$this->db->select('id_menu');
		$this->db->from('tb_menu_evaluasi');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_menu';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_menu_evaluasi where 1=1 ";
		//if(stristr($this->uri->segment(3), 'D') === FALSE) {
		//	$que 	.= " and uri_menu != 'periksatambahan' ";
		//}
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		//$this->db->order_by($sort, $order);
		//$data['query'] = $this->db->get('tb_menu_evaluasi', $rows, $offset);
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>