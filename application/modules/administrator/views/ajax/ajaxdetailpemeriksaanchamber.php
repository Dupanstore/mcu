<?php
	//print_r($_GET);
?>
<form method="POST" id="inputpemeriksaanformdatachamber" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanpemeriksaanpoliklinik')?>">
	<input type="hidden" name="id_parent" value="<?=@$_GET['id_parent']?>">
	<input type="hidden" name="kode_transaksi" value="<?=@$_GET['kode_transaksi']?>">
	<input type="hidden" name="id_tind_detpem" value="<?=@$this->uri->segment(3)?>">
	<input type="hidden" name="id_paket" value="<?=@$_GET['id_paket']?>">
	<input type="hidden" name="noreg_pas" value="<?=@$_GET['noreg']?>">
<?php
	$this->db->select('id_reg_detpem');
	$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
	$this->db->where("id_tind_detpem", $this->uri->segment(3));
	$this->db->where("id_paket", $_GET['id_paket']);
	$this->db->where("id_parent_chamber", $_GET['id_parent']);
	$this->db->limit("1");
	$ndndbs = $this->db->get("tb_register_detailpemeriksaan");
	$jhjkjh = $ndndbs->result();
?>
<table class="tableeasyui" style="width:100%">
	<?php if(!$jhjkjh){ ?>
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Pemeriksaan Belum Tersimpan</div></b></td>
	</tr>
	<?php } ?>
	<tr>
		<td>
			
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
				$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$this->uri->segment(3)."' and b.parent_chamber='".$_GET['id_parent']."' order by b.det_order_pemeriksaan ASC ";
				$absc = $this->db->query($mm);
				$gfsd = $absc->result();
				if($gfsd){
					//ambil stakes
					$this->db->select('val_stakes');
					$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
					$this->db->where('id_ins_tind_pem', $gfsd[0]->id_ins_periksa);
					$this->db->limit('1');
					$ghgjh = $this->db->get('tb_register_pemeriksaan');
					$kjksd = $ghgjh->row();
			?>
			<input type="hidden" name="id_ins_tind_detpem" value="<?=@$gfsd[0]->id_ins_periksa?>">
			<input type="hidden" name="kd_grouptind" value="<?=@$gfsd[0]->kd_group?>">
			<tr>
				<td style="background:#DEEEFA"><b>Pemeriksaan</b></td>
				<td style="background:#DEEEFA"><b>Hasil Pemeriksaan & Daftar Kelainan (Settingan Master)</b></td>
				<td style="background:#DEEEFA"><b>Masukkan Jika ada kelainan yang lain</b></td>
				<td style="background:#DEEEFA"><b></b></td>
			</tr>
			<?php
					$isidetpem = "";
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
								if(!empty($sipp[0]->kesimpulan_det_pemeriksaan)){
									$isidetpem = $sipp[0]->kesimpulan_det_pemeriksaan;
								}
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
							echo '<textarea style="width:99%;height:15px;" name="detpemeriksaan['.$fd->id_pem.']">'.@$sipp[0]->hasilnya.'</textarea>';
						}
					?>
				</td>
				<td width="25%" <?=@$bck?>>
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
					<td colspan="4"><hr style="border:solid 1px #cccccc;"/></td>
				</tr>
				<tr>
				
					<td STYLE="height:10px;"><b>KESIMPULAN</b></td>
					<td colspan="4"><textarea style="width:99%;height:40px;" name="kesimpulan_det_pemeriksaan"><?=@$isidetpem?></textarea></td>
				</tr>
				<?php if($_GET['id_parent'] == "214"){ ?>
				<tr>
					<td><b>Stakes</b></td>
					<td>
						<?php
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
							</select>
					</td>
					<td></td>
				</tr>
				<?php } ?>
				<tr>
					<td></td>
					<td>
						<button type="button" style="cursor:pointer" onclick="simpandetailpemeriksaanchamber()">Simpan Pemeriksaan</button>
					</td>
					<td></td>
				</tr>
			</table>
			<?php } ?>
		</td>
	</tr>
</table>
</form>
<script type="text/javascript">
	function tampilkanhistory(id, nm, kode_transaksi){
		$('#modaltampilkanhistory').window('open');
					$('#modaltampilkanhistory').panel({
						title: 'History Pemeriksaan - '+nm+' - <?=@$_GET['noreg']?>',
						href:'<?=@base_url($this->u1.'/historypemeriksaan')?>/?idpem='+id+'&noreg=<?=@$_GET['noreg']?>',
					});
	}
</script>

