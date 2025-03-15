<?php
	$iddarahtepi = $this->madmin->Get_setting('lab_darah_tepi_tind_id');
	if(isset($_GET['apdetstatusmens'])){
		$gsfagdd = "select a.* from tb_register a where  a.kode_transaksi='".$_GET['kode_transaksi']."' ";
		$awqwqwq = $this->db->query($gsfagdd);
		$dsasasas = $awqwqwq->row();
		
		
		//print_r($dsasasas);
		$mnnbdv = "Y";
		if($dsasasas->sedang_menstruasi == "Y"){
			$mnnbdv = "";
		}
		$ffggfg['sedang_menstruasi'] = $mnnbdv;
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		$this->db->update('tb_register', $ffggfg);
		//print_r($dsasasas);
	}
	
	
	
	
	$ceknoregdata = "select b.tipe_dinas from tb_pasien a, tb_dinas b where a.id_dinas=b.id_dinas and a.no_reg='".$_GET['noreg']."' ";
	$queryceknored = $this->db->query($ceknoregdata);
	$incekkodedinas = $queryceknored->row();
	
	$cekregpasien = "select a.*, b.jenkel_pas, c.en_hasil, c.nm_paket from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket and  a.kode_transaksi='".$_GET['kode_transaksi']."' ";
	$queryregpasien = $this->db->query($cekregpasien);
	$incekregpasien = $queryregpasien->row();
	if(empty($incekregpasien->qr_code_keys)){
		$gsbbd['qr_code_keys'] = get_api_hash();
		$this->db->where('kode_transaksi', $incekregpasien->kode_transaksi);
		$this->db->update('tb_register', $gsbbd);
	}
	$isidarahtepi = unserialize($incekregpasien->hasil_darah_tepi);
	
	if($incekregpasien->sedang_menstruasi != "Y"){
		$pemeriksaanokauto = $this->madmin->Get_setting('pemeriksaan_auto_isi');
		$gsvdsas = explode("*", $pemeriksaanokauto);
		foreach($gsvdsas as $gsgfgd){
			$denganauto[trim($gsgfgd)] = trim($gsgfgd);
		}
	}
	
	$filterpemauto = $this->madmin->Get_setting('detailpemeriksaan_auto_kosong');
	$hhgsjiw = explode("*", $filterpemauto);
	foreach($hhgsjiw as $saqwqw){
		$tanpaauto[trim($saqwqw)] = trim($saqwqw);
	}
	//print_r($incekregpasien);
?>
<form method="POST" id="inputpemeriksaanformdata" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaanlab')?>">
<table class="tableeasyui" style="width:100%">
		<?php
			$this->db->select('id_reg_detpem');
			$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
			$this->db->where("id_ins_tind_detpem", '2');
			$this->db->where("id_paket", $_GET['id_paket']);
			$this->db->limit("1");
			$ndndbs = $this->db->get("tb_register_detailpemeriksaan");
			$jhjkjh = $ndndbs->result();
		?>
		
		<?php if($incekregpasien->en_hasil == "Y"){ ?>
		<tr>
			<td colspan="7" style="background:#00F200;color:white"><b><div align="center">Paket <?=@$incekregpasien->nm_paket?> | Mohon Mengisi Hasil Inputan Dengan Bahasa Inggris</div></b></td>
		</tr>
		<?php } ?>
		<?php if(!$jhjkjh){ ?>
		<tr>
			<td colspan="7" style="background:red;color:white"><b><div align="center">Pemeriksaan Belum Tersimpan</div></b></td>
		</tr>
		<?php } ?>
		<?php 
			if($incekregpasien->jenkel_pas == "P"){ 
				$vdvs = "";
				if($incekregpasien->sedang_menstruasi == "Y"){
					$vdvs = 'checked="true"';
				}
		?>
		<tr>
			<td colspan="7" style="background:#E5F1FD;color:red"><b><div align="center"><input <?=@$vdvs?> type="checkbox" onclick="rubahstatusmestruasii('<?=@$_GET['kode_transaksi']?>')"> Centang Jika Pasien Menstruasi</div></b></td>
		</tr>
		<?php } ?>
