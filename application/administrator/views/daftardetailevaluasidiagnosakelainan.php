<?php
	$pangkasnoreg = substr($_GET['no_reg'],0,1);
	$sga = "select a.val_stakes, a.kesimpulan_pemeriksaan, a.saran_pemeriksaan, b.id_tind, b.nm_tind, b.id_ins_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan, e.order_evalusi_group from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
	$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
	$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
	$sfc = $this->db->query($sga);
	$ash = $sfc->result();
	//print_r($ash);
	
	$nomorurtkesann=1;
	if($ash){
		foreach($ash as $bs){
			//ambil untuk inbody yaaaa
			/*$svfv = "select hasilnya from  tb_register_detailpemeriksaan where kode_transaksi='".$_GET['kode_transaksi']."' and id_paket='".$_GET['id_paket']."' and id_tind_detpem='".$bs->id_tind."' and nama_pemeriksaan_khusus='inbody' limit 1";
			$sfga = $this->db->query($svfv);
			$svac = $sfga->row();
			//print_r($svac);
			if($svac){
				if($svac->hasilnya <> ""){
					$looperror1[$bs->id_tind][$svac->hasilnya] = $svac->hasilnya;
					if($bs->stakes_tindakan != ""){
						$awalstakes[$bs->stakes_tindakan][$bs->nm_tind] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->stakes_tindakan][$bs->nm_tind] = "Tindakan";
						$awalstakes2[$bs->stakes_tindakan][$bs->nm_tind] = $bs->order_evaluasi;
						$awalstakes3[$bs->stakes_tindakan][$bs->nm_tind] = $bs->nm_ins;
						$awalstakes4[$bs->stakes_tindakan][$bs->nm_tind] = implode(", ", $looperror1[$bs->id_tind]);
					}else {
						$awalstakes[$bs->set_stakes][$bs->nm_ins] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->set_stakes][$bs->nm_ins] = "Instalasi";
						$awalstakes2[$bs->set_stakes][$bs->nm_ins] = $bs->order_evaluasi;
						$awalstakes3[$bs->set_stakes][$bs->nm_ins] = $bs->nm_ins;
						$awalstakes4[$bs->set_stakes][$bs->nm_ins] = implode(", ", $looperror1[$bs->id_tind]);
					}
				}
			}*/
			
			//ambil untuk kelainan gigi yang tabel kotak2
			/*$jkab = "select posisi_struktur_gigi, hasilnya from  tb_register_detailpemeriksaan where kode_transaksi='".$_GET['kode_transaksi']."' and id_paket='".$_GET['id_paket']."' and id_tind_detpem='".$bs->id_tind."' and apakah_struktur_gigi='Y' and adakelainan='Y' ";
			$agst = $this->db->query($jkab);
			$sbdg = $agst->result();
			//print_r($sbdg);
			if($sbdg){
				foreach($sbdg as $vsa){
					$looperror1[$bs->id_tind][$vsa->posisi_struktur_gigi] = $vsa->posisi_struktur_gigi .":". $vsa->hasilnya;
					if($bs->stakes_tindakan != ""){
						$awalstakes[$bs->stakes_tindakan][$bs->nm_tind] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->stakes_tindakan][$bs->nm_tind] = "Tindakan";
						$awalstakes2[$bs->stakes_tindakan][$bs->nm_tind] = $bs->order_evaluasi;
						$awalstakes3[$bs->stakes_tindakan][$bs->nm_tind] = $bs->nm_ins;
						$awalstakes4[$bs->stakes_tindakan][$bs->nm_tind] = implode(", ", $looperror1[$bs->id_tind]);
					}else {
						$awalstakes[$bs->set_stakes][$bs->nm_ins] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->set_stakes][$bs->nm_ins] = "Instalasi";
						$awalstakes2[$bs->set_stakes][$bs->nm_ins] = $bs->order_evaluasi;
						$awalstakes3[$bs->set_stakes][$bs->nm_ins] = $bs->nm_ins;
						$awalstakes4[$bs->set_stakes][$bs->nm_ins] = implode(", ", $looperror1[$bs->id_tind]);
					}
				}
			}
			*/
			
			
			$hsbb = "select a.apakah_pemeriksaan_khusus, a.nama_pemeriksaan_khusus, a.hasilnya, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, d.id_ins from tb_register_detailpemeriksaan a left join tb_pemeriksaan c on a.id_pem_deb=c.id_pem inner join tb_instalasi d on a.id_ins_tind_detpem=d.id_ins ";
			$hsbb .= "where  1=1  ";
			$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.adakelainan='Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' ";
			$ansd = $this->db->query($hsbb);
			$ssv = $ansd->result();
			if($ssv){
					
					foreach($ssv as $afsr){
						$sgkdof = $nomorurtkesann++;
						//echo $sgkdof ."<hr />";
						$hasilkelainan = $afsr->hasilnya;
							if($afsr->hasilnya == "Lainnya"){
								if($afsr->ketkelainanlainnya != ""){
									$hasilkelainan = $afsr->ketkelainanlainnya;
								} else {
									$hasilkelainan = $afsr->hasilnya;
								}
							}
							//dipisah yaa
							$periksa = $afsr->det_nm_pemeriksaan;
							if($afsr->id_ins == '2'){
								//print_r($afsr);
								$periksa = $afsr->nm_pem;
							}
							if($afsr->id_ins == '3'){
								$periksa = $afsr->rad_namapemeriksaan;
							}
							if($afsr->apakah_pemeriksaan_khusus == 'Y'){
								$periksa = is_keteranganfisikkhusus($afsr->nama_pemeriksaan_khusus);
								$expldd = explode("___", $afsr->nama_pemeriksaan_khusus);
								if($expldd[0] == "riwayatpasien"){
									$periksa = "Riwayat Kesehatan Pasien";
									$sgkdof = 'riwayatpasien';
									if($expldd[1] == "Lainnya"){
										$expldd[1] = $afsr->hasilnya;
									}
									$getkelainanoks['riwayatpasien'][] = $expldd[1];
									$hasilkelainan = "(". implode(", ", $getkelainanoks['riwayatpasien']) .")";
								}
								
								if($expldd[0] == "riwayatkeluarga"){
									$periksa = "Riwayat Kesehatan Keluarga";
									$sgkdof = 'riwayatkeluarga';
									$getkelainanoks['riwayatkeluarga'][] = $expldd[1];
									$hasilkelainan = "(". implode(", ", $getkelainanoks['riwayatkeluarga']) .")";
								}
							}
							$looperror1[$bs->id_tind][$sgkdof] = $periksa .": ". $hasilkelainan;
							if($periksa == "Tekanan Darah" OR $periksa == "IMT"){
								$generateerrordiagnosa[$bs->id_tind][$sgkdof] = $periksa .": ". $hasilkelainan;
							}
							$looperrorx[$bs->nm_ins][$sgkdof] = $periksa .": ". $hasilkelainan;
					}	


				$sebelumtambahan = "";
				if(is_array($generateerrordiagnosa[$bs->id_tind])){
					$sebelumtambahan = implode(", ", $generateerrordiagnosa[$bs->id_tind]) ." ";
				}
				if($bs->id_ins == "3"){
					$awalstakes[$bs->set_stakes][$bs->nm_grouptindakan] = $bs->val_stakes;
					$kesimpulanperiksa[$bs->set_stakes][$bs->nm_grouptindakan] = $sebelumtambahan . $bs->kesimpulan_pemeriksaan;
					$saranperiksa[$bs->set_stakes][$bs->nm_grouptindakan] = $bs->saran_pemeriksaan;
					$awalstakes1[$bs->set_stakes][$bs->nm_grouptindakan] = "Group Tindakan";
					$awalstakes2[$bs->set_stakes][$bs->nm_grouptindakan] = $bs->order_evalusi_group;
					$awalstakes3[$bs->set_stakes][$bs->nm_grouptindakan] = $bs->nm_grouptindakan;
					$awalstakes4[$bs->set_stakes][$bs->nm_grouptindakan] = implode(", ", $looperror1[$bs->id_tind]);
				} else if($bs->id_ins == "2"){
						$awalstakes[$bs->set_stakes][$bs->nm_ins] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->set_stakes][$bs->nm_ins] = $sebelumtambahan . $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->set_stakes][$bs->nm_ins] = "Instalasi";
						$awalstakes2[$bs->set_stakes][$bs->nm_ins] = $bs->order_evaluasi;
						$awalstakes3[$bs->set_stakes][$bs->nm_ins] = $bs->nm_ins;
						$awalstakes4[$bs->set_stakes][$bs->nm_ins] = "". implode(", ", $looperrorx[$bs->nm_ins]);
				} else {
					if($bs->stakes_tindakan != ""){
						$awalstakes[$bs->stakes_tindakan][$bs->nm_tind] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $sebelumtambahan .  $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->stakes_tindakan][$bs->nm_tind] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->stakes_tindakan][$bs->nm_tind] = "Tindakan";
						$awalstakes2[$bs->stakes_tindakan][$bs->nm_tind] = $bs->order_evaluasi;
						$awalstakes3[$bs->stakes_tindakan][$bs->nm_tind] = $bs->nm_ins;
						$awalstakes4[$bs->stakes_tindakan][$bs->nm_tind] = implode(", ", $looperror1[$bs->id_tind]);
					}else {
						$awalstakes[$bs->set_stakes][$bs->nm_ins] = $bs->val_stakes;
						$kesimpulanperiksa[$bs->set_stakes][$bs->nm_ins] = $sebelumtambahan . $bs->kesimpulan_pemeriksaan;
						$saranperiksa[$bs->set_stakes][$bs->nm_ins] = $bs->saran_pemeriksaan;
						$awalstakes1[$bs->set_stakes][$bs->nm_ins] = "Instalasi";
						$awalstakes2[$bs->set_stakes][$bs->nm_ins] = $bs->order_evaluasi;
						$awalstakes3[$bs->set_stakes][$bs->nm_ins] = $bs->nm_ins;
						$awalstakes4[$bs->set_stakes][$bs->nm_ins] = implode(", ", $looperror1[$bs->id_tind]);
					}
				}
				//print_r($awalstakes4);
			}
		}
		
		
		//print_r($generateerrordiagnosa);
		
		//saatnya looping untuk menampilkan
		foreach($awalstakes as $mk => $aq){
			//$bsa = max($aq);
			//kalau ngrubah disini...yang atas cuma referensi data tok
			//$bsa = 'sssssssssssssssssssss';
			foreach($aq as $op => $av){
				//if($av == $bsa){
					$poll = $awalstakes3[$mk][$op];
					$sff = array("poliklinik", "poli", "pemeriksaan", "periksa", "Poliklinik", "Pemeriksaan", "Periksa");
					$sfa = array("", "", "", "");
					$sdaa = str_replace($sff, $sfa,  $poll);
					//disini membuat stakes pernama cuma diambil 1 tok
					$lopingngnya1[$awalstakes2[$mk][$op]. $mk] = $sdaa;
					$lopingngnya2[$awalstakes2[$mk][$op] . $mk] = $mk;
					$lopingngnya3[$awalstakes2[$mk][$op] . $mk] = $av;
					$lopingngnya4[$awalstakes2[$mk][$op] . $mk] = $awalstakes2[$mk][$op];
					$lopingngnya5[$awalstakes2[$mk][$op] . $mk] = $awalstakes4[$mk][$op];
					$lopingngnya6[$awalstakes2[$mk][$op] . $mk] = $kesimpulanperiksa[$mk][$op];
					$lopingngnya7[$awalstakes2[$mk][$op] . $mk] = $saranperiksa[$mk][$op];
				//}
			}
		}
		//print_r($);die();
		//print_r($lopingngnya7);
	}
	
	//print_r($lopingngnya4);
		$this->db->where('ket_resume', 'diagnosakelainan');
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		//$this->db->limit('1');
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->result();
		//mari kita looping
		foreach($respas as $sga){
			
			$lekapk1[$sga->kelainan_key] = $sga->kelainan_key;
			$lekapk2[$sga->kelainan_key] = $sga->urut_kelainan;
			$lekapk3[$sga->kelainan_key] = $sga->huruf_stakes;
			$lekapk4[$sga->kelainan_key] = $sga->nama_kelainan;
			$lekapk5[$sga->kelainan_key] = $sga->isi_kelainan;
			$lekapk6[$sga->kelainan_key] = $sga->stakes_kelainan;
			$lekapk7[$sga->kelainan_key] = $sga->kesimpulan_kelainan;
			$lekapk8[$sga->kelainan_key] = $sga->saran_kelainan;
			$lekapkx[$sga->kelainan_key] = $sga->aktif_diagnosakelainan;
		}
		//print_r($lekapk5);
