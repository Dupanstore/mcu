<?php
	$dfr = "select a.hasil_darah_tepi, a.no_lab_mcu, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.jenkel_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas, e.tipe_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	//print_r($abs);
	$isidarahtepi = unserialize($abs->hasil_darah_tepi);
	
	$sga = "select a.kesantext, a.val_stakes, b.id_tind, b.kd_tind, b.nm_tind, b.id_ins_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan, e.en_english_group, e.order_evalusi_group, e.kd_grouptindakan from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
	$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
	$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and d.id_ins=2 ";
	$sfc = $this->db->query($sga);
	$ash = $sfc->result();
	//print_r($ash[0]->val_stakes);
	//print_r($ash);
	
	$nolabmcu = "-";
	if($abs->no_lab_mcu > 0){
		$nolabmcu = sprintf("%04s", $abs->no_lab_mcu);
	}
	if($ash){
		foreach($ash as $bs){
			//pertama adalah buat barisnya yaaaaa
			//yang pasti bedakan page kanan dan kiriiii yaaaaa
			//intine page 1 tek buat fix kaya asline
			$hsbb = "select a.hasilnya, a.adakelainan, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, c.kd_pem, c.det_order_pemeriksaan, c.satuan, c.nilai_rujukan, c.in_english_pem, d.id_ins from tb_register_detailpemeriksaan a, tb_pemeriksaan c, tb_instalasi d ";
			$hsbb .= "where a.id_pem_deb=c.id_pem  and a.id_ins_tind_detpem=d.id_ins ";
			$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.apakah_pemeriksaan_khusus <> 'Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' order by c.kd_pem ASC ";
			$ansd = $this->db->query($hsbb);
			$ssv = $ansd->result();
			$nminsnya = strtoupper(str_replace("Poliklinik", "Pemeriksaan", $bs->nm_ins));
			if($bs->id_ins == "2"){
				//yang dihalaman 2 hanya hematologi selain itu dihalaman 3 ya
					//$pages[1]['kiri'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". strtoupper($bs->nm_ins)."</b></span>";	
					$pages[1]['kiri'][$bs->order_evaluasi] = "";	
					$headerpemeriksaan = $bs->nm_grouptindakan;
					if(isset($_GET['lang'])){
						if(!empty($bs->en_english_group)){
							$headerpemeriksaan = $bs->en_english_group;
						}
					}
					$pages1[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span>". strtoupper($headerpemeriksaan)."</span>";
					$pages2[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
					$pages3[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
					foreach($ssv as $hsd){
						if($hsd->nm_pem == "HITUNG JENIS"){
							$hsd->nm_pem = "<b>". $hsd->nm_pem."</b>";
						}
						if($hsd->nm_pem == "Monosit"){
							$hsd->nm_pem = $hsd->nm_pem. "";
						}
						if($hsd->satuan == "-"){
							$hsd->satuan = "";
						}
						if(isset($_GET['lang'])){
							if($this->madmin->rsau_postifif_negatif_en($hsd->hasilnya)){
								$hsd->hasilnya = $this->madmin->rsau_postifif_negatif_en($hsd->hasilnya);
							}
						}
						$bcbjshjsh = $hsd->hasilnya;
						if($hsd->adakelainan == "Y"){
							$bcbjshjsh = "<b>". $hsd->hasilnya."</b>";
							$hsd->adakelainan = "<b style='color:red;font-weight:bold'>*</b>";
						}else{
							$hsd->adakelainan = "";
						}
						
						$cekcttgrp = explode(".", $hsd->kd_pem);
						$pingctrvs = count($cekcttgrp)*15;
						
						$namapemeriksaane = $hsd->nm_pem;
						if(isset($_GET['lang'])){
							if(!empty($hsd->in_english_pem)){
								$namapemeriksaane = $hsd->in_english_pem;
								if($hsd->nm_pem == "<b>HITUNG JENIS</b>"){
									$namapemeriksaane = "<b>". $hsd->in_english_pem."</b>";
								}
							}
						}
						$nilairujukanbaruokmas = $hsd->nilai_rujukan;
						$nillaisatuanokyesmasb = $hsd->satuan;
						$rubaharray1 = array_keys($this->madmin->rsau_postifif_negatif_en(''));
						$rubaharray2 = array_values($this->madmin->rsau_postifif_negatif_en(''));
						
						if(isset($_GET['lang'])){
							$nilairujukanbaruokmas = str_replace($rubaharray1, $rubaharray2, $hsd->nilai_rujukan);
							$nillaisatuanokyesmasb = str_replace($rubaharray1, $rubaharray2, $hsd->satuan);
						}
						$menjoroks = '<span style="<?=@$pingctrvs?>cm"><?=@$pingctrvs?>cm</span>';
						$pages4[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span style='margin-left:".$pingctrvs."px'>".$namapemeriksaane ."</span>";
						$pages5[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$bcbjshjsh."</span>";
						$pages6[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>". $nilairujukanbaruokmas ."</span>";
						$pages7[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->adakelainan ."</span>";
						$pages72[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>". $nillaisatuanokyesmasb ."</span>";
					}
			}
		}
	}
	//print_r($pages4);
	
?>
<style>

#tablenya {
	border:0px;
}
#tablenya td{
	border-left:1px solid;
	padding:2px;
}
#tablenya th{
	border-top:1px solid;
	border-bottom:1px solid;
}
td{
	vertical-align:top;
}
.pddok td{
	padding:0px;
}
.mixhed td{
	padding:1px;
	font-size:12px;
}
.darahtepi td{
	padding:10px 0 10px 0;
}
</style>
<style>
	body {
        width: 100%;
        margin: 0;
        padding: 0;
        background-color: #000000;
        font: 12pt "Helvetica";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 8.5in;
        padding: 5mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        background: white;
        box-shadow: 5px 5px 5px #222222;
    }
    @media print {
		html, body {
		 border: 1px solid white;
		 height: 100%;
		 page-break-after: avoid !important;
		 page-break-before: avoid !important;
	  }
       
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
			box-shadow: 5px 5px 5px #222222;
			page-break-after: auto;
        }
		.breaks{
			page-break-after: auto;
		}	
    }
	@page {
        margin: 0;
    }
	div.page { page-break-after: always }
	
	 header, .header-space,
            footer, .footer-space {
                height: 50px;
                font-weight: bold;
                width: 100%;
                padding: 10pt;
                margin: 10pt 0;
            }

            header {
                position: fixed;
                top: 0;
                border-bottom: 1px solid black;
            }

            footer {
                position: fixed;
                bottom: 0;
                border-top: 1px solid black;
            }
	</style>

<script type="text/javascript">
	window.print();
</script>

<html>
	<head>
		<link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
	</head>
	<body style="background:#777777;">
			<?php 
				$f = range(1,1);
				$akhirpage = 1;
				if($f){ 
					$nm = 1;
					foreach($f as $val){
					$um = $nm++;
					$sgpp = "a4";
			?>
			<div class="page">
											<?php
												$en_nolab = "No Lab.";
												$en_nofile = "No File / Umur";
												$en_noreg = "No Reg";
												$en_nama = "Nama";
												$en_ttl = "Tempat/Tanggal Lahir";
												
												$en_tglpem = "Tanggal Pemeriksaan";
												$en_jenkel = "Jenis Kelamin";
												$en_pngkt = "Pangkat/NRP/NIP";
												$en_kesat = "Kesatuan / Jabatan";
												$en_ppj = "Penanggung Jawab";
												
												$en_hasilpem = "HASIL PEMERIKSAAN";
												$en_nampem = "NAMA PEMERIKSAAN";
												$en_hslk = "HASIL";
												$en_satuan = "SATUAN";
												$en_niruj = "NILAI RUJUKAN";
												
												$jenkelok = is_jenkel($abs->jenkel_pas);
												if(isset($_GET['lang'])){
													
													$en_nolab = "Lab. Number";
													$en_nofile = "File Number / Age";
													$en_noreg = "Reg. Number";
													$en_nama = "Name";
													$en_ttl = "Date of birth";
													
													$en_tglpem = "Examination Date";
													$en_jenkel = "Sex";
													$en_pngkt = "Pangkat/NRP/NIP";
													$en_kesat = "Company/Departement";
													$en_ppj = "Head of Laboratory";
													
													
													$en_hasilpem = "EXAMINATION RESULTS";
													$en_nampem = "EXAMINATION NAME";
													$en_hslk = "RESULTS";
													$en_satuan = "UNIT";
													$en_niruj = "REFERENCE VALUE";
													$jenkelok = is_jenkel_en($abs->jenkel_pas);
												}
											?>
											<table class="pddok" width="100%" style="font-size:12px;font-family: arial;">
												<thead>
												<tr>
													<td colspan="6">
														<table width="100%" style="font-size:12px;font-family: arial;" >
															<tr>
																<td>
																	<table width="100%" style="font-size:13px;border-spacing:0;font-family:arial;margin:5px 0 0 0;" cellpadding="12px" >
																			<tr>
																				<td>
																					<div align="left">
																						<b>
																						<span>MARKAS BESAR ANGKATAN UDARA</span><br/>
																						<span style="border-bottom:solid 1px #000000;padding:0 40px 0 40px;">LAKESPRA <?=@is_fixname()?></span>
																						</b>
																					</div>
																				</td>
																			</tr>
																		</table>
																		<br />
																		<table width="100%" style="font-size:12px;border-spacing:0;font-family: arial;">
																			<tr>
																				<td style="border:solid 1px #000000;width:44%;border-radius:100px;">
																					<table style="width:100%" class="mixhed">
																						<tr>
																							<td width="20%"><?=@$en_nolab?></td>
																							<td >:</td>
																							<td><b style="font-size:16px;"><?=@$nolabmcu?></b></td>
																							
																						</tr><tr>
																							<td width="20%"><?=@$en_nofile?></td>
																							<td width="2%">:</td>
																							<td width="40%"><?=@$abs->no_filemcu?> [<?=@get_umur($abs->tgl_lhr_pas)?>]</td>
																							
																						</tr>
																						<tr>
																							<td><?=@$en_noreg?></td>
																							<td>:</td>
																							<td><?=@$abs->no_reg?></td>
																							
																						</tr>
																						<tr>
																							<td><?=@$en_nama?></td>
																							<td>:</td>
																							<td><?=@$abs->nm_pas?></td>
																							
																						</tr>
																					
																						<tr>
																							<td><?=@$en_ttl?></td>
																							<td>:</td>
																							<td><?=@$abs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($abs->tgl_lhr_pas))?></td>
																							
																						</tr>
																					</table>
																				</td>
																				<td style="width:2%"></td>
																				<td style="border:solid 1px #000000;width:44%;border-radius:100px;">
																					<table style="width:100%" class="mixhed">
																						<tr>
																							<td><?=@$en_tglpem?></td>
																							<td>:</td>
																							<td><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
																						</tr>
																						<tr>
																							<td><?=@$en_jenkel?></td>
																							<td>:</td>
																							<td><?=@$jenkelok?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_pngkt?></td>
																							<td>:</td>
																							<td><?=@$abs->pangkat_pas?>/<?=@$abs->nip_nrp_nik?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_kesat?></td>
																							<td>:</td>
																							<td><?=@$abs->nm_jawatan?> / <?=@$abs->jabatan_pas?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_ppj?></td>
																							<td>:</td>
																							<td><?=@$this->madmin->Get_setting('ttd_lab_nama')?></td>
																						
																						</tr>
																					</table>
																				</td>
																			</tr>
																			
																		</table>
																		<h5 style="margin: 3px 0 3px 0;"><p class="text-left" style="margin:0;"><span style=";font-size:14px;font-family:arial;"><?=@$en_hasilpem?></p></h5>
																</td>
															</tr>
															</table>
													</td>
												</tr>
												<tr STYLE="border-top:solid 1.5px #000000;border-bottom:solid 1.5px #000000;">
													<td><b><?=@$en_nampem?></b></td>
													<td><b><?=@$en_hslk?></b></td>
													<td><b><?=@$en_satuan?></b></td>
													<td><b><?=@$en_niruj?></b></td>
												</tr>
												</thead>
												<tbody>
												<?php 
													ksort($pages[$um]['kiri']);
													foreach($pages[$um]['kiri'] as $ke => $fr){
												?>
												
												<tr><td colspan="3"><?=@$fr?></td></tr>
													<?php 
														ksort($pages1[$um]['kiri'][$ke]);
														foreach($pages1[$um]['kiri'][$ke] as $ju => $va){
													?>
													<?php
														if($ke <> 13 OR ($ke == 13 and is_array($pages4[$um]['kiri'][$ke][$ju]))){
													?>
													<tr>
														<td style="width:30%;"><b><?=@$va?></b></td>
														<td><?=@$pages2[$um]['kiri'][$ke][$ju]?></td>
														
													</tr>
														<?php } ?>
														<?php	
															//jika ada uri 3 brrti lab yaaaaaaaaaaaaa
															$gsfdd=1;
															
															if(is_array($pages3)){
																ksort($pages3[$um]['kiri'][$ke][$ju]);
																foreach($pages3[$um]['kiri'][$ke][$ju] as $mo => $at){
																	ksort($pages4[$um]['kiri'][$ke][$ju][$mo]);
																	foreach($pages4[$um]['kiri'][$ke][$ju][$mo] as $bb => $cc){
																		$jdhs[]=1;
																		
														?>
																	<tr>
																		<td ><?=@$cc?></td>
																		<td ><?=@$pages5[$um]['kiri'][$ke][$ju][$mo][$bb]?><B><?=@$pages7[$um]['kiri'][$ke][$ju][$mo][$bb]?></B></td>
																		<td ><?=@$pages72[$um]['kiri'][$ke][$ju][$mo][$bb]?></td>
																		<td ><div align="left"><?=@$pages6[$um]['kiri'][$ke][$ju][$mo][$bb]?></div></td>
																	</tr>
																	
																	
																<?php } ?>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												<?php } ?>
												</tbody>
											</table>
							<table width="100%" style="font-size:12px;border-spacing:0;font-family:arial;">
								<tr STYLE="border-top:solid 1px #000000;">
									<td WIDTH="58%">
										<div align="left">
											<b>Kesimpulan:</b><br />
											<?php
												$this->db->select('kesimpulan_kelainan');
												$this->db->where('ket_resume', 'diagnosakelainan');
												$this->db->where('nama_kelainan', 'Laboratorium');
												$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
												$sssa = $this->db->get('tb_resume_pasien');
												$respas = $sssa->row();
												if($respas){
													echo $respas->kesimpulan_kelainan;
												}else{
													echo '';
												}
												if($abs->tipe_dinas == "D"){
													echo "<br /><b>Stakes: ".$ash[0]->val_stakes."</b>";
												}
											?>
										</div>
									</td>
										<td width="2%"></td>
										<td>
											<div align="center"><br />
												Pemeriksa
											</div>
										</td>
									</tr>
							</table>
			
				<?php } ?>
			<?php } ?>
			
			<!-- <header id="pageHeader">
				kkkkkkkkkkk
			</header>
			<footer id="pageFooter">
				Custom Footer
				<div class="numberOfPages">

				</div>
			</footer>-->
		</div>
		
		<?php if(!empty($abs->hasil_darah_tepi)){ ?>
		<div class="page">
		
		<table class="pddok" width="100%" style="font-size:12px;font-family: arial;">
												<thead>
												<tr>
													<td colspan="6">
														<table width="100%" style="font-size:12px;font-family: arial;" >
															<tr>
																<td>
																	<table width="100%" style="font-size:13px;border-spacing:0;font-family:arial;margin:5px 0 0 0;" cellpadding="12px" >
																			<tr>
																				<td>
																					<div align="left">
																						<b>
																						<span>MARKAS BESAR ANGKATAN UDARA</span><br/>
																						<span style="border-bottom:solid 1px #000000;padding:0 40px 0 40px;">LAKESPRA SARYANTO</span>
																						</b>
																					</div>
																				</td>
																			</tr>
																		</table>
																		<br />
																		<table width="100%" style="font-size:12px;border-spacing:0;font-family: arial;">
																			<tr>
																				<td style="border:solid 1px #000000;width:44%;border-radius:100px;">
																					<table style="width:100%" class="mixhed">
																						<tr>
																							<td width="20%"><?=@$en_nolab?></td>
																							<td >:</td>
																							<td><b style="font-size:16px;"><?=@$nolabmcu?></b></td>
																							
																						</tr><tr>
																							<td width="20%"><?=@$en_nofile?></td>
																							<td width="2%">:</td>
																							<td width="40%"><?=@$abs->no_filemcu?> [<?=@get_umur($abs->tgl_lhr_pas)?>]</td>
																							
																						</tr>
																						<tr>
																							<td><?=@$en_noreg?></td>
																							<td>:</td>
																							<td><?=@$abs->no_reg?></td>
																							
																						</tr>
																						<tr>
																							<td><?=@$en_nama?></td>
																							<td>:</td>
																							<td><?=@$abs->nm_pas?></td>
																							
																						</tr>
																					
																						<tr>
																							<td><?=@$en_ttl?></td>
																							<td>:</td>
																							<td><?=@$abs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($abs->tgl_lhr_pas))?></td>
																							
																						</tr>
																					</table>
																				</td>
																				<td style="width:2%"></td>
																				<td style="border:solid 1px #000000;width:44%;border-radius:100px;">
																					<table style="width:100%" class="mixhed">
																						<tr>
																							<td><?=@$en_tglpem?></td>
																							<td>:</td>
																							<td><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
																						</tr>
																						<tr>
																							<td><?=@$en_jenkel?></td>
																							<td>:</td>
																							<td><?=@$jenkelok?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_pngkt?></td>
																							<td>:</td>
																							<td><?=@$abs->pangkat_pas?>/<?=@$abs->nip_nrp_nik?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_kesat?></td>
																							<td>:</td>
																							<td><?=@$abs->nm_jawatan?> / <?=@$abs->jabatan_pas?></td>
																						
																						</tr>
																						<tr>
																							<td><?=@$en_ppj?></td>
																							<td>:</td>
																							<td><?=@$this->madmin->Get_setting('ttd_lab_nama')?></td>
																						
																						</tr>
																					</table>
																				</td>
																			</tr>
																			
																		</table>
																</td>
															</tr>
															</table>
													</td>
												</tr>
												</thead>
												<tbody>
												
												
												<tr>
													<td colspan="20">
														<table style="width:100%;font-size:13px;" class="darahtepi">
															<tr>
																<td colspan="3"><span style="text-decoration:underline"><b>Gambaran Darah Tepi</b></span></td>
															</tr>
															<tr>
																<td style="width:15%">Eritrosit</td>
																<td style="width:1%">:</td>
																<td><?=@$isidarahtepi['a']?></td>
															</tr>
															<tr>
																<td style="width:15%">Leukosit</td>
																<td style="width:1%">:</td>
																<td><?=@$isidarahtepi['b']?></td>
															</tr>
															<tr>
																<td style="width:15%">Trombosit</td>
																<td style="width:1%">:</td>
																<td><?=@$isidarahtepi['c']?></td>
															</tr>
															<tr>
																<td style="width:15%">Kesimpulan</td>
																<td style="width:1%">:</td>
																<td><?=@$isidarahtepi['d']?></td>
															</tr>
															<tr>
																<td style="width:15%">Saran</td>
																<td style="width:1%">:</td>
																<td><?=@$isidarahtepi['e']?></td>
															</tr>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
										<table width="100%" style="font-size:12px;border-spacing:0;font-family:arial;">
								<tr STYLE="border-top:solid 1px #000000;">
									<td WIDTH="40%">
										<div align="left">
										
											
										</div>
									</td>
										<td width="20%"></td>
										<td>
											<div align="center"><br />
												Pemeriksa
											</div>
										</td>
									</tr>
							</table>
		</div>
		<?php } ?>
