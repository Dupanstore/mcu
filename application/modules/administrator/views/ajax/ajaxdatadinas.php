<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_dinas', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_dinas');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data dinas:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_dinas" id="id_dinas" value="<?=@$tsts[0]->id_dinas?>">
					<input type="hidden" name="nm_dinas_lama" value="<?=@$tsts[0]->nm_dinas?>">
					<input class="easyui-textbox" type="text" name="nm_dinas" data-options="required:true" value="<?=@$tsts[0]->nm_dinas?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Type:</td>
				<td>
					<select  class="easyui-combobox" name="tipe_dinas" style="width:100%;" data-options="required:true" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(is_type_dinas() as $ke => $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->tipe_dinas == $ke){
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
				<td>Jenis:</td>
				<td>
					<select  class="easyui-combobox" name="ila_medex" style="width:100%;"  >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(is_ilamedex() as $ke => $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->ila_medex == $ke){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>