<?php
	//$this->db->where("kode_transaksi", "MCU-3420211213071030");
	if(!empty($_GET['pkey'])){
		$this->db->where("kode_transaksi", $_GET['pkey']);
		$this->db->where("id_ins_tind_detpem", "2");
		$this->db->order_by("id_reg_detpem", "ASC");
		$snndbv = $this->db->get('tb_register_detailpemeriksaan');
		$gsbdvd = $snndbv->result();
		foreach($gsbdvd as $gsb){
			$lospid[$gsb->id_tind_detpem."-".$gsb->id_ins_tind_detpem."-".$gsb->kd_grouptind."-".$gsb->id_pem_deb][$gsb->id_reg_detpem] = $gsb->id_reg_detpem;
		}
		foreach($lospid as $bdb => $gbd){
			if(count($gbd) > 1){
				$hnn=1;
				foreach($gbd as $sbdf => $bsbd){
					$gsvvd = $hnn++;
					if($gsvvd > 1){
						echo $bdb.' -- '.$bsbd."<hr />";
						$this->db->where('id_reg_detpem', $bsbd);
						$this->db->delete('tb_register_detailpemeriksaan');
					}
				}
			}
		}
	}
	
?>