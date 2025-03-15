<?php
		$this->db->select('idc');
		$this->db->from('tb_reff_konsul');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nama_pkt';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		
		
		$que 	 = "select * from tb_reff_konsul where 1=1 ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (nama_pkt like '%".strip_tags(trim($_POST['cari']))."%' OR  isi_pkt like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		/*if (@!empty($_POST['ins'])){
			if ($_POST['ins'] != "Semua"){				
				$que 	.= " and id_ins='".strip_tags(trim($_POST['ins']))."' ";
			}
		}*/
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$gsvdv = $this->db->query($que);
		$rgdvd = $gsvdv->result();
		foreach($rgdvd as $rgsb){
				$svvd = explode(",", $rgsb->isi_pkt);
				foreach($svvd as $gdbjk){
					$gdbjk = trim(trim(trim($gdbjk)));
					$this->db->select('id_tind');
					$this->db->where('nm_tind', $gdbjk);
					$fvs = $this->db->get('tb_tindakan');
					$fve = $fvs->row();
					$nndb[$rgsb->idc][] = $fve->id_tind;
				}
			$rgsb->idnf = implode(",", $nndb[$rgsb->idc]);
			$celd[] = $rgsb;
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $celd;
			print_r (json_encode($object));
?>