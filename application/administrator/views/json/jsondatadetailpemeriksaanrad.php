<?php
		$this->db->where('id_grouptindakan', $this->uri->segment(3));
		$this->db->limit('1');
		$grp = $this->db->get('tb_grouptind');
		$grptnd = $grp->result();
		//----------------------------------------------------
		$this->db->select('id_periksa');
		$this->db->from('tb_pemeriksaan');
		$this->db->where('id_ins_periksa', 3);
		$this->db->where('kd_group', $grptnd[0]->kd_grouptindakan);
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'det_order_pemeriksaan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('rad_namapemeriksaan', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->where('id_ins_periksa', 3);
		$this->db->where('kd_group', $grptnd[0]->kd_grouptindakan);
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_pemeriksaan', $rows, $offset);
		$ffds = $data['query']->result();
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ffds;
			print_r (json_encode($object));
?>