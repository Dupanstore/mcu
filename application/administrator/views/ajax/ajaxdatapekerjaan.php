<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_pekerjaan', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_pekerjaan');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Pekerjaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_pekerjaan" id="id_pekerjaan" value="<?=@$tsts[0]->id_pekerjaan?>">
					<input type="hidden" name="kd_pekerjaan_lama" value="<?=@$tsts[0]->kd_pekerjaan?>">
					<input class="easyui-textbox" type="text" name="kd_pekerjaan" data-options="required:true" value="<?=@$tsts[0]->kd_pekerjaan?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_pekerjaan" data-options="required:true" value="<?=@$tsts[0]->nm_pekerjaan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>List Pangkat:</td>
				<td>
					<textarea name="list_pangkat" style="width:100%"><?=@$tsts[0]->list_pangkat?></textarea>
				</td>
			</tr>
		</table>
</fieldset>