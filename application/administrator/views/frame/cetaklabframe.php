<?php
	$dfr = "select a.no_lab_mcu, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.jenkel_pas, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->result();
	$sga = "select a.kesantext, a.val_stakes, b.id_tind, b.kd_tind, b.nm_tind, b.id_ins_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan, e.order_evalusi_group, e.kd_grouptindakan from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
	$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
	$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and d.id_ins=2 ";
	$sfc = $this->db->query($sga);
	$ash = $sfc->result();
	
	$nolabmcu = "-";
	if($abs[0]->no_lab_mcu > 0){
		$nolabmcu = sprintf("%04s", $abs[0]->no_lab_mcu);
	}
	//print_r($ash);
	if($ash){
		foreach($ash as $bs){
			//pertama adalah buat barisnya yaaaaa
			//yang pasti bedakan page kanan dan kiriiii yaaaaa
			//intine page 1 tek buat fix kaya asline
			$hsbb = "select a.hasilnya, a.adakelainan, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, c.kd_pem, c.det_order_pemeriksaan, c.satuan, c.nilai_rujukan, d.id_ins from tb_register_detailpemeriksaan a, tb_pemeriksaan c, tb_instalasi d ";
			$hsbb .= "where a.id_pem_deb=c.id_pem  and a.id_ins_tind_detpem=d.id_ins ";
			$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.apakah_pemeriksaan_khusus <> 'Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' order by c.kd_pem ASC ";
			$ansd = $this->db->query($hsbb);
			$ssv = $ansd->result();
			$nminsnya = strtoupper(str_replace("Poliklinik", "Pemeriksaan", $bs->nm_ins));
			if($bs->id_ins == "2"){
				//yang dihalaman 2 hanya hematologi selain itu dihalaman 3 ya
				if($bs->kd_grouptindakan == "01"){
					$pages[1]['kiri'][$bs->order_evaluasi] = "<span style='margin:0 0 0 8px;'><b>". $bs->order_evaluasi .". ". strtoupper($bs->nm_ins)."</b></span>";	
					$pages1[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br />". strtoupper($bs->nm_grouptindakan)."</span>";
					$pages2[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
					$pages3[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
					foreach($ssv as $hsd){
						if($hsd->nm_pem == "HITUNG JENIS"){
							$hsd->nm_pem = "<br /><b>". $hsd->nm_pem."</b>";
						}
						if($hsd->nm_pem == "Monosit"){
							$hsd->nm_pem = $hsd->nm_pem. "<br /><br />";
						}
						if($hsd->satuan == "-"){
							$hsd->satuan = "";
						}
						if($hsd->adakelainan == "Y"){
							$hsd->adakelainan = "<b style='color:red;font-weight:bold'>*</b>";
						}else{
							$hsd->adakelainan = "";
						}
						
						$pages4[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
						$pages5[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->hasilnya."". $hsd->satuan ."</span>";
						$pages6[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
						$pages7[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->adakelainan ."</span>";
					}
				} else {
					if($bs->kd_grouptindakan == "02" OR $bs->kd_grouptindakan == "03" OR $bs->kd_grouptindakan == "05" OR $bs->kd_grouptindakan == "06" OR $bs->kd_grouptindakan == "07" OR $bs->kd_grouptindakan == "08" OR $bs->kd_grouptindakan == "09"){
						$pages[1]['kiri'][$bs->order_evaluasi] = "";	
						$pages1[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br />". strtoupper($bs->nm_grouptindakan)."</span>";
						$pages2[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
						$pages3[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
						foreach($ssv as $hsd){
							if($hsd->satuan == "-"){
								$hsd->satuan = "";
							}
							if($hsd->adakelainan == "Y"){
								$hsd->adakelainan = "<b style='color:red;font-weight:bold'>*</b>";
							}else{
								$hsd->adakelainan = "";
							}
							$pages4[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
							$pages5[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->hasilnya."". $hsd->satuan ."</span>";
							$pages6[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
							$pages7[1]['kiri'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->adakelainan ."</span>";
						}
					}else {
						$pages[1]['kanan'][$bs->order_evaluasi] = "";	
						$pages1[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "<span><br />". strtoupper($bs->nm_grouptindakan)."</span>";
						$pages2[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan] = "";
						$pages3[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind] = "";
						foreach($ssv as $hsd){
							if($hsd->satuan == "-"){
								$hsd->satuan = "";
							}
							if($hsd->adakelainan == "Y"){
								$hsd->adakelainan = "<b style='color:red;font-weight:bold'>*</b>";
							}else{
								$hsd->adakelainan = "";
							}
							$pages4[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nm_pem."</span>";
							$pages5[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->hasilnya."". $hsd->satuan ."</span>";
							$pages6[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->nilai_rujukan ."</span>";
							$pages7[1]['kanan'][$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = "<span>".$hsd->adakelainan ."</span>";
						}
					}
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
</style>
<style>
	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #000000;
        font: 12pt "Helvetica";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
	.breaks{
		page-break-after: auto;
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
            width: 8.27in;
            min-height: 3.69in;        
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
        }
		.breaks{
			page-break-after: auto;
		}	
    }
	@page {
        size: 8.27in;
        margin: 0;
    }
	div.page { page-break-after: always }
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
		<div class="book">
			<?php 
				$f = range(1,1);
				$akhirpage = 1;
				if($f){ 
					$nm = 1;
					foreach($f as $val){
					$um = $nm++;
			?>
			<div class="page">
					
								<table width="100%" style="font-size:12px;font-family: arial;" >
									<thead>
									<tr style="border:none;">
										<td colspan="3" style="border:none;">
										
											<table width="100%" style="font-size:13px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="12px" >
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
												<h5><p class="text-center"><span style="border-bottom:1px solid #666666;font-size:14px;font-family:times new roman;">HASIL PEMERIKSAAN LABORATORIUM</p></h5>
												<table width="100%" style="font-size:12px;border-spacing:0;font-family: arial;" cellpadding="3px">
													<tr>
														<td width="20%">No Lab. </td>
														<td width="2%">:</td>
														<td width="40%"><b style="font-size:16px;"><?=@$nolabmcu?></b></td>
														<td width="12%"></td>
														<td width="2%"></td>
														<td colspan="3"></td>
													</tr>
													<tr>
														<td width="20%">No File / Umur</td>
														<td width="2%">:</td>
														<td width="40%"><?=@$abs[0]->no_filemcu?> [<?=@get_umur($abs[0]->tgl_lhr_pas)?>]</td>
														<td width="12%"></td>
														<td width="2%"></td>
														<td colspan="3"></td>
													</tr>
													<tr>
														<td>Nama / No Reg</td>
														<td>:</td>
														<td><?=@$abs[0]->nm_pas?> [<?=@$abs[0]->no_reg?>]</td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>Jenis Kelamin</td>
														<td>:</td>
														<td><?=@is_jenkel($abs[0]->jenkel_pas)?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>Pangkat/NRP/NIP</td>
														<td>:</td>
														<td><?=@$abs[0]->pangkat_pas?>/<?=@$abs[0]->nip_nrp_nik?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>Jawatan / Jabatan</td>
														<td>:</td>
														<td><?=@$abs[0]->nm_jawatan?> / <?=@$abs[0]->jabatan_pas?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>Tempat/Tanggal Lahir</td>
														<td>:</td>
														<td><?=@$abs[0]->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($abs[0]->tgl_lhr_pas))?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>Tanggal Pemeriksaan</td>
														<td>:</td>
														<td><?=@date("d/m/Y", strtotime($abs[0]->tgl_awal_reg))?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												</table>
					
					
										</td>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td width="49%" style="vertical-align:top;border:solid 1px #000000;">
											<table width="100%" style="font-size:12px;font-family: arial;">
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
														<td style="width:40%;border-bottom:1px solid;"><b><?=@$va?></b></td>
														<td><?=@$pages2[$um]['kiri'][$ke][$ju]?></td>
														
													</tr>
														<?php } ?>
														<?php	
															//jika ada uri 3 brrti lab yaaaaaaaaaaaaa
															if(is_array($pages3)){
																ksort($pages3[$um]['kiri'][$ke][$ju]);
																foreach($pages3[$um]['kiri'][$ke][$ju] as $mo => $at){
																	ksort($pages4[$um]['kiri'][$ke][$ju][$mo]);
																	foreach($pages4[$um]['kiri'][$ke][$ju][$mo] as $bb => $cc){
														?>
																	<tr>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;"><?=@$cc?></td>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;"><?=@$pages5[$um]['kiri'][$ke][$ju][$mo][$bb]?></td>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;" width="5%"><center><?=@$pages7[$um]['kiri'][$ke][$ju][$mo][$bb]?></center></td>
																		<td style="border-bottom:1px solid;border-top:1px solid;"><div align="right"><?=@$pages6[$um]['kiri'][$ke][$ju][$mo][$bb]?></div></td>
																	</tr>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</table>
										</td>
										<td width="2%"></td>
										<td style="vertical-align:top;">
											<table width="100%" style="font-size:12px;font-family: arial;border:solid 1px #000000;">
												<?php 
													ksort($pages[$um]['kanan']);
													foreach($pages[$um]['kanan'] as $ke => $fr){
												?>
												<tr><td colspan="3"><b><?=@$fr?></b></td></tr>
													<?php 
														ksort($pages1[$um]['kanan'][$ke]);
														foreach($pages1[$um]['kanan'][$ke] as $ju => $va){
													?>
													<?php
														if($ke <> 13 OR ($ke == 13 and is_array($pages4[$um]['kanan'][$ke][$ju]))){
													?>
													<tr>
														<td style="width:40%;border-bottom:1px solid;"><b><?=@$va?></b></td>
														<td><?=@$pages2[$um]['kanan'][$ke][$ju]?></td>
													</tr>
														<?php } ?>
														<?php	
															//jika ada uri 3 brrti lab yaaaaaaaaaaaaa
															if(is_array($pages3)){
																ksort($pages3[$um]['kanan'][$ke][$ju]);
																foreach($pages3[$um]['kanan'][$ke][$ju] as $mo => $at){
																	ksort($pages4[$um]['kanan'][$ke][$ju][$mo]);
																	foreach($pages4[$um]['kanan'][$ke][$ju][$mo] as $bb => $cc){
														?>
																	<tr>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;"><?=@$cc?></td>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;"><?=@$pages5[$um]['kanan'][$ke][$ju][$mo][$bb]?></td>
																		<td style="border-bottom:1px solid;border-right:1px solid;border-top:1px solid;" width="5%"><center><?=@$pages7[$um]['kanan'][$ke][$ju][$mo][$bb]?></center></td>
																		<td style="border-bottom:1px solid;border-top:1px solid;"><div align="right"><?=@$pages6[$um]['kanan'][$ke][$ju][$mo][$bb]?></div></td>
																	</tr>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</table>
										</td>
									</tr>
									</tbody>
								</table>
					<table width="100%" style="font-size:12px;border-spacing:0;font-family:arial;">
						<tr>
							<td WIDTH="40%">
								<div align="center">
									
								</div>
							</td>
								<td width="20%"></td>
								<td>
									<div align="center">
										Pemeriksa,<br/><br/><br/><br/><br/><br/><?=@$this->madmin->Get_setting('ttd_lab_nama')?><br /><span style="border-top:1px solid #666666;font-size:12px;"><?=@$this->madmin->Get_setting('ttd_lap_pangkat')?></span>
									</div>
								</td>
							</tr>
					</table>
			</div>
				<?php } ?>
			<?php } ?>
		</div>
