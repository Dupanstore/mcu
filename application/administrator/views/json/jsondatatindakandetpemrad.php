<?php
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_tind';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$sm = " select * from tb_tindakan, tb_grouptind ";
		$sm .= " where tb_tindakan.kd_grouptind = tb_grouptind.kd_grouptindakan ";
		$sm .= " and tb_grouptind.id_grouptindakan='". $this->uri->segment(3) ."' ";
		$sm .= " order by ". $sort ." ". $order;
		$an = $this->db->query($sm);
		$faa = $an->result();
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
									$dsa[$fga->id_tind][] = $mm[0]->rad_namapemeriksaan;
								}
							$fga->detdetlain = implode(", ", $dsa[$fga->id_tind]);
							}
				$fga->kesannormal = '<input type="text" id="kesan_'.$fga->id_tind.'" value="'.$fga->kesan_normal.'" onchange="rubahnilaikesan(\''.$fga->id_tind.'\')" style="width:100%">';
				$jjsh[] = $fga;
			}
		}
			$object = new stdClass();
			$object->rows = $jjsh;
			print_r (json_encode($object));
?>