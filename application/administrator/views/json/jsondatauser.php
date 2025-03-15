<?php
		$this->db->select('id_user');
		$this->db->from('tb_user');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'username';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_user, tb_instalasi where tb_user.level=tb_instalasi.id_ins ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (username like '%".strip_tags(trim($_POST['cari']))."%' OR  email like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		if (@!empty($_POST['ins'])){
			if ($_POST['ins'] != "Semua"){				
				$que 	.= " and id_ins='".strip_tags(trim($_POST['ins']))."' ";
			}
		}
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $data['query']->result();
			print_r (json_encode($object));
?>