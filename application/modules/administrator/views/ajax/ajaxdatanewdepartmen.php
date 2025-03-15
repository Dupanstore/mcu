<?php
	$cek = '';
	//echo $this->uri->segment(3) .' / '. $this->uri->segment(4);
	if($this->uri->segment(4)){
		$this->db->where('id_dept', clean_data($this->uri->segment(4)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_departmen');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Bagian:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_jawatan" id="id_jawatan" value="<?=@$this->uri->segment(3)?>">
					<input type="hidden" name="id_dept" id="id_dept" value="<?=@$tsts[0]->id_dept?>">
					<input class="easyui-textbox" type="text" name="nm_dept" data-options="required:true" value="<?=@$tsts[0]->nm_dept?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>