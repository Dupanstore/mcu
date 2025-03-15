<?php
	$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
	$cekregs = $this->db->get('tb_register');
	$getregs = $cekregs->row();
	if(empty($getregs->qr_code_keys)){
		$gsbbd['qr_code_keys'] = get_api_hash();
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		$this->db->update('tb_register', $gsbbd);
	}
	$sdhgdwver = "select auto_grounded, auto_dinas from tb_paket where id_paket=".$_GET['id_paket']." ";
	$eretryete = $this->db->query($sdhgdwver);
	$sjhdgrher = $eretryete->row();
	$groundeds = $sjhdgrher->auto_grounded;
	
		
	//$pangkasnoreg = substr($_GET['no_reg'],0,1);
	$ceknoregdata = "select b.tipe_dinas from tb_pasien a, tb_dinas b where a.id_dinas=b.id_dinas and a.no_reg='".$_GET['no_reg']."' ";
	$queryceknored = $this->db->query($ceknoregdata);
	$incekkodedinas = $queryceknored->row();
	
	//print_r($sjhdgrher);
	$pangkasnoreg = "N";
	if($incekkodedinas){
		if(!empty($incekkodedinas->tipe_dinas)){
			$pangkasnoreg = $incekkodedinas->tipe_dinas;
		}
	}
	
		//selanjutnya filter lagi kalo nonfinas
	if($pangkasnoreg == "N"){
		if($sjhdgrher->auto_dinas =="Y"){
			$pangkasnoreg = 'D';
		}
	}
	
	$this->db->order_by('id_saran', 'ASC');
	$gtsrnok = $this->db->get('tb_saran');
	$lpsrnou = $gtsrnok->result();
	
	$sga = "select a.val_stakes, b.id_tind, b.nm_tind, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, e.id_grouptindakan, e.nm_grouptindakan, e.order_evalusi_group from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
	$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
	$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
	$sfc = $this->db->query($sga);
	$ash = $sfc->result();
	//print_r($ash);
	if($ash){
		foreach($ash as $bs){		
				if($bs->id_ins == "3"){
					$awalstakes[$bs->set_stakes][$bs->id_grouptindakan."-".$bs->id_tind] = $bs->val_stakes;
				} else {
					if($bs->stakes_tindakan != ""){
						$awalstakes[$bs->stakes_tindakan][$bs->id_tind."-".$bs->id_tind] = $bs->val_stakes;
					}else {
						$awalstakes[$bs->set_stakes][$bs->id_ins."-".$bs->id_tind] = $bs->val_stakes;
					}
				}
		}
		//saatnya looping untuk menampilkan
		
		foreach($awalstakes as $mk => $aq){
			$bsa = max($aq);
			if($mk != "B"){
				$stkkes[$mk] = $bsa;
			}
		}
		//print_r($stkkes);
		
	}
	//print_r($stkkes);
		//ambil data sebelumnya
		
		$this->db->where('ket_resume', 'kesimpulansaran');
		$this->db->where('kode_transaksi', $_GET['kode_transaksi']);
		$sssa = $this->db->get('tb_resume_pasien');
		$respas = $sssa->result();
		if($respas){
			$stkkes = array();
			foreach($respas as $sag){
				$bek_id[$sag->nama_kesansaran] = $sag->id_res;
				$bek_isi[$sag->nama_kesansaran] = $sag->isi_kesansaran;
				$stkkes[$sag->nama_kesansaran] = $sag->isi_kesansaran;
			}
			$getsaran['saran']  = unserialize($bek_isi['saran']);
			$getsimpul['kesimpulan'] = unserialize($bek_isi['kesimpulan']);
			$getdetailsaran['detailsaran'] = unserialize($bek_isi['detailsaran']);
		}else{
			$sssa = $this->db->query("select nama_kelainan, ket_resume, kesimpulan_kelainan, saran_kelainan, isi_kelainan from tb_resume_pasien where kode_transaksi='".$_GET['kode_transaksi']."' and (ket_resume='diagnosakelainan' OR ket_resume='periksatambahan') and isi_kelainan <>'' and aktif_diagnosakelainan <> 'N' ");
			$saranawal = $sssa->result();
			$gdhj=1;
			foreach($saranawal as $vdv){
				$isisimpulokya = $vdv->kesimpulan_kelainan;
				if($vdv->ket_resume == "periksatambahan"){
					$isisimpulokya = $vdv->isi_kelainan;
				}
				$bvd = $gdhj++;
				$getsimpul['kesimpulan'][$bvd] = $vdv->nama_kelainan .": ".$isisimpulokya;
				
				//$getsimpul['kesimpulan']['bawah'] = "Mohon Konsultasi Ke: ";
				$getdetailsaran['detailsaran'][$bvd] = $vdv->saran_kelainan;
			}
			$getsimpul['kesimpulan']['atas'] = "Mohon Konsultasi Ke: ";
		}
		//$getsimpul['kesimpulan']['atas'] = "ssssssssss";
		//print_r($getsaran);
		
		