?>
<?php if(!$respas){ ?>
	<table class="tableeasyui" style="width:100%">
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Diagnosa/Kelainan Belum Tersimpan</div></b></td>
	</tr>
	</table>
	<?php } ?>
<form method="POST" id="detaildiagnosakelainan_form1">
<input type="hidden" name="kode_transaksi_resume" value="<?=@$_GET['kode_transaksi']?>">
<table class="tableeasyui" style="width:100%">
	<tr>
		<td width="1%" style="background:#CDDEF0;"></td>
		<td width="1%" style="background:#CDDEF0;" colspan="2">Kode</td>
		<td style="background:#CDDEF0;">Pemeriksaan</td>
		<td style="background:#CDDEF0;">Diagnosa/Kelainan</td>
		<td style="background:#CDDEF0;">Kesimpulan</td>
		<td style="background:#CDDEF0;">Saran</td>
		<?php if($pangkasnoreg == "D"){ ?>
		<td style="background:#CDDEF0;" width="8%">Stakes</td>
		<?php } ?>
	</tr>
	<?php
		asort($lopingngnya4);
		//print_r($lopingngnya4);
		foreach($lopingngnya4 as $vb => $sb){
			$dg = $sb;
			if($dg < 10){
				$dg = "0".$dg;
			}
			$isikelainan = $lopingngnya5[$vb];
			$isikelainanrealtime = $lopingngnya5[$vb];
			$kesimpulane = $lopingngnya6[$vb];
			$sarane = $lopingngnya7[$vb];
			$stakes_kelainan = $lopingngnya3[$vb];
			if(!$respas){
				$sgaj = 'checked="true"';
			}else{
				if(isset($lekapk1[$dg. $lopingngnya2[$vb]])){
					if($lekapkx[$dg. $lopingngnya2[$vb]] != "N"){
						$sgaj = 'checked="true"';
					}else{
						$sgaj = '';
					}
					$isikelainan = $lekapk5[$dg.$lopingngnya2[$vb]];
					$kesimpulane = $lekapk7[$dg.$lopingngnya2[$vb]];
					$sarane = $lekapk8[$dg.$lopingngnya2[$vb]];
					$stakes_kelainan = $lekapk6[$dg.$lopingngnya2[$vb]];
				}else {
					$sgaj = '';
				}
			}
			
			//print_r($sarane);
			
	?>
	<input type="hidden" name="urut_kelainan[<?=@$dg?><?=@$lopingngnya2[$vb]?>]" value="<?=@$dg?>">
	<input type="hidden" name="huruf_stakes[<?=@$dg?><?=@$lopingngnya2[$vb]?>]" value="<?=@$lopingngnya2[$vb]?>">
	<input type="hidden" name="nama_kelainan[<?=@$dg?><?=@$lopingngnya2[$vb]?>]" value="<?=@$lopingngnya1[$vb]?>">
	<input type="hidden" name="stakes_kelainan[<?=@$dg?><?=@$lopingngnya2[$vb]?>]" value="<?=@$lopingngnya3[$vb]?>">
	<tr>
		<td><input type="checkbox" name="kelainan_key[<?=@$dg?><?=@$lopingngnya2[$vb]?>]" <?=@$sgaj?> value="<?=@$dg?><?=@$lopingngnya2[$vb]?>"></td>
		<td><?=@$dg?></td>
		<td width="1%"><?=@$lopingngnya2[$vb]?></td>
		<td>
			<?php
				$tmpilnama = $lopingngnya1[$vb];
				if(trim(trim(trim($lopingngnya1[$vb]))) == "Umum" and trim(trim(trim($lopingngnya2[$vb]))) == "L"){
					$tmpilnama = 'Kulit';
				}
				if(trim(trim(trim($lopingngnya1[$vb]))) == "Umum" and trim(trim(trim($lopingngnya2[$vb]))) == "B"){
					$tmpilnama = 'Bedah';
				}
			?>
		<?=@$tmpilnama?>
		</td>
		<td>
			<?php 
				echo "
					<textarea readonly='true' style='width:95%;height:60px;background:#eeefff;display:none;' name='diagnosa_kelainan_realtime[".$dg. $lopingngnya2[$vb]."]'>". $isikelainanrealtime ."</textarea>
					<textarea readonly='true' style='width:95%;height:60px;background:#eeefff' name='isi_kelainan[".$dg. $lopingngnya2[$vb]."]'>". $isikelainan ."</textarea>
					";
			?>
		</td>
		<td>
			<?php 
				echo "<textarea style='width:95%;height:60px;' name='isi_kesimpulan[".$dg. $lopingngnya2[$vb]."]'>". $kesimpulane ."</textarea>";
			?>
		</td>
		<td>
			<?php 
				echo "<textarea style='width:95%;height:60px;' name='isi_saran[".$dg. $lopingngnya2[$vb]."]'>". $sarane ."</textarea>";
			?>
		</td>
		<?php if($pangkasnoreg == "D"){ ?>
		<td><div align="center"><?=@$stakes_kelainan?></td>
		<?php } ?>
	</tr>
	<?php } ?>
