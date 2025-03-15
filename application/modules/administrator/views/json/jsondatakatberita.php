<?php
	$this->db->select('id');
		$this->db->from('api_subkatberita');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('name', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('api_subkatberita', $rows, $offset);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$gsvab = '<div align="center"><a href="javascript:void(0)" onclick="rubahstatusyaok(\''.$hj->id.'\')"><b>Tidak</b></a></div>';
				//selanjutnya cekkk
				$this->db->where('sid', $hj->id);
				$dsjfghds = $this->db->get('api_home');
				$rgdhsfsf = $dsjfghds->row();
				if($rgdhsfsf){
					$gsvab = '<div align="center"><a href="javascript:void(0)" onclick="rubahstatusyaok(\''.$hj->id.'\')"><b>Ya</b></a></div>';
				}
				$hj->set_home = $gsvab;
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>