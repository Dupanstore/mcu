<?php
		$this->db->select('id');
		$this->db->from('api_banner');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'bimg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('bimg', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('api_banner', $rows, $offset);
		
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$posss = '<b>HOMEPAGE</b>';
				if($hj->cid > 0){
					$this->db->select('nm_ins');
					$this->db->where('id_ins', $hj->cid);
					$getPoli = $this->db->get('tb_instalasi');
					$setPoli = $getPoli->row();
					$posss = '<b>'.strtoupper($setPoli->nm_ins).'</b>';
				}
				$hj->blstimg = '<img src="'.is_iplocalserverandroid().'/'.$hj->bimg.'" style="width:150px;">';
				$hj->pidpol = $posss;
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>