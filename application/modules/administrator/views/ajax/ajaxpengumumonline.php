<?php
	$jjus = $this->db->get('api_lain');
	$tsts = $jjus->result();
	foreach($tsts as $gbd){
		$gsvd[$gbd->pkeys] = $gbd->pvals;
	}
	
?>
<fieldset style="border:#cccccc 1px dotted;margin-top:10px;background:#ffffff">
	<legend>Pengaturan Lakespra Online:</legend>
		<table style="width:100%" cellpadding="2px;">
			<tr>
				<th style="width:33.33%">Petunjuk Penggunaan</th>
				<th  style="width:33.33%">FAQ</th>
				<th  style="width:33.33%">Syarat dan Ketentuan</th>
			</tr>
			<tr>
				<td>
					Format nomor_urut#isi_petunjuk (pemisah menggunakan *)<br />
					<textarea style="width:98%;height:300px;" name="petunjuk_penggunaan"><?=@$gsvd['petunjuk_penggunaan']?></textarea>
				</td>
				<td>
				Format nomor_urut#pertanyaan#jawaban (pemisah menggunakan *)<br />
				<textarea style="width:98%;height:300px" name="faq"><?=@$gsvd['faq']?></textarea></td>
				<td>
				<br />
				<textarea style="width:98%;height:300px" name="syarat_ketentuan"><?=@$gsvd['syarat_ketentuan']?></textarea></td>
			</tr>
		</table>
</fieldset>