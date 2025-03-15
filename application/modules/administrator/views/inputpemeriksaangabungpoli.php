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
	
	//selanjutnya filter lagi kalo nonfinas
	if($pangkasnoreg == "N"){
		$sdhgdwver = "select auto_dinas from tb_paket where id_paket=".$_GET['id_paket']." ";
		$eretryete = $this->db->query($sdhgdwver);
		$sjhdgrher = $eretryete->row();
		if($sjhdgrher->auto_dinas =="Y"){
			$pangkasnoreg = 'D';
		}
	}
	
	
	
	$cekregpasien = "select c.en_hasil, c.nm_paket, c.casis_tni from tb_register a, tb_paket c where a.id_paket=c.id_paket and  a.kode_transaksi='".$_GET['kode_transaksi']."' ";
	$queryregpasien = $this->db->query($cekregpasien);
	$incekregpasien = $queryregpasien->row();
	//print_r($pangkasnoreg);
	//$pangkasnoreg = substr($_GET['noreg'],0,1);
	//print_r($pangkasnoreg);
?>

		
		
		<?php if($incekregpasien->en_hasil == "Y"){ ?>
		<table class="tableeasyui" style="width:100%">	
		<tr>
			<td colspan="5" style="background:#00F200;color:white"><b><div align="center">Paket <?=@$incekregpasien->nm_paket?> | Mohon Mengisi Hasil Inputan Dengan Bahasa Inggris</div></b></td>
		</tr>
		</table>
		<?php } ?>
		
