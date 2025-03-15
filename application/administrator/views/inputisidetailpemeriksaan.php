<?php
	
	//ambil data berdasarkan noregisternya yaaaaaaa
	$ceknoregdata = "select b.tipe_dinas from tb_pasien a, tb_dinas b where a.id_dinas=b.id_dinas and a.no_reg='".$_GET['noreg']."' ";
	$queryceknored = $this->db->query($ceknoregdata);
	$incekkodedinas = $queryceknored->row();
	$pangkasnoreg = "N";
	if($incekkodedinas){
		if(!empty($incekkodedinas->tipe_dinas)){
			$pangkasnoreg = $incekkodedinas->tipe_dinas;
		}
	}
	//print_r($pangkasnoreg);
	//$pangkasnoreg = substr($_GET['noreg'],0,1);
	
	
	$opid = "select jangan_tampil_stakes, stakes_tindakan, set_pemeriksaan_fisik, set_struktur_gigi from tb_tindakan where 1=1 and id_tind='".$this->uri->segment(3)."' limit 1 ";
	$mnhy = $this->db->query($opid);
	$nhyd = $mnhy->result();
?>
<form method="POST" enctype="multipart/form-data" id="inputpemeriksaanformdata" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaanpoliklinik')?>">
	<input type="hidden" name="stakes_tindakan" value="<?=@$nhyd[0]->stakes_tindakan?>">
	<input type="hidden" name="kode_transaksi" value="<?=@$_GET['kode_transaksi']?>">
	<input type="hidden" name="id_tind_detpem" value="<?=@$this->uri->segment(3)?>">
	<input type="hidden" name="id_paket" value="<?=@$_GET['id_paket']?>">
	<input type="hidden" name="noreg_pas" value="<?=@$_GET['noreg']?>">
<?php
	$this->db->select('id_reg_detpem');
	$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
	$this->db->where("id_tind_detpem", $this->uri->segment(3));
	$this->db->where("id_paket", $_GET['id_paket']);
	$this->db->limit("1");
	$ndndbs = $this->db->get("tb_register_detailpemeriksaan");
	$jhjkjh = $ndndbs->result();
	$keterangansimpan = "belum";
	if($jhjkjh){
		$keterangansimpan = "sudah";
	}
	$cek1 = 'checked="true"';
	$cek2 = 'checked="true"';
	$cek3 = 'checked="true"';
	$cek4 = 'checked="true"';
	$cek5 = 'checked="true"';
	$val1 = 'Tidak ada';
	$val2 = 'Tidak ada';
	$val3 = 'Tidak ada';
	$val4 = 'Tidak ada';
	$val5 = 'Tidak ada';
	
					//ambil data direg dan pasiennya untuk menampilkan
					//baru sampai disini ya
					$hdvs = "select a.keluhan_utama, a.imagegigi, b.riwayat_alergi, b.riwayat_kesehatan_pasien, b.riwayat_kesehatan_keluarga, b.kebiasaan, c.en_hasil, c.nm_paket, c.casis_tni from tb_register a, tb_pasien b, tb_paket c where a.no_reg=b.no_reg and a.id_paket=c.id_paket and a.kode_transaksi='".$_GET['kode_transaksi']."' limit 1";
					$amnp = $this->db->query($hdvs);
					$dfrs = $amnp->result();
					
					
					
					if($dfrs){
						$val1 = $dfrs[0]->keluhan_utama;
						$val2 = $dfrs[0]->riwayat_alergi;
						$val3 = $dfrs[0]->riwayat_kesehatan_pasien;
						$val4 = $dfrs[0]->riwayat_kesehatan_keluarga;
						$val5 = $dfrs[0]->kebiasaan;
						/*if($dfrs[0]->keluhan_utama != "" AND $dfrs[0]->keluhan_utama != "Tidak ada"){
							$cek1 = '';
						}
						if($dfrs[0]->riwayat_alergi != "" AND $dfrs[0]->riwayat_alergi != "Tidak ada"){
							$cek2 = '';
						}
						if($dfrs[0]->riwayat_kesehatan_pasien != "" AND $dfrs[0]->riwayat_kesehatan_pasien != "Tidak ada"){
							$cek3 = '';
						}
						if($dfrs[0]->riwayat_kesehatan_keluarga != "" AND $dfrs[0]->riwayat_kesehatan_keluarga != "Tidak ada"){
							$cek4 = '';
						}
						if($dfrs[0]->kebiasaan != "" AND $dfrs[0]->kebiasaan != "Tidak ada"){
							$cek5 = '';
						}*/
						
						$urigambar = base_url('fotogigi/noimage.png');
						if(!empty($dfrs[0]->imagegigi)){
							$urigambar = base_url('fotogigi/'.$dfrs[0]->imagegigi."?d=". date("YmdHis"));
						}
					}
