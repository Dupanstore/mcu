<?php
	$cek = 'checked="true"';
	if($this->uri->segment(3)){
		$this->db->where('id_ctd', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_catatan_dinas');
		$tsts = $jjus->row();
	}
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Master Data Catatan:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<td>Catatan:</td>
				<td>
					<input type="hidden" name="id_ctd" id="id_ctd" value="<?=@$tsts->id_ctd?>">
					<input type="hidden" name="nm_ctd_lama" value="<?=@$tsts->nm_ctd?>">
					<textarea name="nm_ctd"  style="width:100%;height:150px;"><?=@$tsts->nm_ctd?></textarea>
				</td>
			</tr>
			<tr>
				<td>Jenis:</td>
				<td>
					<select name="jenis_catatan" style="width:100%">
						<option value="">Silahkan Pilih</option>
						<?php 
							foreach(is_getTipeJawatan() as $keys => $vals){ 
								$sell = "";
								if($keys == $tsts->jenis_catatan){
									$sell = 'selected="true"';
								}
						?>
							<option <?=@$sell?> value="<?=@$keys?>"><?=@$vals?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		</table>
</fieldset>