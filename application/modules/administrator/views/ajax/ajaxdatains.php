<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_ins', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_instalasi');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Poliklinik:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_ins" id="id_ins" value="<?=@$tsts[0]->id_ins?>">
					<input type="hidden" name="kd_ins_lama" value="<?=@$tsts[0]->kd_ins?>">
					<input class="easyui-textbox" type="text" name="kd_ins" data-options="required:true" value="<?=@$tsts[0]->kd_ins?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_ins" data-options="required:true" value="<?=@$tsts[0]->nm_ins?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Name (En):</td>
				<td>
					<input class="easyui-textbox" type="text" name="in_english_ins" value="<?=@$tsts[0]->in_english_ins?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Type:</td>
				<td>
					<select name="type_ins" id="type_ins"  style="width:100%">
						<?php 
							foreach(is_typeruang() as $ke => $va){ 
								$sel = "";
								if($tsts){
									if($tsts[0]->type_ins == $ke){
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
				<td>Lantai:</td>
				<td>
					<input class="easyui-textbox" type="text" name="lantai" value="<?=@$tsts[0]->lantai?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Order:</td>
				<td>
					<select name="order_ins" style="width:25%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->order_ins == $va){
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
				<td>Stakes:</td>
				<td>
					<select name="set_stakes" id="set_stakes"  style="width:25%">
						<option value="" <?=@$sel?>>-</option>
						<?php 
							foreach(is_stakes() as $ke => $va){ 
								$sel = "";
								if($tsts){
									if($tsts[0]->set_stakes == $ke){
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
				<td>Order Evaluasi:</td>
				<td>
					<select name="order_evaluasi" style="width:25%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->order_evaluasi == $va){
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
				<td>Order Form:</td>
				<td>
					<select name="order_baru" style="width:25%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->order_baru == $va){
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
				<td colspan="2"><small><i>Order Form digunakan untuk order cetak di form pendaftaran (TANDA TELAH MELAKSANAKAN PEMERIKSAAN)</i></small></td>
			</tr>
		</table>
</fieldset>