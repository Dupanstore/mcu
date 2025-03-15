<?php
	$this->db->select('id_ctd');
		$this->db->from('tb_catatan_dinas');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_ctd';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('nm_ctd', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_catatan_dinas', $rows, $offset);
		$gsvdv = $data['query']->result();
		//$nnnnnnn = new stdclass;
		foreach($gsvdv as $svdsw){
			$svdsw->jencatatan = is_getTipeJawatan($svdsw->jenis_catatan);
			$nnnnnnn[] = $svdsw;
			
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $nnnnnnn;
			print_r (json_encode($object));
?>