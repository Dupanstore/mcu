<?php if(!$_GET['noprint']){ ?>
<script type="text/javascript">
	window.print();
</script>
<?php } ?>
<style>
#tablenya {
	border:0px;
}
#tablenya td{
	border-left:2px solid;
	padding:2px;
}
#tablenya th{
	border-top:2px solid;
	border-bottom:2px solid;
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
        width: 9.5in;
        padding: 5mm;
        margin: 5mm auto;
        border: 2px #D3D3D3 solid;
        background: white;
        box-shadow: 5px 5px 5px #222222;
    }
    @media print {
        html, body {
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

<?php
	$dfr = "select a.qr_code_keys, a.def_ttd, a.id_paket, a.keluhan_utama, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.riwayat_kesehatan_pasien, c.riwayat_kesehatan_keluarga, c.kawin_pas, c.nm_pas, c.bangsa_pas, c.pangkat_pas, c.jenkel_pas, c.alamat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.nm_pekerjaan, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	
	if(!empty($abs->qr_code_keys)){
		$qkeysx = $abs->qr_code_keys;
		$this->load->library('ciqrcode');
		$params['data'] = "https://qr.lakesprasaryanto.com/?uid=".$qkeysx;
		$params['level'] = 'H';
		$params['size'] = 2;
		$params['savename'] = FCPATH.'/qr/Q1-'.$abs->kode_transaksi.'.png';
		$this->ciqrcode->generate($params);
	}
	
	$getAnamnesa = $abs->keluhan_utama;
	
	$oiu = "select nama_kesansaran, isi_kesansaran from tb_resume_pasien where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."'  and ket_resume='kesimpulansaran' ";
	$aew = $this->db->query($oiu);
	$sarankes = $aew->result();
	if($sarankes){
		foreach($sarankes as $sa){
			$kesansaran[$sa->nama_kesansaran] = $sa->isi_kesansaran;
		}
		
	}
	$val3 = $abs->riwayat_kesehatan_pasien;
	$val4 = $abs->riwayat_kesehatan_keluarga;
	
	//ambil riwayattttt
	$gsvbbs = "select hasilnya, nama_pemeriksaan_khusus from tb_register_detailpemeriksaan where apakah_riwayat='Y' and kode_transaksi='".clean_data($_GET['kode_transaksi'])."' and id_paket='".clean_data($_GET['id_paket'])."' ";
	$gsvbas = $this->db->query($gsvbbs);
	$generateriwayat = $gsvbas->result();
	//print_r($generateriwayat);
	foreach($generateriwayat as $loopriwayat){
		$explopriwayat = explode("___", $loopriwayat->nama_pemeriksaan_khusus);
		$getcek[$explopriwayat[0]][$explopriwayat[1]] = 'checked="true"';
		$getcekisiok[$explopriwayat[0]][$explopriwayat[1]] = $loopriwayat->hasilnya;
	}
	
	
	foreach(range(5,22) as $hdbs){
		foreach(range(1,50) as $ikhvd){
			$sethasilpem[$hdbs.'P'.$ikhvd] = '-';
		}
	}
	
	//ambil hasil pemeriksaan laiinya
	$getpemfinal = "select a.adakelainan, a.ketkelainanlainnya, a.hasilnya, b.nomorbuku from tb_register_detailpemeriksaan a, tb_pemeriksaan b where a.id_pem_deb=b.id_pem and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' and a.id_paket='".clean_data($_GET['id_paket'])."' ";
	$setpemfinal = $this->db->query($getpemfinal);
	$returnpemfinal = $setpemfinal->result();
	foreach($returnpemfinal as $ikois){
		if(isset($_GET['lang'])){
			if(!empty($ikois->hasilnya)){
				if($_GET['lang'] == "en"){
					if($this->madmin->rsau_postifif_negatif_en($ikois->hasilnya)){
						$ikois->hasilnya = $this->madmin->rsau_postifif_negatif_en($ikois->hasilnya);
					}
				}
			}
		}
		$isihasil = $ikois->hasilnya;
		
		if(!empty($ikois->ketkelainanlainnya)){
			$isihasil = $ikois->ketkelainanlainnya;
		}
		
		if($ikois->adakelainan == "Y"){
			$isihasil = "<b>".$isihasil."*</b>";
		}
		
		$sethasilpem[$ikois->nomorbuku] = $isihasil;
	}
	$shc = "select id_tind_pem, kesantext,kesimpulan_pemeriksaan  from tb_register_pemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' and id_paket='".clean_data($_GET['id_paket'])."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	//print_r($dgs);
	if($dgs){
		foreach($dgs as $bd){
			$isihasil = $bd->kesantext;
			$sethasilpem['AUTO_KESAN_IDTIND_'. $bd->id_tind_pem] = $isihasil;
			$setkesimpulanauto['AUTO_KESIMPULAN_IDTIND_'. $bd->id_tind_pem] = $bd->kesimpulan_pemeriksaan;
		}
	}
	//print_r($setkesimpulanauto);
	
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' and id_paket='".clean_data($_GET['id_paket'])."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
	
	
	
	
?>
<html>
	<head>
		<link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
	</head>
	<body style="background:#999999;">
	<div >
		<div >
				<!--halalaman coverrr--->
				<?php 
				if($_GET['coverpage']){
					//halaman cover ya bray
			?>
				<div class="page">
					<div style="<?=@get_ukuran_buku('kecil')?>;">
						<table width="100%" style="margin:font-size:14px;font-family: arial;" cellpadding="2px">
							<tr>
								<td width="50%">
									
								</td>
								<td width="50%">
									<div style="padding:5px;">
										<div align="center" style="margin-top:420px;">
											<div style="margin:10% 0 0 0;border:solid 0px #000000;width:100%;font-size:14px;padding:0px;border-radius:0px;"><b><?=@$abs->nm_pas?></b></div>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php } ?>
				<!--halalaman coverrr--->
				
				<!--page 1--->
				
				
				
			<?php 
				$f = range(1,22);
				if($f){ 
					$nm = 1;
					$nx = 22;
					foreach($f as $val){
					$um = $nm++;
					if($val > 11){
						$um = $nx--;
					}
			?>
			<?php if($_GET['viewpage'][$um]){ ?>
			<div class="page">
				<div style="<?=@get_ukuran_buku('kecil')?>;">
					<table width="100%" style="margin:font-size:14px;font-family: arial;" cellpadding="2px">
						<tr>
							<td width="50%">
								
							</td>
							<td width="40%">
								<div style="padding:5px;">
								<?php if($um == "1"){ ?>
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>IDENTITAS</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 5px 0 5px;">IDENTITY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 1px #000000" cellpadding="2px">
										<tr>
											<td style="padding:4px;width:5%">
												<span>Nama</span><br /><span style="border-top:solid 1px #000000;padding:0;"><i>Name</i></span>
											</td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3">
												<?=@$abs->nm_pas?>
											</td>
											<td style="border-left:solid 1px #000000;padding:4px;text-align:center;width:20%;">
												<span>Kelamin</span><br/><span style="border-top:solid 1px #000000;padding:0 10px 0 10px;">Sex</span><br /><?=@is_jenkelenid($abs->jenkel_pas, $_GET['lang'])?>
											</td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;width:20%" colspan="3"><span>Tempat & Tgl.Lahir</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Place & Date of Birth</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@$abs->tmp_lahir_pas?>,<br />
											<?php if($_GET['lang'] == "en"){ ?>
											<?=@date("F d, Y", strtotime($abs->tgl_lhr_pas))?>
											<?php } else { ?>
											<?=@the_time(date("Y-m-d", strtotime($abs->tgl_lhr_pas)))?>
											<?php } ?>
											</td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Kesatuan/Pekerjaan</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Occupation</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@$abs->nm_pekerjaan?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Status Perkawinan</span><br/><span style="border-top:solid 1px #000000;"><i>Marital State</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@$abs->kawin_pas?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Alamat Rumah/Telpon</span><br/><span style="border-top:solid 1px #000000;padding:0 25px 0 0;"><i>Residence/Phone</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@$abs->alamat_pas?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Alamat Pemberitahuan</span><br/><span style="border-top:solid 1px #000000;padding:0 50px 0 0;"><i>Report/Adress</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3">Telp. <?=@$abs->no_tlp_pas?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Kebangsaan</span><br/><span style="border-top:solid 1px #000000;padding:0 15px 0 0;"><i>Nationality</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@is_kebangsaan_en($abs->bangsa_pas, $_GET['lang'])?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>Tanggal Periksa</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Date of Examination</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
										</tr>
										<tr style="border-top:solid 1px #000000;">
											<td style="padding:4px;" colspan="3"><span>No Arsip</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>File Number</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;" colspan="3"><?=@$abs->no_filemcu?></td>
										</tr>
									</table>
								<?php } else if($um == "2") { ?>
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>KESIMPULAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 10px 0 10px;">SUMMARY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;height:8cm;">
										<tr >
											<td>
												<?php
													//$kesansaran['kesimpulan_saran']
												?>
												<?php
													//print_r($kesansaran);
													$dddd = unserialize($kesansaran['kesimpulan']);
													//$eeee = unserialize($kesansaran['detailsaran']);
												?>
												<table width="100%" style="font-size:14px;font-family: arial;margin:0;">
													<?php 
														foreach(range(1,10) as $gsdd){ 
															if($dddd[$gsdd] != ""){
													?>
													<tr>
														<td width="1%" style="padding:4px;"><?=@$gsdd?>. </td>
														<td style="padding:4px;"><?=@$dddd[$gsdd]?></td>
													</tr>
														<?php } ?>
													<?php } ?>
												</table>
											</td>
										</tr>
									</table>
								<?php } else if($um == "3") { ?>
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>SARAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0;">SUGGESTION</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;height:8cm;">
										<tr >
											<td>
												
											</td>
										</tr>
										<tr >
											<td>
												<!--<p style="margin:5px 0 10px 0"><?=@get_lang_hasil('p1', $_GET['lang'])?></p>-->
												<?php
													//print_r(unserialize($kesansaran['kesimpulan']));
												?>
												<?php
													$mcnsd = unserialize($kesansaran['kesimpulan']);
													$dsdsr = unserialize($kesansaran['saran']);
													$sfghs = unserialize($kesansaran['detailsaran']);
													//print_r($sfghs);
													if($mcnsd['atas'] != ""){
														echo "".$mcnsd['atas']."<br /><br />";
													}
													
												?>
												<table width="100%" style="font-size:14px;font-family: arial;margin:0;">
													<?php 
														$nskjfjkfd=1;
														foreach(range(1,10) as $gsdd){ 
															if($dsdsr[$gsdd] != "" OR $sfghs[$gsdd] != ""){
																$isisaraneok = $dsdsr[$gsdd];
																if(!empty($sfghs[$gsdd])){
																	$isisaraneok .= ": ". $sfghs[$gsdd];
																}
																$bsnbdn = $nskjfjkfd++;
													?>
													<tr>
														<td width="1%" style="padding:4px;"><?=@$bsnbdn?>. </td>
														<td style="padding:4px;"><?=@$isisaraneok?></td>
													</tr>
														<?php } ?>
													<?php } ?>
												</table>
												<?php
													//print_r($sfghs);
													if($mcnsd['bawah'] != ""){
														echo "<br /><br />".$mcnsd['bawah']."";
													}
												?>
											</td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;">
										<td></td>
										<td width="20%"></td>
													<td>
														<div align="center">
															<?php
																	//ambil nama penanggung jawab kodde KALA
																	$this->db->where('kd_dok', 'KALA');
																	$kklids = $this->db->get('tb_dokter');
																	$sghdfs = $kklids->row();
																	if($abs->def_ttd > 0){
																		$this->db->where('id_dok', $abs->def_ttd);
																		$cmb1 = $this->db->get('tb_dokter');
																		$sghdfs = $cmb1->row();
																	}
																?>
															<?=@get_lang_hasil('p2', $_GET['lang'])?><br/>
															<!--<?=@$sghdfs->golongan?><br/>-->
															<img src="<?=@base_url('qr/Q1-'.$abs->kode_transaksi.'.png')?>" style="width:35%">
															<br /><!--<br /><br /><br/>--><?=@$sghdfs->nm_dok?><br />
															<?php if($_GET['lang'] == "en"){ ?>
															<?=@$sghdfs->pangkat_en?>
															<?php } else { ?>
															<?=@$sghdfs->pangkat?>
															<?php } ?>
														</div>
													</td>
									</table>
								<?php } else if($um == "4") { ?>
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>RIWAYAT KESEHATAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 50px 0 50px;">HISTORY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
										<tr>
											<td style="padding:4px;width:38%"><span>Keluhan Utama</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Chief Complaint</i></span></td>
											<td width="1%" style="padding:4px;">:</td>
											<td style="padding:4px;"><?=@$getAnamnesa?></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;margin:10px 0 0 0">
										<tr>
											<td colspan="6" style="padding:0 0 5px 0;"><span>Penyakit yang pernah diderita :</span><br/><span style="border-top:solid 1px #000000;padding:0 100px 0 0"><i>Past History</i></span></td>
										</tr>
										<tr>
											<?php
												$sasc = 1;
												foreach(is_penyakit_lama() as $gsf => $sgd){ 
												$trsa = $sasc++;
												$jufd = "";
												$sgshbx = '<img src="'.base_url('assets/img/cekdua.png').'" style="width:14px;">';
												if($getcek['riwayatpasien'][$gsf]){
													$sgshbx = '<img src="'.base_url('assets/img/ceksatu.png').'" style="width:14px;">';
												}
												
											?>
												<td width="5%" style="vertical-align:middle"><?=@$sgshbx?></td>
												<td width="30%"><span><?=@$gsf?></span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0"><i><?=@$sgd?></i></span></td>
											<?php 
												if($trsa > 2){
													$sasc = 1;
													echo "</tr><tr>";
												}
											} ?>
												<td colspan="4"><?=@$getcekisiok['riwayatpasien']['Lainnya'] != "" ? ": ". $getcekisiok['riwayatpasien']['Lainnya'] : ""?></td>
											</tr>
											<tr>
												<td colspan="6" style="padding:10px 0 0 0;"><?=@get_lang_hasil('p3', $_GET['lang'])?> : <?=@$val3?></td>
											</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;margin:10px 0 0 0">
										<tr>
											<td colspan="6" style="padding:0 0 5px 0;"><span>Penyakit Keluarga :</span><br/><span style="border-top:solid 1px #000000;padding:0 20px 0 0"><i>Family History</i></span></td>
										</tr>
										<tr>
											<?php
												$sasc = 1;
												foreach(is_penyakit_keluarga() as $gsf => $sgd){ 
												$trsa = $sasc++;
												$jufd = "";
												if($getcek['riwayatkeluarga'][$gsf]){
													$jufd = 'checked="true"';
												}
												$sgshbsg = '<img src="'.base_url('assets/img/cekdua.png').'" style="width:14px;">';
												if($getcek['riwayatkeluarga'][$gsf]){
													$sgshbsg = '<img src="'.base_url('assets/img/ceksatu.png').'" style="width:14px;">';
												}
											?>
												<td width="5%" style="vertical-align:middle"><?=@$sgshbsg?></td>
												<td width="30%"><span><?=@$gsf?></span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0"><i><?=@$sgd?></i></span></td>
											<?php 
												if($trsa > 2){
													$sasc = 1;
													echo "</tr><tr>";
												}
											} ?>
											<td colspan="6"><?=@$getcekisiok['riwayatkeluarga']['Lainnya'] != "" ? ": ". $getcekisiok['riwayatkeluarga']['Lainnya'] : ""?></td>
											</tr>
											<tr>
												<td colspan="6" style="padding:10px 0 0 0;"><?=@get_lang_hasil('p3', $_GET['lang'])?> : <?=@$val4?></td>
											</tr>
									</table>
									<?php } else if($um == "5") { ?>
										<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
											<tr>
												<td colspan="3"><div align="center">
													<h3 style="font-size:15px;font-weight:bold;"><span>PEMERIKSAAN UMUM</span><br/>
													<span style="border-top:solid 1px #000000;padding:0;">PHYSICAL EXAMINATION</span></h3>
												</div></td>
											</tr>
										</table>
										<table width="125%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:40%"><span>Tinggi Badan</span><br/><span style="border-top:solid 1px #000000;"><i>Height</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['tinggibadan']?></td>
												<td style="padding:4px;">cm</td>
												<td style="padding:4px;" width="20%"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Berat Badan</span><br/><span style="border-top:solid 1px #000000;"><i>Weight</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['beratbadan']?></td>
												<td style="padding:4px;">kg</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Berat Badan Ideal</span><br/><span style="border-top:solid 1px #000000;"><i>Ideal Body Weight</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['beratbadanideal']?></td>
												<td style="padding:4px;">kg</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Berat Badan Minimal</span><br/><span style="border-top:solid 1px #000000;"><i>Minimal Body Weight</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['beratbadanmin']?></td>
												<td style="padding:4px;">kg</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Berat Badan Maksimal</span><br/><span style="border-top:solid 1px #000000;"><i>Maximal Body Weight</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['beratbadanmax']?></td>
												<td style="padding:4px;">kg</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Tekanan Darah</span><br/><span style="border-top:solid 1px #000000;"><i>Blood Pressure</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['tekanan_darah1']?>/<?=@$pemkss['tekanan_darah2']?></td>
												<td style="padding:4px;">mmHg</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Denyut Nadi</span><br/><span style="border-top:solid 1px #000000;"><i>Pulse Rate</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['nadi']?></td>
												<td style="padding:4px;">/Menit<br />/Minute</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Frekwensi Pernapasan</span><br/><span style="border-top:solid 1px #000000;"><i>Respiration Rate</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['pernafasan']?></td>
												<td style="padding:4px;">/Menit<br />/Minute</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Lingkaran Dada</span><br/><span style="border-top:solid 1px #000000;"><i>Chest Circumference</i></span></td>
												<td width="1%"></td>
												<td style="padding:4px;"></td>
												<td style="padding:4px;"></td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="margin:0 0 0 10px">a. Ekspirasi</span><br/><span style="margin:0 0 0 20px;"></span><span style="border-top:solid 1px #000000;"><i>Expiration</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['lingkardada1']?></td>
												<td style="padding:4px;">cm</td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="margin:0 0 0 10px">b. Inspirasi</span><br/><span style="margin:0 0 0 20px;"></span><span style="border-top:solid 1px #000000;"><i>Inspiration</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['lingkardada2']?></td>
												<td style="padding:4px;">cm</td>
												<td style="padding:4px;"></td>
											</tr>
										</table>
									<?php } else if($um == "6") { ?>
										<?php
											//print_r($pemkss);
										?>
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:50%"><span>Lingkaran Perut</span><br/><span style="border-top:solid 1px #000000;"><i>Abdominal Circumference</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;"><?=@$pemkss['lingkarperut']?></td>
												<td style="padding:4px;">cm</td>
												<td style="padding:4px;" width="10%"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Kulit</span><br/><span style="border-top:solid 1px #000000;"><i>skin</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P2']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">kelenjar Getah Bening</span><br/><span><i>Lymph Nodes</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Kepala</span><br/><span style="border-top:solid 1px #000000;"><i>Head</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P4']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Leher</span><br/><span style="border-top:solid 1px #000000;"><i>Neck</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P5']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Kelenjar Gondok</span><br/><span><i>Thyroid</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P6']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Dada</span><br/><span style="border-top:solid 1px #000000;"><i>Thoraric Cage</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P7']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Paru-Paru</span><br/><span><i>Lung</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P8']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Jantung</span><br/><span style="border-top:solid 1px #000000;"><i>Heart</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P9']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Perut</span><br/><span style="border-top:solid 1px #000000;"><i>Abdomen</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P10']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Hati & Kandungan Empedu</span><br/><span><i>Liver & Gall Bladder</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['6P11']?></td>
											</tr>
										</table>
										
									<?php } else if($um == "7") { ?>
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:50%"><span>Limpa</span><br/><span style="border-top:solid 1px #000000;"><i>Spleen</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P1']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Ginjal</span><br/><span style="border-top:solid 1px #000000;"><i>Kidney</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P2']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span >Usus</span><br/><span style="border-top:solid 1px #000000;"><i>Intestines</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Poros Usus & Dubur</span><br/><span ><i>Anus & Rectum</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P4']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Sistem Urogenital</span><br/><span style="border-top:solid 1px #000000;"><i>Genito Urinary System</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P5']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Anggota Gerak</span><br/><span><i>U/L Extremities</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P6']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span ><i>Others</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['7P7']?></td>
											</tr>
										</table>
										
										
										<?php } else if($um == "8") { ?>
										<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span style="border-bottom:solid 1px #000000;">PEMERIKSAAN THT</span><br/>
												<span >ENT EXAMINATION</span></h3>
											</div></td>
										</tr>
									</table>
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:50%" colspan="2"><span style="border-bottom:solid 1px #000000;">Telinga</span><br/><span ><i>Ear</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['8P1']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="2"><span style="border-bottom:solid 1px #000000;">Hidung</span><br/><span ><i>Nose</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['8P2']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="2"><span style="border-bottom:solid 1px #000000;">Tenggorokan</span><br/><span><i>Throat</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['8P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="4"><span>Audiogram</span><br/><span style="border-top:solid 1px #000000;"><i>Audiogram</i></span></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:28%"><span >Kanan</span><br/><span style="border-top:solid 1px #000000;"><i>Right</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['8P4']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span>Kiri</span><br/><span style="border-top:solid 1px #000000;"><i>Left</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['8P5']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="4"><span>Timpanogram</span><br/><span style="border-top:solid 1px #000000;"><i>Tympanogram</i></span></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:28%"><span >Kanan</span><br/><span style="border-top:solid 1px #000000;"><i>Right</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['8P6']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span>Kiri</span><br/><span style="border-top:solid 1px #000000;"><i>Left</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['8P7']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="2"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span ><i>Others</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['8P8']?></td>
											</tr>
										</table>
										
										<?php } else if($um == "9") { ?>
										<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span style="border-bottom:solid 1px #000000;">GIGI - GELIGI</span><br/>
												<span >DENTISTRY</span></h3>
											</div></td>
										</tr>
									</table>
										<?php
										
											$this->db->select("posisi_struktur_gigi, warna_kelainan_gigi, hasilnya, id_reg_detpem");
											$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
											$this->db->where("apakah_struktur_gigi", "Y");
											$jshdc = $this->db->get("tb_register_detailpemeriksaan");
											$nhdsv = $jshdc->result();
											foreach($nhdsv as $gdgl){
												if(!empty($gdgl->warna_kelainan_gigi)){
													$getkelainan[$gdgl->posisi_struktur_gigi] = $gdgl->warna_kelainan_gigi;
													$loopkelainan[$gdgl->posisi_struktur_gigi] = $gdgl;
												}
											}
					
					
											$strukturgigikiri = array(
													'18' => array('id' => 18, 'transfom' => '0,0'),
													'17' => array('id' => 17, 'transfom' => '25,0'),
													'16' => array('id' => 16, 'transfom' => '50,0'),
													'15' => array('id' => 15, 'transfom' => '75,0'),
													'14' => array('id' => 14, 'transfom' => '100,0'),
													'13' => array('id' => 13, 'transfom' => '125,0'),
													'12' => array('id' => 12, 'transfom' => '150,0'),
													'11' => array('id' => 11, 'transfom' => '175,0'),
													'55' => array('id' => 55, 'transfom' => '75,40'),
													'54' => array('id' => 54, 'transfom' => '100,40'),
													'53' => array('id' => 53, 'transfom' => '125,40'),
													'52' => array('id' => 52, 'transfom' => '150,40'),
													'51' => array('id' => 51, 'transfom' => '175,40'),
													'85' => array('id' => 85, 'transfom' => '75,80'),
													'84' => array('id' => 84, 'transfom' => '100,80'),
													'83' => array('id' => 83, 'transfom' => '125,80'),
													'82' => array('id' => 82, 'transfom' => '150,80'),
													'81' => array('id' => 81, 'transfom' => '175,80'),
													'48' => array('id' => 48, 'transfom' => '0,120'),
													'47' => array('id' => 47, 'transfom' => '25,120'),
													'46' => array('id' => 46, 'transfom' => '50,120'),
													'45' => array('id' => 45, 'transfom' => '75,120'),
													'44' => array('id' => 44, 'transfom' => '100,120'),
													'43' => array('id' => 43, 'transfom' => '125,120'),
													'42' => array('id' => 42, 'transfom' => '150,120'),
													'41' => array('id' => 41, 'transfom' => '175,120'),
												);



												$strukturgigikanan = array(
													'21' => array('id' => 21, 'transfom' => '210,0'),
													'22' => array('id' => 22, 'transfom' => '235,0'),
													'23' => array('id' => 23, 'transfom' => '260,0'),
													'24' => array('id' => 24, 'transfom' => '285,0'),
													'25' => array('id' => 25, 'transfom' => '310,0'),
													'26' => array('id' => 26, 'transfom' => '335,0'),
													'27' => array('id' => 27, 'transfom' => '360,0'),
													'28' => array('id' => 28, 'transfom' => '385,0'),
													'61' => array('id' => 61, 'transfom' => '210,40'),
													'62' => array('id' => 62, 'transfom' => '235,40'),
													'63' => array('id' => 63, 'transfom' => '260,40'),
													'64' => array('id' => 64, 'transfom' => '285,40'),
													'65' => array('id' => 65, 'transfom' => '310,40'),
													'71' => array('id' => 71, 'transfom' => '210,80'),
													'72' => array('id' => 72, 'transfom' => '235,80'),
													'73' => array('id' => 73, 'transfom' => '260,80'),
													'74' => array('id' => 74, 'transfom' => '285,80'),
													'75' => array('id' => 75, 'transfom' => '310,80'),
													'31' => array('id' => 31, 'transfom' => '210,120'),
													'32' => array('id' => 32, 'transfom' => '235,120'),
													'33' => array('id' => 33, 'transfom' => '260,120'),
													'34' => array('id' => 34, 'transfom' => '285,120'),
													'35' => array('id' => 35, 'transfom' => '310,120'),
													'36' => array('id' => 36, 'transfom' => '335,120'),
													'37' => array('id' => 37, 'transfom' => '360,120'),
													'38' => array('id' => 38, 'transfom' => '385,120'),
												);
												$pict1 = array(
													'C' => '5,5 	15,5 	15,15 	5,15',
													'T' => '0,0 	20,0 	15,5 	5,5',
													'B' => '5,15 	15,15 	20,20 	0,20',
													'R' => '15,5 	20,0 	20,20 	15,15',
													'L' => '0,0 	5,5 	5,15 	0,20',
												);




												$pict2 = array(
													'C' => '4,4 	12,4 	12,12 	4,12',
													'T' => '0,0 	16,0 	12,4 	4,4',
													'B' => '4,12 	12,12 	16,16 	0,16',
													'R' => '12,4 	16,0 	16,16 	12,12',
													'L' => '0,0 	4,4 	4,12 	0,16',
												);

												$lokasibesar = array(
													'C' => 'x="8" y="12" ',
													'T' => 'x="8" y="4"  ',
													'B' => 'x="7" y="19"  ',
													'R' => 'x="15" y="12" ',
													'L' => 'x="-1" y="12" ',
												);

												$lokasikecil = array(
													'C' => 'x="5" y="9" ',
													'T' => 'x="5" y="3"  ',
													'B' => 'x="5" y="16"  ',
													'R' => 'x="12" y="9" ',
													'L' => 'x="0" y="9" ',
												);
												
												$sltttt = '<div id="svgselect" style="width: 120%;">
													<svg version="1" width="100%">
														<g transform="scale(0.9)" id="gmain">';
														foreach($strukturgigikiri as $vllok){ 
															$sltttt .= '<g id="P'.$vllok['id'].'" transform="translate('.$vllok['transfom'].')">';
																$pict = $pict1;
																$lokasi = $lokasibesar;
																$ukuran = "4pt";
																if($vllok['id'] > 50){
																	$ukuran = "3pt";
																	$lokasi = $lokasikecil;
																	$pict = $pict2;
																}
															foreach($pict as $kjj => $gsfs){ 
																	$warnaku = "";
																	$kods = "P".$vllok['id']."-". $kjj;
																	if(isset($getkelainan[$kods])){
																		$warnaku = $getkelainan[$kods];
																	}
																$sltttt .= '<polygon points="'.@$gsfs.'" fill="white" stroke="navy" stroke-width="0.5" id="'.@$kjj.'" opacity="1"></polygon>';
																$sltttt .= '<text '.$lokasi[$kjj].' stroke="black" fill="black" stroke-width="0.1" style="font-size: '.@$ukuran.';font-weight:normal;color:black;text-align:center">'.@$warnaku.'</text>';
															} 
																$sltttt .= '<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal">'.@$vllok['id'].'</text>
															</g>';
															}
															
															foreach($strukturgigikanan as $vllok){ 
															$sltttt .= '<g id="P'.$vllok['id'].'" transform="translate('.$vllok['transfom'].')">';
																$pict = $pict1;
																$lokasi = $lokasibesar;
																$ukuran = "4pt";
																if($vllok['id'] > 50){
																	$ukuran = "3pt";
																	$lokasi = $lokasikecil;
																	$pict = $pict2;
																}
															foreach($pict as $kjj => $gsfs){ 
																	$warnaku = "";
																	$kods = "P".$vllok['id']."-". $kjj;
																	if(isset($getkelainan[$kods])){
																		$warnaku = $getkelainan[$kods];
																	}
																$sltttt .= '<polygon points="'.@$gsfs.'" fill="white" stroke="navy" stroke-width="0.5" id="'.@$kjj.'" opacity="1"></polygon>';
																$sltttt .= '<text '.$lokasi[$kjj].' stroke="black" fill="black" stroke-width="0.1" style="font-size: '.@$ukuran.';font-weight:normal;color:black;text-align:center">'.$warnaku.'</text>';
															} 
																$sltttt .= '<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal">'.@$vllok['id'].'</text>
															</g>';
															}
															
															
															
														$sltttt .='</g>
														</svg>
													</div>';
													echo $sltttt;
										?>
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:35%"><span style="border-bottom:solid 1px #000000;">Foto Panorex</span><br/><span ><i>Panorex</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P1']?></td>
											</tr>
											<tr>
												<td style="padding:10px;" colspan="10"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Pro Ekstrasi</span><br/><span style="border-top:solid 1px #000000;"><i>Pro Extraction</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P2']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span >Pro Konservasi</span><br/><span style="border-top:solid 1px #000000;"><i>Pro Conservation</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Pro Protesa</span><br/><span style="border-top:solid 1px #000000;"><i>Pro Denture</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P4']?></td>
											</tr>
											<tr>
												<td style="padding:4px;width:63%" colspan="3"><span style="border-bottom:solid 1px #000000;">Pro Pembersihan Karang-Karang Gigi</span><br/><span ><i>Pro Scaling</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P5']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span><i>Others</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['9P6']?></td>
											</tr>
										</table>
										
										
										<?php } else if($um == "10") { ?>
										<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span style="border-bottom:solid 1px #000000;">PEMERIKSAAN MATA</span><br/>
												<span >OPHTHALMOLOGY</span></h3>
											</div></td>
										</tr>
									</table>
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:4px;" colspan="10"><span>Visus</span><br/><span style="border-top:solid 1px #000000;"><i>Visual Aquity</i></span></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:1%"><span>a.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:12%"><span style="border-bottom:solid 1px #000000;">Kanan</span><br/><span><i>Right</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['10P1']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;width:1px"></td>
												<td style="padding:4px;"><span>Koreksi</span><br/><span style="border-top:solid 1px #000000;"><i>Correction</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['10P2']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;width:1px"><span>b.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span>Kiri</span><br/><span style="border-top:solid 1px #000000;"><i>Left Eye</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['10P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;width:1px"></td>
												<td style="padding:4px;"><span>Koreksi</span><br/><span style="border-top:solid 1px #000000;"><i>Correction</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['10P4']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:2px;" colspan="2"><span>Presbiopia</span><br/><span style="border-top:solid 1px #000000;"><i>Presbyopia</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;width:25%"><?=@$sethasilpem['10P5']?></td>
												<td style="padding:4px;width:2%"></td>
												<td style="padding:2px;width:15%"><span></span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:4px;"></td>
												<td style="padding:4px;"></td>
											</tr>
											<tr>
												<td style="padding:2px;width:30%" colspan="5"><span>Membedakan Warna</span><br/><span style="border-top:solid 1px #000000;"><i>Color Vision</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['10P7']?></td>
											</tr>
											<tr style="display:none;">
												<td style="padding:4px;" colspan="5"><span>Pergerakan otot bola mata</span><br/><span style="border-top:solid 1px #000000;"><i>Muscle Balance</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['10P8']?></td>
											</tr>
										</table>
										
										
										<?php } else if($um == "11") { ?>
										
										<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:1px;" colspan="10"><span>Tekanan Bola Mata</span><br/><span style="border-top:solid 1px #000000;"><i>Intra Ocular Pressure</i></span></td>
											</tr>
											<tr>
												<td style="padding:1px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:1px;width:45%"><span >Kanan</span><br/><span style="border-top:solid 1px #000000;"><i>Right Eye</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="5"><?=@$sethasilpem['11P1']?></td>
											</tr>
											
											<tr>
												<td style="padding:1px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:1px;"><span>Kiri</span><br/><span style="border-top:solid 1px #000000;"><i>Left Eye</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="5"><?=@$sethasilpem['11P2']?></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="2"><span>Anterior Segment</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P3']?></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="2"><span>Posterior Segment</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P101']?></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="2"><span>Media</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P4']?></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="2"><span>Fundus</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P5']?></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="2"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span ><i>Others</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P6']?></td>
											</tr>
										</table>
										<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="0px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >PEMERIKSAAN FAAL PARU</span><br/>
												<span style="border-top:solid 1px #000000;">PULMONARY FUNCTION TEST</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:1px;width:34%"><span>Predicted Vol</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P7']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>FVC</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P8']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>FEV<sub>1</sub></span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P9']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>PFR</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P10']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Restriktif</span><br/><span style="border-top:solid 1px #000000;"><i>Restrictive</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P11']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Obstruktif</span><br/><span style="border-top:solid 1px #000000;"><i>Obstructive</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P12']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span ><i>Others</i></span></td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" colspan="3"><?=@$sethasilpem['11P13']?></td>
											</tr>
									</table>
									
									<?php } else if($um == "12") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >PEMERIKSAAN NEUROLOGI</span><br/>
												<span style="border-top:solid 1px #000000;">NEUROLOGICAL EXAMINATION</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:2px;width:50%"><span>Fungsi Motorik </span><br/><span style="border-top:solid 1px #000000;"><i>Motoric Function</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P1']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span>Fungsi Sensorik</span><br/><span style="border-top:solid 1px #000000;"><i>Sensoric Function</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P2']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span>Refrek</span><br/><span style="border-top:solid 1px #000000;"><i>Reflexes</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P3']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span style="border-bottom:solid 1px #000000;">Lain-lain</span><br/><span ><i>Others</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P4']?></td>
											</tr>
											
											<tr>
												<td style="padding:5px;" colspan="3"></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span >Romberg</span><br/><span style="border-top:solid 1px #000000;"><i>Romberg</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$setkesimpulanauto['AUTO_KESIMPULAN_IDTIND_6662']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span >EEG</span><br/><span style="border-top:solid 1px #000000;"><i>(Elektro Encephalogam)</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P5']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span >TCD</span><br/><span style="border-top:solid 1px #000000;"><i>Trans Cranial Doppler</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="3"><?=@$sethasilpem['12P6']?></td>
											</tr>
									</table>
									
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >PEMERIKSAAN OBSTETRI & GINEKOLOGI</span><br/>
												<span style="border-top:solid 1px #000000;">OBSTETRICAL & GYNAECOLOGICAL EXAM</span></h3>
											</div></td>
										</tr>
									</table>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:50%"><span>Ginekologi </span><br/><span style="border-top:solid 1px #000000;"><i>Ginekologi</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['12P41']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Papsmear</span><br/><span style="border-top:solid 1px #000000;"><i>Papsmear</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['12P42']?></td>
											</tr>
									</table>
									
									<?php } else if($um == "13") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >EKG (ELEKTROKARDIOGRAFI)</span><br/>
												<span style="border-top:solid 1px #000000;">ECG (ELECTROCARDIOGRAPHY)</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											
									</table>
									
									
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:2px;width:34%"><span>Resting</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['13P1']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span>MST (Master Step Test)</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['13P2']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span>Treadmill Test</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['13P3']?></td>
											</tr>
											<tr>
												<td style="padding:2px;"><span>Ergocycle</span><br/><span ><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['13P4']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"><span>Kesimpulan</span><br/><span style="border-top:solid 1px #000000;"><i>Conclusion</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$setkesimpulanauto['AUTO_KESIMPULAN_IDTIND_6556']?></td>
											</tr>
									</table>
									
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >PEMERIKSAAN RADIOLOGI</span><br/>
												<span style="border-top:solid 1px #000000;">X-RAY EXAMINATION</span></h3>
											</div></td>
										</tr>
									</table>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:4px;font-weight:bold;" colspan="10"><span>Thorax</span><br/><span style="border-top:solid 1px #000000;"><i>Thorax</i></span></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:35%"><span >Sinus & Diafragma</span><br/><span style="border-top:solid 1px #000000;"><i>Sinus & Diaphragma </i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['13P6']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span style="border-bottom:solid 1px #000000;">Jantung</span><br/><span ><i>Heart</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['13P7']?></td>
											</tr>
									</table>
									
									
									
									<?php } else if($um == "14") { ?>
									
									
									
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:43%"><span >Paru </span><br/><span style="border-top:solid 1px #000000;"><i>Lung</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['14P1']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:43%"><span >Tulang Rongga Dada </span><br/><span style="border-top:solid 1px #000000;"><i>Chest Cavity</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['14P2']?></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:43%"><span >Lain-lain </span><br/><span style="border-top:solid 1px #000000;"><i>Others</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['14P21']?></td>
											</tr>
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span >Kesan</span><br/><span style="border-top:solid 1px #000000;"><i>Conclusion</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['AUTO_KESAN_IDTIND_6626']?></td>
											</tr>
											<tr>
												<td style="padding:4px;width:5%"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;width:43%"><span >Pemeriksaan Foto Lain </span><br/><span style="border-top:solid 1px #000000;"><i>Other Examination</i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['14P3']?></td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="2"><span >CT Scanning</span><br/><span style="border-top:solid 1px #000000;" ><i>Computer Tomograph</i></span><br />Scanning</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><?=@$sethasilpem['14P5']?></td>
											</tr>
											
											
											<tr>
												<td style="padding:2px;" colspan="2"><span>USG Abdomen </span><br/><span style="border-top:solid 1px #000000;"><i>USG Abdomen</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="5"><?=@$sethasilpem['12P7']?></td>
											</tr>
											<tr>
												<td style="padding:2px;" colspan="2"><span>USG Mammae</span><br/><span style="border-top:solid 1px #000000;"><i>USG Mammae</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="5"><?=@$sethasilpem['12P8']?></td>
											</tr>
											<tr>
												<td style="padding:2px;" colspan="2"><span>USG Tyroid</span><br/><span style="border-top:solid 1px #000000;"><i>USG Tyroid</i></span></td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="5"><?=@$sethasilpem['12P9']?></td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="2"><span ><br />BMD</span><br/></td>
												<td width="1%" style="padding:4px;"></td>
												<td style="padding:4px;" colspan="5"><b></b></td>
											</tr>
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span >Lumbar Spine</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><b><?=@$sethasilpem['14P11']?></b></td>
											</tr>
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span >Right Hip</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><b><?=@$sethasilpem['14P12']?></b></td>
											</tr>
											<tr>
												<td style="padding:4px;width:1px"><span></span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td style="padding:4px;"><span >Left Hip</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="5"><b><?=@$sethasilpem['14P13']?></b></td>
											</tr>
											
									</table>
									
									
									<?php } else if($um == "15") { ?>
									
									
									
									<table width="100%" style="font-size:14px;font-family: arial;" cellpadding="2px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span >PEMERIKSAAN LABORATORIUM</span><br/>
												<span style="border-top:solid 1px #000000;">LABORATORY EXAMINATION</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:65%;font-weight:bold;" colspan="4"><span style="border-bottom:solid 1px #000000;">HEMATOLOGI</span><br/><span ><i>Hematology</i></span></td>
												<td style="padding:4px;font-weight:bold;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:35%" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Golongan Darah/Rhesus</span><br/>
													<span ><i>Blood Group/Rhesus</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;width:15%" ><?=@$sethasilpem['15P1']?></td>
												<td style="padding:4px;" ><div align="right"></div></td>
											</tr>
											
											<!--<tr>
												<td style="padding:4px;" colspan="2">
													<span >Rhesus Faktor</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Rhesus Factor</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P2']?></td>
												<td style="padding:4px;" ><div align="right"></div></td>
											</tr>-->
											
											<tr>
												<td style="padding:4px;" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Laju Endap Darah</span><br/>
													<span ><i>E S R</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P3']?></td>
												<td style="padding-top:4px;" >
													<div align="right">
														<span style="border-bottom:solid 1px #000000;"><50 TH:P(Male)&#8804;10mm/1jam</span>
														<span>W(Female)&#8804;20mm/1jam</span><br />
														<span style="border-bottom:solid 1px #000000;">>50 TH:P(Male)&#8804;20mm/1jam</span><br />
														<span>W(Female)&#8804;30mm/1jam</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:10px 4px 4px 4px;" colspan="2">
													<span >Hemoglobin</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Hemoglobine</i></span>
												</td>
												<td width="1%" style="padding:10px 4px 4px 4px;">:</td>
												<td style="padding:10px 4px 4px 4px;"><?=@$sethasilpem['15P4']?></td>
												<td style="padding:10px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) 13-16 g/dL</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) 12-14 g/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="2">
													<span >Lekosit</span><br/>
													<span style="border-top:solid 1px #000000;"><i>White Blood Cells</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P5']?></td>
												<td style="padding:4px;" >
													<div align="right">
														<span>5.000 - 10.000/uL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="2">
													<span >Eritrosit</span><br/>
													<span style="border-top:solid 1px #000000;"><i>black Blood Cells</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P6']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) 4,5-5,5 jt/uL</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) 4,0-5,0 jt/uL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="2">
													<span ><?=@get_lang_hasil('p25', $_GET['lang'])?></span><br/>
													<span ><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P7']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) 40-48%</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) 37-43%</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="2">
													<span ><?=@get_lang_hasil('p26', $_GET['lang'])?></span><br/>
													<span ><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['15P8']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>150.000 - 400.000/uL</span>
													</div>
												</td>
											</tr>
											
									</table>
									
									<?php } else if($um == "16") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:65%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;">Hitung Jenis</span><br/><span ><i>Diff. Count</i></span></td>
												<td style="padding:4px;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:1%">
													<span>a.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;width:20%">
													<span>Eosinofil</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Eosinophilic</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;width:25%" ><?=@$sethasilpem['16P1']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>1 - 3 %</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>b.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span>Basofil</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Basophilic</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P2']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>0 - 1 %</span>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>c.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span>Netrofil</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Neutrophilic</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P3']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>50 - 70 %</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>d.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span>Limfosil</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Lymphocyte</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P4']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>20 - 40 %</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>e.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span >Monosit</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Monocyte</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P5']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>2 - 8 %</span>
													</div>
												</td>
											</tr>
											
											
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span style="border-bottom:solid 1px #000000;">Masa Pendarahan</span><br/>
													<span ><i>Bleeding Time</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P6']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >1 - 6 Menit</span><br />
														<span style="border-top:solid 1px #000000;">1 - 6 Minute</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span style="border-bottom:solid 1px #000000;">Masa Pembekuan</span><br/>
													<span ><i>Clotting Time</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P7']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >2 - 6 Menit</span><br />
														<span style="border-top:solid 1px #000000;">2 - 6 Minute</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >MCV</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P8']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >82 - 92 fL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >MCH</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P9']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >27 - 31 pg</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >MCHC</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['16P10']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >32 - 36 gr/dl</span>
													</div>
												</td>
											</tr>
											
									</table>
									
									
									
									<?php } else if($um == "17") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:1px;width:65%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;">HEMOSTASIS</span><br/><span ><i></i></span></td>
												<td style="padding:1px;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p19', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><b><?=@$sethasilpem['17P22']?></b></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span ></span>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding:1px;width:65%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;">KIMIA DARAH</span><br/><span ><i>Blood Chemistry</i></span></td>
												<td style="padding:1px;text-align:right"><span > &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i></i></span></td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="4">
													<span >Gula Darah</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Blood Glucose</i></span>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;width:5%"></td>
												<td style="padding:1px;width:1%">
													<span>a.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:1px;width:20%">
													<span>Puasa</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Fasting</i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;width:25%" ><?=@$sethasilpem['17P1']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span>70 - 110 mg/dL<span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;"></td>
												<td style="padding:1px;">
													<span>b.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:1px;">
													<span>2 Jam PP</span>
													<br/><span style="border-top:solid 1px #000000;"><i>2 Hours PP</i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P2']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span>70 - 140 mg/dL</span>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding:1px;"></td>
												<td style="padding:1px;">
													<span>c.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:1px;" colspan="3">
													<span>Glukosa Sewaktu</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Blood Glucose</i></span>
												</td>
												<td style="padding:1px;">: <?=@$sethasilpem['17P21']?></td>
											</tr>
											<tr>
												<td style="padding:1px;"></td>
												<td style="padding:1px;">
													<span>d.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:1px;" colspan="3">
													<span>Glukosa Toleransi Tes (GTT)</span>
													<br/><span style="border-top:solid 1px #000000;"><i>Glucose Tolerance Test</i></span>
												</td>
												<td style="padding:1px;">: <?=@$sethasilpem['17P3']?></td>
											</tr>
											
											
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p20', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P4']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span ><200 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span >HDL Cholesterol</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P5']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span >>40 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span >LDL Cholesterol</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P6']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span ><100 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p21', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P7']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span ><150 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p22', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P8']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span ><50 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p23', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P9']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span >P<1,3 mg/dL ; W<1,2 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:1px;" colspan="3">
													<span ><?=@get_lang_hasil('p24', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:1px;">:</td>
												<td style="padding:1px;" ><?=@$sethasilpem['17P10']?></td>
												<td style="padding:1px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) < 7 mg/dL</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) <5,7 mg/dL</span>
													</div>
												</td>
											</tr>
											
									</table>
									
									
									
									<?php } else if($um == "18") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:60%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;"></span><br/><span ><i></i></span></td>
												<td style="padding:4px;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											<tr>
												<td style="padding:6px;" colspan="10">
													
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span ><?=@get_lang_hasil('p15', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P1']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><1 mg/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:1%">
													<span>a.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;width:20%">
													<span><?=@get_lang_hasil('p16', $_GET['lang'])?></span>
													<br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P2']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>< 0,3 mg/dL<span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>b.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span><?=@get_lang_hasil('p17', $_GET['lang'])?></span>
													<br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P3']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span>< 0,70 mg/dL</span>
													</div>
												</td>
											</tr>
											
											
											
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span ><?=@get_lang_hasil('p18', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P4']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >6,6 - 8,7 gr/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:1%">
													<span>a.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;width:20%">
													<span>Albumin</span>
													<br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;width:17%" ><?=@$sethasilpem['18P5']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >3,8 - 5,1 gr/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;">
													<span>b.</span><br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td style="padding:4px;">
													<span>Globulin</span>
													<br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P6']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >2,8 - 3,6 gr/dL</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Alkali Phospatase</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P7']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) (37&#176;C):<128 U/I</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) (37&#176;C):<98 U/I</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:10px;" colspan="10">
													
												</td>
											</tr>
											
											
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >SGPT</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P9']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) (37&#176;C):<46 U/I</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) (37&#176;C):<36 U/I</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >SGOT</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P8']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) (37&#176;C):<33 U/I</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) (37&#176;C):<27 U/I</span>
													</div>
												</td>
											</tr>
											
											
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Gamma GT</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P11']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >P(Male) (37&#176;C):<45-61 U/I</span><br />
														<span style="border-top:solid 1px #000000;">W(Female) (37&#176;C):<33-36 U/I</span>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Cholinesterase</span><br/>
													<span style="border-top:solid 1px #000000;"></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['18P12']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >5320 - 12920</span>
													</div>
												</td>
											</tr>
											
											
											
											
											
									</table>
									
									
									
									<?php } else if($um == "19") { ?>
									
									<table width="100%" style="font-size:13px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:2px;width:68%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;">PEMERIKSAAN KHUSUS</span><br/><span ><i>Special Examination</i></span></td>
												<td style="padding:2px;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											<tr>
												<td style="padding:3px;" colspan="10">
													
												</td>
											</tr>
											<tr>
												<td colspan="10">
													<table width="100%" style="font-size:13px;font-family: arial;border:solid 0PX;">
														<tr>
															<td style="padding:0pxwidth:28%">
																<span >- HBs Ag</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0pxwidth:1%">
																:
															</td>
															<td style="padding:0pxwidth:25%">
																<?=@$sethasilpem['19P1']?>
															</td>
															<td style="padding:0pxwidth:8%">
																
															</td>
															<td style="padding:0pxwidth:28%">
																<span >- PSA</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0pxwidth:1%">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P2']?>
															</td>
														</tr>
														
														<tr>
															<td style="padding:0px">
																<span >- Anti HBs</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P3']?>
															</td>
															<td style="padding:0px">
																
															</td>
															<td style="padding:0px">
																<span >- Anti HIV</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P4']?>
															</td>
														</tr>
														
														<tr>
															<td style="padding:0px">
																<span >- Anti HBc</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P5']?>
															</td>
															<td style="padding:0px">
																
															</td>
															<td style="padding:0px">
																<span >- HbA1C</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P6']?>
															</td>
														</tr>
														
														<tr>
															<td style="padding:0px">
																<span >- Anti HBe</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P7']?>
															</td>
															<td style="padding:0px">
																
															</td>
															<td style="padding:0px">
																<span >- TPHA</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P8']?>
															</td>
														</tr>
														
														<tr>
															<td style="padding:0px">
																<span >- Anti HCV</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P9']?>
															</td>
															<td style="padding:0px">
																
															</td>
															<td style="padding:0px">
																<span >- VDRL</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px">
																:
															</td>
															<td style="padding:0px">
																<?=@$sethasilpem['19P31']?>
															</td>
														</tr>
														<tr>
															<td style="padding:0px;">
																<span >- Vit D</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px;">
																:
															</td>
															<td style="padding:0px;">
																<?=@$sethasilpem['19P35']?>
															</td>
															<td style="padding:0px;">
																
															</td>
															<td style="padding:0px;">
																<span ></span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px;">
																
															</td>
															<td style="padding:0px;">
																<b></b>
															</td>
														</tr>
														<tr>
															<td style="padding:0px;" colspan="5">
																<span >- Rapid tes antibodi Anti SARS- CoV-2</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px;">
																:
															</td>
															<td style="padding:0px;">
																<b><?=@$sethasilpem['19P32']?></b>
															</td>
														</tr>
														<tr>
															<td style="padding:0px;" colspan="5">
																<span >- Swab Antigen SARS Cov-2</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:0px;">
																:
															</td>
															<td style="padding:0px;">
																<b><?=@$sethasilpem['19P101']?></b>
															</td>
														</tr>
														
														<tr>
															<td style="padding:4px;">
																<span >- IgM</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:4px;">
																:
															</td>
															<td style="padding:4px;">
																<b><?=@$sethasilpem['19P33']?></b>
															</td>
															<td style="padding:4px;">
																
															</td>
															<td style="padding:4px;">
																<span >- IgG</span><br/>
																<span style="border-top:solid 1px #000000;"><i></i></span>
															</td>
															<td style="padding:4px;">
																:
															</td>
															<td style="padding:4px;">
																<b><?=@$sethasilpem['19P34']?></b>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											
											<tr>
												<td style="padding:6px;" colspan="10">
													
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;" colspan="7">
													<span  style="border-bottom:solid 1px #000000;">URINE: </span><br/>
													<span><i></i></span>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;width:5%"></td>
												<td style="padding:2px;width:30%" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Warna</span>
													<br/><span ><i>Color</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="5"><?=@$sethasilpem['19P10']?></td>
											</tr>
											
											<tr>
												<td style="padding:2px;width:5%"></td>
												<td style="padding:2px;width:20%" colspan="2">
													<span><?=@get_lang_hasil('p12', $_GET['lang'])?></span>
													<br/><span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" colspan="5">
													<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
														<tr>
															<td style="padding:0;width:20%">
																<span ><?=@$sethasilpem['19P11']?></span>
															</td>
															<td style="padding:0;width:5%">
																;<?=@get_lang_hasil('p14', $_GET['lang'])?>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;width:20%">
																<span ><?=@$sethasilpem['19P12']?></span>
															</td>
															<td style="padding:0;width:5%">
																<span >;<?=@get_lang_hasil('p6', $_GET['lang'])?></span>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;">
																<?=@$sethasilpem['19P13']?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span ><?=@get_lang_hasil('p13', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i><i></i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P51']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span >Keasaman</span><br/>
													<span style="border-top:solid 1px #000000;"><i><i>Acidity</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P14']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span >4,6 - 8,5</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span >Berat Jenis</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Specific Gravity</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P15']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span >1,000 - 1,030</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span >Protein</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Protein</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P16']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Reduksi</span><br/>
													<span ><i>Sugar</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P17']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span >Urobilin</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Urobilin</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P18']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p28', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:2px;"></td>
												<td style="padding:2px;" colspan="2">
													<span >Bilirubin</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Bilirubin</i></span>
												</td>
												<td width="1%" style="padding:2px;">:</td>
												<td style="padding:2px;" ><?=@$sethasilpem['19P19']?></td>
												<td style="padding:2px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											
									</table>
									
									
									<?php } else if($um == "20") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:60%;font-weight:bold;" colspan="6"><span style="border-bottom:solid 1px #000000;">SEDIMEN</span><br/><span ><i>Sedimen</i></span></td>
												<td style="padding:4px;text-align:right"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											<tr>
												<td style="padding:3px;" colspan="10">
													
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:30%" colspan="2">
													<span >Lekosit</span>
													<br/><span style="border-top:solid 1px #000000;"><i>White Blood Cell</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['20P1']?></td>
												<td style="padding:4px;width:1%" >PlP</td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >0 - 8 /Lpb</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:5%"></td>
												<td style="padding:4px;width:20%" colspan="2">
													<span>Eritrosit</span>
													<br/><span style="border-top:solid 1px #000000;"><i>black Blood Cell</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['20P2']?></td>
												<td style="padding:4px;width:1%" >PlP</td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >0 - 3 /Lpb</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span >Epitel</span><br/>
													<span style="border-top:solid 1px #000000;"><i><i>Epithel</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['20P3']?></td>
												<td style="padding:4px;width:1%" >PlP</td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span >0 - 15 /Lpb</span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span >Kristal</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Crystal</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" ><?=@$sethasilpem['20P4']?></td>
												<td style="padding:4px;width:1%" >PlP</td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Lain-Lain</span><br/>
													<span ><i>Others</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3"><?=@$sethasilpem['20P5']?></td>
											</tr>
											
											
											<tr>
												<td style="padding:10px;" colspan="10">
													
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span style="border-bottom:solid 1px #000000;">FAECES</span><br/>
													<span ><i>Stool</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="3">Konsistensi : <?=@$sethasilpem['20P6']?></td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span >Makroskopis</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Macroscopis</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;vertical-align:top;" colspan="3">
													<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
														<tr>
															<td style="padding:0;width:10%">
																<span ><?=@get_lang_hasil('p5', $_GET['lang'])?></span><br/>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;">
																<?=@$sethasilpem['20P7']?>
															</td>
															<td style="padding:0;width:5%">
																<span ><?=@get_lang_hasil('p6', $_GET['lang'])?></span><br/>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;">
																<?=@$sethasilpem['20P8']?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span >Mikroskopis</span><br/>
													<span style="border-top:solid 1px #000000;"><i>Microscopis</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;vertical-align:top;" colspan="3">
													<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
														<tr>
															<td style="padding:0;width:10%">
																<span ><?=@get_lang_hasil('p7', $_GET['lang'])?></span><br/>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;width:20%">
																<?=@$sethasilpem['20P9']?>
															</td>
															<td style="padding:0;width:5%">
																<span ><?=@get_lang_hasil('p8', $_GET['lang'])?></span><br/>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;">
																<?=@$sethasilpem['20P10']?>
															</td>
														</tr>
														<tr>
															<td style="padding:0;width:10%">
																<span ><?=@get_lang_hasil('p9', $_GET['lang'])?></span><br/>
															</td>
															<td width="1%" style="padding:0;">:</td>
															<td style="padding:0;">
																<?=@$sethasilpem['20P11']?>
															</td>
															<td style="padding:0;" colspan="3">
																<span ><?=@get_lang_hasil('p10', $_GET['lang'])?></span>:  <?=@$sethasilpem['20P12']?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Darah Samar</span><br/>
													<span ><i>Blood</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;vertical-align:top;" colspan="3">
													<b><?=@$sethasilpem['20P15']?></b>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;"></td>
												<td style="padding:4px;" colspan="2">
													<span style="border-bottom:solid 1px #000000;">Lain-Lain</span><br/>
													<span ><i>Others</i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;vertical-align:top;" colspan="3">
													<?=@get_lang_hasil('p11', $_GET['lang'])?>: <?=@$sethasilpem['20P13']?>
												</td>
											</tr>
											
											
											
											
									</table>
									
									<?php } else if($um == "21") { ?>
									
									<table width="100%" style="font-size:14px;font-family: arial;border:solid 0PX;">
											
											<tr>
												<td style="padding:4px;width:60%;font-weight:bold;" colspan="5"><span style="border-bottom:solid 1px #000000;">DRUG & ALCOHOL TEST</span><br/><span ><i></i></span></td>
												<td style="padding:4px;text-align:right" colspan="2"><span >Nilai Rujukan &nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style="border-top:solid 1px #000000;"><i>Reference Value</i></span></td>
											</tr>
											<tr>
												<td style="padding:3px;" colspan="10">
													
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;width:30%" colspan="3">
													<span ><?=@get_lang_hasil('p4', $_GET['lang'])?></span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;width:30" colspan="2"><?=@$sethasilpem['21P1']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Amphetaminess</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P2']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Marijuana</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P3']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Cocaine</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P4']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Benzodiazepines</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P6']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Morphin</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P7']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Carisoprodol</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P21']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Metamphetamin</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P8']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											<tr>
												<td style="padding:4px;" colspan="3">
													<span >Lain-Lain</span><br/>
													<span style="border-top:solid 1px #000000;"><i></i></span>
												</td>
												<td width="1%" style="padding:4px;">:</td>
												<td style="padding:4px;" colspan="2"><?=@$sethasilpem['21P9']?></td>
												<td style="padding:4px 4px 4px 4px;" >
													<div align="right">
														<span ><?=@get_lang_hasil('p27', $_GET['lang'])?></span>
													</div>
												</td>
											</tr>
											
											
											
											
									</table>
									
									<?php } ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<table width="100%" style="font-size:14px;">
					<td></td>
					<td><div align="right" style="margin-right:20px;"><br /><br /><?=@$um?></div></td>
				</table>
			</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			</div>
		</div>
