<?php
	if($this->uri->segment(3)){
		$this->db->where('id_user', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_user');
		$tsts = $jjus->result();
	}
?>
<form method="POST" id="formgantipassword" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/gantipassword')?>">
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Password Baru:</td>
				<td>
					<input type="hidden" name="id_user" value="<?=@$tsts[0]->id_user?>" style="width:100%">
					<input type="hidden" name="password" value="<?=@$tsts[0]->password?>" style="width:100%">
					<input class="easyui-textbox" type="passwordbaru" name="passwordbaru" value="" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Konfirmasi:</td>
				<td>
					<input class="easyui-textbox" type="konfirmasi" name="konfirmasi" value="" style="width:100%">
				</td>
			</tr>
		</table>
</form>