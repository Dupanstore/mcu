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
	
	
	$cekregpasien = "select c.en_hasil, c.nm_paket from tb_register a, tb_paket c where a.id_paket=c.id_paket and  a.kode_transaksi='".$_GET['kode_transaksi']."' ";
	$queryregpasien = $this->db->query($cekregpasien);
	$incekregpasien = $queryregpasien->row();
	//print_r($pangkasnoreg);
	//$pangkasnoreg = substr($_GET['noreg'],0,1);
	//print_r($pangkasnoreg);
?>
<form method="POST" id="inputpemeriksaanformdata" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaanrad')?>">
<table class="tableeasyui" style="width:100%">	
		<?php
			$this->db->select('id_reg_detpem');
			$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
			$this->db->where("id_ins_tind_detpem", '3');
			$this->db->where("id_paket", $_GET['id_paket']);
			$this->db->limit("1");
			$ndndbs = $this->db->get("tb_register_detailpemeriksaan");
			$jhjkjh = $ndndbs->result();
		?>
		
		<?php if($incekregpasien->en_hasil == "Y"){ ?>
		<tr>
			<td colspan="5" style="background:#00F200;color:white"><b><div align="center">Paket <?=@$incekregpasien->nm_paket?> | Mohon Mengisi Hasil Inputan Dengan Bahasa Inggris</div></b></td>
		</tr>
		<?php } ?>
		
		<?php if(!$jhjkjh){ ?>
		<tr>
			<td colspan="5" style="background:red;color:white"><b><div align="center">Pemeriksaan Belum Tersimpan</div></b></td>
		</tr>
		<?php } ?>
		<tr>
			<td style="background:#DEEEFA" colspan="2"><b>Pemeriksaan</b></td>
			<td style="background:#DEEEFA"><b>Hasil Pemeriksaan</b></td>
			<td style="background:#DEEEFA" width="9%"><b></b></td>
			<td style="background:#DEEEFA"><b></b></td>
		</tr>
