<?php
	$dfr = "select a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, b.id_paket, b.nm_paket, c.preposisi, c.no_reg, c.nm_pas, c.pangkat_pas, c.jenkel_pas, c.tgl_lhr_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, d.nm_jawatan ";
	$dfr .= " from tb_register a, tb_paket b, tb_pasien c, tb_jawatan d ";
	$dfr .= " where a.id_paket=b.id_paket and a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan ";
	$dfr .= " and a.id_reg='".clean_data($_GET['id_reg'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	
	//ambil preposisi
		$this->db->where("id_pre", $abs->preposisi);
		$jshdc = $this->db->get("tb_preposisi");
		$nhdsv = $jshdc->row();
		$panggsl = $nhdsv->nm_pre;
	$gsgssw = "Kesatuan";
	if(substr($abs->no_reg, 0, 1) == "N"){
		$gsgssw = "Perusahaan";
	}
	//print_r($abs);
	//ambil detail pemeriksaane yaaa
	//ambil pemeriksaan yang difilter
	
	if($abs){
		$nhd = "select a.id_reg_pem, b.nm_tind, b.keterangan_tind, b.lantai_tind, b.ket_cetak_pemeriksaan_pasien,b.order_form_baru, c.lantai, c.id_ins, c.nm_ins, c.order_baru ";
		$nhd .= " from tb_register_pemeriksaan a, tb_tindakan b,  tb_instalasi c ";
		$nhd .= " where a.id_tind_pem=b.id_tind and a.id_ins_tind_pem=c.id_ins ";
		$nhd .= " and a.kode_transaksi='".$abs->kode_transaksi."' and a.id_paket='".$abs->id_paket."' and b.ket_cetak_pemeriksaan_pasien='Y' order by c.order_ins ASC, b.order_tindakan ASC, b.id_tind DESC ";
		$vja = $this->db->query($nhd);
		$sba = $vja->result();
		//print_r($sba);
		foreach($sba as $st){
			$looppem[$st->order_baru] = $st;
			$looppem3[$st->order_baru][$st->order_form_baru] = $st;
			
		}
		$nhy = "select a.id_fil, b.nm_tind, b.keterangan_tind, b.lantai_tind, b.ket_cetak_pemeriksaan_pasien, c.lantai, c.id_ins, c.nm_ins ";
		$nhy .= " from tb_register_filterdata a, tb_tindakan b,  tb_instalasi c ";
		$nhy .= " where a.id_tind=b.id_tind and a.id_ins=c.id_ins ";
		$nhy .= " and a.unicode_transaksi='".$abs->kode_transaksi."' and a.id_paket='".$abs->id_paket."' and a.type_filter='TAMBAH' order by c.order_ins ASC, b.order_tindakan ASC ";
		$anh = $this->db->query($nhy);
		$nhs = $anh->result();
		//print_r($sba);
		$pos = 1;
		foreach($nhs as $ds){
			$pas = $pos++;
			$bawah3[$pas] = $ds->nm_tind;
			$bawah4[$pas] = $ds->lantai_tind;
			$bawah5[$pas] = $ds->keterangan_tind;
			
		}
		//ambil pemeriksaan tambahan
	}
	//print_r($bawah3);
	
?>
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
			padding:3px 22px 3px 22px !important; 
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
			padding:3px 22px 3px 22px !important; 
		}
    }
	@page {
        size: 8.27in;
        margin: 0;
    }
</style>
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
</style>

<script type="text/javascript">
	window.print();
