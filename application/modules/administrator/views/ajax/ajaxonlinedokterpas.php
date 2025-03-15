<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_pas', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_pasien');
		$tsts = $jjus->row();
		
	}
?>	

        <style>
            .kbw-signature{
                height: 250px;
                width: 250px;
				display: inline-block;
				border: 1px solid #a0a0a0;
            }
        </style>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Dokter:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>NIK/NIP/NRP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nip_nrp_nik" value="<?=@$tsts->nip_nrp_nik?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input type="hidden" name="id_pas" id="id_pas" value="<?=@$tsts->id_pas?>">
					<input class="easyui-textbox" type="text" name="nm_pas" data-options="required:true" value="<?=@$tsts->nm_pas?>" style="width:100%">
				</td>
			</tr>
			
			<tr>
				<td>No.HP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="no_tlp_pas" value="<?=@$tsts->no_tlp_pas?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Pangkat:</td>
				<td>
					<input class="easyui-textbox" type="text" name="pangkat_pas" value="<?=@$tsts->pangkat_pas?>" style="width:100%">
				</td>
			</tr>
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
							if($tsts->id_poli_dok == $va->id_ins){
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
				<td>Spesialis:</td>
				<td>
					<select  class="easyui-combobox" name="spesialis" style="width:100%;" data-options="required:true" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->order_by("name", "ASC");
						$sggd = $this->db->get("api_spesialis");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
						if($tsts){
							$sel = "";
							if($tsts->id_spesialis_dok == $va->id){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va->id?>" <?=@$sel?>><?=@$va->name?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>

