<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_paket', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_paket');
		$tsts = $jjus->result();
	}
?>
<form method="POST" id="formtambahpaketmcusatu" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpanupdatepaketmcusatu')?>">
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Paket:</td>
				<td>
					<input type="hidden" name="id_paket" id="id_paket" value="<?=@$tsts[0]->id_paket?>">
					<input type="hidden" name="nm_paket_lama" value="<?=@$tsts[0]->nm_paket?>">
					<input class="easyui-textbox" type="text" name="nm_paket" data-options="required:true" value="<?=@$tsts[0]->nm_paket?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Harga:</td>
				<td>
					<input class="easyui-textbox" type="text" name="harga_paket" data-options="required:true" value="<?=@$tsts[0]->harga_paket?>" style="width:50%">
				</td>
			</tr>
		</table>
</form>