<!--<div class="easyui-tabs" style="width:100%%;">-->
<?php
	//print_r($this->u3);
	//print_r($_GET);
				//ambil stakes
	$asac = "select a.id_tind_pem, b.nm_tind, b.id_ins_tind, b.kesan_normal, b.kd_grouptind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$_GET['kode_transaksi']."' AND a.id_ins_tind_pem='13' AND a.id_paket='".$_GET['id_paket']."' ";
	$uno = $this->db->query($asac);
	$ano = $uno->result();
	if($ano){
		foreach($ano as $bdn){
			$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
			$this->db->where("id_tind_pem", $bdn->id_tind_pem);
			$this->db->where("id_paket", $_GET['id_paket']);
			$this->db->limit("1");
			$fhfh = $this->db->get('tb_register_pemeriksaan');
			$kjksd = $fhfh->row();
?>
		
<?php
			$kesannormal   = 'checked="true"';
			$kesanabnormal = '';
			$kesantext = $bdn->kesan_normal;
			if($fsha){
				if($fsha->kesanstatus == "abnormal"){
					$kesannormal   = '';
					$kesanabnormal = 'checked="true"';
				}
				if($fsha->kesantext != ""){
					$kesantext = $fsha->kesantext;
				}
			}
			
			//ambil semua pemeriksaan diradiologi yaaaaa
			//ini kalau dia konsep poliiiiiiiiiii yaa
			//KITA JUGA AMBIL PEMERIKSAAN YANG DIFILTER YAAAAAA
			$this->db->select('id_pem');
			$this->db->where('id_tind', $bdn->id_tind_pem);
			$this->db->where('unicode_transaksi', $_GET['kode_transaksi']);
			$this->db->where('type_filter', 'KURANG');
			$abo = $this->db->get('tb_register_filterdata');
			$ubi = $abo->result();
			if($ubi){
				foreach($ubi as $df){
					$jangantampil[$df->id_pem] = $df->id_pem;
				}
			}
			$mm = "select b.* from tb_pemeriksaan_meta a, tb_pemeriksaan b where 1=1 ";
			$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$bdn->id_tind_pem."' order by b.det_order_pemeriksaan ASC ";
			$absc = $this->db->query($mm);
			$gfsd = $absc->result();
			if($gfsd){		
		?>
		<!--<div title="<?=@$bdn->nm_tind?>">-->
		<form method="POST" id="inputpemeriksaangabungform<?=@$bdn->id_tind_pem?>" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaancampuran')?>">
		<input type="hidden" name="kode_transaksi[<?=@$bdn->id_tind_pem?>]" value="<?=@$_GET['kode_transaksi']?>">
			<input type="hidden" name="id_tind_detpem[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->id_tind_pem?>">
			<input type="hidden" name="id_ins_tind_detpem[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->id_ins_tind?>">
			<input type="hidden" name="kd_grouptind[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->kd_grouptind?>">
			<input type="hidden" name="id_paket[<?=@$bdn->id_tind_pem?>]" value="<?=@$_GET['id_paket']?>">
		<table class="tableeasyui" style="width:100%">	
		<tr>
			<td colspan="20" style="background:#3CE0ED;"><b><div align="left"><?=@$bdn->nm_tind?></div></b></td>
		</tr>
		<?php
			$this->db->select('id_reg_detpem');
			$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
			$this->db->where("id_ins_tind_detpem", '13');
			$this->db->where("id_tind_detpem", $bdn->id_tind_pem);
			$this->db->where("id_paket", $_GET['id_paket']);
			$this->db->limit("1");
			$ndndbs = $this->db->get("tb_register_detailpemeriksaan");
			$jhjkjh = $ndndbs->row();
		?>
		<?php if(!$jhjkjh){ ?>
		<tr>
			<td colspan="20" style="background:red;color:white"><b><div align="center"><?=@$bdn->nm_tind?> Belum Tersimpan</div></b></td>
		</tr>
		<?php } ?>
		<tr>
				<td style="background:#DEEEFA"><b>Pemeriksaan</b></td>
				<td style="background:#DEEEFA"><b>Hasil Pemeriksaan & Daftar Kelainan (Settingan Master)</b></td>
				<td style="background:#DEEEFA"><b>Masukkan Jika ada kelainan yang lain</b></td>
				<td style="background:#DEEEFA"><b></b></td>
			</tr>
		<?php
				foreach($gfsd as $fd){
					if(!$jangantampil[$fd->id_pem]){
						//ambil id pemeriksaane yaaaaaaaa
						$idnya = "";
						$bck = "";
						$gdd = "checked='true'";
						$nilainormalnya = $fd->rad_nilainormal;
						//$this->db->select('id_reg_detpem, adakelainan');
						$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
						$this->db->where("id_tind_detpem", $bdn->id_tind_pem);
						$this->db->where("id_paket", $_GET['id_paket']);
						$this->db->where("id_pem_deb", $fd->id_pem);
						$this->db->limit("1");
						$sapp = $this->db->get("tb_register_detailpemeriksaan");
						$sipp = $sapp->result();
						if($sipp){
							$idnya = $sipp[0]->id_reg_detpem;
							$nilainormalnya = $sipp[0]->hasilnya;
							if($sipp[0]->adakelainan == "Y"){
								$bck = 'style="background:red;color:white;font-weight:bold"';
								$gdd = "";
							}
						}
		?>
		<tr <?=@$bck?>>
			<td width="3%" <?=@$bck?>><?=@$fd->det_nm_pemeriksaan?></td>
			<td <?=@$bck?>>
					<input type="hidden" name="id_reg_detpem[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$idnya?>">
					<input type="hidden" name="set_nilai_normal[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$fd->det_nilai_normal?>">
					<input type="hidden" name="type_pemeriksaan[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$fd->det_type_pemeriksaan?>">
					<input type="hidden" name="range_pemeriksaan_awal[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$fd->det_range_pemeriksaan_awal?>">
					<input type="hidden" name="range_pemeriksaan_akhir[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$fd->det_range_pemeriksaan_akhir?>">
					<?php 
						if($fd->det_nilai_normal == "Y"){ 
							if($fd->det_type_pemeriksaan == "tetap"){
								if($fd->det_jenis_pemeriksaan == "combo"){
									//saatnya pecah datanya yaaaaaaa'
									//kita tambahkan lainnya
									$hdys = $fd->det_pilihan_pemeriksaan."*Lainnya";
									$exp = explode("*", $hdys);
									echo '<input type="hidden" name="defaultnormal['.$bdn->id_tind_pem.']['.$fd->id_pem.']" value="'.$exp[0].'">';
									echo '<select name="detpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']" style="width:100%">';
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
									echo '<input type="hidden" name="defaultnormal['.$bdn->id_tind_pem.']['.$fd->id_pem.']" value="'.$exp[0].'">';
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
										echo '<input type="radio" name="detpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']" '.$djcn.' value="'.$ndm.'"> '.$ndm;
									}
								}
							}else {
								$rangenya = rand($fd->det_range_pemeriksaan_awal, $fd->det_range_pemeriksaan_akhir);
								if($sipp){
									$rangenya = $sipp[0]->hasilnya;
								}
								echo '<input type="text" style="width:100%" value="'.$rangenya.'" name="detpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']">';
							}
						} else {
							$untukloopfunctonbawah[$fd->id_pem] = 'jadiiddata'.$fd->id_pem;
							echo '<textarea style="width:99%;height:15px;" id="jadiiddata'.$fd->id_pem.'" name="detpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']">'.@$sipp[0]->hasilnya.'</textarea>';
						}
					?>
				</td>
				<td width="35%" <?=@$bck?>>
					<?php 
						if($fd->det_nilai_normal == "Y"){
							if($fd->det_type_pemeriksaan == "tetap"){
								echo '<textarea style="width:99%;height:15px;" name="kelainandetpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']">'.@$sipp[0]->ketkelainanlainnya.'</textarea>';
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
					<td colspan="4"><textarea style="width:99%;height:40px;" name="kesimpulan_pemeriksaan[<?=@$bdn->id_tind_pem?>]"><?=@$kjksd->kesimpulan_pemeriksaan?></textarea></td>
				</tr>
				<tr>
					<td STYLE="height:10px;"><b>SARAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="saran_pemeriksaan[<?=@$bdn->id_tind_pem?>]"><?=@$kjksd->saran_pemeriksaan?></textarea></td>
				</tr>
				<tr>
					<td STYLE="height:10px;"><b>DIAGNOSA PENYAKIT</b></td>
					<td colspan="4"><div id="divuntukdiagnosapenyakitdigabung<?=@$bdn->id_tind_pem?>"></div></td>
				</tr>
				<?php if($pangkasnoreg == "D"){ ?>
				<tr>
						<td><b>STAKES</b></td>
							<td>
								<?php
									if($incekregpasien->casis_tni == "Y"){ 
								?>
								<div style="background:#00F200;color:white;margin:5px;padding:3px;"><div align="center">PAKET CASIS - STAKES MOHON DIISI</div></div>
								<?php } ?>
								<?php
									//$this->db->select('id_pre, nm_pre');
									$this->db->order_by('nm_stakes', 'ASC');
									$cmb1 = $this->db->get('tb_stakes');
									$cmb1 = $cmb1->result();
								?>
								<select name="stakes[<?=@$bdn->id_tind_pem?>]"  style="width:100%">
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
					</td>
				</tr>
				<?php } ?>
				<tr>
				<td></td>
					<td>
						<button type="button" style="cursor:pointer;font-size:16px;padding:5px;" onclick="simpandetailpemeriksaanpoligabungtind('<?=@$bdn->id_tind_pem?>', '<?=@$bdn->nm_tind?>')">Simpan <?=@$bdn->nm_tind?></button>
					</td>
					<td></td>
					<td></td>
				</tr>	
			</table>
			</form>
			<!--</div>-->
		<?php } ?>
		
	<?php } ?>
			
		
