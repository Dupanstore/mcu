<?php
	$cek = '';
	if($this->uri->segment(3)){
		$this->db->where('id_dok', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_dokter');
		$tsts = $jjus->result();
		if($tsts[0]->default_dok == "Y"){
			$cek = 'checked="true"';
		}
		
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
				<td>Kode:</td>
				<td>
					<input type="hidden" name="id_dok" id="id_dok" value="<?=@$tsts[0]->id_dok?>">
					<input type="hidden" name="kd_dok_lama" value="<?=@$tsts[0]->kd_dok?>">
					<input class="easyui-textbox" type="text" name="kd_dok" data-options="required:true" value="<?=@$tsts[0]->kd_dok?>" style="width:40%">
				</td>
			</tr>
			<tr>
				<td>Nama:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nm_dok" data-options="required:true" value="<?=@$tsts[0]->nm_dok?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>NIK/NIP/NRP:</td>
				<td>
					<input class="easyui-textbox" type="text" name="nip_nrp" value="<?=@$tsts[0]->nip_nrp?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Pangkat:</td>
				<td>
					<input class="easyui-textbox" type="text" name="pangkat" value="<?=@$tsts[0]->pangkat?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Pangkat (En):</td>
				<td>
					<input class="easyui-textbox" type="text" name="pangkat_en" value="<?=@$tsts[0]->pangkat_en?>" style="width:100%">
				</td>
			</tr>
			<tr>
				<td>Jabatan:</td>
				<td>
					<input class="easyui-textbox" type="text" name="golongan" value="<?=@$tsts[0]->golongan?>" style="width:100%">
				</td>
			</tr>
		</table>
		<textarea id="tandatanganbase" name="tandatanganbase" style="display:none;"><?=@$tsts[0]->ttddok?></textarea>
		<div align="center"><b>Tanda Tangan <a href="javascript:void(0)" id="hapusttd">Clear TTD</a></b><br />
		<div id="ayeresepolman"></div></div>
</fieldset>

<script>	
	$(function(){
		$('#ayeresepolman').signature({guideline: false});
		$('#ayeresepolman').signature('option', 'syncFormat', 'PNG');
		<?php if($tsts[0]->ttddok != ""){ ?>
		var jsoo = '<?=@$tsts[0]->ttddok?>';
		$('#ayeresepolman').signature('draw', jsoo);
		<?php } ?>
		$('#hapusttd').click(function(){
			 $('#ayeresepolman').signature('clear');
		});	
	});
        </script>