?>
	<?php if(!$respas){ ?>
	<table class="tableeasyui" style="width:100%">
	<tr>
		<td colspan="2" style="background:red;color:white"><b><div align="center">Kesimpulan dan Saran Belum Tersimpan</div></b></td>
	</tr>
	</table>
	<?php } ?>
<form method="POST" id="detailkesimpulansaran_form1" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpankesimpulandansaran')?>">
<input type="hidden" name="kode_transaksi_resume" value="<?=@$_GET['kode_transaksi']?>">
<input type="hidden" name="id_paket_resume" value="<?=@$_GET['id_paket']?>">
<table style="width:100%">
	<tr>
		<td colspan="2">
					<table style="width:100%" class="tableeasyui">
						
						<tr>
							<td><b>No</b></td>
							<td><b>Kesimpulan</b></td>
							<td><b>Saran</b></td>
							
							<td><b>Detail Saran</b></td>
							
						</tr>
						<?php if($pangkasnoreg == "N"){ ?>
						<tr>
							<td style="width:1px;"></td>
							<td colspan="3">
								<textarea name="isinya[kesimpulan][atas]" style="width:99%;height:35px;border:solid 1px #cccccc;"><?=@$getsimpul['kesimpulan']['atas']?></textarea>
							</td>
						</tr>
						<?php } ?>
						<?php foreach( range(1,10) as $gi){ ?>
						<tr>
							<td style="width:1px;"><?=@$gi?></td>
							<td>
								<textarea name="isinya[kesimpulan][<?=@$gi?>]" style="width:99%;height:35px;border:solid 1px #cccccc;"><?=@$getsimpul['kesimpulan'][$gi]?></textarea>
							</td>
							<td style="width:30%">
								<select id="namakesimpulan<?=@$gi?>" name="isinya[saran][<?=@$gi?>]"  style="width:100%">
									<option value=""></option>
									<?php 
										foreach($lpsrnou as $va){ 
										$sel = "";
										if($getsaran['saran'][$gi] == $va->nm_saran){
											$sel = 'selected="true"';
										}
									?>
										<option value="<?=@$va->nm_saran?>" <?=@$sel?>><?=@$va->nm_saran?></option>
									<?php } ?>
									</select>
							</td>
							<td>
								<textarea name="isinya[detailsaran][<?=@$gi?>]" style="width:99%;height:35px;border:solid 1px #cccccc;"><?=@$getdetailsaran['detailsaran'][$gi]?></textarea>
							</td>
						</tr>
						<?php } ?>
						<?php if($pangkasnoreg == "N"){ ?>
						<tr>
							<td style="width:1px;"></td>
							<td colspan="3">
								<input list="browsers" style="width:98%" id="isinya[kesimpulan][bawah]" name="isinya[kesimpulan][bawah]" value="<?=@$getsimpul['kesimpulan']['bawah']?>">
								<datalist id="browsers" style="width:40%">
								 <?php 
									$this->db->order_by('id_ctd', 'ASC');
									$this->db->where('jenis_catatan', 'N');
									$cmb1 = $this->db->get('tb_catatan_dinas');
									$cmb1 = $cmb1->result();
									foreach($cmb1 as $va){ 
								?>
									<option value="<?=@$va->nm_ctd?>">
								<?php } ?>
								</datalist>
			
								
							</td>
						</tr>
						<?php } ?>
						<!--<tr>
							<td colspan="2">
								<textarea name="isinya[kesimpulan][bawah]" style="width:99%;height:35px;border:solid 1px #cccccc;"><?=@$getsimpul['kesimpulan']['bawah']?></textarea>
							</td>
						</tr>-->
					</table>
					
		</td>
	</tr>
	<?php if($pangkasnoreg == "D"){ ?>
	<tr>
		<td>Status Kesehatan</td>
		<td>
			<table class="tableeasyui">
				<tr>
			<?php
				foreach(is_stakes() as $sg){
			?>
					<td><div align="center"><?=@$sg?></div></td>
			<?php } ?>
			</tr>
				<tr>
			<?php
				foreach(is_stakes() as $sg){
					//print_r($stkkes);
			?>

					<td>
						<input type="hidden" name="idstakes[<?=@$sg?>]" value="<?=@$bek_id[$sg]?>">
						<input type="text" name="getstakes[<?=@$sg?>]" style="width:40px" value="<?=@$stkkes[$sg]?>">
					</td>
			<?php } ?>
			</tr>
			</table>
		</td>
	</tr>
	<?php } ?>
	<?php 
		if($groundeds == "Y"){ 
			$cekwrs = "";
			if($bek_isi['ketgrounded'] == "YA"){
				$cekwrs = 'style="background:red;color:white;font-weight:bold;"';
			}
	?>
	<!--<tr >
		<td <?=@$cekwrs?>>Grounded</td>
		<td >	
			<input type="hidden" name="idnya[ketgrounded]" value="<?=@$bek_id['ketgrounded']?>">
			<select  id="ketgrounded" name="isinya[ketgrounded]" style="width:40%;">
				<?php 
					foreach(is_yatidak() as $va => $vlls){ 
						$sel = "";
						if($bek_isi['ketgrounded']){
							if($bek_isi['ketgrounded'] == $va){
								$sel = 'selected="true"';
							}
						}
				?>
					<option value="<?=@$va?>" <?=@$sel?>><?=@$vlls?></option>
				<?php } ?>
				</select>
		</td>
	</tr>-->
	<?php } ?>
	<tr>
		<td>ttd KATIM</td>
		<td>
			<?php
				//print_r($getregs->def_ttd);
			?>
			<select  id="ttdkatim" name="ttdkatim" style="width:40%;">
					<?php 
					
						$this->db->order_by('id_dok', 'ASC');
						$cmb1 = $this->db->get('tb_dokter');
						$cmb1 = $cmb1->result();
						foreach($cmb1 as $va){ 
							$sel = "";
							if($getregs){
								if($getregs->def_ttd > 0){
									if($getregs->def_ttd == $va->id_dok){
										$sel = 'selected="true"';
									}
								}else{
									if(is_def_ttdkatim() == $va->id_dok){
										$sel = 'selected="true"';
									}
								}
								
							}
					?>
						<option value="<?=@$va->id_dok?>" <?=@$sel?>><?=@$va->nm_dok?></option>
					<?php } ?>
					</select>
		</td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>
			<input type="hidden" name="idnya[keterangan_sehat]" value="<?=@$bek_id['keterangan_sehat']?>">
			<select  id="keterangan_sehat"  name="isinya[keterangan_sehat]" style="width:70%;">
									<option value="">-</option>
									<?php 
										$this->db->select('id_kondisi, nm_kondisi');
										$this->db->order_by('nm_kondisi', 'ASC');
										$cmb1 = $this->db->get('tb_kondisi');
										$cmb1 = $cmb1->result();
										foreach($cmb1 as $va){ 
											$sel = "";
											if($bek_isi['keterangan_sehat']){
												if($bek_isi['keterangan_sehat'] == $va->id_kondisi){
													$sel = 'selected="true"';
												}
											}
									?>
										<option value="<?=@$va->id_kondisi?>" <?=@$sel?>><?=@$va->nm_kondisi?></option>
									<?php } ?>
									</select>
		</td>
	</tr>
	<?php if($pangkasnoreg == "D"){ ?>
	<tr>
		<td>Catatan</td>
		<td colspan="2">
			<input type="hidden" name="idnya[catatan_tambahan_dinas]" value="<?=@$bek_id['catatan_tambahan_dinas']?>">
			<input list="browsers" style="width:98%" id="catatan_tambahan_dinas" name="isinya[catatan_tambahan_dinas]" value="<?=@$bek_isi['catatan_tambahan_dinas']?>">
			<datalist id="browsers" style="width:40%">
			 <?php 
				$this->db->order_by('id_ctd', 'ASC');
				$this->db->where('jenis_catatan', 'D');
				$cmb1 = $this->db->get('tb_catatan_dinas');
				$cmb1 = $cmb1->result();
				foreach($cmb1 as $va){ 
			?>
				<option value="<?=@$va->nm_ctd?>">
			<?php } ?>
			</datalist>
		</td>
	</tr>
	<?php } ?>
