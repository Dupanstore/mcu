<?php
	$cek = '';
	//echo $this->uri->segment(3) .' / '. $this->uri->segment(4);
	 //ambil data dari instalasinya
	 $this->db->where("id_ins", $this->uri->segment(3));
	 $this->db->limit(1);
	 $ins = $this->db->get("tb_instalasi");
	 $jus = $ins->result();
	 $vbv = 'checked="true"';
	 $vbk = '';
	 $vbg = '';
	 $vuu = "";
	 $fks = "";
	if($this->uri->segment(4)){
		$this->db->where('id_tind', clean_data($this->uri->segment(4)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_tindakan');
		$tsts = $jjus->result();
		if($tsts[0]->tampil_di_pemeriksaan == "N"){
			 $vbv = '';
		}
		if($tsts[0]->set_pemeriksaan_fisik == "Y"){
			 $vbk = 'checked="true"';
		}
		if($tsts[0]->set_struktur_gigi == "Y"){
			 $vbg = 'checked="true"';
		}
		if($tsts[0]->ket_cetak_pemeriksaan_pasien == "Y"){
			 $vuu = 'checked="true"';
		}
		if($tsts[0]->jangan_tampil_stakes == "Y"){
			 $fks = 'checked="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Pemeriksaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			
			<tr>
				<td width="30%">Kode:</td>
				<td>
					<input type="hidden" name="id_ins_ajax" id="id_ins_ajax" value="<?=@$this->uri->segment(3)?>">
					<input type="hidden" name="id_tind" id="id_tind" value="<?=@$tsts[0]->id_tind?>">
					<input type="hidden" name="kd_tind_lama" value="<?=@$tsts[0]->kd_tind?>">
					<input class="easyui-textbox" type="text" name="kd_tind" data-options="required:true" value="<?=@$tsts[0]->kd_tind?>" style="width:40%">
				</td>
			</tr>
			<?php if($jus[0]->type_ins != "P" AND $jus[0]->type_ins != "L"){ ?>
			<tr>
				<td>Group:</td>
				<td>
					<select  class="easyui-combobox" name="kd_grouptind" style="width:100%;">
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->where("id_ins", $this->uri->segment(3));
						$this->db->order_by("nm_grouptindakan", "ASC");
						$sggd = $this->db->get("tb_grouptind");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->kd_grouptind  == $va->kd_grouptindakan){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va->kd_grouptindakan?>" <?=@$sel?>><?=@$va->nm_grouptindakan?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_tind" data-options="required:true" value="<?=@$tsts[0]->nm_tind?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Jasa Dokter:</td>
				<td>
					<input class="easyui-textbox" type="text" name="js_dok_tind" value="<?=@$tsts[0]->js_dok_tind?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Harga Pemeriksaan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="js_rs_tind" value="<?=@$tsts[0]->js_rs_tind?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Lantai:</td>
				<td>
					<input class="easyui-textbox" type="text" name="lantai_tind" value="<?=@$tsts[0]->lantai_tind?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Keterangan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="keterangan_tind" value="<?=@$tsts[0]->keterangan_tind?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Stakes:</td>
				<td>
					<select name="stakes_tindakan" id="stakes_tindakan"  style="width:25%">
						<option value="">-</option>
						<?php 
							foreach(is_stakes() as $ke => $va){ 
								$sel = "";
								if($tsts){
									if($tsts[0]->stakes_tindakan == $ke){
										$sel = 'selected="true"';
									}
								}
						?>
							<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Order:</td>
				<td>
					<small>Ini mengatur posisi ketika mengisi pemeriksaan (selain Lab dan Radiologi)</small><br />
					<select name="order_tindakan" style="width:20%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->order_tindakan == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><b><?=@$va?></b></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<small>Tampilkan ketika Cetak Pemeriksaan Pasien</small><br />
					<input type="checkbox" name="ket_cetak_pemeriksaan_pasien" value="hj" <?=@$vuu?>> Ya
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<small>Tampilkan ketika Pemeriksaan Pasien</small><br />
					<input type="checkbox" name="tampil_di_pemeriksaan" value="hj" <?=@$vbv?>> Ya
				</td>
			</tr>
			<?php if($this->uri->segment(3) != '2' AND $this->uri->segment(3) != '3'){ ?>
			<tr>
				<td></td>
				<td>
					<small>Set Pemeriksaan Fisik (Jika dicentang maka pemeriksaan akan ditambahkan riwayat dan keluhan)</small><br />
					<input type="checkbox" name="set_pemeriksaan_fisik" value="hj" <?=@$vbk?>> Ya
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<small>Set Struktur Gigi (Jika dicentang maka pemeriksaan akan ditambahkan struktur gigi)</small><br />
					<input type="checkbox" name="set_struktur_gigi" value="hj" <?=@$vbg?>> Ya
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td>
					<small><b>Jangan Tampilkan Stakes</b> pada input pemeriksaan</small><br />
					<input type="checkbox" name="jangan_tampil_stakes" value="hj" <?=@$fks?>> Ya
				</td>
			</tr>
		</table>
</fieldset>