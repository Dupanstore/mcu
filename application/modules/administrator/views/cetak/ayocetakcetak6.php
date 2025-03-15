<?php
	$pididok = is_stakesidtind_kemenkes();
	$impidfr = implode(', ', $pididok);
		
		
	$this->db->select('id_dinas, nm_dinas');
	$cmb1 = $this->db->get('tb_dinas');
	$cmb1 = $cmb1->result();
	if($cmb1){
		foreach($cmb1 as $vd){
			$pids[$vd->id_dinas] = $vd->nm_dinas;
		}
		
	}
	foreach($_GET['id_dinas'] as $dsa){ 
		$hhhsw[$dsa] = $pids[$dsa];
	}
	//print_r($_GET);
	//MARI KITA BUAT LAPORAN
	$kesatuanpanpas = urldecode($_GET['kesatuan_pas']);
	$carabayarpas = urldecode($_GET['cara_bayar']);
	if(isset($_GET['typecetak'])){
		if($_GET['typecetak'] == 'print'){
			echo '
				<script type="text/javascript">
				<!--
				//window.print();
				//-->
				</script>';
		} else if($_GET['typecetak'] == 'excel'){
			$tm = 'lap_kemenkes';
			header("Content-Type:application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	}
		$tglawal = date("d/m/Y", strtotime($_GET['tanggalawal']));
		$tglakhir = date("d/m/Y", strtotime($_GET['tanggalakhir']));
		$que  = " select a.no_filemcu, a.id_paket, a.kode_transaksi, a.no_reg,a.id_reg, a.tgl_awal_reg, b.nip_nrp_nik, b.id_pas, b.tmp_lahir_pas, b.tgl_lhr_pas, b.nm_pas, b.pangkat_pas, b.jabatan_pas, b.id_jawatan, c.nm_jawatan, e.nm_dinas, e.id_dinas, e.ila_medex ";
		$que .= " from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas e, tb_paket f ";
		$que .= " where a.no_reg=b.no_reg ";
		$que .= " and b.id_jawatan=c.id_jawatan ";
		$que .= " and a.id_paket=f.id_paket ";
		$que .= " and b.id_dinas=e.id_dinas ";
		if(@!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['id_jawatan']."' ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		if(!empty($_GET['usia_awal']) and !empty($_GET['usia_akhir'])){
			$que 	.= " and ( a.umur_tahun >= ".$_GET['usia_awal']." and  a.umur_tahun <= ".$_GET['usia_akhir']." ) ";
		}
		$que 	.= " and e.ila_medex IN ('kemenkes') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		$que 	.= " group by a.no_reg";
		$que 	.= " order by a.tgl_awal_reg ASC";
		$nsh = $this->db->query($que);
		//print_r($que);
		//die();
		$abd = $nsh->result();
		
		
		
?>
<style>
	th, td{
			font-size:14px;
			PADDING:3PX;
			border:solid 1px #333333;
			vertical-align:top;
	}
	.bordernone td{
		border:none;
	}
</style>
		<div align="center">
			<h4>
			<?=@urldecode($_GET['judulatas'])?><br />
			<?=@urldecode($_GET['judultengah'])?><br />
			<?=@urldecode($_GET['judulbawah'])?>
			<?php if(isset($_GET['id_dinas'])){ ?>
			<!--<br />(
			<?php  
				echo  implode(", ", $hhhsw);
			?>
			)-->
			<?php } ?>
			</h4>
		</div>
		<table style="width:100%;border-spacing:0;">
			<tr>
				<td width="1%"  style="vertical-align:middle;text-align:center;">NO</td>
				<td  width="10%" style="vertical-align:middle;text-align:center;">KODE</td>
				<td  style="vertical-align:middle;text-align:center;">IDENTITAS</td>
				<td style="vertical-align:middle;text-align:center;">TANGGAL<BR />PERIKSA</td>
				<td style="vertical-align:middle;text-align:center;">BB</td>
				<td style="vertical-align:middle;text-align:center;">TB</td>
				<td style="vertical-align:middle;text-align:center;">TD</td>
				<td style="vertical-align:middle;text-align:center;">RIWAYAT KESEHATAN PRIBADI</td>
				<td style="vertical-align:middle;text-align:center;">RIWAYAT KESEHATAN KELUARGA</td>
				<td style="vertical-align:middle;text-align:center;">ANAMNESA</td>
				<td style="vertical-align:middle;text-align:center;">PEMERIKSAAN DOKTER</td>
				<td style="vertical-align:middle;text-align:center;">EKG</td>
				<td style="vertical-align:middle;text-align:center;">SPIROMETRI</td>
				<td style="vertical-align:middle;text-align:center;">AUDIOMETRI</td>
				<td style="vertical-align:middle;text-align:center;">LABORATORIUM</td>
				<td style="vertical-align:middle;text-align:center;">RADIOLOGI</td>
				<td style="vertical-align:middle;text-align:center;">PAP SMEAR</td>
				<td style="vertical-align:middle;text-align:center;">USG</td>
				<td style="vertical-align:middle;text-align:center;">TREADMILL</td>
				<td style="vertical-align:middle;text-align:center;">KESIMPULAN</td>
				<td style="vertical-align:middle;text-align:center;">SARAN</td>
			</tr>
			<tr>
				<td style="vertical-align:middle;text-align:center;">1</td>
				<td style="vertical-align:middle;text-align:center;">2</td>
				<td style="vertical-align:middle;text-align:center;">3</td>
				<td style="vertical-align:middle;text-align:center;">4</td>
				<td style="vertical-align:middle;text-align:center;">5</td>
				<td style="vertical-align:middle;text-align:center;">6</td>
				<td style="vertical-align:middle;text-align:center;">7</td>
				<td style="vertical-align:middle;text-align:center;">8</td>
				<td style="vertical-align:middle;text-align:center;">9</td>
				<td style="vertical-align:middle;text-align:center;">10</td>
				<td style="vertical-align:middle;text-align:center;">11</td>
				<td style="vertical-align:middle;text-align:center;">12</td>
				<td style="vertical-align:middle;text-align:center;">13</td>
				<td style="vertical-align:middle;text-align:center;">14</td>
				<td style="vertical-align:middle;text-align:center;">15</td>
				<td style="vertical-align:middle;text-align:center;">16</td>
				<td style="vertical-align:middle;text-align:center;">17</td>
				<td style="vertical-align:middle;text-align:center;">18</td>
				<td style="vertical-align:middle;text-align:center;">19</td>
				<td style="vertical-align:middle;text-align:center;">20</td>
				<td style="vertical-align:middle;text-align:center;">21</td>
			</tr>
		<?php
				$nk=1;
				
				foreach($abd as $bs){
					
					
					$judh = "select nama_pemeriksaan_khusus, hasilnya from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$bs->kode_transaksi."' and  apakah_pemeriksaan_khusus='Y' ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					if($dswew){
						foreach($dswew as $gdb){
							$pemkhususnya[$bs->id_reg][$gdb->nama_pemeriksaan_khusus] = $gdb->hasilnya;
							//saatnya pecah untuk riwayat pasien duluuuuuuu
							$vdsdf = explode('___', $gdb->nama_pemeriksaan_khusus);
							if($vdsdf[0] == "riwayatpasien"){
								if($vdsdf[1] == "Lain-Lain" OR $vdsdf[1] == "Lainnya"){
									if($vdsdf[1] == "Lainnya"){
										if(!empty($gdb->hasilnya)){
											$looppribadi[$bs->kode_transaksi]['Lainnya'] = 'Lainnya: '.$gdb->hasilnya;
										}
									}
								}else{
									$looppribadi[$bs->kode_transaksi][$vdsdf[0]] = $vdsdf[1];
								}
							}
							
							$hhsbd = explode('___', $gdb->nama_pemeriksaan_khusus);
							if($hhsbd[0] == "riwayatkeluarga"){
								if($hhsbd[1] == "Lain-Lain" OR $hhsbd[1] == "Lainnya"){
									if($hhsbd[1] == "Lainnya"){
										if(!empty($gdb->hasilnya)){
											$loopkeluarga[$bs->kode_transaksi]['Lainnya'] = 'Lainnya: '.$gdb->hasilnya;
										}
									}
								}else{
									$loopkeluarga[$bs->kode_transaksi][$hhsbd[0]] = $hhsbd[1];
								}
							}
							
						}
					}
					
					$nofilll1 = explode("/", $bs->no_filemcu);
					$nofilll2 = $nofilll1[0];
					$kuku = "-";
					$kaka = $nofilll2;
					
				
					
					//ambil data resumnya yaaa
					$oiu = "select isi_anamnesa, ket_resume, nama_kesansaran, isi_kesansaran, apakah_stakessaran from tb_resume_pasien where  kode_transaksi='".clean_data($bs->kode_transaksi)."' ";
					$aew = $this->db->query($oiu);
					$mdn = $aew->result();
					//print_r($mdn);
						if($mdn){
							foreach($mdn as $sa){
								if($sa->ket_resume == "kesimpulansaran"){	
									$kesansaran[$bs->id_reg][$sa->nama_kesansaran] = $sa->isi_kesansaran;
									$keterangan[$bs->id_reg][$sa->nama_kesansaran] = $sa->isi_kesansaran;	
								}else{
									unset($kesansaran[$bs->id_reg]);
									unset($keterangan[$bs->id_reg]);
								}
								
								$anamnesapass[$bs->id_reg][$sa->ket_resume] = $sa->isi_anamnesa;
								
								//stakessss
								if($sa->apakah_stakessaran == "Y"){
									if(!empty($sa->isi_kesansaran)){
										$stakessaranloop[$bs->id_reg][trim(trim($sa->isi_kesansaran))] = trim(trim($sa->isi_kesansaran));
									}
								}
								
								$kondisipasienstakes[$bs->id_reg][trim(trim($sa->nama_kesansaran))] = trim(trim($sa->isi_kesansaran));
							}
						}
					$so=$nk++;
					
					
					$kesimpulanekg = "-";
					$kesimpulanspiro = "-";
					$kesimpulanaudio = "-";
					$kesimpulanlab = "D.B.N";
					$kesimpulanradio = "D.B.N";
					$kesimpulanpapsmear = "-";
					$kesimpulanusg = "-";
					$kesimpulantreadmill = "-";
					
					
					$kesimpulanjantung = "-";
					$kesimpulanparu = "-";
					$kesimpulanbedah = "-";
					$kesimpulantht = "-";
					$kesimpulanmata = "-";
					$kesimpulansyaraf = "-";
					$kesimpulangigi = "-";
					$kesimpulandalam = "-";
					
					
					$judh = "select id_tind_pem, kesimpulan_pemeriksaan from tb_register_pemeriksaan where kode_transaksi='".$bs->kode_transaksi."' and  id_tind_pem IN (".$impidfr.") ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					//print_r($judh);
					if($dswew){
						foreach($dswew as $gdb){
							if($gdb->id_tind_pem == "6555"){
								$kesimpulanekg = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6579"){
								$kesimpulanspiro = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6586"){
								$kesimpulanaudio = $gdb->kesimpulan_pemeriksaan;
							}
							
							if($gdb->id_tind_pem == "6591"){
								$kesimpulanpapsmear = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6646"){
								$kesimpulanusg = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6556"){
								$kesimpulantreadmill = $gdb->kesimpulan_pemeriksaan;
							}
							
							if($gdb->id_tind_pem == "6548"){
								$kesimpulanbedah = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6583"){
								$kesimpulantht = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6564"){
								if(!empty($gdb->kesimpulan_pemeriksaan)){
									$kesimpulanmata = $gdb->kesimpulan_pemeriksaan;
								}
							}
							if($gdb->id_tind_pem == "6651"){
								if(!empty($gdb->kesimpulan_pemeriksaan)){
									$kesimpulanmata = $gdb->kesimpulan_pemeriksaan;
								}
							}
							if($gdb->id_tind_pem == "6574"){
								$kesimpulansyaraf = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6549"){
								$kesimpulangigi = $gdb->kesimpulan_pemeriksaan;
							}
							if($gdb->id_tind_pem == "6592"){
								$kesimpulandalam = $gdb->kesimpulan_pemeriksaan;
							}
							
						}
					}
					
					
					$this->db->select('isi_kelainan');
					$this->db->where('ket_resume', 'diagnosakelainan');
					$this->db->where('nama_kelainan', 'Laboratorium');
					$this->db->where('kode_transaksi', $bs->kode_transaksi);
					$sssa = $this->db->get('tb_resume_pasien');
					$respas = $sssa->row();
					if($respas){
						if(!empty($respas->isi_kelainan)){
							$kesimpulanlab = $respas->isi_kelainan;
						}
					}
					
					$this->db->select('kesimpulan_kelainan');
					$this->db->where('ket_resume', 'diagnosakelainan');
					$this->db->where('nama_kelainan', 'Rontgen');
					$this->db->where('kode_transaksi', $bs->kode_transaksi);
					$sssa = $this->db->get('tb_resume_pasien');
					$respas = $sssa->row();
					if($respas){
						if(!empty($respas->kesimpulan_kelainan)){
							$kesimpulanradio = $respas->kesimpulan_kelainan;
						}
					}
					
					
					//untuk jantung dan paruuuu
					$hgdgf = "select id_pem_deb, hasilnya, ketkelainanlainnya from tb_register_detailpemeriksaan where kode_transaksi='".$bs->kode_transaksi."' and id_pem_deb IN (185, 186) ";
					$gvdhf = $this->db->query($hgdgf);
					$gvddf = $gvdhf->result();
					foreach($gvddf as $gdvvf){
						if($gdvvf->id_pem_deb == 185){
							if(!empty($gdvvf->hasilnya)){
								if(!empty($gdvvf->ketkelainanlainnya)){
									$kesimpulanjantung = $gdvvf->ketkelainanlainnya;
								}else{
									$kesimpulanjantung = $gdvvf->hasilnya;
								}
							}
						}
						if($gdvvf->id_pem_deb == 186){
							if(!empty($gdvvf->hasilnya)){
								if(!empty($gdvvf->ketkelainanlainnya)){
									$kesimpulanparu = $gdvvf->ketkelainanlainnya;
								}else{
									$kesimpulanparu = $gdvvf->hasilnya;
								}
							}
						}
					}
		?>
		
		<tr>
			<td><div align="center"><?=@$so?></div></td>
			<td style="vertical-align:top;text-align:center;"><?=@$kaka?></td>
			<td>
				<?=@$bs->nm_pas?><br />
				<?=@$bs->pangkat_pas?>/<?=@$bs->nip_nrp_nik?><BR />
				<?=@$bs->nm_jawatan?><BR /><?=@trim($bs->jabatan_pas)?><br />
				<?=@get_umur_laporan($bs->tgl_lhr_pas, $bs->tgl_awal_reg)?>/<?=@$bs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($bs->tgl_lhr_pas))?>
			</td>
			<td>
				<?=@strtoupper(trim(date("d/m/Y", strtotime($bs->tgl_awal_reg))))?>
			</td>
			<td>
				<?=@$pemkhususnya[$bs->id_reg]['beratbadan']?>
			</td>
			<td>
				<?=@$pemkhususnya[$bs->id_reg]['tinggibadan']?>
			</td>
			<td>
				<?=@$pemkhususnya[$bs->id_reg]['tekanan_darah1']?>/<?=@$pemkhususnya[$bs->id_reg]['tekanan_darah2']?>
			</td>
			<td>
				<?=@implode(", ", $looppribadi[$bs->kode_transaksi])?>
			</td>
			<td>
				<?=@implode(", ", $loopkeluarga[$bs->kode_transaksi])?>
			</td>
			<td>
				<?=@$anamnesapass[$bs->id_reg]['anamnesa']?>
			</td>
				
			<td>
				<table style="width:100%">
					<tr>
						<td style="border:none;width:1px;">1.</td>
						<td style="border:none;">Jantung</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulanjantung?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">2.</td>
						<td style="border:none;">P. Dalam</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulandalam?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">3.</td>
						<td style="border:none;">Bedah</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulanbedah?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">4.</td>
						<td style="border:none;">Paru</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulanparu?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">5.</td>
						<td style="border:none;">THT</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulantht?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">6.</td>
						<td style="border:none;">Mata</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulanmata?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">7.</td>
						<td style="border:none;">Syaraf</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulansyaraf?></td>
					</tr>
					<tr>
						<td style="border:none;width:1px;">8.</td>
						<td style="border:none;">Gigi</td>
						<td style="border:none;">:</td>
						<td style="border:none;"><?=@$kesimpulangigi?></td>
					</tr>
				
				</table>
			</td>
			<td>
				<?=@$kesimpulanekg?>
			</td>
			<td>
				<?=@$kesimpulanspiro?>
			</td>
			<td>
				<?=@$kesimpulanaudio?>
			</td>
			<td>
				<?=@$kesimpulanlab?>
			</td>
			<td>
				<?=@$kesimpulanradio?>
			</td>
			<td>
				<?=@$kesimpulanpapsmear?>
			</td>
			<td>
				<?=@$kesimpulanusg?>
			</td>
			<td>
				<?=@$kesimpulantreadmill?>
			</td>
			<td>
				<table style="border:none;">
				<?php
					$sfghs = unserialize($kesansaran[$bs->id_reg]['kesimpulan']);
					$no=0;
					foreach(range(1,10) as $gsdd){ 
						$nb=$no++;
						if($sfghs[$gsdd] !=""){
							echo '<tr><td style="border:none;">'.$sfghs[$gsdd].'</td></tr>';
						}
					} 
				?>
				</table>
			</td>
			<td>
				<table style="border:none;">
				<?php
					$sfghs = unserialize($kesansaran[$bs->id_reg]['saran']);
					$no=0;
					foreach(range(1,10) as $gsdd){ 
						$nb=$no++;
						if($sfghs[$gsdd] !=""){
							echo '<tr><td style="border:none;">'.$sfghs[$gsdd].'</td></tr>';
						}
					} 
				?>
				</table>
			</td>
		</tr>
	<?php } ?>
	</table>