</table>
</form>
<hr style="border:#eeeeee;margin:5px;"/>
<div style="padding:10px;">
<button style="cursor:pointer" type="button" onclick="simpankesimpulansaran()" style="width:100%;">Simpan Kesimpulan</button>
<?php if($pangkasnoreg == "D"){ ?>

<!--<button style="cursor:pointer" type="button" onclick="cetakhasilpemeriksaan()" style="width:100%;">Cetak Resume</button>-->
<button style="cursor:pointer" type="button" onclick="cetakpilihan('cetakhasilkesimpulansaranframepdf', 'Cetak Resume Medis')" style="width:100%;">Cetak Resume</button>
<button style="cursor:pointer" type="button" onclick="cetakpilihandua('cetakhasilpemeriksaan', 'Cetak Hasil Pemeriksaan')" style="width:100%;">Cetak Hasil</button>
<!--<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaan('cetakresumekesimpulansaranframe')" style="width:100%;">Cetak Hasil </button>
<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaan('cetakresumekesimpulansaranframepdf')" style="width:100%;">Cetak Hasil (Mode 2)</button>
<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaan('cetakresumekesimpulansaranframepdfdinamis')" style="width:100%;">Cetak Hasil (Mode 3)</button>-->
<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaanbukutemplate()" style="width:100%;">Cetak Buku (Template)</button>
<?php } else { ?>
<!--<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaanbuku()" style="width:100%;">Cetak Buku</button>-->
<button style="cursor:pointer" type="button" onclick="cetakresumepemeriksaanbukutemplate()" style="width:100%;">Cetak Buku (Template)</button>
<?php } ?>
</div>
<div id="tampilkandetailcetakbuku" modal="true"  closed="true" maximizable="false" draggable="true" minimizable="false" collapsible="false" class="easyui-window" title="" style="width:600px;height:500px;padding:5px;background:#eeeeee;overflow:hidden">
</div>
<script type="text/javascript">
function simpankesimpulansaran(){
			$.messager.confirm('Konfirmasi', 'Anda yakin akan untuk melanjutkan', function(r) {
				if (r){
					$('#detailkesimpulansaran_form1').form('submit', {  
						success:function(data){  
							if(data == 'simpan'){
								$.messager.alert('Informasi', 'Data Berhasil Disimpan', 'info');
								$('#panel_detailevaluasi_kesimpulansaran').panel({
									href:'<?=@base_url($this->u1.'/daftardetailevaluasi')?>/<?=@$this->u3?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&no_reg=<?=@$_GET['no_reg']?>',
								});
							} else {
								$.messager.alert('Informasi', data, 'info');
							}
						}  
					}); 
				}
			});
		}
