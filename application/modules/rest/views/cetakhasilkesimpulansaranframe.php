<?php
	//print_r($_POST);
	$dfr = "select a.qr_code_keys, a.def_ttd, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.nm_pas, c.pangkat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($query->kode_transaksi)."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	
	
	
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($query->kode_transaksi)."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
	//ambil data resumnya yaaa
	$oiu = "select * from tb_resume_pasien where  kode_transaksi='".clean_data($query->kode_transaksi)."' ";
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


		<div class="container" style="width:100%;">
			
			<h5><p class="text-center"><span style="border-bottom:1px solid #000000;font-size:18px;font-family:arial;"><b><?=@$abs->no_filemcu?></b></p></h5>
			<hr style="border:solid 1px #333333;margin:12px 0 -2px 0;"/>
			
			<table width="100%" style="font-size:15px;border-spacing:0;font-family: arial;" cellpadding="3px">
				
				<tr>
					<td>Tanggal Pemeriksaan</td>
					<td>:</td>
					<td><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
					<td></td>
					<td><div align="right"><b>Kategori </b></div></td>
					<td> <b>: <?=@$abs->nm_dinas?></b></td>
				</tr>
			</table>
			
			
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
									<?php
										//mari kita pecah pecah
										$kop1 = explode("RKP:",$getAnamnesa);
										$kop2 = explode("RKK:",$kop1[1]);
										//print_r($kop2);
										//die();
									?>
									<table style="width:100%">
										<?php if(!empty(trim(trim($kop1[0])))){ ?>
										<tr>
											<td style="width:6%">Keluhan</td>
											<td style="width:1%">:</td>
											<td><?=@str_replace("Keluhan:", "", $kop1[0])?></td>
										</tr>
										<?php } ?>
										<?php if(!empty(trim(trim($kop2[0])))){ ?>
										<tr>
											<td>RKP</td>
											<td>:</td>
											<td><?=@$kop2[0]?></td>
										</tr>
										<?php } ?>
										<?php if(!empty(trim(trim($kop2[1])))){ ?>
										<tr>
											<td>RKK</td>
											<td>:</td>
											<td><?=@$kop2[1]?></td>
										</tr>
										<?php } ?>
									</table>
									<!--<pre style="border:0;background:#ffffff;font-size:15px;font-family: arial;margin:0;padding:0;"><?=@$getAnamnesa?><br /></pre>-->
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
												<td style="border:solid 1px #000000;"><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
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
									<?=@$ags[0]->nm_kondisi == "" ? "" : '"<b>'.$ags[0]->nm_kondisi.'</b>"';?><br />
									<?=@$kesansaran['catatan_tambahan_dinas']?>
								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<?php
					if(!empty($abs->qr_code_keys)){
						$qkeysx = $abs->qr_code_keys;
						$this->load->library('ciqrcode');
						$params['data'] = "https://qr.lakesprasaryanto.com/?uid=".$qkeysx;
						$params['level'] = 'H';
						$params['size'] = 2;
						$params['savename'] = FCPATH.'/qr/Q1-'.$abs->kode_transaksi.'.png';
						$this->ciqrcode->generate($params);
					}
				?>
			
			</table>
</div>
