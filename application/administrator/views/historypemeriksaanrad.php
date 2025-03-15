<?php
	$sff = "select a.kesanstatus, a.kesantext, a.kode_transaksi, b.tgl_awal_reg, c.id_tind, c.nm_tind from tb_register_pemeriksaan a, tb_register b, tb_tindakan c where a.kode_transaksi=b.kode_transaksi and a.id_tind_pem=c.id_tind ";
	$sff .= " and a.id_ins_tind_pem='3' and b.no_reg='".$_GET['noreg']."' order by b.tgl_awal_reg DESC";
	$drs = $this->db->query($sff);
	$sta = $drs->result();
	
?>
<table class="tableeasyui" style="width:100%">
	<tr>
		<td width="1%">No</td>
		<td width="30%">Tanggal</td>
		<td colspan="2">Pemeriksaan</td>
		<td>Hasil</td>
	</tr>
	<?php
		if($sta){
			$d=1;
			foreach($sta as $vd){
				$w=$d++;
	?>
	<tr>
		<td><?=@$w?></td>
		<td><?=@date("d/m/Y H:i:s",strtotime($vd->tgl_awal_reg))?></td>
		<td colspan="3"><b><?=@$vd->nm_tind?></b> / <?=@$vd->kesanstatus?> / <?=@$vd->kesantext?></td>
	</tr>
					<?php
						//print_r($_GET);
						//ambil history datanya yyaaa
						$tysd = "select a.hasilnya, a.adakelainan, a.ketkelainanlainnya, b.rad_namapemeriksaan from tb_register_detailpemeriksaan a, tb_pemeriksaan b where a.id_pem_deb=b.id_pem ";
						$tysd .= " and a.id_tind_detpem='".$vd->id_tind."' and a.kode_transaksi='".$vd->kode_transaksi."'";
						$sdsd = $this->db->query($tysd);
						$ssda = $sdsd->result();
						if($ssda){
							$sa=1;
									foreach($ssda as $dds){
										$dv=$sa++;
										$hasilnya = $dds->hasilnya;
										if($dds->hasilnya == "Lainnya"){
											$hasilnya = $dds->ketkelainanlainnya;
										}
										$hhh = "";
										if($dds->adakelainan == "Y"){
											$hhh = 'style="background:red;color:white;font-weight:bold"';
										}
							?>
							<tr <?=@$hhh?>>
								<td></td>
								<td></td>
								<td <?=@$hhh?>><?=@$dv?></td>
								<td <?=@$hhh?>><?=@$dds->rad_namapemeriksaan?></td>
								<td <?=@$hhh?>><?=@$hasilnya?></td>
							</tr>
								<?php } ?>
					<?php } ?>
		<?php } ?>
	<?php } ?>
</table>