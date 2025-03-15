<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_aero', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_aeroklinik');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Pemeriksaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Poliklinik:</td>
				<td>
					<select  class="easyui-combobox" name="poli" style="width:100%;" data-options="required:true" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->where("type_ins", "P");
						$this->db->or_where("type_ins", "J");
						$this->db->order_by("nm_ins", "ASC");
						$sggd = $this->db->get("tb_instalasi");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->id_poli == $va->id_ins){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va->id_ins?>" <?=@$sel?>><?=@$va->nm_ins?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Pemeriksaan:</td>
				<td>
					<input type="text" id="id_aero" value="<?=@$tsts[0]->id_aero?>" style="width:100%">
					<input class="easyui-textbox" type="text" name="nm_aero" data-options="required:true" value="<?=@$tsts[0]->nm_aero?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Keterangan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="alias_aero" value="<?=@$tsts[0]->alias_aero?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>