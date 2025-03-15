<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_agama', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_agama');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data agama:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_agama" id="id_agama" value="<?=@$tsts[0]->id_agama?>">
					<input type="hidden" name="kd_agama_lama" value="<?=@$tsts[0]->kd_agama?>">
					<input class="easyui-textbox" type="text" name="kd_agama" data-options="required:true" value="<?=@$tsts[0]->kd_agama?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_agama" data-options="required:true" value="<?=@$tsts[0]->nm_agama?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>