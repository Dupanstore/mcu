<?php
		$this->db->select('id_jawatan');
		$this->db->from('tb_jawatan');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_jawatan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select id_jawatan,  kd_jawatan, nm_jawatan,  tipe_jawatan, default_jawatan, alamat_jawatan, no_tlp_jawatan, case when tipe_jawatan='D' then 'Dinas' else 'Non Dinas' end as tipe_jawatan_new, case when default_jawatan='Y' then 'Ya' else 'Tidak' end as default_jawatan_new from tb_jawatan where 1=1 ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (nm_jawatan like '%".strip_tags(trim($_POST['cari']))."%' OR  kd_jawatan like '%".strip_tags(trim($_POST['cari']))."%' OR  no_tlp_jawatan like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		if (@!empty($_POST['jawatan'])){
			if ($_POST['jawatan'] != "Semua"){				
				$que 	.= " and tipe_jawatan='".strip_tags(trim($_POST['jawatan']))."' ";
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