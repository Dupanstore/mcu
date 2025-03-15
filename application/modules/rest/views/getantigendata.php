<?php
	$dfr = "select a.id_paket, a.id_reg, a.no_lab_mcu, a.no_reg, a.tgl_awal_reg, a.tglverifrapid, a.kode_transaksi, a.no_filemcu, c.jenkel_pas, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas, e.tipe_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.qr_code_keys='".$_GET['uid']."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	//print_r($abs);
	$idrapid = $this->madmin->Get_setting('set_id_antigen');
	$this->db->where('id_pem', $idrapid);
	$tmmrapid = $this->db->get('tb_pemeriksaan');
	$hnnrapid = $tmmrapid->row();
	
	///saatnya ambil hasilmhyaa
	
	$gbvdvs = "select id_pem_deb, hasilnya, adakelainan from tb_register_detailpemeriksaan a where a.id_tind_detpem=".$idrapid." and a.kode_transaksi='".$abs->kode_transaksi."' and a.id_paket='".$abs->id_paket."' ";
	$svdsdf = $this->db->query($gbvdvs);
	$vdvfdd = $svdsdf->result();
	if(!$vdvfdd){
		die("Belum Ada Hasil Antigen SARS-CoV-2");
	}
	foreach($vdvfdd as $fdc){
		$hasill1[$fdc->id_pem_deb] = $fdc->hasilnya;
		$hasill2[$fdc->adakelainan] = $fdc->adakelainan;
	}
	//print_r($vdvfdd);
	
	$tanggalverifikasi = $abs->tglverifrapid;
	if($abs->tglverifrapid == "0000-00-00 00:00:00"){
		$tanggalverifikasi = date("Y-m-d H:i:s");
		$vrrfrapid['tglverifrapid'] = date("Y-m-d H:i:s");
		$this->db->where('id_reg', $abs->id_reg);
		$this->db->update('tb_register', $vrrfrapid);
	}
	
	$pangkasnoreg = $abs->tipe_dinas;
	if($pangkasnoreg == "N"){
		$sdhgdwver = "select auto_dinas from tb_paket where id_paket=".$abs->id_paket." ";
		$eretryete = $this->db->query($sdhgdwver);
		$sjhdgrher = $eretryete->row();
		if($sjhdgrher->auto_dinas =="Y"){
			$pangkasnoreg = 'D';
		}
	}
	
	$pangktpas = "";
	if($pangkasnoreg == "D"){
		$pangktpas = strtoupper($abs->pangkat_pas);
	}
	
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

#cdn td{
	border:solid 1px #000000;
	padding:3px;
	font-size:14px;
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

