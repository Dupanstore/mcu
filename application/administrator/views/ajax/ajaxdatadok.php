<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_dok', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_dokter');
		$tsts = $jjus->result();
		if($tsts[0]->default_dok == "Y"){
			$cek = 'checked="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Dokter:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_dok" id="id_dok" value="<?=@$tsts[0]->id_dok?>">
					<input type="hidden" name="kd_dok_lama" value="<?=@$tsts[0]->kd_dok?>">
					<input class="easyui-textbox" type="text" name="kd_dok" data-options="required:true" value="<?=@$tsts[0]->kd_dok?>" style="width:40%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_dok" data-options="required:true" value="<?=@$tsts[0]->nm_dok?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>NIK/NIP/NRP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nip_nrp" value="<?=@$tsts[0]->nip_nrp?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Pangkat:</td>
				<td>
					<input class="easyui-textbox" type="text" name="pangkat" value="<?=@$tsts[0]->pangkat?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Golongan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="golongan" value="<?=@$tsts[0]->golongan?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>