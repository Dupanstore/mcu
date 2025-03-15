<?php
	$cek 	= '';
	$cekchm = '';
	//echo $this->uri->segment(3) .' / '. $this->uri->segment(4);
	if($this->uri->segment(4)){
		$this->db->where('id_pem', clean_data($this->uri->segment(4)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_pemeriksaan');
		$tsts = $jjus->result();
		if($tsts[0]->det_nilai_normal == "Y"){
			$cek = 'checked="true"';
		}
		if($tsts[0]->header_chamber == "Y"){
			$cekchm = 'checked="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Detail Pemeriksaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td width="25%">Nilai Normal:</td>
				<td>
					<input type="checkbox" <?=@$cek?> name="det_nilai_normal" id="det_nilai_normal" value="ok" onclick="checksemuanyaya()"> <i style="color:red;font-size:9px;">Centang jika ada nilai normal</i>
				</td>
			</tr>
			<?php if($this->uri->segment(3) == "4"){ ?>
			<tr>
				<td>Set Header:</td>
				<td>
					<input type="checkbox" <?=@$cekchm?> name="header_chamber" id="header_chamber" value="ok"> <i style="color:red;font-size:9px;">Centang jika menjadi header</i>
				</td>
			</tr>
			<tr>
				<td>Parent:</td>
				<td>
					<select  name="parent_chamber" id="parent_chamber" style="width:100%;" >
						<option value="0">-</option>
						<?php
							//ambil kodenya yaaa
							$this->db->select('id_pem, det_nm_pemeriksaan');
							$this->db->where('header_chamber', 'Y');
							//$this->db->limit('1');
							$nhfg = $this->db->get('tb_pemeriksaan');
							$bgts = $nhfg->result();
						?>
						<?php foreach($bgts as $rs){ 
							if($tsts){
								$sel = "";
								if($tsts[0]->parent_chamber == $rs->id_pem){
									$sel = 'selected="true"';
								}
							}
						?>
							<option value="<?=@$rs->id_pem?>" <?=@$sel?>><?=@$rs->det_nm_pemeriksaan?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Pemeriksaan:</td>
				<td>
					<input type="hidden" name="id_ins_periksa" value="<?=@$this->uri->segment(3)?>" style="width:100%">
					<input type="hidden" id="id_pem" name="id_pem" value="<?=@$tsts[0]->id_pem?>" style="width:100%">
					<input type="hidden" name="det_nm_pemeriksaan_lama" value="<?=@$tsts[0]->det_nm_pemeriksaan?>" style="width:100%">
					<input class="easyui-textbox" data-options="required:true" type="text" name="det_nm_pemeriksaan" value="<?=@$tsts[0]->det_nm_pemeriksaan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Name (En):</td>
				<td>
					<input class="easyui-textbox" type="text" name="in_english_pem" value="<?=@$tsts[0]->in_english_pem?>" style="width:100%">
				</td>
			</tr>
			<tr id="ajax_type">
				<td>Type:</td>
				<td>
					<select  name="det_type_pemeriksaan" id="det_type_pemeriksaan" style="width:100%;" onchange="checksemuanyaya()">
					<option value="">Silahkan Pilih</option>
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(is_type_detailperiksa() as $va => $rs){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->det_type_pemeriksaan == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><?=@$rs?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr id="ajax_jenis">
				<td>Jenis:</td>
				<td>
					<select  name="det_jenis_pemeriksaan" id="det_jenis_pemeriksaan" style="width:100%;" >
					<option value="">Silahkan Pilih</option>
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(is_jenis_detailperiksa() as $va => $rs){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->det_jenis_pemeriksaan == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><?=@$rs?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr id="ajax_pilihan">
				<td>Pilihan:</td>
				<td>
					<i style="color:red;font-size:9px;">Gunakan * untuk pemisah antar pilihan, pilihan pertama adalah Nilai Normal, jika lebih dari 5 pilihan disarankan menggunakan Combobox</i>
					<textarea name="det_pilihan_pemeriksaan" id="det_pilihan_pemeriksaan" style="width:100%"><?=@$tsts[0]->det_pilihan_pemeriksaan?></textarea>
					<i style="color:red;font-size:9px;">Jika anda sudah mengisi saran, mohon untuk tidak merubah posisi pilihan, perubahan posisi mengakibatkan saran menjadi bergeser.</i>
				</td>
			</tr>
			<tr id="ajax_range">
				<td>Range:</td>
				<td>
					<input type="text" name="det_range_pemeriksaan_awal" value="<?=@$tsts[0]->det_range_pemeriksaan_awal?>" style="width:30%"> sampai <input type="text" name="det_range_pemeriksaan_akhir" value="<?=@$tsts[0]->det_range_pemeriksaan_akhir?>" style="width:30%">
				</td>
			</tr>
			<tr id="ajax_saran">
				<td>Saran:</td>
				<td>
					<textarea name="saran_pemeriksaan" id="saran_pemeriksaan" style="width:100%"><?=@$tsts[0]->saran_pemeriksaan?></textarea>
					<i style="color:red;font-size:9px;">untuk nilai normal dan kelainan yang tidak ada sarannya gunakan kata (kosong) dan pemisah menggunakan *, posisi menyesuaikan pilihan, untuk type tetap cukup 1 saran.</i>
				</td>
			</tr>
			<tr id="ajax_satuan">
				<td>Satuan:</td>
				<td>
					<input type="text" name="det_satuan_pemeriksaan" value="<?=@$tsts[0]->det_satuan_pemeriksaan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Order:</td>
				<td>
					<select name="det_order_pemeriksaan" style="width:20%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->det_order_pemeriksaan == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><b><?=@$va?></b></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>
<script type="text/javascript">
	function checksemuanyaya(){
		$('#ajax_satuan').hide();
		var tipenya = $('#det_type_pemeriksaan').val();
		var remember = document.getElementById('det_nilai_normal');
		  if (remember.checked){
			$('#ajax_type').show();
			if(tipenya == "tetap"){
				$('#ajax_jenis').show();
				$('#ajax_pilihan').show();
				$('#ajax_saran').show();
				$('#ajax_range').hide();
				$('#ajax_satuan').hide();
			} else if (tipenya == "range"){
				$('#ajax_range').show();
				$('#ajax_satuan').show();
				$('#ajax_saran').show();
				$('#ajax_jenis').hide();
				$('#ajax_pilihan').hide();
			} else {
				$('#ajax_jenis').hide();
				$('#ajax_pilihan').hide();
				$('#ajax_range').hide();
				$('#ajax_satuan').hide();
				$('#ajax_saran').hide();
			}
		  }else{
			$('#ajax_type').hide();
			$('#ajax_jenis').hide();
			$('#ajax_pilihan').hide();
			$('#ajax_range').hide();
			$('#ajax_saran').hide();
			$('#ajax_satuan').show();
		  }
		}
		checksemuanyaya();
</script>