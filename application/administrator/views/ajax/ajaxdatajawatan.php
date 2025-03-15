<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_jawatan', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_jawatan');
		$tsts = $jjus->result();
		if($tsts[0]->default_jawatan == "Y"){
			$cek = 'checked="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data jawatan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Type:</td>
				<td>
					<select  class="easyui-combobox" name="tipe_jawatan" style="width:100%;" data-options="required:true" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(is_type_dinas() as $ke => $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->tipe_jawatan == $ke){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$ke?>" <?=@$sel?>><?=@$va?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_jawatan" id="id_jawatan" value="<?=@$tsts[0]->id_jawatan?>">
					<input type="hidden" name="kd_jawatan_lama" value="<?=@$tsts[0]->kd_jawatan?>">
					<input class="easyui-textbox" type="text" name="kd_jawatan" data-options="required:true" value="<?=@$tsts[0]->kd_jawatan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_jawatan" data-options="required:true" value="<?=@$tsts[0]->nm_jawatan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Telp:</td>
				<td>
					<input class="easyui-textbox" type="text" name="no_tlp_jawatan" value="<?=@$tsts[0]->no_tlp_jawatan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Alamat:</td>
				<td>
					<textarea name="alamat_jawatan" style="width:100%"><?=@$tsts[0]->alamat_jawatan?></textarea>
				</td>
			</tr>
			<tr>
				<td>Default:</td>
				<td>
					<input type="checkbox" <?=@$cek?> name="default_jawatan" value="ok">
				</td>
			</tr>
		</table>
</fieldset>