</table>
<div class="easyui-tabs" style="width:100%%;">
        
        
<?php
	//$pangkasnoreg = substr($_GET['noreg'],0,1);
	
	$pangkasnoreg = "N";
	if($incekkodedinas){
		if(!empty($incekkodedinas->tipe_dinas)){
			$pangkasnoreg = $incekkodedinas->tipe_dinas;
		}
	}
	
	
	//selanjutnya filter lagi kalo nonfinas
	if($pangkasnoreg == "N"){
		$sdhgdwver = "select auto_dinas from tb_paket where id_paket=".$_GET['id_paket']." ";
		$eretryete = $this->db->query($sdhgdwver);
		$sjhdgrher = $eretryete->row();
		if($sjhdgrher->auto_dinas =="Y"){
			$pangkasnoreg = 'D';
		}
	}
	
	//print_r($pangkasnoreg);
	
	//ambil tanggal lahir dan jenis kelamin ya
	$this->db->select('jenkel_pas, tgl_lhr_pas, ');
	$this->db->where("no_reg", $_GET['noreg']);
	$this->db->limit("1");
	$kbds = $this->db->get("tb_pasien");
	$kjkj = $kbds->row();
	//print_r($_GET);
				$this->db->select('val_stakes, kesimpulan_pemeriksaan, saran_pemeriksaan');
				$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
				$this->db->where('id_ins_tind_pem', '2');
				$this->db->limit('1');
				$ghgjh = $this->db->get('tb_register_pemeriksaan');
				$kjksd = $ghgjh->row();
				//print_r($kjksd);
				
				$this->db->where('id_ins', 2);
				$this->db->order_by('kd_grouptindakan', 'ASC');
				$cekgroup = $this->db->get('tb_grouptind');
				$loopgroup = $cekgroup->result();
?>
			<input type="hidden" name="no_lab" value="<?=@$_GET['kode_transaksi']?>" class="input-xlarge">
			<input type="hidden" name="tgllahir" value="<?=@$kjkj->tgl_lhr_pas?>" class="input-xlarge">
			<input type="hidden" name="jenkel" value="<?=@$kjkj->jenkel_pas?>" class="input-xlarge">
			<input type="hidden" name="id_paket" value="<?=@$_GET['id_paket']?>" class="input-xlarge">

			
