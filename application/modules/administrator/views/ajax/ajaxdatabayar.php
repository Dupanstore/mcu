<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_bayar', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_bayar');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Bayar:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_bayar" id="id_bayar" value="<?=@$tsts[0]->id_bayar?>">
					<input type="hidden" name="kd_bayar_lama" value="<?=@$tsts[0]->kd_bayar?>">
					<input class="easyui-textbox" type="text" name="kd_bayar" data-options="required:true" value="<?=@$tsts[0]->kd_bayar?>" style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_bayar" data-options="required:true" value="<?=@$tsts[0]->nm_bayar?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>