?>
<table class="tableeasyui" style="width:100%">
	<?php if($dfrs[0]->en_hasil == "Y"){ ?>
	<tr>
		<td colspan="2" style="background:#00F200;color:white"><b><div align="center">Paket <?=@$dfrs[0]->nm_paket?> | Mohon Mengisi Hasil Inputan Dengan Bahasa Inggris</div></b></td>
	</tr>
	<?php } ?>
	<?php if(!$jhjkjh){ ?>
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Pemeriksaan Belum Tersimpan</div></b></td>
	</tr>
	<?php } ?>
	<tr>
		<td STYLE="vertical-align:top;">
			<?php 
				if($nhyd[0]->set_pemeriksaan_fisik == "Y"){ 
				//ambil untuk riwayat
					$sdswu = "select riwayatkey, riwayathasil, riwayat_lainnya from tb_pasien_riwayat where  no_reg='". $_GET['noreg'] ."' ";
					$sdwqq  = $this->db->query($sdswu);
					$ndhyx  = $sdwqq->result();
					if($ndhyx){
						foreach($ndhyx as $hbs){
							$getcek[$hbs->riwayatkey][$hbs->riwayathasil] = $hbs->riwayat_lainnya;
						}
					}
					//print_r($getcek);
			?>
				<table style="width:100%" class="tableeasyui">
				<?php
					
					$judh = "select nama_pemeriksaan_khusus, hasilnya from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$_GET['kode_transaksi']."' and  apakah_pemeriksaan_khusus='Y' ";
					$keir = $this->db->query($judh);
					$dswew = $keir->result();
					if($dswew){
						foreach($dswew as $gdb){
							$pemkhususnya[$gdb->nama_pemeriksaan_khusus] = $gdb->hasilnya;
						}
					}
				?>
					<tr>
						<td><small>Keluhan Utama</small></td>
						<td><!--<input type="checkbox" <?=@$cek1?>> <small>Tidak Ada</small>--></td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea style="width:100%;height:30px" name="pemreg[keluhan_utama]"><?=@$val1?></textarea>
						</td>
					</tr>
					<!--<tr>
						<td><small>Riwayat Alergi</small></td>
						<td><input type="checkbox"  <?=@$cek2?>> <small>Tidak Ada</small></td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea style="width:100%;height:30px" name="uppasien[riwayat_alergi]"><?=@$val2?></textarea>
						</td>
					</tr>-->
					<tr>
						<td><small>Riwayat Kesehatan Pasien</small></td>
						<td><!--<input type="checkbox" <?=@$cek3?>> <small>Tidak Ada</small>--></td>
					</tr>
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tr>
							<?php
								$sasc = 1;
								foreach(is_penyakit_lama() as $gsf => $sgd){ 
								$trsa = $sasc++;
								$jufd = "";
								if($pemkhususnya['riwayatpasien___'.$gsf]){
									$jufd = 'checked="true"';
								}
								if($trsa == 7){
									echo "</tr><tr>";
								}
							?>
								<td><input type="checkbox" name="pemkhusus[riwayatpasien___<?=@$gsf?>]" <?=@$jufd?>> <br/><small><?=@$gsf?></small></td>
							<?php } ?>
							<td colspan="3"><input type="text" name="pemkhusus[riwayatpasien___Lainnya]" value="<?=@$pemkhususnya['riwayatpasien___Lainnya']?>" style="width:98%"></td>
							</tr>
							</table>
							<small>Penjelasan</small>
							<textarea style="width:100%;height:30px" name="uppasien[riwayat_kesehatan_pasien]"><?=@$val3?></textarea>
						</td>
					</tr>
					<tr>
						<td><small>Riwayat Kesehatan Keluarga</small></td>
						<td><!--<input type="checkbox" <?=@$cek4?>> <small>Tidak Ada</small>--></td>
					</tr>
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tr>
							<?php
								$sasc = 1;
								foreach(is_penyakit_keluarga() as $gsf => $sgd){ 
								$trsa = $sasc++;
								$jufd = "";
								if($pemkhususnya['riwayatkeluarga___'.$gsf]){
									$jufd = 'checked="true"';
								}
								if($trsa == 5){
									echo "</tr><tr>";
								}
							?>
								<td><input type="checkbox" name="pemkhusus[riwayatkeluarga___<?=@$gsf?>]" <?=@$jufd?>> <br/><small><?=@$gsf?></small></td>
							<?php } ?>
							<td colspan="3"><input type="text" name="pemkhusus[riwayatkeluarga___Lainnya]" value="<?=@$pemkhususnya['riwayatkeluarga___Lainnya']?>" style="width:98%"></td>
							</tr>
							</table>
							
							
							<small>Penjelasan</small>
							<textarea name="uppasien[riwayat_kesehatan_keluarga]" style="width:100%;height:30px"><?=@$val4?></textarea>
						</td>
					</tr>
					<!--<tr>
						<td><small>INBODY</small></td>
						<td>--><!--<input type="checkbox" <?=@$cek5?>> <small>Tidak Normal</small>--></td>
					<!--</tr>-->
					<!--<tr>
						<td colspan="2">
							<textarea name="pemkhusus[inbody]" style="width:100%;height:30px"><?=@$pemkhususnya['inbody']?></textarea>
						</td>
					</tr>-->
					<tr>
						<td colspan="2">
							<table style="width:100%">
								<tr>
									<td>Nadi</td>
									<td><input type="text" name="pemkhusus[nadi]" style="width:100%" value="<?=@$pemkhususnya['nadi']?>"></td>
									<td colspan="2">x/Menit</td>
								</tr>
								<tr>
									<td>Pernafasan</td>
									<td><input type="text" style="width:100%" name="pemkhusus[pernafasan]" value="<?=@$pemkhususnya['pernafasan']?>"></td>
									<td colspan="2">x/Menit</td>
								</tr>
								<tr>
									<td>Tekanan Darah</td>
									<td colspan="3">
									<input type="text" style="width:70px" id="tekanandarah1" onchange="tampilkanhasiltekanandarahok()" name="pemkhusus[tekanan_darah1]" value="<?=@$pemkhususnya['tekanan_darah1']?>">/
									<input type="text" style="width:70px" id="tekanandarah2" onchange="tampilkanhasiltekanandarahok()" name="pemkhusus[tekanan_darah2]" value="<?=@$pemkhususnya['tekanan_darah2']?>"></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td><input type="text" readonly="true" style="width:100%" id="hasiltekanandarah" name="pemkhusus[keterangan_td]" value="<?=@$pemkhususnya['keterangan_td']?>"></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Suhu Badan</td>
									<td><input type="text" style="width:100%" name="pemkhusus[suhubadan]" value="<?=@$pemkhususnya['suhubadan']?>"></td>
									<td colspan="2">C</td>
								</tr>
								<tr>
									<td>Lingkar Perut</td>
									<td><input type="text" style="width:100%" name="pemkhusus[lingkarperut]" value="<?=@$pemkhususnya['lingkarperut']?>"></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Lingkar Dada</td>
									<td colspan="3"><input type="text" style="width:70px" name="pemkhusus[lingkardada1]" value="<?=@$pemkhususnya['lingkardada1']?>">-
									<input type="text" style="width:70px" name="pemkhusus[lingkardada2]" value="<?=@$pemkhususnya['lingkardada2']?>"></td>
								</tr>
								<tr>
									<td colspan="4"><hr style="margin:5px;border:solid 1px #cccccc"></td>
								</tr>
								<tr>
									<td>Tinggi Badan</td>
									<td><input type="text" style="width:100%" id="tinggibadan" name="pemkhusus[tinggibadan]" onchange="hitungimt()" value="<?=@$pemkhususnya['tinggibadan']?>"></td>
									<td colspan="2">CM</td>
								</tr>
								<tr>
									<td>Berat Badan</td>
									<td><input type="text" style="width:100%" id="beratbadan" name="pemkhusus[beratbadan]" onchange="hitungimt()" value="<?=@$pemkhususnya['beratbadan']?>"></td>
									<td colspan="2">Kg</td>
								</tr>
								<tr>
									<td>Panjang Kaki</td>
									<td><input type="text" style="width:100%" id="panjangkaki" name="pemkhusus[panjangkaki]" value="<?=@$pemkhususnya['panjangkaki']?>"></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Tinggi Duduk</td>
									<td><input type="text" style="width:100%" id="tinggiduduk" name="pemkhusus[tinggiduduk]"  value="<?=@$pemkhususnya['tinggiduduk']?>"></td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>- Max</td>
									<td><input type="text" style="width:100%" id="beratbadanmax" name="pemkhusus[beratbadanmax]"  readonly="true" value="<?=@$pemkhususnya['beratbadanmax']?>"></td>
									<td colspan="2">Kg</td>
								</tr>
								<tr>
									<td>- Ideal</td>
									<td><input type="text" style="width:100%" id="beratbadanideal" name="pemkhusus[beratbadanideal]" readonly="true" value="<?=@$pemkhususnya['beratbadanideal']?>"></td>
									<td colspan="2">Kg</td>
								</tr>
								<tr>
									<td>- Min</td>
									<td><input type="text" style="width:100%" id="beratbadanmin" name="pemkhusus[beratbadanmin]" readonly="true" value="<?=@$pemkhususnya['beratbadanmin']?>"></td>
									<td colspan="2">Kg</td>
								</tr>
								<tr>
									<td>IMT</td>
									<td><input type="text" style="width:100%" id="imt" readonly="true" name="pemkhusus[imt]" value="<?=@$pemkhususnya['imt']?>"></td>
									<td colspan="2">Kg/m<sup>2</sup></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="3"><input type="text" style="width:97%" id="ketimt" readonly="true" name="pemkhusus[ketimt]" value="<?=@$pemkhususnya['ketimt']?>"></td>
								</tr>
								<tr>
									<td colspan="4"><hr style="margin:5px;border:solid 1px #cccccc"></td>
								</tr>
							</table>
						</td>
					</tr>
					
				</table>
			<?php } ?>
		</td>
		<td style="vertical-align:top;">
			<table class="tableeasyui" style="width:100%">
			<?php
				//ini kalau dia konsep poliiiiiiiiiii yaa
				//KITA JUGA AMBIL PEMERIKSAAN YANG DIFILTER YAAAAAA
				$this->db->select('id_pem');
				$this->db->where('id_tind', $this->uri->segment(3));
				$this->db->where('unicode_transaksi', $_GET['kode_transaksi']);
				$this->db->where('type_filter', 'KURANG');
				$abo = $this->db->get('tb_register_filterdata');
				$ubi = $abo->result();
				if($ubi){
					foreach($ubi as $df){
						$jangantampil[$df->id_pem] = $df->id_pem;
					}
				}
				$mm = "select b.kd_group, b.id_ins_periksa, b.det_range_pemeriksaan_awal, b.det_range_pemeriksaan_akhir, b.det_pilihan_pemeriksaan, b.det_jenis_pemeriksaan, b.det_type_pemeriksaan, b.id_pem, b.det_nilai_normal, b.det_satuan_pemeriksaan, b.det_nm_pemeriksaan from tb_pemeriksaan_meta a, tb_pemeriksaan b where 1=1 ";
				$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$this->uri->segment(3)."' order by b.det_order_pemeriksaan ASC ";
				$absc = $this->db->query($mm);
				$gfsd = $absc->result();
				if($gfsd){
					//ambil stakes
					$this->db->select('val_stakes, stakes_tb, stakes_imt, stakes_anamnesa, stakes_tensi, kesimpulan_pemeriksaan, saran_pemeriksaan');
					$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
					$this->db->where('id_tind_pem', $this->uri->segment(3));
					$this->db->limit('1');
					$ghgjh = $this->db->get('tb_register_pemeriksaan');
					$kjksd = $ghgjh->row();
			?>
			<input type="hidden" name="id_ins_tind_detpem" value="<?=@$gfsd[0]->id_ins_periksa?>">
			<input type="hidden" name="kd_grouptind" value="<?=@$gfsd[0]->kd_group?>">
			<?php if($nhyd[0]->set_struktur_gigi != "Y"){ ?>
			<tr>
				<td style="background:#DEEEFA"><b>Pemeriksaan</b></td>
				<td style="background:#DEEEFA"><b>Hasil Pemeriksaan & Daftar Kelainan (Settingan Master)</b></td>
				<td style="background:#DEEEFA"><b>Masukkan Jika ada kelainan yang lain</b></td>
				<td style="background:#DEEEFA"><b></b></td>
			</tr>
			<?php } ?>
			<?php if($nhyd[0]->set_struktur_gigi == "Y"){ ?>
			<tr>
				<td colspan="4">
					<table width="100%">
						<tbody>
						<tr>
							<td style="vertical-align:top;">
								<div id="viewdetailgigiok"></div>
							</td>
							<!--<td rowspan="2" width="35%" valign="top">
								<?php
									//print_r($_POST);
									//print_r($_GET);
								?>
								<!--<div style="line-height:30px;height:20px;">
									&nbsp;<u>POSISI GIGI :</u>
								</div>
								<p>T=TOP<BR />C=CENTER<BR />B=BOTTOM<BR />L=LEFT<BR />R=RIGHT</p>
								
								<p><u>Jenis Penyakit :</u></p>-->
								<!--<div style="overflow-y: scroll; height:300px;">
								<table style="width:100%">
								<?php
									//ambil kelainannnnn okkkk
									$this->db->order_by("kelainan", "ASC");
									$getsttgigi = $this->db->get("tb_kelainan_gigi");
									$arrsttgigi = $getsttgigi->result();
									foreach($arrsttgigi as $lppgigiok){
								?>
								<tr>
									<td>
										<?=@$lppgigiok->kode_kelainan?>
									</td>
									<td><small><?=@$lppgigiok->kelainan?></small></td>
								</tr>
								<?php } ?>
								</table>
								 </div>
								
							</td>-->
						</tr>
						
					</tbody></table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					
				</td>
			</tr>
			<?php } ?>
			<?php
					foreach($gfsd as $fd){
						if(!$jangantampil[$fd->id_pem]){
							//ambil id pemeriksaane yaaaaaaaa
							$idnya = "";
							$bck = "";
							//$this->db->select('id_reg_detpem, adakelainan');
							$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
							$this->db->where("id_tind_detpem", $this->uri->segment(3));
							$this->db->where("id_paket", $_GET['id_paket']);
							$this->db->where("id_pem_deb", $fd->id_pem);
							$this->db->limit("1");
							$sapp = $this->db->get("tb_register_detailpemeriksaan");
							$sipp = $sapp->result();
							if($sipp){
								$idnya = $sipp[0]->id_reg_detpem;
								if($sipp[0]->adakelainan == "Y"){
									$bck = 'style="background:red;color:white;font-weight:bold"';
								}
							}
			?>
			<tr <?=@$bck?>>
				<td width="15%" <?=@$bck?>><?=@$fd->det_nm_pemeriksaan?></td>
				<td <?=@$bck?>>
					<input type="hidden" name="id_reg_detpem[<?=@$fd->id_pem?>]" value="<?=@$idnya?>">
					<input type="hidden" name="set_nilai_normal[<?=@$fd->id_pem?>]" value="<?=@$fd->det_nilai_normal?>">
					<input type="hidden" name="type_pemeriksaan[<?=@$fd->id_pem?>]" value="<?=@$fd->det_type_pemeriksaan?>">
					<input type="hidden" name="range_pemeriksaan_awal[<?=@$fd->id_pem?>]" value="<?=@$fd->det_range_pemeriksaan_awal?>">
					<input type="hidden" name="range_pemeriksaan_akhir[<?=@$fd->id_pem?>]" value="<?=@$fd->det_range_pemeriksaan_akhir?>">
					<?php 
						if($fd->det_nilai_normal == "Y"){ 
							if($fd->det_type_pemeriksaan == "tetap"){
								if($fd->det_jenis_pemeriksaan == "combo"){
									//saatnya pecah datanya yaaaaaaa'
									//kita tambahkan lainnya
									$hdys = $fd->det_pilihan_pemeriksaan."*Lainnya";
									$exp = explode("*", $hdys);
									echo '<input type="hidden" name="defaultnormal['.$fd->id_pem.']" value="'.$exp[0].'">';
									echo '<select name="detpemeriksaan['.$fd->id_pem.']" style="width:100%">';
									foreach($exp as $ndm){
										$sel = "";
										if($sipp){
											if($ndm == $sipp[0]->hasilnya){
												$sel = 'selected="true"';
											}
										}
										echo '<option value="'.$ndm.'" '.$sel.'>'.$ndm.'</option>';
									}
									echo '</select>';
								}
								if($fd->det_jenis_pemeriksaan == "radio"){
									//saatnya pecah datanya yaaaaaaa'
									$hdys = $fd->det_pilihan_pemeriksaan."*Lainnya";
									$exp = explode("*", $hdys);
									echo '<input type="hidden" name="defaultnormal['.$fd->id_pem.']" value="'.$exp[0].'">';
									$nd = 1;
									foreach($exp as $ndm){
										$tm = $nd++;
										if($tm == '1'){
											$djcn = 'checked="true"';
										}else {
											$djcn = '';
										}
										//$djcn = "";
										if($sipp){
											if($ndm == $sipp[0]->hasilnya){
												$djcn = 'checked="true"';
											}
										}
										echo '<input type="radio" name="detpemeriksaan['.$fd->id_pem.']" '.$djcn.' value="'.$ndm.'"> '.$ndm;
									}
								}
							}else {
								$rangenya = rand($fd->det_range_pemeriksaan_awal, $fd->det_range_pemeriksaan_akhir);
								if($sipp){
									$rangenya = $sipp[0]->hasilnya;
								}
								echo '<input type="text" style="width:100%" value="'.$rangenya.'" name="detpemeriksaan['.$fd->id_pem.']">';
							}
						} else {
							$untukloopfunctonbawah[$fd->id_pem] = 'jadiiddata'.$fd->id_pem;
							echo '<textarea style="width:99%;height:15px;" id="jadiiddata'.$fd->id_pem.'" name="detpemeriksaan['.$fd->id_pem.']">'.@$sipp[0]->hasilnya.'</textarea>';
						}
					?>
				</td>
				<td width="35%" <?=@$bck?>>
					<?php 
						if($fd->det_nilai_normal == "Y"){
							if($fd->det_type_pemeriksaan == "tetap"){
								echo '<textarea style="width:99%;height:15px;" name="kelainandetpemeriksaan['.$fd->id_pem.']">'.@$sipp[0]->ketkelainanlainnya.'</textarea>';
							}else {
								echo $fd->det_satuan_pemeriksaan != "" ? $fd->det_satuan_pemeriksaan ." | " : "- | ";
								echo "<b>(Range: ".$fd->det_range_pemeriksaan_awal ." - ". $fd->det_range_pemeriksaan_akhir .")</b>";
							}
						} else {
							echo $fd->det_satuan_pemeriksaan != "" ? $fd->det_satuan_pemeriksaan : "-";
						}
					?>
				</td <?=@$bck?>>
				<td width="1%"><button type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;" onclick="tampilkanhistory('<?=@$fd->id_pem?>', '<?=@$fd->det_nm_pemeriksaan?>', '<?=@$_GET['kode_transaksi']?>')">History</button></td>
			</tr>
					<?php } ?>
				<?php } ?>
				<tr>
					<td STYLE="height:10px;"><b>KESIMPULAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="kesimpulan_pemeriksaan"><?=@$kjksd->kesimpulan_pemeriksaan?></textarea></td>
				</tr>
				<tr>
					<td STYLE="height:10px;"><b>SARAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="saran_pemeriksaan"><?=@$kjksd->saran_pemeriksaan?></textarea></td>
				</tr>
				<tr>
					<?php if($pangkasnoreg == "D"){ ?>
					<?php 
						if($nhyd[0]->jangan_tampil_stakes == ""){ 
							if($nhyd[0]->set_pemeriksaan_fisik == "Y"){ 
								if($dfrs[0]->casis_tni == "Y"){ 
					?>
								<td STYLE="height:10px;"><b>STAKES</b></td>
									<td>
										<div style="background:#00F200;color:white;margin:5px;padding:3px;"><div align="center">PAKET CASIS - STAKES MOHON DIISI</div></div>
										<?php
											//$this->db->select('id_pre, nm_pre');
											$this->db->order_by('nm_stakes', 'ASC');
											$cmb1 = $this->db->get('tb_stakes');
											$cmb1 = $cmb1->result();
										?>
										
										<B>STAKES TB/BB</B><BR />
										<select name="stakes_tb"  style="width:100%">
										<option value=""></option>
										<?php 
											foreach($cmb1 as $va){ 
											$sel = "";
											if($kjksd){
												if($kjksd->stakes_tb == $va->nm_stakes){
													$sel = 'selected="true"';
												}
											}
										?>
											<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
										<?php } ?>
										</select>
										<div style="width:95%;margin:5px;border-bottom:dotted 1px #666666"></div>
										<B>STAKES IMT</B><BR />
										<select name="stakes_imt"  style="width:100%">
										<option value=""></option>
										<?php 
											foreach($cmb1 as $va){ 
											$sel = "";
											if($kjksd){
												if($kjksd->stakes_imt == $va->nm_stakes){
													$sel = 'selected="true"';
												}
											}
										?>
											<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
										<?php } ?>
										</select>
										<div style="width:95%;margin:5px;border-bottom:dotted 1px #666666"></div>
										<B>STAKES ANAMNESA</B><BR />
										<select name="stakes_anamnesa"  style="width:100%">
										<option value=""></option>
										<?php 
											foreach($cmb1 as $va){ 
											$sel = "";
											if($kjksd){
												if($kjksd->stakes_anamnesa == $va->nm_stakes){
													$sel = 'selected="true"';
												}
											}
										?>
											<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
										<?php } ?>
										</select>
										<div style="width:95%;margin:5px;border-bottom:dotted 1px #666666"></div>
										<B>STAKES TENSI / NADI</b><BR />
										<select name="stakes_tensi"  style="width:100%">
										<option value=""></option>
										<?php 
											foreach($cmb1 as $va){ 
											$sel = "";
											if($kjksd){
												if($kjksd->stakes_tensi == $va->nm_stakes){
													$sel = 'selected="true"';
												}
											}
										?>
											<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
										<?php } ?>
										</select>
									</td>	
								<?php } else { ?>
									<td STYLE="height:10px;"><b>STAKES</b></td>
									<td>
										<?php
											//$this->db->select('id_pre, nm_pre');
											$this->db->order_by('nm_stakes', 'ASC');
											$cmb1 = $this->db->get('tb_stakes');
											$cmb1 = $cmb1->result();
										?>
										
										<select name="stakes"  style="width:100%">
										<option value=""></option>
										<?php 
											foreach($cmb1 as $va){ 
											$sel = "";
											if($kjksd){
												if($kjksd->val_stakes == $va->nm_stakes){
													$sel = 'selected="true"';
												}
											}
										?>
											<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
										<?php } ?>
										</select>
									</td>
								<?php } ?>
						<?php } else { ?>
							<td STYLE="height:10px;"><b>STAKES</b></td>
							<td>
								<?php
									if($dfrs[0]->casis_tni == "Y"){ 
								?>
								<div style="background:#00F200;color:white;margin:5px;padding:3px;"><div align="center">PAKET CASIS - STAKES MOHON DIISI</div></div>
								<?php } ?>
								<?php
									//$this->db->select('id_pre, nm_pre');
									$this->db->order_by('nm_stakes', 'ASC');
									$cmb1 = $this->db->get('tb_stakes');
									$cmb1 = $cmb1->result();
								?>
								<select name="stakes"  style="width:100%">
								<option value=""></option>
								<?php 
									foreach($cmb1 as $va){ 
									$sel = "";
									if($kjksd){
										if($kjksd->val_stakes == $va->nm_stakes){
											$sel = 'selected="true"';
										}
									}
								?>
									<option value="<?=@$va->nm_stakes?>" <?=@$sel?>><?=@$va->nm_stakes?></option>
								<?php } ?>
								</select>
							</td>
						<?php } ?>
					<?php } else { ?>
						<td></td>
						<td></td>
						<?php } ?>
					<?php } else { ?>
					<td></td>
					<td></td>
					<?php } ?>
					<td rowspan="2">
						<?php if($nhyd[0]->set_struktur_gigi == "Y"){ ?>
							<img src="<?=@$urigambar?>" style="width:200px;"><br />
							<input class="form-control" type="file" name="userfile[]">
						<?php } ?>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td style="vertical-align:top;">
						<a href="javascript:void(0)"  iconCls="icon-save" class="easyui-linkbutton" onclick="simpandetailpemeriksaanpoli()"><b>Simpan Hasil Pemeriksaan</b></a>
					</td>
				</tr>
			</table>
			<?php } ?>
		</td>
	</tr>
