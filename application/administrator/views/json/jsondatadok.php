<?php
		$this->db->select('id_dok');
		$this->db->from('tb_dokter');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_dok';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_dokter where 1=1 ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (nm_dok like '%".strip_tags(trim($_POST['cari']))."%' OR  kd_dok like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>