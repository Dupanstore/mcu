<?php
	$sahud  = "SELECT  tb_pasien.tgl_lhr_pas, tb_register.tgl_awal_reg, tb_register.id_reg, tb_register.umur_tahun from tb_register, tb_pasien  where tb_register.no_reg=tb_pasien.no_reg 
	and tb_register.umur_tahun=0 limit 1000";
	$daplun = $this->db->query($sahud);
	$jafuk  = $daplun->result();
	foreach($jafuk as $svd){
		
		$umurrr = get_umur_rekap($svd->tgl_lhr_pas, $svd->tgl_awal_reg);
		$shdggd[] = array(
			'id_reg' => $svd->id_reg,
			'umur_tahun' => (int) $umurrr,
		);
	}
	if(is_array($shdggd)){
		//print_r($shdggd);
		$this->db->update_batch("tb_register", $shdggd, "id_reg");
	}else{
		echo "selessaiiiii";
		die();
	}
	
	
	?>
	<script>
		 location.reload(); 
	</script>
