<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_paket', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_paket');
		$tsts = $jjus->row();
		//print_r($tsts);
	}else{
		die("Pilih Paket Terlebih Dahulu..");
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Upload Gambar Paket:</legend>
		<table style="width:100%" cellpadding="2px;">
			<?php if($this->uri->segment(3)){ ?>
			<tr>
				<tr>
				<td colspan="2">
					<div align="center"><?=@'<img src="'.is_iplocalserverandroid().'/'.$tsts->img_paket.'" style="width:200px;">'?></div>
				</td>
			</tr>
			<?php } ?>
				<td>Upload:</td>
				<td>
					<input type="hidden" name="id_paket" id="id_paket" value="<?=@$tsts->id_paket?>">
					<input type="hidden" name="id_user" id="id_user" value="<?=@$this->session->userdata('id_user')?>">
					<input type="hidden" name="password" id="password" value="<?=@$this->session->userdata('password')?>">
					<div class="form-group">
					<label for="message-text" class="form-control-label">File <small><b><i> (Format jpg, png, pdf, doc, docx max 2mb)</i></b></small>:</label>
					<input class="form-control" type="file" name="userfile[]">
				</div>
				</td>
			</tr>
		</table>
</fieldset>