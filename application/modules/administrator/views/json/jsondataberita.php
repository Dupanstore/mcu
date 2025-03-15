<?php

		$fsvdv = $this->db->get('api_subkatberita');
		$rfgsh = $fsvdv->result();
		foreach($rfgsh as $rgsvd){
			$ghsfg[$rgsvd->id] = $rgsvd->name;
		}
		$this->db->select('id');
		$this->db->from('api_berita');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('pname', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('api_berita', $rows, $offset);
		
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$hj->icmkat = $ghsfg[$hj->sid];
				$hj->blstimg = '<img src="'.is_iplocalserverandroid().'/'.$hj->prel.'" style="width:70px;">';
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>