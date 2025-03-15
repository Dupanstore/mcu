<?php
	$dndn = "select id_reg_detpem from tb_register_detailpemeriksaan 
	where id_tind_detpem=6652 and id_pem_deb=177 ";
	$bbds = $this->db->query($dndn);
	$bdns = $bbds->result();
	foreach($bdns as $gbbd){
		$gsbbs[] = array(
			'id_reg_detpem' => $gbbd->id_reg_detpem,
			'id_pem_deb' => 400,
		);
	}
	$this->db->update_batch("tb_register_detailpemeriksaan", $gsbbs, "id_reg_detpem");
	print_r($gsbbs);
?>
