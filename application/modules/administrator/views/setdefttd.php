<?php
	
	/*$fscscs = "select id_reg from tb_register where def_ttd=0 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') <= 20210328 order by id_reg DESC ";
	$rsfvcd = $this->db->query($fscscs);
	$fscdcd = $rsfvcd->result();
	foreach($fscdcd as $dvdd){
		$svsvd['def_ttd'] = 16;
		$svsvd['update_ttd_katim_by_sis'] = 'Y';
		$this->db->where("id_reg", $dvdd->id_reg);
		$this->db->update("tb_register", $svsvd);
		
	}*/
	
	/*$fscscs = "select id_reg from tb_register where def_ttd=0 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') >= 20210329 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') <= 20220615 ";
	$fscscs = "select count(id_reg) as vvv from tb_register where def_ttd=0 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') >= 20210329 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') <= 20220615 ";
	$rsfvcd = $this->db->query($fscscs);
	$fscdcd = $rsfvcd->result();
	
	foreach($fscdcd as $dvdd){
		$svsvd['def_ttd'] = 6;
		$svsvd['update_ttd_katim_by_sis'] = 'Y';
		$this->db->where("id_reg", $dvdd->id_reg);
		$this->db->update("tb_register", $svsvd);
		
	}*/
	
	//$fscscs = "select id_reg from tb_register where def_ttd=0 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') >= 20220616 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') <= 20230626 ";
	$fscscs = "select count(id_reg) as vvv from tb_register where def_ttd=0 and DATE_FORMAT(tgl_awal_reg, '%Y%m%d') > 20230626 ";
	$rsfvcd = $this->db->query($fscscs);
	$fscdcd = $rsfvcd->result();
	
	foreach($fscdcd as $dvdd){
		//$svsvd['def_ttd'] = 17;
		//$svsvd['update_ttd_katim_by_sis'] = 'Y';
		//$this->db->where("id_reg", $dvdd->id_reg);
		//$this->db->update("tb_register", $svsvd);
		
	}
	print_r($fscdcd);
?>