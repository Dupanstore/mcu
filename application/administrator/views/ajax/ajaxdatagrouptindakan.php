<?php
	$cek = '';
	//echo $this->uri->segment(3) .' / '. $this->uri->segment(4);
	if($this->uri->segment(4)){
		$this->db->where('id_grouptindakan', clean_data($this->uri->segment(4)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_grouptind');
		$tsts = $jjus->result();
		if($tsts[0]->tampil_pemeriksaan == "Y"){
			$cek = 'checked="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Group Pemeriksaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_ins_ajax" id="id_ins_ajax" value="<?=@$this->uri->segment(3)?>">
					<input type="hidden" name="id_grouptindakan" id="id_grouptindakan" value="<?=@$tsts[0]->id_grouptindakan?>">
					<input type="hidden" name="kd_grouptindakan_lama" value="<?=@$tsts[0]->kd_grouptindakan?>">
					<input class="easyui-textbox" type="text" name="kd_grouptindakan" data-options="required:true" value="<?=@$tsts[0]->kd_grouptindakan?>" style="width:40%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_grouptindakan" data-options="required:true" value="<?=@$tsts[0]->nm_grouptindakan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Name (En):</td>
				<td>
					<input class="easyui-textbox" type="text" name="en_english_group" value="<?=@$tsts[0]->en_english_group?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Order:</td>
				<td>
					<select  class="easyui-combobox" name="orderdata" style="width:20%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->orderdata == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><?=@$va?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Order Evaluasi:</td>
				<td>
					<select  class="easyui-combobox" name="order_evalusi_group" style="width:20%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->order_evalusi_group == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><?=@$va?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>