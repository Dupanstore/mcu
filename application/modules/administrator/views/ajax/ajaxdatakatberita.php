<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('api_subkatberita');
		$tsts = $jjus->row();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Kategori Layanan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_kat" id="id_kat" value="<?=@$tsts->id?>">
					<input class="easyui-textbox" type="text" name="nama_kat" data-options="required:true" value="<?=@$tsts->name?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>