</table>
</form>

<div id="modalodontogram" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:600px;height:500px;padding:5px;background:#ffffff;">
	
</div>
<script type="text/javascript">
	function tampilkanhistory(id, nm, kode_transaksi){
		$('#modaltampilkanhistory').window('open');
					$('#modaltampilkanhistory').panel({
						title: 'History Pemeriksaan - '+nm+' - <?=@$_GET['noreg']?>',
						href:'<?=@base_url($this->u1.'/historypemeriksaan')?>/?idpem='+id+'&noreg=<?=@$_GET['noreg']?>',
					});
	}
	function hitungimt(){
		var brt = $('#beratbadan').val();
		var tgg = $('#tinggibadan').val();
		$.post("<?=@base_url($this->u1.'/hitungbmtya')?>", {
		brt:brt, tgg:tgg,
		}, function(response){
			if(response != ""){
				var sop = response;
				var res = sop.split("__"); 
				$('#imt').val(res[0]);
				$('#ketimt').val(res[1]);
				$('#beratbadanmax').val(res[2]);
				$('#beratbadanideal').val(res[3]);
				$('#beratbadanmin').val(res[4]);
			} else {
				$('#imt').val('');
				$('#ketimt').val('');
				$('#beratbadanmax').val('');
				$('#beratbadanideal').val('');
				$('#beratbadanmin').val('');
			}
		});
	}