function cetakhasilpemeriksaan(){
	window.open('<?=@base_url($this->u1.'/cetakhasilkesimpulansaranframe')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>');
}
function cetakresumepemeriksaan(riu){
	window.open('<?=@base_url($this->u1)?>/'+riu+'/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>');
}
function cetakresumepemeriksaanbuku(){
	$('#tampilkandetailcetakbuku').window('open');
					$('#tampilkandetailcetakbuku').panel({
						title: 'Cetak Buku Non Dinas',
						href:'<?=@base_url($this->u1.'/tampilcetakbukunondinas')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>',
					});
	//window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>');
}

function cetakresumepemeriksaanbukutemplate(){
	$('#tampilkandetailcetakbuku').window('open');
					$('#tampilkandetailcetakbuku').panel({
						title: 'Cetak Buku Non Dinas (Mode Template)',
						href:'<?=@base_url($this->u1.'/cetakresumepemeriksaanbukutemplate')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>',
					});
}


function cetakpilihan(url, nm){
	$('#tampilkandetailcetakbuku').window('open');
	$('#tampilkandetailcetakbuku').panel({
		title: nm,
		href:'<?=@base_url($this->u1.'/cetakpilihan')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&uriku='+url,
	});
}

function cetakpilihandua(url, nm){
	$('#tampilkandetailcetakbuku').window('open');
	$('#tampilkandetailcetakbuku').panel({
		title: nm,
		href:'<?=@base_url($this->u1.'/cetakpilihandua')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&uriku='+url,
	});
}


$('#keterangan_sehat').combobox({
	filter: function(q, row){
		var opts = $(this).combobox('options');
		return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
	}
});
$('#ttdkatim').combobox({
	filter: function(q, row){
		var opts = $(this).combobox('options');
		return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
	}
});


<?php foreach( range(1,10) as $gi){ ?>
$('#namakesimpulan<?=@$gi?>').combobox({
	filter: function(q, row){
		var opts = $(this).combobox('options');
		return row[opts.textField].toLowerCase().indexOf(q.toLowerCase()) >= 0;
	}
});
<?php } ?>

</script>