<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('idc', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_reff_konsul');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Paket Konsul:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="idc" id="idc" value="<?=@$tsts[0]->idc?>" style="width:100%">
					<input class="easyui-textbox" type="text" name="nama_pkt" data-options="required:true" value="<?=@$tsts[0]->nama_pkt?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Detail:</td>
				<td>
					<textarea name="isi_pkt" style="width:100%;height:200px;"><?=@$tsts[0]->isi_pkt?></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><small><i>Pemisah menggunakan koma spasi (, )</i></small></td>
			</tr>
		</table>
</fieldset>