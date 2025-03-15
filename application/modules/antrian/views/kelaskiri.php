<table style="width:100%">
	<tr>
		<td style="width:40%;vertical-align:top">
			<table style="width:100%">
				<tr>
					<?php 
						$this->db->order_by("id_kel", "DESC");
						$gshsd = $this->db->get("tb_kelas");
						$ghsdj = $gshsd->result();
						
						$ghsdj[999]->id_kel = 999;
						$ghsdj[999]->nm_kel = "PERINA";
						
						$ghsdj[888]->id_kel = 888;
						$ghsdj[888]->nm_kel = "PICU";
						
						$ghsdj[777]->id_kel = 777;
						$ghsdj[777]->nm_kel = "NICU";
						
						$ghsdj[666]->id_kel = 666;
						$ghsdj[666]->nm_kel = "ISOLASI EBONI";
						
						$ghsdj[555]->id_kel = 555;
						$ghsdj[555]->nm_kel = "VK";
						
						$ghsdj[444]->id_kel = 444;
						$ghsdj[444]->nm_kel = "SCN (Fototerapi)";
						
						$ghsdj[333]->id_kel = 333;
						$ghsdj[333]->nm_kel = "HCU Maternal";
						
						
						//print_r($ghsdj);

						
						foreach($ghsdj as $gds){ 
						
							if($gds->id_kel != 6 && $gds->id_kel != 8){
							
								if($gds->id_kel == "999"){
									$fgf = $this->madmin->getruangicu(63);
								}
								else if($gds->id_kel == "888"){
									$fgf = $this->madmin->getruangicu(204);
								}
								else if($gds->id_kel == "777"){
									$fgf = $this->madmin->getruangicu(191);
								}
								else if($gds->id_kel == "666"){
									$fgf = $this->madmin->getruangicu(169);
								}
								else if($gds->id_kel == "555"){
									$fgf = $this->madmin->getruangicu(66);
								}
								else if($gds->id_kel == "444"){
									$fgf = $this->madmin->getruangicu(190);
								}
								else if($gds->id_kel == "333"){
									$fgf = $this->madmin->getruangicu(192);
								}else{
									$fgf = $this->madmin->getruangbykelas($gds->id_kel);
								}
								foreach($fgf as $ksn){
									$loppoli[$gds->id_kel][$ksn->id_ins] = $ksn;
									$sb=$cn++;
									$shdb = "tabledokter";
									$kapasitas = 0;
									$terisi = 0;
									$cekruanganbykelas[$gds->id_kel][$ksn->id_ins] = 1;
									$terisikiri[$gds->id_kel][$ksn->id_ins] = 0;
									$kosongkiri[$gds->id_kel][$ksn->id_ins] = 0;
									$jadwaldet = $this->madmin->getkapasitasruang($gds->id_kel, $ksn->id_ins);
									if($jadwaldet){
										//ambil detail pasien yang masih aktifff
										$kapasitas = $jadwaldet->ttls;
										$detisi = $this->madmin->getstatusterisi($gds->id_kel, $ksn->id_ins);
										if($detisi){
											$terisikiri[$gds->id_kel][$ksn->id_ins] = $detisi->ttls;
											if($detisi->ttls > $jadwaldet->ttls){
												$terisikiri[$gds->id_kel][$ksn->id_ins] = $jadwaldet->ttl;
											}
											$kosongkiri[$gds->id_kel][$ksn->id_ins] = $kapasitas-$terisikiri[$gds->id_kel][$ksn->id_ins];
										}
									}
								}
								
								//print_r($fgf);
								
							}
						}
						$g=1;
						foreach($ghsdj as $gds){ 
							if(is_array($cekruanganbykelas[$gds->id_kel])){
							if($gds->id_kel != 6 && $gds->id_kel != 8){
								$m=$g++;
								$nmkel = " KELAS " . $gds->nm_kel;
								if($gds->id_kel == 999){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 888){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 777){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 666){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 555){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 444){
									$nmkel =  $gds->nm_kel;
								}
								else if($gds->id_kel == 333){
									$nmkel =  $gds->nm_kel;
								}
					?>
							<td style="width:50%;vertical-align:top;">
								<table style="width:100%;border:solid 2px white;">
									<tr style="background:#1669BE" >
										<td style="color:#ffffff;" colspan="2"><div align="center"><span style="font-size:20px;font-color:#ffffff:font-weight:bold;"> <?=@$nmkel?></span></div></td>
									</tr>
									<tr >
										<td style="background:#155784;color:#ffffff;width:50%"><div align="center"><span style="font-size:14px;font-color:#ffffff:font-weight:bold;">TERISI</span></div></td>
										<td style="background:#ffffff;color:#111111;"><div align="center"><span style="font-size:14px;font-color:#ffffff:font-weight:bold;">KOSONG</span></div></td>
									</tr>
									<tr>
										<td style="background:#155784;color:#ffffff;"><div align="center" style="padding:1px;"><span style="font-size:40px;font-color:#ffffff:font-weight:bold;"><b><?=@array_sum($terisikiri[$gds->id_kel]) == "" ? 0 : array_sum($terisikiri[$gds->id_kel])?></b></span></div></td>
										<td style="background:#ffffff;color:#111111;padding:1px;"><div align="center" style="padding:1px;"><span style="font-size:40px;font-color:#ffffff:font-weight:bold;"><?=@array_sum($kosongkiri[$gds->id_kel]) == "" ? 0 : array_sum($kosongkiri[$gds->id_kel])?></span></div></td>
									</tr>
									
								</table>
							</td>
								<?php if($m > 1){ $g=1; echo "</tr><tr>"; }?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					<td style="width:50%;vertical-align:top;">
								<table style="width:100%;border:solid 1px #0C4E79;">
									<tr style="background:#1669BE" >
										<td style="color:#ffffff;" colspan="2"><div align="center"><span style="font-size:20px;font-color:#ffffff:font-weight:bold;"> -</span></div></td>
									</tr>
									<tr >
										<td style="background:#155784;color:#ffffff;width:50%"><div align="center"><span style="font-size:15px;font-color:#ffffff:font-weight:bold;">TERISI</span></div></td>
										<td style="background:#ffffff;color:#111111;"><div align="center"><span style="font-size:15px;font-color:#ffffff:font-weight:bold;">KOSONG</span></div></td>
									</tr>
									<tr>
										<td style="background:#155784;color:#ffffff;"><div align="center" style="padding:1px;"><span style="font-size:20px;font-color:#ffffff:font-weight:bold;"><b>-</b></span></div></td>
										<td style="background:#ffffff;color:#111111;padding:1px;"><div align="center" style="padding:1px;"><span style="font-size:20px;font-color:#ffffff:font-weight:bold;">-</span></div></td>
									</tr>
									
								</table>
							</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align:top;">
			<table style="width:100%;">
				<?php 
						$g=1;
						
						foreach($ghsdj as $gds){ 
						
						if(is_array($cekruanganbykelas[$gds->id_kel])){
							if($gds->id_kel != 6 && $gds->id_kel != 8 ){
							$m=$g++;
							$nmkel = " KELAS " . $gds->nm_kel;
							//if($gds->id_kel == 999){
								//$nmkel =  $gds->nm_kel;
							//}
							
							//selanjutnya ambil ruangan yang masuk ke kelas tsb
							
					?>
								<tr style="background:#155784;" >
									<td style="color:#ffffff;padding:4px;font-size:15px;border:solid 2px white;"><b><?=@$nmkel?></b></td>
								</tr>
								<tr style="background:#1669BE" >
									<td style="color:#ffffff;padding:4px;">
													
													
													
													<table style="width:100%">
								<tr>
									<?php 
										$g=1;
										//print_r($loppoli[$gds->id_kel]);
										foreach($loppoli[$gds->id_kel] as $sss => $gfhs){
											
											$m=$g++;
									?>
									<td style="width:20%;">
										<table style="width:100%;border:solid 1px white;">
											<tr style="background:#1669BE" >
												<td style="color:#ffffff;" colspan="2"><div align="center"><span style="font-size:15px;font-color:#ffffff:font-weight:bold;"><?=@strtoupper($gfhs->nm_instalasi)?></span></div></td>
											</tr>
											<tr >
												<td style="background:#155784;color:#ffffff;width:50%"><div align="center"><span style="font-size:22px;font-color:#ffffff:font-weight:bold;">TERISI</span></div></td>
												<td style="background:#ffffff;color:#111111;"><div align="center"><span style="font-size:22px;font-color:#ffffff:font-weight:bold;">KOSONG</span></div></td>
											</tr>
											<tr >
												<td style="background:#155784;color:#ffffff;width:50%"><div align="center"><span style="font-size:48px;font-color:#ffffff:font-weight:bold;"><b><?=@(int) $terisikiri[$gds->id_kel][$gfhs->id_ins]?></b></span></div></td>
												<td style="background:#ffffff;color:#111111;padding:1px;"><div align="center"><span style="font-size:48px;font-color:#ffffff:font-weight:bold;"><b><?=@(int) $kosongkiri[$gds->id_kel][$gfhs->id_ins]?></b></span></div></td>
											</tr>
										</table>
									</td>
										<?php if($m > 4){ $g=1; echo "</tr><tr>"; }?>
									<?php } ?>
								</tr>
							</table>
							
							
							
									</td>
								</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>