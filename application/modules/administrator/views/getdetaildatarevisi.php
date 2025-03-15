<style>
	.tblxxrevisi td{
		padding:1px;
	}
</style>
<?php
	//print_r($_POST);
?>
<hr style="margin:5px;border:1px solid #cccccc;">
<?php 
	if($_POST['jenis'] == "D" and !empty($_POST['kode1'])){
		//pertama ambil namanyaaaa
		$this->db->where("id_dinas", $_POST['kode1']);
		$sggd = $this->db->get("tb_dinas");
		$ins = $sggd->row();
		
		//pertama ambil urutan terakhir +1
		$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%-".clean_data($ins->nm_dinas)."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tglawal']))."' ");
		$ggt = $yyy->row();
		$ggt->urut_file_new = (int) $ggt->urut_file_new;
		$newurutangka = $ggt->urut_file_new+1;
		$newurutspint = sprintf("%02s", $newurutangka);
		//print_r($ggt);
		
		//selanjutnya adalah ambil idddddnya ya
		$bdbvs = $this->db->query("select urut_file from tb_register where no_filemcu like '%-".clean_data($ins->nm_dinas)."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tglawal']))."' ");
		$bsbvd = $bdbvs->result();
		foreach($bsbvd as $gsbd){
			$urutsudahada[$gsbd->urut_file][] = $gsbd->urut_file;
		}
		for($nm=1;$nm<$newurutangka;$nm++){
			if(!is_array($urutsudahada[$nm])){
				$lanjuturut[$nm] = $nm;
			}
		}
		rsort($lanjuturut);		
?>
<input type="hidden" name="nama_urut" value="<?=@$ins->nm_dinas?>">
<input type="hidden" name="tgl_urut" value="<?=@$_POST['tglawal']?>">
<table class="tblxxrevisi">
	<tr>
		<td colspan="2"><b style="text-decoration:underline">Nomor Urut Tersedia</b></td>
	</tr>
	<tr>
		<td colspan="2"><small><i>Mohon tidak melakukan pendaftaran pasien selama proses <b>Revisi</b></i></small></td>
	</tr>
	<tr>
		<td style="width:2%"><input type="radio" checked="true" name="urutbaru" value="<?=@$newurutangka?>****<?=@$newurutspint?>-<?=@$ins->nm_dinas?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?>"></td>
		<td><?=@$newurutspint?>-<?=@$ins->nm_dinas?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?></td>
	</tr>
	<?php foreach($lanjuturut as $bdbs){ ?>
	<tr>
		<td style="width:2%"><input type="radio" name="urutbaru" value="<?=@$bdbs?>****<?=@sprintf("%02s", $bdbs)?>-<?=@$ins->nm_dinas?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?>"></td>
		<td><?=@sprintf("%02s", $bdbs)?>-<?=@$ins->nm_dinas?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?></td>
	</tr>
	<?php } ?>
</table>
<hr style="margin:5px;border:1px solid #cccccc;">
<button type="button" onclick="updatedatarevisiok()">Update Data</button>
<?php } ?>





<?php 
	if($_POST['jenis'] == "N" and !empty($_POST['kode2']) and !empty($_POST['bayar'])){
		//pertama ambil namanyaaaa
		$this->db->where("id_bayar", $_POST['bayar']);
		$sggd = $this->db->get("tb_bayar");
		$ins = $sggd->row();
		
		//pertama ambil urutan terakhir +1
		$yyy = $this->db->query("select max(urut_file) as urut_file_new from tb_register where no_filemcu like '%-".clean_data($ins->nm_bayar)."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tglawal']))."' ");
		$ggt = $yyy->row();
		$ggt->urut_file_new = (int) $ggt->urut_file_new;
		$newurutangka = $ggt->urut_file_new+1;
		$newurutspint = sprintf("%02s", $newurutangka);
		//print_r($ggt);
		
		//selanjutnya adalah ambil idddddnya ya
		$bdbvs = $this->db->query("select urut_file from tb_register where no_filemcu like '%-".clean_data($ins->nm_bayar)."/%' and konsul <> 'Y' and DATE_FORMAT(tgl_awal_reg, '%Y')='".date('Y', strtotime($_POST['tglawal']))."' ");
		$bsbvd = $bdbvs->result();
		foreach($bsbvd as $gsbd){
			$urutsudahada[$gsbd->urut_file][] = $gsbd->urut_file;
		}
		for($nm=1;$nm<$newurutangka;$nm++){
			if(!is_array($urutsudahada[$nm])){
				$lanjuturut[$nm] = $nm;
			}
		}
		rsort($lanjuturut);		
?>
<input type="hidden" name="nama_urut" value="<?=@$ins->nm_bayar?>">
<input type="hidden" name="tgl_urut" value="<?=@$_POST['tglawal']?>">
<table class="tblxxrevisi">
	<tr>
		<td colspan="2"><b style="text-decoration:underline">Nomor Urut Tersedia</b></td>
	</tr>
	<tr>
		<td colspan="2"><small><i>Mohon tidak melakukan pendaftaran pasien selama proses <b>Revisi</b></i></small></td>
	</tr>
	<tr>
		<td style="width:2%"><input type="radio" checked="true" name="urutbaru" value="<?=@$newurutangka?>****<?=@$newurutspint?>-<?=@$ins->nm_bayar?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?>"></td>
		<td><?=@$newurutspint?>-<?=@$ins->nm_bayar?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?></td>
	</tr>
	<?php foreach($lanjuturut as $bdbs){ ?>
	<tr>
		<td style="width:2%"><input type="radio" name="urutbaru" value="<?=@$bdbs?>****<?=@sprintf("%02s", $bdbs)?>-<?=@$ins->nm_bayar?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?>"></td>
		<td><?=@sprintf("%02s", $bdbs)?>-<?=@$ins->nm_bayar?>/<?=@date("m-Y", strtotime($_POST['tglawal']))?></td>
	</tr>
	<?php } ?>
</table>
<hr style="margin:5px;border:1px solid #cccccc;">
<button type="button" onclick="updatedatarevisiok()">Update Data</button>
<?php } ?>