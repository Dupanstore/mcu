<?php
	$dfr = "select a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->result();
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
	//ambil data resumnya yaaa
	$oiu = "select * from tb_resume_pasien where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$aew = $this->db->query($oiu);
	$mdn = $aew->result();
	//print_r($mdn);
	if($mdn){
		foreach($mdn as $sa){
			
			if($sa->aktif_diagnosakelainan != "N"){
				if($sa->ket_resume == "anamnesa"){
					$getAnamnesa = $sa->isi_anamnesa;
				}
				if($sa->ket_resume == "diagnosakelainan"){
					$namakelainan = $sa->nama_kelainan;
					if($sa->kelainan_key == "01L"){
						$namakelainan = "Kulit";
					}
					if($sa->kelainan_key == "01B"){
						$namakelainan = "Bedah";
					}
					$getDiagnosalain[$sa->kelainan_key] = $namakelainan;
					$getDiagnosalain1[$sa->kelainan_key] = $sa->urut_kelainan;
					$getDiagnosalain2[$sa->kelainan_key][substr($sa->stakes_kelainan, 0, 1)] = "x";
					$ghdhhjshjg = "";
					if(!empty($sa->stakes_kelainan)){
						$ghdhhjshjg = " (".$sa->stakes_kelainan.")";
					}
					$getDiagnosalain3[$sa->kelainan_key] = $sa->kesimpulan_kelainan .$ghdhhjshjg;
				}
				if($sa->ket_resume == "periksatambahan"){
					$pemeriksaantambahan[$sa->nama_kelainan] = $sa->isi_kelainan;
				}
				if($sa->ket_resume == "kesimpulansaran"){
					$kesansaran[$sa->nama_kesansaran] = $sa->isi_kesansaran;
				}
			}
			
		}
	}
	//print_r($pemeriksaantambahan);
	
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
	<body>
		<div class="container" style="width:100%;">
			<?php if(!$_GET['noprint']){ ?>
			<table width="100%" style="font-size:16px;border-spacing:0;font-family:arial;margin:20px 0 0 0;" cellpadding="2px" >
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
			<?php } ?>
			<h5><p class="text-center"><span style="border-bottom:1px solid #000000;font-size:18px;font-family:arial;"><b>RESUME DATA MEDIS</b></p></h5>
			
			<table width="100%" style="font-size:15px;border-spacing:0;font-family: arial;" cellpadding="3px">
				<tr>
					<td width="25%">No File / Umur</td>
					<td width="2%">:</td>
					<td width="73%" colspan="4"><?=@$abs[0]->no_filemcu?> [<?=@get_umur($abs[0]->tgl_lhr_pas)?>]</td>
					
				</tr>
				<tr>
					<td>Nama / No Reg</td>
					<td>:</td>
					<td colspan="4"><?=@$abs[0]->nm_pas?> [<?=@$abs[0]->no_reg?>]</td>
					
				</tr>
				<tr>
					<td>Pangkat/NRP/NIP</td>
					<td>:</td>
					<td colspan="4"><?=@$abs[0]->pangkat_pas?>/<?=@$abs[0]->nip_nrp_nik?></td>
				
				</tr>
				<tr>
					<td>Jabatan / Jawatan</td>
					<td>:</td>
					<td colspan="4"><?=@$abs[0]->jabatan_pas?> / <?=@$abs[0]->nm_jawatan?></td>
					
				</tr>
				<tr>
					<td>Tempat/Tanggal Lahir</td>
					<td>:</td>
					<td colspan="4"><?=@$abs[0]->tmp_lahir_pas?>, <?=@date("d/m/Y", strtotime($abs[0]->tgl_lhr_pas))?></td>
					
				</tr>
				<tr>
					<td>Tanggal Pemeriksaan</td>
					<td>:</td>
					<td><?=@date("d/m/Y", strtotime($abs[0]->tgl_awal_reg))?></td>
					<td></td>
					<td><div align="right"><b>Kategori </b></div></td>
					<td> <b>: <?=@$abs[0]->nm_dinas?></b></td>
				</tr>
			</table>
			<br />
			<hr style="border:solid 1px #333333;margin:12px 0 -2px 0;"/>
			<table width="100%" style="margin:5px 0 0 0;font-size:15px;font-family:arial;" cellpadding="2px">
				<tr style="border-bottom:1px solid #000000;border-top:double 1px #000000;border-bottom:solid 1px #000000;padding">
					<td width="1%">A.</td>
					<td>Berat Badan : <?=@$pemkss['beratbadan']?> Kg</td>
					<td>Tinggi : <?=@$pemkss['tinggibadan']?> cm</td>
					<td>Tensi : <?=@$pemkss['tekanan_darah1']?>/<?=@$pemkss['tekanan_darah2']?> mmHg</td>
					<td>Nadi : <?=@$pemkss['nadi']?> x/mnt</td>
					<td>LP : <?=@$pemkss['lingkarperut']?> Cm</td>
					<td>LD : <?=@$pemkss['lingkardada1']?>-<?=@$pemkss['lingkardada2']?> Cm</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="6">
						<table width="100%" style="font-size:15px;font-family:arial;" >
							<tr>
								<td width="15%" style="vertical-align:top;">Anamnesa</td>
								<td width="1%" style="vertical-align:top;">:</td>
								<td style="vertical-align:top;">
									<pre style="border:0;background:#ffffff;font-size:15px;font-family: arial;margin:0;padding:0;"><?=@$getAnamnesa?><br /></pre>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>	
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border-top:solid 1px #000000;border-bottom:solid 1px #000000">
					<td colspan="7">
		<!--edit aby-->		<table width="100%" style="font-size:15px;font-family:arial;margin:0 0 5px 0;">
							<tr style="border-bottom:solid 1px #000000">	
								<td width="1%">B.</td>
								<td width="15%">PEMERIKSAAN</td>
								<!--<td width="3%" style="border-left:solid 1px #000000"><div align="center">I</div></td>
								<td width="3%" style="border-left:solid 1px #000000"><div align="center">II</div></td>
								<td width="3%" style="border-left:solid 1px #000000"><div align="center">III</div></td>
								<td width="3%" style="border-left:solid 1px #000000"><div align="center">IV</div></td>-->
								<td style="border-left:solid 1px #000000;padding:2px;">DIAGNOSA / KELAINAN</td>
							</tr>
							<?php
								//print_r($getDiagnosalain);
								ksort($getDiagnosalain);
								foreach($getDiagnosalain as $wy => $sb){
							?>
							<tr>	
								<td width="1%"></td>
								<td width="15%" style="border-bottom:solid 1px #000000;"><!--<?=@$getDiagnosalain1[$wy]?>. --><?=@$sb?></td>
								<!--<td width="3%" style="border-left:solid 1px #000000;border-bottom:solid 1px #000000;"><div align="center"><?=@$getDiagnosalain2[$wy][1]?></div></td>
								<td width="3%" style="border-left:solid 1px #000000;border-bottom:solid 1px #000000;"><div align="center"><?=@$getDiagnosalain2[$wy][2]?></div></td>
								<td width="3%" style="border-left:solid 1px #000000;border-bottom:solid 1px #000000;"><div align="center"><?=@$getDiagnosalain2[$wy][3]?></div></td>
								<td width="3%" style="border-left:solid 1px #000000;border-bottom:solid 1px #000000;"><div align="center"><?=@$getDiagnosalain2[$wy][4]?></div></td>-->
								<td style="border-left:solid 1px #000000;padding:2px;border-bottom:solid 1px #000000;"><?=@$getDiagnosalain3[$wy]?></td>
							</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
				<tr style="border-top:solid 1px #000000;border-bottom:solid 1px #000000">
					<td colspan="7">
		<!--edit aby-->		<table width="100%" style="font-size:15px;font-family:arial;margin:0 0 5px 0;">
							<tr>	
								<td width="1%">C.</td>
								<td width="1%">1.</td>
								<td width="10%">Aerofisiologi</td>
								<td>: <?=@$pemeriksaantambahan['Chamber-FI']?></td>
								<td width="10%"></td>
								<td rowspan="5">
									<div align="right">
										<br/>
		<!--edit aby tdnya 80%-->					<table width="70%" style="font-size:15px;font-family:arial;margin:0 0 5px 0;border:solid 1px #000000;">
											<tr>
												<td colspan="10"><div align="center">STATUS KESEHATAN</div></td>
											</tr>
											<tr>
												<td style="border:solid 1px #000000;">Tanggal</td>
											<?php
												foreach(is_stakes() as $sg){
											?>
													<td style="border:solid 1px #000000;"><div align="center"><?=@$sg?></div></td>
											<?php } ?>
											</tr>
											<tr>
												<td style="border:solid 1px #000000;"><?=@date("d/m/Y", strtotime($abs[0]->tgl_awal_reg))?></td>
											<?php
												foreach(is_stakes() as $sg){
											?>

													<td style="border:solid 1px #000000;">
														<div align="center"><?=@$kesansaran[$sg]?></div>
													</td>
											<?php } ?>
											</tr>
											</table>
										</div>
								</td>
							</tr>
							<tr>	
								<td width="1%"></td>
								<td width="1%">2.</td>
								<td>Psikologi</td>
								<td colspan="2">: <?=@$pemeriksaantambahan['Psikologi']?></td>
							</tr>
							<tr>	
								<td width="1%"></td>
								<td width="1%">3.</td>
								<td>Psikiatri</td>
								<td colspan="2">: <?=@$pemeriksaantambahan['Psikiatri']?></td>
							</tr>
							<tr>	
								<td width="1%"></td>
								<td width="1%">4.</td>
								<td>Kesamaptaan</td>
								<td colspan="2">: <?=@$pemeriksaantambahan['Kesamaptaan']?></td>
							</tr>
							<tr>	
								<td width="1%"></td>
								<td width="1%">5.</td>
								<td>BC</td>
								<td colspan="2">: <?=@$pemeriksaantambahan['BC']?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border-top:solid 1px #000000;border-bottom:solid 1px #000000">
					<td colspan="7">
	<!--edit aby-->			<table width="100%" style="font-size:15px;font-family:arial;margin:0 0 5px 0;">
							<tr>	
								<td width="1%">D.</td>
								<td width="11%">Kesimpulan / Saran</td>
								<td width="1%">:</td>
								<td>
								<?php
								
									$sfghs = unserialize($kesansaran['saran']);
									$sfghx = unserialize($kesansaran['kesimpulan']);
									$sfghl = unserialize($kesansaran['detailsaran']);
									
								?>
	<!--edit aby-->						<table width="100%" style="font-size:15px;font-family:arial;margin:0;">
									<?php 
										foreach(range(1,10) as $gsdd){ 
											if($sfghs[$gsdd] != ""){
												$ghdfsg = $sfghx[$gsdd] ." -> ". $sfghs[$gsdd];
									?>
									<tr>
										<td width="1%" style="padding:1px;">-  </td>
										<td><?=@$ghdfsg?></td>
									</tr>
										<?php } ?>
									<?php } ?>
								</table>
								</td>
								
							</tr>
							<tr>	
								<td width="1%"></td>
								<td width="11%"></td>
								<td width="1%"></td>
								<td>
									<?php
										//print_r($kesansaran);
										//ambil keterangan tarekhirnya ya
										$this->db->select("nm_kondisi");
										$this->db->where("id_kondisi", $kesansaran['keterangan_sehat']);
										$this->db->limit("1");
										$std = $this->db->get("tb_kondisi");
										$ags = $std->result();
										
										
									?>
									<br />
									"<b><?=@$ags[0]->nm_kondisi?></b>"<br />
									<?=@$kesansaran['catatan_tambahan_dinas']?>
								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border-top:solid 1px #000000;">
					<td colspan="7">
						<?php if(!$_GET['noprint']){ ?>
		<!--edit aby-->		<table width="100%" style="font-size:15px;font-family:arial;margin:0 0 5px 0;">
							<tr>	
								<td width="1%"></td>
								<td width="35%"></td>
								<td width="10%"></td>
								<td>
									<div align="center" style="margin:10px 0 0 0;">
										KEPALA LAKESPRA dr. SARYANTO<br/><br/><br/><br/><?=@$this->madmin->Get_setting('tim_kesehatan_lakespra')?><br /><?=@$this->madmin->Get_setting('tim_kesehatan_jabatan')?>
									</div>
								</td>
							</tr>
						</table>
						<?php } ?>
					</td>
				</tr>
			</table>
</div>
