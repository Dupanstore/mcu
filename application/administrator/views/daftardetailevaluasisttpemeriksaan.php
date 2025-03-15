<?php
		//print_r($_GET);
			$que 	 = "select a.sudah_pemeriksaan, b.id_ins_tind, b.id_tind, b.nm_tind, c.nm_ins from tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi c where a.id_tind_pem=b.id_tind and b.id_ins_tind=c.id_ins and a.kode_transaksi='".$_GET['kode_transaksi']."'  and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind <> '2' AND b.id_ins_tind <> '3')";
			$que 	.= " order by b.id_ins_tind ASC";
			$data['query'] 	= $this->db->query($que);
			$ffds = $data['query']->result();
			$hhhh = array();
			if($ffds){
				$hhhh = $ffds;
			}
			$que 	 = "select a.sudah_pemeriksaan,  b.id_ins_tind, b.id_tind, b.nm_tind, c.nm_ins from tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi c where a.id_tind_pem=b.id_tind and b.id_ins_tind=c.id_ins and a.kode_transaksi='".$_GET['kode_transaksi']."' and b.tampil_di_pemeriksaan <> 'N' and (b.id_ins_tind='2' OR b.id_ins_tind='3') group by b.id_ins_tind";
			$que 	.= " order by b.id_ins_tind ASC";
			$data['query'] 	= $this->db->query($que);
			$ffds = $data['query']->result();
			if($ffds){
				foreach($ffds as $gs){
					if($gs->id_ins_tind == '2'){
						$gs->id_tind = "Laboratorium";
						$gs->nm_tind = "Laboratorium";
					}else {
						$gs->id_tind = "Radiologi";
						$gs->nm_tind = "Radiologi";
					}
					$hhhh[] = $gs;
				}
			}

			//print_r($hhhh);
		
?>
<table class="tableeasyui" style="width:99.8%">
	<tr>
		<td style="background:#CDDEF0;"><b>Ruang</b></td>
		<td style="background:#CDDEF0;"><b>Pemeriksaan</b></td>
		<td style="background:#CDDEF0;"><b>Status</b></td>
	</tr>
	<?php 
		foreach($hhhh as $gdvs){ 
			$sttpem = "Sudah";
			$dnsgdf = "";
			if($gdvs->sudah_pemeriksaan == ""){
				$sttpem = "Belum";
				$dnsgdf = 'style="background:red;color:white;font-weight:bold;"';
			}
	?>
	<tr>
		<td <?=@$dnsgdf?>><?=@$gdvs->nm_ins?></td>
		<td><?=@$gdvs->nm_tind?></td>
		<td><?=@$sttpem?></td>
	</tr>
	<?php } ?>
</table>