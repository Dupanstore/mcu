<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_user', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_user');
		$tsts = $jjus->result();
		if($tsts[0]->default_user == "Y"){
			$cek = 'readonly="true"';
		}
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data User:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Level:</td>
				<td>
					<select  class="easyui-combobox" name="level" style="width:100%;" data-options="required:true" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->order_by("nm_ins", "ASC");
						$sggd = $this->db->get("tb_instalasi");
						$ins = $sggd->result();
					?>
					<?php foreach($ins as $va){ 
						if($tsts){
							$sel = "";
							if($tsts[0]->level == $va->id_ins){
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
				<td>Username:</td>
				<td>
					<input type="hidden" name="id_user" id="id_user" value="<?=@$tsts[0]->id_user?>">
					<input type="hidden" name="username_lama" value="<?=@$tsts[0]->username?>">
					<input class="easyui-textbox" type="text" name="username" data-options="required:true" value="<?=@$tsts[0]->username?>" style="width:100%" <?=@$cek?>>
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nmlengkap" data-options="required:true" value="<?=@$tsts[0]->nmlengkap?>" style="width:100%">
				</td>
			</tr>
			<?php if(!$this->uri->segment(3)){ ?>
			<tr>
				<td>Password:</td>
				<td>
					<input class="easyui-textbox" type="password" name="password" value="" style="width:100%">
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Email:</td>
				<td>
					<input class="easyui-textbox" type="text" name="email" value="<?=@$tsts[0]->email?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>No HP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="no_hp" value="<?=@$tsts[0]->no_hp?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>NIK/NIP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nip_nik" value="<?=@$tsts[0]->nip_nik?>" style="width:100%">
				</td>
			</tr>
		</table>
</fieldset>