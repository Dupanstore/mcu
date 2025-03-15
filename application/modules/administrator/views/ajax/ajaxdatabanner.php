<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('api_banner');
		$tsts = $jjus->row();
		//print_r($tsts);
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Banner:</legend>
		<table style="width:100%" cellpadding="2px;">
			<?php if($this->uri->segment(3)){ ?>
			<tr>
				<td colspan="2">
					<div align="center"><?=@'<img src="'.is_iplocalserverandroid().'/'.$tsts->bimg.'" style="width:200px;">'?></div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Upload:</td>
				
				<td>
					<input type="hidden" name="id_banner" id="id_banner" value="<?=@$tsts->id?>">
					<input type="hidden" name="id_user" id="id_user" value="<?=@$this->session->userdata('id_user')?>">
					<input type="hidden" name="password" id="password" value="<?=@$this->session->userdata('password')?>">
					<div class="form-group">
					<label for="message-text" class="form-control-label">File <small><b><i> (Format jpg, png, pdf, doc, docx max 2mb)</i></b></small>:</label>
					<input class="form-control" type="file" name="userfile[]">
					</div>
				</td>
			</tr>
			<tr>
				<td>Posisi:</td>
				<td>
					<select  class="easyui-combobox" name="poli" style="width:100%;" data-options="required:true" >
					<option value="0">Homepage</option>
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
							if($tsts->cid == $va->id_ins){
								$sel = 'selected="true"';
							}
						}
					?>
						<option value="<?=@$va->id_ins?>" <?=@$sel?>><?=@$va->nm_ins?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			
		</table>
</fieldset>