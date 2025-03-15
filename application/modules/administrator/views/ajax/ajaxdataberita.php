<?php
	$cek = 'checked="true"';
	$sname = "";
	if($this->uri->segment(3)){
		$this->db->where('id', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('api_berita');
		$tsts = $jjus->row();
		$sname = $tsts->sname;
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Informasi:</legend>
		<table style="width:99%" cellpadding="2px;">
			<tr>
				<td>Kategori:</td>
				<td>
					<select  class="easyui-combobox" name="sid" style="width:100%;" >
					<option value="">Silahkan pilih...</option>
					<?php
						//ambil kodenya yaaa
						$this->db->order_by("id", "ASC");
						$sggd = $this->db->get("api_subkatberita");
						$ins = $sggd->result();
					?>
					<?php 
					foreach($ins as $va){ 
						$sel = "";
						if($tsts->sid == $va->id){
							$sel = 'selected="true"';
						}
					?>
						<option value="<?=@$va->id?>" <?=@$sel?>><?=@$va->name?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tanggal:</td>
				<td>
					<input class="easyui-datebox" type="text" name="sname" id="sname" style="width:100%;" value="<?=@$sname?>">
				</td>
			</tr>
			<tr>
				<td>Judul:</td>
				<td>
					<input class="easyui-textbox" type="text" name="pname" value="<?=@$tsts->pname?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea placeholder="Masukkan isi informasi" name="psdesc" value="" style="width:98%;height:400px"><?=@$tsts->psdesc?></textarea>
				</td>
			</tr>
			<?php if($this->uri->segment(3)){ ?>
			<tr>
				<td colspan="2">
					<div align="center"><?=@'<img src="'.is_iplocalserverandroid().'/'.$tsts->pimg.'" style="width:200px;">'?></div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>Upload:</td>
				<td>
					<input type="hidden" name="id_berita" id="id_berita" value="<?=@$tsts->id?>">
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