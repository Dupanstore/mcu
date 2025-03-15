<?php
		$this->db->select('id_dinas');
		$this->db->from('tb_dinas');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_dinas';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select id_dinas,  nm_dinas,  tipe_dinas, case when tipe_dinas='D' then 'Dinas' else 'Non Dinas' end as tipe_dinas_new, case when ila_medex='ila' then 'ILA' when ila_medex='medex' then 'MEDEX' else '' end as set_ila_jmu from tb_dinas where 1=1 ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and nm_dinas like '%".strip_tags(trim($_POST['cari']))."%' ";
		}
		if (@!empty($_POST['dinas'])){
			if ($_POST['dinas'] != "Semua"){				
				$que 	.= " and tipe_dinas='".strip_tags(trim($_POST['dinas']))."' ";
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