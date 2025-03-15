<?php
	//print_r($_GET);
	//ambil history datanya yyaaa
	$sff = "select a.hasilnya, a.adakelainan, a.ketkelainanlainnya, b.tgl_awal_reg from tb_register_detailpemeriksaan a, tb_register b where a.kode_transaksi=b.kode_transaksi ";
	$sff .= " and a.id_pem_deb='".$_GET['idpem']."' and b.no_reg='".$_GET['noreg']."' order by b.tgl_awal_reg DESC";
	$drs = $this->db->query($sff);
	$sta = $drs->result();
	
?>
<table class="tableeasyui" style="width:100%">
	<tr>
		<td width="1%">No</td>
		<td>Tanggal</td>
		<td>Hasil</td>
	</tr>
	<?php
		if($sta){
			$d=1;
			foreach($sta as $vd){
				$w=$d++;
				$hasilnya = $vd->hasilnya;
				if($vd->hasilnya == "Lainnya"){
					$hasilnya = $vd->ketkelainanlainnya;
				}
				$hhh = "";
				if($vd->adakelainan == "Y"){
					$hhh = 'style="background:red;color:white;font-weight:bold"';
				}
	?>
	<tr <?=@$hhh?>>
		<td <?=@$hhh?>><?=@$w?></td>
		<td <?=@$hhh?>><?=@date("d/m/Y H:i:s",strtotime($vd->tgl_awal_reg))?></td>
		<td <?=@$hhh?>><?=@$hasilnya?></td>
	</tr>
		<?php } ?>
	<?php } ?>
</table>