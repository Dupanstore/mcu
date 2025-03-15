<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_wilayah', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_wilayah');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data wilayah:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_wilayah" id="id_wilayah" value="<?=@$tsts[0]->id_wilayah?>">
					<input type="hidden" name="kd_wilayah_lama" value="<?=@$tsts[0]->kd_wilayah?>">
					<input class="easyui-textbox" type="text" name="kd_wilayah" data-options="required:true" value="<?=@$tsts[0]->kd_wilayah?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_wilayah" data-options="required:true" value="<?=@$tsts[0]->nm_wilayah?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>