<style>
	hr{
		border:solid 1px #eeeeee;
	}
	.printtablenya td{
		border:solid 1px #eeeeee;
	}
</style>
<?php
	$this->db->select("loket_pendaftaran");
	$this->db->where("id_user", $this->session->userdata('id_user'));
	$this->db->limit('1');
	$ggsaa = $this->db->get('tb_user');
	$fgfas = $ggsaa->row();
	
		$sskj  = "select  id_ins, kdurutan, id_type_khusus from tb_antrian_meta ";
		$sskj .= "where type='pendaftaran' ";
		$sskj .= "and dipanggil_oleh='".$this->session->userdata('id_user')."' ";
		$sskj .= "and loket_pendaftaran='".$fgfas->loket_pendaftaran."' ";
		$sskj .= "and tglmsk like '%". date("Y-m-d") ."%' ";
		$sskj .= "and status='a' ";
		$sskj .= "order by id_met ASC limit 1";
		$upyt = $this->db->query($sskj);
		$cekk = $upyt->row();
		if($cekk){
			$deftampil = $cekk->kdurutan;
		}else {
			$sskj  = "select id_ins, kdurutan, id_type_khusus from tb_antrian_meta ";
			$sskj .= "where type='pendaftaran' ";
			$sskj .= "and dipanggil_oleh='".$this->session->userdata('id_user')."' ";
			$sskj .= "and loket_pendaftaran='".$fgfas->loket_pendaftaran."' ";
			$sskj .= "and tglmsk like '%". date("Y-m-d") ."%' ";
			$sskj .= "and status='b' and  dari_menu_perjanjian='' ";
			$sskj .= "order by tglupdate DESC limit 1";
			$upyt = $this->db->query($sskj);
			$cekk = $upyt->row();
			if($cekk){
				$deftampil = $cekk->kdurutan;
			}else {
				$deftampil = "";
			}
		}
		
?>
<div align="center">Terakhir Refresh: <?=@date("H:i:s")?>
<hr style="margin:5px;"><b>LOKET <?=@$fgfas->loket_pendaftaran?> - <?=@$cekk->kdurutan?></b>
<hr style="margin:5px;">
<?php
//saatnya untuk antrian khusus
$rt = $this->db->get('tb_antrian_khusus');
$sr = $rt->result();	
if($sr){
	foreach($sr as $ff){
?>
<button type="button" class="btn btn-primary btn-sm" onclick="panggilantrian('<?=@$fgfas->loket_pendaftaran?>', '<?=@$ff->id_khusus?>')">
Panggil Antrian Baru</button>
<?php	}
}
?>
<button style="margin-left:20px;" type="button" class="btn btn-success btn-sm" onclick="ulangiantrian('<?=@$fgfas->loket_pendaftaran?>')">Ulangi Antrian</button>
<hr style="margin:5px;">
</div>
<?php
	//ambil list antriannnn
	$scdc = "select * from tb_antrian_meta where tglmsk like '".date("Y-m-d")."%' order by urutan ASC ";
	$svds = $this->db->query($scdc);
	$fsdd = $svds->result();
	
	
?>
<table class="printtablenya" style="width:100%">
	<tr>
		<th>No Antrian</th>
		<th>Jam Ambil Antrian</th>
		<th>Dipanggil Loket</th>
		<th>Panggil Manual</th>
	</tr>
	<?php 
		foreach($fsdd as $svd){ 
		$pnsbd = "";
		$gssd  = "";
		if($svd->loket_pendaftaran > 0){
			$pnsbd = " Loket ". $svd->loket_pendaftaran;
			$gssd = 'style="background:#97FB98;"';
		}
	?>
	<tr>
		<td <?=@$gssd?>><?=@$svd->kdurutan?></td>
		<td <?=@$gssd?>><?=@date("H:i",strtotime($svd->tglmsk))?></td>
		<td <?=@$gssd?>><?=@$pnsbd?></td>
		<td><button type="button" class="btn btn-info btn-sm" onclick="panggilantrianmanual('<?=@$fgfas->loket_pendaftaran?>', '<?=@$svd->id_met?>', '<?=@$svd->kdurutan?>')">Panggil Manual</button></td>
	</tr>
	<?php } ?>
</table>

