<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_kondisi', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_kondisi');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Kondisi:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_kondisi" id="id_kondisi" value="<?=@$tsts[0]->id_kondisi?>">
					<input type="hidden" name="kd_kondisi_lama" value="<?=@$tsts[0]->kd_kondisi?>">
					<input class="easyui-textbox" type="text" name="kd_kondisi" data-options="required:true" value="<?=@$tsts[0]->kd_kondisi?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_kondisi" data-options="required:true" value="<?=@$tsts[0]->nm_kondisi?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>