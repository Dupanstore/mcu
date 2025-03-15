<?php
		$que 	 = "select id_ins_tind, id_tind, nm_tind from tb_tindakan where tampil_di_pemeriksaan<>'N' ";
		$que 	.= " order by id_ins_tind DESC, order_tindakan ASC";
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$hhhh = array();
			$uks = new stdclass();
			$uks->uri_key = "daftarpeserta";
			$uks->id_ins_tind = "daftarpeserta";
			$uks->id_tind = "daftarpeserta";
			$uks->nm_tind = "Daftar Peserta MCU";
			$hhhh[] = $uks;
			$kom = new stdclass();
			$kom->uri_key = "diagnosakesehatan";
			$kom->id_ins_tind = "diagnosakesehatan";
			$kom->id_tind = "diagnosakesehatan";
			$kom->nm_tind = "Diagnosa Kesehatan Kerja";
			$hhhh[] = $kom;
		if($ffds){
			foreach($ffds as $gs){
					if($gs->id_ins_tind == '2'){
						$kkk[] = 1;
						$gs->id_tind = "Laboratorium";
						$gs->nm_tind = "Laboratorium";
						$avrioo = $gs;
					}else {
						$gs->uri_key = "kosong";
						$gs->id_ins_tind = "kosong";
						$gs->id_tind = "kosong";
						$hhhh[] = $gs;
					}
			}
		}
			if(is_array($kkk)){
				$hhhh[] = $avrioo;
			}
			
			
			$object = new stdClass();
			$object->rows = $hhhh;
			print_r (json_encode($object));
			//print_r ($hhhh);
?>