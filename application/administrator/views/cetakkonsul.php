<?php
	$ggs  = " and a.id_reg='".$this->u3."' ";	
	$query = $this->mdaftar->mdaftar_menu_registrasiharian($ggs);
	
	if($this->uri->segment(3) != $query[0]->id_reg){
		$ggs  = " and a.no_reg='".$this->u3."' and id_reg='".$this->u4."' ";	
		$query = $this->mdaftar->mdaftar_menu_registrasiharian($ggs);
	}else{
		
	}
?>
<script type="text/javascript">
<!--
	window.print();
//-->
</script>

<style>
	th, td {
		padding: 5px;
	}
</style>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap/easyui.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap-responsive.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sticky-footer.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/icon.css')?>">
	</head>
	<body>
		<div class="container" style="width:94%;margin-left:3%;margin-right:3%;">
			<table width="100%" style="font-size:14px;border-spacing:0;font-family:<?=@$this->mglobal->Get_setting('font_family')?>;margin:20px 0 0 0;" cellpadding="10px" >
				<tr>
					<td>
						<h5 style="font-size:18px;font-family:<?=@$this->mglobal->Get_setting('font_family')?>;margin-top:-10px;"><p class="text-center">MARKAS BESAR ANGKATAN UDARA</p></h5>
						<h5 style="font-size:18px;font-family:<?=@$this->mglobal->Get_setting('font_family')?>;margin-top:-10px;margin-bottom:-10px;"><p class="text-center">LAKESPRA SARYANTO</p></h5>
						<h5 style="font-size:13px;font-family:<?=@$this->mglobal->Get_setting('font_family')?>;margin-bottom:-10px;"><p class="text-center">Jl. M.T. Haryono Kav. 46, Jakarta Selatan</p></h5>
						<h5 style="font-size:13px;font-family:<?=@$this->mglobal->Get_setting('font_family')?>;margin-bottom:-10px;"><p class="text-center"> Telp. (021) 7994151 / 7996175 / 7980002, Fax. (021) 799 6634</p></h5>
						<br>
					</td>
					<td style="margin-left:-80px;vertical-align:top;">	
						<div style="padding:5px;border:solid 1px #666666;border-radius:5px;background:#eaeaea;">No. File : <?=@$query[0]->no_pas_reg?></div>
					</td>
				</tr>
			</table>
			<hr style="border-bottom:1px solid #999999;margin-top:-19px;"/>
			<hr style="border-bottom:1px solid #999999;margin-top:-19px;"/>
			<h5><p class="text-center"><span style="border-bottom:1px solid #666666;">LEMBAR PEMERIKSAAN</p></h5>
			<h5><p class="text-left"><span style="border-bottom:1px solid #666666;">Mohon Pemeriksaan</p></h5>
			
			<table width="100%" style="font-size:12px;">
				<tr>
					<td width="1%"><b>I.</b></td>
					<td width="15%" align="left">Nama</td>
					<td width="1%">:</td>
					<td><?=$query[0]->nm_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Umur</td>
					<td>:</td>
					<td><?=@get_umur_jg($query[0]->tgl_lhr_pas)?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tempat/Tanggal Lahir</td>
					<td>:</td>
					<td><?=$query[0]->tmp_lahir_pas?>/<?=@str_replace(" /", "", the_time($query[0]->tgl_lhr_pas))?></td>
				</tr>
				<tr>
					<td></td>
					<td>Pangkat</td>
					<td>:</td>
					<td><?=$query[0]->pangkat_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Alamat</td>
					<td>:</td>
					<td><?=@$query[0]->alamat_pas .', '. $query[0]->kelurahan .', '. $query[0]->kecamatan .', '. $query[0]->kabupaten?></td>
				</tr>
				<tr>
					<td></td>
					<td>No. Tlp</td>
					<td>:</td>
					<td><?=$query[0]->no_tlp_pas?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tanggal Pemeriksaan</td>
					<td>:</td>
					<td><?=@the_time(date('Y-m-d', strtotime($query[0]->tgl_awal_reg)))?></td>
				</tr>
			</table>
			<br />
			
			<table width="100%" style="font-size:12px;">
				<tr>
					<td width="1%"><b>II.</b></td>
					<td width="85%" align="left">Untuk Pemeriksaan</td>
				</tr>
					<?php
						$nb = 1;
						$_mm = "SELECT * FROM tb_pemeriksaan_detail, tb_register_meta where tb_pemeriksaan_detail.id_pemeriksaan_detail = tb_register_meta.id_pemeriksaan_detail and tb_register_meta.no_reg='".$query[0]->no_reg."'";
						$_nm = $this->db->query($_mm);
						$debitur = $_nm->result();
						//print_r($debitur);die();
						foreach($debitur as $deb){
						$no = $nb++;
					?>
				<tr id="tr<?=$no?>">
					<td><?=$no?></td>
					<td><?=$deb->nm_detail_pemeriksaan?></td>
				</tr>
					<?php } ?>
			</table>
			<br />
			<table width="100%" style="font-size:12px;">
				<tr>
					<td width="1%"><b>III.</b></td>
					<td width="15px" align="left">Keterangan</td>
					<td>:</td>
				</tr>
				<tr>
					<td width="1%"></td>
					<td width="15%">1. Maksud Pemeriksaan</td>
					<td>: ...........................................................................................................................................</td>			
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>..............................................................................................................................................</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>..............................................................................................................................................</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>..............................................................................................................................................</td>
				</tr>
			</table>
			
				