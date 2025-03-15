<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_kln', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_kelainan_gigi');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Pengaturan Kelainan Gigi:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_kln" id="id_kln" value="<?=@$tsts[0]->id_kln?>">
					<input type="hidden" name="kode_kelainan_lama" value="<?=@htmlentities($tsts[0]->kode_kelainan)?>">
					<input class="easyui-textbox" type="text" name="kode_kelainan" data-options="required:true" value="<?=@htmlentities($tsts[0]->kode_kelainan)?>" style="width:50%">
				</td>
			</tr>
			<tr>
				<td>Kelainan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="kelainan" data-options="required:true" value="<?=@$tsts[0]->kelainan?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>