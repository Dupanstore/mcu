<?php
		//ambil instalasi untuk gogo
		
		$fsfg =  "select a.id_pem, a.det_nm_pemeriksaan from tb_pemeriksaan a, tb_instalasi b where a.id_ins_periksa=b.id_ins and b.pelayanan_gigi='Y' ";
		$sgfs = $this->db->query($fsfg);
		$cekh = $sgfs->result();
		
		$this->db->select('id_kln');
		$this->db->from('tb_kelainan_gigi');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kelainan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		if (@!empty($_POST['cari'])){
			$this->db->or_like('kelainan', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_kelainan_gigi', $rows, $offset);
		$ffds = $data['query']->result();
		foreach($ffds as $fssd){
			$fssd->setpemeriksaan = '<select onchange="rubahuntuksetkelainan(\''.$fssd->id_kln.'\', this.value)">';
			$fssd->setpemeriksaan .= '<option value="">Set Pemeriksaan</option>';
			foreach($cekh as $sasd){
				$bsvs = "";
				if($sasd->id_pem == $fssd->id_pemeriksaan){
					$bsvs = 'selected="true"';
				}
				$fssd->setpemeriksaan .= '<option '.$bsvs.' value="'.$sasd->id_pem.'">'.$sasd->det_nm_pemeriksaan.'</option>';
			}
			$fssd->setpemeriksaan .= '</select>';
			$ding[] = $fssd;
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $ding;
			print_r (json_encode($object));
?>