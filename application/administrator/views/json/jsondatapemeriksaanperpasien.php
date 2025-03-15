<?php
		if($this->session->userdata('id_ins')=='1'){
			$que 	 = "select b.id_ins_tind, b.id_tind, b.nm_tind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$this->uri->segment(3)."'  and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind <> '2' AND b.id_ins_tind <> '3')";
			$que 	.= " order by b.order_tindakan ASC";
			$data['query'] 	= $this->db->query($que);
			$ffds = $data['query']->result();
			$hhhh = array();
			if($ffds){
				$hhhh = $ffds;
			}
			$que 	 = "select b.id_ins_tind, b.id_tind, b.nm_tind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$this->uri->segment(3)."' and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind='2' OR b.id_ins_tind='3') group by b.id_ins_tind";
			$que 	.= " order by b.order_tindakan ASC";
			$data['query'] 	= $this->db->query($que);
			$ffds = $data['query']->result();
			if($ffds){
				foreach($ffds as $gs){
					if($gs->id_ins_tind == '2'){
						$gs->id_tind = "Laboratorium";
						$gs->nm_tind = "Laboratorium";
					}else {
						$gs->id_tind = "Radiologi";
						$gs->nm_tind = "Radiologi";
					}
					$hhhh[] = $gs;
				}
			}
				$object = new stdClass();
				$object->rows = $hhhh;
				print_r (json_encode($object));
		}else{
		$que 	 = "select b.id_ins_tind, b.id_tind, b.nm_tind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$this->uri->segment(3)."' and a.id_ins_tind_pem='".$this->session->userdata('id_ins')."' and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind <> '2' AND b.id_ins_tind <> '3')";
		$que 	.= " order by b.order_tindakan ASC";
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$hhhh = array();
		if($ffds){
			$hhhh = $ffds;
		}
		$que 	 = "select b.id_ins_tind, b.id_tind, b.nm_tind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$this->uri->segment(3)."' and a.id_ins_tind_pem='".$this->session->userdata('id_ins')."' and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind='2' OR b.id_ins_tind='3') group by b.id_ins_tind";
		$que 	.= " order by b.order_tindakan ASC";
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		if($ffds){
			foreach($ffds as $gs){
				if($gs->id_ins_tind == '2'){
					$gs->id_tind = "Laboratorium";
					$gs->nm_tind = "Laboratorium";
				}else {
					$gs->id_tind = "Radiologi";
					$gs->nm_tind = "Radiologi";
				}
				$hhhh[] = $gs;
			}
		}
			$object = new stdClass();
			$object->rows = $hhhh;
			print_r (json_encode($object));
		}
?>