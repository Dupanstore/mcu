<?php 
	$ketats = '-';
	$ketbwh = '-';
	$hrri = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
	$sskj  = "select * from tb_antrian_meta ";
	$sskj .= "where type='pendaftaran' ";
	$sskj .= "and tglmsk like '%". date("Y-m-d") ."%' ";
	$sskj .= "and status='a' and  dari_menu_perjanjian='' ";
	$sskj .= "order by id_met ASC limit 1";
	$upyt = $this->db->query($sskj);
	$cekghsa = $upyt->row();
	
	$abgst = 'style="background:#ffffff;color:#333333;"';
	if($cekghsa){
		
		//jika ada maka tampilkan datanya dan bunyikan suaranya
		$ketats = $cekghsa->kdurutan;
		$ketbwh = "LOKET ". $cekghsa->loket_pendaftaran;
		//buat yang untuk ganti warna bloknya
		$aktifnya[$cekghsa->loket_pendaftaran] = 'ok';
		//selelah itu updatelah ya tip
		$uyp['status'] = 'b';
		$this->db->where('id_met', $cekghsa->id_met);
		$this->db->update('tb_antrian_meta', $uyp);
	} 
?>

					<?php if($cekghsa){ 
						$koncversi = antrianterbilang(clean_data(@$cekghsa->urutan), bacaloket($cekghsa->loket_pendaftaran), clean_data(@$cekghsa->awalan));
						$bsndbssss = explode(" ", $koncversi);
						
						if(is_array($bsndbssss)){
							$mdnh=1;
							foreach($bsndbssss as $hhg){
								trim($hhg);
								if(!empty($hhg)){
								$melo=$mdnh++;
					?> 
						<audio id="audio<?=@$melo?>" controls hidden>
						  <source src="<?=@base_url('suarapendaftaran/audio/'.trim(trim($hhg)).'.mp3')?>" type="audio/mp3">
						</audio> 
					<?php
								}
							}
						}
					?>
					<input type="hidden" id="nomorantriokpendaftaran" value="isi">
					
					<?php } else {?>
					<input type="hidden" id="nomorantriokpendaftaran" value="kosong">
					<?php } ?>
			
			
			