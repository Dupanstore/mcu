<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_stakes', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_stakes');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data stakes:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_stakes" id="id_stakes" value="<?=@$tsts[0]->id_stakes?>">
					<input type="hidden" name="nm_stakes_lama" value="<?=@$tsts[0]->nm_stakes?>">
					<input class="easyui-textbox" type="text" name="nm_stakes" data-options="required:true" value="<?=@$tsts[0]->nm_stakes?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>