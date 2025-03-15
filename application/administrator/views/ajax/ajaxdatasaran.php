<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_saran', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_saran');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data saran:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_saran" id="id_saran" value="<?=@$tsts[0]->id_saran?>">
					<input type="hidden" name="nm_saran_lama" value="<?=@$tsts[0]->nm_saran?>">
					<input class="easyui-textbox" type="text" name="nm_saran" data-options="required:true" value="<?=@$tsts[0]->nm_saran?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>