<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_tind';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_tindakan, tb_grouptind where tb_tindakan.kd_grouptind=tb_grouptind.kd_grouptindakan ";
		$que 	.= " and tb_grouptind.id_grouptindakan='".$this->uri->segment(3)."' ";
		$que 	.= " order by ". $sort ." ". $order;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$object->rows = $ffds;
			print_r (json_encode($object));
?>