<?php
	//print_r($this->u3);
	//print_r($_GET);
				//ambil stakes
				$this->db->select('val_stakes, kesimpulan_pemeriksaan, saran_pemeriksaan');
				$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
				$this->db->where('id_ins_tind_pem', '3');
				$this->db->limit('1');
				$ghgjh = $this->db->get('tb_register_pemeriksaan');
				$kjksd = $ghgjh->row();
	$asac = "select a.id_tind_pem, b.nm_tind, b.id_ins_tind, b.kesan_normal, b.kd_grouptind from tb_register_pemeriksaan a, tb_tindakan b where a.id_tind_pem=b.id_tind and a.kode_transaksi='".$_GET['kode_transaksi']."' AND a.id_ins_tind_pem='3' AND a.id_paket='".$_GET['id_paket']."' ";
	$uno = $this->db->query($asac);
	$ano = $uno->result();
	if($ano){
		foreach($ano as $bdn){
			$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
			$this->db->where("id_tind_pem", $bdn->id_tind_pem);
			$this->db->where("id_paket", $_GET['id_paket']);
			$this->db->limit("1");
			$fhfh = $this->db->get('tb_register_pemeriksaan');
			$fsha = $fhfh->result();
?>
			<input type="hidden" name="kode_transaksi[<?=@$bdn->id_tind_pem?>]" value="<?=@$_GET['kode_transaksi']?>">
			<input type="hidden" name="id_tind_detpem[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->id_tind_pem?>">
			<input type="hidden" name="id_ins_tind_detpem[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->id_ins_tind?>">
			<input type="hidden" name="kd_grouptind[<?=@$bdn->id_tind_pem?>]" value="<?=@$bdn->kd_grouptind?>">
			<input type="hidden" name="id_paket[<?=@$bdn->id_tind_pem?>]" value="<?=@$_GET['id_paket']?>">
<?php
			$kesannormal   = 'checked="true"';
			$kesanabnormal = '';
			$kesantext = $bdn->kesan_normal;
			if($fsha){
				if($fsha[0]->kesanstatus == "abnormal"){
					$kesannormal   = '';
					$kesanabnormal = 'checked="true"';
				}
				if($fsha[0]->kesantext != ""){
					$kesantext = $fsha[0]->kesantext;
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
			$mm = "select b.kd_group, b.id_ins_periksa, b.id_pem, b.rad_namapemeriksaan, b.rad_nilainormal from tb_pemeriksaan_meta a, tb_pemeriksaan b where 1=1 ";
			$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$bdn->id_tind_pem."' order by b.det_order_pemeriksaan ASC ";
			$absc = $this->db->query($mm);
			$gfsd = $absc->result();
			if($gfsd){		
		?>
		<tr>
			<td colspan="3" style="background:#3CE0ED;"><b><div align="left">Pemeriksaan <?=@$bdn->nm_tind?></div></b></td>
			<td colspan="2" style="background:#3CE0ED;"><button type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;" onclick="tampilkanhistorypemeriksaanrad('<?=@$bdn->id_tind_pem?>', '<?=@$bdn->nm_tind?>', '<?=@$_GET['kode_transaksi']?>')"><?=@$bdn->nm_tind?> History</button></td>
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
			<td width="3%" <?=@$bck?>></td>
			<td width="15%" <?=@$bck?>><?=@$fd->rad_namapemeriksaan?></td>
			<td <?=@$bck?>>
				<input type="hidden" name="id_reg_detpem[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" value="<?=@$idnya?>">
				<?php 
					echo '<textarea style="width:99%;" name="detpemeriksaan['.$bdn->id_tind_pem.']['.$fd->id_pem.']">'.@$nilainormalnya.'</textarea>';
					
				?>
			</td>
			<td <?=@$bck?>><input type="checkbox" name="statusnormal[<?=@$bdn->id_tind_pem?>][<?=@$fd->id_pem?>]" <?=@$gdd?>>Normal</td>
			<td width="1%"><button type="button" style="cursor:pointer;background:#CDDDED;border:solid 1px #3BD0E2;" onclick="tampilkanhistory('<?=@$fd->id_pem?>', '<?=@$fd->rad_namapemeriksaan?>', '<?=@$_GET['kode_transaksi']?>')">History</button></td>
		</tr>
				<?php } ?>
			<?php } ?>
			<tr>
				<td></td>
				<td><b>KESAN</b></td>
				<td colspan="3">
					<div style="display:none;"><input type="radio" name="kesanstatus[<?=@$bdn->id_tind_pem?>]" <?=@$kesannormal?> value="normal"> Dalam batas Normal
					<input type="radio" name="kesanstatus[<?=@$bdn->id_tind_pem?>]" <?=@$kesanabnormal?> value="abnormal"> Abnormal<br /></div>
					<textarea style="width:98.5%;" name="kesantext[<?=@$bdn->id_tind_pem?>]"><?=@$kesantext?></textarea>
				</td>
			</tr>
		<?php } ?>
		
	<?php } ?>
			<tr>
				<td colspan="5"><hr style="border:solid 1px #cccccc;"/></td>
			</tr>
			<!--<tr>
				<td><b></b></td>
					<td STYLE="height:10px;"><b>KESIMPULAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="kesimpulan_pemeriksaan"><?=@$kjksd->kesimpulan_pemeriksaan?></textarea></td>
				</tr>-->
				<tr>
					<td><b></b></td>
					<td STYLE="height:10px;"><b>SARAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="saran_pemeriksaan"><?=@$kjksd->saran_pemeriksaan?></textarea></td>
				</tr>
			<?php if($pangkasnoreg == "D"){ ?>
			<tr>
				<td></td>
				<td><b>STAKES</b></td>
				<td><?php
								//$this->db->select('id_pre, nm_pre');
								$this->db->order_by('nm_stakes', 'ASC');
								$cmb1 = $this->db->get('tb_stakes');
								$cmb1 = $cmb1->result();
							?>
							<select name="stakes"  style="width:50%">
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
							</select></td>
				<td></td>
				<td></td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button type="button" style="cursor:pointer" onclick="simpandetailpemeriksaanpoli()">Simpan Pemeriksaan</button>
				</td>
				<td></td>
				<td></td>
			</tr>
		</table>
<?php } ?>
</form>
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
</script>

