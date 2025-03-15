<?php
		$this->db->select('id_dept');
		$this->db->from('tb_departmen');
		$this->db->where('id_jawatan', $this->uri->segment(3));
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_dept';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('nm_dept', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->where('id_jawatan', $this->uri->segment(3));
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_departmen', $rows, $offset);
		$ding = array();
		$ffds = $data['query']->result();
		if($ffds){
			$ding = $ffds;
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ding;
			print_r (json_encode($object));
?>