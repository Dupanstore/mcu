<?php
	$this->db->select('id_tind');
		$this->db->from('tb_tindakan');
		//$this->db->where('id_ins_tind', $this->uri->segment(3));
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kd_tind';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_tindakan, tb_grouptind where tb_tindakan.kd_grouptind=tb_grouptind.kd_grouptindakan ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (nm_tind like '%".strip_tags(trim($_POST['cari']))."%' OR  kd_tind like '%".strip_tags(trim($_POST['cari']))."%' OR  nm_grouptindakan like '%".strip_tags(trim($_POST['cari']))."%')";
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