<?php
	//print_r($loopgroup);
	foreach($loopgroup as $akjgroup){
	$asac = "select a.id_reg_pem, a.id_tind_pem, b.nm_tind, b.id_ins_tind, b.kd_grouptind, b.header_app_tind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$_GET['kode_transaksi']."' AND a.id_ins_tind_pem='2' AND a.id_paket='".$_GET['id_paket']."' and b.kd_grouptind='".$akjgroup->kd_grouptindakan."' order by b.kd_tind ASC";
	$uno = $this->db->query($asac);
	$ano = $uno->result();
	//print_r($ano);
	if($ano){
?>
		<div title="<?=@$akjgroup->nm_grouptindakan?>">
		
			<table class="tableeasyui" style="width:100%">
			<tr>
					<td style="background:#DEEEFA">No</td>
					<td style="background:#DEEEFA">Jenis Pemeriksaan</td>
					<td style="background:#DEEEFA">Hasil Pemeriksan</td>
					<td style="background:#DEEEFA">Keterangan</td>
					<td style="background:#DEEEFA">Satuan</td>
					<td style="background:#DEEEFA">Nilai Normal</td>
					<td style="background:#DEEEFA"></td>
				</tr>
	<?php
		$nma = 1;
		foreach($ano as $sju){
			$cekgambarandarahtepi[$sju->id_tind_pem] = $sju->id_tind_pem;
			if($sju->id_tind_pem != $iddarahtepi){
			//ambil detail pemeriksaane yaaaaaaaa
			//ambil semua pemeriksaan diradiologi yaaaaa
			//ini kalau dia konsep poliiiiiiiiiii yaa
			//KITA JUGA AMBIL PEMERIKSAAN YANG DIFILTER YAAAAAA
			$this->db->select('id_pem');
			$this->db->where('id_tind', $sju->id_tind_pem);
			$this->db->where('unicode_transaksi', $_GET['kode_transaksi']);
			$this->db->where('type_filter', 'KURANG');
			$abo = $this->db->get('tb_register_filterdata');
			$ubi = $abo->result();
			if($ubi){
				foreach($ubi as $df){
					$jangantampil[$df->id_pem] = $df->id_pem;
				}
			}
			$mm = "select * from tb_pemeriksaan_meta a, tb_pemeriksaan b where 1=1 ";
			$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$sju->id_tind_pem."' order by b.det_order_pemeriksaan ASC ";
			$absc = $this->db->query($mm);
			$dum = $absc->result();
				if($dum){
					$nmy = $nma++;
?>
				<input type="hidden" name="id_transkeu[<?=@$sju->id_reg_pem?>]" value="<?=@$sju->id_reg_pem?>" class="input-xlarge">
				<input type="hidden" name="id_tind[<?=@$sju->id_reg_pem?>]" value="<?=@$sju->id_tind_pem?>" class="input-xlarge">
				<input type="hidden" name="kdgroup[<?=@$sju->id_reg_pem?>]" value="<?=@$sju->kd_grouptind?>" class="input-xlarge">
<?php
						$asi = 0;
						$abs = false;
						foreach($dum as $hso){
							$asa = $asi++;
							if(!$jangantampil[$hso->id_pem]){
								$jumPem[$sju->id_tind_pem][] = 1;
								//nah disini buat urutannya ya
								//bedakan antara header dan bukan
								$abs[] = new stdclass;
								if($hso->setheader_lab == 'Y'){
									$abs[$hso->kd_pem]->id_meta_pem = $hso->id_meta_pem;
									$abs[$hso->kd_pem]->id_pem 		= $hso->id_pem;
									$abs[$hso->kd_pem]->setheader 	= 'Y';
								} else {
									$abs[$hso->kd_pem]->id_meta_pem = $hso->id_meta_pem;
									$abs[$hso->kd_pem]->id_pem 		= $hso->id_pem;
									$abs[$hso->kd_pem]->id_tind 	= $hso->id_tind;
									$abs[$hso->kd_pem]->setheader 	= 'N';
								}
								$abs[$hso->kd_pem]->nm_pem 	= $hso->nm_pem;
							}
						}
						//print_r($abs);
						if(count($jumPem[$sju->id_tind_pem]) > 1){
							
	?>
							<tr>	
								<td width="1%"><?=@$nmy?></td>
								<td colspan="6" style="background:#efefef"><?=@$sju->nm_tind?></td>
							</tr>
					<?php } ?>
					<?php
						$bx = 1;
						ksort($abs);
							//print_r($abs);.....................................
							foreach($abs as $vi => $hsm){ 
								if($hsm->id_meta_pem){
									$bm = $bx++;
									$this->db->limit(1);
									$pem = $this->madmin->get_value('id_pem', $hsm->id_pem, 'tb_pemeriksaan');	
									//$this->db->select('id_reg_detpem, adakelainan');
									$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
									$this->db->where("id_tind_detpem", $hsm->id_tind);
									$this->db->where("id_paket", $_GET['id_paket']);
									$this->db->where("id_pem_deb", $hsm->id_pem);
									$this->db->limit("1");
									$sapp = $this->db->get("tb_register_detailpemeriksaan");
									$sipp = $sapp->result();
									//print_r($sipp);
									$id_hasilnya = "";
									$nilainya = "";
									$bintangkejora = "";
									$kontrolhasil = "";
									$bck = "";
									if($sipp){
										$id_hasilnya = $sipp[0]->id_reg_detpem;
										$nilainya = $sipp[0]->hasilnya;
										$kontrolhasil = $sipp[0]->kontrol_hasil_pem;
										if($sipp[0]->adakelainan == "Y"){
											$bck = 'style="background:red;color:white;font-weight:bold"';
											$bintangkejora = "<b style='font-size:20px'>*</b>";
										}
									}else{
										if(isset($denganauto[$sju->id_tind_pem])){
											if(!isset($tanpaauto[$hsm->id_pem])){
												if($pem[0]->type_tampil == "positif_negatif"){
													$nilainya = $pem[0]->positif_negatif;
												}
												
												if($pem[0]->type_tampil == "umum"){
													//pertama kita bedakan apakah laki laki atau perempuan
													$hitawal  = str_replace(",", ".", $pem[0]->low);
													$hitakhir = str_replace(",", ".", $pem[0]->hight);
													//jika hasilnya ada komanyaaaa yaaa
													$dhhs = explode(".", $hitawal);
													$uisy = explode(".", $hitakhir);
													//print_r(count($dhhs));
													if(count($dhhs) > 1 OR count($uisy) > 1){
														$nilainya = rand($dhhs[0]*10, $uisy[0]*10)/10;
														//jika nilainya belum sesuaiiiii buat yang minimal
														if($nilainya < $hitawal){
															$nilainya = $hitawal;
														}
														if($nilainya > $hitakhir){
															$nilainya = $hitakhir;
														}
													}else {
														//bdeakan anara yang nomor dan bukan
														if($pem[0]->low == '0' AND $pem[0]->hight == '0'){
															$nilainya = $pem[0]->nilai_rujukan;
														}else {
															$nilainya = rand($hitawal, $hitakhir);
															
														}
													}
												}
											}
										}
											
									}
									
					?>
					<input type="hidden" name="setheader[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$hsm->setheader?>" class="input-xlarge">
					<input type="hidden" name="idpem[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$hsm->id_pem?>" class="input-xlarge">
					<input type="hidden" name="id_hasil[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$id_hasilnya?>" class="input-xlarge">
								<?php 
									$nmlkk = "";
									$noss = "";
									if(count($jumPem[$sju->id_tind_pem]) < 2){
										$nmlkk = '';
										$noss = $nmy;
									}
								?>
								<?php
									//jadi kalau nanti tindakannya ada headernya maka angka ditindakannya dihilangkan dan nama tindakannya lebih menjorok
									$nmGrouptnd = '';
									if($sju->header_app_tind != ''){
										$loopsatu[$sju->header_app_tind][] = 1;
										$nmGrouptnd = "&nbsp;";
									}
									//nah sekarang tambahkan header tindakan jika tindakannya punya header
									//dan pastikan jangan ada header dengan nama yang sama untuk diulanh
								?>
								<?php
									if($sju->header_app_tind != ''){
										if(array_sum($loopsatu[$sju->header_app_tind]) < 2){
									?>
									<tr>	
										<td width="1%" style="background:#efefef"></td>
										<td colspan="6" style="background:#efefef"><?=@$sju->header_app_tind?></td>
									</tr>
										<?php } ?>
									<?php } ?>
									<tr>
										<td width="1%"><?=@$noss?></td>
										<?php
											$yus = '';
											if($hsm->setheader == 'Y'){
												$yus = 'colspan="6" style="background:#efefef"';
										?>
										<input type="hidden" name="type_tampil[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$pem[0]->type_tampil?>">
										<input type="hidden" name="nilai[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$nilainya?>"><b style="font-size:20px;"></b>
										<?php }
											if($hsm->setheader == 'N'){
												//cek apakah ada titik / sub headernya apa ga
												$snnp = explode(".", $vi);
												//print_r();
												//jika jumlahnya lebih dari 1 maka dibuat lebih menjorok
												$syb = '';
												if(count($snnp) > 1){
													if($nmGrouptnd == ""){
													$syb = "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
													}
												}
											}
										?>
										<td <?=@$yus?> <?=@$bck?>><?=$nmlkk?> <?=@$syb?><?=@$nmGrouptnd?><?=@$hsm->nm_pem?></td>
										<?php
											if($hsm->setheader == 'N'){
										?>
										
												<?php
													//nah disini kita juga bedakan antara yang input atau combo
													if($pem[0]->type_tampil == 'positif_negatif'){
												?>
												<td <?=@$bck?>>
													<input type="hidden" name="type_tampil[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$pem[0]->type_tampil?>">
													<select name="nilai[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" id="positif_negatif">
														<option value=""></option>
														<?php 
															foreach($this->madmin->rsau_postifif_negatif() as $dy => $sr){ 
															$sel = "";
															if($nilainya){
																if($nilainya == $dy){
																	$sel = 'selected="true"';
																}
															}
														?>
															<option value="<?=@$dy?>" <?=@$sel?>><?=@$sr?></option>
														<?php } ?>
													</select>
												</td>
												<?php } else if($pem[0]->type_tampil == 'text_area'){ ?>
													<td colspan="4">
														<input type="hidden" name="type_tampil[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$pem[0]->type_tampil?>">
														<textarea name="nilai[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" style="width:100%"><?=@$nilainya?></textarea>
													</td>
												<?php } else { ?>
													<td <?=@$bck?>>
														<input type="hidden" name="type_tampil[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$pem[0]->type_tampil?>">
														<input type="text" name="nilai[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$nilainya?>">
													</td>
												<?php } ?>
												<input type="hidden" name="samakannilai[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$nilainya?>">
										
										<?php
											$hitung[] = 1;
										?>
										<?php if($pem[0]->type_tampil != 'text_area'){ ?>
										<td <?=@$bck?>><?=@$bintangkejora?></td>
										<td <?=@$bck?>><?=@$pem[0]->satuan?></td>
										<td <?=@$bck?>><?=@$pem[0]->nilai_rujukan?></td>
										<?php } ?>
										<td><div align="right"><button class="btn btn-mini" type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;"  onclick="tampilkanhistory('<?=@$hsm->id_pem?>', '<?=@$hsm->nm_pem?>', '<?=@$_GET['kode_transaksi']?>')"><i class="icon-folder-open" style="opacity:0.5;"></i> Lihat History</button></div></td>
										<?php 
											//end set header N
											} 
										?>
									</tr>
									<?php
										//nah sekarang tambahkan data yang ada kontrol normalnya ayaa
										if($pem[0]->kontrol_normal == 'Y'){
									?>
									<tr>
										<td></td>
										<td>KONTROL <?=@STRTOUPPER($pem[0]->nm_pem)?></td>
										<td>
											<input type="text" name="kontrol_normal[<?=@$sju->id_reg_pem?>][<?=@$hsm->id_pem?>]" value="<?=@$kontrolhasil?>"><b style="font-size:20px;"></b>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>
			</table>
		</div>
	<?php } ?>
	
	
	
	
<?php } ?>
	
	
	<?php if(isset($cekgambarandarahtepi[$iddarahtepi])){ ?>
	<div title="Gambaran Darah Tepi">
		<table class="tableeasyui" style="width:100%">
				<td STYLE="height:10px;width:15%">Eritrosit</td>
				<td colspan="4">
					<textarea style="width:99%;height:40px;" name="darahtepi[a]"><?=@$isidarahtepi['a']?></textarea>
				</td>
			</tr>
			<tr>
				<td STYLE="height:10px;">Leukosit</td>
				<td colspan="4">
					<textarea style="width:99%;height:40px;" name="darahtepi[b]"><?=@$isidarahtepi['b']?></textarea>
				</td>
			</tr>
			<tr>
				<td STYLE="height:10px;">Trombosit</td>
				<td colspan="4">
					<textarea style="width:99%;height:40px;" name="darahtepi[c]"><?=@$isidarahtepi['c']?></textarea>
				</td>
			</tr>
			<tr>
				<td STYLE="height:10px;">Kesimpulan</td>
				<td colspan="4">
					<textarea style="width:99%;height:40px;" name="darahtepi[d]"><?=@$isidarahtepi['d']?></textarea>
				</td>
			</tr>
			<tr>
				<td STYLE="height:10px;">Saran</td>
				<td colspan="4">
					<textarea style="width:99%;height:40px;" name="darahtepi[e]"><?=@$isidarahtepi['e']?></textarea>
				</td>
			</tr>
		</table>
	</div>
	<?php } ?>
	</div>
	
	
	
	
	
	<table class="tableeasyui" style="width:100%">
		<tr> 
				<td colspan="10"><hr style="border:solid 1px #cccccc;"/></td>
			</tr>
		<tr style="display:none;">
				<td><b></b></td>
					<td STYLE="height:10px;"><b>KESIMPULAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="kesimpulan_pemeriksaan"><?=@$kjksd->kesimpulan_pemeriksaan?></textarea></td>
				</tr>
				<tr style="display:none;">
					<td><b></b></td>
					<td STYLE="height:10px;"><b>SARAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="saran_pemeriksaan"><?=@$kjksd->saran_pemeriksaan?></textarea></td>
				</tr>
				<tr>
					<td><b></b></td>
					<td STYLE="height:10px;"><b>DIAGNOSA</b></td>
					<td colspan="4"><div id="divuntukdiagnosapenyakit"></div></td>
				</tr>
		<?php if($pangkasnoreg == "D"){ ?>
			<tr>
					<td><b></b></td>
					<td><b>STAKES</b></td>
					<td>
						<?php
								//$this->db->select('id_pre, nm_pre');
								$this->db->order_by('nm_stakes', 'ASC');
								$cmb1 = $this->db->get('tb_stakes');
								$cmb1 = $cmb1->result();
							?>
							<select name="stakes"  style="width:50%">
							<option value=""></option>
							<?php 
								foreach($cmb1 as $va){ 
								$sel = "";
								if($kjksd){
									if($kjksd->val_stakes == $va->nm_stakes){
										$sel = 'selected="true"';
									}
								}
							?>
								<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
							<?php } ?>
							</select>
					</td>
					<td colspan="4"></td>
				</tr>
		<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td colspan="3">
					<a href="javascript:void(0)"  style="margin:2px;" iconCls="icon-save" class="easyui-linkbutton" onclick="simpandetailpemeriksaanpoli()"><b>Simpan</b></a>
					<a href="javascript:void(0)"  style="margin:2px;" iconCls="icon-print" class="easyui-linkbutton" onclick="cetakrapidtest()"><b>Rapid Test</b></a>
					<a href="javascript:void(0)"  style="margin:2px;" iconCls="icon-print" class="easyui-linkbutton" onclick="cetakswabtest()"><b>Swab Antigen</b></a>
					<a href="javascript:void(0)"  style="margin:2px;" iconCls="icon-print" class="easyui-linkbutton" onclick="cetakhasillabdua()"><b>Cetak Mode 1</b></a>
					<a href="javascript:void(0)"  style="margin:2px;" iconCls="icon-print" class="easyui-linkbutton" onclick="cetakhasillabtiga()"><b>Cetak Mode 2</b></a>
					<a href="javascript:void(0)"   style="margin:2px;" iconCls="icon-print" class="easyui-linkbutton" onclick="cetakhasillabempat()"><b>Cetak Mode 2 (Inggris)</b></a>
					<!--<a href="javascript:void(0)"   style="margin:2px;" iconCls="icon-cancel" class="easyui-linkbutton" onclick="buangduplikatdata()"><b>Clear</b></a>-->
				</td>
				<td colspan="2">
					
				</td>
			</tr>
		</table>
</form>
<script type="text/javascript">
	function tampilkanhistory(id, nm, kode_transaksi){
		$('#modaltampilkanhistory').window('open');
					$('#modaltampilkanhistory').panel({
						title: 'History Pemeriksaan - '+nm+' - <?=@$_GET['noreg']?>',
						href:'<?=@base_url($this->u1.'/historypemeriksaan')?>/?idpem='+id+'&noreg=<?=@$_GET['noreg']?>',
					});
	}
	
	function cetakrapidtest(){
		window.open('<?=@base_url($this->u1.'/cetakrapid')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
	}
	function cetakswabtest(){
		window.open('<?=@base_url($this->u1.'/cetakantigen')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
	}
	function cetakhasillabdua(){
		window.open('<?=@base_url($this->u1.'/cetaklabframe')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
	}
	function cetakhasillabtiga(){
		window.open('<?=@base_url($this->u1.'/cetaklabframedua')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
	}
	
	function cetakhasillabempat(){
		window.open('<?=@base_url($this->u1.'/cetaklabframedua')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&lang=en', '', 'width=700px,toolbar=no,menubar=no,scrollbars=yes');
	}
	
	function getuntukdiagnosapenyakit(){
		$('#divuntukdiagnosapenyakit').html("Proses...");
		$.post("<?=base_url($this->u1 .'/getuntukdiagnosapenyakit/')?>", {
			kode_transaksi:'<?=@$_GET['kode_transaksi']?>', idins:'<?=@$_GET['idins']?>',
		}, function(response){	
			$('#divuntukdiagnosapenyakit').html(response);
		});
	}
	getuntukdiagnosapenyakit();
	
	function buangduplikatdata(){
				window.open('<?=@base_url($this->u1.'/buangduplikat')?>/?pkey=<?=@$_GET['kode_transaksi']?>');
	}
</script>

