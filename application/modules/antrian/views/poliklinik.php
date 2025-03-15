
		<?php 
			for($x=1;$x<=2;$x++){ 
			
			//cek apakah sudah ada data yang disimpan pada hari ini
		$hjyu  = "select kdurutan from tb_antrian_meta ";
		$hjyu .= "where type='pendaftaran' ";
		$hjyu .= "and tglmsk like '%". date("Y-m-d") ."%' ";
		$hjyu .= "and status='b' and  dari_menu_perjanjian='' and loket_pendaftaran=$x ";
		$hjyu .= "order by tglupdate DESC limit 1";
		$bbhy = $this->db->query($hjyu);
		$bkmll = $bbhy->row();
		if($bkmll){
			$urutt = $bkmll->kdurutan;
			//buat yang untuk ganti warna bloknya
		}else{
			$urutt = "-";
		}
		?>
		<div id="list_div_2" class="body-counter" style="box-shadow: 2px 5px 11px #3333336b;">
								<div class="col-xs-12 head-counter v1-hc-text">
									LOKET <?=@$x?> - PENDAFTARAN                    </div>
								<div class="col-xs-12" style="background-color: #eb8a1b; font-size: 20px; color: #FFF; padding: 4px;">NOMOR ANTRIAN</div>
								<div id="list_2" class="col-xs-12 body-counter v2-bc-text"><?=@$urutt?></div>
							</div>
							<br>
		<?php } ?>