</script>

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
	<body style="background:#666666;">
		<div class="page">
			<div style="">
			<table width="100%" style="font-size:15px;border-spacing:0;font-family:calibri;margin:20px 0 0 0;" cellpadding="10px" >
				<tr>
					<td>
						<?=@$this->madmin->get_setting('is_header_alamat')?>
					</td>
				</tr>
			</table>
			<hr style="border-bottom:2px solid #999999;margin-top:-1px;"/>
			<hr style="border-bottom:2px solid #999999;margin-top:-19px;"/>
			<h5><p class="text-center"><span style="border-bottom:1px solid #666666;font-size:15px">TANDA TELAH MELAKSANAKAN PEMERIKSAAN</p></h5>
			<h5><p class="text-center" style="margin-top:-5px;font-size:15px">PAKET : <?=@$abs->nm_paket?></p></h5>
			<table width="100%" style="font-size:16px;border-spacing:0;font-family: calibri;" cellpadding="2px">
				<tr>
					<td width="20%">Nama</td>
					<td width="2%">:</td>
					<td colspan="3" width="40%"><?=@$panggsl?> <?=@$abs->nm_pas?></td>
					<td width="12%">No. File</td>
					<td width="2%">:</td>
					<td colspan="3"><?=@$abs->no_filemcu?></td>
				</tr>
				<tr>
					<td>Pangkat/Koprs</td>
					<td>:</td>
					<td colspan="3"><?=@$abs->pangkat_pas?></td>
					<td>Umur</td>
					<td>:</td>
					<td colspan="3"><?=@get_umur($abs->tgl_lhr_pas)?></td>
				</tr>
				<tr>
					<td>NRP/NIP/NIK</td>
					<td>:</td>
					<td colspan="3"><?=@$abs->nip_nrp_nik?></td>
					<td>Gol. Darah</td>
					<td>:</td>
					<td colspan="3"><?=@$abs->gol_darah?></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<td colspan="3"><?=@$abs->jabatan_pas?></td>
					<td>Tgl. Periksa</td>
					<td>:</td>
					<td colspan="3"><?=@the_time(date("Y-m-d", strtotime($abs->tgl_awal_reg)))?></td>
				</tr>
				<tr>
					<td><?=@$gsgssw?></td>
					<td>:</td>
					<td colspan="3"><?=@$abs->nm_jawatan?></td>
					
				</tr>
			</table>
			<br />
				<table id="tablenya" width="100%" style="margin-top:-10px;font-size:17px;font-family: calibri;" cellpadding="2px">
					<thead>
					<tr>
						<th width="1%" style="border-right:1px solid"><div align="center"><p>NO.</p></div></th>
						<th style="border-right:1px solid"><div align="center"><p>LANTAI</p></div></th>
						<th style="border-right:1px solid"><div align="center"><p>PEMERIKSAAN</p></div></th>
						<th style="border-right:1px solid"><div align="center"><p>KETERANGAN</p></div></th>
						<th width="24%"colspan="2"><div align="center"><p>PARAF PEMERIKSA</p></div></th>
					</tr>
					</thead>
					<?php 
						$u=1;
						$e=1;
						$o=1;
						$n=0;
						//ksort($looppem);
						//print_r($looppem);
						foreach($looppem as $saq => $deg){
						?>
							<?php 
								ksort($looppem3[$saq]);
								foreach($looppem3[$saq] as $sq){ 
									$n++;
									$kirinya = "";
									$kanannya = 'style="border-left:0px"';
									if($n > 1){
										$kirinya = 'style="display:none"';
										$kanannya = 'style="border-left:0px"';
									}else {
										$kirinya = "";
										$kanannya = 'style="display:none;"';
									}
							?>
								<tr>
									<td style="border-left:0px solid"><?=@$u++?>.</td>
									<td><center><?=@$sq->lantai_tind?></center></td>
									<td><?=@$sq->nm_tind?></td>
									<td></td>
									<td width="12%">
									<div <?=@$kirinya?>><?=@$e++?> ............ </div>
									</td>
									<td style="border-left:0px;">
									<div <?=@$kanannya?>><?=@$o++?> ............</div>
									</td>
								</tr>
								<?php
									if($n >= 2){
										$n = 0;
									}
								?>
							<?php } ?>
					<?php } ?>	
					<tr>
						<th colspan="8"><div align="center">PEMERIKSAAN TAMBAHAN</div></th>
					</tr>
					<?php
						$pb = $u;
						if(is_array($bawah3)){
							$pk = $pb+count($bawah3)+1;
						}else {
							$pk = $pb+2;
						}
						$eka=1;
						$ud=1;
						for ($pb;$pb<=$pk; $pb++){
							$eko=$eka++;
							$as++;
								$hs="";
								if($pb == $pk){
									$hs='style="border-bottom:solid 1px;"';
								}
								    $kirinya = '';
									$kanannya = 'style="border-left:0px"';
									if($as > 1){
										$kirinya = 'style="display:none"';
										$kanannya = 'style="border-left:0px"';
									}else {
										$kirinya = "";
										$kanannya = 'style="display:none;"';
									}
					?>
								<tr <?=@$hs?>>
									<td style="border-left:0px solid"><?=@$pb?>.</td>
									<td><center><?=@$bawah4[$eko]?></center></td>
									<td><?=@$bawah3[$eko]?></td>
									<td><?=@$bawah5[$eko]?></td>
									<td width="12%">
									<div <?=@$kirinya?>><?=@$e++?> ............ </div>
									</td>
									<td style="border-left:0px;">
									<div <?=@$kanannya?>><?=@$o++?> ............</div>
									</td>
								</tr>
								<?php
									if($as >= 2){
										$as = 0;
									}
								?>
						<?php } ?>
					</table>
				<br />
				<div style="font-size:12px;">
					Untuk Diperhatikan :
					<ol type="1">
						<li>Dimohon mengikuti jadwal pemeriksaan sesuai dengan nomor urut<br />pemeriksaan masing-masing(lihat daftar jadwal/penjelasannya).</Sli>
						<li>Dimohon tidak merokok sebelum seluruh pemeriksaan selesai.</li>
					</ol>
				</div>
		</div>
	</div>
</body>
</html>