<?php } ?>
<!--</div>-->
<script type="text/javascript">
	function tampilkanhistory(id, nm, kode_transaksi){
		$('#modaltampilkanhistory').window('open');
					$('#modaltampilkanhistory').panel({
						title: 'History Pemeriksaan - '+nm+' - <?=@$_GET['noreg']?>',
						href:'<?=@base_url($this->u1.'/historypemeriksaan')?>/?idpem='+id+'&noreg=<?=@$_GET['noreg']?>',
					});
	}
	function tampilkanhistorypemeriksaanrad(id, nm, kode_transaksi){
		$('#modaltampilkanhistory').window('open');
					$('#modaltampilkanhistory').panel({
						title: 'History Pemeriksaan - '+nm+' - <?=@$_GET['noreg']?>',
						href:'<?=@base_url($this->u1.'/historypemeriksaanrad')?>/?idtind='+id+'&noreg=<?=@$_GET['noreg']?>',
					});
	}
	
	function getuntukdiagnosapenyakitdigabung(idtind){
		$('#divuntukdiagnosapenyakitdigabung'+idtind).html("Proses...");
		$.post("<?=base_url($this->u1 .'/getuntukdiagnosapenyakitdigabung/')?>", {
			kode_transaksi:'<?=@$_GET['kode_transaksi']?>', idins:'<?=@$_GET['idins']?>',idtind:idtind,
		}, function(response){	
			$('#divuntukdiagnosapenyakitdigabung'+idtind).html(response);
		});
	}
	<?php foreach($ano as $bdn){ ?>
		getuntukdiagnosapenyakitdigabung('<?=@$bdn->id_tind_pem?>');
	<?php } ?>
</script>

