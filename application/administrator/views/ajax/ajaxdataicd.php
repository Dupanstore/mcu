<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_icd', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_icd');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data ICD:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_icd" id="id_icd" value="<?=@$tsts[0]->id_icd?>">
					<input type="hidden" name="kd_icd_lama" value="<?=@$tsts[0]->kd_icd?>">
					<input class="easyui-textbox" type="text" name="kd_icd" data-options="required:true" value="<?=@$tsts[0]->kd_icd?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_icd" data-options="required:true" value="<?=@$tsts[0]->nm_icd?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Alias:</td>
				<td>
					<input class="easyui-textbox" type="text" name="alias_icd" value="<?=@$tsts[0]->alias_icd?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>