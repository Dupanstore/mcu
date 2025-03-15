<?php
	$dfr = "select a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, a.maksud_pemeriksaan, c.tmp_lahir_pas, c.tgl_lhr_pas, c.alamat_pas, c.nm_pas, c.preposisi, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas ";
	$dfr .= " from tb_register a, tb_pasien c ";
	$dfr .= " where a.no_reg=c.no_reg ";
	$dfr .= " and a.id_reg='".clean_data($_GET['id_reg'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	
	//ambil preposisi
		$this->db->where("id_pre", $abs->preposisi);
		$jshdc = $this->db->get("tb_preposisi");
		$nhdsv = $jshdc->row();
		$panggsl = $nhdsv->nm_pre;
	//print_r($abs);
	if($abs){
		$nhd = "select a.id_reg_pem, b.nm_tind, b.keterangan_tind, b.lantai_tind, b.ket_cetak_pemeriksaan_pasien, c.id_ins, c.nm_ins ";
		$nhd .= " from tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi c ";
		$nhd .= " where a.id_tind_pem=b.id_tind and b.id_ins_tind=c.id_ins ";
		$nhd .= " and a.kode_transaksi='".$abs->kode_transaksi."' order by b.nm_tind ASC ";
		$vja = $this->db->query($nhd);
		$sba = $vja->result();
		//print_r($sba);
		foreach($sba as $st){
			$bawah[$st->nm_tind] = $st->nm_tind;
			$loopk[$st->id_ins] = $st->nm_ins;
		}
	}
	//print_r($loopk);
?>
<script type="text/javascript">
<!--
	window.print();
//-->
</script>
<style>

	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #666666;
        font: 12pt "Helvetica";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
	.ddd {
			background:#ffffff !important; 
			border:solid 1px #000000 !important; 
			margin:-13px 0 0 530px !important; 
			padding:2px 22px 3px 22px !important; 
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
            page-break-after: always;
			box-shadow: 5px 5px 5px #222222;
        }
		.ddd {
			background:#ffffff !important; 
			border:solid 1px #000000 !important; 
			margin:-13px 0 0 456px !important; 
			padding:2px 22px 3px 22px !important; 
		}
    }
	@page {
        size: 8.27in;
        margin: 0;
    }
</style>
<style>
	th, td {
		padding: 1px;
	}
</style>
<html>
	<head>
		<link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/select2/select2.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/daterangepicker/daterangepicker-bs3.css">
	</head>
	<body>
		<body style="background:#666666;">
		<div class="page">
			<div style="">
			<table width="100%" style="font-size:14px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="10px" >
				<tr>
					<td>
						<?=@$this->madmin->get_setting('is_header_alamat')?>
					</td>
				</tr>
			</table>
			<hr style="border-bottom:2px solid #999999;margin-top:-1px;"/>
			<hr style="border-bottom:2px solid #999999;margin-top:-19px;"/>
			<h5><p class="text-center"><span style="border-bottom:1px solid #666666;">LEMBAR PEMERIKSAAN</p></h5>
			<h5><p class="text-left"><span style="border-bottom:1px solid #666666;">Mohon Pemeriksaan</p></h5>
			
			<table width="100%" style="font-size:14px;" cellpadding="10px;">
				<tr>
					<td width="1%"><b>I.</b></td>
					<td width="15%" align="left">No.File</td>
					<td width="1%">: </td>
					<td style="padding:2px;"><?=@$abs->no_filemcu?></td>
				</tr>
				<tr>
					<td width="1%"><b></b></td>
					<td width="15%" align="left">Nama</td>
					<td width="1%">: </td>
					<td style="padding:2px;"><?=@$panggsl?> <?=@$abs->nm_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Umur</td>
					<td>: </td>
					<td style="padding:2px;"><?=@get_umur($abs->tgl_lhr_pas)?></td>
				</tr>
				<tr>
					<td></td>
					<td>TTL</td>
					<td>:</td>
					<td style="padding:2px;"><?=@$abs->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($abs->tgl_lhr_pas))?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pangkat</td>
					<td>:</td>
					<td style="padding:2px;"><?=@$abs->pangkat_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat</td>
					<td>:</td>
					<td style="padding:2px;"><?=@$abs->alamat_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tanggal Periksa</td>
					<td>:</td>
					<td style="padding:2px;"><?=@date("d/m/Y",strtotime($abs->tgl_awal_reg))?></td>
				</tr>
			</table>
			<br />
			<table width="100%" style="font-size:14px;">
				
				<tr>
					<td>
						<table style="font-size:14px;">
							<tr>
								<td width="1%"><b>II.</b></td>
								<td width="85%" align="left">Untuk Pemeriksaan</td>
							</tr>
							<?php 
								$v=1;
								foreach($bawah as $s){ 
								$z=$v++;
							?>
							<tr>
								<td style="padding:2px;"><?=@$z?></td>
								<td><?=@$s?></td>
							</tr>
							<?php } ?>
						</table>
					</td>
					<td style="width:60%;vertical-align:top;">
						<table width="100%" style="font-size:14px;border:solid 1px #333333;">
							<?php 
								$v=1;
								foreach($loopk as $s){ 
								$z=$v++;
								$hdhsgg = "";
								$sdwret = "..........";
								if($z % 2 == 0){ 
									$hdhsgg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									$sdwret = "";
								} 
							?>
							<tr>
								<td style="padding:2px;">Konsul <?=@$s?></td>
								<td ><?=@$hdhsgg?><?=@$z?>......................................<?=@$sdwret?></td>
								<td></td>
							</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table width="100%" style="font-size:14px;">
				<tr>
					<td width="1%"><b>III.</b></td>
					<td width="15px" align="left">Keterangan</td>
					<td>:</td>
				</tr>
				<tr>
					<td width="1%"></td>
					<td width="15%">1. Maksud Pemeriksaan</td>
					<td>: <?=@$abs->maksud_pemeriksaan?></td>			
				</tr>
			</table><br /><br />
			<table width="100%" style="font-size:14px;">
				<tr style="border:0;">
					<td><div align="left" style="margin-left:20%;"><center>Mengetahui,<br />Kahumas<br /><br /><br />(______________________)</center></div></td>
					<td><div align="right" style="margin-right:0%;"><center>Jakarta, <?=@the_time(date("Y-m-d", strtotime($abs->tgl_awal_reg)))?> <br />Pasien<br /><br /><br />(<?=@$abs->nm_pas?>)</center></div></td>
				</tr>
			</table>
			
	</div>
	</div>
</body>
</html>