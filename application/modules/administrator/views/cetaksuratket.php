<?php
	$this->db->where('kd_dok', 'KADEP');
	$kklids = $this->db->get('tb_dokter');
	$sghdfs = $kklids->row();
?>
<?php
	$dfr = "select a.id_reg, a.no_lab_mcu, a.no_reg, a.tgl_awal_reg, a.tglverifrapid, a.kode_transaksi, a.no_filemcu, c.kesatuan_pas, c.jenkel_pas, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas, e.tipe_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	$idrapid = $_GET['idpem'];
	
	
	
	///saatnya ambil hasilmhyaa
	
	$gbvdvs = "select id_pem_deb, hasilnya, adakelainan from tb_register_detailpemeriksaan a where a.id_tind_detpem=".$idrapid." and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
	$svdsdf = $this->db->query($gbvdvs);
	$vdvfdd = $svdsdf->result();
	if(!$vdvfdd){
		die("Belum Ada Hasil Rapid Test/Swab");
	}
	foreach($vdvfdd as $fdc){
		$hasill1[$fdc->id_pem_deb] = $fdc->hasilnya;
		$hasill2[$fdc->adakelainan] = $fdc->adakelainan;
	}
	
	$hasilpem = $vdvfdd->hasilnya;
	$hasill = "	<b>Non Reaktif</b>";
	if(isset($hasill2['Y'])){
		$hasill = "<b>Reaktif</b>";
	}
	
	
	$gsvdcd1 = "Rapid Test Antibodi Covid-19";
	$gsvdcd2 = "Rapid Test Antibodi Covid-19";
	if($idrapid == "6667"){
		$gsvdcd1 = "Rapid Swab Antigen SARS-CoV-2";
		$gsvdcd2 = "Swab Antigen SARS-CoV-2";
		$hasill = "	<b>Negatif</b>";
		if(isset($hasill2['Y'])){
			$hasill = "<b>Positif</b>";
		}
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
		$sdhgdwver = "select auto_dinas from tb_paket where id_paket=".$_GET['id_paket']." ";
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
	padding:5px;
}

#cdn td{
	border:solid 1px #000000;
	padding:5px;
	font-size:14px;
}
#tbcdn td{
	padding:5px;
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
			<div class="page">
					
								<table width="100%" style="font-size:14px;font-family: arial;" >
									<thead>
									<tr style="border:none;">
										<td colspan="3" style="border:none;">
										
											<table width="100%" style="font-size:14px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="14px" >
													<tr>
														<td>
															<div align="left">
																	<span>MARKAS BESAR ANGKATAN UDARA</span><br/>
																	<span style="border-bottom:solid 1px #000000;padding:0 40px 0 40px;">LAKESPRA <?=@is_fixname()?></span>
																</div>
														</td>
													</tr>
												</table>
												<h5>
												<p class="text-center">
												<img src="<?=@base_url('assets/img/tniau.png')?>" style="width:110px;margin-bottom:10px;">
												<span style="font-size:14px;margin-top:20px;"><br />SURAT KETERANGAN<br />Nomor Sket/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;/<?=@is_romawi(date("m", strtotime($tanggalverifikasi)))?>/<?=@date("Y", strtotime($tanggalverifikasi))?><br /><br /></p>
												</h5>
												<table width="100%" id="tbcdn" style="font-size:14px;border-spacing:0;font-family: arial;" cellpadding="3px">
													<tr>
														<td style="width:3px;">1.</td>
														<td colspan="10"><p>Yang bertanda tangan dibawah ini</p></td>
													</tr>
													<tr>
														<td> </td>
														<td width="15%">Nama </td>
														<td width="2%">:</td>
														<td><?=@$sghdfs->nm_dok?></td>
														
													</tr>
													<tr>
														<td> </td>
														<td width="20%">Pangkat/NRP</td>
														<td width="2%">:</td>
														<td ><?=@$sghdfs->pangkat?></td>
														
													</tr>
													<tr>
														<td> </td>
														<td>Jabatan</td>
														<td>:</td>
														<td>Kadepaeroklinik</td>
														
													</tr>
													<tr>
														<td> </td>
														<td>Jawatan</td>
														<td>:</td>
														<td>Lakespra dr. Saryanto</td>
														
													</tr>
													<tr>
														<td style="width:3px;"></td>
														<td colspan="10"><br /><p>Menerangkan dengan sebenarnya bahwa:</p></td>
													</tr>
													<tr>
														<td> </td>
														<td width="15%">Nama </td>
														<td width="2%">:</td>
														<td><?=@$abs->nm_pas?></td>
														
													</tr>
													<tr>
														<td> </td>
														<td width="15%">Pangkat </td>
														<td width="2%">:</td>
														<td><?=@$pangktpas?></td>
														
													</tr>
													<tr>
														<td> </td>
														<td>Umur</td>
														<td>:</td>
														<td><?=@get_umur($abs->tgl_lhr_pas)?></td>
														
													</tr>
													<tr>
														<td> </td>
														<td>Tanggal Pemeriksaan</td>
														<td>:</td>
														<td><?=@the_time(date("Y-m-d", strtotime($tanggalverifikasi)))?></td>
														
													</tr>
													<tr>
														<td colspan="10"><br /><p>&nbsp; &nbsp; &nbsp;Adalah benar yang bersangkutan melaksanakan <b><?=@$gsvdcd1?></b> di Lakespra dr. Saryanto dengan hasil <b><?=@$gsvdcd2?></b> <?=@$hasill?></p></td>
													</tr>
													<tr>
														<td style="width:15px;">2.</td>
														<td colspan="10"><p>Demikian, surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.</p></td>
													</tr>
												</table>
					
					
										</td>
									</tr>
									</thead>
								</table>
								
					<table width="100%" style="font-size:14px;border-spacing:0;font-family:arial;">
						<tr>
							<td WIDTH="40%">
								<div align="center">
									
								</div>
							</td>
								<td width="20%"></td>
								<td>
									<div align="center">
										<br /><br />Jakarta, <?=@the_time(date("Y-m-d", strtotime($tanggalverifikasi)))?><br/><br/>a.n Kepala Lakespra dr. Saryanto<br/>Kadepaeroklinik<br/><?=@$sghdfs->jabatan?><br/><img src="<?=@base_url('tandatangan/kadep.png')?>" style="width:90px;"><br/><span style="font-size:14px"><?=@$sghdfs->nm_dok?></span><br /><span style="font-size:14px;"><?=@$sghdfs->pangkat?></span>
									</div>
								</td>
							</tr>
					</table>
			</div>
		</div>