</table>
</form>
<hr style="border:#eeeeee;margin:5px;"/>
<div style="padding:10px;">
<button style="cursor:pointer" type="button" onclick="simpandiagnosakelainan()" style="width:100%;">Simpan Diagnosa/Kelainan</button>
<?php if($respas){ ?>
	<button style="cursor:pointer" type="button" onclick="sinkronulangpemeriksaan()" style="width:100%;">Sinkron Ulang</button>
<?php } ?>
</div>
<script type="text/javascript">
function simpandiagnosakelainan(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk melanjutkan', function(r) {
				if (r){
					$('#detaildiagnosakelainan_form1').form('submit', {  
						url:'<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpandetaildiagnosakelainan')?>/?sinkronulang=N',
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panel_detailevaluasi_diagnosakelainan').panel({
									href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/<?=@$this->u3?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$_GET['no_reg']?>',
								});
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
		
function sinkronulangpemeriksaan(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk sinkornasi ulang diagnosa kelainan dengan hasil pemeriksaan terbaru', function(r) {
				if (r){
					$('#detaildiagnosakelainan_form1').form('submit', {
						url:'<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpandetaildiagnosakelainan')?>/?sinkronulang=Y',
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panel_detailevaluasi_diagnosakelainan').panel({
									href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/<?=@$this->u3?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$_GET['no_reg']?>',
								});
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
</script>