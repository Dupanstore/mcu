<?php
	$ceks = "select b.id_dinas, a.id_reg from tb_register a, tb_pasien b where a.no_reg=b.no_reg ";
	$gets = $this->db->query($ceks);
	$gsbd = $gets->result();
	foreach($gsbd as $bbdv){
		$gdghdf['id_dinas_dua'] = $bbdv->id_dinas;
		$this->db->where('id_reg', $bbdv->id_reg);
		$this->db->update('tb_register', $gdghdf);
		
	}
	
?>
ok bos