</script>


<?php if($nhyd[0]->set_struktur_gigi == "Y"){ ?>
<script type="text/javascript">
	function tampilkanodontogramok(){
		$.post("<?=base_url($this->u1 .'/tampilkanodontogramok')?>", {
				idins:'<?=@$_GET['idins']?>', idtind:'<?=@$this->u3?>',kdtrans:'<?=@$_GET['kode_transaksi']?>',
			}, function(response){
				$('#viewdetailgigiok').html(response);
				sinkronodontotopemeriksaan();
		});
	}
	tampilkanodontogramok();
		
		
	function inputhasilgigitampil(posisi){
		//alert(posisi);
		$('#modalodontogram').window('open');
		$('#modalodontogram').panel({
			title: 'Posisi Gigi: '+posisi,
			href:'<?=@base_url($this->u1.'/ajaxposisigigikelainan')?>/'+posisi+'/?idins=<?=@$_GET['idins']?>&idtind=<?=@$this->u3?>&kdtrans=<?=@$_GET['kode_transaksi']?>&idgroup=<?=@$gfsd[0]->kd_group?>&idpaket=<?=@$_GET['id_paket']?>',
		});
	}
	
	/*function simpankelainangigiok(posisi){
		var row = $('#tabel_inputkelainangigiodonto').datagrid('getSelected'); 			
            if (row){
				//alert(row.id_paket);
				$.messager.confirm('Konfirmasi', 'Anda yakin akan menyimpan data ?', function(r) {
				if (r){
						var kelainan = row.kelainan;
						var warna = row.kode_kelainan;
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpankelainangigiok/')?>", {
							posisi:posisi, kelainan:kelainan,warna:warna,idins:'<?=@$_GET['idins']?>', idtind:'<?=@$this->u3?>',kdtrans:'<?=@$_GET['kode_transaksi']?>',idgroup:'<?=@$gfsd[0]->kd_group?>',idpaket:'<?=@$_GET['id_paket']?>',
						}, function(response){	
							$('#modalodontogram').window('close');
							tampilkanodontogramok();
						});
					}  
				}); 	
			}
			else {
				$.messager.alert('Informasi', 'Pilih Kelainan dahulu', 'info');
			}
	}*/
	
	
	
	function hapuspilihodonto(id){
		$.messager.confirm('Konfirmasi', 'Anda yakin akan menghapus data ?', function(r) {
				if (r){
						$.post("<?=base_url($this->u1 .'/'. $this->u1 .'_action/hapuspilihodonto/')?>", {
							id:id,
						}, function(response){	
							tampilkanodontogramok();
						});
					}  
				}); 	
	}
	
	
	
</script>
<?php } ?>
<script>
	function tampilkanhasiltekanandarahok(){
			var td1 = $('#tekanandarah1').val();
			var td2 = $('#tekanandarah2').val();
			$.post('<?=base_url('administrator/tampilkanhasiltekanandarah')?>',{
				td1:td1, td2:td2
			},function(result){ 
				$('#hasiltekanandarah').val(result);
			});
	}
</script>

<?php if(!$jhjkjh){ ?>
	<script>
	function sinkronodontotopemeriksaan(){
		<?php foreach($untukloopfunctonbawah as $sffsd => $bvll){ ?>
			//alert('<?=@$sffsd?>');
			$('#<?=@$bvll?>').val($('#untukambilke<?=@$sffsd?>').html());
		<?php } ?>
	}
</script>
<?php } else { ?>
<script>
	function sinkronodontotopemeriksaan(){
		
	}
</script>
<?php } ?>