<html>
	<body style="background:#777777;">
		<div class="book">
			<div class="page">
					
								<table width="100%" style="font-size:14px;font-family: arial;" >
									<thead>
									<tr style="border:none;">
										<td colspan="3" style="border:none;">
										
											<table width="100%" style="font-size:14px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="14px" >
													<tr>
														<td>
															<div align="left">
																<b>
																<span style="padding:0 0px 0 26px;">LAKESPRA <?=@is_fixname()?></span><br/>
																<span style="border-bottom:solid 1px #000000;padding:0 0px 0 0px;">LABORATORIUM PATOLOGI KLINIK</span>
																</b>
															</div>
														</td>
													</tr>
												</table>
												<div align="center"><h5><p class="text-center"><span style="border-bottom:1px solid #666666;font-size:14px;margin-top:20px;"><br />Pelaporan Hasil Rapid Swab Antigen SARS-CoV-2</p></h5></div>
												<table width="100%" style="font-size:14px;border-spacing:0;font-family: arial;" cellpadding="3px">
													<tr>
														<td width="20%">Nama </td>
														<td width="2%">:</td>
														<td width="40%"><?=@$pangktpas?> <?=@$abs->nm_pas?> [<?=@$abs->no_reg?>]</td>
														<td width="12%"></td>
														<td width="2%"></td>
														<td colspan="3"></td>
													</tr>
													<tr>
														<td width="20%">Jenis Kelamin</td>
														<td width="2%">:</td>
														<td width="40%"><?=@is_jenkel($abs->jenkel_pas)?></td>
														<td width="12%"></td>
														<td width="2%"></td>
														<td colspan="3"></td>
													</tr>
													<tr>
														<td>Usia / Tanggal Lahir</td>
														<td>:</td>
														<td><?=@get_umur($abs->tgl_lhr_pas)?> [<?=@date('d/m/Y', strtotime($abs->tgl_lhr_pas))?>]</td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<!--<tr>
														<td>Tgl Order</td>
														<td>:</td>
														<td><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>-->
													<tr>
														<td>Tgl Pemeriksaan</td>
														<td>:</td>
														<td><?=@date("d/m/Y", strtotime($tanggalverifikasi))?></td>
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
										<td colspan="2" style="vertical-align:top;">
											<br /><b>HASIL PEMERIKSAAN</b><br />
											<table id="cdn" style="width:100%;margin-top:5px;">
												<?php
													$nilairujukan = $hnnrapid->nilai_rujukan;
													$hasilpem = $vdvfdd->hasilnya;
													$hasill = "normal";
													if(isset($hasill2['Y'])){
														$hasill = "abnormal";
													}
													if(strtolower($hasill1[373]) == "positif" OR strtolower($hasill1[373]) == "positive"){
														$hasill = "abnormal";
													}
													
													$igT = "<b>-</b>";
													if(isset($hasill1[373])){
														$igT = "<b>".$hasill1[373]."</b>";
													}
													
												?>
												<tr>
													<td><b>No</b></td>
													<td><b>Parameter</b></td>
													<td style="width:20%"><b>Hasil</b></td>
													<td style="width:20%"><b>Nilai rujukan</b></td>
												</tr>
												<tr>
													<td style="width:5%">1.</td>
													<td>
														Antigen SARS-CoV-2
													</td>
													<td>
														<?=@$igT?><br />
													</td>
													<td>
														Negatif<br />
													</td>
												</tr>
												
											</table>
											<br />
											<?php
												//$hasill = "normal";
												//$hasill = "abnormal";
												$gdvbsd = "Saran";
												if($hasill == "normal"){
													$gdvbsd = "Catatan";
												}
											?>
											<!--<span>Pelaporan</span><br />
											
											<table style="width:100%;font-size:14px;">
												<tr>
													<td style="width:3%;padding:2px;"></td>
													<td style="width:2%;padding:2px;">-</td>
													<td style="padding:2px;"><?=@is_antigen_isi('kesimpulan', $hasill)?></td>
												</tr>
											</table>
											<br /><br />-->
											<span><b><?=@$gdvbsd?></b></span><br />
											<table style="width:100%;font-size:14px;">
												<?php foreach(is_antigen_isi('saran', $hasill) as $vv){ ?>
												<tr>
													<td style="width:3%;padding:2px;"></td>
													<td style="width:2%;padding:2px;">-</td>
													<td style="padding:2px;"><?=@$vv?></td>
												</tr>
												<?php } ?>
											</table><br /><br />
										</td>
									</tr>
									</tbody>
								</table>
								<?php
									$this->db->where('kd_dok', 'KALAB');
									$kklids = $this->db->get('tb_dokter');
									$sghdfs = $kklids->row();
								?>
					<table width="100%" style="font-size:14px;border-spacing:0;font-family:arial;">
						<tr>
							<td WIDTH="40%">
								<div align="center">
									
								</div>
							</td>
								<td width="20%"></td>
								<td>
									<div align="center">
										Penanggungjawab<br/><br/><span style="font-size:14px;text-decoration:underline"><?=@$sghdfs->nm_dok?></span><br /><span style="font-size:14px;"><?=@$sghdfs->pangkat?> NIP <?=@$sghdfs->nip_nrp?></span>
									</div>
								</td>
							</tr>
					</table>
			</div>
		</div>
