<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_pendidikan', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_pendidikan');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data pendidikan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_pendidikan" id="id_pendidikan" value="<?=@$tsts[0]->id_pendidikan?>">
					<input type="hidden" name="kd_pendidikan_lama" value="<?=@$tsts[0]->kd_pendidikan?>">
					<input class="easyui-textbox" type="text" name="kd_pendidikan" data-options="required:true" value="<?=@$tsts[0]->kd_pendidikan?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_pendidikan" data-options="required:true" value="<?=@$tsts[0]->nm_pendidikan?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>