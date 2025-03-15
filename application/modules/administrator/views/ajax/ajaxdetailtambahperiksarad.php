<?php
	$cek = '';
	//echo $this->uri->segment(3) .' / '. $this->uri->segment(4);
	//ambil kode groupnya yaaa
	$this->db->where('id_grouptindakan', $this->uri->segment(3));
	$this->db->limit('1');
	$grp = $this->db->get('tb_grouptind');
	$grptnd = $grp->result();
	if($this->uri->segment(4)){
		$this->db->where('id_pem', clean_data($this->uri->segment(4)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_pemeriksaan');
		$tsts = $jjus->result();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Detail Pemeriksaan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td width="10%">Pemeriksaan:</td>
				<td>
					<input type="hidden" name="id_pem" id="id_pem" value="<?=@$tsts[0]->id_pem?>">
					<input type="hidden" name="id_grouprad" value="<?=@$grptnd[0]->kd_grouptindakan?>">
					<input type="hidden" name="rad_namapemeriksaan_lama" value="<?=@$tsts[0]->rad_namapemeriksaan?>">
					<input class="easyui-textbox" type="text" name="rad_namapemeriksaan" data-options="required:true" value="<?=@$tsts[0]->rad_namapemeriksaan?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Pemeriksaan (En):</td>
				<td>
					<input class="easyui-textbox" type="text" name="in_english_pem" value="<?=@$tsts[0]->in_english_pem?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Nilai Normal:</td>
				<td>
					<textarea name="rad_nilainormal" style="width:100%"><?=@$tsts[0]->rad_nilainormal?></textarea>
				</td>
			</tr>
			<tr>
				<td>Order:</td>
				<td>
					<select name="det_order_pemeriksaan" style="width:20%;" >
					<?php
						//ambil kodenya yaaa
					?>
					<?php foreach(range(0, 100) as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->det_order_pemeriksaan == $va){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va?>" <?=@$sel?>><b><?=@$va?></b></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>