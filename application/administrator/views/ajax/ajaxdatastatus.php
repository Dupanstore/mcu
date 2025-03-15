<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_status', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_status');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Status:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_status" id="id_status" value="<?=@$tsts[0]->id_status?>">
					<input type="hidden" name="kd_status_lama" value="<?=@$tsts[0]->kd_status?>">
					<input class="easyui-textbox" type="text" name="kd_status" data-options="required:true" value="<?=@$tsts[0]->kd_status?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_status" data-options="required:true" value="<?=@$tsts[0]->nm_status?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>