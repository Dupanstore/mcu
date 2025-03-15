	<?php
		//print_r($_GET);
		$this->db->where('kd_dok', 'KALA');
		$kklids = $this->db->get('tb_dokter');
		$sghdfs = $kklids->row();


		$kesatuanpanpas = urldecode($_GET['kesatuan_pas']);
		$carabayarpas = urldecode($_GET['cara_bayar']);
		$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.jabatan_pas, b.id_pas, b.pangkat_pas, b.nm_pas, b.no_tlp_pas, b.alamat_pas from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket ";
		$que 	.= " and c.casis_tni='Y' and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime(urldecode($_GET['tanggalawal'])))." 00:00:00' AND '".date("Y-m-d", strtotime(urldecode($_GET['tanggalakhir'])))." 23:59:59' ";
		if(!empty($_GET['id_jawatan'])){
			$que 	.= " and b.id_jawatan=".$_GET['id_jawatan']." ";
		}
		if(isset($_GET['id_dinas'])){
			$que 	.= " and b.id_dinas IN (".implode(', ', $_GET['id_dinas']).") ";
		}
		if(!empty($_GET['kesatuan_pas'])){
			$que 	.= " and b.kesatuan_pas='".$kesatuanpanpas."' ";
		}
		if(!empty($_GET['cara_bayar'])){
			$que 	.= " and a.cara_bayar='".$carabayarpas."' ";
		}
		$que 	.= "  order by a.id_reg ASC";
		$gsv 	 = $this->db->query($que);
		$ffds = $gsv->result();
		
		$pididok = is_stakesidtind_casis();
		$impidfr = implode(', ', $pididok);
	?>
	<style>
		td{
			vertical-align:middle;
			text-align:center;
			font-size:14px;
			PADDING:3PX;
		}
	</style>
	<?php
		if($_GET['typecetak'] == "print"){
			//echo "<script> window.print(); </script>";
		} else {
		$tm = 'laporan_casis';
		header("Content-Type:application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=". $tm .'_'.date("m-d-Y").".xls");
		}
	?>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.min.js')?>">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?=@base_url('assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>

	<style>
		td{
			border:solid 1px #333333;
		}
	</style>
	<div align="center" style="font-size:16px;font-weight:bold">
		<?=@urldecode($_GET['judulatas'])?><br />
		<?=@urldecode($_GET['judultengah'])?><br />
		<?=@urldecode($_GET['judulbawah'])?><br />
	</div>
	<table style="width:100%;border-spacing:0;">
		<thead>
		<tr>
			<td rowspan="2">NOMOR<BR />URT</td>
			<td rowspan="2">NOMOR<BR />PESERTA</td>
			<td rowspan="2">NAMA<BR />PANGKAT/NRP</td>
			<td colspan="14">UMUM (U)</td>
			<td rowspan="2">MATA<BR />(L)</td>
			<td rowspan="2">GIGI<BR />(G)</td>
			<td rowspan="2">JIWA<BR />(J)</td>
			<td rowspan="2">AEROFISIOLOGI</td>
			<td rowspan="2">KESAMAPTAAN</td>
			<td colspan="3">HASIL</td>
			<td rowspan="2">HASIL DAN <BR />NILAI</td>
			<td rowspan="2">KET</td>
		</tr>
		<tr>
			<td>TB/BB</td>
			<td>IMT</td>
			<td>ANAM NESA</td>
			<td>TENSI / NADI/<BR />PENY. DLM</td>
			<td>TREADMILL</td>
			<td>PARU<BR /> FVC % /FEV1</td>
			<td>NEUROLOGI</td>
			<td>KULIT</td>
			<td>LAB</td>
			<td>RO</td>
			<td>USG</td>
			<td>THT / AUDIO</td>
			<td>BEDAH</td>
			<td>GINEKOLOGI</td>
			<td>KESUM</td>
			<td>KESWA</td>
			<td>AEROFISOLOGI</td>
		</tr>
		<tr>
			<?php foreach(range(1,27) as $numbnew){ ?>
			<td><?=@$numbnew?></td>
			<?php } ?>
		</tr>
		</thead>
		<tbody>
			<?php 
				$gsv = 1;
				foreach($ffds as $vdvb){
					$nhs = $gsv++;
					
					$kesimpulankardiologi = "DBN";
					$kesimpulanparu = "DBN";
					$kesimpulanneurologi = "DBN";
					$kesimpulannekulit = "DBN";
					$kesimpulannelab = "DBN";
					$kesimpulannero = "DBN";
					$kesimpulanneusg = "DBN";
					$kesimpulannetht = "DBN";
					$kesimpulannebedah = "DBN";
					$kesimpulanginekologi = "";
					$kesimpulannemata = "DBN";
					$kesimpulannegigi = "DBN";
					$kesimpulannejiwa = "DBN";
					$kesimpulannesamapta = "";
					$kesimpulannewero = "DBN";
					
					
					
					$stakestbbb = "";
					$stakesimt = "";
					$stakesanam = "";
					$stakesnadi = "";
					$stakestreadmil = "";
					$stakesparu = "";
					$stakesneuro = "";
					$stakeskulit = "";
					$stakeslab = "";
					$stakesro = "";
					$stakesusg = "";
					$stakestht = "";
					$stakesbedah = "";
					$stakesginekologi = "";
					$stakesaudio = "";
					$stakesmata = "";
					$stakesgigi = "";
					$stakesjiwa = "";
					$stakesaero = "";
					
					
					$warnstakes3 = "";
					$warnstakes4 = "";
					$warnstakes5 = "";
					$warnstakes6 = "";
					$warnstakes7 = "";
					$warnstakes8 = "";
					$warnstakes9 = "";
					$warnstakes10 = "";
					$warnstakes11 = "";
					$warnstakes12= "";
					$warnstakes13= "";
					$warnstakes14= "";
					$warnstakes15= "";
					$warnstakes16= "";
					$warnstakes17= "";
					$warnstakes18= "";
					$warnstakes19= "";
					$warnstakes20= "";
					
					$parnstakes3 = "";
					$parnstakes4 = "";
					$parnstakes5 = "";
					$parnstakes6 = "";
					$parnstakes7 = "";
					$parnstakes8 = "";
					$parnstakes9 = "";
					$parnstakes10 = "";
					$parnstakes11 = "";
					$parnstakes12= "";
					$parnstakes13= "";
					$parnstakes14= "";
					$parnstakes15= "";
					$parnstakes16= "";
					$parnstakes17= "";
					$parnstakes18= "";
					$parnstakes19= "";
					$parnstakes20= "";
					
					
					$judh = "select nama_pemeriksaan_khusus, hasilnya from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$vdvb->kode_transaksi."' and  nama_pemeriksaan_khusus IN ('tinggibadan', 'beratbadan', 'imt', 'tekanan_darah1', 'tekanan_darah2', 'panjangkaki', 'tinggiduduk', 'beratbadanmax', 'nadi') ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					if($dswew){
						foreach($dswew as $gdb){
							$pemkhususnya[$vdvb->id_reg][$gdb->nama_pemeriksaan_khusus] = $gdb->hasilnya;
						}
					}
					
					
					$judh = "select ket_resume, isi_anamnesa, huruf_stakes, nama_kelainan, isi_kelainan, kesimpulan_kelainan from tb_resume_pasien where kode_transaksi='".$vdvb->kode_transaksi."' and  ket_resume IN ('diagnosakelainan', 'anamnesa', 'periksatambahan') ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					//print_r($dswew);
					if($dswew){
						foreach($dswew as $gdb){
							$gsvdvd = trim(trim(trim(trim($gdb->huruf_stakes))));
							$newnamakelainanjj = trim(trim(trim(trim($gdb->nama_kelainan))));
							if(empty($gsvdvd)){
								$gsvdvd = "U";
							}
							if($gdb->ket_resume == "anamnesa"){
								$khususanamnesa[$vdvb->id_reg] = $gdb->isi_anamnesa;
								
							} else if($gdb->ket_resume ==  "periksatambahan"){
								if($newnamakelainanjj == "Psikiatri"){
									$psikiatriok[$vdvb->id_reg] = $gdb->isi_kelainan;
								}else if($newnamakelainanjj == "Kesamaptaan"){
									$kesamaptaanok[$vdvb->id_reg] = $gdb->isi_kelainan;
								}else{
									if(!empty($gdb->isi_kelainan)){
										$periksatambahan2[$vdvb->id_reg][$newnamakelainanjj] = $gdb->isi_kelainan;
									}
								}
							}else{
								$pemkesimpulan[$vdvb->id_reg][$gsvdvd][trim(trim(trim(trim($gdb->nama_kelainan))))] = $gdb->kesimpulan_kelainan;
							}
							
						}
					}
					
					
					
					$judh = "select id_ins_tind_pem, id_tind_pem, val_stakes, stakes_tb, stakes_imt, stakes_anamnesa, stakes_tensi from tb_register_pemeriksaan where kode_transaksi='".$vdvb->kode_transaksi."' group by id_tind_pem ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					//print_r($dswew);
					//die();
					if($dswew){
						foreach($dswew as $gdb){
							if($gdb->id_tind_pem == "6592"){
								//pemeriksaan fisik
								$stakestbbb = $gdb->stakes_tb;
								$stakesimt = $gdb->stakes_imt;
								$stakesanam = $gdb->stakes_anamnesa;
								$stakesnadi = $gdb->stakes_tensi;
							}
							if($gdb->id_tind_pem == "6555"){
								$stakestreadmil = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6556"){
								
								$stakestreadmil = $gdb->val_stakes;
								//print_r($stakestreadmil);
								//die();
							}
							if($gdb->id_tind_pem == "6579"){
								$stakesparu = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6574"){
								$stakesneuro = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6563"){
								$stakeskulit = $gdb->val_stakes;
							}
							if($gdb->id_ins_tind_pem == "2"){
								$stakeslab = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6626"){
								$stakesro = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6646"){
								$stakesusg = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6586"){
								$stakesaudio = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6583"){
								$stakestht = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6548"){
								$stakesbedah = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6651"){
								$stakesmata = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6549"){
								$stakesgigi = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6632"){
								$stakesjiwa = $gdb->val_stakes;
							}
							if($gdb->id_tind_pem == "6630"){
								$stakesaero = $gdb->val_stakes;
							}
							
							if($gdb->id_tind_pem == "6591" OR $gdb->id_tind_pem == "6553"){
								$stakesginekologi = $gdb->val_stakes;
							}
						}
					}
					
					
					
					
					//print_r($pemkesimpulan);
					if(!empty($pemkesimpulan[$vdvb->id_reg]['A']['Kardiologi'])){
						$kesimpulankardiologi = $pemkesimpulan[$vdvb->id_reg]['A']['Kardiologi'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Kardiologi'])){
						$kesimpulankardiologi = $pemkesimpulan[$vdvb->id_reg]['U']['Kardiologi'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Paru'])){
						$kesimpulanparu = $pemkesimpulan[$vdvb->id_reg]['U']['Paru'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Neurologi'])){
						$kesimpulanneurologi = $pemkesimpulan[$vdvb->id_reg]['U']['Neurologi'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Ginekologi'])){
						$kesimpulanginekologi = $pemkesimpulan[$vdvb->id_reg]['U']['Ginekologi'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['L']['Umum'])){
						$kesimpulannekulit = $pemkesimpulan[$vdvb->id_reg]['L']['Umum'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['B']['Umum'])){
						$kesimpulannebedah = $pemkesimpulan[$vdvb->id_reg]['B']['Umum'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Laboratorium'])){
						$kesimpulannelab = $pemkesimpulan[$vdvb->id_reg]['U']['Laboratorium'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['Rontgen'])){
						$kesimpulannero = $pemkesimpulan[$vdvb->id_reg]['U']['Rontgen'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['USG'])){
						$kesimpulanneusg = $pemkesimpulan[$vdvb->id_reg]['U']['USG'];
					}
					
					if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['THT']) OR !empty($pemkesimpulan[$vdvb->id_reg]['D']['THT'])){
						if(!empty($pemkesimpulan[$vdvb->id_reg]['U']['THT'])){
							$tht1[$vdvb->id_reg][SchCleanChar($pemkesimpulan[$vdvb->id_reg]['U']['THT'])] = $pemkesimpulan[$vdvb->id_reg]['U']['THT'];
							
						}
						if(!empty($pemkesimpulan[$vdvb->id_reg]['D']['THT'])){
							$tht1[$vdvb->id_reg][SchCleanChar($pemkesimpulan[$vdvb->id_reg]['D']['THT'])] = $pemkesimpulan[$vdvb->id_reg]['D']['THT'];
							
						}
						$kesimpulannetht = implode(", ", $tht1[$vdvb->id_reg]);
					}
					$stakesaudiotht[$vdvb->id_reg][1] = $stakestht;
					$stakesaudiotht[$vdvb->id_reg][2] = $stakesaudio;
					
					if(!empty($pemkesimpulan[$vdvb->id_reg]['L']['Mata'])){
						$kesimpulannemata = $pemkesimpulan[$vdvb->id_reg]['L']['Mata'];
					}
					if(!empty($pemkesimpulan[$vdvb->id_reg]['G']['Gigi'])){
						$kesimpulannegigi = $pemkesimpulan[$vdvb->id_reg]['G']['Gigi'];
					}
					if(!empty($psikiatriok[$vdvb->id_reg])){
						$kesimpulannejiwa = $psikiatriok[$vdvb->id_reg];
					}
					if(!empty($kesamaptaanok[$vdvb->id_reg])){
						$kesimpulannesamapta = $kesamaptaanok[$vdvb->id_reg];
					}
					if(is_array($periksatambahan2[$vdvb->id_reg])){
						$kesimpulannewero = implode(", ", $periksatambahan2[$vdvb->id_reg]);
					}
					
					
					
					
					$warnstakes3 = "style='border-bottom:none;'";
					$warnstakes4 = "style='border-bottom:none;'";
					$warnstakes5 = "style='border-bottom:none;'";
					$warnstakes6 = "style='border-bottom:none;'";
					$warnstakes7 = "style='border-bottom:none;'";
					$warnstakes8 = "style='border-bottom:none;'";
					$warnstakes9 = "style='border-bottom:none;'";
					$warnstakes10 = "style='border-bottom:none;'";
					$warnstakes11 = "style='border-bottom:none;'";
					$warnstakes12= "style='border-bottom:none;'";
					$warnstakes13= "style='border-bottom:none;'";
					$warnstakes14= "style='border-bottom:none;'";
					$warnstakes15= "style='border-bottom:none;'";
					$warnstakes16= "style='border-bottom:none;'";
					$warnstakes17= "style='border-bottom:none;'";
					$warnstakes18= "style='border-bottom:none;'";
					$warnstakes19= "style='border-bottom:none;'";
					$warnstakes20= "style='border-bottom:none;'";
					
					
					$bintang3 = "";
					$bintang4 = "";
					$bintang5 = "";
					$bintang6 = "";
					$bintang7 = "";
					$bintang8 = "";
					$bintang9 = "";
					$bintang10 = "";
					$bintang11 = "";
					$bintang12 =  "";
					$bintang13 = "";
					$bintang14 = "";
					$bintang15 = "";
					$bintang16= "";
					$bintang17= "";
					$bintang18= "";
					$bintang19= "";
					$bintang20= "";
					
					
					
					$stakestehateokpas = max($stakesaudiotht[$vdvb->id_reg]);
					
					
					
					
					if(trim(trim($stakestbbb)) == "3"){
						$warnstakes3 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes3 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesimt)) == "3"){
						$warnstakes4 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes4 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesnadi)) == "3"){
						$warnstakes6 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes6 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakestreadmil)) == "3"){
						$warnstakes7 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes7 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesparu)) == "3"){
						$warnstakes8 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes8 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesneuro)) == "3"){
						$warnstakes9 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes9 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakeskulit)) == "3"){
						$warnstakes10 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes10 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakeslab)) == "3"){
						$warnstakes11 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes11 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesro)) == "3"){
						$warnstakes12 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes12 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesusg)) == "3"){
						$warnstakes13 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes13 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakestehateokpas)) == "3"){
						$warnstakes14 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes14 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesbedah)) == "3"){
						$warnstakes15 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes15 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesmata)) == "3"){
						$warnstakes16 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes16 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesgigi)) == "3"){
						$warnstakes17 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes17 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesjiwa)) == "3"){
						$warnstakes18 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes18 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesaero)) == "3"){
						$warnstakes19 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes19 = 'color:blue;font-weight:bold';
					}
					if(trim(trim($stakesginekologi)) == "3"){
						$warnstakes20 = 'style="border-bottom:none;color:blue;font-weight:bold"';
						$parnstakes20 = 'color:blue;font-weight:bold';
					}
					
					
					
					
					if(trim(trim($stakestbbb)) == "4"){
						$warnstakes3 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes3 = 'color:red;font-weight:bold';
						$bintang3 = "*";
					}
					if(trim(trim($stakesimt)) == "4"){
						$warnstakes4 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes4 = 'color:red;font-weight:bold';
						$bintang4 = "*";
					}
					if(trim(trim($stakesnadi)) == "4"){
						$warnstakes6 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes6 = 'color:red;font-weight:bold';
						$bintang6 = "*";
					}
					if(trim(trim($stakestreadmil)) == "4"){
						$warnstakes7 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes7 = 'color:red;font-weight:bold';
						$bintang7 = "*";
					}
					if(trim(trim($stakesparu)) == "4"){
						$warnstakes8 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes8 = 'color:red;font-weight:bold';
						$bintang8 = "*";
					}
					if(trim(trim($stakesneuro)) == "4"){
						$warnstakes9 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes9 = 'color:red;font-weight:bold';
						$bintang9 = "*";
					}
					if(trim(trim($stakeskulit)) == "4"){
						$warnstakes10 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes10 = 'color:red;font-weight:bold';
						$bintang10 = "*";
					}
					if(trim(trim($stakeslab)) == "4"){
						$warnstakes11 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes11 = 'color:red;font-weight:bold';
						$bintang11 = "*";
					}
					if(trim(trim($stakesro)) == "4"){
						$warnstakes12 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes12 = 'color:red;font-weight:bold';
						$bintang12 = "*";
					}
					if(trim(trim($stakesusg)) == "4"){
						$warnstakes13 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes13 = 'color:red;font-weight:bold';
						$bintang13 = "*";
					}
					if(trim(trim($stakestehateokpas)) == "4"){
						$warnstakes14 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes14 = 'color:red;font-weight:bold';
						$bintang14 = "*";
					}
					if(trim(trim($stakesbedah)) == "4"){
						$warnstakes15 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes15 = 'color:red;font-weight:bold';
						$bintang15 = "*";
					}
					if(trim(trim($stakesmata)) == "4"){
						$warnstakes16 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes16 = 'color:red;font-weight:bold';
						$bintang16 = "*";
					}
					if(trim(trim($stakesgigi)) == "4"){
						$warnstakes17 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes17 = 'color:red;font-weight:bold';
						$bintang17 = "*";
					}
					if(trim(trim($stakesjiwa)) == "4"){
						$warnstakes18 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes18 = 'color:red;font-weight:bold';
						$bintang18 = "*";
					}
					if(trim(trim($stakesaero)) == "4"){
						$warnstakes19 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes19 = 'color:red;font-weight:bold';
						$bintang19 = "*";
					}
					if(trim(trim($stakesginekologi)) == "4"){
						$warnstakes20 = 'style="border-bottom:none;color:red;font-weight:bold"';
						$parnstakes20 = 'color:red;font-weight:bold';
						$bintang20 = "*";
					}
					
					
					$kesummmmok[$vdvb->id_reg][3] = trim(trim($stakestbbb));
					$kesummmmok[$vdvb->id_reg][4] = trim(trim($stakesimt));
					$kesummmmok[$vdvb->id_reg][6] = trim(trim($stakesnadi));
					$kesummmmok[$vdvb->id_reg][7] = trim(trim($stakestreadmil));
					$kesummmmok[$vdvb->id_reg][8] = trim(trim($stakesparu));
					$kesummmmok[$vdvb->id_reg][9] = trim(trim($stakesneuro));
					$kesummmmok[$vdvb->id_reg][10] = trim(trim($stakeskulit));
					$kesummmmok[$vdvb->id_reg][11] = trim(trim($stakeslab));
					$kesummmmok[$vdvb->id_reg][12] = trim(trim($stakesro));
					$kesummmmok[$vdvb->id_reg][13] = trim(trim($stakesusg));
					$kesummmmok[$vdvb->id_reg][14] = trim(trim($stakestehateokpas));
					$kesummmmok[$vdvb->id_reg][15] = trim(trim($stakesbedah));
					$kesummmmok[$vdvb->id_reg][16] = trim(trim($stakesmata));
					$kesummmmok[$vdvb->id_reg][17] = trim(trim($stakesgigi));
					$kesummmmok[$vdvb->id_reg][20] = trim(trim($stakesginekologi));
					
					
					$getkesumm = max($kesummmmok[$vdvb->id_reg]);
					$getkeswaa = $stakesjiwa;
					$getaerostt = $stakesaero;
					
					
					$getsemua[$vdvb->id_reg]['kesum'] = $getkesumm;
					$getsemua[$vdvb->id_reg]['keswa'] = $getkeswaa;
					$getsemua[$vdvb->id_reg]['aero'] = $getaerostt;
					
					$statusakhirstakes = max($getsemua[$vdvb->id_reg]);
					
					$nourutfile = explode("/", $vdvb->no_filemcu);
			?>
			<tr>
				<td rowspan="2"><?=@$nhs?></td>
				<td rowspan="2"><?=@strtoupper($nourutfile[0])?></td>
				<td rowspan="2">
					<?=@strtoupper($vdvb->nm_pas)?>
					<br />
					<?=@strtoupper($vdvb->pangkat_pas)?> / <?=@strtoupper($vdvb->nip_nrp_nik)?>
					<br />
					<?=@strtoupper($vdvb->jabatan_pas)?>
				</td>
				<td <?=@$warnstakes3?> >
					<?=@$pemkhususnya[$vdvb->id_reg]['tinggibadan']?> / <?=@$pemkhususnya[$vdvb->id_reg]['beratbadan']?>
					<?php if($pemkhususnya[$vdvb->id_reg]['beratbadan'] > $pemkhususnya[$vdvb->id_reg]['beratbadanmax']){ ?>
					[<?=@$pemkhususnya[$vdvb->id_reg]['beratbadan']-$pemkhususnya[$vdvb->id_reg]['beratbadanmax']?>]
					<?php } ?><br /><?=@$bintang3?>
				</td>
				<td <?=@$warnstakes4?>><?=@$pemkhususnya[$vdvb->id_reg]['imt']?><br /><?=@$bintang4?></td>
				<td rowspan="2"><?=@$khususanamnesa[$vdvb->id_reg]?><br /></td>
				<td <?=@$warnstakes6?>>Tensi: <?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah1']?>/<?=@$pemkhususnya[$vdvb->id_reg]['tekanan_darah2']?> mmHg. Nadi <?=@$pemkhususnya[$vdvb->id_reg]['nadi']?>/mnt.  Panjang Kaki <?=@$pemkhususnya[$vdvb->id_reg]['panjangkaki']?>. Tinggi Duduk <?=@$pemkhususnya[$vdvb->id_reg]['tinggiduduk']?>.<br /><?=@$bintang6?></td>
				<td <?=@$warnstakes7?>><?=@$kesimpulankardiologi?><br /><?=@$bintang7?></td>
				<td <?=@$warnstakes8?>><?=@$kesimpulanparu?><br /><?=@$bintang8?></td>
				<td <?=@$warnstakes9?>><?=@$kesimpulanneurologi?><br /><?=@$bintang9?></td>
				<td <?=@$warnstakes10?>><?=@$kesimpulannekulit?><br /><?=@$bintang10?></td>
				<td <?=@$warnstakes11?>><?=@$kesimpulannelab?><br /><?=@$bintang11?></td>
				<td <?=@$warnstakes12?>><?=@$kesimpulannero?><br /><?=@$bintang12?></td>
				<td <?=@$warnstakes13?>><?=@$kesimpulanneusg?><br /><?=@$bintang13?></td>
				<td <?=@$warnstakes14?>><?=@$kesimpulannetht?><br /><?=@$bintang14?></td>
				<td <?=@$warnstakes15?>><?=@$kesimpulannebedah?><br /><?=@$bintang15?></td>
				<td <?=@$warnstakes20?>><?=@$kesimpulanginekologi?><br /><?=@$bintang20?></td>
				<td <?=@$warnstakes16?>><?=@$kesimpulannemata?><br /><?=@$bintang16?></td>
				<td <?=@$warnstakes17?>><?=@$kesimpulannegigi?><br /><?=@$bintang17?></td>
				<td <?=@$warnstakes18?>><?=@$kesimpulannejiwa?><br /><?=@$bintang18?></td>
				<td <?=@$warnstakes19?>><?=@$kesimpulannewero?><br /><?=@$bintang19?></td>
				<td style="border-bottom:none;"><?=@$kesimpulannesamapta?></td>
				<?php
					$warnagetkesumm = "";
					$warnagetkeswaa = "";
					$warnagetaerostt = "";
					$warnastatusakhirstakes = "";
					if($getkesumm == "3"){
						$warnagetkesumm = 'style="color:blue;font-weight:bold"';
					}
					if($getkeswaa == "3"){
						$warnagetkeswaa = 'style="color:blue;font-weight:bold"';
					}
					if($getaerostt == "3"){
						$warnagetaerostt = 'style="color:blue;font-weight:bold"';
					}
					if($statusakhirstakes == "3"){
						$warnastatusakhirstakes = 'style="color:blue;font-weight:bold"';
					}
					
					if($getkesumm == "4"){
						$warnagetkesumm = 'style="color:red;font-weight:bold"';
					}
					if($getkeswaa == "4"){
						$warnagetkeswaa = 'style="color:red;font-weight:bold"';
					}
					if($getaerostt == "4"){
						$warnagetaerostt = 'style="color:red;font-weight:bold"';
					}
					if($statusakhirstakes == "4"){
						$warnastatusakhirstakes = 'style="color:red;font-weight:bold"';
					}
				?>
				
				<td rowspan="2" <?=@$warnagetkesumm?>><?=@$getkesumm?></td>
				<td rowspan="2" <?=@$warnagetkeswaa?>><?=@$getkeswaa?></td>
				<td rowspan="2" <?=@$warnagetaerostt?>><?=@$getaerostt?></td>
				<td rowspan="2" <?=@$warnastatusakhirstakes?>><?=@$statusakhirstakes?></td>
				<?php
					$ketstakespalingkanan = "";
					$warnastakeskanan = "";
					if(!empty($statusakhirstakes)){
						if(is_keteranganstakesok($statusakhirstakes)){
							$stakesbawahhh[$statusakhirstakes][] = 1;
							$ketstakespalingkanan = is_keteranganstakesok($statusakhirstakes);
						}
						
						if($ketstakespalingkanan == "MS-K1"){
							$warnastakeskanan = 'style="color:blue;font-weight:bold"';
						}
						if($ketstakespalingkanan == "TMS-K2"){
							$warnastakeskanan = 'style="color:red;font-weight:bold"';
						}
					}
				?>
				<td rowspan="2" <?=@$warnastakeskanan?>><?=@$ketstakespalingkanan?></td>
			</tr>
			
			
			<tr >
				<td style="border-top:none;<?=@$parnstakes3?>"><?=@$stakestbbb?></td>
				<td style="border-top:none;<?=@$parnstakes4?>"><?=@$stakesimt?></td>
				<td style="border-top:none;<?=@$parnstakes6?>"><?=@$stakesnadi?></td>
				<td style="border-top:none;<?=@$parnstakes7?>"><?=@$stakestreadmil?></td>
				<td style="border-top:none;<?=@$parnstakes8?>"><?=@$stakesparu?></td>
				<td style="border-top:none;<?=@$parnstakes9?>"><?=@$stakesneuro?></td>
				<td style="border-top:none;<?=@$parnstakes10?>"><?=@$stakeskulit?></td>
				<td style="border-top:none;<?=@$parnstakes11?>"><?=@$stakeslab?></td>
				<td style="border-top:none;<?=@$parnstakes12?>"><?=@$stakesro?></td>
				<td style="border-top:none;<?=@$parnstakes13?>"><?=@$stakesusg?></td>
				<td style="border-top:none;<?=@$parnstakes14?>"><?=@$stakestehateokpas?></td>
				<td style="border-top:none;<?=@$parnstakes15?>"><?=@$stakesbedah?></td>
				<td style="border-top:none;<?=@$warnstakes20?>"><?=@$stakesginekologi?></td>
				<td style="border-top:none;<?=@$parnstakes16?>"><?=@$stakesmata?></td>
				<td style="border-top:none;<?=@$parnstakes17?>"><?=@$stakesgigi?></td>
				<td style="border-top:none;<?=@$parnstakes18?>"><?=@$stakesjiwa?></td>
				<td style="border-top:none;<?=@$parnstakes19?>"><?=@$stakesaero?></td>
				<td style="border-top:none;"></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<table style="width:100%;border:none;">
		<tr style="border:none;">
			<td style="width:50%;border:none;">
				<div align="left">
				Klasifikasi STAKES
				<table style="width:100%;border:none;">
					<?php 
						foreach(is_keteranganstakesok() as $bdbs => $gdvde){ 
						$sttbwah = 0;
						if(is_array($stakesbawahhh[$bdbs])){
							$sttbwah = array_sum($stakesbawahhh[$bdbs]);
						}
						$palingbawahhitung[] = $sttbwah;
					?>
					<tr>
						<td style="border:none;text-align:left;width:15%"><?=@$gdvde?></td>
						<td style="border:none;text-align:left;width:1%">:</td>
						<td style="border:none;text-align:left;"><?=@$sttbwah?> Orang</td>
					</tr>
					
					<?php } ?>
					<tr>
						<td style="border:none;text-align:left;width:15%;"></td>
						<td style="border:none;text-align:left;width:1%;"></td>
						<td style="border:none;text-align:left;"><span style="border-top:solid 1px #000000"><b><?=@array_sum($palingbawahhitung)?> Orang</b></span></td>
					</tr>
				</table>
				</div>
			</td>
			<td style="border:none;vertical-align:top;">
				<div align="center">
					Jakarta, <?=@the_time(date("Y-m-d"))?><br /><br />
					Ketua Tim Rikkes<br /><br /><br /><br /><br />
					<?=@$sghdfs->nm_dok?><br />
					<?=@$sghdfs->pangkat?>
				</div>
			</td>
		</tr>
	</table>