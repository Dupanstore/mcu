<?php
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_tind';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$this->db->where("id_ins_tind", $this->uri->segment(3));
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_tindakan', $rows, $offset);
		$faa = $data['query']->result();
		$jjsh = array();
		if($faa){
			foreach($faa as $fga){
				$fga->tomboll = '<button type="button" style="cursor:pointer" onclick="tampiljenispemeriksaan(\''. $fga->id_tind .'\', \''.$fga->nm_tind.'\')">Set</button>';
				$fga->detdetlain = "";
							$this->db->where('id_tind', $fga->id_tind);
							$dao = $this->db->get('tb_pemeriksaan_meta');
							$srt = $dao->result();
							if($srt){
								foreach($srt as $dtu){
									$mm = $this->madmin->get_value('id_pem', $dtu->id_pem, 'tb_pemeriksaan');
									$dsa[$fga->id_tind][] = $mm[0]->det_nm_pemeriksaan;
								}
							$fga->detdetlain = implode(", ", $dsa[$fga->id_tind]);
							}
				$jjsh[] = $fga;
			}
		}
			$object = new stdClass();
			$object->rows = $jjsh;
			print_r (json_encode($object));
?>